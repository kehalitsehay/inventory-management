<?php
include '../includes/connection.php';
include '../includes/sidebar_purchase.php';
require 'auth_functions.php';

checkAccess(requiredRole: 'Purchaser'); 

?>
<?php
if(isset($_POST['submit_img'])){
    $today = date("mdGis");
    $invoice_number = $today;
    $file_name = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];
    $folder = '../img_receipts/'.$file_name;

    $query = mysqli_query($conn, "INSERT INTO purchase_receipt(transaction_id, file) values('$invoice_number',  '$file_name')");
    if(move_uploaded_file($tempname, $folder)){
        echo "<h2>Purchase Receipt Uploaded successfully!!</h2>";
    } else{
        echo "<h2>File not Uploaded.</h2>";

    }
}

?>


<?php
  
  $sql = "select distinct PRODUCT_CODE from purcase_req where status = 'Purchase'";
  $result = mysqli_query($db, $sql);  
  $sql2 = "select distinct NAME from product order by NAME";
  $result2 = mysqli_query($db, $sql2);
  $sql3 = "select distinct CNAME from product order by CNAME";
  $result3 = mysqli_query($db, $sql3);
  $query = "select distinct COMPANY_NAME from supplier order by COMPANY_NAME";
  $results = mysqli_query($db, $query); 
        
?>

<h3>Add Purchase Product to Cart</h3>

      <!-- <form action="stockin_import.php" enctype="multipart/form-data" method="post">
          <input type="file" name="file" id="file" accept=".csv, .xls, .xlsx" class="form-control"  required >
          <button type="submit" class="btn btn-info mx-2 mt-2" name="submit">Import</button>
      </form> -->

<form id="addToCartForm" class="row g-3">
  <div class="col-md-2">
    <label for="product_id" class="form-label">Product Code</label>
    <select id="product_id" name="product_id" class="form-control form-select mySelect2" required>
       <option value="">--Select--</option>
          <?php
          while($row = mysqli_fetch_array($result)){
            $k = $row['PRODUCT_CODE'];
            echo '<option value="'.$k.'">'.$k.'</option>'; 
          }
        ?>
      </select>
  </div>
  <div class="col-md-2">
    <label for="product_name" class="form-label">Product Name</label>
    <input id="product_name" name="product_name" class="form-control">  
  </div>
  <div class="col-md-2">
    <label for="product_unit" class="form-label">Product Unit</label>
    <input id="product_unit" name="product_unit" class="form-control">  
  </div>
  <div class="col-md-2">
    <label for="inputEmail4" class="form-label">Quantity</label>
    <input id="quantity" name="quantity" class="form-control" >
  </div>
  <div class="col-md-2">
    <label for="price" class="form-label">Purchase Price</label>
    <input class = "form-control" name = "price" id="price"  required>
  </div>
  <div class="col-md-2">
    <label for="expired_date" class="form-label">Expired Date</label>
    <input type="date" class = "form-control" name = "expired_date" id="expired_date"  required>
  </div>
 
  <div class="col-md-2">
    <label for="inputPassword4" class="form-label">Tax Option</label>
    <select class = "form-control" id="vat" name="vat" aria-label="Default select example" required>
        <option value="0.02" class="text-red">With-hold</option>
        <option value="0.15" class="text-green">VAT</option>
        <option value="0" class="text-red">None</option>
    </select>
  </div>

  <div class="col-12 text-center py-3">
    <button type="submit" class="btn btn-primary">Add Item</button>
  </div>
</form>


<h3>Items in the Cart</h3>
<div class="table-responsive">
<table class="table table-bordered">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>VAT</th>
                <th>Total</th>
                <!-- <th>Expired Date</th> -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="cartItems">
            <tr>
                <td colspan="8">No items in cart</td>
            </tr>
        </tbody>
</table>
</div>
<h4>Grand Total ETB: <span id="grandTotal">0.00</span></h4>

<form id="checkout-form" action="stockin_transac.php" method="POST" class="row g-3">
<input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
  <!-- <div class="col-md-3">
    <label for="invoice_number" class="form-label">Invoice Number</label>
    <input type="number" class="form-control" id="invoice_number" name="invoice_number" for="invoice_number" required>
  </div> -->
  <div class="col-md-3">
    <label for="company_name" class="form-label">Company Name  
    </label>
    <select id="company_name" name="company_name" class= "form-control" required>
      <option value ="">--- Company Name ---</option>";
      <?php
        $query = "select COMPANY_NAME from supplier";
        $results = mysqli_query($db, $query);
        while ($row = mysqli_fetch_assoc($results)) {
          $company = $row['COMPANY_NAME'];
          echo "<option value='".$company."'>".$company."</option>";
        }
        ?>
    </select>
  </div>
  <div class="col-md-3">
    <label for="vendor_phone" class="form-label">Phone Number  
    </label>
    <input id="vendor_phone" name="vendor_phone" class= "form-control" required>
  </div>
  <div class="col-md-3">
    <label for="status" class="form-label">Purchase Method</label>
    <select class = "form-control" id="status" name = "status" required>
      <option value="Cash" class="text-red">Cash</option>
      <option value="Credit" class="text-red">Credit</option>
    </select>
  </div>
  <div class="col-md-3">
    <label for="bank" class="form-label">Bank</label>
    <select class = "form-control" name = "bank" aria-label="Default select example" required>
        <option value="">--Select Bank--</option>
        <option value="cbe">CBE</option>
        <option value="awash">Awash</option>
        <option value="amhara">Amhara</option>
        <option value="ahadu">Ahadu</option>
        <option value="abay">Abay</option>
        <option value="abyssinia">Abyssinia</option>
    </select>
  </div>
  <div class="col-12 text-center py-3">
    <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
  </div>
</form>
<div class="col-12">
<form action="" method="post" enctype="multipart/form-data">
    <h4>Upload the Receipt</h4>
    <input type="file" name="image" required>
    <button type="submit" name="submit_img">Upload</button>
</form>
</div>

<h3 class="py-4">Purchased Product List</h3>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card shadow mb-4">
            <!-- <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Add StockOut Products &nbsp;<a  href="#" data-toggle="modal" data-target="#stockOutModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div> -->
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        
                        <th>Category</th>
                        <th>Product Name</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                        <th>Purchase Date</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM stockin order by stockin_date DESC';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                        $TRANS_D_ID = $row['transac_id'];
                      echo '<tr>';
                      echo '<td>'. $row['category'].'</td>';
                      echo '<td>'. $row['pro_name'].'</td>';
                      echo '<td>'. $row['unit'].'</td>';
                      echo '<td>'. $row['quantity'].'</td>';
                      echo '<td>'. $row['price'].'</td>';
                      echo '<td>'. $row['subtotal'].'</td>';
                      echo '<td>'. $row['total'].'</td>';
                      echo '<td>'. $row['stockin_date'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary btn-sm" href="purchase_view.php?action=edit & id='.$TRANS_D_ID. '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                          </div> </td>';
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


      <script>
        function updateCart() {
            $.post('cart_backend.php', { action: 'get_cart' }, function (response) {
                if (response.status === 'success') {
                    let cartItems = response.cart;
                    let cartHTML = '';
                    let grandTotal = 0;

                    cartItems.forEach((item, index) => {
                        grandTotal += item.total;
                        cartHTML += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.product_id}</td>
                                <td>${item.product_name}</td>
                                <td>
                                    <button onclick="updateQuantity('${item.product_id}', -1)">-</button>
                                    ${item.quantity}
                                    <button onclick="updateQuantity('${item.product_id}', 1)">+</button>
                                </td>
                                <td>${item.price.toFixed(2)}</td>
                                <td>${item.subtotal.toFixed(2)}</td>
                                <td>${item.vat.toFixed(2)}</td>
                                <td>${item.total.toFixed(2)}</td>
                                <td><button onclick="removeItem('${item.product_id}')" class="btn btn-sm btn-danger">Remove</button></td>
                            </tr>
                        `;
                    });

                    $('#cartItems').html(cartHTML || '<tr><td colspan="8">No items in cart</td></tr>');
                    $('#grandTotal').text(grandTotal.toFixed(2));
                }
            }, 'json');
        }

        function updateQuantity(productId, change) {
            $.post('cart_backend.php', { action: 'update_quantity', product_id: productId, change: change }, function () {
                updateCart();
            });
        }

        function removeItem(productId) {
            $.post('cart_backend.php', { action: 'remove_item', product_id: productId }, function () {
                updateCart();
            });
        }

        $('#addToCartForm').on('submit', function (e) {
            e.preventDefault();
            const data = $(this).serialize() + '&action=add_to_cart';
            $.post('cart_backend.php', data, function () {
                updateCart();
                $('#addToCartForm')[0].reset();
            });
        });

        $(document).ready(function () {
            updateCart();
        });

        // fetching products name based on the product code automatically
        $(document).ready(function () {
            $('#product_id').on('input', function () {
                const product_id = $(this).val();

                if (product_id) {
                    $.ajax({
                        url: 'get_product_name.php',
                        type: 'POST',
                        data: { product_id: product_id },
                        success: function (response) {
                            $('#product_name').val(response);
                        },
                        error: function () {
                            alert('Error fetching product name.');
                        }
                    });
                } else {
                    $('#product_name').val('');
                }
            });
        });

        // fetching products unit based on the product code automatically
        $(document).ready(function () {
            $('#product_id').on('input', function () {
                const product_id = $(this).val();

                if (product_id) {
                    $.ajax({
                        url: 'get_product_unit.php',
                        type: 'POST',
                        data: { product_id: product_id },
                        success: function (response) {
                            $('#product_unit').val(response);
                        },
                        error: function () {
                            alert('Error fetching product unit.');
                        }
                    });
                } else {
                    $('#product_unit').val('');
                }
            });
        });
         // fetching products quantity based on the product code automatically
         $(document).ready(function () {
            $('#product_id').on('input', function () {
                const product_id = $(this).val();

                if (product_id) {
                    $.ajax({
                        url: 'get_product_qty.php',
                        type: 'POST',
                        data: { product_id: product_id },
                        success: function (response) {
                            $('#quantity').val(response);
                        },
                        error: function () {
                            alert('Error fetching product unit.');
                        }
                    });
                } else {
                    $('#quantity').val('');
                }
            });
        });
        // fetching vendors phone based on the product code automatically
        $(document).ready(function () {
            $('#company_name').on('input', function () {
                const company_name = $(this).val();

                if (company_name) {
                    $.ajax({
                        url: 'get_vendor_phone.php',
                        type: 'POST',
                        data: { company_name: company_name },
                        success: function (response) {
                            $('#vendor_phone').val(response);
                        },
                        error: function () {
                            alert('Error fetching vendor_phone.');
                        }
                    });
                } else {
                    $('#vendor_phone').val('');
                }
            });
        });
  </script>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <?php include '../includes/script.php'?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    

        <script>
          $(document).ready(function() {
            $('.mySelect2').select2();
          });
        </script>

  <script>

new DataTable('#dataTable', {
    layout: {
        topStart: {
            buttons: ['excel','print']
        }
    }
});
  </script>

<?php
  include '../includes/footer2.php';
?>