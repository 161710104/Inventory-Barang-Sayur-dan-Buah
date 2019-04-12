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
	<p align="center"><span style="font-size: large;"><u><strong>DAFTAR HARGA DAN KETERANGAN PRODUK</strong></u></span></p>
	<p align="center">&nbsp;</p>
	<p style="text-align: left;" align="left"><span style="font-size: medium;"><strong>A. Sayuran dan Buah - Buahan</strong></span></p>
	<p style="color: red"><b><i>*Sewaktu - waktu harga jual bisa berubah</i></b></p>
	<table> 
		<thead> 
			<tr> 
				<th>Nama Barang</th> 
				<th>Jenis</th>
				<th>Satuan</th> 
				<th>Harga Jual / KG</th> 
			</tr> 
		</thead> 
		<tbody> @foreach ($barangs as $item) <tr> 
			<td>{{ $item->nama_barang }}</td> 
			<td>{{ $item->jenis }}</td> 
			<td>{{ $item->satuan }}</td> 
			<td><?php echo 'Rp.'. number_format($item->harga_jual,'2',',','.') ?></td> 
		</tr> @endforeach 
	</tbody> 
</table> 

<p style="text-align: center;">&nbsp;</p>
<p style="text-align: left;">PERSETUJUAN,&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; HORMAT KAMI,</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>CUSTOMER&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;CV PUTRA PUTRA ADIDARMA</p>
</body> 
</html>


