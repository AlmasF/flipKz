<?php
    include "../../config/db.php";
    include "../../config/base_url.php";

    if(isset($_POST["emailOrPhone"], $_POST["password"]) &&
    strlen($_POST["emailOrPhone"]) > 0 && 
    strlen($_POST["password"]) > 0) {
        $emailOrPhone = $_POST["emailOrPhone"];
        $pass = $_POST["password"];
        $hash = sha1($pass);

        $prep = mysqli_prepare($con, "SELECT id, name FROM users WHERE (email=? OR phone=?) AND hash=?");
        mysqli_stmt_bind_param($prep, "sss", $emailOrPhone, $emailOrPhone, $hash);
        mysqli_stmt_execute($prep);
        $query = mysqli_stmt_get_result($prep);
        if(mysqli_num_rows($query) != 1) {
            header("Location: $BASE_URL/login-page?error=8");
            exit();
        }

        $row = mysqli_fetch_assoc($query);

        session_start();
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["name"] = $row["name"];

        header("Location: $BASE_URL/user-page?name=".$row["name"]);

    } else {
        header("Location: $BASE_URL/login-page?error=7");
    }

?>