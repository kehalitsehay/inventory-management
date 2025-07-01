<?php
include '../includes/connection.php';
          $transac_id = $_POST['transac_id'];
          $balance = $_POST['amount'];
          $bank = $_POST['bank'];
          $desc = $_POST['desc'];

          switch($_GET['action']){
            case 'add': 

              $query = "UPDATE chart_of_account set current_balance = current_balance - $balance where account_name = 'Cash Business Starting'";
              mysqli_query($conn, $query) or die(mysqli_error($conn));
              
              if($bank === "amhara"){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Amhara'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Amhara', ?, '0', ?)");
                $stmtTran->bind_param("ds", $balance, $desc);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash Business Starting', '0', ?, ?)");
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
                $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-CBE'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-CBE', ?, '0', ?)");
                $stmtTran->bind_param("ds", $balance, $desc);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash Business Starting', '0', ?, ?)");
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
                $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Awash'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Awash', ?, '0', ?)");
                $stmtTran->bind_param("ds", $balance, $desc);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash Business Starting', '0', ?, ?)");
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
                $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Ahadu'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Ahadu', ?, '0', ?)");
                $stmtTran->bind_param("ds", $balance, $desc);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash Business Starting', '0', ?, ?)");
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
          
            } else if($bank === "abay"){
              $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Abay'";
              mysqli_query($conn, $query) or die(mysqli_error($conn));

              $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Abay', ?, '0', ?)");
              $stmtTran->bind_param("ds", $balance, $desc);
              
              if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
              } 
              $stmtTran->close();

              $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash Business Starting', '0', ?, ?)");
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
            } else if($bank === "abyssinia"){
              $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Abyssinia'";
              mysqli_query($conn, $query) or die(mysqli_error($conn));

              $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Abyssinia', ?, '0', ?)");
              $stmtTran->bind_param("ds", $balance, $desc);
              
              if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
              } 
              $stmtTran->close();

              $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash Business Starting', '0', ?, ?)");
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

              break;
        
            }
            ?>
            <script>
              alert("Cash Deposited completed successfully.");
            </script>
            <?php

          }
          ?>
          
          <script>
              window.location = "bank_deposit.php";
          </script>

