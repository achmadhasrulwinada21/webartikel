@extends('layouts.index')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css')}}">
<div class="container">
   <br />
   <h2 align="center">Navbar : {{ $navbarheader->Judul }}</h2>
   <br />
   <div class="table-responsive">
 <form id="id_form" name="id_form">
     {{ csrf_field() }}
    <table class="table table-bordered" id="crud_table">
     <tr>
      <th width="30%">Judul</th>
      <th width="10%">Link</th>
      <th width="10%">Id Navbar</th>
      <th width="5%" style="text-align:center;"> <button type="button" name="add" id="add" class="btn btn-success btn-xs"><span class="fa fa-plus"></span></button></th>
     </tr>
     <tr>
      <td class="judul_sub"><input type="text" class="form-control" name="judul_sub[]"></td>
      <td class="link_sub"><input type="text" class="form-control" name="link_sub[]"></td>
      <td class="id_navbar"><input type="text" class="form-control" value="{{ $navbarheader->Judul }}" readonly><input type="hidden" class="form-control" name="id_navbar[]" value="{{ $navbarheader->id }}" readonly></td>
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
    <div class="row justify-content-center">
     <div class="col-md-11">
              <div class="card">
                <div class="card-header bg-info">Navbar Sub</div>
                <div class="card-body">
    <div class="table-responsive">
	<table  class="table table-striped table-hover table-list" id="tabelsub">
                  <thead>
                    <tr style="vertical-align:middle;text-align:center;font-weigth:bold">
                        <th>No</th>
                        <th>Judul</th>
                        <th>Link</th>
                        <th>Aksi</th>
                    </tr>
                  </thead>  
                   <tbody>
                   <?php $no = 0;?>
                      @foreach ( $navbarsub as $dtl) 
                   <?php $no++ ;?>
                     <tr>
                       <td>{{ $no }}</td>
                      <td>{{ $dtl->judul_sub }}</td>
                      <td>{{ $dtl->link_sub }}</td>
                      <td><center><a href="/navbar/show2/{{ $dtl->id }}" data-toggle="tooltip"  title="Tambah Sub" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Tambah Sub</a>
                      <a href="javascript:void(0)" data-toggle="tooltip" title="Update" data-id="{{ $dtl->id }}" data-judul_sub="{{ $dtl->judul_sub }}" data-link_sub="{{ $dtl->link_sub }}"  data-original-title="Edit" class="edit btn btn-primary btn-xs editProduct"><i class="fa fa-edit"></i>&nbspEdit</a>
                      <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" data-id="{{ $dtl->id }}" data-original-title="Delete" class="btn btn-danger btn-xs deleteProduct"><i class="fa fa-trash"></i>&nbspDelete</a></center>                     
                      </td>
                     </tr>
                    @endforeach
                  </tbody>              
                </table>
           </div></div></div></div></div>
   <div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title" id="modelHeading"></h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
        </button>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Judul</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="judul_sub" id="judul" placeholder="Enter kategori" value="" maxlength="50" required>
                     </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Link</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="link_sub" id="link" placeholder="Enter kategori" value="" maxlength="50" required>
                     </div>
                    </div>
                   <br>
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn21" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div><div class="modal-footer"></div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
 <script>
     $(function() {
           $.ajaxSetup({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
        });
 </script>
   <script>
$(document).ready(function(){
 var count = 1;
 $('#add').click(function(){
  count = count + 1;
  var html_code = "<tr id='row"+count+"'>";
   html_code += "<td class='judul_sub'><input type='text' class='form-control' name='judul_sub[]'></td>";
   html_code += "<td  class='link_sub'><input type='text' class='form-control' name='link_sub[]'></td>";
   html_code += "<td  class='id_navbar'><input type='text' class='form-control' value='{{ $navbarheader->Judul }}' readonly><input type='hidden' class='form-control' name='id_navbar[]' value='{{ $navbarheader->id }}'></td>";
   html_code += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'><span class='fa fa-times'></span></button></td>";   
   html_code += "</tr>";  
   $('#crud_table').append(html_code);
 });
 
 $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
 });
 $(function () {
      $('#tabelsub').dataTable({"lengthMenu": [[10, 25,  -1], [10,25, "All"]]} );       
      $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'Search');
    }); 
     $('#save').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
          data: $('#id_form').serialize(),
          url: "/navbar/insert_detail",
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

      $('body').on('click', '.editProduct', function () {
      var id = $(this).data('id');
      var judul = $(this).data('judul_sub');
      var link = $(this).data('link_sub');
          $('#modelHeading').html("Edit Data");
          $('#saveBtn21').val("edit");
          $('#ajaxModel').modal('show');
          $('#id').val(id);
          $('#judul').val(judul);
          $('#link').val(link);
        });

         $('#saveBtn21').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
          data: $('#productForm').serialize(),
          url: "/navbar/update_detail",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              $('#productForm').trigger("reset");
               $('#ajaxModel').modal('hide');
                 window.location = window.location.href;
            },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn21').html('Save Changes');
          }    
      });
      
     });

       $('body').on('click', '.deleteProduct', function () {
        var id = $(this).data("id");
        $.ajax({
            type: "DELETE",
            url: "/navbar/delete"+'/'+id,
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