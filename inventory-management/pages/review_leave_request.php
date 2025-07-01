<?php
include '../includes/connection.php';
include '../includes/sidebar.php';
?>      
            <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Approve Leave Request</h4>
            </div>
      
      <?php 
      $leave_requ = "SELECT * FROM leave_requests where status = 'pending' ";
      $leave_requ = mysqli_query($db, $leave_requ);
      ?>
      
<div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                          <th>Employee ID</th>
                          <th>Leave Type</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
        
                      while ($row = mysqli_fetch_array($leave_requ)) {

                        echo '<tr>';
                        echo '<td>'.$row['employee_id'].'</td>';
                        echo '<td>'. $row['leave_type'].'</td>';
                        echo '<td>'. $row['start_date'].'</td>';
                        echo '<td>'. $row['end_date'].'</td>';
                        echo '<td>'.$row['status'].'</td>';

                        $leave_id = $row['leave_id'];
                        echo '<td align="center">
                            <div class="btn-group">
                            
                              <button type="submit" name = "reject" class="btn btn-success btn-sm" ><a href="leave_request_aprove.php?approveid='.$leave_id.'" class="text-light">Approve</a></button>
                              <button type="submit" name = "reject" class="btn btn-danger btn-sm" ><a href="leave_request_reject.php?rejectid='.$leave_id.'" class="text-light">Reject</a></button>
                              
                            </div>
                         </td>';
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>


          
    <script src="script.js"></script>
    <script src="../js1/jquery.js"></script>
    <script src="../js1/dataTables.js"></script>
    <script src="../js1/dataTableButton.js"></script>
    <script src="../js1/buttonDataTable.js"></script>
    <script src="../js1/jszip.js"></script>
    <script src="../js1/pdfmake.js"></script>
    <script src="../js1/pdfmakefont..js"></script>
    <script src="../js1/buttonhtml.js"></script>
    <script src="../js1/buttonprint.js"></script>
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



<?php
include'../includes/footer.php';
?>



