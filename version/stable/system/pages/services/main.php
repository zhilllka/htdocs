<html>
<head>
    <title>Сервисы</title>
    <link rel="stylesheet" href=<?php echo $HOME['style']; ?>>
</head>
<body>
<div class="wrapaper">

    <?php include $HOME['dir'].'/system/pages/header.php'; ?>

    <div class="main">
        <div class="infoRoute">
            <h2>Сервисы</h2>
            <h4>Страницы с сервисами сайта</h4>
        </div>
        <div class="container">
            <div class="container-block">
                <div class="container-block-header">
                    <h2>Социальные сети</h2>
                </div>
                <div class="container-block-main">
                    <form method="post">
                        <input type="hidden" name="command" value="route">
                        <input type="hidden" name="route" value="atack/vk/get_token.php">
                        <input type="submit" value="Получить токен вк">
                    </form>
                </div>
                <div class="container-block-footer">

                </div>
            </div>
            <div class="container-block">
                <div class="container-block-header">

                </div>
                <div class="container-block-main">

                </div>
                <div class="container-block-footer">

                </div>
            </div>
            <div class="container-block">
                <div class="container-block-header">

                </div>
                <div class="container-block-main">

                </div>
                <div class="container-block-footer">

                </div>
            </div>
        </div>
    </div>

    <?php include $HOME['dir'].'/system/pages/footer.php'; ?>

</div>
</body>
</html>