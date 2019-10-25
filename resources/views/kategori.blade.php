@extends('layouts.index')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css')}}">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">Kategori Artikel</div>

                <div class="card-body">
                   <a class="btn btn-success btn-sm" href="javascript:void(0)" id="createNewKategori"><i class="fa fa-plus">&nbsp Tambah Data</i></a><br><br>
         <div class="table-responsive">
	        <table  class="table table-striped table-bordered table-hover table-list data-table21">
                  <thead>
                    <tr style="vertical-align:middle;text-align:center;font-weigth:bold">
                        <th>No</th>
                        <th>ID Kategori</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                      </tr> 
                  </thead>
                  
                </table>
   </div></div>
    </div>
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Kategori</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Enter kategori" value="" maxlength="50" required>
                     </div>
                    </div>
                   <br>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        </div>
    </div>
</div>

 <!--modal -->
 
            <!--endmodal -->

    </section>
   <!-- /.content -->
   <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
</head>
    <script>

     $(function() {
         
          $.ajaxSetup({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
          var table_kat = $('.data-table21').DataTable({
              processing: true,
              serverSide: true,
              ajax: '/kategori/json',
              columns: [
                  { data: 'DT_RowIndex', name:'DT_RowIndex'},
                  { data: 'id', name: 'id' },
                  { data: 'kategori', name: 'kategori' },
                 {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
          });

    $('#createNewKategori').click(function () {
        $('#saveBtn').val("create-product");
        $('#id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Tambah Data");
        $('#ajaxModel').modal('show');
    });

      $('body').on('click', '.editProduct', function () {
      var id = $(this).data('id');
          $.get("{{ route('kategori.index') }}" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Data");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#id').val(data.id);
          $('#kategori').val(data.kategori);       
       })
   });


  $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
          data: $('#productForm').serialize(),
          url: "/kategori/store",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              Swal.fire({
                                type: 'success',
                                title: 'success...',
                                text: 'Data Telah Tersimpan',
                            })
              table.draw();
            },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
          
      });
       table_kat.ajax.reload()
    });

     $('body').on('click', '.deleteProduct', function () {
        var id = $(this).data("id");
        $.ajax({
            type: "DELETE",
            url: "/kategori/destroy"+'/'+id,
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
    });
});
    </script>
@endsection