<?php
    include "../../config/db.php";

    if(intval($_GET["page"]) || $_GET["page"] == 0) {
        $page = $_GET["page"];

        $limit = 12;
        $skip = $page * $limit;

        $sql = "SELECT g.* FROM goods g";
        if(isset($_GET["category_id"]) && intval($_GET["category_id"])) {
            $sql .= " WHERE g.category_id = " . $_GET["category_id"];
        }
        $sql .= " LIMIT ".$skip.",".$limit;

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