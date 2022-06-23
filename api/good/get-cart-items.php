<?php
    include "../../config/db.php";
    include "../../config/base_url.php";

    if(!isset($_GET["user_id"]) || !intval($_GET["user_id"])) {
        exit();
    }


    $user_id = $_GET["user_id"];

    $prep = mysqli_prepare($con, "SELECT g.*, c.id AS cart_item_id FROM cart c LEFT OUTER JOIN goods g ON g.id = c.good_id WHERE c.user_id = ?");
    mysqli_stmt_bind_param($prep, "i", $user_id);
    mysqli_stmt_execute($prep);
    $query = mysqli_stmt_get_result($prep);
    
    $goods = array();
    if(mysqli_num_rows($query) == 0) {
        echo json_encode($goods);
        exit();
    }

    while($good = mysqli_fetch_assoc($query)) {
        $goods[] = $good;
    }

    echo json_encode($goods);
?>