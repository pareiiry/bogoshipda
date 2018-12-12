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


if(isset($_GET['page'])){
    $page = $_GET['page'];
    if($_GET['page']==""||$_GET['page']=="1"){
        $pageshow=0;

    }
    else{
        $pageshow=($page*10)-10;
    }
}
else{
    $pageshow=0;
}

if(!isset($_GET['page'])){
    $sql2 = "SELECT * FROM product WHERE product.delete = 0 ORDER BY dateCreate DESC LIMIT $pageshow,10";
    $result2 = mysqli_query($con,$sql2);

    $sql3 = "SELECT * FROM product WHERE product.delete=0 ORDER BY dateCreate DESC";
    $result3 = mysqli_query($con,$sql3);
    $all_pd_count = mysqli_num_rows($result3);
    $cal=$all_pd_count/10;
    $page_of_pd = ceil($cal);
}
else{

    $sql2 = "SELECT * FROM product WHERE product.delete=0 ORDER BY dateCreate DESC LIMIT $pageshow,10";
    $result2 = mysqli_query($con, $sql2);

    $sql3 = "SELECT * FROM product WHERE product.delete=0 ORDER BY dateCreate DESC";
    $result3 = mysqli_query($con, $sql3);
    $all_pd_count = mysqli_num_rows($result3);
    $cal = $all_pd_count / 10;
    $page_of_pd = ceil($cal);
}

//$sql2 = "SELECT * FROM product WHERE product.delete = 0";
////$objQuery = mysqli_query($strSQL);
////$objResult = mysqli_fetch_array($objQuery);
//$result2 = mysqli_query($con,$sql2);
////$row_getimgGID = mysqli_fetch_array($result2,MYSQLI_ASSOC);

$sqlOrder2 = "SELECT * FROM order_table WHERE orderStatus='waiting for payment'";
$resultOrder2 = mysqli_query($con,$sqlOrder2);
$countNoti = mysqli_num_rows($resultOrder2);

$sqlOrder3 = "SELECT * FROM order_table WHERE orderStatus='waiting for verify'";
$resultOrder3 = mysqli_query($con,$sqlOrder3);
$countNotiPay = mysqli_num_rows($resultOrder3);

$sqlOrder4 = "SELECT * FROM order_table WHERE orderStatus='prepare to send order'";
$resultOrder4 = mysqli_query($con,$sqlOrder4);
$countNotiShipment = mysqli_num_rows($resultOrder4);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bogoshipda Admin | รายการสินค้า</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    <link rel="icon" type="image/png" href="../images/icons/favicon.png"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="../css/lightbox.css">
    <style>
        .pagination {
            /*margin-right: -6px;*/
            /*margin-left: -6px;*/
        }

        .item-pagination {
            font-family: Montserrat-Regular;
            font-size: 13px;
            color: #808080;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid #eeeeee;
            margin: 6px;
        }

        .item-pagination:hover {
            background-color: #222222;
            color: white;
        }

        .active-pagination {
            background-color: #222222;
            color: white;
        }
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

        /* Darker background on mouse-over */
        .btn-delete:hover {
            background-color: #d15252;
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
                <a href="indexForOwner.php" ><img class="bg-icon-current" src="../img/menu_bar_admin/product.png" style="width:100%; " alt="Image">สินค้า</a>
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
                <a href="shipping.php"><img class="bg-icon" src="../img/menu_bar_admin/shipment.png" style="width:100%" alt="Image">ขนส่ง<span class="menu-icons-noti"><?php echo $countNotiShipment;?></a>
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
                <div class="col-sm-4"><a href="addProduct.php" class="btn btn-info" role="button" style="margin-left: 2%;margin-top: 3%" >+ เพิ่มสินค้า</a></div>
                <div class="col-sm-4" align="center"><h3><b>รายการสินค้า</b></h3></div>
                <div class="col-sm-4"><input type="text" id="myInput" onkeyup="search()" placeholder="ค้นหาสินค้า..." title="Type in a name" width="100%" align="right"></div>
            </div>


            <hr>


            <table id="myTable">
                <thead>
                <tr class="header">
                    <th style="width:15%;text-align:center;">รูปสินค้า</th>
                    <th style="width:15%;text-align:center;">รหัสสินค้า</th>
                    <th style="width:20%;text-align:center;">ชื่อสินค้า</th>
                    <th style="width:10%;text-align:center;">ราคาขาย</th>
                    <th style="width:10%;text-align:center;">ต้นุทน</th>
                    <th style="width:10%;text-align:center;">จัดการ</th>
                </tr>
                </thead>
                <?php
                while($row2= mysqli_fetch_assoc($result2))// show the information from query
                {
                    echo "<tr>";
                    if($row2['custom']==1){
                        $sql3 = "SELECT * FROM design WHERE design.pdID= '".$row2["pdID"]."' LIMIT 1";
                        $result3 = mysqli_query($con, $sql3);
                        $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                        echo "
                    <td style=\"text-align:center;\">";
                        if($row3['imgPath']==="" || empty($row3)){

                            echo '<img style="width:30%" src="../images/no-picture.jpg">';
                        }
                        else {
                            echo '<a class="example-image-link" href="../member/'.$row3['imgPath'].'" data-lightbox="product"><img style="width:30%" src="../member/'.$row3['imgPath'].'"/></a>';
                        }
                        echo"</td>";
                    }
                    else{
                        $sql3 = "SELECT * FROM image WHERE pdID= '".$row2['pdID']."' LIMIT 1";
                        $result3 = mysqli_query($con,$sql3);
                        $row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);

                        echo "
                 
                    <td style=\"text-align:center;\">";
                        if($row3['pdImgPath']==="" || empty($row3)){
                            echo '<img style="width:30%" src="../images/no-picture.jpg">';
                        }
                        else {
                            echo '<a class="example-image-link" href="../'.$row3['pdImgPath'].'" data-lightbox="product"><img style="width:30%" src="../'.$row3['pdImgPath'].'"/></a>';
//                            echo '<a class="example-image-link" href="data:image/*;base64,'.base64_encode($row3['img']).'" data-lightbox="product"><img style="width:30%" src="data:image/*;base64,' . base64_encode($row3['img']) . '"/></a>';
                        }
                        echo"</td>";
                    }

                echo"
                    <td>$row2[pdID]</td>
                    <td>$row2[name]</td>
                     <td style=\"text-align:center;\">$row2[price]</td>
                     <td style=\"text-align:center;\">$row2[cost]</td>
                    <td style=\"text-align:center;\">
                       ";
                       if($row2['custom']==1){
                           echo"<div class='row'>
                       <div class=\"col-md-4\">
                        </div>
                        <div class=\"col-md-6\" >
                        <form action=\"Action/deleteProduct_action.php\" method=\"get\">
                                <input style='display: none;' type=\"text\" name=\"pdID\" value='$row2[pdID]'>
                                <button class='btn-delete' type=\"submit\"><i class=\"fa fa-trash\"></i></button>
                        </form></div>
                        </div>";
                       }
                       else{
                           echo"<div class='row'>
                       <div class=\"col-md-4\"><form action=\"editProduct.php\" method=\"get\">
                            <input style='display: none;' type=\"text\" name=\"pdID\" value='$row2[pdID]'>
                            <button class='btn-edit' type=\"submit\"><i class=\"fa fa-edit\"></i></button>
                        </form>
                        </div>
                        <div class=\"col-md-6\" >
                        <form action=\"Action/deleteProduct_action.php\" method=\"get\">
                                <input style='display: none;' type=\"text\" name=\"pdID\" value='$row2[pdID]'>
                                <button class='btn-delete' type=\"submit\"><i class=\"fa fa-trash\"></i></button>
                        </form></div>
                        </div>";
                       }


                        echo"
                        
                        
                    </td>
                    </tr>
                    ";
                }?>


            </table>

            <div class="pagination flex-m flex-w p-t-26">
                <?php
                for($pn=1;$pn<=$page_of_pd;$pn++){

                    echo  "<a href=\"indexForOwner.php?page=$pn\" class=\"item-pagination flex-c-m trans-0-4\">$pn</a>";

                }
                ?>
            </div>

            <script>
                function search() {
                    var input, filter, table, tr, td, i,td2;
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[1];
                        td2 = tr[i].getElementsByTagName("td")[2];
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
<script src="../js/lightbox.js"></script>
</body>
</html>
