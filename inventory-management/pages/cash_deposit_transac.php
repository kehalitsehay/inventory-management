<?php
include'../includes/connection.php';
          $transac_id = $_POST['transac_id'];
          $balance = $_POST['amount'];
          $desc = $_POST['desc'];

          switch($_GET['action']){
            case 'add': 

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash Business Starting', ?, '0', ?)");
                $stmtTran->bind_param("ds", $balance, $desc);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Owners Capital', '0', ?, ?)");
                $stmtTran->bind_param("ds", $balance, $desc);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                
                $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Cash Business Starting'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
                $query = "UPDATE chart_of_account set current_balance = current_balance + $balance where account_name = 'Owners Capital'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));

                function recordCashTransaction($conn, $cash_id, $amount, $description) {
                  $stmt = $conn->prepare("INSERT INTO cash_account (date, transaction_id, amount,  description) VALUES (NOW(), ?, ?, ?)");
                  $stmt->bind_param("ids", $cash_id, $amount, $description);
                  
                  if (!$stmt->execute()) {
                    echo "Error: " . $stmt->error;
                  } 
                  $stmt->close();
                }
                $cash_id = $transac_id; 
                $amount = $balance;
                $description = $desc;
                recordCashTransaction($conn, $cash_id, $amount, $description);
            
            ?>
            <script>
              alert("Cash business starting registered successfully.");
            </script>
            <?php

          }
          ?>
          
          <script>
              window.location = "bank_deposit.php";
          </script>