<?php
session_start();
include ('dbConnect.php');
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Bogoshipda | ตารางราคา</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/styleHelp.css">

    <!--===============================================================================================-->
    
    <style>
        table, tr, td, th{
            margin-left: 35%;
            border: 1px solid #ddd;
            text-align: center;
            padding: 10px 20px;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
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
						สวัสดี Guest | <a href="loginPage.php">ลงชื่อเข้าใช้</a>
					</span>
            </div>
        </div>

        <div class="wrap_header">
            <!-- Logo -->
            <a href="index.php" class="logo" >
                <font size="5"><b>Bogoshipda</b></font>
                <!-- <img src="images/icons/logo.png" alt="IMG-LOGO">-->
            </a>

            <!-- Menu -->
            <div class="wrap_menu">
                <nav class="menu">
                    <ul class="main_menu">
                        <li>
                            <a href="index.php">หน้าแรก</a>
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
                        <li class="sale-noti">
                            <a href="help.php">ช่วยเหลือ</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Header Icon -->
            <div class="header-icons">


                <div class="header-wrapicon2">
                    <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
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
                                                if($row3['pdImgPath']==="" || empty($row3)){
                                                    echo '<img src="images/no-picture.jpg">';
                                                }
                                                else {
                                                    echo '<img src="'.$row3['pdImgPath'].'"/></a>';
                                                }
//                                                if($row3['img']==="" || empty($row3)){
//                                                    // echo"Hello";
//                                                    echo '<img src="images/no-picture.jpg">';
//                                                }
//                                                else {
//                                                    echo '<img src="data:image/*;base64,' . base64_encode($row3['img']) . '"/>';
//                                                }
                                                ?>
                                            </div>

                                            <div class="header-cart-item-txt">
                                                <a href="product-detail.php?pdID=<?php echo $values['pdID']; ?>" class="header-cart-item-name">
                                                    <?php echo $values["name"]; ?>
                                                </a>

                                                <span class="header-cart-item-info">
											<?php echo $values["quantity"]; ?> x  ฿<?php echo number_format($values["price"], 2); ?>
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
                                    รวมค่าสินค้า : ฿<?php echo number_format($total, 2); ?>
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
                                <a href="loginPage.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    ดูตะกร้าสินค้า
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap_header_mobile">
        <!-- Logo moblie -->
        <a href="index.php" class="logo-mobile">
            <font size="5"><b>Bogoshipda</b></font>
        </a>

        <!-- Button show menu -->
        <div class="btn-show-menu">
            <!-- Header Icon mobile -->
            <div class="header-icons-mobile">
                <a href="loginPage.php" class="header-wrapicon1 dis-block">
                    ลงชื่อเข้าใช้
                </a>

                <span class="linedivide2"></span>

                <div class="header-wrapicon2">
                    <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti">0</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                        <ul class="header-cart-wrapitem">
                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="images/item-cart-01.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        White Shirt With Pleat Detail Back
                                    </a>

                                    <span class="header-cart-item-info">
											1 x $19.00
										</span>
                                </div>
                            </li>

                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="images/item-cart-02.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        Converse All Star Hi Black Canvas
                                    </a>

                                    <span class="header-cart-item-info">
											1 x $39.00
										</span>
                                </div>
                            </li>

                            <li class="header-cart-item">
                                <div class="header-cart-item-img">
                                    <img src="images/item-cart-03.jpg" alt="IMG">
                                </div>

                                <div class="header-cart-item-txt">
                                    <a href="#" class="header-cart-item-name">
                                        Nixon Porter Leather Watch In Tan
                                    </a>

                                    <span class="header-cart-item-info">
											1 x $17.00
										</span>
                                </div>
                            </li>
                        </ul>

                        <div class="header-cart-total">
                            Total: $75.00
                        </div>

                        <div class="header-cart-buttons">
                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="cart.html" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    View Cart
                                </a>
                            </div>

                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="#" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    Check Out
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="wrap-side-menu" >
        <nav class="side-menu">
            <ul class="main-menu">

                <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                    <div class="topbar-child2-mobile">
							<span class="topbar-email">
								สวัสดี Guest
							</span>

                    </div>
                </li>

                <li class="item-topbar-mobile p-l-10">
                    <div class="topbar-social-mobile">
                        <a href="https://twitter.com/bogoshipdastore" class="topbar-social-item fa fa-twitter"></a>
                	<a href="https://www.instagram.com/bogoshipda_store" class="topbar-social-item fa fa-instagram"></a>
                    </div>
                </li>

                <li class="item-menu-mobile">
                    <a href="index.php">หน้าหลัก</a>
                    <ul class="sub-menu">
                        <li><a href="index.html">Homepage V1</a></li>
                        <li><a href="home-02.html">Homepage V2</a></li>
                        <li><a href="home-03.html">Homepage V3</a></li>
                    </ul>
                    <i class="arrow-main-menu fa fa-angle-right" aria-hidden="true"></i>
                </li>

                <li class="item-menu-mobile">
                    <a href="product.html">Product</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="product.html">Review</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="cart.html">Design</a>
                </li>

                <li class="item-menu-mobile">
                    <a href="about.html">Help</a>
                </li>

       
            </ul>
        </nav>
    </div>
</header>



<!-- Banner -->


<!-- container -->
<section class="newproduct bgwhite p-t-45 p-b-105">
    <div class="container">
<div class="row">
                        <div class="col-xs-3">
    <div class="list-group">
        <a class="list-group-item disabled" href="#"><img src="images/icons/logo.png"/></a>
        <a href="color.php" class="list-group-item">สีสาย/สีสกรีน</a>
        <a href="price.php" class="list-group-item">ตารางราคา</a>
        <a href="shipping.php" class="list-group-item">ค่าจัดส่ง</a>
        <a href="payment.php" class="list-group-item">การชำระเงิน</a>
        <a href="faq.php" class="list-group-item">คำถามที่พบบ่อย</a>
        <a href="contact.php" class="list-group-item">ติดต่อเรา</a>
        <a href="terms.php" class="list-group-item">เงื่อนไขข้อตกลง</a>
    </div>
    <div class="list-group">
        <a href="#" class="list-group-item disabled">ช่วยเหลือ</a>
        <a href="how-to-order.php" class="list-group-item">ขั้นตอนสั่งซื้อ</a>
        <a href="coupon.php" class="list-group-item">วิธีใช้งานคูปอง</a>
        <a href="how-to-payment.php" class="list-group-item">ขั้นตอนแจ้งชำระเงิน</a>
    </div> 
</div>                         <div class="col-xs-9">
                            <div class="panel panel-default">
                                <div class="panel-heading">
    <h3 class="panel-title">ตารางราคา</h3>
</div>
<div class="panel-body">
     <table>
         <tr>
             <th>1 ด้าน</th>
             <th>หน้า - หลัง</th>
         </tr>
         <tr>
             <td>100 บาท</td>
             <td>120 บาท</td>
         </tr>
     </table>
</div>
    </div>
    </div>
        </div>
    </div>
    </section>

<!-- Banner2 -->



<!-- Blog -->


<!-- Instagram -->


<!-- Shipping -->

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
<script type="text/javascript" src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/bootstrap/js/popper.js"></script>
<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/select2/select2.min.js"></script>
<script type="text/javascript">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });
</script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/slick/slick.min.js"></script>
<script type="text/javascript" src="js/slick-custom.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
<script type="text/javascript" src="vendor/sweetalert/sweetalert.min.js"></script>
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
<script src="js/main.js"></script>

</body>
</html>
