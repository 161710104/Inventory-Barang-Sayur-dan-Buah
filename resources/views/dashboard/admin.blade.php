@extends('layouts.admin')

@section('title','Home')
@section('header','Barang')

@section('content')
							<div class="row" style="margin-top: -70px;">
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-primary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-primary">
														<i class="fa fa-group"></i>
													</div>
												</div>
												 @php
											      $customers	 = App\Customer::all();
											      $customerss	 = App\Customer::where('status','Activate')->get();
											     @endphp
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Customer</h4>
														<div class="info">
															<strong class="amount">{{$customers->count()}}</strong>
															<span class="text-primary">({{$customerss->count()}} Aktif)</span>
														</div>
													</div>
													<div class="summary-footer">
														<a href="/admin/customers" class="text-muted text-uppercase">(lihat selengkapnya)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-secondary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-secondary">
														<i class="fa fa-group"></i>
													</div>
												</div>
												 @php
											      $suppliers = App\Supplier::all();
											     @endphp
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Supplier</h4>
														<div class="info">
															<strong class="amount">{{$suppliers->count()}}</strong>
														</div>
													</div>
													<div class="summary-footer">
														<a href="/admin/suppliers" class="text-muted text-uppercase">(lihat selengkapnya)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-tertiary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-tertiary">
														<i class="fa fa-shopping-cart"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title"><b>Barang Keluar</b> Hari ini</h4>
														<div class="info">
															<strong class="amount">{{$barang_keluar->count()}}</strong>
														</div>
													</div>
													<div class="summary-footer">
														<a href="/admin/barang_keluars" class="text-muted text-uppercase">(lihat selengkapnya)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-6 col-xl-6">
									<section class="panel panel-featured-left panel-featured-quartenary">
										<div class="panel-body">
											<div class="widget-summary">
												<div class="widget-summary-col widget-summary-col-icon">
													<div class="summary-icon bg-quartenary">
														<i class="fa fa-user"></i>
													</div>
												</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title"><b>Barang Masuk </b> Hari Ini</h4>
														<div class="info">
															<strong class="amount">{{$barang_masuk->count()}}</strong>
														</div>
													</div>
													<div class="summary-footer">
														<a href="/admin/barang_masuks" class="text-muted text-uppercase">(lihat selengkapnya)</a>
													</div>
												</div>
											</div>
										</div>
									</section>
								</div>

							</div>
							<div class="row" style="margin-top: -70px;">
								
							<div class="col-md-12 col-lg-6 col-xl-6">
							<section class="panel">
										<div class="panel-body">
											<div class="small-chart pull-right" id="sparklineBarDash"></div>
											<img src="/assets/images/price.png" width="80px" height="80px" style="float: right;">
											<div class="h3 text-bold mb-none">Rp. {{number_format($lap_pemasukan->sum('total'),'2',',','.')}}</div>
											<h5>Total <b>Uang Masuk</b> Hari Ini</h5>
										</div>
									</section>
								</div>
								<div class="col-md-12 col-lg-6 col-xl-6">
							<section class="panel">
										<div class="panel-body">
											<div class="small-chart pull-right" id="sparklineBarDash"></div>
											<img src="/assets/images/price.png" width="80px" height="80px" style="float: right;">
											<div class="h3 text-bold mb-none">Rp. {{number_format($lap_pengeluaran->sum('total'),'2',',','.')}}</div>
											<h5>Total <b>Uang Keluar</b> Hari Ini</h5>
										</div>
							</section>
								</div>
							</div>


							<section class="panel panel-info">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
								</div>

								<h2 class="panel-title"><i class="fa fa-users"></i> Log Aktivitas</h2>
							</header>
							<div class="panel-body">
              <div class="table-responsive">
								<table class="table table-mb-none" id="datatable-ajax">
									<thead>
										<tr>
							               <th>Nama User</th>
							               <th>Aktivitas</th>
							               <th>Tanggal</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($logs as $item)
                                                    <tr>
	                                                    <td>
	                                                    	{{$item->user->name}}
	                                                	</td>
	                                                    <td>{{$item->description}}</td>
	                                                    <td><?php echo date('d F Y h:i:sa' , strtotime($item->created_at)) ?></td>
                                                    </tr>
                                                    @endforeach

							          </tbody>
								</table>
                </div>
							</div>
						</section>
						<div id="clock"></div>
						<script type="text/javascript">
		<!--
		function showTime() {
		    var a_p = "";
		    var today = new Date();
		    var curr_hour = today.getHours();
		    var curr_minute = today.getMinutes();
		    var curr_second = today.getSeconds();
		    if (curr_hour < 12) {
		        a_p = "AM";
		    } else {
		        a_p = "PM";
		    }
		    if (curr_hour == 0) {
		        curr_hour = 12;
		    }
		    if (curr_hour > 12) {
		        curr_hour = curr_hour - 12;
		    }
		    curr_hour = checkTime(curr_hour);
		    curr_minute = checkTime(curr_minute);
		    curr_second = checkTime(curr_second);
		 document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
		    }
 
		function checkTime(i) {
		    if (i < 10) {
		        i = "0" + i;
		    }
		    return i;
		}
		setInterval(showTime, 500);
		//-->
		</script>


									

@endsection
@section('js')
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatable-ajax').DataTable();
  });
  </script>
@endsection