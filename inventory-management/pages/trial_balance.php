<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>
<p>Select the period to generate trial balance sheet</p>
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

<div class="mx-4 mb-5 text-center">
<h4>Maedot Hypermarket </h4>
<h4>Trial Balance Report</h4>
<h5>For the period <?php $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : 0; echo $from_date ?> to <?php $to_date = isset($_GET['to_date']) ? $_GET['from_date'] : 0; echo $to_date ?> </h5>
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
                        <th>Account Name</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(isset($_GET['from_date']) && isset($_GET['to_date'])){
                        $from_date = $_GET['from_date'];
                        $to_date = $_GET['to_date'];
                        $query = "SELECT *, SUM(debit) as sum_debit, SUM(credit) as sum_credit FROM transaction where date between '$from_date' AND '$to_date' group by account_name";
                        $result = mysqli_query($db, $query) or die(mysqli_error($db));
                        
                        if(mysqli_num_rows($result) > 0){
                          foreach($result as $row){
                            $sum_debit = $row['sum_debit'];
                            $sum_credit = $row['sum_credit'];
                            $balance = $sum_debit - $sum_credit;
                            echo '<tr>';
                            echo '<td>'. $row['account_name'].'</td>';
                            echo '<td>'. $sum_debit.'</td>';
                            echo '<td>'. $sum_credit.'</td>';
                            echo '<td>'. $balance.'</td>';
                            echo '</tr> ';
                          }
                        }else{
                          echo "No data found";
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

