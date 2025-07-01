<?php
include '../includes/connection.php';
include '../includes/sidebar_acc.php';
require 'auth_functions.php';

checkAccess('Accountant'); 

?>
<h3>Approve Expense Request</h3>
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
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM expense where status = "Pending" order by date DESC';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                        $expense_id = $row['expense_id'];
                      echo '<tr>';
                      echo '<td>'. $row['date'].'</td>';
                      echo '<td>'. $row['requested_by'].'</td>';
                      echo '<td>'. $row['category'].'</td>';
                      echo '<td>'. $row['amount'].'</td>';
                      echo '<td>'. $row['description'].'</td>';
                      echo '<td>'. $row['status'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <button type="submit" class="btn btn-success bg-gradient-success btn-sm">
                              <a href="expense_transac_approve.php?exapp='.$expense_id.'">Approve</a>
                              </button>
                              <button type="submit" class="btn btn-danger bg-gradient-danger btn-sm">
                              <a href="expense_transac_reject.php?exrej='.$expense_id.'">Reject</a>
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
