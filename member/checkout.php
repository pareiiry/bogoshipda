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

$sql2 = "SELECT * FROM product";
$result2 = mysqli_query($con,$sql2);
$dc=0;
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Bogoshipda | สรุปรายการสั่งซื้อ</title>
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
        .table-shipping{
            border-color: #2b2b2b;
            width: 100%;
            height: 65%;
            padding: auto;
            margin-bottom: 10px;
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

            </div>

        </div>
    </div>

</header>

<section class="cart bgwhite p-t-70 p-b-100">
<?php if(!isset($_POST['discountShip'])){?>
    <div class="container">
        <!-- Cart item -->
        <a href="cart.php"><i class="fa fa-angle-double-left" style="font-size:24px"></i> &nbsp;ย้อนกลับ</a>
        <div class="bo9 w-size29 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
            <h5 class="m-text20 p-b-24" align="center">
                สรุปรายการสั่งซื้อสินค้า
            </h5>
            <h6 align="center" style="color: red">-ไม่มีรายการยืนยันการสั่งสินค้า-</h6>
        </div>
    </div>
    <?php }else{?>
    <form action="addToDbForGuest_action.php" method="post">
    <div class="container">
        <!-- Cart item -->
        <a href="cart.php"><i class="fa fa-angle-double-left" style="font-size:24px"></i> &nbsp;ย้อนกลับ</a>

        <!-- Total -->

        <div class="bo9 w-size29 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
            <h5 class="m-text20 p-b-24" align="center">
                สรุปรายการสั่งซื้อสินค้า
            </h5>
            <h6 align="center" style="color: red">ตรวจสอบความถูกต้องก่อนยืนยันการสั่งซื้อ</h6>

            <!--  -->
            <div class="flex-w flex-sb bo17 p-t-20 p-b-20 p-l-20 p-r-20 m-b-30 m-t-25">
					<span class="s-text18 w-size15 w-full-sm">
                        ที่อยู่ในการจัดส่ง :
					</span>

                <div class="w-size16 w-full-sm">
                    <?php echo "<input type=\"hidden\" name=\"nameShip\" value=\"$_POST[nameShip]\">";?>
                    <?php echo "<input type=\"hidden\" name=\"addressShip\" value=\"$_POST[addressShip]\">";?>
                    <?php echo "<input type=\"hidden\" name=\"telShip\" value=\"$_POST[telShip]\">";?>
                    <?php echo $_POST['nameShip']."( โทร. ".$_POST['telShip']." )"."<br>".$_POST['addressShip']?>
                </div>
            </div>

            <div class="flex-w flex-sb bo18 p-t-20 p-b-20 p-l-20 p-r-20 m-b-30 m-t-25">
					<span class="s-text18 w-size15 w-full-sm">
                        ข้อความถึงเจ้าของร้าน :
					</span>

                <div class="w-size16 w-full-sm">
                    <?php if($_POST['msgShip']==""||$_POST['msgShip']==" "||$_POST['msgShip']=="-"){echo "-";echo "<input type=\"hidden\" name=\"msgShip\" value=\"-\">";}else{ echo $_POST['msgShip'];echo "<input type=\"hidden\" name=\"msgShip\" value=\"$_POST[msgShip]\">";}?>
                </div>
            </div>

            <div class="flex-w flex-sb-m bo16 p-t-20 p-b-20 p-l-20 p-r-20  ">
					<span class="s-text18 w-size15 w-full-sm">
						รายละเอียดสินค้าที่สั่งซื้อ :
					</span>

                <div class="w-size16 w-full-sm m-b-10">
                    <table class="p-t-10 p-b-10" width="100%">
                        <tr>
                            <td width="20%"></td>
                            <td width="50%" align="center">ชื่อสินค้า</td>
                            <td width="10%" align="center">จำนวน</td>
                            <td width="20%" align="right">ราคารวม</td>
                        </tr>
                        <?php
                        $total = 0;
                        if(!empty($_SESSION["shopping_cart"]))
                        {
                            foreach($_SESSION["shopping_cart"] as $keys => $values)
                            {
                                if($values["pdID"]!==null)
                                {
                                    ?>

                                    <tr >
                                        <td align="center"></td>
                                        <td><?php echo $values["name"]; ?></td>
                                        <td align="center"><?php echo $values["quantity"]; ?></td>
                                        <td align="right">฿<?php echo ($values["quantity"] * $values["price"]); ?></td>
                                    </tr>

                                    <?php
                                    $total = $total + ($values["quantity"] * $values["price"]);
                                    //echo $total;
                                }
                                else{
                                    unset($_SESSION["shopping_cart"][$keys]);
                                    ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center;color: red"> - ไม่มีสินค้าที่เลือก -</td>
                                    </tr>
                                    <?php

                                }
                            }

                        }
                        else{
                            ?>
                            <tr>
                                <td colspan="4" style="text-align: center;color: red"> - ไม่มีสินค้าที่เลือก -</td>
                            </tr>
                            <?php
                        }
                        ?>

                    </table>
                </div>
                <span class="s-text18 w-size16 w-full-sm">
					</span>
                <div class="w-size30 w-full-sm" align="right">
                    <b>
                        <?php
                        if(!empty($_SESSION["shopping_cart"])){
                            if($total!==null) {

                                  echo "฿ ".number_format($total, 0);

                            }
                        }?>
                    </b>
                </div>
            </div>

            <!--  -->
            <div class="flex-w flex-sb bo16 p-t-20 p-b-20 p-l-20 p-r-20 ">
					<span class="s-text18 w-size15 w-full-sm">
						วิธีการจัดส่งสินค้า :
					</span>

                <div class="w-size31  w-full-sm p-t-7">
                    <?php if($_POST['ship']=='Regis'){
                       echo "พัสดุลงทะเบียน";
                    }elseif ($_POST['ship']=='Ems'){
                        echo "พัสดุด่วนพิเศษ (EMS)";
                    }elseif ($_POST['ship']=='Kerry'){
                        echo "Kerry Express";
                    }?>
                    </div>
                    <div class="w-size15  w-full-sm" align="right">
                        ฿ <?php
                        if($_POST['ship']=='Regis'){
                            $ship = 30;
                            if($_POST['countShip']>5){
                                $addShip = ($_POST['countShip']-5)*5;
                            }
                            $sc=number_format(($ship+$addShip), 0);
                            echo number_format(($ship+$addShip), 0);
                        }elseif ($_POST['ship']=='Ems'){
                            $ship = 50;
                            if($_POST['countShip']>5){
                                $addShip = ($_POST['countShip']-5)*5;
                            }
                            $sc=number_format(($ship+$addShip), 0);
                            echo number_format(($ship+$addShip), 0);

                        }elseif ($_POST['ship']=='Kerry'){
                            $ship = 50;
                            if($_POST['countShip']>5){
                                $addShip = ($_POST['countShip']-5)*5;
                            }
                            $sc=number_format(($ship+$addShip), 0);
                            echo number_format(($ship+$addShip), 0);
                        }
                        $sp=($ship+$addShip);
                         echo "<input type=\"hidden\" name=\"shipPrice\" value=\"$sp\">";

                       ?>
                </div>

            </div>

            <div class="flex-w flex-sb bo16 p-t-20 p-b-20 p-l-20 p-r-20 ">
					<span class="s-text18 w-size15 w-full-sm">
						ส่วนลด :
					</span>
                <div class="w-size15 w-full-sm" align="right">
                    ฿ <?php echo $_POST['discountShip']; $dc=$_POST['discountShip'];?>
                </div>

            </div>
            <!--  -->
            <div class="flex-w flex-sb-m p-b-30 p-l-20 p-r-20 m-t-20">
					<span class="m-text22 w-size19 w-full-sm">
						ยอดชำระเงินทั้งหมด :
					</span>

                <div class="w-size15 w-full-sm fs-25 text-pink" align="right">
                    <b>฿ <?php
                        echo  number_format((($total-$dc)+$sc), 0);
                        ?></b>
                </div>
            </div>

            <div class="size15 trans-0-4">
                <!-- Button -->
                    <input type="hidden" name="codeID" value="<?php echo $_POST['codeID']?>">
                    <input type="hidden" name="ship" value="<?php echo $_POST['ship']?>">
                    <input type="hidden" name="dc" value="<?php echo $dc?>">
                    <button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                        สั่งซื้อสินค้า
                    </button>

            </div>
        </div>

    </div>
    </form>
    <?php }?>



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
                    bogoshipdashop@gmail.com
                </li>

                <li class="p-b-9 s-text7">
                    Tel. 082-6118627
                </li>

                <li class="p-b-9 s-text7">
                    line : bogoshipdastore
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
</script>

<!--===============================================================================================-->
<script src="../js/main.js"></script>

</body>
</html>
