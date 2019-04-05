@extends('layouts.admin')

@section('title','Customer')
@section('header','customer')

@section('content')

					<ul class="app-breadcrumb breadcrumb side">
					    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
					    <li class="breadcrumb-item">Customer</li>
					</ul>

          @include('Customer.create')
          <div id="index">
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
								</div>

								<h2 class="panel-title"><i class="fa fa-users   "></i> Customer
								&nbsp<button type="button" class="mb-xs mt-xs mr-xs btn btn-primary" id="TambahCustomer" >
								<i class="fa fa-plus"></i> Tambah Customer</button>
								</h2>
							</header>
							<div class="panel-body">
              <div class="table-responsive">
								<table class="table table-mb-none" id="datatable-ajax">
									<thead>
										<tr>
							               <th>Nama</th>
							               <th>No Telepon</th>
							               <th>Awal Kejasama</th>
							               <th>Akhir Kerjasama</th>
                             <th>Status</th>
							               <th><center> Action</center></th>
										</tr>
									</thead>
									<tbody>

							          </tbody>
								</table>
                </div>
							</div>
						</section>
</div>
@include('Customer.perpanjang')
@endsection
@section('js')
  <script type="text/javascript">

  $(document).ready(function(){
    createData();
    Perpanjang();
    $('#datatable-ajax').DataTable({
      aaSorting :[],
      stateSave : true,
      processing : true,
      serverSide : true,
      ajax : '{!! url('jsoncustomer') !!}',
      columns : [
        {data : 'nama', name: 'nama'},
        {data : 'no_telepon', name: 'no_telepon'},
        {data : 'awal_kerjasama'},
        {data : 'akhir_kerjasama'},
        {data : 'statuss'},
        {data: 'action', orderable: false, searchable: false}
      ],
  });

    $('#create').attr('hidden',true);
    $('#myModalPerpanjang').modal('hide');
    $('#TambahCustomer').on('click',function(){
            $('#create').attr('hidden',false);
     		$('#myModalPerpanjang').remove();

            state = "insert";
            });

    $('#cancel').on('click',function(){
           $('#index').attr('hidden',false);
            $('#create').attr('hidden',true);
             });
    function createData() {
          $('#formCustomer').submit(function(e){
              $.ajaxSetup({
                header: {
                  'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
              });
              e.preventDefault();
              if (state == 'insert') {
              $.ajax({
                  url:'/storecustomers',
                  type:'post',
                  data: new FormData(this),
                  cache: true,
                  contentType: false,
                  processData: false,
                  async:false,
                  dataType: 'json',
                  success: function (data){
                    console.log(data);
                    swal({
                        title:'Sukses Tambah!',
                        text: data.message,
                        type:'success',
                        timer:'2000'
                      });
                    $('#create').attr('hidden',true);
                    $('#index').attr('hidden',false);
                    $('#datatable-ajax').DataTable().ajax.reload();
                  },
                  error:function (data){
                    $('input').on('keydown keypress keyup click change', function(){
                      $(this).parent().removeClass('has-error');
                      $(this).next('.help-block').hide()
                    });
                    var coba = new Array();
                    console.log(data.responseJSON.errors);
                    $.each(data.responseJSON.errors,function(name,value){
                      console.log(name);
                      coba.push(name);
                      $('input[name='+name+']').parent().addClass('has-error');
                      $('input[name='+name+']').next('.help-block').show().text(value);
                    });
                    $('input[name='+coba[0]+']').focus();
                  },
                  complete: function() {
                      $("#formCustomer")[0].reset();
                  }
              });
          }
          else{
            $.ajax({
                  url:'customers/edit' + '/' + $('#id').val(),
                  type:'post',
                  data: new FormData(this),
                  cache: true,
                  contentType: false,
                  processData: false,
                  async:false,
                  dataType: 'json',
                  success: function (data){
                    console.log(data);
                    swal({
                        title:'Sukses Edit !',
                        text: data.message,
                        type:'success',
                        timer:'2000'
                      });
                    $('#create').attr('hidden',true);
                    $('#index').attr('hidden',false);
                    $('#datatable-ajax').DataTable().ajax.reload();
                  },
                  complete: function() {
                      $("#formCustomer")[0].reset();
                  }
              });
          }
          });
      }

     function Perpanjang() {
          $('#formPerpanjang').submit(function(e){
              $.ajaxSetup({
                header: {
                  'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
              });
              e.preventDefault();
            $.ajax({
                  url:'customers/edit' + '/' + $('#idd').val(),
                  type:'post',
                  data: new FormData(this),
                  cache: true,
                  contentType: false,
                  processData: false,
                  async:false,
                  dataType: 'json',
                  success: function (data){
                    console.log(data);
                    swal({
                        title:'Sukses Perpanjang !',
                        text: data.message,
                        type:'success',
                        timer:'2000'
                      });
                    $('#create').attr('hidden',true);
                    $('#index').attr('hidden',false);
    				        $('#myModalPerpanjang').modal('hide');
                    $('#datatable-ajax').DataTable().ajax.reload();
                  },
                  complete: function() {
                      $("#formPerpanjang")[0].reset();
                  }
              });

          });
      }

      $(document).on('click', '.perpanjangcs', function(){
            var nomor = $(this).data('id');
            $('#formPerpanjang').submit('');
            $.ajax({
              url:'customers/getedit' + '/' + nomor,
              method:'get',
              data:{id:nomor},
              dataType:'json',
              success:function(data){
                console.log(data);
                state = "update";
                $('#idd').val(data.id);
                $('#nama2').val(data.nama);
                $('#no_telepon2').val(data.no_telepon);
                $('#alamat2').val(data.alamat);
                $('#awal2').val(data.awal);
                $('#akhir2').val(data.akhir);
                $('#tgl_sebelumnya').val(data.akhir);
                $('#status2').val(data.status);
                $('#create').remove();
                $('#index').attr('hidden',false);
                $('#aksi').val('Simpan');
     			$('#myModalPerpanjang').modal('show');
                }
              });
          });

      $(document).on('click', '.editCustomer', function(){
            var nomor = $(this).data('id');
            $('#formCustomer').submit('');
            $.ajax({
              url:'customers/getedit' + '/' + nomor,
              method:'get',
              data:{id:nomor},
              dataType:'json',
              success:function(data){
                console.log(data);
                state = "update";
                $('#id').val(data.id);
                $('#nama').val(data.nama);
                $('#no_telepon').val(data.no_telepon);
                $('#alamat').val(data.alamat);
                $('#awal').val(data.awal);
                $('#akhir').val(data.akhir);
                $('#status').val(data.status);
                $('#create').attr('hidden',false);
                $('#index').attr('hidden',false);
     			$('#myModalPerpanjang').remove();
                }
              });
          });

                  $('#create').attr('hidden',true);
                  $('#index').attr('hidden',false);
                  $('#datatable-ajax').DataTable().ajax.reload();

    $(document).on('click', '.delete', function(){
              var bebas = $(this).attr('id');
                if (confirm("Yakin Dihapus ?")) {
                  $.ajax({
                    url: 'customers/delete' + '/' + bebas,
                    method: "get",
                    data:{id:bebas},
                    success: function(data){
                      swal({
                        title:'Sukses Delete!',
                        text:'Data Berhasil Dihapus',
                        type:'success',
                        timer:'1500'
                      });
                      $('#datatable-ajax').DataTable().ajax.reload();
                    }
                  })
                }
                else
                {
                  swal({
                    title:'Batal',
                    text:'Data Tidak Jadi Dihapus',
                    type:'error',
                    });
                  return false;
                }
              });

});

  </script>

@endsection
