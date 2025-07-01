
<?php
include '../includes/connection.php';
include '../includes/sidebar.php';
require 'auth_functions.php';

checkAccess(requiredRole: 'Admin'); 
?>
<h3>Insert Beginning Balance</h3>

<form method="POST" action="beginning_balance_transaction.php?action=add">
  <div class="container">
    <div class="row">
      <div class="col-md-2 pt-3">
        <input type="number" name="cash_on_hand" class="form-control" placeholder="Cash on Hand">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="cbe_saving" class="form-control" placeholder="Sav. Acc-CBE">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="amhara_saving" class="form-control" placeholder="Sav. Acc-Amhara">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="ahadu_saving" class="form-control" placeholder="Sav. Acc-Ahadu">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="awash_saving" class="form-control" placeholder="Sav. Acc-Awash">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="abay_saving" class="form-control" placeholder="Sav. Acc-Abay">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="abyssinia_saving" class="form-control" placeholder="Sav. Acc-Abyssinia">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="account_receive" class="form-control" placeholder="Acc Receivable">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="inventory" class="form-control" placeholder="Inventory">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="prepaid" class="form-control" placeholder="Prepaid Expenses">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="property" class="form-control" placeholder="Propty & Equipment">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="account_payable" class="form-control" placeholder="Account Payable">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="purchase_payable" class="form-control" placeholder="Purch Tax Payable">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="tot" class="form-control" placeholder="TOT">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="sales_payable" class="form-control" placeholder="Sale Tax Payable">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="long_term_debit" class="form-control" placeholder="Long Term Debit">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="owner_capital" class="form-control" placeholder="Owners Capital">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="retained_earning" class="form-control" placeholder="Retained Earning">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="product_sales" class="form-control" placeholder="Product Sale">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="other_income" class="form-control" placeholder="Other Income">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="cogs" class="form-control" placeholder="Cost of Goods Sold">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="salary" class="form-control" placeholder="Salary and Wage">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="electricity" class="form-control" placeholder="Electricity">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="internet" class="form-control" placeholder="Internet">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="advert" class="form-control" placeholder="Marketing and Advertisement">  
      </div>
      <div class="col-md-2 pt-3">
        <input type="number" name="miscellaneous" class="form-control" placeholder="Miscellaneous Expenses">  
      </div>
    </div>
  </div>
  <div class="col-12 text-center py-3"> 
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</form>


<?php
  include '../includes/footer2.php';
?>