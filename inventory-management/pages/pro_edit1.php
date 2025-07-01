<?php

include('../includes/connection.php');
			$zz = $_POST['id'];
			$pc = $_POST['prodcode'];
			$cata_id = $_POST['cata_id'];
			$cat = $_POST['category'];
			$pname = $_POST['prodname'];
			$unit = $_POST['unit'];
      $pr1 = $_POST['sales_price1'];
      $pr2 = $_POST['sales_price2'];
      $pr3 = $_POST['sales_price3'];
      
		
	 			$query = 'UPDATE product set NAME="'.$pname.'", CATEGORY_ID = "'.$cata_id.'",
					CNAME="'.$cat.'", UNIT ="'.$unit.'" , sales_price1 ="'.$pr1.'" , sales_price2 ="'.$pr2.'" , sales_price3 ="'.$pr3.'" WHERE
					PRODUCT_CODE ="'.$pc.'"';
					$result = mysqli_query($db, $query) or die(mysqli_error($db));

							
?>	
	<script type="text/javascript">
			alert("You've Update Product Successfully.");
			window.location = "product.php";
		</script>