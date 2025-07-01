<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

?>
            
            <!-- Begin Page Content -->
        <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Sales Product &nbsp;</h4>
            </div>
            
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
                        <th>Sale Price</th>
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
                      $query = 'SELECT * FROM sales';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));

                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['TRANS_ID'].'</td>';
                      echo '<td>'. $row['PRODUCT_CODE'].'</td>';
                      echo '<td>'. $row['NAME'].'</td>';
                      echo '<td>'. $row['CATEGORY'].'</td>';
                      echo '<td>'. $row['UNIT'].'</td>';
                      echo '<td>'. $row['QUANTITY'].'</td>';
                      echo '<td>'. $row['PURCH_PRICE'].'</td>';
                      echo '<td>'. $row['PRICE'].'</td>';
                      echo '<td>'. $row['SUBTOTAL'].'</td>';
                      echo '<td>'. $row['VAT'].'</td>';
                      echo '<td>'. $row['TOTAL'].'</td>';
                      echo '<td>'. $row['PROFIT'].'</td>';
                      echo '<td>'. $row['DATE'].'</td>';
                      echo '<td>'. $row['STATUS'].'</td>';
                      
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    <script src="../pages/script.js"></script>
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
<?php
include'../includes/footer.php';
?>