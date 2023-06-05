<?php
session_start();

// Empty the cart
$_SESSION['cart'] = array();

echo "success";
exit();
?>