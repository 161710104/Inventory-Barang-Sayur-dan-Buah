<div class="row" id="create">
					 		<div id="orang">
							<div class="col-xs-12">
								<section class="panel">
									<header class="panel-heading" style="padding: 0px;">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<i id="cancel" class="fa fa-times"></i>
										</div>
										<h2 class="panel-title"><i class="fa fa-group" style="margin-top: 20px;margin-left: 20px;"></i>
											<div class="form-group" >
													<div class="col-md-4">
														<select class="form-control mb-md" name="id_supplier" id="supplier" style="margin-left: 50px;margin-top: -25px;">
															<option selected="selected" disabled="disabled" value="">-Pilih Supplier-</option>
															@foreach ($supplier as $item)
															<option value="{{$item->id}}">{{$item->nama}}</option>
															@endforeach
														</select>
													</div>
                                                    @if ($errors->has('id_supplier'))
                                                        <span class="help-block">
                                                            <strong style="color:red;">{{ $errors->first('id_supplier') }}</strong>
                                                        </span>
                                                    @endif
											</div>
										</h2>
									</header>
									<div class="panel-body">
											<div class="form-body">
												<div class="col-xs-12" style="height: 90px;">
									              <div class="col-sm-4">
									                <table class="table" style="border-top: none;">
									                    <tr style="border-top: none;">
									                      <td style="border-top: none;">Nama supplier</td>
									                      <td style="border-top: none;">:</td>
									                      <td style="border-top: none;"><input type="text" name="nama" class="form-control" value="" style="border: none;background-color: #fdfdfd;" readonly/></td>
									                    </tr>
									     
									                </table>

									              </div>

									              <div class="col-sm-4">
									                <table class="table" style="border-top: none;">
									                    <tr>
									                      <td style="border-top: none;">No Telepon</td>
									                      <td style="border-top: none;">: </td>    
									                      <td style="border-top: none;"><input type="text" name="no_telepon" class="form-control" value="" style="border: none;background-color: #fdfdfd;width: 150px" readonly/></td>          
									                  	</tr>
									        
									                </table>

									            </div>
									            <div class="col-sm-4">
									                <table class="table" id="test" style="border-top: none;">
									                  
									                    <tr>
									                      <td style="border-top: none;">Alamat:</td>
									                      <td style="border-top: none;"></td>
									                      <td style="border-top: none;"><div class="col-md-18"><input type="text" name="alamat" class="form-control" value="" style="width: 220px;margin-left: -10px;border: none;background-color: #fdfdfd;height: 90px;" readonly /></div></td>
									                    </tr>
									                    
									                    
									                      
									                    </tr>
									                  
									               
									                      </td>
									                    </tr>
									                </table>
									              </div>
									            </div>
												
											</div>
										</form>
									</div>
								</section>

							</div>
							</div>
                        
							<div class="col-xs-12">
								<section class="panel">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<i id="cancel_edit" class="fa fa-times"></i>
										</div>
										<h2 class="panel-title"><i class="fa fa-pencil"></i> Barang Masuk</h2>
										<div style="position:absolute;right:100px;top:10px;" id="time">
							                <h5>
						                        <div>
						                            <div class="dmy agileits w3layouts">
						                            	Tanggal Barang Masuk:&nbsp
						                                <b><script type="text/javascript">
						                                    var mydate=new Date()
						                                    var year=mydate.getYear()
						                                    if(year<1000)
						                                    year+=1900
						                                    var day=mydate.getDay()
						                                    var month=mydate.getMonth()
						                                    var daym=mydate.getDate()
						                                    if(daym<10)
						                                    daym="0"+daym
						                                    var dayarray=new Array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu")
						                                    var montharray=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember")
						                                    document.write(" "+daym+" "+montharray[month]+"  "+year+"")
						                                </script></b>
						                             </div>
						                        </div>
						                    </h5>
							            </div>
									</header>
									<div class="panel-body">
								<form id="formBarang_masuk" method="post" enctype="multipart/form-data">
 										{{csrf_field()}} {{ method_field('POST') }}
											<input type="hidden" name="id" id="id">
											<div class="form-body content" id="bm_create">
												<center><button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-check-circle"></i> Simpan</button></h2></center>
												<table id="item_table" class="table table-bordered">
										            <tr id="last">
										              <th>Nama Barang</th>
										              <th>Kuantitas</th>
										              <th>Harga/KG</th>
										              <th>
										              	<input type="hidden" name="id_supplier" value="">
										              	<input type="hidden" name="id_karyawan" value="{{ Auth::user()->id }}">
										              	<button type="button" name="add" class="btn btn-success btn-sm add" onclick="addrow()"><i class="fa fa-plus-square"></i></button></th>
										            </tr>
										        </table>
											</div>
											<div class="form-body" id="bm_edit">
												<div class="row">
													<div class="col-sm-4">
														<div class="form-group">
															<input type="hidden" name="id" id="id">
															<label class="control-label">Nama Barang Masuk</label>
															<select class="form-control mb-md" name="id_barang" id="id_barang">
																	@foreach ($barang as $item)
																	<option value="{{$item->id}}">{{$item->nama_barang}}</option>
																	@endforeach
																</select>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label class="control-label">Kuantitas</label>
															<input id="kuantitas" type="number" class="form-control" name="kuantitas">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<br>
		                                                    <button type="submit" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-check-circle"></i> Simpan</button>
		                                                    <button type="reset" class="mb-xs mt-xs mr-xs btn btn-danger"><i class="fa fa-ban"></i> Hapus</button>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-sm-4">
														<div class="form-group">
															<input type="hidden" name="id" id="id">
															<label class="control-label">Harga</label>
															<input id="harga" type="number" class="form-control" name="harga" name="harga">
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label class="control-label">Nama Supplier</label>
															<select class="form-control mb-md" name="id_supplier" id="id_supplier">
																	@foreach ($supplier as $item)
																	<option value="{{$item->id}}">{{$item->nama}}</option>
																	@endforeach
																</select>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															
														</div>
													</div>
												</div>


														<input type="hidden" name="id_karyawan" value="{{ Auth::user()->id }}">
														<input type="hidden" name="quantity_awal" id="quantity_awal">
											</div>
								</form>
							</div>
						</section>
					</div>
				</div>
