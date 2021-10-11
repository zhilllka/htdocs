<?php
$error = new \cp\error();
$commands = true;



if (isset($_SESSION['user']['authKey']))
{

    $deffender = new \cp\deffender($_SESSION['user']['authKey']);

    if ($error_code = $deffender->start())
    {
        $error->view($error_code);
        $_SESSION['user'] = [];
        $commands = false;
        $routeTo = 'sign/in';
    }

}
else
{
    if (!isset($_POST['command']) OR $_POST['command'] !== 'sign')
    {
        //$error->view('you_need_to_sign_in');
        $_SESSION['user'] = [];
        $commands = false;
        $routeTo = 'sign/in';
    }
    else
    {
        $routeTo = 'sign/in';
    }

}





if ($commands)
{
    // АВТОРИЗАЦИЯ
    if (isset($_POST['command']) AND $_POST['command'] == 'sign') {

        if ($_POST['sign'] == 'in') {

            $sign = new \cp\sign($_POST['username'],$_POST['passcode']);
            $error->view($sign->in());
            if (isset($_SESSION['user']['authKey']))
                $routeTo = 'desktop/main';

        } elseif ($_POST['sign'] == 'up') {

        } elseif ($_POST['sign'] == 'restore') {

        } elseif ($_POST['sign'] == 'out') {
            $sign = new \cp\sign($_SESSION['user']['username'],$_SESSION['user']['passcode']);
            $error->view($sign->out());
        }

    }
    elseif (isset($_POST['command']) AND $_POST['command'] == 'route')
    {
        $routeTo = $_POST['route'];
    }

}





if (isset($_SESSION['user']['authKey']))
{
    $route = new \cp\route($_SESSION['user']['authKey']);
}
else
{
    $route = new \cp\route();
}


$route = $route->go(@$routeTo);
require_once $route;
