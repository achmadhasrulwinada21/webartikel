@extends('layouts.index')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container">
    <div class="row">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <h3>Wellcome {{ Auth::user()->name }} in admin panel</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="{{ asset('assets/dist/js/pages/dashboard.js')}}"></script>
@endsection