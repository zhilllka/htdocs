<?php

namespace cp;

class error
{
    public function __construct()
    {
        $_SESSION['alert'] = [];
    }

    private function processing_error_code ($error_code)
    {
        if ($error_code == '')
        {

        }
        elseif ($error_code == '')
        {

        }
        elseif ($error_code == '')
        {

        }
        elseif ($error_code == '')
        {

        }
        elseif ($error_code == '')
        {

        }
        elseif ($error_code == '')
        {

        }
        elseif ($error_code == '')
        {

        }
        else
        {
            $type = "danger";
            $header = "Ошибка!";
            $text = "Неизвестная ошибка. Код ошибки: <strong>$error_code</strong>";
        }

        return [
            'type' => $type,
            'header' => $header,
            'text' => $text,
        ];
    }

    private function create ($error_code)
    {

        $body = $this->processing_error_code($error_code);

        $result = "
        
        <div class = 'alert $body[type]'>
            <div class='alert-header'>
                <p>$body[header]</p>
            </div>
            <div class='alert-text'>
                <p>$body[text]</p>    
            </div>
        </div>
        
        ";

        return $result;
    }

    public function view ($code)
    {
        $_SESSION['alert'][] = $this->create($code);
    }
}