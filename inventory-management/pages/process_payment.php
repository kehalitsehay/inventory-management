<?php
include'../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $creditId = $_POST['credit_id'];
    $customer_id = $_POST['customer_id'];
    $transac_id= $customer_id;
    $paymentAmount = $_POST['payment_amount'];
    $balance = $paymentAmount;
    $paidDate = date('Y-m-d');
    $discount = $_POST['discount'];
    $interest = $_POST['interest'];
    $final_amount = $_POST['final_amount'];
    $bank = $_POST['bank'];
    $desc = $_POST['desc'];

    $credit_balance = $final_amount + $discount - $interest;

    $newBalance = $final_amount - $paymentAmount;

    if($credit_balance > $paymentAmount){
      $query = "UPDATE credit_customer set paied_date = NOW(), credit_balance = $newBalance WHERE credit_id = $creditId";
      mysqli_query($conn, $query) or die(mysqli_error($conn));
    }else {
      $query = "UPDATE credit_customer set paied_date = NOW(), credit_balance = 0 WHERE credit_id = $creditId";
      mysqli_query($conn, $query) or die(mysqli_error($conn));
    }
    

    if($bank === "amhara"){

      $query = "UPDATE chart_of_account set current_balance = current_balance - $balance where account_name = 'Account Receivable'";
      mysqli_query($conn, $query) or die(mysqli_error($conn));

      $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Amhara' ";
      mysqli_query($conn, $query) or die(mysqli_error($conn));

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Amhara', ?, '0', ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Receivable', '0', ?, ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();

        $stmt = $conn->prepare("INSERT INTO amhara_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?,'inflow', NOW(), ?, 'cash', ?, ?)");
        $stmt->bind_param("idis", $transac_id, $balance, $transac_id, $description);

        if (!$stmt->execute()) {
          echo "Error: " . $stmt->error;
        } 
        $stmt->close();
      
    }else if($bank === "cbe"){
      $query = "UPDATE chart_of_account set current_balance = current_balance - $balance where account_name = 'Account Receivable'";
      mysqli_query($conn, $query) or die(mysqli_error($conn));

      $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-CBE' ";
      mysqli_query($conn, $query) or die(mysqli_error($conn));

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-CBE', ?, '0', ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Receivable', '0', ?, ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();

      $stmt = $conn->prepare("INSERT INTO cbe_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?,'inflow', NOW(), ?, 'cash', ?, ?)");
        $stmt->bind_param("idis", $transac_id, $balance, $transac_id, $description);

        if (!$stmt->execute()) {
          echo "Error: " . $stmt->error;
        } 
        $stmt->close();

    } else if($bank === "awash"){
      $query = "UPDATE chart_of_account set current_balance = current_balance - $balance where account_name = 'Account Receivable'";
      mysqli_query($conn, $query) or die(mysqli_error($conn));

      $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Awash' ";
      mysqli_query($conn, $query) or die(mysqli_error($conn));
      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Awash', ?, '0', ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Receivable', '0', ?, ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();

      $stmt = $conn->prepare("INSERT INTO awash_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?,'inflow', NOW(), ?, 'cash', ?, ?)");
        $stmt->bind_param("idis", $transac_id, $balance, $transac_id, $description);

        if (!$stmt->execute()) {
          echo "Error: " . $stmt->error;
        } 
        $stmt->close();
      
    } else if($bank === "ahadu"){
      $query = "UPDATE chart_of_account set current_balance = current_balance - $balance where account_name = 'Account Receivable'";
      mysqli_query($conn, $query) or die(mysqli_error($conn));

      $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Ahadu' ";
      mysqli_query($conn, $query) or die(mysqli_error($conn));

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Ahadu', ?, '0', ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Receivable', '0', ?, ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();
      $stmt = $conn->prepare("INSERT INTO ahadu_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?,'inflow', NOW(), ?, 'cash', ?, ?)");
        $stmt->bind_param("idis", $transac_id, $balance, $transac_id, $description);

        if (!$stmt->execute()) {
          echo "Error: " . $stmt->error;
        } 
        $stmt->close();
    } else if($bank === "abyssinia"){
      $query = "UPDATE chart_of_account set current_balance = current_balance - $balance where account_name = 'Account Receivable'";
      mysqli_query($conn, $query) or die(mysqli_error($conn));

      $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Abyssinia' ";
      mysqli_query($conn, $query) or die(mysqli_error($conn));

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Abyssinia', ?, '0', ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Receivable', '0', ?, ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();
      $stmt = $conn->prepare("INSERT INTO abyssinia_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?,'inflow', NOW(), ?, 'cash', ?, ?)");
        $stmt->bind_param("idis", $transac_id, $balance, $transac_id, $description);

        if (!$stmt->execute()) {
          echo "Error: " . $stmt->error;
        } 
        $stmt->close();
    } else if($bank === "abay"){
      $query = "UPDATE chart_of_account set current_balance = current_balance - $balance where account_name = 'Account Receivable'";
      mysqli_query($conn, $query) or die(mysqli_error($conn));

      $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Abay' ";
      mysqli_query($conn, $query) or die(mysqli_error($conn));

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Abay', ?, '0', ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Receivable', '0', ?, ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();
      $stmt = $conn->prepare("INSERT INTO abay_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?,'inflow', NOW(), ?, 'cash', ?, ?)");
        $stmt->bind_param("idis", $transac_id, $balance, $transac_id, $description);

        if (!$stmt->execute()) {
          echo "Error: " . $stmt->error;
        } 
        $stmt->close();
    }else if($bank === "cash"){
      $query = "UPDATE chart_of_account set current_balance = current_balance - $balance where account_name = 'Account Receivable'";
      mysqli_query($conn, $query) or die(mysqli_error($conn));

      $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Cash on Hand' ";
      mysqli_query($conn, $query) or die(mysqli_error($conn));

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash on Hand', ?, '0', ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Receivable', '0', ?, ?)");
      $stmtTran->bind_param("ds", $balance, $desc);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();
      $stmt = $conn->prepare("INSERT INTO ahadu_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?,'inflow', NOW(), ?, 'cash', ?, ?)");
        $stmt->bind_param("idis", $transac_id, $balance, $transac_id, $description);

        if (!$stmt->execute()) {
          echo "Error: " . $stmt->error;
        } 
        $stmt->close();
      
    }
}
?>
    <script>
      alert("Cash Deposited completed successfully.");
      window.location = 'customer_pay.php';
    </script>
  