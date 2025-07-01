<?php
include'../includes/connection.php';
?>

            <?php
              $account_code = $_POST['account_code'];
              $account_name = $_POST['account_name'];
              $sub_account = $_POST['sub_account'];
              $account_category = $_POST['account_category'];
              $balance = $_POST['balance'];
  
              switch($_GET['action']){
                case 'add':  
                  $count = 0;
                  $res = mysqli_query($db, "select * FROM chart_of_account where account_code = '$account_code' && account_name = '$account_name' && sub_account = '$sub_account'") or die (mysqli_error($db));
                  $count = mysqli_num_rows($res);
                  if($count > 0){
                    ?>
                    <script>
                      alert("The chart of account already exists, please enter another new chart of account.")
                      </script>
                    <?php
                    
                  }else{
                    $query = "INSERT INTO chart_of_account
                    VALUES (NULL, '{$account_code}', '{$account_name}','{$sub_account}','{$account_category}', '{$balance}')";
                    mysqli_query($db,$query) or die (mysqli_error($db));
                    ?>
                    <script>
                      alert("The chart of account successfully added.")
                      </script>
                    <?php
                  }
                break;
              }
            ?>
          <script type="text/javascript">
                window.location = "chart_of_account.php";
          </script>