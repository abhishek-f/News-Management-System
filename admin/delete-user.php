<?php
include "config.php";
$id = $_GET["id"];
$sql = "DELETE FROM user WHERE `user_id`='$id'";
if(mysqli_query($conn,$sql)){
    header("location:http://localhost/news management/admin/users.php");
}else{
    echo "<p style='color:red; text-align:center; margin:10px 0;'>Can\'t delete the user record...</p>";
}
?>