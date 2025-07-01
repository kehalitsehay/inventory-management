<?php
include'../includes/connection.php';
include'../includes/topp.php';



 $query2 = 'SELECT * FROM purchse';
        $result = mysqli_query($db, $query2) or die (mysqli_error($db));
        while ($row = mysqli_fetch_assoc($result)) {
  
          $date = $row['DATE'];
          $tid = $row['TRANS_ID'];
          $sub = $row['SUBTOTAL'];
          $less = $row['VAT'];
          $net = $row['TOTAL'];
          $role = $row['EMPLOYEE'];
          $roles = $row['ROLE'];
          $cname = $row['COMPANY_NAME'];
        }
?>
      <form method="post" action="export_excel.php">
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="form-group row text-left mb-0">
                <div class="col-sm-9">
                  <h5 class="font-weight-bold">
                    Selam Arigiw Hyper Market
                  </h5>
                  <h5 class="font-weight-bold">
                    Sales and Inventory
                  </h5>
                </div>
                <div class="col-sm-3 py-1">
                  <h6>
                    Date: <?php echo $date; ?>
                  </h6>
                </div>
              </div>
<hr>
              <div class="form-group row text-left mb-0 py-2">
                <div class="col-sm-4 py-1">
                  <h6 class="font-weight-bold">
                    Supplier:
                  </h6>
                  <h6 class="font-weight-bold">
                    <?php echo $cname; ?> 
                  </h6>
                </div>
                <div class="col-sm-4 py-1"></div>
                <div class="col-sm-4 py-1">
                  <h6>
                    Transaction ID: <?php echo $tid; ?>
                  </h6>
                  <h6 class="font-weight-bold">
                    Purchaser Name: <?php echo $role; ?>
                  </h6>
                  <h6>
                    Role: <?php echo $roles; ?>
                  </h6>
                </div>
              </div>
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Products</th>
                <th width="8%">Qty</th>
                <th width="20%">Price</th>
                <th width="20%">Subtotal</th>
              </tr>
            </thead>
            <tbody>
<?php  
           $query = 'SELECT *
                     FROM purchse
                     WHERE TRANS_ID ='.$tid;
            $result = mysqli_query($db, $query) or die (mysqli_error($db));
            while ($row = mysqli_fetch_assoc($result)) {
              $Sub =  $row['QUANTITY'] * $row['PRICE'];
                echo '<tr>';
                echo '<td>'. $row['NAME'].'</td>';
                echo '<td>'. $row['QUANTITY'].'</td>';
                echo '<td>'. $row['PRICE'].'</td>';
                echo '<td>'. $Sub.'</td>';
                echo '</tr> ';
                        }
?>
            </tbody>
          </table>
            <div class="form-group row text-left mb-0 py-2">
                <div class="col-sm-4 py-1"></div>
                <div class="col-sm-3 py-1"></div>
                <div class="col-sm-4 py-1">
                  <h4>
                    Cash Amount: ETB <?php echo number_format($net, 2); ?>
                  </h4>
                  <table width="100%">
                    <tr>
                      <td class="font-weight-bold">Subtotal</td>
                      <td class="text-right">ETB <?php echo $sub; ?></td>
                    </tr>
                    <tr>
                      <td class="font-weight-bold">VAT</td>
                      <td class="text-right">ETB <?php echo $less; ?></td>
                      </tr>
                    
                    <tr>
                      <td class="font-weight-bold">Total</td>
                      <td class="font-weight-bold text-right text-primary">ETB <?php echo $net; ?></td>
                    </tr>
                  </table>
                </div>
                <div class="col-sm-1 py-1"></div>
              </div>
              <a href="export_excel.php"><button type="button" name= "button">Export to excel</button> </a>
            </div>
          </div>
      </form>


<?php
include'../includes/footer.php';
?>
