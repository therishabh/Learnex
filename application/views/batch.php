<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Batch Setting
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-6">
				<a href="<?php echo base_url();?>study/batch"><div class="submit-btn">New Batch</div></a>
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
		<div class="col-manual-5 active">Batch</div>
	</a>
	<a href="<?php echo base_url();?>study/batchscheduling">
		<div class="col-manual-5" >Batch Scheduling</div>
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
?>
<div class="row location">
	<div class="col-lg-12">
		<div class="row">
			<!-- left hand site division -->
			<div class="col-lg-6 left-side">
				<!-- search bar -->
				<div class="row">
					<div class="col-lg-12 search-bar">
						<input type="text" class="search-standard"  placeholder="Type Batch Name..">
					</div>
				</div>
				<!-- // end search bar -->

				<div class="row section">
					<div class="col-lg-12" style="padding-right:0px;">		
						<div class="view-grid">

					<?php
					///execute if existed number of standard greater than 0
					///then display standard grid
					if($no_of_standard > 0)
					{
						$i = 1;
						foreach($standard_details as $standard)
						{

							$standard_id = $standard['id'];
							$standard_name = $standard['name'];
							$course_id = $standard['course'];
							$standard_subject = explode('/',$standard['subject']);
							//get course name from database by course id..
							$course = $this->manage_course->get_detail_by_id($course_id,'course');
							$course_name = $course['name'];

							//if select any organization..
							if(isset($selected_standard) && $selected_standard != "")
							{
								//execute when selected_standard id is same as standard id.
								if($standard_id == $selected_standard['id'])
								{
									echo '<div class="row">
										<div class="col-lg-12 top-label">
											<div class="row">
												<div class="col-lg-6 location-name">'.$standard_name.'</div>
												<div class="col-lg-6 topic_number">'.$course_name.'</div>
											</div>
										</div>
									</div>';
									echo '<div class="row">
										<div class="col-lg-12">
											<div class="bottom-label '.$i.' selected" id="'.$standard_id.'">
												<a href="#">
												<div class="row">';
												$x = 1;
												foreach($standard_subject as $subject)
												{
													if($x < 10)
													{
														$subject_n = $this->manage_course->get_detail_by_id($subject,'subject');
														$subject_name = $subject_n['name'];

														echo '<div class="col-lg-4">';
														echo $subject_name;
														echo '</div>';																
													}
													$x++;
												}
												
													?>

												</div><!-- end row -->
												</a>
											</div><!-- end bottom-label -->
										</div><!-- end col-lg-12 -->
									</div>
									<?php
								
								}
								else
								{
									echo '<div class="row">
											<div class="col-lg-12 top-label">
												<div class="row">
													<div class="col-lg-6 location-name">'.$standard_name.'</div>
													<div class="col-lg-6 topic_number">'.$course_name.'</div>
												</div>
											</div>
										</div>';
									echo '<div class="row">
										<div class="col-lg-12">
											<div class="bottom-label '.$i.'" id="'.$standard_id.'">
												<a href="'.base_url().'study/batch/'.$standard_id.'">
												<div class="row">';
												$x = 1;
												foreach($standard_subject as $subject)
												{
													if($x < 10)
													{
														$subject_n = $this->manage_course->get_detail_by_id($subject,'subject');
														$subject_name = $subject_n['name'];

														echo '<div class="col-lg-4">';
														echo $subject_name;
														echo '</div>';																
													}
													$x++;
												}
												
													?>

												</div><!-- end row -->
												</a>
											</div><!-- end bottom-label -->
										</div><!-- end col-lg-12 -->
									</div>
									<?php
								}
							}//end if condition..
							//execute if there is no any select organization..
							else
							{
								echo '<div class="row">
									<div class="col-lg-12 top-label">
										<div class="row">
											<div class="col-lg-6 location-name">'.$standard_name.'</div>
											<div class="col-lg-6 topic_number">'.$course_name.'</div>
										</div>
									</div>
								</div>';
								echo '<div class="row">
										<div class="col-lg-12">
											<div class="bottom-label '.$i.'" id="'.$standard_id.'">
												<a href="'.base_url().'study/batch/'.$standard_id.'">
												<div class="row">';

												$x = 1;
												foreach($standard_subject as $subject)
												{
													if($x < 10)
													{
														$subject_n = $this->manage_course->get_detail_by_id($subject,'subject');
														$subject_name = $subject_n['name'];

														echo '<div class="col-lg-4">';
														echo $subject_name;
														echo '</div>';																
													}
													$x++;
												}
												
													?>

												</div><!-- end row -->
												</a>
											</div><!-- end bottom-label -->
										</div><!-- end col-lg-12 -->
									</div>
							<?php
							}//end else condition..
							$i++;
						}//end foreach loop foreach($standard_details as $standard)
					}// end if condition.. if($no_of_standard > 0)
					//execute if there is no any standard in database..
					else
					{
						// error message when there is no any organizaion location
						echo '<div class="row">
								<div class="col-lg-12 alert-msg">
									No Standard In Database
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

				<div class="display-div standard">
						
					<div class="row" style="padding:6px 15px;">
						<div class="col-lg-12 location-heading">
							<div class="row">
								<!-- course form heading -->
								<div class="col-lg-4">
									<?php
									if( isset($selected_standard) && !empty($selected_standard) )
									{
										echo "Edit Batch";
									}
									else
									{
										echo "Add Batch";
									}
									?>
								</div>
								<!-- // end subject form heading -->
								<div class="col-lg-8 msg success-msg">
									<?php
									if( $this->session->userdata('insert_standard') != "" )
									{
										echo "Batch Has Been Successfully Added.";
									}
									else if( $this->session->userdata('update_standard') != "" )
									{
										echo "Batch Has Been Successfully Updated.";
									}									
									?>
								</div>
							</div>
						</div>
					</div>

					<div class="subject-form">
						<?php echo form_open('study/batch','id="standard-form"'); ?>
						
						<?php
						//execute if any organization selected for updation..
						//then display editable mode form..
						if( isset($selected_standard) && !empty($selected_standard) )
						{
						?>
						<!-- standard name and course name section -->
						<div class="row">
							<div class="col-lg-5">
								<div class="label-text">Batch Name :</div>
								<div>
									<input type="text" id="standard_name" value="<?php echo $selected_standard['name']?>" class="form-control" name="standard_name" >
									
								</div>
							</div>

							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Course :</div>
								<div>
									<select name="course" id="course" class="form-control">
										<option value="">Select Course</option>
										<?php
										foreach ($course_details as $course)
										{
											if( $selected_standard['course'] == $course['id'] )
											{
												echo '<option selected value="'.$course['id'].'">'.$course['name'].'</option>';
											}
											else
											{
												echo '<option value="'.$course['id'].'">'.$course['name'].'</option>';
											}
											
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<!-- // end standard name and course name section -->

						

						<!-- subject name checkbox -->
						<div class="row" style="margin-top:15px">
							<div class="col-lg-12">
								<div class="label-text">Subject :</div>
							</div>
						</div>
						<div class="row">
							<?php
							$s_subject = explode("/",$selected_standard['subject']);
							foreach ($subject_details as $subject)
							{
								if(in_array($subject['id'], $s_subject))
								{
								?>
								<div class="col-lg-6">
									<label style="float:left; margin-right:10px;">
										<input type="checkbox" checked class="checkbox" value="<?php echo $subject['id']?>" name="subject[]">
										<div class="checkbox-img"></div>
									</label>
									<div><?php echo $subject['name']; ?></div>
								</div>
								<?php
								}
								else
								{
								?>
								<div class="col-lg-6">
									<label style="float:left; margin-right:10px;">
										<input type="checkbox" class="checkbox" value="<?php echo $subject['id']?>" name="subject[]">
										<div class="checkbox-img"></div>
									</label>
									<div><?php echo $subject['name']; ?></div>
								</div>
								<?php
								}
							}
							?>
						</div>
						<!-- // end subject name checkbox -->


						<!-- save and cancle button -->
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-3 col-lg-offset-3">
								<input type="hidden" name="batch_id" value="<?php echo $selected_standard['id']; ?>">
								<input type="hidden" name="update_btn" value="success">
								<div class="submit-btn form-submit-btn save-btn">Update</div>
							</div>
							<div class="col-lg-3">
								<div class="cancel-btn" id="reset">Cancle</div>
							</div>
						</div>
						<!-- //end save and cancle button -->
						<?php
						}
						else
						{
						?>
						<!-- standard name and course name section -->
						<div class="row">
							<div class="col-lg-5">
								<div class="label-text">Batch Name :</div>
								<div>
									<input type="text" id="standard_name" class="form-control" name="standard_name" >
									
								</div>
							</div>

							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Course :</div>
								<div>
									<select name="course" id="course" class="form-control">
										<option value="">Select Course</option>
										<?php
										foreach ($course_details as $course)
										{
											echo '<option value="'.$course['id'].'">'.$course['name'].'</option>';
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<!-- // end standard name and course name section -->
						
						

						<div class="row" style="margin-top:15px;margin-bottom:10px">
							<div class="col-lg-12">
								<div class="label-text">Subject :</div>
							</div>
						</div>
						<div class="row">
							<?php
							if($subject_details)
							{
								foreach ($subject_details as $subject) 
								{
									?>
										<div class="col-lg-6">
											<label style="float:left; margin-right:10px;">
												<input type="checkbox" class="checkbox" value="<?php echo $subject['id']?>" name="subject[]">
												<div class="checkbox-img"></div>
											</label>
											<div><?php echo $subject['name']; ?></div>
										</div>
									<?php
								}
								
							}
							else
							{
							?>
								<div class="col-lg-12 alert-msg" style="margin-top:5px;">
									Please Add Subjects. <a href="<?php echo base_url() ?>study/subject">Click Here</a> 
								</div>
							<?php
							}
							?>
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

						<?php
						}
						?>

						<?php echo form_close(); ?>

					</div><!-- end subject-form -->
				</div><!-- end display-div -->
			</div><!-- end col-lg-6 right-side -->


		</div><!-- end <div class="row"> -->
	</div>
</div>
<?php
}
?>	

<script type="text/javascript">
	
	$(".form-submit-btn").click(function(){

		if($("#standard_name").val() != "")
		{
			var flag_name = 1;
		}
		else
		{
			$("#standard_name").parent().addClass('has-error');
			var flag_name = 0;
		}

		if($("#course").val() != "")
		{
			var flag_course = 1;
		}
		else
		{
			$("#course").parent().addClass('test');
			var flag_course = 0;
		}

		if ($("#standard-form input:checkbox:checked").length > 0)
		{
		    flag_subject = 1;
		}
		else
		{
			flag_subject = 0;
			$('.msg').show();
			$('.msg').text("Please Select Subjects !");
			$('.msg').removeClass('success-msg');
			$('.msg').addClass('error-msg');
			$('.msg').delay(5000).fadeOut(1000);
			return false;
		   // none is checked
		}

		if(flag_name == 1 && flag_course == 1 && flag_subject == 1)
		{
			$("#standard-form").submit();
		}
		else
		{
			$('.msg').show();
			$('.msg').text("Please Enter All Fields Correct !");
			$('.msg').removeClass('success-msg');
			$('.msg').addClass('error-msg');
			$('.msg').delay(5000).fadeOut(1000);
		}

	});

	$(".search-standard").keyup(function(event) {

		var search_value = $.trim($(this).val());

		$.ajax({
			url: '<?php echo base_url();?>index.php/study/batch_search',
			type: 'POST',
			data: {search_standard: search_value},
			success: function(result){
				$(".view-grid").html(result);
				// alert(result);
			}
		});
	});

	<?php
	//execute after Course is successfully Added and show success msg.
  	// 
	if( $this->session->userdata('insert_standard') )
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
  	if( $this->session->userdata('update_standard') )
	{
	?>
		var id = "<?php echo $this->session->userdata('update_standard') ?>";
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
		$('.view-grid').animate({scrollTop:top_value}, 'slow');
  	
  	<?php
  	}
  	?>

</script>

<?php
$this->session->unset_userdata('update_standard');
$this->session->unset_userdata('insert_standard');
?>