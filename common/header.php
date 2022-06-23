<?php
    include "config/base_url.php";
?>

<div class="header">
    <span class="catalog" id="catalog">
        <img src="img/header/burger-menu.svg" alt="">
        <p>Каталог</p>
    </span>
    <a href="<?=$BASE_URL?>/index">
        <img src="img/header/logo.svg" alt="" class="logo">
    </a>
    <form class="search" action="index">
        <?php
            $search_value = "";
            if(isset($_GET["q"]) && strlen($_GET["q"]) > 0) {
                $search_value = $_GET["q"];
            }
        ?>
        <input type="text" name="q" id="" placeholder='более 500 000 товаров' value='<?=$search_value?>'>
        <button type="submit">
            Найти
        </button>
    </form>
    <span class="location">
        <img src="img/header/location.png" alt="">
        <p>Алматы</p>
    </span>
    <span class="login" id="login-id">

        <?php
            if(isset($_SESSION["user_id"])) {
        ?>
            <a href="<?=$BASE_URL?>/user-page">
                <img src="img/header/user-in.jpg" alt="">
            </a>
            <a href="<?=$BASE_URL?>/user-page" class="login-user">
                <p>
                    <b><?=$_SESSION["name"]?></b>
                    <br>
                    Мой раздел
                </p>
            </a>
            <span class="login-menu">
                <a href="<?=$BASE_URL?>/user-page">
                    <p>
                        Мой раздел
                    </p>
                </a>
                <a href="<?=$BASE_URL?>/my-orders-page">
                    <p>
                        Мои заказы
                    </p>
                </a>
                <a href="<?=$BASE_URL?>/add-good-page">
                    <p>
                        Добавить товар
                    </p>
                </a>
                <a href="<?=$BASE_URL?>/my-good-page">
                    <p>
                        Мои товары
                    </p>
                </a>
                <a href="<?=$BASE_URL?>/api/user/signout">
                    <p>
                        Выйти
                    </p>
                </a>
            </span>
        <?php
            } else {
        ?>
            <a href="<?=$BASE_URL?>/login-page">
            <img src="img/header/user.jpg" alt="">
            </a>
            <a href="<?=$BASE_URL?>/login-page" class="login-user">
                <p>
                    <b>Войти</b>
                    <br>
                    Мой раздел
                </p>
            </a>
            <span class="login-menu">
                <a href="<?=$BASE_URL?>/login-page">
                    <p>
                        Войти
                    </p>
                </a>
                <a href="<?=$BASE_URL?>/signup-page">
                    <p>
                        Регистрация
                    </p>
                </a>
                <a href="<?=$BASE_URL?>/login-page">
                    <p>
                        Мой раздел
                    </p>
                </a>
                <a href="<?=$BASE_URL?>/login-page">
                    <p>
                        Мои заказы
                    </p>
                </a>
            </span>
        <?php
        }
        ?>
    </span>
    <a href="my-cart-page">
        <div class="cart">
            <p class="cart-image-items" id="cart-image-items">0</p>
            <img src="img/header/cart.svg" alt="">
            <p id="cart-image-text">Корзина <br> пуста</p>
        </div>
    </a>

    <div class="menu-catalog" id="menu-catalog">
        <form class="search catalog" action="index">
            <?php
                $search_value = "";
                if(isset($_GET["q"]) && strlen($_GET["q"]) > 0) {
                    $search_value = $_GET["q"];
                }
            ?>
            <input type="text" name="q" id="" placeholder='более 500 000 товаров' value='<?=$search_value?>'>
            <button type="submit">
                Найти
            </button>
            <span id="close-menu-catalog">X</span>
        </form>
        <span>
            <img src="img/catalog/hot.png" alt="">
            <p>Скидки и акции</p>
        </span>
        <span>
            <img src="img/catalog/8-march.png" alt="">
            <p>8 марта</p>
        </span>
        <?php
            $query = mysqli_query($con, "SELECT * FROM categories");
            while($category = mysqli_fetch_assoc($query)) {
        ?>
        
        <a href="index?category_id=<?=$category["id"]?>">
            <?php
                if(isset($_GET["category_id"]) && $_GET["category_id"] == $category["id"]) {
            ?>
            <span style="background-color: #febd01;">
            <?php                                
                } else {
            ?>
            <span>
            <?php
                }
            ?>
                <img src="img/catalog/category-<?=$category["id"]?>.png" alt=""> 
                <p><?=$category["title"]?></p>
            </span>
        </a>
        <?php
            }
        ?>
    </div>

    <script src="js/header.js"></script>
</div>