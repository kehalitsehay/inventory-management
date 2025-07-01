<?php
include '../includes/connection.php';
include '../includes/sidebar.php';
require 'auth_functions.php';

checkAccess('Admin'); 

?>

<?php
  
  $sql = "select distinct pro_code from stockin where quantity > 0";
  $result = mysqli_query($db, $sql);  
  $sql2 = "select distinct pro_name from stockin order by pro_name";
  $result2 = mysqli_query($db, $sql2);
  $sql3 = "select distinct category from stockin order by category";
  $result3 = mysqli_query($db, $sql3);
  $query = "select distinct FIRST_NAME, LAST_NAME from customer order by FIRST_NAME";
  $results = mysqli_query($db, $query);
        
        
?>

<h3>Add Items to be Moved to Store 2</h3>

<form id="addToCartForm" class="row g-3">
  <div class="col-md-2">
    <label for="product_id" class="form-label">Product Code</label>
    <select id="product_id" name="product_id" class="form-control form-select mySelect2" required>
       <option value="">--Select--</option>
          <?php
          while($row = mysqli_fetch_array($result)){
            $k = $row['pro_code'];
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
    <label for="quantity" class="form-label">Quantity</label>
    <input type="number"  min="1" max="999999999" class="form-control"  id="quantity" name="quantity" step ="any" required>
  </div>
  <div class="col-md-2">
    <label for="price" class="form-label">Purchase Price</label>
    <input type ="number" step ="any" class = "form-control" name = "price" id="price" required>
  </div>
  <div class="col-md-2">
    <label for="inputPassword4" class="form-label">Tax Option</label>
    <select class = "form-control" id="vat" name="vat" required>
        <option value="0.15" class="text-green">VAT</option>
        <option value="0.02" class="text-red">With-hold</option>
        <option value="0" class="text-red">None</option>
    </select>
  </div>
  <div class="col-12 text-center py-3">
    <button type="submit" class="btn btn-primary">Add Item</button>
  </div>
</form>


<h3>Items to be Moved</h3>
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="cartItems">
            <tr>
                <td colspan="8">No items added</td>
            </tr>
        </tbody>
</table>
</div>

<form id="checkout-form" action="move_transaction.php" method="POST" class="row g-3">
<input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
  <div class="col-12 text-center py-3">
    <button type="submit" class="btn btn-primary">Add to Store 2</button>
  </div>
</form>

<h3>Products moved from Store one to Store two </h3>
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
                        <th>VAT</th>
                        <th>Total</th>
                        <th>Stockin Date</th>
                        <!-- <th>Action</th> -->
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM stockin2 order by stockin_date DESC';
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
                      echo '<td>'. $row['vat'].'</td>';
                      echo '<td>'. $row['total'].'</td>';
                      echo '<td>'. $row['stockin_date'].'</td>';
                      // echo '<td align="right"> <div class="btn-group">
                      //         <a type="button" class="btn btn-primary bg-gradient-primary btn-sm" href="sales_view.php?action=edit & id='.$TRANS_D_ID. '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                      //     </div> </td>';
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

<?php
  include '../includes/footer2.php';
?>
      <script>
        function updateCart() {
            $.post('move_backend.php', { action: 'get_cart' }, function (response) {
                if (response.status === 'success') {
                    let cartItems = response.cart;
                    let cartHTML = '';


                    cartItems.forEach((item, index) => {
                        
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

                    $('#cartItems').html(cartHTML || '<tr><td colspan="8">No items added</td></tr>');
                }
            }, 'json');
        }

        function updateQuantity(productId, change) {
            $.post('move_backend.php', { action: 'update_quantity', product_id: productId, change: change }, function () {
                updateCart();
            });
        }

        function removeItem(productId) {
            $.post('move_backend.php', { action: 'remove_item', product_id: productId }, function () {
                updateCart();
            });
        }

        $('#addToCartForm').on('submit', function (e) {
            e.preventDefault();
            const data = $(this).serialize() + '&action=add_to_cart';
            $.post('move_backend.php', data, function () {
                updateCart();
                $('#addToCartForm')[0].reset();
            });
        });

        $(document).ready(function () {
            updateCart();
        });
    </script>
  <script>
      // fetching products price based on the product code automatically
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

