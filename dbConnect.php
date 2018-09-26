<?php
//phpinfo();

$host ="localhost";//ชื่อโฮส
$user ="root";//ชื่อผู้ใช้
$pass ="";//รหัสผ่าน
$db ="bogoshipdadb";//ชื่อฐานข้อมูลที่เราสร้างไว้

//$con = mysqli_connect($host,$user,$pass,$db);
$con = @mysqli_connect($host,$user,$pass,$db);

if (!$con) {
    echo "Error: " . mysqli_connect_error();
    exit();
}

?>