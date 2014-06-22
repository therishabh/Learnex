<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Organization Location Setting
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-6">
				<a href="<?php echo base_url();?>setting/location"><div class="submit-btn">New Location</div></a>
			</div>
		</div>
	</div>
</div>
<!-- // end heading -->

<!-- navigation top bar -->
<div class="row nav">
	<a href="<?php echo base_url();?>setting/organization">
		<div class="col-lg-3">Organization</div>
	</a>
	<a href="#">

		<div class="col-lg-3 active">Organization Location</div>
	</a>
	<a href="<?php echo base_url();?>setting/tax">
		<div class="col-lg-3">Tax</div>
	</a>
	<a href="">
		<div class="col-lg-3">Manage Year</div>
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
						<input type="text" class="search-location"  placeholder="Type Location Name..">
						
					</div>
				</div>
				<!-- // end search bar -->
				
				<div class="row section">
					<div class="col-lg-12" style="padding-right:0px;">		
						<div class="location-grid">
						
						<?php
						//execute if there is any organization location exist in database..
						if( count($organization_location) > 0 )
						{
							$i = 1;
							foreach($organization_location as $a)
							{

								$location_id = $a['id'];
								$location_name = $a['location_name'];
								$location_address = character_limiter($a['address'],50);
								$location_full_address = $a['address'];
								$location_city = $a['city'];
								$location_email = explode(',',$a['email']);
								$location_phone = explode(',',$a['phone']);

								//if select any organization..
								if(isset($selected_organization) && $selected_organization != "")
								{
									//execute when selected organization id is same as location id.
									//then show selected location..
									if($location_id == $selected_organization['id'])
									{
										echo '<div class="row">
											<div class="col-lg-12 top-label">
												<div class="row">
													<div class="col-lg-6 location-name">'.$location_name.'</div>
													<div class="col-lg-6 location-city">'.$location_city.'</div>
												</div>
											</div>
										</div>';
										echo '<div class="row">
											<div class="col-lg-12">
												<div class="bottom-label '.$i.' selected" id="'.$location_id.'">
													<div class="row">
														<div class="col-lg-4 location-address">
															<div>'.$location_address.'</div>
														</div>
														<div class="col-lg-3 location-phone">';
														foreach ($location_phone as $phone) {
															echo '<div>'.$phone.'</div>';
														}
														echo '</div>
													<div class="col-lg-5 location-email">';
													foreach ($location_email as $email) {
															echo '<div>'.$email.'</div>';
														}
														echo '</div>
													</div>
												</div>
											</div>
										</div>';
									}//end if condition.. if($location_id == $selected_organization['id'])
									else
									{
										echo '<div class="row">
											<div class="col-lg-12 top-label">
												<div class="row">
													<div class="col-lg-6 location-name">'.$location_name.'</div>
													<div class="col-lg-6 location-city">'.$location_city.'</div>
												</div>
											</div>
										</div>';
										echo '<div class="row">
											<div class="col-lg-12">
												<div class="bottom-label '.$i.'" id="'.$location_id.'">
												<a href="'.base_url().'setting/location/'.$location_id.'">
													<div class="row">
														<div class="col-lg-4 location-address">
															<div>'.$location_address.'</div>
														</div>
														<div class="col-lg-3 location-phone">';
														foreach ($location_phone as $phone) {
															echo '<div>'.$phone.'</div>';
														}
														echo '</div>
													<div class="col-lg-5 location-email">';
													foreach ($location_email as $email) {
															echo '<div>'.$email.'</div>';
														}
														echo '</div>
													</div>
												</a>
												</div>
											</div>
										</div>';
									}//end else condition..
								}// end if(isset($selected_organization) && $selected_organization != "")
								//execute if there is no any select organization..
								else{
									echo '<div class="row">
											<div class="col-lg-12 top-label">
												<div class="row">
													<div class="col-lg-6 location-name">'.$location_name.'</div>
													<div class="col-lg-6 location-city">'.$location_city.'</div>
												</div>
											</div>
										</div>';
										echo '<div class="row">
											<div class="col-lg-12">
												<div class="bottom-label '.$i.'" id="'.$location_id.'">
												<a href="'.base_url().'setting/location/'.$location_id.'">
													<div class="row">
														<div class="col-lg-4 location-address">
															<div>'.$location_address.'</div>
														</div>
														<div class="col-lg-3 location-phone">';
														foreach ($location_phone as $phone) {
															echo '<div>'.$phone.'</div>';
														}
														echo '</div>
													<div class="col-lg-5 location-email">';
													foreach ($location_email as $email) {
															echo '<div>'.$email.'</div>';
														}
														echo '</div>
													</div>
												</a>
												</div>
											</div>
										</div>';
									}//end else..

								$i++;
								
							}//end foreach loop
						}//close if condition..
						//execute if there is no any organization in database
						else
						{
							// error message when there is no any organizaion location
							echo '<div class="row">
									<div class="col-lg-12 alert-msg">
										There is no any Organization Location.
									</div>
								</div>';
							// end error message when there is no any organizaion location
						}
						?>

						</div><!-- //end location-grid -->
					</div>
				</div>

			</div>
			<!-- // left hand site division -->

			<!-- right hand site division -->
			<div class="col-lg-6 right-side">

				<div class="display-div">
						
					<div class="row" style="padding:6px 15px;">
						<div class="col-lg-12 location-heading">
							<div class="row">
								<!-- location form heading -->
								<div class="col-lg-4">
									<?php
									if( isset($selected_organization) && !empty($selected_organization) )
									{
										echo "Edit Location";
									}
									else
									{
										echo "Add Location";
									}
									?>
								</div>
								<!-- // end location form heading -->
								<div class="col-lg-8 msg success-msg">
									<?php
									if( $this->session->userdata('insert_org_location') != "" )
									{
										echo "Location Has Been Successfully Added.";
									}
									else if( $this->session->userdata('update_org_location') != "" )
									{
										echo "Location Has Been Successfully Updated.";
									}
									?>
								</div>
							</div>
						</div>
						
					</div>

					<div class="location-form">
						<?php echo form_open('setting/location','id="loc-form"'); ?>
						
						<?php
						//execute if any organization selected for updation..
						//then display editable mode form..
						if( isset($selected_organization) && !empty($selected_organization) )
						{
						?>
						
						<div class="row">
							<div class="col-lg-5">
								<div class="label-text">Location Name</div>
								<div><input type="text" name="location_name" value="<?php echo $selected_organization['location_name']?>" class="form-control loc-name"></div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Location Head</div>
								<div><input type="text" name="location_head" value="<?php echo $selected_organization['location_head']?>" class="form-control"></div>
							</div>
						</div>
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-12">
								<div class="label-text">Location Address</div>
								<div><textarea name="address" rows="2" class="form-control address-text"><?php echo $selected_organization['address']?></textarea></div>
							</div>
							
						</div>

						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5">
								<div class="label-text">Country</div>
								<div>
									<select class="form-control country" onchange="print_state('state' , this.selectedIndex);" id="country" name ="country"></select>
								</div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">State</div>
								<div>
									<select name ="state" id ="state" class="form-control state"></select>
									<script language="javascript">print_country("country");</script>
								</div>
							</div>
						</div>

						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5">
								<div class="label-text">City</div>
								<div><input type="text" value="<?php echo $selected_organization['city']?>" name="city" class="form-control city-text"></div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Website</div>
								<div><input type="text" value="<?php echo $selected_organization['website']?>" name="website" class="form-control web-text"></div>
							</div>
						</div>

						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5">
								
								<div class="row">
									<div class="col-lg-12">
										<div class="label-text">Email Id.</div>
										<div class="email">
										<?php
										$organization_email = explode(',',$selected_organization['email']);
										for($a = 0; $a< count($organization_email); $a++)
										{
											if($organization_email[$a] != "")
											{
												if($a == 0)
												{
												echo '<input type="text" value="'.$organization_email[$a].'" name="email[]" class="form-control email-text">';
												}
												else
												{
												echo '<input type="text" value="'.$organization_email[$a].'" name="email[]" class="form-control email-text" style="margin-top:10px;">';
												}
											}
										}
										?>

											
										</div>
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
											<?php
											$organization_phone = explode(',',$selected_organization['phone']);
											for($a = 0; $a< count($organization_phone); $a++)
											{
												if($organization_phone[$a] != "")
												{
													if($a == 0)
													{
													echo '<input type="text" value="'.$organization_phone[$a].'" name="phone[]" class="form-control phone-text">';
													}
													else
													{
													echo '<input type="text" value="'.$organization_phone[$a].'" name="phone[]" class="form-control phone-text" style="margin-top:10px;">';
													}
												}
											}
											?>
											
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

							</div>
						</div>

						<div class="row" style="margin-top:15px;">
							<div class="col-lg-3 col-lg-offset-3">
								<input type="hidden" name="id" value="<?php echo $selected_organization['id']; ?>">
								<input type="hidden" name="update_location" value="success">
								<div class="submit-btn save-btn form-submit-btn">Update</div>
							</div>
							<div class="col-lg-3">
								<div class="cancel-btn" id="reset">Cancle</div>
							</div>
						</div>

						<?php
						}
						else
						{
						?>

						<div class="row">
							<div class="col-lg-5">
								<div class="label-text">Location Name</div>
								<div><input type="text" name="location_name" class="form-control loc-name"></div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Location Head</div>
								<div><input type="text" name="location_head" class="form-control"></div>
							</div>
						</div>
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-12">
								<div class="label-text">Location Address</div>
								<div><textarea name="address" rows="2" class="form-control address-text"></textarea></div>
							</div>
							
						</div>

						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5">
								<div class="label-text">Country</div>
								<div>
									<select class="form-control country" onchange="print_state('state' , this.selectedIndex);" id="country" name ="country"></select>
								</div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">State</div>
								<div>
									<select name ="state" id ="state" class="form-control state"></select>
									<script language="javascript">print_country("country");</script>
								</div>
							</div>
						</div>

						<div class="row" style="margin-top:15px;">
							<div class="col-lg-5">
								<div class="label-text">City</div>
								<div><input type="text" name="city" class="form-control city-text"></div>
							</div>
							<div class="col-lg-5 col-lg-offset-2">
								<div class="label-text">Website</div>
								<div><input type="text" name="website" class="form-control web-text"></div>
							</div>
						</div>

						<div class="row" style="margin-top:15px;">
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

							</div>
						</div>

						<div class="row" style="margin-top:15px;">
							<div class="col-lg-3 col-lg-offset-3">
								<input type="hidden" name="insert_location" value="success">
								<div class="submit-btn save-btn form-submit-btn">Save</div>
							</div>
							<div class="col-lg-3">
								<div class="cancel-btn" id="reset">Cancle</div>
							</div>
						</div>

						<?php
						}//end else condition.. 
						//end display new location form
						?>

						


						<?php echo form_close(); ?>
						
					</div><!-- // end location-form -->

				</div><!-- // end display-div -->
			</div>
			<!-- // right hand site division -->
		</div>
	</div>
</div>

<?php
}//end else condition //organization set into databse..
?>

<script type="text/javascript">

// $(document).ready(function() {
//     formmodified=0;
//     $('form *').change(function(){
//         formmodified=1;
//     });
//     window.onbeforeunload = confirmExit;
//     function confirmExit() {
//         if (formmodified == 1) {
//             return "New information not saved. Do you wish to leave the page?";
//         }
//     }
// });

jQuery(document).ready(function($) {

	$("#reset").click(function(event) {
		/* Act on the event */
		$(".form-control").val("");
	});	


	<?php 
	//execute after organization is successfully inserted and show success msg.
	if( $this->session->userdata('insert_org_location') != "" )
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
	if( $this->session->userdata('update_org_id') != "" )
	{
	?>
		var location_id = "<?php echo $this->session->userdata('update_org_id'); ?>"
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
	
	//add more phone textbox on click on add more 
	$(".add-phone").click(function(){
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
	$(".add-email").click(function(){
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
	$('.location-form').on('keypress','.phone-text',function(e){
		//if the letter is not digit then display error and don't type anything
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
	});

	//by default hide remove text box button..
	$(".remove-box").hide();

	//script execute when click on remove phone button..
	$(".remove-phone").click(function() {

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
	$(".remove-email").click(function() {

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

	//creating a exist_organization_location array for store all previous organization location..
	var exist_organization_location = [];

	//execute when any organization location is selected for update.
	//then already selected country and state..
	<?php
	if(isset($selected_organization) && $selected_organization != "")
	{
		?>

		//select those country which is present in database..
		$("#country").val("<?php echo $selected_organization['country']; ?>").attr('selected','selected');

		//get country_index which is selected..
		var country_index = $('#country :selected').index();

		//display all state of selected Country..
		print_state_country('state',country_index);

		//select those state which is present in database..
		$("#state").val("<?php echo $selected_organization['state']; ?>").attr('selected','selected');

		<?php
		//foreach loop for insert organization locaiton name into exist_organization_location array..
		foreach ($organization_location as $value) 
		{
			//create a condition for selected location name is not push into array..
			if($selected_organization['location_name'] != $value['location_name'])
			{	
			?>
				exist_organization_location.push("<?php echo strtolower($value['location_name']);?>");
			<?php
			}
		}
	}
	else
	{
		foreach ($organization_location as $value) 
		{	
		?>
			exist_organization_location.push("<?php echo strtolower($value['location_name']);?>");
		<?php
		}
	}
	?>

	//execute if click on submit-btn
	$(".form-submit-btn").click(function() {

		//check location name is not empty..
		if( $('.loc-name').val() == "" )
		{
			flag_location_name = 0;
			$('.loc-name').parent().addClass('has-error');
		}
		else
		{
			//check location name is not already taken..
			//firsty convert entered location name to lowercase
			//then check if this locaiton name is exist in exist_organization_location array.
			//then show error message..
			if( $.inArray( ($('.loc-name').val().toLowerCase() ) , exist_organization_location ) > -1 )
			// if(exist_organization_location.indexOf( $('.location-name').val() ))
			{
				flag_location_name = 0;
				$('.loc-name').parent().addClass('has-error');
			}
			else
			{
				flag_location_name = 1;
			}
		}

		//check address is not empty
		if($('.address-text').val() == "")
		{
			flag_address = 0;
			$('.address-text').parent().addClass('has-error');
		}
		else
		{
			flag_address = 1;
		}

		//check country is not selected or not
		if( $('.country').val() == "" )
		{
			$(".country").parent().addClass('has-error');
			$(".country-error").show();
			flag_country = 0;
		}
		else
		{
			flag_country = 1;
		}

		//check state is not selected or not
		if( $('.state').val() == "" ||  $('.state').val() == null )
		{
			$(".state").parent().addClass('has-error');
			$(".state-error").show();
			flag_state = 0;
		}
		else
		{
			flag_state = 1;
		}

		//check city is not selected or not
		if( $(".city-text").val() == "" )
		{
			$(".city-text").parent().addClass('has-error');
			$(".city-error").show();
			flag_city = 0;
		}
		else
		{
			flag_city = 1;
		}

		//execute if website is not empty
		if( $('.web-text').val() != "" )
		{
			var website = $('.web-text').val();
			//execute if website is valid
			website_regex = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
			if( website_regex.test($('.web-text').val()) )
			{
				flag_website = 1;
			}
			//execute if website is not valid
			else
			{
				//display error
				$('.web-text').parent().addClass('has-error');
				flag_website = 0;
			}
		}
		else{
			flag_website = 1;
		}
	

		//check city is not selected or not
		$('.phone-text').each(function()
		{
			if($(this).val() == "")
			{
				$(this).parent().addClass('has-error');
				$(".phone-error").show();
				flag_phone = 0;
			}
			else
			{
				flag_phone = 1;
			}
		});

		$('.email-text').each(function()
		{
			//execute if email id is empty
			if($(this).val() == "")
			{
				//display error..
				$(this).parent().addClass('has-error');
				$(".email-error").show();
				flag_email = 0;
			}
			//execute if email id is not empty..
			else
			{
				//execute if email id is valid
				// email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
				email_regex = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
				if( email_regex.test( $(this).val() ) )
				{
					flag_email = 1;
				}
				//execute if email id is not valid
				else
				{
					//display error
					$(this).parent().addClass('has-error');
					$(".email-valid-error").show();
					flag_email = 0;
				}
			}
		});

		
		if(flag_location_name == 1 && flag_address == 1 && flag_country == 1 && flag_state == 1 && flag_city == 1 && flag_phone == 1 && flag_email == 1 && flag_website == 1)
		{
			$("#loc-form").submit();
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

	//execute when click on organization location name textbox..
	//then remove has-error class
	$(".location-form").on('focusin','.loc-name',function(){
		$('.loc-name').parent().removeClass('has-error');
	});

	//execute when click on organization location address textbox..
	//then remove has-error class
	$(".location-form").on('focusin','.address-text',function(){
		$('.address-text').parent().removeClass('has-error');
	});

	//execute when click on organization location Country textbox..
	//then remove has-error class
	$(".location-form").on('focusin','.country',function(){
		$('.country').parent().removeClass('has-error');
	});

	//execute when click on organization location state textbox..
	//then remove has-error class
	$(".location-form").on('focusin','.state',function(){
		$('.state').parent().removeClass('has-error');
	});

	//execute when click on organization location city textbox..
	//then remove has-error class
	$(".location-form").on('focusin','.city-text',function(){
		$('.city-error').hide();
		$('.city-text').parent().removeClass('has-error');
	});

	//execute when click on organization location phone textbox..
	//then remove has-error class
	$(".location-form").on('focusin','.phone-text',function(){
		$('.phone-text').parent().removeClass('has-error');
	});

	$(".location-form").on('focusin','.email-text',function(){
		$('.email-text').parent().removeClass('has-error');
	});

	$(".location-form").on('focusin','.web-text',function(){
		$('.web-text').parent().removeClass('has-error');
	});


	// execute script when user want to search location
	$(".search-location").keyup(function(event) {

		var search_value = $.trim($(this).val());
		// if(search_value != "")
		{
			$.ajax({
				url: '<?php echo base_url();?>index.php/setting/location_search',
				type: 'POST',
				data: {search_location: search_value},
				success: function(result){
					$(".location-grid").html(result);
					// alert(result);
				}
			});
		}
	});


	
});

// if( $(".search-location").val() != "" )
// 	{
// 		var search_value = $.trim( $(".search-location").val() );
// 		$.ajax({
// 				url: '<?php echo base_url();?>index.php/setting/location_search',
// 				type: 'POST',
// 				data: {search_location: search_value},
// 				success: function(result){
// 					$(".location-grid").html(result);
// 					// alert(result);
// 				}
// 			});
// 	}
</script>

<?php
$this->session->unset_userdata('insert_org_location');
$this->session->unset_userdata('update_org_location');
$this->session->unset_userdata('update_org_id');
?>
