<?php
include('../includes/connection.php');
			$prodcode = $_POST['id'];
			$prodname = $_POST['prodname'];
		  $category = $_POST['category'];
			$quantity = $_POST['quantity'];
      $unit = $_POST['unit'];
      $price = $_POST['price'];
      $supplier = $_POST['supplier'];
      $date = $_POST['date'];
      $status = $_POST['status'];
	   	
		
	 			$query = 'UPDATE purcase_req set 
          PRODUCT_CODE = "'.$prodcode.'",
          NAME ="'.$prodname.'", 
          CATEGORY = "'.$category.'",
          QUANTITY = "'.$quantity.'",
          UNIT = "'.$unit.'",
          PRICE = "'.$price.'",
          CNAME = "'.$supplier.'",
          DATE = "'.$date.'",
          STATUS = "'.$status.'"
          WHERE
					PRODUCT_CODE ="'.$prodcode.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));
		
					
?>	
	<script type="text/javascript">
			alert("You've Update purchase request Successfully.");
			window.location = "requ.php";
		</script>