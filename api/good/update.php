<?php

    include "../../config/db.php";
    include "../../config/base_url.php";

    if(isset($_POST["name"], $_POST["company"], $_POST["price"], $_GET["id"], $_POST["description"]) && 
        strlen($_POST["name"]) > 0 &&
        strlen($_POST["company"]) > 0 &&
        strlen($_POST["description"]) > 0 && 
        intval($_POST["price"]) &&
        intval($_GET["id"]))
        {
            $name = $_POST["name"];
            $price = $_POST["price"];
            $company = $_POST["company"];
            $description = $_POST["description"];
            $category_id = $_POST["category_id"];
            $id = $_GET["id"];

            if(isset($_FILES["image"]) && isset($_FILES["image"]["name"]) && strlen($_FILES["image"]["name"]) > 0) {

                $query = mysqli_query($con, "SELECT image FROM goods WHERE id=$id");
                if(mysqli_num_rows($query) > 0) {
                    $row = mysqli_fetch_assoc($query);
                    $old_path = __DIR__."/../../".$row["imag"];
                    echo $old_path;
                    if(file_exists($old_path)){
                        unlink($old_path);
                    }
                }


                $ext = end(explode(".", $_FILES["image"]["name"]));
                $image_name = time().".".$ext;
                move_uploaded_file($_FILES["image"]["tmp_name"], "../../img/goods/$image_name");

                $prep = mysqli_prepare($con, "UPDATE goods SET name=?, company=?, image=?, price=?, description=?, category_id=? WHERE id=?");
                $path = "/img/goods/".$image_name;
                mysqli_stmt_bind_param($prep, "sssisii", $name, $company, $path, $price, $description, $category_id, $id);
                mysqli_stmt_execute($prep);
            }
            else {
                $prep = mysqli_prepare($con, "UPDATE goods SET name=?, company=?, price=?, description=?, category_id=? WHERE id=?");
                mysqli_stmt_bind_param($prep, "ssisii", $name, $company, $price, $description, $category_id, $id);
                mysqli_stmt_execute($prep);
            }
            
            header("Location: $BASE_URL/my-good-page");
        }
        else
        {
            header("Location: $BASE_URL/edit-good-page?id=".$_GET['id']."&error=3");
        }

?>