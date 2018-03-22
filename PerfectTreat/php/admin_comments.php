<?php
function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit();
}
session_start();
if(isset($_SESSION["a_id"])){
}
else{
    echo "<script>alert('Session Expired. Login Again!');
                  window.location = '../html/perfect_admin.html'; </script>";
}
?>
<?php
require_once("db_connection.php");
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>View Comments-Admin</title>
    <link href="../css/all.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/admin_home.css" rel="stylesheet" type="text/css" media="all" />
    <script src="../js/jquery-1.8.3.min.js"></script>
</head>
<body>
<div id="site">
    <div id="header" role="banner">
    </div>
    <h3 align="right"><font color="#92c100"><?php
            $a_id=$_SESSION['a_id'];
            $query2 = "SELECT * FROM `admin` WHERE a_id=$a_id";
            $result2 = mysqli_query($connection, $query2);
            $admin=mysqli_fetch_assoc($result2);
            $admin_name=$admin['adminname'];
            echo "Welcome, " . $admin_name;
            ?></font></h3>
    <div id="nav_main" role="navigation" class="reset menu pull_out">
        <h3 class="hidden">Main Navigation</h3>
        <ul>
            <li><a href="admin_home.php"><span>Add balance</span></a></li>
            <li><a href="admin_rating.php"><span>View ratings</span></a></li>
            <li><a href="admin_comments.php"><span>View comments</span></a></li>
            <li><a href="admin_aboutus.php"><span>About Us</span></a></li>
            <li><a href="admin_view_user_info.php" class="parent"><span>View UserInfo</span></a></li>
        </ul>
    </div>
    <div id="content">
        <div id="review_posts">
            <hr>
            <?php
            $query = "SELECT * FROM `comments` ORDER BY c_id";
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
            $("#header").load("admin_header.html");
            $("#footer").load("footer.html");
        });
    </script>
</div>
</body>
</html>