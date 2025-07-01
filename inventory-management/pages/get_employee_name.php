<?php
include '../includes/connection.php';
// fetch_product.php
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Query to fetch product name
    $sql = "SELECT FULL_NAME FROM employee WHERE EMPLOYEE_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($product_name);
    $stmt->fetch();

    // Return the product name as a response
    echo $product_name ? $product_name : "Employee name not found";

    $stmt->close();
    $conn->close();
}
?>
