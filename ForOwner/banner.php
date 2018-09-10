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


$sqlB = "SELECT * FROM banner";
$resultB = mysqli_query($con,$sqlB);
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
            height: 1600px;
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
                        <a href="order.php"><img class="bg-icon" src="../img/menu_bar_admin/order.png" style="width:100%" alt="Image">สั่งซื้อ</a>
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
                        <a href="banner.php"><img class="bg-icon-current" src="../img/menu_bar_admin/news.png" style="width:100%" alt="Image">BANNER</a>
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

        <div class="col-sm-9">

                <div class="row" style="margin-top: 5px">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4" align="center"><h3><b>BANNER</b></h3></div>

                    <div class="col-sm-4 " align="right">
                    </div>

                    <!--                <div class="col-sm-4"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหาสินค้า..." title="Type in a name" width="100%"></div>-->
                </div>

                <hr>

                <div class="row" style="margin-top: 20px">
                    <form method="post" action="Action/addBanner_action.php" enctype="multipart/form-data">
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading" align="center"  style="background-color:#edf9f7;"><b>เพิ่มรูปภาพ</b></div>
                            <div class="panel-body" style="margin: 0% 2% 0% 2%">
                                <!--                            <form method="post">-->

                                    <div class="btn-group" style="margin: 0 0 2% 0;width: 100%">
                                        <form method="post" action="#" enctype="multipart/form-data">
                                            Select files: <input style="margin:2% 0 2% 0 " type="file" name="filesToUploadBanner[]" id="filesToUploadBanner" multiple onchange="makeFileList2();">
                                            <!--                                        <input type="submit">-->
                                        </form>
                                        รูปภาพที่เลือก :
                                        <ul id="fileList2" style="list-style-type:none"><li>ไม่มีรูปภาพที่เลือก</li></ul>

                                        <script>
                                            function makeFileList2() {
                                                var input = document.getElementById("filesToUploadBanner");
                                                var ul = document.getElementById("fileList2");
                                                while (ul.hasChildNodes()) {
                                                    ul.removeChild(ul.firstChild);
                                                }
                                                for (var i = 0; i < input.files.length; i++) {
                                                    var li = document.createElement("li");
                                                    li.innerHTML = input.files[i].name;
                                                    ul.appendChild(li);
                                                }
                                                if(!ul.hasChildNodes()) {
                                                    var li = document.createElement("li");
                                                    li.innerHTML = 'ไม่มีรูปภาพที่เลือก';
                                                    ul.appendChild(li);
                                                }
                                            }

                                        </script>
                                    </div>
                                <input  class="form-control btn btn-success" type="submit" value="เพิ่มรูปภาพ" style="margin-top: 3%">
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
                                        <th style="width:10%;text-align:center;">รูปภาพ</th>
                                        <th style="width:5%;text-align:center;"></th>
                                    </tr>
                                    </thead>
                                        <?php
                                        while($rowB = mysqli_fetch_assoc($resultB))// show the information from query
                                        {
                                                echo '<tr><td style="text-align: center"><img style="width:50%" src="data:image/*;base64,' . base64_encode($rowB['bImg']) . '"/></td>';
                                                ?><td>
                                                <form action="Action/deleteBanner.php" method="get">
                                                    <input style='display: none;' type="text" name="bID" value='<?php echo $rowB['bID'];?>'>
                                                    <button class='btn-delete' type="submit"><i class="fa fa-trash"></i></button>
                                                </form>
                                                </td><?php echo'</tr>';
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
