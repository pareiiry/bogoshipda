<?php
session_start();
$dateCreate=$_POST['dateCreate'];
$dateDelete=$_POST['dateDelete'];
$codeText=$_POST['codeText'];
$discount=$_POST['discount'];
$unitDiscount=$_POST['unitDiscount'];
//$status=$_POST['status'];

include ('../../dbConnect.php');

$sql="INSERT INTO code (codeID,codeText,discount,unitDiscount,dateCreate,dateDelete,active)VALUES('','$codeText','$discount','$unitDiscount','$dateCreate','$dateDelete',1)";//คำสั่งเพิ่มข้อมูล
$sql_query=mysqli_query($con,$sql);
if($sql_query) {
    echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<meta http-equiv ='refresh'content='0;URL=../discount.php'>";
}else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');window.history.go(-1);</script>" ;
}

$con->close()

?>