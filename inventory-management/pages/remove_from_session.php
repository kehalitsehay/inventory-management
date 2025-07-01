<?php
session_start();

$index = $_POST['index'];

// Remove the item at the given index
if (isset($_SESSION['cart'][$index])) {
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index the array
    echo "Item removed from cart.";
} else {
    echo "Item not found in cart.";
}
?>
