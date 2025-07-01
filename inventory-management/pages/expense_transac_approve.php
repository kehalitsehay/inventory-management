<?php
include'../includes/connection.php';
     
      if(isset($_GET['exapp'])){
        $id = $_GET['exapp'];
        $query = "SELECT * from expense where expense_id = $id";
        $query_result = mysqli_query($db, $query);
        $row = mysqli_fetch_array($query_result);
        $emp = $row['requested_by'];
        $cata = $row['category'];
        $amount = $row['amount'];
        $desc = $row['description'];
        $expense_id = $row['expense_id'];
        $bank = $row['bank'];
        $account_name = $cata;

        $query = "SELECT * from expense where expense_id = $id";
            $query_result = mysqli_query($db, $query);
            $row = mysqli_fetch_array($query_result);
            if($row['status']=='Pending'){
              $query = "update `expense` set status = 'Approved' where expense_id = $id";
              $query_result = mysqli_query($db, $query);
              if($query_result){
                ?>
              <script>
                alert("Expense Request Approval Updated successfully!")
              </script>
              <?php
              // header("Location: accountant.php");
              }else{
                die(mysqli_error($db));
              }
            }else {
              ?>
              <script>
                alert("Expense Request Status Should be Pending!");
              </script>
              <?php
            }

        if($bank == "amhara"){

          $query = "UPDATE chart_of_account set current_balance = current_balance + $amount where account_name = $cata ";
          mysqli_query($conn, $query) or die(mysqli_error($conn));

          $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Saving Account-Amhara' ";
          mysqli_query($conn, $query) or die(mysqli_error($conn)); 
          
          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), ?, ?, '0', ?)");
          $stmtTran->bind_param("sds", $cata,$amount, $desc);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();

          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Amhara', '0', ?, ?)");
          $stmtTran->bind_param("ds", $amount, $desc);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();

          function recordExpenseTransaction($conn, $expense_id, $amount, $emp, $cata, $desc) {
          
            $stmt = $conn->prepare("INSERT INTO amhara_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?, 'outflow', NOW(), ?, ?, ?, ?)");
            $stmt->bind_param("idsss", $expense_id, $amount, $cata, $emp, $desc);
            
            if (!$stmt->execute()) {
              echo "Error: " . $stmt->error;
            } 
            $stmt->close();
          }
          $emp = $expense_id;
          recordExpenseTransaction($conn, $expense_id, $amount, $emp, $cata, $desc);
        } else if ($bank == "ahadu"){

          $query = "UPDATE chart_of_account set current_balance = current_balance + $amount where account_name = '$cata'";
          mysqli_query($conn, $query) or die(mysqli_error($conn));

          $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Saving Account-Ahadu' ";
          mysqli_query($conn, $query) or die(mysqli_error($conn)); 

          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), ?, ?, '0', ?)");
          $stmtTran->bind_param("sds", $cata,$amount, $desc);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();

          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Checking Account-Ahadu', '0', ?, ?)");
          $stmtTran->bind_param("ds", $amount, $desc);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();
          function recordExpenseTransaction($conn, $expense_id, $amount, $emp, $cata, $desc) {
          
            $stmt = $conn->prepare("INSERT INTO ahadu_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?, 'outflow', NOW(), ?, ?, ?, ?)");
            $stmt->bind_param("idsss", $expense_id, $amount, $cata, $emp, $desc);
            
            if (!$stmt->execute()) {
              echo "Error: " . $stmt->error;
            } 
            $stmt->close();
          }
          $emp = $expense_id;
          recordExpenseTransaction($conn, $expense_id, $amount, $emp, $cata, $desc);
        } else if($bank == "cbe"){

          $query = "UPDATE chart_of_account set current_balance = current_balance + $amount where account_name = '$account_name'";
          mysqli_query($conn, $query) or die(mysqli_error($conn));

          $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Saving Account-CBE' ";
          mysqli_query($conn, $query) or die(mysqli_error($conn)); 

          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), ?, ?, '0', ?)");
          $stmtTran->bind_param("sds", $cata,$amount, $desc);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();

          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Checking Account-CBE', '0', ?, ?)");
          $stmtTran->bind_param("ds", $amount, $desc);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();
          function recordExpenseTransaction($conn, $expense_id, $amount, $emp, $cata, $desc) {
          
            $stmt = $conn->prepare("INSERT INTO cbe_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?, 'outflow', NOW(), ?, ?, ?, ?)");
            $stmt->bind_param("idsss", $expense_id, $amount, $cata, $emp, $desc);
            
            if (!$stmt->execute()) {
              echo "Error: " . $stmt->error;
            } 
            $stmt->close();
          }
          $emp = $expense_id;
          recordExpenseTransaction($conn, $expense_id, $amount, $emp, $cata, $desc);
        } else if($bank == "awash"){

          $query = "UPDATE chart_of_account set current_balance = current_balance + $amount where account_name = $cata ";
          mysqli_query($conn, $query) or die(mysqli_error($conn));

          $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Saving Account-Awash' ";
          mysqli_query($conn, $query) or die(mysqli_error($conn)); 
          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), ?, ?, '0', ?)");
          $stmtTran->bind_param("sds", $cata,$amount, $desc);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();

          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Checking Account-Awash', '0', ?, ?)");
          $stmtTran->bind_param("ds", $amount, $desc);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();
          function recordExpenseTransaction($conn, $expense_id, $amount, $emp, $cata, $desc) {
          
            $stmt = $conn->prepare("INSERT INTO cbe_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?, 'outflow', NOW(), ?, ?, ?, ?)");
            $stmt->bind_param("idsss", $expense_id, $amount, $cata, $emp, $desc);
            
            if (!$stmt->execute()) {
              echo "Error: " . $stmt->error;
            } 
            $stmt->close();
          }
          $emp = $expense_id;
          recordExpenseTransaction($conn, $expense_id, $amount, $emp, $cata, $desc);
        } else if($bank == "cash"){

          $query = "UPDATE chart_of_account set current_balance = current_balance + $amount where account_name = $cata ";
          mysqli_query($conn, $query) or die(mysqli_error($conn));

          $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Cash Business Starting' ";
          mysqli_query($conn, $query) or die(mysqli_error($conn)); 

          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Electricity', ?, '0', 'Paid Electricity for Utility')");
          $stmtTran->bind_param("sds", $cata,$amount, $desc);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();

          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash on Hand', '0', ?, ?)");
          $stmtTran->bind_param("d", $amount, $desc);
          
          if (!$stmtTran->execute()) {
            echo "Error: " . $stmtTran->error;
          } 
          $stmtTran->close();
        }
} 
?>
<script>
  window.location = "expense_request_approve.php";
</script>