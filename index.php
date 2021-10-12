<?php
// TODO Сделать защиту на прямое открытие файлов, путем проверки файла на инклуд. UPD Настроить в apache белый список, если таковой имеется.

session_start();

//$_SESSION['user']['authKey'] = 345;
//$_SESSION['user']['username'] = 'root';
//$_SESSION['user']['passcode'] = 'root';
//$_SESSION['user']['authVersion'] = 'stable';
//$_SESSION['user']['routeNow'] = 'signIn';
$_SESSION = array();


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

//---
// МАРШРУТИЗАЦИЯ ВЕРСИЙ.
//---


// ЕСЛИ ЕСТЬ КЛЮЧ АВТОРИЗАЦИИ.
if (isset($_SESSION['user']['authKey'])) {

  // Отправляем его на версию указанную в сессии.
  if (!include 'version/'.$_SESSION['user']['authVersion'].'/start.php') {
    // Если не удалось подключить страницу, выводим сообщение.
    echo "ОШИБКА: Не удалось получить версию сайта - '".$user['site_version']."'.";
    // Завершаем скрипт.
    exit;
  }

 // ЕСЛИ НЕТУ КЛЮЧА АВТОРИЗАЦИИ.
} else {

  // У пользователя нет ключа авторизации, значит отправляем его на дефолтную версию сайта.
  if (!include 'version/stable/start.php') {
    // Если не удалось подключить страницу старта версии, выводим сообщение.
    echo "ОШИБКА: Не удалось получить дефолтную версию сайта.";
    // Завершаем скрипт.
    exit;
  }

}
