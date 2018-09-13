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


$sql2 = "SELECT * FROM product WHERE pdID = '".$_GET['pdID']."' ";;
//$objQuery = mysqli_query($strSQL);
//$objResult = mysqli_fetch_array($objQuery);
$result2 = mysqli_query($con,$sql2);
$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
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
    <link rel="stylesheet" type="text/css" href="../css/styleOwner.css">
    <link rel="icon" type="image/png" href="../images/icons/favicon.png"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
        .row.content {height: 1500px}

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
            <form method="post" action="Action/editProduct_action.php" enctype="multipart/form-data">
                <div class="row" style="margin-top: 5px">
                    <div class="col-sm-4"><a href="indexForOwner.php" class="btn btn-primary" role="button" style="margin-left: 2%;margin-top: 3%" >< กลับไปหน้ารายการสินค้า</a></div>
                    <div class="col-sm-4" align="center"><h3><b>แก้ไขสินค้า</b></h3></div>

                    <div class="col-sm-4 " align="right">
                        <input class="btn btn-success" type="submit" value="แก้ไข" style="margin-left: 2%;margin-top: 3%">
                        <a href="indexForOwner.php" class="btn btn-danger" role="button" type="clear" style="margin-left: 2%;margin-top: 3%" >ยกเลิก</a>
                    </div>

                    <!--                <div class="col-sm-4"><input type="text" id="myInput" onkeyup="myFunction()" placeholder="ค้นหาสินค้า..." title="Type in a name" width="100%"></div>-->
                </div>

                <hr>

                <div class="row" style="margin-top: 20px">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <input style='display: none;' type="text" name="pdID" value='<?php echo $row2['pdID'];?>'>
                            <div class="panel-heading"><b>ข้อมูลสินค้า</b></div>
                            <div class="panel-body" style="margin: 0% 2% 0% 2%">
                                <!--                            <form method="post">-->
                                <div class="btn-group" style="margin: 0 0 2% 0">
                                    <label>ชื่อสินค้า:</label>
                                    <input size="100%" class="form-control" type="text" name="name" value="<?php echo $row2['name'];?>" required>
                                </div>
                                <div class="row" >
                                    <div class="col-md-6" style="margin: 0 0 2% 0">
                                        <div class="btn-group">
                                            <label>ราคา:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">฿</span>
                                                <input size="45%" class="form-control" type="number" min="0.00" step="0.01" id="price" name="price" value="<?php echo $row2['price'];?>" required> <!--onkeyup="enterNumber()"-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <label>ต้นทุน:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">฿</span>
                                                <input size="45%" class="form-control" type="number" min="0.00" step="0.01" id="cost" name="cost" value="<?php echo $row2['cost'];?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label>สี:</label>
                                <select class="form-control" name="color">
                                    <option value="white" <?php if(isset($row2['color']) && ($row2['color']=='white'))echo 'selected' ?>>สีขาว</option>
                                    <option value="cream" <?php if(isset($row2['color']) && ($row2['color']=='cream'))echo 'selected' ?>>สีครีม</option>
                                    <option value="milktea" style="color: #fdebc3" <?php if(isset($row2['color']) && ($row2['color']=='milktea'))echo 'selected' ?>>สีชานม</option>
                                    <option value="yellow"  style="color: #fcff00" <?php if(isset($row2['color']) && ($row2['color']=='yellow'))echo 'selected' ?>>สีเหลือง</option>
                                    <option value="green" style="color: #8ae671" <?php if(isset($row2['color']) && ($row2['color']=='green'))echo 'selected' ?>>สีเขียว</option>
                                    <option value="darkgreen" style="color: #388b6f" <?php if(isset($row2['color']) && ($row2['color']=='darkgreen'))echo 'selected' ?>>สีเขียวเข้ม</option>
                                    <option value="mint" style="color: #b4ffcb" <?php if(isset($row2['color']) && ($row2['color']=='mint'))echo 'selected' ?>>สีมิ้นต์</option>
                                    <option value="sky" style="color: #43abea" <?php if(isset($row2['color']) && ($row2['color']=='sky'))echo 'selected' ?>>สีฟ้าเข้ม</option>
                                    <option value="orange" style="color: #ffd28b" <?php if(isset($row2['color']) && ($row2['color']=='orange'))echo 'selected' ?>>สีส้มอ่อน</option>
                                    <option value="lightpink" style="color: #ffe5e5" <?php if(isset($row2['color']) && ($row2['color']=='lightpink'))echo 'selected' ?>>สีชมพูอ่อน</option>
                                    <option value="pink" style="color: #ffb0bb" <?php if(isset($row2['color']) && ($row2['color']=='pink'))echo 'selected' ?>>สีชมพู</option>
                                    <option value="darkpink" style="color: #f95a7c" <?php if(isset($row2['color']) && ($row2['color']=='darkpink'))echo 'selected' ?>>สีชมพูเข้ม</option>
                                    <option value="red" style="color: #e20000" <?php if(isset($row2['color']) && ($row2['color']=='red'))echo 'selected' ?>>สีแดง</option>
                                    <option value="purple" style="color: #ebd1e9" <?php if(isset($row2['color']) && ($row2['color']=='purple'))echo 'selected' ?>>สีม่วง</option>
                                    <option value="lightgray" style="color: #d7d8e4" <?php if(isset($row2['color']) && ($row2['color']=='lightgray'))echo 'selected' ?>>สีเทาอมฟ้า</option>
                                    <option value="darkgray" style="color: #727875" <?php if(isset($row2['color']) && ($row2['color']=='darkgray'))echo 'selected' ?>>สีเทาเข้ม</option>
                                    <option value="brown" style="color: #72552a" <?php if(isset($row2['color']) && ($row2['color']=='brown'))echo 'selected' ?>>สีน้ำตาล</option>
                                    <option value="black" <?php if(isset($row2['color']) && ($row2['color']=='black'))echo 'selected' ?>>สีดำ</option>
                                </select>
                                <div class="btn-group" style="margin: 0 0 2% 0">
                                    <label>คำอธิบายสินค้า:</label>
                                    <textarea class="form-control" style="min-width: 320%" rows="5" name="description"><?php echo $row2['description'];?></textarea>
                                </div>
                                <!--                            </form>-->
                            </div>
                        </div>
                    </div>
            </form>
            <div class="col-md-4">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>รูปภาพสินค้า</b></div>
                    <div class="panel-body" >

                        รูปภาพ :
                        <?php
                        $sql3 = "SELECT * FROM image WHERE pdID= '".$row2['pdID']."'";
                        $result3 = mysqli_query($con,$sql3);
                        //$row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);
                        echo "<table style='margin-right: 3%' width='100%' '>";
                        //                                    print_r($result3);
                        //                                    echo mysqli_num_rows($result3);
                        while($row3= mysqli_fetch_assoc($result3)){
                            if($row3['img']===""){
                                echo "<br><center><font color='red'>ไม่มีรูปภาพที่จะแสดง</font></center>";
                            }
                            else{
                                echo"<tr><td align='right' style='padding: 7px'>";
                                echo '<img class="img-thumbnail" style="width:50%" src="data:image/*;base64,'.base64_encode($row3['img']).'"/>';
                                echo "</td><td align='left' width='50%'>"; ?>
                                <form action="Action/deleteImg_action.php" method="get">
                                    <input style='display: none;' type="text" name="imgID" value='<?php echo $row3['imgID'];?>'>
                                    <button class='btn-delete' type="submit"><i class="fa fa-trash"></i></button>
                                </form>
                                <?php
                                echo "</td></tr>";
                            }


                        }echo "</table>";?>
                        <br>
                        <div class="btn-group">
                            <form method="post" action="Action/addEditImg_action.php" enctype="multipart/form-data">
                                Select files: <input style="margin:2% 0 2% 0 " type="file" name="filesToUpload[]" id="filesToUpload" multiple onchange="makeFileList();">
                                <!--                                        <input type="submit">-->
                                <input style='display: none;' type="text" name="pdID" value='<?php echo $row2['pdID'];?>'>

                                รูปภาพที่เลือก :
                                <ul id="fileList" style="list-style-type:none"><li><font color='red'>ไม่มีรูปภาพที่เลือก</font></li></ul>

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
                                            li.innerHTML = '<font color=\'red\'>ไม่มีรูปภาพที่เลือก</font>';
                                            ul.appendChild(li);
                                        }
                                    }

                                </script>
                                <button class='form-control btn btn-success' type="submit">อัพโหลดรูปภาพ</button>
                            </form>
                        </div>

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
