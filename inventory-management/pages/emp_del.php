<?php
include'../includes/connection.php';

	if (!isset($_GET['EMPLOYEE_ID'])) {
						
    			$query = 'DELETE FROM employee WHERE EMPLOYEE_ID = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));	
				}			
            ?>
    			<script type="text/javascript">alert("Employee Successfully Deleted.");
						window.location = "employee.php";
					</script>					