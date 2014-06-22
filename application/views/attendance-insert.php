<!-- heading -->
<div class="row heading">
	<div class="col-lg-4">
		Attendance Management
	</div>
	<div class="col-lg-5">
		<div class="success-msg-top">
			
		</div>
	</div>
	<div class="col-lg-3">
		<div class="row">
			<div class="col-lg-5">
				<a href="<?php echo base_url();?>attendance"><div class="submit-btn">New</div></a>
			</div>
			<div class="col-lg-5 lecture-s">
				<a href="<?php echo base_url();?>viewattendance"><div class="submit-btn view" style="position:relative;">View</div></a>
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
			There is no any organization so first set organization details
			<?php echo anchor('setting/organization','click here'); ?>
		</div>
	</div>
	
<?php
}
else{
	date_default_timezone_set('Asia/Calcutta');
	$today_date = date("d/m/Y");
?>


<div class="row attendance-insert">
	<div class="col-lg-11 col-centered">
		<div class="row" style="margin-top:20px;">
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-4 label-text">Course :</div>
					<div class="col-lg-8 label-value"><?php echo $lecture_detail['course_name']; ?></div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-4 label-text">Batch :</div>
					<div class="col-lg-8 label-value"><?php echo $lecture_detail['batch_name']; ?></div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-4 label-text">Day :</div>
					<div class="col-lg-8 label-value"><?php echo $lecture_detail['day']; ?></div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-4 label-text">Time :</div>
					<div class="col-lg-8 label-value"><?php echo str_replace(".",":",$lecture_detail['start_time'])." - ".str_replace(".",":",$lecture_detail['end_time']); ?></div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-4 label-text">Subject :</div>
					<div class="col-lg-8 label-value"><?php echo $lecture_detail['subject_name']; ?></div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-4 label-text">Teacher :</div>
					<div class="col-lg-8 label-value"><?php echo $lecture_detail['teacher_name']; ?></div>
				</div>
			</div>
		</div>

		<?php echo form_open('attendance','id="attendance-form"');?>

		<div class="row" style="margin-top:20px;">
			<div class="col-lg-4 col-centered">
				<div class="form-group">
                    <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
                        <input type='text' class="form-control" name="date" value="<?php echo $today_date; ?>" id="date" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
			</div>
		</div>
		<div id="date-selected" style="display:none;"></div>
		<div class="row" style="border:1px solid #000;font-size:16px; font-weight:bold; background-color:#0A4961; color:#fff;">
			<div class="col-lg-1" style="border-right:1px solid #000; text-align:center; padding:7px;">
				S.No.
			</div>
			<div class="col-lg-5" style="border-right:1px solid #000; text-align:left; padding:7px; padding-left:12px;">
				Student Name
			</div>
			<div class="col-lg-3" style="border-right:1px solid #000; text-align:left; padding:7px; padding-left:12px;">
				Username
			</div>
			<div class="col-lg-3 checkall" style="padding-top:7px;text-align:center;padding-left:36px;">
				<label>
					<input type="checkbox" class="checkbox" value="yes">
					<div class="checkbox-img"></div>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12" style="padding:0;">
				<div class="display-student">
						
						<?php
						//check if there is any student exist into this batch.
						if($student_detail)
						{
							$i = 1;
							foreach ($student_detail as $student) {
								if($i % 2 != 0)
								{
									echo '<div class="row odd-div">
											<div class="col-lg-1 sno">'.
												$i
											.'.</div>
											<div class="col-lg-5 name">'.
												$student['name']	
											.'</div>
											<div class="col-lg-3 username">'.
												$student['username']	
											.'</div>
											<div class="col-lg-3 attendance-check">
												<label>
													<input type="checkbox" class="checkbox student-check" value="'.$student['id'].'">
													<div class="checkbox-img"></div>
												</label>
											</div>
										</div>';
								}
								else
								{
									echo '<div class="row even-div">
										<div class="col-lg-1 sno">'.
												$i
										.'.</div>
										<div class="col-lg-5 name">'.
											$student['name']	
										.'</div>
										<div class="col-lg-3 username">'.
											$student['username']	
										.'</div>
										<div class="col-lg-3 attendance-check">
											<label>
												<input type="checkbox" class="checkbox student-check" value="'.$student['id'].'">
												<div class="checkbox-img"></div>
											</label>
										</div>
									</div>';
								}
								$i++;
							} 
							?>
							<div class="row total-student">
								<div class="col-lg-4">
									<span>Total Student : </span>
									<span class="t-student"><?php echo $i-1; ?></span>
								</div>
								<div class="col-lg-4">
									<span>Present Student : </span>
									<span class="p-student">0</span>
								</div>
								<div class="col-lg-4">
									<span>Absent Student : </span>
									<span class="a-student"><?php echo $i-1; ?></span>
								</div>
							</div>
							<div class="row" style="margin-top:20px;">
								<div class="col-lg-3 col-centered">
									<div class="save-btn submit-btn">Save</div>
								</div>
							</div>
							<?php
						}
						else
						{
						?>
						<div class="error-student">
							There is No any student in <?php echo $lecture_detail['batch_name']; ?>
						</div>

						<?php
						}
						?>
						<input type="hidden" name="timetable-id" class="timetable-id" value="<?php echo $lecture_detail['id']; ?>">
						<input type="hidden" name="select-student-id" class="select-student-id" value="">
						<input type="hidden" name="insert-btn" value="success">
					
					
				</div>
			</div>
		</div>
		
		<?php echo form_close(); ?>


	</div>
</div>
<div class="selected_batch_id"><?php echo $lecture_detail['batch_id']; ?></div>
<?php 
}
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#datetimepicker1').datetimepicker({
        pickTime: false
    });

	var today = new Date();
    $('#datetimepicker1').data("DateTimePicker").setMaxDate(new Date(today));

	
	$(".attendance-insert .checkall .checkbox").click(function(event) {
			
		//execute when checkall checkbox is checked..
		if( $(this).is(":checked") )
		{
			// execute a loop for checkbox
			$(".checkbox").each(function() {
				$(this).prop('checked',true);
				$(this).next('.checkbox-img').css({
					background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 1px'
				});
			});

			// section for store all checked value into hidden div
			//each for store all checkbox value into hidden div..
			var student_id = [];
			$(".student-check").each(function()
			{
				student_id.push($(this).val());
			});

			var el = $.map(student_id, function(val, i) {
				return val;
			});
			$(".select-student-id").val(el.join(","));
			// // end section for store all checked value into hidden div
			$(".p-student").text($(".student-check:checked").length);
			$(".a-student").text("0");
		}

		//execute when checkall checkbox is unchecked..
		else{
			// execute a loop for checkbox
			$(".checkbox").each(function() {
				$(this).prop('checked',false);
				$(this).next('.checkbox-img').css({
					background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 1px'
				});
			});
			$(".select-student-id").val("");
			$(".p-student").text("0");
			$(".a-student").text( $(".student-check").length ) ;
		}
	});

	//execute when click on any student checkbox..
	$(".attendance-insert").on('click', '.student-check', function(event) {
		
		//execute when any student checkbox is checked..
		if( $(this).is(":checked") )
		{
			
			if($(".student-check").length == $(".student-check:checked").length) {
	            $(".checkall .checkbox").prop('checked',true);
	            $(".checkall .checkbox").next('.checkbox-img').css({
					background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 1px'
				});
	        }
	        
	        $(this).prop('checked',true);
	        
	        $(this).next('.checkbox-img').css({
				background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 1px'
			});

			// section for store all checked value into hidden div
			var student_id = [];
			$(".student-check:checked").each(function(){
				student_id.push($(this).val());
			});
			var el = $.map(student_id, function(val, i) {
				return val;
			});
			$(".select-student-id").val(el.join(","));
			// end section for store all checked value into hidden div
			$(".p-student").text($(".student-check:checked").length);
			$(".a-student").text($(".student-check:not(:checked)").length);
		}
		else{
			
			$(".checkall .checkbox").prop('checked',false);

            $(".checkall .checkbox").next('.checkbox-img').css({
				background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 1px'
			});

	        $(this).prop('checked',false);
			
			$(this).next('.checkbox-img').css({
				background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 1px'
			});
			


			// section for store all checked value into hidden div
			var student_id = [];
			$(".student-check:checked").each(function()
			{
					student_id.push($(this).val());
			});
			var el = $.map(student_id, function(val, i) {
				return val;
			});
			$(".select-student-id").val(el.join(","));
			// end section for store all checked value into hidden div
			// 
			
			$(".p-student").text($(".student-check:checked").length);
			$(".a-student").text($(".student-check:not(:checked)").length);
		}
	});
	
	$(".attendance-insert").on('click', '.save-btn', function(event) {
		if( $('#date').val() != "")
		{
			$("#attendance-form").submit();
		}
		else{
			alert("Please Choose Date !");
		}
	});

	$("#datetimepicker1").on("dp.change",function (e) {
		var selected_date = $("#date").val();
		var timetable_id = $(".timetable-id").val();
		var batch_id = $(".selected_batch_id").text();
		$.ajax({
			url: "<?php echo base_url();?>index.php/attendance/check_attendance",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {selected_date : selected_date,timetable_id:timetable_id,batch_id : batch_id},
			success: function(result){
				$(".display-student").html(result);
			}
		});
    });

	var selected_date = $("#date").val();
	var timetable_id = $(".timetable-id").val();
	var batch_id = $(".selected_batch_id").text();
	$.ajax({
		url: "<?php echo base_url();?>index.php/attendance/check_attendance",
		type: 'POST',
		// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
		data: {selected_date : selected_date,timetable_id:timetable_id,batch_id : batch_id},
		success: function(result){
			$(".display-student").html(result);
		}
	});



});
</script>