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
                  <a href="<?=base_url()?>mahasiswa">
                    Data Mahasiswa
                  </a>
                </h2>
                <ul class="nav navbar-right panel_toolbox">
			            <li>
						          <button type="button" id="btn-tambah" class="btn btn-primary">Tambah</button>
					        </li>
					        <li>
						        <a class="collapse-link">
							         <i class="fa fa-chevron-up"></i>
						        </a>
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
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>NIM</th>
                      <th>Program Studi</th>
                      <th>Jurusan</th>
                      <th>No. Telepon</th>
                      <th>Foto</th>
                      <th>Email</th>
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
							<form id="form-tambah" data-parsley-validate method="POST" action="" enctype="multipart/form-data">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">×</button>
											<h4 class="modal-title">Tambah Data</h4>
										</div>
										<div class="modal-body">
											<div class="form-horizontal">
												<div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="id" name="id" type="hidden">
                            <input id="kode" name="kode" type="hidden">
                            <input type="hidden" id="nama_gambar" name="nama_gambar">
                            <input id="nama" name="nama" class="required form-control input-xs" placeholder="Nama" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">NIM</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="nim" name="nim" class="required form-control input-xs" placeholder="NIM" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Kelas</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="kelas" name="kelas" class="required form-control input-xs" placeholder="Kelas" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Jurusan</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <select  class="form-control" id="jurusan" name="jurusan">
                            <option value="">Pilih Jurusan</option>
                            <?php
                                foreach ($jurusan as $list) {
                                  echo '<option value="'.$list->id_jurusan.'">'.$list->nama.'</option>';
                                }

                              ?>
                          </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Program Studi</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <select  class="form-control" id="prodi" name="prodi">
                            <option value="">Pilih Program Studi</option>

                          </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Alamat</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="alamat" name="alamat" class="required form-control input-xs" placeholder="Alamat" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Nomor Telepon</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="no_telp" name="no_telp" class="required form-control input-xs" placeholder="Nomor Telepon" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Email</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input id="email" name="email" class="required form-control input-xs" placeholder="Email" type="text" required="required">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Foto</label>
                          <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="file" id="foto" name="foto" accept="image/*" required="required"">
                          </div>
                        </div>
												<div class="form-group">
													<label class="col-md-4 col-sm-4 col-xs-12 control-label">Password</label>
													<div class="col-md-8 col-sm-8 col-xs-12">
														<input id="password" name="password" class="required form-control input-xs" placeholder="Password" type="password" required="required">
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
        "sAjaxSource":  '<?php echo base_url(); ?>mahasiswa/data',
        "aoColumns":  [
                  { "mData" : "no"},
                  { "mData" : "kode"},
                  { "mData" : "nama"},
                  { "mData" : "kelas"},
                  { "mData" : "nim"},
                  { "mData" : "prodi"},
                  { "mData" : "jurusan"},
                  { "mData" : "no_telp"},
                  { "mData" : "foto"},
                  { "mData" : "email"},
                  { "mData" : "action"}
                ],
        "columnDefs":   [
                  { className: "text-center", "targets": [0,10] },
                  { width: 25, targets: 0},
                  { width: 150, targets: 10}
                ],
        "fixedColumns": true
      });

      $('#btn-tambah').click(function(){
        $('#form-tambah').attr('action','<?=base_url()?>mahasiswa/tambah');
        $('.modal-title').html('Tambah data');
        $('#modal-tambah').modal('show');
        $('#email').focus();
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
        $('#form-tambah').attr('action','<?=base_url()?>mahasiswa/edit');
        $('#id').val($(this).data('id'));
        $('#kode').val($(this).data('kode'));
        $('#nama').val($(this).data('nama'));
        $('#kelas').val($(this).data('kelas'));
        $('#nim').val($(this).data('nim'));
        $('#jurusan').val($(this).data('id_jurusan'));
        getProdi($(this).data('id_jurusan'));
        $('#prodi').val($(this).data('id_prodi'));
        $('#alamat').val($(this).data('alamat'));
        $('#no_telp').val($(this).data('no_telp'));
        $('#nama_gambar').val($(this).data('gambar'));
        $('#email').val($(this).data('email'));
        $('#password').val($(this).data('password'));
        $('#modal-tambah').modal('show');
        $('#email').focus();
        $('#email').select();
      });

      $('#tabel-body').on('click', '#btn-hapus', function(){
        var id    = $(this).data('id');
        var kode  = $(this).data('kode');
        var nama  = $(this).data('nama');
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
              url:    '<?=base_url()?>'+'mahasiswa/hapus/' + id,
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

  <script>
  $("#jurusan").change(function(){
      if ($(this).val() != '') {

       getProdi($(this).val());
      }
    })

  function getProdi(filter){
    $('#prodi').empty();
     $.ajax({
            type: "GET",
            url: "<?php echo base_url(); ?>mahasiswa/getProdi/" + filter,
            success: function(data){
            var data = $.parseJSON(data);
              console.log(data);
            $.each(data, function(key, val){
              $('#prodi').append('<option value="'+val.id_prodi+'">' + val.nama + '</option>');
            });
        },
         error: function(){
          console.log('error');
         }
      });
    }  

  </script>
</body>
</html>
