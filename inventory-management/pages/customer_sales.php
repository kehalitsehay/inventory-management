<?php
include'../includes/connection.php';
include'../includes/sidebar_sales.php';
?>
            
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              $fname = $_POST['firstname'];
              $lname = $_POST['lastname'];
              $pn = $_POST['phonenumber'];
              $add = $_POST['address'];
              // $credit_balance = $_POST['credit_balance'];
         
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
              }
            ?>


            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h4 class="m-2 font-weight-bold text-primary">Customer&nbsp;<a  href="#" data-toggle="modal" data-target="#customerModal" type="button" class="btn btn-primary bg-gradient-primary" style="border-radius: 0px;"><i class="fas fa-fw fa-plus"></i></a></h4>
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Customer ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM customer';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['CUST_ID'].'</td>';
                      echo '<td>'. $row['FIRST_NAME'].'</td>';
                      echo '<td>'. $row['LAST_NAME'].'</td>';
                      echo '<td>'. $row['PHONE_NUMBER'].'</td>';
                      echo '<td>'. $row['ADDRESS'].'</td>';
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