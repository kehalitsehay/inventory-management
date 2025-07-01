<?php 

include'../includes/connection.php';
if(isset($_GET['approveid'])){
  $id = $_GET['approveid'];

  $sql = "update `leave_requests` set status = 'approved' where leave_id=$id";
  $result = mysqli_query($db, $sql);
  if($result){
    // echo "Updated successfully!";
    header("Location: review_leave_request.php");
  }else{
    die(mysqli_error($db));
  }
}
?>