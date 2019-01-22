<?php
include ('../../dbConnect.php');
$orderID=$_GET['orderID'];
date_default_timezone_set("Asia/Bangkok");
$dateTime = date('Y-m-d H:i:s');
$sql="UPDATE order_table SET orderStatus='cancel' WHERE orderID='$orderID'";
$sql_query=mysqli_query($con,$sql);

$sql2="UPDATE payment SET dateVerifyPayment='$dateTime' WHERE orderID='$orderID'";
$sql_query2=mysqli_query($con,$sql2);

if($sql_query2) {
    echo "<script type='text/javascript'>alert('ยกเลิกการชำระเงินเรียบร้อยแล้ว');location.replace(document.referrer);</script>";
}else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการยกเลิกการชำระเงิน');window.history.go(-1);</script>" ;
}
