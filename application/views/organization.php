<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Organization Setting
	</div>
	<div class="col-lg-6">
		
	</div>
</div>
<!-- // end heading -->
<!-- navigation top bar -->
<div class="row nav">
	<a href="<?php echo base_url();?>setting/organization">
		<div class="col-lg-3 active">Organization</div>
	</a>
	<a href="<?php echo base_url();?>setting/location">

		<div class="col-lg-3">Organization Location</div>
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
//check if there is not set any organization..
if($organization_detail['name'] == "")
{
	echo form_open_multipart('setting/organization','id="organization_detail_form"');
?>
<div class="row form">
	<div class="col-lg-12">
		<div class="row ">
			<div class="col-lg-4 label-text">Organization Name</div>
			<div class="col-lg-3">
				<input type="text" class="form-control organization_name" name="organization_name">
			</div>
			<div class="col-lg-4 error-msg name-error">
				Fill Organization Name
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Organization Logo</div>
			<div class="col-lg-3">
				<label style="width:100%;">
					<input type="file" style="display:none;" name="logo_choose" id="files">
					<div class="upload-file">Upload Logo</div>
				</label>
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg">
				
			</div>
		</div>

		<div class="row form-label logo-display">
			<div class="col-lg-3 col-lg-offset-4 end image">
				<div id="uploaded-image"></div>
				<div class="cross">
					<img src="<?php echo base_url();?>img/close.png" alt="">
				</div>

			</div>
		</div>

		

		<div class="row form-label">
			<div class="col-lg-4 label-text">Organization Address</div>
			<div class="col-lg-3">
				<textarea name="organization_address" cols="30" rows="4" class="organization_address form-control"></textarea>
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg address-error">
				Fill Organization Address
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Country</div>
			<div class="col-lg-3">
				<select class="form-control country" onchange="print_state('state' , this.selectedIndex);" id="country" name ="country"></select>
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg country-error">
				Select Organization Country
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">State</div>
			<div class="col-lg-3">
				<select name ="state" id ="state" class="form-control state"></select>
				<script language="javascript">print_country("country");</script>	
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg state-error">
				Select Organization State
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">City</div>
			<div class="col-lg-3">
				<input type="text" name="city" class="city form-control">
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg city-error">
				Fill Organization City
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Phone No.</div>
			<div class="col-lg-3">
			<div class="row phone">
				<div class="col-lg-12">
					<input type="text" name="phone[]" class="phone_no form-control">
				</div>
			</div>
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg phone-error">
				Fill Organization Phone
			</div>
		</div>
		<div class="row add-more">
			<div class="col-lg-2 col-lg-offset-4 add-phone">
				<span>+ Add More</span>
			</div>
			<div class="col-lg-1 remove-box remove-phone" style="text-align:right">
				<span>- Remove</span>
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Email Id</div>
			<div class="col-lg-3">
				<div class="row email">
					<div class="col-lg-12">
						<input type="text" name="email[]" placeholder="hello@example.com" class="email_id form-control">
					</div>
				</div>
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg email-error">
				Fill Organization Email Id.
			</div>
			<div class="col-lg-4 error-msg email-valid-error">
				Enter a Valid Email Address
			</div>
		</div>
		<div class="row add-more">
			<div class="col-lg-2 col-lg-offset-4 add-email">
				+ Add More
			</div>
			<div class="col-lg-1 remove-box remove-email" style="text-align:right">
				- Remove
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Website</div>
			<div class="col-lg-3">
				<div class="row website">
					<div class="col-lg-12">
						<input type="text" name="website[]" placeholder="http://www.example.com" class="form-control website-textbox">
					</div>
				</div>
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg website-error">
				Enter a Valid Website
			</div>
		</div>
		<div class="row add-more">
			<div class="col-lg-2 col-lg-offset-4 add-website">
				+ Add More
			</div>
			<div class="col-lg-1 remove-box remove-website" style="text-align:right">
				- Remove
			</div>
		</div>

		<div class="row form-label">
			
			<div class="col-lg-3 col-lg-offset-4 end">
				<input type="hidden" value="success" name="insert_btn">
				<div class="submit-btn save-btn">Save</div>
			</div>
		</div>
	</div>
</div>

<?php
echo form_close();
}
//execute if user want to update organization information
//then display organization information into updated form..
else if( isset($update_organization) && !empty($update_organization) )
{
		echo form_open_multipart('setting/organization','id="organization_detail_form"');
?>
<div class="row form">
	<div class="col-lg-12">
		<div class="row ">
			<div class="col-lg-4 label-text">Organization Name</div>
			<div class="col-lg-3">
				<input type="text" value="<?php echo $organization_detail['name']?>" class="form-control organization_name" name="organization_name">
			</div>
			<div class="col-lg-4 error-msg name-error">
				Fill Organization Name
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Organization Logo</div>
			<div class="col-lg-3">
				<label style="width:100%;">
					<input type="file" style="display:none;" name="logo_choose" id="files">
					<input type="hidden" name="default_logo" id="default_logo" value="<?php echo $organization_detail['logo'] ?>">

					<div class="upload-file">Upload Logo</div>
				</label>
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg">
				
			</div>
		</div>

		<div class="row form-label logo-display">
			<div class="col-lg-3 col-lg-offset-4 end image">
				<div id="uploaded-image">
					<?php
					$base_url = base_url();
					if($organization_detail['logo'] != "")
					{
						$organization_logo = $organization_detail['logo'];
						
						echo "<img src='$base_url/uploads/organization_logo/$organization_logo'>";
					}
					?>
				</div>
				<div class="cross">
					<img src="<?php echo base_url();?>img/close.png" alt="">
				</div>

			</div>
		</div>

		

		<div class="row form-label">
			<div class="col-lg-4 label-text">Organization Address</div>
			<div class="col-lg-3">
				<textarea name="organization_address" cols="30" rows="4" class="organization_address form-control"><?php echo $organization_detail['address']?></textarea>
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg address-error">
				Fill Organization Address
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Country</div>
			<div class="col-lg-3">
				<select class="form-control country" onchange="print_state('state' , this.selectedIndex);" id="country" name ="country"></select>
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg country-error">
				Select Organization Country
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">State</div>
			<div class="col-lg-3">
				<select name ="state" id ="state" class="form-control state"></select>
				<script language="javascript">print_country("country");</script>	
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg state-error">
				Select Organization State
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">City</div>
			<div class="col-lg-3">
				<input type="text" name="city" value="<?php echo $organization_detail['city']; ?>" class="city form-control">
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg city-error">
				Fill Organization City
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Phone No.</div>
			<div class="col-lg-3">
			
					<?php
					$organization_phone = explode(',',$organization_detail['phone']);
					for($a = 0; $a< count($organization_phone); $a++)
					{
						//check if phone no is not blank
						if($organization_phone[$a] != "")
						{
							if($a == 0)
							{
								echo '<div class="row phone">
									<div class="col-lg-12">';
								echo '<input type="text" name="phone[]" value="'.$organization_phone[$a].'" class="phone_no form-control">';
								echo '</div>
									</div>';
							}
							else
							{
								echo '<div class="row phone" style="margin-top:10px;">
									<div class="col-lg-12">';
								echo '<input type="text" name="phone[]" value="'.$organization_phone[$a].'" class="phone_no form-control">';
								echo '</div>
									</div>';
							}
						}
					}
					?>
					
					
				
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg phone-error">
				Fill Organization Phone
			</div>
		</div>
		<div class="row add-more">
			<div class="col-lg-2 col-lg-offset-4 add-phone">
				<span>+ Add More</span>
			</div>
			<div class="col-lg-1 remove-box remove-phone" style="text-align:right">
				<span>- Remove</span>
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Email Id</div>
			<div class="col-lg-3">
				<?php
					$organization_email = explode(',',$organization_detail['email']);
					for($a = 0; $a< count($organization_email); $a++)
					{
						//check if phone no is not blank
						if($organization_email[$a] != "")
						{
							if($a == 0)
							{
								echo '<div class="row email">
									<div class="col-lg-12">';
								echo '<input type="text" name="email[]" value="'.$organization_email[$a].'" class="email_id form-control">';
								echo '</div>
									</div>';
							}
							else
							{
								echo '<div class="row email" style="margin-top:10px;">
									<div class="col-lg-12">';
								echo '<input type="text" name="email[]" value="'.$organization_email[$a].'" class="email_id form-control">';
								echo '</div>
									</div>';
							}
						}
					}
				?>
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg email-error">
				Fill Organization Email Id.
			</div>
			<div class="col-lg-4 error-msg email-valid-error">
				Enter a Valid Email Address
			</div>
		</div>
		<div class="row add-more">
			<div class="col-lg-2 col-lg-offset-4 add-email">
				+ Add More
			</div>
			<div class="col-lg-1 remove-box remove-email" style="text-align:right">
				- Remove
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Website</div>
			<div class="col-lg-3">
				<?php
					$organization_website = explode(',',$organization_detail['website']);
					for($a = 0; $a< count($organization_website); $a++)
					{
						//check if phone no is not blank
						if($organization_website[$a] != "")
						{
							if($a == 0)
							{
								echo '<div class="row website">
									<div class="col-lg-12">';
								echo '<input type="text" name="website[]" value="'.$organization_website[$a].'" class="website-textbox form-control">';
								echo '</div>
									</div>';
							}
							else
							{
								echo '<div class="row website" style="margin-top:10px;">
									<div class="col-lg-12">';
								echo '<input type="text" name="website[]" value="'.$organization_website[$a].'" class="website-textbox form-control">';
								echo '</div>
									</div>';
							}
						}
					}
				?>
				
			</div>
			<!-- </label> -->
			<div class="col-lg-4 error-msg website-error">
				Enter a Valid Website
			</div>
		</div>
		<div class="row add-more">
			<div class="col-lg-2 col-lg-offset-4 add-website">
				+ Add More
			</div>
			<div class="col-lg-1 remove-box remove-website" style="text-align:right">
				- Remove
			</div>
		</div>

		<div class="row form-label">
			
			<div class="col-lg-3 col-lg-offset-4 end">
				<input type="hidden" value="success" name="update_btn">
				<div class="submit-btn save-btn">Update</div>
			</div>
		</div>
	</div>
</div>

<?php
echo form_close();
}
//execute if organization is already set then display in view mode..
else
{
?>
	<div class="row">
		<div class="col-lg-12 view-mode">
			<div class="row view-row">
				<div class="col-lg-4 label-heading">Organization Name :</div>
				<div class="col-lg-4 label-value end"><?php echo $organization_detail['name']; ?></div>
			</div>
			<div class="row view-row">
				<div class="col-lg-4 label-heading">Logo :</div>
				<div class="col-lg-4 label-value end">
				<?php 
				$base_url = base_url();
				$organization_logo = $organization_detail['logo'];
				if($organization_logo != "")
				echo "<img src='$base_url/uploads/organization_logo/$organization_logo' class='logo'>"; 
				?>
					
				</div>
			</div>
			<div class="row view-row">
				<div class="col-lg-4 label-heading">Address :</div>
				<div class="col-lg-4 label-value end"><?php echo $organization_detail['address']; ?></div>
			</div>
			<div class="row view-row">
				<div class="col-lg-4 label-heading">Country :</div>
				<div class="col-lg-4 label-value end"><?php echo $organization_detail['country']; ?></div>
			</div>
			<div class="row view-row">
				<div class="col-lg-4 label-heading">State :</div>
				<div class="col-lg-4 label-value end"><?php echo $organization_detail['state']; ?></div>
			</div>
			<div class="row view-row">
				<div class="col-lg-4 label-heading">City :</div>
				<div class="col-lg-4 label-value end"><?php echo $organization_detail['city']; ?></div>
			</div>

			<div class="row view-row">
				<div class="col-lg-4 label-heading">Phone No :</div>
				<div class="col-lg-4 label-value end">
				<?php
				$organization_phone = explode(',',$organization_detail['phone']);
				for($a = 0; $a< count($organization_phone); $a++)
				{
					//check if phone no is not blank
					if($organization_phone[$a] != "")
					{
					echo "<div class='row'>
					<div class='col-lg-12'>".
						$organization_phone[$a]
					."</div>
					</div>";
					}
				}
				?>
				</div>
			</div>
			<div class="row view-row">
				<div class="col-lg-4 label-heading">Email Id :</div>
				<div class="col-lg-4 label-value end">
				<?php
				$organization_email = explode(',',$organization_detail['email']);
				for($a = 0; $a< count($organization_email); $a++)
				{
					if($organization_email[$a] != "")
					{
					echo "<div class='row'>
						<div class='col-lg-12'>".
							$organization_email[$a]
						."</div>
					</div>";
					}
				}
				?>
				</div>
			</div>

			<div class="row view-row">
				<div class="col-lg-4 label-heading">Website :</div>
				<div class="col-lg-4 label-value end">
					<?php
					$organization_website = explode(',',$organization_detail['website']);
					for($a = 0; $a< count($organization_website); $a++)
					{
						if($organization_website[$a] != "")
						{
							echo "<div class='row'>
							<div class='col-lg-12'>".
								$organization_website[$a]
							."</div>
						</div>";
						}
					}
					?>
				</div>
			</div>
	
			<div class="row view-row">
				<div class="col-lg-3 col-lg-offset-4 label-value end">
					<?php echo form_open('/setting/organization/update'); ?>
					<input type="submit" value="Edit" class="submit-btn save-btn" name="update-btn">
					<?php echo form_close(); ?>
				</div>
			</div>


		</div>
	</div>
<?php
}

?>




<script type="text/javascript">
jQuery(document).ready(function($) {

	//add more phone textbox on click on add more 
	$(".add-phone").click(function(){
		var new_phone = '<div class="row phone" style="margin-top:10px;"> <div class="col-lg-12"> <input type="text" name="phone[]" class="phone_no form-control"> </div> </div>';
		var new_phone_value = $(".phone").last().children().children().val()
		if(new_phone_value != "")
		{
			$('.phone').last().after(new_phone);
			$(".remove-phone").show();	
		}
		else
		{
			$(".phone").last().children().children().focus();
		}
	});


	//add more email textbox on click on add more
	$(".add-email").click(function(){
		var new_email = '<div class="row email" style="margin-top:10px;"> <div class="col-lg-12"> <input type="text" name="email[]" placeholder="hello@example.com" class="email_id form-control"> </div> </div>';
		var new_email_value = $(".email").last().children().children().val()
		if(new_email_value != "")
		{
			$('.email').last().after(new_email);	
			$(".remove-email").show();
		}
		else
		{
			$(".email").last().children().children().focus();
		}
	});

	//add more website textbox on click on add more
	$(".add-website").click(function(){
		var new_website = '<div class="row website" style="margin-top:10px;"> <div class="col-lg-12"> <input type="text" name="website[]" placeholder="http://www.example.com" class="form-control website-textbox"> </div> </div>';
		var new_website_value = $(".website").last().children().children().val()
		if(new_website_value != "")
		{
			$('.website').last().after(new_website);
			$(".remove-website").show();	
		}
		else
		{
			$(".website").last().children().children().focus();
		}		
	});

	$(".remove-phone").click(function() {

		$('.phone-error').hide();
		$('.phone_no').parent().removeClass('has-error');

		$(".phone").last().slideUp();
		$(".phone").last().remove();
		var i=0;
		$(".phone_no").each(function(){
			i++;
		});
		if(i == 1)
		{
			$(this).hide();
		}
	});

	$(".remove-email").click(function() {
		$('.email-error').hide();
		$('.email-valid-error').hide();
		$('.email_id').parent().removeClass('has-error');

		$(".email").last().slideUp();
		$(".email").last().remove();
		var i=0;
		$(".email_id").each(function(){
			i++;
		});
		if(i == 1)
		{
			$(this).hide();
		}
	});

	$(".remove-website").click(function() {
		$('.website-error').hide();
		$('.website-textbox').parent().removeClass('has-error');

		$(".website").last().slideUp();
		$(".website").last().remove();
		var i=0;
		$(".website-textbox").each(function(){
			i++;
		});
		if(i == 1)
		{
			$(this).hide();
		}
	});


	$(".remove-box").hide();
	$(".remove-email").hide();
	$(".remove-website").hide();



	//create script for accept only integer in phone number.
	$('form').on('keypress','.phone_no',function(e){
		//if the letter is not digit then display error and don't type anything
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
		// var phone = $(this).children().children().val();
	});

	//hide image cross button..
	$(".cross").hide();
	$(".logo-display").hide();

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
		  span.innerHTML = ['<img class="thumb" src="', e.target.result,
		                    '" title="', escape(theFile.name), '"/>'].join('');
		  document.getElementById('uploaded-image').insertBefore(span, null);
			};
		})(f);

		// Read in the image file as a data URL.
		reader.readAsDataURL(f);
		}
	}

	//display logo image when select any logo..
	$('#files').change(function(event) {
		if($(this).val() != "")
		{
			$(".logo-display").slideDown();
			$(".cross").show();
			$("#default_logo").val("");
		}
		else
		{
			$(".cross").hide();
			$(".logo-display").hide();
			$("#default_logo").val("test");
		}
		$("#uploaded-image").html("");

	  	handleFileSelect(event);
	});

	//execute when user want to delete selected logo..
	$(".cross").click(function(){
		$("#files").val("");
		$(".logo-display").slideUp();
		//this is for remove default logo image into update section..
		$("#default_logo").val("");
	});


	//by default hide all errors message..
	$(".error-msg").hide();


	$(".form").on('focusin','.organization_name',function(){
		$('.name-error').hide();
		$('.organization_name').parent().removeClass('has-error');
	});

	$(".form").on('focusin','.organization_address',function(){
		$('.address-error').hide();
		$('.organization_address').parent().removeClass('has-error');
	});


	$(".form").on('focusin','.country',function(){
		$('.country-error').hide();
		$('.country').parent().removeClass('has-error');
	});


	$(".form").on('focusin','.state',function(){
		$('.state-error').hide();
		$('.state').parent().removeClass('has-error');
	});

	$(".form").on('focusin','.city',function(){
		$('.city-error').hide();
		$('.city').parent().removeClass('has-error');
	});

	$(".form").on('focusin','.phone_no',function(){
		$('.phone-error').hide();
		$('.phone_no').parent().removeClass('has-error');
	});

	$(".form").on('focusin','.email_id',function(){
		$('.email-error').hide();
		$('.email-valid-error').hide();
		$('.email_id').parent().removeClass('has-error');
	});

	$(".form").on('focusin','.website-textbox',function(){
		$('.website-error').hide();
		$('.website-textbox').parent().removeClass('has-error');
	});


	// execute if click on save button..
	$(".submit-btn").click(function() {

		if( $('.organization_name').val() == "" )
		{
			$(".organization_name").parent().addClass('has-error');
			$(".name-error").show();
			flag_name = 0;
		}
		else{
			flag_name = 1;
		}

		if( $('.organization_address').val() == "" )
		{
			$(".organization_address").parent().addClass('has-error');
			$(".address-error").show();
			flag_address = 0;
		}
		else{
			flag_address = 1;
		}

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
		if( $('.city').val() == "" )
		{
			$(".city").parent().addClass('has-error');
			$(".city-error").show();
			flag_city = 0;
		}
		else
		{
			flag_city = 1;
		}

		$('.phone_no').each(function()
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

		$('.email_id').each(function()
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
				email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
				
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

		$('.website-textbox').each(function()
		{
			//execute if website is not empty
			if($(this).val() != "")
			{
				//execute if website is valid
				website_regex = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
				if( website_regex.test($(this).val()) )
				{
					flag_website = 1;
				}
				//execute if website is not valid
				else
				{
					//display error
					$(this).parent().addClass('has-error');
					$(".website-error").show();
					flag_website = 0;
				}
			}
			else
			{
				flag_website = 1;
			}
		});

		if(flag_name == "1" && flag_address == "1" && flag_country == "1" && flag_state == "1" && flag_city == "1" && flag_phone == "1" && flag_email == "1" && flag_website == "1")
		{
			$("#organization_detail_form").submit();
		}
	});



	<?php
	if( isset($update_organization) && !empty($update_organization) )
	{
	?>

	//select those country which is present in database..
	$("#country").val("<?php echo $organization_detail['country']; ?>").attr('selected','selected');

	//get country_index which is selected..
	var country_index = $('#country :selected').index();

	//display all state of selected Country..
	print_state_country('state',country_index);

	//select those state which is present in database..
	$("#state").val("<?php echo $organization_detail['state']; ?>").attr('selected','selected');
		
	//display remove phone button..
	var phone_count = 0
	$(".phone").each(function(){
		phone_count++;
	});

	if(phone_count != 1)
	{
		$(".remove-phone").show();
	}

	//display remove email button..
	var email_count = 0
	$(".email").each(function(){
		email_count++;
	});

	if(email_count != 1)
	{
		$(".remove-email").show();
	}

	//display remove website button..
	var website_count = 0
	$(".website").each(function(){
		website_count++;
	});

	if(website_count != 1)
	{
		$(".remove-website").show();
	}


	<?php
		if($organization_detail['logo'] != "")
		{
		?>
			$(".logo-display").show();
			$('.cross').show();
		<?php
		}
	}
	?>



});
</script>