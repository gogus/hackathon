<?php

namespace App\Services;

/**
 * Class FacebookMessengerService
 *
 * @package App\Services
 */
class FacebookMessengerService extends BaseService
{
    /** @var string */
    protected $accessToken;

    /** @var int */
    protected $fanpageId;

    /**
     * FacebookMessengerService constructor.
     *
     * @param $db
     * @param string $accessToken
     * @param int $fanpageId
     */
    public function __construct($db, $accessToken, $fanpageId)
    {
        $this->accessToken = $accessToken;
        $this->fanpageId = $fanpageId;

        parent::__construct($db);
    }

    /**
     * @param int $recipientId
     * @param string $outputMessage
     */
    public function sendMessage($recipientId, $outputMessage)
    {
        $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . $this->accessToken;
        $ch = curl_init($url);

        $data = [
            'recipient' => [
                'id' => $recipientId
            ],
            'message' => [
                'text' => $outputMessage
            ]
        ];

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        curl_exec($ch);
    }
}
