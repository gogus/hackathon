<?php
namespace App\Controllers;

use App\Services\FacebookMessengerService;
use App\Services\QueryParserService;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class CallbackController
 *
 * @package App\Controllers
 */
class CallbackController
{
    /** @var FacebookMessengerService */
    protected $facebookMessengerService;

    /** @var */
    protected $queryParserService;

    /**
     * CallbackController constructor.
     *
     * @param FacebookMessengerService $facebookMessengerService
     * @param QueryParserService $queryParserService
     */
    public function __construct(
        FacebookMessengerService $facebookMessengerService,
        QueryParserService $queryParserService
    ) {
        $this->facebookMessengerService = $facebookMessengerService;
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
                $this->facebookMessengerService->sendMessage($message['sender']['id'], $queryParser);
            }
        }

        return new JsonResponse(true);
    }
}
