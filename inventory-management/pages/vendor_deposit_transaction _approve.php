<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
            <?php
            
            if(isset($_GET['venapp'])){
              $id = $_GET['venapp'];

              $query = "select * from vendor_request where id = $id";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);

              $amount = $row['amount'];
              $transaction_id = $row['transaction_id'];
              $bank = $row['bank'];
              $desc = $row['description'];
              $vendor = $row['company_name'];

                    // registering the transaction on each bank account
                    if($bank === "amhara"){

                      $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Account Payable'";
                      mysqli_query($conn, $query) or die(mysqli_error($conn));

                      $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Saving Account-Amhara' ";
                      mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Payable', ?, '0', ?)");
                      $stmtTran->bind_param("ds", $amount, $desc);
                      
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
                
                    }else if ($bank === "cbe"){

                      $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Account Payable'";
                      mysqli_query($conn, $query) or die(mysqli_error($conn));

                      $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Saving Account-CBE' ";
                      mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Payable', ?, '0', ?)");
                      $stmtTran->bind_param("ds", $amount, $desc);
                      
                      if (!$stmtTran->execute()) {
                        echo "Error: " . $stmtTran->error;
                      } 
                      $stmtTran->close();

                      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-CBE', '0', ?, ?)");
                      $stmtTran->bind_param("ds", $amount, $desc);
                      
                      if (!$stmtTran->execute()) {
                        echo "Error: " . $stmtTran->error;
                      } 
                      $stmtTran->close();
      
                    }else if ($bank === "ahadu"){

                      $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Account Payable'";
                      mysqli_query($conn, $query) or die(mysqli_error($conn));

                      $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Saving Account-Ahadu' ";
                      mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Payable', ?, '0', ?)");
                      $stmtTran->bind_param("ds", $amount, $desc);
                      
                      if (!$stmtTran->execute()) {
                        echo "Error: " . $stmtTran->error;
                      } 
                      $stmtTran->close();

                      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Ahadu', '0', ?, ?)");
                      $stmtTran->bind_param("ds", $amount, $desc);
                      
                      if (!$stmtTran->execute()) {
                        echo "Error: " . $stmtTran->error;
                      } 
                      $stmtTran->close();
                    }else if ($bank === "awash"){

                      $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Account Payable'";
                      mysqli_query($conn, $query) or die(mysqli_error($conn));

                      $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Saving Account-Awash' ";
                      mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Payable', ?, '0', ?)");
                      $stmtTran->bind_param("ds", $amount, $desc);
                      
                      if (!$stmtTran->execute()) {
                        echo "Error: " . $stmtTran->error;
                      } 
                      $stmtTran->close();

                      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Awash', '0', ?, ?)");
                      $stmtTran->bind_param("ds", $amount, $desc);
                      
                      if (!$stmtTran->execute()) {
                        echo "Error: " . $stmtTran->error;
                      } 
                      $stmtTran->close();
                    }else if($bank == "cash"){

                      $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Account Payable'";
                      mysqli_query($conn, $query) or die(mysqli_error($conn));

                      $query = "UPDATE chart_of_account set current_balance = current_balance - $amount where account_name = 'Cash Business Starting' ";
                      mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Payable', ?, '0', ?)");
                      $stmtTran->bind_param("ds", $amount, $desc);
                      
                      if (!$stmtTran->execute()) {
                        echo "Error: " . $stmtTran->error;
                      } 
                      $stmtTran->close();

                      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash Business Starting', '0', ?, ?)");
                      $stmtTran->bind_param("ds", $amount, $desc);
                      
                      if (!$stmtTran->execute()) {
                        echo "Error: " . $stmtTran->error;
                      } 
                      $stmtTran->close();
                    }
                  
                    $query2 = "update `vendor_request` set status='Approved' where id = $id";
                    $result = mysqli_query($conn, $query2);

                    $query = "UPDATE supplier set CREDIT_BALANCE = CREDIT_BALANCE - $amount where SUPPLIER_ID = $vendor";
                    mysqli_query($conn, $query) or die(mysqli_error($conn));
            } 
            ?>
            <script type="text/javascript">
              window.location = "vendor_approve.php";
            </script>
            <?php
