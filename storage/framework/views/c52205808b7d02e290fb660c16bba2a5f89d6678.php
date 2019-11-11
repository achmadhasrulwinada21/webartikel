<?php $__env->startSection('content'); ?>
<?php 

$PREFIX = config('app.app_prefix');

?>

<br><br>
<div class="container">
  <div class="card-header bg-info">Create Role</div>
    <div class="row">
      <div class="col-md-7">
        <div class="card">
          <div class="card-body">
            <form action="/<?php echo e($PREFIX); ?>/role" method="post">
		          <?php echo e(csrf_field()); ?>

              <div class="form-group">
                <label>Name</label><br>
                <input type="text" name="name" class="form-control" placeholder="fill this name...">
                <?php if($errors->has('name')): ?>
                    <div class="text-danger">
                    <?php echo e($errors->first('name')); ?>

                  </div>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label>Description</label> <br>
                <textarea name="description" class="form-control" placeholder="fill this description..."></textarea>
                <?php if($errors->has('description')): ?>
                    <div class="text-danger">
                    <?php echo e($errors->first('description')); ?>

                  </div>
                <?php endif; ?>
              </div>
          </div>
            </div>
        </div>
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="">List Permission</label>
                <div style="height: 250px;overflow: overlay;padding: 10px;">
                  <div>
                    <ul style="list-style-type: none;padding:unset;">
                      <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                          <label for="<?php echo e($permission->name); ?>">
                            <input type="checkbox" name="permissions[]" value="<?php echo e($permission->name); ?>" class="flat-red" id="<?php echo e($permission->name); ?>">
                            <?php echo e($permission->name); ?>

                          </label>
                          
                        </li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </div>
                </div>
              </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/<?php echo e($PREFIX); ?>/role" class="btn btn-secondary">Back</a>
	      </form>
        </div>
      </div>
      </div>
    </div>
  </div>
<script src="/assets/plugins/icheck-bootstrap/icheck.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#content').summernote({
      height: "300px",
      styleWithSpan: false
    });
  }); 
</script>
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

// $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
//   checkboxClass: 'icheckbox_flat-green',
//   radioClass   : 'iradio_flat-green'
// })

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/webartikel/app/Modules/Role/Resources/Views/create.blade.php ENDPATH**/ ?>