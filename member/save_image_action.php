<?php

	$imagedata = base64_decode($_POST['imgdata']);
	$filename = 'custom_'.md5(uniqid(rand(), true));
	//path where you want to upload image
	$file = 'custom_design/'.$filename.'.png';
	//$imageurl  = 'http://example.com/uploads/'.$filename.'.png';
	$imageurl  = 'custom_design/'.$filename.'.png';
	file_put_contents($file,$imagedata);
    //echo $imageurl;

    $designBy=$_POST['name'];
    $price=$_POST['price'];
    $cost=$_POST['cost'];
    $dateCreate = date("Y-m-d H:i:s");
    $pdID = uniqid();
    $quantity=1;

        include ('../dbConnect.php');
        $sql2="INSERT INTO product (pdID,name,price,cost,dateCreate,custom)VALUES('$pdID','$filename','$price','$cost','$dateCreate',1)";//คำสั่งเพิ่มข้อมูล
        $sql_query2=mysqli_query($con,$sql2);
        //echo $image;
        //$sql = "INSERT INTO image (imgID,img,pdID,delete)VALUES('','$image','',0)";//คำสั่งเพิ่มข้อมูล
         $sql = "INSERT INTO design (designID,pdID,imgPath,designBy)VALUES('','$pdID','$imageurl','$designBy')";
        $sql_query = mysqli_query($con, $sql);

//        if($sql_query) {
//            echo "เพิ่มไปยังตระกร้าสินค้าเรียบร้อยแล้ว";
//            //echo "<meta http-equiv ='refresh'content='0;URL=../indexForOwner.php'>";
//            //return "success";
//        }else{
//            echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล" ;
//            //return "Failed";
//        }


//    $myfile = fopen("custom_design/newfile.txt", "w") or die("Unable to open file!");
//    $txt =$_POST['imgdata']."\n".$_POST['name']."\n";
//    fwrite($myfile, $txt);
//    $txt = $_POST['cost']."\n".$_POST['price']."\n";
//    fwrite($myfile, $txt);
//    fclose($myfile);


session_start();

    if(isset($_SESSION["shopping_cart"]))
    {   //loop check
        $item_array_id = array_column($_SESSION["shopping_cart"], "pdID");
        if(!in_array($pdID, $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'pdID'               =>     $pdID,
                'quantity'          =>     $quantity,
                'name'          =>     $filename,
                'price'          =>     $price
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
            echo 'เพิ่มสินค้าในตระกร้าสินค้าเรียบร้อยแล้ว';
//            echo '<script>location.replace(document.referrer);</script>';

        }
        else{
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                if($values["pdID"]===$pdID){
                    //$quantity = $_POST['quantity']+$values["quantity"];
                    //delete old
                    unset($_SESSION["shopping_cart"][$keys]);
                    $item_array = array(
                        'pdID'               =>     $pdID,
                        'quantity'          =>     $quantity,
                        'name'          =>     $filename,
                        'price'          =>     $price
                    );
                    $_SESSION["shopping_cart"][$keys] = $item_array;
                    echo 'เพิ่มสินค้าในตระกร้าสินค้าเรียบร้อยแล้ว';
//            echo '<script>location.replace(document.referrer);</script>';
                    break;
                }

            }

        }

    }
    else
    {
        $item_array = array(
            'pdID'               =>     $pdID,
            'quantity'          =>     $quantity,
            'name'          =>     $filename,
            'price'          =>     $price
        );
        $_SESSION["shopping_cart"][0] = $item_array;
        echo 'เพิ่มสินค้าในตระกร้าสินค้าเรียบร้อยแล้ว';
//            echo '<script>location.replace(document.referrer);</script>';
    }



?>