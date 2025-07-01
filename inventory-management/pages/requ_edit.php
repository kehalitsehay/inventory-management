<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

  
  $query = 'SELECT * FROM purcase_req WHERE PRODUCT_CODE ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $a= $row['PRODUCT_CODE'];
      $b= $row['NAME'];
      $c=$row['CATEGORY'];
      $d=$row['QUANTITY'];
      $e=$row['UNIT'];
      $h=$row['DATE'];
      $i=$row['STATUS'];
    }  
      $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Purchase Request</h4>
            </div><a  type="button" class="btn btn-primary bg-gradient-primary btn-block" href="requ.php?"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
         
            <form role="form" method="post" action="requ_edit1.php">
              <input type="hidden" name="id" value="<?php echo $a; ?>" />
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Product Code:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="prodcode" value="<?php echo $a; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="prodname" value="<?php echo $b; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Category:
                </div>
                <div class="col-sm-9">
                   <input class="form-control" name="category" value="<?php echo $c; ?>" required>
                </div>
              </div>

              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Quantity:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="quantity" value="<?php echo $d; ?>" required>
                </div>
              </div>

              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Unit:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="unit" value="<?php echo $e; ?>" required>
                </div>
              </div>
              
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Date:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="date" value="<?php echo $h; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left text-warning">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Status:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="status" value="<?php echo $i; ?>" readonly>
                </div>
              </div>

              <hr>

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Update</button> 
              </form>  
          </div>
  </div>

<?php
include'../includes/footer.php';
?>