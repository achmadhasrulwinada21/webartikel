<?php $__env->startSection('content'); ?>
<?php 

$PREFIX = config('app.app_prefix');

?>

<br><br>
<div class="container">
  <div class="card-header bg-info">Edit Office</div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form action="<?php echo e(route('branchoffice.update', $branch->id)); ?>" method="post">
		          <?php echo e(csrf_field()); ?>

                  <?php echo e(method_field('PUT')); ?>

              <div class="form-group">
                <label>Province</label><br>
                <select class="form-control" name="province_id" id="province">
                    <!-- <option value="<?php echo e($branch->province_id); ?>"><?php echo e($branch->provinces->province_name); ?></option> -->
                    <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $province): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($province->id); ?>" <?php if($province->id == $branch->province_id): ?> selected <?php endif; ?>><?php echo e($province->province_name); ?></option>
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
                    <?php $__currentLoopData = $branch->provinces->cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($city->id); ?>" <?php if($city->id == $branch->cities->id): ?> selected <?php endif; ?>><?php echo e($city->city_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php if($errors->has('city_id')): ?>
                    <div class="text-danger">
                    <?php echo e($errors->first('city_id')); ?>

                    </div>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label>Address</label><br>
                <input type="text" name="address"  value="<?php echo e($branch->address); ?>" class="form-control" placeholder="fill this address...">
                <?php if($errors->has('address')): ?>
                    <div class="text-danger">
                    <?php echo e($errors->first('address')); ?>

                    </div>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label>Office Phone Number</label><br>
                <input type="text" name="phone_number" value="<?php echo e($branch->phone_number); ?>" class="form-control" placeholder="fill this phone number...">
                <?php if($errors->has('phone_number')): ?>
                    <div class="text-danger">
                    <?php echo e($errors->first('phone_number')); ?>

                    </div>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label>Fax</label><br>
                <input type="text" name="fax" value="<?php echo e($branch->fax); ?>" class="form-control" placeholder="fill this fax...">
                <?php if($errors->has('fax')): ?>
                    <div class="text-danger">
                    <?php echo e($errors->first('fax')); ?>

                    </div>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label>Office Type</label><br>
                <select class="form-control"  name="office_type" id="office-type">
                <?php if($branch->office_type == "head-office"): ?>
                <option value="head-office" selected>Head Office</option>
                <option value="branch-office">Branch Office</option>
                <?php else: ?>
                <option value="branch-office" selected>Branch Office</option>
                <option value="head-office">Head Office</option>
                <?php endif; ?>
                    
                </select>
                <?php if($errors->has('phone_number')): ?>
                    <div class="text-danger">
                    <?php echo e($errors->first('phone_number')); ?>

                    </div>
                <?php endif; ?>
              </div>
              <div class="form-group" id="head-office">
                <label>Head Office Name</label><br>
                <input type="text" value="<?php echo e($branch->head_office); ?>" name="head_office" id="frm-head-office" class="form-control" placeholder="fill this head office...">
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

    if($('#office-type').val() === 'branch-office' ){
        $('#head-office').show();
      }else{
        $('#head-office').hide();
        $('#frm-head-office').val("");
    }

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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/webartikel/app/Modules/Branchoffice/Resources/Views/edit.blade.php ENDPATH**/ ?>