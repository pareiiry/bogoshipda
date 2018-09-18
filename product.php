<?php
session_start();
include ('dbConnect.php');

$page = $_GET['page'];
if($_GET['page']==""||$_GET['page']=="1"){
        $pageshow=0;

}
else{
    $pageshow=($page*9)-9;
}

$sql2 = "SELECT * FROM product WHERE product.delete=0 ORDER BY dateCreate DESC LIMIT $pageshow,9";
$result2 = mysqli_query($con,$sql2);

$sql3 = "SELECT * FROM product WHERE product.delete=0 ORDER BY dateCreate DESC";
$result3 = mysqli_query($con,$sql3);
$all_pd_count = mysqli_num_rows($result3);
$cal=$all_pd_count/9;
$page_of_pd = ceil($cal);
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Home</title>
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

                        <li class="sale-noti">
                            <a href="product.php">สินค้า</a>
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


                <div class="header-wrapicon2">
                    <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                    <span class="header-icons-noti"><?php if(empty($_SESSION["shopping_cart"])){echo "0";}else{echo count($_SESSION["shopping_cart"]);}?></span>

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
                                                <a href="product-detail.php?pdID=<?php echo $values['pdID']; ?>" class="header-cart-item-name">
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

<section class="slide1">
    <div class="wrap-slick1">
        <div class="slick1">

            <?php
            $sqlB = "SELECT * FROM banner";
            $resultB = mysqli_query($con,$sqlB);
            while($rowB = mysqli_fetch_assoc($resultB))// show the information from query
            {
                echo ' <div class="item-slick1 item1-slick1" style="background-image: url(data:image/*;base64,' . base64_encode($rowB['bImg']) . ');">
                <div class="wrap-content-slide1 sizefull flex-col-c-m p-l-15 p-r-15 p-t-150 p-b-170">
                    <div class="wrap-btn-slide1 w-size1 animated visible-false" data-appear="zoomIn">
                        <!-- Button -->
                    </div>
                </div>
            </div>';
            }
            ?>
        </div>
    </div>
</section>

<!-- Banner -->


<!-- Product -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                <div class="leftbar p-r-20 p-r-0-sm">
                    <!--  -->


                    <!--  -->
                    <h4 class="m-text14 p-b-32">
                        ค้นหาจากสี
                    </h4>



                    <div class="filter-color p-t-22 p-b-50 bo3">
                        <div class="m-text15 p-b-12">

                        </div>

                        <ul class="flex-w">
                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter1" type="checkbox" name="color-filter1">
                                <label class="color-filter color-filter1" for="color-filter1"></label>
                            </li>

                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter2" type="checkbox" name="color-filter2">
                                <label class="color-filter color-filter2" for="color-filter2"></label>
                            </li>

                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter3" type="checkbox" name="color-filter3">
                                <label class="color-filter color-filter3" for="color-filter3"></label>
                            </li>

                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter4" type="checkbox" name="color-filter4">
                                <label class="color-filter color-filter4" for="color-filter4"></label>
                            </li>

                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter5" type="checkbox" name="color-filter5">
                                <label class="color-filter color-filter5" for="color-filter5"></label>
                            </li>

                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter6" type="checkbox" name="color-filter6">
                                <label class="color-filter color-filter6" for="color-filter6"></label>
                            </li>

                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter7" type="checkbox" name="color-filter7">
                                <label class="color-filter color-filter7" for="color-filter7"></label>
                            </li>
                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter8" type="checkbox" name="color-filter8">
                                <label class="color-filter color-filter8" for="color-filter8"></label>
                            </li>
                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter9" type="checkbox" name="color-filter9">
                                <label class="color-filter color-filter9" for="color-filter9"></label>
                            </li>
                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter10" type="checkbox" name="color-filter10">
                                <label class="color-filter color-filter10" for="color-filter10"></label>
                            </li>
                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter11" type="checkbox" name="color-filter11">
                                <label class="color-filter color-filter11" for="color-filter11"></label>
                            </li>
                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter12" type="checkbox" name="color-filter12">
                                <label class="color-filter color-filter12" for="color-filter12"></label>
                            </li>
                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter13" type="checkbox" name="color-filter13">
                                <label class="color-filter color-filter13" for="color-filter13"></label>
                            </li>
                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter14" type="checkbox" name="color-filter14">
                                <label class="color-filter color-filter14" for="color-filter14"></label>
                            </li>
                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter15" type="checkbox" name="color-filter15">
                                <label class="color-filter color-filter15" for="color-filter15"></label>
                            </li>
                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter16" type="checkbox" name="color-filter16">
                                <label class="color-filter color-filter16" for="color-filter16"></label>
                            </li>
                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter17" type="checkbox" name="color-filter17">
                                <label class="color-filter color-filter17" for="color-filter17"></label>
                            </li>
                            <li class="m-r-10">
                                <input class="checkbox-color-filter" id="color-filter18" type="checkbox" name="color-filter18">
                                <label class="color-filter color-filter18" for="color-filter18"></label>
                            </li>
                        </ul>
                    </div>

                    <div class="search-product pos-relative bo4 of-hidden">
                        <input class="s-text7 size6 p-l-23 p-r-50" type="text" name="search-product" placeholder="Search Products...">

                        <button class="flex-c-m size5 ab-r-m color2 color0-hov trans-0-4">
                            <i class="fs-12 fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-8 col-lg-9 p-b-50">
                <!--  -->
                <div class="flex-sb-m flex-w p-b-35">
                    <div class="flex-w">

                    </div>

                    <span class="s-text8 p-t-5 p-b-5">
                        <?php
                        if(($pageshow+10)>$all_pd_count){
                            echo "แสดง ".($pageshow+1)." - ".$all_pd_count." จาก ".$all_pd_count." ผลการค้นหา";

                        }
                        else{
                             echo "แสดง ".($pageshow+1)." - ".($pageshow+9)." จาก ".$all_pd_count." ผลการค้นหา";

                        }?>
						</span>
                </div>

                <!-- Product -->
                <div class="row">
<?php


while($row2= mysqli_fetch_assoc($result2))// show the information from query
{
    $sql3 = "SELECT * FROM image WHERE pdID= '" . $row2['pdID'] . "' LIMIT 1";
    $result3 = mysqli_query($con, $sql3);
    $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);

                    echo  "<div class=\"col-sm-12 col-md-6 col-lg-4 p-b-50\">
                        <!-- Block2 -->
                        <div class=\"block2\">
                            <div class=\"block2-img wrap-pic-w of-hidden pos-relative\">";

 if($row3['img']===""){
     echo '<img src="images/no-picture.jpg">';
 }
 else {
     echo '<img src="data:image/*;base64,' . base64_encode($row3['img']) . '"/>';
 }
                    echo "
                                <div class=\"block2-overlay trans-0-4\">
                                    
                                    <div class=\"block2-btn-addcart w-size1 trans-0-4\">
                                        <!-- Button -->
                                        <form action=\"addToCart_action.php\" method=\"post\">
                                        <input type=\"hidden\" name=\"quantity\" value=\"1\">
                                        <input type=\"hidden\" name=\"name\" value=\"$row2[name]\">
                                        <input type=\"hidden\" name=\"price\" value=\"$row2[price]\">
                                        <input type=\"hidden\" name=\"pdID\" value=\"$row2[pdID]\">
                                        <input type=\"submit\" value=\"Add to Cart\" class=\"flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4\">
                                    </form>
                                    </div>
                                </div>
                            </div>

                            <div class=\"block2-txt p-t-20\">
                                <a href=\"product-detail.php?pdID=$row2[pdID]\" class=\"block2-name dis-block s-text3 p-b-5\">
                                    $row2[name]
                                </a>

                                <span class=\"block2-price m-text6 p-r-5\">
										฿ $row2[price]
									</span>
                            </div>
                        </div>
                    </div>";
 }
 ?>





<!--                        <a href="#" class="item-pagination flex-c-m trans-0-4 active-pagination">1</a>-->

                    </div>
                <!-- Pagination -->
                <div class="pagination flex-m flex-w p-t-26">
                    <?php
                    for($pn=1;$pn<=$page_of_pd;$pn++){

                        echo  "<a href=\"product.php?page=$pn\" class=\"item-pagination flex-c-m trans-0-4\">$pn</a>";

                    }
                    ?>
            </div>
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
            <h4 class="s-text12 p-b-30">
                วิธีการชำระเงิน
            </h4>
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