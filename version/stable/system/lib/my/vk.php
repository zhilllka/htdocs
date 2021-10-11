<?php

namespace vk;
use Curl\Curl;


class access_token
{
    public function __construct()
    {
        $this->curl = new Curl();
    }

    private array $auth_client = [
        'android' => [
            'client_id' => '2274003',
            'client_secret' => 'hHbZxrka2uZ6jB1inYsH',
        ],
        'iphone' => [
            'client_id' => '3140623',
            'client_secret' => 'VeWdmVclDCtn6ihuP1nt',
        ],
        'ipad' => [
            'client_id' => '3682744',
            'client_secret' => 'mY6CDUswIVdJLCD3j15n',
        ],
        'windows' => [
            'client_id' => '3697615',
            'client_secret' => 'AlVXZFMUqyrnABp8ncuU',
        ],
        'windowsPhone' => [
            'client_id' => '3502557',
            'client_secret' => 'PEObAuQi6KloPM4T30DV',
        ],
        ];

    public function get_token ($auth_client, $username, $passcode, $scope = "offline,friends,messages,status,notify,photos,audio,video,stories,pages,notes,wall,ads,docs,groups,notifications,stats,email,market")
    {
        if (array_key_exists($auth_client, $this->auth_client))
        {
            $client_id = $this->auth_client[$auth_client]['client_id'];
            $client_secret = $this->auth_client[$auth_client]['client_secret'];
        }

        $this->curl->post('https://api.vk2.com/oauth/token', array(
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'username' => $username,
            'password' => $passcode,
            'grant_type' => 'password',
            'scope' => $scope ,
        ));

        $this->curl = json_decode($this->curl->response, true);

        return $this->curl;
    }
}

//$VK = new access_token();
//$VK->get_token('iphone','root','root');


class profile
{
    public function __construct()
    {
        $this->curl = new Curl();
    }
}



class messages
{
    public function __construct()
    {
        $this->curl = new Curl();
    }
}



class friends
{
    public function __construct()
    {
        $this->curl = new Curl();
    }
}




class feed
{
    public function __construct()
    {
        $this->curl = new Curl();
    }
}





class groups
{
    public function __construct()
    {
        $this->curl = new Curl();
    }
}