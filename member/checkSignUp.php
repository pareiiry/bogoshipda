<?php
session_start() ;
$_SESSION['post']=$_POST;
$_SESSION['error']="";
$email=$_POST['email'];//ตั้งค่าตัวแปล
$password=$_POST['password'];
$name=$_POST['name'];
$dob=$_POST['dob'];
$gender=$_POST['gender'];
$phone_number=$_POST['phone_number'];
$address=$_POST['address'];


include ("dbConnect.php");
$sql="INSERT INTO user (uID,name,email,password,address,phone_number,gender,dob,usertype)VALUES('','$name','$email','$password','$address','$phone_number','$gender','$dob','member')";
//$sql_query=mysqli_query($sql);
$con->query($sql);

if($con) {
    echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<meta http-equiv ='refresh'content='0;URL=loginPage.php'>";
    $_SESSION['post']="";
}else{
    echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');window.history.go(-1);</script>" ;
}

$con->close();

?>