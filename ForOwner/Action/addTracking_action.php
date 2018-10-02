<?php
include ('../../dbConnect.php');
$orderID=$_POST['orderID'];
$trackingNumber = $_POST['trackingNumber'];

$dateTime = date('Y-m-d H:i:s');

$sql="UPDATE order_table SET orderStatus='sent order',trackingNumber='$trackingNumber',dateTimeSendProduct='$dateTime' WHERE orderID='$orderID'";
$sql_query=mysqli_query($con,$sql);


if($sql_query) {
    echo "<script type='text/javascript'>alert('ยืนยันการจัดส่งสินค้าเรียบร้อยแล้ว');location.replace(document.referrer);</script>";
}else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกการัดส่งสินค้า');window.history.go(-1);</script>" ;
}
