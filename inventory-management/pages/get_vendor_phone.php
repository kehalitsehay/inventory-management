<?php
include '../includes/connection.php';
// fetch_product.php
if (isset($_POST['company_name'])) {
    $company_name = $_POST['company_name'];
    
    // Query to fetch product name
    $sql = "SELECT PHONE_NUMBER FROM supplier WHERE COMPANY_NAME = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $company_name);
    $stmt->execute();
    $stmt->bind_result($vendor_phone);
    $stmt->fetch();

    // Return the product name as a response
    echo $vendor_phone ? $vendor_phone : "Product not found";

    $stmt->close();
    $conn->close();
}
?>
