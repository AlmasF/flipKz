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
            <span>
                <a href="login-page">Вход</a>
            </span>
            <span  class="underline">
                Регистрация
            </span>
        </div>
        <form action="api/user/signup" method="POST">
            <input type="text" name="name" id="" placeholder="Имя" require>
            <input type="number" name="phone" id="" placeholder="Телефон" require>
            <input type="text" name="email" id="" placeholder="E-mail" require>
            <input type="password" name="password" id="" placeholder="Пароль" require>
            <button type="submit">Зарегистрироваться</button>
        </form>
        <a href="">
            <p>
                Регистрация юридического лица
            </p>
        </a>
        <a href="">
            <p>
                Что дает регистрация?
            </p>
        </a>
    </div>

    <div class="dark-block" id="dark-block-id">
    </div>

    <script src="js/bright.js"></script>
    <script src="js/axios.js"></script>
    <script src="js/cartItemsNum.js"></script>
    <script src="js/header.js"></script>
    </body>
</html>