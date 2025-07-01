<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>

<?php 


$sql = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category order by CNAME asc";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");
$cataname = "<select class='form-control' name='category'>
        <option disabled selected>Select Category</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['CATEGORY_ID']."'>".$row['CNAME']."</option>";
  }
$cataname .= "</select>";

$sql2 = "SELECT DISTINCT SUPPLIER_ID, COMPANY_NAME FROM supplier order by COMPANY_NAME asc";
$result2 = mysqli_query($db, $sql2) or die ("Bad SQL: $sql2");
$sup = "<select class='form-control' name='supplier'>
        <option disabled selected>Select Supplier</option>";
  while ($row = mysqli_fetch_assoc($result2)) {
    $sup .= "<option value='".$row['COMPANY_NAME']."'>".$row['COMPANY_NAME']."</option>";
  }
$sup .= "</select>";

$sql3 = "SELECT DISTINCT ID, STATUS FROM status";
$result3 = mysqli_query($db, $sql3) or die ("Bad SQL: $sql3");
$status = "<select class='form-control' name='status' required>
        <option disabled selected hidden>Select Status</option>";
  while ($row = mysqli_fetch_assoc($result3)) {
    $status .= "<option value='".$row['STATUS']."'>".$row['STATUS']."</option>";
  }
$status .= "</select>";

            ?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Add Purchase request</h4>
            </div>
            <a href="category.php" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
            <div class="card-body">
                        <div class="table-responsive">
                        <form role="form" method="post" action="requ_transac.php?action=add">
                            <div class="form-group">
                              <input class="form-control" placeholder="Product Code" name="prodcode" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Name" name="proname" required>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $cataname;
                              ?>
                            </div>
                            <div class="form-group">
                              <input type="number"  min="1" max="999999999" class="form-control" placeholder="Quantity" name="quantity" required>
                            </div>
                            <div class="form-group">
                              <input type="text"  min="1" max="999999999" class="form-control" placeholder="Unit" name="unit" required>
                            </div>
                            <div class="form-group">
                              <input type="number"  min="1" max="9999999999" class="form-control" placeholder="Price" name="price" required>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $sup;
                              ?>
                            </div>
                            <div class="form-group">
                              <input type="date" class="form-control" placeholder="Date" name="date" required>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $status;
                              ?>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Save</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>
                            
                        </form>  
                      </div>
            </div>
          </div></center>
<?php
include'../includes/footer.php';
?>