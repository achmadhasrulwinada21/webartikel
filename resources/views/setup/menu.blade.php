@extends('layouts.index')
@section('content')
 <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css')}}">
    <!-- Content Header (Page header) -->
    <ul class="nav nav-tabs">
  <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/admin/menu') }}" class="nav-link">Menu</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/admin/judul') }}" class="nav-link active">Judul</a>
      </li>
</ul>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen Menu</h1>
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
<div class="card-header bg-info"><i class="fa fa-plus">&nbspTambah Menu</i></div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                 <div class="card-body">
	<form action="/artikel/insert" method="post" enctype="multipart/form-data" id="productForm" name="productForm">
        {{ csrf_field() }}
        <label>Judul</label><br>
		 <select name="id_jdl"  class="form-control @error('id_jdl') is-invalid @enderror" >
                    <option value="0" selected disabled>- Pilih Judul -</option>
                     @foreach ($judul2 as $pemilik)
                        <option value="{{ $pemilik->id }}">{{ ($pemilik->judul) }}</option>
                    @endforeach
                     </select>
                            @error('id_jdl')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
       <label>Icon</label><br>
		<input type="text" name="icon"  class="form-control" placeholder="isi Icon...">
		 @if($errors->has('icon'))
            <div class="text-danger">
             {{ $errors->first('icon')}}
           </div>
        @endif
    </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                  <div class="card-body">
                <label>Sub Menu</label><br>
                     <select name="childjudul"  class="form-control @error('childjudul') is-invalid @enderror" >
                    <option value="0" selected disabled>- Pilih Sub Menu -</option>
                     @foreach ($judul as $pemilik)
                        <option value="{{ $pemilik->id }}">{{ ($pemilik->judul) }}</option>
                    @endforeach
                     </select>
                            @error('childjudul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
        <label>Link</label><br>
		<input type="text" name="link"  class="form-control" placeholder="isi link...">
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
                <div class="card-header bg-info">Menu</div>

                <div class="card-body">
    <div class="table-responsive">
	<table  class="table table-striped table-hover table-list tabelmenu">
                  <thead>
                    <tr style="vertical-align:middle;text-align:center;font-weigth:bold">
                        <th>No</th>
                        <th>Judul</th>
                        <th>Link</th>
                        <th>Icon</th>
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
		 <select name="id_jdl" id="id_jdl" class="form-control @error('id_jdl') is-invalid @enderror" >
                    <option value="0" selected disabled>- Pilih Judul -</option>
                     @foreach ($judul2 as $pemilik)
                        <option value="{{ $pemilik->id }}">{{ ($pemilik->judul) }}</option>
                    @endforeach
                     </select>
                            @error('id_jdl')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
         </div></div>
         <div class="form-group row">
       <label class="col-md-4 col-form-label text-md-right">Icon</label><br>
        <div class="col-md-6">
		<input type="text" name="icon" id="icon" class="form-control" placeholder="isi Icon...">
		 @if($errors->has('icon'))
            <div class="text-danger">
             {{ $errors->first('icon')}}
           </div>
        @endif
    </div></div> 
    <div class="form-group row">
     <label class="col-md-4 col-form-label text-md-right">Sub Menu</label><br>
      <div class="col-md-6">
                     <select name="childjudul" id="childjudul" class="form-control @error('childjudul') is-invalid @enderror" >
                    <option value="0" selected disabled>- Pilih Sub Menu -</option>
                     @foreach ($judul as $pemilik)
                        <option value="{{ $pemilik->id }}">{{ ($pemilik->judul) }}</option>
                    @endforeach
                     </select>
                            @error('childjudul')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div></div> 
     <div class="form-group row">
        <label class="col-md-4 col-form-label text-md-right">Link</label><br>
        <div class="col-md-6">
		<input type="text" name="link" id="link" class="form-control" placeholder="isi link...">
		 @if($errors->has('link'))
            <div class="text-danger">
             {{ $errors->first('link')}}
           </div>
        @endif
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
          var table_user = $('.tabelmenu').DataTable({
              processing: true,
              serverSide: true,
              ajax: '/menu/json',
              columns: [
                  { data: 'DT_RowIndex', name:'DT_RowIndex'},
                  { data: 'judul', name: 'judul' },
                  { data: 'link', name: 'link' },
                  { data: 'icon', name: 'icon' },
                   {data: 'action', name: 'action', orderable: false, searchable: false}
                  ]
          });
        
          $('body').on('click', '.editProduct', function () {
      var id = $(this).data('id');
          $.get("{{ route('menu.index') }}" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Data");
          $('#saveBtn').val("simpan");
          $('#ajaxModel').modal('show');
          $('#id').val(data.id);
          $('#id_jdl').val(data.id_jdl); 
          $('#childjudul').val(data.childjudul);
          $('#icon').val(data.icon);  
          $('#link').val(data.link);       
       })
   });

          $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
          data: $('#productForm').serialize(),
          url: "/menu/insert",
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
          url: "/menu/insert",
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
            url: "/menu/destroy"+'/'+id,
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
