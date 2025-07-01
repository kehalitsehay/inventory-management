<?php 

include'../includes/connection.php';
if(isset($_GET['purchaseapp'])){
  $id = $_GET['purchaseapp'];

  $query = "select status from purcase_req where id=$id";
  $query_result = mysqli_query($db, $query);
  $row = mysqli_fetch_array($query_result);
  if($row['status'] == 'Approved' || $row['status'] == 'Purchase Rejected'){
    $sql = "update `purcase_req` set status = 'Purchase' where id=$id";
    $result = mysqli_query($db, $sql);
    if($result){
    // echo "Updated successfully!";
    header("Location: purchaseAdmin.php");
    }else{
    die(mysqli_error($db));
    }
  }else{
    ?>
    <script>
      alert("Purchase request status should be Approved to be Purchase!")
      window.location='purchaseAdmin.php';
    </script>
    <?php
  }
}
?>