<!DOCTYPE html>
<html lang="en">
<head>
    <script
        src="https://assets.ottu.net/checkout/v3/checkout.min.js"
        data-error="errorCallback"
        data-cancel="cancelCallback"
        data-success="successCallback"
        data-beforepayment="beforePayment"
    ></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gulf-Inspection Admin | Dashboard </title>
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/admin/images/logo.jpg')?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/admin/images/logo.jpg')?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/admin/images/logo.jpg')?>">
  <link rel="manifest" href="<?php echo base_url('assets/favicons')?>/site.webmanifest">
  <link rel="mask-icon" href="<?php echo base_url('assets/favicons')?>/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>dist/css/adminlte.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/');?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/');?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/');?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/dropify/dist/css/dropify.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>plugins/sweetalert/sweetalert.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>plugins/summernote/summernote-bs4.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- jQuery -->
  <script src="<?php echo base_url('assets/admin/')?>plugins/jquery/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <style type="text/css">
    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
      background-color: #dc3545!important;
      color: #fff !important;
      }
    .dt-buttons .btn.btn-secondary{
    color: #fff;
    background-color: #dc3545!important;
    border-color: #dc3545!important; 
    box-shadow: none;
    }
    .page-item.active .page-link {
    z-index: 1;
    color: #fff;
    background-color: #dc3545!important;
    border-color: #dc3545!important;
  }
  .dropify-wrapper {
      height: 150px !important;
  }
  .arabic-input {
    text-align: right !important;
}
  </style>
</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!--<div class="preloader flex-column justify-content-center align-items-center">-->
  <!--  <img class="animation__wobble" src="<?php echo base_url('assets/admin/')?>images/logo-1.png" width="100">-->
  <!--</div>-->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="javascript:void(0)" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="javascript:void(0)" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin-sign-signout')?>" class="nav-link" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  
  