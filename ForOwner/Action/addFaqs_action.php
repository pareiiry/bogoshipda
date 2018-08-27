<?php
session_start();

$question=$_POST['question'];
$answer=$_POST['answer'];


include ('../../dbConnect.php');

$sql="INSERT INTO faqs (faqsID,question,answer)VALUES('','$question','$answer')";//คำสั่งเพิ่มข้อมูล
$sql_query=mysqli_query($con,$sql);



if($sql_query) {
    echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
    echo "<meta http-equiv ='refresh'content='0;URL=../faqs.php'>";
}else{
    echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');window.history.go(-1);</script>" ;
}

//mysqli_close();

?>