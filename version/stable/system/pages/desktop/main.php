<?php
// Проверка на целостность файловой структуры.
if(!defined("integrity_protection")) {require_once $_SERVER['DOCUMENT_ROOT'].'/version/stable/system/pages/error/404.php';exit();}
?>
<html>
    <head>
        <title>Панель управления</title>
        <link rel="stylesheet" href=<?php echo $GLOBALS['HOME']['style']; ?>>
      </head>
    <body>
        <div class="wrapaper">

            <?php include $GLOBALS['HOME']['dir'].'/system/pages/header.php'; ?>

            <div class="main">
                <div class="infoRoute">
                    <h2>Рабочий стол</h2>
                    <h4>Все для удобного управления в одном месте в виде виджетов.</h4>
                </div>
                <div class="container">

                </div>
            </div>

            <?php include $GLOBALS['HOME']['dir'].'/system/pages/footer.php'; ?>

        </div>
    </body>
</html>