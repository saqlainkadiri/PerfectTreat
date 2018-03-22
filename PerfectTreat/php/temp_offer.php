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
                  window.location = 'login.php'; </script>";
}
?>
<?php
if(($_GET["month"]>0 && $_GET["month"]<3) || ($_GET["month"]>10 && $_GET["month"]<13)){
    redirect_to("../html/offer_winter.html");
}
elseif($_GET["month"]>2 && $_GET["month"]<7){
    redirect_to("../html/offer_summer.html");
}
elseif($_GET["month"]>6 && $_GET["month"]<11){
    redirect_to("../html/offer_rainy.html");
}
?>
