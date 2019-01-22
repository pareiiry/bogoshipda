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

$age = date_diff(date_create($dob), date_create('now'))->y;

if($age>=13) {
    include("../dbConnect.php");
    $sql = "UPDATE user SET name='$name',password='$password',address='$address',phone_number='$phone_number',gender='$gender',dob='$dob'  WHERE email='$email'";

    $sql_query = mysqli_query($con, $sql);

    if ($sql_query) {
        echo "<script type='text/javascript'>alert('แก้ไขข้อมูลส่วนตัวเรียบร้อยแล้ว');location.replace(document.referrer);</script>";
    } else {
        echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการแก้ไขข้อมูลส่วนตัว');window.history.go(-1);</script>";
    }
}
else{
    echo "<script>alert('เกิดข้อผิดพลาด โปรดตรวจสอบอายุที่ระบุต้องมากกว่า 13ปี');window.history.go(-1);</script>";
}

?>