<?php


$GLOBALS['HOME'] = [
    'dir' => __DIR__,
    'style' => 'version/'.basename(__DIR__).'/system/pages/assets/css/style.css',
    'version' => '<strong></strong> 0.0.2 ALPHA | <strong>date:</strong> 12.10.2021',
    'changeLog' => '
    ..:: ЖУРНАЛ ::.
    1. Первая стабильная версия сайта.
    ',

];





//$HOME = [
//    'dir' => __DIR__,
//    'style' => 'version/'.basename(__DIR__).'/system/pages/assets/css/style.css',
//    'version' => '<strong></strong> 0.0.1 STABLE | <strong>date:</strong> 08.10.2021',
//    'changeLog' => '
//    ..:: ЖУРНАЛ ::.
//    1. Первая стабильная версия сайта.
//    ',
//
//];








// Подключаем библиотеку 'my'.
if (!include $GLOBALS['HOME']['dir'].'/system/lib/autoload.php') {
  // Если не удалось подключить библиотеки, выводим сообщение.
  echo "ОШИБКА: Не удалось подключить библиотеки в версии: ".$GLOBALS['HOME']['version'].".";
  // Завершаем скрипт.
  exit;
}

// Подключаем ядро сайта.
if (!include $GLOBALS['HOME']['dir'].'/system/logic/core.php') {
  // Если не удалось подключить ядро сайта, выводим сообщение.
  echo "ОШИБКА: Не удалось подключить ядро сайта в версии: ".$GLOBALS['HOME']['version'].".";
  // Завершаем скрипт.
  exit;
}
