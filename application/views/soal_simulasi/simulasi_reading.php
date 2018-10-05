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
                  <a href="<?=base_url()?>simulasi_reading">
                    Data Soal Simulasi Reading
                  </a>
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li id="btn-reading-container">
                    <button type="button" id="btn-tambah" class="btn btn-primary">Tambah Soal Reading</button>
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
                      <h4 class="modal-title">Tambah Soal Reading</h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Gambar</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="file" name="foto" accept="image/*" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Pertanyaan</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="id" name="id" type="hidden">
                            <input id="kode" name="kode" type="hidden">
                            <input type="hidden" id="nama_gambar" name="nama_gambar">
                            <input id="pertanyaan" name="pertanyaan" class="required form-control input-xs" placeholder="Pertanyaan" type="text">
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
                                  echo '<option value="'.$list->kode_kategori.'">'.$list->nama_kategori.'</option>';
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
        "sAjaxSource":  '<?php echo base_url(); ?>simulasi_reading/data',
        "aoColumns":  [
                  { "mData" : "no"},
                  { "mData" : "kode"},
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
                  { className: "text-center", "targets": [0,10] },
                  { width: 30, targets: 0},
                  { width: 50, targets: 10}
                ],
        "fixedColumns": true
      });

      $('#btn-tambah').click(function(){
        $('#form-tambah').attr('action','<?=base_url()?>simulasi_reading/tambah');
        $('.modal-title').html('Tambah data');
        $('#modal-tambah').modal('show');
        $('#pertanyaan').focus();
      });

      $('#simpan').click(function() {
        $('#form-tambah').ajaxForm({
          success:  function(response){
            if(response=='true'){
              tabel.api().ajax.reload();
              swal($('.modal-title').html() + ' Sukses');
              $('#form-tambah')[0].reset();
              $('#modal-tambah').modal('hide');
            }else{
              swal($('.modal-title').html() + ' Gagal');
            }
          },
          error: function(){
            swal('ERROR : function(response)');
          }
        }).submit();
      });
    
      $('#tabel-body').on('click', '#btn-ubah', function(){
        $('.modal-title').html('Ubah Data');
        $('#form-tambah').attr('action','<?=base_url()?>simulasi_reading/edit');
        $('#id').val($(this).data('id'));
        $('#kode').val($(this).data('kode'));
        $('#nama_gambar').val($(this).data('gambar'));
        $('#pertanyaan').val($(this).data('pertanyaan'));
        $('#pil_a').val($(this).data('pil_a'));
        $('#pil_b').val($(this).data('pil_b'));
        $('#pil_c').val($(this).data('pil_c'));
        $('#pil_d').val($(this).data('pil_d'));
        $('#jawaban').val($(this).data('jawaban'));
        $('#tipe').val($(this).data('id_kategori'));
        $('#modal-tambah').modal('show');
        $('#pertanyaan').focus();
        $('#pertanyaan').select();
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
              url:      '<?=base_url()?>'+'simulasi_reading/hapus/' + id,
              async:    true,
              dataType: 'json',
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
