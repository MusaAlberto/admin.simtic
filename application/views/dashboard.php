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
              <span class="count_top" style="text-align: center;"><h2><i class="fa fa-user"></i> Total Peserta</h2></span>
              <?php
                $query = "SELECT COUNT(kode_peserta) AS jumlah FROM tabel_peserta WHERE status_peserta = 'A' ";
                $value1[] = $this->db->query($query)->row();
              ?>
              <div class="count" style="text-align: center;">
                <?php foreach ($value1 as $row) {
                      echo $row->jumlah;
                    } ?>
              </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 tile_stats_count">
              <span class="count_top" style="text-align: center;"><h2><i class="fa fa-user"></i> Total Pendaftar Tes</h2></span>
              <?php
                $query = "SELECT COUNT(id_reg_tes) AS jumlah FROM tabel_reg_tes WHERE status = 'A' ";
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
              <?php
                $query = "SELECT COUNT(kode_auth) AS jumlah FROM tabel_hasil WHERE jenis_tes = 'ujian' ";
                $value3[] = $this->db->query($query)->row();
              ?>
              <div class="count green" style="text-align: center;">
                <?php foreach ($value3 as $row) {
                      echo $row->jumlah;
                    } ?>
              </div>
            </div>
        </div>
        <!-- /top tiles -->

        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Statistik</h2>
                <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Settings 1</a>
                      </li>
                      <li><a href="#">Settings 2</a>
                      </li>
                    </ul>
                  </li>
                  <li><a class="close-link"><i class="fa fa-close"></i></a>
                  </li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                <canvas id="lineChart" width="484" height="242" style="width: 484px; height: 242px;"></canvas>
              </div>
            </div>
          </div>
          
          <!-- Calendar -->
          <div class="col-md-6 column">
            <div id='<?php echo $calendar; ?>'></div>
          </div>
        </div>
      </div>
			<!-- /page content -->

			<!-- footer content -->
			<footer>
				<div class="pull-right">
				Bimbingan Belajar ANTOLOGI Semarang
				</div>
				<div class="clearfix"></div>
			</footer>
			<!-- /footer content -->

		  </div>
	  </div>
  </div>

	<?php include(__DIR__ . "/load_js.php"); ?>

  <!-- Modal Calender -->

  <!-- Modal Add Event -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Add Calendar Event</h4>
        </div>
        <div class="modal-body">

        <!-- Modal Form -->
        <?php echo form_open(base_url("dashboard/add_event"), array("class" => "form-horizontal")) ?>
          <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading">Nama Event</label>
            <div class="col-md-8 ui-front">
             <input type="text" class="form-control" name="name_add" value="">
            </div>
          </div>
          <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading">Tempat</label>
            <div class="col-md-8 ui-front">
              <input type="text" class="form-control" name="description_add">
            </div>
          </div>
          <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading">Kuota</label>
            <div class="col-md-8 ui-front">
              <input type="text" class="form-control" name="kuota_add">
            </div>
          </div>
          <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading">Event Date</label>
            <div class="col-md-8 ui-front">
               
              <fieldset>
                <div class="control-group">
                  <div class="controls">
                    <div class="input-prepend input-group">
                      <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                      <input type="text" style="width: 200px" name="daterange_add" id="daterange_add" class="form-control" value="04/01/2018 - 04/02/2018" />
                    </div>
                  </div>
                </div>
              </fieldset>

            </div>
          </div>

          <input type="hidden" name="start_date_add" id="start_date_add" value="">
          <input type="hidden" name="end_date_add" id="end_date_add" value="">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Add Event">
          <?php echo form_close() ?>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Add Event -->

  <!-- Modal Edit Event -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel_edit">Update Calendar Event</h4>
        </div>
        <div class="modal-body">

          <!-- Modal Form -->
          <?php echo form_open(base_url("dashboard/edit_event"), array("class" => "form-horizontal")) ?>
          <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading">Nama Event</label>
            <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="name_edit" value="" id="name_edit">
            </div>
          </div>
          <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading">Tempat</label>
            <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="description_edit" id="description_edit">
            </div>
          </div>
          <div class="form-group">
            <label for="p-in" class="col-md-4 label-heading">Kuota</label>
            <div class="col-md-8 ui-front">
                <input type="text" class="form-control" name="kuota_edit" id="kuota_edit">
            </div>
          </div>
          <div class="form-group" id="event_date">
            <label for="p-in" class="col-md-4 label-heading">Event Date</label>
            <div class="col-md-8 ui-front">
               
              <fieldset>
                <div class="control-group">
                  <div class="controls">
                    <div class="input-prepend input-group">
                      <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                      <input type="text"  style="width: 200px" name="daterange_edit" id="daterange_edit" class="form-control" value="" />
                    </div>
                  </div>
                </div>
              </fieldset>

            </div>
          </div>

            <input type="hidden" name="start_date_edit" id="start_date_edit" value="">
            <input type="hidden" name="end_date_edit" id="end_date_edit" value="">

          <div class="form-group" id="delete_event">
            <label for="p-in" class="col-md-4 label-heading">Delete Event</label>
            <div class="col-md-8">
                <input type="checkbox" id="delete" name="delete" value="1">
            </div>
          </div>
              <input type="hidden" name="eventid" id="event_id" value="0" />
          <!-- End Modal Form -->                  
        </div>
        <div class="modal-footer" id="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Update Event">
          <?php echo form_close() ?>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Edit Event -->
	
      
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
