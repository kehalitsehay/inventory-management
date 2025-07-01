<?php
require('session.php');
include '../includes/connection.php';

if (!isset($_SESSION['MEMBER_ID'])) {
    header("Location: login.php"); // Redirect if not logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['MEMBER_ID'];
    $new_username = $_POST['new_user'];
    $new_password = $_POST['new_password'];
    $u_new_password = sha1($new_password);

    // Update username and password
    $query = "UPDATE users SET username = ?, password = ?, force_password_change = FALSE WHERE ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $new_username, $u_new_password, $user_id);

    if ($stmt->execute()) {
      echo "Credentials updated successfully. Redirecting to your dashboard...";
        header("location: login.php");
    } else {
        echo "Error updating credentials: " . $stmt->error;
    }
    $stmt->close();
    ?>

    
    <?php
}
?>
