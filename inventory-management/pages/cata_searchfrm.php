<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

   
  $query = 'SELECT * FROM category WHERE CATEGORY_ID ='.$_GET['id'];
  $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result))
    {   
      $zz= $row['CATEGORY_ID'];
      $a= $row['CNAME'];
    }
    $id = $_GET['id'];
?>
            
            <center><div class="card shadow mb-4 col-xs-12 col-md-8 border-bottom-primary">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Category's Detail</h4>
            </div>
            <a href="category.php" type="button" class="btn btn-primary bg-gradient-primary btn-block"> <i class="fas fa-flip-horizontal fa-fw fa-share"></i> Back </a>
            <div class="card-body">
                

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Category Code: <br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          <?php echo $zz; ?>  <br>
                        </h5>
                      </div>

                    </div>

                    <div class="form-group row text-left">

                      <div class="col-sm-3 text-primary">
                        <h5>
                          Category Name<br>
                        </h5>
                      </div>

                      <div class="col-sm-9">
                        <h5>
                          : <?php echo $a; ?> <br>
                        </h5>
                      </div>
                      
                    </div>
            </div>
          </div>

<?php
include'../includes/footer.php';
?>