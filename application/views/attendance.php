<!-- heading -->
<div class="row heading">
	<div class="col-lg-3">
		Attendance Management
	</div>
	<div class="col-lg-6">
		<div class="success-msg-top">
			<?php
			if(  $this->session->userdata('insert_attendance') != "" )
			{
				echo "Attendance Has Been Successfully Inserted.";
			}
			elseif(  $this->session->userdata('update_attendance') != "" )
			{
				echo "Attendance Has Been Successfully Updated.";
			}
			?>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="row">
			<div class="col-lg-5">
				<a href="<?php echo base_url();?>attendance"><div class="submit-btn">New</div></a>
			</div>
			<div class="col-lg-5 lecture-s">
				<a href="<?php echo base_url();?>viewattendance"><div class="submit-btn view" style="position:relative;">View</div></a>
			</div>
		</div>
	</div>
</div>
<!-- // end heading -->



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
<div class="row lecture-scheduling attendance">
	<div class="col-lg-12">
		
		<!-- filter fields -->
		<div class="row course-batch">
			<div class="col-lg-5 col-centered">
				<div class="row">

					<div class="col-lg-6">
						<select class="form-control" name="course"  id="course">
							<option value="">Select Course</option>
							<?php
							foreach ($course_detail as $course) {
								echo '<option value="'.$course['id'].'">'.$course['name'].'</option>';
							}
							?>
						</select>
					</div>
					<div class="col-lg-6">
						<select class="form-control" name="batch"  id="batch">
							<option value="">Select Batch</option>
						</select>
					</div>

				</div>
			</div>
		</div>
		<!-- // end filter fields -->


		<div class="row">
			<div class="col-lg-11 col-centered  error-display">

			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 view-display">
				
			</div>
		</div>





<?php 
}
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	
	//display batch when choose course in filter field..
	$("#course").change(function() {
		var course_id = $(this).val();
		$.ajax({
			url: "<?php echo base_url();?>index.php/user/batch_search",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {course_id : course_id},
			success: function(result){
				$("#batch").html(result);
				// alert(result)
			}
		});
	});

	$("#batch").change(function(){
		var batch_id = $(this).val();

		$.ajax({
			url: "<?php echo base_url();?>index.php/study/lecture_attendance_check",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {batch_id : batch_id},
			success: function(result){
				if(result)
				{
					$(".view-display").html(result);
					$(".view-display").show();
					$(".error-display").hide();
				}
				else
				{
					$(".view-display").hide();
					$(".error-display").show();
					$(".error-display").html("There is no Lecture Scheduled.!");
				}
			}
		});

	});

});

</script>

<?php
$this->session->unset_userdata('update_attendance');
$this->session->unset_userdata('insert_attendance');
?>