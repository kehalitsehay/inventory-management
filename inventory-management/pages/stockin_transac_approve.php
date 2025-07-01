<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
            <?php
            
            if(isset($_GET['purapp'])){
              $id = $_GET['purapp'];

              $query = "select * from stockin_request where id = $id";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);

              $amount = $row['total'];
              $purchase_id = $row['transac_id'];
              
              $product_id = $row['pro_code']; $prodname = $row['pro_name']; $cataname = $row['category']; $qty=$row['quantity']; $unit=$row['unit']; $price=$row['price']; $subtotal = $row['subtotal']; $vatt = $row['VAT_t']; $vat_t= $row['vat']; $pur_date = $row['stockin_date']; $ex_date=$row['expired_date']; $emp = $row['employee']; $sub = $row['company_name'];  $bank = $row['bank'];  $purchase_method = $row['purchase_method'];

              
                  if($purchase_method == 'Cash'){
                    // registering the transaction on each bank account
                    if($bank === "amhara"){

                          $query = "UPDATE chart_of_account set current_balance = current_balance + $amount where account_name = 'Inventory' ";
                          mysqli_query($conn, $query) or die(mysqli_error($conn));

                          $query = "UPDATE chart_of_account set current_balance = current_balance + $vat_t where account_name = 'Purchase Tax Payable' ";
                          mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                          $query = "UPDATE chart_of_account set current_balance = current_balance - $subtotal where account_name = 'Saving Account-Amhara' ";
                          mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Inventory', ?, '0', 'Purchased Inven. Using Amhara Bank')");
                          $stmtTran->bind_param("d", $amount,);
                          
                          if (!$stmtTran->execute()) {
                            echo "Error: " . $stmtTran->error;
                          } 
                          $stmtTran->close();

                          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Amhara', '0', ?, 'Purchased Inven. Using Amhara Bank')");
                          $stmtTran->bind_param("d", $subtotal);
                          
                          if (!$stmtTran->execute()) {
                            echo "Error: " . $stmtTran->error;
                          } 
                          $stmtTran->close();

                          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Purchase Tax Payable', '0', ?, 'Purchased Inven. Using Amhara Bank')");
                          $stmtTran->bind_param("d", $vat_t);
                          
                          if (!$stmtTran->execute()) {
                            echo "Error: " . $stmtTran->error;
                          } 
                          $stmtTran->close();
                          function recordPurchaseTransaction($conn, $purchase_id, $amount) {
          
                            $stmt = $conn->prepare("INSERT INTO amhara_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?, 'outflow', NOW(), ?, 'purchase', ?, 'Purchase transaction')");
                            $stmt->bind_param("idi", $purchase_id, $amount, $purchase_id);
                            
                            if ($stmt->execute()) {
                              ?>
                              <script>
                                  alert("Purchase transaction recorded successfully.");
                              </script>
                              <?php
                            } else {
                                echo "Error: " . $stmt->error;
                            }
                            $stmt->close();
                        }
                        recordPurchaseTransaction($conn, $purchase_id, $amount);
                    }else if ($bank === "cbe"){

                          $query = "UPDATE chart_of_account set current_balance = current_balance + $amount where account_name = 'Inventory' ";
                          mysqli_query($conn, $query) or die(mysqli_error($conn));

                          $query = "UPDATE chart_of_account set current_balance = current_balance + $vat_t where account_name = 'Purchase Tax Payable' ";
                          mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                          $query = "UPDATE chart_of_account set current_balance = current_balance - $subtotal where account_name = 'Saving Account-CBE' ";
                          mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Inventory', ?, '0', 'Purchased Inven. Using CBE Bank')");
                          $stmtTran->bind_param("d", $amount,);
                          
                          if (!$stmtTran->execute()) {
                            echo "Error: " . $stmtTran->error;
                          } 
                          $stmtTran->close();

                          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-CBE', '0', ?, 'Purchased Inven. Using CBE Bank')");
                          $stmtTran->bind_param("d", $subtotal);
                          
                          if (!$stmtTran->execute()) {
                            echo "Error: " . $stmtTran->error;
                          } 
                          $stmtTran->close();

                          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Purchase Tax Payable', '0', ?, 'Purchased Inven. Using CBE Bank')");
                          $stmtTran->bind_param("d", $vat_t);
                          
                          if (!$stmtTran->execute()) {
                            echo "Error: " . $stmtTran->error;
                          } 
                          $stmtTran->close();
                          function recordPurchaseTransaction($conn, $purchase_id, $amount) {
          
                            $stmt = $conn->prepare("INSERT INTO cbe_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?, 'outflow', NOW(), ?, 'purchase', ?, 'Purchase transaction')");
                            $stmt->bind_param("idi", $purchase_id, $amount, $purchase_id);
                            
                            if ($stmt->execute()) {
                              ?>
                              <script>
                                  alert("Purchase transaction recorded successfully.");
                              </script>
                              <?php
                            } else {
                                echo "Error: " . $stmt->error;
                            }
                            $stmt->close();
                        }
                        recordPurchaseTransaction($conn, $purchase_id, $amount);
      
                    }else if ($bank === "ahadu"){

                      $query = "UPDATE chart_of_account set current_balance = current_balance + $amount where account_name = 'Inventory' ";
                      mysqli_query($conn, $query) or die(mysqli_error($conn));

                      $query = "UPDATE chart_of_account set current_balance = current_balance + $vat_t where account_name = 'Purchase Tax Payable' ";
                      mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                      $query = "UPDATE chart_of_account set current_balance = current_balance - $subtotal where account_name = 'Saving Account-Ahadu' ";
                      mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Inventory', ?, '0', 'Purchased Inven. Using Ahadu Bank')");
                      $stmtTran->bind_param("d", $amount,);
                      
                      if (!$stmtTran->execute()) {
                        echo "Error: " . $stmtTran->error;
                      } 
                      $stmtTran->close();

                      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Ahadu', '0', ?, 'Purchased Inven. Using Ahadu Bank')");
                      $stmtTran->bind_param("d", $subtotal);
                      
                      if (!$stmtTran->execute()) {
                        echo "Error: " . $stmtTran->error;
                      } 
                      $stmtTran->close();

                      $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Purchase Tax Payable', '0', ?, 'Purchased Inven. Using Ahadu Bank')");
                      $stmtTran->bind_param("d", $vat_t);
                      
                      if (!$stmtTran->execute()) {
                        echo "Error: " . $stmtTran->error;
                      } 
                      $stmtTran->close();
                      function recordPurchaseTransaction($conn, $purchase_id, $amount) {
      
                        $stmt = $conn->prepare("INSERT INTO ahadu_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?, 'outflow', NOW(), ?, 'purchase', ?, 'Purchase transaction')");
                        $stmt->bind_param("idi", $purchase_id, $amount, $purchase_id);
                        
                        if ($stmt->execute()) {
                          ?>
                          <script>
                              alert("Purchase transaction recorded successfully.");
                          </script>
                          <?php
                        } else {
                            echo "Error: " . $stmt->error;
                        }
                        $stmt->close();
                    }
                    recordPurchaseTransaction($conn, $purchase_id, $amount);
                    }else if ($bank === "awash"){

                          $query = "UPDATE chart_of_account set current_balance = current_balance + $amount where account_name = 'Inventory' ";
                          mysqli_query($conn, $query) or die(mysqli_error($conn));

                          $query = "UPDATE chart_of_account set current_balance = current_balance + $vat_t where account_name = 'Purchase Tax Payable' ";
                          mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                          $query = "UPDATE chart_of_account set current_balance = current_balance - $subtotal where account_name = 'Saving Account-Awash' ";
                          mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Inventory', ?, '0', 'Purchased Inven. Using Awash Bank')");
                          $stmtTran->bind_param("d", $amount,);
                          
                          if (!$stmtTran->execute()) {
                            echo "Error: " . $stmtTran->error;
                          } 
                          $stmtTran->close();

                          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Awash', '0', ?, 'Purchased Inven. Using Awash Bank')");
                          $stmtTran->bind_param("d", $subtotal);
                          
                          if (!$stmtTran->execute()) {
                            echo "Error: " . $stmtTran->error;
                          } 
                          $stmtTran->close();

                          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Purchase Tax Payable', '0', ?, 'Purchased Inven. Using Awash Bank')");
                          $stmtTran->bind_param("d", $vat_t);
                          
                          if (!$stmtTran->execute()) {
                            echo "Error: " . $stmtTran->error;
                          } 
                          $stmtTran->close();
                          function recordPurchaseTransaction($conn, $purchase_id, $amount) {
          
                            $stmt = $conn->prepare("INSERT INTO awash_bank_account (transaction_id, transaction_type, transaction_date, amount, category, reference_id, description) VALUES (?, 'outflow', NOW(), ?, 'purchase', ?, 'Purchase transaction')");
                            $stmt->bind_param("idi", $purchase_id, $amount, $purchase_id);
                            
                            if ($stmt->execute()) {
                              ?>
                              <script>
                                  alert("Purchase transaction recorded successfully.");
                              </script>
                              <?php
                            } else {
                                echo "Error: " . $stmt->error;
                            }
                            $stmt->close();
                        }
                        recordPurchaseTransaction($conn, $purchase_id, $amount);
                    }
                  }else{

                          $query = "UPDATE chart_of_account set current_balance = current_balance + $amount where account_name = 'Inventory' ";
                          mysqli_query($conn, $query) or die(mysqli_error($conn));

                          $query = "UPDATE chart_of_account set current_balance = current_balance + $vat_t where account_name = 'Purchase Tax Payable' ";
                          mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                          $query = "UPDATE chart_of_account set current_balance = current_balance + $subtotal where account_name = 'Account Payable' ";
                          mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Inventory', ?, '0', 'Purchased Inven. by Credit')");
                          $stmtTran->bind_param("d", $amount,);
                          
                          if (!$stmtTran->execute()) {
                            echo "Error: " . $stmtTran->error;
                          } 
                          $stmtTran->close();

                          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Payable', '0', ?, 'Purchased Inven. by Credit')");
                          $stmtTran->bind_param("d", $subtotal);
                          
                          if (!$stmtTran->execute()) {
                            echo "Error: " . $stmtTran->error;
                          } 
                          $stmtTran->close();

                          $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Purchase Tax Payable', '0', ?, 'Purchased Inven. by Credit')");
                          $stmtTran->bind_param("d", $vat_t);
                          
                          if (!$stmtTran->execute()) {
                            echo "Error: " . $stmtTran->error;
                          } 
                          $stmtTran->close();
                    
                  }

                    $query = "INSERT INTO stockin
                    (id, transac_id, pro_code, pro_name, category, quantity, unit, price, subtotal, VAT_t, vat, total, status, stockin_date, expired_date, employee, company_name)
                    VALUES (NULL, '{$purchase_id}', '{$product_id}','{$prodname}','{$cataname}', '{$qty}', '{$unit}', '{$price}', '{$subtotal}', '{$vatt}', '{$vat_t}', '{$amount}', '{$purchase_method}', '{$pur_date}', '{$ex_date}', '{$emp}','{$sub}')";
                    mysqli_query($db,$query)or die (mysqli_error($db));

                    $query2 = "INSERT INTO purchse VALUES (NULL, '{$purchase_id }', '{$product_id}','{$prodname}','{$cataname}', '{$qty}', '{$unit}', '{$price}', '{$subtotal}', '{$vatt}', '{$vat_t}', '{$amount}', '{$purchase_method}', '{$pur_date}', '{$ex_date}', '{$emp}','{$sub}')";
                    mysqli_query($db,$query2)or die (mysqli_error($db));

                    $query3 = "update `stockin_request` set req_status='StockedIn' where pro_code = $product_id ";
                    mysqli_query($db, $query3) or die (mysqli_error($db));
                    $query4 = "update `purcase_req` set STATUS='Purchased' where PRODUCT_CODE = $product_id ";
                    mysqli_query($db, $query4) or die (mysqli_error($db));

            } 
            ?>
            <script type="text/javascript">
              window.location = "purchase_request_approve.php";
            </script>
            <?php
