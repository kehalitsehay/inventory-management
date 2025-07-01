<?php
session_start();
include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $today = date("mdGis");
    $invoice_number = $today;
    $transac_id = isset($_POST['transac_id']) ? $_POST['transac_id'] : null;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : null;
    $employee_name = isset($_POST['employee']) ? $_POST['employee'] : null;
    $bank = isset($_POST['bank']) ? $_POST['bank'] : null;
    $desc = isset($_POST['desc']) ? $_POST['desc'] : null;
    $vendor = isset($_POST['vendor']) ? $_POST['vendor'] : null;
    

    // Current date of transaction
      $date_of_transaction = date('Y-m-d H:i:s');
  // $cashier_name = "Kehali";

  if (!$amount || !$bank) {
      echo "The amount and bank fields are required!";
      exit;
  }
          $stockInStmt = $conn->prepare("INSERT INTO vendor_request (date, transaction_id, amount, bank, description, employee, status, company_name) VALUES (NOW(), ?, ?, ?, ?, ?, 'Pending', ?)");
          $stockInStmt->bind_param("sdssss", $transac_id , $amount, $bank, $desc, $employee_name, $vendor);
          $stockInStmt->execute();
        // Commit transaction
  
  }else {
    echo "Invalid request!";
}
?>
<script>
  window.location = "supplier_pay.php";
</script>