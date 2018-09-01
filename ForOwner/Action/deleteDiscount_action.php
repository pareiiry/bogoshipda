<?php
include ('../../dbConnect.php');

$sql = "DELETE FROM code WHERE code.codeID = '".$_GET['codeID']."'";
//$query = mysqli_query($con,$sql2);
if ($con->query($sql) === TRUE) {
    echo "<script type='text/javascript'>alert('ลบข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<meta http-equiv ='refresh'content='0;URL=../discount.php'>";
}
else {
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการลบข้อมูล');window.history.go(-1);</script>" ;
}


$con->close();