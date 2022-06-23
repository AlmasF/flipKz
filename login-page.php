<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "common/head.php";
        include "config/base_url.php";
        include "config/db.php";
    ?>

    <title>Интернет-магазин Казахстана. 500 000 товаров с доставкой по всему Казахстану!</title>
</head>
<body data-baseurl="<?=$BASE_URL;?>">

    <?php
        include "common/header.php";
    ?>

    <div class="login-block">
        <div class="login-title">
            <span class="underline">
                Вход
            </span>
            <span>
                <a href="signup-page">Регистрация</a>
            </span>
        </div>
        <form action="<?=$BASE_URL?>/api/user/signin" method="POST">
            <input type="text" name="emailOrPhone" id="" placeholder="Телефон или E-mail">
            <input type="password" name="password" id="" placeholder="Пароль">
            <button type="submit">Войти</button>
        </form>
        <a href="">
            <p>
                Забыли пароль?
            </p>
        </a>
        <?php
            if(isset($_GET["error"]))
            {
                if($_GET["error"]==8) {
                    echo "<p class='red'>Неверный логин или пароль!</p>";
                }
            }
        ?>
    </div>

    <div class="dark-block" id="dark-block-id">
    </div>

    <script src="js/bright.js"></script>
    <script src="js/axios.js"></script>
    <script src="js/cartItemsNum.js"></script>
    <script src="js/header.js"></script>
    </body>
</html>