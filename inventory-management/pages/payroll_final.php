<?php
include '../includes/connection.php';
include '../includes/sidebar.php';
require 'auth_functions.php';

checkAccess('Admin'); 

?>

<?php
  
  $sql = "select distinct EMPLOYEE_ID from employee";
  $result = mysqli_query($db, $sql);  
  $sql2 = "select distinct pro_name from stockin order by pro_name";
  $result2 = mysqli_query($db, $sql2);
  $sql3 = "select distinct category from stockin order by category";
  $result3 = mysqli_query($db, $sql3);
  $query = "select distinct FIRST_NAME, LAST_NAME from customer order by FIRST_NAME";
  $results = mysqli_query($db, $query);
        
        
?>

<h3>Add Employee to Payslip</h3>


<form id="addToCartForm" class="row g-3">
  <div class="col-md-2 pt-3">
    <label for="product_id" class="form-label">Employee ID</label>
    <select id="product_id" name="product_id" class="form-control form-select mySelect2" required>
       <option value="">--Select--</option>
          <?php
          while($row = mysqli_fetch_array($result)){
            $k = $row['EMPLOYEE_ID'];
            echo '<option value="'.$k.'">'.$k.'</option>'; 
          }
        ?>
        
      </select>
  </div>
  <div class="col-md-2 pt-3">
    <label for="product_name" class="form-label">Employee Name</label>
    <input id="product_name" name="product_name" class="form-control">  
  </div>
  <div class="col-md-2 pt-3">
    <label for="attendance" class="form-label">Attendance</label>
    <input id="attendance" name="attendance" class="form-control" readonly>  
  </div>
  <div class="col-md-2 pt-3">
    <label for="product_unit" class="form-label">Salary</label>
    <input id="product_unit" name="product_unit" class="form-control">  
  </div>

 <div class="col-md-2 pt-3">
    <label for="transport" class="form-label">Transport</label>
    <input type="number"  min="0" max="999999999" class="form-control"  id="transport" name="transport" step ="any" required>
  </div>
  <div class="col-md-2 pt-3">
    <label for="incentives" class="form-label">Incentives</label>
    <input type="number"  min="0" max="999999999" class="form-control"  id="incentives" name="incentives" step ="any" required>
  </div>
  <div class="col-md-2 pt-3">
    <label for="others" class="form-label">Others</label>
    <input type="number"  min="0" max="999999999" class="form-control"  id="others" name="others" step ="any" required>
  </div>

  <div class="col-12 text-center py-3">
    <button type="submit" class="btn btn-primary">Calculate Payroll</button>
  </div>
</form>


<h3>Employee in the payslip</h3>
<div class="card shadow mb-4">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th>S/N</th>
                        <th>Employee Name</th>
                        <th>Attendance</th>
                        <th>Salary</th>
                        <th>Transport</th>
                        <th>Incentives</th>
                        <th>Others</th>
                        <th>Gross</th>
                        <th>Tax</th>
                        <th>Pension(11%)</th>
                        <th>Pension(7%)</th>
                        <th>Deduction</th>
                        <th>Net Pay</th>
                        <th>Action</th>
                  </tr>
              </thead>
              <tbody id="cartItems">
                  <tr>
                      <td colspan="13">No Employee salary in payslip</td>
                  </tr>
              </tbody>
      </table>
    </div>
  </div>
</div>
<div class="pt-3">
<h6>Total Gross ETB: <span id="grossTotal">0.00</span></h6>
<h6>Total Deduction ETB: <span id="deductTotal">0.00</span></h6>
<h6>Total Net Pay ETB: <span id="netTotal">0.00</span></h6>
</div>

<form id="checkout-form" action="payroll_transac.php" method="POST" class="row g-3">
<div class="col-md-3 pt-2">
    <label for="bank" class="form-label">Bank for Payroll Payment</label>
    <select class = "form-control" id="bank" name = "bank" required>
      <option value="">-- Select Bank --</option>
      <option value="abay">Abay</option>
      <option value="abyssinia">Abyssinia</option>
      <option value="cbe">CBE</option>
      <option value="ahadu">Ahadu</option>
      <option value="awash">Awash</option>
      <option value="amhara">Amhara</option>   
    </select>
  </div>
  <div class="col-12 text-center py-3">
    <button type="submit" class="btn btn-primary">Save and Pay</button>
  </div>
</form>

      <script>
        function updateCart() {
            $.post('payroll_backend.php', { action: 'get_cart' }, function (response) {
                if (response.status === 'success') {
                    let cartItems = response.cart;
                    let cartHTML = '';
                    let t_gross = 0;
                    let t_deduct = 0;
                    let t_net = 0;

                    cartItems.forEach((item, index) => {
                        t_gross += item.subtotal;
                        t_deduct += item.totalDeduct;
                        t_net += item.netPay;
                        cartHTML += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.product_name}</td>
                                <td>${item.attendance}</td>
                                <td>${item.quantity.toFixed(2)}</td>
                                <td>${item.transport.toFixed(2)}</td>
                                <td>${item.incentives.toFixed(2)}</td>
                                <td>${item.others.toFixed(2)}</td>
                                <td>${item.subtotal.toFixed(2)}</td>
                                <td>${item.tax.toFixed(2)}</td>
                                <td>${item.pension_11.toFixed(2)}</td>
                                <td>${item.pension_7.toFixed(2)}</td>
                                <td>${item.totalDeduct.toFixed(2)}</td>
                                <td>${item.netPay.toFixed(2)}</td>
                                <td><button onclick="removeItem('${item.product_id}')" class="btn btn-sm btn-danger">Remove</button></td>
                            </tr>
                        `;
                    });

                    $('#cartItems').html(cartHTML || '<tr><td colspan="13">No Employee in the in payslip</td></tr>');
                    $('#grossTotal').text(t_gross.toFixed(2));
                    $('#deductTotal').text(t_deduct.toFixed(2));
                    $('#netTotal').text(t_net.toFixed(2));
                }
            }, 'json');
        }


        function removeItem(productId) {
            $.post('cart_backend.php', { action: 'remove_item', product_id: productId }, function () {
                updateCart();
            });
        }

        $('#addToCartForm').on('submit', function (e) {
            e.preventDefault();
            const data = $(this).serialize() + '&action=add_to_cart';
            $.post('payroll_backend.php', data, function () {
                updateCart();
                $('#addToCartForm')[0].reset();
            });
        });

        $(document).ready(function () {
            updateCart();
        });
        
    </script>
  <script>
      // fetching products unit based on the product code automatically
      
        $(document).ready(function () {
            $('#product_id').on('input', function () {
                const product_id = $(this).val();

                if (product_id) {
                    $.ajax({
                        url: 'get_employee_name.php',
                        type: 'POST',
                        data: { product_id: product_id },
                        success: function (response) {
                            $('#product_name').val(response);
                        },
                        error: function () {
                            alert('Error fetching product name.');
                        }
                    });
                } else {
                    $('#product_name').val('');
                }
            });
        });
        $(document).ready(function () {
            $('#product_id').on('input', function () {
                const product_id = $(this).val();

                if (product_id) {
                    $.ajax({
                        url: 'get_employee_attendance.php',
                        type: 'POST',
                        data: { product_id: product_id },
                        success: function (response) {
                            $('#attendance').val(response);
                        },
                        error: function () {
                            alert('Error fetching product name.');
                        }
                    });
                } else {
                    $('#attendance').val('');
                }
            });
        });
        $(document).ready(function () {
            $('#product_id').on('input', function () {
                const product_id = $(this).val();

                if (product_id) {
                    $.ajax({
                        url: 'get_employee_salary.php',
                        type: 'POST',
                        data: { product_id: product_id },
                        success: function (response) {
                            $('#product_unit').val(response);
                        },
                        error: function () {
                            alert('Error fetching product unit.');
                        }
                    });
                } else {
                    $('#product_unit').val('');
                }
            });
        });
  </script>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
      <?php include '../includes/script.php'?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    

        <script>
          $(document).ready(function() {
            $('.mySelect2').select2();
          });
        </script>

  <script>
    // new DataTable('#dataTable', {
    //     layout: {
    //         topStart: {
    //             buttons: []
    //         }
    //     }
    // });
  </script>

<?php
  include '../includes/footer2.php';
?>