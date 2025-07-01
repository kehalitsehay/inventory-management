<?php
include '../includes/connection.php';
          $cash_on_hand = $_POST['cash_on_hand'];
          $cbe_saving = $_POST['cbe_saving'];
          $amhara_saving = $_POST['amhara_saving'];
          $ahadu_saving = $_POST['ahadu_saving'];
          $awash_saving = $_POST['awash_saving'];
          $abyssinia_saving = $_POST['abyssinia_saving'];
          $abay_saving = $_POST['abay_saving'];
          $account_receive = $_POST['account_receive'];
          $inventory = $_POST['inventory'];
          $prepaid = $_POST['prepaid'];
          $property = $_POST['property'];
          $account_payable = $_POST['account_payable'];
          $purchase_payable = $_POST['purchase_payable'];
          $sales_payable = $_POST['sales_payable'];
          $long_term_debit = $_POST['long_term_debit'];
          $owner_capital = $_POST['owner_capital'];
          $retained_earning = $_POST['retained_earning'];
          $product_sales = $_POST['product_sales'];
          $other_income = $_POST['other_income'];
          $cogs = $_POST['cogs'];
          $salary = $_POST['salary'];
          $electricity = $_POST['electricity'];
          $internet = $_POST['internet'];
          $advert = $_POST['advert'];
          $miscellaneous = $_POST['miscellaneous'];
          $transaction_id  = date('mdGis');
          switch($_GET['action']){
            case 'add': 
                if($cash_on_hand){
                  $query = "UPDATE chart_of_account set current_balance = current_balance + $cash_on_hand where account_name = 'Cash on Hand'";
                  mysqli_query($conn, $query) or die(mysqli_error($conn));
               
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash on Hand', ?, '0', 'Beginning Balance')");
                $stmtTran->bind_param("d", $cash_on_hand);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash on Hand', '0', ?, 'Beginning Balance')");
                // $stmtTran->bind_param("d", $cash_on_hand);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();
              }
              if($cbe_saving){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $cbe_saving where account_name = 'Saving Account-CBE'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
             
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-CBE', ?, '0', 'Beginning Balance')");
                $stmtTran->bind_param("d", $cbe_saving);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
                // 	inserting to the bank table for beginning balance
                $stmtTran = $conn->prepare("INSERT INTO cbe_bank_account (transaction_id,	transaction_type,	transaction_date,	amount,	category,	reference_id,	description, debit,	credit,	net_balance) VALUES ($transaction_id, 'inflow', NOW(), ?, 'cash', $transaction_id, 'Begining Balance', 0, $cbe_saving, $cbe_saving)");
                $stmtTran->bind_param("d", $cbe_saving);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
              }
              if($amhara_saving){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $amhara_saving where account_name = 'Saving Account-Amhara'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
             
              $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Amhara', ?, '0', 'Beginning Balance')");
              $stmtTran->bind_param("d", $amhara_saving);
              
              if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
              } 
              $stmtTran->close();

              // 	inserting to the bank table for beginning balance
              $stmtTran = $conn->prepare("INSERT INTO amhara_bank_account (transaction_id,	transaction_type,	transaction_date,	amount,	category,	reference_id,	description, debit,	credit,	net_balance) VALUES ($transaction_id, 'inflow', NOW(), ?, 'cash', $transaction_id, 'Begining Balance', 0, $amhara_saving, $amhara_saving)");
              $stmtTran->bind_param("d", $amhara_saving);
              
              if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
              } 
              $stmtTran->close();
              }
              if($ahadu_saving){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $ahadu_saving where account_name = 'Saving Account-Ahadu'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Ahadu', ?, '0', 'Beginning Balance')");
                $stmtTran->bind_param("d", $ahadu_saving);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

              // 	inserting to the bank table for beginning balance
              $stmtTran = $conn->prepare("INSERT INTO cbe_bank_account (transaction_id,	transaction_type,	transaction_date,	amount,	category,	reference_id,	description, debit,	credit,	net_balance) VALUES ($transaction_id, 'inflow', NOW(), ?, 'cash', $transaction_id, 'Begining Balance', 0, $ahadu_saving, $ahadu_saving)");
              $stmtTran->bind_param("d", $ahadu_saving);
              
              if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
              } 
              $stmtTran->close();
              }
              if($awash_saving){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $awash_saving where account_name = 'Saving Account-awash'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-awash', ?, '0', 'Beginning Balance')");
                $stmtTran->bind_param("d", $awash_saving);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                 // 	inserting to the bank table for beginning balance
              $stmtTran = $conn->prepare("INSERT INTO cbe_bank_account (transaction_id,	transaction_type,	transaction_date,	amount,	category,	reference_id,	description, debit,	credit,	net_balance) VALUES ($transaction_id, 'inflow', NOW(), ?, 'cash', $transaction_id, 'Begining Balance', 0, $awash_saving, $awash_saving)");
              $stmtTran->bind_param("d", $awash_saving);
              
              if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
              } 
              $stmtTran->close();
              }
              if($abay_saving){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $abay_saving where account_name = 'Saving Account-Abay'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Abay', ?, '0', 'Beginning Balance')");
                $stmtTran->bind_param("d", $abay_saving);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                 // 	inserting to the bank table for beginning balance
              $stmtTran = $conn->prepare("INSERT INTO cbe_bank_account (transaction_id,	transaction_type,	transaction_date,	amount,	category,	reference_id,	description, debit,	credit,	net_balance) VALUES ($transaction_id, 'inflow', NOW(), ?, 'cash', $transaction_id, 'Begining Balance', 0, $abay_saving, $abay_saving)");
              $stmtTran->bind_param("d", $abay_saving);
              
              if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
              } 
              $stmtTran->close();
              }
              if($abyssinia_saving){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $abyssinia_saving where account_name = 'Saving Account-Abyssinia'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Saving Account-Abyssinia', ?, '0', 'Beginning Balance')");
                $stmtTran->bind_param("d", $abyssinia_saving);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

               // 	inserting to the bank table for beginning balance
               $stmtTran = $conn->prepare("INSERT INTO cbe_bank_account (transaction_id,	transaction_type,	transaction_date,	amount,	category,	reference_id,	description, debit,	credit,	net_balance) VALUES ($transaction_id, 'inflow', NOW(), ?, 'cash', $transaction_id, 'Begining Balance', 0, $abyssinia_saving, $abyssinia_saving)");
               $stmtTran->bind_param("d", $abyssinia_saving);
               
               if (!$stmtTran->execute()) {
                 echo "Error: " . $stmtTran->error;
               } 
               $stmtTran->close();
              }
              if($account_receive){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $account_receive where account_name = 'Account Receivable'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Receivable', ?, '0', 'Beginning Balance')");
                $stmtTran->bind_param("d", $account_receive);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Receivable', '0', ?, 'Beginning Balance')");
                // $stmtTran->bind_param("d", $account_receive);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();
              }
              // if($inventory){
              //   $query = "UPDATE chart_of_account set current_balance = current_balance + $inventory where account_name = 'Inventory'";
              //   mysqli_query($conn, $query) or die(mysqli_error($conn));
            
              //   $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Inventory', ?, '0', 'Beginning Balance')");
              //   $stmtTran->bind_param("d", $inventory);
                
              //   if (!$stmtTran->execute()) {
              //     echo "Error: " . $stmtTran->error;
              //   } 
              //   $stmtTran->close();

              //   $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Inventory', '0', ?, 'Beginning Balance')");
              //   $stmtTran->bind_param("d", $inventory);
                
              //   if (!$stmtTran->execute()) {
              //     echo "Error: " . $stmtTran->error;
              //   } 
              //   $stmtTran->close();
              // }
              if($prepaid){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $prepaid where account_name = 'Prepaid Expenses'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Prepaid Expenses', ?, '0', 'Beginning Balance')");
                $stmtTran->bind_param("d", $prepaid);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Prepaid Expenses', '0', ?, 'Beginning Balance')");
                // $stmtTran->bind_param("d", $prepaid);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();
              }
              if($property){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $property where account_name = 'Property and Equipment'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Property and Equipment', ?, '0', 'Beginning Balance')");
                $stmtTran->bind_param("d", $property);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Property and Equipment', '0', ?, 'Beginning Balance')");
                // $stmtTran->bind_param("d", $property);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();
              }
              if($account_payable){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $account_payable where account_name = 'Account Payable'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Payable', ?, '0', 'Beginning Balance')");
                // $stmtTran->bind_param("d", $account_payable);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Payable', '0', ?, 'Beginning Balance')");
                $stmtTran->bind_param("d", $account_payable);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
              }
              if($purchase_payable){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $purchase_payable where account_name = 'Purchase Tax Payable'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Purchase Tax Payable', ?, '0', 'Beginning Balance')");
                // $stmtTran->bind_param("d", $purchase_payable);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Purchase Tax Payable', '0', ?, 'Beginning Balance')");
                $stmtTran->bind_param("d", $purchase_payable);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
              }
              if($sales_payable){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $sales_payable where account_name = 'Sales Tax Payable'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Sales Tax Payable', ?, '0', 'Beginning Balance')");
                // $stmtTran->bind_param("d", $sales_payable);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Sales Tax Payable', '0', ?, 'Beginning Balance')");
                $stmtTran->bind_param("d", $sales_payable);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
              }
              if($long_term_debit){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $long_term_debit where account_name = 'Long Term Debit'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Long Term Debit', ?, '0', 'Beginning Balance')");
                // $stmtTran->bind_param("d", $long_term_debit);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Long Term Debit', '0', ?, 'Beginning Balance')");
                $stmtTran->bind_param("d", $long_term_debit);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
              }
              if($owner_capital){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $owner_capital where account_name = 'Owners Capital'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Owners Capital', ?, '0', 'Beginning Balance')");
                // $stmtTran->bind_param("d", $owner_capital);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Owners Capital', '0', ?, 'Beginning Balance')");
                $stmtTran->bind_param("d", $owner_capital);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
              }
              if($retained_earning){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $retained_earning where account_name = 'Retained Earning'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Retained Earning', ?, '0', 'Beginning Balance')");
                // $stmtTran->bind_param("d", $retained_earning);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Retained Earning', '0', ?, 'Beginning Balance')");
                $stmtTran->bind_param("d", $retained_earning);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
              }
              if($product_sales){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $product_sales where account_name = 'Product Sale'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Product Sale', ?, '0', 'Beginning Balance')");
                // $stmtTran->bind_param("d", $product_sales);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Product Sale', '0', ?, 'Beginning Balance')");
                $stmtTran->bind_param("d", $product_sales);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
              }
              if($other_income){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $other_income where account_name = 'Other Income'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Other Income', ?, '0', 'Beginning Balance')");
                $stmtTran->bind_param("d", $other_income);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Other Income', '0', ?, 'Beginning Balance')");
                // $stmtTran->bind_param("d", $other_income);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();
              }
              if($cogs){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $cogs where account_name = 'Cost of Goods Sold'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cost of Goods Sold', ?, '0', 'Beginning Balance')");
                $stmtTran->bind_param("d", $cogs);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cost of Goods Sold', '0', ?, 'Beginning Balance')");
                // $stmtTran->bind_param("d", $cogs);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();
              }
              if($salary){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $salary where account_name = 'Salary and Wage'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Salary and Wage', ?, '0', 'Beginning Balance')");
                // $stmtTran->bind_param("d", $salary);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Salary and Wage', '0', ?, 'Beginning Balance')");
                $stmtTran->bind_param("d", $salary);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
              }
              if($electricity){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $electricity where account_name = 'Electricity'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Electricity', ?, '0', 'Beginning Balance')");
                // $stmtTran->bind_param("d", $electricity);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Electricity', '0', ?, 'Beginning Balance')");
                $stmtTran->bind_param("d", $electricity);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
              }
              if($internet){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $internet where account_name = 'Internet'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Internet', ?, '0', 'Beginning Balance')");
                // $stmtTran->bind_param("d", $internet);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Internet', '0', ?, 'Beginning Balance')");
                $stmtTran->bind_param("d", $internet);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
              }
              if($advert){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $advert where account_name = 'Marketing and Advertisement'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Marketing and Advertisement', ?, '0', 'Beginning Balance')");
                // $stmtTran->bind_param("d", $advert);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Marketing and Advertisement', '0', ?, 'Beginning Balance')");
                $stmtTran->bind_param("d", $advert);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
              }
              if($miscellaneous){
                $query = "UPDATE chart_of_account set current_balance = current_balance + $miscellaneous where account_name = 'Miscellaneous Expenses'";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
            
                // $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Miscellaneous Expenses', ?, '0', 'Beginning Balance')");
                // $stmtTran->bind_param("d", $miscellaneous);
                
                // if (!$stmtTran->execute()) {
                //   echo "Error: " . $stmtTran->error;
                // } 
                // $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Miscellaneous Expenses', '0', ?, 'Beginning Balance')");
                $stmtTran->bind_param("d", $miscellaneous);
                
                if (!$stmtTran->execute()) {
                  echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
                break;
              }
              ?>
            <?php
          }
          ?>
          <script>
              alert("Beginning Balance imported successfully.");
          </script>
          <script>
              window.location = "beginning_balance.php";
          </script>