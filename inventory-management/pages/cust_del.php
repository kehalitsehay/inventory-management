<?php
include'../includes/connection.php';

	if (!isset($_GET['CUST_ID'])) {
						
    			$query = 'DELETE FROM customer WHERE CUST_ID = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));
	}
            ?>
    			<script type="text/javascript">alert("Customer Successfully Deleted.");
						window.location = "customer.php";
					</script>					
    			
      
	