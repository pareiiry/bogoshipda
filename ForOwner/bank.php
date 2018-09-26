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


$sql2 = "SELECT * FROM bank";
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
                <a href="discount.php"><img class="bg-icon" src="../img/menu_bar_admin/discount.png" style="width:100%" alt="Image">ส่วนลด</a>
            </div>
            <div class="col-sm-3">
                <!--                        <p>Some text..</p>-->
                <a href="bank.php"><img class="bg-icon-current" src="../img/menu_bar_admin/account.png" style="width:100%" alt="Image">บัญชีรับเงิน</a>
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
                    <div class="col-sm-4" align="center"><h3><b>บัญชีรับเงิน</b></h3></div>

                    <div class="col-sm-4 " align="right">
                    </div>

                    <!--                <div class="col-sm-4"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหาสินค้า..." title="Type in a name" width="100%"></div>-->
                </div>

                <hr>

                <div class="row" style="margin-top: 20px">
                    <form method="post" action="Action/addBank_action.php" enctype="multipart/form-data">
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading" align="center"  style="background-color:#edf9f7;"><b>เพิ่มบัญชี</b></div>
                            <div class="panel-body" style="margin: 0% 2% 0% 2%">
                                <!--                            <form method="post">-->

                                    <div class="btn-group" style="margin: 0 0 2% 0;width: 100%">
                                        <label>ชื่อธนาคาร:</label>
                                        <select class="form-control" name="bankName">
                                            <option value="SCB">ธนาคารไทยพาณิชย์</option>
                                            <option value="KTB">ธนาคารกรุงไทย</option>
                                            <option value="BBL">ธนาคารกรุงเทพ</option>
                                            <option value="KBANK">ธนาคารกสิกร</option>
                                            <option value="GSB">ธนาคารออมสิน</option>
                                            <option value="KRUNGSRI">ธนาคารกรุงศรีอยุธยา</option>
                                            <option value="TMB">ธนาคารทหารไทย</option>
                                            <option value="UOB">ธนาคารยูโอบี</option>
                                            <option value="TBANK">ธนาคารธนชาติ</option>
                                            <option value="CIMB">ธนาคารซีไอเอ็มบี</option>
                                            <option value="CITIBANK">ซิตี้แบงค์</option>
                                            <option value="SCBT">Standard Chartered</option>
                                            <option value="TISCO">ทิสโก้แบงค์</option>
                                            <option value="Wallet">ทรูวอลเลท</option>
                                            <option value="PrompPay">พร้อมเพย์</option>
                                        </select>
                                    </div>
                                <div class="btn-group" style="margin: 0 0 2% 0;width: 100%">
                                    <label>ชื่อบัญชี:</label>
                                    <input size="100%" class="form-control" type="text" name="accountName" value="" required>
                                </div>
                                <div class="btn-group" style="margin: 0 0 2% 0;width: 100%">
                                    <label>เลขบัญชี:</label>
                                    <input size="100%" class="form-control" type="text" name="accountNumber" value="" required>
                                </div>
                                
                                
                                   <input  class="form-control btn btn-success" type="submit" value="เพิ่มบัญชี" style="margin-top: 3%">


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
                                        <th style="width:10%;text-align:center;"></th>
                                        <th style="width:10%;text-align:center;">ธนาคาร</th>
                                        <th style="width:15%;text-align:center;">ชื่อบัญชี</th>
                                        <th style="width:15%;text-align:center;">เลขที่บัญชี</th>
                                        <th style="width:5%;text-align:center;"></th>
                                    </tr>
                                    </thead>
                                    <?php
                                   
                     while($row2= mysqli_fetch_assoc($result2))// show the information from query
                {


                        echo"<tr>";
                    if($row2['bankName']=='SCB'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/scb.png\"  width=\"25%\"></td>";
                     }
                    else if($row2['bankName']=='KTB') {
                        echo " <td style=\"text-align:center;\"><img src=\"../images/bank/ktb.jpg\"  width=\"25%\"></td>";
                    }
                    else if($row2['bankName']=='BBL'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/bbl.png\"  width=\"25%\"></td>";
                    }
                    else if($row2['bankName']=='KBANK'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/kbank.png\"  width=\"25%\"></td>";
                    }else if($row2['bankName']=='GSB'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/gsb.png\"  width=\"25%\"></td>";
                    }  else if($row2['bankName']=='KRUNGSRI'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/krungsri.png\"  width=\"25%\"></td>";
                    }
                    else if($row2['bankName']=='TMB'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/tmb.png\"  width=\"25%\"></td>";
                    }
                   else if($row2['bankName']=='UOB'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/uob.png\"  width=\"25%\"></td>";
                    }
                    else if($row2['bankName']=='TBANK') {
                        echo "<td style=\"text-align:center;\"><img src=\"../images/bank/tbank.png\"  width=\"25%\"></td>";
                    }else if($row2['bankName']=='CIMB'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/cimb.png\"  width=\"25%\"></td>";
                    }
                    else if($row2['bankName']=='CITIBANK'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/citibank.png\"  width=\"25%\"></td>";
                    }
                    else if($row2['bankName']=='SCBT'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/standardcharter.png\"  width=\"25%\"></td>";
                    }
                    else if($row2['bankName']=='TISCO'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/tisco.png\"  width=\"25%\"></td>";
                    }
                    else if($row2['bankName']=='Wallet') {
                        echo "<td style=\"text-align:center;\"><img src=\"../images/bank/true.jpg\"  width=\"25%\"></td>";
                    }
                    else if($row2['bankName']=='PrompPay') {
                        echo "<td style=\"text-align:center;\"><img src=\"../images/bank/promptpay.png\"  width=\"25%\"></td>";
                    }
                    echo "<td style=\"text-align:center;\">$row2[bankName]</td>
                     <td style=\"text-align:center;\">$row2[accountName]</td>
					 <td style=\"text-align:center;\">$row2[accountNumber]</td>
                    <td style=\"text-align:center;\">
                    <form action=\"Action/deleteBank_action.php\" method=\"get\">
                        <input style='display: none;' type=\"text\" name=\"bankID\" value='$row2[bankID]'>
                        <button class='btn-delete' type=\"submit\"><i class=\"fa fa-trash\"></i></button>
                    </form>
                    </td>
                    </tr>";

				}
                                    ?>
                                    
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
