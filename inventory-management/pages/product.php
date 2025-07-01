<?php
include '../includes/connection.php';
include '../includes/sidebar.php';


$sql = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category order by CNAME asc";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$cata_name = "<select class='form-control' name='category' required>
        <option disabled selected hidden>Select Category</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $cata_name .= "<option value='".$row['CNAME']."'>".$row['CNAME']."</option>";
  }

$cata_name .= "</select>";

$sql = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category order by CNAME asc";
$result2 = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$cata_code = "<select class='form-control' name='cata_code' required>
        <option disabled selected hidden>Select Category</option>";
  while ($row = mysqli_fetch_assoc($result2)) {
    $cata_code .= "<option value='".$row['CATEGORY_ID']."'>".$row['CATEGORY_ID']."</option>";
  }

$cata_code .= "</select>";

?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"> Product&nbsp;<a  href="#" data-toggle="modal" data-target="#aModal" type="button" class="btn btn-primary bg-gradient-info" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            <form action="product_imort.php" enctype="multipart/form-data" method="post">
                <input type="file" name="file" id="file" accept=".csv, .xls, .xlsx" class="form-control"  required >
                <button type="submit" class="btn btn-info mx-2 mt-2" name="submit">Import</button>
            </form>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                    <th>Category</th>
                     <th>Name</th>
                     <th>Product Code</th>
                     <th>Unit</th>
                     <th>Sale Price1</th>
                     <th>Sale Price2</th>
                     <th>Sale Price3</th>
                     <th>Action</th>
                   </tr>
               </thead>
          <tbody>

<?php                  
    $query = 'SELECT * FROM product GROUP BY PRODUCT_CODE';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {                 
                echo '<tr>';
                echo '<td>'. $row['CNAME'].'</td>';
                echo '<td>'. $row['NAME'].'</td>';
                echo '<td>'. $row['PRODUCT_CODE'].'</td>';
                echo '<td>'. $row['UNIT'].'</td>';
                echo '<td>'. $row['sales_price1'].'</td>';
                echo '<td>'. $row['sales_price2'].'</td>';
                echo '<td>'. $row['sales_price3'].'</td>';

                echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-info btn-sm" href="pro_edit.php?action=edit & id='.$row['PRODUCT_ID']. '"> 
                              <i class="fas fa-fw fa-edit"></i>
                              Edit
                              </a>
                            
                          </div> </td>';
                echo '</tr> ';
                }
?> 
                                    
                                </tbody>
                            </table>

                        </div>
                    </div>
                  </div>


    <script src="script.js"></script>
    <!-- important scripts -->
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

  <!-- Product Modal-->
  <div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="pro_transac.php?action=add">
           <div class="form-group">
             <input class="form-control" placeholder="Product Code" name="prodcode" required>
           </div>
           <div class="form-group">
             <?php
               echo $cata_code;
             ?>
           </div>
           <div class="form-group">
             <?php
               echo $cata_name;
             ?>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Name" name="name" required>
           </div>
           
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Unit" name="unit" required>
           </div>
            <div class="form-group">
             <input type="text" class="form-control" placeholder="Sales Price1" name="sales_price1" required>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Sales Price2" name="sales_price2" required>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Sales Price3" name="sales_price3" required>
           </div>
             <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>