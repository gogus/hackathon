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
        $challenge = $_REQUEST['hub_challenge'];
        $verify_token = $_REQUEST['hub_verify_token'];

        if ($verify_token === 'luxbot') {
            return new Response($challenge);
        }

        return new Response('bad');
    }
}
