<?php
    include "config/db.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include "common/head.php";
        ?>

        <title>Интернет-магазин Казахстана. 500 000 товаров с доставкой по всему Казахстану!</title>
    </head>
    <body data-baseurl="<?=$BASE_URL;?>">

    <?php
        include "common/header.php";
    ?>  
        
        <div class="container">
            <div class="navigation-elements">
                <div class="menu-catalog">
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

            
                <?php
                    if(!isset($_GET["category_id"]) && !(isset($_GET["q"]) && !strlen($_GET["q"]) > 0) && !(isset($_GET["company"]))) {
                ?>
                <div class="main-grid" id="main-grid">

                    <div class="products-slider">
                        <div class="slider-item">
                            <img src="img/main-grid/slider-1.jpg" alt="Первый слайд">
                        </div>

                        <div class="slider-item">
                            <img src="img/main-grid/slider-2.jpg" alt="Второй слайд">
                        </div>

                        <div class="slider-item">
                            <img src="img/main-grid/slider-3.jpg" alt="Третий слайд">
                        </div>

                        <div class="slider-item">
                            <img src="img/main-grid/slider-4.jpg" alt="Третий слайд">
                        </div>

                        <div class="slider-item">
                            <img src="img/main-grid/slider-5.jpg" alt="Третий слайд">
                        </div>

                        <a class="prev" onclick="minusSlide()">&#10094;</a>
                        <a class="next" onclick="plusSlide()">&#10095;</a>

                        <div class="products-slider-dots">
                            <span class="slider-dots_item" onclick="currentSlide(1)"></span> 
                            <span class="slider-dots_item" onclick="currentSlide(2)"></span> 
                            <span class="slider-dots_item" onclick="currentSlide(3)"></span>
                            <span class="slider-dots_item" onclick="currentSlide(4)"></span> 
                            <span class="slider-dots_item" onclick="currentSlide(5)"></span> 
                        </div>
                    </div>

                    

                    <div class="product-1">
                        <img src="img/main-grid/product-1.jpg" alt="">
                    </div>
                    <div class="product-2">
                        <img src="img/main-grid/product-2.jpg" alt="">
                    </div>
                    <div class="ad">
                        <img src="img/main-grid/ad.jpg" alt="">
                    </div>
                </div>

                <div class="gifts" id="gifts">
                    <h3>Вам это понравится</h3>
                    <div class="gifts-list">
                        <div class="gift-item">
                            <img src="img/gifts/gift-1.jpg" alt="">
                        </div>
                        <div class="gift-item">
                            <img src="img/gifts/gift-2.jpg" alt="">
                        </div>
                        <div class="gift-item">
                            <img src="img/gifts/gift-3.jpg" alt="">
                        </div>
                        <div class="gift-item">
                            <img src="img/gifts/gift-4.jpg" alt="">
                        </div>
                        <div class="gift-item">
                            <img src="img/gifts/gift-5.jpg" alt="">
                        </div>
                        <div class="gift-item">
                            <img src="img/gifts/gift-6.jpg" alt="">
                        </div>
                    </div>
                </div>
                
                <?php
                    }
                ?>
                <div class="goods">
                    <h3 id="goods-title">Все товары</h3>
                    <div class="goods-items" id="goods-items">
                        <?php
                        if(isset($_GET["category_id"]) && intval($_GET["category_id"])) {
                            $cat_id = $_GET["category_id"];

                            $sql = "SELECT * FROM goods
                            WHERE category_id = $cat_id";
                            $query = mysqli_query($con, $sql);

                            if(mysqli_num_rows($query) > 0) {
                                while($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <div class="goods-item">
                                <div class="item-img-box">
                                    <img src='<?=$BASE_URL?>/<?=$row["image"]?>' alt="" class="item-img">
                                </div>
                                <a href='good-info-page?id=<?=$row["id"]?>'>
                                    <p class="item-title"><?=$row["name"]?></p>
                                </a>
                                <a href='index?company=<?=$row["company"]?>'>
                                    <p class="item-company"><?=$row["company"]?></p>
                                </a>
                                <span>
                                    <p class="item-price"><?=$row["price"]?> тг</p>
                                    <p class="item-date"><?=$row["date"]?></p>
                                </span>
                                <p class="good-item-buy" onclick='addToCart(<?=$row["id"]?>)'>
                                    В КОРЗИНУ
                                </p>
                            </div>
                        <?php
                                }
                            }
                        ?>

                        <?php
                        }
                        ?>

                        <?php
                        if(isset($_GET["q"])) {
                            $q = '%'.$_GET["q"].'%';

                            $sql = "SELECT * FROM goods
                            WHERE name LIKE ?
                            OR company LIKE ?";
                            $prep = mysqli_prepare($con, $sql);
                            mysqli_stmt_bind_param($prep, "ss", $q, $q);
                            mysqli_stmt_execute($prep);
                            $query = mysqli_stmt_get_result($prep);

                            if(mysqli_num_rows($query) > 0) {
                                while($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <div class="goods-item">
                                <div class="item-img-box">
                                    <img src='<?=$BASE_URL?>/<?=$row["image"]?>' alt="" class="item-img">
                                </div>
                                <a href='good-info-page?id=<?=$row["id"]?>'>
                                    <p class="item-title"><?=$row["name"]?></p>
                                </a>
                                <a href='index?company=<?=$row["company"]?>'>
                                    <p class="item-company"><?=$row["company"]?></p>
                                </a>
                                <span>
                                    <p class="item-price"><?=$row["price"]?> тг</p>
                                    <p class="item-date"><?=$row["date"]?></p>
                                </span>
                                <p class="good-item-buy" onclick='addToCart(<?=$row["id"]?>)'>
                                    В КОРЗИНУ
                                </p>
                            </div>
                        <?php
                                }
                            }
                        }
                        ?>

                        <?php
                        if(isset($_GET["company"])){
                            $company_id = $_GET["company"];

                            $sql = "SELECT * FROM goods
                            WHERE company = ?";
                            $prep = mysqli_prepare($con, $sql);
                            mysqli_stmt_bind_param($prep, "s", $company_id);
                            mysqli_stmt_execute($prep);
                            $query = mysqli_stmt_get_result($prep);

                            if(mysqli_num_rows($query) > 0) {
                                while($row = mysqli_fetch_assoc($query)) {
                        ?>

                            <div class="goods-item">
                                <div class="item-img-box">
                                    <img src='<?=$BASE_URL?>/<?=$row["image"]?>' alt="" class="item-img">
                                </div>
                                <a href='good-info-page?id=<?=$row["id"]?>'>
                                    <p class="item-title"><?=$row["name"]?></p>
                                </a>
                                <a href='index?company=<?=$row["company"]?>'>
                                    <p class="item-company"><?=$row["company"]?></p>
                                </a>
                                <span>
                                    <p class="item-price"><?=$row["price"]?> тг</p>
                                    <p class="item-date"><?=$row["date"]?></p>
                                </span>
                                <p class="good-item-buy" onclick='addToCart(<?=$row["id"]?>)'>
                                    В КОРЗИНУ
                                </p>
                            </div>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </div>


            </div>
        </div>

        <div class="dark-block" id="dark-block-id">
        </div>

        
    <script src="js/bright.js"></script>
    <script src="js/axios.js"></script>
    <script src="js/good.js"></script>
    <script src="js/cartItemsNum.js"></script>
    <script src="js/slider.js"></script>
    <script src="js/header.js"></script>
    <?php
        if(
            !(isset($_GET["category_id"]) && intval($_GET["category_id"]))
            &&
            !(isset($_GET["q"]))
            &&
            !(isset($_GET["company"]))
        ) {
    ?>
    <script src="js/index.js"></script>
    <?php
        }
    ?>
    <?php
        include "credentials.php";
    ?>
    <script src="js/myCredentials.js"></script>
    </body>
</html>