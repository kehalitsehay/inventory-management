<?php
include '../includes/connection.php';
include '../includes/sidebar.php';

$sql = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category order by CNAME asc";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt = "<select class='form-control' name='category' required>
        <option value='' disabled selected hidden>Select Category</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['CATEGORY_ID']."'>".$row['CNAME']."</option>";
  }

$opt .= "</select>";

  $query = 'SELECT * from product WHERE PRODUCT_ID ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz = $row['PRODUCT_ID'];
      $cata_id = $row['CATEGORY_ID'];
      $zzz = $row['PRODUCT_CODE'];
      $A = $row['NAME'];
      $C1 = $row['sales_price1'];
      $C2 = $row['sales_price2'];
      $C3 = $row['sales_price3'];
      $D = $row['CNAME'];
      $E = $row['UNIT'];
    }
      $id = $_GET['id'];
?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Product</h4>
            </div>
            <a href="product.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
            <div class="card-body">

            <form role="form" method="post" action="pro_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left ">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Product Code:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Product Code" name="prodcode" value="<?php echo $zzz; ?>">
                </div>
              </div>
              <div class="form-group row text-left ">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Category Code:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Product Code" name="cata_id" value="<?php echo $cata_id; ?>">
                </div>
              </div>
              <div class="form-group row text-left ">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Category Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Category Name" name="category" value="<?php echo $D; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left ">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Product Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Product Name" name="prodname" value="<?php echo $A; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left ">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Unit:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Product Unit" name="unit" value="<?php echo $E; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Sales Price1:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Price" name="sales_price1" value="<?php echo $C1; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Sales Price2:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Price" name="sales_price2" value="<?php echo $C2; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Sales Price3:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Price" name="sales_price3" value="<?php echo $C3; ?>" required>
                </div>
              </div>
              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Update</button>    
              </form>  
            </div>
          </div></center>

<?php
include'../includes/footer.php';
?>