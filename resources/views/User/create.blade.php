<div id="create">
<div class="row">
							<div class="col-xs-12">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<i class="fa fa-times" id="cancel"></i>
										</div>
						
										<h2 class="panel-title"><i class="fa fa-pencil"></i> User</h2>
									</header>
									<div class="panel-body">
										<div class="form-body">
                                         <form id="formUser" method="post" enctype="multipart/form-data">
 										{{csrf_field()}} {{ method_field('POST') }}
          								<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<input type="hidden" name="id" id="id">
													<label class="control-label">Nama User</label>
													<input type="text" name="name" id="name" class="form-control">
													<span class="help-block has-error name_error"></span>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<label class="control-label">Email</label>
													<input type="email" name="email" id="email" class="form-control">
													<span class="help-block has-error email_error"></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<label class="control-label">Kata Sandi</label>
													<input type="password" name="password" id="password" class="form-control" value="">
													<span class="help-block has-error password_error"></span>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="form-group">
													<br>
													<button type="submit" onclick="return confirm('Yakin ingin menambahkan data?')" class="mb-xs mt-xs mr-xs btn btn-primary" id="aksi"><i class="fa fa-check-circle"></i> Simpan</button>
                                                    <button type="reset" class="mb-xs mt-xs mr-xs btn btn-danger"><i class="fa fa-ban"></i> Hapus</button>
												</div>
											</div>
										</div>			
										</form>
									</div>
								</section>
							</div>
						</div>
				
				</div>