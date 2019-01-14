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
    echo "ของ Adminเท่านั้นจ้าาา";
    exit();
}
include ('../dbConnect.php');
$sql = "SELECT * FROM user WHERE uID = '".$_SESSION['ID']."' ";
//$objQuery = mysqli_query($strSQL);
//$objResult = mysqli_fetch_array($objQuery);
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);


$sql2 = "SELECT * FROM user";
//$objQuery = mysqli_query($strSQL);
//$objResult = mysqli_fetch_array($objQuery);
$result2 = mysqli_query($con,$sql2);
//$row_getimgGID = mysqli_fetch_array($result2,MYSQLI_ASSOC);

$sqlOrder2 = "SELECT * FROM order_table WHERE orderStatus='waiting for payment'";
$resultOrder2 = mysqli_query($con,$sqlOrder2);
$countNoti = mysqli_num_rows($resultOrder2);

$sqlOrder3 = "SELECT * FROM order_table WHERE orderStatus='waiting for verify'";
$resultOrder3 = mysqli_query($con,$sqlOrder3);
$countNotiPay = mysqli_num_rows($resultOrder3);

$sqlOrder4 = "SELECT * FROM order_table WHERE orderStatus='prepare to send order'";
$resultOrder4 = mysqli_query($con,$sqlOrder4);
$countNotiShipment = mysqli_num_rows($resultOrder4);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bogoshipda Admin | สถิติร้านค้า - จำนวนรายการสั่งซื้อ</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../images/icons/favicon.png"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="dist/Chart.bundle.js"></script>
    <script src="utils.js"></script>
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
        a {
			font-size: 12px;
			color:#fff;
			}
			
        a:hover {
			color:#FFF;
        }
        .navbar {
            margin-bottom: 0px;
			border-radius:0px;
        }

        * {
            box-sizing: border-box;
        }

        #myInput {
            background-image: url("../img/search1.png");
            background-size: 25px;
            background-position: 10px 5px;
            background-repeat: no-repeat;
            /*width: 20%;*/
            /*font-size: 16px;*/
            padding: 0px 20px 0px 40px;
            border: 1px solid #ddd;
			margin-top:10px;
			margin-left:90px;
            /*margin-bottom: 2px;*/
            border-radius: 8px;
			height:35px;	
        }
        .tb{
            margin: auto;
            margin-top: 50px;
            margin-bottom: 30px;
        }
        .tb tr td{
            text-align: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-collapse: collapse;
        }
        .custom-date{
            margin: auto;
            margin-top: 30px;
            text-align: center;
            width: 80%;
        }

        .list{
            margin: auto;
            margin-top: 30px;
            text-align: center;
            width: 80%;
            border: 1px black;
        }
        #myTable {
            border-collapse: collapse;
            margin-top: 50px;
            width: auto;
            border-top: 1px solid #ddd;
            /*font-size: 18px;*/
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
        /* Style buttons */
        .btn-view {
            background-color: #CCC  ; /* Blue background */
            border: none; /* Remove borders */
            color: white; /* White text */
            padding: 0px; /* Some padding */
            font-size: 16px; /* Set a font size */
            cursor: pointer; /* Mouse pointer on hover */
            border-radius: 10px;
			width: 30px;
			height: 30px;
			margin-left:10px;
			
        }

        /* Darker background on mouse-over */
        .btn-view:hover {
            background-color: #6CF;
        }
        .btn-delete {
            background-color: #ccc; /* Blue background */
            border: none; /* Remove borders */
            color: white; /* White text */
            padding: 0px; /* Some padding */
            font-size: 16px; /* Set a font size */
            cursor: pointer; /* Mouse pointer on hover */
            border-radius: 10px;
			width: 30px;
			height: 30px;
			margin-left:10px;
        }

        /* Darker background on mouse-over */
        .btn-delete:hover {
            background-color: #d15252;
        }
		
		.bg-icon{
			background-color: #666;
			border-radius: 8px;
			
		}
		.bg-icon:hover {
			background-color:#aadcd8;
		}
		.bg-icon-current {
			background-color: #aadcd8;
			border-radius: 8px;
		}
        .color-link{
            color: #ed80aa;
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
                <a href="statistic.php"><img class="bg-icon-current" src="../img/menu_bar_admin/statistic.png" style="width:100%" alt="Image">สถิติ</a>
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
            <div class="row" style="margin-top: 5px" align="center">
                <h3><b>สถิติร้านค้า</b></h3>
            </div>

            <hr>
        <div class="col-sm-3">
            <div class="panel panel-default">
            <div class="list-group">
                <a href="statistic.php" class="list-group-item">รายได้</a>
                <a href="statistic-order.php" class="list-group-item list-group-item-info">จำนวนรายการสั่งซื้อ</a>

            </div>
            </div>

        </div>
        <div class="col-sm-9">
            <div class="panel panel-default">
                <div class="row" style="margin-top: 30px" align="center">
                    <h4><b>จำนวนรายการสั่งซื้อ</b></h4>
                </div>

                    <table class="custom-date">
                        <tr>
                            <form action="" method="get">
                                <td>แสดงตั้งแต่วันที่ </td>
                                <td><input type="date" class="form-control" id="dateSt" name="dateSt"  value="<?php if(isset($_GET['dateSt'])){echo $_GET['dateSt'];}else echo date('d-m-Y');?>" onchange='this.form.submit()'></td>
                                <td>ถึง </td>
                                <td><input type="date" class="form-control" id="dateEn" name="dateEn" value="<?php if(isset($_GET['dateEn'])){echo $_GET['dateEn'];}else echo date('d-m-Y');?>" min="" onchange='this.form.submit()'></td>
                            </form>
                        </tr>
                    </table>


        <?php
        if(isset($_GET)){
            if($_GET['dateSt']!="" && $_GET['dateEn']!=""){
                if($_GET['dateSt']<=$_GET['dateEn']){
                    $sqlPayment = "SELECT * FROM payment WHERE (dateVerifyPayment >= '".$_GET['dateSt']."' AND dateVerifyPayment <='".$_GET['dateEn'].":23:59:59') ORDER BY dateVerifyPayment ASC";
                    $resultPayment = mysqli_query($con,$sqlPayment);
                    echo "<table class=\"list table-striped\">
                    <thead>
                         <th style=\"width:10%;text-align:center;\">วันที่สั่งซื้อ</th>
                        <th style=\"width:10%;text-align:center;\">Order ID</th>
                        <th style=\"width:10%;text-align:center;\">จำนวน</th>
                        <th style=\"width:20%;text-align:center;\">ราคา(บาท)</th>
                    </thead>";
                    if($resultPayment->num_rows == 0){
                        echo "
                            <tr>
                            <td colspan='4' style=\"text-align:center;color: red;\">-ไม่มีรายการสั่งซื้อ-</td>
                            </tr>
                        ";
                    }
                    else {
                        $oldDate = null;

                        unset($dates);
                        unset($allAmounts);
                        $totalPrice = 0;
                        $totalAmount = 0;
                        $totalOrder = 0;

                        $yesD = null;
                        $f = 0;
//                        $dates[] = null;
                        while ($rowPayment = mysqli_fetch_assoc($resultPayment)) {
                            $sqlOrderTable = "SELECT * FROM order_table WHERE orderID = '" . $rowPayment['orderID'] . "'";
                            $resultOrderTable = mysqli_query($con, $sqlOrderTable);
                            $rowOrderTable = mysqli_fetch_array($resultOrderTable, MYSQLI_ASSOC);

                            $date = date_format(date_create($rowPayment['dateVerifyPayment']), 'd-m-Y');
//                            $dateT = date_format(date_create($rowPayment['dateVerifyPayment']), 'Y-m-d');
                            $price = number_format($rowOrderTable['priceAmount'] - $rowOrderTable['discountPrice']);
                            echo "
                            <tr>
                            <td style=\"width:10%;text-align:center;\">$date</td>
                            <td style=\"width:10%;text-align:center;\"><a href=\"orderInfo.php?orderID=$rowOrderTable[orderID]\" class=\"color-link\">$rowOrderTable[orderID]</a></td>
                            <td style=\"width:20%;text-align:center;\">$rowOrderTable[allAmount]</td>
                            <td style=\"width:20%;text-align:center;\">$price</td>
                            </tr>
                        ";


                            if($f == 0){
                                $dates[] = $date;
                                $yesD = $date;
                                $f = 1;
                            }
                            else{
//                                echo $dateCheck." VS ".$yesD."<br>";
                                if($date != $yesD){
                                    $dates[] = $date;
                                    $yesD = $date;
                                }

                            }



                            $totalPrice += ($rowOrderTable['priceAmount'] - $rowOrderTable['discountPrice']);
                            $totalAmount += $rowOrderTable['allAmount'];
                            $totalOrder++;

                        }


                        foreach ($dates as $d){
// echo $d;
                            $dateC = date_format(date_create($d), 'Y-m-d');
                            $sqlPayment2 = "SELECT * FROM payment WHERE (dateVerifyPayment >= '".$dateC." 00:00:00' AND dateVerifyPayment <='".$dateC." 23:59:59') ORDER BY dateVerifyPayment";
                            $resultPayment2 = mysqli_query($con,$sqlPayment2);

                            $allAmount = 0;
                            while ($rowPayment2 = mysqli_fetch_assoc($resultPayment2)){
//                                print_r($rowPayment2 );
                                $sqlOrderTable2 = "SELECT * FROM order_table WHERE orderID = '".$rowPayment2['orderID']."'";
                                $resultOrderTable2 = mysqli_query($con, $sqlOrderTable2);
                                $rowOrderTable2 = mysqli_fetch_array($resultOrderTable2, MYSQLI_ASSOC);

                                $allAmount += str_replace(",", "",$rowOrderTable2['allAmount']);


                            }

                            $allAmounts[] = $allAmount;



                        }

                        $totalPrice_f = number_format($totalPrice);




//                        foreach($dates as $result) {
//
//                                $sqlPaymentChart = "SELECT * FROM payment WHERE dateVerifyPayment = '".$result."')";
//                                $resultPaymentChart = mysqli_query($con,$sqlPaymentChart);
//                                print_r($resultPaymentChart);
////                                echo $resultPaymentChart['orderID'];
//                                $amount=0;
//
////                                var_dump($resultPaymentChart);
//                                while ($rowPaymentChart = mysqli_fetch_assoc($resultPaymentChart)) {
//                                    echo $rowPaymentChart['orderID'];
//                                    $sqlOrderTableChart = "SELECT * FROM order_table WHERE orderID = '" . $rowPaymentChart['orderID'] . "'";
//                                    $resultOrderTableChart = mysqli_query($con, $sqlOrderTableChart);
//                                    $rowOrderTableChart = mysqli_fetch_array($resultOrderTableChart, MYSQLI_ASSOC);
//                                     echo $rowOrderTableChart['allAmount'];
//
//                                    $amount= $amount + $rowOrderTable['allAmount'];
//
//                                }
//                                $allAmounts[]=$amount;
//
//
//
//                        }



                        echo "</table>

                        <div style=\"width:80%;margin: 10%\">
                            <canvas id=\"canvas\"></canvas>
                        </div>
                        
                          <table class=\"tb\" width=\"80%\">
                                            <tr>
                                                <td colspan=\"2\">
                                                    รายการสั่งซื้อทั้งหมด <br>$totalOrder
                                                    <br> รายการ
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width=\"50%\">จำนวนสินค้าที่ขายได้<br> $totalAmount
                                                <br> ชิ้น
                                                </td>
                                                <td>ราคารวม <br>$totalPrice_f
                                                    <br> บาท
                                                </td>
                                            </tr>
                        
                                        </table>

                                       
                                  
                        ";
                    }


                }
                else{
                    echo "<script type='text/javascript'>alert('โปรดตรวจสอบ!! วันที่เริ่มต้นต้องน้อยกว่าวันที่สิ้นสุด');</script>";
                }
            }
        }
        ?>

            </div>
        </div>
        </div>

            <script>
                function search() {
                    var input, filter, table, tr, td, i,td2;
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[1];
                        td2 = tr[i].getElementsByTagName("td")[2];
                        if (td||td2) {
                            if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }
            </script>

        <script>
            var config = {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($dates); ?>,
                    datasets: [{
                        label: 'จำนวนรายการ',
                        lineTension: 0,
                        backgroundColor: window.chartColors.green,
                        borderColor: window.chartColors.green,
                        data: <?php echo json_encode($allAmounts, JSON_NUMERIC_CHECK); ?>,
                        fill: false,
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'กราฟแสดงสถิติ จำนวนการสั่งซื้อ'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'วันที่สั่งซื้อ'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'จำนวนรายการ'
                            }
                        }]
                    }
                }
            };

            window.onload = function() {
                var ctx = document.getElementById('canvas').getContext('2d');
                window.myLine = new Chart(ctx, config);
            };
        </script>

        </div>
    </div>
</div>

<!--<footer class="container-fluid">-->
<!--    <p>Footer Text</p>-->
<!--</footer>-->

</body>
</html>
