<!DOCTYPE html> 
<html  lang="{{ app()->getLocale() }}">
 <head> 
 	<title>List Harga Produk</title>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

table, th, td {
  border: 1px solid black;
}
th{
	text-align: center;
}
</style> 
</head> 
<body> 
	<p align="center"><span style="font-size: x-large;"><strong>CV PUTRA ADIDARMA </strong></span></p>
	<p align="center"><span style="font-size: medium;">Grand Sharon JL. Sharon Selatan II No. 11 Rt.03/11 Bandung</span></p>
	<p align="center"><span style="font-size: medium;">Hp. 082338214191 / 082216786597 </span></p>
	<p align="center"><span style="font-size: medium;">EMAIL : cvputraadidarma@yahoo.com </span></p>
	<p align="center">&nbsp;</p>
	<p align="center"><span style="font-size: large;"><u><strong>LAPORAN PENGELUARAN </strong></u></span></p>
	<p align="center">&nbsp;</p>
	<p style="text-align: left;" align="left"><span style="font-size: medium;"><strong>A. Sayuran dan Buah - Buahan</strong></span></p>
		<p style="text-align: right;">
		<span style="color: #000000;">
		@if($dari == '' && $sampai == '' && $supplier == 'all')
          		<?php
					$tanggal= mktime(date("m"),date("d"),date("Y"));
					echo "Tanggal : <b>".date("d-M-Y", $tanggal)."</b> ";
					date_default_timezone_set('Asia/Jakarta');?>
        @elseif($dari == '' && $sampai == '')
          <?php
					$tanggal= mktime(date("m"),date("d"),date("Y"));
					echo "Tanggal : <b>".date("d-M-Y", $tanggal)."</b> ";
					date_default_timezone_set('Asia/Jakarta');?>
        @elseif($supplier == 'all')
            <strong>
				<?php echo date('d F Y' , strtotime($dari)) ?> -
				<?php echo date('d F Y' , strtotime($sampai)) ?>
	        </strong>
        @else
        <strong>
				<?php echo date('d F Y' , strtotime($dari)) ?> -
				<?php echo date('d F Y' , strtotime($sampai)) ?>
	        </strong>
        @endif
			
	    </span>
	</p>
	<table class="table mb-none"> 
		<thead> 
			<tr> 
				<th>Nama Barang Keluar</th>
				<th>Jenis</th>
				<th>Kuantitas</th>
				<th>Harga</th>
				<th>Total Harga</th>
				<th>Nama Supplier</th>
			</tr> 
		</thead> 
		<tbody> @foreach ($barang_masuks as $item) <tr> 
			<td>{{ $item->barang->nama_barang }}</td> 
			<td>{{ $item->barang->jenis }}</td> 	
			<td>{{ $item->kuantitas }} {{ $item->barang->satuan }}</td> 
			<td><?php echo 'Rp.'. number_format($item->harga,'2',',','.') ?></td> 
			<td><?php echo 'Rp.'. number_format($item->total,'2',',','.') ?></td> 
			<td>{{ $item->supplier->nama}}</td>
		</tr> @endforeach 
	</tbody> 
</table> 
			<p align="left"><span style="font-size: medium;"><strong>Total Uang Keluar :
			Rp. {{number_format($barang_masuks->sum('total'),'2',',','.')}}</strong></span></p>
			
			<p align="left"><span style="font-size: medium;"><strong>Total Barang Keluar : </strong></span></p>
			<ul>
				<li>
					{{$satuan_ikat->sum('kuantitas')}} <b>Ikat</b>
				</li>
				<li>
					{{$satuan_kg->sum('kuantitas')}} <b>Kilogram</b>
				</li>
			</ul>
			<p align="left">
				<span style="font-size: medium;"><strong>Keterangan :</strong></span>
			</p>
			<ul>
				<li>
					{{$jenis_sayur->count()}} <b>Sayuran</b>
				</li>
				<li>
					{{$jenis_buah->count()}} <b>Buah - Buahan</b>
				</li>
			</ul>
</body> 
</html>


