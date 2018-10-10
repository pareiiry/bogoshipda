<?php
include ('../../dbConnect.php');
$pdID =$_POST['pdID'];
for ($i=0; $i<count($_FILES['filesToUpload']['name']); $i++){
    $ar = array();
    foreach (array_keys($_FILES['filesToUpload']) as $arr){
        $ar[$arr] = $_FILES['filesToUpload'][$arr][$i];
    }
    if($_FILES['filesToUpload']['size'][$i] !== 0) {
    echo $_FILES['filesToUpload']['tmp_name'][$i];echo "<br>";

    $image = addslashes(file_get_contents($_FILES['filesToUpload']['tmp_name'][$i]));
    $query = "INSERT INTO image (imgID,img,pdID) VALUES('','$image','$pdID')";
    $sql_query = mysqli_query($con, $query);

    if($sql_query) {
        echo "<script type='text/javascript'>alert('บันทึกรูปภาพเรียบร้อยแล้ว');window.history.go(-1);</script>" ;
    }else{
        echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกรูปภาพ');window.history.go(-1);</script>" ;
    }
    }
    else{
        echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกรูปภาพ');window.history.go(-1);</script>" ;
    }

}

