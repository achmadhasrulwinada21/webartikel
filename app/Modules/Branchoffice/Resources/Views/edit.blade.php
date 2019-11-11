@extends('layouts.index')
@section('content')
<?php 

$PREFIX = config('app.app_prefix');

?>
{{-- <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.css"> --}}
<br><br>
<div class="container">
  <div class="card-header bg-info">Edit Office</div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form action="{{route('branchoffice.update', $branch->id)}}" method="post">
		          {{ csrf_field() }}
                  {{ method_field('PUT') }}
              <div class="form-group">
                <label>Province</label><br>
                <select class="form-control" name="province_id" id="province">
                    <!-- <option value="{{$branch->province_id}}">{{ $branch->provinces->province_name }}</option> -->
                    @foreach($provinces as $province)
                    <option value="{{ $province->id }}" @if($province->id == $branch->province_id) selected @endif>{{ $province->province_name }}</option>
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
                    @foreach($branch->provinces->cities as $city)
                    <option value="{{$city->id}}" @if($city->id == $branch->cities->id) selected @endif>{{$city->city_name}}</option>
                    @endforeach
                </select>
                @if($errors->has('city_id'))
                    <div class="text-danger">
                    {{ $errors->first('city_id')}}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label>Address</label><br>
                <input type="text" name="address"  value="{{$branch->address}}" class="form-control" placeholder="fill this address...">
                @if($errors->has('address'))
                    <div class="text-danger">
                    {{ $errors->first('address')}}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label>Office Phone Number</label><br>
                <input type="text" name="phone_number" value="{{$branch->phone_number}}" class="form-control" placeholder="fill this phone number...">
                @if($errors->has('phone_number'))
                    <div class="text-danger">
                    {{ $errors->first('phone_number')}}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label>Fax</label><br>
                <input type="text" name="fax" value="{{$branch->fax}}" class="form-control" placeholder="fill this fax...">
                @if($errors->has('fax'))
                    <div class="text-danger">
                    {{ $errors->first('fax')}}
                    </div>
                @endif
              </div>
              <div class="form-group">
                <label>Office Type</label><br>
                <select class="form-control"  name="office_type" id="office-type">
                @if($branch->office_type == "head-office")
                <option value="head-office" selected>Head Office</option>
                <option value="branch-office">Branch Office</option>
                @else
                <option value="branch-office" selected>Branch Office</option>
                <option value="head-office">Head Office</option>
                @endif
                    
                </select>
                @if($errors->has('phone_number'))
                    <div class="text-danger">
                    {{ $errors->first('phone_number')}}
                    </div>
                @endif
              </div>
              <div class="form-group" id="head-office">
                <label>Head Office Name</label><br>
                <input type="text" value="{{$branch->head_office}}" name="head_office" id="frm-head-office" class="form-control" placeholder="fill this head office...">
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

    $('#office-type').change(function(){
      if($(this).val() === 'branch-office'){
        $('#head-office').show();
      }else{
        $('#head-office').hide();
        $('#frm-head-office').val("");
      }
    })

    if($('#office-type').val() === 'branch-office' ){
        $('#head-office').show();
      }else{
        $('#head-office').hide();
        $('#frm-head-office').val("");
    }

    $('#province').change(function(){
      var province_id = $(this).val();

      $.ajax({
        url: '/{{ $PREFIX }}/city/province/'+province_id,
        type: 'GET',
        dataType: 'JSON',
        success: function(response){
          var html = "";
          response.forEach(function(data){
            html += '<option value="'+data.id+'">';
            html += data.city_name;
            html += '</option>';
          })
          $('#city').html(html);
          html = "";
        }
      })
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