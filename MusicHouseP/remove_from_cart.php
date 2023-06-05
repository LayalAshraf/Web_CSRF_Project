<?php
session_start();

// If there's no cart session or the provided id isn't in the cart, go back to My-Cart.php
if (!isset($_SESSION['cart']) || !isset($_GET['id']) || !in_array($_GET['id'], $_SESSION['cart'])) {
    header("Location: My-Cart.php");
    exit();
}

// Remove item from the cart
if (($key = array_search($_GET['id'], $_SESSION['cart'])) !== false) {
    unset($_SESSION['cart'][$key]);
}

// Re-index the array
$_SESSION['cart'] = array_values($_SESSION['cart']);

header("Location: My-Cart.php");
exit();
?>