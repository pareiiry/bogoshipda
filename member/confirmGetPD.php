<?php
include ('../dbConnect.php');
$orderID=$_GET['orderID'];
//date_default_timezone_set("Asia/Bangkok");
//$dateTime = date('Y-m-d H:i:s');

$sql="UPDATE order_table SET orderStatus='get product' WHERE orderID='$orderID'";
$sql_query=mysqli_query($con,$sql);

if($sql_query) {
    echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อยแล้ว');location.replace(document.referrer);</script>";
}else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');window.history.go(-1);</script>" ;
}
