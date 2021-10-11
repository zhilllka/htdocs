<html>
<head>
    <title>Получить токен</title>
    <link rel="stylesheet" href=<?php echo $HOME['style']; ?>>
</head>
<body>
<div class="wrapaper">

    <?php include $HOME['dir'].'/system/pages/header.php'; ?>

    <div class="main">
        <div class="infoRoute">
            <h2>Главная страница</h2>
            <h4>Туц туц туц</h4>
        </div>
        <div class="container">
            <?php

            $result = $GLOBALS['db']->query("SELECT * FROM `seeds` WHERE id_refferal = '".$_SESSION['user']['id']."'", 30);
            $result = $result->fetchAssocArray();

            foreach ($result as $result) {
                echo "
                
                <table>
                <p><text>$result[id]</text> | <text>$result[network]</text> | <text>$result[login]</text> | <text>$result[password]</text></p>
                </table>
                
                
                ";
            }

            ?>
        </div>
    </div>

    <?php include $HOME['dir'].'/system/pages/footer.php'; ?>

</div>
</body>
</html>