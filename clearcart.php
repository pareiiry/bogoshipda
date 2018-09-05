<?php
session_start();
unset($_SESSION["shopping_cart"]["pdID"]);
session_destroy();
echo '<script>location.replace(document.referrer);</script>';