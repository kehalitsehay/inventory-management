<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

?>
        
            <?php
              $prodcode = $_POST['prodcode'];
              $prodname = $_POST['prodname'];
              $cataname = $_POST['category'];
              $qty = $_POST['quantity'];
              $unit = $_POST['unit'];
              $price = $_POST['price'];
              $supplier = $_POST['supplier'];
              $date = $_POST['date'];
              $status= $_POST['status'];
        
              switch($_GET['action']){
                case 'add':     
                    $query = "INSERT INTO purcase_req
                    (ID, PRODUCT_CODE, NAME, CATEGORY, QUANTITY, UNIT, DATE, STATUS)
                    VALUES (NULL, '{$prodcode}','{$prodname}','{$cataname}', '{$qty}', '{$unit}', '{$date}', '{$status}')";
                    mysqli_query($db,$query)or die ('Error in updating Database');
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "requ.php";
              </script>
         

<?php
include'../includes/footer2.php';
?>