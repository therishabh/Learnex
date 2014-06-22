
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
	//end script for percent box..
	
	
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
						$(".discount-fix-value").val("0");
						$(".net-fee-amount").val(course_fee_value);
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
					$(".net-fee-amount").val(course_fee_value);
				}
			}
			else
			{
				var x = $("#course-fee-value").val();
				$(".net-fee-amount").val(x);
			}
		}
		else
		{
			$(".net-fee-amount").val("");
		}

		
	});
	
	$("#course-name").focusin(function() {
		$(this).parent().removeClass('has-error');
	})
	//focus in on course fee textbox
	$("#course-fee-value").focusin(function() {
		$(this).parent().removeClass('has-error');
		$(".net-fee-amount").parent().removeClass('has-error');

		$(this).select();
		if($(this).val() == "0")
		{
			$(this).val("");
		}
	});


	$("#course-fee-value").focusout(function(){

		if($(this).val() == ".")
		$(this).val("0");

		if(parseFloat($(this).val()) == "0")
		$(this).val("0");

		if($(this).val() == "")
		$(this).val("0");

		if( $("#discount-checkbox").is(":checked") )
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
					$(".net-fee-amount").val(z);			
				}
				
			}
			//if fix value discount radio button is checked..
			else if( $("#fix-value-discount").is(":checked") )
			{
				var discount_fix_value = $(".discount-fix-value").val();
				var course_fee = $("#course-fee-value").val();
				//check if percent value is not empty..
				if(discount_fix_value != "")
				{
					var x = parseFloat(course_fee) - parseFloat(discount_fix_value);	 
					$(".net-fee-amount").val(x);		
				}
			}
			else
			{
				$(".net-fee-amount").val($("#course-fee-value").val());
			}
		}
		else
		{
			$(".net-fee-amount").val($("#course-fee-value").val());
		}


		if( parseFloat($('.net-fee-amount').val()) != "0" )
		{
			$("#instalment-checkbox").removeAttr('disabled');
		}
		else
		{
			$("#instalment-checkbox").prop('disabled',true);
		}

	});




	// execute if click on discount checkbox
	$("#discount-checkbox").click(function() {
		//if checkbox is checked..
		if($(this).is(':checked'))
		{
			//display discount-option-div...
			//for select fix value or percentage value..
			$(".discount-option-div").slideDown();

			if( $("#percent-discount").is(":checked") )
			{
				$(".discount-percent-box").slideDown();
			}

			if( $("#fix-value-discount").is(":checked") )
			{
				$(".discount-rupee-box").slideDown();
			}
		}
		//if checkbox is unchecked..
		else
		{
			//remove error class form discount mode radio button..
			$('input:radio[name="discount_mode"]').parent().parent().removeClass('test');

			$(".discount-percent-value").parent().removeClass('has-error');
			$(".discount-fix-value").parent().removeClass('has-error');

			//slideup discount-option-div...
			//which is for select fix value or percentage value..
			$(".discount-option-div").slideUp();
			$(".discount-rupee-box").hide();
			$(".discount-percent-box").hide();
			$(".net-fee-amount").val($("#course-fee-value").val());
		}
	});

	//execute if click on discount mode on percent radio button ..
	$("#percent-discount").click(function(event) {
		$('input:radio[name="discount_mode"]').parent().parent().removeClass('test');
		if($(this).is(":checked"))
		{
			$(".discount-rupee-box").hide();
			$(".discount-percent-box").slideDown();
			$(".discount-fix-value").val("0");
			$(".net-fee-amount").val($("#course-fee-value").val());
		}
	});


	//execute if click on discount mode on fix radio button ..
	$("#fix-value-discount").click(function() {
		$('input:radio[name="discount_mode"]').parent().parent().removeClass('test');
		if($(this).is(":checked"))
		{
			$(".discount-percent-box").hide();
			$(".discount-rupee-box").slideDown();
			$(".discount-percent-value").val("0");
			$(".net-fee-amount").val($("#course-fee-value").val());
		}
	});

	
	$(".discount-percent-value").focusout(function() {

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

		if( parseFloat($('.net-fee-amount').val()) != "0" )
		{
			$("#instalment-checkbox").removeAttr('disabled');
		}
		else
		{
			$("#instalment-checkbox").prop('disabled',true);
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
			$(".net-fee-amount").val(course_fee);
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

		if( parseFloat($('.net-fee-amount').val()) != "0" )
		{
			$("#instalment-checkbox").removeAttr('disabled');
		}
		else
		{

			$("#instalment-checkbox").prop('disabled',true);
		}
	});

	$(".discount-fix-value").focusin(function() {

		$(".discount-fix-value").parent().removeClass('has-error');

		$(this).select();
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
			$(".net-fee-amount").val(course_fee);
		}


	});



	//installment script..!..
	
	// execute if click on discount checkbox
	$("#instalment-checkbox").click(function() {

		//if checkbox is checked..
		if($(this).is(':checked'))
		{
			$(".instalment-val-box").html("");
			//display discount-option-div...
			//for select fix value or percentage value..
			$(".instalment-mode-select").slideDown();
			$(".instalment-number").slideDown();

			if( $("#percent-ins").is(":checked") )
			{
				
				var num_of_ins = $("#num-of-instalment").val();
				for(var i = 1; i<= num_of_ins; i++)
				{
					var div = '<div class="row" style="margin-top:10px;"><div class="col-lg-5 heading">'+i+' Instalment</div> <div class="col-lg-7"> <input type="text" class="form-control percent-box inst_per_val" id="ins-'+i+'" name="instalment_percent_value[]"> </div> </div>';
					$(".instalment-val-box").append(div);
				}
			}
			if( $("#fix-value-ins").is(":checked") )
			{
				var num_of_ins = $("#num-of-instalment").val();
				for(var i = 1; i<= num_of_ins; i++)
				{
					var div = '<div class="row" style="margin-top:10px;"><div class="col-lg-5 heading">'+i+' Instalment</div>  <div class="col-lg-7"> <input type="text" class="form-control rupee-box inst_fix_val" id="ins-'+i+'" name="instalment_fix_value[]"> </div> </div>';
					$(".instalment-val-box").append(div);
				}
			}
			$(".instalment-val-box").slideDown();
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

		$(".instalment-val-box").html("");
		var num_of_ins = $(this).val();
		
		//if percent radio button is selected
		if($("#percent-ins").is(":checked"))
		{
			for(var i=1; i<= num_of_ins; i++)
			{
				var div = '<div class="row" style="margin-top:10px;"><div class="col-lg-5 heading">'+i+' Instalment</div>   <div class="col-lg-7"> <input type="text" class="form-control percent-box inst_per_val" id="ins-'+i+'" name="instalment_percent_value[]"> </div> </div>';
				$(".instalment-val-box").append(div);
			}
		}
		
		//if fix value radio button is selected
		if($("#fix-value-ins").is(":checked"))
		{
			for(var i=1; i<= num_of_ins; i++)
			{
				var div = '<div class="row" style="margin-top:10px;"><div class="col-lg-5 heading">'+i+' Instalment</div>   <div class="col-lg-7"> <input type="text" class="form-control rupee-box inst_fix_val" id="ins-'+i+'" name="instalment_fix_value[]"> </div> </div>';
				$(".instalment-val-box").append(div);
			}
		}
	});

	$("#percent-ins").click(function() {

		$('input:radio[name="instalment_mode"]').parent().parent().removeClass('test');
		$(".instalment-val-box").html("");
		if($(this).is(":checked"))
		{
			var num_of_ins = $("#num-of-instalment").val();
			var abc = "";
			for(var i=1; i<= num_of_ins; i++)
			{
			var div = '<div class="row" style="margin-top:10px;"><div class="col-lg-5 heading">'+i+' Instalment</div>   <div class="col-lg-7"> <input type="text" class="form-control percent-box inst_per_val" id="ins-'+i+'" name="instalment_percent_value[]"> </div> </div>';
				$(".instalment-val-box").append(div);
			}
			$(".instalment-val-box").slideDown();
		}

	});

	$("#fix-value-ins").click(function() {

		$('input:radio[name="instalment_mode"]').parent().parent().removeClass('test');

		$(".instalment-val-box").html("");

		if($(this).is(":checked"))
		{
			var num_of_ins = $("#num-of-instalment").val();
			for(var i=1; i<= num_of_ins; i++)
			{
				var div = '<div class="row" style="margin-top:10px;"><div class="col-lg-5 heading">'+i+' Instalment</div><div class="col-lg-7"> <input type="text" class="form-control rupee-box inst_fix_val" id="ins-'+i+'" name="instalment_fix_value[]"> </div> </div>';
				$(".instalment-val-box").append(div);
			}
			$(".instalment-val-box").slideDown();
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
	$("#submit_btn").click(function(){

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
			else
			{
				$('input:radio[name="discount_mode"]').parent().parent().addClass('test');
				flag_discount = 0;
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
			else
			{
				$('input:radio[name="instalment_mode"]').parent().parent().addClass('test');
				flag_instalment = 0;
			}
		}
		else
		{
			flag_instalment = 1;
		}

		if(flag_year == "1" && flag_name == "1" && flag_fee == "1" && flag_discount == "1" && flag_instalment == "1")
		{
			$("#course_form").submit();	
		}
		else
		{
			alert("error");
		}

	});
	
});
