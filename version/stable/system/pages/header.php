<div class="header">

    <div class="header-menu">

        <div class="header-logo">
            <form method="post" class="header-logo-form">
                <input type="hidden" name="command" value="route">
                <input type="hidden" name="command_more" value="desktop/main">
                <button class="header-logo-form-button" type="submit">
                    <img class="header-logo-form-button-img" src=<?php echo 'version/'.$_SESSION['user']['authVersion'].'/system/pages/assets/img/ico/512x512.png'; ?>>
                    <p class="header-logo-form-button-text">ilk.in</p>
                </button>
            </form>
        </div>

        <nav>
            <ul>

<!--            РАБОЧИЙ СТОЛ-->
                <li>
                    <form method="post">
                        <input type="hidden" name="command" value="route">
                        <input type="hidden" name="command_more" value="desktop/main">
                        <button type="submit"><i class="fa-desktop"></i>Рабочий стол</button>
                    </form>

                    <ul>

                        <li>
                            <form method="post">
                                <input type="hidden" name="command" value="route">
                                <input type="hidden" name="command_more" value="desktop/edit">
                                <button type="submit" disabled>Изменить</button>
                            </form>
                        </li>

                    </ul>

                </li>

<!--            ПРОФИЛЬ-->
                <li>

                    <form method="post">
                        <input type="hidden" name="command" value="route">
                        <input type="hidden" name="command_more" value="profile/main">
                        <button type="submit"><i class="bi-person-circle"></i>Профиль</button>
                    </form>

                    <ul>
                        <li>
                            <form method="post">
                                <input type="hidden" name="command" value="route">
                                <input type="hidden" name="command_more" value="profile/edit">
                                <button type="submit">Изменить</button>
                            </form>
                        </li>

                        <li>
                            <form method="post">
                                <input type="hidden" name="command" value="route">
                                <input type="hidden" name="command_more" value="profile/main">
                                <button type="submit"><i class="bi-people-fill"></i>Друзья</button>
                            </form>

                            <ul>
                                <li>
                                    <form method="post">
                                        <input type="hidden" name="command" value="route">
                                        <input type="hidden" name="command_more" value="profile/edit">
                                        <button type="submit"><i class="bi-person-plus-fill"></i>Добавить</button>
                                    </form>
                                </li>

                                <li>
                                    <form method="post">
                                        <input type="hidden" name="command" value="route">
                                        <input type="hidden" name="command_more" value="profile/edit">
                                        <button type="submit"><i class="bi-person-dash-fill"></i>Удалить</button>
                                    </form>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <form method="post">
                                <input type="hidden" name="command" value="sign_out">
                                <input type="hidden" name="command_more" value="sign_out">
                                <button type="submit">Выйти</button>
                            </form>
                        </li>
                    </ul>
                </li>


<!--                БАЗА ДАННЫХ-->
                <li>
                    <form method="post">
                        <input type="hidden" name="command" value="route">
                        <input type="hidden" name="command_more" value="database/main">
                        <button type="submit">База данных</button>
                    </form>
                </li>

<!--            Атаковать-->
                <li>
                    <form method="post">
                        <input type="hidden" name="command" value="route">
                        <input type="hidden" name="command_more" value="atack/main">
                        <button type="submit">Атаковать</button>
                    </form>
                </li>

<!--                НАСТРОЙКИ-->
                <li>
                    <form method="post">
                        <input type="hidden" name="command" value="route">
                        <input type="hidden" name="command_more" value="settings/main">
                        <button type="submit"><i class="bi-key-fill"></i>Настройки</button>
                    </form>

                    <ul>
                        <li>
                            <form method="post">
                                <input type="hidden" name="command" value="route">
                                <input type="hidden" name="command_more" value="profile/edit">
                                <button type="submit"><i class="bi-shield-fill"></i>Безопасность</button>
                            </form>
                        </li>

                    </ul>
                </li>

<!--                 О ПРОГРАММЕ-->
                <li>
                    <form method="post">
                        <input type="hidden" name="command" value="route">
                        <input type="hidden" name="command_more" value="about/main">
                        <button type="submit">О программе</button>
                    </form>
                </li>
            </ul>
        </nav>
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