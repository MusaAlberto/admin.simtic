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
                <h2>Profile</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />
                <form id="form-edit" name="form-edit" action="<?php base_url('user/update');?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="id" name="id" value="<?php echo $profile->id_dosen; ?>" type="hidden">
                      <input type="text" id="nama" name="nama" value="<?php echo $profile->nama_dosen; ?>" required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">NIP</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="nip" name="nip" required="required" value="<?php echo $profile->nip; ?>" class="form-control col-md-7 col-xs-12">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="alamat" name="alamat" value="<?php echo $profile->alamat; ?>"  class="form-control col-md-7 col-xs-12" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">No. Telepon</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="no_telp" name="no_telp" value="<?php echo $profile->no_hp; ?>" class="form-control col-md-7 col-xs-12" type="text">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="email" name="email" value="<?php echo $profile->email; ?>" class="form-control col-md-7 col-xs-12" type="email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Password </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="password" name="password" value="<?php echo $profile->password; ?>" class="form-control col-md-7 col-xs-12" type="password">
                    </div>
                  </div>
                  <div class="ln_solid"></div>
                  <div class="pull-right">
                  </div>
                </form>
                <button type="submit" id="simpan" value="Update" class="btn btn-success">Simpan</button>
              </div>
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

</body>
</html>

<script>
  $('#simpan').click(function() {
    //mengambil semua inputan data dari form
    var data = new FormData(document.getElementById("form-edit"));
    $.ajax({
      url: '<?php echo base_url() ?>user/update',
      type: 'post',
      dataType: 'json',
      data: data,
      async: false,
      processData: false,
      contentType: false,

      success: function(msg) {
        console.log(msg);
        if(msg == true){
          swal('Ubah Profile Sukses');
        }else{
          swal('Ubah Profile Gagal');
        }
      },
      error: function(){
        swal('ERROR : function(response)');
      }
    });
  });
  
</script>