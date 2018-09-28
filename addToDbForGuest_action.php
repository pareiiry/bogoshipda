<?php
session_start();
include ('dbConnect.php');
$gpdID = uniqid();

$nameShip=$_POST['nameShip'];
$addressShip=$_POST['addressShip'];
$telShip=$_POST['telShip'];
$msgShip=$_POST['msgShip'];
$shipPrice=$_POST['shipPrice'];
if($_POST['codeID']==null || $_POST['codeID'] == ""){
    $codeID=null;
}
else{
    $codeID=$_POST['codeID'];
}

$discount =$_POST['dc'];
$dateTime = date("Y-m-d H:i:s");
$howShip=$_POST['ship'];


$total = 0;
$sumQuantity=0;
$sumCost=0;
if(!empty($_SESSION["shopping_cart"]))
{
    foreach($_SESSION["shopping_cart"] as $keys => $values)
    {
        if($values["pdID"]!==null) {
            $pdID = $values["pdID"];
            $priceAmount = $values["quantity"] * $values["price"];
            $sqlcost = "SELECT * FROM product WHERE product.pdID='" . $values["pdID"] . "'";
            $resultcost = mysqli_query($con, $sqlcost);
            $rowcost = mysqli_fetch_array($resultcost, MYSQLI_ASSOC);
            $costAmount = $values["quantity"] * $rowcost['cost'];
            $quantity = $values["quantity"];
            $total = $total + ($values["quantity"] * $values["price"]);
            $sumQuantity = $sumQuantity + $values["quantity"];
            $sumCost = $sumCost + $rowcost['cost'];

            $sqlapd = "INSERT INTO groupproduct (ID,productID,costAmount,priceAmount,amount,gpdID)VALUES('','$pdID','$costAmount','$priceAmount','$quantity','$gpdID')";//คำสั่งเพิ่มข้อมูล
            $sql_queryapd = mysqli_query($con, $sqlapd);

        }

    }
        $netPrice=number_format((($total-$discount)+$shipPrice), 0,'.', '');
        echo $netPrice;
        $sqlaod="INSERT INTO order_table (orderID,uID,gpdID,allAmount,priceAmount,codeID,shipPrice,howShip,netPrice,dateTime,nameShip,addressShip,telShip,msgShip)VALUES('',NULL,'$gpdID','$sumQuantity','$total','$codeID','$shipPrice','$howShip','$netPrice','$dateTime','$nameShip','$addressShip','$telShip','$msgShip')";//คำสั่งเพิ่มข้อมูล
        $sql_queryaod = mysqli_query($con,$sqlaod);

      //  echo $netPrice.$total.$dateTime.$sumCost.$sumQuantity.$telShip.$codeID;
        if($sql_queryaod) {
            foreach($_SESSION["shopping_cart"] as $keys => $values) {
                unset($_SESSION["shopping_cart"][$keys]);
            }
            echo "<script type='text/javascript'>alert('สั่งซื้อสินค้าเรียบร้อยแล้ว')</script>";
            echo "<meta http-equiv ='refresh'content='0;URL=index.php'>"; //ส่งไปหน้า การโอนเงิน!!!!!!!!!!!!!!!!!!!!
        }else{
            echo "<script type='text/javascript'>alert('เกิดข้อผิดพลาดในการสั่งซื้อสินค้า')</script>";
            echo "<meta http-equiv ='refresh'content='0;URL=cart.php'>";
        }

}

$con->close();