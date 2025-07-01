<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

?>
<style>
  th, td{
    text-align: left !important;
  }
</style>
<div>
<h4>Generate Abay Bank Transaction Report</h4>
</div>
<div class="card-body">
            <form action="" method="GET">
              <div class="row">         
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">From Date</label>
                    <input type="date" name="from_date" class="form-control" required/>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">To Date</label>
                    <input type="date" name="to_date" class="form-control" required/>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Click to Filter</label><br />
                    <button type="submit" class="btn btn-primary">Filter</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          
        <div class="card mt-3">
          <div class="card-body">
          <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Transaction Date</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Description</th>
                      </tr>
                  </thead>
                  <tbody >
            <?php
              if(isset($_GET['from_date']) && isset($_GET['to_date'])){
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];

                $query = "select * from abay_bank_account where transaction_date BETWEEN '$from_date' AND '$to_date'";
                $query_run = mysqli_query($db, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $row){
                      echo '<tr>';
                      echo '<td>'. $row['transaction_date'].'</td>';
                      echo '<td>'. $row['transaction_id'].'</td>';
                      echo '<td>'. $row['balance'].'</td>';
                      echo '<td>'. $row['description'].'</td>';
                      echo '</tr> ';
                  }
                }else{
                  echo "No Record Found!";
                }
              }
            ?>
                  </tbody>
                </table>
              </div>
            
          </div>
        </div>
        <script src="script.js"></script>
        <?php include '../includes/script.php'?>
<script>

new DataTable('#dataTable', {
    layout: {
        bottomStart: {
            buttons: ['excel','print']
        }
    }
});

</script>


<?php
include'../includes/footer2.php';
?>


