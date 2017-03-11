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
        $access_token = "EAAJ4pzDROJwBAIJxYgPjLNnkYFYdaqLwZBB4PMLSTf6BVzraKcECqhf3hVukT6yO538DILfwA0C5ZCSS60erw3HtHjurKYtIRal4OxzY55svpocGWxJoGEWKaZAZBeWQgaHDIc2Fzowd7yPM8ZCNLSG1ziUS31yuxqubMWIcqpgZDZD";
        $verify_token = "luxbot";
        $hub_verify_token = null;

        if(isset($_REQUEST['hub_challenge'])) {
            $challenge = $_REQUEST['hub_challenge'];
            $hub_verify_token = $_REQUEST['hub_verify_token'];
        }

        if ($hub_verify_token === $verify_token) {
            echo $challenge;
            die;
        }
    }
}
