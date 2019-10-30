@extends('layouts.index')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css')}}">
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
     @if(Auth::user()->jabatan == 'admin')
 <section class="content">
      <div class="container">
         @if ($message = Session::get('sukses'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
        </div>
        @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">Web setting</div>
                @foreach ($settingweb as $sw )
 <form action="/settingweb/update" method="post" class="form-horizontal" enctype="multipart/form-data">
  {{ csrf_field() }}
  <br>
                   <input type="hidden" name="id" id="id" value="{{ $sw->id }}">
                <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Title Web</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="{{ $sw->title }}" maxlength="50" required>
               </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Nama Web</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="nm_web" name="nm_web" placeholder="Enter nama web" value="{{ $sw->nm_web }}" maxlength="50" required>
                     </div></div>
                     <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Logo Web</label>
                        <div class="col-sm-12">
                          <div class="row">
                             <div class="col s6">
                               @foreach ($settingweb as $sw )
                                 <img src="{{ URL::to("$sw->logo_web")}}" id="showgambar" style="max-width:200px;max-height:200px;float:left;" />
                                 @endforeach
                          </div>
                        </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="logo_web" accept="image/*">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                          </div>
                          </div>
                     <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Link Web</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="link_web" name="link_web" placeholder="Enter link web" value="{{ $sw->link_web }}" maxlength="50" required>
                     </div>
                    </div>
                   <br>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
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