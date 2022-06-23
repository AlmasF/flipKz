<?php
ob_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../../PHPMailer/src/Exception.php';
    require '../../PHPMailer/src/SMTP.php';
    require '../../PHPMailer/src/PHPMailer.php';

    include "../../config/db.php";
    include "../../config/base_url.php";

    session_start();
    if(!isset($_SESSION["user_id"])) {
        header("Location: $BASE_URL?error=wtf");
        exit();
    }

    if(isset($_SESSION["user_id"])) {
            session_start();
            $user_id = $_SESSION["user_id"];

            
            $prep = mysqli_prepare($con, "INSERT INTO orders (user_id, good_id) SELECT user_id, good_id FROM cart WHERE user_id = ?");
            mysqli_stmt_bind_param($prep, "i", $user_id);
            mysqli_stmt_execute($prep);

            $prep = mysqli_prepare($con, 
            "SELECT u.name seller, u.email, g.name good, COUNT(g.user_id) num
            FROM cart c
            LEFT OUTER JOIN goods g
            ON g.id = c.good_id
            LEFT OUTER JOIN users u
            ON u.id = g.user_id
            WHERE c.user_id = ?
            GROUP BY u.name, u.email, g.name");
            mysqli_stmt_bind_param($prep, "i", $user_id);
            mysqli_stmt_execute($prep);
            $query = mysqli_stmt_get_result($prep);

            $mail = new PHPMailer(true);

        
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPDebug   = 2;
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->SMTPSecure  = "tls"; //Secure conection
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            $mail->Username   = 'alisamla202216@gmail.com';                     //SMTP username
            $mail->Password   = 'arqrqlyfxqoqvvub';                               //SMTP password
            $mail->Priority    = 1;
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            

            $mail_query = mysqli_fetch_assoc($query);
            //Recipients
            $mail->setFrom('alisamla@gmail.com', 'Mailer');
            $mail->addAddress($mail_query["email"]);
            $mail->addReplyTo('info@example.com', 'Information');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'У вас покупка!';
            $mail->Body    = 'Здравствуйте, '.$mail_query["seller"].'!\nУ вас купили '.$mail_query["good"].'. '.$mail_query["num"].' штук.';
            $mail->AltBody = 'У вас покупка';

            $mail->send();
            //echo 'Message has been sent';

            $prep = mysqli_prepare($con, "DELETE FROM cart WHERE user_id=?");
            mysqli_stmt_bind_param($prep, "i", $user_id);
            mysqli_stmt_execute($prep);


            header("Location: $BASE_URL/my-cart-page.php");

            
    } else {
        header("Location: $BASE_URL/my-cart-page?error=3");
    }
?>