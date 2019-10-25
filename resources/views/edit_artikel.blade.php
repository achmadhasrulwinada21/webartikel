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
                </div>
            </div>
        </div>
         <div class="col-md-4">
            <div class="card">
                <div class="card-body"> 
                     <div class="form-group">
                        <label>Upload</label> 
                          <div class="row">
                             <div class="col s6">
                                 <img src="{{ URL::to("/data_file/foto_artikel/$artikel->foto")}}" id="showgambar" style="max-width:200px;max-height:200px;float:left;" />
                          </div>
                        </div>
                        <br>
                    <div class="row">
                       <div class="input-field col s6">
                           <input type="file" id="inputgambar" name="foto" class="validate"/ >
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
@endsection