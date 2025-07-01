<?php
session_start();
include '../includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Check if cart is empty
  if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
      echo "Your cart is empty. Please add items before proceeding to checkout.";
      exit;
  }

  // $cashier_name = "Kehali";
  $cart_items = $_SESSION['cart'];

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


            function sellProduct($productId, $quantity, $salePrice) {
                global $conn;
                global $product_id, $salePrice, $prodname, $cataname, $unit, $transac_id, $quantity, $vat, $vat_f, $vatt, $subtotal, $stockin, $status, $expired, $employee, $company, $totalPriceReduced;
      
              $remainingQty = $quantity; // Total quantity we need to stock out
              $totalPriceReduced = 0; // Initialize total price reduced
      
                  $subtotal_sale = number_format(($quantity * $salePrice), 2, '.', '');
                  $vat_f = number_format(($subtotal_sale * $vat), 2, '.', '');
                  $total_sale = number_format(($subtotal_sale + $vat_f), 2, '.', '');

      
      
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
                

            // Step 5: Log the stock-out action in the stockout table
            $stockOutStmt = $conn->prepare("INSERT INTO stockin2 (transac_id, pro_code, pro_name, category, quantity, unit, price, subtotal, VAT_t, vat, total, stockin_date, expired_date, status, employee,  company_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
            $stockOutStmt->bind_param("ssssisdddddsssss", $transac_id, $productId, $prodname, $cataname, $quantity, $unit, $salePrice, $subtotal, $vatt, $vat_f, $totalPriceReduced, $stockin,$expired, $status, $employee, $company);
            $stockOutStmt->execute();
            
            // echo "Stock-out completed successfully.";
            }

   
      // Process each cart item
        foreach ($cart_items as $item) {
            $product_id = $item['product_id'];
            $quantity = $item['quantity'];
            $salePrice = $item['price'];
            $vat = $item['vat'];
            $vatt = $item['vatt'];
            $subtotal = $item['subtotal'];
            $total = $item['total'];

                $query = "SELECT * FROM stockin where pro_code = $product_id LIMIT 1";
                $results = mysqli_query($db, $query);
                $rows = mysqli_fetch_array($results);

                $prodname = $rows['pro_name'];
                $cataname = $rows['category'];
                $unit = $rows['unit'];
                $transac_id = $rows['transac_id'];
                $stockin = $rows['stockin_date'];
                $expired = $rows['expired_date'];
                $status = $rows['status'];
                $employee = $rows['employee'];
                $company = $rows['company_name'];

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
<script>
  alert("You have successfully moved products to Store two!");
  window.location = 'move_products.php';
</script>