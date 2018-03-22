<?php
function redirect_to($new_location) {
    header("Location: " . $new_location);
    exit();
}
?>
<?php
function password_encrypt($password){
    $hash_format="$2y$10$";//tells PHP to use Blowfish with a "cost" of 10
    $salt_length="22";//Blowfish salts should be 22 characters or more
    $salt=generate_salt($salt_length);
    $format_and_salt=$hash_format . $salt;
    $hash=crypt($password,$format_and_salt);
    return $hash;
}
function generate_salt($length){
    //not 100% unique,not 100% random,but good enough for a salt
    //MD5 returns 32 characters
    $unique_random_string=md5(uniqid(mt_rand(),true));
    //Valid characters for a salt are[a-zA-Z0-9./]
    $base64_string=base64_encode($unique_random_string);
    //But not '+' which is valid in base_64 encoding
    $modified_base64_string=str_replace('+','.',$base64_string);
    //truncate string to the correct length
    $salt=substr($modified_base64_string,0,$length);
    return $salt;
}
?>
<?php require_once("db_connection.php");
if (isset($_POST["validateadmin"]) && $_POST["validateadmin"] == "yes") {
    $query = "SELECT * FROM admin WHERE adminname LIKE '".$_POST["adminname"]."'";
    $res = mysqli_query($connection,$query);
    if(mysqli_num_rows($res) > 0){
        echo "success";
    }
    exit;
}
if (isset($_POST['submit'])) {
    newAdmin($connection);
}
function newAdmin($connection) {
    $adminname = $_POST['adminname'];
    $hashed_password = password_encrypt($_POST['password']);
    $query = "INSERT INTO `admin` (`adminname`,`hashed_password`) VALUES ('$adminname','$hashed_password')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "<script>alert('Successfully Signed Up !');
                  window.location = 'perfect_admin.php'; </script>";

    }
    else {
        alert("error");
        redirect_to("perfect_adminsignup.php");
    }
}
?>
