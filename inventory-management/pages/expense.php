<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

?>

<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Add Expenses &nbsp;<a  href="#" data-toggle="modal" data-target="#expenseModal" type="button" class="btn btn-primary bg-gradient-info" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        
                        <th>Date</th>
                        <!-- <th>S/N</th> -->
                        <th>Requested By</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Request Status</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM expense ORDER BY DATE';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['expense_id'];
                      echo '<tr>';
                      echo '<td>'. $row['date'].'</td>';
                      // echo '<td>'. $row['expense_id'].'</td>';
                      echo '<td>'. $row['requested_by'].'</td>';
                      echo '<td>'. $row['amount'].'</td>';
                      echo '<td>'. $row['description'].'</td>';
                      echo '<td>'. $row['status'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary btn-sm" href="expense_form.php?action=edit & id='.$id. '"><i class="fas fa-fw fa-list-alt"></i> View </a>
                          </div> </td>';
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


    <script src="script.js"></script>
    <!-- important scripts -->
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



