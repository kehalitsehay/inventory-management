<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Category &nbsp;<a  href="#" data-toggle="modal" data-target="#categoryModal" type="button" class="btn btn-primary bg-gradient-info" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            
            <form action="category_imort.php" enctype="multipart/form-data" method="post">
                <input type="file" name="file" id="file" accept=".csv, .xls, .xlsx" class="form-control"  required >
                <button type="submit" class="btn btn-info mx-2 mt-2" name="submit">Import</button>
            </form>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Category Name</th>
                        <th>Category Code</th>
                        <th>Action</th>
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
                      echo '<td align="right"> <div class="btn-group">
                              <a type="button" class="btn btn-primary bg-gradient-info btn-sm" href="cata_edit.php?action=edit & id='.$row['ID']. '"> 
                              <i class="fas fa-fw fa-edit"></i>
                              Edit
                              </a>
                            
                          </div> </td>';
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