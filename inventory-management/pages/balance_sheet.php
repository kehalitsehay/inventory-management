<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>
<?php  
  
  // $myquery = 'SELECT current_balance FROM chart_of_account order by account_name ';
  // $myresult = mysqli_query($db, $myquery) or die (mysqli_error($db));
  // $row = mysqli_fetch_assoc($myresult);
  // // $all = $row['current_balance'];

  $query = 'SELECT current_balance FROM chart_of_account where account_name = "Property and Equipment"';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result);
  $property = $row['current_balance'];
  $query2 = 'SELECT current_balance FROM chart_of_account where account_name = "Cash on Hand"';
  $result2 = mysqli_query($db, $query2) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result2);
  $cash = $row['current_balance']; 
  $query3 = 'SELECT current_balance FROM chart_of_account where account_name = "Saving Account-CBE"';
  $result3 = mysqli_query($db, $query3) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result3);
  $cbe = $row['current_balance'];
  $query4 = 'SELECT current_balance FROM chart_of_account where account_name = "Saving Account-Amhara"';
  $result4 = mysqli_query($db, $query4) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result4);
  $amhara = $row['current_balance'];
  $query5 = 'SELECT current_balance FROM chart_of_account where account_name = "Saving Account-Ahadu"';
  $result5 = mysqli_query($db, $query5) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result5);
  $ahadu = $row['current_balance'];
  $query6 = 'SELECT current_balance FROM chart_of_account where account_name = "Saving Account-Awash"';
  $result6 = mysqli_query($db, $query6) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result6);
  $awash = $row['current_balance'];
  $query7 = 'SELECT current_balance FROM chart_of_account where account_name = "Account Receivable"';
  $result7 = mysqli_query($db, $query7) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result7);
  $acc_rec = $row['current_balance'];
  $query8 = 'SELECT current_balance FROM chart_of_account where account_name = "Inventory"';
  $result8 = mysqli_query($db, $query8) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result8);
  $inventory = $row['current_balance'];
  $query9 = 'SELECT current_balance FROM chart_of_account where account_name = "Owners Capital"';
  $result9 = mysqli_query($db, $query9) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result9);
  $capital = $row['current_balance'];
  $query10 = 'SELECT current_balance FROM chart_of_account where account_name = "Account Payable"';
  $result10 = mysqli_query($db, $query10) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result10);
  $acc_pay = $row['current_balance'];
  $query12 = 'SELECT current_balance FROM chart_of_account where account_name = "Purchase Tax Payable"';
  $result12 = mysqli_query($db, $query12) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result12);
  $purchase = $row['current_balance'];
  $query13 = 'SELECT current_balance FROM chart_of_account where account_name = "Sales Tax Payable"';
  $result13 = mysqli_query($db, $query13) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result13);
  $sales = $row['current_balance'];
  $query11 = 'SELECT current_balance FROM chart_of_account where account_name = "TOT"';
  $result11 = mysqli_query($db, $query11) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result11);
  $tot = $row['current_balance']; 
  $query14 = 'SELECT current_balance FROM chart_of_account where account_name = "Product Sale"';
  $result14 = mysqli_query($db, $query14) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result14);
  $pro_sales = $row['current_balance'];
  $query15 = 'SELECT current_balance FROM chart_of_account where account_name = "Cost of Goods Sold"';
  $result15 = mysqli_query($db, $query15) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result15);
  $cogs = $row['current_balance'];

  $net_profit = $pro_sales - $cogs;
  $total_cur_asset = $cash + $inventory + $acc_rec + $cbe + $awash + $ahadu + $amhara; 
  $total_fixed_asset = $property;
  $total_asset = $total_cur_asset + $total_fixed_asset;
  $total_liabilities = $acc_pay + $purchase + $sales + $tot;
  $total_equity = $capital + $net_profit;
  $total_E_Q =  $total_equity + $total_liabilities;


?>
<div class="text-center">
<h3>Maedot Hypermarket </h3>
<h3>Balance Sheet</h3>
<h4>As of -------</h4>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h3>Asset</h3>
      <h4>Fixed Asset</h4>
      <ul style="list-style: none;">
        <li>Property and Equipment: <?php echo $property?></li>
        <li>Total Fixed Asset: <?php echo $property?></li>
      </ul>
      <h4>Current Asset</h4>
      <ul style="list-style: none;">
        <li>Cash on Hand: <?php echo $cash?></li>
        <li>Saving Account-CBE:<?php echo $cbe?></li>
        <li>Saving Account-Amhara:<?php echo $amhara?></li>
        <li>Saving Account-Ahadu:<?php echo $ahadu?></li>
        <li>Saving Account-Awash:<?php echo $awash?></li>
        <li>Account Receivable:<?php echo $acc_rec?></li>
        <li>Inventory: <?php echo $inventory?></li>
        <li>Total Current Asset: <?php echo $total_cur_asset?></li>
      </ul>
      <ul style="list-style: none;">
        <li>Total of Asset: <?php echo $total_cur_asset + $property?></li>
      </ul>
    </div>
    <div class="col-md-6">
      <h3>Liability and Equity</h3>
      <h4>Owners Equities</h4>
      <ul style="list-style: none;">
        <li>Owners Capital: <?php echo $capital?></li>
        <li>Net Profit: <?php echo $net_profit?></li>
        <li>Total Equities:<?php echo $total_equity ?></li>
      </ul>
      <h4>Liabilities</h4>
      <ul style="list-style: none;">
        <li>Account Payable:<?php echo $acc_pay?></li>
        <li>Purchase Tax Payable:<?php echo $purchase?></li>
        <li>Sales Tax Payable:<?php echo $sales?></li>
        <li>TOT:<?php echo $tot?></li>
        <li>Total Liabilities:<?php echo $total_liabilities?></li>
      </ul>
      <ul style="list-style: none;">
        <li>Total of Equities and Liabilities: <?php echo $total_E_Q?></li>
      </ul>
    </div>
  </div>
</div>



<?php
include '../includes/footer2.php';
?>

