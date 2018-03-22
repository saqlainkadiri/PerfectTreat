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
                  window.location = 'login.php'; </script>";
}
?>
<?php
$temp_order_id=$_SESSION["order_id"];
$u_id = $_SESSION["u_id"];
?>
<?php
$temp_quantity=$_SESSION["quantity"];
$time=5+(3*$temp_quantity)+5+2+7;
$_SESSION["time"] = $time;
$total=$_GET['total'];
?>
<?php require_once("db_connection.php"); ?>
<?php
function confirm_query( $result_set ) {
    if( !$result_set ) {
        die( "Database query failed: " . mysqli_error());
    }
}
function password_check($password,$existing_hash){
    $hash=crypt($password,$existing_hash);
    if($hash==$existing_hash){
        return true;
    }
    else{
        return false;
    }
}
?>
<?php
$row = "SELECT * FROM users WHERE u_id=$u_id";
$result_set = mysqli_query($connection, $row);
confirm_query($result_set);
$u_password = "";
$balance=0;
if (mysqli_num_rows($result_set) > 0) {
    $found_item = mysqli_fetch_assoc($result_set);
    $u_password = $found_item['hashed_password'];
    $balance=$found_item['balance'];
}
if (isset($_POST['submit'])) {
    $try_password = ($_POST['checkpass']);
    $temp_input = $_POST['payment_choice'];
    if (password_check($try_password, $u_password)) {
        echo "your card balance is : ".$balance."<br>";
        if ($temp_input == 'card_balance') {
            if ($balance < $total) {
                echo "Insufficient Balance";
            } else {
                echo "Sufficient Balance";
                $balance -= $total;
                $payment_status = 1;
                $query = "UPDATE `users` SET `balance`=$balance WHERE `u_id`=$u_id";
                $result = mysqli_query($connection, $query);
            }
        }
        else if($temp_input == 'cash'){
            $payment_status=0;
        }
        else{
            echo "Kindly select a payment method.";
        }
        $checkstr = ",";
        $count_order = substr_count($temp_order_id, $checkstr, 0, strlen($temp_order_id));
        $loopcounter = 0;
        while ($loopcounter <= $count_order) {
            $solo_order_id = substr($temp_order_id, 0, strpos($temp_order_id, ",", 0));
            if ($loopcounter == $count_order) {
                $solo_order_id = $temp_order_id;
            }
            $status = 1;
            $query = "UPDATE `order_details` SET `status`=1,`payment_status`=$payment_status WHERE `order_id`=$solo_order_id";
            $result = mysqli_query($connection, $query);
            $temp_order_id = substr($temp_order_id, strlen($solo_order_id) + 1, strlen($temp_order_id));
            $loopcounter++;
        }
        redirect_to("tracking.php");
    } else {
        echo "Incorrect Password.Please Re-enter your Password.";
    }
}
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>About us</title>
    <link href="../css/all.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/payment.css" rel="stylesheet" type="text/css" media="all" />
    <script src="../js/jquery.min.js"></script>
</head>
<body>
<div id="site">
    <div id="header" role="banner">
    </div>
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
        <form action="payment.php?total=<?php echo $total ?>" method="post">
            <h4>Total is :<?php echo $_GET['total']."<br/>"; ?></h4>
            <br/>
            <input type="radio" name="payment_choice" id="cash" value="cash" checked>Cash on Delivery<br>
            <input type="radio" name="payment_choice" id="card_balance" value="card_balance">PerfectTreat Card<br>
            <label id="lbl_pass">Enter your password</label>
            <input type="password" name="checkpass" id="checkpass">
            <br/>
            <button type="submit" name="submit" id="confirm_pay">Confirm</button>
        </form>
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
</body>
</html>
