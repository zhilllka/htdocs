<?php
//---
// МАРШРУТИЗАЦИЯ.
//---



// МАРШРУТ НЕ ПОЛУЧЕН.
if (empty($routeTo)) {

    echo "Нету маршрута.";

  // МАРШРУТ ПОЛУЧЕН.
} else {


  /// ЕСЛИ ПОЛЬЗОВАТЕЛЬ АВТОРИЗОВАН.
  if (isset($_SESSION['user']['authKey'])) {

    if ($routeTo == "start") {

      // Отправляем.
      header("Location: ./");

    } else {

      // Обновляем информацию о маршруте.
      updateUserRoute($routeTo,$_SESSION['user']['routeNow'],$db);

      // Отправляем.
      include './version/'.$_SESSION['user']['authVersion'].'/system/pages/'.$routeTo.'.php';
    }

  /// ЕСЛИ ПОЛЬЗОВАТЕЛЬ НЕ АВТОРИЗОВАН.
  } else {

    // Отправляем. // TODO Возможно, тут уязвимость.
    include $HOME.'/system/pages/'.$routeTo.'.php';

  }

}
