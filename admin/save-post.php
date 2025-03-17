<?php
include "config.php";

if($_FILES["fileToUpload"]){
    $errors = array();

    $file_name = $_FILES["fileToUpload"]["name"];
    $file_size = $_FILES["fileToUpload"]["size"];
    $file_tmp = $_FILES["fileToUpload"]["tmp_name"];
    $file_type = $_FILES["fileToUpload"]["type"];
    $file_parts = explode('.', $file_name);
    $file_ext = strtolower(end($file_parts));
    $extensions = array("jpeg","jpg","png");

    if(in_array($file_ext,$extensions)== false){
        $errors[] = "this extension file not allowed, please choose a jpg or png file";
    }
    if($file_size > 2097152){
        $errors[] = "file size must be 2 mb or lower";
    }
    if(empty($errors)== true){
        move_uploaded_file($file_tmp,"upload/".$file_name);
    }else{
        print_r($errors);
        die();
    }

}
session_start();
$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$postdesc = mysqli_real_escape_string($conn, $_POST['postdesc']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$date = date("d M, Y");
$author = $_SESSION["user_id"];

echo $sql = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUES('$title','$postdesc',$category,'$date',$author,'$file_name');";
$sql .="UPDATE category SET post = post +1 WHERE category_id='$category'";
if(mysqli_multi_query($conn,$sql)){
    header("location:http://localhost/news management/admin/post.php");
}else{
    echo "<div class='alert alert-danger'>query failed.</div>";
}
?>
