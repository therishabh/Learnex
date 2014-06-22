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
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
</head>
<body style="overflow-x:hidden;overflow-y:hidden;">
	<div class="row login">
		<div class="col-lg-12">
			<div class="row login-logo">
				<div class="col-lg-12">
					<div class="logo animate0 bounceIn">
						LearnEx Education
					</div>
					<div class="change-pass animate0 bounceIn">
						Change Password
					</div>
				</div>
			</div>
			<div class="row login-form">
				<div class="col-lg-11 col-centered">
					
					<?php echo form_open('changepassword','id="change-password-form"'); ?>
					<div class="row username animate1 bounceIn">
						<div class="col-lg-4 col-lg-offset-4">
							<input type="password" class="form-control icon-3" required name="oldpassword" autocomplete="off" placeholder="Old Password" id="box-1">
						</div>
						<div class="col-lg-4 error-msg display-error-0 short">
							<?php
							if(isset($error))
							{
								echo "Old Password Does Not Match";
							} 
							 ?>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4 col-lg-offset-4 animate2 bounceIn">
							<input type="password" class="form-control icon-4" required placeholder="New Password" name="newpassword" id="box-2">
						</div>
						<div class="col-lg-4 error-msg display-error-1">
							
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4 col-lg-offset-4 animate2 bounceIn">
							<input type="password" class="form-control icon-4" required placeholder="Confirm Password" name="conpassword" id="box-3">
						</div>
						<div class="col-lg-4 error-msg display-error-2">
							
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-4 col-lg-offset-4 animate2 bounceIn">
							<input type="hidden" name="submit-btn" value="success">
							<div class="submit-btn save-btn">Submit</div>
						</div>
						
					</div>
					<?php echo form_close(); ?>

					

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

<script type="text/javascript">
	
	<?php
	if(isset($error))
	{
	?>
		$("#box-1").parent().addClass('has-error');
	<?php
	} 
	 ?>

	/*
		checkStrength is function which will do the 
		main password strength checking for us
	*/
	function checkStrength(password)
	{
		//initial strength
		var strength = 0
		
		//if the password length is less than 6, return message.
		if (password.length < 6) { 
			$('.display-error-1').removeClass('good');
			$('.display-error-1').removeClass('strong');
			$('.display-error-1').removeClass('weak');
			$('.display-error-1').addClass('short')
			return 'Too short' 
		}
		
		//length is ok, lets continue.
		
		//if length is 8 characters or more, increase strength value
		if (password.length > 7) strength += 1
		
		//if password contains both lower and uppercase characters, increase strength value
		if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
		
		//if it has numbers and characters, increase strength value
		if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
		
		//if it has one special character, increase strength value
		if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
		
		//if it has two special characters, increase strength value
		if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
		
		//now we have calculated strength value, we can return messages
		
		//if value is less than 2
		if (strength < 2 )
		{
			$('.display-error-1').removeClass('good');
			$('.display-error-1').removeClass('strong');
			$('.display-error-1').removeClass('short');
			$('.display-error-1').addClass('weak')
			return 'Weak Password'			
		}
		else if (strength == 2 )
		{
			$('.display-error-1').removeClass('weak')
			$('.display-error-1').removeClass('strong')
			$('.display-error-1').removeClass('short');
			$('.display-error-1').addClass('good')
			return 'Good Password'		
		}
		else
		{
			$('.display-error-1').removeClass('weak')
			$('.display-error-1').removeClass('good')
			$('.display-error-1').removeClass('short');
			$('.display-error-1').addClass('strong')
			return 'Strong Password'
		}
	}


	$('#box-2').keyup(function()
	{
		if($(this).val() != "")
		{
			$('.display-error-1').html(checkStrength($('#box-2').val()))
		}
		else
		{
			$('.display-error-1').html("");
		}

		if($("#box-3").val() != "")
		{
			if($("#box-2").val() == $("#box-3").val() )
			{
				$(".display-error-2").removeClass('short');
				$(".display-error-2").addClass('strong');
				$(".display-error-2").html("Password Match");
			}
			else
			{
				$(".display-error-2").removeClass('strong');
				$(".display-error-2").addClass('short');
				$(".display-error-2").html("Password Does Not Match");
			}
		}
	});

	$("#box-3").keyup(function() {
		if($("#box-2").val() == $("#box-3").val() )
		{
			$(".display-error-2").removeClass('short');
			$(".display-error-2").addClass('strong');
			$(".display-error-2").html("Password Match");
		}
		else
		{
			$(".display-error-2").removeClass('strong');
			$(".display-error-2").addClass('short');
			$(".display-error-2").html("Password Does Not Match");
		}
		if(event.keyCode == 13){
	        $(".submit-btn").click();
	    }
	});

	$(".submit-btn").click(function() {
		if($("#box-1").val() != "")
		{
			var flag_1 = 1;
		}
		else
		{
			var flag_1 = 0
			$("#box-1").parent().addClass('has-error');
		}

		if($("#box-2").val() != "")
		{
			var flag_2 = 1;
		}
		else
		{
			var flag_2 = 0;
			$("#box-2").parent().addClass('has-error');

		}

		if($("#box-3").val() != "")
		{
			var flag_3 = 1;
		}
		else
		{
			var flag_3 = 0
			$("#box-3").parent().addClass('has-error');
		}

		if(flag_1 == 1 && flag_2 == 1 && flag_3 == 1)
		{
			if($("#box-2").val() == $("#box-3").val())
			{
				$("#change-password-form").submit();
			}
			else
			{
				$("#box-3").parent().addClass('has-error');
			}
		}
		else
		{

		}
	});

	$(".form-control").focusin(function() {
		$(this).parent().removeClass('has-error');
	});
	$("#box-1").focusin(function() {
		$(".display-error-0").hide();
	});
</script>