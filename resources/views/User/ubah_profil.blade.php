@extends('layouts.admin')

@section('title','User')
@section('header','User')

@section('content')
<style type="text/css">
  html .panel-warning .panel-heading {
    background: #34495e;
}
body .btn-warning{
    color: #ffffff;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    background-color: #34495e;
    border-color: #34495e;
}
body .btn-success{
    color: #ffffff;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    background-color: #34495e;
    border-color: #34495e;
}
.panel {
    margin-top: -70px;
}
body .btn-warning:hover {
    border-color: #34495e !important;
    background-color: #34495e;
}
body .btn-success:hover {
    border-color: #34495e !important;
    background-color: #34495e;
}
</style>
							<div class="row" id="create">
							<div class="col-xs-12">
								<section class="panel panel-warning">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
								</div>
						
								<h2 class="panel-title"><i class="fa fa-user"></i> Profile
								</h2>
							</header>
									<div class="panel-body">
										<div class="form-body content">
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
													<label class="col-md-3 control-label">Kata Sandi : </label>

                          <!-- Password -->
													<div class="col-md-6" id="password_user">
													<input id="password" type="password" class="form-control" name="password">
													<span class="help-block has-error password_error"></span>
													</div>
                          <!-- endPassword -->

                          <!-- emailtext -->
                          <div class="col-md-6" id="password_user_text">
                          <p>***********</p>
                          </div>
                          <!-- endemailtext -->
												</div>


                                                <div class="form-group" id="button-2">
													<label class="col-md-3 control-label"></label>
													<div class="col-md-6">
													<button type="submit" class="mb-xs mt-xs mr-xs btn btn-success editUser" id="editUser"><i class="fa fa-pencil"></i> Simpan</button>
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
     $('#password_user').attr('hidden',true); 
     $('#button-2').attr('hidden',true); 

     $('#cancel').on('click',function(){
           $('#nama_user').attr('hidden',true);
           $('#email_user').attr('hidden',true); 
           $('#password_user').attr('hidden',true);
           $('#nama_user_text').attr('hidden',false);
           $('#email_user_text').attr('hidden',false);  
           $('#password_user_text').attr('hidden',false);
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
                $('#password_user').attr('hidden',false);
                $('#nama_user_text').attr('hidden',true);
                $('#email_user_text').attr('hidden',true); 
                $('#password_user_text').attr('hidden',true); 
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
      });
       $('#nama_user').attr('hidden',true); 
       $('#email_user').attr('hidden',true); 
       $('#password_user').attr('hidden',true); 
       $('#button-2').attr('hidden',true); 
       $('#nama_user_text').attr('hidden',false);
       $('#email_user_text').attr('hidden',false); 
       $('#password_user_text').attr('hidden',false); 
       $('#button-1').attr('hidden',false); 

    
</script>
<script type="text/javascript">
  $('.content').delegate('.stok,.sisa_stok,.kuantitas','keyup',function(){
      var tr = $(this).parent().parent();
      var kuantitas = tr.find('.kuantitas').val();
      var stok = tr.find('.stok').val();
      var sisa_stok = (stok - kuantitas);
      if (parseString(kuantitas) == parseString(stok)) {
        $('#stoklebih').show();
        var stoklebih = "Kuantitas melebihi stok, otomatis input semua stok"
        $('#stoklebih').addClass('alert alert-danger alert-dismissable fade in').html(stoklebih);
        setTimeout(function(){
          $('#stoklebih').fadeOut('slow');
        },5000);
        tr.find('.kuantitas').val(stok);
      }else{
        tr.find('.sisa_stok').val(sisa_stok);
      }
    });
</script>
@endsection