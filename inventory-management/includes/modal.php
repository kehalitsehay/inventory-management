<!-- Employee select and script -->
<?php
$sqlforjob = "SELECT DISTINCT JOB_TITLE, JOB_ID FROM job order by JOB_ID asc";
$result = mysqli_query($db, $sqlforjob) or die ("Bad SQL: $sqlforjob");

$job = "<select class='form-control' name='jobs' required>
        <option value='' disabled selected hidden>Select Job</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $job .= "<option value='".$row['JOB_ID']."'>".$row['JOB_TITLE']."</option>";
  }

$job .= "</select>";
?>
<script>  
window.onload = function() {  
  // ---------------
  // basic usage
  // ---------------
  var $ = new City();
  $.showProvinces("#province");
  $.showCities("#city");

  // ------------------
  // additional methods 
  // -------------------

  // will return all provinces 
  console.log($.getProvinces());
  
  // will return all cities 
  console.log($.getAllCities());
  
  // will return all cities under specific province (e.g Batangas)
  console.log($.getCities("Batangas")); 
  
}
</script>
<!-- end of Employee select and script -->

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><?php echo  $_SESSION['FIRST_NAME']; ?> are you sure do you want to logout?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Customer Modal-->
  <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post">
            <div class="form-group">
              <input class="form-control" placeholder="First Name" name="firstname" required>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Last Name" name="lastname" required>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Phone Number" name="phonenumber" required>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Address" name="address" required>
            </div>
            <!-- <div class="form-group">
              <input class="form-control" placeholder="Credit Balance" name="credit_balance" required>
            </div> -->
            <hr>
            <button type="submit" class="btn btn-success"><i class="fa fa-check fa-fw"></i>Save</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-times fa-fw"></i>Reset</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>
  

  <!-- Category Modal-->
  <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post">
            <div class="form-group">
              <input class="form-control" placeholder="Category Code" name="catacode" required>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Category Name" name="cataname" required>
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

  <!-- Category Modal-->
  <div class="modal fade" id="poscategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="cata_pos_trans.php?action=add">
            <div class="form-group">
              <input class="form-control" placeholder="Category Code" name="catacode" required>
            </div>
            <div class="form-group">
              <input class="form-control" placeholder="Category Name" name="cataname" required>
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


<?php
$sql = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category order by CNAME asc";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");
$cataname = "<select class='form-control' name='category'>
        <option disabled selected>Select Category</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $cataname .= "<option value='".$row['CNAME']."'>".$row['CNAME']."</option>";
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

$sql3 = "SELECT * FROM customer";
$result3 = mysqli_query($db, $sql3) or die ("Bad SQL: $sql3");
$customer = "<select class='form-control' name='customer'>
        <option disabled selected hidden>Select Customer</option>";
  while ($row = mysqli_fetch_assoc($result3)) {
    $customer .= "<option value='".$row['FIRST_NAME']." ".$row['LAST_NAME']."'>".$row['FIRST_NAME'].'- '.$row['LAST_NAME']."</option>";
  }
$customer .= "</select>";

$sql4 = "SELECT DISTINCT PRODUCT_ID, PRODUCT_CODE FROM product ";
$result4 = mysqli_query($db, $sql4) or die ("Bad SQL: $sql4");
$prodcode = "<select class='form-control' name='prodcode' id='prodcode' required>
        <option>Select Product Code</option>";
  while ($row = mysqli_fetch_assoc($result4)) {
    $prodcode .= "<option value='".$row['PRODUCT_CODE']."'>".$row['PRODUCT_CODE']."</option>";
  }
$prodcode .= "</select>";

$sql5 = "SELECT DISTINCT PRODUCT_ID, NAME FROM product ";
$result5 = mysqli_query($db, $sql5) or die ("Bad SQL: $sql4");
$prodname = "<select class='form-control' name='prodname' required>
        <option disabled selected hidden>Select Product Name</option>";
  while ($row = mysqli_fetch_assoc($result5)) {
    $prodname .= "<option value='".$row['NAME']."'>".$row['NAME']."</option>";
  }
$prodname .= "</select>";

?>
  <!-- Purchase Request  Modal-->
  <div class="modal fade" id="purchaseReqModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Purchase Request</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="POST">
          <div class="form-group">
                              <?php
                                echo $prodcode;
                              ?>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $prodname;
                              ?>
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
                            <!-- <div class="form-group">
                              <label>Request Date</label>
                              <input type="date" class="form-control" placeholder="Date" name="date" required>
                            </div> -->
                            <!-- <div class="form-group">
                            <select class="form-select col-md-12 mt-2 p-2" class = "form-control" name = "status" aria-label="Default select example" required>
                                <option disabled selected>---Request status---</option>
                                <option value="Pending" class="text-red">Pending</option>
                              </select>
                            </div> -->
                            <hr>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Save</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>

<?php
  
  $sql = "select PRODUCT_CODE from product";
  $result = mysqli_query($db, $sql);  
        
?>



<!-- d/t price display method  -->

  <!-- Sales  Modal-->
  <div class="modal fade" id="salesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Sales Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="sales_transac.php?action=add">
          <input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
          <input type="hidden" name="role" value="<?php echo $_SESSION['JOB_TITLE']; ?>">


                            <div class="form-group">
                            <input type="number" class="form-control" placeholder="Transaction ID" name="transac_id" required>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $customer;
                              ?>
                            </div>
                            <div class="form-group">
                              <select name="proid" id="proid" class="form-control" onchange="fetchpro()">
                                <option value="">Select Product Code</option>
                                  <?php
                                  while($row = mysqli_fetch_array($result)){
                                    $k = $row['PRODUCT_CODE'];
                                    echo '<option value="'.$k.'">'.$k.'</option>'; 
                                  }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                             <input type="text" name="name" id="name" class="form-control" placeholder="Product Name">
                            </div>
                            <div class="form-group">
                            <input type="text" name="brand_id" id="brand_id" class="form-control" placeholder="Category Name">
                            </div>
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder= "Unit" name="unit" id="unit" required>
                            </div>
                            <div class="form-group">
                              <input type="number"  min="1" max="999999999" class="form-control" placeholder="Quantity" name="quantity" step ="any" required>
                            </div>
                            <div class="form-group">
                              <input type="number"  min="1" max="9999999999" class="form-control" placeholder="Price" name="price" step ="any" required>
                            </div>
                            <div class="form-group">
                              
                            <select class = "form-control" name = "vat" aria-label="Default select example" required>
                                <option value="">--Select Tax Option--</option>
                                <option value="0.15" class="text-green">VAT</option>
                                <option value="0.02" class="text-red">With-hold</option>
                                <option value="1" class="text-red">None</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="">Sales Method</label>
                            <select class = "form-control" name = "status" aria-label="Default select example" required>
                                <option value="Cash" class="text-red">Cash</option>
                                <option value="Credit" class="text-red">Credit</option>
                              </select>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Save</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>


  <?php
  
  $sql = "select PRODUCT_CODE from product";
  $result = mysqli_query($db, $sql);  
        
  ?>

  <!-- copied from sales modal -->

        <!-- purchase  Modal-->
        <div class="modal fade" id="purchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Purchase Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="purchase_transac.php?action=add">
          <input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
          <input type="hidden" name="role" value="<?php echo $_SESSION['JOB_TITLE']; ?>">


                            <div class="form-group">
                            <input type="number" class="form-control" placeholder="Transaction ID" name="transac_id" required>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $sup; 
                              ?>
                            </div>
                            <div class="form-group">
                              <select name="proid" id="proid" class="form-control" onchange="fetchpro()">
                                <option value="">Select Product Code</option>
                                  <?php
                                  while($row = mysqli_fetch_array($result)){
                                    $k = $row['PRODUCT_CODE'];
                                    echo '<option value="'.$k.'">'.$k.'</option>'; 
                                  }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                             <input type="text" name="name" id="name" class="form-control" placeholder="Product Name">
                            </div>
                            <div class="form-group">
                            <input type="text" name="brand_id" id="brand_id" class="form-control" placeholder="Category Name">
                            </div>
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder= "Unit" name="unit" id="unit" required>
                            </div>
                            <div class="form-group">
                              <input type="number"  min="1" max="999999999" class="form-control" placeholder="Quantity" name="quantity" step ="any" required>
                            </div>
                            <div class="form-group">
                              <input type="number"  min="1" max="9999999999" class="form-control" placeholder="Price" name="price" step ="any" required>
                            </div>
                            <div class="form-group">
                              
                            <select class = "form-control" name = "vat" aria-label="Default select example" required>
                                <option value="">--Select Tax Option--</option>
                                <option value="0.15" class="text-green">VAT</option>
                                <option value="0.02" class="text-red">With-hold</option>
                                <option value="1" class="text-red">None</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="">Purchase Method</label>
                            <select class = "form-control" name = "status" aria-label="Default select example" required>
                                <option value="Cash" class="text-red">Cash</option>
                                <option value="Credit" class="text-red">Credit</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Expire Date Date</label>
                              <input type="date" class="form-control" placeholder="Date" name="ex_date" required>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Save</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>



  <!-- Purchase  Modal, which was original-->

  <div class="modal fade" id="purchModall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Purchase Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="purchase_transac.php?action=add">
            <input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
            <input type="hidden" name="role" value="<?php echo $_SESSION['JOB_TITLE']; ?>">
                            <div class="form-group">
                              <input type="number"  min="1" max="999999999" class="form-control" placeholder="Transaction ID" name="transac_id" required>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $sup; 
                              ?>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $prod_name; 
                              ?>
                            </div>
                            <div class="form-group">
                             <input type="text" name="name" id="name" class="form-control" placeholder="Product Name">
                            </div>
                            <div class="form-group">
                            <input type="text" name="brand_id" id="brand_id" class="form-control" placeholder="Category Name">
                            </div>
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder= "Unit" name="unit" id="unit" required>
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
                            <select class = "form-control" name = "vat" aria-label="Default select example" required>
                                <option value="">--Select Tax Option--</option>
                                <option value="0.15" class="text-red">VAT</option>
                                <option value="0.02" class="text-red">With-hold</option>
                                <option value="1" class="text-red">None</option>
                              </select>
                            </div>
                            <div class="form-group">
                            <select class = "form-control" name = "status" aria-label="Default select example" required>
                                <option selected>Purchase Method</option>
                                <option value="Cash" class="text-red">Cash</option>
                                <option value="Credit" class="text-red">Credit</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Purchase Date</label>
                              <input type="date" class="form-control" placeholder="Date" name="date" required>
                            </div>
                            <div class="form-group">
                              <label>Expire Date</label>
                              <input type="date" class="form-control" placeholder="Date" name="expire_date" required>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Save</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>      
          </form>  
        </div>
      </div>
    </div>
  </div> 


<?php
  $sql = "select PRODUCT_CODE from product";
  $result = mysqli_query($db, $sql);  
?>
  <!-- StockIn Modal -->
  <div class="modal fade" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Stockin Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="stockin_transac.php?action=add">
          <input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
          <input type="hidden" name="role" value="<?php echo $_SESSION['JOB_TITLE']; ?>">


                            <div class="form-group">
                            <input type="number" class="form-control" placeholder="Transaction ID" name="transac_id" required>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $sup; 
                              ?>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $prodcode; 
                              ?>
                            </div>
                            <!-- <div class="form-group">
                              <select name="proid" id="proid" class="form-control" onchange="fetchpro()">
                                <option value="">Select Product Code</option>
                                  <?php
                                  while($row = mysqli_fetch_array($result)){
                                    $k = $row['PRODUCT_CODE'];
                                    echo '<option value="'.$k.'">'.$k.'</option>'; 
                                  }
                                ?>
                              </select>
                            </div> -->
                            <div class="form-group">
                              <?php
                                echo $prodname; 
                              ?>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $cataname; 
                              ?>
                            </div>
                            <!-- <div class="form-group">
                             <input type="text" name="name" id="name" class="form-control" placeholder="Product Name">
                            </div>
                            <div class="form-group">
                            <input type="text" name="brand_id" id="brand_id" class="form-control" placeholder="Category Name">
                            </div> -->
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder= "Unit" name="unit" id="unit" required>
                            </div>
                            <div class="form-group">
                              <input type="number"  min="1" max="999999999" class="form-control" placeholder="Quantity" name="quantity" step ="any" required>
                            </div>
                            <div class="form-group">
                              <input type="number"  min="1" max="9999999999" class="form-control" placeholder="Price" name="price" step ="any" required>
                            </div>
                            <div class="form-group">
                              
                            <select class = "form-control" name = "vat" aria-label="Default select example" required>
                                <option value="">--Select Tax Option--</option>
                                <option value="0.15" class="text-green">VAT</option>
                                <option value="0.02" class="text-red">With-hold</option>
                                <option value="1" class="text-red">None</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="">Purchase Method</label>
                            <select class = "form-control" name = "status" aria-label="Default select example" required>
                                <option value="Cash" class="text-red">Cash</option>
                                <option value="Credit" class="text-red">Credit</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Expire Date Date</label>
                              <input type="date" class="form-control" placeholder="Date" name="ex_date" required>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Save</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>



  <!-- StockOut Modal -->

  <?php
  $sql = "select PRODUCT_CODE from product";
  $result = mysqli_query($db, $sql);  
  ?>

  <div class="modal fade" id="stockOutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Stockout/sales Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="stockout_transac.php?action=add">
          <input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
          <input type="hidden" name="role" value="<?php echo $_SESSION['JOB_TITLE']; ?>">


                            <div class="form-group">
                            <input type="number" class="form-control" placeholder="Transaction ID" name="transac_id" required>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $customer; 
                              ?>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $prodcode; 
                              ?>
                            </div>
                            <!-- <div class="form-group">
                              <select name="proid" id="proid" class="form-control" onchange="fetchpro()">
                                <option value="">Select Product Code</option>
                                  <?php
                                  $sql = "select PRODUCT_CODE from product";
                                  $result = mysqli_query($db, $sql);  
                                  while($row = mysqli_fetch_array($result)){
                                    $k = $row['PRODUCT_CODE'];
                                    echo '<option value="'.$k.'">'.$k.'</option>'; 
                                  }
                                ?>
                              </select>
                            </div> -->

                            <div class="form-group">
                              <?php
                                echo $prodname; 
                              ?>
                            </div>
                            <div class="form-group">
                              <?php
                                echo $cataname; 
                              ?>
                            </div>
                            <!-- <div class="form-group">
                             <input type="text" name="name" id="name" class="form-control" placeholder="Product Name">
                            </div>
                            <div class="form-group">
                            <input type="text" name="brand_id" id="brand_id" class="form-control" placeholder="Category Name">
                            </div> -->
                            <div class="form-group">
                            <input type="text" class="form-control" placeholder= "Unit" name="unit" id="unit" required>
                            </div>
                            <div class="form-group">
                              <input type="number"  min="1" max="999999999" class="form-control" placeholder="Quantity" name="quantity" step ="any" required>
                            </div>
                            <div class="form-group">
                              <input type="number"  min="1" max="9999999999" class="form-control" placeholder="Price" name="sale_price" step ="any" required>
                            </div>
                            <div class="form-group">
                              
                            <select class = "form-control" name = "vat" aria-label="Default select example" required>
                                <option value="">--Select Tax Option--</option>
                                <option value="0.15" class="text-green">VAT</option>
                                <option value="0.02" class="text-red">With-hold</option>
                                <option value="1" class="text-red">None</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="">Sales Method</label>
                            <select class = "form-control" name = "status" aria-label="Default select example" required>
                                <option value="Cash" class="text-red">Cash</option>
                                <option value="Credit" class="text-red">Credit</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Expire Date Date</label>
                              <input type="date" class="form-control" placeholder="Date" name="expired-date" required>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-check fa-fw"></i>Save</button>
                            <button type="reset" class="btn btn-danger btn-block"><i class="fa fa-times fa-fw"></i>Reset</button>      
          </form>  
        </div>
      </div>
    </div>
  </div>




  <!-- Employee Modal-->
  <div class="modal fade" id="employeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="emp_transac.php?action=add">          
              <div class="form-group">
                <input class="form-control" placeholder="First Name" name="firstname" required>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Last Name" name="lastname" required>
              </div>
              <div class="form-group">
                  <select class='form-control' name='gender' required>
                    <option value="" disabled selected hidden>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Email" name="email" required>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Phone Number" name="phonenumber" required>
              </div>
              <div class="form-group">
                <?php
                  echo $job;
                ?>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="salary" placeholder="Salary" required>
              </div>
              <div class="form-group">
                <input placeholder="Hired Date" type="date" onfocus="(this.type='date')" onblur="(this.type='text')" id="FromDate" name="hireddate" class="form-control" />
              </div>
              
              <div class="form-group">
                <select class="form-control" id="province" placeholder="Country" name="province" required></select>
              </div>
              <div class="form-group">
                <select class="form-control" id="city" placeholder="City" name="city" required></select>
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



  <!-- Delete Modal-->
  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure do you want to delete?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger btn-ok">Delete</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Supplier Modal-->
  <div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="sup_transac.php?action=add">
              
              <div class="form-group">
                <input class="form-control" placeholder="Company Name" name="companyname" required>
              </div>
              <div class="form-group">
                <select class="form-control" id="province" placeholder="Country" name="province" required></select>
              </div>
              <div class="form-group">
                <select class="form-control" id="city" placeholder="City" name="city" required></select>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Phone Number" name="phonenumber" required>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" placeholder="Credit Balance" name="credit_balance" required>
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
<!-- Expenses Modal-->

<div class="modal fade" id="expenseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Expenses</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="expense_transac.php?action=add">
           <div class="form-group">
             <input class="form-control" placeholder="Requested By" name="employee" required>
           </div>
           <div class="form-group">
             <select class="form-control" placeholder="Category" name="category" required>
              <option value="">--Select--</option>
              <?php
              $sql = "select * from chart_of_account where account_category = 'Expense'";
              $result = mysqli_query($db, $sql);  
              while($row = mysqli_fetch_array($result)){
                $k = $row['account_name'];
                echo '<option value="'.$k.'">'.$k.'</option>'; 
              }
            ?>
              </select>
           </div>
          <div class="form-group">
             <input class="form-control" placeholder="Amount" name="amount" required>
           </div>
           
            <div class="form-group">
              <label for="bank" class="form-label">Bank</label>
              <select class = "form-control" name = "bank" aria-label="Default select example" required>
                  <option value="">--Select Bank--</option>
                  <option value="cbe" class="text-green">CBE</option>
                  <option value="awash" class="text-red">Awash</option>
                  <option value="amhara" class="text-red">Amhara</option>
                  <option value="ahadu" class="text-red">Ahadu</option>
                  <option value="abay" class="text-red">Abay</option>
                  <option value="abyssinia" class="text-red">Abyssinia</option>
                  <option value="cash" class="text-red">Cash</option>
              </select>
            </div>
            <div class="form-group">
              <textarea rows="3" cols="50" class="form-control" placeholder="Description" name="description" required></textarea>
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




  <script src="../autofill/jquery.min.js"></script>
  <script src="../autofill/script.js"></script>  

  <script src="script.js"></script>
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            
            $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
        });
</script>
