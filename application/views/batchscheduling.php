<!-- heading -->
<div class="row heading">
	<div class="col-lg-3">
		Batch Scheduling
	</div>
	<div class="col-lg-6">
		<div class="success-msg-top">
			
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
		<div class="col-manual-5 active" >Batch Scheduling
			<div class="batch-noti">990</div>
		</div>

	</a>
	<a href="<?php echo base_url();?>study/lecturescheduling">
		<div class="col-manual-5">Lecture Scheduling</div>
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
	$course_id =  $student_detail[0]['course'];
	$batch_detail = $this->manage_course->fetch_batch_by_courseid($course_id);
?>

<div class="select-student-id" style="display:none;"></div>
<div class="row batch-scheduling">
	<div class="col-lg-12">
		
		<!-- search bar -->
		<div class="row">
			<div class="col-lg-12">
				<div class="checkall">
					<label style="float:left;">
						<input type="checkbox" class="checkbox check-all">
						<div class="checkbox-img"></div>
					</label>
				</div>

				<div class="row search-bar">
					
					<div class="col-manual-5">
						<input type="text" class="search-course name-search"  placeholder="Type Student Name..">
					</div>
					<div class="col-manual-5">
						<input type="text" class="search-course username-search"  placeholder="Type Username..">
					</div>
					<div class="col-manual-5">
						<select id="course" class="course-search">
							<?php 
							foreach ($course_detail as $course) {
								if($course_id == $course['id'])
								echo '<option value="'.$course['id'].'" selected>'.$course['name'].'</option>';
								else
								echo '<option value="'.$course['id'].'">'.$course['name'].'</option>';

							}
							?>
						</select>
					</div>
					<div class="col-manual-5">
						<select id="batch" class="batch-search">
							<option value="">Select Batch</option>
							<?php 
							foreach ($batch_detail as $batch) {
								echo '<option value="'.$batch['id'].'">'.$batch['name'].'</option>';
							}
							?>
						</select>
					</div>
					<div class="col-manual-5 move-div">
						<div class="move">Move</div>
						<div class="move-list" >
							<?php 
							foreach ($batch_detail as $batch) {
								echo '<div class="move-batch" id="'.$batch['id'].'">'.$batch['name'].'</div>';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- // end search bar -->

		<div class="row" style="padding-right:0;">
			<div class="col-lg-12 view-grid">
				
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
					<div class="student">
						<div class="student-checkbox">
							<label style="float:left;">
								<input type="checkbox" name="student-check[]" class="checkbox student-check" value="<?php echo $student['id']; ?>">
								<div class="checkbox-img"></div>
							</label>
						</div>

						
						<div class="row student-list">
							<div class="col-lg-12">
								<div class="row">
									<div class="col-lg-1 student-img">
										<img src="<?php echo base_url(); ?>uploads/student/<?php echo $student['image']; ?>" alt="">
									</div>
									<div class="col-lg-4 student-name-username">
										<div><?php echo $student['name']; ?></div>
										<div><?php echo $student['username']; ?></div>
										<div><?php echo date('j, M Y',strtotime($student['dob'])) ?></div>
									</div>

									<div class="col-lg-3 student-email-phone">
										<div><?php echo $student['gender']; ?></div>
										<div><?php echo $email[0]; ?></div>
										<div><?php echo $phone[0]; ?></div>
									</div>
									<div class="col-lg-2 student-email-phone">
										<div><?php echo $student['city']; ?></div>
										<div><?php echo $course['name']; ?></div>
										<div>
											<?php 
											if($batch['name'] != "")
												echo $batch['name'];
											else
												echo "<span style='color:red'>--</span>"
											 ?>
										</div>
									</div>
									<div class="col-lg-2 student-view" style="position:relative">
										<div data-toggle="modal" data-target=".bs-example-modal-lg" style="position:absolute;" >
										<img src="<?php echo base_url() ?>/img/view.png" alt="" class="view-student" id="stu_<?php echo $student['id']; ?>">
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

			</div>
		</div>
		
		

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style=" width: 70%; ">
    <div class="modal-content" style="width:100%;">
    	
    </div>
  </div>
</div>
		



		
	</div>
</div>



<?php
}//end else condition
?>

<script type="text/javascript">

jQuery(document).ready(function($) {
	
	$(".batch-scheduling .search-bar .move ").click(function(event) {
		/* Act on the event */
		$(".move-list").slideToggle();
	});
	
	$(document).click( function (event) {
	    var className = event.target.className;
	    if(className == "move-list" || className == "move"){
	        return false;
	    }
	    else if(className == "move-batch")
	    {    	
	    	$(".move-list").fadeOut();
	    }
	    else
	    {
	    	$(".move-list").slideUp();
	    }

	});

    
	$(".batch-scheduling .checkall .checkbox").click(function(event) {
		
		//execute when checkall checkbox is checked..
		if( $(this).is(":checked") )
		{
			// execute a loop for checkbox
			$(".checkbox").each(function() {
				$(this).prop('checked',true);
				$(this).next('.checkbox-img').css({
					background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 0px'
				});
			});
			$(".student-list").addClass('selected');

			// section for store all checked value into hidden div
			//each for store all checkbox value into hidden div..
			var student_id = [];
			$(".student-check").each(function()
			{
				student_id.push($(this).val());
			});
			var el = $.map(student_id, function(val, i) {
				return val;
			});
			$(".select-student-id").html(el.join(","));
			// // end section for store all checked value into hidden div
		}

		//execute when checkall checkbox is unchecked..
		else{
			// execute a loop for checkbox
			$(".checkbox").each(function() {
				$(this).prop('checked',false);
				$(this).next('.checkbox-img').css({
					background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 0px'
				});
			});
			$(".student-list").removeClass('selected');
			$(".select-student-id").html("");
		}
	});
	// $(".batch-scheduling .student-checkbox .checkbox").click(function(event) {
	//execute when click on any student checkbox..
	$(".batch-scheduling").on('click', '.student-check', function(event) {
		
		//execute when any student checkbox is checked..
		if( $(this).is(":checked") )
		{
			
			if($(".student-checkbox .checkbox").length == $(".student-checkbox .checkbox:checked").length) {
	            $(".checkall .checkbox").prop('checked',true);
	            $(".checkall .checkbox").next('.checkbox-img').css({
					background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 0px'
				});
	        }
	        
	        $(this).prop('checked',true);
	        
	        $(this).next('.checkbox-img').css({
				background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 0px'
			});
			$(this).parents('.student').children('.student-list').addClass('selected');

			// section for store all checked value into hidden div
			var student_id = [];
			$(".student-check:checked").each(function()
			{
					student_id.push($(this).val());
			});
			var el = $.map(student_id, function(val, i) {
				return val;
			});
			$(".select-student-id").html(el.join(","));
			// end section for store all checked value into hidden div


		}
		else{
			
			$(".checkall .checkbox").prop('checked',false);

            $(".checkall .checkbox").next('.checkbox-img').css({
				background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 0px'
			});

	        $(this).prop('checked',false);
			
			$(this).next('.checkbox-img').css({
				background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 0px'
			});
			
			$(this).parents('.student').children('.student-list').removeClass('selected');


			// section for store all checked value into hidden div
			var student_id = [];
			$(".student-check:checked").each(function()
			{
					student_id.push($(this).val());
			});
			var el = $.map(student_id, function(val, i) {
				return val;
			});
			$(".select-student-id").html(el.join(","));
			// end section for store all checked value into hidden div
		}
	});
	

	$('.name-search').keyup(function(event) {
		/* Act on the event */
		var name = $('.name-search').val()
		var username = $('.username-search').val();
		var course = $('.course-search').val();
		var batch = $('.batch-search').val();


		$.ajax({
			url: "<?php echo base_url();?>index.php/study/batchscheduling_search",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {name:name, username : username,course:course, batch:batch},
			success: function(result){
				$(".view-grid").html(result);
			}
		});

		$(".checkall .checkbox").prop('checked',false);

        $(".checkall .checkbox").next('.checkbox-img').css({
			background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 0px'
		});
	});


	$('.username-search').keyup(function(event) {
		/* Act on the event */
		var name = $('.name-search').val()
		var username = $('.username-search').val();
		var course = $('.course-search').val();
		var batch = $('.batch-search').val();


		$.ajax({
			url: "<?php echo base_url();?>index.php/study/batchscheduling_search",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {name:name, username : username,course:course, batch:batch},
			success: function(result){
				$(".view-grid").html(result);
			}
		});
		$(".checkall .checkbox").prop('checked',false);

        $(".checkall .checkbox").next('.checkbox-img').css({
			background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 0px'
		});
	});

	$('.course-search').change(function(event) {
		/* Act on the event */
		var name = $('.name-search').val()
		var username = $('.username-search').val();
		var course = $('.course-search').val();
		var batch = "";


		$.ajax({
			url: "<?php echo base_url();?>index.php/study/batchscheduling_search",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {name:name, username : username,course:course, batch:batch},
			success: function(result){
				$(".view-grid").html(result);
			}
		});
		$(".checkall .checkbox").prop('checked',false);

        $(".checkall .checkbox").next('.checkbox-img').css({
			background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 0px'
		});

		var course_id = $(this).val();
		$(".select-student-id").html('');
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

		$.ajax({
			url: "<?php echo base_url();?>index.php/study/move_list",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {course_id : course_id},
			success: function(result){
				$(".move-list").html(result);
				// alert(result)
			}
		});
	});

	$('.batch-search').change(function(event) {
		/* Act on the event */
		var name = $('.name-search').val()
		var username = $('.username-search').val();
		var course = $('.course-search').val();
		var batch = $('.batch-search').val();
		$(".select-student-id").html('');

		$.ajax({
			url: "<?php echo base_url();?>index.php/study/batchscheduling_search",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {name:name, username : username,course:course, batch:batch},
			success: function(result){
				$(".view-grid").html(result);
			}
		});
		$(".checkall .checkbox").prop('checked',false);

        $(".checkall .checkbox").next('.checkbox-img').css({
			background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 0px'
		});
		$(".move-list .move-batch").show();
		$(".move-list #"+batch).hide();
	});

	//execute when click on move batch for move students into batch.
	$(".batch-scheduling").on('click', '.move-batch', function(event) {
		//execute if any student is selected for move..
		if( $(".checkbox:checked").length > 0 )
		{
			//get student ids which is selected..
			var select_id = $(".select-student-id").text();
			//get batch id where it is moved..
			var batch = $(this).attr('id');
			//get course  id..
			var course = $(".course-search").val();
			//delete student id from select-student-id division..
			$(".select-student-id").text("");
			
			//execute n times those students is selected.
			$(".student-check:checked").each(function()
			{
				$(this).parents('.student').slideUp();
				$(this).val('');
			});

			setTimeout(function () {
			   $(".student-check:checked").each(function(){
				$(this).parents('.student').remove();
				
				});
			}, 2000);


			if( $(".checkall .checkbox").is(":checked") )
			{
				$(".checkall .checkbox").prop('checked',false);
				
	            $(".checkall .checkbox").next('.checkbox-img').css({
					background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 0px'
				});
			}

			$.ajax({
			url: "<?php echo base_url();?>index.php/study/batchscheduling_move",
			type: 'POST',
			data: {select_id:select_id, course:course, batch:batch},
			success: function(result){
				$(".success-msg-top").html(result);
				setTimeout(function () {
		            $(".success-msg-top").slideUp(1000);
		        }, 2000);
		         $(".success-msg-top").show();
			}

		});
		}
		//execute if there is no student selected for move..
		//then display error..
		else
		{
			alert("Please Select Any Student for Move !");
		}
	});
	
	$(".batch-scheduling").on('click', '.view-student', function(event) {
		var student_id = $(this).attr('id');
		$.ajax({
			url: "<?php echo base_url();?>index.php/study/batchscheduling_view_student",
			type: 'POST',
			data: {student_id:student_id},
			success: function(result){
				$(".modal-content").html(result);
			}
		});
	});


});




</script>