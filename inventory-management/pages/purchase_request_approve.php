<?php
include '../includes/connection.php';
include '../includes/sidebar_acc.php';
require 'auth_functions.php';
checkAccess('Accountant'); 

?>
<h3>Approve Purchase Request</h3>
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
                        <th>Requested Date</th>
                        <th>Requested By</th>
                        <th>Product Category</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Purchase Price</th>
                        <th>Subtotal</th>
                        <th>VAT</th>
                        <th>Total</th>
                        <th>Method</th>
                        <th>Request Status</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM stockin_request where req_status = "Pending" or req_status = "Rejected" order by stockin_date DESC';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                      echo '<tr>';
                      echo '<td>'. $row['stockin_date'].'</td>';
                      echo '<td>'. $row['employee'].'</td>';
                      echo '<td>'. $row['category'].'</td>';
                      echo '<td>'. $row['pro_code'].'</td>';
                      echo '<td>'. $row['pro_name'].'</td>';
                      echo '<td>'. $row['unit'].'</td>';
                      echo '<td>'. $row['quantity'].'</td>';
                      echo '<td>'. $row['price'].'</td>';
                      echo '<td>'. $row['subtotal'].'</td>';
                      echo '<td>'. $row['vat'].'</td>';
                      echo '<td>'. $row['total'].'</td>';
                      echo '<td>'. $row['purchase_method'].'</td>';
                      echo '<td>'. $row['req_status'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <button type="submit" class="btn btn-success bg-gradient-success btn-sm">
                              <a href="stockin_transac_approve.php?purapp='.$id.'">Approve</a>
                              </button>
                              <button type="submit" class="btn btn-danger bg-gradient-danger btn-sm">
                              <a href="stockin_transac_reject.php?purrej='.$id.'">Reject</a>
                              </button>
                          </div> </td>';
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <?php include '../includes/script.php'?>
    
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
