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


$sql2 = "SELECT * FROM code";
//$objQuery = mysqli_query($strSQL);
//$objResult = mysqli_fetch_array($objQuery);
$result2 = mysqli_query($con,$sql2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bogoshipda Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../images/icons/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="../css/styleOwner.css">
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
                <a href="order.php"><img class="bg-icon" src="../img/menu_bar_admin/order.png" style="width:100%" alt="Image">สั่งซื้อ<span class="menu-icons-noti">1</span></a>
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
                <a href="discount.php"><img class="bg-icon-current" src="../img/menu_bar_admin/discount.png" style="width:100%" alt="Image">ส่วนลด</a>
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

                <div class="row" style="margin-top: 5px">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4" align="center"><h3><b>ส่วนลด</b></h3></div>

                    <div class="col-sm-4 " align="right">
                    </div>

                    <!--                <div class="col-sm-4"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหาสินค้า..." title="Type in a name" width="100%"></div>-->
                </div>

                <hr>

                <div class="row" style="margin-top: 20px">
                    <form method="post" action="Action/addDiscount_action.php" enctype="multipart/form-data">
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading" align="center"  style="background-color:#edf9f7;"><b>เพิ่มส่วนลด</b></div>
                            <div class="panel-body" style="margin: 0% 2% 0% 2%">
                                <!--                            <form method="post">-->
                                <div class="btn-group" style="margin: 0 0 2% 0;width: 100%">
                                    <label>วันที่สร้าง:</label>
                                    <input type="date" class="form-control" id="dateCreate" name="dateCreate" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="btn-group" style="margin: 0 0 2% 0;width: 100%">
                                    <label>วันที่สิ้นสุด:</label>
                                    <input type="date" class="form-control" id="dateDelete" name="dateDelete" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="btn-group" style="margin: 0 0 2% 0">
                                    <label>รหัส:</label>
                                    <input size="100%" class="form-control" type="text" name="codeText" value="" required>
                                </div>
                                <div class="btn-group" style="margin: 0 0 2% 0;width: 100%">
                                    <label>ส่วนลด:</label>
                                    <input type="number" class="form-control" id="discount" name="discount" min="1" required>
                                </div>
                                <div class="btn-group" style="margin: 0 0 2% 0;width: 100%">
                                    <label>หน่วย:</label>
                                    <select class="form-control" id="unitDiscount" name="unitDiscount">
                                        <option value="bath" selected>บาท</option>
                                        <option value="percent">%</option>
                                    </select>
                                </div>
                                <input  class="form-control btn btn-success" type="submit" value="เพิ่มส่วนลด" style="margin-top: 3%">


                            </div>
                        </div>
                    </div>
                    </form>

                    <div class="col-md-9">
                        <div class="panel panel-default">
                            <div class="panel-body" >

                                <table class="table">
                                    <thead style=" color:#00a9a3">
                                    <tr>
                                        <th style="width:10%;text-align:center;">สถานะ</th>
                                        <th style="width:15%;text-align:center;">วันที่เริ่มใช้งาน</th>
                                        <th style="width:15%;text-align:center;">วันที่สิ้นสุด</th>
                                        <th style="width:20%;text-align:center;">รหัส</th>
                                        <th style="width:15%;text-align:center;">ส่วนลด</th>
                                        <th style="width:5%;text-align:center;">หน่วย</th>
                                        <th style="width:5%;text-align:center;"></th>
                                    </tr>
                                    </thead>
                                    <?php
                                    while($row2= mysqli_fetch_assoc($result2))// show the information from query
                                    {
                                        echo "
                    <tr>";
                    if($row2['active']==1){
                        $drnM = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
                        $drnM = $drnM ->format("Y-m-d");
                        if($row2['dateDelete']>$drnM){
                            echo"<td style=\"text-align:center;color: #1BA135\">Active</td>";
                        }
                        else{
                            echo"<td style=\"text-align:center;color: red\">Unactive</td>";
                        }

                     echo"<td style=\"text-align:center;\">$row2[dateCreate]</td>
                     <td style=\"text-align:center;\">$row2[dateDelete]</td>
                     <td style=\"text-align:center;\">$row2[codeText]</td>
                     <td style=\"text-align:center;\">$row2[discount]</td>";
                    if($row2['unitDiscount']=='bath'){
                        echo "<td style=\"text-align:center;\">บาท</td>";
                    }
                    else if($row2['unitDiscount']=='percent'){
                        echo "<td style=\"text-align:center;\">%</td>";
                    }
                    echo"
                    <td style=\"text-align:center;\">
                    <form action=\"Action/deleteDiscount_action.php\" method=\"get\">
                        <input style='display: none;' type=\"text\" name=\"codeID\" value='$row2[codeID]'>
                        <button class='btn-delete' type=\"submit\"><i class=\"fa fa-trash\"></i></button>
                    </form>

                    </td>
                    </tr>
                    ";
                   }
                                    }?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>



        </div>
    </div>
</div>
<!--<footer class="container-fluid">-->
<!--    <p></p>-->
<!--</footer>-->

</body>
</html>
