<?php
//---
// СКРИПТ ЗАЩИТЫ.
//---



// Получаем настройки сайта.
$settingsSite = $db->query("SELECT * FROM `settings`", 30);
$settingsSite = $settingsSite->fetchAssoc();



// Если сайт не доступен.
if (!$settingsSite['dostypeSite']) {
  $routeTo = "dontDostype";
}



// Если пользователь авторизован.
if (isset($_SESSION['user']['authKey'])) {

  // Обновляем информацию пользователя.
  $user = $db->query("SELECT * FROM `users` WHERE username = '".$_SESSION['user']['username']."'", 30);
  $_SESSION['user'] = $user->fetchAssoc();

  // Если команды нету, то отправляем его на последнюю посещенную страницу.
  if (empty($_POST['command'])) {
    $routeTo = $_SESSION['user']['routeNow'];
  }


} else {

  // Проверяем, поступила ли команда.
  if (isset($_POST['command'])) {

    // Если команда на авторизацию или регистрацию, то пропускаем.
    if ($_POST['command'] == "signIn" or $_POST['command'] == "signUp") {

    } else {
      // Если другая команда от не авторизованого пользователя.
      $routeTo = "signIn";
    }

  } else {
    // Если команды не было, то отправляем на страницу авторизации.
    $routeTo = "signIn";
  }
}


// // Проверяем, есть ли у пользователя в сессии ключ авторизации.
// if (!empty($_SESSION['user']['authKey'])) { // Если в сессии есть ключ авторизации.
//
//   // Проверяем, есть ли у пользователя в сессии логин и пароль.
//   if (!empty($_SESSION['user']['username'])) { // Если есть в сессии логин и пароль.
//
//     // Получаем данные пользователя из БД.
//     $user = $db->query("SELECT * FROM `users` WHERE username = '".$_SESSION['user']['username']."' and passcode = '".$_SESSION['user']['passcode']."'", 30);
//     $user = $user->fetchAssoc();
//
//     // Сравниваем с БД ключ авторизации.
//     if ($_SESSION['user']['authKey'] == $user['authKey']) { // Если ключ совпадает.
//
//       // Обновляем информацию пользователя из БД.
//       $_SESSION['user'] = $user;
//
//       // Отправляем на страницу авторизации.
//       $route = "signIn"; // TODO Сделать, что бы маршрут шел из сессии, для контроля пользователя и выхода с блокировки экрана.
//
//     } else { // Если ключ не совпадает.
//
//       // Убиваем всю сессию пользователя.
//       session_destroy();
//       $_SESSION = array();
//
//       // Отправляем на страницу авторизации.
//       $route = "signIn";
//
//     }
//
//
//   } else { // Если в сесси нету логина и пароля.
//
//   }
//
//
// } else { // Если в сессии нету ключа авторизации.
//
//   // Проверяем, есть ли команда на авторизацию.
//   if (empty($_POST['command'])) { // Если нет команды.
//
//     // Отправляем на страницу авторизации.
//     $route = "signIn";
//
//   }
//
// }
