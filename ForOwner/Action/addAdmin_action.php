<?php
session_start();
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
//$status=$_POST['status'];

include ('../../dbConnect.php');

$sql="INSERT INTO usertable (uID,name,email,password,address,phone_number,gender,dob,status)VALUES('','$name','$email','$password','-','-','None','','admin')";//คำสั่งเพิ่มข้อมูล
$sql_query=mysqli_query($con,$sql);
if($sql_query) {
    echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<meta http-equiv ='refresh'content='0;URL=../manageMember.php'>";
}else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');window.history.go(-1);</script>" ;
}

mysqli_close();

?>