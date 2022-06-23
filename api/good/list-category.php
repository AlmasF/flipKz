<?php
    include "../../config/db.php";

    if(intval($_GET["id"]) || $_GET["id"] == 0) {
        $sql = "SELECT g.*, c.title AS cat_name FROM goods g LEFT OUTER JOIN categories c ON
        c.id = g.category_id
        WHERE g.category_id =". $_GET["id"];
        // if(isset($_GET["category_id"]) && intval($_GET["category_id"])) {
        //     $sql .= " WHERE g.category_id = " . $_GET["category_id"];
        // }

        $prep = mysqli_prepare($con, $sql);
        mysqli_stmt_execute($prep);
        $query = mysqli_stmt_get_result($prep);
        $goods = array();

        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $goods[] = $row;
            }
        }

        echo json_encode($goods);
    }
?>