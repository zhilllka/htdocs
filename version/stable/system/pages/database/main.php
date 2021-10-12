<html>
<head>
    <title>База данных</title>
    <link rel="stylesheet" href=<?php echo $GLOBALS['HOME']['style']; ?>>
</head>
<body>
<div class="wrapaper">

    <?php include $GLOBALS['HOME']['dir'].'/system/pages/header.php'; ?>

    <div class="main">
        <div class="infoRoute">
            <h2>База данных</h2>
            <h4>Управляйте Вашими данными в удобной форме и в одном месте.</h4>
        </div>
        <div class="container">
            <table class='table'>
                <thead>
                <tr>
                    <th>id</th>
                    <th>Сеть</th>
                    <th>Логин</th>
                    <th>Пароль</th>
                    <th>Токен</th>
                    <th>Управление</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $db = new \cp\database();
                $seeds = $db->get('array','seeds','id_reff = '.$_SESSION['user']['id']);
                foreach ($seeds as $seeds)
                {
                    echo "
                    
                    <tr>
                        <td>$seeds[id]</td>
                        <td>$seeds[network]</td>
                        <td>$seeds[username]</td>
                        <td>$seeds[passcode]</td>
                        <td><textarea cols='50'>$seeds[access_token]</textarea> </td>
                        <td>
                            <form method='post'>
                                <input type='hidden' name='command_more' value='$seeds[id]'>
                                <button type='submit' name='command' value=view_$seeds[network]>GO</button>
                            </form>
                        </td>
                    </tr>
                    
                    ";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include $GLOBALS['HOME']['dir'].'/system/pages/footer.php'; ?>

</div>
</body>
</html>