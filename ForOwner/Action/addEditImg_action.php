<?php
include ('../../dbConnect.php');
$pdID =$_POST['pdID'];
for ($i=0; $i<count($_FILES['filesToUpload']['name']); $i++) {

    if ($_FILES['filesToUpload']['size'][$i] !== 0) {
        $filename = 'product_img/product_' . md5(uniqid(rand(), true)) . '.png';
        move_uploaded_file($_FILES['filesToUpload']['tmp_name'][$i], '../../' . $filename);

        $sql = "INSERT INTO image (imgID,pdImgPath,pdID)VALUES('','$filename','$pdID')";//คำสั่งเพิ่มข้อมูล
        $sql_query = mysqli_query($con, $sql);
    }
}

    if($sql_query) {
        echo "<script type='text/javascript'>alert('บันทึกรูปภาพเรียบร้อยแล้ว');window.history.go(-1);</script>" ;
    }else {
        echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกรูปภาพ');window.history.go(-1);</script>";
    }

