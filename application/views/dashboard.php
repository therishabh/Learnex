<?php 
$username = $this->session->userdata('username');
//execute when login user is admin
if( substr($username,0,5) == "admin" )
{
?>
<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Dashboard
	</div>
	<div class="col-lg-6">
		
	</div>
</div>
<div class="row dashboard">
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<img src="<?php echo base_url(); ?>img/home.png" alt="">
			<div class="notification">0</div>
		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<a href="<?php echo base_url();?>user/staff">
			<img src="<?php echo base_url(); ?>img/users.png" alt="">
			<div class="notification">5</div>
			</a>
		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<a href="<?php echo base_url();?>study/course">
			<img src="<?php echo base_url(); ?>img/course.png" alt="">
			<div class="notification">8</div>
			</a>
		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<a href="<?php echo base_url(); ?>study/lecturescheduling">
			<img src="<?php echo base_url(); ?>img/timetable.png" alt="">
			<div class="notification">10</div>
			</a>
		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<a href="<?php echo base_url(); ?>attendance">
			<img src="<?php echo base_url(); ?>img/attendance.png" alt="">
			<div class="notification">7</div>
			</a>
		</div>
	</div>
	
</div>
<div class="row dashboard">
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<a href="<?php echo base_url();?>news">
			<img src="<?php echo base_url(); ?>img/news.png" alt="">
			<div class="notification news-noti"></div>
			</a>

		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<img src="<?php echo base_url(); ?>img/settings.png" alt="">
			<div class="notification">3</div>
		</div>
	</div>
	
</div>
<!-- // end heading -->
<script type="text/javascript">
$(document).ready(function()
{
	//execute for display news notification... in admin section
	$.ajax({
		url: '<?php echo base_url();?>index.php/notification/admin_news_notification',
		type: 'POST',
		data: {data:"hello"},
		success: function(result){
			$(".news-noti").text(result);
		}
	});


});

</script>
<?php
}
//execute when login user is Staff
if( substr($username,0,5) == "staff" )
{
?>
<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Dashboard
	</div>
	<div class="col-lg-6">
		
	</div>
</div>
<!-- // end heading -->
<div class="row dashboard">
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<img src="<?php echo base_url(); ?>img/home.png" alt="">
			<div class="notification">0</div>
		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<a href="<?php echo base_url();?>user/staff">
			<img src="<?php echo base_url(); ?>img/users.png" alt="">
			<div class="notification">5</div>
			</a>
		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<a href="<?php echo base_url();?>study/course">
			<img src="<?php echo base_url(); ?>img/course.png" alt="">
			<div class="notification">8</div>
			</a>
		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<a href="<?php echo base_url(); ?>study">
			<img src="<?php echo base_url(); ?>img/timetable.png" alt="">
			<div class="notification">10</div>
			</a>
		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<a href="<?php echo base_url(); ?>attendance">
			<img src="<?php echo base_url(); ?>img/attendance.png" alt="">
			<div class="notification">7</div>
			</a>
		</div>
	</div>
	
</div>
<div class="row dashboard">
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<a href="<?php echo base_url();?>news">
			<img src="<?php echo base_url(); ?>img/news.png" alt="">
			<div class="notification news-noti"></div>
			</a>

		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<img src="<?php echo base_url(); ?>img/settings.png" alt="">
			<div class="notification">3</div>
		</div>
	</div>
	
</div>
<!-- // end heading -->
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
		}
	});

});

</script>

<?php
}
//execute when login user is student
if( substr($username,0,5) == "stude" )
{
?>

<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Dashboard
	</div>
	<div class="col-lg-6">
		
	</div>
</div>
<!-- // end heading -->
<div class="row dashboard">
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<img src="<?php echo base_url(); ?>img/home.png" alt="">
			<div class="notification">0</div>
		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<a href="<?php echo base_url();?>user">
				<img src="<?php echo base_url(); ?>img/users.png" alt="">
				<div class="notification">5</div>
			</a>
		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<img src="<?php echo base_url(); ?>img/course.png" alt="">
			<div class="notification">8</div>
		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<img src="<?php echo base_url(); ?>img/timetable.png" alt="">
			<div class="notification">10</div>
		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<img src="<?php echo base_url(); ?>img/attendance.png" alt="">
			<div class="notification">7</div>
		</div>
	</div>
	
</div>
<div class="row dashboard">
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<a href="<?php echo base_url();?>news">
			<img src="<?php echo base_url(); ?>img/news.png" alt="">
			<div class="notification news-noti"></div>
			</a>
		</div>
	</div>
	<div class="col-manual-5 ">
		<div class="dashboard-icon">
			<img src="<?php echo base_url(); ?>img/settings.png" alt="">
			<div class="notification">3</div>
		</div>
	</div>
	
</div>
<!-- // end heading -->
<script type="text/javascript">
$(document).ready(function()
{
	//execute for display news notification... in admin section
	$.ajax({
		url: '<?php echo base_url();?>index.php/notification/student_news_notification',
		type: 'POST',
		data: {data:"hello"},
		success: function(result){
			$(".news-noti").text(result);
		}
	});
	setInterval(function(){
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
	}, 200);
	// end.. execute for display news notification... in admin section

});

</script>

<?php
}
?>

