<?php

namespace App\Controllers;

use App\Domain\Callback\FacebookMessengerCallback;
use App\Domain\QueryParser;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CallbackController
 *
 * @package App\Controllers
 */
class CallbackController
{
    /** @var FacebookMessengerCallback */
    protected $facebookMessengerCallback;

    /** @var QueryParser */
    protected $queryParserService;

    /**
     * @param FacebookMessengerCallback $facebookMessengerCallback
     * @param QueryParser               $queryParser
     */
    public function __construct(
        FacebookMessengerCallback $facebookMessengerCallback,
        QueryParser $queryParser)
    {
        $this->facebookMessengerCallback = $facebookMessengerCallback;
        $this->queryParserService = $queryParser;
    }

    /**
     * @return JsonResponse
     */
    public function facebookMessengerAction()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        /** @var array $entries */
        $entries = $input['entry'];

        foreach ($entries as $entry) {
            /** @var array $messages */
            $messages = $entry['messaging'];

            foreach ($messages as $message) {
                $queryParser = $this->queryParserService->queryParse($message['message']['text']);
                $this->facebookMessengerCallback->sendMessage($message['sender']['id'], $queryParser);
            }
        }

        return new JsonResponse(true);
    }
}
