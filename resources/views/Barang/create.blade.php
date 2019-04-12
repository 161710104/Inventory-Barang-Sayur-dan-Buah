<div class="row" id="create">
							<div class="col-xs-12">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<i class="fa fa-times" id="cancel"></i>
										</div>
						
										<h2 class="panel-title"><i class="fa fa-pencil"></i> Barang</h2>
									</header>
									<div class="panel-body">
										<div class="form-body">
                                        <form id="formBarang" method="post" enctype="multipart/form-data">
 										{{csrf_field()}} {{ method_field('POST') }}
          								<div class="form-group">
												<input type="hidden" name="id" id="id">
													<label class="col-md-3 control-label">Nama Barang</label>
													<div class="col-md-6">
															<input id="nama_barang" type="text" class="form-control" name="nama_barang">
													<span class="help-block has-error nama_barang_error"></span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Jenis</label>
													<div class="col-md-6 control-label">
														<select class="form-control" name="jenis" id="jenis">
                                                                <option value="Sayur" >Sayur-Sayuran</option> 
                                                                <option value="Buah" >Buah-Buahan</option>
														</select>
														<span class="help-block has-error jenis_error"></span>
													</div>
												</div>

                                               <div class="form-group">
													<label class="col-md-3 control-label">Satuan</label>
													<div class="col-md-6 control-label">
                                                  
														<select class="form-control" name="satuan" id="satuan">
                                                                <option value="Kilogram" >Kilogram</option>
                                                                <option value="Ikat">IKat</option>
														</select>
														<span class="help-block has-error satuan_error"></span>
													</div>
                                                    
												</div>

                                                <div class="form-group">
													<label class="col-md-3 control-label">Harga Jual / KG</label>
													<div class="col-md-6">
													<input type="number" class="form-control" name="harga_jual" id="harga_jual">
													<span class="help-block has-error harga_error"></span>
													</div>
												</div>
												
                                                <div class="form-group">
													<label class="col-md-3 control-label"></label>
													<div class="col-md-6">
                                                    <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary" onclick="return confirm('Yakin ingin menambahkan data?')"><i class="fa fa-check-circle" id="aksi"></i> Simpan</button>
                                                    <button type="reset" class="mb-xs mt-xs mr-xs btn btn-danger"><i class="fa fa-ban"></i> Hapus</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
    
