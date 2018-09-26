<?php
include ('../../dbConnect.php');

$sql3 = "SELECT * FROM image WHERE image.pdID='".$_GET['pdID']."'";
$result3 = mysqli_query($con,$sql3);
//$row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);
//print_r($result3);
while($row3= mysqli_fetch_assoc($result3))// show the information from query
{
   // echo $row3['imgID'];
//    $sql = "DELETE FROM image WHERE image.imgID = '".$row3['imgID']."'";
//    $query = mysqli_query($con,$sql);
    $sql ="UPDATE image SET image.delete=1 WHERE image.imgID = '".$row3['imgID']."'";
    $query = mysqli_query($con,$sql);
}

//$sql2 = "DELETE FROM product WHERE product.pdID = '".$_GET['pdID']."'";
$sql2 ="UPDATE product SET product.delete=1 WHERE product.pdID = '".$_GET['pdID']."'";
//$query = mysqli_query($con,$sql2);
    if ($con->query($sql2) === TRUE) {
        echo "<script type='text/javascript'>alert('ลบข้อมูลเรียบร้อยแล้ว')</script>";
        echo "<meta http-equiv ='refresh'content='0;URL=../indexForOwner.php'>";
    }
    else {
        echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการลบข้อมูล');window.history.go(-1);</script>" ;
    }


$con->close();