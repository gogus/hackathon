<?php

namespace App\Controllers;

use App\Domain\Callback\FacebookMessengerCallback;
use App\Domain\Callback\Formatter\FormatterFactory;
use App\Domain\Callback\Formatter\FormatterInterface;
use App\Domain\QueryParser;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Facebook app API controller
 */
class CallbackController
{
    /**
     * @var FacebookMessengerCallback
     */
    protected $facebookMessengerCallback;

    /**
     * @var QueryParser
     */
    protected $queryParserService;

    /**
     * @var FormatterFactory
     */
    protected $responseFormatterFactory;

    /**
     * @param FacebookMessengerCallback $facebookMessengerCallback
     * @param QueryParser               $queryParserService
     * @param FormatterInterface        $responseFormatter
     */
    public function __construct(
        FacebookMessengerCallback $facebookMessengerCallback,
        QueryParser $queryParserService,
        FormatterInterface $responseFormatter
    )
    {
        $this->facebookMessengerCallback = $facebookMessengerCallback;
        $this->queryParserService = $queryParserService;
        $this->responseFormatter = $responseFormatter;
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
                $response = $this->queryParserService->queryParse($message['message']['text']);
                $formatted = $this->responseFormatterFactory->format($response);
                $this->facebookMessengerCallback->sendMessage($message['sender']['id'], $formatted);
            }
        }

        return new JsonResponse(true);
    }
}
