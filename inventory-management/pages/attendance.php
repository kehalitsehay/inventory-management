<?php
include'../includes/connection.php';
include'../includes/sidebar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employee_id = $_POST['employee_id'];
    $employee = $_POST['employee'];
    $status = $_POST['status'];

    $query = "INSERT INTO attendance (employee_name, employee_id, status, date)
            VALUES (?, ?, ?, NOW())"; 

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $employee, $employee_id, $status);
    $stmt->execute();
    ?>
    <script type="text/javascript">
        alert("Attendance recorded successfully.");
    </script>
    <?php
    
}

?>


<?php
    $query = "SELECT * from employee";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

    $employee = "<select class='form-control' name='employee' required>
        <option disabled selected hidden>Select Employee</option>";
    while ($row = mysqli_fetch_assoc($result)) {
    $employee .= "<option value='".$row['FIRST_NAME']."  ".$row['LAST_NAME']."'>".$row['FIRST_NAME']."  ".$row['LAST_NAME']."</option>";
    }

    $employee .= "</select>";
    $query2 = "SELECT * from employee";
    $result2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
    $employee_id = "<select class='form-control' name='employee_id' required>
        <option disabled selected hidden>Select Employee Id</option>";
    while ($row = mysqli_fetch_assoc($result2)) {
    $employee_id .= "<option value='".$row['EMPLOYEE_ID']."'>".$row['EMPLOYEE_ID']."</option>";
    }

    $employee_id .= "</select>";
?>

<h3>Take daily attendance for your employee</h3>
    <form method="post" class="row g-3">
        <div class="col-md-3 pt-3">
                <?php
                echo $employee_id;
                ?>
            </div>    
        <div class="col-md-3 pt-3">
            <?php
            echo $employee;
            ?>
        </div>
        <div class="col-md-3 pt-3">
            <select name="status" class="form-control">
                <option value="1">Present</option>
                <option value="1">Permission</option>
                <option value="0">Absent</option>
                <option value="0">Without Payment</option>
            </select>
        </div>
        <div class="col-12 text-center pt-3">
            <button type="submit" class="btn btn-primary float-start">Save</button>
        </div>
        
    </form>


<?php
include'../includes/footer2.php';
?>