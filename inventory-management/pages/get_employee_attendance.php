<?php
include '../includes/connection.php';
// fetch_product.php
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $query = "SELECT status, sum(status) as attendance FROM attendance where employee_id = $product_id";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $row = mysqli_fetch_assoc($result);
    $attendance = $row['attendance'];
    echo $attendance ? $attendance : "Attendance not found";
}
?>
