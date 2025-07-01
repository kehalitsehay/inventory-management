<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $pc = $_POST['prodcode'];
              $name = $_POST['name'];
              $desc = $_POST['description'];
              $cat = $_POST['category'];
              $unit = $_POST['unit'];

              switch($_GET['action']){
                case 'add':  
                  $count = 0;
                  $res = mysqli_query($db, "select * FROM product where PRODUCT_CODE = '$pc' && NAME = '$name' && DESCRIPTION = '$desc' && CNAME = '$cat'") or die (mysqli_error($db));
                  $count = mysqli_num_rows($res);
                  if($count > 0){
                    ?>
                    <script>
                      alert("The product already exists, please enter another new product.")
                      </script>
                    <?php
                    
                  }else{
                    $query = "INSERT INTO product 
                    VALUES (Null,'$pc','$name','$cat','$unit','$desc')";
                    mysqli_query($db,$query) or die (mysqli_error($db));
                    ?>
                    <script>
                      alert("The product successfully added.")
                      </script>
                    <?php
                  }
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "product_purchase.php";
              </script>
          </div>
