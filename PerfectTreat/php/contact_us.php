<?php
function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit();
}
session_start();
if(isset($_SESSION["u_id"])){
}
else{
    echo "<script>alert('Session Expired. Login Again!');
                  window.location = '../html/login.html'; </script>";
}
?>
<?php
/**
 * This example shows how to handle a simple contact form.
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '..\other\PHPMailer-master\src\Exception.php';
require '..\other\PHPMailer-master\src\PHPMailer.php';
require '..\other\PHPMailer-master\src\SMTP.php';
if(isset($_POST['submit2'])){
    $msg = '';

    if(isset($_POST['submit2'])){
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';         			 // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'YOUR_EMAIL';                 // SMTP username
            $mail->Password = 'YOUR_PASSWORD';                           // SMTP password
            $mail->SMTPSecure = 'ssl';                          
            $mail->Port = 465;                                  
			$mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    )
			);
            //Recipients
            $user_name=$_POST['name2'];
            $user_email=$_POST['email2'];
            $mail->setFrom($user_email,$user_name);
            $mail->addAddress('YOUR_QUERY_EMAIL','Perfect Treat Contact Mail'); // Add a recipient  // Name is optional
            $mail->addReplyTo($user_email,$user_name);
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Contact Form';
            $user_message=$_POST['comments2'];
            $mail->Body    = '<u><font color="red">'.$user_message.'</font></u>';
            $mail->AltBody = '<p>'.$user_message.'</p>';

            $mail->send();
            echo "<script>alert('Message sent. !');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Message could not be sent. !');</script>";
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Contact us</title>
    <link href="../css/all.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/items.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/contactus.css" rel="stylesheet" type="text/css" />
    <script src="../js/base.min.js"></script>
</head>

<body class="">
<div id="site">
    <div id="header" role="banner"></div>
    <h3 align="right"><font color="#92c100"><?php
            require_once("db_connection.php");
            $u_id=$_SESSION['u_id'];
            $query2 = "SELECT * FROM `users` WHERE u_id=$u_id";
            $result2 = mysqli_query($connection, $query2);
            $user=mysqli_fetch_assoc($result2);
            $user_name=$user['username'];
            echo "Welcome, " . $user_name;
            ?></font></h3>
    <div id="nav_main" role="navigation" class="reset menu pull_out">
        <h3 class="hidden">Main Navigation</h3>
        <ul>
            <li><a href="sweets.php" class="parent"><span>Sweets</span></a></li>
            <li>
            <li><a href="../other/menu.xml"><span>Menu</span></a></li>
            <li><a href="bulk_submit.php"><span>Bulk Orders</span></a></li>
            <li><a href="aboutus.php"><span>About Us</span></a></li>
            <li><a href="temp_offer.php?month=<?php echo date('m');?>" class="parent"><span>Seasonal Offers</span></a></li>
        </ul>
    </div>

    <div id="content">
        <div id="mainContent">
            <h1 id="pageID">Contact Us</h1>
            <div id="mainArticle">
                <h3>We want to hear from you</h3>
                ...and if you're on this page, we're guessing you've got something to say! Take a look at our contact options below. If none of them are right for you, feel free to call us at <strong> 8888777666</strong>. Please note that this is not the support line, for support information see below!
                <hr>
                <div id="contact">
                    <p>Would you like more information about one of our products? Have a question that the site can't answer for you? Perhaps you want to give your valuable review for us? Please drop us a line, we'd love to hear from you!</p>
                    <form id="frmContact" name="frmContact" method="post" action="contact_us.php">
                        <fieldset id="personalInfo">
                            <legend><strong>Personal Information</strong></legend>
                            <p>
                                <label for="name2">Name</label>
                                <input name="name2" type="text" class="text" id="name2" tabindex="100" />
                            </p>
                            <p>
                                <label for="email2">Email</label>
                                <input name="email2" type="text" class="text" id="email2" tabindex="110" />
                            </p>
                            <p class="clearBoth">
                                <label for="comments2">Comments</label><br />
                                <textarea name="comments2" id="comments2" cols="45" rows="5" tabindex="270"></textarea>
                            </p>
                            <p>
                                <input type="submit" name="submit2" id="submit2" value="Send" tabindex="300" />
                            </p>
                        </fieldset>
                    </form>
                    <p>&nbsp;</p>
                </div>
            </div>
        </div>

    </div>
    <div id="footer">
    </div>
</div>

<p id="disclaimer">This website is made by Saqlain Kadiri and Rahul Joshi for educational purposes only. By using this website you understand that there is no attorney client relationship between you and the website publisher.This website is to be used as a template for online sweet shopping for educational purposes only.</p>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../sweet/js/jquery-1.8.3.min.js"><\/script>')</script>
<script src="../js/plugins.min.js"></script>
<script src="../js/all.js"></script>
<script src="../js/improved.js"></script>
<script>
    $(document).ready(function() {
        $("#header").load("header.html");
        $("#footer").load("footer.html");
    });
</script>
</body>
</html>
