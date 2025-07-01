<?php
include '../includes/connection.php';
// fetch_product.php
if (isset($_POST['credit_id'])) {
    $credit_id = $_POST['credit_id'];
    
    // Query to fetch product name
    $sql = "SELECT customer_id FROM credit_customer WHERE credit_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $credit_id);
    $stmt->execute();
    $stmt->bind_result($customer_id);
    $stmt->fetch();

    // Return the product name as a response
    echo $customer_id ? $customer_id : "Credit Balance not found";

    $stmt->close();
    $conn->close();
}
?>
