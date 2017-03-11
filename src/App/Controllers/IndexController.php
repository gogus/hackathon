<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class IndexController
 *
 * @package App\Controllers
 */
class IndexController
{
    /**
     * @return JsonResponse
     */
    public function indexAction()
    {
        return new JsonResponse(['status' => 'ok']);
    }

    /**
     *
     */
    public function messengerHookAction()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        foreach ($input['entry'] as $entry) {
            foreach ($entry['messaging'] as $message) {
                $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=EAAJ4pzDROJwBANhEhVUnhZCpAE8VaKGwSu9wCsCAQM8Bpew2THlE0klfHraRGmiiY9NXc5ZAjb9gwsHaJZAuZBozUREVXXhew4dCfDLZCoXZBFqY2tXCsp35jXqn5DeDwLPXN1jiOZCkKsmppRY1qE0kZBpohdEUKYRbsvLIXtkBwwZDZD';
                $ch = curl_init($url);

                $data = [
                    'recipient' => [
                        'id' => $message['recipient']['id']
                    ],
                    'message' => [
                        'text' => 'Whatever'
                    ]
                ];

                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

                $result = curl_exec($ch);
                file_put_contents('test', $result);
                file_put_contents('test2', $message);
            }
        }

        file_put_contents('test3', var_export($input['entry'], true));

        return new JsonResponse(true);
    }
}
