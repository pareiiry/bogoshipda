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

$sqlOrder = "SELECT * FROM order_table WHERE orderStatus IN ('prepare to send order','sent order')";
$resultOrder = mysqli_query($con,$sqlOrder);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bogoshipda Admin | รายการจัดส่งสินค้า</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
			margin-left:40px;
            /*margin-bottom: 2px;*/
            border-radius: 8px;
			height:35px;	
        }

        #myTable {
            border-collapse: collapse;
            width: 100%;
            border-top: 1px solid #ddd;
            font-size: 12px;
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
        .btn-edit {
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
        .btn-edit:hover {
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
                <a href="shipping.php"><img class="bg-icon-current" src="../img/menu_bar_admin/shipment.png" style="width:100%" alt="Image">ขนส่ง<span class="menu-icons-noti"><?php echo $countNotiShipment;?></a>
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
                <div class="col-sm-4"></div>
                <div class="col-sm-4"><h3><b>รายการจัดส่งสินค้า</b></h3></div>
                <div class="col-sm-4"><input type="text" id="myInput" onkeyup="search()" placeholder="ค้นหาชื่อ..." title="Type in a name" width="100%"></div>
            </div>

            <hr>


            <table id="myTable" >
                <tr class="header">
                    <th style="width:5%;text-align:center;">สถานะ</th>
                    <th style="width:5%;text-align:center;">Order ID</th>
                    <th style="width:12%; text-align: center;">วันที่ยืนยันรับเงิน</th>
                    <th style="width:10%;text-align:center;">ชื่อผู้สั่งซื้อ</th>
                    <th style="width:17%;text-align:center;">รายละเอียดการส่งของ</th>
                    <th style="width: 16%; text-align: center;">รหัสพัสดุ</th>
                    <th style="width:10%; text-align: center;">ยืนยันจัดส่ง</th>
                </tr>
                <?php
                $howShip="";
                $orderStatus="";
                while($rowOrder = mysqli_fetch_assoc($resultOrder))
                {
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
                $orderStatus = "ยกเลิก";
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

                    $sqlPay = "SELECT * FROM payment WHERE orderID='".$rowOrder['orderID']."'";
                    $resultPay = mysqli_query($con,$sqlPay);
                    $rowPay = mysqli_fetch_array($resultPay,MYSQLI_ASSOC);
                    $date = date_format(date_create($rowPay['dateVerifyPayment']),'d-m-Y H:i:s');
                echo "<tr>
                    <td style=\"width:10%;text-align:center;\">$orderStatus</td>
                    <td style=\"width:5%;text-align:center;\"><b><a href=\"orderInfo.php?orderID=$rowOrder[orderID]\" class=\"color-link\">$rowOrder[orderID]</a></b> </td>
                    <td style=\"width:10%;text-align: center;\">$date</td>
                    <td style=\"width:15%;text-align:center;\">$rowU[name]</td>
                    <td style=\"width:25%;text-align:left;\">
                        <b>ส่งแบบ : $howShip</b>
                        <br><b>ผู้รับ</b> : $rowOrder[nameShip] ( โทร. $rowOrder[telShip] )<br>$rowOrder[addressShip]</br>
                    </td>";
                    if($rowOrder['trackingNumber']==NULL){
                        echo "<form action='Action/addTracking_action.php' method='post'>
                    <input type='hidden' name='orderID' value='$rowOrder[orderID]'>
                    <td style=\"text-align: center;\"><input type='text' class='form-control' value='' name='trackingNumber' placeholder='กรุณาระบุรหัสพัสดุ...' required></td>
                    <td style=\"text-align: center\">
                        <button type=\"submit\" class=\"btn btn-outline-success\">ยืนยัน</button>
                    </td>
                    </form>";
                    }
                    else{
                        echo "  <td style=\"text-align: center;\">$rowOrder[trackingNumber]</td>
                                <td style=\"text-align: center; color: limegreen\">ยืนยันแล้ว</td>";
                    }


                echo "</tr>";
                }?>
            </table>

            <script>
                function search() {
                    var input, filter, table, tr, td, i,td2;
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[0];
                        td2 = tr[i].getElementsByTagName("td")[3];
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

        </div>
    </div>
</div>

<!--<footer class="container-fluid">-->
<!--    <p>Footer Text</p>-->
<!--</footer>-->

</body>
</html>
