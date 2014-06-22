<!-- heading -->
<div class="row heading">
	<div class="col-lg-3">
		Lecture Scheduling
	</div>
	<div class="col-lg-6">
		<div class="success-msg-top">
			<?php
			if(isset($insert_lecture))
			{
				echo "Lecture Has Been Successfully Scheduled.";
			}
			?>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="row">
			<div class="col-lg-5">
				<a href="<?php echo base_url();?>study/lecturescheduling"><div class="submit-btn">New</div></a>
			</div>
			<div class="col-lg-5 lecture-s">
				<div class="submit-btn view" style="position:relative;">View</div>
				<div class="list-view">
					<a href="<?php echo base_url(); ?>study/lecturescheduling"><div>Batch</div></a>
					<a href="<?php echo base_url(); ?>study/teacherlecture"><div>Teacher</div></a>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- // end heading -->


<!-- navigation top bar -->
<div class="row nav">
	<a href="<?php echo base_url();?>study/course">
		<div class="col-manual-5">Course</div>
	</a>
	<a href="<?php echo base_url();?>study/subject">
	
		<div class="col-manual-5">Subject</div>
	</a>
	<a href="<?php echo base_url();?>study/batch">
		<div class="col-manual-5">Batch</div>
	</a>
	<a href="<?php echo base_url();?>study/batchscheduling">
		<div class="col-manual-5" >Batch Scheduling</div>
	</a>
	<a href="<?php echo base_url();?>study/lecturescheduling">
		<div class="col-manual-5 active">Lecture Scheduling</div>
	</a>
</div>
<!-- // end navigation top bar -->





<?php
//check if there is any organization set or not
//execute if there is no any organization in database
//then firstly set organization..
if($organization_detail['name'] == "")
{
?>
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1 alert-msg">
			There is no any organization so first set organization details
			<?php echo anchor('setting/organization','click here'); ?>
		</div>
	</div>
	
<?php
}
else{
?>

<div class="select-student-id" style="display:none;"></div>
<div class="row lecture-scheduling">
	<div class="col-lg-12">


	<div class="row" style="margin-top:40px; margin-bottom:30px;">
		<div class="col-lg-4 col-centered">
			<select id="teacher" class="form-control">
				<option value="">Teacher</option>
				<?php
				foreach($teacher_detail as $teacher)
				{
					echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
				}
				?>
			</select>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-11 col-centered dispaly-teacher-timetable">
			<div class="select-teacher">
				Select Teacher.. !
			</div>
		</div>
	</div>

	</div>
</div>
</div>


<?php 
}
?>
<script type="text/javascript">
	
	$("#teacher").change(function(event) {

		var teacher_id = $(this).val();
		if(teacher_id == "")
		{
			$(".dispaly-teacher-timetable").html('<div class="select-teacher"> Select Teacher.. ! </div>');
		}
		else
		{
			$.ajax({
				url: "<?php echo base_url();?>index.php/study/view_teacher_timetable",
				type: 'POST',
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				data: {teacher_id : teacher_id},
				success: function(result){
					$(".dispaly-teacher-timetable").html(result);
					// alert(result)
				}
			});
		}
	});

	$(".list-view").hide();
	$(".view").click(function(event) {
		/* Act on the event */
		$(".list-view").slideToggle();
	});
	
	$(document).click( function (event) {
	    var className = event.target.className;
	    if(className == "list-view" || className == "submit-btn view"){
	        return false;
	    }
	    else
	    {
	    	$(".list-view").slideUp();
	    }

	});
</script>