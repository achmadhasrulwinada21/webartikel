<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatables/jquery.dataTables.min.css')); ?>">
 <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen Testimoni</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(url('/home')); ?>">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <section class="content">
      <div class="container">
         <?php if($message = Session::get('sukses')): ?>
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong><?php echo e($message); ?></strong>
				</div>
                <?php endif; ?>
                  <?php if($message = Session::get('sukses21')): ?>
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong><?php echo e($message); ?></strong>
				</div>
                <?php endif; ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">Data Testimoni</div>

                <div class="card-body">
                   <a class="btn btn-success btn-sm" href="/testimoni/tambah"><i class="fa fa-plus">&nbsp Tambah Testimoni</i></a><br><br>
  <div class="table-responsive">
	<table  class="table-hover table-striped table-bordered table-list tabeltestimoni">
                  <thead>
                    <tr style="vertical-align:middle;text-align:center;font-weigth:bold">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr> 
                  </thead>
                  <tbody><tbody>
                </table>
   </div></div>
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
          var table_kat = $('.tabeltestimoni').DataTable({
              processing: true,
              serverSide: true,
              ajax: '/testimoni/json',
              columns: [
                  { data: 'DT_RowIndex', name:'DT_RowIndex'},
                  { data: 'nama', name: 'nama' },
                  {data: 'action', name: 'status', orderable: false, searchable: false},
                   { data: 'id', 
                   "render": function ( data, type, row, meta ) {
                            return '<center><a href="/testimoni/edit/'+data+'" title="edit" class="btn btn-xs btn-warning" style="margin-bottom:4px;margin-right:2px;"><i class="fa fa-edit"></i></a><a data-id="'+data+'" class="btn btn-xs btn-danger" style="margin-bottom:4px;" title="hapus" id="hapustestimoni"><i class="fa fa-trash"></i></a></center>';
                       }
                }
                ]
          });

           $(document).on('click','#hapustestimoni',function(){
            // dapetin dulu ID si usernya dari tag element button data-id
            var id = $(this).data('id')

            // kirim data ke server untuk hapus user dengan id 
            $.ajax({
              type: "DELETE",
              url: "/testimoni/hapus/" + id,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(data){
                var json  = JSON.parse(data)

                switch (json.code) {
                  case 200:
                       Swal.fire({
                                type: 'success',
                                title: 'Oops...',
                                text: 'Data has been Deleted!',
                            })
                    break;
                  default:
                    break;
                }

                // refresh datatablesnya kalau sudah menghapus usernya
                table_kat.ajax.reload()
              }
            });
          })

      });
   </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/webartikel/resources/views/master/testimoni/testimoni.blade.php ENDPATH**/ ?>