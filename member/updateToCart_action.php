<?php
session_start();
if(isset($_POST['pdID2'])){
    $quantity = $_POST['quantity2'];
    $pdID = $_POST['pdID2'];
    $name = $_POST['name2'];
    $price = $_POST['price2'];
//echo count($quantity);
    for($i =0; $i<count($pdID);$i++){
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["pdID"]==$pdID[$i]){
                //delete old
                unset($_SESSION["shopping_cart"][$keys]);
                $item_array = array(
                    'pdID'               =>     $pdID[$i],
                    'quantity'          =>     $quantity[$i],
                    'name'          =>     $name[$i],
                    'price'          =>     $price[$i]
                );
                $_SESSION["shopping_cart"][$keys] = $item_array;
                echo '<script>alert("อัพเดตสินค้าในตระกร้าสินค้าเรียบร้อยแล้ว")</script>';
                echo '<script>location.replace(document.referrer);</script>';

            }
        }
    }
}
else{
    echo '<script>location.replace(document.referrer);</script>';
}








?>
