<?php
include '../includes/connection.php';
?>
<?php
if(isset($_GET['purrej'])){
  $id = $_GET['purrej'];

  $query = 'update `stockin_request` set req_status = "Rejected" where id=$id ';
  mysqli_query($db, $query) or die(mysqli_error($db));
}
?>
<script>
  window.location = "purchase_request_approve.php";
</script>