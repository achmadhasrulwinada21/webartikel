@extends('layouts.index')
@section('content')
<br><br>
<div class="container">
  <div class="card-header bg-info">Tambah Artikel</div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                 <div class="card-body">
	<form action="/artikel/insert" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    	<input type="hidden" name="language" value="ID" class="form-control" placeholder="isi Judul...">
		<label>Judul</label><br>
		<input type="text" name="judul" class="form-control" placeholder="isi Judul...">
		 @if($errors->has('judul'))
            <div class="text-danger">
             {{ $errors->first('judul')}}
           </div>
        @endif
		<br/>
        <label>Isi Artikel</label> <br>
		<textarea name="isi_artikel" class="form-control" id="content"></textarea>
		 @if($errors->has('isi_artikel'))
            <div class="text-danger">
             {{ $errors->first('isi_artikel')}}
           </div>
        @endif
        <label>Keyword</label><br>
		<input type="text" name="keyword" class="form-control" placeholder="isi Keyword...">
		 @if($errors->has('keyword'))
            <div class="text-danger">
             {{ $errors->first('keyword')}}
           </div>
        @endif
		<br/>
</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                  <div class="card-body">
                    <br/>
        <label>Upload Gambar</label><br>
   <div class="custom-file">
    <input type="file" class="custom-file-input" id="customFile" name="foto" accept="image/*">
    <label class="custom-file-label" for="customFile">Choose file</label>
  </div>
        <br/>
        <label>Upload File</label><b> (*pdf)</b><br>
    <div class="custom-file">
    <input type="file" class="custom-file-input upload" id="" name="file_artikel" accept="application/pdf">
    <label class="custom-file-label lblupload" for="customFile">Choose file</label>
  </div>
        <br/>
        <label>Kategori</label><br>
                     <select name="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror" >
                    <option value="0" selected disabled>- Pilih Kategori Barang -</option>
                    @foreach ($kategori as $pemilik)
                        <option value="{{ $pemilik->id }}">{{ ($pemilik->kategori) }}</option>
                    @endforeach
                     </select>
                            @error('id_kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>
		<input type="submit" value="Simpan Data" class="btn btn-info btn-sm">
	</form>

                </div>
    </div>
</div></div></div>

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
<script>
// Add the following code if you want the name of the file appear on select
$(".upload").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".lblupload").addClass("selected").html(fileName);
});
</script>
@endsection