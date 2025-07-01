<?php
include '../includes/connection.php';
// fetch_product.php
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Query to fetch product name
    $sql = "SELECT QUANTITY FROM purcase_req WHERE PRODUCT_CODE = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($quantity);
    $stmt->fetch();

    // Return the product name as a response
    echo $quantity ? $quantity : "Product quantity not found";

    $stmt->close();
    $conn->close();
}
?>
