<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Admin Management
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-6">
				<a href="<?php echo base_url();?>user/admin"><div class="submit-btn">New Admin</div></a>
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
	
		<div class="col-lg-4">Student</div>
	</a>
	<a href="<?php echo base_url();?>user/admin">
		<div class="col-lg-4 active">Admin</div>
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
					<div class="col-lg-6 search-bar admin-search">
						<input type="text" class="search-admin admin-name"  placeholder="Admin Name..">
					</div>
					<div class="col-lg-6 search-bar admin-search">
						<input type="text" class="search-admin admin-username"  placeholder="Admin Username..">
					</div>
					
				</div>
				<!-- // end search bar -->

				<div class="row section">
					<div class="col-lg-12" style="padding-right:0px;">		
						<div class="view-grid staff-grid">

						<?php
						//if there is any staff in database..
						if($no_of_admin > 0)
						{
							$i=1;
							//execute when first time page load..
							foreach($admin as $admin_detail)
							{
								$email = explode(',',$admin_detail['email']);
								$phone = explode(',',$admin_detail['phone']);
							?>
							<div class="left-blog">
								<div class="row">
									<div class="col-lg-12 top-label">
										<div class="row">
											<div class="col-lg-6 location-name">
											<?php echo $admin_detail['name']; ?>
											</div>
											<div class="col-lg-6 topic_number">
											<?php echo $admin_detail['username']; ?>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="bottom-label <?php echo $i;?>" id="<?php echo $admin_detail['id']; ?>" style="padding-right:0px;">
											<div class="row staff-detail">
												<div class="col-lg-2">
													<img src="<?php echo base_url(); ?>uploads/admin/<?php echo $admin_detail['image'] ?>"  alt="<?php echo $admin_detail['name']; ?>" class="staff-img">
												</div>
												<div class="col-lg-5">
													<div><?php echo date('j, M Y',strtotime($admin_detail['dob'])); ?></div>
													<div><?php echo $email[0]; ?></div>
													<div><?php echo $phone[0]; ?></div>
												</div>
												<div class="col-lg-5">
													<div><?php echo $admin_detail['gender']; ?></div>
													<div><?php echo $admin_detail['city']; ?></div>
													<div><?php echo $admin_detail['country']; ?></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<?php
							$i++;
							}//end foreach loop..
						}
						else
						{
							// error message when there is no any organizaion location
							echo '<div class="row">
									<div class="col-lg-12 alert-msg">
										No Admin Found In Database..!
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
									<?php
									if( isset($selected_admin) && !empty($selected_admin) )
									{
										echo "Edit Admin";
									}
									else
									{
										echo "Add Admin";
									}
									?>
								</div>
								<!-- // end subject form heading -->
								<div class="col-lg-7">
									<div class="msg success-msg">
										<?php
										if( $this->session->userdata('insert_admin') != "" )
										{
											echo "Admin Has Been Successfully Added.";
										}
										else if( $this->session->userdata('update_admin') != "" )
										{
											echo "Admin Has Been Successfully Updated.";
										}
										?>
									</div>
									
								</div><!-- end success msg -->
								<div class="col-lg-1 edit">
									<div class="current-admin-id" style="display:none;"></div>
									<img src="<?php echo base_url()?>/img/edit-icon.png" alt="" class="edit-btn" title="Edit User">
								</div>

							</div><!-- // end row -->
						</div><!-- // end col-lg-12 -->
					</div><!-- // end row -->

					<div class="staff-right-div">
						<?php echo form_open_multipart('user/admin','id="admin-form"');?>
						<div class="row">
							<div class="col-lg-5">
								<div class="row">
									<div class="col-lg-12">
										<div class="label-text">Name</div>
										<div><input type="text" class="form-control" id="staff-name" name="name"></div>
									</div>
								</div>
								<div class="row" style="margin-top:10px;">
									<div class="col-lg-12">
										<div class="label-text">Username</div>
										<div><input type="text" class="form-control" id="staff-username" name="username" readonly value="<?php echo increment_string($last_admin_username['username']); ?>"></div>
									</div>
								</div>
								<div class="row" style="margin-top:10px;">
									<div class="col-lg-12">
										<div class="label-text">Date Of Birth</div>
										<div>
											
											<div class="form-group">
				                                <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
				                                    <input type='text' class="form-control" name="dob" id="staff-dob" />
				                                    <span class="input-group-addon">
				                                        <span class="glyphicon glyphicon-calendar"></span>
				                                    </span>
				                                </div>
				                            </div>

										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-lg-offset-3">
								<div class="row">
									<div class="col-lg-12 image" >
										<div id="uploaded-image">
											<img src="<?php echo base_url(); ?>uploads/admin/default.png"  alt="Staff Image" class="img">
										</div>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>

								</div>
								<div class="row" style="margin-top:5px;">
									<div class="col-lg-9">
										<label style="width:100%;">
											<input type="file" style="display:none;" name="image" accept="image/*" id="files">
											<div class="upload-file">Upload Image</div>
										</label>
									</div>
								</div>
							</div>
						</div>

						<div class="row" style="">
							<div class="col-lg-5">
								<div class="label-text">Gender </div>
								<div>
									<select class="form-control" name="gender">
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Country</div>
								<div>
									<select class="form-control country" onchange="print_state('state' , this.selectedIndex);" id="country" name ="country"></select>
								</div>
							</div>
						</div>

						<div class="row" style="margin-top:10px;">
							<div class="col-lg-5">
								<div class="label-text">State</div>
								<div>
									<select name ="state" id ="state" class="form-control state"></select>
									<script language="javascript">print_country("country");</script>
								</div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">City</div>
								<div><input type="text" class="form-control" id="city" name="city"></div>
							</div>
						</div>

						<div class="row" style="margin-top:10px;">
							<div class="col-lg-5">
								<div class="row">
									<div class="col-lg-12">
										<div class="label-text">Email Id.</div>
										<div class="email"><input type="text" name='email[]' class="form-control email-text"></div>
									</div>
								</div>

								<div class="row add-more">
									<div class="col-lg-6 add-email">
										+ Add More
									</div>
									<div class="col-lg-6 remove-box remove-email" style="text-align:right">
										- Remove
									</div>
								</div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">

								<div class="row">
									<div class="col-lg-12">
										<div class="label-text">Phone No.</div>
										<div class="phone">
											<input type="text" name='phone[]' class="form-control phone-text">
										</div>
									</div>
								</div>

								<div class="row add-more">
									<div class="col-lg-6 add-phone">
										+ Add More
									</div>
									<div class="col-lg-6 remove-box remove-phone" style="text-align:right">
										- Remove
									</div>
								</div>

							</div><!-- //end col-lg-5 -->
						</div>

						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5">
								<div class="label-text">Date of Joining</div>
								<div>
									<div class='input-group date' id='datetimepicker2' data-date-format="DD/MM/YYYY">
	                                    <input type='text' class="form-control" name="doj" id="staff-doj" />
	                                    <span class="input-group-addon">
	                                        <span class="glyphicon glyphicon-calendar"></span>
	                                    </span>
	                                </div>
								</div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Marital Status</div>
								<div>
									<select name="marital_status" id="marital_status" class="form-control">
										<option value="">Single</option>
										<option value="">Married</option>
									</select>
								</div>
							</div>
						</div>

						<div class="row" style="margin-top:10px;">
							<div class="col-lg-5">
								<div class="label-text">Current Address</div>
								<div>
									<textarea name="current_address" class="form-control c_address" rows="3"></textarea>
								</div>
							</div>
							<div class="col-lg-2" style="text-align:center; padding-top:36px;">
								<label>
									<div style="font-family:Gilda Display; font-size:13px; font-weight:normal;">Copy</div>
									<input type="checkbox" class="checkbox address-checkbox" >
									<div style="margin-left:2px;" class="checkbox-img"></div>
								</label>
							</div>
							<div class="col-lg-5">
								<div class="label-text">Permanet Address</div>
								<div>
									<textarea name="permanent_address" class="form-control p_address" rows="3"></textarea>
								</div>
							</div>
						</div>

						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5">
								<div class="label-text">Relationship</div>
								<div>
									<select name="relationship" id="relationship" class="form-control">
										<option value="Father">Father</option>
										<option value="Mother">Mother</option>
										<option value="Spouse">Spouse</option>
										<option value="Guardian">Guardian</option>
									</select>
								</div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text parent-name">Father Name</div>
								<div>
									<input type="text" name="parent_name" id="parent_name" class="form-control">
								</div>
							</div>
						</div>

						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5">
								<div class="label-text parent-phone">Father Phone</div>
								<div>
									<input type="text" name="parent_phone" id="parent_phone" class="form-control">
								</div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text parent-email">Father Email Id</div>
								<div>
									<input type="text" name="parent_email" id="parent_email" class="form-control">
								</div>
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
						<div class="username" style="display:none;"><?php echo increment_string($last_admin_username['username']); ?></div>
						<?php echo form_close(); ?>

					</div><!-- end staff-right-div -->
				
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
	
	$('#datetimepicker1').datetimepicker({
        pickTime: false
    });
    $('#datetimepicker1').data("DateTimePicker").setMaxDate(new Date("january 1, 1994"));
    $('#datetimepicker2').datetimepicker({
        pickTime: false
    });
    var today = new Date();
    $('#datetimepicker2').data("DateTimePicker").setMaxDate(new Date(today));


    $('.admin-name').keyup(function(event) {
		/* Act on the event */
		var name = $('.admin-name').val()
		var username = $('.admin-username').val();
		$(".la-anim-10").addClass('la-animate');

		$.ajax({
			url: "<?php echo base_url();?>index.php/user/admin_search",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {name:name, username : username},
			success: function(result){
				$(".staff-grid").html(result);
				$(".la-anim-10").removeClass('la-animate');
			}
		});
	});

	$('.admin-username').keyup(function(event) {
		/* Act on the event */
		var name = $('.admin-name').val()
		var username = $('.admin-username').val();
		$(".la-anim-10").addClass('la-animate');

		$.ajax({
			url: "<?php echo base_url();?>index.php/user/admin_search",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {name:name, username : username},
			success: function(result){
				$(".staff-grid").html(result);
				$(".la-anim-10").removeClass('la-animate');
			}
		});
	});


	//execute when click on any admin on left panel for view admin full details..
	$(".staff-grid").on('click', '.bottom-label', function() {
		var admin_id = $(this).attr('id');
		$(".bottom-label").removeClass('selected');
		$(this).addClass('selected');

		$(".right-heading").text('View Admin');
		$(".edit .current-admin-id").text(admin_id);
		$(".edit").show();
		$(".la-anim-10").addClass('la-animate');
		$.ajax({
			url: '<?php echo base_url();?>index.php/user/view_admin',
			type: 'POST',
			data: {admin_id: admin_id},
			success: function(result){
				$(".staff-right-div").html(result);
				$(".la-anim-10").removeClass('la-animate');
			}
		});
	});


	//execute when user want to edit any admin details.
	//when click on edit button on right panel for edit information of user..
	$('.edit .edit-btn').click(function() {
		var admin_id = $(".edit .current-admin-id").text();
		$(".edit").hide();
		$(".right-heading").text('Edit Admin');
		$(".la-anim-10").addClass('la-animate');
		$.ajax({
			url: '<?php echo base_url();?>index.php/user/edit_admin',
			type: 'POST',
			data: {admin_id: admin_id},
			success: function(result){
				$(".staff-right-div").html(result);
				$(".la-anim-10").removeClass('la-animate');
			}
		});
	});


    //add more phone textbox on click on add more 
	$(".staff-right-div").on('click', '.add-phone', function() {
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
	$(".staff-right-div").on('click', '.add-email', function() {
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
	$('.staff-right-div').on('keypress','.phone-text',function(e){
		//if the letter is not digit then display error and don't type anything
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
	});

	//by default hide remove text box button..
	$(".remove-box").hide();

	//script execute when click on remove phone button..
	$(".staff-right-div").on('click', '.remove-phone', function() {

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
	$(".staff-right-div").on('click', '.remove-email', function() {

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

	$(".staff-right-div").on('change', '#relationship', function(event) {
		var relationship = $("#relationship").val();

		$(".parent-name").text(relationship+" Name");
		$(".parent-email").text(relationship+" Email Id");
		$(".parent-phone").text(relationship+" Phone");

		if(relationship == "")
		{
			$("#parent_name").val("");
			$("#parent_email").val("");
			$("#parent_phone").val("");
		}

	});

	$(".staff-right-div").on('click', '.address-checkbox', function(event) {
		if($(this).is(":checked"))
		{
			$(".p_address").val($(".c_address").val());
			// alert("d0");
		}
		else
		{
			$(".p_address").val("");
		}
	});

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
	$(".staff-right-div").on('change', '#files', function(event) {
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
			$("#uploaded-image").html('<img src="<?php echo base_url(); ?>uploads/admin/default.png"  alt="Staff Image" class="img">');
			$("#default_image").val("");
		}

	});

	$(".staff-right-div").on('click', '.cross', function(event) {
		$("#files").val("");
		$(".cross").hide();
		$("#uploaded-image").html('<img src="<?php echo base_url(); ?>uploads/admin/default.png"  alt="Staff Image" class="img">');
		//this is for remove default logo image into update section..
		$("#default_image").val("");
	});



	$(".staff-right-div").on('click', '.form-submit-btn', function(event) {

		//check if staff name is filled or not..
		if( $('#staff-name').val() != "" )
		{
			var flag_name = 1;
		}
		else
		{
			$('#staff-name').parent().addClass('has-error');
			var flag_name = 0;
			$('.staff-right-div').animate({scrollTop:0}, 'slow');
		}

		//check if staff username is filled or not..
		if( $('#staff-username').val() != "" )
		{
			var flag_username = 1;
		}
		else
		{
			$('#staff-username').parent().addClass('has-error');
			var flag_username = 0;
			$('.staff-right-div').animate({scrollTop:0}, 'slow');
		}

		//check if staff date of birth is filled or not..
		if( $('#staff-dob').val() != "" )
		{
			var flag_dob = 1;
		}
		else
		{
			$('#staff-dob').parent().addClass('has-error');
			var flag_dob = 0;
			$('.staff-right-div').animate({scrollTop:0}, 'slow');
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
		if( $('#city').val() != "" )
		{
			var flag_city = 1;
		}
		else
		{
			$('#city').parent().addClass('has-error');
			var flag_city = 0;
			$('.staff-right-div').animate({scrollTop:0}, 'slow');
		}

		//check if city is selected or not
		if( $('#staff-doj').val() != "" )
		{
			var flag_doj = 1;
		}
		else
		{
			$('#staff-doj').parent().addClass('has-error');
			var flag_doj = 0;
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


		if(flag_name == 1 && flag_username == 1 && flag_dob == 1 && flag_country == 1 && flag_state == 1 && flag_city == 1 && flag_doj == 1 && flag_phone == 1 && flag_email == 1 && flag_c_address == 1 && flag_p_address == 1 )
		{
			$(this).removeClass('form-submit-btn');
			$(".la-anim-10").addClass('la-animate');
			$("#admin-form").submit();
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

	$(".staff-right-div").on('focusin', '.form-control', function() {
		$(this).parent().removeClass('has-error');
	});

	$(".staff-right-div").on('click', '.cancel-btn', function(event) {
		$('.staff-right-div').animate({scrollTop:0}, 'slow');
		$(".form-control").val("");
		$("#files").val("");
		$(".cross").hide();
		$("#uploaded-image").html('<img src="<?php echo base_url(); ?>uploads/admin/default.png"  alt="Staff Image" class="img">');
		//this is for remove default logo image into update section..
		$("#default_image").val("");
		$("#staff-username").val($(".username").text());
	});

	<?php
	//execute after Course is successfully Added and show success msg.
  	// 
	if( $this->session->userdata('insert_admin') )
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
  	if( $this->session->userdata('update_admin') )
	{
	?>
		var id = "<?php echo $this->session->userdata('update_admin') ?>";
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

  	$(".staff-right-div").on('keyup', '.c_address', function(event) {
  		var c_address = $(this).val();
  		if($(".address-checkbox").is(":checked"))
		{
			$(".p_address").val(c_address);
		}
  	});


});
</script>

<?php
$this->session->unset_userdata('update_admin');
$this->session->unset_userdata('insert_admin');
?>