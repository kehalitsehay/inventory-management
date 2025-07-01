<?php
include'../includes/connection.php';
?>

<?php
  require_once('session.php');
  confirm_logged_in();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <style type="text/css">
#overlay {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}
#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 50px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Selam Argiw Hyper Market </title>
  <link rel="icon" href="../img/peace1.PNG">

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <link rel="stylesheet" href="cart.css" />
</head>

<body id="page-top">
          
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <a class="sidebar-brand d-flex align-items-center justify-content-center"  style="text-decoration: none; font-size: 18px; font-weight: bold;" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <div class="sidebar-brand-text mx-3">Selam Argiw Hyper Market</div>
      </a>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown no-arrow">
              <a class="nav-link" href="stockmaster.php" role="button">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Home</span>
              </a>
            </li>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link" href="stockin.php" role="button">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">StockIn</span>
              </a>
            </li>
          <li class="nav-item dropdown no-arrow">
              <a class="nav-link" href="stockout.php" role="button">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">StockOut</span>
              </a>
            </li>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link" href="requ_common_store.php" role="button">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Request</span>
              </a>
            </li>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link" href="purchase_common_store.php" role="button">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Purchase</span>
              </a>
            </li>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link" href="sales_common_store.php" role="button">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Sales</span>
              </a>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo  $_SESSION['FIRST_NAME']. ' '.$_SESSION['LAST_NAME'] ;?></span>
                <img class="img-profile rounded-circle"
                <?php
                  if($_SESSION['GENDER']=='Male'){
                    echo 'src="../img/male.png"';
                  }else{
                    echo 'src="../img/female.png"';
                  }
                ?>>

              </a>

              <?php 

                $query = 'SELECT ID, FIRST_NAME,LAST_NAME,USERNAME,PASSWORD, t.TYPE
                          FROM users u
                          JOIN employee e ON e.EMPLOYEE_ID=u.EMPLOYEE_ID
                          JOIN type t ON t.TYPE_ID=u.TYPE_ID';
                $result = mysqli_query($db, $query) or die (mysqli_error($db));
      
                while ($row = mysqli_fetch_assoc($result)) {
                          $a = $_SESSION['MEMBER_ID'];
                          $bbb = $_SESSION['TYPE'];
                }
                          
            ?>

              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <button class="dropdown-item" onclick="on()">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </button>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#settingsModal" data-href="settings.php?action=edit & id='<?php echo $a; ?>'">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
          
        <!-- Begin Page Content -->
        <div class="container-fluid">

        <?php

$sql = "select PRODUCT_CODE from product";
$result = mysqli_query($db, $sql);
?>



  <form action="">
    <h3>Add new Purchase</h3>
    <table id = "table">
      <tr>
        <td>Transaction ID</td>
        <td>
        <input type="text" name="transac_id" id="transac_id" class="form-control" size="20">
        </td>
      </tr>
      <tr>
        <td>Product Code</td>
        <td>
        <select name="proid" id="proid" class="form-control" onchange="fetchpro()">
          <option value="">Select Product Code</option>
          <?php
            while($row = mysqli_fetch_array($result)){
              $k = $row['PRODUCT_CODE'];
              echo '<option value="'.$k.'">'.$k.'</option>'; 
            }
          ?>
        </select>
        </td>
      </tr>
      <tr>
        <td>Product Name</td>
        <td>
        <input type="text" name="name" id="name" class="form-control mt-2" size="20">
        </td>
      </tr>

      <tr>
        <td>Brand ID</td>
        <td>
        <input type="text" name="brand_id" id="brand_id" class="form-control" size="20">
        </td>
      </tr>

      <tr>
        <td>Unit</td>
        <td>
        <input type="text" name="unit" id="unit" class="form-control" size="20">
        </td>
      </tr>

      <tr>
        <td>Purchase Price</td>
        <td>
        <input type="text" name="pur_price" id="pur_price" class="form-control" size="20">
        </td>
      </tr>
    </table>
  </form>
  </div>

  <script src="../autofill/jquery.min.js"></script>
  <script src="../autofill/script.js"></script>        

<?php
include'../includes/footer.php';
?>