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
    <title>Bogoshipda Admin | เพิ่มสินค้า</title>
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
                <a href="indexForOwner.php" ><img class="bg-icon-current" src="../img/menu_bar_admin/product.png" style="width:100%; " alt="Image">สินค้า</a>
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
            <form method="post" action="Action/addProduct_action.php" enctype="multipart/form-data">
            <div class="row" style="margin-top: 5px">
                <div class="col-sm-4"><a href="indexForOwner.php" class="btn btn-primary" role="button" style="margin-left: 2%;margin-top: 3%" >< กลับไปหน้ารายการสินค้า</a></div>
                <div class="col-sm-4" align="center"><h4>จัดการสินค้า</h4></div>

                <div class="col-sm-4 " align="right">
                    <input class="btn btn-success" type="submit" value="บันทึก" style="margin-left: 2%;margin-top: 3%">
                    <a href="indexForOwner.php" class="btn btn-danger" role="button" type="clear" style="margin-left: 2%;margin-top: 3%" >ยกเลิก</a>
                </div>

<!--                <div class="col-sm-4"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหาสินค้า..." title="Type in a name" width="100%"></div>-->
            </div>

            <hr>

            <div class="row" style="margin-top: 20px">
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <script type="text/javascript">

                            // function enterNumber(){
                            //
                            //     var e = document.getElementById('price');
                            //
                            //     if (!/^\d+(\.\d{1,2})?$/.test(e.value))
                            //     {
                            //         alert("ไม่สามารถใส่จำนวนติดลบได้ค่ะ");
                            //         //e.value = '';
                            //         e.value = e.value.substring(0,e.value.length-1);
                            //     }
                            // }
                            // function enterNumber2(){
                            //
                            //     var e = document.getElementById('cost');
                            //
                            //     if (!/^-/.test(e.value))
                            //     {
                            //         alert("ไม่สามารถใส่จำนวนติดลบได้ค่ะ");
                            //         //e.value = '';
                            //         e.value = e.value.substring(0,e.value.length-1);
                            //     }
                            // }

                        </script>
                        <div class="panel-heading">ข้อมูลสินค้า</div>
                        <div class="panel-body" style="margin: 0% 2% 0% 2%">
<!--                            <form method="post">-->
                                <div class="btn-group" style="margin: 0 0 2% 0">
                                    <label>ชื่อสินค้า:</label>
                                    <input size="100%" class="form-control" type="text" name="name" value="" required>
                                </div>
                                <div class="row" >
                                    <div class="col-md-6" style="margin: 0 0 2% 0">
                                        <div class="btn-group">
                                            <label>ราคา:</label>
                                            <div class="input-group">
                                            <span class="input-group-addon">฿</span>
                                            <input size="45%" class="form-control" type="number" min="0.00" step="0.01" id="price" name="price" value="" required> <!--onkeyup="enterNumber()"-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <label>ต้นทุน:</label>
                                            <div class="input-group">
                                            <span class="input-group-addon">฿</span>
                                            <input size="45%" class="form-control" type="number" min="0.00" step="0.01" id="cost" name="cost" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <label>สี:</label>
                            <select class="form-control" name="color">
                                <option value="white">สีขาว</option>
                                <option value="cream">สีครีม</option>
                                <option value="milktea" style="color: #fdebc3">สีชานม</option>
                                <option value="yellow" style="color: #fcff00">สีเหลือง</option>
                                <option value="green" style="color: #8ae671">สีเขียว</option>
                                <option value="darkgreen" style="color: #388b6f">สีเขียวเข้ม</option>
                                <option value="mint" style="color: #b4ffcb">สีมิ้นต์</option>
                                <option value="sky" style="color: #43abea">สีฟ้าเข้ม</option>
                                <option value="orange" style="color: #ffd28b">สีส้มอ่อน</option>
                                <option value="lightpink" style="color: #ffe5e5">สีชมพูอ่อน</option>
                                <option value="pink" style="color: #ffb0bb">สีชมพู</option>
                                <option value="darkpink" style="color: #f95a7c">สีชมพูเข้ม</option>
                                <option value="red" style="color: #e20000">สีแดง</option>
                                <option value="purple" style="color: #ebd1e9">สีม่วง</option>
                                <option value="lightgray" style="color: #d7d8e4">สีเทาอมฟ้า</option>
                                <option value="darkgray" style="color: #727875">สีเทาเข้ม</option>
                                <option value="brown" style="color: #72552a">สีน้ำตาล</option>
                                <option value="black">สีดำ</option>
                            </select>

                                <div class="btn-group" style="margin: 2% 0 2% 0">
                                    <label>คำอธิบายสินค้า:</label>
                                    <textarea class="form-control" style="min-width: 320%" rows="5" name="description"></textarea>
                                </div>
<!--                            </form>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">รูปภาพสินค้า</div>
                        <div class="panel-body" >

                                <div class="btn-group">
                                    <form method="post" action="#" enctype="multipart/form-data">
                                        Select files: <input style="margin:2% 0 2% 0 " type="file" name="filesToUpload[]" id="filesToUpload" multiple onchange="makeFileList();">
<!--                                        <input type="submit">-->
                                    </form>
                                    รูปภาพที่เลือก :
                                    <ul id="fileList" style="list-style-type:none"><li>ไม่มีรูปภาพที่เลือก</li></ul>

                                    <script>
                                        function makeFileList() {
                                            var input = document.getElementById("filesToUpload");
                                            var ul = document.getElementById("fileList");
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

                        </div>
                    </div>
                </div>
            </div>

            </form>

            <!--            <h2>I Love Food</h2>-->
            <!--            <h5><span class="glyphicon glyphicon-time"></span> Post by Jane Dane, Sep 27, 2015.</h5>-->
            <!--            <h5><span class="label label-danger">Food</span> <span class="label label-primary">Ipsum</span></h5><br>-->
            <!--            <p>Food is my passion. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
            <!--            <br><br>-->

            <!--            <h4><small>RECENT POSTS</small></h4>-->
            <!--            <hr>-->
            <!--            <h2>Officially Blogging</h2>-->
            <!--            <h5><span class="glyphicon glyphicon-time"></span> Post by John Doe, Sep 24, 2015.</h5>-->
            <!--            <h5><span class="label label-success">Lorem</span></h5><br>-->
            <!--            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
            <!--            <hr>-->

            <!--            <h4>Leave a Comment:</h4>-->
            <!--            <form role="form">-->
            <!--                <div class="form-group">-->
            <!--                    <textarea class="form-control" rows="3" required></textarea>-->
            <!--                </div>-->
            <!--                <button type="submit" class="btn btn-success">Submit</button>-->
            <!--            </form>-->
            <!--            <br><br>-->

            <!--            <p><span class="badge">2</span> Comments:</p><br>-->

            <!--            <div class="row">-->
            <!--                <div class="col-sm-2 text-center">-->
            <!--                    <img src="bandmember.jpg" class="img-circle" height="65" width="65" alt="Avatar">-->
            <!--                </div>-->
            <!--                <div class="col-sm-10">-->
            <!--                    <h4>Anja <small>Sep 29, 2015, 9:12 PM</small></h4>-->
            <!--                    <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
            <!--                    <br>-->
            <!--                </div>-->
            <!--                <div class="col-sm-2 text-center">-->
            <!--                    <img src="bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">-->
            <!--                </div>-->
            <!--                <div class="col-sm-10">-->
            <!--                    <h4>John Row <small>Sep 25, 2015, 8:25 PM</small></h4>-->
            <!--                    <p>I am so happy for you man! Finally. I am looking forward to read about your trendy life. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
            <!--                    <br>-->
            <!--                    <p><span class="badge">1</span> Comment:</p><br>-->
            <!--                    <div class="row">-->
            <!--                        <div class="col-sm-2 text-center">-->
            <!--                            <img src="bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">-->
            <!--                        </div>-->
            <!--                        <div class="col-xs-10">-->
            <!--                            <h4>Nested Bro <small>Sep 25, 2015, 8:28 PM</small></h4>-->
            <!--                            <p>Me too! WOW!</p>-->
            <!--                            <br>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
        </div>
    </div>
</div>
<!--<footer class="container-fluid">-->
<!--    <p></p>-->
<!--</footer>-->

</body>
</html>
