<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
            <?php
            $product_id = $_POST['prodcode'];

            $purchasePrices = "SELECT * FROM product where PRODUCT_CODE = $product_id";
            $results = mysqli_query($db, $purchasePrices);
            $rows = mysqli_fetch_array($results);

            $prodname = $rows['NAME'];
            $cataname = $rows['CNAME'];
            $unit = $rows['UNIT'];

              $transac_id = $_POST['transac_id'];
              $qty = $_POST['quantity'];
              $price = $_POST['price'];
              $bank = $_POST['bank'];
              $ex_date = $_POST['expired_date'];
              $pur_date = $_POST['purch_date'];
              $vat = $_POST['vat'];
              $subtotal = number_format(($_POST['quantity'] * $_POST['price']), 2, '.', '');
              $vat_t = number_format($subtotal * $vat, 2, '.', '');
              $net = number_format(($subtotal + $vat_t), 2, '.', '');
              $status = $_POST['status'];
              $emp = $_POST['employee'];
              $rol = $_POST['role'];
              $sub = $_POST['supplier'];
              $transac_id = $_POST['transac_id'];

              switch($_GET['action']){
                case 'add': 
                  $query = "INSERT INTO stockin
                  (id, transac_id, pro_code, pro_name, category, quantity, unit, price, subtotal, vat, total, status, stockin_date, expired_date, employee, role, company_name)
                  VALUES (NULL, '{$transac_id }', '{$product_id}','{$prodname}','{$cataname}', '{$qty}', '{$unit}', '{$price}', '{$subtotal}', '{$vat_t}', '{$net}', '{$status}', '{$pur_date}', '{$ex_date}', '{$emp}', '{$rol}','{$sub}')";
                  mysqli_query($db,$query)or die (mysqli_error($db));

                  $query2 = "INSERT INTO purchse
                  VALUES (NULL, '{$transac_id }', '{$product_id}','{$prodname}','{$cataname}', '{$qty}', '{$unit}', '{$price}', '{$subtotal}', '{$vat_t}', '{$net}', '{$status}', '{$pur_date}, '{$ex_date}', '{$emp}', '{$rol}','{$sub}')";
                  mysqli_query($db,$query2)or die (mysqli_error($db));
              }


              switch($_GET['action']){
                case 'add': 
                  if($bank === "amhara"){
                    function recordPurchaseTransaction($conn, $purchase_id, $amount) {
    
                      $stmt = $conn->prepare("INSERT INTO amhara_bank_account (transaction_type, transaction_date, amount, category, reference_id, description) VALUES ('outflow', NOW(), ?, 'purchase', ?, 'Purchase transaction')");
                      $stmt->bind_param("di", $amount, $purchase_id);
                      
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
        
                  // Example usage:
                  $purchase_id = $transac_id; // Replace with actual purchase ID
                  $amount = $net;
                  recordPurchaseTransaction($conn, $purchase_id, $amount);
                  }else if ($bank === "cbe"){
                        function recordPurchaseTransaction($conn, $purchase_id, $amount) {
        
                          $stmt = $conn->prepare("INSERT INTO cbe_bank_account (transaction_type, transaction_date, amount, category, reference_id, description) VALUES ('outflow', NOW(), ?, 'purchase', ?, 'Purchase transaction')");
                          $stmt->bind_param("di", $amount, $purchase_id);
                          
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
            
                      // Example usage:
                      $purchase_id = $transac_id; // Replace with actual purchase ID
                      $amount = $net;
                      recordPurchaseTransaction($conn, $purchase_id, $amount);

                  } else if ($bank === "ahadu"){
                    function recordPurchaseTransaction($conn, $purchase_id, $amount) {
    
                      $stmt = $conn->prepare("INSERT INTO ahadu_bank_account (transaction_type, transaction_date, amount, category, reference_id, description) VALUES ('outflow', NOW(), ?, 'purchase', ?, 'Purchase transaction')");
                      $stmt->bind_param("di", $amount, $purchase_id);
                      
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
        
                  // Example usage:
                  $purchase_id = $transac_id; // Replace with actual purchase ID
                  $amount = $net;
                  recordPurchaseTransaction($conn, $purchase_id, $amount);
                } else if ($bank === "awash"){
                  function recordPurchaseTransaction($conn, $purchase_id, $amount) {
  
                    $stmt = $conn->prepare("INSERT INTO awash_bank_account (transaction_type, transaction_date, amount, category, reference_id, description) VALUES ('outflow', NOW(), ?, 'purchase', ?, 'Purchase transaction')");
                    $stmt->bind_param("di", $amount, $purchase_id);
                    
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
      
                // Example usage:
                $purchase_id = $transac_id; // Replace with actual purchase ID
                $amount = $net;
                recordPurchaseTransaction($conn, $purchase_id, $amount);
              }

                  $query = "INSERT INTO stockin
                  (id, transac_id, pro_code, pro_name, category, quantity, unit, price, subtotal, vat, total, status, stockin_date, expired_date, employee, role, company_name)
                  VALUES (NULL, '{$transac_id }', '{$product_id}','{$prodname}','{$cataname}', '{$qty}', '{$unit}', '{$price}', '{$subtotal}', '{$vat_t}', '{$net}', '{$status}', '{$pur_date}', '{$ex_date}', '{$emp}', '{$rol}','{$sub}')";
                  mysqli_query($db,$query)or die (mysqli_error($db));

                  $query2 = "INSERT INTO purchse
                  VALUES (NULL, '{$transac_id }', '{$product_id}','{$prodname}','{$cataname}', '{$qty}', '{$unit}', '{$price}', '{$subtotal}', '{$vat_t}', '{$net}', '{$status}', '{$pur_date}, '{$ex_date}', '{$emp}', '{$rol}','{$sub}')";
                  mysqli_query($db,$query2)or die (mysqli_error($db));
                  break;
              }
  
            ?>
              <script type="text/javascript">
                window.location = "purchase.php";
              </script>
