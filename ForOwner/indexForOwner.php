<?php
session_start();
if($_SESSION['ID'] == "")
{
    //echo "Please Login!";
    header("location:loginPage.php");
    exit();
}
if($_SESSION['usertype'] != "owner" && $_SESSION['usertype'] != "admin")
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


$sql2 = "SELECT * FROM product";
//$objQuery = mysqli_query($strSQL);
//$objResult = mysqli_fetch_array($objQuery);
$result2 = mysqli_query($con,$sql2);
//$row_getimgGID = mysqli_fetch_array($result2,MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bogoshipda Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
    <link rel="icon" type="image/png" href="../images/icons/favicon.png"/>
    <style>
        /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
        .row.content {height: 1000px}

        /* Set gray background color and 100% height */
        .sidenav {
            background-color: #4f4f4f;
            height: 100%;
        }

        /* Set black background color, white text and some padding */
        footer {
            background-color: #555;
            color: white;
            padding: 15px;
        }

        /* On small screens, set height to 'auto' for sidenav and grid */
        @media screen and (max-width: 767px) {
            .sidenav {
                height: auto;
                padding: 15px;
            }
            .row.content {height: auto;}
		}
        a {
			font-size: 12px;
			color:#fff;
			}
			
        a:hover {
			color:#FFF;
        }
        .navbar {
            margin-bottom: 0px;
			border-radius:0px;
        }

        * {
            box-sizing: border-box;
        }

        #myInput {
            background-image: url("../img/search1.png");
            background-size: 25px;
            background-position: 10px 5px;
            background-repeat: no-repeat;
            /*width: 20%;*/
            /*font-size: 16px;*/
            padding: 0px 20px 0px 40px;
            border: 1px solid #ddd;
			margin-top:10px;
			margin-left:90px;
            /*margin-bottom: 2px;*/
            border-radius: 8px;
			height:35px;	
        }

        #myTable {
            border-collapse: collapse;
            width: 100%;
            border-top: 1px solid #ddd;
            /*font-size: 18px;*/
        }

        #myTable th, #myTable td {
            text-align: left;
            padding: 12px;
        }

        #myTable tr {
            border-bottom: 1px solid #ddd;
        }

        #myTable tr.header {
            background-color: #edf9f7;
			color: #00a9a3;
        }
		#myTable tr:hover {
            background-color: #edf9f7;
        }
        /* Style buttons */
        .btn-edit {
            background-color: #CCC  ; /* Blue background */
            border: none; /* Remove borders */
            color: white; /* White text */
            padding: 0px; /* Some padding */
            font-size: 16px; /* Set a font size */
            cursor: pointer; /* Mouse pointer on hover */
            border-radius: 10px;
			width: 30px;
			height: 30px;
			margin-left:10px;
			
        }

        /* Darker background on mouse-over */
        .btn-edit:hover {
            background-color: #6CF;
        }
        .btn-delete {
            background-color: #ccc; /* Blue background */
            border: none; /* Remove borders */
            color: white; /* White text */
            padding: 0px; /* Some padding */
            font-size: 16px; /* Set a font size */
            cursor: pointer; /* Mouse pointer on hover */
            border-radius: 10px;
			width: 30px;
			height: 30px;
			margin-left:10px;
        }

        /* Darker background on mouse-over */
        .btn-delete:hover {
            background-color: #d15252;
        }
		
		.bg-icon{
			background-color: #666;
			border-radius: 8px;
			
		}
		.bg-icon:hover {
			background-color:#aadcd8;
		}
		.bg-icon-current {
			background-color: #aadcd8;
			border-radius: 8px;
		}
			
			
    </style>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand" >Bogoshipda Admin</div>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="navbar-text">สวัสดี คุณ <?php echo "".$row["name"];?></li>
                <li><a href="../logout.php"><span class="glyphicon glyphicon-log-in"></span> ออกจากระบบ</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav" style="font-size: 10px;">
            <br>
<!--            <h4>Bogoshipda Admin</h4>-->
            <div class="container-fluid bg-3 text-center">
                <div class="row">
                    <div class="col-sm-3">
<!--                        <p>Some text..</p>-->
                        <a href="indexForOwner.php" ><img class="bg-icon-current" src="../img/menu_bar_admin/product.png" style="width:100%; " alt="Image">สินค้า</a>
                    </div>
                    <div class="col-sm-3">
<!--                        <p>Some text..</p>-->
                        <a href="#"><img class="bg-icon" src="../img/menu_bar_admin/order.png" style="width:100%" alt="Image">สั่งซื้อ</a>
                    </div>
                    <div class="col-sm-3">
<!--                        <p>Some text..</p>-->
                        <a href="#"><img class="bg-icon" src="../img/menu_bar_admin/payment.png" style="width:100%" alt="Image">ชำระเงิน</a>
                    </div>
                    <div class="col-sm-3">
<!--                        <p>Some text..</p>-->
                        <a href="#"><img class="bg-icon" src="../img/menu_bar_admin/shipment.png" style="width:100%" alt="Image">ขนส่ง</a>
                    </div>
                </div>
            </div><br>
            <div class="container-fluid bg-3 text-center">
                <div class="row">
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="manageMember.php"><img class="bg-icon" src="../img/menu_bar_admin/user.png" style="width:100%" alt="Image">สมาชิก</a>
                    </div>
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="discount.php"><img class="bg-icon" src="../img/menu_bar_admin/discount.png" style="width:100%" alt="Image">ส่วนลด</a>
                    </div>
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="bank.php"><img class="bg-icon" src="../img/menu_bar_admin/account.png" style="width:100%" alt="Image">บัญชีรับเงิน</a>
                    </div>
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="#"><img class="bg-icon" src="../img/menu_bar_admin/news.png" style="width:100%" alt="Image">BANNER</a>
                    </div>
                </div>
            </div><br>
            <div class="container-fluid bg-3 text-center">
                <div class="row">
                    <div class="col-sm-3">
                        <!--                        <p>Some text..</p>-->
                        <a href="#"><img class="bg-icon" src="../img/menu_bar_admin/review.png" style="width:100%" alt="Image">รีวิว</a>
                    </div>
                    <div class="col-sm-3">
                        <a href="#"><img class="bg-icon" src="../img/menu_bar_admin/statistic.png" style="width:100%" alt="Image">รายงาน</a>
                    </div>
                    <div class="col-sm-3">

                    </div>
                </div>
            </div><br>
<!--            <ul class="nav nav-pills nav-stacked">-->
<!--                <li class="active"><a href="#section1">Home</a></li>-->
<!--                <li><a href="#section2">Friends</a></li>-->
<!--                <li><a href="#section3">Family</a></li>-->
<!--                <li><a href="#section3">Photos</a></li>-->
<!--            </ul><br>-->

<!--            <div class="input-group">-->
<!--                <input type="text" class="form-control" placeholder="Search Blog..">-->
<!--                <span class="input-group-btn">-->
<!--          <button class="btn btn-default" type="button">-->
<!--            <span class="glyphicon glyphicon-search"></span>-->
<!--          </button>-->
<!--        </span>-->
<!--            </div>-->
        </div>

        <div class="col-sm-9">
            <div class="row" style="margin-top: 5px">
                <div class="col-sm-4"><a href="addProduct.php" class="btn btn-success" role="button" style="margin-left: 2%;margin-top: 3%" >+ เพิ่มสินค้า</a></div>
                <div class="col-sm-4" align="center"><h3><b>รายการสินค้า</b></h3></div>
                <div class="col-sm-4"><input type="text" id="myInput" onkeyup="search()" placeholder="ค้นหาสินค้า..." title="Type in a name" width="100%" align="right"></div>
            </div>

            <hr>


            <table id="myTable">
                <tr class="header">
                    <th style="width:20%;text-align:center;">รูปสินค้า</th>
                    <th style="width:10%;text-align:center;">รหัสสินค้า</th>
                    <th style="width:20%;text-align:center;">ชื่อสินค้า</th>
                    <th style="width:10%;text-align:center;">ราคาขาย</th>
                    <th style="width:10%;text-align:center;">ต้นุทน</th>
                    <th style="width:10%;text-align:center;">จัดการ</th>
                </tr>
                <?php
                while($row2= mysqli_fetch_assoc($result2))// show the information from query
                {
                    $sql3 = "SELECT * FROM image WHERE pdID= '".$row2['pdID']."' LIMIT 1";
                    $result3 = mysqli_query($con,$sql3);
                    $row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);

                    echo "
                    <tr>
                    <td style=\"text-align:center;\">";
                    echo '<img style="width:30%" src="data:image/*;base64,'.base64_encode($row3['img']).'"/>';
                    echo"</td>
                    <td>$row2[pdID]</td>
                    <td>$row2[name]</td>
                     <td style=\"text-align:center;\">$row2[price]</td>
                     <td style=\"text-align:center;\">$row2[cost]</td>
                    <td style=\"text-align:center;\">
                       <div class='row'>
                       <div class=\"col-md-4\">
                       <form action=\"editProduct.php\" method=\"get\">
                            <input style='display: none;' type=\"text\" name=\"pdID\" value='$row2[pdID]'>
                            <button class='btn-edit' type=\"submit\"><i class=\"fa fa-edit\"></i></button>
                        </form>
                        </div>
                        <div class=\"col-md-6\" >
                        <form action=\"Action/deleteProduct_action.php\" method=\"get\">
                                <input style='display: none;' type=\"text\" name=\"pdID\" value='$row2[pdID]'>
                                <button class='btn-delete' type=\"submit\"><i class=\"fa fa-trash\"></i></button>
                        </form>
                        </div>
                        </div>
                        
                    </td>
                    </tr>
                    ";
                }?>









<!--                <tr>-->
<!--                    <td style="text-align:center;">-->
<!--                        <img src="../img/menu_bar_admin/news.png" style="width:50%" alt="Image">-->
<!--                    </td>-->
<!--                    <td>67890</td>-->
<!--                    <td>News</td>-->
<!--                    <td style="text-align:center;">50</td>-->
<!--                    <td style="text-align:center;">-->
<!--                        <a href=""><i class="material-icons" style="font-size:30px;color:gray">create</i></a>-->
<!--                        <a href=""><i class="material-icons" style="font-size:30px;color:gray">	delete_sweep</i></a>-->
<!--                    </td>-->
<!---->
<!--                </tr>-->

            </table>

            <script>
                function search() {
                    var input, filter, table, tr, td, i,td2;
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[1];
                        td2 = tr[i].getElementsByTagName("td")[2];
                        if (td||td2) {
                            if (td.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }
            </script>
<!--            <h2>I Love Food</h2>-->
<!--            <h5><span class="glyphicon glyphicon-time"></span> Post by Jane Dane, Sep 27, 2015.</h5>-->
<!--            <h5><span class="label label-danger">Food</span> <span class="label label-primary">Ipsum</span></h5><br>-->
<!--            <p>Food is my passion. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
<!--            <br><br>-->

<!--            <h4><small>RECENT POSTS</small></h4>-->
<!--            <hr>-->
<!--            <h2>Officially Blogging</h2>-->
<!--            <h5><span class="glyphicon glyphicon-time"></span> Post by John Doe, Sep 24, 2015.</h5>-->
<!--            <h5><span class="label label-success">Lorem</span></h5><br>-->
<!--            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
<!--            <hr>-->

<!--            <h4>Leave a Comment:</h4>-->
<!--            <form role="form">-->
<!--                <div class="form-group">-->
<!--                    <textarea class="form-control" rows="3" required></textarea>-->
<!--                </div>-->
<!--                <button type="submit" class="btn btn-success">Submit</button>-->
<!--            </form>-->
<!--            <br><br>-->

<!--            <p><span class="badge">2</span> Comments:</p><br>-->

<!--            <div class="row">-->
<!--                <div class="col-sm-2 text-center">-->
<!--                    <img src="bandmember.jpg" class="img-circle" height="65" width="65" alt="Avatar">-->
<!--                </div>-->
<!--                <div class="col-sm-10">-->
<!--                    <h4>Anja <small>Sep 29, 2015, 9:12 PM</small></h4>-->
<!--                    <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
<!--                    <br>-->
<!--                </div>-->
<!--                <div class="col-sm-2 text-center">-->
<!--                    <img src="bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">-->
<!--                </div>-->
<!--                <div class="col-sm-10">-->
<!--                    <h4>John Row <small>Sep 25, 2015, 8:25 PM</small></h4>-->
<!--                    <p>I am so happy for you man! Finally. I am looking forward to read about your trendy life. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
<!--                    <br>-->
<!--                    <p><span class="badge">1</span> Comment:</p><br>-->
<!--                    <div class="row">-->
<!--                        <div class="col-sm-2 text-center">-->
<!--                            <img src="bird.jpg" class="img-circle" height="65" width="65" alt="Avatar">-->
<!--                        </div>-->
<!--                        <div class="col-xs-10">-->
<!--                            <h4>Nested Bro <small>Sep 25, 2015, 8:28 PM</small></h4>-->
<!--                            <p>Me too! WOW!</p>-->
<!--                            <br>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</div>

<!--<footer class="container-fluid">-->
<!--    <p>Footer Text</p>-->
<!--</footer>-->

</body>
</html>
