<?php
    function redirect_to($new_location) {
        header("Location: " . $new_location);
        exit();
    }
?>
<?php
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
require 'db_connection.php';
if (isset($_POST['submit'])) {
    $query = "SELECT * FROM admin WHERE adminname LIKE '".$_POST['adminname']."'";
    $result = mysqli_query($connection,$query);
    $admin = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($admin["adminname"] == $_POST["adminname"] && password_check($_POST["password"],$admin["hashed_password"])){
        echo "<script>alert('Login Successful !');</script>";
        session_start();
        $_SESSION["a_id"] = $admin["a_id"];
        redirect_to("admin_home.php");
    }
}
?>
