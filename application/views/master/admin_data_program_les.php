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
									<a href="<?=base_url()?>program_les">
										Data Program Les
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
											<th>No</th>\
											<th>Kode Program</th>
											<th>Nama Program Les</th>
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
						                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Kode Program</label>
						                          <div class="col-md-8 col-sm-8 col-xs-12">
						                            <input id="id" name="id" type="hidden">
						                            <input id="kode" name="kode" class="required form-control input-xs" placeholder="Nama" type="text" required="required">
						                          </div>
						                        </div>
												<div class="form-group">
						                          <label class="col-md-4 col-sm-4 col-xs-12 control-label">Nama Program Les</label>
						                          <div class="col-md-8 col-sm-8 col-xs-12">
						                            <input id="program_les" name="program_les" class="required form-control input-xs" placeholder="Nama Program Les" type="text" required="required">
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
				"bProcessing": 	true,
				"bAutoWidth": 	true,
				"bSort": 		false,
				"sAjaxSource": 	'<?php echo base_url(); ?>program_les/data',
				"aoColumns":	[
									{ "mData"	: "no"},
									{ "mData"	: "kode"},
									{ "mData"	: "program_les"},
									{ "mData"	: "action"}
								],
				"columnDefs": 	[
									{ className: "text-center", "targets": [0,3] },
									{ width: 30, targets: 0},
									{ width: 75, targets: 3}
								],
				"fixedColumns": true
			});

			$('#btn-tambah').click(function(){
				$('#form-tambah').attr('action','<?=base_url()?>program_les/tambah');
				$('.modal-title').html('Tambah data');
				$('#modal-tambah').modal('show');
				$('#email').focus();
			});

			$('#simpan').click(function() {
				$('#form-tambah').ajaxForm({
					success: 	function(response){
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
				$('#form-tambah').attr('action','<?=base_url()?>program_les/edit');
				$('#id').val($(this).data('id'));
				$('#kode').val($(this).data('kode'));
				$('#program_les').val($(this).data('program_les'));
				$('#modal-tambah').modal('show');
				$('#kode').focus();
				$('#kode').select();
			});

			$('#tabel-body').on('click', '#btn-hapus', function(){
				var id 		= $(this).data('id');
				var nama 	= $(this).data('program_les');
				swal({
					title: "Apakah anda yakin?",
					text: "Untuk menghapus data : " + nama,
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
							type: 		'ajax',
							method: 	'post',
							url: 		'<?=base_url()?>'+'program_les/hapus/' + id,
							async: 		true,
							dataType: 	'json',
							success: 	function(response){
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
