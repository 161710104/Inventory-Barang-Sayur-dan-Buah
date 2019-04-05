@extends('layouts.admin')

@section('title','User')
@section('header','User')

@section('content')
					<ul class="app-breadcrumb breadcrumb side">
					    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
					    <li class="breadcrumb-item">User</li>
					</ul>
@include('User.create')
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
								</div>
						
								<h2 class="panel-title"><i class="fa fa-user"></i> User
                  &nbsp<button type="button" class="mb-xs mt-xs mr-xs btn btn-primary" id="TambahUser">
                    <i class="fa fa-plus"></i> Tambah User</button>
								</h2>
							</header>
							<div class="panel-body">
                			<div class="table-responsive">
								<table class="table mb-none" id="datatable-ajax">
									<thead>
										<tr>
							               	<th>Nama</th>
                             				<th>Email</th>
							               	<th><center> Action</center></th>
										</tr>
									</thead>
									<tbody>
							  	
							          </tbody>
								</table>
                </div>
							</div>
						</section>

@endsection
@section('js')
  <script type="text/javascript">
  $(document).ready(function(){
    createData();
    $('#datatable-ajax').DataTable({
      aaSorting :[],
      stateSave : true,
      processing : true,
      serverSide : true,
      ajax : '/jsonuser',
      columns : [
        {data : 'name', name: 'name'},
        {data : 'email' , name: 'email'},
        {data: 'action', orderable: false, searchable: false}
      ],  
    });

     $('#create').attr('hidden',true); 
    $('#TambahUser').on('click',function(){
            $('#awal').attr('hidden',false); 
            $('#create').attr('hidden',false);
            state = "insert"; 
            });

    $('#cancel').on('click',function(){
           $('#awal').attr('hidden',false); 
            $('#create').attr('hidden',true); 
             });

  function createData() {
          $('#formUser').submit(function(e){
              $.ajaxSetup({
                header: {
                  'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
              });
              e.preventDefault();
              if (state == 'insert') {
              $.ajax({
                  url:'/storeusers',
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
                        title:'Berhasil Menambahkan Data!',
                        text: data.message,
                        type:'success',
                        timer:'2000'
                      });
                    $('#create').attr('hidden',true);
                    $('#awal').attr('hidden',false);  
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
                      $("#formUser")[0].reset();
                  }
              });
          }
          else{
            $.ajax({
                  url:'/users/edit' + '/' + $('#id').val(),
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
                        title:'Berhasil Edit !',
                        text: data.message,
                        type:'success',
                        timer:'2000'
                      });
                    $('#create').attr('hidden',true);
                    $('#awal').attr('hidden',false);  
                    $('#datatable-ajax').DataTable().ajax.reload();
                  },
                  complete: function() {
                      $("#formUser")[0].reset();
                  }
              });
          }
          });
      }
      $(document).on('click', '.editUser', function(){
            var nomor = $(this).data('id');
            $('#formUser').submit('');
            $.ajax({
              url:'/users/getedit' + '/' + nomor,
              method:'get',
              data:{id:nomor},
              dataType:'json',
              success:function(data){
                console.log(data);
                state = "update";
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#password').val(data.password);
                $('#create').attr('hidden',false);
                $('#awal').attr('hidden',false);  
                $('#aksi').val('Simpan');
                }
              });
          });

                  $('#create').attr('hidden',true);
                  $('#awal').attr('hidden',false);  
                  $('#datatable-ajax').DataTable().ajax.reload();

    $(document).on('click', '.delete', function(){
              var bebas = $(this).attr('id');
                if (confirm("Yakin Dihapus ?")) {
                  $.ajax({
                    url: '/users/delete' + '/' + bebas,
                    method: "get",
                    data:{id:bebas},
                    success: function(data){
                      swal({
                        title:'Success Delete!',
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