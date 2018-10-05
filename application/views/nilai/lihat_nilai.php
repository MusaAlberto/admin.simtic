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
              <div class="clearfix"></div>
              <div class="x_content">
                <table id="tabel-data" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th colspan="2">Data</th>
                    </tr>
                  </thead>
                  <tbody id="tabel-body">
                    <tr>
                      <td width="25%">
                        <center><img src="<?php echo base_url(). "assets/user_image/" . $hasil->foto  ?>" style="width: 175px; height: 250px;"></center>
                      </td>
                      <td colspan="2"><br>
                        Nama            :<?php echo $hasil->nama_peserta  ?><br><br>
                        NIM             :<?php echo $hasil->nim           ?><br><br>
                        Kelas           :<?php echo $hasil->kelas         ?><br><br>
                        Program Studi   :<?php echo $hasil->nama_prodi    ?><br><br>
                        Jurusan         :<?php echo $hasil->nama_jurusan  ?><br><br>
                        Institusi       :<?php echo $hasil->nama_institusi?><br>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" width="50%"><h2 style="text-align: center;"> SIMULASI</h2></td>
                      <td><h2 style="text-align: center;"> TES ONLINE</h2></td>
                    </tr>
                    <tr>
                      <td colspan="2" width="50%"><h2 style="text-align: center;">0</h2></td>
                      <?php $ujian = $hasil->score_listening  +   $hasil->score_reading?>
                      <td><h2 style="text-align: center;"><?php echo $simulasi?></h2></td>
                    </tr>
                  </tbody>
                </table>
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
