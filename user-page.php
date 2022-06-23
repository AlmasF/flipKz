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

            $query_goods = mysqli_query($con, "SELECT COUNT(id) num FROM goods WHERE user_id=$id");
            $row_goods = mysqli_fetch_assoc($query_goods);
            $num_goods = $row_goods["num"];

            $query_orders = mysqli_query($con, "SELECT COUNT(id) num FROM orders WHERE user_id=$id");
            $row_orders = mysqli_fetch_assoc($query_orders);
            $num_orders = $row_orders["num"];
        ?>
        <div class="my-section">
            <h2>Мой раздел</h2>
            <div class="section-elements">
                <div class="user-elements">
                    <h3>Заказы</h3>
                    <p>Всего заказов: <?=$num_orders?> <a href="my-orders-page">Подробно</a></p>
                    <p>Ожидание оплаты</p>
                    <p>Отмененных</p>
                    <h3>Мои товары</h3>
                    <p>Всего товаров: <?=$num_goods?> <a href="my-good-page">Просмотр/Редактирование</a></p>
                    <h3>Добавить товар</h3>
                    <p><a href="add-good-page">Добавить</a></p>
                    <h3>Адресная книга</h3>
                    <p>Всего адресов: 0 <a href="">Просмотр</a>/<a href="">Редактирование</a></p>
                    <h3>Персональные данные</h3>
                    <p>Имя: <?=$row["name"];?></p>
                    <p>Дата рождения: г.</p>
                    <p>Email: <?=$row["email"];?></p>
                    <p>Мобильный телефон: <?=$row["phone"];?></p>
                    <p><a href="">Редактировать</a></p>
                    <p><a href="">Изменить пароль входа</a></p>
                </div>
                <div class="money-elements">
                    <h3>Скидки</h3>
                    <p>Накопительная скидка: 0% <a href="">Подробно</a></p>
                    <h3>Счет</h3>
                    <p>Баланс персонального счета: 0 тг <a href="">Подробно</a></p>
                    <h3>Выйти</h3>
                    <p><a href="api/user/signout">Выйти из аккаунта</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="js/axios.js"></script>
    <script src="js/cartItemsNum.js"></script>
    <script src="js/header.js"></script>
</body>
</html>