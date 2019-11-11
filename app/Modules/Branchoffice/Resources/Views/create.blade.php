@extends('layouts.index')
@section('content')
<?php 

$PREFIX = config('app.app_prefix');

?>
{{-- <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.css"> --}}
<br><br>
<div class="container">
  <div class="card-header bg-info">Create Office</div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form action="/{{ $PREFIX }}/role" method="post">
		          {{ csrf_field() }}
              <div class="form-group">
                <label>Province</label><br>
                <select class="form-control" name="province_id" id="province">
                    <option></option>
                    @foreach ($provinces as $province)
                    <option value="{{ $province->id }}">{{ $province->province_name }}</option>
                    @endforeach
                </select>
                @if($errors->has('province_id'))
                    <div class="text-danger">
                    {{ $errors->first('province_id')}}
                    </div>
                @endif
                <div class="form-group">
                <label>City</label><br>
                <select class="form-control" name="city_id" id="city">
                    <option></option>
                </select>
                @if($errors->has('city_id'))
                    <div class="text-danger">
                    {{ $errors->first('city_id')}}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label>Address</label><br>
                <input type="text" name="address" class="form-control" placeholder="fill this address...">
                @if($errors->has('address'))
                    <div class="text-danger">
                    {{ $errors->first('address')}}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label>Office Phone Number</label><br>
                <input type="text" name="phone_number" class="form-control" placeholder="fill this phone number...">
                @if($errors->has('phone_number'))
                    <div class="text-danger">
                    {{ $errors->first('phone_number')}}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label>Office Type</label><br>
                <select class="form-control" name="office_type">
                    <option></option>
                    <option value="head-office">Head Office</option>
                    <option value="branch-office">Branch Office</option>
                </select>
                @if($errors->has('phone_number'))
                    <div class="text-danger">
                    {{ $errors->first('phone_number')}}
                    </div>
                @endif
              </div>
          </div>
          <div class="card-footer">
          <center>
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="/{{ $PREFIX }}/branchoffice" class="btn btn-secondary">Back</a>
          </center>
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