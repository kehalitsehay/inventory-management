<?php
include'../includes/connection.php';
      $emp = $_POST['employee'];
      $cata = $_POST['category'];
      $amount = $_POST['amount'];
      $desc = $_POST['description'];
      $bank = $_POST['bank'];

      function addExpenses($emp, $cata, $amount, $desc, $bank){
        global $conn;
        $addExpense =  $conn->prepare("INSERT INTO expense (requested_by, category, amount, description, date, status, bank) values (?, ?, ?, ?, NOW(), 'Pending', ?)");
        $addExpense->bind_param('ssdss', $emp, $cata, $amount, $desc, $bank);
        $addExpense->execute();
      }

      switch ($_GET['action']){
        case 'add':
          addExpenses($emp, $cata, $amount, $desc, $bank);
      }
    ?>
    <script>
      window.location = "expense.php"
    </script>