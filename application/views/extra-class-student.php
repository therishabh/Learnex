<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Extra Class
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-6">
				<a href="<?php echo base_url();?>news"><div class="submit-btn">Add Extra Class</div></a>
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
			There is no any organization so first you cannot Access This Facility.
		</div>
	</div>
	
<?php
}
//if organization is exist in database..
else{
?>
<div id="view_status" class="hidden"><?php echo $view_status; ?></div>
<div class="row extra-class">
	<div class="col-lg-12">
		<div class="row">

			<!-- left hand site division -->
			<div class="col-lg-6 left-side">
	
				<div class="row left-nav">
					<div class="col-lg-3 running-btn selected">Running</div>
					<div class="col-lg-3 pending-btn">Pending</div>
					<div class="col-lg-3 own-btn">Own</div>
					<div class="col-lg-3 enroll-btn">Enrolled</div>
				</div>

				<!-- search bar -->
				<div class="row">
					<div class="col-lg-4 search-bar">
						<input type="text" class="code-search"  placeholder="Class Code..">
					</div>
					<div class="col-lg-4 search-bar">
						<select name="" class="subject-search">
							<option value="">Select Subject</option>
							<?php
							$subject = explode("/", $subject_string);
							foreach ($subject as $subject_id) {
							 	$subject_detail = $this->user_model->fetchbyid($subject_id,"subject");
							 	echo '<option value = "'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
							 	$subject_array[] = $subject_detail['id'];
							 } 
							?>
						</select>
					</div>

					<div class="col-lg-4 search-bar" style="padding-left:0px;">
						<select name="" class="topic-search">
							<option value="">Select Topic</option>
						</select>
					</div>
					
				</div>
				<!-- // end search bar -->

				<div class="row section">
					<div class="col-lg-12" style="padding-right:0px;">		
						<div class="view-grid" id="running-classes">
						
							<?php
							//execute if there is any running extra classes..! 
							if (is_array($running_extra_class[0])) 
							{
								$p = 1;
								foreach ($running_extra_class as $extra_class) 
								{	
									//display only those extra classs those subject is matched..
									if(in_array($extra_class['subject'],$subject_array))
									{					
										$subject_detail = $this->user_model->fetchbyid($extra_class['subject'],'subject');
										$teacher_detail = $this->user_model->fetchbyid($extra_class['teacher'],'staff');
										$start_date = date("jS, F Y",strtotime($extra_class['start_date']));
										$end_date = date("jS, F Y",strtotime($extra_class['end_date']));
										$number_of_batchmates = $this->user_model->fetch_batchment($extra_class['code'],$user_detail['batch']);
								?>
								<div class="left-blog">
									<!-- extra class code and total student section -->
									<div class="row">
										<div class="col-lg-12 top-label" style="background:#168039 !important;">
											<div class="row">
												<div class="col-lg-4 class-code" title="Extra Class Code">
													<?php echo $extra_class['code']; ?>			
												</div>

												<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
													Batchmates : <?php echo $number_of_batchmates; ?>							
												</div>
												<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
													Total Student : <?php echo $extra_class['num_of_student']; ?>									
												</div>
											</div>
										</div>
									</div>
									<!-- // end extra class code and total student section -->
									
									<!-- start bottom-label -->
									<div class="bottom-label <?php echo $p; ?>"  id="<?php echo $extra_class['id']; ?>">
										<div class="row">
											<div class="col-lg-4">
												<div class="popover-options">
													<div class="show-tooltip" data-toggle="popover" data-content="Subject Name"><?php echo $subject_detail['name']; ?></div>
												</div>
												<div class="popover-options">
													<div data-toggle="popover" data-content="Start Date" class="show-tooltip"><?php echo $start_date; ?></div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="popover-options">
													<div class="show-tooltip" data-toggle="popover" data-content="<?php echo $extra_class['topic']; ?>" title="Topic Name" style="text-align:center;"><?php echo character_limiter($extra_class['topic'],12); ?></div>
												</div>
												<div class="popover-options">
													<div data-toggle="popover" data-content="End Date" class="show-tooltip" style="text-align:center"><?php echo $end_date; ?></div>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="popover-options">
													<div data-toggle="popover" data-content="Teacher Name" class="show-tooltip" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
												</div>
												<div class="popover-options">
													<div data-toggle="popover" data-content="Timing" class="show-tooltip" style="text-align:center"><?php echo $extra_class['timing']; ?></div>
												</div>
											</div>
										</div>
									</div>
									<!-- // end bottom-label -->

								</div>
							<?php			
								$p++;	
									}//end if condition..
								}//end foreach loop
							}//end if condition
							else{

								// error message when there is no any organizaion location
								echo '<div class="row">
									<div class="col-lg-12 alert-msg">
										There is no any Running Class..!
									</div>
								</div>';
								// end error message when there is no any organizaion location
							}
							?>

						</div><!-- end view-grid running-classes -->

						<div class="hidden number_of_running"><?php echo --$p; ?></div>
					
						<div class="view-grid" id="pending-classes">
						<?php
						//execute if there is any extra classes created by login user..! 
						if (is_array($pending_extra_class[0])) 
						{
							$q = 1;
							foreach ($pending_extra_class as $pending_class) 
							{	
								//display only those extra classs those subject is matched..
								if(in_array($pending_class['subject'],$subject_array))
								{					
									$subject_detail = $this->user_model->fetchbyid($pending_class['subject'],'subject');
									$teacher_detail = $this->user_model->fetchbyid($pending_class['teacher'],'staff');
									$start_date = date("jS, F Y",strtotime($pending_class['start_date']));
									$end_date = date("jS, F Y",strtotime($pending_class['end_date']));
									$number_of_batchmates = $this->user_model->fetch_batchment($pending_class['code'],$user_detail['batch']);
							?>
							<div class="left-blog">
								<!-- extra class code and total student section -->
								<div class="row">
									<div class="col-lg-12 top-label" style="background:#F04E41 !important;">
										<div class="row">
											<div class="col-lg-4 class-code" title="Extra Class Code">
												<?php echo $pending_class['code']; ?>										
											</div>

											<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
												Batchmates : <?php echo $number_of_batchmates; ?>							
											</div>
											<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
												Total Student : <?php echo $pending_class['num_of_student']; ?>									
											</div>
										</div>
									</div>
								</div>
								<!-- // end extra class code and total student section -->
								
								<!-- start bottom-label -->
								<div class="bottom-label <?php echo $q; ?>" id="<?php echo $pending_class['id']; ?>">
									<div class="row">
										<div class="col-lg-4">
											<div class="popover-options">
												<div class="show-tooltip"  data-container="body" data-toggle="popover" data-content="Subject Name">
											         <?php echo $subject_detail['name']; ?>
											     </div>
										     </div>
										</div>
										<div class="col-lg-4">
											<div class="popover-options">
											<div class="show-tooltip" title="Topic Name" data-toggle="popover" data-content="<?php echo $pending_class['topic']; ?>" style="text-align:center;"><?php echo character_limiter($pending_class['topic'],12); ?></div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="popover-options">
											<div class="show-tooltip" data-toggle="popover" data-content="Teacher Name" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
											</div>
										</div>
									</div>
								</div>
								<!-- // end bottom-label -->

							</div>
								<?php	
								$q++;			 
								}// end if condition 
							}//end foreach loop
						}//end if condition
						else{

							// error message when there is no any organizaion location
							echo '<div class="row">
								<div class="col-lg-12 alert-msg">
									There is No any Pending Class..!
								</div>
							</div>';
							// end error message when there is no any organizaion location
						}
						?>

						</div><!-- end view-grid pending-classes -->
						<div class="hidden number_of_pending"><?php echo --$q; ?></div>

						<div class="view-grid" id="own-classes">
							<?php
							//execute if there is any running extra classes..! 
							if (is_array($own_extra_class[0])) 
							{
								$a = 1;
								foreach ($own_extra_class as $own_class) 
								{	
									//display only those extra classs those subject is matched..
									if(in_array($own_class['subject'],$subject_array))
									{					
										$subject_detail = $this->user_model->fetchbyid($own_class['subject'],'subject');
										$teacher_detail = $this->user_model->fetchbyid($own_class['teacher'],'staff');
										$start_date = date("jS, F Y",strtotime($own_class['start_date']));
										$end_date = date("jS, F Y",strtotime($own_class['end_date']));
										$number_of_batchmates = $this->user_model->fetch_batchment($own_class['code'],$user_detail['batch']);
										//execute if extra class status is running..
										if($own_class['allow'] == "1")
										{
										?>
											<div class="left-blog">
												<!-- extra class code and total student section -->
												<div class="row">
													<div class="col-lg-12 top-label" style="background:#168039 !important;">
														<div class="row">
															<div class="col-lg-4 class-code" title="Extra Class Code">
																<?php echo $own_class['code']; ?>										
															</div>

															<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
																Batchmates : <?php echo $number_of_batchmates; ?>							
															</div>
															<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
																Total Student : <?php echo $own_class['num_of_student']; ?>									
															</div>
														</div>
													</div>
												</div>
												<!-- // end extra class code and total student section -->
												
												<!-- start bottom-label -->
												<div class="bottom-label <?php echo $a; ?>" id="<?php echo $own_class['id']; ?>">
													<div class="row">
														<div class="col-lg-4">
															<div class="popover-options">
																<div class="show-tooltip" data-toggle="popover" data-content="Subject Name"><?php echo $subject_detail['name']; ?></div>
															</div>
															<div class="popover-options">
																<div data-toggle="popover" data-content="Start Date" class="show-tooltip"><?php echo $start_date; ?></div>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="popover-options">
																<div class="show-tooltip" data-toggle="popover" data-content="<?php echo $own_class['topic']; ?>" title="Topic Name" style="text-align:center;"><?php echo character_limiter($own_class['topic'],12); ?></div>
															</div>
															<div class="popover-options">
																<div data-toggle="popover" data-content="End Date" class="show-tooltip" style="text-align:center;"><?php echo $end_date; ?></div>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="popover-options">
																<div data-toggle="popover" data-content="Teacher Name" class="show-tooltip" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
															</div>
															<div class="popover-options">
																<div data-toggle="popover" data-content="Timing" class="show-tooltip" style="text-align:center"><?php echo $own_class['timing']; ?></div>
															</div>
														</div>
													</div>
												</div>
												<!-- // end bottom-label -->

											</div>
										<?php
										}//end if condition if($own_class['allow'] == "1")
										//execute if extra class status is pending..
										else
										{
										?>
											<div class="left-blog">
												<!-- extra class code and total student section -->
												<div class="row">
													<div class="col-lg-12 top-label" style="background:#F04E41 !important;">
														<div class="row">
															<div class="col-lg-4 class-code" title="Extra Class Code">
																<?php echo $own_class['code']; ?>										
															</div>

															<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
																Batchmates : <?php echo $number_of_batchmates; ?>							
															</div>
															<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
																Total Student : <?php echo $own_class['num_of_student']; ?>									
															</div>
														</div>
													</div>
												</div>
												<!-- // end extra class code and total student section -->
												
												<!-- start bottom-label -->
												<div class="bottom-label <?php echo $a; ?>" id="<?php echo $own_class['id']; ?>">
													<div class="row">
														<div class="col-lg-4">
															<div class="popover-options">
																<div class="show-tooltip"  data-container="body" data-toggle="popover" data-content="Subject Name">
															         <?php echo $subject_detail['name']; ?>
															     </div>
														     </div>
														</div>
														<div class="col-lg-4">
															<div class="popover-options">
															<div class="show-tooltip" title="Topic Name" data-toggle="popover" data-content="<?php echo $own_class['topic']; ?>" style="text-align:center;"><?php echo character_limiter($own_class['topic'],12); ?></div>
															</div>
														</div>
														<div class="col-lg-4">
															<div class="popover-options">
															<div class="show-tooltip" data-toggle="popover" data-content="Teacher Name" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
															</div>
														</div>
													</div>
												</div>
												<!-- // end bottom-label -->

											</div>
										<?php
										}//end else condition..	
									$a++;
									}//end if condition..			 
								}//end foreach loop
							}//end if condition
							else{

								// error message when there is no any organizaion location
								echo '<div class="row">
									<div class="col-lg-12 alert-msg">
										There is No any Class Created by You..!
									</div>
								</div>';
								// end error message when there is no any organizaion location
							}
							?>
						</div>
						<div class="hidden number_of_own"><?php echo --$a; ?></div>

						<div class="view-grid" id="enroll-classes">
						<?php
						//execute if there is any extra classes enrolled by login user..! 
						if (is_array($enroll_extra_class[0])) 
						{
							$x = 1;
							foreach ($enroll_extra_class as $enroll_class) 
							{
								$enroll_class_code = $enroll_class['class_code'];
								$enroll_class_detail = $this->user_model->fetchbyfield('code',$enroll_class_code,'extra_class');
								
								//display only those extra classs those subject is matched..
								if(in_array($enroll_class_detail['subject'],$subject_array))
								{
								
									$subject_detail = $this->user_model->fetchbyid($enroll_class_detail['subject'],'subject');
									$teacher_detail = $this->user_model->fetchbyid($enroll_class_detail['teacher'],'staff');
									$start_date = date("jS, F Y",strtotime($enroll_class_detail['start_date']));
									$end_date = date("jS, F Y",strtotime($enroll_class_detail['end_date']));
									$number_of_batchmates = $this->user_model->fetch_batchment($enroll_class_detail['code'],$user_detail['batch']);

									//execute if extra class status is running..
									if($enroll_class_detail['allow'] == "1")
									{
									?>
									<div class="left-blog">
										<!-- extra class code and total student section -->
										<div class="row">
											<div class="col-lg-12 top-label" style="background:#168039 !important;">
												<div class="row">
													<div class="col-lg-4 class-code" title="Extra Class Code">
														<?php echo $enroll_class_detail['code']; ?>										
													</div>

													<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
														Batchmates : <?php echo $number_of_batchmates; ?>								
													</div>
													<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
														Total Student : <?php echo $enroll_class_detail['num_of_student']; ?>									
													</div>
												</div>
											</div>
										</div>
										<!-- // end extra class code and total student section -->
										
										<!-- start bottom-label -->
										<div class="bottom-label <?php echo $x; ?>" id="<?php echo $enroll_class_detail['id']; ?>">
											<div class="row">
												<div class="col-lg-4">
													<div class="popover-options">
														<div class="show-tooltip" data-toggle="popover" data-content="Subject Name"><?php echo $subject_detail['name']; ?></div>
													</div>
													<div class="popover-options">
														<div data-toggle="popover" data-content="Start Date" class="show-tooltip"><?php echo $start_date; ?></div>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="popover-options">
														<div class="show-tooltip" data-toggle="popover" data-content="<?php echo $enroll_class_detail['topic']; ?>" title="Topic Name" style="text-align:center;"><?php echo character_limiter($enroll_class_detail['topic'],12); ?></div>
													</div>
													<div class="popover-options">
														<div data-toggle="popover" data-content="End Date" class="show-tooltip" style="text-align:center;"><?php echo $end_date; ?></div>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="popover-options">
														<div data-toggle="popover" data-content="Teacher Name" class="show-tooltip" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
													</div>
													<div class="popover-options">
														<div data-toggle="popover" data-content="Timing" class="show-tooltip" style="text-align:center"><?php echo $enroll_class_detail['timing']; ?></div>
													</div>
												</div>
											</div>
										</div>
										<!-- // end bottom-label -->

									</div>
									<?php
									}//end if condition if($own_class['allow'] == "1")
									//execute if extra class status is pending..
									else
									{
									?>
									<div class="left-blog">
										<!-- extra class code and total student section -->
										<div class="row">
											<div class="col-lg-12 top-label" style="background:#F04E41 !important;">
												<div class="row">
													<div class="col-lg-4 class-code" title="Extra Class Code">
														<?php echo $enroll_class_detail['code']; ?>										
													</div>

													<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
														Batchmates : <?php echo $number_of_batchmates; ?>								
													</div>
													<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
														Total Student : <?php echo $enroll_class_detail['num_of_student']; ?>									
													</div>
												</div>
											</div>
										</div>
										<!-- // end extra class code and total student section -->
										
										<!-- start bottom-label -->
										<div class="bottom-label <?php echo $x; ?>" id="<?php echo $enroll_class_detail['id']; ?>">
											<div class="row">
												<div class="col-lg-4">
													<div class="popover-options">
														<div class="show-tooltip"  data-container="body" data-toggle="popover" data-content="Subject Name">
													         <?php echo $subject_detail['name']; ?>
													     </div>
												     </div>
												</div>
												<div class="col-lg-4">
													<div class="popover-options">
													<div class="show-tooltip" title="Topic Name" data-toggle="popover" data-content="<?php echo $enroll_class_detail['topic']; ?>" style="text-align:center;"><?php echo character_limiter($enroll_class_detail['topic'],12); ?></div>
													</div>
												</div>
												<div class="col-lg-4">
													<div class="popover-options">
													<div class="show-tooltip" data-toggle="popover" data-content="Teacher Name" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
													</div>
												</div>
											</div>
										</div>
										<!-- // end bottom-label -->

									</div>
									<?php
									}//end else condition..
								$x++;
								}//end if condition..
							}//end foreach loop3

						}//end if condition
						else
						{
							// error message when there is no any organizaion location
							echo '<div class="row">
								<div class="col-lg-12 alert-msg">
									There is No any Class Enrolled by You..!
								</div>
							</div>';
							// end error message when there is no any organizaion location
						}
						?>
						</div>
						<div class="hidden number_of_enroll"><?php echo --$x; ?></div>
					</div><!-- end  class="col-lg-12" -->
				</div><!-- end row section -->

			</div><!-- // end<div class="col-lg-6 left-side"> -->
			<!-- // end left hand site division -->


			<!-- right-side div -->
			<div class="col-lg-6 right-side">
				<div class="display-div">

					<div class="row" style="padding:6px 15px;">
						<div class="col-lg-12 location-heading">
							<div class="row">
								<!-- course form heading -->
								<div class="col-lg-4 right-heading">
									Add Extra Class
								</div>
								<!-- // end subject form heading -->
								<div class="col-lg-7 msg success-msg">
									<?php 
									if( $this->session->userdata('insert_class') != "" )
									{
										echo "Extra Class Has Been Successfully Added.";
									}
									?>
									<span class="enrolled">Enrolled</span>
								</div><!-- end success msg -->
								<div class="col-lg-1 edit">
								</div>

							</div><!-- // end row -->
						</div><!-- // end col-lg-12 -->
					</div>
					<div class="class-right-div">
						<?php echo form_open('extraclass','id="extra-class-form"');?>
						<div class="row">
							<div class="col-lg-10 col-centered">
								<div class="row">
									<div class="col-lg-4 label-text">Subject</div>
									<div class="col-lg-8">
										<select name="subject" class="form-control" id="subject">
											<option value="">Select Subject</option>
											<?php
											$subject = explode("/", $subject_string);
											foreach ($subject as $subject_id) {
											 	$subject_detail = $this->user_model->fetchbyid($subject_id,"subject");
											 	echo '<option value = "'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
											 } 
											?>
										</select>
									</div>
								</div>

								<div class="row" style="margin-top:15px;">
									<div class="col-lg-4 label-text">Topic</div>
									<div class="col-lg-8">
										<select name="topic" class="form-control" id="topic">
											<option value="">Select Topic</option>
										</select>
									</div>
								</div>
								
								<div class="already-class">
									<div class="row" style="margin-top:15px;">
										<div class="col-lg-6 label-text">Already Existing Class</div>
										<div class="col-lg-6 view-full-detail" data-toggle="modal" data-target=".already-exist-modal">View Full Detail</div>
									</div>
									<div style="margin-top:10px;">
										<table class="exist-class">
												<thead>
													<tr>
														<td>S.No</td>
														<td></td>
														<td>Class</td>
														<td title="Enrolled Student">Student</td>
														<td>Operation</td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>1</td>
														<td><span class="running"></span></td>
														<td>Extra_1010</td>
														<td>10</td>
														<td><span class="enroll">Enroll</span></td>
													</tr>
													<tr>
														<td>2</td>
														<td><span class="pending"></span></td>
														<td>Extra_1010</td>
														<td>10</td>
														<td><span class="enrolled">Enrolled</span></td>
													</tr>
													<tr>
														<td>3</td>
														<td><span class="running"></span></td>
														<td>Extra_1010</td>
														<td>10</td>
														<td><span class="enroll">Enroll</span></td>
													</tr>
												</tbody>
											</table>
									</div>
									<div class="pending-running">
										<span></span> Pending
										<span></span> Running
									</div>
								</div>


								<div class="row" style="margin-top:15px;">
									<div class="col-lg-4 label-text">Prefrable Teacher</div>
									<div class="col-lg-8">
										<select name="teacher" class="form-control" id="teacher">
											<option value="">Select Teacher</option>
											<?php
											foreach ($all_teachers_detail as $teacher) {
												echo '<option value="'.$teacher['id'].'">'.$teacher['name'].'</option>';
											}
											?>
										</select>
									</div>
								</div>

								<div class="row" style="margin-top:15px;">
									<div class="col-lg-4 label-text">Comment</div>
									<div class="col-lg-8">
										<textarea name="comment" class="form-control" id="comment"  rows="5"></textarea>
									</div>
								</div>
							</div>
						</div>

						<!-- save and cancle button -->
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-3 col-lg-offset-3">
								<input type="hidden" name="insert_btn" value="success">
								<div class="submit-btn form-submit-btn save-btn" data-loading-text="Loading...">Save</div>
							</div>
							<div class="col-lg-3">
								<div class="cancel-btn" id="reset">Cancel</div>
							</div>
						</div>
						<!-- //end save and cancle button -->

						<?php echo form_close(); ?>

					</div><!-- // end assignment-right-div -->


				</div>

			</div>
			<!-- // end right-side div -->

		</div>
	</div>
</div>

<!-- modal for view already exist extra classes -->
<div class="modal fade already-exist-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" style=" width: 80%; ">
    <div class="modal-content" style="width:100%;">
      <div class="row">
    		<div class="col-lg-12">
		      	<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				    <h4 class="modal-title">Already Existing Class</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-lg-6 subject">
							<span>Subject: </span>
							<span>Subject Name</span>
						</div>
						<div class="col-lg-6 topic">
							<span>Topic: </span>
							<span>Topic Name</span>
						</div>
					</div>
					<table>
						<thead>
						<tr>
							<td>S.No</td>
							<td></td>
							<td>Class</td>
							<td title="Enrolled Student">Student</td>
							<td>Batchmates</td>
							<td>Teacher</td>
							<td>Start Date</td>
							<td>End Date</td>
							<td>Timming</td>
							<td>Operation</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td><span class="running"></span></td>
							<td>Extra_1010</td>
							<td>40</td>
							<td>14</td>
							<td>Rishabh Agrawal</td>
							<td>14th July</td>
							<td>20th July</td>
							<td>05:00 - 06:00</td>
							<td><span class="enroll">Enroll</span></td>
						</tr>
						<tr>
							<td>2</td>
							<td><span class="pending"></span></td>
							<td>Extra_1010</td>
							<td>14</td>
							<td>1</td>
							<td>--</td>
							<td>--</td>
							<td>--</td>
							<td>--</td>
							<td><span class="enrolled">Enrolled</span></td>
						</tr>
						<tr>
							<td>3</td>
							<td><span class="running"></span></td>
							<td>Extra_1010</td>
							<td>18</td>
							<td>8</td>
							<td>Ram Kumar Mishra</td>
							<td>13th July</td>
							<td>24th July</td>
							<td>05:30 - 06:30</td>
							<td><span class="enroll">Enroll</span></td>
						</tr>
					</tbody>
					</table>
					<div class="pending-running">
						<span></span> Pending
						<span></span> Running
					</div>
				</div>
    		</div>
    	</div>
    </div>
  </div>
</div>
<!-- // modal for view already exist extra classes -->



<?php 
}
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	// $(".already-class").hide();

	$("#pending-classes").hide();
	$("#own-classes").hide();
	$("#enroll-classes").hide();

	$(".running-btn").text("Running ("+($(".number_of_running").text())+")") ;
	$(".pending-btn").text("Pending ("+($(".number_of_pending").text())+")") ;
	$(".own-btn").text("Own ("+($(".number_of_own").text())+")") ;
	$(".enroll-btn").text("Enrolled ("+($(".number_of_enroll").text())+")") ;
	

	 // $('.popover-options a').popover('show');
	$(".popover-options div").popover({
		html : true,
		trigger : 'hover',
		placement : 'top'
	});



	$(".subject-search").change(function() {
		var subject_id = $(this).val();
		var topic = $(".topic-search").val();
		var code = $(".code-search").val();
		var status = $("#view_status").text();

		//update topic in search bar..
		$.ajax({
			url: "<?php echo base_url();?>index.php/extraclass/selectsubject",
			type: 'POST',
			data: {subject_id:subject_id},
			success: function(result){
				// alert(result);
				$(".topic-search").html(result);
			}
		});

		$.ajax({
			url: "<?php echo base_url();?>index.php/extraclass/class_search",
			type: 'POST',
			data: {subject_id:subject_id, topic:topic, code:code, status:status},
			success: function(result){
				// alert(result);
				if(status == 1)
				{
					$("#running-classes").html(result);
				}
				else if(status == 2)
				{
					$("#pending-classes").html(result);
				}
				else if(status == 3)
				{
					$("#own-classes").html(result);
				}
				else if(status == 4)
				{
					$("#enroll-classes").html(result);
				}
			}
		});
		
	});

	$(".code-search").keyup(function() {
		var code = $(this).val();
		var topic = $(".topic-search").val();
		var subject_id = $(".subject-search").val();
		var status = $("#view_status").text();

		$.ajax({
			url: "<?php echo base_url();?>index.php/extraclass/class_search",
			type: 'POST',
			data: {subject_id:subject_id, topic:topic, code:code, status:status},
			success: function(result){
				// alert(result);
				if(status == 1)
				{
					$("#running-classes").html(result);
				}
				else if(status == 2)
				{
					$("#pending-classes").html(result);
				}
				else if(status == 3)
				{
					$("#own-classes").html(result);
				}
				else if(status == 4)
				{
					$("#enroll-classes").html(result);
				}
			}
		});
		
	});

	$(".topic-search").change(function() {
		var topic = $(this).val();
		var code = $(".code-search").val();
		var subject_id = $(".subject-search").val();
		var status = $("#view_status").text();

		$.ajax({
			url: "<?php echo base_url();?>index.php/extraclass/class_search",
			type: 'POST',
			data: {subject_id:subject_id, topic:topic, code:code, status:status},
			success: function(result){
				// alert(result);
				if(status == 1)
				{
					$("#running-classes").html(result);
				}
				else if(status == 2)
				{
					$("#pending-classes").html(result);
				}
				else if(status == 3)
				{
					$("#own-classes").html(result);
				}
				else if(status == 4)
				{
					$("#enroll-classes").html(result);
				}
			}
		});
		
	});


	$("#subject").change(function() {
		var subject_id = $(this).val();
		$.ajax({
			url: "<?php echo base_url();?>index.php/extraclass/selectsubject",
			type: 'POST',
			data: {subject_id:subject_id},
			success: function(result){
				// alert(result);
				$("#topic").html(result);
			}
		});
	});

	$(".extra-class").on('click', '.form-submit-btn', function() {
		if( $("#subject").val() != "" )
		{
			flag_subject = 1
		}
		else
		{
			$("#subject").parent().addClass('has-error');
			flag_subject = 0;
		}

		if( $("#topic").val() != "" )
		{
			flag_topic = 1
		}
		else
		{
			$("#topic").parent().addClass('has-error');
			flag_topic = 0;
		}

		if( $("#teacher").val() != "" )
		{
			flag_teacher = 1
		}
		else
		{
			$("#teacher").parent().addClass('has-error');
			flag_teacher = 0;
		}

		if(flag_subject == 1 && flag_topic == 1 && flag_teacher == 1)
		{
			$(this).removeClass('form-submit-btn');
			$("#extra-class-form").submit();
		}
	});

	$(".extra-class").on('focusin', '.has-error', function(event) {
		$(this).removeClass('has-error');
	});


	$(".running-btn").click(function() {
		$(".left-nav div").removeClass('selected');
		$(this).addClass('selected');
		$("#pending-classes").hide();
		$("#own-classes").hide();
		$("#enroll-classes").hide();
		$("#running-classes").fadeIn(1000);
		// update view status..
		$("#view_status").text('1');
		//reset filter option..
		$(".code-search").val("");
		$(".subject-search").prop('selectedIndex',0);
		$(".topic-search").prop('selectedIndex',0);
	});

	$(".pending-btn").click(function() {
		$(".left-nav div").removeClass('selected');
		$(this).addClass('selected');
		$("#running-classes").hide();
		$("#own-classes").hide();
		$("#enroll-classes").hide();
		$("#pending-classes").fadeIn(1000);

		// update view status..
		$("#view_status").text('2');
		//reset filter option..
		$(".code-search").val("");
		$(".subject-search").prop('selectedIndex',0);
		$(".topic-search").prop('selectedIndex',0);
	});

	$(".own-btn").click(function() {
		$(".left-nav div").removeClass('selected');
		$(this).addClass('selected');
		$("#pending-classes").hide();
		$("#enroll-classes").hide();
		$("#running-classes").hide();
		$("#own-classes").fadeIn(1000);
		// update view status..
		$("#view_status").text('3');
		//reset filter option..
		$(".code-search").val("");
		$(".subject-search").prop('selectedIndex',0);
		$(".topic-search").prop('selectedIndex',0);
	});

	$(".enroll-btn").click(function() {
		$(".left-nav div").removeClass('selected');
		$(this).addClass('selected');
		$("#pending-classes").hide();
		$("#own-classes").hide();
		$("#running-classes").hide();
		$("#enroll-classes").fadeIn(1000);
		// update view status..
		$("#view_status").text('4');
		//reset filter option..
		$(".code-search").val("");
		$(".subject-search").prop('selectedIndex',0);
		$(".topic-search").prop('selectedIndex',0);
	});


	//execute code when new classs is added into database..
	<?php 
	if( $this->session->userdata('insert_class') )
	{
	?>
		$(".left-nav div").removeClass('selected');
		$(".own-btn").addClass('selected');
		$("#pending-classes").hide();
		$("#enroll-classes").hide();
		$("#running-classes").hide();
		$("#own-classes").fadeIn("1000");
		// update view status..
		$("#view_status").text('3');

		//reset filter option..
		$(".code-search").val("");
		$(".subject-search").prop('selectedIndex',0);
		$(".topic-search").prop('selectedIndex',0);

		$(".1").css({
			backgroundColor: 'rgb(142, 213, 114)'
		});

		$(".1").animate({
	    	backgroundColor:"#fff"
	  	},9000);
		
		$(".success-msg").delay(5000).fadeOut(1000);
	<?php
	}
	 ?>

});

</script>

<?php 
$this->session->unset_userdata('insert_class');
?>


