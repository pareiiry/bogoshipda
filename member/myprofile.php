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
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Bogoshipda | ข้อมูลส่วนตัว</title>
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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <style>


        .star-rating .fa-star{color: orange;}

        .uppic{
            text-align: left;
        }
        .btn-outline-success {
            color: #28a745;
            background-color: transparent;
            background-image: none;
            border-color: #28a745;
        }

        .btn-outline-success:hover {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-outline-success:focus, .btn-outline-success.focus {
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.5);
        }

        .btn-outline-success.disabled, .btn-outline-success:disabled {
            color: #28a745;
            background-color: transparent;
        }

        .btn-outline-success:active, .btn-outline-success.active,
        .show > .btn-outline-success.dropdown-toggle {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-outline-danger {
            color: #dc3545;
            background-color: transparent;
            background-image: none;
            border-color: #dc3545;
        }

        .btn-outline-danger:hover {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-outline-danger:focus, .btn-outline-danger.focus {
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.5);
        }

        .btn-outline-danger.disabled, .btn-outline-danger:disabled {
            color: #dc3545;
            background-color: transparent;
        }

        .btn-outline-danger:active, .btn-outline-danger.active,
        .show > .btn-outline-danger.dropdown-toggle {
            color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;
        }
        a:hover {
            text-decoration: none;!important;
            color: #ffaeba;!important;
        }
        a {
            color: #666666;!important;
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
                                        $sqlPd = "SELECT * FROM product WHERE pdID= '".$values["pdID"]."'";
                                        $resultPd = mysqli_query($con, $sqlPd);
                                        $rowPd = mysqli_fetch_array($resultPd, MYSQLI_ASSOC);
                                        if ($rowPd["custom"] == 1) {
                                            $sql3 = "SELECT * FROM design WHERE pdID= '" . $values["pdID"] . "' LIMIT 1";
                                            $result3 = mysqli_query($con, $sql3);
                                            $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC); ?>
                                            <li class="header-cart-item">
                                                <div class="header-cart-item-img">
                                                    <?php
                                                    if ($row3['imgPath'] === "" || empty($row3)) {
                                                        // echo"Hello";
                                                        echo '<img src="../images/no-picture.jpg">';
                                                    } else {
                                                        echo '<img style="width:50%" src="'.$row3['imgPath'].'"/>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="header-cart-item-txt">
                                                    <a href="product-detail.php?pdID=<?php echo $values['pdID']; ?>"
                                                       class="header-cart-item-name">
                                                        <?php echo $values["name"]; ?>
                                                    </a>

                                                    <span class="header-cart-item-info">
											<?php echo $values["quantity"]; ?> x  ฿<?php echo $values["price"]; ?>
										</span>
                                                </div>
                                            </li>
                                            <?php
                                        } else {
                                            $sql3 = "SELECT * FROM image WHERE pdID= '" . $values["pdID"] . "' LIMIT 1";
                                            $result3 = mysqli_query($con, $sql3);
                                            $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
                                            ?>
                                            <li class="header-cart-item">
                                                <div class="header-cart-item-img">
                                                    <?php

                                                    if($row3['pdImgPath']==="" || empty($row3)){
                                                        echo '<img src="../images/no-picture.jpg">';
                                                    }
                                                    else {
                                                        echo '<img src="../'.$row3['pdImgPath'].'"/></a>';
                                                    }
                                                    ?>
                                                </div>

                                                <div class="header-cart-item-txt">
                                                    <a href="product-detail.php?pdID=<?php echo $values['pdID']; ?>"
                                                       class="header-cart-item-name">
                                                        <?php echo $values["name"]; ?>
                                                    </a>

                                                    <span class="header-cart-item-info">
											<?php echo $values["quantity"]; ?> x  ฿<?php echo $values["price"]; ?>
										</span>
                                                </div>
                                            </li>
                                            <?php
                                            //echo $total;
                                        }

                                        $total = $total + ($values["quantity"] * $values["price"]);
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



<!-- Banner -->


<!-- Product -->
<section class="bgwhite p-t-55 p-b-65">
    <div class="container">
        <div class="bo9 w-size20 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-auto m-l-auto p-lr-15-sm">
            <h4 class="p-b-24" align="center">
                ข้อมูลส่วนตัว
            </h4>

                <form class="form-horizontal" method="post" action="editProfile_action.php">
                    <div class="form-group">
                        <label class="control-label col-sm-3">อีเมลล์</label>
                        <div class="col-md-8 col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email'];?>" disabled>
                                <input type="hidden" class="form-control" name="email" id="email" value="<?php echo $row['email'];?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">รหัสผ่าน</label>
                        <div class="col-md-8 col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="password" id="password" value="<?php echo $row['password'];?>" required>
                            </div>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label class="control-label col-sm-3">Confirm Password <span class="text-danger">*</span></label>
                        <div class="col-md-5 col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm your password" value="" required>
                            </div>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <label class="control-label col-sm-3">ชื่อ-นามสกุล </label>
                        <div class="col-md-8 col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" placeholder="กรอกชื่อ-นามสกุล" value="<?php echo $row['name'];?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">วันเกิด </label>
                        <div class="col-md-4 col-sm-5">
                            <input class="form-control" type="date" name="dob" value="<?php echo $row['dob'];?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">เพศ</label>
                        <div class="col-md-8 col-sm-9">
                            <label>
                                <input name="gender" type="radio"  value="Male" <?php if($row['gender']=='Male') {echo 'checked';}?>>
                                ชาย </label>
                               
                            <label>
                                <input name="gender" type="radio"  value="Female" <?php if($row['gender']=='Female') {echo 'checked';}?>>
                                หญิง </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">เบอร์โทรศัพท์ </label>
                        <div class="col-md-8 col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                <input type="text" class="form-control" name="phone_number" id="phone_number" value="<?php echo $row['phone_number'];?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">ที่อยู่</label>
                        <div class="col-md-8 col-sm-9">
                            <textarea style="resize:none;" rows="3" class="form-control" name="address" id="address" placeholder="กรอกที่อยู่" required><?php echo $row['address'];?></textarea>
                        </div>
                    </div>

                    <div class="size15 trans-0-4 t-center">

                        <button class="btn btn-outline-success" type="submit"  style="margin-left: 2%;margin-top: 3%">บันทึก</button>
                        <button class="btn btn-outline-danger" type="button" style="margin-left: 2%;margin-top: 3%" onclick="window.history.go(-1);">ยกเลิก</button>
                        <!-- Button -->

                    </div>
                </form>

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