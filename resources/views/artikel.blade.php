@extends('layouts.index')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css')}}">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
         <div class="container">
            @if ($message = Session::get('sukses'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
				</div>
                @endif
             @if ($message = Session::get('sukses21'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{{ $message }}</strong>
				</div>
                @endif
      <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">Artikel</div>

                <div class="card-body">
                   <a class="btn btn-success btn-sm" href="/artikel/tambah"><i class="fa fa-plus">&nbsp Tambah Artikel</i></a><br><br>
         <div class="table-responsive">
	        <table  class="table table-striped table-bordered table-hover table-list data-table21">
                  <thead>
                    <tr style="vertical-align:middle;text-align:center;font-weigth:bold">
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                      </tr> 
                  </thead>
                  
                </table>
          </div></div>
         </div>
        </div>
       </div>
    </div>
   </div>
</section>
   <!-- /.content -->
   <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>

<script>

     $(function() {
         
          $.ajaxSetup({
          headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
          var table_kat = $('.data-table21').DataTable({
              processing: true,
              serverSide: true,
              ajax: '/artikel/json',
              columns: [
                  { data: 'DT_RowIndex', name:'DT_RowIndex'},
                  { data: 'judul', name: 'judul' },
                  { data: 'kategori', name: 'kategori' },
                  { data: 'foto',
                  'searchable': false,
                  'orderable':false,
                  'render': function (data, type, full, meta)
                     {
                       @foreach($settingweb as $s)
                  return '<center><img src="{{ $s->link_web}}/'+data+'" style="height:100px;width:100px;"/></center';
                  @endforeach
                     }
                   },               
                  { data: 'id', 
                   "render": function ( data, type, row, meta ) {
                            return '<a href="/artikel/edit/'+data+'" title="edit" class="btn btn-xs btn-warning" style="margin-bottom:4px;margin-right:2px;"><i class="fa fa-edit"></i></a><a data-id="'+data+'" class="btn btn-xs btn-danger" style="margin-bottom:4px;" title="hapus" id="hapusartikel"><i class="fa fa-trash"></i></a>';
                       }
                }
                ]
          });

           $(document).on('click','#hapusartikel',function(){
            // dapetin dulu ID si usernya dari tag element button data-id
            var id = $(this).data('id')

            // kirim data ke server untuk hapus user dengan id 
            $.ajax({
              type: "DELETE",
              url: "/artikel/hapus/" + id,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(data){
                var json  = JSON.parse(data)

                switch (json.code) {
                  case 200:
                       Swal.fire({
                                type: 'success',
                                title: 'Oops...',
                                text: 'Data has been Deleted!',
                            })
                    break;
                  default:
                    break;
                }

                // refresh datatablesnya kalau sudah menghapus usernya
                table_kat.ajax.reload()
              }
            });
          })

    });
    </script>
@endsection