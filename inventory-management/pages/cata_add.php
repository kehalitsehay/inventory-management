<?php
include'../includes/connection.php';

?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Add Catagory</h4>
            </div>
            <a href="category.php" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
            <div class="card-body">
                        <div class="table-responsive">
                        <form role="form" method="post" action="cata_transac.php?action=add">
                          <div class="form-group">
                              <input class="form-control" placeholder="Category Code" name="catacode" required>
                            </div>
                            <div class="form-group">
                              <input class="form-control" placeholder="Category Name" name="cataname" required>
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