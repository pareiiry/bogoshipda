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
                        <a href="indexForOwner.php" ><img class="bg-icon" src="../img/menu_bar_admin/product.png" style="width:100%" alt="Image">สินค้า</a>
                    </div>
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="#"><img class="bg-icon" src="../img/menu_bar_admin/order.png" style="width:100%" alt="Image">สั่งซื้อ</a>
                    </div>
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="#"><img class="bg-icon" src="../img/menu_bar_admin/payment.png" style="width:100%" alt="Image">ชำระเงิน</a>
                    </div>
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="#"><img class="bg-icon" src="../img/menu_bar_admin/shipment.png" style="width:100%" alt="Image">ขนส่ง</a>
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
                        <a href="#"><img class="bg-icon" src="../img/menu_bar_admin/news.png" style="width:100%" alt="Image">BANNER</a>
                    </div>
                </div>
            </div><br>
            <div class="container-fluid bg-3 text-center">
                <div class="row">
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="#"><img class="bg-icon" src="../img/menu_bar_admin/review.png" style="width:100%" alt="Image">รีวิว</a>
                    </div>
                    <div class="col-sm-3">
                        <a href="faqs.php"><img class="bg-icon" src="../img/menu_bar_admin/faqs.png" style="width:100%" alt="Image">FAQs</a>
                    </div>
                    <div class="col-sm-3">
                        <a href="#"><img class="bg-icon" src="../img/menu_bar_admin/statistic.png" style="width:100%" alt="Image">รายงาน</a>
                    </div>
                    <div class="col-sm-3">

                    </div>
                </div>
            </div><br>
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
                                            <option value="SCB">SCB</option>
                                            <option value="KTB">KTB</option>
                                            <option value="BBL">BBL</option>
                                            <option value="KBANK">KBANK</option>
                                            <option value="Wallet">Wallet</option>
                                            <option value="PrompPay">PrompPay</option>
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

                    if($row2['bankName']=='SCB'){
                        echo"<tr>
                     <td style=\"text-align:center;\"><img src=\"../images/bank/scb.png\"  width=\"100%\"></td>
                     <td style=\"text-align:center;\">$row2[bankName]</td>
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
                    else if($row2['bankName']=='KTB'){
                        echo"<tr>
                     <td style=\"text-align:center;\"><img src=\"../images/bank/ktb.jpg\"  width=\"100%\"></td>
                     <td style=\"text-align:center;\">$row2[bankName]</td>
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
                    else if($row2['bankName']=='BBL'){
                        echo"<tr>
                     <td style=\"text-align:center;\"><img src=\"../images/bank/bbl.png\"  width=\"100%\"></td>
                     <td style=\"text-align:center;\">$row2[bankName]</td>
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
                    else if($row2['bankName']=='KBANK'){
                        echo"<tr>
                     <td style=\"text-align:center;\"><img src=\"../images/bank/kbank.png\"  width=\"100%\"></td>
                     <td style=\"text-align:center;\">$row2[bankName]</td>
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
                    else if($row2['bankName']=='Wallet'){
                        echo"<tr>
                     <td style=\"text-align:center;\"><img src=\"../images/bank/true.jpg\"  width=\"100%\"></td>
                     <td style=\"text-align:center;\">$row2[bankName]</td>
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
                    else if($row2['bankName']=='PrompPay'){
                        echo"<tr>
                     <td style=\"text-align:center;\"><img src=\"../images/bank/promptpay.png\"  width=\"100%\"></td>
                     <td style=\"text-align:center;\">$row2[bankName]</td>
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
