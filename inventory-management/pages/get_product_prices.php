<?php
include '../includes/connection.php';
// Fetch the product code from the AJAX request
if (isset($_GET['product_id'])) {
  $product_code = $_GET['product_id'];

  // Fetch product details
  $sql = "SELECT sales_price1, sales_price2, sales_price3 FROM product WHERE PRODUCT_CODE = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $product_code);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      // Fetch the data
      $data = $result->fetch_assoc();
      echo json_encode($data); // Send as JSON
  } else {
      echo json_encode(["error" => "Product not found"]);
  }
  $stmt->close();
}

$conn->close();
?>