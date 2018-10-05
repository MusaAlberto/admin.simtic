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
					<audio id="video"autoplay controls  style="width: 100%;">
					  <source src="http://simtic.informatikapolines.com/admin/assets/soal_assets/audio/		L00012.wav" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>

					<form method="post" id="form-jawab">
					    <ul class="nav nav-tabs">
						     <li class="nav-item">
						      <a class="nav-link active_tab1" style="border:1px solid #ccc" id="photograph">Photograph</a>
						     </li>
						     <li class="nav-item">
						      <a class="nav-link inactive_tab1" id="questions_response" style="border:1px solid #ccc">Questions Response</a>
						     </li>
						     <li class="nav-item">
						      <a class="nav-link inactive_tab1" id="conversations" style="border:1px solid #ccc">Conversations</a>
						     </li>
						     <li class="nav-item">
						      <a class="nav-link inactive_tab1" id="short_talks" style="border:1px solid #ccc">Short Talks</a>
						     </li>
					    </ul>
					    <div class="tab-content" style="margin-top:16px;">
						    <div class="tab-pane active" id="photograph_details">
							    <div class="panel panel-default">
							        <div class="panel-body">
							        	<?php
							       			$nomor = 0;
							       			foreach ($photograph as $row) {
							       				$nomor++;
							       		?>
								        <div class="col-md-12">
								        	<div class="col-md-1">
								        		<?php echo $nomor;?>
								        	</div>
								        	<div class="col-md-10">
								        		 <img src="<?php echo $row->gambar ?>" alt="#" width="30%" style="margin-left: 10%">
								        		 <h5><?php echo $row->pertanyaan?></h5>
								        		<div class="form-group">
										        	<input type="text" hidden name="id_user" value="<?=$this->session->userdata('id_peserta')?>">
										        	<input type="text" hidden name="id_soal[]" value="<?php echo $row->id_soal?>">
										        </div>
										        <div class="form-group">
										        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="A" checked><?php echo $row->pil_a?>
										        </div>
										        <div class="form-group">
										        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="B"><?php echo $row->pil_b?>
										        </div>
										        <div class="form-group">
										        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="C"><?php echo $row->pil_c?>
										        </div>
										        <div class="form-group">
										        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="D"><?php echo $row->pil_d?>
										        </div>
								        	</div>
								        </div>
								    	<?php }?>
							        <br />
							        <div align="center">
							         	<button type="button" name="btn_photograph_details" id="btn_photograph_details" class="btn btn-info btn-lg">Next</button>
							        </div>
							        <br />
							       </div>
							    </div>
						    </div>
						    <div class="tab-pane fade" id="questions_response_details">
							    <div class="panel panel-default">
								        <div class="panel-body">
								        	<?php
							       			foreach ($questions_response as $row) {
							       				$nomor++;
							       		?>
								        <div class="col-md-12">
								        	<div class="col-md-1">
								        		<?php echo $nomor;?>
								        	</div>
								        	<div class="col-md-10">
								        		 <img src="<?php echo $row->gambar ?>" width="30%" style="margin-left: 10%">
								        		 <h5><?php echo $row->pertanyaan?></h5>
								        		<div class="form-group">
										        	<input type="text" hidden name="id_user" value="<?=$this->session->userdata('id_peserta')?>">
										        	<input type="text" hidden name="id_soal[]" value="<?php echo $row->id_soal?>">
										        </div>
										        <div class="form-group">
										        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="A" checked><?php echo $row->pil_a?>
										        </div>
										        <div class="form-group">
										        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="B"><?php echo $row->pil_b?>
										        </div>
										        <div class="form-group">
										        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="C"><?php echo $row->pil_c?>
										        </div>
										        <div class="form-group">
										        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="D"><?php echo $row->pil_d?>
										        </div>
								        	</div>
								        </div>
								    	<?php }?>
								        <br />
								        <div align="center">
									         <button type="button" name="previous_btn_qr_details" id="previous_btn_qr_details" class="btn btn-default btn-lg">Previous</button>
									         <button type="button" name="btn_qr_details" id="btn_qr_details" class="btn btn-info btn-lg">Next</button>
								        </div>
								        <br />
								        </div>
							    </div>
						    </div>
						    <div class="tab-pane fade" id="conversations_details">
							    <div class="panel panel-default">
								        <div class="panel-body">
								        	<?php
								       			foreach ($conversations as $row) {
								       				$nomor++;
								       		?>
									        <div class="col-md-12">
									        	<div class="col-md-1">
									        		<?php echo $nomor;?>
									        	</div>
									        	<div class="col-md-10">
									        		 <img src="<?php echo $row->gambar ?>" width="30%" style="margin-left: 10%">
									        		 <h5><?php echo $row->pertanyaan?></h5>
									        		<div class="form-group">
											        	<input type="text" hidden name="id_user" value="<?=$this->session->userdata('id_peserta')?>">
										        	<input type="text" hidden name="id_soal[]" value="<?php echo $row->id_soal?>">
											        </div>
											        <div class="form-group">
											        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="A" checked><?php echo $row->pil_a?>
											        </div>
											        <div class="form-group">
											        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="B"><?php echo $row->pil_b?>
											        </div>
											        <div class="form-group">
											        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="C"><?php echo $row->pil_c?>
											        </div>
											        <div class="form-group">
											        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="D"><?php echo $row->pil_d?>
											        </div>
									        	</div>
									        </div>
									    	<?php }?>
									        <br />
									        <div align="center">
										         <button type="button" name="previous_btn_conversations_details" id="previous_btn_conversations_details" class="btn btn-default btn-lg">Previous</button>
										         <button type="button" name="btn_conversations_details" id="btn_conversations_details" class="btn btn-info btn-lg">Next</button>
									        </div>
									        <br />
								        </div>
							    </div>
						    </div>
						    <div class="tab-pane fade" id="short_talk_details">
							    <div class="panel panel-default">
								        <div class="panel-body">
								        	<?php
								       			foreach ($short_talks as $row) {
								       				$nomor++;
								       		?>
									        <div class="col-md-12">
									        	<div class="col-md-1">
									        		<?php echo $nomor;?>
									        	</div>
									        	<div class="col-md-10">
									        		 <img src="<?php echo $row->gambar ?>" width="30%" style="margin-left: 10%">
									        		 <h5><?php echo $row->pertanyaan?></h5>
									        		<div class="form-group">
											        	<input type="text" hidden name="id_user" value="<?=$this->session->userdata('id_peserta')?>">
										        	<input type="text" hidden name="id_soal[]" value="<?php echo $row->id_soal?>">
											        </div>
											        <div class="form-group">
											        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="A" checked><?php echo $row->pil_a?>
											        </div>
											        <div class="form-group">
											        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="B"><?php echo $row->pil_b?>
											        </div>
											        <div class="form-group">
											        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="C"><?php echo $row->pil_c?>
											        </div>
											        <div class="form-group">
											        	<input type="radio" name="pil[<?php echo $row->id_soal?>]" value="D"><?php echo $row->pil_d?>
											        </div>
									        	</div>
									        </div>
									    	<?php }?>
									        <br />
									        <div align="center">
										         <button type="button" name="previous_btn_short_talk_details" id="previous_btn_short_talk_details" class="btn btn-default btn-lg">Previous</button>
										         <button type="button" name="btn_short_talk_details" id="btn_short_talk_details" class="btn btn-success btn-lg">Submit</button>
									        </div>
									        <br />
								        </div>
							    </div>
						    </div>
					    </div>
				   </form>
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
	<script>
		$(document).ready(function(){
		 
			$('#btn_photograph').click(function(){
			   $('#photograph').removeClass('active active_tab1');
			   $('#photograph').removeAttr('href data-toggle');
			   $('#list_photograph').removeClass('active');
			   $('#photograph').addClass('inactive_tab1');
			   $('#questions_response').removeClass('inactive_tab1');
			   $('#questions_response').addClass('active_tab1 active');
			   $('#questions_response').attr('href', '#list_questions_response');
			   $('#questions_response').attr('data-toggle', 'tab');
			   $('#list_questions_response').addClass('active in');  
			});
		 
			$('#previous_part_2').click(function(){
			  $('#questions_response').removeClass('active active_tab1');
			  $('#questions_response').removeAttr('href data-toggle');
			  $('#list_questions_response').removeClass('active in');
			  $('#questions_response').addClass('inactive_tab1');
			  $('#photograph').removeClass('inactive_tab1');
			  $('#photograph').addClass('active_tab1 active');
			  $('#photograph').attr('href', '#list_photograph');
			  $('#photograph').attr('data-toggle', 'tab');
			  $('#list_photograph').addClass('active in');
			});
		 
			$('#part_2').click(function(){
			   $('#questions_response').removeClass('active active_tab1');
			   $('#questions_response').removeAttr('href data-toggle');
			   $('#list_questions_response').removeClass('active');
			   $('#questions_response').addClass('inactive_tab1');
			   $('#conversations').removeClass('inactive_tab1');
			   $('#conversations').addClass('active_tab1 active');
			   $('#conversations').attr('href', '#list_conversations');
			   $('#conversations').attr('data-toggle', 'tab');
			   $('#list_conversations').addClass('active in');
			});
		 
			$('#previous_part_4').click(function(){
			  $('#short_talks').removeClass('active active_tab1');
			  $('#short_talks').removeAttr('href data-toggle');
			  $('#list_conversations').removeClass('active in');
			  $('#short_talks').addClass('inactive_tab1');
			  $('#conversations').removeClass('inactive_tab1');
			  $('#conversations').addClass('active_tab1 active');
			  $('#conversations').attr('href', '#list_conversations');
			  $('#conversations').attr('data-toggle', 'tab');
			  $('#list_conversations').addClass('active in');
			});
		 
		    $('#btn_contact_details').click(function(){
			   $('#btn_contact_details').attr("disabled", "disabled");
			   $(document).css('cursor', 'prgress');
			   $("#register_form").submit();
			});
	</script>
	<script>
$(document).ready(function(){
 
 $('#btn_photograph_details').click(function(){
   $('#photograph').removeClass('active active_tab1');
   $('#photograph').removeAttr('href data-toggle');
   $('#photograph_details').removeClass('active');
   $('#photograph').addClass('inactive_tab1');
   $('#questions_response').removeClass('inactive_tab1');
   $('#questions_response').addClass('active_tab1 active');
   $('#questions_response').attr('href', '#questions_response_details');
   $('#questions_response').attr('data-toggle', 'tab');
   $('#questions_response_details').addClass('active in');  
 });
 
 $('#previous_btn_qr_details').click(function(){
  $('#questions_response').removeClass('active active_tab1');
  $('#questions_response').removeAttr('href data-toggle');
  $('#questions_response_details').removeClass('active in');
  $('#questions_response').addClass('inactive_tab1');
  $('#photograph').removeClass('inactive_tab1');
  $('#photograph').addClass('active_tab1 active');
  $('#photograph').attr('href', '#photograph_details');
  $('#photograph').attr('data-toggle', 'tab');
  $('#photograph_details').addClass('active in');
 });
 
 $('#btn_qr_details').click(function(){
   $('#questions_response').removeClass('active active_tab1');
   $('#questions_response').removeAttr('href data-toggle');
   $('#questions_response_details').removeClass('active');
   $('#questions_response').addClass('inactive_tab1');
   $('#conversations').removeClass('inactive_tab1');
   $('#conversations').addClass('active_tab1 active');
   $('#conversations').attr('href', '#conversations_details');
   $('#conversations').attr('data-toggle', 'tab');
   $('#conversations_details').addClass('active in');
 });
 
 $('#previous_btn_conversations_details').click(function(){
  $('#conversations').removeClass('active active_tab1');
  $('#conversations').removeAttr('href data-toggle');
  $('#conversations_details').removeClass('active in');
  $('#conversations').addClass('inactive_tab1');
  $('#questions_response').removeClass('inactive_tab1');
  $('#questions_response').addClass('active_tab1 active');
  $('#questions_response').attr('href', '#questions_response_details');
  $('#questions_response').attr('data-toggle', 'tab');
  $('#questions_response_details').addClass('active in');
 });

 $('#btn_conversations_details').click(function(){
   $('#conversations').removeClass('active active_tab1');
   $('#conversations').removeAttr('href data-toggle');
   $('#conversations_details').removeClass('active');
   $('#conversations').addClass('inactive_tab1');
   $('#short_talks').removeClass('inactive_tab1');
   $('#short_talks').addClass('active_tab1 active');
   $('#short_talks').attr('href', '#short_talk_details');
   $('#short_talks').attr('data-toggle', 'tab');
   $('#short_talk_details').addClass('active in');
 });
 
 $('#btn_short_talk_details').click(function(){
   $('#btn_short_talk_details').attr("disabled", "disabled");
   $('#form-jawab').attr('action','<?=base_url()?>listening/ans_temp_list');
   $(document).css('cursor', 'prgress');
   $("#form-jawab").submit();
  
 });

 $('#previous_btn_short_talk_details').click(function(){
  $('#short_talks').removeClass('active active_tab1');
  $('#short_talks').removeAttr('href data-toggle');
  $('#short_talk_details').removeClass('active in');
  $('#short_talks').addClass('inactive_tab1');
  $('#conversations').removeClass('inactive_tab1');
  $('#conversations').addClass('active_tab1 active');
  $('#conversations').attr('href', '#conversations_details');
  $('#conversations').attr('data-toggle', 'tab');
  $('#conversations_details').addClass('active in');
 });
 
});
</script>

<script type="text/javascript">
		var video = document.getElementById('video');
		var supposedCurrentTime = 0;
		video.addEventListener('timeupdate', function() {
		  if (!video.seeking) {
		        supposedCurrentTime = video.currentTime;
		  }
		});
		// prevent user from seeking
		video.addEventListener('seeking', function() {
		  // guard agains infinite recursion:
		  // user seeks, seeking is fired, currentTime is modified, seeking is fired, current time is modified, ....
		  var delta = video.currentTime - supposedCurrentTime;
		  if (Math.abs(delta) > 0.01) {
		    console.log("Seeking is disabled");
		    video.currentTime = supposedCurrentTime;
		  }
		});
		// delete the following event handler if rewind is not required
		video.addEventListener('ended', function() {
		  // reset state in order to allow for rewind
		    supposedCurrentTime = 0;
		});
	</script>

</body>
</html>
