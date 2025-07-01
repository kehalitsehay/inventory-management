<?php
session_start();
include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if cart is empty
  if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
      echo "Your cart is empty. Please add items before proceeding to checkout.";
      exit;
  }

  // Retrieve invoice and customer details
  $today = date("mdGis");
  $invoice_number = $today;
  $customer_name = isset($_POST['customer_name']) ? $_POST['customer_name'] : null;
  $employee_name = isset($_POST['employee']) ? $_POST['employee'] : null;
  $sales_method = isset($_POST['status']) ? $_POST['status'] : null;
  $status = isset($_POST['status']) ? $_POST['status'] : null;


        // $status = $_POST['status'];
        $emp = $_POST['employee'];
        // $rol = $_POST['role'];
        $customer = $_POST['customer_name'];
        
        $transac_id = $today;
        



    // Current date of transaction
  $date_of_transaction = date('Y-m-d H:i:s');
  // $cashier_name = "Kehali";

  if (!$invoice_number || !$customer_name) {
      echo "Invoice number and customer name are required!";
      exit;
  }

  $cart_items = $_SESSION['cart'];
  $grand_total = 0; // To calculate grand total price

  // Begin database transaction
  $conn->begin_transaction();

  try {
      // Validate quantities before proceeding
        foreach ($cart_items as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];

            // Calculate total stock available for the product
            $stmt_stock = $conn->prepare("SELECT SUM(quantity) AS total_stock FROM stockin WHERE pro_code= ? AND quantity > 0");
            $stmt_stock->bind_param("i", $product_id);
            $stmt_stock->execute();
            $result = $stmt_stock->get_result();
            $stock = $result->fetch_assoc();

            if (!$stock || $stock['total_stock'] < $quantity) {
                $stockin_qty = $stock['total_stock'];
                echo "Insufficient stock for product ID $product_id. The available stock quantity is $stockin_qty. Transaction halted.";
                $conn->rollback(); // Rollback the transaction
                exit;
            }
        }

        // Insert invoice details
        $stmt_invoice = $conn->prepare("INSERT INTO invoices (invoice_number, customer_name, employee_name, grand_total, sales_method, invoice_date) VALUES (?, ?, ?, ?,?, NOW())");
        foreach ($cart_items as $item) {
            $grand_total += $item['total'];
        }
        $stmt_invoice->bind_param("sssds", $invoice_number, $customer_name, $employee_name, $grand_total, $sales_method);
        $stmt_invoice->execute();
        $invoice_id = $conn->insert_id; // Get the last inserted invoice ID


        if($sales_method == "Cash"){
            function sellProduct($productId, $quantity, $salePrice) {
                global $conn;
                global $product_id, $salePrice, $prodname, $cataname, $unit, $transac_id, $quantity, $vat, $customer;
      
              $remainingQty = $quantity; // Total quantity we need to stock out
              $totalPriceReduced = 0; // Initialize total price reduced
      
                  $subtotal_sale = number_format(($quantity * $salePrice), 2, '.', '');
                  $vat_f = number_format(($subtotal_sale * $vat), 2, '.', '');
                  $total_sale = number_format(($subtotal_sale + $vat_f), 2, '.', '');
                  $status = $_POST['status'];
                  $emp = $_POST['employee'];
                  // $rol = $_POST['role'];
                  $customer = $_POST['customer_name'];
                  $today = date("mdGis");
                  $transac_id = $today;
      
      
            // Step 1: Fetch all stock-in records for the product in FIFO order
            // Select batches where quantity > 0, ordered by date (oldest first)
            $query = "SELECT *
                        FROM stockin WHERE pro_code = ? AND quantity > 0 ORDER BY stockin_date ASC";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();
          
      
            // Step 2: Process each stock-in batch in FIFO order
            while ($row = $result->fetch_assoc()) {
                $batchId = $row['id'];
                $batchQty = $row['quantity'];
                $purchasePrice = $row['price'];  // Price per unit in this batch
                $vatt = $row['VAT_t']; // vat value forthis batch
                
                // $query = "SELECT SUM(quantity) FROM stockin WHERE pro_code = $product_id AND quantity > 0";
                // $result = mysqli_query($db, $query) or die (mysqli_error($db));
                // $row = mysqli_fetch_assoc($result);
                // $totalBatchQty = $row;
                $stmt = $conn->prepare("
                        SELECT 
                            SUM(quantity) AS total_stockin FROM stockin WHERE pro_code = $product_id AND quantity > 0
                    ");
                    $stmt->execute();
                    $stmt->bind_result($total_stockin);
                    $stmt->fetch();
      
                    if($remainingQty > $total_stockin){
                        ?>
                        <script>
                            alert("Not enough stock available in stockin to fulfill the request.");
                        </script>
                        <?php
                        break;
                    }
                    $stmt->close();
               
                // Step 3: Check if remainingQty is more than zero
                if ($remainingQty <= 0) {
                    break; // All requested quantity has been fulfilled
                }
      
                if ($remainingQty >= $batchQty) {
                    // Case 1: Remaining quantity is greater than or equal to this batch quantity
                    // Fully use this batch, set its quantity to 0
                    $totalPriceReduced += (($batchQty * $purchasePrice) + ($batchQty * $purchasePrice) * $vatt); // Add to the total price reduced
                    $remainingQty -= $batchQty; // Reduce the remaining quantity by the batch amount
                    $newTotalPrice = 0;  // Fully depleted, so no remaining total price
                    $updateQuery = "UPDATE stockin SET quantity = 0, total = 0, subtotal = 0, vat = 0 WHERE id = ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param("i", $batchId);
                } else {
                    // Case 2: Remaining quantity is less than this batch quantity
                    // Partially use this batch, set its quantity to (batchQty - remainingQty)
                    $newBatchQty = $batchQty - $remainingQty; 
                    $totalPriceReduced += (($remainingQty * $purchasePrice) + ($remainingQty * $purchasePrice) * $vatt); // Add to the total price reduced
                    $subtotal_sale1 = ($newBatchQty * $purchasePrice);
                    $vat_f1 = $subtotal_sale1 * $vatt;
                    // Calculate new quantity for the batch
                    $newTotalPrice1 = $subtotal_sale1 + $vat_f1;  // Recalculate the total price based on the remaining quantity
                    $remainingQty = 0; // We've fulfilled the entire stock-out request
                    $updateQuery = "UPDATE stockin SET quantity = ?, total = ?, subtotal = ?, vat = ?  WHERE id = ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param("idddi", $newBatchQty, $newTotalPrice1, $subtotal_sale1, $vat_f1, $batchId);
                }
                
                // Execute the update query for this batch
                $updateStmt->execute();
            }
      
            // Step 4: Check if we fulfilled the requested quantity
            if ($remainingQty > 0) {
                echo "Error: Not enough stock available to fulfill the request.";
                return;
            }

                $subtotal_sale = number_format(($quantity * $salePrice), 2, '.', '');
                $vat_f = $vat;
                $total_sale = $subtotal_sale + $vat_f;
                $profit = $total_sale - $totalPriceReduced;

                // updating chart of account
                $query = "UPDATE chart_of_account set current_balance = current_balance + $total_sale where account_name = 'Cash on Hand' ";
                mysqli_query($conn, $query) or die(mysqli_error($conn));

                $query = "UPDATE chart_of_account set current_balance = current_balance + $vat_f where account_name = 'Sales Tax Payable' ";
                mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                $query = "UPDATE chart_of_account set current_balance = current_balance + $subtotal_sale where account_name = 'Product Sale' ";
                mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                $query = "UPDATE chart_of_account set current_balance = current_balance + $totalPriceReduced where account_name = 'Cost of Goods Sold' ";
                mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                $query = "UPDATE chart_of_account set current_balance = current_balance - $totalPriceReduced where account_name = 'Inventory' ";
                mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                // transaction registering 
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cash on Hand', ?, '0', 'Sold Inventory on Cash')");
                $stmtTran->bind_param("d", $total_sale,);
                
                if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Sales', '0', ?, 'Sold Inventory on Cash')");
                $stmtTran->bind_param("d", $subtotal_sale);
                
                if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Sales Tax Payable', '0', ?, 'Sold Inventory on Cash')");
                $stmtTran->bind_param("d", $vat_f);
                
                if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                //  Adjusting the inventory against COGS
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cost of Goods Sold', ?, '0', 'Adjusting Inventory Against COGS')");
                $stmtTran->bind_param("d", $totalPriceReduced,);
                
                if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Inventory', '0', ?, 'Adjusting Inventory Against COGS')");
                $stmtTran->bind_param("d", $totalPriceReduced);
                
                if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

            
            // Step 5: Log the stock-out action in the stockout table
            $stockOutStmt = $conn->prepare("INSERT INTO stockout (transac_id, pro_code, pro_name, category, quantity, unit, sale_price, subtotal, vat, total_price_reduced,  total, profit, stockout_date, expired_date, status, employee,  customer_name, store) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, ?, ?, 'Store 1')");
        
            $stockOutStmt->bind_param("iissisddddddsss", $transac_id, $productId, $prodname, $cataname, $quantity, $unit, $salePrice, $subtotal_sale, $vat_f, $totalPriceReduced, $total_sale, $profit, $status, $emp, $customer);
            $stockOutStmt->execute();
      
            $stockOutStmt = $conn->prepare("INSERT INTO sales (transac_id, PRODUCT_CODE, NAME, CATEGORY, QUANTITY, UNIT, PRICE, SUBTOTAL, VAT, TOTAL, total_price_reduced, profit, DATE, expired_date, STATUS, EMPLOYEE, CUSTOMER_NAME, store) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, ?, ?, 'Store 1')");
        
            $stockOutStmt->bind_param("iissisddddddsss", $transac_id, $productId, $prodname, $cataname, $quantity, $unit, $salePrice, $subtotal_sale, $vat_f, $total_sale, $totalPriceReduced,  $profit, $status, $emp, $customer);
            $stockOutStmt->execute();
            
            
            // echo "Stock-out completed successfully.";
            }
        }else{
            function sellProduct($productId, $quantity, $salePrice) {
                global $conn;
                global $product_id, $salePrice, $prodname, $cataname, $unit, $transac_id, $quantity, $vat, $customer;
      
              $remainingQty = $quantity; // Total quantity we need to stock out
              $totalPriceReduced = 0; // Initialize total price reduced
      
                  $subtotal_sale = number_format(($quantity * $salePrice), 2, '.', '');
                  $vat_f = number_format(($subtotal_sale * $vat), 2, '.', '');
                  $total_sale = number_format(($subtotal_sale + $vat_f), 2, '.', '');
                  $status = $_POST['status'];
                  $emp = $_POST['employee'];
                  // $rol = $_POST['role'];
                  $customer = $_POST['customer_name'];
                  $today = date("mdGis");
                  $transac_id = $today;
      
      
            // Step 1: Fetch all stock-in records for the product in FIFO order
            // Select batches where quantity > 0, ordered by date (oldest first)
            $query = "SELECT *
                        FROM stockin WHERE pro_code = ? AND quantity > 0 ORDER BY stockin_date ASC";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $productId);
            $stmt->execute();
            $result = $stmt->get_result();
          
      
            // Step 2: Process each stock-in batch in FIFO order
            while ($row = $result->fetch_assoc()) {
                $batchId = $row['id'];
                $batchQty = $row['quantity'];
                $purchasePrice = $row['price'];  // Price per unit in this batch
                $vatt = $row['VAT_t']; // vat value forthis batch
                
                // $query = "SELECT SUM(quantity) FROM stockin WHERE pro_code = $product_id AND quantity > 0";
                // $result = mysqli_query($db, $query) or die (mysqli_error($db));
                // $row = mysqli_fetch_assoc($result);
                // $totalBatchQty = $row;
                $stmt = $conn->prepare("
                        SELECT 
                            SUM(quantity) AS total_stockin FROM stockin WHERE pro_code = $product_id AND quantity > 0
                    ");
                    $stmt->execute();
                    $stmt->bind_result($total_stockin);
                    $stmt->fetch();
      
                    if($remainingQty > $total_stockin){
                        ?>
                        <script>
                            alert("Not enough stock available in stockin to fulfill the request.");
                        </script>
                        <?php
                        break;
                    }
                    $stmt->close();
               
                // Step 3: Check if remainingQty is more than zero
                if ($remainingQty <= 0) {
                    break; // All requested quantity has been fulfilled
                }
      
                if ($remainingQty >= $batchQty) {
                    // Case 1: Remaining quantity is greater than or equal to this batch quantity
                    // Fully use this batch, set its quantity to 0
                    $totalPriceReduced += (($batchQty * $purchasePrice) + ($batchQty * $purchasePrice) * $vatt); // Add to the total price reduced
                    $remainingQty -= $batchQty; // Reduce the remaining quantity by the batch amount
                    $newTotalPrice = 0;  // Fully depleted, so no remaining total price
                    $updateQuery = "UPDATE stockin SET quantity = 0, total = 0, subtotal = 0, vat = 0 WHERE id = ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param("i", $batchId);
                } else {
                    // Case 2: Remaining quantity is less than this batch quantity
                    // Partially use this batch, set its quantity to (batchQty - remainingQty)
                    $newBatchQty = $batchQty - $remainingQty; 
                    $totalPriceReduced += (($remainingQty * $purchasePrice) + ($remainingQty * $purchasePrice) * $vatt); // Add to the total price reduced
                    $subtotal_sale1 = ($newBatchQty * $purchasePrice);
                    $vat_f1 = $subtotal_sale1 * $vatt;
                    // Calculate new quantity for the batch
                    $newTotalPrice1 = $subtotal_sale1 + $vat_f1;  // Recalculate the total price based on the remaining quantity
                    $remainingQty = 0; // We've fulfilled the entire stock-out request
                    $updateQuery = "UPDATE stockin SET quantity = ?, total = ?, subtotal = ?, vat = ?  WHERE id = ?";
                    $updateStmt = $conn->prepare($updateQuery);
                    $updateStmt->bind_param("idddi", $newBatchQty, $newTotalPrice1, $subtotal_sale1, $vat_f1, $batchId);
                }
                
                // Execute the update query for this batch
                $updateStmt->execute();
            }
      
            // Step 4: Check if we fulfilled the requested quantity
            if ($remainingQty > 0) {
                echo "Error: Not enough stock available to fulfill the request.";
                return;
            }

                $subtotal_sale = number_format(($quantity * $salePrice), 2, '.', '');
                $vat_f = $vat;
                $total_sale = $subtotal_sale + $vat_f;
                $profit = $total_sale - $totalPriceReduced;
                // updating chart of account
                $query = "UPDATE chart_of_account set current_balance = current_balance + $total_sale where account_name = 'Account Receivable' ";
                mysqli_query($conn, $query) or die(mysqli_error($conn));

                $query = "UPDATE chart_of_account set current_balance = current_balance + $vat_f where account_name = 'Sales Tax Payable' ";
                mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                $query = "UPDATE chart_of_account set current_balance = current_balance + $subtotal_sale where account_name = 'Product Sale' ";
                mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                $query = "UPDATE chart_of_account set current_balance = current_balance + $totalPriceReduced where account_name = 'Cost of Goods Sold' ";
                mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                $query = "UPDATE chart_of_account set current_balance = current_balance - $totalPriceReduced where account_name = 'Inventory' ";
                mysqli_query($conn, $query) or die(mysqli_error($conn)); 

                // transaction registering 
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Account Receivable', ?, '0', 'Sold Inventory on Credit')");
                $stmtTran->bind_param("d", $total_sale,);
                
                if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Sales', '0', ?, 'Sold Inventory on Credit')");
                $stmtTran->bind_param("d", $subtotal_sale);
                
                if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Sales Tax Payable', '0', ?, 'Sold Inventory on Credit')");
                $stmtTran->bind_param("d", $vat_f);
                
                if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                //  Adjusting the inventory against COGS
                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Cost of Goods Sold', ?, '0', 'Adjusting Inventory Against COGS')");
                $stmtTran->bind_param("d", $totalPriceReduced,);
                
                if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();

                $stmtTran = $conn->prepare("INSERT INTO transaction (date, account_name, debit, credit, description) VALUES (NOW(), 'Inventory', '0', ?, 'Adjusting Inventory Against COGS')");
                $stmtTran->bind_param("d", $totalPriceReduced);
                
                if (!$stmtTran->execute()) {
                echo "Error: " . $stmtTran->error;
                } 
                $stmtTran->close();
     
            // Step 5: Log the stock-out action in the stockout table
            $stockOutStmt = $conn->prepare("INSERT INTO stockout (transac_id, pro_code, pro_name, category, quantity, unit, sale_price, subtotal, vat, total_price_reduced,  total, profit, stockout_date, expired_date, status, employee,  customer_name, store) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, ?, ?, 'Store 1')");
        
            $stockOutStmt->bind_param("iissisddddddsss", $transac_id, $productId, $prodname, $cataname, $quantity, $unit, $salePrice, $subtotal_sale, $vat_f, $totalPriceReduced, $total_sale, $profit, $status, $emp, $customer);
            $stockOutStmt->execute();
      
            $stockOutStmt = $conn->prepare("INSERT INTO sales (transac_id, PRODUCT_CODE, NAME, CATEGORY, QUANTITY, UNIT, PRICE, SUBTOTAL, VAT, TOTAL, total_price_reduced, profit, DATE, expired_date, STATUS, EMPLOYEE, CUSTOMER_NAME, store) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, ?, ?, 'Store 1')");
        
            $stockOutStmt->bind_param("iissisddddddsss", $transac_id, $productId, $prodname, $cataname, $quantity, $unit, $salePrice, $subtotal_sale, $vat_f, $total_sale, $totalPriceReduced,  $profit, $status, $emp, $customer);
            $stockOutStmt->execute();
            

                // updating customer table
                $query = "UPDATE customer set CREDIT_BALANCE = CREDIT_BALANCE + $total_sale where CUST_ID = $customer";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
                $date = date('Y-m-d');
                $dueDate = date('Y-m-d', strtotime('+30 days', strtotime($date)));
                // $dueDate = $date;
                // registering the customer on credit_customer table
                $query = "INSERT INTO credit_customer (customer_id, credit_balance, due_date, paied_date, discount,interest) VALUES (?, ?, ?, '0', 0,0)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ids", $customer, $total_sale, $dueDate);
                $stmt->execute();
            }
        }


        
      // Process each cart item
        foreach ($cart_items as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $salePrice = $item['price'];
            $vat = $item['vat'];
            $subtotal = $item['subtotal'];
            $total = $item['total'];

                $query = "SELECT * FROM product where PRODUCT_CODE = $product_id";
                $results = mysqli_query($db, $query);
                $rows = mysqli_fetch_array($results);

                $prodname = $rows['NAME'];
                $cataname = $rows['CNAME'];
                $unit = $rows['UNIT'];
          // this the place of function that omitted from prvious
            sellProduct($product_id, $quantity, $salePrice);
        }
        // Commit transaction
        $conn->commit();
        
        unset($_SESSION['cart']); // Clear cart

      }catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Error during checkout: " . $e->getMessage();
    }
  }else {
    echo "Invalid request!";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Success</title>
    <style>
        /* Add receipt style */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            text-align: center;
            margin: 0;
        }
        .receipt {
            width: 63mm; /* Adjust for POS printer size */
            padding: 5px;
            border: 1px dashed black;
        }
        .receipt .header {
            font-size: 14px;
            font-weight: bold;
        }
        .receipt .footer {
            margin-top: 10px;
            border-top: 1px dashed black;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <p>Selam Arigiw Hypermarket</p>
            <p>Date: <?php echo $date_of_transaction; ?></p>
            <p>Invoice #: <?php echo $invoice_number; ?></p>
            <p>Customer: <?php echo $customer_name; ?></p>
            <p>Cashier: <?php echo $employee_name; ?></p>
        </div>

        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>VAT</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sn = 1;
                foreach ($cart_items as $item) {
                    
                    // $vat_t =  $item['quantity'] * $item['price'] * $item['vat'];
                    $item_total = $item['quantity'] * $item['price'] + $item['vat'];
                    echo "<tr>
                        <td>$sn</td>
                        <td>{$item['product_name']}</td>
                        <td>{$item['quantity']}</td>
                        <td>{$item['price']}</td>
                        <td>{$item['vat']}</td>
                        <td>{$item_total}</td>
                    </tr>";
                    $sn++;
                }
                ?>
            </tbody>
        </table>

        <div>
            <h3>Grand Total ETB: <?php echo $grand_total; ?></h3>
        </div>

        <div class="footer">
            <p>Thank you for shopping with us!</p>
        </div>
    </div>

    <button onclick="window.print()">Print Receipt</button>
    <a href="sales.php"><button type="submit">Back</button></a>
</body>
</html>

