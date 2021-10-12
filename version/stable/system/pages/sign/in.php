<html>
<head>
    <title>Авторизация</title>
    <link rel="stylesheet" href=<?php echo $GLOBALS['HOME']['style']; ?>>
    <link rel="shortcut icon" href=<?php echo $GLOBALS['HOME']['styleIco']; ?> type="image/png">
</head>
<body>
<div class="wrapaper">

    <?php

    if (isset($_SESSION['alert'])) {
        foreach ($_SESSION['alert'] as $_SESSION['alert']) {
            echo $_SESSION['alert'];
        }
        $_SESSION['alert']=[];
    }

    ?>

    <div class="main">
        <div class="login-form">
            <form method="post">
                <input type="hidden" name="command" value="sign_in">
<!--                <input type="hidden" name="sign" value="in">-->
                <input type="text" name="username" placeholder="Логин">
                <input type="text" name="passcode" placeholder="Пароль">
                <input type="submit" value="Войти">
            </form>
        </div>
    </div>

    <?php include $GLOBALS['HOME']['dir'].'/system/pages/footer.php'; ?>

</div>
</body>
</html>