
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
?>

<div class="row add-student">
	<div class="col-lg-9 col-centered">

		<?php echo form_open_multipart('user/student','id="student-form"');?>
		<div class="row">
			<div class="col-lg-6">
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Name</div>
					<div class="col-lg-6"><input type="text" name="name" class="form-control student-name"></div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Username</div>
					<div class="col-lg-6"><input type="text" readonly name="username" value="<?php echo increment_string($last_student_username['username']); ?>" class="form-control student-username"></div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Date of Birth</div>
					<div class="col-lg-6">

						<div class="form-group">
                            <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
                                <input type='text' class="form-control" name="dob" id="student-dob" />
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
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Blood Group</div>
					<div class="col-lg-6">
						<select name="blood_group" id="" class="form-control">
							<option value="">Select Blood Group</option>
							<option value="O-">O-</option>
							<option value="O+">O+</option>
							<option value="A-">A-</option>
							<option value="A+">A+</option>
							<option value="B-">B-</option>
							<option value="B+">B+</option>
							<option value="AB-">AB-</option>
							<option value="AB+">AB+</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-7 image" style="text-align:center;">
						<div id="uploaded-image">
							<img src="<?php echo base_url(); ?>uploads/student/default.png"  alt="Student Image" class="img">
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
                                <input type='text' class="form-control" name="doj" id="student-doj" />
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
							if($course_detail)
							{
								foreach ($course_detail as $course) {
									echo '<option value="'.$course['id'].'">'.$course['name'].'</option>';
									# code...
								}
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
							<option value="VIII">VIII</option>
							<option value="IX">IX</option>
							<option value="X">X</option>
							<option value="XI">XI</option>
							<option value="XII">XII</option>
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
							<option value="General">General</option>
							<option value="OBC">OBC</option>
							<option value="SC/ST">SC/ST</option>
						</select>
					</div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Batch</div>
					<div class="col-lg-6">
						<select class="form-control" name="batch" id="batch">
							<option value="" id="batch-add">Select Batch</option>
							
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
						<input type="text" name="total_amount" id="total_amount" class="form-control total_amount" value="0.00" readonly>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-name">Discount</div>
						<div class="col-lg-1" style="padding-top:5px">
							<label>
								<input type="checkbox"  id="discount_checkbox" class="checkbox" value="yes" name="discount_checkbox">
								<div class="checkbox-img"></div>
							</label>
						</div>
						<div class="col-lg-5">
							<div class="discount-percent-box" style="display:none;">
								<input type="text" class="discount-percent-value form-control percent-box" name="discount_value" value="0">
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
						<input type="text" name="net_amount" id="net_amount" class="form-control net_amount" readonly value="0.00">
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
										<label>
											<input type="radio" name="payment_type" checked id="full_amount"  value="Full Amount"  class="radio payment_type">
											<div class="radio-img"></div>
										</label>
									</div>
								</div>
								<div class="col-lg-6 ins-radio-div">
									<div style="text-align:center;">Instalment</div>
									<div style="text-align:center;">
										<label>
											<input type="radio" name="payment_type" id="instalment"  value="Instalment" class="radio payment_type">
											<div class="radio-img"></div>
										</label>
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
					
				</div>
				<div class="col-lg-6">
					<div class="row" style="margin-top:5px;">
						<div class="col-lg-6 label-text">Pay Amount</div>
						<div class="col-lg-6">
						<input type="text" name="pay_amount" class="form-control pay_amount" value="0" id="pay_amount">
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
										<label>
											<input type="radio" checked name="payment_mode"  value="Cash" id="cash_radio" class="radio">
											<div class="radio-img"></div>
										</label>
									</div>
								</div>
								<div class="col-lg-6">
									<div style="text-align:center;">Cheque</div>
									<div style="text-align:center;">
										<label>
											<input type="radio" name="payment_mode"  value="Cheque" id="cheque_radio" class="radio">
											<div class="radio-img"></div>
										</label>
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
						<input type="text" name="cheque_number" id="cheque_number"  class="form-control cheque_number">
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
							<option value="Father">Father</option>
							<option value="Mother">Mother</option>
							<option value="Guardian">Guardian</option>
						</select>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-name">Father Name</div>
						<div class="col-lg-6"><input type="text" name="parent_name" class="form-control p-name"></div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-occ">Father Occupation</div>
						<div class="col-lg-6"><input type="text" name="parent_occupation" class="form-control p-occ"></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-phone">Father Phone</div>
						<div class="col-lg-6"><input type="text" name="parent_phone" class="form-control p-phone"></div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-email">Father Email</div>
						<div class="col-lg-6"><input type="text" name="parent_email" class="form-control p-email"></div>
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
							<input type="text" name='phone[]' class="form-control phone-text">
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
							<input type="text" name='email[]' class="form-control email-text">
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
							<textarea name="current_address" class="form-control c_address" rows="3"></textarea>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Permanet Address</div>
						<div class="col-lg-6">
							<textarea name="permanent_address" class="form-control p_address" rows="3"></textarea>
						</div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">City</div>
						<div class="col-lg-6"><input type="text" name="city" class="form-control city"></div>
					</div>
				</div>
			</div>


		</fieldset>

		<div class="row" style="margin-top:15px; margin-bottom:25px;">
				<div class="col-lg-3 col-lg-offset-3">
					<input type="hidden" name="insert_btn" value="success">
					<div class="submit-btn save-btn form-submit-btn">Save</div>
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
	
	$('#datetimepicker1').datetimepicker({
        pickTime: false
    });
    $('#datetimepicker1').data("DateTimePicker").setMaxDate(new Date("january 1, 1996"));
    $('#datetimepicker2').datetimepicker({
        pickTime: false
    });
   	var today = new Date();
    $('#datetimepicker2').data("DateTimePicker").setMaxDate(new Date(today));


    $(".cross").hide();

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

	$(".ins-radio-div").hide();

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


	$(".add-student").on('change', '#relationship', function(event) {
		var relationship = $("#relationship").val();

		$(".parent-name").text(relationship+" Name");
		$(".parent-email").text(relationship+" Email Id");
		$(".parent-phone").text(relationship+" Phone");
		$(".parent-occ").text(relationship+" Occupation");

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

	$(".instalment-section").hide();
	$("#cheque_no").hide();

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