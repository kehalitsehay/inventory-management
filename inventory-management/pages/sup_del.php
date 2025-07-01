<?php

include'../includes/connection.php';

	if (!isset($_GET['SUPPLIER_ID'])) {
						
    	
    			$query = 'DELETE FROM supplier WHERE SUPPLIER_ID = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));
				}			
            ?>
    			<script type="text/javascript">alert("Supplier Successfully Deleted.");
						window.location = "supplier.php";
					</script>					