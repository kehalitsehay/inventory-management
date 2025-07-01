<?php
include'../includes/connection.php';
include'../includes/sidebar_acc.php';
?>
        <div>       
          <h4 class="mx-4">Generate Sales Report</h4>
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
                        <th>Transaction ID</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Purchase Price</th>
                        
                        <th>Sub Total</th>
                        <th>VAT</th>
                        <th>Grand</th>
                        <th>Profit</th>
                        <th width="10%">Sales Date</th>
                        <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>


            <?php
              if(isset($_GET['from_date']) && isset($_GET['to_date'])){
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];

                $query = "select * from sales where DATE BETWEEN '$from_date' AND '$to_date'";
                $query_run = mysqli_query($db, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $row){
                      echo '<tr>';
                      echo '<td>'. $row['transac_id'].'</td>';
                      echo '<td>'. $row['PRODUCT_CODE'].'</td>';
                      echo '<td>'. $row['NAME'].'</td>';
                      echo '<td>'. $row['CATEGORY'].'</td>';
                      echo '<td>'. $row['UNIT'].'</td>';
                      echo '<td>'. $row['QUANTITY'].'</td>';
                      echo '<td>'. $row['PRICE'].'</td>';
                      echo '<td>'. $row['SUBTOTAL'].'</td>';
                      echo '<td>'. $row['VAT'].'</td>';
                      echo '<td>'. $row['TOTAL'].'</td>';
                      echo '<td>'. $row['profit'].'</td>';
                      echo '<td>'. $row['DATE'].'</td>';
                      echo '<td>'. $row['STATUS'].'</td>';
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
        topStart: {
            buttons: ['excel','print']
        }
    }
});

</script>


<?php
include'../includes/footer2.php';
?>


