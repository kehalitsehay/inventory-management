<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

?>
<div>
<h4>Generate Sales Report</h4>
</div>
<div class="card-body">
            <form action="" method="GET">
              <div class="row">         
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="from_date">From Date</label>
                    <input type="date" name="from_date" class="form-control" required/>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="to_date">To Date</label>
                    <input type="date" name="to_date" class="form-control" required/>
                  </div>
                </div>
                <!-- <div class="col-md-3">
                  <div class="form-group">
                    <label for="store">Slect Store</label>
                    <select name="store" class="form-control" >
                    <option value="">--Select--</option>
                    <option value="Store 1">Store 1</option>
                    <option value="Store 2">Store 2</option>
                    </select>
                  </div>
                </div> -->
                <div class="col-md-3">
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
                        <th>Sales Date</th>
                        <th>TransID</th>
                        <th>Pro Code</th>
                        <th>Pro Name</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Qty</th>
                        <th>Sale Price</th>
                        <th>Sub Total</th>
                        <th>VAT</th>
                        <th>Grand</th>
                        <th>Profit</th>
                        <th>From Store</th>
                        <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>


            <?php
              if(isset($_GET['from_date']) && isset($_GET['to_date'])){
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];
                // $store = $_GET['store'];

                $query = "select * from sales
                 where DATE BETWEEN '$from_date' AND '$to_date'
                 ";
                $query_run = mysqli_query($db, $query);
                if(mysqli_num_rows($query_run) > 0){
                  foreach($query_run as $row){
                      echo '<tr>';
                      echo '<td>'. $row['DATE'].'</td>';
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
                      echo '<td>'. $row['store'].'</td>';
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
    <?php include '../includes/script.php' ?>
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


