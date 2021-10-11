<?php
//---
// КОМАНДЫ.
//---

// echo $_POST['command'];
// echo $_POST['go'];
// echo $_POST['versionSite'];

// Если команда получена.
if (isset($_POST['command'])) {

  // Заносим команду в переменную.
  $command = $_POST['command'];



  // -----
  // АУЕНТИФИКАЦИЯ | sign
  // -----

  // Авторизация.
  if ($command == "signIn") {

    if (!empty($_POST['username'])) {
      if (!empty($_POST['passcode'])) {

        $auth = $db->query("SELECT * FROM `users` WHERE username = '".$_POST['username']."' AND passcode = '".$_POST['passcode']."'", 30);
        $auth = $auth->fetchAssoc();

        if ($auth == NULL) {
          $msg = msg(code: 'wrongPasscode');
          $routeTo = 'signIn';
        } else {
          $_SESSION['user'] = $auth;
          $routeTo = 'start';
        }

      } else {
        $msg = msg(code: 'emptyPasscode');
        $routeTo = 'signIn';
      }
    } else {
      $msg = msg(code: 'emptyUsername');
      $routeTo = 'signIn';
    }



    //$auth = $db->query("SELECT * FROM `users` WHERE username = '".$_SESSION['user']['username']."'", 30);
  }

  // Регистрация.
  elseif ($command == "signUp") {

  }

  // Востонавление пароля.
  elseif ($command == "SignRestore") {

  }

  // Выход из системы.
  elseif ($command == "signOut") {
    $_SESSION = array();
    $msg = msg(code: 'signOut');
    $routeTo = 'signIn';
  }



  // -----
  // ПРОФИЛЬ | profile
  // -----

  // Сменить пароль.
  elseif ($command == "profileChangePassword") {
    echo $_POST['username'];
  }

  // -----
  // НАСТРОЙКИ | settings
  // -----

  // Сменить версию сайта.
  elseif ($command == "changeVersion") {

    $updateVersion = $db->query("UPDATE `users` SET `authVersion`='".$_POST['versionSite']."' WHERE `username` = '".$_SESSION['user']['username']."'", 30);


    $msg = msg (code: 'changeVersion', more : $_POST['versionSite']);
    $routeTo = $_SESSION['user']['routeNow'];
  }

  else {
    $msg = msg (code: 'unknowCommand', more : $command);
    $routeTo = $_SESSION['user']['routeNow'];
  }
  // КОНЕЦ СРИПТА С КОМАНДАМИ.
}

// -----
// МАРШРУТИЗАЦИЯ | route
// -----

// Отлавливаем команду на перемещение.
if (isset($_POST['go'])) {
  $routeTo = $_POST['go'];
}
