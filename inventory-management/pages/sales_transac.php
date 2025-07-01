<?php
include'../includes/connection.php';
?>


<?php
$product_id = $_POST['proid'];
$quantitySold = $_POST['quantity'];
$salesPrice = $_POST['price'];

$remainingQty = $quantitySold;
$cogs = 0;

function sellProduct($productId, $quantity, $salePrice) {
    global $conn;
    global $db;
    $remainingQty = $quantity; // Total quantity we need to stock out
    $totalPriceReduced = 0; // Initialize total price reduced


              $product_id = $_POST['proid'];
              $prodname = $_POST['name'];
              $cataname = $_POST['brand_id'];
              $qty = $_POST['quantity'];
              $unit = $_POST['unit'];
              $price = $_POST['price'];
              $vat = $_POST['vat'];

              $subtotal = number_format(($_POST['quantity'] * $_POST['price']), 2, '.', '');
              $vat_t = number_format(($subtotal * $vat), 2, '.', '');
              $net = number_format(($subtotal + $vat_t), 2, '.', '');
              $status = $_POST['status'];
              $emp = $_POST['employee'];
              $rol = $_POST['role'];
              $customer = $_POST['customer'];
              // $today = date("mdGis");
              $transac_id = $_POST['transac_id'];
  
              $query2 = "select PRICE from purchse where NAME = '$prodname'";
              $query2_result = mysqli_query($db, $query2) or die (mysqli_error($db));
              $rows = mysqli_fetch_assoc($query2_result);
              $pur_price = $rows['PRICE'];
              $profit = ($price - $pur_price) * $qty;



        // Step 1: Fetch all stock-in records for the product in FIFO order
        // Select batches where quantity > 0, ordered by date (oldest first)
        $query = "SELECT * FROM stockin WHERE pro_code = ? AND quantity > 0 ORDER BY stockin_date ASC";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Step 2: Process each stock-in batch in FIFO order
        while ($row = $result->fetch_assoc()) {
            $batchId = $row['id'];
            $batchQty = $row['quantity'];
            $purchasePrice = $row['purchase_price'];  // Price per unit in this batch
            

            // Step 3: Check if remainingQty is more than zero
            if ($remainingQty <= 0) {
                break; // All requested quantity has been fulfilled
            }

            if ($remainingQty >= $batchQty) {
                // Case 1: Remaining quantity is greater than or equal to this batch quantity
                // Fully use this batch, set its quantity to 0
                $totalPriceReduced += $batchQty * $purchasePrice; // Add to the total price reduced
                $remainingQty -= $batchQty; // Reduce the remaining quantity by the batch amount
                $newTotalPrice = 0;  // Fully depleted, so no remaining total price
                $updateQuery = "UPDATE stockin SET quantity = 0, total_price = 0 WHERE stockin_id = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("i", $batchId);
            } else {
                // Case 2: Remaining quantity is less than this batch quantity
                // Partially use this batch, set its quantity to (batchQty - remainingQty)
                $totalPriceReduced += $remainingQty * $purchasePrice; // Add to the total price reduced
                $newBatchQty = $batchQty - $remainingQty; // Calculate new quantity for the batch
                $newTotalPrice = $newBatchQty * $purchasePrice;  // Recalculate the total price based on the remaining quantity
                $remainingQty = 0; // We've fulfilled the entire stock-out request
                $updateQuery = "UPDATE stockin SET quantity = ?, total_price = ? WHERE id = ?";
                $updateStmt = $conn->prepare($updateQuery);
                $updateStmt->bind_param("idi", $newBatchQty, $newTotalPrice, $batchId);
            }
            
            // Execute the update query for this batch
            $updateStmt->execute();
        }

        // Step 4: Check if we fulfilled the requested quantity
        if ($remainingQty > 0) {
            echo "Error: Not enough stock available to fulfill the request.";
            return;
        }
        

        // Step 5: Log the stock-out action in the stockout table
        $stockOutStmt = $conn->prepare("INSERT INTO sales (TRANS_ID, PRODUCT_CODE, NAME, CATEGORY, QUANTITY, UNIT, PRICE,total_sale_price, SUBTOTAL, VAT, TOTAL, STATUS, DATE, EMPLOYEE, ROLE, CUSTOMER_NAMEpro_code, pro_name, category, quantity, unit, total_price_reduced, sale_price, total_sale,stockout_date, expired_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
    
        $stockOutStmt->bind_param("issisddds", $productId, $prodname, $cataname, $quantity, $unit, $totalPriceReduced, $salePrice, $total_sale_price, $expire_date);
        $stockOutStmt->execute();

        echo "Stock-out completed successfully.";
    }

    switch($_GET['action']){
        case 'add': 
            // stockOutProduct($product_id, $quantity, $salePrice);
        break;    
    } 
    ?>           
              <script type="text/javascript">
                window.location = "sales.php";
              </script> 

    <?php



  