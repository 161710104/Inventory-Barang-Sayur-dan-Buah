<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Modal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="modal fade" id="myModalPerpanjang" role="dialog">
    <div class="modal-dialog">
<div class="modal-content">
  <form id="formPerpanjang" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Perpanjang Kerjasama </h4>
        </div>
        <div class="modal-body">
          {{csrf_field()}} {{ method_field('POST') }}
          <div class="form-group">
            <input type="hidden" name="idd" id="idd">
                     <label>Tanggal Sebelumnya</label>
                     <input type="text" name="tgl_sebelumnya" id="tgl_sebelumnya" class="form-control" readonly>
                     <span class="help-block has-error judul_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Tanggal Perpanjang</label>
                     <input type="date" name="akhir" id="akhir2" class="form-control" 
                     placeholder="Nilai Satuan" required>
                     <span class="help-block has-error pengarang_error"></span>
                  </div>
                  <div class="form-group"  style="display: none;">
                      <input type="text" name="nama" id="nama2" class="form-control">
                      <input type="number" name="no_telepon" id="no_telepon2" class="form-control" data-plugin-maxlength maxlength="13">
                      <textarea class="form-control" rows="3" data-plugin-maxlength maxlength="140" name="alamat" id="alamat2" style="height: 60px;"></textarea>
                      <input type="date" name="awal" id="awal2" class="form-control">
                  </div>
                  <input type="text" name="status" id="status2" value="" class="hidden">
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" name="submit" id="aksi">Simpan</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</body>
</html> 