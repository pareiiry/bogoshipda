<?php
session_start();
$uID=$_POST['uID'];
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];


include ('../../dbConnect.php');

$sql="UPDATE user SET name='$name',email='$email',password='$password' WHERE uID = $uID";
//$sql_query2=mysqli_query($con,$sql2);


if($con->query($sql) === TRUE) {
    echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<meta http-equiv ='refresh'content='0;URL=../manageMember.php'>";
}else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');window.history.go(-1);</script>" ;
}

$con->close();

?>