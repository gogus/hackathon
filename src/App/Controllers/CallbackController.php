<?php
namespace App\Controllers;

use App\Services\Callback\FacebookMessengerCallback;
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

    /**
     * CallbackController constructor.
     *
     * @param FacebookMessengerCallback $facebookMessengerCallback
     */
    public function __construct(FacebookMessengerCallback $facebookMessengerCallback)
    {
        $this->facebookMessengerCallback = $facebookMessengerCallback;
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
                $this->facebookMessengerCallback->sendMessage($message['sender']['id'], 'Whatever.');
            }
        }

        return new JsonResponse(true);
    }
}
