<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Student Setting
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-3 col-lg-offset-5">
				<a href="<?php echo base_url();?>user/newstudent"><div class="submit-btn">Add Student</div></a>
			</div>
			<div class="col-lg-3">
				<a href="<?php echo base_url();?>excel/uploadstudent"><div class="submit-btn">Upload Student</div></a>
			</div>
			<div class="col-lg-1">
				<img src="<?php echo  base_url(); ?>img/pdf.png" alt="PDF" id="pdf-list" style="cursor:pointer;height:35px;margin-left:-8px;">
			</div>
		</div>
	</div>
</div>
<!-- // end heading -->

  




<!-- navigation top bar -->
<div class="row nav">
	<a href="<?php echo base_url();?>user/staff">
		<div class="col-lg-4">Staff</div>
	</a>
	<a href="<?php echo base_url();?>user/student">
	
		<div class="col-lg-4 active">Student</div>
	</a>
	<a href="<?php echo base_url();?>user/admin">
		<div class="col-lg-4">Admin</div>
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
//if organization is exist in database..
else{

?>

<div class="row location">
	<div class="col-lg-12">
		<div class="row">


			<!-- left hand site division -->
			<div class="col-lg-6 left-side">
				<!-- search bar -->
				<div class="row">
					<div class="col-lg-3 search-bar staff-search">
						<input type="text" class="search-staff name-search"  placeholder="Name..">
					</div>
					<div class="col-lg-3 search-bar staff-search" style="padding-left:0px;">
						<input type="text" class="search-staff username-search"  placeholder="Username..">
					</div>
					<div class="col-lg-3 search-bar staff-search" style="padding-left:0px;">
						<select name=""  class="course-search">
							<option value="">Course</option>
							<?php 

							foreach ($course_detail as $course) {
								echo '<option value="'.$course['id'].'">'.$course['name'].'</option>';
							}
							 ?>
						</select>

					</div>
					<div class="col-lg-3 search-bar staff-search" style="padding-left:0px;">
						<select name="" id="batch" class="batch-search">
							<option value="">Select Batch</option>
						</select>
					</div>
				</div>
				<!-- // end search bar -->

				<div class="row section">
					<div class="col-lg-12" style="padding-right:0px;">		
						<div class="view-grid staff-grid">
						
						<?php

						if($no_of_student > 0)
						{
							$i=1;
							//execute when first time page load..
							foreach($student_detail as $student)
							{
								$email = explode(',',$student['email']);
								$phone = explode(',',$student['phone']);
								$course = $this->user_model->fetchbyfield('id',$student['course'],'course');
								$batch = $this->user_model->fetchbyfield('id',$student['batch'],'batch');
							?>
							<div class="left-blog">
								<div class="row">
									<div class="col-lg-12 top-label">
										<div class="row">
											<div class="col-lg-6 location-name">
											<?php echo $student['name']; ?>
											</div>
											<div class="col-lg-6 topic_number">
											<?php echo $student['username']; ?>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="bottom-label <?php echo $i;?>" id="<?php echo $student['id']; ?>">
											<div class="row staff-detail">
												<div class="col-lg-2">
													<img src="<?php echo base_url(); ?>uploads/student/<?php echo $student['image'] ?>"  alt="" class="staff-img">
												</div>
												<div class="col-lg-5">
													<div><?php echo date('j, M Y',strtotime($student['dob'])); ?></div>
													<div><?php echo $student['gender']; ?></div>
													<div><?php echo $email[0]; ?></div>
												</div>
												<div class="col-lg-5">
													<div><?php echo $course['name']; ?></div>
													<div><?php echo $batch['name']; ?></div>
													<div><?php echo $phone[0]; ?></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
							$i++;
							}
						}
						else
						{
							// error message when there is no any organizaion location
							echo '<div class="row">
									<div class="col-lg-12 alert-msg">
										No Student Found In Database..!
									</div>
								</div>';
							// end error message when there is no any organizaion location
						}
						?>

							

						
						
							
						</div><!-- end view-grid -->
					</div><!-- end  class="col-lg-12" -->
				</div><!-- end row section -->

			</div><!-- // end<div class="col-lg-6 left-side"> -->
			<!-- // end left hand site division -->


			<div class="col-lg-6 right-side">

				<div class="display-div staff">
						
					<div class="row" style="padding:6px 15px;">
						<div class="col-lg-12 location-heading">
							<div class="row">
								<!-- course form heading -->
								<div class="col-lg-4 right-heading">
									New Student
								</div>
								<!-- // end subject form heading -->
								<div class="col-lg-6">
									<div class="msg success-msg">
										<?php
										if( $this->session->userdata('insert_student') != "" )
										{
											echo "Student Has Been Successfully Added.";
										}
										else if( $this->session->userdata('update_student') != "" )
										{
											echo "Student Has Been Successfully Updated.";
										}
										?>
									</div>
									
								</div><!-- end success msg -->
								<div class="col-lg-2 edit">
									<div class="current-student-id" style="display:none;"></div>
									<img src="<?php echo base_url()?>/img/pdf.png" alt="" class="pdf-btn" title="PDF Create">
									
									<img src="<?php echo base_url()?>/img/edit-icon.png" alt="" class="edit-btn" title="Edit User">
								</div>

							</div><!-- // end row -->
						</div><!-- // end col-lg-12 -->
					</div><!-- // end row -->

					<div class="staff-right-div student-view">

						<div class="row">
							<div class="col-lg-4 col-centered" style="margin-top:140px;">
								<a href="<?php echo base_url(); ?>user/newstudent">
								<div class="submit-btn form-submit-btn">Add New Student</div>
								</a>
							</div>
						</div>


					</div><!-- end student-right-div -->
				
				</div>
			</div>


		
		</div>
	</div>
</div>

<?php 
}
?>


<script type="text/javascript">
jQuery(document).ready(function($) {

	$("#pdf-list").hide();
	
	//execute when click on any student on left panel for view student full details..
	$(".staff-grid").on('click', '.bottom-label', function() {
		var student_id = $(this).attr('id');
		$(".bottom-label").removeClass('selected');
		
		$(this).addClass('selected');

		$(".right-heading").text('View Student');
		$(".edit .current-student-id").text(student_id);
		$(".edit").show();
		$(".la-anim-10").addClass('la-animate');
		$.ajax({
			url: '<?php echo base_url();?>index.php/user/view_student',
			type: 'POST',
			data: {student_id: student_id},
			success: function(result){
				$(".staff-right-div").html(result);
				$('.staff-right-div').animate({scrollTop:0}, 'slow');
				$(".la-anim-10").removeClass('la-animate');

			}
		});
	});

	$('.name-search').keyup(function(event) {
		/* Act on the event */
		var name = $('.name-search').val()
		var username = $('.username-search').val();
		var course = $('.course-search').val();
		var batch = $('.batch-search').val();
		$(".la-anim-10").addClass('la-animate');

		$.ajax({
			url: "<?php echo base_url();?>index.php/user/student_search",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {name:name, username : username,course:course, batch:batch},
			success: function(result){
				$(".staff-grid").html(result);
				$(".la-anim-10").removeClass('la-animate');
			}
		});
	});

	$('.username-search').keyup(function(event) {
		/* Act on the event */
		var name = $('.name-search').val()
		var username = $('.username-search').val();
		var course = $('.course-search').val();
		var batch = $('.batch-search').val();
		$(".la-anim-10").addClass('la-animate');
		$.ajax({
			url: "<?php echo base_url();?>index.php/user/student_search",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {name:name, username : username,course:course, batch:batch},
			success: function(result){
				$(".staff-grid").html(result);
				$(".la-anim-10").removeClass('la-animate');
			}
		});
	});

	$('.course-search').change(function(event) {
		/* Act on the event */
		var name = $('.name-search').val()
		var username = $('.username-search').val();
		var course = $('.course-search').val();
		var batch = "";
		$(".la-anim-10").addClass('la-animate');

		if(course != "")
		{
			$("#pdf-list").fadeIn();
		}
		else
		{
			$("#pdf-list").fadeOut();
		}

		$.ajax({
			url: "<?php echo base_url();?>index.php/user/student_search",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {name:name, username : username,course:course, batch:batch},
			success: function(result){
				$(".staff-grid").html(result);
				$(".la-anim-10").removeClass('la-animate');
			}
		});
	});

	$('.batch-search').change(function(event) {
		/* Act on the event */
		var name = $('.name-search').val()
		var username = $('.username-search').val();
		var course = $('.course-search').val();
		var batch = $('.batch-search').val();
		$(".la-anim-10").addClass('la-animate');

		$.ajax({
			url: "<?php echo base_url();?>index.php/user/student_search",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {name:name, username : username,course:course, batch:batch},
			success: function(result){
				$(".staff-grid").html(result);
				$(".la-anim-10").removeClass('la-animate');
			}
		});
	});

	//display batch when choose course in filter field..
	$(".course-search").change(function() {
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

	$("#pdf-list").click(function() {
		var course = $('.course-search').val();
		var batch = $('.batch-search').val();
		window.open('<?php echo base_url(); ?>pdf/studentlist/'+course+"/"+batch,'_blank');
	});

	//execute when user want to edit any admin details.
	//when click on edit button on right panel for edit information of user..
	$('.edit .edit-btn').click(function() {
		$(".la-anim-10").addClass('la-animate');
		var student_id = $(".edit .current-student-id").text();
		// alert(student_id)
		window.location = '<?php echo base_url(); ?>user/editstudent/'+student_id;
	});

	//execute when user want to create pdf file of any profile..
	$('.edit .pdf-btn').click(function() {
		var student_code = $(".student_code").text();
		// alert(student_id)
		 window.open('<?php echo base_url(); ?>pdf/studentprofile/'+student_code,'_blank');

	});


	<?php
	//execute after Course is successfully Added and show success msg.
  	// 
	if( $this->session->userdata('insert_student') )
	{
	?>
		
		$(".1").css({
			backgroundColor: 'rgb(142, 213, 114)'
		});

		$(".1").animate({
	    	backgroundColor:"#fff"
	  	},9000);
		
		$(".success-msg").delay(5000).fadeOut(1000);
  	
  	<?php
  	}
  	if( $this->session->userdata('update_student') )
	{
	?>
		var id = "<?php echo $this->session->userdata('update_student') ?>";
		$("#"+id).css({
			backgroundColor: 'rgb(142, 213, 114)'
		});

		$("#"+id).animate({
	    	backgroundColor:"#fff"
	  	},9000);
		
		$(".success-msg").delay(5000).fadeOut(1000);

		var p = $( "#"+id );

		var offset = p.offset();
		var top_value = parseFloat(offset.top) - 200;
		$('.staff-grid').animate({scrollTop:top_value}, 'slow');
  	
  	<?php
  	}
  	?>



});

</script>

<?php
$this->session->unset_userdata('update_student');
$this->session->unset_userdata('insert_student');
?>