<?php

namespace cp;

class FA
{
    public function __construct($authKey)
    {
    }




    public function generate_code ($length)
    {
        $arr = array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
            'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'
        );

        $res = '';

        for ($i = 0; $i < $length; $i++) {
            $res .= $arr[random_int(0, count($arr) - 1)];
        }

        return $res;
    }

    private function send ($network)
    {

    }
}