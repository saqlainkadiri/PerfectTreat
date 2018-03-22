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
    $u_id=$_SESSION['u_id'];
    function confirm_query( $result_set ) {
        if( !$result_set ) {
            die( "Database query failed: " . mysqli_connect_error());
        }
    }
    require_once("db_connection.php");

    $row = "SELECT * FROM order_details WHERE u_id=$u_id and status=1 and payment_status!=-1 ORDER BY order_id DESC";
    $result_set = mysqli_query($connection, $row);
    confirm_query($result_set);
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Previous orders</title>
    <link href="../css/all.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/basket.css" rel="stylesheet" type="text/css" media="all" />
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
            <li><a href="sweets.php" class="parent"><span>Sweets</span></a></li>
            <li>
            <li><a href="../other/menu.xml"><span>Menu</span></a></li>
            <li><a href="bulk_submit.php"><span>Bulk Orders</span></a></li>
            <li><a href="aboutus.php"><span>About Us</span></a></li>
            <li><a href="temp_offer.php?month=<?php echo date('m');?>" class="parent"><span>Seasonal Offers</span></a></li>
        </ul>
    </div>
    <div id="content">
        <h2>PREVIOUS ORDERS</h2>
        <table id="basket_table" border="5">
            <tr>
                <th>Sr No</th>
                <th>Order Number</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Item Total</th>
            </tr>
            <?php
            $total=0;
            $counter=0;
            while ($found_order = mysqli_fetch_assoc($result_set)) {
                $counter=$counter+1;
                $order_id=$found_order['order_id'];
                $product_id=$found_order['product_id'];
                $quantity=$found_order['quantity'];
                $row2 = "SELECT * FROM items WHERE product_id=$product_id";
                $result_set2 = mysqli_query($connection, $row2);
                confirm_query($result_set2);
                $found_item=mysqli_fetch_assoc($result_set2);
                $product_name=$found_item['itemname'];
                $price=$found_item['price'];
                $total=$total+($price*$quantity);
                ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $order_id ?></td>
                    <td><?php echo $product_name?></td>
                    <td><?php echo $price?></td>
                    <td><?php echo $quantity?></td>
                    <td><?php echo ($price * $quantity)?></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <th colspan="3">Grand Total</th>
                <th colspan="3"><?php echo $total; ?></th>
            </tr>
        </table>
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

