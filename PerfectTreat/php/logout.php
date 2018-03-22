<?php
    session_start();
    session_unset();
    session_destroy();
    if(!isset($_SESSION['u_id'])){
        redirect_to("../html/login.html");
    }else{
        redirect_to("logout.php");
    }
?>
<?php
function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit();
}
?>