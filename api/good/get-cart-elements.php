<?php
    include "../../config/db.php";
    include "../../config/base_url.php";

    if(!isset($_GET["user_id"]) || !intval($_GET["user_id"])) {
        exit();
    }


    $user_id = $_GET["user_id"];


    $prep = mysqli_prepare($con, "SELECT COUNT(id) AS num FROM cart WHERE user_id = ?");
    mysqli_stmt_bind_param($prep, "i", $user_id);
    mysqli_stmt_execute($prep);

    $query = mysqli_stmt_get_result($prep);
    $row = mysqli_fetch_assoc($query);

    $cartItemsNum = $row["num"];

    echo json_encode($cartItemsNum);
?>