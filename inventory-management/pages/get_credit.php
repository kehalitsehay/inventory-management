<?php
include '../includes/connection.php';
// fetch_product.php
if (isset($_POST['credit_id'])) {
    $credit_id = $_POST['credit_id'];
    
    // Query to fetch product name
    $sql = "SELECT credit_balance FROM credit_customer WHERE credit_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $credit_id);
    $stmt->execute();
    $stmt->bind_result($credit_balance);
    $stmt->fetch();

    // Return the product name as a response
    echo $credit_balance ? $credit_balance : "Credit Balance not found";

    $stmt->close();
    $conn->close();
}
?>
