<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Course Setting
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-6">
				<a href="<?php echo base_url();?>study/course"><div class="submit-btn">New Course</div></a>
			</div>
		</div>
	</div>
</div>
<!-- // end heading -->

<!-- navigation top bar -->
<div class="row nav">
	<a href="<?php echo base_url();?>study/course">
		<div class="col-manual-5 active">Course</div>
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
						<input type="text" class="search-course"  placeholder="Type Course Name..">
					</div>
				</div>
				<!-- // end search bar -->

				<div class="row section">
					<div class="col-lg-12" style="padding-right:0px;">		
						<div class="course-grid">
						<?php
						///execute if existed number of course greater than 0
						///then display course grid
						if($no_of_course > 0)
						{
							$i = 1;
							foreach($course_details as $course)
							{

								$course_id = $course['id'];
								$course_name = $course['name'];
								$course_fee = $course['fee'];
								$course_net_fee = $course['net_fee_amount'];
								$discount_mode = $course['discount_mode'];
								$discount_amount = $course['discount_amount'];
								$num_of_instalment = $course['no_of_instalment'];
								//if select any course..
								if(isset($selected_course) && $selected_course != "")
								{
									//execute when selected_course id is same as course id.
									if($course_id == $selected_course['id'])
									{

										echo '<div class="row">
											<div class="col-lg-12 top-label">
												<div class="row">
													<div class="col-lg-6 location-name">'.$course_name.'</div>
													<div class="col-lg-6 location-city">'.$course_fee.'</div>
												</div>
											</div>
										</div>';

										echo '<div class="row">
											<div class="col-lg-12">
												<div class="bottom-label '.$i.' selected" id="'.$course_id.'">
													<div class="row">
														<div class="col-lg-4 location-address">
															<div>Discount :</div>';
															if($discount_mode == "percent")
															{
																echo "<div style='font-size:17px;'>$discount_amount<span><img src='".base_url()."img/precentage.png' style='height:15px; padding-left:5px;'><span></div>";
															}
															elseif($discount_mode == "fix")
															{
																echo "<div style='font-size:17px;'>$discount_amount<span><img src='".base_url()."img/rupee.png' style='height:15px;padding-left:5px;'><span></div>";
															}
															else
															{
																echo "<div style='font-size:17px;'>0<span><img src='".base_url()."img/rupee.png' style='height:15px;padding-left:5px;'><span></div>";
															}
												  echo '</div>
														<div class="col-lg-3 location-phone">
															<div>Net Course Fee :</div>
															<div>'.$course_net_fee.'</div>
														</div>
													<div class="col-lg-5 location-email">
														<div class="location-phone">
															<div>Num of Instalment :</div>

															<div>';
															if($num_of_instalment != "")
															{
																echo $num_of_instalment;
															}
															else
															{
																echo "0";
															}
															echo '</div>
														</div>
													</div>
													</div>

												</div>
											</div>
										</div>';
									}
									else
									{
										echo '<div class="row">
											<div class="col-lg-12 top-label">
												<div class="row">
													<div class="col-lg-6 location-name">'.$course_name.'</div>
													<div class="col-lg-6 location-city">'.$course_fee.'</div>
												</div>
											</div>
										</div>';

										echo '<div class="row">
											<div class="col-lg-12">
												<div class="bottom-label '.$i.'" id="'.$course_id.'">
													<a href="'.base_url().'study/course/'.$course_id.'">
													<div class="row">
														<div class="col-lg-4 location-address">
															<div>Discount :</div>';
															if($discount_mode == "percent")
															{
																echo "<div style='font-size:17px;'>$discount_amount<span><img src='".base_url()."img/precentage.png' style='height:15px; padding-left:5px;'><span></div>";
															}
															elseif($discount_mode == "fix")
															{
																echo "<div style='font-size:17px;'>$discount_amount<span><img src='".base_url()."img/rupee.png' style='height:15px;padding-left:5px;'><span></div>";
															}
															else
															{
																echo "<div style='font-size:17px;'>0<span><img src='".base_url()."img/rupee.png' style='height:15px;padding-left:5px;'><span></div>";
															}
												  echo '</div>
														<div class="col-lg-3 location-phone">
															<div>Net Course Fee :</div>
															<div>'.$course_net_fee.'</div>
														</div>
													<div class="col-lg-5 location-email">
														<div class="location-phone">
															<div>Num of Instalment :</div>

															<div>';
															if($num_of_instalment != "")
															{
																echo $num_of_instalment;
															}
															else
															{
																echo "0";
															}
															echo '</div>
														</div>
													</div>
													</div>
													</a>

												</div>
											</div>
										</div>';
									}//end // else condition.
								}
								//execute if there is no any select organization..
								else
								{
									echo '<div class="row">
											<div class="col-lg-12 top-label">
												<div class="row">
													<div class="col-lg-6 location-name">'.$course_name.'</div>
													<div class="col-lg-6 location-city">'.$course_fee.'</div>
												</div>
											</div>
										</div>';

									echo '<div class="row">
										<div class="col-lg-12">
											<div class="bottom-label '.$i.'" id="'.$course_id.'">
												<a href="'.base_url().'study/course/'.$course_id.'">
												<div class="row">
													<div class="col-lg-4 location-address">
														<div>Discount :</div>';
														if($discount_mode == "percent")
														{
															echo "<div style='font-size:17px;'>$discount_amount<span><img src='".base_url()."img/precentage.png' style='height:15px; padding-left:5px;'><span></div>";
														}
														elseif($discount_mode == "fix")
														{
															echo "<div style='font-size:17px;'>$discount_amount<span><img src='".base_url()."img/rupee.png' style='height:15px;padding-left:5px;'><span></div>";
														}
														else
														{
															echo "<div style='font-size:17px;'>0<span><img src='".base_url()."img/rupee.png' style='height:15px;padding-left:5px;'><span></div>";
														}
											  echo '</div>
													<div class="col-lg-3 location-phone">
														<div>Net Course Fee :</div>
														<div>'.$course_net_fee.'</div>
													</div>
												<div class="col-lg-5 location-email">
													<div class="location-phone">
														<div>Num of Instalment :</div>

														<div>';
														if($num_of_instalment != "")
														{
															echo $num_of_instalment;
														}
														else
														{
															echo "0";
														}
														echo '</div>
													</div>
												</div>
												</div>
												</a>

											</div>
										</div>
									</div>';

									
								}
								
								
								$i++;
							}
											
						}//end if condition if($no_of_course > 0)
						//execute if there is no any organization in database
						else
						{
							// error message when there is no any organizaion location
							echo '<div class="row">
									<div class="col-lg-12 alert-msg">
										There is no any Course Added.
									</div>
								</div>';
							// end error message when there is no any organizaion location
						}
						?>

						</div><!-- end course-grid -->
					</div><!-- end  class="col-lg-12" -->
				</div><!-- end row section -->

			</div><!-- // end<div class="col-lg-6 left-side"> -->
			<!-- // end left hand site division -->

			
			<div class="col-lg-6 right-side">

				<div class="display-div course">
						
					<div class="row" style="padding:6px 15px;">
						<div class="col-lg-12 location-heading">
							<div class="row">
								<!-- course form heading -->
								<div class="col-lg-4">
									<?php
									if( isset($selected_course) && !empty($selected_course) )
									{
										echo "Edit Course";
									}
									else
									{
										echo "Add Course";
									}
									?>
								</div>
								<!-- // end course form heading -->
								<div class="col-lg-8 msg success-msg">
									<?php
									if( $this->session->userdata('insert_course') != "" )
									{
										echo "Course Has Been Successfully Added.";
									}
									else if( $this->session->userdata('update_course') != "" )
									{
										echo "Course Has Been Successfully Updated.";
									}
									?>
								</div>
							</div>
						</div>
					</div>

					<div class="course-form">

						<?php echo form_open('study/course','id="course-form"'); ?>
						
						<?php
						//execute if any organization selected for updation..
						//then display editable mode form..
						if( isset($selected_course) && !empty($selected_course) )
						{
						?>
						
						<!-- academic year and course name section -->
						<div class="row">
							<div class="col-lg-5">
								<div class="label-text">Academic Year :</div>
								<div>
									<input type="text" class="form-control course_year" id="course-year" name="academic_year" value="<?php echo $selected_course['academic_year']?>">
								</div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Course Name :</div>
								<div>
									<input type="text" class="form-control course_name" id="course-name"  name="course_name" value="<?php echo $selected_course['name']?>" >
								</div>
							</div>
						</div>
						<!-- // end academic year and course name section -->

						<!-- course fee and discount section -->
						<div class="row" style="margin-top:15px;">
							<!-- course fee section -->
							<div class="col-lg-5">
								<div class="label-text">Course Fee :</div>
								<div>
									<input type="text" class="form-control" value="<?php echo $selected_course['fee']?>" id="course-fee-value" name="course_fee">
								</div>
							</div>
							<!-- // end course fee section -->
							
							<!-- discount select section -->
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Discount :</div>
								<div style="padding-top:5px;">
									<?php
									if($selected_course['discount'] == "yes")
									{
									?>
									<label>
										<input type="checkbox" checked  id="discount-checkbox" class="checkbox" value="yes" name="discount_checkbox">
										<div class="checkbox-img"></div>
									</label>
									<?php
									}
									else
									{
									?>
									<label>
										<input type="checkbox" id="discount-checkbox" class="checkbox" value="yes" name="discount_checkbox">
										<div class="checkbox-img"></div>
									</label>
									<?php
									}
									?>
								</div>
							</div>							
							<!-- // end discount select section -->
						</div>
						<!-- // end course fee and discount section -->
						
						

							
						<?php
						if($selected_course['discount_mode'] == "percent")
						{
						?>
						<!-- discount mode and discount amount row.. -->
						<div class="row">

							<!-- discount mode section -->
							<div class="col-lg-5">
								<div class="row discount-option-div" style="margin-top:15px;">
									<div class="col-lg-6">
										<div class="label-text">
											<div>Percent</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" checked name="discount_mode"  value="percent" id="percent-discount" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="label-text">
											<div style="text-align:center;">Fix</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" name="discount_mode" id="fix-value-discount" value="fix" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div><!-- // end col-lg-5 -->
						<?php
						}
						else if($selected_course['discount_mode'] == "fix")
						{
						?>
						<!-- discount mode and discount amount row.. -->
						<div class="row">
							<!-- discount mode section -->
							<div class="col-lg-5">
								<div class="row discount-option-div" style="margin-top:15px;">
									<div class="col-lg-6">
										<div class="label-text">
											<div>Percent</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" name="discount_mode"  value="percent" id="percent-discount" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="label-text">
											<div style="text-align:center;">Fix</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" checked name="discount_mode" id="fix-value-discount" value="fix" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div><!-- // end col-lg-5 -->
						<?php
						}
						else
						{
						?>
						<!-- discount mode and discount amount row.. -->
						<div class="row">
							<!-- discount mode section -->
							<div class="col-lg-5">
								<div class="row discount-option-div" style="margin-top:15px; display:none;">
									<div class="col-lg-6">
										<div class="label-text">
											<div>Percent</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" name="discount_mode"  value="percent" id="percent-discount" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="label-text">
											<div style="text-align:center;">Fix</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" checked name="discount_mode" id="fix-value-discount" value="fix" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div><!-- // end col-lg-5 -->
						<?php
						}
						?>		
						<!-- // end discount mode section -->


							<!-- discount amount section -->
							<?php
							if( $selected_course['discount_mode'] == "percent" )
							{
							?>
							<div class="col-lg-5 col-lg-offset-2 discount-option-div" style="margin-top:15px;">
								<div class="label-text">Discount Amount :</div>
									<div class="discount-percent-box">
										<input type="text" class="discount-percent-value form-control percent-box" name="discount_value_percent" value="<?php echo $selected_course['discount_amount']?>">
									</div>
									<div class="discount-rupee-box" style="display:none;">
										<input type="text" class="discount-fix-value form-control rupee-box" name="discount_value_fix" value="0">
									</div>
							</div>
							<?php
							}
							else if( $selected_course['discount_mode'] == "fix" )
							{
							?>
							<div class="col-lg-5 col-lg-offset-2 discount-option-div" style="margin-top:15px;">
								<div class="label-text">Discount Amount :</div>
									<div class="discount-percent-box" style="display:none;">
										<input type="text" class="discount-percent-value form-control percent-box" name="discount_value_percent" value="0">
									</div>
									<div class="discount-rupee-box">
										<input type="text" class="discount-fix-value form-control rupee-box" name="discount_value_fix" value="<?php echo $selected_course['discount_amount']?>">
									</div>
							</div>
							<?php
							}
							else
							{
							?>
							<div class="col-lg-5 col-lg-offset-2 discount-option-div" style="display:none; margin-top:15px;">
								<div class="label-text">Discount Amount :</div>
								<div class="discount-percent-box" style="display:none;">
									<input type="text" class="discount-percent-value form-control percent-box" name="discount_value_percent" value="0">
								</div>
								<div class="discount-rupee-box">
									<input type="text" class="discount-fix-value form-control rupee-box" name="discount_value_fix" value="0">
								</div>
							</div>
							<?php
							}
							?>
						
							<!-- // end discount amount section -->

						</div>
						<!-- // end discount mode and discount amount row.. -->

						<!-- course net amount and instalment aplicable section -->
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5">
								<div class="label-text">Net Amount : </div>
								<div>
									<input type="text" class="form-control net-fee-amount" id="disabledInput" readonly name="net_fee_amount" value="<?php echo $selected_course['net_fee_amount']?>">
								</div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Instalment Applicable :</div>
								<div style="padding-top:5px;">
									<?php
									if( $selected_course['instalment_applicable'] == "yes" )
									{
									?>	
									<label>
										<input type="checkbox" checked  id="instalment-checkbox" class="checkbox" value="yes" name="instalment_applicable">
										<div class="checkbox-img"></div>
									</label>
									<?php
									}
									else{
									?>
									<label>
										<input type="checkbox"  id="instalment-checkbox" class="checkbox" value="yes" name="instalment_applicable">
										<div class="checkbox-img"></div>
									</label>
									<?php	
									}
									?>
								</div>
							</div>
						</div>
						<!-- // end course net amount and instalment aplicable section -->

						<!-- number of instalment and instalment mode section -->
					
						<?php
						if( $selected_course['no_of_instalment'] != "" )
						{
						?>
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5 instalment-number">
								<div class="label-text">Nubmer of Instalmet :</div>
								<div>
									<select name="num_of_instalment" id="num-of-instalment" class="form-control">
										<option value="">Number of instalment</option>
											<?php
										
											for( $i = 2 ; $i <= 5; $i++ )
											{
												if($i == $selected_course['no_of_instalment'])
												{
													echo '<option selected value="'.$i.'">'.$i.'</option>';
												}
												else
												{
													echo '<option value="'.$i.'">'.$i.'</option>';
												}
											}
											?>
									</select>
								</div>
							</div><!-- end col-lg-5 instalment-number -->
						<?php
						}//end if condition..
						else
						{
						?>
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5 instalment-number" style="display:none;">
								<div class="label-text">Nubmer of Instalmet :</div>
								<div>
									<select name="num_of_instalment" id="num-of-instalment" class="form-control">
										<option value="">Number of instalment</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											</select>
								</div>
							</div><!-- end col-lg-5 instalment-number -->
						<?php
						}
						?>
								

							<div class="col-lg-5 col-lg-offset-2">
								
								<?php
								if($selected_course['instalment_mode'] == "percent")
								{
								?>
								<div class="row instalment-mode-select">
									<div class="col-lg-6">
										<div class="label-text">
											<div>Percent</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" checked name="instalment_mode"  value="percent" id="percent-ins" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="label-text">
											<div style="text-align:center;">Fix</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" name="instalment_mode" id="fix-value-ins" value="fix" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
								</div>
								<?php
								}
								else if($selected_course['instalment_mode'] == "fix")
								{
								?>
								<div class="row instalment-mode-select">
									<div class="col-lg-6">
										<div class="label-text">
											<div>Percent</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" name="instalment_mode"  value="percent" id="percent-ins" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="label-text">
											<div style="text-align:center;">Fix</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" checked name="instalment_mode" id="fix-value-ins" value="fix" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
								</div>
								<?php
								}
								else
								{
								?>
								<div class="row instalment-mode-select" style="display:none;">
									<div class="col-lg-6">
										<div class="label-text">
											<div>Percent</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" name="instalment_mode"  value="percent" id="percent-ins" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="label-text">
											<div style="text-align:center;">Fix</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" checked name="instalment_mode" id="fix-value-ins" value="fix" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
								</div>
								<?php
								}
								?>
							</div>
						</div><!-- //end row -->
						<!-- // end number of instalment and instalment mode section -->

						<!-- instalment value section -->
						<?php
						if($selected_course['instalment_mode'] == "percent")
						{
						?>
						<div class="row instalment-val-box" style="margin-top:15px;">
							<div class="col-lg-5">
								<div class="label-text">Instalment Value :</div>
								<div class="instalment-box">
								<?php
									$instalment_amount = explode('/',$selected_course['instalment_amount']);
									$a = 1;
									for($i = 0; $i < count($instalment_amount); $i++ )
									{ 
										if($i == 0){
										?>
										<input type="text" class="form-control percent-box inst_per_val" id="ins-<?php echo $a; ?>" name="instalment_percent_value[]" value="<?php echo $instalment_amount[$i];?>">
										<?php
										}
										else
										{
										?>
										<input type="text" class="form-control percent-box inst_per_val" id="ins-<?php echo $a; ?>" name="instalment_percent_value[]" value="<?php echo $instalment_amount[$i];?>" style="margin-top:10px;">
										<?php
										}
									$a++;
									}//end for loop..
								?>
								</div>
							</div>
						</div>
						<?php
						}//end if condition..
						else if($selected_course['instalment_mode'] == "fix")
						{
						?>
						<div class="row instalment-val-box" style="margin-top:15px;">
							<div class="col-lg-5">
								<div class="label-text">Instalment Value :</div>
								<div class="instalment-box">
								<?php
								$instalment_amount = explode('/',$selected_course['instalment_amount']);
								$a = 1;
								for($i = 0; $i < count($instalment_amount); $i++ )
								{ 
									if($i == 0)
									{
									?>
									<input type="text" class="form-control rupee-box inst_fix_val" id="ins-<?php echo $a; ?>" name="instalment_fix_value[]" value="<?php echo $instalment_amount[$i];?>">
									<?php
									}
									else
									{
									?>
									<input type="text" class="form-control rupee-box inst_fix_val" id="ins-<?php echo $a; ?>" name="instalment_fix_value[]" value="<?php echo $instalment_amount[$i];?>" style="margin-top:10px;">
									<?php
									}
								$a++;
								}//end for loop..
								?>
								</div>
							</div>
						</div>
						<?php
						}//end else condition..
						else
						{
						?>
						<div class="row instalment-val-box" style="margin-top:15px; display:none;">
							<div class="col-lg-5">
								<div class="label-text">Instalment Value :</div>
								<div class="instalment-box">

								</div>
							</div>
						</div>
						<?php
						}
						?>
						<!-- // instalment value section -->

						<!-- update and cancle button -->
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-3 col-lg-offset-3">
								<input type="hidden" name="update_btn" value="success">
								<input type="hidden" name="course_id" value="<?php echo $selected_course['id']; ?>">
								<div class="submit-btn form-submit-btn save-btn">Update</div>
							</div>
							<div class="col-lg-3">
								<div class="cancel-btn" id="reset">Cancle</div>
							</div>
						</div>
						<!-- //end update and cancle button -->

						<?php 
						}//end if condition.. if( isset($selected_course) && !empty($selected_course) )
						//execute if there is no any organization is selected..
						else
						{
						?>
						<!-- academic year and course name section -->
						<div class="row">
							<div class="col-lg-5">
								<div class="label-text">Academic Year :</div>
								<div>
									<input type="text" class="form-control course_year" id="course-year" name="academic_year" >
								</div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Course Name :</div>
								<div>
									<input type="text" class="form-control course_name" id="course-name"  name="course_name" >
								</div>
							</div>
						</div>
						<!-- // end academic year and course name section -->
						
						<!-- course fee and discount section -->
						<div class="row" style="margin-top:15px;">
							<!-- course fee section -->
							<div class="col-lg-5">
								<div class="label-text">Course Fee :</div>
								<div>
									<input type="text" class="form-control"  id="course-fee-value" name="course_fee" value="0">
								</div>
							</div>
							<!-- // end course fee section -->

							<!-- discount select section -->
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Discount :</div>
								<div style="padding-top:5px;">
									
									<label>
										<input type="checkbox"  id="discount-checkbox" class="checkbox" value="yes" name="discount_checkbox">
										<div class="checkbox-img"></div>
									</label>
									
								</div>
							</div>							
							<!-- // end discount select section -->
						</div>
						<!-- //end course fee and discount section -->



						<!-- discount mode and discount amount row.. -->
						<div class="row">

							<!-- discount mode section -->
							<div class="col-lg-5">
								<div class="row discount-option-div" style="margin-top:15px; display:none;">
									<div class="col-lg-6">
										<div class="label-text">
											<div>Percent</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" name="discount_mode"  value="percent" id="percent-discount" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="label-text">
											<div style="text-align:center;">Fix</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" checked name="discount_mode" id="fix-value-discount" value="fix" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div><!-- // end col-lg-5 -->

							<div class="col-lg-5 col-lg-offset-2 discount-option-div" style="margin-top:15px; display:none;">
								<div class="label-text">Discount Amount :</div>
									<div class="discount-percent-box" style="display:none;">
										<input type="text" class="discount-percent-value form-control percent-box" name="discount_value_percent" value="0">
									</div>
									<div class="discount-rupee-box">
										<input type="text" class="discount-fix-value form-control rupee-box" name="discount_value_fix" value="0">
									</div>
							</div>
						</div>
						<!-- // end discount mode and discount amount row.. -->


						<!-- course net amount and instalment aplicable section -->
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5">
								<div class="label-text">Net Amount : </div>
								<div>
									<input type="text" class="form-control net-fee-amount" id="disabledInput" readonly name="net_fee_amount" value="0.00">
								</div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Instalment Applicable :</div>
								<div style="padding-top:5px;">
									<label>
										<input type="checkbox"  id="instalment-checkbox" class="checkbox" value="yes" name="instalment_applicable">
										<div class="checkbox-img"></div>
									</label>
								</div>
							</div>
						</div>
						<!-- // end course net amount and instalment aplicable section -->


						<!-- number of instalment and instalment mode section -->
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5 instalment-number" style="display:none;">
								<div class="label-text">Nubmer of Instalmet :</div>
								<div>
									<select name="num_of_instalment" id="num-of-instalment" class="form-control">
										<option value="">Number of instalment</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
								</div>
							</div><!-- end col-lg-5 instalment-number -->

							<div class="col-lg-5 col-lg-offset-2">
								<div class="row instalment-mode-select" style="display:none;">
									<div class="col-lg-6">
										<div class="label-text">
											<div>Percent</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" name="instalment_mode"  value="percent" id="percent-ins" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="label-text">
											<div style="text-align:center;">Fix</div>
											<div style="text-align:center;">
												<label>
													<input type="radio" checked name="instalment_mode" id="fix-value-ins" value="fix" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div><!-- end col-lg-5 -->
						</div><!-- //end row -->
						<!-- // end number of instalment and instalment mode section -->
							
						<!-- instalment value section -->
						<div class="row instalment-val-box" style="margin-top:15px; display:none;">
							<div class="col-lg-5">
								<div class="label-text">Instalment Value :</div>
								<div class="instalment-box">

								</div>
							</div>
						</div>
						<!-- // end instalment value section -->

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
						}///end else condition. if there is no any organization is selected..
						?>

						<?php echo form_close(); ?>

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

jQuery(document).ready(function($) {
	
	// script for percent box, rupee-box, course-fee-value..
	$(".course").on('keypress','.percent-box, .rupee-box, #course-fee-value',function(e){
	
		//if the letter is not digit then display error and don't type anything
		if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57))
		{
			return false;
		}

		//when press dot 
		if(e.which == 46)
		{
			//check if one dot is exist in string then return false
			if($(this).val().indexOf('.') !== -1)
			{
				return false
			}
		}

		//if only one digit is enter in discount textbox
		if( $(this).val().length == 1 )
		{
			//if there is only one dot and it is starting digit then return 0.
			if($(this).val().indexOf('.') !== -1)
			{
				$(this).val("0.");
			}
		}

	});


	//execute when key up from percent text box...
	$(".course").on('keyup','.percent-box',function(e){
		
		//when this value is greater than 100 then return 0
		if($(this).val() >100)
		{
			$(this).val("0");
		}

		//if there is 0 starting before percentage..
		//0999 == 999
		
		if($(this).val().length == 2)
		{
			if($(this).val() != "0.")
			{
				if($(this).val()[0] == '0')
				{
					$(this).val($(this).val()[1]);	
				}
			}
		}
	});

	//excute when key up from rupee-box and course fee value..
	$(".course").on('keyup','.rupee-box, #course-fee-value',function(e){

		//if there is 0 starting before percentage..
		//0999 == 999
		if($(this).val().length == 2)
		{
			if($(this).val() != "0.")
			{
				if($(this).val()[0] == '0')
				{
					$(this).val($(this).val()[1]);	
				}
			}
		}
	});


	//execute when keyup on course fee..
	$("#course-fee-value").keyup(function() {

		// execute if course fee value is not empty
		if($(this).val() != "")
		{
			//if percent-discount radio button is checked
			if( $("#percent-discount").is(":checked") )
			{
				var percent_value = $(".discount-percent-value").val();
				var course_fee = $("#course-fee-value").val();
				
				//check if percent value is not empty..
				if(percent_value != "")
				{
					var x = parseFloat(course_fee) * parseFloat(percent_value);	
					var y = parseFloat(x) / 100;
					var z = parseFloat(course_fee) - parseFloat(y); 
					var a = z.toFixed(2);
					$(".net-fee-amount").val(a);				
				}
				else
				{
					$(".net-fee-amount").val(course_fee);
				}
				
			}
			//if fix value discount radio button is checked..
			else if( $("#fix-value-discount").is(":checked") )
			{

				var course_fee_value = $("#course-fee-value").val();
				var discount_fix_value = $(".discount-fix-value").val();
				if(discount_fix_value != "")
				{
					if(parseFloat(course_fee_value) < parseFloat(discount_fix_value))
					{
						// $(".discount-fix-value").val("0");
						var a = parseFloat(course_fee_value).toFixed(2);
						$(".net-fee-amount").val(a);
					}	
					else
					{
						var x = parseFloat(course_fee_value) - parseFloat(discount_fix_value);
						var y = x.toFixed(2);	 
						$(".net-fee-amount").val(y);
					}
				}
				else
				{
					var a = $("#course-fee-value").val();
					var b = parseFloat(a).toFixed(2);
					$(".net-fee-amount").val(b);
				}
			}
			//execute if there is no any discount value..
			else
			{
				var x = $("#course-fee-value").val();
				var y = parseFloat(x).toFixed(2);
				$(".net-fee-amount").val(y);
			}
		}
		// execute if course fee value is empty
		else
		{
			$(".net-fee-amount").val("0.00");
		}
	});
	

	//execute when focusin into course name textbox..
	$("#course-name").focusin(function() {
		$(this).parent().removeClass('has-error');
	});


	//focus in on course fee textbox
	$("#course-fee-value").focusin(function() {
		$(this).parent().removeClass('has-error');
		$(".net-fee-amount").parent().removeClass('has-error');

		if($(this).val() == "0")
		{
			$(this).val("");
		}
	});

	//execute if focus out from course fee textbox..
	$("#course-fee-value").focusout(function(){

		if($(this).val() == ".")
		$(this).val("0");

		if(parseFloat($(this).val()) == "0")
		$(this).val("0");

		if($(this).val() == "")
		$(this).val("0");
	});


	// execute if click on discount checkbox
	$("#discount-checkbox").click(function() {
		//if checkbox is checked..
		if($(this).is(':checked'))
		{
			//display discount-option-div...
			//for select fix value or percentage value..
			$(".discount-option-div").slideDown();

			//if percent mode discount is selected..
			if( $("#percent-discount").is(":checked") )
			{
				$(".discount-percent-box").slideDown();
			}
			
			//if fix mode discount is selected..
			if( $("#fix-value-discount").is(":checked") )
			{
				$(".discount-rupee-box").slideDown();
			}
		}
		//if checkbox is unchecked..
		else
		{

			$(".discount-percent-value").parent().removeClass('has-error');
			$(".discount-fix-value").parent().removeClass('has-error');

			//slideup discount-option-div...
			//which is for select fix value or percentage value..
			$(".discount-option-div").slideUp();
			var a = parseFloat($("#course-fee-value").val()).toFixed(2);
			$(".net-fee-amount").val(a);
			$(".discount-percent-value").val("0");
			$(".discount-fix-value").val("0");
		}
	});


	//execute if click on discount mode on percent radio button ..
	$("#percent-discount").click(function(event) 
	{
		if($(this).is(":checked"))
		{
			$(".discount-rupee-box").hide();
			$(".discount-percent-box").show();
			$(".discount-fix-value").val("0");
			var a = parseFloat($("#course-fee-value").val()).toFixed(2);
			$(".net-fee-amount").val(a);
		}
	});

	//execute if click on discount mode on fix radio button ..
	$("#fix-value-discount").click(function()
	{
		if($(this).is(":checked"))
		{
			$(".discount-percent-box").hide();
			$(".discount-rupee-box").show();
			$(".discount-percent-value").val("0");
			var a = parseFloat($("#course-fee-value").val()).toFixed(2);
			$(".net-fee-amount").val(a);
		}
	});

	///execute when focus out form discount percent box..
	$(".discount-percent-value").focusout(function()
	{
		if(parseFloat($(this).val()) == "0")
		$(this).val("0");

		if($(this).val() == ".")
		$(this).val("0");

		if($(this).val() == "")
		$(this).val('0');

		var percent_value = $(".discount-percent-value").val();
		var course_fee = $("#course-fee-value").val();
		//check if percent value is not empty..
		if(percent_value != "")
		{
			var x = parseFloat(course_fee) * parseFloat(percent_value);	
			var y = parseFloat(x) / 100;
			var z = parseFloat(course_fee) - parseFloat(y); 
			var a = z.toFixed(2);
			$(".net-fee-amount").val(a);

		}
	});

	$(".discount-percent-value").focusin(function() {

		$(".discount-percent-value").parent().removeClass('has-error');
		
		$(this).select();
		if($(this).val() == "0")
		{
			$(this).val("");
		}
	});

	$(".discount-percent-value").keyup(function() {

		var percent_value = $(this).val();
		var course_fee = $("#course-fee-value").val();
		//check if percent value is not empty..
		if(percent_value != "")
		{
			var x = parseFloat(course_fee) * parseFloat(percent_value);	
			var y = parseFloat(x) / 100;
			var z = parseFloat(course_fee) - parseFloat(y); 
			var a = z.toFixed(2);
			$(".net-fee-amount").val(a);				
		}
		else
		{
			var a = parseFloat(course_fee).toFixed(2);
			$(".net-fee-amount").val(a);
		}
	});


	$(".discount-fix-value").focusout(function() {

		if(parseFloat($(this).val()) == "0")
		$(this).val("0");

		if($(this).val() == ".")
		$(this).val("0");

		if($(this).val() == "")
		$(this).val("0");

		var discount_fix_value = $(".discount-fix-value").val();
		var course_fee = $("#course-fee-value").val();
		//check if percent value is not empty..
		if(discount_fix_value != "")
		{
			var x = parseFloat(course_fee) - parseFloat(discount_fix_value);	
			var y = x.toFixed(2); 
			$(".net-fee-amount").val(y);			
		}
	});

	$(".discount-fix-value").focusin(function() {

		$(".discount-fix-value").parent().removeClass('has-error');

		if($(this).val() == "0")
		{
			$(this).val("");
		}
	});

	$(".discount-fix-value").keyup(function() {

		var discount_fix_value = $(".discount-fix-value").val();
		var course_fee = $("#course-fee-value").val();
		if(parseFloat(discount_fix_value) > parseFloat(course_fee))
		{
			$('.discount-fix-value').val(course_fee);
		}

		var discount_fix_value = $(".discount-fix-value").val();
		//check if percent value is not empty..
		if(discount_fix_value != "")
		{
			var x = parseFloat(course_fee) - parseFloat(discount_fix_value);	 
			var y = x.toFixed(2); 
			$(".net-fee-amount").val(y);				
		}
		else
		{
			var a = parseFloat(course_fee).toFixed(2);
			$(".net-fee-amount").val(a);
		}
	});


	//installment script..!..
	
	// execute if click on discount checkbox
	$("#instalment-checkbox").click(function() {

		//if checkbox is checked..
		if($(this).is(':checked'))
		{
			$(".instalment-box").html("");
			//display discount-option-div...
			//for select fix value or percentage value..
			$(".instalment-mode-select").slideDown();
			$(".instalment-number").slideDown();

			if( $("#percent-ins").is(":checked") )
			{
				
				var num_of_ins = $("#num-of-instalment").val();
				for(var i = 1; i<= num_of_ins; i++)
				{
					if(i== 1)
					{
						var div = '<input type="text" class="form-control percent-box inst_per_val" id="ins-'+i+'" name="instalment_percent_value[]" value="">';
						$(".instalment-box").append(div);						
					}
					else
					{
						var div = '<input type="text" class="form-control percent-box inst_per_val" id="ins-'+i+'" name="instalment_percent_value[]" value="" style="margin-top:10px;">';
						$(".instalment-box").append(div);

					}
				}
			}
			if( $("#fix-value-ins").is(":checked") )
			{
				var num_of_ins = $("#num-of-instalment").val();
				for(var i = 1; i<= num_of_ins; i++)
				{
					if(i == 1)
					{
						var div = '<input type="text" class="form-control rupee-box inst_fix_val" id="ins-'+i+'" name="instalment_fix_value[]" value="">';
						$(".instalment-box").append(div);
					}
					else
					{
						var div = '<input type="text" class="form-control rupee-box inst_fix_val" id="ins-'+i+'" name="instalment_fix_value[]" value="" style="margin-top:10px;">';
						$(".instalment-box").append(div);						
					}
				}
			}
			if($("#num-of-instalment").val() != "")
			{
				$(".instalment-val-box").slideDown();
			}
		}
		//if checkbox is unchecked..
		else
		{
			//which is for select fix value or percentage value..
			$(".instalment-mode-select").slideUp();
			$(".instalment-number").slideUp();
			$(".instalment-val-box").slideUp();

			//remove errors..
			$('input:radio[name="instalment_mode"]').parent().parent().removeClass('test');
			$("#num-of-instalment").removeClass('test');
			$(".inst_per_val").removeClass('has-error');
			$(".inst_fix_val").removeClass('has-error');
		}
	});


	$("#num-of-instalment").change(function() {
		//remove error class..
		$(this).removeClass('test');
		// 
		// 
		$(".instalment-box").html("");
		var num_of_ins = $(this).val();

		if($("#num-of-instalment").val() != "")
		{
			$(".instalment-val-box").slideDown();
		}
		else
		{
			$(".instalment-val-box").slideUp();
		}
		
		//if percent radio button is selected
		if($("#percent-ins").is(":checked"))
		{
			for(var i = 1; i<= num_of_ins; i++)
			{
				if(i== 1)
				{
					var div = '<input type="text" class="form-control percent-box inst_per_val" id="ins-'+i+'" name="instalment_percent_value[]" value="">';
					$(".instalment-box").append(div);						
				}
				else
				{
					var div = '<input type="text" class="form-control percent-box inst_per_val" id="ins-'+i+'" name="instalment_percent_value[]" value="" style="margin-top:10px;">';
					$(".instalment-box").append(div);

				}
			}
		}
		
		//if fix value radio button is selected
		if($("#fix-value-ins").is(":checked"))
		{
			for(var i = 1; i<= num_of_ins; i++)
			{
				if(i == 1)
				{
					var div = '<input type="text" class="form-control rupee-box inst_fix_val" id="ins-'+i+'" name="instalment_fix_value[]" value="">';
					$(".instalment-box").append(div);
				}
				else
				{
					var div = '<input type="text" class="form-control rupee-box inst_fix_val" id="ins-'+i+'" name="instalment_fix_value[]" value="" style="margin-top:10px;">';
					$(".instalment-box").append(div);						
				}
			}
		}
	});


	$("#percent-ins").click(function() {

		// $('input:radio[name="instalment_mode"]').parent().parent().removeClass('test');
		$(".instalment-box").html("");
		if($(this).is(":checked"))
		{
			var num_of_ins = $("#num-of-instalment").val();
			var abc = "";
			for(var i=1; i<= num_of_ins; i++)
			{
				if(i== 1)
				{
					var div = '<input type="text" class="form-control percent-box inst_per_val" id="ins-'+i+'" name="instalment_percent_value[]" value="">';
					$(".instalment-box").append(div);						
				}
				else
				{
					var div = '<input type="text" class="form-control percent-box inst_per_val" id="ins-'+i+'" name="instalment_percent_value[]" value="" style="margin-top:10px;">';
					$(".instalment-box").append(div);

				}
			}

			if($("#num-of-instalment").val() != "")
			{
				$(".instalment-val-box").slideDown();
			}
		
		}

	});

	$("#fix-value-ins").click(function() {

		// $('input:radio[name="instalment_mode"]').parent().parent().removeClass('test');

		$(".instalment-box").html("");

		if($(this).is(":checked"))
		{
			var num_of_ins = $("#num-of-instalment").val();
			for(var i=1; i<= num_of_ins; i++)
			{
				if(i == 1)
				{
					var div = '<input type="text" class="form-control rupee-box inst_fix_val" id="ins-'+i+'" name="instalment_fix_value[]" value="">';
					$(".instalment-box").append(div);
				}
				else
				{
					var div = '<input type="text" class="form-control rupee-box inst_fix_val" id="ins-'+i+'" name="instalment_fix_value[]" value="" style="margin-top:10px;">';
					$(".instalment-box").append(div);						
				}
			}
			if($("#num-of-instalment").val() != "")
			{
				$(".instalment-val-box").slideDown();
			}
		}

	});

	//execute if focusin on installment fix value boxes..
	$(".course").on('focusin','.inst_fix_val',function(){
		//remove error class..
		$(".inst_fix_val").parent().removeClass('has-error');
	});

	//execute if focusout on installment fix value boxes..
	$(".course").on('focusout','.inst_fix_val',function(){

		var inst_fix_total = 0;
		$('.inst_fix_val:not(:last)').not(this).each(function(){
			if( $(this).val() != "" )
			{
				inst_fix_total += parseFloat( $(this).val() );
			}
		});

		var this_val = $(this).val();
		var remaining_fix_var = parseFloat( $('.net-fee-amount').val() ) - parseFloat(inst_fix_total);
		if( parseFloat(this_val) > parseFloat(remaining_fix_var) )
		{
			$(this).val(remaining_fix_var);
		}

		//execute if focusout textbox has more than or equal to net-fee-amount 
		if( parseFloat( $(this).val() )  >= parseFloat( $(".net-fee-amount").val() ) )
		{
			$(this).val( $(".net-fee-amount").val() );
			$('.inst_fix_val').not(this).each(function(){
				$(this).val('0');
			});
		}
		else
		{
			var inst_fix_val = 0;
			$('.inst_fix_val:not(:last)').each(function(){
				if( $(this).val() != "" )
				{
					inst_fix_val += parseFloat( $(this).val() );
				}
			});
			var net_fee_amount = $(".net-fee-amount").val();
			var remaining_amount = parseFloat(net_fee_amount) - parseFloat(inst_fix_val);

			$(".inst_fix_val").last().val(remaining_amount);
		}
	});



	//execute if focusin on installment per value boxes..
	$(".course").on('focusin','.inst_per_val',function(){
		//remove error class..
		$(".inst_per_val").parent().removeClass('has-error');
	});



	//execute if focusout on installment per value boxes..
	$(".course").on('focusout','.inst_per_val',function(){

		var inst_per_total = 0;
		$('.inst_per_val:not(:last)').not(this).each(function(){
			if( $(this).val() != "" )
			{
				inst_per_total += parseFloat( $(this).val() );
			}
		});

		var this_val = $(this).val();
		var remaining_per_var = 100 - parseFloat(inst_per_total);
		if( parseFloat(this_val) > parseFloat(remaining_per_var) )
		{
			$(this).val(remaining_per_var);
		}

		//execute if focusout textbox has more than or equal to net-fee-amount 
		if( parseFloat( $(this).val() )  >= parseFloat(100) )
		{
			$(this).val("100");
			$('.inst_per_val').not(this).each(function(){
				$(this).val('0');
			});
		}
		else
		{
			var inst_per_val = 0;
			$('.inst_per_val:not(:last)').each(function(){
				if( $(this).val() != "" )
				{
					inst_per_val += parseFloat( $(this).val() );
				}
			});

			var remaining_per = 100 - parseFloat(inst_per_val);

			$(".inst_per_val").last().val(remaining_per);
		}
	});

	//execute query when click on save button..
	//then course_form submit..
	$(".form-submit-btn").click(function(){

		//execute if course-year is not empty
		if( $("#course-year").val() != "" )
		{
			var flag_year = 1;
		}
		else
		{
			flag_year = 0;
			$("#course-year").parent().addClass('has-error');
		}

		//execute if course-year is not empty
		if( $("#course-name").val() != "" )
		{
			var flag_name = 1;
		}
		else
		{
			flag_name = 0;
			$("#course-name").parent().addClass('has-error');
		}
		
		//execute if course-fee is not empty or not zero..
		if( $("#course-fee-value").val() != "" && parseFloat($("#course-fee-value").val()) != "0" )
		{
			var flag_fee = 1;
		}
		else
		{
			flag_fee = 0;
			$("#course-fee-value").parent().addClass('has-error');
		}

		if( $(".net-fee-amount").val() != "" && parseFloat($(".net-fee-amount").val()) != "0" )
		{
			flag_net_fee = 1;
		}
		else
		{
			flag_fee = 0;
			$(".net-fee-amount").parent().addClass('has-error');
		}


		//execute if discount checkbox is checked..
		if( $("#discount-checkbox").is(":checked") )
		{
			// execute if discount mode radio button is clicked..
			if( $('input:radio[name="discount_mode"]').is(":checked") )
			{
				//if selected discount mode is percentage..
				if( $('input:radio[name="discount_mode"]:checked').val() == "percent")
				{
					//check if discount percent value is not blank
					if( parseFloat( $(".discount-percent-value").val() ) == "0" ) 
					{
						$(".discount-percent-value").parent().addClass('has-error');
						flag_discount = 0;
					}
					//execute if discount percentage value is blank.
					else
					{
						flag_discount = 1;
					}

				}
				//execute if selected discount mode is fix value..
				else if($('input:radio[name="discount_mode"]:checked').val() == "fix")
				{
					//check if discount fix value is not blank
					if(parseFloat( $(".discount-fix-value").val() ) == "0" )
					{
						$(".discount-fix-value").parent().addClass('has-error');
						flag_discount = 0;
					}
					//execute if discount fix value is blank.
					else
					{
						flag_discount = 1;
					}
				}
				
			}
			
		}
		//execute if discount checkbox is not checked..
		else
		{
			flag_discount = 1;
		}

		//execute if instalment checkbox is checked..
		if( $("#instalment-checkbox").is(":checked") )
		{
			//if number of instalment is not selected
			if( $("#num-of-instalment").val() == "" )
			{
				//execute if instalment  mode radio button is selected..
				if( $('input:radio[name="instalment_mode"]').is(":checked") )
				{
					//if number of instalment is not selected but instalment mode is selected.
					//then do nothing.. 
				}
				//execute if instalment mode radio button is not selected..
				else
				{
					$('input:radio[name="instalment_mode"]').parent().parent().addClass('test');
					flag_instalment = 0;
				}
				$("#num-of-instalment").addClass('test');
				flag_instalment = 0;
			}
			//if number of instalment is selected..
			else
			{

			}

			if( $('input:radio[name="instalment_mode"]').is(":checked") )
			{
				//if selected discount mode is percentage..
				if( $('input:radio[name="instalment_mode"]:checked').val() == "percent")
				{
					var inst_per_val = 0;
					var check_per_blank = 0;
					//add all percentage instalment value
					$(".inst_per_val").each(function(){
						if( $(this).val() != "" )
						{
							check_per_blank = 1;
							inst_per_val += parseFloat( $(this).val() );
						}
						else
						{
							check_per_blank = 0;
							flag_instalment = 0;
							$(this).parent().addClass('has-error');
						}
					});

					// check if there is no any blank percent textbox
					if(check_per_blank == 1)
					{
						//check if total percentage instalment value is not equal to 100
						if(inst_per_val !=  100)
						{
							$('.inst_per_val').parent().addClass('has-error');
							flag_instalment = 0;
						}
						else
						{
							flag_instalment = 1;
						}
					}
				}
				//execute if selected discount mode is fix value..
				else if($('input:radio[name="instalment_mode"]:checked').val() == "fix")
				{
					var inst_fix_val = 0;

					//variable for check is there fix instalment value is blank..
					var check_fix_blank = 0;
					
					//add all percentage instalment value
					$(".inst_fix_val").each(function(){
						if( $(this).val() != "" )
						{
							check_fix_blank = 1;
							inst_fix_val += parseFloat( $(this).val() );
						}
						else
						{
							check_fix_blank = 0;
							flag_instalment = 0;
							$(this).parent().addClass('has-error');
						}
					});
					// check if there is no any blank percent textbox
					if(check_fix_blank == 1)
					{
						//check if total percentage instalment value is not equal to 100
						if(inst_fix_val !=  $(".net-fee-amount").val() )
						{
							$('.inst_fix_val').parent().addClass('has-error');
							flag_instalment = 0;
						}
						else
						{
							flag_instalment = 1;
						}
					}//end if(check_fix_blank == 1)				
				}
			} // end if( $('input:radio[name="instalment_mode"]').is(":checked") )
			
		}
		else
		{
			flag_instalment = 1;
		}

		if(flag_year == "1" && flag_name == "1" && flag_fee == "1" && flag_discount == "1" && flag_instalment == "1")
		{
			$("#course-form").submit();	
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


	// execute script when user want to search location
	$(".search-course").keyup(function(event) {

		var search_value = $.trim($(this).val());

		$.ajax({
			url: '<?php echo base_url();?>index.php/study/course_search',
			type: 'POST',
			data: {search_course: search_value},
			success: function(result){
				$(".course-grid").html(result);
				// alert(result);
			}
		});
	});


	<?php 
	//execute after organization is successfully inserted and show success msg.
	if( $this->session->userdata('insert_course') != "" )
	{
	?>
		$(".1").css({
			backgroundColor: 'rgb(142, 213, 114)'
		});

		$(".1").animate({
	    	backgroundColor:"#fff"
	  	},9000);
		
		$(".success-msg").delay(5000).fadeOut(1000)  	
  	<?php
  	}
  	?>


  	<?php
	//execute after organization is successfully Updated and show success msg.
	if( $this->session->userdata('update_course') != "" )
	{
	?>
		var location_id = "<?php echo $this->session->userdata('update_course_id'); ?>"
		$("#"+location_id).css({
			backgroundColor: 'rgb(142, 213, 114)'
		});

		$("#"+location_id).animate({
	    	backgroundColor:"#fff"
	  	},9000);
		
		$(".success-msg").delay(5000).fadeOut(1000)
  	
  	<?php
  	}
  	?>
	

});

</script>

<?php
$this->session->unset_userdata('insert_course');
$this->session->unset_userdata('update_course');
$this->session->unset_userdata('update_course_id');
?>