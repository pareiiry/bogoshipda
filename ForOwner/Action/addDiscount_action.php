<?php
session_start();
$dateCreate=$_POST['dateCreate'];
$dateDelete=$_POST['dateDelete'];
$codeText=$_POST['codeText'];
$discount=$_POST['discount'];
$unitDiscount=$_POST['unitDiscount'];
//$status=$_POST['status'];

include ('../../dbConnect.php');
if($dateCreate<=$dateDelete){
    $sqlCheckCode = "SELECT * FROM code WHERE codeText='".$codeText."'";
    $resultCheckCode = mysqli_query($con,$sqlCheckCode);
    $checkCode = mysqli_num_rows($resultCheckCode);
    if($checkCode=0){
        $sql="INSERT INTO code (codeID,codeText,discount,unitDiscount,dateCreate,dateDelete,active)VALUES('','$codeText','$discount','$unitDiscount','$dateCreate','$dateDelete',1)";//คำสั่งเพิ่มข้อมูล
        $sql_query=mysqli_query($con,$sql);
        if($sql_query) {
            echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv ='refresh'content='0;URL=../discount.php'>";
        }else{
            echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');window.history.go(-1);</script>" ;
        }
    }
    else{
        echo "<script type='text/javascript'>alert('รหัสส่วนลดถูกใช้ไปแล้ว กรุณาระบุรหัสใหม่อีกครั้ง');window.history.go(-1);</script>" ;
    }



}
else{
    echo "<script type='text/javascript'>alert('ไม่สามารถเพิ่มส่วนลดได้เนื่องจากวันที่สร้างมากกว่าวันที่สิ้นสุด กรุณาแก้ไขแล้วทำรายการใหม่อีกครั้ง');window.history.go(-1);</script>" ;
}
$con->close()

?>