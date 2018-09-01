<?php
session_start();
$name=$_POST['name'];
$price=$_POST['price'];
$cost=$_POST['cost'];
$description=$_POST['description'];
$pdID =$_POST['pdID'];
$color=$_POST['color'];

include ('../../dbConnect.php');
$sql="UPDATE product SET name='$name',price='$price',cost='$cost',color='$color',description='$description' WHERE pdID='$pdID'";

if($con->query($sql) === TRUE) {
    echo "<script type='text/javascript'>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');window.history.go(-1);</script>" ;
}else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการแก้ไขข้อมูล');window.history.go(-1);</script>" ;
}

$con->close();

?>