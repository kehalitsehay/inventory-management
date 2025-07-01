<?php
include '../includes/connection.php';
include '../includes/sidebar.php';


  $query = 'SELECT * from category WHERE ID ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
			$zz = $row['ID'];
      $cata_code = $row['CATEGORY_ID'];
      $cata_name = $row['CNAME'];
    
    }
      $id = $_GET['id'];
?>

  <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Edit Category</h4>
            </div>
            <a href="category.php?action=add" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
            <d class="card-body">

            <form role="form" method="post" action="cata_edit1.php">
              <input type="hidden" name="id" value="<?php echo $zz; ?>" />
              <div class="form-group row text-left ">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Category Code:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Category Code" name="cata_code" value="<?php echo $cata_code; ?>">
                </div>
              </div>
              <div class="form-group row text-left ">
                <div class="col-sm-3" style="padding-top: 5px;">
                 Category Name:
                </div>
                <div class="col-sm-9">
                  <input class="form-control" placeholder="Category Code" name="cata_name" value="<?php echo $cata_name; ?>">
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