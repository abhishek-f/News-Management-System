<?php
include "config.php";
if(empty($_FILES['new-image']['name'])){
    $file_name = $_POST["old-image"];
}else{
        $errors = array();
    
        $file_name = $_FILES["new-image"]["name"];
        $file_size = $_FILES["new-image"]["size"];
        $file_tmp = $_FILES["new-image"]["tmp_name"];
        $file_type = $_FILES["new-image"]["type"];
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

$sql = "UPDATE post SET title='{$_POST["post_title"]}',description='{$_POST["postdesc"]}',category={$_POST["category"]},post_img='{$file_name}' WHERE post_id={$_POST["post_id"]}";
// die;
$result = mysqli_query($conn,$sql);
if($result){
    header("location:http://localhost/news management/admin/post.php");
}else{
    echo "query failed...";
}
?>