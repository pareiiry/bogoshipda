<?php
include ('../../dbConnect.php');
$orderID=$_POST['orderID'];
$dateTime = date('Y-m-d H:i:s');
$sql="UPDATE order_table SET orderStatus='cancel' WHERE orderID='$orderID'";
$sql_query=mysqli_query($con,$sql);

if($sql_query) {
    echo "<script type='text/javascript'>alert('ยกเลิกการชำระเงินเรียบร้อยแล้ว')</script>";
    echo "<meta http-equiv ='refresh'content='0;URL=../payment.php'>";
}else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการยกเลิกการชำระเงิน');window.history.go(-1);</script>" ;
}
