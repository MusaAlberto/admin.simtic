<!DOCTYPE html>
<html>
<?php include(__DIR__ . "/tittle.php"); ?>
<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <?php include(__DIR__ . "/sidebar.php"); ?>
      <?php include(__DIR__ . "/top_nav.php"); ?>

      <!-- page content -->
    <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top" style="text-align: center;"><h2><i class="fa fa-user"></i> Total Mahasiswa</h2></span>
              <div class="count" style="text-align: center;">2500</div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top" style="text-align: center;"><h2><i class="fa fa-user"></i> Total Peserta</h2></span>
              <?php
                $query = "SELECT COUNT(kode_mahasiswa) AS jumlah FROM tabel_mahasiswa WHERE status_mhs = 'A' ";
                $value2[] = $this->db->query($query)->row();
              ?>
              <div class="count" style="text-align: center;">
              <?php foreach ($value2 as $row) {
                      echo $row->jumlah;
                    } ?>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top" style="text-align: center;"><h2><i class="fa fa-user"></i> Total Selesai Ujian</h2></span>
              <div class="count green" style="text-align: center;">2,315</div>
            </div>
          </div>
          <!-- /top tiles -->


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

  <?php include(__DIR__ . "/load_js.php"); ?>

    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
    <!-- /calendar modal -->
        
    <!-- FullCalendar -->
    <script src="<?=base_url()?>assets/vendors/moment/min/moment.min.js"></script>
    <script src="<?=base_url()?>assets/vendors/fullcalendar/dist/fullcalendar.min.js"></script>
    
    <!-- Chart.js -->
    <script src="<?=base_url()?>assets/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?=base_url()?>assets/vendors/moment/min/moment.min.js"></script>
    <script src="<?=base_url()?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

</body>
</html>
