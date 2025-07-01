<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

?>
            
            <!-- Begin Page Content -->
        <div class="container-fluid">
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Stock Master</h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Category</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Request Suggestion</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php   
                    
                    function dateDiffUsingDateTime($date1, $date2) {
                      $datetime1 = new DateTime($date1);
                      $datetime2 = new DateTime($date2);
                  
                      $interval = $datetime1->diff($datetime2);
                  
                      return $interval->days;
                  }

                    $today = date('Y-m-d');
                  

                      $query_in = "SELECT *, SUM(quantity) as total_quantity FROM stockin where quantity > 0 group by pro_name";
                      $result_in = mysqli_query($db, $query_in) or die (mysqli_error($db));

                      while ($row = mysqli_fetch_assoc($result_in)) {
                        $expire = $row['expired_date'];
                        $dateDiff = dateDiffUsingDateTime($today, $expire);
                      echo '<tr>';
                      echo '<td>'. $row['category'].'</td>';
                      echo '<td>'. $row['pro_code'].'</td>';
                      echo '<td>'. $row['pro_name'].'</td>';
                      echo '<td>'. $row['total_quantity'].'</td>';
                      if($row['total_quantity'] > 10){
                        echo '<td>'.'<a type="button" class="btn btn-info bg-gradient-info btn-sm" href="#"> Available</a>'.'</td';
                      }
                      else{
                        echo '<td>'.'<a type="button" class="btn btn-danger bg-gradient-danger btn-sm" href="requ_admin.php"> Place Order</a>'.'     
                          </td>';
                      }
                      
                      echo '</tr> ';
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