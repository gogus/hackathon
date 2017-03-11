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
}
