<?php
include '../includes/connection.php';
include '../includes/sidebar.php';
?>


<h3>Cash Deposit to bank</h3>
<form class="row g-3" method="POST" action="bank_deposit_transac.php?action=add" role="form">
  <div class="col-md-3">
    <label for="transac_id" class="form-label">Transaction ID</label>
    <input type="number" class="form-control" name="transac_id" for="transac_id" required>
  </div>
  <div class="col-md-3">
    <label for="amount" class="form-label">Amount</label>
    <input type="number" class="form-control" name="amount" for="amount" required>
  </div>
  <div class="col-md-3">
    <label for="bank" class="form-label">Bank</label>
    <select class = "form-control" name = "bank" aria-label="Default select example" required>
        <option value="">--Select Bank--</option>
        <option value="cbe">CBE</option>
        <option value="awash">Awash</option>
        <option value="amhara">Amhara</option>
        <option value="ahadu">Ahadu</option>
        <option value="abay">Abay</option>
        <option value="abyssinia">Abyssinia</option>
    </select>
  </div>
  <div class="col-md-3">
    <label for="desc" class="form-label">Description</label>
    <textarea class="form-control" name="desc" for="desc" required>
    </textarea>
  </div>
  <div class="col-12 text-center py-3">
    <button type="submit" class="btn btn-primary">Deposit to bank</button>
  </div>
</form>


<h3>Cash Business Starting</h3>
<form class="row g-3" method="POST" action="cash_deposit_transac.php?action=add" role="form">
  <div class="col-md-3">
    <label for="transac_id" class="form-label">Transaction ID</label>
    <input type="number" class="form-control" name="transac_id" for="transac_id" required>
  </div>
  <div class="col-md-3">
    <label for="amount" class="form-label">Amount</label>
    <input type="number" class="form-control" name="amount" for="amount" required>
  </div>

  <div class="col-md-3">
    <label for="desc" class="form-label">Description</label>
    <textarea class="form-control" name="desc" for="desc" required>
    </textarea>
  </div>
  <div class="col-12 text-center py-3">
    <button type="submit" class="btn btn-primary">Deposit to Cash</button>
  </div>
</form>

<?php
include'../includes/footer2.php';
?>