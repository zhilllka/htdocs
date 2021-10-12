<?php

namespace cp;
use Krugozor\Database\Mysql;

// Проверка на целостность файловой структуры.
if(!defined("integrity_protection")) {require_once $_SERVER['DOCUMENT_ROOT'].'/version/stable/system/pages/error/404.php';exit();}



class database
{
    public function connect ()
    {
        return $db = Mysql::create("localhost", "roman123", "Marozwtpmj")
            ->setDatabaseName("zhilkin")
            ->setCharset("utf8");
    }


    public function get ($method, $from, $where, $what = '*')
    {
        if ($method == 'array')
        {
            $result = $this->connect()->query("SELECT $what FROM `$from` WHERE $where", 30);
            $result = $result->fetchAssocArray();
            return $result;
        }
        else
        {
            $result = $this->connect()->query("SELECT $what FROM `$from` WHERE $where", 30);
            $result = $result->fetchAssoc();
            return $result;
        }

    }
}



class profile
{
    public function __construct($authKey = NULL)
    {
        $db = new database();
        $this->db = $db->connect();

        $this->alert = new alert();


        $this->authKey = $authKey;
    }



    public function sign_in ($username, $passcode)
    {
        // Проверяем, пусты ли входящие данные.
        if (empty($username) or empty($passcode))
        {
            $this->alert->view('Empty username and passcode');
            return false;
        }

        // Проверяем, есть ли запрещенные символы.
        if (!preg_match("#^[A-Za-z0-9\-_]+$#", $username) or !preg_match("#^[A-Za-z0-9\-_]+$#", $passcode))
        {
            $this->alert->view('Found forbidden symbol');
            return false;
        }

        // Пытаемся получить информацию о пользователе.
        $db_user = $this->db->query("SELECT * FROM `users` WHERE username = '".$username."' AND passcode = '".$passcode."'", 30);
        $db_user = $db_user->fetchAssoc();

        // Если запрос вернул NULL.
        if ($db_user == NULL)
        {
            $this->alert->view('Wrong username and passcode');
            return false;
        }
        // Успешно получили информацию пользователя.
        else
        {
            // Проверяем, подключена ли двух-факторная авторизация.
            if ($db_user['2FA'])
            {
                $this->alert->view('Two-factor authorization is enabled in your account');
                return false;
            }

            // Если не подключена.
            else{
                // Если разрешен вход с нескольких устройств.
                if ($db_user['authMulti'])
                {
                    // Генерируем ключ авторизации.
                    $authKey = new deffender();
                    $authKey = $authKey->generate_code(100);

                    // Заносим ключ в базу данных.
                    $update_authKey = $this->db->query("UPDATE users SET authKey = '".$authKey."' WHERE id=".$db_user['id'], 30);

                    // Устанавливаем статус "в сети".
                    $this->set_status(true, $authKey);

                    // Добавляем ключ авторизации в сессию.
                    $_SESSION['user']['authKey'] = $authKey;

                    // Добавляем id пользователя в сессию.
                    $_SESSION['user']['id'] = $db_user['id'];

                    // Отправляем на рабочий стол.
                    $_SESSION['user']['routeNow'] = "desktop/main";

                    // TODO не безопасно, переделать, что бы инфа бралась с базы.
                    $_SESSION['user']['authVersion'] = $db_user['authVersion'];

                    // Выводим информацию об успешном входе.
                    $this->alert->view('You have successfully logged in');
                    return false;
                }

                // Если запрещен.
                else
                {
                    $this->alert->view('Access from multiple devices is prohibited');
                    return false;
                }
            }
        }
    }

    public function sign_out ($authKey)
    {
        // Ставим отметку, что пользователь не в сети.
        $this->set_status(false, $authKey);

        // Уничтожаем ключ авторизации в базе данных.
        $update_authKey = $this->db->query("UPDATE users SET authKey = NULL WHERE authKey = '".$authKey."'", 30);

        // Уничтожаем ключ авторизации в сессии.
        $_SESSION['user'] = [];

        $this->alert->view('You have successfully logged out of your account');
        return false;
    }

    public function sign_up ($username, $passcode)
    {

    }

    public function sign_restore ($username, $passcode)
    {

    }

    public function set_status ($status, $authKey = NULL)
    {
        $set_online = $this->db->query("UPDATE users SET authOnline = '".$status."' WHERE authKey='".$authKey."'", 30);
    }

    public function get_status ($id = NULL, $authKey = NULL)
    {

    }
}





// ЗАЩИТНЫЕ ФУНКЦИИ
class deffender
{
    public function __construct()
    {
        $db = new database();
        $this->db = $db->connect();

        $this->alert = new alert();
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


    public function check ($authKey)
    {
        // Проверяем, существует ли такой ключ авторизации.
        $db_user = $this->db->query("SELECT authKey FROM `users` WHERE authKey = '$authKey'", 30);
        $db_user = $db_user->fetchAssoc();

        if ($db_user == NULL)
        {
            $this->alert->view('error key auth');
            $_SESSION['user'] = [];
            $_SESSION['user']['routeNow'] = 'sign/in';
        }
    }
}





// ОПОВЕЩЕНИЕ ДЛЯ ПОЛЬЗОВАТЕЛЕЙ
class alert
{
    public function __construct()
    {

    }


    private array $errorCode = [
        // ERROR
        'Empty username and passcode' => [
            'type' => 'error',
            'header' => 'Ошибка',
            'text' => 'Необходимо ввести логин и пароль.',
        ],
        'Found forbidden symbol' => [
            'type' => 'error',
            'header' => 'Ошибка',
            'text' => 'Вы ввели запрещенный символ. Разрешены следующие символы: A-w, А-я, 0-9.',
        ],
        'Wrong username and passcode' => [
            'type' => 'error',
            'header' => 'Ошибка',
            'text' => 'Неверный логин или пароль.',
        ],
        'Access from multiple devices is prohibited' => [
            'type' => 'error',
            'header' => 'Ошибка',
            'text' => 'На вашем аккаунте запрещен вход с нескольких устройств, пожалуйста, выйдите с Вашего прошлого устройства или дождитесь 60 минут.',
        ],
        'Wrong username and passcodцe' => [
            'type' => 'error',
            'header' => 'Ошибка',
            'text' => '',
        ],
        'adwad' => [
            'type' => 'error',
            'header' => 'Ошибка',
            'text' => '',
        ],

        // INFO
        'Two-factor authorization is enabled in your account' => [
            'type' => 'info',
            'header' => 'Информативное сообщение',
            'text' => 'В вашем аккаунте подключена двух-факторная авторизация.',
        ],

        // SUCCESS
        'You have successfully logged in' => [
            'type' => 'success',
            'header' => 'Успех!',
            'text' => 'Добро пожаловать в прекрасный мир:)',
        ],
        'You have successfully logged out of your account' => [
            'type' => 'success',
            'header' => 'Успех!',
            'text' => 'Возвращайтесь как можно скорее, мы скучаем :(',
        ],
    ];



    public function view ($errorCode)
    {
            if (array_key_exists($errorCode, $this->errorCode))
            {
                $type = $this->errorCode[$errorCode]['type'];
                $header = $this->errorCode[$errorCode]['header'];
                $text = $this->errorCode[$errorCode]['text'];

            }
            else
            {
                $type = 'error';
                $header = 'Неизвестная ошибка';
                $text = "Код: <strong>'.$errorCode.'</strong>";

            }

            $alert = "
            <div class='alert $type'>
                <h1>$header</h1>
                <h2>$text</h2>
            </div>
            
            ";

            $_SESSION['alert'][] = $alert;

    }

}




class route
{
    public function __construct()
    {
        $db = new database();
        $this->db = $db->connect();

        $this->alert = new alert();
    }

    private function get_route_from_db ($authKey)
    {
        $userRouteNow = $this->db->query("SELECT routeNow, routePrev FROM `users` WHERE authKey = '$authKey'", 30);
        $userRouteNow = $userRouteNow->fetchAssoc();
        return $userRouteNow;
    }

    private function update_to_db ($to, $authKey)
    {
        $route = $this->get_route_from_db($authKey);
        $update_route_prev = $this->db->query("UPDATE users SET routePrev = '".$route['routeNow']."' WHERE authKey='$authKey'", 30);
        $update_route_now = $this->db->query("UPDATE users SET routeNow = '".$to."' WHERE authKey='".$authKey."'", 30);
    }

    private function update_to_session ($to)
    {
        $_SESSION['user']['routePrev'] = $_SESSION['user']['routeNow'];
        $_SESSION['user']['routeNow'] = $to;
    }

    private function get_url ($to, $authKey)
    {
        if (empty($to))
        {
            if (isset($_SESSION['user']['authKey']))
            {
                $url = "version/".$_SESSION['user']['authVersion']."/system/pages/".$_SESSION['user']['routeNow'].".php";
                $this->update_to_db($to, $authKey);
                $this->update_to_session($to);
            }
            else
            {
                $url = "version/stable/system/pages/sign/in.php";
                $this->update_to_session($to);
            }
        }
        else
        {
            if (isset($_SESSION['user']['authKey']))
            {
                $url = "version/".$_SESSION['user']['authVersion']."/system/pages/$to.php";
                $this->update_to_db($to, $authKey);
                $this->update_to_session($to);
            }
            else
            {
                $url = "version/stable/system/pages/$to.php";
                $this->update_to_session($to);
            }
        }

        if (is_file($url))
        {
//            if (isset($_SESSION['user']['authKey']))
//            {
//                $url = "version/".$_SESSION['user']['authVersion']."/system/pages/".$_SESSION['user']['routeNow'].".php";
//                $this->update_to_db($to, $authKey);
//                $this->update_to_session($to);
//                $this->alert->view('error url route');
//            }
//            else
//            {
//                $url = "version/stable/system/pages/sign/in.php";
//                $this->update_to_session($to);
//                $this->alert->view('error url route');
//            }
        }
        else
        {
            if (isset($_SESSION['user']['authKey']))
            {
                $url = "version/".$_SESSION['user']['authVersion']."/system/pages/".$_SESSION['user']['routePrev'].".php";
                $this->update_to_db($to, $authKey);
                $this->update_to_session($_SESSION['user']['routePrev']);
                $this->alert->view('error url route');
            }
            else
            {
                $url = "version/stable/system/pages/sign/in.php";
                $this->update_to_session($_SESSION['user']['routePrev']);
                $this->alert->view('error url route');
            }
        }

        return $url;
    }

    public function go ($to, $authKey)
    {
        $url = $this->get_url($to, $authKey);

        return $url;
    }
}





class commands
{
    public function __construct()
    {
    }


    public function run ($command, $command_more = NULL)
    {
        if (isset($command))
        {
            if ($command == 'sign_in')
            {
                $profile = new profile();
                $profile->sign_in($_POST['username'], $_POST['passcode']);
            }
            elseif ($command == 'sign_out')
            {
                $profile = new profile();
                $profile->sign_out($_SESSION['user']['authKey']);
            }
            elseif ($command == 'route')
            {
                $route = new route();
                $route->go($command_more, $_SESSION['user']['authKey']);
            }
        }
        else
        {
            return 0;
        }
    }
}