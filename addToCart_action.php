<?php
session_start();
if(isset($_POST['pdID']))
{
//    $price = preg_replace( '/[^0-9]/', '', $_POST['price'] );
    //$priceBefore = preg_replace( '/[^0-9]/', '', $_POST['priceBefore'] );
    if(isset($_SESSION["shopping_cart"]))
    {   //loop check
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["pdID"]===$_POST['pdID']){
                $quantity = $_POST['quantity']+$values["quantity"];
                //delete old
                unset($_SESSION["shopping_cart"][$keys]);


            }
            else{
                $quantity = $_POST['quantity'];
            }
        }
        $item_array_id = array_column($_SESSION["shopping_cart"], "pdID");
        if(!in_array($_POST['pdID'], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'pdID'               =>     $_POST['pdID'],
                'quantity'          =>     $quantity,
                'name'          =>     $_POST['name'],
                'price'          =>     $_POST['price']
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
            echo '<script>alert("เพิ่มสินค้าในตระกร้าสินค้าเรียบร้อยแล้ว")</script>';
            echo '<script>location.replace(document.referrer);</script>';


        }
        else{
            echo '<script>alert("เพิ่มสินค้าในตระกร้าสินค้าเรียบร้อยแล้ว")</script>';
            echo '<script>location.replace(document.referrer);</script>';
        }
    }
    else
    {
        $item_array = array(
            'pdID'               =>     $_POST['pdID'],
            'quantity'          =>     $_POST['quantity'],
            'name'          =>     $_POST['name'],
            'price'          =>     $_POST['price']
        );
        $_SESSION["shopping_cart"][0] = $item_array;
        echo '<script>alert("เพิ่มสินค้าในตระกร้าสินค้าเรียบร้อยแล้ว")</script>';
        echo '<script>location.replace(document.referrer);</script>';
    }

}

//if(isset($_GET["action"]))
//{
//    if($_GET["action"] == "delete")
//    {
//        foreach($_SESSION["shopping_cart"] as $keys => $values)
//        {
//            if($values["pdID"] === $_GET['pdID'])
//            {
//                unset($_SESSION["shopping_cart"][$keys]);
//                echo '<script>alert("Item removed")</script>';
//                echo '<script>location.replace(document.referrer);</script>';
//            }
//        }
//    }
//}
?>
<!--<script type="text/javascript">location.href = 'index.html';</script>-->
