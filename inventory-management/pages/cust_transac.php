<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

?>
            <?php
              $fname = $_POST['firstname'];
              $lname = $_POST['lastname'];
              $pn = $_POST['phonenumber'];
              $add = $_POST['address'];
              // $credit_balance = $_POST['credit_balance'];
        
              switch($_GET['action']){
                case 'add':  
                  $count = 0;
                  $res = mysqli_query($db, "select * FROM customer where FIRST_NAME = '$fname' && LAST_NAME = '$lname' && PHONE_NUMBER = '$pn' && ADDRESS = '$add'") or die (mysqli_error($db));
                  $count = mysqli_num_rows($res);
                  ?>
                  <?php
                  if($count > 0){
                    ?>
                    <script>
                      alert("The customer already exists, please enter another new customer.")
                      </script>
                    <?php
                    
                  }else{
                    $query = "INSERT INTO customer 
                    VALUES (Null,'{$fname}','{$lname}','{$pn}', '{$add}')";
                    mysqli_query($db,$query) or die (mysqli_error($db));
                    ?>
                    <script>
                      alert("The customer successfully added.")
                      </script>
                    <?php
                  }
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "customer.php";
              </script>
          </div>

<?php
include'../includes/footer.php';
?>