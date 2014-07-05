<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Assignment Management
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-6">
				<a href="<?php echo base_url();?>news"><div class="submit-btn">Add Assignment</div></a>
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
//if organization is exist in database..
else{
?>


<div class="row assignment">
	<div class="col-lg-12">
		<div class="row">

			<!-- left hand site division -->
			<div class="col-lg-6 left-side">
				<!-- search bar -->
				<div class="row">
					<div class="col-lg-3 search-bar">
						<input type="text" class="search-staff title-search"  placeholder="Title..">
					</div>
					<div class="col-lg-3 search-bar" style="padding-left:0px;">
						<select name="" class="course-search">
							<option value="">Select Course</option>
							<?php
							foreach ($course_detail as $course) {
								?>
								<option value="<?php echo $course['id'] ?>"><?php echo $course['name'] ?></option>
								<?php
							}
							?>
						</select>
					</div>
					<div class="col-lg-3 search-bar" style="padding-left:0px;">
						<select name="" class="batch-search">
							<option value="">Select Batch</option>
						</select>
					</div>
					<div class="col-lg-3 search-bar" style="padding-left:0px;">
						<select name="" class="subject-search">
							<option value="">Subject</option>
						</select>
					</div>
				</div>
				<!-- // end search bar -->

				<div class="row section">
					<div class="col-lg-12" style="padding-right:0px;">		
						<div class="view-grid">

							<div class="left-blog">

								<!-- assignment title and post date section -->
								<div class="row">
									<div class="col-lg-12 top-label">
										<div class="row">
											<div class="col-lg-6 assignment-title" title="">
												Assignment Title										
											</div>
											<div class="col-lg-6 post-date">
												20, June 2014										
											</div>
										</div>
									</div>
								</div>
								<!-- // end assignment title and post date section -->
								

								<div class="bottom-label">
									<div class="row">
										<div class="col-lg-8 assignment-left">
											hello hello hello hello hello hello
											hello hello hello hello hello hello..
										</div>
										<div class="col-lg-4 assignment-right">
											<!-- <div>Share with (3)</div>
											<div>25 June, 2014</div>
											<div>admin_101</div> -->
											<div class="popover-options">
										      <a href="#"  style="font-weight:bold;" title="<div style='width:200px;'>Share with</div>"  
										         data-container="body" data-toggle="popover" data-content="
										         <div class='row'>
										         	<div class='col-lg-6'>
										         		<b>Course</b>
										         	</div>
										         	<div class='col-lg-6'>
										         		<b>Batch</b>
										         	</div>
										         </div>
										         <div class='row'>
										         	<div class='col-lg-6'>
										         		IIT
										         	</div>
										         	<div class='col-lg-6'>
										         		Batch 101
										         	</div>
										         </div>">
										         Shared with (3)
										      </a>
										   </div>
										   <div>Subject Name</div>
										   <div>25 june, 2014</div>
										</div>
									</div>
								</div>
								
							</div>
							
						</div><!-- end view-grid -->
					</div><!-- end  class="col-lg-12" -->
				</div><!-- end row section -->

			</div><!-- // end<div class="col-lg-6 left-side"> -->
			<!-- // end left hand site division -->

			<div class="col-lg-6 right-side">
				<div class="display-div">

					<div class="row" style="padding:6px 15px;">
						<div class="col-lg-12 location-heading">
							<div class="row">
								<!-- course form heading -->
								<div class="col-lg-4 right-heading">
									Add Assignment
								</div>
								<!-- // end subject form heading -->
								<div class="col-lg-7">
									
								</div><!-- end success msg -->
								<div class="col-lg-1 edit">
									<div class="current-staff-id" style="display:none;"></div>
									<img src="<?php echo base_url(); ?>/img/edit-icon.png" alt="" class="edit-btn" title="Edit User">
								</div>

							</div><!-- // end row -->
						</div><!-- // end col-lg-12 -->
					</div>
					<div class="assignment-right-div">
						<div class="row course-batch">
							<div class="col-lg-10">
								
								<div class="row">
									<div class="col-lg-6">
										<div class="label-text">Course</div>
										<select name="" id="course" class="form-control">
											<option value="">Select Course</option>
											<?php
											foreach ($course_detail as $course) {
												?>
												<option value="<?php echo $course['id'] ?>"><?php echo $course['name'] ?></option>
												<?php
											}
											?>
										</select>
									</div>
									<div class="col-lg-6">
										<div class="label-text">Batch</div>
										<select name="" id="batch" class="form-control">
											<option value=""> Select Batch</option>
										</select>
									</div>
								</div>

								<div class="row" style="margin-top:10px;">
									<div class="col-lg-6">
										<div class="label-text">Subject</div>
										<select name="" id="subject" class="form-control">
											<option value=""> Select Subject</option>
										</select>
									</div>
									<div class="col-lg-6">
										<div class="label-text">Topic</div>
										<select name="" id="topic" class="form-control">
											<option value=""> Select Topic</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-lg-2 add-btn">
								<img src="<?php echo base_url(); ?>img/plus-icon.png" alt="">
							</div>
						</div>

						<div class="row" style="margin-top:10px;">
							<div class="col-lg-12">
								<div class="label-text"> Assignment Topic</div>
								<div>
									<input type="text" class="form-control">
								</div>
							</div>
						</div>

						<div class="row" style="margin-top:10px;">
							<div class="col-lg-12">
								<div class="label-text">Assignment Description</div>
									<textarea rows="4" class="form-control"></textarea>
							</div>
						</div>

						<div class="row" style="margin-top:10px;">
							<div class="col-lg-6">
								<div class="label-text">Submition Date</div>
								<div>
									<div class="form-group">
			                            <div class='input-group date' id='datetimepicker' data-date-format="DD/MM/YYYY">
			                                <input type='text' class="form-control" name="doj" id="student-doj" />
			                                <span class="input-group-addon">
			                                    <span class="glyphicon glyphicon-calendar"></span>
			                                </span>
			                            </div>
			                        </div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="label-text">Attachment</div>
								<div>
									<label style="width:100%;">
										<input type="file" style="display:none;" multiple name="file" id="file">
										<div class="upload-file">Upload Files</div>
									</label>
								</div>
								<div class="select-file">
									
								</div>
							</div>
						</div>

						<div class="row" style="margin-top:10px;">
							<div class="col-lg-12">
								<div class="label-text">Comments</div>
									<textarea rows="2" class="form-control"></textarea>
							</div>
						</div>

						<!-- save and cancle button -->
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-3 col-lg-offset-3">
								<input type="hidden" name="insert_btn" value="success">
								<div class="submit-btn form-submit-btn save-btn">Save</div>
							</div>
							<div class="col-lg-3">
								<div class="cancel-btn" id="reset">Cancle</div>
							</div>
						</div>
						<!-- //end save and cancle button -->

					</div><!-- // end assignment-right-div -->


				</div>

			</div>

		</div>
	</div>
</div>


<?php 
}//end else condition..
?>
<script type="text/javascript">
$(function(){

	$('#datetimepicker').datetimepicker({
        pickTime: false
    });
   	var today = new Date();
    $('#datetimepicker').data("DateTimePicker").setMinDate(new Date(today));

	 // $('.popover-options a').popover('show');
	$(".popover-options a").popover({
		html : true,
		trigger : 'hover' 
	});

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

	$(".assignment").on('click', '.add-btn img', function(event) {
		// alert("hello");
		var course_batch = '<div class="row course-batch" style="margin-top:10px;">'
							+' <div class="col-lg-10">' 
								+'<div class="row">'
									+'<div class="col-lg-6">'
										+'<div class="label-text">Course</div>'
										+'<select name="" id="course" class="form-control">'
										+'<option value="">Select Course</option>'
										+'<?php foreach ($course_detail as $course){?> <option value="<?php echo $course['id'] ?>"><?php echo $course['name'] ?></option> <?php } ?>'
										+'</select>'
									+'</div>'
									+'<div class="col-lg-6">'
										+'<div class="label-text">Batch</div>'
										+'<select name="" id="batch" class="form-control">'
										+'<option value=""> Select Batch</option>'
										+'</select>'
									+'</div>'
								+'</div>'
								+'<div class="row" style="margin-top:10px;">'
									+'<div class="col-lg-6">'
										+'<div class="label-text">Subject</div>'
										+'<select name="" id="subject" class="form-control">'
										+'<option value=""> Select Subject</option>'
										+'</select>'
									+'</div>'
									+'<div class="col-lg-6">'
										+'<div class="label-text">Topic</div>'
										+'<select name="" id="topic" class="form-control">'
										+'<option value=""> Select Topic</option>'
										+'</select>'
									+'</div>'
								+'</div>'
							+'</div>'
							+'<div class="col-lg-2 add-btn">'
								+'<img src="<?php echo base_url(); ?>img/plus-icon.png" alt="">'
							+'</div>'
							+'</div>'; 
		$(".course-batch").last().after(course_batch);
		$(".course-batch").removeClass('background');
		$(".course-batch").addClass('background');
		$(this).parent().removeClass('add-btn');
		$(this).parent().addClass('remove-btn');
		$(this).parent().html('<img src="<?php echo base_url(); ?>img/minus.png" alt="">');
	});

	$(".assignment").on('click', '.remove-btn img', function(event) {
		$(this).parent().parent().fadeOut();
		var remove_btn = $(this)
		setTimeout(function () {
			remove_btn.parent().parent().remove();
			$(".course-batch").removeClass('background');
			$(".course-batch").addClass('background');		  
		}, 1000);
	});

	$(".assignment").on('change', '.course-search', function(event) {
		var course_id = $(this).val();
		$.ajax({
			url: "<?php echo base_url();?>index.php/user/batch_search",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {course_id : course_id},
			success: function(result){
				$(".batch-search").html(result);
				// alert(result)
			}
		});
	});

	$(".assignment").on('change', '#course', function(event) {
		var course_id = $(this).val();
		var course = $(this)
		$.ajax({
			url: "<?php echo base_url();?>index.php/user/batch_search",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {course_id : course_id},
			success: function(result){
				course.parent().next().children('#batch').html(result);
			}
		});
	});

	$(".assignment").on('change', '#file', function() {
		var innn = document.getElementById('file');
		var files = innn.files.length;
		if (files > 1) {
			var text = files + " files selected."
		}
		else
		{
			var text = files + " file selected."
		}

		$('.select-file').text(text);
	});

});
</script>