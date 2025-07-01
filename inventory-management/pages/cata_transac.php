<?php
include'../includes/connection.php';
?>
<?php
    $catacode = $_POST['catacode'];
    $cataname = $_POST['cataname'];

          switch($_GET['action']){
                case 'add':  
                  $count = 0;
                  $res = mysqli_query($db, "select * FROM category where CATEGORY_ID = '$catacode' && CNAME = '$cataname'") or die (mysqli_error($db));
                  $count = mysqli_num_rows($res);
                  ?>
                  <?php
                  if($count > 0){
                    ?>
                    <script>
                      alert("The category already exists, please enter another new category.")
                      </script>
                    <?php
                    
                  }else{
                    mysqli_query($db,"INSERT INTO category 
                              VALUES (NULL, '$catacode','$cataname')") or die(mysqli_error($db)); 
                        ?>
                        <script>
                          alert("The category successfully added.")
                          </script>
                        <?php
                  }
                break;
              }
            ?>
              <script type="text/javascript">
                window.location = "category.php";
              </script>
          </div>
