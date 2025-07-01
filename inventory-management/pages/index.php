<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

require 'auth_functions.php';

checkAccess('Admin'); 
?>
<h3>Admin Dashboard</h3>
<div class="row show-grid">
  
      <div class="col-md-4">
        <!-- Customer record -->
          <div class="col-md-12 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-0">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Total Balance</div>
                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                      <?php 
                      $query = "SELECT SUM(balance) FROM cbe_bank_account";
                      $result = mysqli_query($db, $query) or die(mysqli_error($db));
                      $row = mysqli_fetch_array($result);
                      $cbe =  $row[0];
                      $query1 = "SELECT SUM(balance) FROM amhara_bank_account";
                      $result1 = mysqli_query($db, $query1) or die(mysqli_error($db));
                      $row1 = mysqli_fetch_array($result1);
                      $amhara =  $row1[0];
                      echo $cbe + $amhara;
                      ?>
                      ETB
                      <!-- <p><a href="#">Show more</a></p> -->
                    </div>
                  </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
                
              </div>
            </div> 
          </div>
      </div>

        <div class="col-md-4">
        <!-- Customer record -->
          <div class="col-md-12 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-0">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Inventory Balance</div>
                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                      <?php 
                      $query = "SELECT SUM(total) FROM stockin";
                      $result = mysqli_query($db, $query) or die(mysqli_error($db));
                      while ($row = mysqli_fetch_array($result)) {
                          echo "$row[0]";
                        }
                      ?> ETB
                    </div>
                  </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-800"></i>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
        <!-- Customer record -->
          <div class="col-md-12 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-0">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Sales Profit</div>
                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                      <?php 
                      $query = "SELECT SUM(profit) FROM stockout";
                      $result = mysqli_query($db, $query) or die(mysqli_error($db));
                      while ($row = mysqli_fetch_array($result)) {
                          echo "$row[0]";
                        }
                      ?> ETB
                    </div>
                  </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-800"></i>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
        <!-- Customer record -->
          <div class="col-md-12 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-0">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Expenses</div>
                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                      <?php 
                      $query = "SELECT SUM(amount) FROM expense";
                      $result = mysqli_query($db, $query) or die(mysqli_error($db));
                      while ($row = mysqli_fetch_array($result)) {
                          echo "$row[0]";
                        }
                      ?> ETB
                    </div>
                  </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-800"></i>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
        <!-- Customer record -->
          <div class="col-md-12 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-0">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Stock Alert</div>
                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                      <?php 
                      $query_in = "SELECT *, SUM(quantity) as total_quantity FROM stockin where quantity > 0 group by pro_name";
                      $result_in = mysqli_query($db, $query_in) or die (mysqli_error($db));
                      $count = 0; 
                      while($row = mysqli_fetch_assoc($result_in)){
                        if($row['total_quantity'] <= 10){
                          $count += 1;
                        }
                      }
                      echo $count;
                      // echo $row['total_quantity'];   
                      ?> Record(s)
                    </div>
                  </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-800"></i>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
        <!-- Customer record -->
          <div class="col-md-12 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-0">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Expire Alert</div>
                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                    <?php   
                    $query_expire = "SELECT 
                              COUNT(*) AS total_expiring_soon
                          FROM 
                              stockin
                          WHERE 
                              DATEDIFF(expired_date, CURDATE()) < 30 and quantity > 0";
                    $result = mysqli_query($db, $query_expire) or die(mysqli_error($db));  
                    $row = mysqli_fetch_assoc($result);
                    echo $row['total_expiring_soon'];             
                    ?> Record(s)
                    </div>
                  </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-800"></i>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</div>      
<?php
include'../includes/footer.php';
?>