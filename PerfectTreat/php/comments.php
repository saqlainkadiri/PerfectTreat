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
<html>
<head>
    <meta charset="utf-8" />
    <title>Comments</title>
    <link href="../css/all.css" rel="stylesheet" type="text/css" media="all" />
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
        $u_id=$_SESSION['u_id'];
        function confirm_query( $result_set ) {
            if( !$result_set ) {
                die( "Database query failed: " . mysqli_connect_error());
            }
        }
        require_once("db_connection.php");
        if(isset($_POST['submit'])){
            $comment=$_POST['comment'];
            $query = "INSERT INTO `comments` (`u_id`,`comment`) VALUES ($u_id,'$comment')";
            $result = mysqli_query($connection, $query);
        }
        ?>
        <div id="review_form">
            <form action="comments.php" method="post">
                <textarea type="text" id="comment" name="comment" rows="8" cols="100" placeholder="Enter your review"></textarea>
                <button type="submit" id="submit" name="submit">Submit</button>
            </form>
        </div>
        <div id="review_posts">
            <hr>
            <?php
            $query = "SELECT * FROM `comments` ORDER BY c_id DESC";
            $result = mysqli_query($connection, $query);
            while($comments=mysqli_fetch_assoc($result)){
                $u_id=$comments['u_id'];
                $u_comment=$comments['comment'];
                $query2 = "SELECT * FROM `users` WHERE u_id=$u_id";
                $result2 = mysqli_query($connection, $query2);
                $user=mysqli_fetch_assoc($result2);
                $user_name=$user['username'];
                ?>
                <div class="review_username">
                    <?php echo $user_name." : " ?>
                </div>
                <div class="review_comment">
                    <?php echo $u_comment ?>
                </div>
                <hr>
                <?php
            }
            ?>
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
</body>
</html>
