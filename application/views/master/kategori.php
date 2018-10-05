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
                  <a href="<?=base_url()?>kategori">
                    Data Kategori
                  </a>
                </h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li>
                    <button type="button" id="btn-tambah" class="btn btn-primary">Tambah</button>
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
                      <th>Nama Kategori</th>
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
              <form id="form-tambah" data-parsley-validate method="POST" action="">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">×</button>
                      <h4 class="modal-title">Tambah Data</h4>
                    </div>
                    <div class="modal-body">
                      <div class="form-horizontal">
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Kode Kategori</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="id" name="id" type="hidden">
                            <input id="kode" name="kode" class="required form-control input-xs" placeholder="Kode Kategori" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama Kategori</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="nama" name="nama" class="required form-control input-xs" placeholder="Nama Kategori" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Jenis</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control" id="jenis" name="jenis">
                            <option value="">Choose option</option>
                            <option value="Listening">Listening</option>
                            <option value="Reading">Reading</option>
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
            <!-- Tampilan "model-tambah" -->
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
        "sAjaxSource":  '<?php echo base_url(); ?>kategori/data',
        "aoColumns":  [
                  { "mData" : "no"},
                  { "mData" : "kode"},
                  { "mData" : "nama"},
                  { "mData" : "action"}
                ],
        "columnDefs":   [
                  { className: "text-center", "targets": [0,3] },
                  { width: 30, targets: 0},
                  { width: 100, targets: 3}
                ],
        "fixedColumns": true
      });

      $('#btn-tambah').click(function(){
        $('#form-tambah').attr('action','<?=base_url()?>kategori/tambah');
        $('.modal-title').html('Tambah data');
        $('#modal-tambah').modal('show');
        $('#nama').focus();
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
        $('#form-tambah').attr('action','<?=base_url()?>kategori/edit');
        $('#id').val($(this).data('id'));
        $('#kode').val($(this).data('kode'));
        $('#nama').val($(this).data('nama'));
        $('#jenis').val($(this).data('jenis'));
        $('#modal-tambah').modal('show');
        $('#nama').focus();
        $('#nama').select();
      });

      $('#tabel-body').on('click', '#btn-hapus', function(){
        var id      = $(this).data('id');
        var kode    = $(this).data('kode');
        var nama    = $(this).data('nama');
        swal({
          title: "Apakah anda yakin?",
          text: "Untuk menghapus data : " + kode + " - " + nama,
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
              url:    '<?=base_url()?>'+'kategori/hapus/' + id,
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
