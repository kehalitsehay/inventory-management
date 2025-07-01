<?php

include('../includes/connection.php');

			$account_code = $_POST['account_code'];
			$account_name = $_POST['account_name'];
			$sub_account = $_POST['sub_account'];
			$account_category = $_POST['account_category'];
			
	 			$query = 'UPDATE chart_of_account set account_code="'.$account_code.'", account_name = "'.$account_name.'", sub_account="'.$sub_account.'",account_category ="'.$account_category.'" where account_code = "'.$account_code.'" ';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
						
?>	
	<script type="text/javascript">
			alert("You've Update Chart of Account Successfully.");
			window.location = "chart_of_account.php";
		</script>