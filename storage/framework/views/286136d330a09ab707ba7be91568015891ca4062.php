<?php

$PREFIX = config('app.app_prefix');

  use Illuminate\Support\Facades\DB; 
    $sw = DB::table('settingweb')
    ->where('kode', '001')->first(); 
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
               
       <title><?php echo e($sw->title); ?> | Dashboard </title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/jqvmap/jqvmap.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/dist/css/adminlte.min.css')); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/daterangepicker/daterangepicker.css')); ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/summernote/summernote-bs4.css')); ?>">
  <!--swall-->
  <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.css')); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="<?php echo e(asset('assets/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('assets/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Summernote -->
<script src="<?php echo e(asset('assets/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!--swall-->
 <script src="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.js')); ?>"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
     
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
       <a class="nav-link" href="<?php echo e(route('logout')); ?>"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
          <?php echo e(__('Logout')); ?>

      </a>

      <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
          <?php echo csrf_field(); ?>
      </form>
      </li>
    </ul>
    <!-- Right navbar links -->
    <!-- <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li> 
    </ul> -->
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
   
    <a href="<?php echo e(url('/home')); ?>" class="brand-link">
      <img src="<?php echo e(asset(''.$sw->logo_web.'')); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo e($sw->nm_web); ?></span>
    </a>
           
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          
        </div>
        <div class="info">
          <a href="<?php echo e(url('/management')); ?>" class="d-block">Login as <?php echo e(Auth::user()->name); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
          <a href="<?php echo e(url('/management')); ?>" class="nav-link <?php echo e(Request::is('management') ? 'active' : ''); ?>"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p> </a>
        </li>
        <li class="nav-item">
          <a href="/<?php echo e($PREFIX); ?>/role" class="nav-link <?php echo e(Request::is($PREFIX . '/role') ? 'active' : ''); ?>"><i class="nav-icon fas fa-users-cog"></i><p>Roles</p></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/manajemenuser')); ?>" class="nav-link <?php echo e(Request::is('admin/manajemenuser') ? 'active' : ''); ?>"><i class="nav-icon fas fa-user-circle"></i><p>User</p></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/artikel')); ?>" class="nav-link <?php echo e(Request::is('admin/artikel') ? 'active' : ''); ?>"> <i class="nav-icon fas fa-newspaper"></i> <p>Article </p> </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/kategori')); ?>" class="nav-link <?php echo e(Request::is('admin/kategori') ? 'active' : ''); ?>"> <i class="nav-icon fas fa-th-large"></i> <p>Category </p> </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/menu')); ?>" class="nav-link <?php echo e(Request::is('admin/menu') ? 'active' : ''); ?>"> <i class="nav-icon fas fa-list-alt"></i> <p>Menu </p> </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/servis')); ?>" class="nav-link <?php echo e(Request::is('admin/servis') ? 'active' : ''); ?>"> <i class="nav-icon fas fa-binoculars"></i> <p>Service </p> </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/banner')); ?>" class="nav-link <?php echo e(Request::is('admin/banner') ? 'active' : ''); ?>"> <i class="nav-icon fas fa-file-image"></i><p>Banner</p></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/produk')); ?>" class="nav-link <?php echo e(Request::is('admin/produk') ? 'active' : ''); ?>"> <i class="nav-icon fas fa-building"></i><p>Produk</p></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/testimoni')); ?>" class="nav-link <?php echo e(Request::is('admin/testimoni') ? 'active' : ''); ?>"> <i class="nav-icon fas fa-star"></i><p>Testimony</p></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/footerbrand')); ?>" class="nav-link <?php echo e(Request::is('admin/footerbrand') ? 'active' : ''); ?>"> <i class="nav-icon fas fa-mouse-pointer"></i><p>Footer Brand</p></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/sitemap')); ?>" class="nav-link <?php echo e(Request::is('admin/sitemap') ? 'active' : ''); ?>"> <i class="nav-icon fas fa-sitemap"></i><p>Sitemap</p></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/navbar')); ?>" class="nav-link <?php echo e(Request::is('admin/navbar') ? 'active' : ''); ?>"> <i class="nav-icon fas fa-object-ungroup"></i><p>Navbar</p></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/category')); ?>" class="nav-link <?php echo e(Request::is('admin/category') ? 'active' : ''); ?>"> <i class="nav-icon fas fa-location-arrow"></i><p>Category</p></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/file')); ?>" class="nav-link <?php echo e(Request::is('admin/file') ? 'active' : ''); ?>"> <i class="nav-icon fas fa-laptop"></i><p>File</p></a>
        </li>
        <li class="nav-item">
          <a href="/<?php echo e($PREFIX); ?>/workshop" class="nav-link <?php echo e(Request::is([$PREFIX . '/workshop', $PREFIX . '/workshop/create']) ? 'active' : ''); ?>"><i class="nav-icon fas fa-car"></i><p>Workshop</p></a>
        </li>
        <li class="nav-item">
          <a href="<?php echo e(url('/admin/settingweb')); ?>" class="nav-link <?php echo e(Request::is('admin/settingweb') ? 'active' : ''); ?>"><i class="nav-icon fas fa-cog"></i><p>Setting</p></a>
        </li>
        <li class="nav-item">
          <a href="/<?php echo e($PREFIX); ?>/branchoffice" class="nav-link <?php echo e(Request::is([$PREFIX . '/branchoffice', $PREFIX . '/branchoffice/create']) ? 'active' : ''); ?>"><i class="nav-icon fas fa-building"></i><p>Branch Office</p></a>
        </li>
        </ul>



          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- /.content-header -->
<?php echo $__env->yieldContent('content'); ?>
    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0-rc.3
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(asset('assets/plugins/chart.js/Chart.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('assets/plugins/sparklines/sparkline.js')); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo e(asset('assets/plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset('assets/plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(asset('assets/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo e(asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>

<!-- overlayScrollbars -->
<script src="<?php echo e(asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('assets/dist/js/adminlte.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('assets/dist/js/demo.js')); ?>"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
</body>
</html>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/webartikel/resources/views/layouts/index.blade.php ENDPATH**/ ?>