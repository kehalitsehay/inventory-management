<?php
include '../includes/connection.php';
include '../includes/sidebar_acc.php';
require 'auth_functions.php';

checkAccess('Accountant'); 

?>

<?php
  
  $sql = "select distinct PRODUCT_CODE from product";
  $result = mysqli_query($db, $sql);  
  $sql2 = "select distinct NAME from product order by NAME";
  $result2 = mysqli_query($db, $sql2);
  $sql3 = "select distinct CNAME from product order by CNAME";
  $result3 = mysqli_query($db, $sql3);
  $query = "select distinct FIRST_NAME, LAST_NAME from customer order by FIRST_NAME";
  $results = mysqli_query($db, $query);
        
        
?>

<h3>Add sales product</h3>

            
<form class="row g-3" method="POST" action="stockout_transac.php?action=add" role="form">
<input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
<input type="hidden" name="role" value="<?php echo $_SESSION['JOB_TITLE']; ?>">
  <div class="col-md-3">
    <label for="inputEmail4" class="form-label">Transaction ID</label>
    <input type="number" class="form-control" name="transac_id" for="inputEmail4" required>
  </div>
  <div class="col-md-3">
    <label for="inputEmail4" class="form-label">Customer Name</label>
    <select name="customer" class= "form-control" >
      <option value ="">---Select---</option>";
      <?php
        while ($row = mysqli_fetch_assoc($results)) {
          $customer = $row['CUSTOMER_NAME'];
          echo "<option value='".$row['FIRST_NAME']." ".$row['LAST_NAME']."'>".$row['FIRST_NAME'].'- '.$row['LAST_NAME']."</option>";
        }
        ?>
    </select>
  </div>
  
  <div class="col-md-3">
    <label for="prodcode" class="form-label">Product Code</label>
    <select name="prodcode" id="prodcode" class="form-control form-select mySelect2" required>
       <option value="">--Select--</option>
          <?php
          while($row = mysqli_fetch_array($result)){
            $k = $row['PRODUCT_CODE'];
            echo '<option value="'.$k.'">'.$k.'</option>'; 
          }
        ?>
        
      </select>
  </div>
  <div class="col-md-3">
    <label for="sales_price" class="form-label">Sales Price</label>
    <select class = "form-control" name = "sales_price" id="sales_price" aria-label="Default select example" required>
    <option value="">Select Price</option>
    </select>
  </div>
 <div class="col-md-3 pt-3">
    <label for="inputEmail4" class="form-label">Quantity</label>
    <input type="number"  min="1" max="999999999" class="form-control"  name="quantity" step ="any" required>
  <div class="col-md-3 pt-3">
    <label for="inputPassword4" class="form-label">Tax Option</label>
    <select class = "form-control" name = "vat" aria-label="Default select example" required>
        <option value="">--Select Tax Option--</option>
        <option value="0.15" class="text-green">VAT</option>
        <option value="0.02" class="text-red">With-hold</option>
        <option value="1" class="text-red">None</option>
    </select>
  </div>
  <div class="col-md-3 pt-3">
    <label for="inputPassword4" class="form-label">Sales Method</label>
    <select class = "form-control" name = "status" aria-label="Default select example" required>
      <option value="Cash" class="text-red">Cash</option>
      <option value="Credit" class="text-red">Credit</option>
    </select>
  </div>
  <div class="col-md-3 pt-3">
    <label for="bank" class="form-label">Bank</label>
    <select class = "form-control" name = "bank" aria-label="Default select example" required>
        <option value="">--Select Bank--</option>
        <option value="cbe" class="text-green">CBE</option>
        <option value="awash" class="text-red">Awash</option>
        <option value="amhara" class="text-red">Amhara</option>
        <option value="ahadu" class="text-red">Ahadu</option>
        <option value="abay" class="text-red">Abay</option>
        <option value="abyssinia" class="text-red">Abyssinia</option>
    </select>
  </div>

  <div class="col-12 text-center py-3">
    <button type="submit" class="btn btn-primary">Add Sales</button>
  </div>
</form>

<h3>Sold products list</h3>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card shadow mb-4">
                     
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Total</th>
                        <th>Sales Date</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM stockout order by stockout_date DESC';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                        $TRANS_D_ID = $row['transac_id'];
                      echo '<tr>';
                      echo '<td>'. $row['pro_name'].'</td>';
                      echo '<td>'. $row['category'].'</td>';
                      echo '<td>'. $row['unit'].'</td>';
                      echo '<td>'. $row['quantity'].'</td>';
                      echo '<td>'. $row['sale_price'].'</td>';
                      echo '<td>'. $row['subtotal'].'</td>';
                      echo '<td>'. $row['total'].'</td>';
                      echo '<td>'. $row['stockout_date'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary btn-sm" href="sales_view.php?action=edit & id='.$TRANS_D_ID. '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
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
      $(document).ready(function() {
            $('#prodcode').change(function() {
                let productCode = $(this).val();

                if (productCode) {
                    // Send AJAX request to fetch sales prices
                    $.ajax({
                        url: 'get_product_prices.php',
                        type: 'GET',
                        data: { prodcode: productCode },
                        dataType: 'json',
                        success: function(response) {
                            if (response.error) {
                                alert(response.error);
                                $('#sales_price').html('<option value="">Select Price</option>');
                            } else {
                                // Populate the sales price dropdown
                                $('#sales_price').html(`
                                    <option value="${response.sales_price1}">Price 1: ${response.sales_price1}</option>
                                    <option value="${response.sales_price2}">Price 2: ${response.sales_price2}</option>
                                    <option value="${response.sales_price3}">Price 3: ${response.sales_price3}</option>
                                `);
                            }
                        },
                        error: function() {
                            alert('An error occurred while fetching data.');
                        }
                    });
                } else {
                    $('#sales_price').html('<option value="">Select Price</option>');
                }
            });
        });
    </script>
  <!-- important scripts -->
    <?php include '../includes/script.php'?>

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
include'../includes/footer2.php';
?>