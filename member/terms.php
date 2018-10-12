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
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Bogoshipda | เงื่อนไขข้อตกลง</title>
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
    <link rel="stylesheet" type="text/css" href="../css/styleHelp.css">


    <!--===============================================================================================-->
    
    <style>
        table, tr, td, th{
            margin-left: 250px;
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
                            <a href="../product.php?color=all">สินค้า</a>
                        </li>

                        <li>
                            <a href="../review.php">รีวิว</a>
                        </li>

                        <li>
                            <a href="../design.php">ออกแบบ</a>
                        </li>
                        <li class="sale-noti">
                            <a href="../help.php">ช่วยเหลือ</a>
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
                                                <a href="../product-detail.php?pdID=<?php echo $values['pdID']; ?>" class="header-cart-item-name">
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
                                <a href="../clearcart.php" style="background-color: red" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
                                    ลบทั้งหมด
                                </a>
                            </div>

                            <div class="header-cart-wrapbtn">
                                <!-- Button -->
                                <a href="../cart.php" class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4">
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


<!-- container -->
<section class="newproduct bgwhite p-t-45 p-b-105">
    <div class="container">
<div class="row">
                        <div class="col-xs-3">
                            <div class="list-group">
                            <a class="list-group-item disabled" href="#"><img src="../images/icons/logo.png"/></a>
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
    <h3 class="panel-title">เงื่อนไขข้อตกลง</h3>
</div>
<div class="panel-body">
    <b>1. ราคาสินค้า</b>
    <br>ราคาสินค้าอ้างอิงตามเว็บไซต์ ณ วันที่สั่งซื้อสินค้าที่ระบุตามเว็บไซต์เท่านั้น หากมีการเปลี่ยนแปลงราคาจะไม่มีผลต่อรายการสั่งซื้อก่อนหน้า ไม่ว่าเหตุๆใดก็ตาม ทางเราขอสงวนสิทธิในการเปลี่ยนแปลงราคาสินค้าได้ทุกเมื่อโดยไม่ต้องมีการแจ้งให้ลูกค้าทราบแต่ประการใด
    <br><br>
    <b>2. การสั่งซื้อสินค้า</b>
    <br>การสั่งซื้อสินค้าจะถือว่าเสร็จสมบรูณ์ เมื่อลูกค้าได้ชำระ ราคาสินค้าและค่าจัดส่งและเงินจำนวนใดๆ ที่ลูกค้าจะชำระให้เรา เต็มจำนวนครบถ้วนแล้ว และระบบการรับชำระเงินมีการยืนยันว่าได้รับชำระเงินดังกล่าวแล้วครบถ้วนเรียบร้อยแล้ว และทางเรา ขอสงวนสิทธิในการคืนเงินในทุกกรณี
    <br><br>
    <b>3. การจัดส่งสินค้า</b>
    <br>ทางเราจะจัดส่งสินค้าก็ต่อเมื่อได้มีการยืนยันการชำระเงินเสร็จเรียบร้อยแล้ว และจะดำเนินการจัดส่งสินค้าตามที่ทางเราได้ระบุไว้บนหน้าเว็บไซต์
    <br><br>
    <b>4. การคืนสินค้า</b>
    <br>กรณีที่จะรับคืนสินค้า คือส่งสินค้าผิดแบบ หรือไม่ตรงตามความต้องการของลูกค้าที่ออกแบบไว้ หรือ มีตำหนิที่เกิดจากการผลิตจากทางเรา เท่านั้น จะรับคืนสินค้าดังกล่าวต่อเมื่อลูกค้าได้ส่งคืนสินค้าดังกล่าวมายังเรา ภายใน 3 วัน นับจากวันที่ลูกค้าได้รับสินค้า และสินค้าต้องอยู่ในสภาพเดิม โดยทางเราจะรับผิดชอบค่าจัดส่งคืนสินค้า
    <br><br>
    <b>5. การยกเลิกคำสั่ง</b>
    <br>มื่อทางเราได้รับคำสั่งซื้อและการยืนยันการชำระเงินเรียบร้อยแล้ว ลูกค้าจะไม่สามารถยกเลิกคำสั่งซื้อสินค้าได้
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
            <a href="../payment.php"><h4 class="s-text12 p-b-30">
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