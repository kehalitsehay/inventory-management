<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>

<div>
<h4 class="mx-4">Generate Journal Report</h4>
</div>

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
                        
                        <th>Date</th>
                        <th>Account Name</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Description</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM transaction order by date DESC';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['date'].'</td>';
                      echo '<td>'. $row['account_name'].'</td>';
                      echo '<td>'. $row['debit'].'</td>';
                      echo '<td>'. $row['credit'].'</td>';
                      echo '<td>'. $row['description'].'</td>';
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
<!-- <div class="card-body">
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
  </div> -->
          
        <!-- <div class="card mt-3">
          <div class="card-body">
          <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Transaction Date</th>
                        <th>Account Name</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Description</th>
                      </tr>
                  </thead>
                  <tbody>


            <?php
              if(isset($_GET['from_date']) && isset($_GET['to_date'])){
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];
            
                $query = "select * from transaction where DATE BETWEEN '$from_date' AND '$to_date'";
                $query_run = mysqli_query($db, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $row){
                      echo '<tr>';
                      echo '<td>'. $row['date'].'</td>';
                      echo '<td>'. $row['account_name'].'</td>';
                      echo '<td>'. $row['debit'].'</td>';
                      echo '<td>'. $row['credit'].'</td>';
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
        </div> -->
    <script src="script.js"></script>
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

