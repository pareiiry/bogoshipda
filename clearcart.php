<?php
session_start();
foreach($_SESSION["shopping_cart"] as $keys => $values) {
    unset($_SESSION["shopping_cart"][$keys]);
}
//session_destroy();
echo '<script>location.replace(document.referrer);</script>';