<?php
include'../includes/connection.php';

if (isset($_GET['exrej'])){
            $id = $_GET['exrej'];
            $query = "SELECT * from expense where expense_id = $id";
            $query_result = mysqli_query($db, $query);
            $row = mysqli_fetch_array($query_result);
            if($row['status']=='Pending'){
              $query = "update `expense` set status = 'Rejected' where expense_id = $id";
              $query_result = mysqli_query($db, $query);
              if($query_result){
                ?>
                  <script>
                    alert("Expense Request Approval Rejected!")
                  </script>
                <?php
              }else{
                die(mysqli_error($db));
              }
            }else {
              ?>
              <script>
                alert("Expense Request Status Should be Pending!");
              </script>
              <?php
            }
}
?>
              <script>
                window.location = "expense_request_approve.php";
              </script>
