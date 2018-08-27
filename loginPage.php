<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
        <link rel="icon" type="image/png" href="images/icons/favicon.png"/>

  <!--  <link rel="icon" href="./favicon.ico">-->

    <title>Bogoshipda | Login</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="checkLogin.php" method="post" style="background:#fff;border-radius: 10px">
    <!--<img  src="./images/logoLogin.jpg" alt="" height="72">-->
    <h1 class="h3 mb-3 font-weight-normal">ลงชื่อเข้าใช้</h1><hr>
    <label for="inputEmail" class="sr-only">อีเมลล์</label>
    <input type="email" id="email" name="email" class="form-control" placeholder="กรอกอีเมลล์" required autofocus>
    <label for="inputPassword" class="sr-only">รหัสผ่าน</label>
    <input type="password" id="password" name="password" class="form-control" placeholder="กรอกรหัสผ่าน" required>
    <div class="checkbox mb-3">
    </div>
    <div class="row">
    <button style="margin-right: 2%;margin-left: 5%;background: #ce4564" class="btn btn-lg btn-danger" type="button" onclick="document.location.href='index.php';">ยกเลิก</button>
    <button style="width: 61%;background: #7bd0c8; border-color:#67c1b6; color: white" class="btn btn-lg btn-default" type="submit">ลงชื่อเข้าใช้</button>
    </div>
    <div style="margin: 3%">
        <a href="signUpPage.php">สร้างบัญชีใหม่</a>
    </div>
    <p class="mt-5 mb-3 text-muted">Bogoshipda &copy; 2018</p>
</form>
</body>
</html>
