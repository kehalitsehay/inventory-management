<?php
include'../includes/connection.php';
?>
<?php
	if (!isset($_GET['CATEGORY_ID'])) {
        $query = 'DELETE FROM category WHERE CATEGORY_ID = ' . $_GET['id'];
        mysqli_query($db, $query) or die(mysqli_error($db));
    }
										
            ?>
    			<script type="text/javascript">alert("Category Successfully Deleted.");window.location = "category.php";</script>					
            <?php
?>