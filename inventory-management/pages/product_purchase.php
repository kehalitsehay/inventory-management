<?php
include'../includes/connection.php';
include'../includes/sidebar_purchase.php';
?>


<?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $pc = $_POST['prodcode'];
              $name = $_POST['name'];
              $cat = $_POST['category'];
              $unit = $_POST['unit'];
              $pr1 = $_POST['sales_price1'];
              $pr2 = $_POST['sales_price2'];
              $pr3 = $_POST['sales_price3'];

                  $count = 0;
                  $res = mysqli_query($db, "select * FROM product where PRODUCT_CODE = '$pc' && NAME = '$name' && CNAME = '$cat'") or die (mysqli_error($db));
                  $count = mysqli_num_rows($res);
                  if($count > 0){
                    ?>
                    <script>
                      alert("The product already exists, please enter another new product.")
                      </script>
                    <?php
                    
                  }else{
                    $query = "INSERT INTO product 
                    VALUES (NULL, '{$cata_id}', '{$pc}','{$name}','{$cat}','{$unit}', '{$pr1}', '{$pr2}', '{$pr3}')";
                    mysqli_query($db,$query) or die (mysqli_error($db));
                    ?>
                    <script>
                      alert("The product successfully added.")
                      </script>
                    <?php
                  }
              }
            ?>

        <?php
        $sql = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category order by CNAME asc";
        $result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

        $aaa = "<select class='form-control' name='category' required>
        <option disabled selected hidden>Select Category</option>";
        while ($row = mysqli_fetch_assoc($result)) {
          $aaa .= "<option value='".$row['CNAME']."'>".$row['CNAME']."</option>";
        }

        $aaa .= "</select>";

        $sql2 = "SELECT DISTINCT CNAME, CATEGORY_ID FROM category order by CNAME asc";
        $result2 = mysqli_query($db, $sql2) or die ("Bad SQL: $sql");

        $cata_code = "<select class='form-control' name='cata_code' required>
        <option disabled selected hidden>Select Category Code</option>";
        while ($row = mysqli_fetch_assoc($result2)) {
          $cata_code .= "<option value='".$row['CATEGORY_ID']."'>".$row['CATEGORY_ID']."</option>";
        }

        $cata_code .= "</select>";

        ?>
            
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary"> Product&nbsp;<a  href="#" data-toggle="modal" data-target="#aModal" type="button" class="btn btn-primary bg-gradient-info" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                    <th>Category</th>
                    <th>Name</th>
                     <th>Product Code</th>
                    
                     <th>Unit</th>
                     <!-- <th>Action</th> -->
                   </tr>
               </thead>
          <tbody>

<?php                  
    $query = 'SELECT * FROM product GROUP BY PRODUCT_CODE';
        $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
            while ($row = mysqli_fetch_assoc($result)) {                 
                echo '<tr>';
                echo '<td>'. $row['CNAME'].'</td>';
                echo '<td>'. $row['NAME'].'</td>';
                echo '<td>'. $row['PRODUCT_CODE'].'</td>';
                echo '<td>'. $row['UNIT'].'</td>';
                      // echo '<td align="right"> <div class="btn-group">
                      //         <a type="button" class="btn btn-primary bg-gradient-info btn-sm" href="pro_searchfrm.php?action=edit & id='.$row['PRODUCT_CODE'] . '"><i class="fas fa-fw fa-list-alt"></i> Details</a>
                      //       <div class="btn-group">
                      //         <a type="button" class="btn btn-primary bg-gradient-info dropdown no-arrow" data-toggle="dropdown" style="color:white;">
                      //         ... <span class="caret"></span></a>
                      //       <ul class="dropdown-menu text-center" role="menu">
                      //           <li>
                      //             <a type="button" class="btn btn-warning bg-gradient-warning btn-block" style="border-radius: 0px;" href="pro_edit.php?action=edit & id='.$row['PRODUCT_ID']. '">
                      //               <i class="fas fa-fw fa-edit"></i> Edit
                      //             </a>
                      //           </li>
                      //       </ul>
                      //       </div>
                      //     </div> </td>';
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

  <!-- Product Modal-->
  <div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="post">
           <div class="form-group">
             <input class="form-control" placeholder="Product Code" name="prodcode" required>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Name" name="name" required>
           </div>
           <div class="form-group">
             <?php
               echo $aaa;
             ?>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Unit" name="unit" required>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Sales Price1" name="sales_price1" required>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Sales Price2" name="sales_price2" required>
           </div>
           <div class="form-group">
             <input type="text" class="form-control" placeholder="Sales Price3" name="sales_price3" required>
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