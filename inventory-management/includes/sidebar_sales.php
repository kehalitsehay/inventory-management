<?php
  require('session.php');
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
li::marker {
  color: white;
}
@media(max-width: 770px){
  .my-sub-navigation{
  margin-left: 15px;
  background-color: #001B3A;
  padding-right: 20px;
}
}
</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> ABC Hyper Market </title>
  <link rel="icon" href="../img/peace1.png">
  <!-- select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Custom fonts for this template-->
  <link href="../vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="../vendors/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/dataTable.css">
  <link rel="stylesheet" href="../css/buttondatatable.css">
  <link rel="stylesheet" href="../css/cart.css" />
  
  <link rel="stylesheet" href="../css/custom.css" />

  
  
  <script src="../js/jquery.js"></script>
</head>

<body id="page-top">
          
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="sales.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <img src="../img/peace.png" alt="" width="100" height="90" >
        </div>
        <div class="sidebar-brand-text mx-3">ABC</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="sales.php">
        <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        General
      </div>
      <!-- Tables Buttons -->

      <li class="nav-item">
        <a class="nav-link" href="#maintenance" data-toggle="collapse" aria-expanded="false">
          <i class="fas fa-fw fa-cogs"></i>
          <span>Maintenance</span></a>
          <ul id="maintenance" class="collapse my-sub-navigation">
            <li><a href="customer_sales.php" style="color: white;">Customer</a></li>
            <li><a href="customer_pay.php" style="color: white;">Credit Customer</a></li>
          </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#report" data-toggle="collapse" aria-expanded="false">
          <i class="fas fa-fw fa-list"></i>
          <span>Report</span></a>
          <ul  id="report" class="collapse my-sub-navigation">
            <li><a href="saller_purchase_report.php" style="color: white; ">Purchase</a></li>
            <li><a href="sales_report.php" style="color: white;">Sales</a></li>
            <li><a href="stockmaster_common_sales.php" style="color: white;">Stock</a></li>
          </ul>
      </li>
    
      <li class="nav-item">
        <a class="nav-link" href="requ_common_s.php">
          <i class="fas fa-fw fa-shopping-cart"></i>
          <span>Purchase Request</span></a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="attendance.php">
          <i class="fas fa-fw fa-list"></i>
          <span>Attendance</span></a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="leave_request.php">
          <i class="fas fa-fw fa-list"></i>
          <span>Leave Request</span></a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="bank_deposit_sales.php">
          <i class="fas fa-fw fa-list"></i>
          <span>Bank Deposit</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
    <?php include_once 'topbar.php'; ?>
