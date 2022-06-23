<?php
    include "../../config/db.php";
    include "../../config/base_url.php";

    if(isset($_GET["id"]) && intval($_GET["id"])) {
        $id = $_GET["id"];

        $prep = mysqli_prepare($con, "DELETE FROM cart WHERE id=?");
        mysqli_stmt_bind_param($prep, "i", $id);
        mysqli_stmt_execute($prep);
    }

    echo json_encode("removed");
?>