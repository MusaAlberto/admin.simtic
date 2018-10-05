<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Bimbingan Belajar ANTOLOGI - </title>
		<link rel="shortcut icon" href="<?=base_url()?>assets/images/logo.png">

		<!-- Bootstrap -->
		<link href="<?=base_url()?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="<?=base_url()?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- NProgress -->
		<link href="<?=base_url()?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
		<!-- Animate.css -->
		<link href="<?=base_url()?>assets/vendors/animate.css/animate.min.css" rel="stylesheet">

		<!-- Custom Theme Style -->
		<link href="<?=base_url()?>assets/build/css/custom.min.css" rel="stylesheet">

		<script language='JavaScript'>
			var txt="Bimbingan Belajar ANTOLOGI - ";
			var speed=300;
			var refresh=null;
			function action() { document.title=txt;
			txt=txt.substring(1,txt.length)+txt.charAt(0);
			refresh=setTimeout("action()",speed);}action();
		</script>
	</head>

	<body class="login">
		<div>
			<a class="hiddenanchor" id="signup"></a>
			<a class="hiddenanchor" id="signin"></a>

			<div class="login_wrapper">
				<div class="animate form login_form">
					<section class="login_content">
						<div>
							<img src="<?=base_url()?>assets/images/logo.png" width="350px" height="150px">
							<h2>
								<b>
								Bimbingan Belajar ANTOLOGI Semarang
								</b>
							</h2>
						</div>
						<form method="POST" action="<?=base_url()?>user/login">
							<h1>Silahkan Login</h1>
							<div>
								<input type="email" name="email" class="form-control" placeholder="Email" required="" />
							</div>
							<div>
								<input type="password" name="pass" class="form-control" placeholder="Password" required="" />
							</div>
							<div>
								<button class="btn btn-default form-control" type="submit">Login</button>
							</div>
							<div class="clearfix"></div>
							<div class="separator">

								<div class="clearfix"></div>
								<br />

								<div>
									<p>Jln. Meranti Raya 286 Banyumanik Semarang</p>
									<p>( 024 ) 747 6671</p>
								</div>
							</div>
						</form>
					</section>
				</div>
			</div>
		</div>
	</body>
</html>
