<?php
include'../includes/connection.php';
?>
            <?php
              $pc = $_POST['prodcode'];
              $cata_id = $_POST['cata_code'];
              $name = $_POST['name'];
              $cat = $_POST['category'];
              $unit = $_POST['unit'];
              $pr1 = $_POST['sales_price1'];
              $pr2 = $_POST['sales_price2'];
              $pr3 = $_POST['sales_price3'];

              switch($_GET['action']){
                case 'add':  
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
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "product.php";
              </script>