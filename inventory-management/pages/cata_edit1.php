<?php

include('../includes/connection.php');

			$cata_code = $_POST['cata_code'];
			$cata_name = $_POST['cata_name'];
			
		// print_r($cata_code);
	 			$query = 'UPDATE category set CATEGORY_ID = "'.$cata_code.'", CNAME = "'.$cata_name.'" WHERE
					CATEGORY_ID ="'.$cata_code.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));

							
?>	
	<script type="text/javascript">
			alert("You've Updated Category Successfully.");
			window.location = "category.php";
		</script>