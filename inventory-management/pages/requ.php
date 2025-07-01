<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

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
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Add Request &nbsp;<a  href="#" data-toggle="modal" data-target="#purchaseReqModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Request Date</th>
                        <th>Status</th>
                        <!-- <th>Action</th> -->
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM purcase_req ORDER BY DATE';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['PRODUCT_CODE'].'</td>';
                      echo '<td>'. $row['NAME'].'</td>';
                      echo '<td>'. $row['CATEGORY'].'</td>';
                      echo '<td>'. $row['UNIT'].'</td>';
                      echo '<td>'. $row['QUANTITY'].'</td>';
                      echo '<td>'. $row['DATE'].'</td>';
                      echo '<td>'. $row['STATUS'].'</td>';
                      // echo '<td align="right"> <div class="btn-group">
                      //         <a type="button" class="btn btn-primary bg-gradient-primary btn-sm" href="cata_searchfrm.php?action=edit & id='.$row['PRODUCT_CODE'] . '"> Details</a>
                      //       <div class="btn-group">
                      //         <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                      //         ... <span class="caret"></span></a>
                      //       <ul class="dropdown-menu text-center" role="menu">
                      //           <li>
                      //             <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="requ_edit.php?action=edit & id='.$row['PRODUCT_CODE']. '">
                      //               <i class="fas fa-fw fa-edit"></i> Edit
                      //             </a>
                      //           </li>
                      //           <li>
                      //             <a type="button" class="btn btn-danger bg-gradient-danger btn-block" style="border-radius: 0px;" href="requ_del.php?action=delete & id='.$row['PRODUCT_CODE']. '">
                      //               <i class="fas fa-fw fa-trash"></i> Delete
                      //             </a>
                      //           </li>
                      //       </ul>
                      //       </div>
                      //     </div> </td>';
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

<?php
include'../includes/footer.php';
?>