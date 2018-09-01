<?php
include ('../../dbConnect.php');

$sql = "DELETE FROM image WHERE image.imgID = '".$_GET['imgID']."'";
//$query = mysqli_query($con,$sql2);
if ($con->query($sql) === TRUE) {
    echo "<script type='text/javascript'>alert('ลบข้อมูลเรียบร้อยแล้ว');window.history.go(-1);</script>" ;
}
else {
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการลบข้อมูล');window.history.go(-1);</script>" ;
}


$con->close();