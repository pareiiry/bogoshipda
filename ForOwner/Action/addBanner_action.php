<?php
session_start();

include ('../../dbConnect.php');

for ($i = 0; $i < count($_FILES['filesToUploadBanner']['name']); $i++) {
    if($_FILES['filesToUploadBanner']['size'][$i] !== 0) {
        //$image = addslashes(file_get_contents($_FILES['filesToUploadBanner']['tmp_name'][$i]));
        $filename = 'banner_img/banner_' . md5(uniqid(rand(), true)) . '.png';
        move_uploaded_file($_FILES['filesToUploadBanner']['tmp_name'][$i], '../../' . $filename);

        $sql2 = "INSERT INTO banner (bID,bType,bImgPath)VALUES('','Header','$filename')";//คำสั่งเพิ่มข้อมูล
        $sql_query2 = mysqli_query($con, $sql2);
        if($sql_query2) {
            echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv ='refresh'content='0;URL=../banner.php'>";
        }else{
            echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');window.history.go(-1);</script>" ;
        }
    }
    else{
        echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');window.history.go(-1);</script>" ;
    }
}



$con->close()
?>