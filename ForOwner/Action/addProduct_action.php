<?php
session_start();
$name=$_POST['name'];
$price=$_POST['price'];
$cost=$_POST['cost'];
$description=$_POST['description'];
$pdID = uniqid();

$filesToUpload=$_POST['filesToUpload'];

include ('../../dbConnect.php');

$sql="INSERT INTO product (pdID,name,description,price,cost)VALUES('$pdID','$name','$description','$price','$cost')";//คำสั่งเพิ่มข้อมูล
$sql_query=mysqli_query($con,$sql);

for ($i=0; $i<count($_FILES['filesToUpload']['name']); $i++) {
    $image = addslashes(file_get_contents($_FILES['filesToUpload']['tmp_name'][$i]));
    $sql2 = "INSERT INTO image (imgID,img,pdID)VALUES('','$image','$pdID')";//คำสั่งเพิ่มข้อมูล
    $sql_query2 = mysqli_query($con, $sql2);
}

if($sql_query) {
    echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<meta http-equiv ='refresh'content='0;URL=../indexForOwner.php'>";
}else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');window.history.go(-1);</script>" ;
}

$con->close()
?>