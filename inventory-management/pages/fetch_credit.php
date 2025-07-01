<?php
include'../includes/connection.php';

// Fetch credit details
$creditId = $_GET['credit_id']; // Pass credit ID as a query parameter
if (!$creditId) {
  echo json_encode(['error' => 'No credit ID provided']);
  exit;
}
$query = "SELECT credit_balance, due_date FROM credit_customer WHERE credit_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $creditId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $creditBalance = $row['credit_balance'];
    $dueDate = $row['due_date'];
    $currentDate = date('Y-m-d');

    // Calculate days early or late
    $daysLate = max(0, (strtotime($currentDate) - strtotime($dueDate)) / (60 * 60 * 24));
    $daysEarly = max(0, (strtotime($dueDate) - strtotime($currentDate)) / (60 * 60 * 24));

    // Define rates
    $interestRate = 0.05; // 5% daily interest
    $discountRate = 0.02; // 2% daily discount

    // Calculate final amount
    if ($daysEarly > 0) {
        $finalAmount = $creditBalance - ($creditBalance * $discountRate * $daysEarly);
    } elseif ($daysLate > 0) {
        $finalAmount = $creditBalance + ($creditBalance * $interestRate * $daysLate);
    } else {
        $finalAmount = $creditBalance; // No discount or interest
    }

    // Return data
    echo json_encode([
        'credit_balance' => $creditBalance,
        'final_amount' => $finalAmount,
        'days_early' => $daysEarly,
        'days_late' => $daysLate
    ]);
} else {
    echo json_encode(['error' => 'Credit not found']);
}
?>
