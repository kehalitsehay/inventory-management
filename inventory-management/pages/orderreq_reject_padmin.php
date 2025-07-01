<?php 

include'../includes/connection.php';
if(isset($_GET['rejectid'])){
  $id = $_GET['rejectid'];

  $sql = "update `purcase_req` set status = 'Purchase Rejected' where id=$id";
  $result = mysqli_query($db, $sql);
  if($result){
    // echo "Updated successfully!";
    header("Location: purchase_admin.php");
  }else{
    die(mysqli_error($db));
  }
}
?>