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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Order</title>
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
                <a href="order.php"><img class="bg-icon-current" src="../img/menu_bar_admin/order.png" style="width:100%" alt="Image">สั่งซื้อ<span class="menu-icons-noti">1</span></a>
            </div>
            <div class="col-sm-3">
                <!--                        <p>Some text..</p>-->
                <a href="payment.php"><img class="bg-icon" src="../img/menu_bar_admin/payment.png" style="width:100%" alt="Image">ชำระเงิน</a>
            </div>
            <div class="col-sm-3">
                <!--                        <p>Some text..</p>-->
                <a href="shipping.php"><img class="bg-icon" src="../img/menu_bar_admin/shipment.png" style="width:100%" alt="Image">ขนส่ง</a>
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
                <a href="bank.php"><img class="bg-icon" src="../img/menu_bar_admin/account.png" style="width:100%" alt="Image">บัญชีรับเงิน</a>
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
            <form method="post" action="Action/addProduct_action.php" enctype="multipart/form-data">
            <div class="row" style="margin-top: 5px">
                <div class="col-sm-4"><a href="order.php" class="btn btn-primary" role="button" style="margin-left: 2%;margin-top: 3%" >< กลับไปหน้ารายการสั่งซื้อทั้งหมด</a></div>
                <div class="col-sm-4" align="center"><h3><b>Order ID : </b></h3></div>

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
                                <table width="100%" border="1px black">
                                    <tr>
                                        <td width="35%">สถานะ : </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>สั่งเมื่อ : </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>การจัดส่ง : </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>รายละเอียดเพิ่มเติม : </td>
                                        <td></td>
                                    </tr>
                                </table>
                        </div>
                    </div>


                    <div class="panel panel-default">
                        <div class="panel-heading fs-25"><b>รายละเอียดการจัดส่ง</b></div>
                        <div class="panel-body" style="margin: 0% 2% 0% 2%">
                            <!--                            <form method="post">-->
                            <table width="100%" border="1px black">
                                <tr>
                                    <td width="35%">รหัสพัสดุ : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>จัดส่งเมื่อ : </td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading fs-25"><b>รายละเอียดการชำระเงิน</b></div>
                        <div class="panel-body" style="margin: 0% 2% 0% 2%">
                            <!--                            <form method="post">-->
                            <table width="100%" border="1px black">
                                <tr>
                                    <td width="35%">Payment ID : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>ชำระเงินเมื่อ : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>ช่องทางชำระเงิน : </td>
                                    <td></td>
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
                            <table width="100%" border="1px black">
                                <tr>
                                    <td width="35%">ผู้สั่งซื้อ : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>อีเมล : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>เบอร์โทร : </td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading fs-25"><b>รายละเอียดผู้รับ</b></div>
                        <div class="panel-body" style="margin: 0% 2% 0% 2%">
                            <!--                            <form method="post">-->
                            <table width="100%" border="1px black">
                                <tr>
                                    <td width="35%">ชื่อผู้รับ : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>ที่อยู่ : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>เบอร์โทร : </td>
                                    <td></td>
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
                            <table width="100%" border="1px black">
                                <tr>
                                    <th width="10%"></th>
                                    <th width="45%">สินค้า</th>
                                    <th style="text-align: right; padding-right: 10px;">ราคาต่อชิ้น</th>
                                    <th>จำนวน</th>
                                    <th style="text-align: right">ราคารวม</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>name</td>
                                    <td style="text-align: right; padding-right: 10px;">200</td>
                                    <td style="text-align: center">1</td>
                                    <td style="text-align: right; ">200</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td style="padding-right: 5px"></td>
                                    <td style="color: #9d9d9d; padding: 5px;">ค่าขนส่ง</td>
                                    <td style="text-align: right"><b>+ </b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="color: #9d9d9d; font-size: 17px; padding: 5px;">ยอดชำระเงินทั้งหมด</td>
                                    <td style="text-align: right; color: #4cae4c "><b>฿</b></td>
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
