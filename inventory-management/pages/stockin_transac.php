<?php
session_start();
include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if cart is empty
  if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
      echo "Your cart is empty. Please add items before proceeding to checkout.";
      exit;
  }

  // Retrieve invoice and customer details
  $today = date("mdGis");
  $invoice_number = $today;
  $company_name = isset($_POST['company_name']) ? $_POST['company_name'] : null;
  $employee_name = isset($_POST['employee']) ? $_POST['employee'] : null;
  $purchase_method = isset($_POST['status']) ? $_POST['status'] : null;
  $phone = isset($_POST['vendor_phone']) ? $_POST['vendor_phone'] : null;
  $bank = isset($_POST['bank']) ? $_POST['bank'] : null;

    // Current date of transaction
      $date_of_transaction = date('Y-m-d H:i:s');
  // $cashier_name = "Kehali";

  if (!$invoice_number || !$company_name) {
      echo "Invoice number and company name are required!";
      exit;
  }

  $cart_items = $_SESSION['cart'];
  $grand_total = 0; // To calculate grand total price

  // Begin database transaction
  $conn->begin_transaction();

        // // Insert invoice details
        // $stmt_invoice = $conn->prepare("INSERT INTO invoices (invoice_number, customer_name, employee_name, grand_total, sales_method, invoice_date) VALUES (?, ?, ?, ?,?, NOW())");
        // foreach ($cart_items as $item) {
        //     $grand_total += $item['total'];
        // }
        // $stmt_invoice->bind_param("sssds", $invoice_number, $customer_name, $employee_name, $grand_total, $sales_method);
        // $stmt_invoice->execute();
        // $invoice_id = $conn->insert_id; // Get the last inserted invoice ID

        function purchaseProduct($productId, $quantity, $purchasePrice) {
          global $conn;
          global $prodname, $cataname, $quantity, $unit, $purchasePrice, $subtotal, $vat, $total, $purchase_method, $employee_name, $company_name, $bank, $expired_date, $invoice_number, $vatt;
          $stockInStmt = $conn->prepare("INSERT INTO stockin_request (transac_id, pro_code, pro_name, category, quantity, unit, price, subtotal, VAT_t, vat, total, purchase_method, stockin_date, expired_date, employee, company_name, req_status, bank) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, 'Pending', ?)");
      
          $stockInStmt->bind_param("isssisdddddsssss", $invoice_number , $productId, $prodname, $cataname, $quantity, $unit, $purchasePrice, $subtotal, $vatt, $vat, $total, $purchase_method, $expired_date, $employee_name, $company_name, $bank);
          $stockInStmt->execute();

      }

      // Process each cart item
        foreach ($cart_items as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $purchasePrice = $item['price'];
            $vat = $item['vat'];
            $subtotal = $item['subtotal'];
            $total = $item['total'];
            $vatt = $item['vatt'];
            $expired_date = $item['expired_date'];
            $query = "SELECT * FROM product where PRODUCT_CODE = $product_id";
            $results = mysqli_query($db, $query);
            $rows = mysqli_fetch_array($results);
            $prodname = $rows['NAME'];
            $cataname = $rows['CNAME'];
            $unit = $rows['UNIT'];
            $invoice_number = $today;
          // this the place of function that omitted from prvious
          purchaseProduct($product_id, $quantity, $purchasePrice);
        }
        // Commit transaction
        $conn->commit();
        
        unset($_SESSION['cart']); // Clear cart

      
  }else {
    echo "Invalid request!";
}
?>
<script>
  window.location = "purchase.php";
</script>