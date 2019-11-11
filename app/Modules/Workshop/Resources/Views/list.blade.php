@extends('layouts.index')
@section('content')

<?php

$prefix = config('app.app_prefix');

?>

<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css')}}">
 <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen Workshop</h1>
            </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">Workshop</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  
  <section class="content">
    <div class="container">
        <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card">
            <div class="card-header bg-info">
              Workshop Management
            </div>
            <div class="card-body">
            <a class="btn btn-success btn-sm" href="workshop/create"  style="color:white;"><i class="fa fa-plus"> Create Workshop</i></a><br><br>
                <div class="table-responsive">
                    <table  class="table-hover table-striped table-bordered table-list" id="workshopDatatables">
                      <thead>
                        <tr style="vertical-align:middle;text-align:center;font-weigth:bold">
                            <th>No</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Action</th>
                          </tr> 
                      </thead>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
    </div>
      
</section>
 <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
 <script>

    $(function() {
            
      $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var role_table = $('#workshopDatatables').DataTable({
          processing: true,
          serverSide: true,
          ajax: '/{{ $prefix }}/workshop/all',
          columns: [
              { data: 'id', name:'id'},
              { data: 'name', name: 'name' },
              { data: 'address', name: 'address' },
              { data: 'phone', name: 'phone' },
              { 
                data: 'action', 
                name: 'action', 
                orderable: false, 
                searchable: false
              }
            ]
      });
    
    $(document).on('click', '#deleteRole', function () {
      var id = $(this).data("id");

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
            $.ajax({
            type: "DELETE",
            url: "/{{ $prefix }}/role/" + id,
            success: function(data){
              var json  = JSON.parse(data)
              switch (json.status) {
                case 200:
                  Swal.fire({
                              type: 'success',
                              title: 'Oops...',
                              text: json.message,
                          })
                  break;
                default:
                  break;
              }

              // refresh datatablesnya kalau sudah menghapus rolenya
              role_table.ajax.reload()
              }
            });
        }
      })



      
    })
        
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