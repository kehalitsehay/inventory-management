<?php
include'../includes/connection.php';
include'../includes/sidebar_puradmin.php';
?>

          
        <div class="container-fluid">

            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Approve Purchase Payment</h4>
            </div>
      
      <?php 
      $purhase_requ = "SELECT * FROM purcase_req where STATUS = 'Approved'";
      $purhase_requ = mysqli_query($db, $purhase_requ);
      ?>
      
<div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
        
                      while ($row = mysqli_fetch_array($purhase_requ)) {

                      echo '<tr>';
                      echo '<td>'. $row['PRODUCT_CODE'].'</td>';
                      echo '<td>'. $row['NAME'].'</td>';
                      echo '<td>'. $row['CATEGORY'].'</td>';
                      echo '<td>'. $row['QUANTITY'].'</td>';
                      echo '<td>'. $row['UNIT'].'</td>';
                      echo '<td>'. $row['DATE'].'</td>';
                      echo '<td>'. $row['STATUS'].'</td>';
                      $pro_id = $row['ID'];

                      echo '<td align="center">
                            <div class="btn-group">
                            
                            <button type="submit" name = "reject" class="btn btn-success btn-sm" ><a href="purchaseAdmin_approve.php?purchaseapp='.$pro_id.'" class="text-light">Purchase</a></button> 
                            <button type="submit" name = "reject" class="btn btn-danger btn-sm" ><a href="purchaseAdmin_reject.php?purchaserej='.$pro_id.'" class="text-light">Reject</a></button>
                              
                            </div>
                         </td>';
                      echo '</tr> ';
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
        topStart: {
            buttons: ['excel','print']
        }
    }
});

</script>
<?php
include'../includes/footer2.php';
?>



