@extends('layouts.index')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css')}}">
 <ul class="nav nav-tabs">
  <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/admin/settingweb') }}" class="nav-link active">Title</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/settingweb/perusahaan') }}" class="nav-link active">Perusahaan</a>
      </li>
       <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/settingweb/sosmed') }}" class="nav-link">Sosmed</a>
      </li>
</ul>

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
      <div class="container">
         @if ($message = Session::get('sukses'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
        </div>
        @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card">
            @foreach ($settingweb as $sw )
 <form action="/settingweb/update_sosmed" method="post" class="form-horizontal" enctype="multipart/form-data">
  {{ csrf_field() }}
   {{ method_field('PUT') }}
  <br>
            <input type="hidden" name="id" id="id" value="{{ $sw->id }}">
         <div class="col-md-12">
             <div class="row">
                 <div class="form-group" style="margin-left:80px;margin-right:12px;">
                        <label for="name" class="col-sm-6 control-label">Logo Facebook</label>
                        <div class="col-md-12">
                          <div class="row">
                             <div class="col s6">
                               @foreach ($settingweb as $sw )
                                 <img src="{{ URL::to("$sw->logo_sosmed1")}}" id="showgambar" style="max-width:100px;max-height:100px;float:left;" />
                                 @endforeach
                          </div>
                        </div><br>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="logo_sosmed1" accept="image/*">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                              </div><br><br>
                               <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">Link Facebook</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="link_web" name="link_sosmed1" placeholder="Enter link web" value="{{ $sw->link_sosmed1 }}" maxlength="50" required>
                     </div>
                    </div>
                          </div>
                          </div>
                   <div class="form-group" style="margin-left:12px;margin-right:12px;">
                        <label for="name" class="col-sm-6 control-label">Logo Instagram</label>
                        <div class="col-md-12">
                          <div class="row">
                             <div class="col s6">
                               @foreach ($settingweb as $sw )
                                 <img src="{{ URL::to("$sw->logo_sosmed2")}}" id="showgambar" style="max-width:100px;max-height:100px;float:left;" />
                                 @endforeach
                          </div>
                        </div><br>
                          <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="logo_sosmed2" accept="image/*">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                              <br><br>
                               <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">Link Instagram</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="link_web" name="link_sosmed2" placeholder="Enter link web" value="{{ $sw->link_sosmed2 }}" maxlength="50" required>
                     </div>
                    </div>
                          </div>
                          </div>
                          <div class="form-group" style="margin-left:12px;margin-right:12px;">
                        <label for="name" class="col-sm-6 control-label">Logo Twitter</label>
                        <div class="col-md-12">
                          <div class="row">
                             <div class="col s6">
                               @foreach ($settingweb as $sw )
                                 <img src="{{ URL::to("$sw->logo_sosmed3")}}" id="showgambar" style="max-width:100px;max-height:100px;float:left;" />
                                 @endforeach
                          </div>
                        </div><br>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="logo_sosmed3" accept="image/*">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                              <br><br>
                               <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">Link Twitter</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="link_web" name="link_sosmed3" placeholder="Enter link web" value="{{ $sw->link_sosmed3 }}" maxlength="50" required>
                     </div>
                    </div>
                          </div>
                          </div>
                        </div></div>
                     <br><br>
           <div class="col-sm-offset-2 col-sm-10" style="margin-left:80px;margin-right:12px;">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create"><span class="fa fa-save">&nbspSave changes</span>
                     </button>
                    </div>
                </form>
               @endforeach
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