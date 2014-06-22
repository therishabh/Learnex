<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Subject Setting
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-6">
				<a href="<?php echo base_url();?>study/subject"><div class="submit-btn">New Subject</div></a>
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
	
		<div class="col-manual-5 active">Subject</div>
	</a>
	<a href="<?php echo base_url();?>study/batch">
		<div class="col-manual-5">Batch</div>
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
						<input type="text" class="search-subject"  placeholder="Type subject Name..">
					</div>
				</div>
				<!-- // end search bar -->

				<div class="row section">
					<div class="col-lg-12" style="padding-right:0px;">		
						<div class="view-grid">

						<?php
						///execute if existed number of subject greater than 0
						///then display subject grid
						if($no_of_subject > 0)
						{
							$i = 1;
							foreach($subject_details as $subject)
							{

								$subject_id = $subject['id'];
								$subject_name = $subject['name'];
								$subject_topic = explode(',', $subject['topic']);
								sort($subject_topic);
								$number_of_topic = count($subject_topic);
								if($number_of_topic > 1)
								{
									$number_of_topic = $number_of_topic." Topics";
								}
								else
								{
									$number_of_topic = $number_of_topic." Topic";
								}

								//if select any Subject..
								if(isset($selected_subject) && $selected_subject != "")
								{
									//execute when selected_subject id is same as subject id.
									if($subject_id == $selected_subject['id'])
									{

										echo '<div class="row">
											<div class="col-lg-12 top-label">
												<div class="row">
													<div class="col-lg-6 location-name">'.$subject_name.'</div>
													<div class="col-lg-6 topic_number">'.$number_of_topic.'</div>
												</div>
											</div>
										</div>';

										echo '<div class="row">
												<div class="col-lg-12">
													<div class="bottom-label '.$i.' selected" id="'.$subject_id.'">
														<a href="'.base_url().'study/subject/'.$subject_id.'">
														<div class="row">';
															echo '<div class="col-lg-4 subject-topic">';
															for($a = 0; $a < count($subject_topic); $a++)
															{
																if($a < 2)
																{
																$topic_name = character_limiter($subject_topic[$a],12);
																echo $topic_name;
																echo "<br>";
																}
															}
															echo '</div>';

															echo '<div class="col-lg-4 subject-topic">';
															for($a = 0; $a < count($subject_topic); $a++)
															{
																if($a > 1 && $a < 4)
																{
																$topic_name = character_limiter($subject_topic[$a],12);
																echo $topic_name;
																echo "<br>";
																}
															}
															echo '</div>';

															echo '<div class="col-lg-4 subject-topic">';
															for($a = 0; $a < count($subject_topic); $a++)
															{
																if($a > 3 && $a < 6)
																{
																$topic_name = character_limiter($subject_topic[$a],12);
																echo $topic_name;
																echo "<br>";
																}
																
															}
															echo '</div>';
														
															?>

														</div><!-- end row -->
														</a>
													</div><!-- end bottom-label -->
												</div><!-- end col-lg-12 -->
											</div>
									<?php
									}// end if($subject_id == $selected_subject['id'])
									else
									{
										echo '<div class="row">
											<div class="col-lg-12 top-label">
												<div class="row">
													<div class="col-lg-6 location-name">'.$subject_name.'</div>
													<div class="col-lg-6 topic_number">'.$number_of_topic.'</div>
												</div>
											</div>
										</div>';

										echo '<div class="row">
												<div class="col-lg-12">
													<div class="bottom-label '.$i.'" id="'.$subject_id.'">
														<a href="'.base_url().'study/subject/'.$subject_id.'">
														<div class="row">';
															echo '<div class="col-lg-4 subject-topic">';
															for($a = 0; $a < count($subject_topic); $a++)
															{
																if($a < 2)
																{
																$topic_name = character_limiter($subject_topic[$a],12);
																echo $topic_name;
																echo "<br>";
																}
															}
															echo '</div>';

															echo '<div class="col-lg-4 subject-topic">';
															for($a = 0; $a < count($subject_topic); $a++)
															{
																if($a > 1 && $a < 4)
																{
																$topic_name = character_limiter($subject_topic[$a],12);
																echo $topic_name;
																echo "<br>";
																}
															}
															echo '</div>';

															echo '<div class="col-lg-4 subject-topic">';
															for($a = 0; $a < count($subject_topic); $a++)
															{
																if($a > 3 && $a < 6)
																{
																$topic_name = character_limiter($subject_topic[$a],12);
																echo $topic_name;
																echo "<br>";
																}
																
															}
															echo '</div>';
														
															?>

														</div><!-- end row -->
														</a>
													</div><!-- end bottom-label -->
												</div><!-- end col-lg-12 -->
											</div>
									<?php
									}//end else condition..
								}//end if(isset($selected_subject) && $selected_subject != "")
								//execute if there is no any subject selected..
								else
								{
									echo '<div class="row">
											<div class="col-lg-12 top-label">
												<div class="row">
													<div class="col-lg-6 location-name">'.$subject_name.'</div>
													<div class="col-lg-6 topic_number">'.$number_of_topic.'</div>
												</div>
											</div>
										</div>';

										echo '<div class="row">
												<div class="col-lg-12">
													<div class="bottom-label '.$i.'" id="'.$subject_id.'">
														<a href="'.base_url().'study/subject/'.$subject_id.'">
														<div class="row">';
															echo '<div class="col-lg-4 subject-topic">';
															for($a = 0; $a < count($subject_topic); $a++)
															{
																if($a < 2)
																{
																$topic_name = character_limiter($subject_topic[$a],12);
																echo $topic_name;
																echo "<br>";
																}
															}
															echo '</div>';

															echo '<div class="col-lg-4 subject-topic">';
															for($a = 0; $a < count($subject_topic); $a++)
															{
																if($a > 1 && $a < 4)
																{
																$topic_name = character_limiter($subject_topic[$a],12);
																echo $topic_name;
																echo "<br>";
																}
															}
															echo '</div>';

															echo '<div class="col-lg-4 subject-topic">';
															for($a = 0; $a < count($subject_topic); $a++)
															{
																if($a > 3 && $a < 6)
																{
																$topic_name = character_limiter($subject_topic[$a],12);
																echo $topic_name;
																echo "<br>";
																}
																
															}
															echo '</div>';
														
															?>

														</div><!-- end row -->
														</a>
													</div><!-- end bottom-label -->
												</div><!-- end col-lg-12 -->
											</div>
								<?php
								}//end else condition..
								$i++;
							} // end foreach loop foreach($subject_details as $subject)
						}//end if condition.. if($no_of_subject > 0)
						//execute if there is no any organization in database
						else
						{
							// error message when there is no any organizaion location
							echo '<div class="row">
									<div class="col-lg-12 alert-msg">
										No Subject Found In Database
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

				<div class="display-div subject">
						
					<div class="row" style="padding:6px 15px;">
						<div class="col-lg-12 location-heading">
							<div class="row">
								<!-- course form heading -->
								<div class="col-lg-4">
									<?php
									if( isset($selected_subject) && !empty($selected_subject) )
									{
										echo "Edit Subject";
									}
									else
									{
										echo "Add Subject";
									}
									?>
								</div>
								<!-- // end subject form heading -->
								<div class="col-lg-8 msg success-msg">
									<?php
									if( $this->session->userdata('insert_subject') != "" )
									{
										echo "Subject Has Been Successfully Added.";
									}
									else if( $this->session->userdata('update_subject') != "" )
									{
										echo "Subject Has Been Successfully Updated.";
									}
									?>
								</div>
							</div>
						</div>
					</div>

					<div class="subject-form">
						<?php echo form_open('study/subject','id="subject-form"'); ?>
						
						<?php
						//execute if any organization selected for updation..
						//then display editable mode form..
						if( isset($selected_subject) && !empty($selected_subject) )
						{
						?>
						<!-- academic year and course name section -->
						<div class="row">
							<div class="col-lg-10 col-centered">
								<div class="label-text">Subject Name :</div>
								<div>
									<input type="text" id="subject_name" class="form-control" name="subject_name" value="<?php echo $selected_subject['name']?>" placeholder="Type Subject Name..">
								</div>
							</div>
							
						</div>
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-10 col-centered">
								<div class="label-text">Subject Topics :</div>
								<div>
									<input type="text" value="<?php echo $selected_subject['topic']?>" id="subject_topics" data-role="tagsinput" placeholder="Add Title.."/>
									<div class="topic_div" style="display:none;"></div>
								</div>
							</div>
							
						</div>
						<!-- // end academic year and course name section -->

						<!-- save and cancle button -->
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-3 col-lg-offset-3">
								<input type="hidden" name="update_btn" value="success">
								<input type="hidden" name="topic" id="topic" value="">
								<input type="hidden" name="subject_id" value="<?php echo $selected_subject['id']; ?>">
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
						<!-- academic year and course name section -->
						<div class="row">
							<div class="col-lg-10 col-centered">
								<div class="label-text">Subject Name :</div>
								<div>
									<input type="text" id="subject_name" class="form-control" name="subject_name" placeholder="Type Subject Name..">
									
								</div>
							</div>
						</div>

						<div class="row" style="margin-top:15px;">
							<div class="col-lg-10 col-centered">
								<div class="label-text">Subject Topics :</div>
								<div>
									<input type="text" value="" id="subject_topics" data-role="tagsinput" placeholder="Add Title.."/>
									<div class="topic_div" style="display:none;"></div>
								</div>
							</div>
							
						</div>
						<!-- // end academic year and course name section -->

						<!-- save and cancle button -->
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-3 col-lg-offset-3">
								<input type="hidden" name="insert_btn" value="success">
								<input type="hidden" name="topic" id="topic" value="">
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

					</div>
				
				</div>
			</div>




		</div><!-- end <div class="row"> -->
	</div>
</div>
<?php
}

?>


<script type="text/javascript">
jQuery(document).ready(function($) {
	
		// execute script when user want to search location
	$(".search-subject").keyup(function(event) {

		var search_value = $.trim($(this).val());

		$.ajax({
			url: '<?php echo base_url();?>index.php/study/subject_search',
			type: 'POST',
			data: {search_subject: search_value},
			success: function(result){
				$(".view-grid").html(result);
				// alert(result);
			}
		});
	});

	$(".subject-form").on('focus', '.bootstrap-tagsinput input[type="text"]', function() {
		$(".bootstrap-tagsinput").css({
			borderColor: 'rgba(82, 168, 236, 0.8)',
			'-webkit-box-shadow':'inset 0 1px 1px rgba(0, 0, 0, 0.075),0 0 8px rgba(82, 168, 236, 0.6)',
			'box-shadow':'inset 0 1px 1px rgba(0, 0, 0, 0.075),0 0 8px rgba(82, 168, 236, 0.6)',
			'-moz-box-shadow':'inset 0 1px 1px rgba(0, 0, 0, 0.075),0 0 8px rgba(82, 168, 236, 0.6)',
			'outline':'0'
		});
		/* Act on the event */
	});

	$(".subject-form").on('focusout', '.bootstrap-tagsinput input[type="text"]', function() {
		$(".bootstrap-tagsinput").css({
			borderColor: '#ccc',
			'-webkit-box-shadow':'none',
			'box-shadow':'none',
			'-moz-box-shadow':'none',
			'outline':'0'
		});
		/* Act on the event */
	});

	$(".form-submit-btn").click(function() {
		$("#topic").val("");
		var subject_name = $("#subject_name").val();
		if(subject_name != "")
		{
			$(".label-info").each(function(){
				$(".topic_div").append( $(this).text()+"," );
			});
			
			$("#topic").val( $(".topic_div").text() )
			if( $("#topic").val() == "" )
			{
				if( $(".bootstrap-tagsinput input").val() == "" )
				{
					 $(".bootstrap-tagsinput").css({
					 	border: '1px solid #a94442'
					 });;
					
				}
				else
				{
					$("#topic").val( $(".bootstrap-tagsinput input").val() );
					$("#subject-form").submit();
				}
			}
			else
			{
				$("#subject-form").submit();
			}

		}
		else
		{
			$("#subject_name").parent().addClass('has-error');

		}
	});

	$(".subject").on('focusin', '#subject_name', function() {
		$("#subject_name").parent().removeClass('has-error');
	});


	<?php
	//execute after Course is successfully Added and show success msg.
  	// 
	if( $this->session->userdata('insert_subject') )
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
  	if( $this->session->userdata('update_subject') )
	{
	?>
		var id = "<?php echo $this->session->userdata('update_subject') ?>";
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

});
</script>

<?php
$this->session->unset_userdata('update_subject');
$this->session->unset_userdata('insert_subject');
?>