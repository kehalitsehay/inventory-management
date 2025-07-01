<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>
<?php                  
  $query = 'SELECT current_balance FROM chart_of_account where account_name = "Product Sale"';
  $result = mysqli_query($db, $query) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result);
  $product_sale = $row['current_balance'];
  $query2 = 'SELECT current_balance FROM chart_of_account where account_name = "Other Income"';
  $result2 = mysqli_query($db, $query2) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result2);
  $other_income = $row['current_balance']; 
  $query3 = 'SELECT current_balance FROM chart_of_account where account_name = "Cost of Goods Sold"';
  $result3 = mysqli_query($db, $query3) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result3);
  $cogs = $row['current_balance'];
  $query4 = 'SELECT current_balance FROM chart_of_account where account_name = "Salary Gross Expense"';
  $result4 = mysqli_query($db, $query4) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result4);
  $salary = $row['current_balance'];
  $query5 = 'SELECT current_balance FROM chart_of_account where account_name = "Salary Tax Expense"';
  $result5 = mysqli_query($db, $query5) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result5);
  $salary_tax_expense = $row['current_balance'];
  $query6 = 'SELECT current_balance FROM chart_of_account where account_name = "Electricity"';
  $result6 = mysqli_query($db, $query6) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result6);
  $electricity = $row['current_balance'];
  $query7 = 'SELECT current_balance FROM chart_of_account where account_name = "Water"';
  $result7 = mysqli_query($db, $query7) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result7);
  $water = $row['current_balance'];
  $query8 = 'SELECT current_balance FROM chart_of_account where account_name = "Rent"';
  $result8 = mysqli_query($db, $query8) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result8);
  $rent = $row['current_balance'];
  $query9 = 'SELECT current_balance FROM chart_of_account where account_name = "Marketing and Advertisement"';
  $result9 = mysqli_query($db, $query9) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result9);
  $advert = $row['current_balance'];
  $query10 = 'SELECT current_balance FROM chart_of_account where account_name = "Miscellaneous Expenses"';
  $result10 = mysqli_query($db, $query10) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result10);
  $miscellaneous = $row['current_balance'];
  $query11 = 'SELECT current_balance FROM chart_of_account where account_name = "Internet"';
  $result11 = mysqli_query($db, $query11) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result11);
  $internet = $row['current_balance'];
  $query12 = 'SELECT current_balance FROM chart_of_account where account_name = "Sales Tax Payable"';
  $result12 = mysqli_query($db, $query12) or die (mysqli_error($db));
  $row = mysqli_fetch_assoc($result12);
  $sale_tax_payable = $row['current_balance'];

  $total_rev = $product_sale + $other_income - $cogs;
  $total_exp = $salary + $salary_tax_expense + $electricity + $water + $rent + $advert + $miscellaneous;
  $gross_profit = $total_rev - $total_exp;
  $tax = $gross_profit * 0.15;
  $net_profit = $gross_profit  - $tax;


?>

<div>
  <h3 class="mx-4">Generate Income Statement</h3>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h4>Revenue</h4>
      <ul style="list-style: none;">
        <li>Product Sales: <?php echo $product_sale ?></li> 
        <li>Other Income: <?php echo $other_income ?></li>
        <li>Cost of Goods Sold: <?php echo $cogs ?></li>
        <li>Total: <span style="text-decoration:underline;"><?php echo $total_rev ?></span></li>
      </ul>
      <h4>Operating Expenses</h4>
      <ul style="list-style: none;">
        <li>Salary Gross Expense: <?php echo $salary ?></li>  
        <li>Salary Tax Expense: <?php echo $salary_tax_expense ?></li>  
        <li>Electricity:<?php echo $electricity ?></li>
        <li>Internet:<?php echo $internet ?></li>
        <li>Water:<?php echo $water ?></li>
        <li>Rent:<?php echo $rent ?></li>
        <li>Marketing and Advertisement:<?php echo $advert ?></li>
        <li>Miscellaneous Expenses:<?php echo $miscellaneous ?></li>
        <li>Total:<span style="text-decoration:underline;"><?php echo $total_exp ?></span></li>
      </ul>
      <ul style="list-style: none;">
        <li>Profit: <span style="text-decoration:underline;"><?php echo $gross_profit ?></span></li>
      </ul>
    
    </div>
  </div>
</div>


<?php
include '../includes/footer2.php';
?>

