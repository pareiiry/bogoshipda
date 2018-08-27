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
include ('../dbConnect.php');
$sql = "SELECT * FROM usertable WHERE uID = '".$_SESSION['ID']."' ";
//$objQuery = mysqli_query($strSQL);
//$objResult = mysqli_fetch_array($objQuery);
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
        .row.content {height: 1500px}

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #f1f1f1;
            height: 100%;
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
        a:hover {
            opacity:0.7 !important;
            filter: grayscale(100%); !important; /* For IE8 and earlier */
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
                        <a href="indexForOwner.php" ><img src="../img/menu_bar_admin/product.png" style="width:100%" alt="Image">สินค้า</a>
                    </div>
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="#"><img src="../img/menu_bar_admin/order.png" style="width:100%" alt="Image">สั่งซื้อ</a>
                    </div>
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="#"><img src="../img/menu_bar_admin/payment.png" style="width:100%" alt="Image">ชำระเงิน</a>
                    </div>
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="#"><img src="../img/menu_bar_admin/shipment.png" style="width:100%" alt="Image">ขนส่ง</a>
                    </div>
                </div>
            </div><br>
            <div class="container-fluid bg-3 text-center">
                <div class="row">
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="manageMember.php" style="filter: grayscale(100%);"><img src="../img/menu_bar_admin/user.png" style="width:100%" alt="Image">สมาชิก</a>
                    </div>
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="discount.php"><img src="../img/menu_bar_admin/discount.png" style="width:100%" alt="Image">ส่วนลด</a>
                    </div>
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="#"><img src="../img/menu_bar_admin/account.png" style="width:100%" alt="Image">บัญชีรับเงิน</a>
                    </div>
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="#"><img src="../img/menu_bar_admin/news.png" style="width:100%" alt="Image">BANNER</a>
                    </div>
                </div>
            </div><br>
            <div class="container-fluid bg-3 text-center">
                <div class="row">
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="#"><img src="../img/menu_bar_admin/review.png" style="width:100%" alt="Image">รีวิว</a>
                    </div>
                    <div class="col-sm-3">
                        <a href="#"><img src="../img/menu_bar_admin/statistic.png" style="width:100%" alt="Image">รายงาน</a>
                    </div>
                    <div class="col-sm-3">

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
            <form method="post" action="Action/addAdmin_action.php" enctype="multipart/form-data">
                <div class="row" style="margin-top: 5px">
                    <div class="col-sm-4"><a href="manageMember.php" class="btn btn-primary" role="button" style="margin-left: 2%;margin-top: 3%" >< กลับไปรายชื่อผู้ใช้และสมาชิก</a></div>
                    <div class="col-sm-4" align="center"><h4>เพิ่ม Admin</h4></div>

                    <div class="col-sm-4 " align="right">
                        <input class="btn btn-success" type="submit" value="เพิ่ม" style="margin-left: 2%;margin-top: 3%">
                        <a href="" class="btn btn-danger" role="button" type="clear" style="margin-left: 2%;margin-top: 3%" >ยกเลิก</a>
                    </div>

                    <!--                <div class="col-sm-4"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหาสินค้า..." title="Type in a name" width="100%"></div>-->
                </div>

                <hr>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
                            <center><h5>ข้อมูลผู้ใช้</h5></center>
                                <!--                            <form method="post">-->
                                <div class="btn-group" style="margin: 0 0 2% 0;">
                                    <label>ชื่อ:</label>
                                    <input size="100%" class="form-control" type="text" name="name" required>
                                </div>
                                <div class="btn-group" style="margin: 0 0 2% 0;">
                                    <label>Email:</label>
                                    <input size="100%" class="form-control" type="email" name="email" required>
                                </div>
                                <br>
                                <div class="btn-group" style="margin: 0 0 2% 0;">
                                    <label>Password:</label>
                                    <input size="100%" class="form-control" type="password" name="password" required>
                                </div>
                                <br>
                                <div class="btn-group" style="margin: 0 0 2% 0;width: 100%">
                                    <label>สิทธิ์การเข้าใช้งาน:</label>
                                    <select class="form-control" id="status" name="status" disabled>
<!--                                        <option value="all" --><?php //if(isset($_POST['typeSearch']) && ($_POST['typeSearch']=='all'))echo 'selected' ?><!-->ประเภทงาน</option>-->
                                        <option value="admin" selected>admin</option>
                                        <option value="admin">member</option>
                                    </select>
                                </div>
    </div>
    <div class="col-md-4"></div>
</div>

            </form>

        </div>
    </div>
</div>
<!--<footer class="container-fluid">-->
<!--    <p></p>-->
<!--</footer>-->

</body>
</html>
