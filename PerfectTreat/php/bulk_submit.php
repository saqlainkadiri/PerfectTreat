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
    function confirm_query( $result_set ) {
        if( !$result_set ) {
            die( "Database query failed: " . mysqli_connect_error());
        }
    }
?>
<?php
    if(!isset($_POST['submit'])){
        $total=0;
        $order_id=-1;
    }
    $query = "SELECT * FROM items";
    $result_set = mysqli_query($connection, $query);
    confirm_query($result_set);
?>
<?php
    if (isset($_POST['submit2'])) {
        $bquantity = $_POST['bquantity'];
        $_SESSION['quantity']=$bquantity;
        $item = $_POST['item'];
        $query = "SELECT * FROM `items` WHERE `itemname`='$item'";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $row=mysqli_fetch_assoc($result);
            $item_id=$row['item_id'];
            $price=$row['price'];
        }
        else {
            echo "Data Retrieve Error";
        }
    }
?>
<?php
    if (isset($_POST['submit'])) {
        $order_id=$_GET['order_id'];
        $_SESSION['order_id']=$order_id;
        $total=$_SESSION['total'];
        $redirect="payment.php"."?total=".$total;
        redirect_to($redirect);
    }
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Bulk Orders</title>
    <link href="../css/all.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/bulk_submit.css" rel="stylesheet" type="text/css" media="all" />
    <script src="../js/jquery-1.8.3.min.js"></script>
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
            <li>
                <a href="sweets.php" class="parent"><span>Sweets</span></a>
            </li>
            <li>
            <li><a href="../other/menu.xml"><span>Menu</span></a></li>
            <li><a href="bulk_submit.php"><span>Bulk Orders</span></a></li>
            <li><a href="aboutus.php"><span>About Us</span></a></li>
            <li>
                <a href="temp_offer.php?month=<?php echo date('m');?>" class="parent"><span>Seasonal Offers</span></a>
            </li>
        </ul>
    </div>
    <div id="content">
        <?php
        if(isset($_POST['submit2'])){
            $total=0;
            if($bquantity<=30) {
                $total = ($price * 0.85) * $bquantity;
            }
            else if($bquantity<=40){
                $total = ($price * 0.80) * $bquantity;
            }
            else if($bquantity<=50){
                $total = ($price * 0.75) * $bquantity;
            }
            else if($bquantity<=60){
                $total = ($price * 0.70) * $bquantity;
            }
            $discount=($price*$bquantity)-$total;
            $nodisctotal=$discount+$total;
            echo "<br><h3>Item Price per KG is : ".$price."</h3>";
            echo "<br><h3>Quantity is : ".$bquantity."</h3>";
            echo "<br><h3>Total is : ".$nodisctotal."</h3>";
            echo "<br><h3>Discount is : ".$discount."</h3>";
            echo "<br><h3>Discounted Total is : ".$total."</h3><br>";
            $u_id=$_SESSION['u_id'];
            $status=0;
            $_SESSION['total']=$total;
            $payment_status=-1;
            $query = "INSERT INTO `order_details` (`product_id`,`u_id`,`quantity`,`status`,`payment_status`) VALUES ($item_id,$u_id,$bquantity,$status,$payment_status)";
            $result = mysqli_query($connection, $query);
            $order_id=mysqli_insert_id($connection);
        }
        ?>
        <form action="bulk_submit.php?total=<?php echo $total;?>&order_id=<?php echo $order_id?>" method="post">
            <?php
            if(!isset($_POST['submit2'])) {
                echo "<h3>Select item</h3>";
                echo "<select name=" . "item" . " id=" . "item" . " class=" . "bulk_dropdown" . ">";
                if (mysqli_num_rows($result_set) > 0) {
                    while ($found_item = mysqli_fetch_assoc($result_set)) {
                        echo "<option value='" . $found_item['itemname'] . "'>" . $found_item['itemname'] . "</option>";
                    }
                    echo "</select>";
                }
                ?>
                <br>
                <h3>Select quantity</h3>
                <select name="bquantity" id="bquantity" class="bulk_dropdown">
                    <?php
                    for ($i = 20; $i <= 60; $i++) {
                        echo "<option value='" . $i . "'>" . $i . "</option>";
                    }
                    ?>
                </select>
                <?php
            }
            ?>
            <?php
            if(!isset($_POST['submit2'])){
                ?>
                <button type="submit" name="submit2" id="submit2">View Price</button>
                <?php
            }
            ?>
            <?php
            if(isset($_POST['submit2'])){
                ?>
                <button type="submit" name="submit" id="submit">Submit Order</button>
                <?php
            }
            ?>
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
