<?php
include'../includes/connection.php';
include'../includes/sidebar_acc.php';
?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $prodcode = $_POST['prodcode'];
              $prodname = $_POST['prodname'];
              $cataname = $_POST['category'];
              $qty = $_POST['quantity'];
              $unit = $_POST['unit'];
              // $price = $_POST['price'];
              // $supplier = $_POST['supplier'];
              $date = $_POST['date'];
              $status= $_POST['status'];

              $query = "INSERT INTO purcase_req
                    (ID, PRODUCT_CODE, NAME, CATEGORY, QUANTITY, UNIT, DATE, STATUS)
                    VALUES (NULL, '{$prodcode}','{$prodname}','{$cataname}', '{$qty}', '{$unit}', '{$date}', '{$status}')";
                    mysqli_query($db,$query)or die ('Error in updating Database');
    }
    ?>
          
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Purchase Request <a  href="#" data-toggle="modal" data-target="#purchaseReqModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>

            <form action="purchase_request_import.php" enctype="multipart/form-data" method="post">
                <input type="file" name="file" id="file" accept=".csv, .xls, .xlsx" class="form-control"  required >
                <button type="submit" class="btn btn-info mx-2 mt-2" name="submit">Import</button>
            </form>
      
      <?php 
      $purhase_requ = "SELECT * FROM purcase_req where STATUS = 'Pending'";
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