@extends('layouts.admin')

@section('title','Barang Keluar')
@section('header','Barang Keluar')

@section('content')
					<ul class="app-breadcrumb breadcrumb side">
					    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
					    <li class="breadcrumb-item">Barang Keluar</li>
					</ul>
           @include('BarangKeluar.create')
          <div id="index">
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>  
								</div>
						
								<h2 class="panel-title"><i class="fa fa-dropbox"></i> Barang Keluar
								&nbsp<button type="button" class="mb-xs mt-xs mr-xs btn btn-primary" id="TambahBarangMasuk" ><i class="fa fa-plus"></i> Tambah Barang Keluar</button>
								</h2>
							</header>
							<div class="panel-body">
              <div class="table-responsive">
								<table class="table table-mb-none" id="datatable-ajax">
									<thead>
										<tr>
							               <th>Nama Barang Keluar</th>
							               <th>Jenis</th>
							               <th>Kuantitas</th>
							               <th>Harga</th>
							               <th>Tanggal Keluar</th>
							               <th>Nama Customer</th>
							               <th>Nama Karyawan</th>
							               <th><center> Action</center></th>
										</tr>
									</thead>
									<tbody>
							          </tbody>
								</table>
                </div>
							</div>
						</section>
          </div>

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
      ajax : '/jsonbarang_keluars',
      columns : [
        {data : 'barang.nama_barang'},
        {data : 'barang.jenis'},
        {data : 'quantity'},
        {data : 'harga_jual'},
        {data : 'tanggal_keluar'},
        {data : 'customer.nama'},
        {data : 'karyawan.name'},
        {data: 'action', orderable: false, searchable: false}
      ],
    });
    $('#create').attr('hidden',true);
    $('#Edit').attr('hidden',true);   
    $('#TambahBarangMasuk').on('click',function(){
            $('#create').attr('hidden',false);
            $('#index').attr('hidden',true);
            $('#bm_edit').remove();  
            state = "insert"; 
            });

    $('#cancel').on('click',function(){
            $('#index').attr('hidden',false); 
            $('#create').attr('hidden',true);
            $('#Edit').attr('hidden',true);  
             });

    $('#cancel_edit').on('click',function(){
            $('#index').attr('hidden',false); 
            $('#create').attr('hidden',true);
            $('#Edit').attr('hidden',true);  
             });
    function createData() {
          $('#formBarang_keluar').submit(function(e){
              $.ajaxSetup({
                header: {
                  'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
              });
              e.preventDefault();
              if (state == 'insert') {
              $.ajax({
                  url:'/storebarang_keluars',
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
                        title:'Success Tambah!',
                        text: data.message,
                        type:'success',
                        timer:'2000'
                      });
                    $('#create').attr('hidden',true);
                    $('#index').attr('hidden',false);  
                    $('#datatable-ajax').DataTable().ajax.reload();
                  },
                  complete: function() {
                      $("#formBarang_keluar")[0].reset();
                  }
              });
          }
          else{
            
            $.ajax({
                  url:'/barang_keluars/edit' + '/' + $('#id').val(),
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
                        title:'Success Edit !',
                        text: data.message,
                        type:'success',
                        timer:'2000'
                      });
                    $('#create').attr('hidden',true);
                    $('#Edit').attr('hidden',true);
                    $('#index').attr('hidden',false);  
                    $('#datatable-ajax').DataTable().ajax.reload();
                  },
                  complete: function() {
                      $("#formBarang_keluar")[0].reset();
                  }
              });
          }
          });
      }
      $(document).on('click', '.editBarang', function(){
            var nomor = $(this).data('id');
            $('#formBarang_keluar').submit('');
            $.ajax({
              url:'/barang_keluars/getedit' + '/' + nomor,
              method:'get',
              data:{id:nomor},
              dataType:'json',
              success:function(data){
                console.log(data);
                state = "update";
                $('#id').val(data.id);
                $('#id_barang').val(data.id_barang);
                $('#jenis').val(data.jenis);
                $('#kuantitas').val(data.kuantitas);
                $('#harga').val(data.harga);
                $('#id_supplier').val(data.id_supplier);
                $('#create').attr('hidden',false);
                $('#bm_edit').show();
                $('#bm_create').attr('hidden',true);
                $('#orang').attr('hidden',true);
                $('#time').attr('hidden',true);
                }
              });
          });

                  $('#create').attr('hidden',true);
                  $('#Edit').attr('hidden',true);
                  $('#index').attr('hidden',false);  
                  $('#datatable-ajax').DataTable().ajax.reload();
      $(document).on('click', '.delete', function(){
              var bebas = $(this).attr('id');
                if (confirm("Yakin Dihapus ?")) {
                  $.ajax({
                    url: 'barang_keluars/delete' + '/' + bebas,
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
  <script type="text/javascript">

    $('.content').delegate('.barangselect','change',function(){
      var tr = $(this).parent().parent();
      var id = tr.find('.barangselect').val();
      var dataId = {'id' : id};
      console.log(dataId);
      $.ajax({
        type      : 'GET',
        url       : '{!! url('barangkeluars/getIdBarang') !!}',
        dataType  : 'json',
        data      : dataId,

        success:function(data){
          tr.find('.harga_jual').val(data.harga_jual);
          tr.find('.stok').val(data.kuantitas);
        }
      });
    });
      
      var count = 1
      $('#add').click(function(){
        count = count + 1;
        var html = "<tr id='row"+count+"'>";
        html +='<td><select name="id_barang[]" class="form-control barangselect select-pilih" id="barang">@foreach($barang as $data)<option value="{{$data->id}}">{{$data->nama_barang}}</option>@endforeach</select></td>';

        html +='<td><input type="number" name="kuantitas[]" class="form-control kuantitas"/></td>';

        html +='<td><input type="text" class="form-control stok" readonly/></td>';

        html +='<td><input type="number" name="harga[]" id="harga_jual" class="form-control harga_jual" value=""/></td>';

        html +='<td><button type="button" class="btn btn-danger btn-sm remove" data-row="row'+ count +'"><i class="fa fa-minus-square"></i></button></td></tr>';

        $('#coba').append(html);  
      });

       $(document).on('click','.remove',function(){
        var delete_row = $(this).data("row");
        $('#' + delete_row).remove();
       });

     $("#customer").change(function()
      {
        var id=$(this).val();
        $.ajax
        
        ({

        type: "GET",
        url: "/barang_keluars/getIdCustomer",
        data: {id: id},
        cache: false,
        dataType:"json",
        success: function(data)
      {
        $("input[name='id_customer']").val(data.id_customer);
        $("input[name='nama']").val(data.nama);
        $("input[name='no_telepon']").val(data.no_telepon);
        $("input[name='alamat']").val(data.alamat);
        $("input[name='awal']").val(data.awal);
        $("input[name='akhir']").val(data.akhir);

        

    } 

  });

});



  
  </script>
@endsection