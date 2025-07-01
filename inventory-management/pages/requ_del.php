<?php
include'../includes/connection.php';
?>
<?php 
	if (!isset($_GET['PRODUCT_CODE'])) {
        $query = 'DELETE FROM purcase_req WHERE PRODUCT_CODE = ' . $_GET['id'];
        mysqli_query($db, $query) or die(mysqli_error($db));
    }
										
            ?>
    			<script type="text/javascript">alert("Request Successfully Deleted.");window.location = "requ.php";</script>					
            <?php
?>