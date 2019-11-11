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
            <h1 class="m-0 text-dark">Manajemen Role</h1>
            </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Role</li>
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
              Role Management
            </div>
            <div class="card-body">
            <a class="btn btn-success btn-sm" href="role/create"  style="color:white;"><i class="fa fa-plus"> Create Role</i></a><br><br>
                <div class="table-responsive">
                    <table  class="table-hover table-striped table-bordered table-list" id="roleDatatables">
                      <thead>
                        <tr style="vertical-align:middle;text-align:center;font-weigth:bold">
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
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
   <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
           <h4 class="modal-title">Tambah File</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>
      <div class="modal-body">
        <form action="/file/insert" method="post" enctype="multipart/form-data" id="productForm">
            <?php echo e(csrf_field()); ?>

                   <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">File</label>
                        <div class="col-sm-12">
                            <div class="custom-file">
                         <input type="file" class="custom-file-input" id="customFile" name="foto">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                         </div>
                     </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control"  name="ket" placeholder="Enter keterangan" value="" maxlength="50" required>
                     </div>
                    </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Kategori</label>
                        <div class="col-sm-12">
                    <select name="id_kategori" class="form-control" >
                    <option value="0" selected disabled>- Pilih Kategori File -</option>
                     </select>
                     </div>
                    </div>
                   <br>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary"  value="create" id="saveBtn">Save changes
                     </button>
                    </div>
                </form>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
          ajax: '/<?php echo e($prefix); ?>/role/all',
          columns: [
              { data: 'id', name:'id'},
              { data: 'name', name: 'name' },
              { data: 'description', name: 'description' },
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/webartikel/app/Modules/Role/Resources/Views/list.blade.php ENDPATH**/ ?>