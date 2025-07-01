<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>


<h4 class="mx-4">Purchase Receipt Report</h4>

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
            <form action="" method="POST" enctype="multipart/form-data">
          <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Transaction Date</th>
                        <th>Transaction ID</th>
                        <th>Receipt</th>
                      </tr>
                  </thead>
                  <tbody>
            <?php
              if(isset($_GET['from_date']) && isset($_GET['to_date'])){
                $from_date = $_GET['from_date'];
                $to_date = $_GET['to_date'];
              
                $query = "select * from purchase_receipt where DATE BETWEEN '$from_date' AND '$to_date'";
                $query_run = mysqli_query($db, $query);
                
                while($row = mysqli_fetch_assoc($query_run)){
                  ?>
                  <tr>
                    <td><?php echo $row['date']?></td>
                    <td><?php echo $row['transaction_id']?></td>
                    <td><?php echo '<img src="../img_receipts/'.$row['file'].'" style="width: 100%">' ?></td>
                  </tr>
                  <?php
                }
              }
            ?>
                  </tbody>
                </table>
              </div>
              </form>
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

