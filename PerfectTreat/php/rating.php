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
    require 'db_connection.php';
    function confirm_query( $result_set ) {
        if( !$result_set ) {
            die( "Database query failed: " . mysqli_error());
        }
    }
    function rate($table,$factor,$rating,$connection){
        $factor=(int)$factor;
        $rating=(int)$rating;
        $query = "UPDATE `$table` SET `rating_total`=`rating_total`+$rating,`rating_count`=`rating_count`+1 WHERE `r_id`=$factor";
        $result = mysqli_query($connection, $query);
    }
    if(isset($_POST['submit'])){
        $counter_temp=1;
        while($counter_temp<=5){
            if(isset($_POST[$counter_temp])){
                $temp=$_POST[$counter_temp];
                $counter_temp++;

                $factor=(int)substr($temp,0,1);
                $rating=(int)substr($temp,1,1);
                $table='rating';
                if(!empty($factor) && !empty($rating) && ($factor>=1 && $factor<=5) && ($rating>=1 && $rating<=5)){
                    rate($table,$factor,$rating,$connection);
                }

                header('rating.php');
            }
            else{
                $counter_temp++;
            }
        }
    }
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Rate Us</title>
    <link href="../css/all.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/rating.css" rel="stylesheet" type="text/css" media="all" />
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
        <form id="rating_form"action="rating.php" method="post">
            <?php
            for ($z=1;$z<=5;$z++){
                ?>
                <div class="rate">
                    <?php
                    $row = "SELECT * FROM rating WHERE r_id=$z";
                    $result_set = mysqli_query($connection, $row);
                    confirm_query($result_set);
                    $row=mysqli_fetch_assoc($result_set);
                    $factor=$row['title'];
                    $rating=number_format((($row['rating_count']!=0) ? $row['rating_total']/$row['rating_count'] : 0) , 2);
                    echo $factor." : ".$rating."<br>";
                    ?>
                    <?php
                    for($x=1;$x<=5;$x++){
                        ?>
                        <input type="radio" id="<?php echo (($z*10)+$x); ?>" name="<?php echo $z; ?>" value="<?php echo (($z*10)+$x); ?> "><?php echo $x; ?>
                        <?php
                    }
                    ?>
                </div>
                <?php
                echo "<br>";
            }
            ?>
            <button type="submit" name="submit" id="submit">Submit</button>
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
