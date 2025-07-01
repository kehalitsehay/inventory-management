<?php
include'../includes/connection.php';
include'../includes/sidebar_store.php';
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
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>StockIn</th>
                        <th>StockOut</th>
                        <th>Available in Stock</th>
                        <th>Request Suggestion</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query_in = 'SELECT *, SUM(quantity) AS total FROM stockin GROUP BY pro_name';
                      $result_in = mysqli_query($db, $query_in) or die (mysqli_error($db));

                      $query_out = 'SELECT *,  SUM(quantity) AS total FROM stockout GROUP BY pro_name';
                      $result_out = mysqli_query($db, $query_out);
                      // $row_out = mysqli_fetch_assoc($result_out);

                      while ($row = mysqli_fetch_assoc($result_in)) {
                        $row_out = mysqli_fetch_assoc($result_out);
                        $def = $row['total'] - $row_out['total'];
                      echo '<tr>';
                      echo '<td>'. $row['pro_code'].'</td>';
                      echo '<td>'. $row['pro_name'].'</td>';
                      echo '<td>'. $row['category'].'</td>';
                      echo '<td>'. $row['total'].'</td>';
                      echo '<td>'. $row_out['total'].'</td>';
                      echo '<td>'. $row['total'] - $row_out['total'].'</td>';
                      if($def > 10){
                        echo '<td>'.'<a type="button" class="btn btn-info bg-gradient-info btn-sm" href="#"> Available</a>'.'</td';
                      }
                      else{
                        echo '<td>'.'<a type="button" class="btn btn-danger bg-gradient-danger btn-sm" href="requ_common_s.php"> Place Order</a>'.'     
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
