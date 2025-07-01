<?php
include '../includes/connection.php';
include '../includes/sidebar.php';
  $query = 'SELECT * from chart_of_account WHERE account_code ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $account_code = $row['account_code'];
      $account_name = $row['account_name'];
      $sub_account = $row['sub_account'];
      $account_category = $row['account_category'];
    }
      $id = $_GET['id'];
?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Product</h4>
            </div>
            <a href="chart_of_account.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
            <div class="card-body">

            <form role="form" method="post" action="account_edit1.php">
              <input type="hidden" name="id" value="<?php echo $account_code; ?>" />
              <div class="form-group row text-left ">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Account Code:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="account_code" value="<?php echo $account_code; ?>" readonly>
                </div>
              </div>
              <div class="form-group row text-left ">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Account Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="account_name" value="<?php echo $account_name; ?>">
                </div>
              </div>
              <div class="form-group row text-left ">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Sub Account:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="sub_account" value="<?php echo $sub_account; ?>" required>
                </div>
              </div>
              <div class="form-group row text-left ">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Account Category:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" name="account_category" value="<?php echo $account_category; ?>" required>
                </div>
              </div>
              <hr >

                <button type="submit" class="btn btn-warning btn-block"><i class="fa fa-edit fa-fw"></i>Update</button>    
              </form>  
            </div>
          </div></center>

<?php
include'../includes/footer.php';
?>