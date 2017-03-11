<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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

        foreach ($input['entry']['messaging'] as $message) {
            $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=EAAJ4pzDROJwBANhEhVUnhZCpAE8VaKGwSu9wCsCAQM8Bpew2THlE0klfHraRGmiiY9NXc5ZAjb9gwsHaJZAuZBozUREVXXhew4dCfDLZCoXZBFqY2tXCsp35jXqn5DeDwLPXN1jiOZCkKsmppRY1qE0kZBpohdEUKYRbsvLIXtkBwwZDZD';
            $ch = curl_init($url);
            $jsonData = '{
             "recipient":{
                "id":"'.$message['recipient']['id'].'"
             },
             "message":{
                "text":"Whatever!"
             }
            }';

            $jsonDataEncoded = $jsonData;
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            $result = curl_exec($ch);
        }
    }
}
