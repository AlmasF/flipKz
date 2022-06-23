<?php
    include "../../config/db.php";
    include "../../config/base_url.php";

    if(isset($_GET["id"]) && 
        intval($_GET["id"])) {
            $good_id = $_GET["id"];
            
            session_start();
            $user_id = $_SESSION["user_id"];

            $prep = mysqli_prepare($con, "DELETE FROM goods WHERE id = ?");
            mysqli_stmt_bind_param($prep, "i", $good_id);
            mysqli_stmt_execute($prep);
            
            header("Location: $BASE_URL/my-good-page");
    }
?>