<?php
session_start();
if($_SESSION['ID'] == "")
{
    //echo "Please Login!";
    header("location:../loginPage.php");
    exit();
}
if($_SESSION['usertype'] != "member")
{
    //echo "ของ Adminเท่านั้นจ้าาา";
    exit();
}

include ('../dbConnect.php');
$sql = "SELECT * FROM user WHERE uID = '".$_SESSION['ID']."' ";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

$sqlB = "SELECT * FROM bank";
$resultB = mysqli_query($con,$sqlB);
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Bogoshipda | สั่งซื้อเรียบร้อย</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="../images/icons/favicon.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/themify/themify-icons.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fonts/elegant-font/html-css/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../vendor/lightbox2/css/lightbox.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../css/util.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!--===============================================================================================-->
    <style>
        table{
            margin: auto;
            width: 80%;
            margin-bottom: 50px;
        }
        td{
            padding-top: 10px;
        }


    </style>
</head>
<body class="animsition">

<!-- Header -->
<header class="header1">
    <!-- Header desktop -->
    <div class="container-menu-header" >
        <div class="topbar">
            <div class="topbar-social">
                <a href="https://twitter.com/bogoshipdastore" class="topbar-social-item fa fa-twitter"></a>
                <a href="https://www.instagram.com/bogoshipda_store" class="topbar-social-item fa fa-instagram"></a>
            </div>

            <span class="topbar-child1">
					-
				</span>

            <div class="topbar-child2">
					<span class="topbar-email">
						สวัสดี คุณ <?php echo "".$row["name"];?>
					</span>
            </div>
        </div>

        <div class="wrap_header">
            <!-- Logo -->
            <a href="indexMember2.php" class="logo" >
                <font size="5"><b>Bogoshipda</b></font>
                <!-- <img src="images/icons/logo.png" alt="IMG-LOGO">-->
            </a>

            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li>
                            <a href="indexMember2.php">หน้าแรก</a>
                        </li>

                        <li>
                            <a href="product.php?color=all">สินค้า</a>
                        </li>

                        <li>
                            <a href="review.php">รีวิว</a>
                        </li>

                        <li>
                            <a href="design.php">ออกแบบ</a>
                        </li>
                        <li>
                            <a href="help.php">ช่วยเหลือ</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- Header Icon -->
            <div class="header-icons">
                <div class="header-wrapicon1">
                    <img src="../images/icons/icon-header-01.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <div class="header-cart header-dropdown">
                        <center><?php echo "".$row["name"];?></center><hr>
                        <li>
                            <a href="myprofile.php">ข้อมูลส่วนตัว</a>
                        </li>
                        <li>
                            <a href="history.php">ประวัติการสั่งซื้อ</a>
                        </li>
                        <li>
                            <a href="addReview.php">เพิ่มรีวิวสินค้า</a>
                        </li>
                        <li>
                            <a href="myreview.php">รีวิวของฉัน</a>
                        </li>
                        <li>
                            <a href="../logout.php">ลงชื่อออก</a>
                        </li>
                    </div>
                </div>


            </div>

        </div>
    </div>

</header>

<section class="cart bgwhite p-t-70 p-b-100">

    <div class="container">

        <div class="bo9 w-size29 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
            <table>
                <tr>
                    <td colspan="2">
                         <h5 class="m-text20 p-b-24" align="center">
                            <img src="../images/icons/success.png">
                            <br>
                            สั่งซื้อเรียบร้อย (รอชำระเงิน)</h5>
                            <h6 align="center" style="color: darkgray">เลขที่รายการสั่งซื้อของคุณคือ <?php echo $_GET['orderID']; ?>  </h6>
                    </td>
                </tr>
                <?php $sqlOrder = "SELECT * FROM order_table WHERE orderID = '".$_GET['orderID']."' ";
                $resultOrder = mysqli_query($con,$sqlOrder);
                $rowOrder = mysqli_fetch_array($resultOrder,MYSQLI_ASSOC);?>
                <tr>
                    <td align="center">จำนวนเงินที่ต้องชำระ
                        <h4 style="color: #ffaeba">฿ <?php echo number_format($rowOrder['netPrice'], 2);?></h4>
                    </td>
                    <td align="center">สถานะรายการสั่งซื้อ
                    <h4 style="color: limegreen">รอชำระเงิน</h4>
                    </td>
                </tr>
            </table>
            <?php $payDate = date('d-m-Y',strtotime($rowOrder['dateTime'] . "+5 days"));?>
            <h6 align="center" style="color: red">กรุณาชำระเงินภายในวันที่ <?php echo $payDate;?> หากไม่ได้ชำระเงินภายในวันที่กำหนด รายการสั่งซื้อของคุณจะถูกยกเลิกโดยอัตโนมัติ</h6>
            <hr>
            <h5 class="m-text20 p-b-24" align="center">
                วิธีการชำระเงิน</h5>
            <table>
                <thead style=" color:#ffaeba">
                <tr>
                    <th></th>
                    <th style="text-align:center;">ธนาคาร</th>
                    <th style="text-align:center;">ชื่อที่บัญชี</th>
                    <th style="text-align:center;">เลขบัญชี</th>

                </tr>
                </thead>

                <?php

                while($row2= mysqli_fetch_assoc($resultB))// show the information from query
                {
                    echo"<tr>";
                    if($row2['bankName']=='SCB'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/scb.png\"  width=\"20%\"></td>";
                    }
                    else if($row2['bankName']=='KTB') {
                        echo " <td style=\"text-align:center;\"><img src=\"../images/bank/ktb.jpg\"  width=\"20%\"></td>";
                    }
                    else if($row2['bankName']=='BBL'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/bbl.png\"  width=\"20%\"></td>";
                    }
                    else if($row2['bankName']=='KBANK'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/kbank.png\"  width=\"20%\"></td>";
                    }else if($row2['bankName']=='GSB'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/gsb.png\"  width=\"20%\"></td>";
                    }  else if($row2['bankName']=='KRUNGSRI'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/krungsri.png\"  width=\"20%\"></td>";
                    }
                    else if($row2['bankName']=='TMB'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/tmb.png\"  width=\"20%\"></td>";
                    }
                    else if($row2['bankName']=='UOB'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/uob.png\"  width=\"20%\"></td>";
                    }
                    else if($row2['bankName']=='TBANK') {
                        echo "<td style=\"text-align:center;\"><img src=\"../images/bank/tbank.png\"  width=\"20%\"></td>";
                    }else if($row2['bankName']=='CIMB'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/cimb.png\"  width=\"20%\"></td>";
                    }
                    else if($row2['bankName']=='CITIBANK'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/citibank.png\"  width=\"20%\"></td>";
                    }
                    else if($row2['bankName']=='SCBT'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/standardcharter.png\"  width=\"20%\"></td>";
                    }
                    else if($row2['bankName']=='TISCO'){
                        echo"<td style=\"text-align:center;\"><img src=\"../images/bank/tisco.png\"  width=\"20%\"></td>";
                    }
                    else if($row2['bankName']=='Wallet') {
                        echo "<td style=\"text-align:center;\"><img src=\"../images/bank/true.jpg\"  width=\"20%\"></td>";
                    }
                    else if($row2['bankName']=='PrompPay') {
                        echo "<td style=\"text-align:center;\"><img src=\"../images/bank/promptpay.png\"  width=\"20%\"></td>";
                    }
                    echo "<td style=\"text-align:center;\">$row2[bankName]</td>
                     <td style=\"text-align:center;\">$row2[accountName]</td>
					 <td style=\"text-align:center;\">$row2[accountNumber]</td>
                  
                    </tr>";



                }
                ?>
            </table>
        </div>
    </div>

</section>
<!-- Banner2 -->



<!-- Blog -->


<!-- Instagram -->


<!-- Footer -->
<footer class="bg6 p-t-45 p-b-43 p-l-45 p-r-45">
    <div class="flex-w p-b-90">
        <div class="w-size6 p-t-30 p-l-15 p-r-15 respon3">
            <h4 class="s-text12 p-b-30">
                bogoshipda.com
            </h4>

            <div>
                <p class="s-text7 w-size27">
                    Chiangmai, Thailand
                </p>

                <div class="flex-m p-t-30">
                    <a href="https://twitter.com/bogoshipdastore" class="topbar-social-item fa fa-twitter"></a>
                    <a href="https://www.instagram.com/bogoshipda_store" class="topbar-social-item fa fa-instagram"></a>
                </div>
            </div>
        </div>

        <div class="w-size8 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text12 p-b-30">
                ติดต่อเรา
            </h4>

            <ul>
                <li class="p-b-9 s-text7">
                    <a href="mailto:bogoshipdashop@gmail.com?Subject=สอบถามข้อมูล" target="_top">
                        bogoshipdashop@gmail.com</a>
                </li>

                <li class="p-b-9 s-text7">
                    Tel. 082-6118627
                </li>

                <li class="p-b-9 s-text7">
                    Line id : bogoshipdastore
                </li>

            </ul>
        </div>

        <div class="w-size15 p-t-30 p-l-15 p-r-15 respon4">
            <h4 class="s-text12 p-b-30">
                บริการจัดส่ง
            </h4>

            <ul>
                <li class="p-b-9 s-text7">
                    <a href="http://track.thailandpost.co.th/tracking/default.aspx">
                        Thailand Post</a>
                </li>
                <li class="p-b-9 s-text7">
                    <a href="https://th.kerryexpress.com/th/track/">
                        Kerry Express</a>
                </li>

            </ul>
        </div>

        <div class="w-size7 p-t-30 p-l-15 p-r-15 respon4">
            <a href="payment.php"><h4 class="s-text12 p-b-30">
                    วิธีการชำระเงิน
                </h4></a>
            <ul>
                <li class="p-b-9 s-text7">
                    KTB &emsp;  K-BANK
                </li>
                <li class="p-b-9 s-text7">
                    BBL  &emsp; Wallet
                </li>
                <li class="p-b-9 s-text7">
                    SCB &emsp; PrompPay
                </li>
            </ul>
        </div>


    </div>



    <div class="t-center s-text8 p-t-20">
        Copyright © 2018 All rights reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
    </div>

</footer>



<!-- Back to top -->
<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-double-up" aria-hidden="true"></i>
		</span>
</div>

<!-- Container Selection1 -->
<div id="dropDownSelect1"></div>



<!--===============================================================================================-->
<script type="text/javascript" src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="../vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="../vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="../vendor/select2/select2.min.js"></script>
<script type="text/javascript">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
</script>
<!--===============================================================================================-->
<script type="text/javascript" src="../vendor/slick/slick.min.js"></script>
<script type="text/javascript" src="../js/slick-custom.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="../vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="../vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="../vendor/sweetalert/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.block2-btn-addcart').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to cart !", "success");
        });
    });

    $('.block2-btn-addwishlist').each(function(){
        var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
        $(this).on('click', function(){
            swal(nameProduct, "is added to wishlist !", "success");
        });
    });
</script>

<!--===============================================================================================-->
<script src="../js/main.js"></script>

</body>
</html>
