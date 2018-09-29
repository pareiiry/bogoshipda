<?php
session_start();
// clear session
foreach($_SESSION["shopping_cart"] as $keys => $values) {
    if( $_SESSION["shopping_cart"][$keys]['pdID'] == $_GET['pdID']){
        unset($_SESSION["shopping_cart"][$keys]);
        echo '<script>location.replace(document.referrer);</script>';
    //echo $_SESSION["shopping_cart"][$keys]['pdID'];
    }


}