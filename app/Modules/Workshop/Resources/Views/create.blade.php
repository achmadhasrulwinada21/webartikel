@extends('layouts.index')
@section('content')
<?php 

$PREFIX = config('app.app_prefix');

?>

<br><br>
<div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-info">Create Workshop</div>
          <div class="card-body">
            <form action="/{{ $PREFIX }}/workshop" method="post">
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
                <label>Address</label> <br>
                <textarea name="address" class="form-control" placeholder="fill this address..."></textarea>
                @if($errors->has('address'))
                    <div class="text-danger">
                    {{ $errors->first('address')}}
                  </div>
                @endif
              </div>

              <div class="form-group">
                <label>Phone</label> <br>
                <input type="text" name="phone" class="form-control" placeholder="fill this phone...">
                @if($errors->has('phone'))
                    <div class="text-danger">
                    {{ $errors->first('phone')}}
                  </div>
                @endif
              </div>
              <div class="form-group">
                  <label>Fax</label> <br>
                  <input type="text" name="fax" class="form-control" placeholder="fill this fax...">
                  @if($errors->has('fax'))
                      <div class="text-danger">
                      {{ $errors->first('fax')}}
                    </div>
                  @endif
                </div>
              <div class="form-group">
                <label>City</label> <br>
                <input type="text" name="city" class="form-control" placeholder="fill this city...">
                @if($errors->has('fax'))
                    <div class="text-danger">
                    {{ $errors->first('fax')}}
                  </div>
                @endif
              </div>
              <div class="form-group">
                <label>Province</label> <br>
                <input type="text" name="province" class="form-control" placeholder="fill this province...">
                @if($errors->has('fax'))
                    <div class="text-danger">
                    {{ $errors->first('fax')}}
                  </div>
                @endif
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="/{{ $PREFIX }}/workshop" class="btn btn-secondary">Back</a>
              </div>
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