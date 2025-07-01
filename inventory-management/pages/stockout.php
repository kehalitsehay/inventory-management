<?php
include'../includes/connection.php';
include'../includes/sidebar_store.php';
?>
  



  <?php
  
  $sql = "select distinct PRODUCT_CODE from product";
  $result = mysqli_query($db, $sql);  
  $sql2 = "select distinct NAME from product order by NAME";
  $result2 = mysqli_query($db, $sql2);
  $sql3 = "select distinct CNAME from product order by CNAME";
  $result3 = mysqli_query($db, $sql3);
  $query = "select distinct FIRST_NAME, LAST_NAME from customer order by FIRST_NAME";
  $results = mysqli_query($db, $query);
        
        
?>

<h3>Add sales product</h3>
<form class="row g-3" method="POST" action="stockout_transac.php?action=add" role="form">
<input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
<input type="hidden" name="role" value="<?php echo $_SESSION['JOB_TITLE']; ?>">
  <div class="col-md-3">
    <label for="inputEmail4" class="form-label">Transaction ID</label>
    <input type="number" class="form-control" name="transac_id" for="inputEmail4" required>
  </div>
  <div class="col-md-3">
    <label for="inputEmail4" class="form-label">Customer Name</label>
    <select name="customer" class= "form-control" >
      <option value ="">---Select---</option>";
      <?php
        while ($row = mysqli_fetch_assoc($results)) {
          $customer = $row['CUSTOMER_NAME'];
          echo "<option value='".$row['FIRST_NAME']." ".$row['LAST_NAME']."'>".$row['FIRST_NAME'].'- '.$row['LAST_NAME']."</option>";
        }
        ?>
    </select>
  </div>
  <div class="col-md-3">
    <label for="inputPassword4" class="form-label">Product Code</label>
    <select name="prodcode" id="proid" class="form-control" required>
       <option value="">--Select--</option>
          <?php
          while($row = mysqli_fetch_array($result)){
            $k = $row['PRODUCT_CODE'];
            echo '<option value="'.$k.'">'.$k.'</option>'; 
          }
        ?>
      </select>
  </div>
 
  <div class="col-md-3">
    <label class="form-label">Product Name</label>
    <select name="prodname" id="proid" class="form-control" required>
       <option value="">--Select--</option>
          <?php
          while($row = mysqli_fetch_array($result2)){
            $p = $row['NAME'];
            echo '<option value="'.$p.'">'.$p.'</option>'; 
          }
        ?>
      </select>
  </div>
  <div class="col-md-3 pt-3">
    <label class="form-label">Product Category</label>
    <select name="category" id="proid" class="form-control" required>
       <option value="">---Select---</option>
          <?php
          while($row = mysqli_fetch_array($result3)){
            $q = $row['CNAME'];
            echo '<option value="'.$q.'">'.$q.'</option>'; 
          }
        ?>
      </select>
  </div>
  <div class="col-md-3 pt-3">
    <label for="inputPassword4" class="form-label">Unit</label>
    <input type="text" class="form-control" name="unit" id="unit" required>
  </div>
  <div class="col-md-3 pt-3">
    <label for="inputEmail4" class="form-label">Quantity</label>
    <input type="number"  min="1" max="999999999" class="form-control"  name="quantity" step ="any" required>
  </div>
  <div class="col-md-3 pt-3">
    <label for="inputPassword4" class="form-label">Price</label>
    <input type="number"  min="1" max="9999999999" class="form-control" name="sale_price" step ="any" required>
  </div>
  <div class="col-md-3 pt-3">
    <label for="inputPassword4" class="form-label">Tax Option</label>
    <select class = "form-control" name = "vat" aria-label="Default select example" required>
        <option value="">--Select Tax Option--</option>
        <option value="0.15" class="text-green">VAT</option>
        <option value="0.02" class="text-red">With-hold</option>
        <option value="1" class="text-red">None</option>
    </select>
  </div>
  <div class="col-md-3 pt-3">
    <label for="inputPassword4" class="form-label">Sales Method</label>
    <select class = "form-control" name = "status" aria-label="Default select example" required>
      <option value="Cash" class="text-red">Cash</option>
      <option value="Credit" class="text-red">Credit</option>
    </select>
  </div>
  <div class="col-md-3 pt-3">
    <label for="inputPassword4" class="form-label">Expired Date</label>
    <input type="date" class="form-control" name="expired-date" step ="any">
  </div>
  <div class="col-12 text-center py-3">
    <button type="submit" class="btn btn-primary">Add Sales</button>
  </div>
</form>



<h3>Sold products list</h3>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            
            <div class="card shadow mb-4">
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
                        <th>StockOut Date</th>
                        <th>Expired Date</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM stockout';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['pro_code'].'</td>';
                      echo '<td>'. $row['pro_name'].'</td>';
                      echo '<td>'. $row['category'].'</td>';
                      echo '<td>'. $row['quantity'].'</td>';
                      echo '<td>'. $row['unit'].'</td>';
                      echo '<td>'. $row['stockout_date'].'</td>';
                      echo '<td>'. $row['expired_date'].'</td>';
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary btn-sm" href="cata_searchfrm.php?action=edit & id='.$row['pro_code'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                            <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-primary dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                              ... <span class="caret"></span></a>
                            <ul class="dropdown-menu text-center" role="menu">
                                <li>
                                  <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="stockin_edit.php?action=edit & id='.$row['pro_code']. '">
                                    <i class="fas fa-fw fa-edit"></i> Edit
                                  </a>
                                </li>
                                <li>
                                  <a type="button" class="btn btn-danger bg-gradient-danger btn-block" style="border-radius: 0px;" href="stockin_del.php?action=delete & id='.$row['id']. '">
                                    <i class="fas fa-fw fa-trash"></i> Delete
                                  </a>
                                </li>
                            </ul>
                            </div>
                          </div> </td>';
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

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