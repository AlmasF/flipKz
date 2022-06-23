<?php
    include "../../config/db.php";
    $data = json_decode(file_get_contents('php://input'), true);


    if(isset($data["text"], $data["good_id"]) &&
    intval($data["good_id"]) && strlen($data["text"]) > 0) {

        $text = $data["text"];
        $good_id = $data["good_id"];
        $rating = $data["rating"];
        session_start();

        $prep = mysqli_prepare($con, "INSERT INTO comments (text, good_id, stars, user_id) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($prep, "siii", $text, $good_id, $rating, $_SESSION["user_id"]);
        mysqli_stmt_execute($prep);

        $comment_id = mysqli_stmt_insert_id($prep);
        $query = mysqli_query($con, "SELECT c.*, u.name FROM comments c LEFT OUTER JOIN users u ON c.user_id=u.id WHERE c.id=$comment_id");

        if(mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);

            echo json_encode($row);
        }


    } else {
        echo "ERROR";
    }



?>