<?php
include'../includes/connection.php';
?>
          <!-- Page Content -->
          <div class="col-lg-12">
            <?php
              $name = $_POST['companyname'];
              $prov = $_POST['province'];
              $cit = $_POST['city'];
              $phone = $_POST['phonenumber'];
              $credit = $_POST['credit_balance'];
              
switch($_GET['action']){
  case 'add':  
    $count = 0;
    $res = mysqli_query($db, "select * FROM supplier where COMPANY_NAME = '$name' && PHONE_NUMBER = '$phone'") or die (mysqli_error($db));
    $count = mysqli_num_rows($res);
    ?>
    <?php
    if($count > 0){
      ?>
      <script>
        alert("The Supplier already exists, please enter another new supplier.")
        </script>
      <?php
      
    }else{
                  $query = "INSERT INTO location
                              (LOCATION_ID, PROVINCE, CITY)
                              VALUES (Null,'{$prov}','{$cit}')";
                    mysqli_query($db,$query)or die(mysqli_error($db)); 

                    $query2 = "INSERT INTO supplier
                              (SUPPLIER_ID, COMPANY_NAME, LOCATION_ID, PHONE_NUMBER, CREDIT_BALANCE)
                              VALUES (Null,'{$name}',(SELECT MAX(LOCATION_ID) FROM location),'".$phone."', $credit)";
                    mysqli_query($db,$query2) or die(mysqli_error($db)); 
          ?>
          <script>
            alert("The supplier successfully added.")
            </script>
          <?php
    }
  break;
}
?>
<script type="text/javascript">
  window.location = "supplier.php";
</script>
</div>

?>