<?php
include '../includes/connection.php';
include '../includes/sidebar_sales.php';
require 'auth_functions.php';

checkAccess('Casher'); 
?>
<?php
$date = date('d-m-Y');
$query = 'SELECT *
                     FROM stockout
                     WHERE transac_id ='.$_GET['id'];
            $result = mysqli_query($db, $query) or die (mysqli_error($db));
            $data = mysqli_fetch_array($result);

?>

<div class="card shadow mb-4">
            <!-- < class="card-body"> -->
        <div id="myInvocie">
              <div class="form-group row text-left mb-0">
                <div class="col-sm-9">
		                <h5 class="font-weight-bold text-center">
                      Maedot Hyper Market
                    </h5>
                  <h5 class="font-weight-bold text-center">
                    Sales Invoices
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
                    Customer:
                    </h6>
                  <h6 class="font-weight-bold">
                    <?php echo $data['customer_name']; ?>
                  </h6>
                </div>
                <div class="col-sm-4 py-1"></div>
                <div class="col-sm-4 py-1">
                  <h6>
                    Transaction #<?php echo $data['transac_id']; ?>
                  </h6>
                  <h6 class="font-weight-bold">
                    Cahsier: <?php echo $data['employee']; ?>
                  </h6>
                </div>
              </div>
          <div class="table-responsive">
          <table class="table table-bordered" width="50%" cellspacing="0">
            <thead>
              <tr>
                <th>Products</th>
                <th >Qty</th>
                <th >Price</th>
                <th >Subtotal</th>
                <th >Vat</th>
                <th >Total</th>
              </tr>
            </thead>
            <tbody>
              <?php  
                $query = 'SELECT *
                    FROM stockout
                    WHERE transac_id ='.$_GET['id'] ;
              $result = mysqli_query($db, $query) or die (mysqli_error($db));
              while ($row = mysqli_fetch_assoc($result)) {
              $Sub =  $row['quantity'] * $row['sale_price'];
                echo '<tr>';
                echo '<td>'. $row['pro_name'].'</td>';
                echo '<td>'. $row['quantity'].'</td>';
                echo '<td>'. $row['sale_price'].'</td>';
                echo '<td>'. $row['subtotal'].'</td>';
                echo '<td>'. $row['vat'].'</td>';
                echo '<td>'. $row['total'].'</td>';
                echo '</tr> ';
                        }
                  ?>
            </tbody>
          </table>
          </div>
  
          <h5 class="text-center">Thank you being our valued customer!</h5>
          </div>  
        </div>  
          <div class="mt-4 text-end">  
            <button class="btn btn-info mx-1 px-4" onclick="printMyInvocie()">Print</button>
            <button class="btn btn-secondary mx-1 px-4" onclick="printMyInvocie()">Download</button>
          </div>

          <script>
            function printMyInvocie(){
              var divContent = document.getElementById('myInvocie').innerHTML;
              var a = window.open('', '');
              a.document.write('<html><title>Invocie</title>');
              a.document.write('<body>');
              a.document.write(divContent);
              a.document.write('</body></html>');
              a.document.close();
              a.print();
            }
          </script>


<script src="../js1/jquery.js"></script>
    <script src="../js1/dataTables.js"></script>
    <script src="../js1/dataTableButton.js"></script>
    <script src="../js1/buttonDataTable.js"></script>
    <script src="../js1/jszip.js"></script>
    <script src="../js1/pdfmake.js"></script>
    <script src="../js1/pdfmakefont..js"></script>
    <script src="../js1/buttonhtml.js"></script>
    <script src="../js1/buttonprint.js"></script>
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
include '../includes/footer2.php';
?>