<?php $__env->startSection('content'); ?>
<?php 

$PREFIX = config('app.app_prefix');

?>

<br><br>
<div class="container">
  <div class="card-header bg-info">Create Office</div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form action="<?php echo e(route('branchoffice.store')); ?>" method="post">
		          <?php echo e(csrf_field()); ?>

              <div class="form-group">
                <label>Province</label><br>
                <select class="form-control" name="province_id" id="province">
                    <option></option>
                    <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($province->id); ?>"><?php echo e($province->province_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('province_id')): ?>
                    <div class="text-danger">
                    <?php echo e($errors->first('province_id')); ?>

                    </div>
                <?php endif; ?>
                <div class="form-group">
                <label>City</label><br>
                <select class="form-control" name="city_id" id="city">
                    <option></option>
                </select>
                <?php if($errors->has('city_id')): ?>
                    <div class="text-danger">
                    <?php echo e($errors->first('city_id')); ?>

                    </div>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label>Address</label><br>
                <input type="text" name="address" class="form-control" placeholder="fill this address...">
                <?php if($errors->has('address')): ?>
                    <div class="text-danger">
                    <?php echo e($errors->first('address')); ?>

                    </div>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label>Office Phone Number</label><br>
                <input type="text" name="phone_number" class="form-control" placeholder="fill this phone number...">
                <?php if($errors->has('phone_number')): ?>
                    <div class="text-danger">
                    <?php echo e($errors->first('phone_number')); ?>

                    </div>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label>Fax</label><br>
                <input type="text" name="fax" class="form-control" placeholder="fill this fax...">
                <?php if($errors->has('fax')): ?>
                    <div class="text-danger">
                    <?php echo e($errors->first('fax')); ?>

                    </div>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label>Office Type</label><br>
                <select class="form-control" name="office_type" id="office-type">
                    <option></option>
                    <option value="head-office">Head Office</option>
                    <option value="branch-office">Branch Office</option>
                </select>
                <?php if($errors->has('phone_number')): ?>
                    <div class="text-danger">
                    <?php echo e($errors->first('phone_number')); ?>

                    </div>
                <?php endif; ?>
              </div>
              <div class="form-group" id="head-office">
                <label>Head Office Name</label><br>
                <input type="text" name="head_office" id="frm-head-office" class="form-control" placeholder="fill this head office...">
              </div>
          </div>
          <div class="card-footer">
          <center>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/<?php echo e($PREFIX); ?>/branchoffice" class="btn btn-secondary">Back</a>
          </center>
          </div>
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

    $('#office-type').change(function(){
      if($(this).val() === 'branch-office'){
        $('#head-office').show();
      }else{
        $('#head-office').hide();
        $('#frm-head-office').val("");
      }
    })

    $('#head-office').hide();

    $('#province').change(function(){
      var province_id = $(this).val();

      $.ajax({
        url: '/<?php echo e($PREFIX); ?>/city/province/'+province_id,
        type: 'GET',
        dataType: 'JSON',
        success: function(response){
          var html = "";
          response.forEach(function(data){
            html += '<option value="'+data.id+'">';
            html += data.city_name;
            html += '</option>';
          })
          $('#city').html(html);
          html = "";
        }
      })
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/webartikel/app/Modules/Branchoffice/Resources/Views/create.blade.php ENDPATH**/ ?>