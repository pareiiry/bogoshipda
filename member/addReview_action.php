<?php
session_start();
$score=$_POST['score'];
$comment=$_POST['comment'];
$uID=$_POST['uID'];

include ('../dbConnect.php');
date_default_timezone_set("Asia/Bangkok");
$dateTime = date('Y-m-d H:i:s');

if($score != 0) {
    if ($_FILES['filesToUpload']['size'] !== 0) {
//$filesToUpload=$_POST['filesToUpload'];
        for ($i = 0; $i < count($_FILES['filesToUpload']['name']); $i++) {

            if($_FILES['filesToUpload']['size'][$i] !== 0) {
                $filename = 'review_img/review_' . md5(uniqid(rand(), true)) . '.png';
                move_uploaded_file($_FILES['filesToUpload']['tmp_name'][$i], '../' . $filename);


//            $image = addslashes(file_get_contents($_FILES['filesToUpload']['tmp_name'][$i]));
            $sql = "INSERT INTO review (reviewID,uID,imgReviewPath,score,comment,dateTime)VALUES('','$uID','$filename','$score','$comment','$dateTime')";//คำสั่งเพิ่มข้อมูล
            $sql_query = mysqli_query($con, $sql);
            }
        }
        if ($sql_query) {
            echo "<script type='text/javascript'>alert('บันทึกการรีวิวเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv ='refresh'content='0;URL=myreview.php'>";
        } else {
            echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการบันทึกการรีวิว');window.history.go(-1);</script>";
        }

    }
    $con->close();
}
else{
    echo "<script type='text/javascript'>alert('โปรดระบุคะแนนสินค้า')</script>";
    echo "<meta http-equiv ='refresh'content='0;URL=addReview.php'>";
}


?>