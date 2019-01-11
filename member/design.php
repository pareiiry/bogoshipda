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

$sql2 = "SELECT * FROM product WHERE product.delete=0 ORDER BY dateCreate DESC LIMIT 10";
$result2 = mysqli_query($con,$sql2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bogoshipda | ออกแบบ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="../images/icons/favicon.png"/>
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
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if IE]><script type="text/javascript" src="../js/excanvas.js"></script><![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="../js/fabric.js"></script>
    <script type="text/javascript" src="../js/tshirtEditor.js"></script>
    <script type="text/javascript" src="../js/jquery.miniColors.min.js"></script>

    <!-- Le styles -->
    <link type="text/css" rel="stylesheet" href="../css/jquery.miniColors.css" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <script type="text/javascript">
    </script>
    <style type="text/css">
        a {
            font-family: Montserrat-Regular;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.7;
            color: #666666;
            margin: 0px;
            transition: all 0.4s;
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            text-decoration: none;
        }

        a:focus {
            outline: none !important;
        }

        a:hover {
            text-decoration: none;
            color: #ffaeba;
        }

        body {
            padding-top: 60px;
        }
        .color-preview {
            border: 1px solid #CCC;
            margin: 2px;
            zoom: 1;
            vertical-align: top;
            display: inline-block;
            cursor: pointer;
            overflow: hidden;
            width: 20px;
            height: 20px;
        }
        .text-fontcolor {
            border: 1px solid #CCC;
            margin: 2px;
            zoom: 1;
            vertical-align: top;
            display: inline-block;
            cursor: pointer;
            overflow: hidden;
            width: 20px;
            height: 20px;
        }
        .rotate {
            -webkit-transform:rotate(90deg);
            -moz-transform:rotate(90deg);
            -o-transform:rotate(90deg);
            /* filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=1.5); */
            -ms-transform:rotate(90deg);
        }

        .Impact{font-family:"Impact";}
        .BebasKai{font-family: "Bebas Kai";}
        .FrontPageNeue{font-family: "Front Page Neue";}
        .CollegeBlock{font-family: "College Block";}
        .JerseyM54{font-family: "Jersey M54";}
        .Minercraftory{font-family: "Minercraftory";}
        .Vonique64{font-family: "Vonique 64";}
        .TRACEROUTE{font-family: "TRACEROUTE";}
        .Differentiator{font-family: "Differentiator";}
        .MouseDeco{font-family: "Mouse Deco";}
        .HeyPrettyGirl{font-family: "Hey Pretty Girl";}
        .CarolinaValtuilleRegular{font-family: "Carolina Valtuille Regular";}
        .Traffolight{font-family: "Traffolight";}
        .cookies{font-family: "Cookies";}
        .topo{font-family: "Topo";}

    </style>
</head>

<body class="preview" data-spy="scroll" data-target=".subnav" data-offset="80">


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

                        <li class="sale-noti">
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

                                                if($row3['pdImgPath']==="" || empty($row3)){
                                                    echo '<img src="../images/no-picture.jpg">';
                                                }
                                                else {
                                                    echo '<img src="../'.$row3['pdImgPath'].'"/></a>';
                                                }
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
<div class="container">
    <section id="typography">


        <!-- Headings & Paragraph Copy -->
        <div class="row">
            <div class="span3">

                <div class="tabbable"> <!-- Only required for left/right tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab">สี</a></li>
                        <li><a href="#tab2" data-toggle="tab">ข้อความ / รูปภาพ</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <div class="well">
                                <!--					      	<h3>Tee Styles</h3>-->
                                <!--						      <p>-->
                                <select id="strap">
                                    <option value="1" selected="selected">1 ด้าน</option>
                                    <option value="2">2 ด้าน</option>
                                </select>
                                <!--						      </p>-->
                            </div>
                            <div class="well">
                                <ul class="nav">
                                    <li class="color-preview" title="ขาว" style="background-color:#ffffff;"></li>
                                    <li class="color-preview" title="ครีม" style="background-color:#fffdbd;"></li>
                                    <li class="color-preview" title="ชานม" style="background-color:#fff18f;"></li>
                                    <li class="color-preview" title="เหลือง" style="background-color:#fff71b;"></li>
                                    <li class="color-preview" title="เขียว" style="background-color:#44cb4d;"></li>
                                    <li class="color-preview" title="เขียวเข้ม" style="background-color:#1b6140;"></li>
                                    <li class="color-preview" title="มิ้นต์" style="background-color:#bdffce;"></li>
                                    <li class="color-preview" title="ฟ้า" style="background-color:#278bd3;"></li>
                                    <li class="color-preview" title="ส้มอ่อน" style="background-color:#ffde97;"></li>
                                    <li class="color-preview" title="ชมพูอ่อน" style="background-color:#ffc7c2;"></li>
                                    <li class="color-preview" title="ชมพู" style="background-color:#ffa5b0;"></li>
                                    <li class="color-preview" title="ชมพูเข้ม" style="background-color:#f23063;"></li>
                                    <li class="color-preview" title="แดง" style="background-color:#ae0000;"></li>
                                    <li class="color-preview" title="ม่วงอ่อน" style="background-color:#e5c6e7;"></li>
                                    <li class="color-preview" title="เทาอ่อน" style="background-color:#9f9f9f;"></li>
                                    <li class="color-preview" title="เทาเข้ม" style="background-color:#343434;"></li>
                                    <li class="color-preview" title="น้ำตาล" style="background-color:#251507;"></li>
                                    <li class="color-preview" title="ดำ" style="background-color:#000000;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="well">
                                <div class="input-append">
                                    <input class="span2" id="text-string" type="text" placeholder="เพิ่มข้อความ..." style="height: auto;">
                                    <button id="add-text" class="btn" title="Add text"><i class="fa fa-check" aria-hidden="true"></i>
                                        </i></button>
                                    <hr>

                                </div>
                                <button style="display:block;" class="btn btn-primary" onclick="document.getElementById('imgInp').click()">อัพโหลดไฟล์...</button>
                                <input type='file' id="imgInp" style="display:none">
                                <br>
                                <div id="avatarlist" style="margin-top: 5%">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/astro1-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/astro1-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/astro2-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/astro2-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/b1a4-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/b1a4-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/bp1-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/bp1-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/bp2-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/bp2-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/bts1-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/bts1-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/bts2-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/bts2-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/bts3-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/bts3-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/exo1-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/exo1-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/exo2-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/exo2-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/exo3-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/exo3-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/got7-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/got7-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/icon-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/icon-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/mon-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/mon-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/mon2-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/mon2-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/seventeen-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/seventeen-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/seventeen2-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/seventeen2-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/twice-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/twice-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/wo-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/wo-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/heart-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/heart-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/heartl-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/heartl-w.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/line-b.png">
                                    <img style="cursor:pointer;" class="img-polaroid" src="../img/kpop/line-w.png">
                                </div>

                                <style>
                                    input[type="file"]{
                                        color: transparent;
                                    }
                                </style>
                                <script>
                                    $(function () {
                                        $('input[type="file"]').change(function () {
                                            if ($(this).val() != "") {
                                                $(this).css('color', '#333');
                                            }else{
                                                $(this).css('color', 'transparent');
                                            }
                                        });
                                    })


                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span7" style="height: 600px">
                <div align="center" style="min-height: 32px;">
                    <div class="clearfix">
                        <div class="btn-group inline pull-left" id="texteditor" style="display:block">
                            <button id="font-family" class="btn dropdown-toggle" data-toggle="dropdown" title="Font Style">
                                <i class="fa fa-font" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="font-family-X">
                                <li><a tabindex="-1" href="#" onclick="setFont('Impact');" class="Impact">Impact </a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('BeBas Kai');" class="BebasKai">Bebas Kai</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Front Page Neue');" class="FrontPageNeue">Front Page Neue</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('College Block');" class="CollegeBlock">College Block</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Jersey M54');" class="JerseyM54">Jersey M54</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Minercraftory');" class="Minercraftory">Minercraftory</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Vonique 64');" class="Vonique64">Vonique 64</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('TRACEROUTE');" class="TRACEROUTE">TRACEROUTE</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Differentiator');" class="Differentiator">Differentiator</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Mouse Deco');" class="MouseDeco">Mouse Deco</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Hey Pretty Girl');" class="HeyPrettyGirl">Hey Pretty Girl</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('CarolinaValtuilleRegular');" class="CarolinaValtuilleRegular">Carolina Valtuille</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Traffolight');" class="Traffolight">Traffolight</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('cookies');" class="cookies">Cookies</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('topo');" class="topo">Topo</a></li>
                            </ul>
                            <button id="text-bold" class="btn" data-original-title="Bold"><i class="fa fa-bold"></i></button>
                            <button id="text-italic" class="btn" data-original-title="Italic"><i class="fa fa-italic" aria-hidden="true"></i></button>
                            <a class="btn" href="#" rel="tooltip" data-placement="top" data-original-title="Font Color"><input type="hidden" id="text-fontcolor" class="color-picker" size="7" value="#000000"></a>

                            <!--- Background <input type="hidden" id="text-bgcolor" class="color-picker" size="7" value="#ffffff"> --->
                        </div>
                        <div class="pull-right" align="" id="imageeditor" style="display:block">
                            <div class="btn-group">
                                <button class="btn" id="bring-to-front" title="Bring to Front">
                                    <i class="fa fa-chevron-up" aria-hidden="true"></i>
                                </button>
                                <button class="btn" id="send-to-back" title="Send to Back">
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                </button>
                                <button id="remove-selected" class="btn" title="Delete selected item">
                                    <i class="fa fa-trash" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--	EDITOR      -->
                <div id="shirtDiv" class="page" style="width: 670px; height: 500px; position: relative; background-color: rgb(255, 255, 255);">
                    <img id="tshirtFacing" src="../img/strap1.png">
                    <div id="drawingArea" style="position: absolute;top: 50px;left: 155px;z-index: 10;width: 595px;height: 83px;">
                        <canvas id="tcanvas" width=530 height="400" class="hover" style="-webkit-user-select: none;"></canvas>
                    </div>
                </div>
                <!--					<div id="shirtBack" class="page" style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255); display:none;">-->
                <!--						<img src="img/crew_back.png"></img>-->
                <!--						<div id="drawingArea" style="position: absolute;top: 100px;left: 160px;z-index: 10;width: 200px;height: 400px;">					-->
                <!--							<canvas id="backCanvas" width=200 height="400" class="hover" style="-webkit-user-select: none;"></canvas>-->
                <!--						</div>-->
                <!--					</div>						-->

                <!--	/EDITOR		-->
            </div>

            <div class="span2">
                <div class="well">
                    <input type="hidden" name="nameUser" id="nameUser" value="<?php echo "".$row["name"];?>">
                    <h3 align="center">฿ <input value="100" id="price" name="price" style="width: 60px;color: #1b6d85;font-size: 20px" disabled></h3>
                    <button type="button" class="btn btn-large btn-block btn-primary" name="addToTheBag" id="addToTheBag">เพิ่มลงตะกร้า</button>
                </div>
            </div>

        </div>

    </section>
</div><!-- /container -->

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
<!--===============================================================================================-->
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-35639689-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

</script>

<script src="../js/html2canvas.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $(document).on('click', '#addToTheBag', function() {
            html2canvas([document.getElementById('shirtDiv')], {
                onrendered: function (canvas) {
                    var imagedata = canvas.toDataURL('image/png');
                    var imgdata = imagedata.replace(/^data:image\/(png|jpg);base64,/, "");
                    //var imgDb = dataURLtoBlob(imagedata);
                    var price =  document.getElementById("price").value;
                    var name = document.getElementById("nameUser").value;
                    var cost = price/2;
                    //ajax call to save image inside folder
                    $.ajax({
                        url: 'save_image_action.php',
                        data: {imgdata:imgdata,
                                price:price,
                                name:name,
                                cost:cost,
                                imagedata:imagedata
                        },
                        type: 'post',
                        success: function (response) {
                            //console.log(response);
                            //$('#image_id img').attr('src', response);

                            alert(response);
                            location.replace(document.referrer);
                        }
                    });
                }
            });
        });
    });
</script>
<script src="../js/main.js"></script>
</body>
</html>