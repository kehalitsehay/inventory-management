<?php 

include'../includes/connection.php';
if(isset($_GET['approveid'])){
  $id = $_GET['approveid'];

  $query = "select status from purcase_req where id=$id";
  $query_result = mysqli_query($db, $query);
  $row = mysqli_fetch_array($query_result);
  if($row['status'] == 'Pending'){
    $sql = "update `purcase_req` set status = 'Approved' where id=$id";
    $result = mysqli_query($db, $sql);
    if($result){
    // echo "Updated successfully!";
    header("Location: requ_admin_approve.php");
    }else{
    die(mysqli_error($db));
    }
  }else{
    ?>
    <script>
      alert("Purchase request status should be Pending to be approved!")
      window.location='requ_admin_approve.php';
    </script>
    <?php
  }

  
}
?>