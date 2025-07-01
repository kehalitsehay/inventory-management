<?php
include '../includes/connection.php';
include '../includes/sidebar_sales.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $employee_id = $_POST['employee_id'];

    $query = "INSERT INTO leave_requests (employee_id, leave_type, start_date, end_date, status)
              VALUES (?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("isss", $employee_id, $leave_type, $start_date, $end_date);
    $stmt->execute();

    echo "Leave request submitted.";
}
?>

<form method="post">
    <label>Employee_Id:</label>
    <input type="number" name="employee_id" required>
    <label>Leave Type:</label>
    <input type="text" name="leave_type" required>
    <label>Start Date:</label>
    <input type="date" name="start_date" required>
    <label>End Date:</label>
    <input type="date" name="end_date" required>

    <button type="submit">Submit Request</button>
</form>


<?php
include'../includes/footer2.php';
?>