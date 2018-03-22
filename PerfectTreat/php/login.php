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
    $query = "SELECT * FROM users WHERE username LIKE '".$_POST['username']."'";
    $result = mysqli_query($connection,$query);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if($user["username"] == $_POST["username"] && password_check($_POST["password"],$user["hashed_password"])){
        echo "<script>alert('Login Successful !');</script>";
        session_start();
        $_SESSION["u_id"] = $user["u_id"];
        redirect_to("sweets.php");
    }
}
?>

