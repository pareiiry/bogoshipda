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
$valueDIscount=0;
$unit=null;
$summaryPrice=0;
$ship = 30;
$addShip=0;
$count=0;
$discount=0;


?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Bogoshipda | ตะกร้าสินค้า</title>
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

                        <li  class="sale-noti">
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



<!-- Cart -->
<section class="cart bgwhite p-t-70 p-b-100">
    <div class="container">
        <?php if(empty($_SESSION["shopping_cart"])){?>

                <!-- Cart item -->
                <a href="product.php"><i class="fa fa-angle-double-left" style="font-size:24px"></i> &nbsp;กลับไปยังหน้าสินค้า</a>
                <table class="table-shopping-cart">
                    <tr class="table-head">
                        <th class="column-1"></th>
                        <th class="column-2">สินค้า</th>
                        <th class="column-3">ราคาต่อชิ้น</th>
                        <th class="column-4 p-l-70">จำนวน</th>
                        <th class="column-5">ราคารวม</th>
                        <th class="column-5"></th>
                    </tr>
                    <tr class="table-row">
                        <td colspan="6" style="text-align: center;color: red"> - ไม่มีสินค้าที่เลือก -</td>
                    </tr>
                </table>

        <?php }else{?>
        <!-- Cart item -->
        <form action="updateToCart_action.php" method="post">

        <div class="container-table-cart pos-relative">
            <div class="wrap-table-shopping-cart bgwhite">
                <a href="product.php"><i class="fa fa-angle-double-left" style="font-size:24px"></i> &nbsp;กลับไปยังหน้าสินค้า</a>
                <table class="table-shopping-cart">
                    <tr class="table-head">
                        <th class="column-1"></th>
                        <th class="column-2">สินค้า</th>
                        <th class="column-3">ราคาต่อชิ้น</th>
                        <th class="column-4 p-l-70">จำนวน</th>
                        <th class="column-5">ราคารวม</th>
                        <th class="column-5"></th>
                    </tr>
                    <?php
                    if(!empty($_SESSION["shopping_cart"]))
                    {
                        $total = 0;

                        foreach($_SESSION["shopping_cart"] as $keys => $values)
                        {
                            echo "<input type=\"hidden\" name=\"name2[]\" value=\"$values[name]\">
                            <input type=\"hidden\" name=\"price2[]\" value=\"$values[price]\">
                            <input type=\"hidden\" name=\"pdID2[]\" value=\"$values[pdID]\">";
                            if($values["pdID"]!==null) {
                                $sql3 = "SELECT * FROM image WHERE pdID= '".$values["pdID"]."' LIMIT 1";
                                $result3 = mysqli_query($con,$sql3);
                                $row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);
                                ?>
                                <tr class="table-row">
                                    <td class="column-1">
                                        <div class="cart-img-product b-rad-4 o-f-hidden">
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
                                    </td>
                                    <td class="column-2"><?php echo $values["name"]; ?></td>
                                    <td class="column-3">฿  <?php echo $values["price"]; ?></td>
                                    <td class="column-4">
                                        <div class="flex-w bo5 of-hidden w-size17">
                                            <button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
                                                <i class="fs-12 fa fa-minus" aria-hidden="true"></i>
                                            </button>

                                            <input class="size8 m-text18 t-center num-product" type="number" name="quantity2[]" value="<?php echo $values["quantity"]; ?>">

                                            <button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2" >
                                                <i class="fs-12 fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="column-5">฿ <?php echo ($values["quantity"] * $values["price"]); ?></td>
                                    <td class="column-6">  <?php echo "<a href='deleteFromCart_action.php?pdID=$values[pdID]' style='background-color: red;margin-left: 2%' class='flex-c-m bg1 bo-rad-5 hov1 s-text1 trans-0-4'>
                                            X
                                         </a>";?>  </td>
                                </tr>

                                <?php
                                $total = $total + ($values["quantity"] * $values["price"]);
                                $count += $values["quantity"];
                                //echo $total;
                            }
                            else{
                                unset($_SESSION["shopping_cart"][$keys]);
                                ?>
                                <tr class="table-row">
                                    <td colspan="6" style="text-align: center;color: red"> - ไม่มีสินค้าที่เลือก -</td>
                                </tr>
                                <?php

                            }
                        }

                    }
                    else{
                        ?>
                        <tr class="table-row">
                            <td colspan="6" style="text-align: center;color: red"> - ไม่มีสินค้าที่เลือก -</td>
                        </tr>
                        <?php
                    }
                    ?>

                    <?php
                    if(!empty($_SESSION["shopping_cart"])){
                        if($total!==null) {
                            ?>
                            <tr class="table-row">
                                <td colspan="4" style="text-align: right">รวมค่าสินค้าทั้งหมด:  &nbsp;&nbsp;</td>
                                <td style="color: red">฿ <?php echo number_format($total, 0); ?></td>
                                <td></td>
                            </tr>
                            <?php
                        }
                    }?>

                </table>
            </div>
        </div>

        <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
            <div class="flex-w flex-m w-full-sm"></div>
            <div class="size10 trans-0-4 m-t-10 m-b-10">
                <!-- Button -->
                <input type="submit" value="อัพเดตราคาสินค้า" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
<!--                <button class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">-->
<!--                    อัพเดทราคาสินค้า-->
<!--                </button>-->
            </div>
        </div>
        </form>
    <!--Code promotion-->
        <div class="flex-w flex-sb-m p-t-25 p-b-25 bo8 p-l-35 p-r-60 p-lr-15-sm">
            <form action="cart.php" method="post">
            <div class="flex-w flex-m w-full-sm">
                <div class="size11 bo4 m-r-10">
                    <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="codePromo" placeholder="โค้ดส่วนลด">
                </div>

                <div class="size12 trans-0-4 m-t-10 m-b-10 m-r-10">
                    <!-- Button -->
                    <button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                        ใช้โค้ด
                    </button>
                </div>
            </div>
            </form>
            <?php
                if(isset($_POST['codePromo'])) {
                    //echo $_POST['codePromo'];
                    include ('../dbConnect.php');
                    $sqlC = "SELECT * FROM code WHERE codeText = '".$_POST['codePromo']."'";
                    $resultC = mysqli_query($con, $sqlC);
                    $rowC = mysqli_fetch_array($resultC,MYSQLI_ASSOC);
                    if(!empty($rowC)) {
                        if ($rowC['active'] == 1) {
                            $drnM = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
                            $drnM = $drnM->format("Y-m-d");
                            if ($rowC['dateDelete'] > $drnM) {

                                $valueDIscount = $rowC['discount'];
                                $unit = $rowC['unitDiscount'];
                                $codeID=$rowC['codeID'];
                                //Active
                            } else {

                                $valueDIscount = 0;
                                $unit = null;
                                $codeID=null;
                                echo "ส่วนลดหมดอายุแล้ว";
                            }
                        } else {
                            $valueDIscount = 0;
                            $unit = null;
                            $codeID=null;
                        }
                    }else{
                        $valueDIscount = 0;
                        $unit = null;
                        $codeID=null;
                        echo "ไม่มีส่วนลด";
                    }

                }
                else{
                    $valueDIscount=0;
                    $unit=null;
                    $codeID=null;
                }
            ?>

            <div class="size10 trans-0-4 m-t-10 m-b-10">
               <?php
                if($unit!=null){
                    echo "<span style='color: red'>คุณได้รับส่วนลด  </span>";
                    if($unit=="bath"){
                        echo  "<span style='color: red'> ". $valueDIscount." บาท</span>";
                        $summaryPrice=$total-$valueDIscount;
                        $discount=$valueDIscount;
                    }
                    else if($unit=="percent"){
                        echo  "<span style='color: red'> ". $valueDIscount." %</span>";
                        $summaryPrice=($total*(100-$valueDIscount))/100;
                        $discount=($total*$valueDIscount)/100;
                    }
                }
                else{
                    $summaryPrice=$total;
                }
               ?>
            </div>
        </div>
        <!-- Total -->
        <div class="bo9 w-size29 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
            <h5 class="m-text20 p-b-24">
                สรุปรายการสินค้า
            </h5>

            <!--  -->
            <div class="flex-w flex-sb-m p-b-12">
					<span class="s-text18 w-size19 w-full-sm">
						ยอดรวมสินค้า :
					</span>

                <span class="m-text21 w-size20 w-full-sm">

                    <span style='color: red'>฿ <?php echo number_format($summaryPrice, 0);?></span>
					</span>
            </div>

         <form action="checkout.php" method="post">
            <div class="flex-w flex-sb bo10 p-t-15 p-b-20">
					<span class="s-text18 w-size19 w-full-sm">
						เลือกวิธีการจัดส่งสินค้า :
					</span>

                <div class="w-size20 w-full-sm">
                    <p class="s-text8 p-b-23">
                        ชิ้นที่ 5 เป็นต้นไปบวกค่าส่งเพิ่มชิ้นละ 5 บาท
                    </p>


                    <table class="table-shipping">
                       <tr>
                           <td>
                               <input type="radio" name="ship" value="Regis"  checked > + พัสดุลงทะเบียน <br>ระยะเวลาจัดส่ง :   3 - 7 วันทำการ
                           </td>
                           <td> ค่าจัดส่ง </td>
                           <td>30 บาท</td>
                       </tr>

                        <tr>
                            <td>
                                <input type="radio" name="ship" value="Ems" > + พัสดุด่วนพิเศษ (EMS)<br>ระยะเวลาจัดส่ง :   1 - 2 วันทำการ
                            </td>
                            <td> ค่าจัดส่ง </td>
                            <td>50 บาท</td>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="ship" value="Kerry" > + Kerry Express<br>ระยะเวลาจัดส่ง :   1 - 2 วันทำการ
                            </td>
                            <td> ค่าจัดส่ง </td>
                            <td>50 บาท</td>
                        </tr>
                    </table>

                </div>
            </div>

            <div class="flex-w flex-sb bo16 p-t-15 p-b-20">
                <span class="s-text18 w-size19 w-full-sm">
                       ชื่อผู้รับ :
					</span>
                <div class="w-size20 w-full-sm p-b-20">
                    <textarea class="form-control" style="width: 100%" rows="1" name="nameShip" required><?php echo $row['name'];?></textarea>
                </div>

					<span class="s-text18 w-size19 w-full-sm">
                        ที่อยู่ในการจัดส่ง :
					</span>

                <div class="w-size20 w-full-sm p-b-20">
                    <textarea class="form-control" style="width: 100%" rows="3" name="addressShip" required><?php echo $row['address'];?></textarea>
                </div>

                <span class="s-text18 w-size19 w-full-sm">
                        เบอร์โทรศัพท์ :
				</span>
<!--                <div class="size11 bo4 m-r-10">-->
<!--                    <input class="sizefull s-text7 p-l-22 p-r-22" type="text" name="codePromo" placeholder="โค้ดส่วนลด">-->
<!--                </div>-->
                <div class="w-size20 bo4 w-full-sm" >
                    <input type="tel"  class="form-control" style="width: 100%" name="telShip" pattern="^[0-9-+s()]*$" value="<?php echo $row['phone_number'];?>" required>
                </div>
            </div>

            <div class="flex-w flex-sb bo16 p-t-15 p-b-20">

                <span class="s-text18 w-size19 w-full-sm">
                        ข้อความ :
					</span>

                <div class="w-size20 w-full-sm">
                    <textarea class="form-control" style="width: 100%" rows="1" name="msgShip" placeholder="(ไม่บังคับ) ฝากข้อความถึงเจ้าของร้าน"></textarea>
                </div>
            </div>

<!--            <input type="hidden" name="lastPriceShip" value="--><?php //if($count>5){$addShip = ($count-5)*5;}echo number_format(($summaryPrice+30+$addShip), 0);?><!--">-->
            <input type="hidden" name="discountShip" value="<?php echo $discount;?>">
            <input type="hidden" name="countShip" value="<?php echo $count;?>">
             <input type="hidden" name="codeID" value="<?php echo $codeID;?>">

            <!--  -->
            <div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="m-text22 w-size19 w-full-sm">
						ยอดชำระเงินทั้งหมด :
					</span>

                <span class="m-text21 w-size20 w-full-sm" >

                   <span id="lastPrice" style="color: red">฿ <?php
                       if($count>5){
                           $addShip = ($count-5)*5;
                       }
                       echo number_format(($summaryPrice+30+$addShip), 0);?></span>
					</span>
            </div>

            <div class="size15 trans-0-4">
                <!-- Button -->
                <button type="submit" class="flex-c-m sizefull bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                    ดำเนินการต่อ
                </button >
            </div>
            </form>
            <?php }?>
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

<script>
    $('input[type=radio][name=ship]').change(function() {
        if (this.value == 'Regis') {
            <?php $ship = 30;
            if($count>5){
                $addShip = ($count-5)*5;
            }
            $lastPrice = number_format(($summaryPrice+$ship+$addShip), 0);?>
            document.getElementById("lastPrice").innerHTML = "฿ <?php echo $lastPrice;?>";

        }
        else if (this.value == 'Ems') {
            <?php $ship = 50;
            if($count>5){
                $addShip = ($count-5)*5;
            }
            $lastPrice = number_format(($summaryPrice+$ship+$addShip), 0);?>
            document.getElementById("lastPrice").innerHTML = "฿ <?php echo $lastPrice;?>";
        }
        else if (this.value == 'Kerry') {
            <?php $ship = 50;
            if($count>5){
                $addShip = ($count-5)*5;
            }
            $lastPrice = number_format(($summaryPrice+$ship+$addShip), 0);?>
            document.getElementById("lastPrice").innerHTML = "฿ <?php echo $lastPrice;?>";

        }
    });
</script>

<script>
    $('input[type=radio][name=ship]').change(function() {
        if (this.value == 'Regis') {
            <?php $ship = 30;
            if($count>5){
                $addShip = ($count-5)*5;
            }
            $lastPrice = number_format(($summaryPrice+$ship+$addShip), 0);?>
            document.getElementById("lastPriceShip").innerHTML = "฿ <?php echo $lastPrice;?>";

        }
        else if (this.value == 'Ems') {
            <?php $ship = 50;
            if($count>5){
                $addShip = ($count-5)*5;
            }
            $lastPrice = number_format(($summaryPrice+$ship+$addShip), 0);?>
            document.getElementById("lastPriceShip").innerHTML = "฿ <?php echo $lastPrice;?>";
        }
        else if (this.value == 'Kerry') {
            <?php $ship = 50;
            if($count>5){
                $addShip = ($count-5)*5;
            }
            $lastPrice = number_format(($summaryPrice+$ship+$addShip), 0);?>
            document.getElementById("lastPriceShip").innerHTML = "฿ <?php echo $lastPrice;?>";
        }
    });
</script>

<!--===============================================================================================-->
<script src="../js/main.js"></script>

</body>
</html>
