<?php
include'../includes/connection.php';

	if (!isset($_GET['PRODUCT_CODE'])) {
						
    			$query = 'DELETE FROM purchse WHERE PRODUCT_CODE = ' . $_GET['id'];
    			$result = mysqli_query($db, $query) or die(mysqli_error($db));	
				}			
            ?>
    			<script type="text/javascript">alert("Purchase Successfully Deleted.");
						window.location = "purchase.php";
					</script>					