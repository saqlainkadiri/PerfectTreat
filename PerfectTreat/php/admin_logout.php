<?php
session_start();
session_unset();
session_destroy();
if(!isset($_SESSION['a_id'])){
    redirect_to("../html/perfect_admin.html");
}else{
    redirect_to("admin_logout.php");
}
?>
<?php
function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit();
}
?>