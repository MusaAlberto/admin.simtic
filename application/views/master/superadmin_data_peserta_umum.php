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
                  <a href="<?=base_url()?>peserta_umum">
                    Data Peserta Umum
                  </a>
                </h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="tabel-data" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode</th>
                      <th>Nama</th>
                      <th>No. Telepon</th>
                      <th>Alamat</th>
                      <th>Nama Institusi</th>
                      <th>Email</th>
                      <th>Foto</th>
                    </tr>
                  </thead>
                  <tbody id="tabel-body">
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

  <script>
    $(document).ready(function(){
      var tabel = $('#tabel-data').dataTable({
        "bProcessing":  true,
        "bAutoWidth":   true,
        "bSort":    false,
        "sAjaxSource":  '<?php echo base_url(); ?>peserta_umum/data',
        "aoColumns":  [
                  { "mData" : "no"},
                  { "mData" : "kode"},
                  { "mData" : "nama"},
                  { "mData" : "no_telp"},
                  { "mData" : "alamat"},
                  { "mData" : "institusi"},
                  { "mData" : "email"},
                  { "mData" : "foto"}
                ],
        "columnDefs":   [
                  { className: "text-center", "targets": [0,7] },
                  { width: 30, targets: 0},
                  { width: 150, targets: 7}
                ],
        "fixedColumns": true
      });
    });
  </script>
</body>
</html>
