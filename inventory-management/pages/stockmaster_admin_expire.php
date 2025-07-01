<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

?>
            
            <!-- Begin Page Content -->
        <div class="container-fluid">
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Products Expired Soon</h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Category</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Batch</th>
                        <!-- <th>Remaining Date</th> -->
                      </tr>
                  </thead>
                  <tbody>
                  <?php   
                    
                      $query = "SELECT *, 
                                  COUNT(*) AS total_expiring_soon
                              FROM 
                                  stockin
                              WHERE 
                                  DATEDIFF(expired_date, CURDATE()) < 30 and quantity > 0
                              GROUP BY 
                                  pro_name";
                      $result_in = mysqli_query($db, $query) or die (mysqli_error($db));
                      while ($row = mysqli_fetch_assoc($result_in)) {
                      echo '<tr>';
                      echo '<td>'. $row['category'].'</td>';
                      echo '<td>'. $row['pro_code'].'</td>';
                      echo '<td>'. $row['pro_name'].'</td>';
                      echo '<td>'. $row['total_expiring_soon'].'</td>';
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