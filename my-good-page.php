<?php
    include "config/db.php";
    include "config/base_url.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "common/head.php";
        if(!isset($_SESSION["user_id"])) {
            header("Location: $BASE_URL?error=wtf");
            exit();
        }
    ?>
    <title>Мой раздел - Flip.kz</title>
</head>
<body data-baseurl="<?=$BASE_URL;?>">
    <?php
        include "common/header.php";
    ?>

    <div class="container">
        <div class="navigation-elements">
        
            <div class="user-panel">
                <a href="">
                    <p>Мои заказы</p>
                </a>
                <a href="">
                    <p>Содержимое корзины</p>
                </a>
                <a href="">
                    <p>Избранное</p>
                </a>
                <a href="">
                    <p>Ожидаемые товары</p>
                </a>
                <a href="">
                    <p>Мои отзывы о товарах</p>
                </a>
                <a href="">
                    <p>Подарочные карты</p>
                </a>
                <hr>
                <a href="">
                    <p>Личный счет</p>
                </a>
                <a href="">
                    <p>Пополнение счета</p>
                </a>
                <a href="">
                    <p>Накопительная скидка</p>
                </a>
                <hr>
                <a href="">
                    <p>Персональные данные</p>
                </a>
                <a href="">
                    <p>Изменить пароль</p>
                </a>
                <hr>
                <a href="">
                    <p>Центр уведомлений</p>
                </a>
                <a href="">
                    <p>Управление рассылками</p>
                </a>
                <a href="">
                    <p>Адресная книга</p>
                </a>
            </div>
            <div class="help">
                    <h3>Помощь</h3>
                    <a href="">
                        <p>Способы доставки</p>
                    </a>
                    <a href="">
                        <p>Способы оплаты</p>
                    </a>
                    <a href="">
                        <p>Контактная информация</p>
                    </a>
                    <a href="">
                        <p>Отзывы о товаре</p>
                    </a>

                    <h3>Принимаем к оплате</h3>
                    <span>
                        <img src="img/help/visa.jpg" alt="">
                        <p>
                            Наличные при получении товара и банковские переводы
                        </p>
                    </span>
                    <span>
                        <img src="img/help/money.jpg" alt="">
                        <p>
                            Платежные карты Visa и MasterCard
                        </p>
                    </span>

                    <a href="">
                        <p>
                            Подробнее о способах оплаты
                        </p>
                    </a>
            </div>
        
        </div>
        

        <?php
            $id = $_SESSION["user_id"];
            $query = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");

            $row = mysqli_fetch_assoc($query);
            $email = $row["email"];
            $phone = $row["phone"];
            $name = $row["name"];
        ?>
        <div class="my-section">
            <h2>Мои товары</h2>
            <div class="goods-items">


                        <?php

                            $sql = "SELECT * FROM goods WHERE user_id = $id";
                            $query = mysqli_query($con, $sql);
                            if(mysqli_num_rows($query) > 0) {
                                while($row = mysqli_fetch_assoc($query)) {

                        ?>

                        <div class="goods-item">
                            <div class="item-img-box">
                                <img src="<?=$BASE_URL; ?>/<?=$row["image"]; ?>" alt="" class="item-img">
                            </div>
                            <a href="good-info-page?id=<?=$row["id"]?>">
                                <p class="item-title"><?=$row["name"]; ?></p>
                            </a>
                            <a href="">
                                <p class="item-company"><?=$row["company"]; ?></p>
                            </a>
                            <span>
                                <p class="item-price"><?=$row["price"]; ?></p>
                                <p class="item-date"><?=$row["date"]; ?></p>
                            </span>
                            <a class="delete-good-item" href="api/good/delete?id=<?=$row["id"]?>">
                                X
                            </a>
                            <a class="edit-good-item" href="edit-good-page?id=<?=$row["id"]?>">
                                Изменить
                            </a>
                        </div>

                        <?php
                                }
                            } else {
                        ?>

                        <h3>Нет товара!</h3>
                        <?php
                            }
                        ?>

                    </div>
        </div>
    </div>

    <script src="js/axios.js"></script>
    <script src="js/cartItemsNum.js"></script>
    <script src="js/header.js"></script>
</body>
</html>