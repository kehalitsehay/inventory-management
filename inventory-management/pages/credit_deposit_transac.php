<?php 
include'../includes/connection.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){

$credit_id = $_POST['credit_id'];
$transac_id = $credit_id;
$balance = $_POST['amount'];
$bank = $_POST['bank'];
$desc = $_POST['desc'];
$customer = $_POST['customer'];
$currentDate = date('Y-m-d');


// credit_customer start
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
  global $creditBalance, $discount, $interest, $finalAmount;

  // Update credit balance
  $newBalance = $finalAmount - $balance;
  // $status = $newBalance <= 0 ? 'paid' : 'active';
  $updateQuery = "UPDATE credit_customer SET credit_balance = ?, paied_date = NOW(), discount = ?, interest = ? WHERE credit_id = ?";
  $updateStmt = $conn->prepare($updateQuery);
  $updateStmt->bind_param("dddi", $newBalance, $discount, $interest, $credit_id);
  $updateStmt->execute();
// credit_customer end
}