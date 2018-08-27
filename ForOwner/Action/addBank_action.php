<?php
session_start();
$bankName=$_POST['bankName'];
$accountName=$_POST['accountName'];
$accountNumber=$_POST['accountNumber'];


//$filesToUpload=$_POST['filesToUpload'];
//$status=$_POST['status'];

include ('../../dbConnect.php');

$sql="INSERT INTO bank (bankID,bankName,accountName,accountNumber)VALUES('','$bankName','$accountName','$accountNumber')";//คำสั่งเพิ่มข้อมูล
$sql_query=mysqli_query($con,$sql);



if($sql_query) {
    echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<meta http-equiv ='refresh'content='0;URL=../bank.php'>";
}else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');window.history.go(-1);</script>" ;
}

//mysqli_close();

?>