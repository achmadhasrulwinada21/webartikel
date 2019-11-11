<?php $__env->startSection('content'); ?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo e(url('/home')); ?>">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container">
    <div class="row">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <h3>Wellcome <?php echo e(Auth::user()->name); ?> in admin panel</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?php echo e(asset('assets/dist/js/pages/dashboard.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/webartikel/resources/views/admin/adminlte.blade.php ENDPATH**/ ?>