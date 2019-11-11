<?php $__env->startSection('content'); ?>

<?php

$prefix = config('app.app_prefix');

?>

<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatables/jquery.dataTables.min.css')); ?>">
 <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Office Management</h1>
            </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Office Management</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <section class="content">
    <div class="container">
        <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header bg-info">
              Office Management
            </div>
            <div class="card-body">
            <a class="btn btn-success btn-sm" href="branchoffice/create"  style="color:white;"><i class="fa fa-plus"> Create Office</i></a><br><br>
                <div class="table-responsive">
                    <table  class="table-hover table-striped table-bordered table-list" id="roleDatatables">
                      <thead>
                        <tr style="vertical-align:middle;text-align:center;font-weigth:bold">
                            <th>No</th>
                            <th>Type</th>
                            <th>Head Office</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Province</th>
                            <th>Action</th>
                          </tr> 
                      </thead>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
      </div>
</section>
 <script src="<?php echo e(asset('assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
 <script>

    $(function() {
            
      $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var role_table = $('#roleDatatables').DataTable({
          processing: true,
          serverSide: true,
          ajax: '/<?php echo e($prefix); ?>/branchoffice/list',
          columns: [
              { data: 'id', name:'id'},
              { data: 'office_type', name: 'office_type' },
              { data: 'head_office', name: 'head_office' },
              { data: 'address', name: 'address' },
              { data: 'city_name', name: 'city_name' },
              { data: 'province_name', name: 'province_name' },
              { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false
              }
            ]
      });
    
    $(document).on('click', '#deleteRole', function () {
      var id = $(this).data("id");

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
            $.ajax({
            type: "DELETE",
            url: "/<?php echo e($prefix); ?>/role/" + id,
            success: function(data){
              var json  = JSON.parse(data)
              switch (json.status) {
                case 200:
                  Swal.fire({
                              type: 'success',
                              title: 'Oops...',
                              text: json.message,
                          })
                  break;
                default:
                  break;
              }

              // refresh datatablesnya kalau sudah menghapus rolenya
              role_table.ajax.reload()
              }
            });
        }
      })



      
    })
        
  });

  </script>
<script>
  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/webartikel/app/Modules/Branchoffice/Resources/Views/list.blade.php ENDPATH**/ ?>