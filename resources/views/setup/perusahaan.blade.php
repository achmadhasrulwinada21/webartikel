@extends('layouts.index')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css')}}">
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             <h1 class="m-0 text-dark">Setup Web</h1>
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
     @if ($message = Session::get('sukses21'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
        </div>
        @endif
      <div class="container">
        <div class="row">
           <div class="col-md-6">
       <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Tabs</h3>
                <ul class="nav nav-pills ml-auto p-2">
                  <li class="nav-item"><a class="nav-link" href="{{ url('/admin/settingweb') }}">Title</a></li>
                  <li class="nav-item"><a class="nav-link active" href="{{ url('/settingweb/perusahaan') }}">Company</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('/settingweb/sosmed') }}">Sosial Media</a></li>
                </ul>
              </div><!-- /.card-header -->
  <form action="/settingweb/update_perusahaan" method="post" class="form-horizontal" enctype="multipart/form-data">
  {{ csrf_field() }}
   {{ method_field('PUT') }}
  <br>
            <input type="hidden" name="id" id="id" value="{{ $settingweb->id }}">
               
            <div class="form-group" style="margin-left:12px;margin-right:12px;">
                        <label for="name" class="col-sm-4 control-label">Perusahaan</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nm_perusahaan" name="nm_perusahaan" placeholder="Enter perusahaan" value="{{ $settingweb->nm_perusahaan }}" maxlength="50" required>
               </div>
                    </div>
                    <div class="form-group" style="margin-left:12px;margin-right:12px;">
                        <label for="name" class="col-sm-4 control-label">Alamat</label>
                        <div class="col-sm-12">
                      <textarea class="form-control" name="alamat" id="alamat" required>{{ $settingweb->alamat }}</textarea>
                     </div></div>
                    <div class="form-group" style="margin-left:12px;margin-right:12px;">
                        <label for="name" class="col-sm-4 control-label">No Telp</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Enter NO Telpon" value="{{ $settingweb->no_telp }}" maxlength="50" required>
                     </div>
                    </div>
                     <div class="form-group" style="margin-left:12px;margin-right:12px;">
                        <label for="name" class="col-sm-4 control-label">Fax</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="fax" name="fax" placeholder="Enter NO Fax" value="{{ $settingweb->fax }}" maxlength="50" required>
                     </div>
                    </div>
                      <div class="form-group" style="margin-left:12px;margin-right:12px;">
                        <label for="name" class="col-sm-4 control-label">Copyright</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="copyright" name="copyright" placeholder="Enter link web" value="{{ $settingweb->copyright }}" maxlength="50" required>
                     </div>
                    </div>
                     <div class="col-sm-offset-2 col-sm-10" style="margin-left:12px;margin-right:12px;">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create"><span class="fa fa-save">&nbspSave changes</span>
                     </button>
                    </div>
                </form>
              <div class="card-body">
        </div>
    </div>
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
   <!-- /.content -->
   <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
@endsection