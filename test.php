<?php
session_start();
if($_SESSION['ID'] == "")
{
    //echo "Please Login!";
    header("location:loginPage.php");
    exit();
}
if($_SESSION['Status'] != "owner" && $_SESSION['Status'] != "admin")
{
    //echo "ของ Adminเท่านั้นจ้าาา";
    exit();
}

include ('../bogoshipda/dbConnect.php');
$sql = "SELECT * FROM usertable WHERE uID = '".$_SESSION['ID']."' ";
//$objQuery = mysqli_query($strSQL);
//$objResult = mysqli_fetch_array($objQuery);
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$sql2 = "SELECT * FROM producttable";

$result2 = mysqli_query($sql2);
$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);


		echo $row2['pdID'],"<br>";
		echo $row2['pdName'],"<br>";
		echo $row2['price'],"<br>";
		echo "<hr>";
	
	

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
	<style>
	.block {
		border: 1px; color: #F69; 
	}
	.product-img {
		width: 100px;
		height: 100px;
	}
	</style>
</head>

<body>
	

</body>
</html>