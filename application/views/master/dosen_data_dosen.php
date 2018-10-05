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
									<a href="<?=base_url()?>dashboard">
										<i class="fa fa-home"></i>
									</a>
									<a href="<?=base_url()?>dosen">
										Data Dosen
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
											<th>NIP</th>
											<th>Nama</th>
											<th>Alamat</th>
											<th>No. Telepon</th>
											<th>Email</th>
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
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>dosen/data',
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "kode"},
									{ "mData"	: "nip"},
									{ "mData"	: "nama"},
									{ "mData"	: "alamat"},
									{ "mData"	: "no_hp"},
									{ "mData"	: "email"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0] },
									{ width: 30, targets: 0}
								],
				"fixedColumns": true
			});

		});
	</script>
</body>
</html>
