<?php

namespace cp;

class deffender
{
    public function __construct($authKey)
    {
        $this->authKey = $authKey;
    }


    public function start()
    {



        $user_db = new profile($this->authKey);
        $user_db = $user_db->get_info_with_db('authKey');

        if ($user_db == NULL)
        {

            return 'invalid_authorization_key';

        }

    }
}