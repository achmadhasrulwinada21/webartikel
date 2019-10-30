@extends('layouts.index')
@section('content')
<br><br>
<div class="container">
       <div class="card-header bg-info">Edit Artikel</div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
             

                <div class="card-body">

	       <form method="post" action="/artikel/update/{{ $artikel->id }}" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                     <div class="form-group">
                            <label>Judul</label>
                            <input type="text" name="judul" class="form-control" value=" {{ $artikel->judul }}">

                            @if($errors->has('judul'))
                                <div class="text-danger">
                                    {{ $errors->first('judul')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Isi Artikel</label> 
                         <textarea id="content" class="form-control" name="isi_artikel">{{ $artikel->isi_artikel }}</textarea>
                     </div>
                     <div class="form-group">
                            <label>Keyword</label>
                            <input type="text" name="keyword" class="form-control" value=" {{ $artikel->keyword }}">

                            @if($errors->has('keyword'))
                                <div class="text-danger">
                                    {{ $errors->first('keyword')}}
                                </div>
                            @endif
                        </div>
                </div>
            </div>
        </div>
         <div class="col-md-4">
            <div class="card">
                <div class="card-body"> 
                     <div class="form-group">
                        <label>Upload Gambar</label> 
                          <div class="row">
                             <div class="col s6">
                               @foreach ($settingweb as $sw )
                                 <img src="{{ URL::to("$artikel->foto")}}" id="showgambar" style="max-width:200px;max-height:200px;float:left;" />
                                 @endforeach
                          </div>
                        </div>
                        <br>
                    <div class="row">
                       <div class="input-field col s6">
                           <div class="custom-file">
                           <input type="file" id="inputgambar" name="foto" class="custom-file-input" accept="image/*"/ >
                         <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                       </div>
                   </div>
                </div>  
                  <div class="form-group">
                        <label>Upload File (*pdf)</label> 
                          <div class="row">
                             <div class="col s6">
                                @if($artikel->file_artikel ==' ')
                                   <b>no file<b>
                                @else
                                @foreach ($settingweb as $s )
                                <a href="{{ URL::to("$artikel->file_artikel")}}" target="blank"><img src="{{ URL::to("/assets/pdf.png")}}" id="showgambar2" style="max-width:200px;max-height:200px;float:left;" /></a>
                                 @endforeach
                                @endif
                          </div>
                        </div>
                        <br>
                    <div class="row">
                       <div class="input-field col s6">
                            <div class="custom-file">
                           <input type="file" id="inputgambar2" name="file_artikel" class="custom-file-input" accept="application/pdf"/ >
                         <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                       </div>
                   </div>
                </div>                                     
            <div class="form-group">
                <label>Kategori</label>
                <select class="form-control" name="id_kategori">
                            @foreach($kategori as $role)
                 <option value="{{ $role->id }}" {{ $artikel->id_kategori == $role->id ? 'selected="selected"' : '' }}>{{ $role->kategori }}</option>
                  @endforeach    
                </select>
            </div>
                <div class="form-group">
                    <input type="submit"  value="Update" class="btn btn-success btn-sm">
                </div>

 </form>
        </div></div></div>

    </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#content').summernote({
      height: "300px",
      styleWithSpan: false
    });
  }); 
</script>
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
@endsection