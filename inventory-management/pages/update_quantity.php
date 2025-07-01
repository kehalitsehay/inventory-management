<?php
session_start();

$index = $_POST['index'];
$change = $_POST['change'];

// Check if the item exists in the session
if (isset($_SESSION['cart'][$index])) {
    // Update the quantity
    $new_quantity = $_SESSION['cart'][$index]['quantity'] + $change;

    // Prevent quantity from going below 1
    if ($new_quantity > 0) {
        $_SESSION['cart'][$index]['quantity'] = $new_quantity;
        echo "Quantity updated.";
    } else {
        echo "Quantity cannot be less than 1.";
    }
} else {
    echo "Item not found in cart.";
}
?>
