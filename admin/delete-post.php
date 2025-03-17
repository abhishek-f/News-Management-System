<?php
include "config.php";
$post_id = $_GET["id"];

$sql1 = "SELECT * FROM post WHERE post_id='$post_id';";
$result = mysqli_query($conn,$sql1) or die("query failed...");
$row = mysqli_fetch_assoc($result);

unlink("upload/".$row["post_img"]);

$cate_id = $_GET["catid"];


$sql = "DELETE FROM post WHERE post_id='$post_id';";
$sql .= "UPDATE category SET post = post-1 WHERE category_id = '$cate_id'";

if(mysqli_multi_query($conn,$sql)){
    header("location:http://localhost/news management/admin/post.php");
}else{
    echo "query failed...";
}
?>