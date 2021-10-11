<?php

namespace vk;

use Curl\Curl;

class access_token
{
    public function __construct($username, $passcode, $client, $scope = "offline,friends,messages,status,notify,photos,audio,video,stories,pages,notes,wall,ads,docs,groups,notifications,stats,email,market")
    {
        $this->curl = new Curl();
        $this->username = $username;
        $this->passcode = $passcode;
        $this->client = $client;
        $this->scope = $scope;

        if ($client == 'android') {
            $this->client_id = "2274003";
            $this->client_secret = "hHbZxrka2uZ6jB1inYsH";
        } else if ($client == 'iphone') {
            $this->client_id = "3140623";
            $this->client_secret = "VeWdmVclDCtn6ihuP1nt";
        } else if ($client == 'ipad') {
            $this->client_id = "3682744";
            $this->client_secret = "mY6CDUswIVdJLCD3j15n";
        } else if ($client == 'windows') {
            $this->client_id = "3697615";
            $this->client_secret = "AlVXZFMUqyrnABp8ncuU";
        } else if ($client == 'windowsPhone') {
            $this->client_id = "3502557";
            $this->client_secret = "PEObAuQi6KloPM4T30DV";
        }

    }



    public function get ()
    {
        $this->curl->post('https://api.vk.com/oauth/token', array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'username' => $this->username,
            'password' => $this->passcode,
            'grant_type' => 'password',
            'scope' => $this->scope,
        ));

        $this->curl = json_decode($this->curl->response, true);

        return $this->curl;
    }
}