<?php
namespace App\Controllers;

use App\Services\Callback\FacebookMessengerCallback;
use App\Services\QueryParserService;
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

    /** @var */
    protected $queryParserService;

    /**
     * CallbackController constructor.
     *
     * @param FacebookMessengerCallback $facebookMessengerCallback
     * @param QueryParserService $queryParserService
     */
    public function __construct(
        FacebookMessengerCallback $facebookMessengerCallback,
        QueryParserService $queryParserService)
    {
        $this->facebookMessengerCallback = $facebookMessengerCallback;
        $this->queryParserService = $queryParserService;
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
                $queryParser = $this->queryParserService->ask($message['message']['text']);
                $this->facebookMessengerCallback->sendMessage($message['sender']['id'], $queryParser);
            }
        }

        return new JsonResponse(true);
    }
}
