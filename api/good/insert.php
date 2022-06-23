<?php
    include "../../config/db.php";
    include "../../config/base_url.php";

    if(isset($_POST["name"], $_POST["category_id"], $_POST["company"], $_POST["price"], $_POST["description"]) && 
        strlen($_POST["name"])> 0 &&
        strlen($_POST["company"])> 0 && 
        strlen($_POST["description"])>0 &&
        intval($_POST["price"]) && intval($_POST["category_id"])) {
            $name = $_POST["name"];
            $company = $_POST["company"];
            $price = $_POST["price"];
            $cat_id = $_POST["category_id"];
            $description = $_POST["description"];
            
            session_start();
            $user_id = $_SESSION["user_id"];

            if(isset($_FILES["image"]) && isset($_FILES["image"]["name"]) 
            && strlen($_FILES["image"]["name"])> 0) {
                $ext = end(explode(".", $_FILES["image"]["name"]));
                $image_name = time().".".$ext;
                move_uploaded_file($_FILES["image"]["tmp_name"], "../../img/goods/$image_name");

                $prep = mysqli_prepare($con, "INSERT INTO goods (name, company, image, user_id, category_id, price, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $path = "/img/goods/".$image_name;
                mysqli_stmt_bind_param($prep, "sssiiis", $name, $company, $path, $user_id, $cat_id, $price, $description);
                mysqli_stmt_execute($prep);
            } else {
                $prep = mysqli_prepare($con, "INSERT INTO goods (name, company, image, user_id, category_id, price, description) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $path = "/img/goods/default-good.jpg";
                mysqli_stmt_bind_param($prep, "sssiiis", $name, $company, $path, $user_id, $cat_id, $price, $description);
                mysqli_stmt_execute($prep);
            }
            header("Location: $BASE_URL/user-page?name=".$_SESSION["name"]);
    } else {
        header("Location: $BASE_URL/add-good-page?error=3");
    }
?>