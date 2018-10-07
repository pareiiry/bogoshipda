<?php
session_start();
include ('dbConnect.php');

$sql2 = "SELECT * FROM product ORDER BY dateCreate DESC";
$result2 = mysqli_query($con,$sql2);

$sqlReview = "SELECT * FROM review ORDER BY dateTime DESC";
$resultReview = mysqli_query($con,$sqlReview);

$sqlReview = "SELECT * FROM review ORDER BY dateTime DESC";
$resultReview = mysqli_query($con,$sqlReview);
$sqlReview2 = "SELECT * FROM review ORDER BY dateTime DESC";
$resultReview2 = mysqli_query($con,$sqlReview2);
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Bogoshipda | รีวิว </title>
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
    <!--===============================================================================================-->

    <style>
        .star-rating .fa-star{color: orange;}
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
                            <a href="product.php">สินค้า</a>
                        </li>

                        <li class="sale-noti">
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
                                                <a href="#" class="header-cart-item-name">
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
                                        <a href="#" class="header-cart-item-name">
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


</header>


<!-- Banner -->


<!-- Product -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="sec-title p-b-60">
            <div class="m-text5 t-center">
                รีวิวจากลูกค้า
            </div>

            <div class=" t-center m-t-30">
                <?php
                $sumScore=0;
                $iScore=0;
                while($rowReviews= mysqli_fetch_assoc($resultReview2)){
                    $sc2=number_format($rowReviews['score'],0);
                    $sumScore+=$sc2;
                    $iScore++;
                }
                $totalScore=$sumScore/$iScore;

                ?>
                คะแนนของร้าน
                <h2><?php echo $totalScore; ?></h2>
                (เต็ม 5)
            </div>


        </div>



                <!-- Product -->
                <div class="row">
                    <?php


                    while($rowReview= mysqli_fetch_assoc($resultReview))// show the information from query
                    {
                        echo  "<div class=\"col-sm-12 col-md-4 col-lg-3 p-b-50\">
                        <!-- Block2 -->
                        <div class=\"block2\">
                            <div class=\"block2-img wrap-pic-w of-hidden pos-relative\">";

                        if($rowReview['img']===""){
                            echo '<img src="images/no-picture.jpg">';
                        }
                        else {
                            echo '<img src="data:image/*;base64,' . base64_encode($rowReview['img']) . '"/>';
                        }
                        $sqlU = "SELECT * FROM user WHERE uID = '".$rowReview['uID']."' ";
                        $resultU = mysqli_query($con,$sqlU);
                        $rowU = mysqli_fetch_array($resultU,MYSQLI_ASSOC);
                        $sc=number_format($rowReview['score'],0);
                        echo "
                                <div class=\"block2 trans-0-4\">
                                    

                                </div>
                            </div>

                            <div class=\"block2-txt p-t-20\">
                                <span class=\"block2-name dis-block s-text3 p-b-5\">
                                    $rowU[name]
                                </span>
                            <div class=\"star-rating\">";
                        for($i=0;$i<$sc;$i++){
                            echo "<span class=\"fa fa-star\" ></span>";
                        }
                        $space=5-$sc;
                        for($i=0;$i<$space;$i++){
                            echo "<span class=\"fa fa-star-o\" ></span>";
                        }
                        echo"
                                     </div>
                    <div class=\"rating-comment block2-name dis-block s-text3 p-b-5\">$rowReview[comment]</div>
                    <div class=\"rating-time block2-name dis-block s-text3 p-b-5\">$rowReview[dateTime]</div>
                                
                            </div>
                        </div>
                    </div>";
                    }
                    ?>





<!--                        <a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>-->

                    </div>
                <!-- Pagination -->

        </div>
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


<!--===============================================================================================-->
<script src="js/main.js"></script>

</body>
</html>