@extends('layouts.index')
@section('content')
<?php 

$PREFIX = config('app.app_prefix');

?>
{{-- <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.css"> --}}
<br><br>
<div class="container">
  <div class="card-header bg-info">Create Role</div>
    <div class="row">
      <div class="col-md-7">
        <div class="card">
          <div class="card-body">
            <form action="/{{ $PREFIX }}/role" method="post">
		          {{ csrf_field() }}
              <div class="form-group">
                <label>Name</label><br>
                <input type="text" name="name" class="form-control" placeholder="fill this name...">
                @if($errors->has('name'))
                    <div class="text-danger">
                    {{ $errors->first('name')}}
                  </div>
                @endif
              </div>
              <div class="form-group">
                <label>Description</label> <br>
                <textarea name="description" class="form-control" placeholder="fill this description..."></textarea>
                @if($errors->has('description'))
                    <div class="text-danger">
                    {{ $errors->first('description')}}
                  </div>
                @endif
              </div>
          </div>
            </div>
        </div>
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="">List Permission</label>
                <div style="height: 250px;overflow: overlay;padding: 10px;">
                  <div>
                    <ul style="list-style-type: none;padding:unset;">
                      @foreach ($permissions as $permission)
                        <li>
                          <label for="{{ $permission->name }}">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="flat-red" id="{{ $permission->name }}">
                            {{ $permission->name }}
                          </label>
                          
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/{{ $PREFIX }}/role" class="btn btn-secondary">Back</a>
	      </form>
        </div>
      </div>
      </div>
    </div>
  </div>
<script src="/assets/plugins/icheck-bootstrap/icheck.js"></script>
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

// $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
//   checkboxClass: 'icheckbox_flat-green',
//   radioClass   : 'iradio_flat-green'
// })

</script>
@endsection