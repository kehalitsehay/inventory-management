<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $response = ['status' => 'error'];

    if ($action === 'add_to_cart') {
        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $quantity = (int) $_POST['quantity'];
        $price = (float) $_POST['price'];
        $vat = (float) $_POST['vat'];
        $expired_date = $_POST['expired_date'];
        $vatt = (float) $_POST['vat'];
        $subtotal = $quantity * $price;
        $vatAmount = $subtotal * $vat;
        $total = $subtotal + $vatAmount;

        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] === $productId) {
                $item['quantity'] += $quantity;
                $item['subtotal'] = $item['quantity'] * $item['price'];
                $item['vat'] = $item['subtotal'] * ($item['vat_rate'] / 100);
                $item['total'] = $item['subtotal'] + $item['vat'];
                $item['expired_date'] = $expired_date;
                $item['vatt'] = $vatt;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = [
                'product_id' => $productId,
                'product_name' => $productName,
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $subtotal,
                'vat_rate' => $vat,
                'vat' => $vatAmount,
                'total' => $total,
                'expired_date' => $expired_date,
                'vatt' => $vatt,
                
            ];
        }

        $response = ['status' => 'success', 'cart' => $_SESSION['cart']];
    }

    if ($action === 'update_quantity') {
        $productId = $_POST['product_id'];
        $change = $_POST['change']; // +1 or -1

        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] === $productId) {
                $item['quantity'] += $change;
                if ($item['quantity'] < 1) $item['quantity'] = 1;
                $item['subtotal'] = $item['quantity'] * $item['price'];
                $item['vat'] = $item['subtotal'] * ($item['vat_rate']);
                $item['total'] = $item['subtotal'] + $item['vat'];
                break;
            }
        }
        $response = ['status' => 'success', 'cart' => $_SESSION['cart']];
    }

    if ($action === 'remove_item') {
        $productId = $_POST['product_id'];
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($item) use ($productId) {
            return $item['product_id'] !== $productId;
        });
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
        $response = ['status' => 'success', 'cart' => $_SESSION['cart']];
    }

    if ($action === 'get_cart') {
        $response = ['status' => 'success', 'cart' => $_SESSION['cart']];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
