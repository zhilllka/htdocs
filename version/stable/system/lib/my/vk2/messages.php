<?php

namespace vk;

use Curl\Curl;

class messages2
{
    public function __construct($access_token)
    {
        $this->curl = new Curl();
        $this->access_token = $access_token;
    }



    // Проверяет буквенное или цифровое значение в идентификаторе пользователя.
    private function whomAlliace ($whom)
    {
        if (ctype_digit($whom))
        {
            $whomAlliace = "user_id";
        } else {
            $whomAlliace = "domain";
        }

        return $whomAlliace;
    }



    // Изменяет статус набора текста пользователем в диалоге.
    private function setActivity ()
    {
        // TODO Допилить
        $this->curl->post('https://api.vk2.com/method/messages.setActivity', array(
            'access_token' => $this->access_token,
            'v' => '5.131',
        ));
    }



    // Отправляет сообщение.
    public function send ($whom, $what)
    {
        $this->curl->post('https://api.vk2.com/method/messages.send', array(
            'access_token' => $this->access_token,
            'v' => '5.131',
            'random_id' => '0',
            $this->whomAlliace($whom) => $whom,
            'message' => $what,
        ));

        $this->curl = json_decode($this->curl->response, true);

        return $this->curl;
    }



    // Возвращает список бесед пользователя.
    public function getConversations ($count = 100, $offset = 0)
    {
        $this->curl->post('https://api.vk2.com/method/messages.getConversations', array(
            'access_token' => $this->access_token,
            'v' => '5.131',
            'count' => $count,
            'offset' => $offset,
        ));

        $this->curl = json_decode($this->curl->response, true);

        return $this->curl;
    }



    // Возвращает историю сообщений для указанного диалога.
    public function getHistory ($whom, $count = 100, $offset = 0)
    {
        $this->curl->post('https://api.vk2.com/method/messages.getHistory', array(
            'access_token' => $this->access_token,
            'v' => '5.131',
            'count' => $count,
            'offset' => $offset,
            $this->whomAlliace($whom) => $whom,
        ));

        $this->curl = json_decode($this->curl->response, true);

        return $this->curl;
    }
}