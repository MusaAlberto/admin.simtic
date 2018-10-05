<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Bimbingan Belajar ANTOLOGI - </title>
	<link href="<?=base_url()?>assets/images/icon.png" rel="shortcut icon" >

	<!-- jQuery -->
	<script src="<?=base_url()?>assets/vendors/jquery/dist/jquery.min.js"></script>
	<script src="<?=base_url()?>assets/vendors/moment/min/moment.min.js"></script>
 	<script src="<?=base_url()?>assets/vendors/fullcalendar/dist/fullcalendar.min.js"></script>
  	<script src="<?=base_url()?>assets/vendors/fullcalendar/dist/gcal.js"></script>
  
  
  	<!-- bootstrap-daterangepicker -->
  	<script src="<?=base_url()?>assets/vendors/moment/min/moment.min.js"></script>
  	<script src="<?=base_url()?>assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="<?=base_url()?>assets/vendors/jquery/dist/jquery.form.js"></script>
	
	<!-- Bootstrap -->
	<link href="<?=base_url()?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="<?=base_url()?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="<?=base_url()?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="<?=base_url()?>assets/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- bootstrap-progressbar -->
	<link href="<?=base_url()?>assets/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

	<!-- DateJS -->
	<script src="<?=base_url()?>assets/vendors/DateJS/build/date.js"></script>

	<!-- Bootstrap Colorpicker -->
	<link href="<?=base_url()?>assets/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

	<link href="<?=base_url()?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="<?=base_url()?>assets/build/css/custom.min.css" rel="stylesheet">
	<link href="<?=base_url()?>assets/vendors/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
	<!-- Chart.js -->
  	<script src="<?=base_url()?>assets/vendors/Chart.js/dist/Chart.min.js"></script>

	<link href="<?=base_url()?>assets/vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">

    

	<script language='JavaScript'>
		var txt="ANTOLOGI - Admin ";
		var speed=300;
		var refresh=null;
		function action() { document.title=txt;
		txt=txt.substring(1,txt.length)+txt.charAt(0);
		refresh=setTimeout("action()",speed);}action();
	</script>
	<script type="text/javascript">
	    $(document).ready(function() {

	        $('#daterange_add').on('apply.daterangepicker', function(ev, picker) {
	            $('#start_date_add').val(picker.startDate.format('YYYY/MM/DD HH:mm'));
	            $('#end_date_add').val(picker.endDate.format('YYYY/MM/DD HH:mm'));
	            console.log(picker.startDate.format('YYYY/MM/DD HH:mm'));
	            console.log(picker.endDate.format('YYYY/MM/DD HH:mm'));
	        });

	        $('#daterange_edit').on('apply.daterangepicker', function(ev, picker) {
	            $('#start_date_edit').val(picker.startDate.format('YYYY/MM/DD HH:mm'));
	            $('#end_date_edit').val(picker.endDate.format('YYYY/MM/DD HH:mm'));
	            console.log(picker.startDate.format('YYYY/MM/DD HH:mm'));
	            console.log(picker.endDate.format('YYYY/MM/DD HH:mm'));
	        });

	        var date_last_clicked = null;

	        $('#calendar').fullCalendar({
	            eventSources: [
	               {
	               events: function(start, end, timezone, callback) {
	                console.log(moment(start).format('DD/MM/YYYY') + " - " + moment(end).format('DD/MM/YYYY'));
	                    $.ajax({
	                        url: '<?php echo base_url() ?>dashboard/get_events',
	                        dataType: 'json',
	                        data: {
	                            // our hypothetical feed requires UNIX timestamps
	                            start: start.unix(),
	                            end: end.unix()
	                        },
	                        success: function(msg) {
	                            console.log(msg.events);
	                            var events = msg.events;
	                            callback(events);
	                        }
	                    });
	                  }
	                },
	            ],
	            dayClick: function(date, jsEvent, view) {
	                date_last_clicked = $(this);
	                $(this).css('background-color', '#bed7f3');
	                $('input[name="daterange_add"]').daterangepicker({
	                  startDate: moment(date).format('MM/DD/YYYY'),
	                  endDate: moment(date).format('MM/DD/YYYY')
	                });
	                //$('#daterange_add').val(moment(date).format('MM/DD/YYYY') + ' - ' + moment(date).format('MM/DD/YYYY'));
	                $('#addModal').modal();
	            },
	           eventClick: function(event, jsEvent, view) {
	              $('#name_edit').val(event.title);
	              $('#description_edit').val(event.description);
	              $('#kuota_edit').val(event.kuota);
	              $('input[name="daterange_edit"]').daterangepicker({
	                  startDate: moment(event.start).format('MM/DD/YYYY'),
	                  endDate: moment(event.end).format('MM/DD/YYYY')
	              });
	              //$('#daterange_edit').val(moment(event.start).format('MM/DD/YYYY') + ' - ' + moment(event.end).format('MM/DD/YYYY'));
	              $('#start_date_edit').val(moment(event.start).format('YYYY/MM/DD HH:mm'));
	              if(event.end) {
	                $('#end_date_edit').val(moment(event.end).format('YYYY/MM/DD HH:mm'));
	              } else {
	                $('#end_date_edit').val(moment(event.start).format('YYYY/MM/DD HH:mm'));
	              }
	              $('#event_id').val(event.id);
	              $('#editModal').modal();
	           },
	        });
	    });
  	</script>
  	<script type="text/javascript">
    	$(document).ready(function() {

        $('#daterange_add').on('apply.daterangepicker', function(ev, picker) {
            $('#start_date_add').val(picker.startDate.format('YYYY/MM/DD HH:mm'));
            $('#end_date_add').val(picker.endDate.format('YYYY/MM/DD HH:mm'));
            console.log(picker.startDate.format('YYYY/MM/DD HH:mm'));
            console.log(picker.endDate.format('YYYY/MM/DD HH:mm'));
        });

        $('#daterange_edit').on('apply.daterangepicker', function(ev, picker) {
            $('#start_date_edit').val(picker.startDate.format('YYYY/MM/DD HH:mm'));
            $('#end_date_edit').val(picker.endDate.format('YYYY/MM/DD HH:mm'));
            console.log(picker.startDate.format('YYYY/MM/DD HH:mm'));
            console.log(picker.endDate.format('YYYY/MM/DD HH:mm'));
        });

        var date_last_clicked = null;

        $('#calendar1').fullCalendar({
            eventSources: [
               {
               events: function(start, end, timezone, callback) {
                console.log(moment(start).format('DD/MM/YYYY') + " - " + moment(end).format('DD/MM/YYYY'));
                    $.ajax({
                        url: '<?php echo base_url() ?>dashboard/get_events',
                        dataType: 'json',
                        data: {
                            // our hypothetical feed requires UNIX timestamps
                            start: start.unix(),
                            end: end.unix()
                        },
                        success: function(msg) {
                            console.log(msg.events);
                            var events = msg.events;
                            callback(events);
                        }
                    });
                  }
                },
            ],
            eventClick: function(event, jsEvent, view) {
	              $('#name_edit').val(event.title);
	              $('#description_edit').val(event.description);
	              $('#kuota_edit').val(event.kuota);
	              $('input[name="daterange_edit"]').daterangepicker({
	                  startDate: moment(event.start).format('MM/DD/YYYY'),
	                  endDate: moment(event.end).format('MM/DD/YYYY')
	              });
	              //$('#daterange_edit').val(moment(event.start).format('MM/DD/YYYY') + ' - ' + moment(event.end).format('MM/DD/YYYY'));
	              $('#start_date_edit').val(moment(event.start).format('YYYY/MM/DD HH:mm'));
	              if(event.end) {
	                $('#end_date_edit').val(moment(event.end).format('YYYY/MM/DD HH:mm'));
	              } else {
	                $('#end_date_edit').val(moment(event.start).format('YYYY/MM/DD HH:mm'));
	              }
	              $('#event_id').val(event.id);
	              $('#editModal').modal();
	              $('#myModalLabel_edit').empty();
	              $('#myModalLabel_edit').append('Detail Event');
	              $('#modal-footer').hide();
	              $('#event_date').hide();
	              $('#delete_event').hide();
	              $('#name_edit').prop('disabled', true);
	              $('#description_edit').prop('disabled', true);
	              $('#kuota_edit').prop('disabled', true);
	           },
        });
   		});
 	</script>
 	
</head>