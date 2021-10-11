<?php

namespace cp;

class sign
{
    public function __construct($username, $passcode)
    {
        $this->username = $username;
        $this->passcode = $passcode;
        $this->db = $GLOBALS['db'];
    }



    private function generate_code ($length)
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




    public function in ()
    {

        // Проверяем, пусты ли входящие данные.
        if (empty($this->username) or empty($this->passcode))
        {

            return 'empty_username_and_passcode';

        }


        // Проверяем, есть ли запрещенные символы.
        if (!preg_match("#^[A-Za-z0-9\-_]+$#",$this->username) or !preg_match("#^[A-Za-z0-9\-_]+$#",$this->passcode))
        {

            return 'found_forbidden_symbol';

        }


        // Отправляем запрос в базу данных на получение информации о пользователе.
        $auth = $this->db->query("SELECT * FROM `users` WHERE username = '".$this->username."' AND passcode = '".$this->passcode."'", 30);
        $auth = $auth->fetchAssoc();


        // Если запрос вернул NULL.
        if ($auth == NULL)
        {

            return 'wrong_username_and_passcode';

        }


        // Если запрос вернул информацию о пользователе.
        else {

            // Если у пользователя нету ключа авторизации в базе данных.
            if ($auth['authKey'] == NULL)
            {
                // Разрешаем вход.
                $authUser = true;
            }
            else
            {
                // Проверяем, разрешен ли вход с нескольких устройств.
                if ($auth['authMulti']) {

                    $authUser = true;

                }
                else
                {

                    // Если запрещен, отклоняем авторизацию и генерируем ошибку.
                    $authUser = false;
                    $authUserError = 'access_from_multiple_devices_is_prohibited';

                }
            }


            // Если авторизация разрешена.
            if ($authUser) {

                // Генерируем ключ авторизации.
                $authKey = $this->generate_code('100');

                // Обновляем ключ авторизации в базе данных.
                $update_auth_key_to_db = $this->db->query("UPDATE users SET authKey = '".$authKey."' WHERE id=".$auth['id'], 30);

                // Обновляем маршрут в базе данных.
                $update_route_now_to_db = $this->db->query("UPDATE users SET routeNow = 'desktop/main' WHERE id=".$auth['id'], 30);

                // Добавляем пользователю метку "в онлайне".
                $profile = new profile($authKey);
                $profile->set_online(true);

                // Получаем обновленную информацию о пользователе с БД.
                $auth = $this->db->query("SELECT * FROM `users` WHERE username = '".$this->username."' AND passcode = '".$this->passcode."'", 30);
                $auth = $auth->fetchAssoc();

                // Создаем сессию.
                $_SESSION['user'] = $auth;

                return 'sign_in_success';
            }
            // Если авторизации запрещена.
            else
            {

                // Выводим ошибку.
                return $authUserError;

            }

        }

    }



    public function up ()
    {

    }



    public function restore ()
    {

    }



    public function out ()
    {
        // Ставим статус "оффлайн".
        $profile = new profile($_SESSION['user']['authKey']);
        $profile->set_online(false);

        // Уничтожаем ключ в базе данных.
        $destroy_auth_key = $this->db->query("UPDATE users SET authKey = NULL WHERE id='".$_SESSION['user']['id']."'", 30);

        // Уничтожаем сессию пользователя.
        $_SESSION['user'] = [];

        // Выводим сообщение о успешности выхода.
        return 'success_sign_out';
    }
}