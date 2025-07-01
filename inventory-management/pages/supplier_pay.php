<?php
include '../includes/connection.php';
include '../includes/sidebar_purchase.php';
?>

<?php
$sql = "SELECT * FROM supplier";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql3");
$vendor = "<select class='form-control' name='vendor'>
        <option disabled selected hidden>--Select Vendor--</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $vendor .= "<option value='".$row['SUPPLIER_ID']."'>".$row['COMPANY_NAME']."</option>";
  }
$vendor .= "</select>";
?>
<h3>Pay for Credit Vendors</h3>
<form class="row g-3" method="POST" action="vendor_deposit_transac.php" role="form">
<input type="hidden" name="employee" value="<?php echo $_SESSION['FIRST_NAME']; ?>">
  <div class="col-md-2">
    <label for="transac_id" class="form-label">Transaction ID</label>
    <input type="number" class="form-control" name="transac_id" for="transac_id" required>
  </div>
  <div class="col-md-2">
  <label for="vendor" class="form-label">Vendor</label>
    <?php
    echo $vendor;
    ?>
  </div>
  <div class="col-md-2">
    <label for="amount" class="form-label">Amount</label>
    <input type="number" class="form-control" name="amount" for="amount" required>
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
    <textarea class="form-control" name="desc" for="desc" placeholder="Payment for Mr. ---" required>
    </textarea>
  </div>
  <div class="col-12 text-center py-3">
    <button type="submit" class="btn btn-primary">Pay</button>
  </div>
</form>

<?php
include'../includes/footer2.php';
?>