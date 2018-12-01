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
//$objQuery = mysqli_query($strSQL);
//$objResult = mysqli_fetch_array($objQuery);
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);


$sql2 = "SELECT * FROM product";
//$objQuery = mysqli_query($strSQL);
//$objResult = mysqli_fetch_array($objQuery);
$result2 = mysqli_query($con,$sql2);

$sqlOrder2 = "SELECT * FROM order_table WHERE orderStatus='waiting for payment'";
$resultOrder2 = mysqli_query($con,$sqlOrder2);
$countNoti = mysqli_num_rows($resultOrder2);

$sqlOrder3 = "SELECT * FROM order_table WHERE orderStatus='waiting for verify'";
$resultOrder3 = mysqli_query($con,$sqlOrder3);
$countNotiPay = mysqli_num_rows($resultOrder3);

$sqlOrder4 = "SELECT * FROM order_table WHERE orderStatus='prepare to send order'";
$resultOrder4 = mysqli_query($con,$sqlOrder4);
$countNotiShipment = mysqli_num_rows($resultOrder4);

$sqlPay = "SELECT * FROM payment WHERE paymentID='".$_GET['paymentID']."'";
$resultPay = mysqli_query($con,$sqlPay);
$rowPay = mysqli_fetch_array($resultPay,MYSQLI_ASSOC);

$sqlOrder = "SELECT * FROM order_table WHERE orderID='".$rowPay['orderID']."'";
$resultOrder= mysqli_query($con,$sqlOrder);
$rowOrder = mysqli_fetch_array($resultOrder,MYSQLI_ASSOC);

$sqlUser = "SELECT * FROM user WHERE uID='".$rowOrder['uID']."'";
$resultUser = mysqli_query($con,$sqlUser);
$rowUser = mysqli_fetch_array($resultUser,MYSQLI_ASSOC);

$sqlBank = "SELECT * FROM bank WHERE bankID='".$rowPay['bankID']."'";
$resultBank = mysqli_query($con,$sqlBank);
$rowBank= mysqli_fetch_array($resultBank,MYSQLI_ASSOC);
$bank ="";
if($rowBank['bankName']=='SCB'){
    $bank ="ธนาคารไทยพาณิชย์ | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='KTB') {
    $bank ="ธนาคารกรุงไทย | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='BBL'){
    $bank ="ธนาคารกรุงเทพ | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='KBANK'){
    $bank ="ธนาคารกสิกร | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}else if($rowBank['bankName']=='GSB'){
    $bank ="ธนาคารออมสิน | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}  else if($rowBank['bankName']=='KRUNGSRI'){
    $bank ="ธนาคารกรุงศรีอยุธยา | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='TMB'){
    $bank ="ธนาคารทหารไทย | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='UOB'){
    $bank ="ธนาคารยูโอบี | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='TBANK') {
    $bank ="ธนาคารธนชาติ | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}else if($rowBank['bankName']=='CIMB'){
    $bank ="ธนาคารซีไอเอ็มบี | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='CITIBANK'){
    $bank ="ซิตี้แบงค์ | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='SCBT'){
    $bank ="Standard Chartered | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='TISCO'){
    $bank ="ทิสโก้แบงค์ | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='Wallet') {
    $bank ="ทรูวอลเลท | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}
else if($rowBank['bankName']=='PrompPay') {
    $bank ="พร้อมเพย์ | ".$rowBank['accountName']." | ".$rowBank['accountNumber'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bogoshipda Admin | รายละเอียดการชำระเงิน</title>
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
        .row.content {
            height: 600px;
        }
        .fs-25{
            font-size: 16px;
        }
        table{
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .btn-outline-success {
            color: #28a745;
            background-color: transparent;
            background-image: none;
            border-color: #28a745;
        }

        .btn-outline-success:hover {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-outline-success:focus, .btn-outline-success.focus {
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.5);
        }

        .btn-outline-success.disabled, .btn-outline-success:disabled {
            color: #28a745;
            background-color: transparent;
        }

        .btn-outline-success:active, .btn-outline-success.active,
        .show > .btn-outline-success.dropdown-toggle {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-outline-danger {
            color: #dc3545;
            background-color: transparent;
            background-image: none;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-outline-danger:focus, .btn-outline-danger.focus {
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.5);
        }

        .btn-outline-danger.disabled, .btn-outline-danger:disabled {
            color: #dc3545;
            background-color: transparent;
        }

        .btn-outline-danger:active, .btn-outline-danger.active,
        .show > .btn-outline-danger.dropdown-toggle {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
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
    .pinfo td{
        padding-top: 10px;
        padding-bottom: 10px;
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
                <a href="order.php"><img class="bg-icon" src="../img/menu_bar_admin/order.png" style="width:100%" alt="Image">สั่งซื้อ<span class="menu-icons-noti"><?php echo $countNoti;?></a>
            </div>
            <div class="col-sm-3">
                <!--                        <p>Some text..</p>-->
                <a href="payment.php"><img class="bg-icon-current" src="../img/menu_bar_admin/payment.png" style="width:100%" alt="Image">ชำระเงิน<span class="menu-icons-noti"><?php echo $countNotiPay;?></a>
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

            <div class="row" style="margin-top: 5px">
                <div class="col-sm-4"><a href="payment.php" class="btn btn-info" role="button" style="margin-left: 2%;margin-top: 3%" >< กลับไปหน้ารายการแจ้งชำระเงินทั้งหมด</a></div>
                <div class="col-sm-4" align="center"><h3><b>Payment ID : <?php echo $rowPay['paymentID'];?></b></h3></div>

                <div class="col-sm-4 " align="right">

                </div>

<!--                <div class="col-sm-4"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหาสินค้า..." title="Type in a name" width="100%"></div>-->
            </div>

            <hr>



                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading fs-25"><B>รายละเอียดการชำระเงิน</B></div>
                        <div class="panel-body" style="margin: 0% 2% 0% 2%">
                            <!--                            <form method="post">-->
                            <table class="pinfo"  width="100%">

                                <tr>
                                    <td width="20%">สถานะ : </td>
                                    <td><?php if($rowPay['checked']==1){echo "<span style='color: limegreen'>ยืนยันการชำระเงินแล้ว</span>";}else{ if($rowOrder['orderStatus']=="cancel"){
                                            echo "<span style='color: grey'>ถูกปฏิเสธ</span>";
                                        }else{echo "<span style='color: red'>รอตรวจสอบ</span>";}}?></td>
                                </tr>
                                <tr>
                                    <td>เวลาที่ชำระเงิน : </td>
                                    <td><?php $date= date_format(date_create($rowPay['date']),'d-m-Y'); echo $date." ".$rowPay['time'];?></td>
                                </tr>
                                <tr>
                                    <td>ช่องทางชำระเงิน : </td>
                                    <td> <?php echo $bank;?></td>
                                </tr>
                                <tr>
                                    <td>จำนวนเงินที่แจ้งชำระ : </td>
                                    <td><?php echo $rowPay['pricePayInput'];?></td>
                                </tr>
                                <tr>
                                    <td>เวลาที่แจ้งชำระเงิน : </td>
                                    <td><?php $date2= date_format(date_create($rowPay['dateCreate']),'d-m-Y H:i:s'); echo $date2;?></td>
                                </tr>
                                <tr>
                                    <td>เวลายืนยันยอด : </td>
                                    <td><?php if($rowPay['checked']==1){$date3= date_format(date_create($rowPay['dateVerifyPayment']),'d-m-Y H:i:s');echo $date3;}else{ echo "-";} ?></td>
                                </tr>
                                <tr>
                                    <td>ผู้แจ้งยอด : </td>
                                    <td><?php echo $rowUser['name'];?></td>
                                </tr>
                                <tr>
                                    <td>รูปสลิป : </td>
                                    <td><?php echo '<img style="width:30%" src="../'.$rowPay['slipImgPath'].'"/>';?></td>
                                </tr>
                                <tr>
                                    <td>การตวรสอบ</td>
                                    <td>
                                        <?php if($rowPay['checked']=='0'){
                                            if($rowOrder['orderStatus']=="cancel"){
                                                echo "<span style='color: grey'>ถูกปฏิเสธ</span>";
                                            }else{
                                       echo "
                                       <form action='Action/updateStatusTosendOrder_action.php' method='post'>
                                            <input type='hidden' name='paymentID' value='$rowPay[paymentID]'>
                                            <input type='hidden' name='orderID' value='$rowPay[orderID]'>
                                            <button type=\"submit\" class=\"btn btn-outline-success\">ยืนยัน</button>
                                        </form>
                                        <form action='Action/updateCancelStatusTosendOrder_action.php' method='post'>
                                            <input type='hidden' name='orderID' value='$rowPay[orderID]'>
                                            <button type=\"submit\" class=\"btn btn-outline-danger\">ปฏิเสธ</button>
                                         </form>";
                                        }
                                        }
                                        else{

                                                echo "<span style='color: limegreen'>ยืนยันแล้ว</span>";


                                        }?>

                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>


<!--</footer>-->

</body>
</html>
