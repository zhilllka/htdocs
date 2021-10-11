<div class="header">
    <div class="menu">

<!--        ГЛАВНАЯ-->

        <div class="menu-block">
            <form method="post">
                <input type="hidden" name="command" value="route">
                <input type="hidden" name="route" value="desktop/main">
                <input class="btn" type="submit" value="Главная" title=""></input>
            </form>
        </div>

<!--        ПРОФИЛЬ-->

        <div class="menu-block">
            <form method="post">
                <input type="hidden" name="command" value="route">
                <input type="hidden" name="route" value="profile/main">
                <input class="btn" type="submit" value="Профиль" title=""></input>
            </form>
            <div class="menu-full">
<!--                <form method="post">-->
<!--                    <input type="hidden" name="command" value="route">-->
<!--                    <input type="hidden" name="route" value="dbStat">-->
<!--                    <input class="btn submit-desktop" type="submit" value="Редактировать" title=""></input>-->
<!--                </form>-->
<!--                <form method="post">-->
<!--                    <input type="hidden" name="command" value="route">-->
<!--                    <input type="hidden" name="route" value="dbRemote">-->
<!--                    <input class="btn submit-desktop" type="submit" value="Настройки" title=""></input>-->
<!--                </form>-->
                <form method="post">
                    <input type="hidden" name="command" value="sign">
                    <input type="hidden" name="sign" value="out">
                    <input class="btn submit-desktop" type="submit" value="Выйти" title=""></input>
                </form>
            </div>
        </div>

<!--        БАЗА ДАННЫХ-->

        <div class="menu-block">
            <form method="post">
                <input type="hidden" name="command" value="route">
                <input type="hidden" name="route" value="database/main">
                <input class="btn" type="submit" value="База данных" title=""></input>
            </form>
<!--            <div class="menu-full">-->
<!--                <form method="post">-->
<!--                    <input type="hidden" name="command" value="route">-->
<!--                    <input type="hidden" name="route" value="dbStat">-->
<!--                    <input class="btn submit-desktop" type="submit" value="Статистика" title=""></input>-->
<!--                </form>-->
<!--                <form method="post">-->
<!--                    <input type="hidden" name="command" value="route">-->
<!--                    <input type="hidden" name="route" value="dbRemote">-->
<!--                    <input class="btn submit-desktop" type="submit" value="Управление" title=""></input>-->
<!--                </form>-->
<!--                <form method="post">-->
<!--                    <input type="hidden" name="command" value="route">-->
<!--                    <input type="hidden" name="route" value="dbDelete">-->
<!--                    <input class="btn submit-desktop" type="submit" value="Удалить" title=""></input>-->
<!--                </form>-->
<!--            </div>-->
        </div>

<!--        СЕРВИСЫ-->

        <div class="menu-block">
            <form method="post">
                <input type="hidden" name="command" value="route">
                <input type="hidden" name="route" value="services/main">
                <input class="btn" type="submit" value="Сервисы" title=""></input>
            </form>
            <div class="menu-full">
                <div class="menu-block-sub">
                    <form method="post">
                        <input type="hidden" name="command" value="route">
                        <input type="hidden" name="route" value="dbStat">
                        <input class="btn submit-desktop" type="submit" value="ВК" title=""></input>
                    </form>
                    <div class="menu-full-sub">
                        <form method="post">
                            <input type="hidden" name="command" value="route">
                            <input type="hidden" name="route" value="atack/vk/getToken">
                            <input class="btn submit-desktop" type="submit" value="Получить токен" title=""></input>
                        </form>
                    </div>
                </div>
                <form method="post">
                    <input type="hidden" name="command" value="route">
                    <input type="hidden" name="route" value="dbRemote">
                    <input class="btn submit-desktop" type="submit" value="Управление" title=""></input>
                </form>
                <form method="post">
                    <input type="hidden" name="command" value="route">
                    <input type="hidden" name="route" value="dbDelete">
                    <input class="btn submit-desktop" type="submit" value="Удалить" title=""></input>
                </form>
            </div>
        </div>
    </div>


    <?php

    if (isset($_SESSION['alert'])) {
        foreach ($_SESSION['alert'] as $_SESSION['alert']) {
            echo $_SESSION['alert'];
        }
        $_SESSION['alert']=[];
    }

    ?>
</div>