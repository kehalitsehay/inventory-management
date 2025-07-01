<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
            <?php
            $product_id = $_POST['prodcode'];

            $purchasePrices = "SELECT * FROM purcase_req where PRODUCT_CODE = $product_id";
            $results = mysqli_query($db, $purchasePrices);
            $rows = mysqli_fetch_array($results);

            $prodname = $rows['NAME'];
            $cataname = $rows['CATEGORY'];
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
                  $query = "INSERT INTO stockin_request
                  (id, transac_id, pro_code, pro_name, category, quantity, unit, price, subtotal, vat, total, status, stockin_date, expired_date, employee, role, company_name, req_status, bank)
                  VALUES (NULL, '{$transac_id }', '{$product_id}','{$prodname}','{$cataname}', '{$qty}', '{$unit}', '{$price}', '{$subtotal}', '{$vat_t}', '{$net}', '{$status}', '{$pur_date}', '{$ex_date}', '{$emp}', '{$rol}','{$sub}', 'Pending', '{$bank}')";
                  mysqli_query($db,$query)or die (mysqli_error($db));
              }
            ?>
              <script type="text/javascript">
                window.location = "purchase.php";
              </script>



