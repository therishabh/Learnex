<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Tax Setting
	</div>
	<div class="col-lg-6">
		
	</div>
</div>
<!-- // end heading -->

<!-- navigation top bar -->
<div class="row nav">
	<a href="<?php echo base_url();?>setting/organization">
		<div class="col-lg-3">Organization</div>
	</a>
	<a href="<?php echo base_url();?>setting/location">
	
		<div class="col-lg-3">Organization Location</div>
	</a>
	<a href="#">
		<div class="col-lg-3 active">Tax</div>
	</a>
	<a href="">
		<div class="col-lg-3">Manage Year</div>
	</a>
</div>
<!-- // end navigation top bar -->

<div class="row tax">
	<div class="col-lg-5 col-lg-offset-4 success-msg">
		<?php
		if( $this->session->userdata('insert_tax') )
		{
			echo "Tax Has Been Successfully Saved.";
		}
		else if( $this->session->userdata('update_tax') )
		{
			echo "Tax Has Been Successfully Updated.";
		}
		?>
	</div>
</div>
<?php
//if tax is not inserted into database...
//then display new tax form for insert value into database.. 
if( $tax_detail['tax_name'] == "" )
{
?>
<div class="row form">
	<div class="col-lg-12">

		<?php echo form_open('setting/tax','id="tax-form"'); ?>
		<div class="row ">
			<div class="col-lg-4 label-text">Tax Name</div>
			<div class="col-lg-3">
				<input type="text" class="form-control tax-name"  name="tax_name">
			</div>
			<div class="col-lg-4 error-msg name-error">
				Fill Tax Name
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Tax Value</div>
			<div class="col-lg-3">
				<input type="text" class="form-control percent-box tax-value" name="tax_value">
			</div>
			<div class="col-lg-4 error-msg value-error">
				Fill Tax Value
			</div>

		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Tax Applicable</div>
			<div class="col-lg-3" style="text-align:center;">
				<label>
					<input type="checkbox" name="tax_applicable" value="yes" class="checkbox">
					<div class="checkbox-img"></div>
				</label>
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-3 col-lg-offset-4 end">
				<input type="hidden" value="success" name="insert_btn">
				<div class="submit-btn save-btn">Save</div>
			</div>
		</div>
		<?php echo form_close(); ?>

	</div><!-- end col-lg-12 -->
</div><!-- end row form -->
<?php
}
//execute if user want to update tax information
//then display tax information into updated form..
else if( isset($update_tax) && !empty($update_tax) )
{
?>
<div class="row form">
	<div class="col-lg-12">

		<?php echo form_open('setting/tax','id="tax-form"'); ?>
		<div class="row ">
			<div class="col-lg-4 label-text">Tax Name</div>
			<div class="col-lg-3">
				<input type="text" class="form-control tax-name" value="<?php echo $tax_detail['tax_name']; ?>" name="tax_name">
			</div>
			<div class="col-lg-4 error-msg name-error">
				Fill Tax Name
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Tax Value</div>
			<div class="col-lg-3">
				<input type="text" class="form-control percent-box tax-value" value="<?php echo $tax_detail['tax_value']; ?>" name="tax_value">
			</div>
			<div class="col-lg-4 error-msg value-error">
				Fill Tax Value
			</div>

		</div>

		<div class="row form-label">
			<div class="col-lg-4 label-text">Tax Applicable</div>
			<div class="col-lg-3" style="text-align:center;">
				<?php
					if($tax_detail['applicable'] == "1")
					{
						echo '<label>
						<input type="checkbox" class="checkbox" checked value="yes" name="tax_applicable">
						<div class="checkbox-img"></div>
						</label>';
					}
					else
					{
						echo '<label>
						<input type="checkbox" class="checkbox" value="yes" name="tax_applicable">
						<div class="checkbox-img"></div>
						</label>';
					}
					?>
			</div>
		</div>

		<div class="row form-label">
			<div class="col-lg-3 col-lg-offset-4 end">
				<input type="hidden" value="success" name="update_btn">
				<div class="submit-btn save-btn">Update</div>
			</div>
		</div>
		<?php echo form_close(); ?>

	</div><!-- end col-lg-12 -->
</div><!-- end row form -->
<?php
}
//execute if tax is already set then display in view mode..
else
{
	?>
	<div class="row">
		<div class="col-lg-12 view-mode">
			<div class="row view-row">
				<div class="col-lg-6 label-heading">Tax Name :</div>
				<div class="col-lg-4 label-value end"><?php echo $tax_detail['tax_name']; ?></div>
			</div>

			<div class="row view-row">
				<div class="col-lg-6 label-heading">Tax Value :</div>
				<div class="col-lg-4 label-value end"><?php echo $tax_detail['tax_value']; ?></div>
			</div>

			<div class="row view-row">
				<div class="col-lg-6 label-heading">Tax Applicable :</div>
				<div class="col-lg-4 label-value end">
					<?php
					if($tax_detail['applicable'] == "1")
					{
						echo "Yes";
					}
					else
					{
						echo "No";
					}
					?>
				</div>
			</div>

			<div class="row view-row">
				<div class="col-lg-3 col-lg-offset-4 label-value end">
					<div class="row">
						<div class="col-lg-8 col-lg-offset-2">
							
						<?php echo form_open('/setting/tax/update'); ?>
						<input type="submit" value="Edit" class="submit-btn save-btn" name="update-btn">
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

<!-- <label>
	<input type="radio" name="hello" class="radio">
	<div class="radio-img"></div>
</label>

<label>
	<input type="radio" name="hello" class="radio">
	<div class="radio-img"></div>
</label> -->

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.percent-box').keypress(function(e) {
	
		//if the letter is not digit then display error and don't type anything
		if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {

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

	$(".percent-box").keyup(function(e) {
		/* Act on the event */
		
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
					$(this).val($(this).val()[1])
				}
			}
		}

	});
	$(".percent-box").focusout(function() {
		/* Act on the event */
		var acb = $(this).val().split(".")[1].length;
		if(acb == "0")
		{
			$(this).val($(this).val().split('.')[0] + ".00" );
		}
	});

	$(".error-msg").hide();

	$(".submit-btn").click(function(){

		if( $(".tax-name").val() != "" )
		{
			var flag_name = 1;
		}
		else
		{
			$(".tax-name").parent().addClass('has-error');
			$(".name-error").show();
			var flag_name = 0;
		}

		if( $(".tax-value").val() != "" )
		{
			var flag_value = 1;
		}
		else
		{
			$(".tax-value").parent().addClass('has-error');
			$(".value-error").show();
			var flag_value = 0;
		}
		if(flag_name == 1 && flag_value == 1)
		{
			$("#tax-form").submit();
		}
	});

	$(".tax-name").focusin(function() {
		$(".tax-name").parent().removeClass('has-error');
		$(".name-error").hide();
	});

	$(".tax-value").focusin(function() {
		$(".tax-value").parent().removeClass('has-error');
		$(".value-error").hide();
	});

	<?php
	if( $this->session->userdata('insert_tax') )
	{
	?>
	$(".success-msg").delay(4000).slideUp(1000);
	<?php
	}
	else if( $this->session->userdata('update_tax') )
	{
	?>
	$(".success-msg").delay(4000).slideUp(1000);
	<?php
	}
	?>
});
</script>
<?php
$this->session->unset_userdata('insert_tax');
$this->session->unset_userdata('update_tax');
?>