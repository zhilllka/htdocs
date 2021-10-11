<?php

namespace cp;

class profile
{
    public function __construct($authKey)
    {

        $this->authKey = $authKey;
        $this->db = $GLOBALS['db'];

    }



    public function get_info_with_db ($select)
    {

        $userDB = $this->db->query("SELECT ".$select." FROM `users` WHERE authKey = '".$this->authKey."'", 30);
        $userDB = $userDB->fetchAssoc();

        if ($userDB == NULL) {

            return NULL;

        } else {

            return $userDB;

        }

    }



    public function set_online ($status)
    {

        $set_online = $this->db->query("UPDATE users SET authOnline = '".$status."' WHERE authKey='".$this->authKey."'", 30);

    }
}