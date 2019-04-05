@extends('layouts.admin')

@section('title','User')
@section('header','User')

@section('content')
					<ul class="app-breadcrumb breadcrumb side">
					    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
					    <li class="breadcrumb-item">Ubah Profil</li>
					</ul>
							<div class="row" id="create">
							<div class="col-xs-12">
								<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
								</div>
						
								<h2 class="panel-title"><i class="fa fa-user"></i> Profile
								</h2>
							</header>
									<div class="panel-body">
										<div class="form-body">
                                        <form id="formUser" method="post" enctype="multipart/form-data">
 										{{csrf_field()}} {{ method_field('POST') }}
          										<div class="form-group">
													<input type="hidden" name="id" id="id">
													<label class="col-md-3 control-label">Nama : </label>
													<!-- nama -->
													<div class="col-md-6" id="nama_user">
													<input type="text" id="nama" class="form-control" name="name">
													<span class="help-block has-error nama_barang_error"></span>
													</div>
													<!-- endnama -->
													<!-- namatext -->
													<div class="col-md-6" id="nama_user_text">
													<p>{{$users->name}}</p>
													</div>
													<!-- namatext -->
												</div>

												<div class="form-group">
													<label class="col-md-3 control-label">Email :</label>
													<!-- email -->
													<div class="col-md-6" id="email_user">
													<input type="text" id="email_" class="form-control" name="email">
													<span class="help-block has-error nama_barang_error"></span>
													</div>
													<!-- endemail -->

													<!-- emailtext -->
													<div class="col-md-6" id="email_user_text">
													<p>{{$users->email}}</p>
													</div>
													<!-- endemailtext -->
												</div>

												<div class="form-group">
													<input type="hidden" name="id" id="id">
													<label class="col-md-3 control-label">Password</label>
													<div class="col-md-6">
													<input id="nama_barang" type="text" class="form-control" name="nama_barang">
													<span class="help-block has-error nama_barang_error"></span>
													</div>
												</div>


                                                <div class="form-group" id="button-2">
													<label class="col-md-3 control-label"></label>
													<div class="col-md-6">
													<button type="submit" class="mb-xs mt-xs mr-xs btn btn-info editUser" id="editUser"><i class="fa fa-pencil"></i> Simpan</button>
                                                    <a class="mb-xs mt-xs mr-xs btn btn-danger" id="cancel"><i class="fa fa-ban"></i> Batal</a>				
                                                	</div>
                                                </div>

												
                                                <div class="form-group" id="button-1">
													<label class="col-md-3 control-label"></label>
													<div class="col-md-6">
													<a data-id="{{$users->id}}" class="mb-xs mt-xs mr-xs btn btn-warning editUser" id="editUser"><i class="fa fa-pencil"></i> Ubah Profil</a>
													</div>
                                                </div>


                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
    

						</section>

@endsection
@section('js')
<script type="text/javascript">
     $('#nama_user').attr('hidden',true); 
     $('#email_user').attr('hidden',true); 
     $('#button-2').attr('hidden',true); 

     $('#cancel').on('click',function(){
           $('#nama_user').attr('hidden',true);
           $('#email_user').attr('hidden',true); 
           $('#nama_user_text').attr('hidden',false);
           $('#email_user_text').attr('hidden',false);  
           $('#button-2').attr('hidden',true); 
     	   $('#button-1').attr('hidden',false); 
     });

      $(document).on('click', '.editUser', function(){
            var nomor = $(this).data('id');
            $('#formUser').submit('');
            $.ajax({
              url:'ubahprofil/getedit' + '/' + nomor,
              method:'get',
              data:{id:nomor},
              dataType:'json',
              success:function(data){
                console.log(data);
                state = "update";
                $('#id').val(data.id);
                $('#nama').val(data.name);
                $('#email_').val(data.email);
                $('#password').val(data.password);
                $('#nama_user').attr('hidden',false);
                $('#email_user').attr('hidden',false); 
                $('#nama_user_text').attr('hidden',true);
                $('#email_user_text').attr('hidden',true); 
     			$('#button-2').attr('hidden',false); 
     			$('#button-1').attr('hidden',true); 
                }
              });
          });

      $('#formUser').submit(function(e){
              $.ajaxSetup({
                header: {
                  'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
              });
              e.preventDefault();
              $.ajax({
                  url:'ubahprofil/edit' + '/' + $('#id').val(),
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
                     $('#nama_user').attr('hidden',true);
		             $('#email_user').attr('hidden',true); 
		             $('#nama_user_text').attr('hidden',false);
		             $('#email_user_text').attr('hidden',false);    
                  },
                  complete: function() {
                      $("#formUser")[0].reset();
                  }
              });
      });

    
</script>
@endsection