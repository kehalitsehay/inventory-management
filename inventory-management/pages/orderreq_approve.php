<?php 

include'../includes/connection.php';
if(isset($_GET['approveid'])){
  $id = $_GET['approveid'];

  $sql = "update `purcase_req` set status = 'Approved' where id=$id";
  $result = mysqli_query($db, $sql);
  if($result){
    // echo "Updated successfully!";
    header("Location: purchase_admin.php");
  }else{
    die(mysqli_error($db));
  }
}
?>