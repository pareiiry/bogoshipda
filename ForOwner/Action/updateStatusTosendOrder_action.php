<?php
include ('../../dbConnect.php');
$orderID=$_POST['orderID'];
$paymentID=$_POST['paymentID'];
$dateTime = date('Y-m-d H:i:s');
$sql="UPDATE order_table SET orderStatus='prepare to send order' WHERE orderID='$orderID'";
$sql_query=mysqli_query($con,$sql);
$sql2="UPDATE payment SET checked='1',dateVerifyPayment='$dateTime' WHERE paymentID='$paymentID'";
$sql_query2=mysqli_query($con,$sql2);

    if($sql_query2) {
        echo "<script type='text/javascript'>alert('ยืนยันการชำระเงินเรียบร้อยแล้ว')";
        echo "<meta http-equiv ='refresh'content='0;URL=../payment.php'>";
    }else{
        echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกการยืนยันการชำระเงิน');window.history.go(-1);</script>" ;
    }
