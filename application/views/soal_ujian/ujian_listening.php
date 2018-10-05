<!DOCTYPE html>
<html>
<?php include(__DIR__ . "/../tittle.php"); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include(__DIR__ . "/../sidebar.php"); ?>
      <?php include(__DIR__ . "/../top_nav.php"); ?>

      <!-- page content -->
      <div class="right_col" role="main">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
              <div class="x_title">
                <h2>
                  <a href="<?=base_url()?>">
                    <i class="fa fa-home"></i>
                  </a>
                  <a href="<?=base_url()?>dosen">
                    Data Soal Tes Listening
                  </a>
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li>
                    <button type="button" id="btn-tambah" class="btn btn-primary">Tambah Soal Listening</button>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="tabel-data" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode</th>
                      <th>Audio</th>
                      <th>Gambar</th>
                      <th>Pertanyaan</th>
                      <th>Pilihan A</th>
                      <th>Pilihan B</th>
                      <th>Pilihan C</th>
                      <th>Pilihan D</th>
                      <th>Kunci</th>
                      <th>Tipe</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="tabel-body">
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Tampilan "model-tambah" -->
            <div class="modal fade" id="modal-tambah">
              <!-- jika ingin mengupload file wajib tambah atribut enctype -->
              <form id="form-tambah" data-parsley-validate method="POST" action="" enctype="multipart/form-data">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <h4 class="modal-title">Tambah Soal Listening</h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Audio</label>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="file" name="audio" accept="audio/*" required="required">
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <select name="list_audio" class="select2_single form-control" tabindex="-1">
                              <option value="xxx">Pilih Riwayat Audio</option>
                              <?php
                                foreach ($riwayat as $audio) {
                                  echo '<option value="'.$audio->audio.'">'.$audio->audio.'</option>';
                                }

                              ?>                        
                          </select>
                          </div>
                        </div> 
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Gambar</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="file" name="pic" accept="image/*" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Pertanyaan</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="pertanyaan" name="pertanyaan" class="required form-control input-xs" placeholder="Pertanyaan" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Pilihan A</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="pil_a" name="pil_a" class="required form-control input-xs" placeholder="Pilihan A" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Pilihan B</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="pil_b" name="pil_b" class="required form-control input-xs" placeholder="Pilihan B" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Pilihan C</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="pil_c" name="pil_c" class="required form-control input-xs" placeholder="Pilihan C" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Pilihan D</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="pil_d" name="pil_d" class="required form-control input-xs" placeholder="Pilihan D" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Kunci Jawaban</label>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <select class="form-control" id="jawaban" name="jawaban">
                            <option>Jawaban</option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                          </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Tipe</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <select  class="form-control" id="tipe" name="tipe">
                            <option value="">Pilih Tipe</option>
                            <?php
                                foreach ($tipe as $list) {
                                  echo '<option value="'.$list->id_kategori.'">'.$list->nama_kategori.'</option>';
                                }

                              ?>
                          </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <div class="btn-group">
                        <button data-dismiss="modal" class="btn btn-warning" type="button">Batal</button>
                        <button id="simpan" class="btn btn-success" type="button">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- Tampilan "modal-tambah" -->

            <div class="modal fade" id="modal-edit">
              <!-- jika ingin mengupload file wajib tambah atribut enctype -->
              <form id="form-edit" data-parsley-validate method="POST" action="" enctype="multipart/form-data">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <h4 class="modal-title">Ubah Soal Listening</h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Audio</label>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <input type="file" id="audio" name="audio" accept="audio/*" required="required">
                            <input type="hidden" id="id_soal" name="id_soal">
                            <input type="hidden" id="id_audio" name="id_audio">
                            <input type="hidden" id="nama_audio" name="nama_audio">
                            <input type="hidden" id="nama_gambar" name="nama_gambar">
                          </div>
                          <div class="col-md-4 col-sm-4 col-xs-12">
                            <select id="list_audio" name="list_audio" class="select2_single form-control" tabindex="-1">
                              <option value="xxx">Pilih Riwayat Audio</option>
                              <?php
                                foreach ($riwayat as $audio) {
                                  echo '<option value="'.$audio->audio.'">'.$audio->audio.'</option>';
                                }

                              ?>                        
                          </select>
                          </div>
                        </div> 
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Gambar</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="file" id="pic" name="pic" accept="image/*" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Pertanyaan</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="pertanyaan2" name="pertanyaan" class="required form-control input-xs" placeholder="Pertanyaan" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Pilihan A</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="pil_a2" name="pil_a" class="required form-control input-xs" placeholder="Pilihan A" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Pilihan B</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="pil_b2" name="pil_b" class="required form-control input-xs" placeholder="Pilihan B" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Pilihan C</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="pil_c2" name="pil_c" class="required form-control input-xs" placeholder="Pilihan C" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Pilihan D</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="pil_d2" name="pil_d" class="required form-control input-xs" placeholder="Pilihan D" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Kunci Jawaban</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control" id="jawaban2" name="jawaban">
                              <option>Jawaban</option>
                              <option value="A">A</option>
                              <option value="B">B</option>
                              <option value="C">C</option>
                              <option value="D">D</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Tipe</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <select  class="form-control" id="tipe2" name="tipe">
                            <option value="">Pilih Tipe</option>
                            <?php
                                foreach ($tipe as $list) {
                                  echo '<option value="'.$list->id_kategori.'">'.$list->nama_kategori.'</option>';
                                }

                              ?>
                          </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <div class="btn-group">
                        <button data-dismiss="modal" class="btn btn-warning" type="button">Batal</button>
                        <button id="edit" class="btn btn-success" type="button">Simpan</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
        Modern Electronic Semarang
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>
  <?php include(__DIR__ . "/../load_js.php"); ?>

  <script>
    $(document).ready(function(){
      var tabel = $('#tabel-data').dataTable({
        "bProcessing":  true,
        "bAutoWidth":   true,
        "bSort":    false,
        "sAjaxSource":  '<?php echo base_url(); ?>ujian_listening/data',
        "aoColumns":  [
                  { "mData" : "no"},
                  { "mData" : "kode"},
                  { "mData" : "audio"},
                  { "mData" : "gambar"},
                  { "mData" : "pertanyaan"},
                  { "mData" : "pil_a"},
                  { "mData" : "pil_b"},
                  { "mData" : "pil_c"},
                  { "mData" : "pil_d"},
                  { "mData" : "jawaban"},
                  { "mData" : "tipe"},
                  { "mData" : "action"}
                ],
        "columnDefs":   [
                  { className: "text-center", "targets": [0,11] },
                  { width: 30, targets: 0},
                  { width: 50, targets: 11}
                ],
        "fixedColumns": true
      });

      $('#btn-tambah').click(function(){
        //$('#simpan').attr('id', 'simpan_listening');
        $('#form-tambah').attr('action','<?=base_url()?>ujian_listening/tambah');
        $('.modal-title').html('Tambah Data Listening');
        $('#modal-tambah').modal('show');
        $('#pertanyaan').focus();
      });

      $('#simpan').click(function() {
        //mengambil semua inputan data dari form
        var data = new FormData(document.getElementById("form-tambah"));
        $.ajax({
        url: '<?php echo base_url() ?>ujian_listening/tambah',
        type: 'post',
        dataType: 'json',
        data: data,
        async: false,
        processData: false,
        contentType: false,

        success: function(msg) {
          console.log(msg);
          if(msg.status==true && msg.status_image == true){
              tabel.api().ajax.reload();
              swal($('.modal-title').html() + ' Sukses');
              $('#form-tambah')[0].reset();
              $('#modal-tambah').modal('hide');
            }else{
              var pesan = msg.image;
              pesan = pesan.replace(/<p>/g , "");
              pesan = pesan.replace(/<\/p>/g , "");

              
              swal($('.modal-title').html() + ' Gagal' + '\n' + pesan);
            }
        },
        error: function(){
            swal('ERROR : function(response)');
          }
      });
      });
    
      $('#tabel-body').on('click', '#btn-ubah', function(){
          $('.modal-title').html('Ubah Data');
          $('#form-edit').attr('action','<?=base_url()?>ujian_listening/edit');
          $('#id_soal').val($(this).data('id'));
          $('#id_audio').val($(this).data('kode'));
          $('#nama_audio').val($(this).data('audio'));
          $('#audio').val('');
          $('#list_audio').val('xxx');
          $('#nama_gambar').val($(this).data('gambar'));
          $('#pic').val('');
          $('#pertanyaan2').val($(this).data('pertanyaan'));
          $('#pil_a2').val($(this).data('pil_a'));
          $('#pil_b2').val($(this).data('pil_b'));
          $('#pil_c2').val($(this).data('pil_c'));
          $('#pil_d2').val($(this).data('pil_d'));
          $('#jawaban2').val($(this).data('jawaban'));
          $('#tipe2').val($(this).data('id_kategori'));
          $('#modal-edit').modal('show');
          $('#pertanyaan2').focus();
          $('#pertanyaan2').select();
      });

      $('#edit').click(function() {
        //mengambil semua inputan data dari form
        var data = new FormData(document.getElementById("form-edit"));
        $.ajax({
        url: '<?php echo base_url() ?>ujian_listening/edit',
        type: 'post',
        dataType: 'json',
        data: data,
        async: false,
        processData: false,
        contentType: false,

        success: function(msg) {
          console.log(msg);
          if(msg.status==true && msg.status_image == true){
              tabel.api().ajax.reload();
              swal($('.modal-title').html() + ' Sukses');
              $('#modal-edit').modal('toggle');
            }else{
              var pesan = msg.image;
              pesan = pesan.replace(/<p>/g , "");
              pesan = pesan.replace(/<\/p>/g , "");

              
              swal($('.modal-title').html() + ' Gagal' + '\n' + pesan);
            }
        },
        error: function(){
            swal('ERROR : function(response)');
          }
      });
      });

      $('#tabel-body').on('click', '#btn-hapus', function(){
        var id          = $(this).data('id');
        var kode        = $(this).data('kode');
        swal({
          title: "Apakah anda yakin?",
          text: "Untuk menghapus data : " + kode,
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Delete",
          cancelButtonText: "Cancel",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
            $.ajax({
              type:     'ajax',
              method:   'post',
              url:    '<?=base_url()?>'+'ujian_listening/hapus/' + id,
              async:    true,
              dataType:   'json',
              success:  function(response){
                if(response==true){
                  tabel.api().ajax.reload();
                  swal("Deleted!", "Hapus data sukses.", "success");
                }else{
                  swal("ERROR", "Hapus data gagal.", "error");
                }
              },
              error: function(){
                swal("ERROR", "Hapus data gagal.", "error");
              }
            });
          } else {
            swal("Cancelled", "Hapus data dibatalkan.", "error");
          }
        }); 
      });
      });

  </script>
</body>
</html>
