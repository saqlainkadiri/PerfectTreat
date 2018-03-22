<?php
session_start();
require_once("db_connection.php");
function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit();
}
if(isset($_SESSION["u_id"])){
}
else{
    echo "<script>alert('Session Expired. Login Again!');
                  window.location = '../html/login.html'; </script>";
}
?>
<?php
    if(isset($_POST["timer"]) && $_POST["timer"] == "yes") {
        echo $_SESSION["time"]--;
        exit;
    }
?>
<?php require_once("db_connection.php"); ?>
<?php
    function confirm_query( $result_set ) {
        if( !$result_set ) {
            die( "Database query failed: " . mysqli_error());
        }
    }
?>
<?php
    $quantity=$_SESSION['quantity'];
    $total_time=5+(3*$quantity)+5+2+7;
    $a=$total_time-5;
    $b=$total_time-5-(3*$quantity);
    $c=$total_time-5-(3*$quantity)-5;
    $d=$total_time-5-(3*$quantity)-5-2;
    $e=$total_time-5-(3*$quantity)-5-2-7;
    $u_id=$_SESSION["u_id"];
    $row = "SELECT mobile FROM users WHERE u_id=$u_id";
    $result_set = mysqli_query($connection, $row);
    confirm_query($result_set);
    if (mysqli_num_rows($result_set) > 0) {
        $found_item = mysqli_fetch_assoc($result_set);
        $mobile = "+91".$found_item['mobile'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Track your order</title>
    <link href="../css/all.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/tracking.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/items.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/aboutus.css" rel="stylesheet" type="text/css" media="all" />
    <script src="../js/base.min.js"></script>
    <script src="../js/jquery-1.8.3.min.js"></script>
</head>
<body>
<div id="site">
    <div id="header" role="banner">
    </div>
    <h3 align="right"><font color="#92c100"><?php
            $u_id=$_SESSION['u_id'];
            $query2 = "SELECT * FROM `users` WHERE u_id=$u_id";
            $result2 = mysqli_query($connection, $query2);
            $user=mysqli_fetch_assoc($result2);
            $user_name=$user['username'];
            $mobile=$user['mobile'];
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
        <div id="trackmain">
            You will receive a message in<p id="track_demo"></p> secs:
            <br>
            <div class="track" id="1" style="background-color: yellow;"><br/>Order Received</div>
            <div class="tracktick" id="a"><img class="img_track" src="../images/tick.png"></div><div class="track_clear"></div>
            <br/>
            <div class="track" id="2" style="background-color: yellow;"><br/>Preparing Your Order</div>
            <div class="tracktick" id="b"><img class="img_track" src="../images/tick.png"></div><div class="track_clear"></div>
            <br/>
            <div class="track" id="3" style="background-color: yellow;"><br/>Order Packaged</div>
            <div class="tracktick" id="c"><img class="img_track" src="../images/tick.png"></div><div class="track_clear"></div>
            <br/>
            <div class="track" id="4" style="background-color: yellow; "><br/>Delivery Scheduled</div>
            <div class="tracktick" id="d"><img class="img_track" src="../images/tick.png"></div><div class="track_clear"></div>
            <br/>
            <div class="track" id="5" style="background-color: yellow;"><br/>Out for delivery</div>
            <div class="tracktick" id="e"><img class="img_track" src="../images/tick.png"></div><div class="track_clear"></div>
            <br/>
            <p id="final"></p>
            <form action="sweets.php" method="post">
                <button type="submit" id="lastcheck">Back to Home</button>
            </form>
        </div>
    </div>
    <div id="footer">
    </div>
    <p id="disclaimer">This website is made by Saqlain Kadiri and Rahul Joshi for educational purposes only. By using this website you understand that there is no attorney client relationship between you and the website publisher.This website is to be used as a template for online sweet shopping for educational purposes only.</p>
    <script>
        $(document).ready(function() {
            $("#header").load("header.html");
            $("#footer").load("footer.html");
        });
    </script>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        timer(<?=$_SESSION["time"]?>);
    })
    function timer(tim) {
        if(tim < 0) {
            $('#5').css({"background-color":"greenyellow"});
            $('#e').css({"display":"block"});
            $('#final').html("Order will be received in 30 mins");
            <?php
            echo "Welcome, " . $user_name;
            // Get the PHP helper library from twilio.com/docs/php/install
            require_once '../other/twilio-php-master/Twilio/autoload.php'; // Loads the library
            use Twilio\Rest\Client;
            $account_sid = 'ACCOUNT_SID';
            $auth_token = 'AUTH_TOKEN';
            $client = new Client($account_sid, $auth_token);
            $mobile="+91".$mobile;
            $messages = $client->messages->create($mobile, array(
                'From' => 'TWILIO_MOBILE_NUMBER',
                'Body' => 'Order received.'
        ));
            ?>
        }
        else{
            //$('#demo').html(tim);
            setTimeout(function () {
                $.post('tracking.php',{timer:"yes"})
                    .done(function (data) {
                        timer(data.trim());
                    })
                $('#track_demo').html(tim);
            },1000);
            if(tim < <?php echo $d ?> ){
                $('#4').css({"background-color":"greenyellow"});
                $('#d').css({"display":"block"});
            }
            if(tim < <?php echo $c ?> ){
                $('#3').css({"background-color":"greenyellow"});
                $('#c').css({"display":"block"});
            }
            if(tim < <?php echo $b ?> ){
                $('#2').css({"background-color":"greenyellow"});
                $('#b').css({"display":"block"});
            }
            if(tim < <?php echo $a ?> ){
                $('#1').css({"background-color":"greenyellow"});
                $('#a').css({"display":"block"});
            }
        }
    }
</script>
</body>
</html>
