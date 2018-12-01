<?php
include ('../dbConnect.php');
$orderID=$_POST['orderID'];
$bankID=$_POST['bankName'];
$pricePayInput= $_POST['pricePay'];
$time= $_POST['time'];
$date= $_POST['date'];

//if($_FILES['filesToUpload']['size'] !== 0) {

    for ($i = 0; $i < count($_FILES['filesToUploadPay']['name']); $i++) {
        date_default_timezone_set("Asia/Bangkok");
        $dateTime = date('Y-m-d H:i:s');
        //$image = addslashes(file_get_contents($_FILES['filesToUploadPay']['tmp_name'][$i]));

        $filename = 'slip_img/slip_' . md5(uniqid(rand(), true)) . '.png';
        move_uploaded_file($_FILES['filesToUploadPay']['tmp_name'][$i], '../' . $filename);

        $sql="INSERT INTO payment (paymentID,orderID,bankID,date,time,slipImgPath,pricePayInput,dateCreate,checked)VALUES('','$orderID','$bankID','$date','$time','$filename','$pricePayInput','$dateTime','0')";
        $sql_query=mysqli_query($con,$sql);
     //print_r($image);
    }
    if($sql_query) {
        $sql2="UPDATE order_table SET orderStatus='waiting for verify' WHERE orderID='$orderID'";
        $sql_query2=mysqli_query($con,$sql2);
        echo "<script type='text/javascript'>alert('บันทึกข้อมูลเรียบร้อยแล้ว')</script>";
        echo "<meta http-equiv ='refresh'content='0;URL=history.php'>";
    }else{
        echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');window.history.go(-1);</script>" ;
    }
//}