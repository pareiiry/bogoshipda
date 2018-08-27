<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="icon" type="image/png" href="images/icons/favicon.png"/>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<?php

if (isset($_SESSION['post'])){
    $post=$_SESSION['post'];
}else{
    $post=array();
}
if (isset($_SESSION['error'])){
    $error=$_SESSION['error'];
}else{
    $error=array();
}

?>

<div class="container"  >
    <div class="row">
        <div class="col-md-8">
            <section>
                <h1 class="entry-title"><span>ลงทะเบียน</span> </h1>
                <hr align="center">
                <form class="form-horizontal" method="post" name="signup" id="signup" action="checkSignUp.php" >
                    <div class="form-group">
                        <label class="control-label col-sm-3">อีเมลล์ <span class="text-danger">*</span></label>
                        <div class="col-md-8 col-sm-9">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" class="form-control" name="email" id="email" placeholder="กรอกอีเมลล์" value="<?php echo isset($post['email']) ? $post['email'] : '';?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3">รหัสผ่าน <span class="text-danger">*</span></label>
                        <div class="col-md-5 col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="กรอกรหัสผ่าน" value="<?php echo isset($post['password']) ? $post['password'] : '';?>" required>
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
                        <label class="control-label col-sm-3">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
                        <div class="col-md-8 col-sm-9">
                            <input type="text" class="form-control" name="name" id="name" placeholder="กรอกชื่อ-นามสกุล" value="<?php echo isset($post['name']) ? $post['name'] : '';?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">วันเกิด <span class="text-danger">*</span></label>
                        <div class="col-md-5 col-sm-8">
                            <input class="form-control" type="date" name="dob" value="<?php echo isset($post['dob']) ? $post['dob'] : '';?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">เพศ <span class="text-danger">*</span></label>
                        <div class="col-md-8 col-sm-9">
                            <label>
                                <input name="gender" type="radio"  value="<?php echo isset($post['gender']) ? $post['gender'] : 'Male';?>" checked>
                                ชาย </label>
                               
                            <label>
                                <input name="gender" type="radio"  value="<?php echo isset($post['gender']) ? $post['gender'] : 'Female';?>" >
                                หญิง </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">เบอร์โทรศัพท์ <span class="text-danger">*</span></label>
                        <div class="col-md-5 col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="กรอกเเบอร์โทรศัพท์" value="<?php echo isset($post['phone_number']) ? $post['phone_number'] : '';?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">ที่อยู่ <span class="text-danger">*</span></label>
                        <div class="col-md-8 col-sm-9">
                            <textarea style="resize:none;" rows="3" class="form-control" name="address" id="address" placeholder="กรอกที่อยู่" value="<?php echo isset($post['address']) ? $post['address'] : '';?>" required></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-offset-3 col-xs-10">
                            <button class="btn btn-danger" type="button" onclick="document.location.href='index.php';">ยกเลิก</button>
                            <input style="background: #7bd0c8; border-color:#67c1b6; color: white" name="Submit" type="submit" value="ลงทะเบียน" class="btn btn-default">
                        </div>
                    </div>
                </form>
        </div>
    </div>
</div>
