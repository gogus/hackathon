<?php

namespace App\Controllers;

use App\Domain\Callback\FacebookMessengerCallback;
use App\Domain\Callback\Formatter\FormatterFactory;
use App\Domain\Exception\LocalizationRequiredException;
use App\Domain\QueryParser;
use App\Services\PreviousQueryService;
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
     * @var PreviousQueryService
     */
    protected $previousQueryService;

    /**
     * @param FacebookMessengerCallback $facebookMessengerCallback
     * @param QueryParser $queryParserService
     * @param FormatterFactory $responseFormatterFactory
     * @param PreviousQueryService $previousQueryService
     */
    public function __construct(
        FacebookMessengerCallback $facebookMessengerCallback,
        QueryParser $queryParserService,
        FormatterFactory $responseFormatterFactory,
        PreviousQueryService $previousQueryService
    )
    {
        $this->facebookMessengerCallback = $facebookMessengerCallback;
        $this->queryParserService = $queryParserService;
        $this->responseFormatterFactory = $responseFormatterFactory;
        $this->previousQueryService = $previousQueryService;
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
                $senderId       = $message['sender']['id'];
                $messageDetails = $message['message'];
                $query          = $messageDetails['text'] ?: null;

                if (isset($messageDetails['attachments']) && 'location' === $messageDetails['attachments']['type']) {
                    $query = sprintf(
                        '%s [%s]',
                        $this->previousQueryService->get($senderId),
                        implode(' ', $messageDetails['attachments']['payload']['coordinates'])
                    );
                } else {
                    $this->previousQueryService->save($senderId, $query);
                }

                try {
                    $response = $this->queryParserService->queryParse($query);
                    $formatted = $this->responseFormatterFactory->format($response);
                } catch (LocalizationRequiredException $localizationRequiredException) {
                    $formatted = [
                        'text' => 'Please share your location.',
                        'quick_replies' => [
                            'content_type' => 'location'
                        ]
                    ];
                }

                $this->facebookMessengerCallback->sendMessage($senderId, $formatted);
            }
        }

        return new JsonResponse(true);
    }
}
