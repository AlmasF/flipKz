<?php
    include "config/db.php";
    include "config/base_url.php";

    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $query = mysqli_query($con, "SELECT * FROM goods WHERE id=$id");


        if(mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
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

    <title>Измените товар</title>
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

        <div class="main-elements">
            <div class="add-good-block">
                <div class="add-good-title">
                    <span>
                        Измените товар
                    </span>
                </div>
                <form action="api/good/update?id=<?=$id?>" method="POST" enctype="multipart/form-data">
                    <input type="text" name="name" id="" placeholder="Имя товара" value="<?=$row["name"]?>" require>
                    <select name="category_id" id="" class="input">
                        <?php

                            $query = mysqli_query($con, "SELECT * FROM categories");
                            while($category = mysqli_fetch_assoc($query)) {
                                if($row["category_id"] == $category["id"]) {
                                    echo "<option selected value='".$category["id"]."'>".$category["title"]."</option>";
                                }
                                else {
                                    echo "<option value='".$category["id"]."'>".$category["title"]."</option>";
                                }
                            }
                        ?>
                    </select>
                    <textarea name="description" placeholder="Расскажите о товаре"><?=$row["description"]?></textarea>
                    <input type="text" name="company" id="" placeholder="Компания"  value="<?=$row["company"]?>" require>
                    <input type="number" name="price" id="" placeholder="Цена" value="<?=$row["price"]?>" require>
                    <div class="button button-yellow input-file">
                        <input type="file" name="image">	
                        Выберите картинку
                    </div>
                    <button type="submit">Сохранить</button>
                </form>
            </div>
        </div>
        
    </div>

    <script src="js/axios.js"></script>
    <script src="js/cartItemsNum.js"></script>
    <script src="js/header.js"></script>
</body>
</html>

<?php

        } else {
            header("Location: $BASE_URL/my-good-page");
        }
    } else {
        header("Location: $BASE_URL/user-page");
    }

?>