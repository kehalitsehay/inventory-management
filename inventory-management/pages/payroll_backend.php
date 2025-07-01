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
        $attendance = (int) $_POST['attendance'];
        $productId = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $quantity = (float) $_POST['product_unit']/30 * $attendance;
        $transport = (float) $_POST['transport'];
        $incentives = (float) $_POST['incentives'];
        $others = (float) $_POST['others'];
        $pension_7 = $quantity * 0.07;
        $pension_11 = $quantity * 0.11;
        
        $tax = 0;
        $deduct = 0;
        if($quantity <= 1650){
          $tax = $quantity * 0.1;
          $deduct = 60;
        }else if($quantity <= 3200){
          $tax = $salary * 0.15;
          $deduct = 142.5;
        }else if($quantity <= 5250){
          $tax = $quantity * 0.2;
          $deduct = 302.5;
        }else if($quantity <= 7800){
          $tax = $quantity * 0.25;
          $deduct = 565;
        }else if($quantity <= 10900){
          $tax = $quantity * 0.3;
          $deduct = 955;
        }else if($quantity > 10900){
          $tax = $quantity * 0.35;
          $deduct = 1500;
        }

        $subtotal = $quantity + $transport + $incentives + $others;
        $taxPayable = $tax - $deduct;
        $totalDeduct = $pension_7 + $taxPayable;
        $netPay = $subtotal - $totalDeduct;

        $found = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] === $productId) {
                $item['quantity'] = $quantity;
                $item['subtotal'] = $item['quantity']  + $item['transport'] + $item['others'] + $item['incentives'] ;
                $item['taxPayable'] = $item['tax'] - $item['deduct'];
                $item['totalDeduct'] = $item['pension_7'] + $item['taxPayable'];
                $item['netPay'] = $item['subtotal'] - $item['totalDeduct'];
                $found = true;
                break;
            }
        }
        if (!$found) {
            $_SESSION['cart'][] = [
                'product_id' => $productId,
                'attendance' => $attendance,
                'product_name' => $product_name,
                'quantity' => $quantity,
                'transport' => $transport,
                'incentives' => $incentives,
                'others' => $others,
                'tax' => $tax,
                'deduct' => $deduct,
                'pension_7' => $pension_7,
                'pension_11' => $pension_11,
                'taxPayable' => $taxPayable,
                'subtotal' => $subtotal,
                'totalDeduct' => $totalDeduct,
                'netPay' => $netPay,
            ];
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
