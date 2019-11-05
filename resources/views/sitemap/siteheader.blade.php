@extends('layouts.index')
@section('content')
 <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css')}}">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen Sitemap</h1>
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
     @if(Auth::user()->jabatan == 'admin')
     <section class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info"><i class="fa fa-plus">&nbspTambah Sitemap</i></div>
                 <div class="card-body">
	<form  method="post" enctype="multipart/form-data" id="productForm" name="productForm">
        {{ csrf_field() }}
        <label>Judul</label><br>
		 <input type="text" name="Judul"  class="form-control" placeholder="isi judul..." required>
		 @if($errors->has('Judul'))
            <div class="text-danger">
             {{ $errors->first('Judul')}}
           </div>
        @endif<br>
        <label>Link</label><br>
         <input type="text" name="link"  class="form-control" placeholder="isi link..." required>
          @if($errors->has('link'))
            <div class="text-danger">
             {{ $errors->first('link')}}
           </div>
        @endif
		<br><br>
		<input type="submit" value="Simpan Data" id="saveBtn" class="btn btn-info btn-sm">
    </form>
    </div>
    </div>
</div></div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">Judul</div>

                <div class="card-body">
    <div class="table-responsive">
	<table  class="table table-striped table-hover table-list tabeljudul">
                  <thead>
                    <tr style="vertical-align:middle;text-align:center;font-weigth:bold">
                        <th>No</th>
                        <th>Judul</th>
                        <th>Link</th>
                        <th>Aksi</th>
                    </tr> 
                  </thead>
                  
                </table>
   </div></div>
        </div>
        </div>
    </div>
 <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" id="modelHeading"></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <form id="productForm2" name="productForm2" class="form-horizontal">
                     {{ csrf_field() }}
         <input type="hidden" name="id" id="id">
        <div class="form-group row">
       <label class="col-md-4 col-form-label text-md-right">Judul</label><br>
        <div class="col-md-6">
		<input type="text" name="Judul" id="Judul" class="form-control" placeholder="isi judul...">
		 @if($errors->has('Judul'))
            <div class="text-danger">
             {{ $errors->first('Judul')}}
           </div>
        @endif
    </div></div> 
     <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">Link</label><br>
        <div class="col-md-6">
     <input type="text" name="link" id="link" class="form-control" placeholder="isi link...">
         </div></div>    <br>
                    <div class="col-sm-offset-2 col-sm-10" style="margin-left:67%">
                     <button type="submit" class="btn btn-primary" id="saveBtn2" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div><div class="modal-footer"></div>
        </div>
    </div>
</div>
    </section>
      @else 
    <section class="content">
      <script>
      Swal.fire({
                                type: 'error',
                                title: 'Maaf...',
                                text: 'Anda Bukan Admin..',
                            })
      </script>
    </section>
    @endif
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script>
      $(function() {
           $.ajaxSetup({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
          var table_user = $('.tabeljudul').DataTable({
              processing: true,
              serverSide: true,
              ajax: '/sitemap/json',
              columns: [
                  { data: 'DT_RowIndex', name:'DT_RowIndex'},
                  { data: 'Judul', name: 'Judul' },
                  { data: 'link', name: 'link' },
                  {data: 'action', name: 'action', orderable: false, searchable: false}
                  ]
          });
        
          $('body').on('click', '.editProduct', function () {
      var id = $(this).data('id');
          $.get("{{ route('sitemap.index') }}" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Data");
          $('#saveBtn').val("simpan");
          $('#ajaxModel').modal('show');
          $('#id').val(data.id);
          $('#Judul').val(data.Judul); 
          $('#link').val(data.link);       
       })
   });

          $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
          data: $('#productForm').serialize(),
          url: "/sitemap/insert",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#productForm').trigger("reset");
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
       table_user.ajax.reload()
    });
      $('#saveBtn2').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
          data: $('#productForm2').serialize(),
          url: "/sitemap/insert",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#productForm2').trigger("reset");
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
              $('#saveBtn2').html('Save Changes');
          }
          
      });
       table_user.ajax.reload()
    });

     $('body').on('click', '.deleteProduct', function () {
        var id = $(this).data("id");
        $.ajax({
            type: "DELETE",
            url: "/sitemap/destroy"+'/'+id,
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
                table_user.ajax.reload()
              }
           
        });
    });
           });
    </script>
    @endsection
