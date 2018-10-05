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
        <div class="">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Pengawasan</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <table id="" class="table table-striped table-bordered dt-responsive nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Ruang</th>
                      <th>Jumlah Peserta</th>
                      <th>Waktu</th>
                      <th>Keterangan</th>
                      <th style="text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Lab 1</td>
                      <td>20</td>
                      <td>09.00-11.00</td>
                      <td></td>
                      <td>
                        <center><a href="<?=base_url()?>pengawasan/lab1"><button type="button" class="btn btn-info btn-sm" style="width: 75%;">Lihat</button></a></center>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
      <div class="pull-right">
        SIMTIC Politeknik Negeri Semarang
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
  </div>
</div>

<?php include(__DIR__ . "/../load_js.php"); ?>
</body>
</html>
