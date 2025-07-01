<?php
include'../includes/connection.php';

?>
            <?php
              $fname = $_POST['firstname'];
              $lname = $_POST['lastname'];
              $gen = $_POST['gender'];
              $email = $_POST['email'];
              $phone = $_POST['phonenumber'];
              $jobb = $_POST['jobs'];
              $salary = $_POST['salary'];
              $hdate = $_POST['hireddate'];
              $prov = $_POST['province'];
              $cit = $_POST['city'];
              
              switch($_GET['action']){
                case 'add':  
                  $count = 0;
                  $res = mysqli_query($db, "select * FROM employee where FIRST_NAME = '$fname' && LAST_NAME = '$lname' && GENDER = '$gen' && EMAIL = '$email'") or die (mysqli_error($db));
                  $count = mysqli_num_rows($res);
                  ?>
                  <?php
                  if($count > 0){
                    ?>
                    <script>
                      alert("The employee already exists, please enter another new employee.")
                      </script>
                    <?php
                    
                  }else{
                    mysqli_query($db,"INSERT INTO location
                              (LOCATION_ID, PROVINCE, CITY)
                              VALUES (Null,'$prov','$cit')") or die(mysqli_error($db)); 
                    mysqli_query($db,"INSERT INTO employee
                              (EMPLOYEE_ID, FIRST_NAME, LAST_NAME, FULL_NAME, GENDER, EMAIL, PHONE_NUMBER, JOB_ID, SALARY, HIRED_DATE, LOCATION_ID)
                              VALUES (Null,'{$fname}','{$lname}','{$fname} - $lname}','{$gen}','{$email}','{$phone}','{$jobb}', '{$salary}', '{$hdate}',(SELECT MAX(LOCATION_ID) FROM location))") or die(mysqli_error($db));
                        ?>
                        <script>
                          alert("The employee successfully added.")
                          </script>
                        <?php
                  }
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "employee.php";
              </script>
          </div>