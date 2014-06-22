<html>
<head>
	<title>Learnex Login</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style-login.css">
	<link rel="stylesheet" href="css/animate.delay.css">
	<link rel="stylesheet" href="css/animate.min.css">
	<!-- user favicon -->
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>img/favicon.ico"/>
	<!-- // end user favicon -->
</head>
<body style="overflow-x:hidden;overflow-y:hidden;">
	<div class="row login">
		<div class="col-lg-12">
			<div class="row login-logo">
				<div class="col-lg-12">
					<div class="logo-login animate0 bounceIn">
						LearnEx Education
					</div>
				</div>
			</div>
			<div class="row login-form">
				<div class="col-lg-6 col-lg-offset-3">
					<div class="row">
						<div class="col-lg-12 error">
							<?php
							if(isset($error))
							echo $error; 
							?>
						</div>
					</div>
					<?php echo form_open(); ?>
					<div class="row username animate1 bounceIn">
						<div class="col-lg-8 col-lg-offset-2">
							<input type="text" class="form-control icon-1" required name="username" autocomplete="off" placeholder="Username">
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8 col-lg-offset-2 animate2 bounceIn">
							<input type="password" class="form-control icon-2" required placeholder="Password" name="password">
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-8 col-lg-offset-2 animate2 bounceIn">
							<input type="Submit" name="submit_btn" value="Login">
						</div>
					</div>
					<?php echo form_close(); ?>

					<div class="row">
						<div class="col-lg-8 col-lg-offset-2 animate3 bounceIn forget-password">
							<a href="#">Forget Password</a>
						</div>
					</div>

				</div>
			</div>
			<div class="row" id="footer">
				<div class="col-lg-12">
					&copy; <a href="http://www.codebibber.com" target="_blank">CodeBibber</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>