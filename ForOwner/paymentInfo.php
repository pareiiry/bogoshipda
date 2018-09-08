<?php
session_start();
if($_SESSION['ID'] == "")
{
    //echo "Please Login!";
    header("location:loginPage.php");
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

    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
        .row.content {height: 1500px}

        /* Set gray background color and 100% height */


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
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav" style="font-size: 10px;">
            <br>
            <!--            <h4>Bogoshipda Admin</h4>-->
            <div class="container-fluid bg-3 text-center">
                <div class="row">
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="indexForOwner.php"><img class="bg-icon" src="../img/menu_bar_admin/product.png" style="width:100%" alt="Image">สินค้า</a>
                    </div>
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="order.php"><img class="bg-icon-current" src="../img/menu_bar_admin/order.png" style="width:100%" alt="Image">สั่งซื้อ</a>
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
                        <a href="statistic.php"><img class="bg-icon" src="../img/menu_bar_admin/statistic.png" style="width:100%" alt="Image">รายงาน</a>
                    </div>
                    <div class="col-sm-3">

                    </div>
                </div>
            </div><br>
            <!--            <ul class="nav nav-pills nav-stacked">-->
            <!--                <li class="active"><a href="#section1">Home</a></li>-->
            <!--                <li><a href="#section2">Friends</a></li>-->
            <!--                <li><a href="#section3">Family</a></li>-->
            <!--                <li><a href="#section3">Photos</a></li>-->
            <!--            </ul><br>-->

            <!--            <div class="input-group">-->
            <!--                <input type="text" class="form-control" placeholder="Search Blog..">-->
            <!--                <span class="input-group-btn">-->
            <!--          <button class="btn btn-default" type="button">-->
            <!--            <span class="glyphicon glyphicon-search"></span>-->
            <!--          </button>-->
            <!--        </span>-->
            <!--            </div>-->
        </div>

        <div class="col-sm-9">
            <form method="post" action="Action/addProduct_action.php" enctype="multipart/form-data">
            <div class="row" style="margin-top: 5px">
                <div class="col-sm-4"><a href="payment.php" class="btn btn-primary" role="button" style="margin-left: 2%;margin-top: 3%" >< กลับไปหน้ารายการแจ้งชำระเงินทั้งหมด</a></div>
                <div class="col-sm-4" align="center"><h3><b>Payment ID : </b></h3></div>

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
                            <table width="100%" border="1px black">
                                <tr>
                                    <td width="20%">Order Id : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>สถานะ : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>เวลาที่ชำระเงิน : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>ช่องทางชำระเงิน : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>จำนวนเงิน : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>เวลาที่แจ้งชำระเงิน : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>เวลายืนยันยอด : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>ผู้แจ้งยอด : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>รูปสลิป : </td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>


<!--</footer>-->

</body>
</html>