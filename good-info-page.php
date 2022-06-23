<?php
    include "config/db.php";
    include "config/base_url.php";

    $id = $_GET["id"];
    $prep = mysqli_prepare($con,
    "SELECT g.`id`, g.`name`, g.`company`, g.`image`, g.`price`, g.`date`, g.`user_id`, g.`category_id`, g.`description`, ROUND(AVG(c.stars)) AS rating
    FROM goods g LEFT OUTER JOIN comments c ON c.good_id = g.id WHERE g.id = ?
    GROUP BY g.`id`, g.`name`, g.`company`, g.`image`, g.`price`, g.`date`, g.`user_id`, g.`category_id`, g.`description`");
    mysqli_stmt_bind_param($prep, "i", $id);
    mysqli_stmt_execute($prep);
    $query = mysqli_stmt_get_result($prep);

    if(mysqli_num_rows($query) <= 0) {
        header("Location: $BASE_URL");
        exit();
    }

    $row = mysqli_fetch_assoc($query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "common/head.php";
    ?>
    <title>
        <?=$row["name"]?>
    </title>
</head>
<body data-baseurl="<?=$BASE_URL;?>" data-authorid='<?=$row["user_id"]?>' data-goodid='<?=$row["id"]?>'>
    <?php
        include "common/header.php";
    ?>
    <div class="good-info-container">
        <div class="good-image">
            <img src="<?=$BASE_URL?><?=$row["image"]?>" alt="" srcset="">
        </div>
        <div class="good-description">
            <h2>
                <?=$row["name"]?>
            </h2>
            <span class="rating">
                <?php
                    for($i = 0; $i < 5; $i++) {
                        if($i < $row["rating"]) {
                ?>
                            <img src="img/good-info/star.png" style="filter:invert(67%) sepia(67%) saturate(631%) hue-rotate(360deg) brightness(103%) contrast(97%);">
                <?php
                        }
                        else {
                ?>
                            <img src="img/good-info/star.png" alt="">
                <?php
                        }
                    }
                ?>
            </span>
            <span class="price">
                <?=$row["price"]?>
            </span>
            <p>
                <?=$row["description"]?>
            </p>
            <div class="good-buy">
                <button onclick='addToCart(<?=$row["id"]?>)'>Купить</button>
            </div>
        </div>
    </div>
    <div class="commentaries" id="comments">
        
    </div>
    <?php
        if(isset($_SESSION["user_id"])) {
    ?>

    <div class="leave-commentary">
        <div class="star-rating" id="star-rating">
            <input type="radio" id="star1" name="rating" value="1" checked>
            <label for="star1">
                <img src="img/good-info/star.png" alt="" srcset="">
            </label>
            <input type="radio" id="star2" name="rating" value="2">
            <label for="star2">
                <img src="img/good-info/star.png" alt="" srcset="">
            </label>
            <input type="radio" id="star3" name="rating" value="3">
            <label for="star3">
                <img src="img/good-info/star.png" alt="" srcset="">
            </label>
            <input type="radio" id="star4" name="rating" value="4">
            <label for="star4">
                <img src="img/good-info/star.png" alt="" srcset="">
            </label>
            <input type="radio" id="star5" name="rating" value="5">
            <label for="star5">
                <img src="img/good-info/star.png" alt="" srcset="">
            </label>
        </div>
        <textarea id="comment-text" id="" cols="30" rows="5" placeholder="Напишите отзыв"></textarea>
        <button id="add-comment">Отправить</button>
    </div>

    <?php
        } else {
    ?>

    <span class="comment-warning">
        Чтобы оставить отзыв <a href="signup-page">зарегистрируйтесь</a> , или  <a href="login-page">войдите</a>  в аккаунт.
    </span>

    <?php
    }
    ?>
    

    <script src="js/axios.js"></script>
    <script src="js/good.js"></script>
    <script src="js/comment.js"></script>
    <script src="js/cartItemsNum.js"></script>
    <script src="js/star.js"></script>
    <script src="js/header.js"></script>
</body>
</html>