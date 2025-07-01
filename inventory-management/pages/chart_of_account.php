<?php
include '../includes/connection.php';
include '../includes/sidebar.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){
  $query = "UPDATE chart_of_account set current_balance = 0";
  mysqli_query($conn, $query) or die(mysqli_error($conn));
}
?>  
<form action="" method="POST">
  <button type ="submit">Rest</button>
</form>

            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"> Chart of Accounting&nbsp;<a  href="#" data-toggle="modal" data-target="#chartofAccModal" type="button" class="btn btn-primary bg-gradient-info" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            <!-- <h4>Beginning Balance</h4>
            <form action="" class="row-g-3">
              <div col-md-2>
              <input type="number" class="form-control" name="cash_on_hand" id="cash_on_hand" placeholder="Cash on Hand" required>
              </div>
            </form> -->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th>Account Code</th>
                     <th>Description</th>
                     <th>Sub Category</th>
                     <th>Account Type</th>
                     <th>Balance</th>
                     <th>Action</th>
                   </tr>
               </thead>
          <tbody>

<?php                  
    $query = 'SELECT * FROM chart_of_account GROUP BY account_code';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {                 
                echo '<tr>';
                echo '<td style="text-align: left;">'. $row['account_code'].'</td>';
                echo '<td style="text-align: left;">'. $row['account_name'].'</td>';
                echo '<td style="text-align: left;">'. $row['sub_account'].'</td>';
                echo '<td>'. $row['account_category'].'</td>';
                echo '<td>'. $row['current_balance'].'</td>';
                echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-info btn-sm" href="account_edit.php?action=edit & id='.$row['account_code']. '"> 
                              <i class="fas fa-fw fa-edit"></i>
                              Edit
                              </a>
                            
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

  <!-- Chart of Account  Modal-->
  <div class="modal fade" id="chartofAccModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Chart of Accounting</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="chart_transac.php?action=add">
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Account Code" name="account_code" required>
           </div>
           <div class="form-group">
           <input type="text" class="form-control" placeholder="Account Name" name="account_name" required>
           </div>
           <div class="form-group">
           <input type="text" class="form-control" placeholder="Sub Account" name="sub_account" required>
           </div>
           <div class="form-group">
            <input type="text" class="form-control" placeholder="Account Category" name="account_category" required>
           </div>
           <div class="form-group">
            <input type="text" class="form-control" placeholder="Beginning Balance" name="balance" required>
           </div>
             <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>