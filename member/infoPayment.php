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

$sql2 = "SELECT * FROM bank";
$result2 = mysqli_query($con,$sql2);
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Bogoshipda | แจ้งชำระเงิน</title>
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


        .star-rating .fa-star{color: orange;}

        .uppic{
            text-align: left;
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

                <span class="linedivide1"></span>

                <div class="header-wrapicon2">
                    <img src="../images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti"><?php
                        $quantity=0;
                        if(empty($_SESSION["shopping_cart"]))
                        {
                            echo "0";
                        }
                        else{
                            foreach($_SESSION["shopping_cart"] as $keys2 => $values2)
                            {
                                $quantity+=$values2["quantity"];
                            }echo $quantity;
                        }?></span>
                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                            <?php
                            if(!empty($_SESSION["shopping_cart"]))
                            {
                                $total = 0;

                                foreach($_SESSION["shopping_cart"] as $keys => $values)
                                {
                                    if($values["pdID"]!==null) {
                                        $sql3 = "SELECT * FROM image WHERE pdID= '".$values["pdID"]."' LIMIT 1";
                                        $result3 = mysqli_query($con,$sql3);
                                        $row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);
                                        ?>
                                        <li class="header-cart-item">
                                            <div class="header-cart-item-img">
                                                <?php

                                                if($row3['img']==="" || empty($row3)){
                                                    // echo"Hello";
                                                    echo '<img src="images/no-picture.jpg">';
                                                }
                                                else {
                                                    echo '<img src="data:image/*;base64,' . base64_encode($row3['img']) . '"/>';
                                                }
                                                ?>
                                            </div>

                                            <div class="header-cart-item-txt">
                                                <a href="#" class="header-cart-item-name">
                                                    <?php echo $values["name"]; ?>
                                                </a>

                                                <span class="header-cart-item-info">
											<?php echo $values["quantity"]; ?> x  ฿<?php echo $values["price"]; ?>
										</span>
                                            </div>
                                        </li>
                                        <?php
                                        $total = $total + ($values["quantity"] * $values["price"]);
                                        //echo $total;
                                    }
                                    else{
                                        unset($_SESSION["shopping_cart"][$keys]);
                                        ?>
                                        <li class="header-cart-item">
                                            <div class="header-cart-item-img">
                                            </div>

                                            <div class="header-cart-item-txt">
                                                <a class="header-cart-item-name">
                                                    - ไม่มีสินค้าที่เลือก -
                                                </a>

                                                <span class="header-cart-item-info">

										</span>
                                            </div>
                                        </li>
                                        <?php

                                    }
                                }

                            }
                            else{
                                ?>
                                <li class="header-cart-item">
                                    <div class="header-cart-item-img">
                                    </div>

                                    <div class="header-cart-item-txt">
                                        <a class="header-cart-item-name">
                                            - ไม่มีสินค้าที่เลือก -
                                        </a>

                                        <span class="header-cart-item-info">

										</span>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>

                        </ul>

                        <?php
                        if(!empty($_SESSION["shopping_cart"])){
                            if($total!==null) {
                                ?>
                                <div class="header-cart-total">
                                    รวมค่าสินค้า : ฿<?php echo number_format($total, 0); ?>
                                </div>
                                <?php
                            }
                        }?>

                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="clearcart.php" style="background-color: red" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    ลบทั้งหมด
                                </a>
                            </div>

                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    ดูตะกร้าสินค้า
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</header>

<!-- Product -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <form action="uploadPayment_action.php" method="post" enctype="multipart/form-data">
        <div class="bo9 w-size20 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-auto m-l-auto p-lr-15-sm">
            <h4 class="p-b-24" align="center">
                แจ้งชำระเงิน
            </h4>

            <!--  -->
            <div class="flex-w flex-sb-m">
                <span class="s-text18 w-size19 w-full-sm p-t-10">
                    เลขที่ใบสั่งซื้อ :
				</span>
                <div class="w-size20 w-full-sm p-b-3">
                    <input class="form-control" type="text" value="<?php echo $_GET['orderID'];?>" disabled>
                    <input id="orderID" name="orderID" type="hidden" value="<?php echo $_GET['orderID'];?>">
                </div>

                <span class="s-text18 w-size19 w-full-sm" style="padding-left: 1px">
						บัญชีที่โอนเงิน* :
					</span>

                <span class="m-text21 w-size20 w-full-sm">

                     <select class="form-control" name="bankName" id="bankName">
                      <?php  while($row2= mysqli_fetch_assoc($result2))// show the information from query
                {
                    if($row2['bankName']=='SCB'){
                        echo "<option value=\"$row2[bankID]\">ธนาคารไทยพาณิชย์ | $row2[accountName] | $row2[accountNumber]</option>";
                     }
                    else if($row2['bankName']=='KTB') {
                        echo "<option value=\"$row2[bankID]\">ธนาคารกรุงไทย | $row2[accountName] | $row2[accountNumber]</option>";
                    }
                    else if($row2['bankName']=='BBL'){
                        echo "<option value=\"$row2[bankID]\">ธนาคารกรุงเทพ | $row2[accountName] | $row2[accountNumber]</option>";
                    }
                    else if($row2['bankName']=='KBANK'){
                        echo "<option value=\"$row2[bankID]\">ธนาคารกสิกร | $row2[accountName] | $row2[accountNumber]</option>";
                    }else if($row2['bankName']=='GSB'){
                        echo "<option value=\"$row2[bankID]\">ธนาคารออมสิน | $row2[accountName] | $row2[accountNumber]</option>";
                    }  else if($row2['bankName']=='KRUNGSRI'){
                        echo "<option value=\"$row2[bankID]\">ธนาคารกรุงศรีอยุธยา | $row2[accountName] | $row2[accountNumber]</option>";
                    }
                    else if($row2['bankName']=='TMB'){
                        echo "<option value=\"$row2[bankID]\">ธนาคารทหารไทย | $row2[accountName] | $row2[accountNumber]</option>";
                    }
                   else if($row2['bankName']=='UOB'){
                       echo "<option value=\"$row2[bankID]\">ธนาคารยูโอบี | $row2[accountName] | $row2[accountNumber]</option>";
                    }
                    else if($row2['bankName']=='TBANK') {
                        echo "<option value=\"$row2[bankID]\">ธนาคารธนชาติ | $row2[accountName] | $row2[accountNumber]</option>";
                    }else if($row2['bankName']=='CIMB'){
                        echo "<option value=\"$row2[bankID]\">ธนาคารซีไอเอ็มบี | $row2[accountName] | $row2[accountNumber]</option>";
                    }
                    else if($row2['bankName']=='CITIBANK'){
                        echo "<option value=\"$row2[bankID]\">ซิตี้แบงค์ | $row2[accountName] | $row2[accountNumber]</option>";
                    }
                    else if($row2['bankName']=='SCBT'){
                        echo "<option value=\"$row2[bankID]\">Standard Chartered | $row2[accountName] | $row2[accountNumber]</option>";
                    }
                    else if($row2['bankName']=='TISCO'){
                        echo "<option value=\"$row2[bankID]\">ทิสโก้แบงค์ | $row2[accountName] | $row2[accountNumber]</option>";
                    }
                    else if($row2['bankName']=='Wallet') {
                        echo "<option value=\"$row2[bankID]\">ทรูวอลเลท | $row2[accountName] | $row2[accountNumber]</option>";
                    }
                    else if($row2['bankName']=='PrompPay') {
                        echo "<option value=\"$row2[bankID]\">พร้อมเพย์ | $row2[accountName] | $row2[accountNumber]</option>";
                    }

				}?>
                     </select>
					</span>
                <span class="s-text18 w-size19 w-full-sm p-t-10">
						วันที่ชำระเงิน* :
					</span>

                <div class="w-size20 w-full-sm p-t-10">
                    <input type="date" id="date" name="date" style="width: 200px" value="<?php echo date("Y-m-d"); ?>" required>
                </div>

                <span class="s-text18 w-size19 w-full-sm p-t-5">
                       เวลา(โดยประมาณ)* :
					</span>
                <div class="w-size20 w-full-sm p-b-10 p-t-10">

                    <input type="time" id="time" name="time" style="width: 120px" required/>
                </div>

                <span class="s-text18 w-size19 w-full-sm">
                        จำนวนเงิน* :
					</span>

                <div class="w-size20 w-full-sm border">
                    <input class="form-control" type="text" id="pricePay" name="pricePay" value="" required>
                </div>
            </div>

                <div class="flex-w flex-sb bo16 p-t-15 p-b-20">

                <span class="s-text18 w-size19 w-full-sm">
                        หลักฐานการโอน* :
					</span>

                    <div class="w-size20 w-full-sm">
                        <div class="uppic">
                                <input style="margin:2% 0 2% 0 " type="file" name="filesToUploadPay[]" id="filesToUploadPay" required>


                    </div>

                </div>



                <div class="size15 trans-0-4">
                    <p style="color: red; text-align: center">*กรุณาตรวจสอบรายละเอียดให้ถูกต้องอีกครั้ง ก่อนยืนยันการแจ้งชำระเงิน</p>

                    <!-- Button -->
                    <button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4 m-t-15">
                        แจ้งชำระเงิน
                    </button >
                </div>

        </div>

        </div>
        </form>
    </div>
</section>


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
                    bogoshipdashop@gmail.com
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
                    Thailand Post
                </li>
                <li class="p-b-9 s-text7">
                    Kerry Express
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
    var $star_rating = $('.star-rating .fa');

    var SetRatingStar = function() {
        return $star_rating.each(function() {
            if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
                return $(this).removeClass('fa-star-o').addClass('fa-star');
            } else {
                return $(this).removeClass('fa-star').addClass('fa-star-o');
            }
        });
    };

    $star_rating.on('click', function() {
        $star_rating.siblings('input.rating-value').val($(this).data('rating'));
        return SetRatingStar();
    });

    SetRatingStar();
    $(document).ready(function() {

    });
</script>

<!--===============================================================================================-->
<script src="../js/main.js"></script>

</body>
</html>