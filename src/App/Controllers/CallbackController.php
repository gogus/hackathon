<?php
namespace App\Controllers;

use App\Services\FacebookMessengerService;
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

    /**
     * CallbackController constructor.
     *
     * @param FacebookMessengerService $facebookMessengerService
     */
    public function __construct(FacebookMessengerService $facebookMessengerService)
    {
        $this->facebookMessengerService = $facebookMessengerService;
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
                $this->facebookMessengerService->sendMessage($message['sender']['id'], 'Whatever.');
            }
        }

        return new JsonResponse(true);
    }
}
