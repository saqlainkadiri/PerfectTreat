<?php
require 'db_connection.php';
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
<html>
<head>
    <meta charset="utf-8" />
    <title>View Rating-Admin</title>
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
        <br/>
        <h3 align="center">User Ratings</h3>
        <hr>
        <?php
        $factors=array();
        $query = "SELECT * FROM rating";
        $result = mysqli_query($connection,$query);
        while($row=mysqli_fetch_assoc($result)){
            $factors[]=array(
                'id'  =>  $row['r_id'],
                'title' =>  $row['title'],
                'rating'  => ($row['rating_count']!=0) ? $row['rating_total']/$row['rating_count'] : 0
            );
        }
        foreach ($factors as $factor){
            ?>
            <div class="factor" align="center">
                <?php echo $factor['title']." = "; ?>  <?php echo number_format($factor['rating'],2); ?>
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

