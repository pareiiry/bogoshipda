<?php
session_start();
if($_SESSION['ID'] == "")
{
    //echo "Please Login!";
    header("location:../loginPage.php");
    exit();
}
if($_SESSION['usertype'] != "owner" && $_SESSION['usertype'] != "admin")
{
    //echo "ของ Adminเท่านั้นจ้าาา";
    exit();
}
include ('../dbConnect.php');
$sql = "SELECT * FROM user WHERE uID = '".$_SESSION['ID']."' ";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$sqlOrder = "SELECT * FROM order_table WHERE orderID='".$_GET['orderID']."'";
$resultOrder = mysqli_query($con,$sqlOrder);
$rowOrder  = mysqli_fetch_array($resultOrder ,MYSQLI_ASSOC);
if($rowOrder['orderStatus']=='waiting for payment'){
    $orderStatus = "รอชำระเงิน";
}
else if($rowOrder['orderStatus']=='waiting for verify'){
    $orderStatus = "รอตรวจสอบ";
}
else if($rowOrder['orderStatus']=='prepare to send order'){
    $orderStatus = "เตรียมจัดส่ง";
}
else if($rowOrder['orderStatus']=='sent order'){
    $orderStatus = "จัดส่งแล้ว";
}
else if($rowOrder['orderStatus']=='cancel'){
    $orderStatus = "การสั่งซื้อถูกยกเลิก";
}
if($rowOrder['howShip']=='Regis'){
    $howShip = "พัสดุลงทะเบียน";
}elseif ($rowOrder['howShip']=='Ems'){
    $howShip = "พัสดุด่วนพิเศษ (EMS)";
}elseif ($rowOrder['howShip']='Kerry'){
    $howShip = "Kerry Express";
}
$dateTime = date_format(date_create($rowOrder['dateTime']),'d-m-Y');

$sqlU = "SELECT * FROM user WHERE uID= '".$rowOrder['uID']."'";
$resultU = mysqli_query($con,$sqlU);
$rowU = mysqli_fetch_array($resultU,MYSQLI_ASSOC);


$sqlOrder2 = "SELECT * FROM order_table WHERE orderStatus='waiting for payment'";
$resultOrder2 = mysqli_query($con,$sqlOrder2);
$countNoti = mysqli_num_rows($resultOrder2);

$sqlOrder3 = "SELECT * FROM order_table WHERE orderStatus='waiting for verify'";
$resultOrder3 = mysqli_query($con,$sqlOrder3);
$countNotiPay = mysqli_num_rows($resultOrder3);

$sqlOrder4 = "SELECT * FROM order_table WHERE orderStatus='prepare to send order'";
$resultOrder4 = mysqli_query($con,$sqlOrder4);
$countNotiShipment = mysqli_num_rows($resultOrder4);

$sqlPay = "SELECT * FROM payment WHERE orderID='".$_GET['orderID']."'";
$resultPay = mysqli_query($con,$sqlPay);
$rowPay = mysqli_fetch_array($resultPay,MYSQLI_ASSOC);

$sqlBank = "SELECT * FROM bank WHERE bankID='".$rowPay['bankID']."'";
$resultBank = mysqli_query($con,$sqlBank);
$rowBank= mysqli_fetch_array($resultBank,MYSQLI_ASSOC);
$bank ="";
if($rowBank['bankName']=='SCB'){
    $bank ="ธนาคารไทยพาณิชย์ | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='KTB') {
    $bank ="ธนาคารกรุงไทย | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='BBL'){
    $bank ="ธนาคารกรุงเทพ | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='KBANK'){
    $bank ="ธนาคารกสิกร | ".$rowBank['accountNumber'];
}else if($rowBank['bankName']=='GSB'){
    $bank ="ธนาคารออมสิน | ".$rowBank['accountNumber'];
}  else if($rowBank['bankName']=='KRUNGSRI'){
    $bank ="ธนาคารกรุงศรีอยุธยา | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='TMB'){
    $bank ="ธนาคารทหารไทย | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='UOB'){
    $bank ="ธนาคารยูโอบี | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='TBANK') {
    $bank ="ธนาคารธนชาติ | ".$rowBank['accountNumber'];
}else if($rowBank['bankName']=='CIMB'){
    $bank ="ธนาคารซีไอเอ็มบี | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='CITIBANK'){
    $bank ="ซิตี้แบงค์ | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='SCBT'){
    $bank ="Standard Chartered | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='TISCO'){
    $bank ="ทิสโก้แบงค์ | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='Wallet') {
    $bank ="ทรูวอลเลท | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='PrompPay') {
    $bank ="พร้อมเพย์ | ".$rowBank['accountNumber'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bogoshipda Admin | รายละเอียดใบสั่งซื้อ</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/styleOwner.css">
    <link rel="icon" type="image/png" href="../images/icons/favicon.png"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>

        /* Set gray background color and 100% height */
        div.sticky{
            position: sticky;
            top:0;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height: auto;}
        }
       
        .navbar {
            margin-bottom: 0px;
        }

        * {
            box-sizing: border-box;
        }
        .fs-25{
            font-size: 16px;
        }
        th{
            color: #3FB8AF;
            padding-top: 15px;
            padding-bottom: 15px;
            text-align: center;
        }
        .menu-icons-noti {
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: red;
            color: white;
            font-family: Montserrat-Medium;
            font-size: 12px;
            position: absolute;
            top: -7px;
            right: 10px;
        }
    .orderinfo {
        font-size: 14px;

    }
        #myTable {
            border-collapse: collapse;
            width: 100%;
            border-top: 1px solid #ddd;
            font-size: 14px;
        }

        #myTable th, #myTable td {
            text-align: left;
            padding: 12px;
        }

        #myTable tr {
            border-bottom: 1px solid #ddd;
        }

        #myTable tr.header {
            background-color: #edf9f7;
            color: #00a9a3;
        }
        #myTable tr:hover {
            background-color: #edf9f7;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand" >Bogoshipda Admin</div>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="navbar-text">สวัสดี คุณ <?php echo "".$row["name"];?></li>
                <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> ออกจากระบบ</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="w3-sidebar w3-bar-block" style="width:25%;background-color:#4f4f4f;color: white;padding: 15px;" >
    <!--    <h3 class="w3-bar-item" style="background-color: #101010">Bogoshipda Admin</h3>-->
    <div class="container-fluid bg-3 text-center">
        <div class="row">
            <div class="col-sm-3">
                <!--                        <p>Some text..</p>-->
                <a href="indexForOwner.php" ><img class="bg-icon" src="../img/menu_bar_admin/product.png" style="width:100%; " alt="Image">สินค้า</a>
            </div>
            <div class="col-sm-3">
                <!--                        <p>Some text..</p>-->
                <a href="order.php"><img class="bg-icon-current" src="../img/menu_bar_admin/order.png" style="width:100%" alt="Image">สั่งซื้อ<span class="menu-icons-noti"><?php echo $countNoti;?></a>
            </div>
            <div class="col-sm-3">
                <!--                        <p>Some text..</p>-->
                <a href="payment.php"><img class="bg-icon" src="../img/menu_bar_admin/payment.png" style="width:100%" alt="Image">ชำระเงิน<span class="menu-icons-noti"><?php echo $countNotiPay;?></a>
            </div>
            <div class="col-sm-3">
                <!--                        <p>Some text..</p>-->
                <a href="shipping.php"><img class="bg-icon" src="../img/menu_bar_admin/shipment.png" style="width:100%" alt="Image">ขนส่ง<span class="menu-icons-noti"><?php echo $countNotiShipment;?></a>
            </div>
        </div>
    </div><br>
    <div class="container-fluid bg-3 text-center">
        <div class="row">
            <div class="col-sm-3">
                <!--                        <p>Some text..</p>-->
                <a href="manageMember.php"><img class="bg-icon" src="../img/menu_bar_admin/user.png" style="width:100%" alt="Image">สมาชิก</a>
            </div>
            <div class="col-sm-3">
                <!--                        <p>Some text..</p>-->
                <a href="discount.php"><img class="bg-icon" src="../img/menu_bar_admin/discount.png" style="width:100%" alt="Image">ส่วนลด</a>
            </div>
            <div class="col-sm-3">
                <!--                        <p>Some text..</p>-->
                <a href="bank.php"><img class="bg-icon" src="../img/menu_bar_admin/account.png" style="width:100%" alt="Image">บัญชี</a>
            </div>
            <div class="col-sm-3">
                <!--                        <p>Some text..</p>-->
                <a href="banner.php"><img class="bg-icon" src="../img/menu_bar_admin/news.png" style="width:100%" alt="Image">BANNER</a>
            </div>
        </div>
    </div><br>
    <div class="container-fluid bg-3 text-center">
        <div class="row">
            <div class="col-sm-3">
                <a href="statistic.php"><img class="bg-icon" src="../img/menu_bar_admin/statistic.png" style="width:100%" alt="Image">สถิติ</a>
            </div>
            <div class="col-sm-3">
                <a href="review.php"><img class="bg-icon" src="../img/menu_bar_admin/review.png" style="width:100%" alt="Image">รีวิว</a>
            </div>
        </div>
    </div><br>
</div>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sticky" style="font-size: 10px;background-color: #252525;">
            <h4 style="color: #c8c8c8;padding: 10px">Bogoshipda Admin</h4>
        </div>

        <div class="col-sm-9">
            <form method="post" action="Action/addProduct_action.php" enctype="multipart/form-data">
            <div class="row" style="margin-top: 5px">
                <div class="col-sm-4"><a href="javascript:history.back()" class="btn btn-info" role="button" style="margin-left: 2%;margin-top: 3%" >< กลับไปหน้ารายการสั่งซื้อทั้งหมด</a></div>
                <div class="col-sm-4" align="center"><h3><b>Order ID : <?php echo $rowOrder['orderID'];?></b></h3></div>

                <div class="col-sm-4 " align="right">

                </div>

<!--                <div class="col-sm-4"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหาสินค้า..." title="Type in a name" width="100%"></div>-->
            </div>

            <hr>

                <!--    col-left-->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading fs-25"><b>รายละเอียดการสั่งซื้อ</b></div>
                        <div class="panel-body" style="margin: 0% 2% 0% 2%">
<!--                            <form method="post">-->
                                <table class="orderinfo" width="100%">
                                    <tr>
                                        <td width="35%">สถานะ :</td>
                                        <td><?php echo $orderStatus;?></td>
                                    </tr>
                                    <tr>
                                        <td>สั่งเมื่อ :</td>
                                        <td><?php echo $dateTime ;?></td>
                                    </tr>
                                    <tr>
                                        <td>การจัดส่ง : </td>
                                        <td><?php  echo $howShip;?></td>
                                    </tr>
                                    <tr>
                                        <td>ข้อความถึงผู้ขาย : </td>
                                        <td><?php echo $rowOrder['msgShip'];?></td>
                                    </tr>
                                </table>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading fs-25"><b>รายละเอียดการจัดส่ง</b></div>
                        <div class="panel-body" style="margin: 0% 2% 0% 2%">
                            <!--                            <form method="post">-->
                            <table class="orderinfo" width="100%">
                                <tr>
                                    <td width="35%">รหัสพัสดุ : </td>
                                    <td><?php if($rowOrder['trackingNumber']!=NULL)echo $rowOrder['trackingNumber'];else echo "-"; ?></td>
                                </tr>
                                <tr>
                                    <td>จัดส่งเมื่อ : </td>
                                    <td><?php if($rowOrder['trackingNumber']!=NULL){ $dateTimeSendPd = date_format(date_create($rowOrder['dateTimeSendProduct']),'d-m-Y H:i:s'); echo $dateTimeSendPd;}else echo "-"; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading fs-25"><b>รายละเอียดการชำระเงิน  <?php
                                if($orderStatus!='รอชำระเงิน'){
                                if($rowPay['checked']=='0'){
                                    if($rowOrder['orderStatus']=="cancel"){
                                        echo "<span style='color: grey'>(ถูกปฏิเสธ)</span>";
                                    }
                                    else {
                                        echo "<span style='color: red'>(ยังไม่ได้ยืนยันการชำระเงิน)</span>";
                                    }
                                } else{
                                        echo "<span style='color: limegreen'>(ยืนยันการชำระเงินแล้ว)</span>";
                                }}?></b></div>
                        <div class="panel-body" style="margin: 0% 2% 0% 2%">
                            <!--                            <form method="post">-->
                            <table class="orderinfo" width="100%">
                                <tr>
                                    <td width="35%">Payment ID : </td>
                                    <td><?php echo $rowPay['paymentID']; ?></td>
                                </tr>
                                <tr>
                                    <td>ชำระเงินเมื่อ : </td>
                                    <td><?php $datePay = date_format(date_create($rowPay['dateCreate']),'d-m-Y H:i:s'); if(!empty($rowPay))echo $datePay; ?></td>
                                </tr>
                                <tr>
                                    <td>ช่องทางชำระเงิน : </td>
                                    <td><?php echo $bank;?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <!--    col-right-->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading fs-25"><B>รายละเอียดผู้สั่งซื้อ</B></div>
                        <div class="panel-body" style="margin: 0% 2% 0% 2%">
                            <!--                            <form method="post">-->
                            <table  class="orderinfo" width="100%">
                                <tr>
                                    <td width="35%">ผู้สั่งซื้อ : </td>
                                    <td><?php echo $rowU['name'];?></td>
                                </tr>
                                <tr>
                                    <td>อีเมล : </td>
                                    <td><?php echo $rowU['email'];?></td>
                                </tr>
                                <tr>
                                    <td>เบอร์โทร : </td>
                                    <td><?php echo $rowU['phone_number'];?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading fs-25"><b>รายละเอียดผู้รับ</b></div>
                        <div class="panel-body" style="margin: 0% 2% 0% 2%">
                            <!--                            <form method="post">-->
                            <table class="orderinfo" width="100%">
                                <tr>
                                    <td width="35%">ชื่อผู้รับ : </td>
                                    <td><?php echo $rowOrder['nameShip'];?></td>
                                </tr>
                                <tr>
                                    <td>ที่อยู่ : </td>
                                    <td><?php echo $rowOrder['addressShip'];?></td>
                                </tr>
                                <tr>
                                    <td>เบอร์โทร : </td>
                                    <td><?php echo $rowOrder['telShip'];?></td>
                                </tr>
                            </table>
                        </div>
                    </div>



                </div>

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading fs-25"><b>รายการสินค้า</b></div>
                        <div class="panel-body" style="margin: 0% 2% 0% 2%">
                            <!--                            <form method="post">-->

                            <table  class="table-striped" width="100%" style="font-size: 14px;">
                                <tr>
                                    <th width="20%"></th>
                                    <th style="padding-left: 10px" width="25%">สินค้า</th>
                                    <th style="text-align: right; padding-right: 10px;">ราคาต่อชิ้น</th>
                                    <th>จำนวน</th>
                                    <th style="text-align: right; padding-right: 10px;">ราคารวม</th>
                                </tr>
                                <?php
                                $sqlgpd = "SELECT * FROM groupproduct WHERE gpdID= '".$rowOrder['gpdID']."'";
                                $resultgpd = mysqli_query($con,$sqlgpd);
                                while($rowgpd = mysqli_fetch_assoc($resultgpd))
                                {
                                    $sqlPD = "SELECT * FROM product WHERE pdID= '".$rowgpd['productID']."'";
                                    $resultPD = mysqli_query($con,$sqlPD);
                                    $rowPD = mysqli_fetch_array($resultPD,MYSQLI_ASSOC);


                                    echo "<tr>";

                                    if($rowPD['custom']==1){
                                        $sql3 = "SELECT * FROM design WHERE design.pdID= '".$rowPD["pdID"]."' LIMIT 1";
                                        $result3 = mysqli_query($con, $sql3);
                                        $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                                        echo "
                                        <td style=\"text-align:center;\">";
                                        if($row3['imgPath']==="" || empty($row3)){

                                            echo '<img style="width:30%" src="../images/no-picture.jpg">';
                                        }
                                        else {
                                            echo '<a class="example-image-link" href="../member/'.$row3['imgPath'].'" data-lightbox="product"><img style="width:30%" src="../member/'.$row3['imgPath'].'"/></a>';
                                        }
                                        echo"</td>";
                                    }
                                    else{
                                        $sql3 = "SELECT * FROM image WHERE pdID= '".$rowPD['pdID']."' LIMIT 1";
                                        $result3 = mysqli_query($con,$sql3);
                                        $row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);

                                        echo "
                 
                                        <td style=\"text-align:center;\">";
                                        if($row3['pdImgPath']==="" || empty($row3)){
                                            echo '<img style="width:30%" src="../images/no-picture.jpg">';
                                        }
                                        else {
                                            echo '<a class="example-image-link" href="../'.$row3['pdImgPath'].'" data-lightbox="product"><img style="width:30%" src="../'.$row3['pdImgPath'].'"/></a>';
//                            echo '<a class="example-image-link" href="data:image/*;base64,'.base64_encode($row3['img']).'" data-lightbox="product"><img style="width:30%" src="data:image/*;base64,' . base64_encode($row3['img']) . '"/></a>';
                                        }
                                        echo"</td>";
                                    }


                                        echo "</td>
                                        <td style='padding-left: 10px;'>$rowPD[name]</td>
                                        <td style=\"text-align: right; padding-right: 10px;\">$rowPD[price]</td>
                                        <td style=\"text-align: center\">$rowgpd[amount]</td>
                                        <td style=\"text-align: right; padding-right: 10px; \">$rowgpd[priceAmount]</td>
                                    </tr>";

                                }
                                ?>

                                <tr>

                                    <td></td>
                                    <td style="padding-right: 5px"></td>
                                    <td style="color: #9d9d9d; padding: 5px;">ค่าขนส่ง</td>
                                    <td style="text-align: right; padding-right: 10px;"><b>+ <?php echo $rowOrder['shipPrice'];?></b></td>
                                </tr>
                                <tr>

                                    <td></td>
                                    <td style="padding-right: 5px"></td>
                                    <td style="color: #9d9d9d; padding: 5px;">ส่วนลด</td>
                                    <td style="text-align: right;color: red; padding-right: 10px;"><b>- <?php echo $rowOrder['discountPrice'];?></b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="color: #9d9d9d; font-size: 17px; padding: 5px;">ยอดชำระเงินทั้งหมด</td>
                                    <td style="text-align: right; color: #4cae4c; padding-right: 10px;"><b>฿ <?php echo $rowOrder['netPrice'];?></b></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
<!--<footer class="container-fluid">-->
<!--    <p></p>-->
<!--</footer>-->

</body>
</html>
