<?php
include("dbConnect.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $sql = "SELECT * FROM user WHERE email = '$email' and password = '$password'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $status = $row['usertype'];
    $count = mysqli_num_rows($result);

    // If result matched $myusername and $mypassword, table row must be 1 row

    if($count == 1) {

        $_SESSION["ID"] = $row["uID"];
        $_SESSION["usertype"] = $row["usertype"];

        session_write_close();

        if($status== "member")
        {
            header("location:indexMember.php");
        }
        else
        {
            header("location:ForOwner/indexForOwner.php");
        }
    }else {
        //header("location:loginPage.php");
        echo "<script>alert('อีเมลล์ หรือ รหัสผ่าน ไม่ถูกต้อง');window.history.go(-1);</script>" ;
    }
}
?>