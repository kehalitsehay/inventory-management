<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Add Customer</h4>
            </div>
            <a href="customer.php" type="button" class="btn btn-primary bg-gradient-primary">Back</a>
            <div class="card-body">
                        <div class="table-responsive">
                        <form role="form" method="post" action="cust_transac.php?action=add">
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