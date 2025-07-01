<?php
include'../includes/connection.php';
include'../includes/sidebar_purchase.php';
?>


            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $catacode = $_POST['catacode'];
                $cataname = $_POST['cataname'];

                  $count = 0;
                  $res = mysqli_query($db, "select * FROM category where CATEGORY_ID = '$catacode' && CNAME = '$cataname'") or die (mysqli_error($db));
                  $count = mysqli_num_rows($res);
                  ?>
                  <?php
                  if($count > 0){
                    ?>
                    <script>
                      alert("The category already exists, please enter another new category.")
                      </script>
                    <?php
                    
                  }else{
                    mysqli_query($db,"INSERT INTO category 
                              VALUES (NULL, '$catacode','$cataname')") or die(mysqli_error($db)); 
                        ?>
                        <script>
                          alert("The category successfully added.")
                          </script>
                        <?php
                  }
              }
            ?>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Category &nbsp;<a  href="#" data-toggle="modal" data-target="#categoryModal" type="button" class="btn btn-primary bg-gradient-info" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Category Name</th>
                        <th>Category Code</th>
                        
                        <!-- <th>Action</th> -->
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM category';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['CNAME'].'</td>';
                      echo '<td>'. $row['CATEGORY_ID'].'</td>';
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
          <form role="form" method="post" action="cata_trans_pur.php?action=add">
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