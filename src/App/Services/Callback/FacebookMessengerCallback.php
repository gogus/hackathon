<?php

namespace App\Services\Callback;

use GuzzleHttp\Client;

/**
 * Class FacebookMessengerCallback
 *
 * @package App\Services\Callback
 */
class FacebookMessengerCallback
{
    /** @var string */
    protected $accessToken;

    /** @var int */
    protected $fanpageId;

    /** @var Client */
    protected $client;

    /**
     * FacebookMessengerCallback constructor.
     *
     * @param Client $client
     * @param string $accessToken
     * @param int $fanpageId
     */
    public function __construct(Client $client, $accessToken, $fanpageId)
    {
        $this->accessToken = $accessToken;
        $this->fanpageId = $fanpageId;
        $this->client = $client;
    }

    /**
     * @param int $recipientId
     * @param string $outputMessage
     */
    public function sendMessage($recipientId, $outputMessage)
    {
        $data = [
            'recipient' => [
                'id' => $recipientId
            ],
            'message' => [
                'text' => $outputMessage
            ]
        ];

        $this->client->post(
            'https://graph.facebook.com/v2.6/me/messages?access_token=' . $this->accessToken,
            [
                'json' => $data
            ]
        );
    }
}
