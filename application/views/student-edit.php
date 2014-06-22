
<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		<?php echo $student_status;?>
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-3 col-lg-offset-5">
				<a href="<?php echo base_url();?>user/student"><div class="submit-btn">View Student</div></a>
			</div>
			<div class="col-lg-3">
				<a href="<?php echo base_url();?>excel/uploadstudent"><div class="submit-btn">Upload Student</div></a>
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
	if($student_detail)
	{
		$dob = str_replace('-','/',$student_detail['dob']);
		$doj = str_replace('-','/',$student_detail['doj']);
		$batch_detail = $this->manage_course->fetch_batch_by_courseid($student_detail['course']);
	}
?>

<div class="row add-student">
	<div class="col-lg-9 col-centered">

		<?php echo form_open_multipart('user/student','id="student-form"');?>
		<div class="row">
			<div class="col-lg-6">
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Name</div>
					<div class="col-lg-6"><input type="text" name="name" value="<?php echo $student_detail['name'] ?>" class="form-control student-name"></div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Username</div>
					<div class="col-lg-6"><input type="text" readonly name="username" value="<?php echo $student_detail['username'] ?>" class="form-control student-username"></div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Date of Birth</div>
					<div class="col-lg-6">

						<div class="form-group">
                            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
                                <input type='text' class="form-control" value="<?php echo $dob; ?>" name="dob" id="student-dob" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>

					</div>
				</div>
				<div class="row" >
					<div class="col-lg-6 label-text">Gender</div>
					<div class="col-lg-6">
						<select name="gender" id="" class="form-control">
							<?php
							if($student_detail['gender'] == "Male")
							{
								echo '<option value="Male">Male</option>
							<option value="Female">Female</option>';
							} 
							else
							{
								echo '<option value="Male">Male</option>
							<option value="Female" selected>Female</option>';
							}
							?>
							
						</select>
					</div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Blood Group</div>
					<div class="col-lg-6">
						<select name="blood_group" id="" class="form-control">
							<option value="">Select Blood Group</option>
							<option value="O-" <?php if($student_detail['blood_group'] == "O-") echo "selected"; ?>>O-</option>
							<option value="O+" <?php if($student_detail['blood_group'] == "O+") echo "selected"; ?>>O+</option>
							<option value="A-" <?php if($student_detail['blood_group'] == "A-") echo "selected"; ?>>A-</option>
							<option value="A+" <?php if($student_detail['blood_group'] == "A+") echo "selected"; ?>>A+</option>
							<option value="B-" <?php if($student_detail['blood_group'] == "B-") echo "selected"; ?>>B-</option>
							<option value="B+" <?php if($student_detail['blood_group'] == "B+") echo "selected"; ?>>B+</option>
							<option value="AB-" <?php if($student_detail['blood_group'] == "AB-") echo "selected"; ?>>AB-</option>
							<option value="AB+" <?php if($student_detail['blood_group'] == "AB+") echo "selected"; ?>>AB+</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-7 image" style="text-align:center;">
						<div id="uploaded-image">
							<img src="<?php echo base_url(); ?>uploads/student/<?php echo $student_detail['image']; ?>"  alt="Student Image" class="img">
						</div>
						<div class="cross">
							<img src="<?php echo base_url();?>img/close.png" alt="">
						</div>
					</div>
					
				</div>
				<div class="row" style="margin-top:5px;">
					<div class="col-lg-4 col-lg-offset-7">
						<label style="width:100%;">
							<input type="file" style="display:none;" name="image" accept="image/*" id="files">
							<div class="upload-file">Upload Image</div>
						</label>
					</div>
				</div>
			</div>
		</div>

		<div class="row" style="margin-top:10px">
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-6 label-text">Date of Joining</div>
					<div class="col-lg-6">
						<div class="form-group">
                            <div class='input-group date' id='datetimepicker2' data-date-format="DD/MM/YYYY">
                                <input type='text' class="form-control" name="doj" value="<?php echo $doj; ?>" id="student-doj" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 label-text">Course</div>
					<div class="col-lg-6">
						<select class="form-control" name="course" id="course">
							<option value="">Select Course</option>
							<?php 
							foreach ($course_detail as $course) {
								if($course['id'] == $student_detail['course'])
								{
								echo '<option value="'.$course['id'].'" selected>'.$course['name'].'</option>';
								}
								else
								{	
								echo '<option value="'.$course['id'].'">'.$course['name'].'</option>';
								}
								# code...
								# 
							}
							 ?>
						</select>
					</div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Class</div>
					<div class="col-lg-6">
						<select class="form-control" name="class" id="class">
							<option value="">Select Class</option>
							<option value="VIII" <?php if($student_detail['class'] == "VIII") echo "selected"; ?>>VIII</option>
							<option value="IX" <?php if($student_detail['class'] == "IX") echo "selected"; ?>>IX</option>
							<option value="X" <?php if($student_detail['class'] == "X") echo "selected"; ?>>X</option>
							<option value="XI" <?php if($student_detail['class'] == "XI") echo "selected"; ?>>XI</option>
							<option value="XII" <?php if($student_detail['class'] == "XII") echo "selected"; ?>>XII</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-6 label-text">Category</div>
					<div class="col-lg-6">
						<select class="form-control" name="category" id="category">
							<option value="">Select Category</option>
							<option value="General" <?php if($student_detail['category'] == "General") echo "selected"; ?>>General</option>
							<option value="OBC" <?php if($student_detail['category'] == "OBC") echo "selected"; ?>>OBC</option>
							<option value="SC/ST" <?php if($student_detail['category'] == "SC/ST") echo "selected"; ?>>SC/ST</option>
						</select>
					</div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Batch</div>
					<div class="col-lg-6">
						<select class="form-control" name="batch" id="batch">
							<option value="" id="batch-add">Select Batch</option>
							<?php
							
							foreach ($batch_detail as $batch) {
								if($batch['id'] == $student_detail['batch'])
								echo '<option selected value="'.$batch['id'].'">'.$batch['name'].'</option>';
								else
								echo '<option value="'.$batch['id'].'">'.$batch['name'].'</option>';

							 } 
							?>
						</select>

					</div>
				</div>
			</div>
		</div>

		<fieldset>
			<legend>Payment Info</legend>
			
			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Total Amount</div>
						<div class="col-lg-6">
						<input type="text" name="total_amount" id="total_amount" class="form-control total_amount" value="<?php echo $student_detail['total_amount'] ?>" readonly>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-name">Discount</div>
						<div class="col-lg-1" style="padding-top:5px">
							<?php
							if(strtolower($student_detail['discount']) == "yes")
							{
							?>
							<label>
								<input type="checkbox" checked id="discount_checkbox" class="checkbox" value="yes" name="discount_checkbox">
								<div class="checkbox-img"></div>
							</label>
							
							<?php
							}
							else
							{
							?>
							<label>
								<input type="checkbox" id="discount_checkbox" class="checkbox" value="yes" name="discount_checkbox">
								<div class="checkbox-img"></div>
							</label>
							<?php
							}
							?>
						</div>
						<div class="col-lg-5">
							<div class="discount-percent-box">
								<input type="text" class="discount-percent-value form-control percent-box" name="discount_value" value="<?php echo $student_detail['discount_amount'] ?>">
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- net amount and payment type section -->
			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Net Amount</div>
						<div class="col-lg-6">
						<?php
						if($student_detail['net_amount'] == "")
						{
							?>
							<input type="text" name="net_amount" id="net_amount" class="form-control net_amount" readonly value="<?php echo $student_detail['total_amount'] ?>">
							<?php
						} 
						else
						{
							?>
							<input type="text" name="net_amount" id="net_amount" class="form-control net_amount" readonly value="<?php echo $student_detail['net_amount'] ?>">
						 	<?php
						}
						?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Payment Type</div>
						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-6">
									<div style="text-align:center;">Full Amount</div>
									<div style="text-align:center;">
										<?php 
										if($student_detail['pay_amount'] == $student_detail['net_amount'])
										{
										?>
										<label>
											<input type="radio" name="payment_type" checked id="full_amount"  value="Full Amount"  class="radio payment_type">
											<div class="radio-img"></div>
										</label>
										<?php
										}
										else
										{
										?>
										<label>
											<input type="radio" name="payment_type" id="full_amount"  value="Full Amount"  class="radio payment_type">
											<div class="radio-img"></div>
										</label>
										<?php
										}
										?>
									</div>
								</div>
								<div class="col-lg-6 ins-radio-div">
									<div style="text-align:center;">Instalment</div>
									<div style="text-align:center;">
										<?php 
										if($student_detail['pay_amount'] == $student_detail['net_amount'])
										{
										?>
										<label>
											<input type="radio" name="payment_type" id="instalment"  value="Instalment" class="radio payment_type">
											<div class="radio-img"></div>
										</label>
										<?php
										}
										else
										{
										?>
										<label>
											<input type="radio" checked name="payment_type" id="instalment"  value="Instalment" class="radio payment_type">
											<div class="radio-img"></div>
										</label>
										<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- // end net amount and payment type section -->

			<div class="row instalment-section">
				<div class="col-lg-6" id="instalment-div" >
					<?php
					$course_detail = $this->user_model->fetchbyid($student_detail['course'],'course');
					$instalment_amount = explode("/",$course_detail['instalment_amount']);
					if($course_detail['instalment_mode'] != "")
					{
						//execute if instalment mode is fix value..
						if($course_detail['instalment_mode'] == "fix")
						{
							$a = 1;
							for($i = 0; $i < count($instalment_amount); $i++) {
								if($student_detail['discount_amount'] != "")
								{
									$instalment_value = $instalment_amount[$i] - ( $instalment_amount[$i] * $student_detail['discount_amount'] / 100 );
								}
								else
								{
									$instalment_value = $instalment_amount[$i];
								}
							?>

							<div class="row">
								<div class="col-lg-6 label-text"><?php echo $a; ?> Instalment Amount</div>
								<div class="col-lg-6">
								<input type="text" name="total_amount" value="<?php echo $instalment_value; ?>" class="form-control instalment-value" readonly style="margin-top:5px;">
								<div class="hidden instalment-amount-hidden"><?php echo $instalment_amount[$i]; ?></div>
								</div>
							</div>
							<?php
								$a++;
							}
							
						}
						if($course_detail['instalment_mode'] == "percent")
						{
							$a = 1;
							for($i = 0; $i < count($instalment_amount); $i++) {
								$amount = $course_detail['net_fee_amount'] * $instalment_amount[$i] / 100;

								if($student_detail['discount_amount'] != "")
								{
									$instalment_value =$amount - ($amount * $student_detail['discount_amount'] / 100 );
								}
								else
								{
									$instalment_value = round($amount, 2);
								}
							?>

							<div class="row">
								<div class="col-lg-6 label-text"><?php echo $a; ?> Instalment Amount</div>
								<div class="col-lg-6">
								<input type="text" name="total_amount" value="<?php echo $instalment_value;  ?>" class="form-control instalment-value" readonly style="margin-top:5px;">
								<div class="hidden instalment-amount-hidden"><?php echo round($amount, 2); ?></div>
								</div>
							</div>
							<?php
								$a++;
							}
						}
					}
					?>
				</div>
				<div class="col-lg-6">
					<div class="row" style="margin-top:5px;">
						<div class="col-lg-6 label-text">Pay Amount</div>
						<div class="col-lg-6">
						<input type="text" name="pay_amount" class="form-control pay_amount" value="<?php echo $student_detail['pay_amount']; ?>" id="pay_amount">
						</div>
					</div>
					
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<div class="row" style="margin-top:10px;">
						<div class="col-lg-6 label-text">Payment Mode</div>
						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-6">
									<div style="text-align:center;">Cash</div>
									<div style="text-align:center;">
										<?php 
										if(strtolower($student_detail['payment_mode']) == "cash")
										{
										?>
										<label>
											<input type="radio" checked name="payment_mode"  value="Cash" id="cash_radio" class="radio">
											<div class="radio-img"></div>
										</label>
										<?php
										}
										else
										{
										?>
										<label>
											<input type="radio" name="payment_mode"  value="Cash" id="cash_radio" class="radio">
											<div class="radio-img"></div>
										</label>
										<?php
										}
										?>
										
									</div>
								</div>
								<div class="col-lg-6">
									<div style="text-align:center;">Cheque</div>
									<div style="text-align:center;">
									<?php 
										if(strtolower($student_detail['payment_mode']) == "cheque")
										{
										?>
										<label>
											<input type="radio" checked name="payment_mode"  value="Cheque" id="cheque_radio" class="radio">
											<div class="radio-img"></div>
										</label>
										<?php
										}
										else
										{
										?>
										<label>
											<input type="radio" name="payment_mode"  value="Cheque" id="cheque_radio" class="radio">
											<div class="radio-img"></div>
										</label>
										<?php
										}
										?>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="col-lg-6" id="cheque_no">
					<div class="row" style="margin-top:15px;">
						<div class="col-lg-6 label-text">Cheque No</div>
						<div class="col-lg-6">
						<input type="text" name="cheque_number" id="cheque_number" value="<?php echo $student_detail['cheque_number'] ?>"  class="form-control cheque_number">
						</div>
					</div>
					
				</div>
			</div>

		</fieldset>


		<fieldset>
			<legend>Parent Info</legend>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Relation</div>
						<div class="col-lg-6">
						<select name="relationship" id="relationship" class="form-control">
							<option value="Father" <?php if($student_detail['parent_relation'] == "Father") echo "selected"; ?> >Father</option>
							<option value="Mother" <?php if($student_detail['parent_relation'] == "Mother") echo "selected"; ?>>Mother</option>
							<option value="Guardian" <?php if($student_detail['parent_relation'] == "Guardian") echo "selected"; ?>>Guardian</option>
						</select>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-name"><?php echo $student_detail['parent_relation'] ?> Name</div>
						<div class="col-lg-6"><input type="text" value="<?php echo $student_detail['parent_name'] ?>" name="parent_name" class="form-control p-name"></div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-occ"><?php echo $student_detail['parent_relation'] ?> Occupation</div>
						<div class="col-lg-6"><input type="text" value="<?php echo $student_detail['parent_occupation'] ?>" name="parent_occupation" class="form-control p-occ"></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-phone"><?php echo $student_detail['parent_relation'] ?> Phone</div>
						<div class="col-lg-6"><input type="text" value="<?php echo $student_detail['parent_phone'] ?>" name="parent_phone" class="form-control p-phone"></div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-email"><?php echo $student_detail['parent_relation'] ?> Email</div>
						<div class="col-lg-6"><input type="text" value="<?php echo $student_detail['parent_email'] ?>" name="parent_email" class="form-control p-email"></div>
					</div>
				</div>
			</div>

		</fieldset>

		<fieldset>
			<legend>Personal Contacts</legend>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Phone</div>
						<div class="col-lg-6 phone">
							<?php
							$student_phone = explode(',',$student_detail['phone']);
							for($a = 0; $a< count($student_phone); $a++)
							{
								if($student_phone[$a] != "")
								{
									if($a == 0)
									{
									echo '<input type="text" value="'.$student_phone[$a].'" name="phone[]" class="form-control phone-text">';
									}
									else
									{
									echo '<input type="text" value="'.$student_phone[$a].'" name="phone[]" class="form-control phone-text" style="margin-top:10px;">';
									}
								}
							}
							?>
						</div>
					</div>
					<div class="row add-more">
						<div class="col-lg-6 col-lg-offset-6">
							<div class="row">
								<div class="col-lg-6 add-phone">
									+ Add More
								</div>
								<div class="col-lg-6 remove-box remove-phone" style="text-align:right">
									- Remove
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Email</div>
						<div class="col-lg-6 email">
							<?php
							$student_email = explode(',',$student_detail['email']);
							for($a = 0; $a< count($student_email); $a++)
							{
								if($student_email[$a] != "")
								{
									if($a == 0)
									{
									echo '<input type="text" value="'.$student_email[$a].'" name="email[]" class="form-control email-text">';
									}
									else
									{
									echo '<input type="text" value="'.$student_email[$a].'" name="email[]" class="form-control email-text" style="margin-top:10px;">';
									}
								}
							}
							?>
						</div>
					</div>
					<div class="row add-more">
						<div class="col-lg-6 col-lg-offset-6">
							<div class="row ">
								<div class="col-lg-6 add-email">
									+ Add More
								</div>
								<div class="col-lg-6 remove-box remove-email" style="text-align:right">
									- Remove
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Country</div>
						<div class="col-lg-6">
							<select class="form-control country" onchange="print_state('state' , this.selectedIndex);" id="country" name ="country"></select>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">State</div>
						<div class="col-lg-6">
							<select name ="state" id ="state" class="form-control state"></select>
							<script language="javascript">print_country("country");</script>
						</div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Current Address</div>
						<div class="col-lg-6">
							<textarea name="current_address" class="form-control c_address" rows="3"><?php echo $student_detail['current_address'] ?></textarea>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Permanet Address</div>
						<div class="col-lg-6">
							<textarea name="permanent_address" class="form-control p_address" rows="3"><?php echo $student_detail['permanent_address'] ?></textarea>
						</div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">City</div>
						<div class="col-lg-6"><input type="text" name="city" class="form-control city" value="<?php echo $student_detail['city'] ?>"></div>
					</div>
				</div>
			</div>


		</fieldset>

		<div class="row" style="margin-top:15px; margin-bottom:25px;">
				<div class="col-lg-3 col-lg-offset-3">
					<input type="hidden" name="update_btn" value="success">
					<input type="hidden" name="default_image" id="default_image" value="default">
					<input type="hidden" name="old_image" value="<?php echo $student_detail['image']; ?>">
					<input type="hidden" name="student_id" value="<?php echo $student_detail['id']; ?>">
					<div class="submit-btn form-submit-btn save-btn">Update</div>
				</div>
				<div class="col-lg-3">
					<div class="cancel-btn" id="reset">Cancle</div>
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
</div>

<?php 
}
?>


<script type="text/javascript">
jQuery(document).ready(function($) {

	<?php
	if(strtolower($student_detail['discount']) == "yes")
	{
	?>
		$(".discount-percent-box").show();
	<?php 
	}
	else
	{
	?>
		$(".discount-percent-box").hide();
	<?php
	}
	?>

	<?php 
	if($student_detail['pay_amount'] == $student_detail['net_amount'])
	{
	?>
		$(".instalment-section").hide();
	<?php
	}
	else
	{
	?>
		$(".instalment-section").show();
	<?php
	}
	?>			

	
	$('#datetimepicker1').datetimepicker({
        pickTime: false
    });
    $('#datetimepicker1').data("DateTimePicker").setMaxDate(new Date("january 1, 1996"));
    $('#datetimepicker2').datetimepicker({
        pickTime: false
    });
   	var today = new Date();
    $('#datetimepicker2').data("DateTimePicker").setMaxDate(new Date(today));


	//select those country which is present in database..
	$("#country").val("<?php echo $student_detail['country']; ?>").attr('selected','selected');

	//get country_index which is selected..
	var country_index = $('#country :selected').index();

	//display all state of selected Country..
	print_state_country('state',country_index);

	//select those state which is present in database..
	$("#state").val("<?php echo $student_detail['state']; ?>").attr('selected','selected');

	<?php
		if($student_detail['image'] == "default.png")
		{
			?>
			$(".cross").hide();
			<?php
		}
		else
		{
			?>
			$(".cross").show();
			<?php
		}
	?>


	function handleFileSelect(evt) {
		
	var files = evt.target.files; // FileList object

	// Loop through the FileList and render image files as thumbnails.
	for (var i = 0, f; f = files[i]; i++) {
		if (!f.type.match('image.*')) {
		continue;
		// Only process image files.
	}

	var reader = new FileReader();

	// Closure to capture the file information.
	reader.onload = (function(theFile) {
		
		return function(e) {
		  // Render thumbnail.
		  var span = document.createElement('span');
		  span.innerHTML = ['<img class="img" src="', e.target.result,
		                    '" title="', escape(theFile.name), '"/>'].join('');
		  document.getElementById('uploaded-image').insertBefore(span, null);
			};
		})(f);

		// Read in the image file as a data URL.
		reader.readAsDataURL(f);
		}
	}

	//display logo image when select any logo..
	$(".add-student").on('change', '#files', function(event) {
		$("#uploaded-image").html("");
		//execute if use select any image
		if($(this).val() != "")
		{
			$(".cross").show();
			$("#default_image").val("hello");
	  		handleFileSelect(event);

		}
		//execute if user has not select any image..
		else
		{
			$(".cross").hide();
			$("#uploaded-image").html('<img src="<?php echo base_url(); ?>uploads/student/default.png"  alt="Staff Image" class="img">');
			$("#default_image").val("");
		}

	});

	$(".add-student").on('click', '.cross', function(event) {
		$("#files").val("");
		$(".cross").hide();
		$("#uploaded-image").html('<img src="<?php echo base_url(); ?>uploads/student/default.png"  alt="Staff Image" class="img">');
		//this is for remove default logo image into update section..
		$("#default_image").val("");
	});


	    //add more phone textbox on click on add more 
	$(".add-student").on('click', '.add-phone', function() {
		var new_phone = '<input type="text" name="phone[]" class="form-control phone-text" style="margin-top:10px;">';
		var new_phone_value = $(".phone-text").last().val()

		if(new_phone_value != "")
		{
			$('.phone-text').last().after(new_phone);
			$('.phone-text').last().focus();
			$(".remove-phone").show();
		}
		else
		{
			$(".phone-text").last().focus();
		}
	});

	//add more email textbox on click on add more 
	$(".add-student").on('click', '.add-email', function() {
		var new_email = '<input type="text" name="email[]" class="form-control email-text" style="margin-top:10px;">';
		var new_email_value = $(".email-text").last().val()

		if(new_email_value != "")
		{
			$('.email-text').last().after(new_email);
			$('.email-text').last().focus();
			$(".remove-email").show();
		}
		else
		{
			$(".email-text").last().focus();
		}
	});


	//create script for accept only integer in phone number.
	$('.add-student').on('keypress','.phone-text',function(e){
		//if the letter is not digit then display error and don't type anything
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
	});

	//by default hide remove text box button..
	$(".remove-box").hide();

	//display remove email button..
	var email_count = 0
	$(".email-text").each(function(){
		email_count++;
	});

	if(email_count != 1)
	{
		$(".remove-email").show();
	}


	//display remove phone button..
	var phone_count = 0
	$(".phone-text").each(function(){
		phone_count++;
	});

	if(phone_count != 1)
	{
		$(".remove-phone").show();
	}


	//script execute when click on remove phone button..
	$(".add-student").on('click', '.remove-phone', function() {

		$('.phone-error').hide();

		$(".phone-text").last().slideUp();
		$(".phone-text").last().remove();

		var i=0;
		$(".phone-text").each(function(){
			i++;
		});
		if(i == 1)
		{
			$(this).hide();
		}
		
	});

	//script execute when click on remove email button..
	$(".add-student").on('click', '.remove-email', function() {

		$('.email-error').hide();

		$(".email-text").last().slideUp();
		$(".email-text").last().remove();
		
		var i=0;
		$(".email-text").each(function(){
			i++;
		});
		if(i == 1)
		{
			$(this).hide();
		}
	});


	$(".add-student").on('change', '#relationship', function(event) {
		var relationship = $("#relationship").val();

		$(".parent-name").text(relationship+" Name");
		$(".parent-email").text(relationship+" Email Id");
		$(".parent-phone").text(relationship+" Phone");
		$(".parent-occ").text(relationship+" Occupation");

	});

	$(".add-student").on('change', '#course', function(event) {
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

		$.ajax({
			url: "<?php echo base_url();?>index.php/user/course_fee",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {course_id : course_id},
			success: function(result){
				//discount checkbox is unchecked..
				$("#discount_checkbox").prop('checked',false);
				$("#discount_checkbox").next('.checkbox-img').css({
					background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 1px'
				});
				//discount box hide..
				$(".discount-percent-box").hide();
				//set discount value is 0..
				$(".discount-percent-value").val('0');

				$("#instalment-div").html(result);
				var net_amount = $(".net-fee-amount-hidden").text();
				$("#net_amount").val(net_amount);
				$("#total_amount").val(net_amount);
				if( $(".instalment-mode-hidden").text() == "" )
				{
					$(".ins-radio-div").hide();
					$(".instalment-section").slideUp();
					$("#full_amount").prop('checked','checked');
					$("#full_amount").next('.radio-img').css({
						background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -167px 0px'
					});
				}
				else
				{
					$(".ins-radio-div").show();
				}
			}
		});
	});


	$("#discount_checkbox").click(function() {
		if($(this).is(":checked"))
		{
			$(".discount-percent-box").slideDown();			
		}
		else
		{
			$(".discount-percent-box").slideUp();
			$(".discount-percent-value").parent().removeClass('has-error');
			$(".discount-percent-value").val("0");
			var total_amount = $("#total_amount").val();
			$("#net_amount").val(total_amount);	
		}
	});


	// script for percent box, rupee-box, course-fee-value..
	$(".add-student").on('keypress','.percent-box, .rupee-box, .net_amount',function(e){
	
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
	$(".add-student").on('keyup','.percent-box',function(e){
		
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
	$(".add-student").on('keyup','.rupee-box, .net_amount',function(e){

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


	$(".discount-percent-value").keyup(function(){

		var percent_value = $(this).val();
		var total_amount = $("#total_amount").val();
		// //check if percent value is not empty..
		if(percent_value != "")
		{
			var x = parseFloat(total_amount) * parseFloat(percent_value);	
			var y = parseFloat(x) / 100;
			var z = parseFloat(total_amount) - parseFloat(y); 
			var a = z.toFixed(2);
			if(a < 0)
			{
				$("#net_amount").val(total_amount);				
			}
			else
			{
				$("#net_amount").val(a);
			}

			$(".instalment-value").each(function(){
				var instalment_amount = $(this).next().text();
				var x = parseFloat(instalment_amount) * parseFloat(percent_value);	
				var y = parseFloat(x) / 100;
				var z = parseFloat(instalment_amount) - parseFloat(y); 
				var a = z.toFixed(2);
				if(a < 0)
				{
					$(this).val(instalment_amount);
				}
				else
				{
					$(this).val(a);
				}
			})
		}
		else
		{
			var a = parseFloat(total_amount).toFixed(2);
			$("#net_amount").val(a);
			var percent_value = 0;
			$(".instalment-value").each(function(){
				var instalment_amount = $(this).next().text();
				$(this).val(instalment_amount);
			})
		}
	});

	$(".discount-percent-value").focusout(function(){

		var percent_value = $(this).val();
		if(parseFloat(percent_value) == "0")
		{
			$(this).val('0');
		}
		var total_amount = $("#total_amount").val();
		// //check if percent value is not empty..
		if(percent_value != "")
		{
			var x = parseFloat(total_amount) * parseFloat(percent_value);	
			var y = parseFloat(x) / 100;
			var z = parseFloat(total_amount) - parseFloat(y); 
			var a = z.toFixed(2);
			$("#net_amount").val(a);			
		}
		else
		{
			var a = parseFloat(total_amount).toFixed(2);
			$("#net_amount").val(a);
			$(".discount-percent-value").val("0");
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

	$("#pay_amount").focusout(function(){

		if(parseFloat($(this).val()) == "0")
		{
			$(this).val('0');
		}
		else if($(this).val() == "")
		{
			$(this).val('0');
		}
	});

	$("#pay_amount").focusin(function() {
		$(this).select();
		if($(this).val() == "0")
		{
			$(this).val("");
		}
	});

	<?php 
	if(strtolower($student_detail['payment_mode']) == "cheque")
	{
		?>
		$("#cheque_no").show();
	<?php
	}
	else
	{
		?>
		$("#cheque_no").hide();
		<?php
	}
	?>
	

	$("#full_amount").click(function() {
		$(".instalment-section").slideUp();
	});	

	$("#instalment").click(function() {
		$(".instalment-section").slideDown();
	});

	$("#cash_radio").click(function() {
		$("#cheque_no").hide();
	});


	$("#cheque_radio").click(function() {
		$("#cheque_no").show();
	});




	$(".add-student").on('click', '.form-submit-btn', function(event) {

				//check if staff name is filled or not..
		if( $('.student-name').val() != "" )
		{
			var flag_name = 1;
		}
		else
		{
			$('.student-name').parent().addClass('has-error');
			var flag_name = 0;
			$('.add-student').animate({scrollTop:0}, 1000);
		}

		//check if staff username is filled or not..
		if( $('.student-username').val() != "" )
		{
			var flag_username = 1;
		}
		else
		{
			$('.student-username').parent().addClass('has-error');
			var flag_username = 0;
			$('.add-student').animate({scrollTop:0}, 1000);
		}

		//check if staff date of birth is filled or not..
		if( $('#student-dob').val() != "" )
		{
			var flag_dob = 1;
		}
		else
		{
			$('#student-dob').parent().addClass('has-error');
			var flag_dob = 0;
			$('.add-student').animate({scrollTop:0}, 1000);
		}

		//check if city is selected or not
		if( $('#student-doj').val() != "" )
		{
			var flag_doj = 1;
		}
		else
		{
			$('#student-doj').parent().addClass('has-error');
			var flag_doj = 0;
			$('.add-student').animate({scrollTop:0}, 1000);
		}

		//check if country is selected or not
		if( $('#country').val() != "" )
		{
			var flag_country = 1;
		}
		else
		{
			$('#country').parent().addClass('has-error');
			var flag_country = 0;
			$('.staff-right-div').animate({scrollTop:0}, 'slow');
		}

		//check if country is selected or not
		if(  $('#state').val() == ""  || $("#state").val() == null)
		{
			$('#state').parent().addClass('has-error');
			var flag_state = 0;
			$('.staff-right-div').animate({scrollTop:0}, 'slow');
		}
		else
		{
			var flag_state = 1;
		}

		//check if city is selected or not
		if( $('.city').val() != "" )
		{
			var flag_city = 1;
		}
		else
		{
			$('.city').parent().addClass('has-error');
			var flag_city = 0;
			$('.staff-right-div').animate({scrollTop:0}, 'slow');
		}

	


		$('.phone-text').each(function()
		{
			if($(this).val() == "")
			{
				$(this).parent().addClass('has-error');
				flag_phone = 0;
			}
			else
			{
				flag_phone = 1;
			}
		});

		$('.email-text').each(function()
		{
			if($(this).val() == "")
			{
				$(this).parent().addClass('has-error');
				flag_email = 0;
			}
			else
			{
				flag_email = 1;
			}
		});

		//check if city is selected or not
		if( $('.c_address').val() != "" )
		{
			var flag_c_address = 1;
		}
		else
		{
			$('.c_address').parent().addClass('has-error');
			var flag_c_address = 0;
		}

		//check if city is selected or not
		if( $('.p_address').val() != "" )
		{
			var flag_p_address = 1;
		}
		else
		{
			$('.p_address').parent().addClass('has-error');
			var flag_p_address = 0;
		}


		//check if parent phone is fill or not
		if( $('#course').val() != "" )
		{
			var flag_course = 1;
		}
		else
		{
			$('#course').parent().addClass('has-error');
			var flag_course = 0;
			$('.add-student').animate({scrollTop:0}, 1000);
		}

		var flag_discount = 1;
		if($("#discount_checkbox").is(":checked"))
		{
			if($(".discount-percent-value").val() == "0")
			{
				var flag_discount = 0;
				$(".discount-percent-value").parent().addClass('has-error');
			}
			else
			{
				var flag_discount = 1;
			}
		}

		var flag_instalment = 1;
		if($("#instalment").is(":checked"))
		{
			if($("#pay_amount").val() == "0")
			{
				var flag_instalment = 0;
				$("#pay_amount").parent().addClass('has-error');
			}
			else
			{
				var flag_instalment = 1;
			}
		}

		var flag_cheque = 1;
		if($("#cheque_radio").is(":checked"))
		{
			if($("#cheque_number").val() == "0")
			{
				var flag_cheque = 0;
				$("#cheque_number").parent().addClass('has-error');
			}
			else
			{
				var flag_cheque = 1;
			}
		}


		if(flag_name == 1 && flag_username == 1 && flag_course == 1 && flag_dob == 1 && flag_country == 1 && flag_state == 1 && flag_city == 1 && flag_doj == 1 && flag_phone == 1 && flag_email == 1 && flag_c_address == 1 && flag_p_address == 1 && flag_course == 1 && flag_discount == 1)
		{
			$(".form-submit-btn").removeClass('form-submit-btn');
			$("#student-form").submit();
			$(".la-anim-10").addClass('la-animate');
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

	$(".form-control").focusin(function() {
		$(this).parent().removeClass('has-error');
	});

			
});

</script>