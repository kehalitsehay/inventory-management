<?php 

include'../includes/connection.php';
if(isset($_GET['rejectid'])){
  $id = $_GET['rejectid'];

  $sql = "update `purcase_req` set status = 'Rejected' where id=$id";
  $result = mysqli_query($db, $sql);
  if($result){
    // echo "Updated successfully!";
    header("Location: requ_admin_approve.php");
  }else{
    die(mysqli_error($db));
  }
}
?>