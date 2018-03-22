<?php
session_start();
require 'db_connection.php';
function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit();
}
if(isset($_SESSION["a_id"])){
}
else{
    echo "<script>alert('Session Expired. Login Again!');
                  window.location = '../html/perfect_admin.html'; </script>";
}
?>
<?php
function confirm_query( $result_set ) {
    if( !$result_set ) {
        die( "Database query failed: " . mysqli_error());
    }
}
?>
<?php
$query = "SELECT * FROM users";
$result_set = mysqli_query($connection, $query);
confirm_query($result_set);
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>View Comments-Admin</title>
    <link href="../css/all.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/admin_view_user_info.css" rel="stylesheet" type="text/css" media="all" />
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
        <form action="admin_view_user_info.php" method="post">
            <?php
            echo "<select name="."user"." id="."user".">";
            if(mysqli_num_rows($result_set)>0) {
                while ($found_item = mysqli_fetch_assoc($result_set)) {
                    echo "<option value='".$found_item['username']."'>".$found_item['username']."</option>";
                }
                echo "</select>";
            }
            ?>
            <button type="submit" name="submit" id="userinfo">Find Info</button>
        </form>
        <?php
        if(isset($_POST['submit'])){
            ?>
            <div id="user_info">
                <hr>
                <?php
                $selected_user=$_POST['user'];
                $query2 = "SELECT * FROM `users` WHERE username='$selected_user'";
                $result = mysqli_query($connection, $query2);
                confirm_query($result);
                $users = mysqli_fetch_assoc($result);
                //$users=mysqli_fetch_assoc($result);
                $u_id=$users['u_id'];
                $username=$users['username'];
                $mobile=$users['mobile'];
                $email=$users['email'];
                $gender=$users['gender'];
                $balance=$users['balance'];
                ?>
                <div class="info_userid">
                    <p><?php echo $u_id." : " ?>
                </div>
                <div class="info_user">
                    <?php echo "Username : ".$username."<br>"; ?>
                    <?php echo "Gender : ".$gender."<br>"; ?>
                    <?php echo "Mobile : ".$mobile."<br>"; ?>
                    <?php echo "Email : ".$email."<br>"; ?>
                    <?php echo "Card Balance : ".$balance."<br>"; ?>
                    </p>
                </div>
                <hr>
            </div>
            <?php
        }
        ?>
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