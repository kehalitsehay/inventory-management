<?php
include '../includes/connection.php';
include '../includes/sidebar_acc.php';
require 'auth_functions.php';

checkAccess('Accountant'); 

?>
<h3>Approve Payment for Vendor Credit </h3>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Requested Date</th>
                        <th>Requested By</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Bank</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM vendor_request where status = "Pending" order by date DESC';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                      echo '<tr>';
                      echo '<td>'. $row['date'].'</td>';
                      echo '<td>'. $row['employee'].'</td>';
                      echo '<td>'. $row['transaction_id'].'</td>';
                      echo '<td>'. $row['amount'].'</td>';
                      echo '<td>'. $row['bank'].'</td>';
                      echo '<td>'. $row['description'].'</td>';
                      echo '<td>'. $row['status'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <button type="submit" class="btn btn-success bg-gradient-success btn-sm">
                              <a href="vendor_deposit_transaction _approve.php?venapp='.$id.'">Approve</a>
                              </button>
                              <button type="submit" class="btn btn-danger bg-gradient-danger btn-sm">
                              <a href="vendor_deposit_transaction_reject.php?venrej='.$id.'">Reject</a>
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
