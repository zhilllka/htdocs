<?php

use Krugozor\Database\Mysql;

$GLOBALS['db'] = Mysql::create("localhost", "roman123", "Marozwtpmj")
    ->setDatabaseName("zhilkin")
    ->setCharset("utf8");