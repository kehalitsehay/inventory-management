<?php
include '../includes/connection.php';
function generateBankStatement($conn, $start_date, $end_date) {
  $stmt = $conn->prepare("SELECT transaction_date, transaction_type, amount, category, description FROM bank_account WHERE transaction_date BETWEEN ? AND ?");
  $stmt->bind_param("ss", $start_date, $end_date);
  $stmt->execute();
  $result = $stmt->get_result();

  echo "<h2>Bank Statement</h2>";
  echo "<table border='1'>";
  echo "<tr><th>Date</th><th>Type</th><th>Amount</th><th>Category</th><th>Description</th></tr>";
  while ($row = $result->fetch_assoc()) {
      echo "<tr>
              <td>{$row['transaction_date']}</td>
              <td>{$row['transaction_type']}</td>
              <td>{$row['amount']}</td>
              <td>{$row['category']}</td>
              <td>{$row['description']}</td>
            </tr>";
  }
  echo "</table>";

  $stmt->close();
}

// Usage
$start_date = '2024-01-01';
$end_date = '2024-12-31';
generateBankStatement($conn, $start_date, $end_date);


?>

