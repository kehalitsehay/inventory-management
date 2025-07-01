<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $emp = $_POST['empid'];
              $user = $_POST['username'];
              $pass = $_POST['password'];
              $role = $_POST['role'];
              $force = 1;

          switch($_GET['action']){
            case 'add':  
              $count = 0;
              $res = mysqli_query($db, "select * FROM users where EMPLOYEE_ID = '$emp' && USERNAME = '$user' && TYPE_ID= '$role'") or die (mysqli_error($db));
              $count = mysqli_num_rows($res);
              ?>
              <?php
              if($count > 0){
                ?>
                <script>
                  alert("The user already exists, please enter another new user.")
                  </script>
                <?php
                
              }else{
                mysqli_query($db,"INSERT INTO users 
                          VALUES (NULL, '$emp','$user', sha1('{$pass}'), '$role', '$force')") or die(mysqli_error($db)); 
                    ?>
                    <script>
                      alert("The user successfully added.")
                      </script>
                    <?php
              }
            break;
          }
        ?>
          <script type="text/javascript">
            window.location = "user.php";
          </script>
      </div>
