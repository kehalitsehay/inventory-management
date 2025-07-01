<?php
include'../includes/connection.php';
          $transac_id = $_POST['transac_id'];
          $balance = $_POST['amount'];
          $bank = $_POST['bank'];
          $desc = $_POST['desc'];
          
          switch($_GET['action']){
            case 'add': 
              $query = "UPDATE chart_of_account set current_balance = current_balance - $balance where account_name = 'Cash on Hand'";
              mysqli_query($conn, $query) or die(mysqli_error($conn));

              if($bank === "amhara"){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Amhara'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Amhara', ?, '0', 'Cash deposit to bank')");
                $stmtTran->bind_param("d", $balance);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash on Hand', '0', ?, 'Cash deposit to bank')");
                $stmtTran->bind_param("d", $balance);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
                function recordSaleTransaction($conn, $sale_id, $amount, $description) {
                  $stmt = $conn->prepare("INSERT INTO amhara_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES ('inflow', NOW(), ?, 'cash', ?, ?)");
                  $stmt->bind_param("idis", $sale_id, $amount, $sale_id, $description);
                  
                  if (!$stmt->execute()) {
                    echo "Error: " . $stmt->error;
                  } 
                  $stmt->close();
                }
                $sale_id = $transac_id; 
                $amount = $balance;
                $description = $desc;
                recordSaleTransaction($conn, $sale_id, $amount, $description);
              }else if($bank === "cbe"){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-CBE'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-CBE', ?, '0', 'Cash deposit to bank')");
                $stmtTran->bind_param("d", $balance);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash on Hand', '0', ?, 'Cash deposit to bank')");
                $stmtTran->bind_param("d", $balance);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
                
                function recordSaleTransaction($conn, $sale_id, $amount, $description, $debit, $credit, $net_balance) {
                  $stmt = $conn->prepare("INSERT INTO cbe_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description, debit, credit, net_balance) VALUES (?, 'inflow', NOW(), ?, 'cash', ?, ?, ?, ?, ?)");
                  $stmt->bind_param("idisddd",$sale_id, $amount, $sale_id, $description, $debit, $credit, $net_balance);
                  
                  if (!$stmt->execute()) {
                    echo "Error: " . $stmt->error;
                  } 
                  $stmt->close();
                }
                $sale_id = $transac_id; 
                $amount = $balance;
                $description = $desc;
                $debit = 0;
                $credit = $balance;
                $net_balance = $credit + $debit;
                recordSaleTransaction($conn, $sale_id, $amount, $description, $debit, $credit, $net_balance);
              } else if($bank === "awash"){

                $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Awash'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
                
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Awash', ?, '0', 'Cash deposit to bank')");
                $stmtTran->bind_param("d", $balance);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash on Hand', '0', ?, 'Cash deposit to bank')");
                $stmtTran->bind_param("d", $balance);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
                function recordSaleTransaction($conn, $sale_id, $amount, $description) {
                  $stmt = $conn->prepare("INSERT INTO awash_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?, 'inflow', NOW(), ?, 'cash', ?, ?)");
                  $stmt->bind_param("idis", $sale_id, $amount, $sale_id, $description);
                  
                  if (!$stmt->execute()) {
                    echo "Error: " . $stmt->error;
                  } 
                  $stmt->close();
                }
                $sale_id = $transac_id; 
                $amount = $balance;
                $description = $desc;
                recordSaleTransaction($conn, $sale_id, $amount, $description);
              } else if($bank === "ahadu"){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Ahadu'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
                
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Ahadu', ?, '0', 'Cash deposit to bank')");
                $stmtTran->bind_param("d", $balance);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash on Hand', '0', ?, 'Cash deposit to bank')");
                $stmtTran->bind_param("d", $balance);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
                function recordSaleTransaction($conn, $sale_id, $amount, $description) {
                  $stmt = $conn->prepare("INSERT INTO ahadu_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?, 
                  'inflow', NOW(), ?, 'cash', ?, ?)");
                  $stmt->bind_param("idis", $sale_id, $amount, $sale_id, $description);
                  
                  if (!$stmt->execute()) {
                    echo "Error: " . $stmt->error;
                  } 
                  $stmt->close();
                }
                $sale_id = $transac_id; 
                $amount = $balance;
                $description = $desc;
                recordSaleTransaction($conn, $sale_id, $amount, $description);
          
            }else if($bank === "abyssinia"){
              $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Abyssinia'";
              mysqli_query($conn, $query) or die(mysqli_error($conn));
              
              $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Abyssinia', ?, '0', 'Cash deposit to bank')");
              $stmtTran->bind_param("d", $balance);
              
              if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
              } 
              $stmtTran->close();

              $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash on Hand', '0', ?, 'Cash deposit to bank')");
              $stmtTran->bind_param("d", $balance);
              
              if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
              } 
              $stmtTran->close();
              function recordSaleTransaction($conn, $sale_id, $amount, $description) {
                $stmt = $conn->prepare("INSERT INTO abyssinia_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?, 
                'inflow', NOW(), ?, 'cash', ?, ?)");
                $stmt->bind_param("idis", $sale_id, $amount, $sale_id, $description);
                
                if (!$stmt->execute()) {
                  echo "Error: " . $stmt->error;
                } 
                $stmt->close();
              }
              $sale_id = $transac_id; 
              $amount = $balance;
              $description = $desc;
              recordSaleTransaction($conn, $sale_id, $amount, $description);

            }else if($bank === "abay"){
              $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Saving Account-Abay'";
              mysqli_query($conn, $query) or die(mysqli_error($conn));
              
              $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Abay', ?, '0', 'Cash deposit to bank')");
              $stmtTran->bind_param("d", $balance);
              
              if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
              } 
              $stmtTran->close();

              $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash on Hand', '0', ?, 'Cash deposit to bank')");
              $stmtTran->bind_param("d", $balance);
              
              if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
              } 
              $stmtTran->close();
              function recordSaleTransaction($conn, $sale_id, $amount, $description) {
                $stmt = $conn->prepare("INSERT INTO abay_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?, 
                'inflow', NOW(), ?, 'cash', ?, ?)");
                $stmt->bind_param("idis", $sale_id, $amount, $sale_id, $description);
                
                if (!$stmt->execute()) {
                  echo "Error: " . $stmt->error;
                } 
                $stmt->close();
              }
              $sale_id = $transac_id; 
              $amount = $balance;
              $description = $desc;
              recordSaleTransaction($conn, $sale_id, $amount, $description);

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
              window.location = "bank_deposit_sales.php";
          </script>