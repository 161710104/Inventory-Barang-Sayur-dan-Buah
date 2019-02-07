$(document).ready(function(){
    createData();
    $('#datatable-ajax').DataTable({
      aaSorting :[],
      stateSave : true,
      processing : true,
      serverSide : true,
      ajax : '{!! url('jsoncustomer') !!}',
      columns : [
        {data : 'nama', name: 'nama'},
        {data : 'no_telepon', name: 'no_telepon'},
        {data : 'awal_kerjasama'},
        {data : 'akhir_kerjasama'},
        {data : 'statuss'},
        {data: 'action', orderable: false, searchable: false}
      ],
  });

     $('#create').attr('hidden',true); 
    $('#TambahCustomer').on('click',function(){
            $('#create').attr('hidden',false);
            state = "insert"; 
            });

    $('#cancel').on('click',function(){
           $('#index').attr('hidden',false); 
            $('#create').attr('hidden',true); 
             });
    function createData() {
          $('#formCustomer').submit(function(e){
              $.ajaxSetup({
                header: {
                  'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
              });
              e.preventDefault();
              if (state == 'insert') {
              $.ajax({
                  url:'/storecustomers',
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
                      $("#formCustomer")[0].reset();
                  }
              });
          }
          else{
            $.ajax({
                  url:'customers/edit' + '/' + $('#id').val(),
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
                    $('#index').attr('hidden',false);  
                    $('#datatable-ajax').DataTable().ajax.reload();
                  },
                  complete: function() {
                      $("#formCustomer")[0].reset();
                  }
              });
          }
          });
      }
      $(document).on('click', '.editCustomer', function(){
            var nomor = $(this).data('id');
            $('#formCustomer').submit('');
            $.ajax({
              url:'customers/getedit' + '/' + nomor,
              method:'get',
              data:{id:nomor},
              dataType:'json',
              success:function(data){
                console.log(data);
                state = "update";
                $('#id').val(data.id);
                $('#nama').val(data.nama);
                $('#no_telepon').val(data.no_telepon);
                $('#alamat').val(data.alamat);
                $('#awal').val(data.awal);
                $('#akhir').val(data.akhir);
                $('#status').val(data.status);
                $('#create').attr('hidden',false);
                $('#index').attr('hidden',false);
                $('#aksi').val('Simpan');
                }
              });
          });

                  $('#create').attr('hidden',true);
                  $('#index').attr('hidden',false);  
                  $('#datatable-ajax').DataTable().ajax.reload();

    $(document).on('click', '.delete', function(){
              var bebas = $(this).attr('id');
                if (confirm("Yakin Dihapus ?")) {
                  $.ajax({
                    url: 'customers/delete' + '/' + bebas,
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
  