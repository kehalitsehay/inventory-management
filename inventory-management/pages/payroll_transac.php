<?php
session_start();
include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if cart is empty
  if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
      echo "Your Payslip is empty. Please add employee Salary before proceeding to Payment.";
      exit;
  }

  // Retrieve invoice and customer details
  $today = date("mdGis");
  $invoice_number = $today;
  $bank = isset($_POST['bank']) ? $_POST['bank'] : null;

    // Current date of transaction
      $date_of_transaction = date('Y-m-d H:i:s');
  // $cashier_name = "Kehali";

  $cart_items = $_SESSION['cart'];
  $grand_total = 0; // To calculate grand total price

  // Begin database transaction
  $conn->begin_transaction();

        function calculatePayroll($product_id, $quantity) {
          global $conn;
          global $product_name, $transport, $quantity, $incentives, $others, $pension_7, $pension_11, $tax, $deduct, $subtotal, $netPay, $bank;
          $stockInStmt = $conn->prepare("INSERT INTO salary (date, employee_id, employee_name, salary, transport, incentive, others, gross, tax, pension_11, pension_7, deduction, net_pay, bank) VALUES (NOW(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      
          $stockInStmt->bind_param("isdddddddddds", $product_id,  $product_name, $quantity, $transport, $incentives, $others, $subtotal, $tax, $pension_11, $pension_7, $deduct, $netPay, $bank);
          $stockInStmt->execute();

      }

      // Process each cart item
      $t_gross = 0;
      $t_deduct = 0;
      $t_net = 0;
      $salary_tax_expense = 0;
      $pension_7_payable = 0;
      $tax_payable = 0;

        foreach ($cart_items as $item) {
          $t_gross += $item['subtotal'];
          $t_deduct += $item['totalDeduct'];
          $t_net += $item['netPay'];
          $salary_tax_expense += $item['pension_11'];
          $pension_7_payable += $item['pension_7'];;
          $tax_payable += $item['taxPayable'];

            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $product_name = $item['product_name'];
            $transport = $item['transport'];
            $incentives = $item['incentives'];
            $others = $item['others'];
            $subtotal = $item['subtotal'];
            $tax = $item['tax'];
            $pension_7 = $item['pension_7'];
            $pension_11 = $item['pension_11'];
            $deduct = $item['totalDeduct'];
            $netPay = $item['netPay'];
            $taxPayable = $item['taxPayable'];
           
          // this the place of function that omitted from prvious
          calculatePayroll($product_id, $quantity);
        }
        $t_total = (float) $t_gross + (float) $salary_tax_expense;
        // Salary Registration
        $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Salary Gross Expense', ?, '0', 'Salary Calculation')");
        $stmtTran->bind_param("d", $t_gross,);
        
        if (!$stmtTran->execute()) {
          echo "Error: " . $stmtTran->error;
        } 
        $stmtTran->close();

        $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Salary Tax Expense', ?, '0', 'Salary Calculation')");
        $stmtTran->bind_param("d", $salary_tax_expense,);
        
        if (!$stmtTran->execute()) {
          echo "Error: " . $stmtTran->error;
        } 
        $stmtTran->close();

        $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Salary Tax Payable', '0', ?, 'Salary Calculation')");
        $stmtTran->bind_param("d", $tax_payable);
        
        if (!$stmtTran->execute()) {
          echo "Error: " . $stmtTran->error;
        } 
        $stmtTran->close();

        $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Pension Payable(7%)', '0', ?, 'Salary Calculation')");
        $stmtTran->bind_param("d", $pension_7_payable);
        
        if (!$stmtTran->execute()) {
          echo "Error: " . $stmtTran->error;
        } 
        $stmtTran->close();
        $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Pension Payable(11%)', '0', ?, 'Salary Calculation')");
        $stmtTran->bind_param("d", $salary_tax_expense);
        
        if (!$stmtTran->execute()) {
          echo "Error: " . $stmtTran->error;
        } 
        $stmtTran->close();
        $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Salary Net Payable', '0', ?, 'Salary Calculation')");
        $stmtTran->bind_param("d", $t_net);
        
        if (!$stmtTran->execute()) {
          echo "Error: " . $stmtTran->error;
        } 
        $stmtTran->close();

        // Final payment
        $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Salary Tax Payable', ?, '0', 'Salary Payment')");
        $stmtTran->bind_param("d", $tax_payable,);
        
        if (!$stmtTran->execute()) {
          echo "Error: " . $stmtTran->error;
        } 
        $stmtTran->close();

        $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Pension Payable(7%)', ?, '0', 'Salary Payment')");
        $stmtTran->bind_param("d", $pension_7_payable,);
        
        if (!$stmtTran->execute()) {
          echo "Error: " . $stmtTran->error;
        } 
        $stmtTran->close();

        $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Pension Payable(11%)', ?, '0', 'Salary Payment')");
        $stmtTran->bind_param("d", $salary_tax_expense,);
        
        if (!$stmtTran->execute()) {
          echo "Error: " . $stmtTran->error;
        } 
        $stmtTran->close();

        $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Salary Net Payable', ?, '0', 'Salary Payment')");
        $stmtTran->bind_param("d", $t_net,);
        
        if (!$stmtTran->execute()) {
          echo "Error: " . $stmtTran->error;
        } 
        $stmtTran->close();
        // Updating Chart of account
        $query = "UPDATE chart_of_account set current_balance = current_balance + $t_gross where account_name = 'Salary Gross Expense' ";
        mysqli_query($conn, $query) or die(mysqli_error($conn));

        $query = "UPDATE chart_of_account set current_balance = current_balance + $salary_tax_expense where account_name = 'Salary Tax Expense' ";
        mysqli_query($conn, $query) or die(mysqli_error($conn)); 

        $query = "UPDATE chart_of_account set current_balance = current_balance + $tax_payable where account_name = 'Salary Tax Payable' ";
        mysqli_query($conn, $query) or die(mysqli_error($conn)); 

        $query = "UPDATE chart_of_account set current_balance = current_balance + $pension_7_payable where account_name = 'Pension Payable(7%)' ";
        mysqli_query($conn, $query) or die(mysqli_error($conn));

        $query = "UPDATE chart_of_account set current_balance = current_balance + $salary_tax_expense where account_name = 'Pension Payable(11%)' ";
        mysqli_query($conn, $query) or die(mysqli_error($conn)); 

        $query = "UPDATE chart_of_account set current_balance = current_balance + $t_net where account_name = 'Salary Net Payable' ";
        mysqli_query($conn, $query) or die(mysqli_error($conn)); 

        if($bank === "amhara"){

          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Amhara', '0', ?, 'Salary Payment')");
          $stmtTran->bind_param("d", $t_total);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();

          $query = "UPDATE chart_of_account set current_balance = current_balance - ($t_gross + $salary_tax_expense) where account_name = 'Saving Account-Amhara' ";
          mysqli_query($conn, $query) or die(mysqli_error($conn));

    }else if ($bank === "cbe"){

          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-CBE', '0', ?, 'Salary Payment')");
          $stmtTran->bind_param("d", $t_total);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();

          $query = "UPDATE chart_of_account set current_balance = current_balance - ($t_gross + $salary_tax_expense) where account_name = 'Saving Account-CBE' ";
          mysqli_query($conn, $query) or die(mysqli_error($conn));

    }else if ($bank === "ahadu"){

          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Ahadu', '0', ?, 'Salary Payment')");
          $stmtTran->bind_param("d", $t_total);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();

          $query = "UPDATE chart_of_account set current_balance = current_balance - ($t_gross + $salary_tax_expense) where account_name = 'Saving Account-Ahadu' ";
          mysqli_query($conn, $query) or die(mysqli_error($conn));
    }else if ($bank === "abyssinia"){

          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Abyssinia', '0', ?, 'Salary Payment')");
          $stmtTran->bind_param("d", $t_total);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();

          $query = "UPDATE chart_of_account set current_balance = current_balance - ($t_gross + $salary_tax_expense) where account_name = 'Saving Account-Abyssinia' ";
          mysqli_query($conn, $query) or die(mysqli_error($conn));
    }else if ($bank === "abay"){

        $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Abay', '0', ?, 'Salary Payment')");
        $stmtTran->bind_param("d", $t_total);
        
        if (!$stmtTran->execute()) {
          echo "Error: " . $stmtTran->error;
        } 
        $stmtTran->close();

        $query = "UPDATE chart_of_account set current_balance = current_balance - ($t_gross + $salary_tax_expense) where account_name = 'Saving Account-Abay' ";
        mysqli_query($conn, $query) or die(mysqli_error($conn));
    }else if ($bank === "awash"){

      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Awash', '0', ?, 'Salary Payment')");
      $stmtTran->bind_param("d", $t_total);
      
      if (!$stmtTran->execute()) {
        echo "Error: " . $stmtTran->error;
      } 
      $stmtTran->close();

      $query = "UPDATE chart_of_account set current_balance = current_balance - ($t_gross + $salary_tax_expense) where account_name = 'Saving Account-Awash' ";
      mysqli_query($conn, $query) or die(mysqli_error($conn));
    }
        // Commit transaction
        $conn->commit();
        
        unset($_SESSION['cart']); // Clear cart

      
  }else {
    echo "Invalid request!";
}
?>
<script>
  window.location = "payroll_final.php";
</script>