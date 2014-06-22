<?php
date_default_timezone_set('Asia/Calcutta');
$current_url = current_url();
//echo date("Y-m-d H:i:s");
$base_url = base_url();

if($this->session->userdata('username'))
{
	if($user_detail['status'] == 1)
	{
		if($user_detail['change_pass_status'] == 1)
		{
			redirect('changepassword', 'refresh');
		}
	}
	else
	{
		$this->session->sess_destroy('username');
		redirect('home', 'refresh');
	}
}
else
{
	 redirect('/home/', 'refresh');
}
?>
<html>
<head>
	<title>LearnEx Education</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style_old.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>


	<!-- loder css and script.. -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/component.css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>js/modernizr.custom.js"></script>
	<!-- // end loder css and script.. -->

	<!-- user favicon -->
	<link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>img/favicon.ico"/>
	<!-- // end user favicon -->

	
	<!-- link css for create tag into input text -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap-tagsinput.css">
	<!-- //link css for create tag into input text -->

	
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/countries.js"></script> 
	<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-tagsinput.js"></script> 

		




	<!-- script for data picker -->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>css/site.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>js/moment.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.js"></script>
	<!-- // end script for data picker -->

</head>

<body>

	<div class="la-anim-10"></div>

	<!-- left-panel div -->
	<nav id="left-panel">
		

	<?php
	//execute when login user is admin.. 
	if(substr($this->session->userdata('username'),0,5) == "admin")
	{
	?>
	
		<!-- display logo  -->
		<a class="logo-anchor" href="<?php echo base_url();?>">
			<div class="logo">
				L
			</div>
		</a>
		<!-- // end display logo  -->

		<!-- display home icon -->
		<?php
		if($current_url == base_url() || strpos($current_url,'home') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>">
					<img src="<?php echo base_url(); ?>img/right-panel/home.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>">
					<img src="<?php echo base_url(); ?>img/right-panel/home.png" alt="">
				</a>
			</div>
		<?php
		}
		?>
		<!-- // end display home icon -->

		<!-- display setting icon -->
		<?php
		if(strpos($current_url,'setting') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>setting/organization">
					<img src="<?php echo base_url(); ?>img/right-panel/setting.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>setting/organization">
					<img src="<?php echo base_url(); ?>img/right-panel/setting.png" alt="">
				</a>
			</div>
		<?php
		}
		?>		
		<!-- // end display setting icon -->

		<!-- display user icon -->
		<?php
		if(strpos($current_url,'user') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>user/staff">
					<img src="<?php echo base_url(); ?>img/right-panel/user.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>user/staff">
					<img src="<?php echo base_url(); ?>img/right-panel/user.png" alt="">
				</a>
			</div>
		<?php
		}
		?>
		<!-- // end display user icon -->

		<!-- display course icon -->
		<?php
		if(strpos($current_url,'study') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>study/course">
					<img src="<?php echo base_url(); ?>img/right-panel/course.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>study/course">
					<img src="<?php echo base_url(); ?>img/right-panel/course.png" alt="">
				</a>
			</div>
		<?php
		}
		?>
		<!-- // end display course icon -->

		<!-- display attendance icon -->
		<?php
		if(strpos($current_url,'attendance') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>attendance">
					<img src="<?php echo base_url(); ?>img/right-panel/attendance.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>attendance">
					<img src="<?php echo base_url(); ?>img/right-panel/attendance.png" alt="">
				</a>
			</div>
		<?php
		}
		?>
		<!-- //end display attendance icon -->

		<!-- display news icon -->
		<?php
		if(strpos($current_url,'news') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>news">
					<img src="<?php echo base_url(); ?>img/right-panel/news.png" alt="">
				</a>
				<div class="notification-left-panel news-noti"></div>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>news">
					<img src="<?php echo base_url(); ?>img/right-panel/news.png" alt="">
				</a>
				<div class="notification-left-panel news-noti"></div>
			</div>
		<?php
		}
		?>
		<!-- // end display news icon -->

		<!-- admin image and name.. -->
		<div class="user">
			<div class="flyout">
	            <a href="<?php echo base_url();?>/#" class="setting"><img src="<?php echo base_url();?>img/setting.png" alt=""></a>
	            <a href="<?php echo base_url();?>/logout" class="logout" title="Logout"><img src="<?php echo base_url();?>img/logout.png" alt=""></a>
	        </div>
			<div class="user_img">
				<img src="<?php echo base_url(); ?>uploads/admin/<?php echo $user_detail['image'] ?>" alt="">
			</div>
			<div class="user_name" title="<?php echo $user_detail['name']; ?>">
				<?php echo $user_detail['name']; ?>
			</div>
			<div class="user_name" style="font-size:10px;" title="<?php echo $user_detail['username']; ?>">
				<?php echo $user_detail['username']; ?>
			</div>
		</div>
		<!-- // end admin image and name.. -->

		<script type="text/javascript">
		$(document).ready(function()
		{
			//execute for display news notification... in admin section
			$.ajax({
				url: '<?php echo base_url();?>index.php/notification/admin_news_notification',
				type: 'POST',
				data: {data:"hello"},
				success: function(result){
					if(result == 0)
					{
						$(".news-noti").removeClass('noti-alert');
					}
					else
					{
						$(".news-noti").addClass('noti-alert');
					}
					$(".news-noti").text(result);
				}
			});
			// setInterval(function(){
			// 	$.ajax({
			// 		url: '<?php echo base_url();?>index.php/notification/admin_news_notification',
			// 		type: 'POST',
			// 		data: {data:"hello"},
			// 		success: function(result){
			// 			if(result == 0)
			// 			{
			// 				$(".news-noti").removeClass('noti-alert');
			// 			}
			// 			else
			// 			{
			// 				$(".news-noti").addClass('noti-alert');
			// 			}
			// 			$(".news-noti").text(result);
			// 		}
			// 	});
			// }, 200);
			// end.. execute for display news notification... in admin section

		});

		</script>


	<?php
	}
	//execute when login user is admin.. 
	elseif(substr($this->session->userdata('username'),0,5) == "staff")
	{
	?>	
		<!-- display logo  -->
		<a class="logo-anchor" href="<?php echo base_url();?>">
			<div class="logo">
				L
			</div>
		</a>
		<!-- // end display logo  -->

		<!-- display home icon -->
		<?php
		if($current_url == base_url() || strpos($current_url,'home') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>">
					<img src="<?php echo base_url(); ?>img/right-panel/home.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>">
					<img src="<?php echo base_url(); ?>img/right-panel/home.png" alt="">
				</a>
			</div>
		<?php
		}
		?>
		<!-- // end display home icon -->

		<!-- display setting icon -->
		<?php
		if(strpos($current_url,'setting') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>setting/organization">
					<img src="<?php echo base_url(); ?>img/right-panel/setting.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>setting/organization">
					<img src="<?php echo base_url(); ?>img/right-panel/setting.png" alt="">
				</a>
			</div>
		<?php
		}
		?>		
		<!-- // end display setting icon -->

		<!-- display user icon -->
		<?php
		if(strpos($current_url,'user') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>user/staff">
					<img src="<?php echo base_url(); ?>img/right-panel/user.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>user/staff">
					<img src="<?php echo base_url(); ?>img/right-panel/user.png" alt="">
				</a>
			</div>
		<?php
		}
		?>
		<!-- // end display user icon -->

		<!-- display course icon -->
		<?php
		if(strpos($current_url,'study') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>study">
					<img src="<?php echo base_url(); ?>img/right-panel/course.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>study">
					<img src="<?php echo base_url(); ?>img/right-panel/course.png" alt="">
				</a>
			</div>
		<?php
		}
		?>
		<!-- // end display course icon -->

		<!-- display attendance icon -->
		<?php
		if(strpos($current_url,'attendance') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>attendance">
					<img src="<?php echo base_url(); ?>img/right-panel/attendance.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>attendance">
					<img src="<?php echo base_url(); ?>img/right-panel/attendance.png" alt="">
				</a>
			</div>
		<?php
		}
		?>
		<!-- //end display attendance icon -->

		<!-- display news icon -->
		<?php
		if(strpos($current_url,'news') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>news">
					<img src="<?php echo base_url(); ?>img/right-panel/news.png" alt="">
				</a>
				<div class="notification-left-panel news-noti"></div>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>news">
					<img src="<?php echo base_url(); ?>img/right-panel/news.png" alt="">
				</a>
				<div class="notification-left-panel news-noti"></div>
			</div>
		<?php
		}
		?>
		<!-- // end display news icon -->

		<!-- admin image and name.. -->
		<div class="user">
			<div class="flyout">
	            <a href="<?php echo base_url();?>/#" class="setting"><img src="<?php echo base_url();?>img/setting.png" alt=""></a>
	            <a href="<?php echo base_url();?>/logout" class="logout" title="Logout"><img src="<?php echo base_url();?>img/logout.png" alt=""></a>
	        </div>
			<div class="user_img">
				<img src="<?php echo base_url(); ?>uploads/staff/<?php echo $user_detail['image'] ?>" alt="">
			</div>
			<div class="user_name" title="<?php echo $user_detail['name']; ?>">
				<?php echo $user_detail['name']; ?>
			</div>
			<div class="user_name" style="font-size:10px;" title="<?php echo $user_detail['username']; ?>">
				<?php echo $user_detail['username']; ?>
			</div>
		</div>
		<!-- // end admin image and name.. -->

		<script type="text/javascript">
		$(document).ready(function()
		{
			//execute for display news notification... in admin section
			$.ajax({
				url: '<?php echo base_url();?>index.php/notification/staff_news_notification',
				type: 'POST',
				data: {data:"hello"},
				success: function(result){
					$(".news-noti").text(result);
					if(result == 0)
					{
						$(".news-noti").removeClass('noti-alert');
					}
					else
					{
						$(".news-noti").addClass('noti-alert');
					}
				}
			});
			// setInterval(function(){
			// 	$.ajax({
			// 		url: '<?php echo base_url();?>index.php/notification/staff_news_notification',
			// 		type: 'POST',
			// 		data: {data:"hello"},
			// 		success: function(result){
			// 			$(".news-noti").text(result);
			// 			if(result == 0)
			// 			{
			// 				$(".news-noti").removeClass('noti-alert');
			// 			}
			// 			else
			// 			{
			// 				$(".news-noti").addClass('noti-alert');
			// 			}
			// 		}
			// 	});
			// }, 200);
			// end.. execute for display news notification... in admin section

		});

		</script>


	<?php
	}
	// execute when login user is student..
	else if(substr($this->session->userdata('username'),0,5) == "stude")
	{
	?>
		
		<!-- display logo  -->
		<a class="logo-anchor" href="<?php echo base_url();?>">
			<div class="logo">
				L
			</div>
		</a>
		<!-- // end display logo  -->

		<!-- display home icon -->
		<?php
		if($current_url == base_url() || strpos($current_url,'home') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>">
					<img src="<?php echo base_url(); ?>img/right-panel/home.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>">
					<img src="<?php echo base_url(); ?>img/right-panel/home.png" alt="">
				</a>
			</div>
		<?php
		}
		?>
		<!-- // end display home icon -->

		<!-- display setting icon -->
		<?php
		if(strpos($current_url,'setting') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>setting/organization">
					<img src="<?php echo base_url(); ?>img/right-panel/setting.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>setting/organization">
					<img src="<?php echo base_url(); ?>img/right-panel/setting.png" alt="">
				</a>
			</div>
		<?php
		}
		?>		
		<!-- // end display setting icon -->

		<!-- display user icon -->
		<?php
		if(strpos($current_url,'user') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>user">
					<img src="<?php echo base_url(); ?>img/right-panel/user.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>user">
					<img src="<?php echo base_url(); ?>img/right-panel/user.png" alt="">
				</a>
			</div>
		<?php
		}
		?>
		<!-- // end display user icon -->

		<!-- display course icon -->
		<?php
		if(strpos($current_url,'study') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>study/course">
					<img src="<?php echo base_url(); ?>img/right-panel/course.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>study/course">
					<img src="<?php echo base_url(); ?>img/right-panel/course.png" alt="">
				</a>
			</div>
		<?php
		}
		?>
		<!-- // end display course icon -->

		<!-- display attendance icon -->
		<?php
		if(strpos($current_url,'attendance') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>attendance">
					<img src="<?php echo base_url(); ?>img/right-panel/attendance.png" alt="">
				</a>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>attendance">
					<img src="<?php echo base_url(); ?>img/right-panel/attendance.png" alt="">
				</a>
			</div>
		<?php
		}
		?>
		<!-- //end display attendance icon -->

		<!-- display news icon -->
		<?php
		if(strpos($current_url,'news') !== false)
		{
			?>
			<div class="icon active">
				<a href="<?php echo base_url();?>news">
					<img src="<?php echo base_url(); ?>img/right-panel/news.png" alt="">
				</a>
				<div class="notification-left-panel news-noti"></div>
			</div>
			<?php
		}
		else
		{
			?>
			<div class="icon">
				<a href="<?php echo base_url();?>news">
					<img src="<?php echo base_url(); ?>img/right-panel/news.png" alt="">
				</a>
				<div class="notification-left-panel news-noti"></div>
			</div>
		<?php
		}
		?>
		<!-- // end display news icon -->

		<!-- student image and name.. -->
		<div class="user">
			<div class="flyout">
	            <a href="<?php echo base_url();?>/#" class="setting"><img src="<?php echo base_url();?>img/setting.png" alt=""></a>
	            <a href="<?php echo base_url();?>/logout" class="logout" title="Logout"><img src="<?php echo base_url();?>img/logout.png" alt=""></a>
	        </div>
			<div class="user_img">
				<img src="<?php echo base_url(); ?>uploads/student/<?php echo $user_detail['image'] ?>" alt="">
			</div>
			<div class="user_name" title="<?php echo $user_detail['name']; ?>">
				<?php echo $user_detail['name']; ?>
			</div>
			<div class="user_name" style="font-size:10px;" title="<?php echo $user_detail['username']; ?>">
				<?php echo $user_detail['username']; ?>
			</div>
		</div>
		<!-- // end student image and name.. -->

		<script type="text/javascript">
		$(document).ready(function()
		{
			//execute for display news notification... in student section
			$.ajax({
				url: '<?php echo base_url();?>index.php/notification/student_news_notification',
				type: 'POST',
				data: {data:"hello"},
				success: function(result){
					$(".news-noti").text(result);
					if(result == 0)
					{
						$(".news-noti").removeClass('noti-alert');
					}
					else
					{
						$(".news-noti").addClass('noti-alert');
					}
				}
			});
			// setInterval(function(){
			// 	$.ajax({
			// 		url: '<?php echo base_url();?>index.php/notification/student_news_notification',
			// 		type: 'POST',
			// 		data: {data:"hello"},
			// 		success: function(result){
			// 			$(".news-noti").text(result);
			// 			if(result == 0)
			// 			{
			// 				$(".news-noti").removeClass('noti-alert');
			// 			}
			// 			else
			// 			{
			// 				$(".news-noti").addClass('noti-alert');
			// 			}
			// 		}
			// 	});
			// }, 200);
			// end.. execute for display news notification... in student section

		});

		</script>

		

	<?php
	}
	// // end execute when login user is student..
	?>
		
	</nav>
	<!-- // end left-panel div -->

	<!-- start main body for content -->
	<div class="main-body" style="overflow-y:auto;">
		<div class="row">
			<div class="col-lg-12">


               
                          
