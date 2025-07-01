<?php
include '../includes/connection.php';
include '../includes/sidebar_sales.php';

        global $creditBalance, $discount, $interest, $finalAmount;
        if($_SERVER['REQUEST_METHOD'] === "POST"){

          $credit_id = $_POST['credit_id'];
          $customer = $_POST['customer_id'];
          $currentDate = date('Y-m-d');

          // Fetch credit details
            $query = "SELECT credit_balance, due_date FROM credit_customer WHERE credit_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $credit_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $credit = $result->fetch_assoc();

            $creditBalance = $credit['credit_balance'];
            $dueDate = $credit['due_date'];

            // Check payment timing
            $daysDifference = (strtotime($dueDate) - strtotime($currentDate)) / 86400;
            $discount = 0;

            if ($daysDifference >= 20) { // Early payment
                $discount = $creditBalance * 0.05; // 5% discount
            } 

            $daysLate = max(0, ceil((strtotime($currentDate) - strtotime($dueDate)) / 86400));
            $dailyInterestRate = 0.001; // 0.1% daily interest rate
            $interest = $daysLate > 0 ? $creditBalance * $dailyInterestRate * $daysLate : 0;

            $finalAmount = $creditBalance - $discount + $interest;
            
        }
          ?>
          
<?php
$sql = "SELECT * FROM credit_customer where credit_balance > 0";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql3");
?>
<h3>Receive money from Credit Customer</h3>
<form class="row g-3" method="POST">
  <div class="col-md-2">
    <label for="credit_id" class="form-label">Credit Id</label>
    <select id="credit_id" name="credit_id" class="form-control" required>
       <option value="">--Select--</option>
          <?php
          while($row = mysqli_fetch_array($result)){
            $k = $row['credit_id'];
            echo '<option value="'.$k.'">'.$k.'</option>'; 
          }
        ?>
        
      </select>
  </div>
  <div class="col-md-2">
    <label for="customer_id" class="form-label">Customer ID</label>
    <input class="form-control" name="customer_id" id="customer_id">
  </div>
  <div class="col-md-2">
    <label for="credit_balance" class="form-label">Credit Balance</label>
    <input class="form-control" name="credit_balance" id="credit_balance">
  </div>
  <div class="col-12 text-center py-3">
    <button type="submit" class="btn btn-primary">Calculate</button>
  </div>
</form>
<form action="process_payment.php" class="row g-3" method="POST" >
  <input type="hidden" name="credit_id" value="<?php echo $credit_id; ?>">
  <input type="hidden" name="customer_id" value="<?php echo $customer; ?>">

  <div class="col-md-2">
      <label for="discount" class="form-label">Discount</label>
      <input class="form-control" name="discount" id="discount" value="<?php echo  $discount ? $discount: 0 ?>">
    </div>
    <div class="col-md-2">
      <label for="interest" class="form-label">Interest</label>
      <input class="form-control" name="interest" id="interest" value="<?php echo  $interest? $interest:0?>">
    </div>
    <div class="col-md-2">
      <label for="final_amount" class="form-label">Final Amount</label>
      <input class="form-control" name="final_amount" id="final_amount" value="<?php echo  $finalAmount? $finalAmount:0?>">
    </div>
  <div class="col-md-2">
      <label for="payment_amount" class="form-label">Payment Amount</label>
      <input class="form-control" id="payment_amount" name="payment_amount" required>
    </div>
    <div class="col-md-2">
      <label for="bank" class="form-label">Bank</label>
      <select class = "form-control" name = "bank" aria-label="Default select example" required>
          <option value="">--Select Bank--</option>
          <option value="cbe">CBE</option>
          <option value="awash">Awash</option>
          <option value="amhara">Amhara</option>
          <option value="ahadu">Ahadu</option>
          <option value="abay">Abay</option>
          <option value="abyssinia">Abyssinia</option>select>
          <option value="cash">Cash</option>
      </select>
    </div>
    <div class="col-md-2">
      <label for="desc" class="form-label">Description</label>
      <textarea class="form-control" name="desc" for="desc" placeholder="Received from Mr. -----" required>
      </textarea>
    </div>
    <div class="col-12 text-center py-3">
      <button type="submit" class="btn btn-primary">Pay Now</button>
    </div>
</form>
    <div class="card shadow mb-4">
      <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">        
                  <thead>
                      <tr>
                        <th>Credit ID</th>
                        <th>Customer ID</th>
                        <th>Credit Balance</th>
                        <th>Due Date</th>
                        <th>Paid Date</th>
                        <th>Discount</th>
                        <th>Interest</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php                  
                      $query = 'SELECT * FROM credit_customer where credit_balance > 0';
                      $result = mysqli_query($db, $query) or die (mysqli_error($db));
        
                      while ($row = mysqli_fetch_assoc($result)) {
                      echo '<tr>';
                      echo '<td>'. $row['credit_id'].'</td>';
                      echo '<td>'. $row['customer_id'].'</td>';
                      echo '<td>'. $row['credit_balance'].'</td>';
                      echo '<td>'. $row['due_date'].'</td>';
                      echo '<td>'. $row['paied_date'].'</td>';
                      echo '<td>'. $row['discount'].'</td>';
                      echo '<td>'. $row['interest'].'</td>';
                      echo '</tr> ';
                      }
                    ?>
                  </tbody>
                </table>
              </div>
      </div>
    </div>
<script>
        $(document).ready(function () {
            $('#credit_id').on('input', function () {
                const creditId = $(this).val();

                if (creditId) {
                    $.ajax({
                        url: 'get_credit.php',
                        type: 'POST',
                        data: { credit_id: creditId },
                        success: function (response) {
                            $('#credit_balance').val(response);
                        },
                        error: function () {
                            alert('Error fetching credit balance.');
                        }
                    });
                } else {
                    $('#credit_balance').val('');
                }
            });
        });
        $(document).ready(function () {
            $('#credit_id').on('input', function () {
                const creditId = $(this).val();

                if (creditId) {
                    $.ajax({
                        url: 'get_customer.php',
                        type: 'POST',
                        data: { credit_id: creditId },
                        success: function (response) {
                            $('#customer_id').val(response);
                        },
                        error: function () {
                            alert('Error fetching customer id.');
                        }
                    });
                } else {
                    $('#customer_id').val('');
                }
            });
        });
    
    
</script>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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