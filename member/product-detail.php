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
//$objQuery = mysqli_query($strSQL);
//$objResult = mysqli_fetch_array($objQuery);
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$pdID = $_GET['pdID'];
$sqlShow = "SELECT * FROM product WHERE product.pdID = '$pdID'";
$resultShow = mysqli_query($con,$sqlShow);
$rowShow = mysqli_fetch_array($resultShow,MYSQLI_ASSOC);

if($rowShow['color']=='white'){
    $color = 'สีขาว';
}
elseif ($rowShow['color']=='cream'){
    $color = 'สีครีม';
}
elseif ($rowShow['color']=='milktea'){
    $color = 'สีชานม';
}
elseif ($rowShow['color']=='yellow'){
    $color = 'สีเหลือง';
}
elseif ($rowShow['color']=='green'){
    $color = 'สีเขียว';
}
elseif ($rowShow['color']=='darkgreen'){
    $color = 'สีเขียวเข้ม';
}
elseif ($rowShow['color']=='mint'){
    $color = 'สีมิ้นต์';
}
elseif ($rowShow['color']=='sky'){
    $color = 'สีฟ้าเข้ม';
}
elseif ($rowShow['color']=='orange'){
    $color = 'สีส้มอ่อน';
}
elseif ($rowShow['color']=='lightpink'){
    $color = 'สีชมพูอ่อน';
}
elseif ($rowShow['color']=='pink'){
    $color = 'สีชมพู';
}
elseif ($rowShow['color']=='darkpink'){
$color = 'สีชมพูเข้ม';
}
elseif ($rowShow['color']=='red'){
$color = 'สีแดง';
}
elseif ($rowShow['color']=='purple'){
$color = 'สีม่วง';
}
elseif ($rowShow['color']=='lightgray'){
$color = 'สีเทาอมฟ้า';
}
elseif ($rowShow['color']=='darkgray'){
$color = 'สีเทาเข้ม';
}
elseif ($rowShow['color']=='brown'){
$color = 'สีน้ำตาล';
}
elseif ($rowShow['color']=='black'){
$color = 'สีดำ';
}
else{
    $color = 'ไม่กำหนด';
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Home</title>
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
        .checked, .price span {
            color: #ff9f1a; }
        .p{
            color:#ffaeba ;
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
                                                    echo '<img src="../images/no-picture.jpg">';
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

<!-- Product Detail -->
<div class="container bgwhite p-t-35 p-b-80">
    <div class="flex-w flex-sb">
        <div class="w-size13 p-t-30 respon5">
            <div class="wrap-slick3 flex-sb flex-w">
                <div class="wrap-slick3-dots"></div>
                <?php $sqlSP = "SELECT * FROM image WHERE pdID= '".$_GET["pdID"]."'";
                $resultSP = mysqli_query($con,$sqlSP);
                $pic_count = mysqli_num_rows($resultSP);
                //$rowSP = mysqli_fetch_array($resultSP,MYSQLI_ASSOC);
                ?>
                <div class="slick3">
                        <?php
                      //echo "<script>alert($pic_count);</script>";
                            if($pic_count>1) {
                                while ($rowSP = mysqli_fetch_assoc($resultSP))// show the information from query
                                {
                                    if (empty($rowSP)) {
                                        echo '
                                    <div class="item-slick3" data-thumb="../images/no-picture.jpg">
                                    <div class="wrap-pic-w">
                                        <img src="../images/no-picture.jpg">;
                                    </div>
                                </div>';

                                    } else {
                                        echo '
                                    <div class="item-slick3" data-thumb="data:image/*;base64,' . base64_encode($rowSP['img']) . '">
                                    <div class="wrap-pic-w">
                                        <img src="data:image/*;base64,' . base64_encode($rowSP['img']) . '"/>
                                    </div>
                                    </div>';
                                    }
                                }
                            }
                            else{
                                while ($rowSP = mysqli_fetch_assoc($resultSP))// show the information from query
                                {
                                    $image = base64_decode($rowSP['img']);
                                    /** check if the image is db */
                                    if($image!=null)
                                    {
                                        $db_img = imagecreatefromstring($image);
                                        Header("Content-type: image/jpeg");
                                        imagejpeg($db_img);
                                    }

                                    if ($rowSP['img']==="" || empty($rowSP)) {
                                        echo '
                                        <div class="item-slick3" data-thumb="../images/no-picture.jpg">
                                        <div class="wrap-pic-w">
                                        <img src="../images/no-picture.jpg">
                                    </div>
                                </div>';

                                    } else {
                                        echo '
                                    <div class="item-slick3" data-thumb="data:image/*;base64,' . base64_encode($rowSP['img']) . '" >
                                    <div class="wrap-pic-w">
                                        <img src="data:image/*;base64,' . base64_encode($rowSP['img']) . '"/>
                                    </div>
                                </div>';
                                    }
                                }
                            }

                echo '</div>';
                        ?>

            </div>
        </div>

        <div class="w-size14 p-t-30 respon5">
            <h4 class="product-detail-name m-text16 p-b-13">
                <?php echo $rowShow['name'];?>
            </h4>

            <span class="m-text17 p">
					฿ <?php echo $rowShow['price'];?>
				</span>


            <!--  -->
            <div class="p-t-33 p-b-60">


                <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                    <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">
                        รายละเอียดสินค้า
                        <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>
                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>
                    </h5>

                    <div class="dropdown-content dis-none p-t-15 p-b-23">
                        <p class="s-text8">
                            สี : <?php echo $color;?> <br>
                            <?php echo nl2br($rowShow['description']);?>
                        </p>

                    </div>
                </div>
                <form action="addToCart_action.php" method="post">
                <div class="flex-r-m flex-w p-t-10">
                    <div class="w-size16 flex-m flex-w">
                            <input type="hidden" name="name" value="<?php echo $rowShow['name'];?>">
                            <input type="hidden" name="price" value="<?php echo $rowShow['price'];?>">
                            <input type="hidden" name="pdID" value="<?php echo $rowShow['pdID'];?>">
                            <div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
                                <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                </button>

                                <input class="size8 m-text18 t-center num-product" type="number" name="quantity" value="1">

                                <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
                                    <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                </button>
                            </div>

                            <div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
                                <!-- Button -->
                                <input type="submit" value="เพิ่มลงตะกร้า" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                            </div>


                    </div>
                </div>
                </form>
            </div>



            <!--  -->


        </div>
    </div>
</div>

<!--<section class="newproduct bgwhite p-t-45 p-b-105">-->
<!---->
<!---->
<!--    <div class="container">-->
<!--        <div class="wrap-dropdown-content bo7 p-t-15 p-b-14">-->
<!--            <h5 class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4">-->
<!--                รีวิวสินค้า (0)-->
<!--                <i class="down-mark fs-12 color1 fa fa-minus dis-none" aria-hidden="true"></i>-->
<!--                <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i>-->
<!--            </h5>-->
<!---->
<!--            <div class="dropdown-content dis-none p-t-15 p-b-23">-->
<!--                <div class="rating-main">-->
<!--                    <div class="rating-name">name</div>-->
<!--                    <div class="rating-rating">-->
<!--                        <div class="stars">-->
<!--                            <span class="fa fa-star checked"></span>-->
<!--                            <span class="fa fa-star checked"></span>-->
<!--                            <span class="fa fa-star checked"></span>-->
<!--                            <span class="fa fa-star"></span>-->
<!--                            <span class="fa fa-star"></span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="rating-comment">comment</div>-->
<!--                    <div class="rating-pic"><img src="../images/no-picture.jpg"></div>-->
<!--                    <div class="rating-time">10-09-2018 18:26</div>-->
<!--                    <hr>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!---->
<!--    </div>-->
<!--    </section>-->


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
<div id="dropDownSelect2"></div>


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
<script type="text/javascript">
    $(".selection-1").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect1')
    });

    $(".selection-2").select2({
        minimumResultsForSearch: 20,
        dropdownParent: $('#dropDownSelect2')
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
