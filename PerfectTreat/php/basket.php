<?php
require_once("db_connection.php");
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
    function confirm_query( $result_set ) {
        if( !$result_set ) {
            die( "Database query failed: " . mysqli_error());
        }
    }
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Basket</title>
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
            <li><a href="../other/menu.xml"><span>Menu</span></a></li>
            <li><a href="bulk_submit.php"><span>Bulk Orders</span></a></li>
            <li><a href="aboutus.php"><span>About Us</span></a></li>
            <li><a href="temp_offer.php?month=<?php echo date('m');?>" class="parent"><span>Seasonal Offers</span></a></li>
        </ul>
    </div>
    <div id="content">
        <?php
        $total=0;
        if ( isset( $_POST['submit'] ) ) {
            if(!empty($_POST['check_list3'])){
                $total=0;
                $item=0;
                $flag=1;
                $pur_quantity=0;
                $purchased_items=0;
                $order_string="";
                foreach ($_POST['check_list3'] as $quantity){
                    if($quantity!=0) {
                        $purchased_items += 1;
                        $item += 1;
                        if ($quantity > 0) {
                            $pur_quantity+=$quantity;
                            $row = "SELECT * FROM items WHERE product_id=$item";
                            $result_set = mysqli_query($connection, $row);
                            confirm_query($result_set);
                            if (mysqli_num_rows($result_set) > 0) {
                                $found_item = mysqli_fetch_assoc($result_set);
                                //print_r($found_item);
                                $price = $found_item['price'];
                                $itemname = $found_item['itemname'];
                                $total = $total + ($price * $quantity);
                                if($flag==1){
                                    ?>
                                    <table id="basket_table">
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Item Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Item Total</th>
                                    </tr>
                                    <?php $flag=0; } ?>
                                <tr>
                                    <td><?php echo $purchased_items ?></td>
                                    <td><?php echo $itemname?></td>
                                    <td><?php echo $price?></td>
                                    <td><?php echo $quantity?></td>
                                    <td><?php echo ($price * $quantity)?></td>
                                </tr>
                                <?php
                                $u_id=$_SESSION['u_id'];
                                $status=0;
                                $payment_status=-1;
                                $query = "INSERT INTO `order_details` (`product_id`,`u_id`,`quantity`,`status`,`payment_status`) VALUES ($item,$u_id,$quantity,$status,$payment_status)";
                                $result = mysqli_query($connection, $query);
                                $order_id=mysqli_insert_id($connection);
                                $order_string.=$order_id.",";
                            }
                        }
                    }
                    else{
                        $item += 1;
                    }
                }
                ?>
                <tr>
                    <th colspan="2">Grand Total</th>
                    <th colspan="3"><?php echo $total; ?></th>
                </tr>
                </table>
                <?php
                $order_string=substr($order_string,0,strlen($order_string)-1);
                $_SESSION["order_id"]=$order_string;
                $_SESSION['quantity']=$pur_quantity;
            }
        }
        ?>
        <a href="payment.php?total=<?php echo $total;?>">
            <button type="submit" name="submit" id="Checkout">Proceed to Payment</button>
        </a>
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
