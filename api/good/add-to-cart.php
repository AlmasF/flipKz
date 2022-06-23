<?php
    include "../../config/db.php";
    include "../../config/base_url.php";

    if(isset($_GET["good_id"]) && intval($_GET["good_id"])) {
            $good_id = $_GET["good_id"];
            
            session_start();
            $user_id = $_SESSION["user_id"];

            $prep = mysqli_prepare($con, "INSERT INTO cart (good_id, user_id) VALUES (?, ?)");
            mysqli_stmt_bind_param($prep, "ii", $good_id, $user_id);
            mysqli_stmt_execute($prep);

            header("Location: $BASE_URL/index");
    } else {
        header("Location: $BASE_URL/index?error=3");
    }
?>