	@extends('layouts.admin')

	@section('title','Laporan Pemasukan')
	@section('header','Laporan Pemasukan')

	@section('content')
	<link rel="stylesheet" href="/assets/stylesheets/datatable_laporan.css" />
						<ul class="app-breadcrumb breadcrumb side">
						    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
						    <li class="breadcrumb-item">Laporan Pemasukan</li>
						</ul>


							<div class="row">
								<div class="col-xs-12">
									<section class="panel">
										<header class="panel-heading">
											<div class="panel-actions">
												<a href="#" class="fa fa-caret-down"></a>
											</div>
											<h2 class="panel-title">
												<i class="fa fa-dropbox"></i> Laporan Pemasukan
											</h2>
											<div style="position:absolute;right:100px;top:20px;">
												<?php echo date('d F Y' , strtotime($dari)) ?> -
												<?php echo date('d F Y' , strtotime($sampai)) ?>
											</div>

										</header>
								<form action="{{ url('laporan_uang_masuk/downloadPDF')}}" method="post">
                               {{csrf_field()}}
										<div class="panel-body">
												<div class="form-body">
													<div class="col-xs-12">
														<div class="row">
														<div class="col-sm-3">
															<div class="form-group">
																<input type="hidden" name="dari" value="{{$dari}}">
																<input type="hidden" name="sampai" value="{{$sampai}}">
																<button type="submit" class="mb-xs mt-xs mr-xs btn btn-warning">
                            									<i class="fa fa-file-pdf-o"></i>&nbspPDF</button>
															</div>
														</div>
														</div>
													</form>
										                <table class="table mb-none" id="datatable-ajax">
													<thead>
														<tr>
											               <th>Nama Barang Keluar</th>
											               <th>Jenis</th>
											               <th>Kuantitas</th>
											               <th>Harga</th>
											               <th>Total Harga</th>
											               <th>Tanggal Keluar</th>
											               <th>Nama Customer</th>
														</tr>
													</thead>
													<tbody>

												            @foreach ($barang_keluar as $item)
												            <tr>
															<td>{{$item->barang->nama_barang}}</td>
															<td>{{$item->barang->jenis}}</td>
															<td>{{$item->kuantitas}} {{$item->barang->satuan}}</td>
															<td>

																<?php echo 'Rp.'. number_format($item->harga) ?>
															</td>
															<td><?php echo  'Rp.'. number_format($item->total)?></td>
															<td>
																<?php echo date('d F Y h:i:sa' , strtotime($item->created_at)) ?>
															</td>
															<td>{{$item->customer->nama}}</td>
														</tr>
														@endforeach
											          </tbody>
												</table>
												<br>
												<h5>Total Uang Keluar :
												<b>Rp. {{number_format($barang_keluar->sum('total'),'2',',','.')}}</b>
												</h5>

												<table table class="table mb-none">
													<thead>
													<tr>
														<th>Total Barang Keluar : </th>
														<th>Keterangan : </th>
													</tr>
													</thead>
													<tbody>
														<td>
															<li>{{$satuan_ikat->sum('kuantitas')}} <b>Ikat</b></li>
															<li>{{$satuan_kg->sum('kuantitas')}} <b>Kilogram</b></li>
														</td>
														<td>
															<li>{{$jenis_sayur->count()}} <b>Sayuran</b></li>
															<li>{{$jenis_buah->count()}} <b>Buah - Buahan</b></li></
														</td>
													</tbody>
												</table>
										              </div>
										            </div>

												</div>
											</form>
										</div>
									</section>

								</div>
							</div>


@endsection
@section('js')
  <script type="text/javascript">
  $(document).ready(function(){
    $('#datatable-ajax').DataTable();
  });
  </script>
@endsection
