@extends('layouts.index')
@section('content')
 <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css')}}">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen User</h1>
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
     @if(Auth::user()->jabatan == 'admin')
    <section class="content">
      <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">Data User</div>

                <div class="card-body">
                   <a class="btn btn-success btn-sm" href="javascript:void(0)" id="createNewUser"><i class="fa fa-plus">&nbsp Tambah User</i></a><br><br>
                   <div class="table-responsive">
	<table id="tabeluser" class="table table-striped table-bordered table-list">
                  <thead>
                    <tr style="vertical-align:middle;text-align:center;font-weigth:bold">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                      </tr> 
                  </thead>
                  
                </table>
   </div></div>
   <p id="pesan"></p>
            </div>
        </div>
    </div>
</div>

 <!--modal -->
 <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="id">
                   <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input  type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                          <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                       <div class="col-md-6">
                           <select name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" >
                                <option value="0" selected disabled>- Pilih Role -</option>
                                <option value="admin">Admin</option>
                                <option value="member">Member</option>
                           </select>

                            @error('jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                       </div>
                    </div>
                     <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                   <br>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Register
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
            <!--endmodal -->

            <!--modal -->
 <div class="modal fade" id="ajaxModel2" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="modelHeading2"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm2" name="productForm" class="form-horizontal">
                   <input type="hidden" name="id" id="id">
                   <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                          <label for="role" class="col-md-4 col-form-label text-md-right">Role</label>
                       <div class="col-md-6">
                           <select name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" >
                                <option value="0" selected disabled>- Pilih Role -</option>
                                <option value="admin">Admin</option>
                                <option value="member">Member</option>
                           </select>

                            @error('jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                       </div>
                    </div>
                  <br>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn2" value="create">Simpan
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
            <!--endmodal -->

    </section>
    @else 
    <section class="content">
      anda bukan admin
    </section>
    @endif
    <!-- /.content -->
   <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script>
      $(function() {
           $.ajaxSetup({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
          var table_user = $('#tabeluser').DataTable({
              processing: true,
              serverSide: true,
              ajax: '/manajemenuser/json',
              columns: [
                  { data: 'DT_RowIndex', name:'DT_RowIndex'},
                  { data: 'name', name: 'name' },
                  { data: 'email', name: 'email' },
                  { data: 'jabatan', name: 'jabatan' },
                  {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
          });

       
       $('#createNewUser').click(function () {
        $('#saveBtn').val("create-product");
        $('#id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Tambah User");
        $('#ajaxModel').modal('show');
    });

     $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
          data: $('#productForm').serialize(),
          url: "/manajemenuser/insert",
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
       table_user.ajax.reload()
    });

     $('body').on('click', '.editProduct', function () {
      var id = $(this).data('id');
          $.get("{{ route('manajemenuser.index') }}" +'/' + id +'/edit', function (data) {
          $('#modelHeading2').html("Edit Data");
          $('#saveBtn2').val("edit-user");
          $('#ajaxModel2').modal('show');
          $('#id').val(data.id);
          $('#name').val(data.name); 
          $('#email').val(data.email);
          $('#jabatan').val(data.jabatan);       
       })
   });

    $('#saveBtn2').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
          data: $('#productForm2').serialize(),
          url: "/manajemenuser/update",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#productForm2').trigger("reset");
              $('#ajaxModel2').modal('hide');
              Swal.fire({
                                type: 'success',
                                title: 'success...',
                                text: 'Data Telah Terupdate',
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
            url: "/manajemenuser/destroy"+'/'+id,
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

