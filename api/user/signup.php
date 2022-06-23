<?php
    include "../../config/db.php";
    include "../../config/base_url.php";
    if(isset($_POST["email"], 
            $_POST["name"], 
            $_POST["password"],
            $_POST["phone"]) && 
        strlen($_POST["email"]) > 0 && 
        strlen($_POST["name"]) > 0 && 
        strlen($_POST["phone"]) > 0 && 
        strlen($_POST["password"]) > 0
      ) {
            $email = $_POST["email"];
            $name = $_POST["name"];
            $phone = $_POST["phone"];
            $password = $_POST["password"];


            $prep = mysqli_prepare($con, "SELECT id FROM users WHERE email=? OR phone=?");
            mysqli_stmt_bind_param($prep, "ss", $email, $phone);
            mysqli_stmt_execute($prep);
            $query = mysqli_stmt_get_result($prep);

            if(mysqli_num_rows($query) > 0) {
                header("Location: $BASE_URL/signup-page?error=6");
                exit();
            }


            $hash = sha1($password);
            $prep1 = mysqli_prepare($con, "INSERT INTO users (email, name, phone, hash) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($prep1, "ssss", $email, $name, $phone, $hash);
            mysqli_stmt_execute($prep1);

            header("Location: $BASE_URL/login-page");

        } else {

            header("Location: $BASE_URL/sigunp-page?error=4");

        }

?>