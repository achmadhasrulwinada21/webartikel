@extends('layouts.index')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css')}}">
<div class="container">
   <br />
   <h2 align="center">Sitemap : {{ $siteheader->Judul }}</h2>
   <br />
   <div class="table-responsive">
 <form id="id_form" name="id_form">
     {{ csrf_field() }}
    <table class="table table-bordered" id="crud_table">
     <tr>
      <th width="30%">Judul</th>
      <th width="10%">Link</th>
      <th width="10%">Id Sitemap</th>
      <th width="5%" style="text-align:center;"> <button type="button" name="add" id="add" class="btn btn-success btn-xs"><span class="fa fa-plus"></span></button></th>
     </tr>
     <tr>
      <td class="judul_detail"><input type="text" class="form-control" name="judul_detail[]"></td>
      <td class="link_detail"><input type="text" class="form-control" name="link_detail[]"></td>
      <td class="id_sitemap"><input type="text" class="form-control" value="{{ $siteheader->Judul }}" readonly><input type="hidden" class="form-control" name="id_sitemap[]" value="{{ $siteheader->id }}" readonly></td>
      <td></td>
     </tr>
    </table>
    <div align="right">
    </div>
    <div align="center">
     <button type="button" name="save" id="save" class="btn btn-info"><span class="fa fa-save">&nbspSave</span></button>
      </form>
      </div>
    <br />
    </div></div>
     <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-info">Sitemap Detail</div>
                <div class="card-body">
    <div class="table-responsive">
	<table  class="table table-striped table-hover table-list" id="tb-datatables3">
                  <thead>
                    <tr style="vertical-align:middle;text-align:center;font-weigth:bold">
                        <th>No</th>
                        <th>Judul</th>
                        <th>Link</th>
                        <th>Hapus</th>
                    </tr> 
                  </thead>
                  <tbody>
                   <?php $no = 0;?>
                      @foreach ( $sitedetail as $dtl) 
                   <?php $no++ ;?>
                     <tr>
                       <td>{{ $no }}</td>
                      <td>{{ $dtl->judul_detail }}</td>
                      <td>{{ $dtl->link_detail }}</td>
                      <td><a href="javascript:void(0)" data-toggle="tooltip" title="Delete" data-id="{{ $dtl->id }}" data-original-title="Delete" class="btn btn-danger btn-xs deleteProduct"><i class="fa fa-trash"></i>&nbspDelete</a></td>
                     </tr>
                    @endforeach
                  </tbody>
                  
                </table>
           </div></div></div></div>
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
   <script>
$(document).ready(function(){
 var count = 1;
 $('#add').click(function(){
  count = count + 1;
  var html_code = "<tr id='row"+count+"'>";
   html_code += "<td class='judul_detail'><input type='text' class='form-control' name='judul_detail[]'></td>";
   html_code += "<td  class='link_detail'><input type='text' class='form-control' name='link_detail[]'></td>";
   html_code += "<td  class='id_sitemap'><input type='text' class='form-control' value='{{ $siteheader->Judul }}' readonly><input type='hidden' class='form-control' name='id_sitemap[]' value='{{ $siteheader->id }}'></td>";
   html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'><span class='fa fa-times'></span></button></td>";   
   html_code += "</tr>";  
   $('#crud_table').append(html_code);
 });
 
 $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
 });
   $(function() {
           $.ajaxSetup({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
 });

  $(function () {
      $('#tb-datatables3').dataTable({"lengthMenu": [[10, 25,  -1], [10,25, "All"]]} );       
      $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'Search');
    }); 

   
   $('#save').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
          data: $('#id_form').serialize(),
          url: "/sitemap/insert_detail",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#id_form').trigger("reset");
               window.location = window.location.href;
              },
          error: function (data) {
              console.log('Error:', data);
              $('#save').html('Save Changes');
          }   
         
      });
      
     });
       $('body').on('click', '.deleteProduct', function () {
        var id = $(this).data("id");
        $.ajax({
            type: "DELETE",
            url: "/sitemap/delete"+'/'+id,
             success: function(data){
                var json  = JSON.parse(data)

                switch (json.code) {
                  case 200:
                   window.location = window.location.href;
                    break;
                  default:
                    break;
                }

            }
           });
          });
  });
 </script>
 @endsection