
<!-- heading -->
<div class="row heading">
	<div class="col-lg-2">
		Updoad Students
	</div>
	<div class="col-lg-7">
		<div class="success-msg"  style="text-align:center; font-size:16px; color:#168039">
		<?php
		if(isset($addstudent) && isset($updatestudent))
		{
			echo "$addstudent Students has been successfully Added.";
			echo "<br>";
			echo "$updatestudent Students has been successfully Updated";
		} 
		 ?>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url();?>user/student"><div class="submit-btn">View Student</div></a>
			</div>
			<div class="col-lg-6">
				<a href="<?php echo base_url();?>user/newstudent"><div class="submit-btn">Add Student</div></a>
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


<div class="row student-excel" style="margin-top:20px;">
	<div class="col-lg-9 col-centered">


		<fieldset style="margin-top:20px;">
			<legend>Upload Excel File</legend>


		<?php echo form_open_multipart('excel/uploadstudent','id="upload_excel"');?>
	
		<div class="row">
			<div class="col-lg-6 col-centered">
				<div class="row">
					<div class="col-lg-6">
						<label style="width:100%;">
							<input type="file" style="display:none;" name="file" id="files">
							<div class="upload-file">Upload Excel File</div>
						</label>
					</div>
					<div class="col-lg-3">
						<div class="submit-btn upload-btn disable-btn">Submit</div>
						<input type="hidden" value="Submit" name="submit-btn">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6 centered file-select-success" id="msg">
				
					</div>
				</div>
			</div>
		</div>

		<?php echo form_close(); ?>
		</fieldset>
	

		<fieldset style="margin-top:50px;">
			<legend>Download Excel File</legend>


		
		<div class="row">
			<div class="col-lg-7 col-centered">
				<div class="row">
					<div class="col-lg-4">
						<select name="course" id="course" class="form-control">
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
					<div class="col-lg-4">
						<select name="batch" id="batch" class="form-control">
							<option value="">Select Batch</option>
						</select>
					</div>
					<div class="col-lg-3">
						<div class="submit-btn save-btn download-btn" id="download-btn">Submit</div>
					</div>
				</div>
			</div>
		</div>

		</fieldset>

		
		<div class="row" style="margin-top:40px;">
			<div class="col-lg-4" style="color: #333; font-size:21px; padding-top:20px;">
				Download Excel Sample 
			</div>
			<div class="col-lg-3">
				<a href="<?php echo base_url(); ?>documents/student_sample_file.xls">
					<img src="<?php echo base_url(); ?>img/excel.png" alt="" style="height:70px;" >
				</a>
			</div>
		</div>

		<div class="hidden">
			<table id="tblExport" >
				<thead>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr></tr>
					<tr style="background:#0A4961; color:#fff; font-weight:bold; font-size:20px;">
						<th>S.No.</th>
						<th style="width:200px;">Student Name</th>
						<th style="width:100px;">Gender</th>
						<th style="width:120px;">Date of Birth</th>
						<th style="width:125px;">Blood Group</th>
						<th style="width:125px;">Category</th>
						<th style="width:95px;">Class</th>
						<th style="width:155px;">Date of Joining</th>
						<th style="width:125px;">City</th>
						<th style="width:125px;">State</th>
						<th style="width:125px;">Country</th>
						<th style="width:150px;">Parent Relation</th>
						<th style="width:160px;">Parent Name</th>
						<th style="width:175px;">Parent Occupation</th>
						<th style="width:125px;">Parent Phone</th>
						<th style="width:200px;">Parent Email id</th>
						<th style="width:160px;">Student Phone</th>
						<th style="width:200px;">Student Email Id</th>
						<th style="width:200px;">Current Address</th>
						<th style="width:200px;">Permanent Address</th>
						<th style="width:125px;">Course</th>
						<th style="width:125px;">Batch</th>
						<th style="width:125px;">Total Amount</th>
						<th style="width:125px;">Discount (%)</th>
						<th style="width:125px;">Net Amount</th>
						<th style="width:125px;">Pay Amount</th>
						<th style="width:160px;">Payment Mode</th>
						<th style="width:160px;">Cheque Number</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if($student_detail)
					{
						$i = 1;
						foreach($student_detail as $student)
						{
							$course_detail = $this->user_model->fetchbyid($student['course'],"course");
							$batch_detail = $this->user_model->fetchbyid($student['batch'],"batch");
							echo "<tr>";
							echo "<td>$i</td>";
							echo "<td>".$student['name']."</td>";
							echo "<td style='text-align:center;'>".$student['gender']."</td>";
							echo "<td style='text-align:center;'>".$student['dob']."</td>";
							echo "<td style='text-align:center;'>".$student['blood_group']."</td>";
							echo "<td style='text-align:center;'>".$student['category']."</td>";
							echo "<td style='text-align:center;'>".$student['class']."</td>";
							echo "<td style='text-align:center;'>".$student['doj']."</td>";
							echo "<td style='text-align:center;'>".$student['city']."</td>";
							echo "<td style='text-align:center;'>".$student['state']."</td>";
							echo "<td style='text-align:center;'>".$student['country']."</td>";
							echo "<td style='text-align:center;'>".$student['parent_relation']."</td>";
							echo "<td style='text-align:center;'>".$student['parent_name']."</td>";
							echo "<td style='text-align:center;'>".$student['parent_occupation']."</td>";
							echo "<td style='text-align:center;'>".$student['parent_phone']."</td>";
							echo "<td style='text-align:center;'>".$student['parent_email']."</td>";
							echo "<td style='text-align:center;'>".str_replace(",",", ", $student['phone'])."</td>";
							echo "<td style='text-align:center;'>".$student['email']."</td>";
							echo "<td style='text-align:center;'>".$student['current_address']."</td>";
							echo "<td style='text-align:center;'>".$student['permanent_address']."</td>";
							echo "<td style='text-align:center;'>".$course_detail['name']."</td>";
							echo "<td style='text-align:center;'>".$batch_detail['name']."</td>";
							echo "<td style='text-align:center;'>".$student['total_amount']."</td>";
							echo "<td style='text-align:center;'>".$student['discount_amount']."</td>";
							echo "<td style='text-align:center;'>".$student['net_amount']."</td>";
							echo "<td style='text-align:center;'>".$student['pay_amount']."</td>";
							echo "<td style='text-align:center;'>".$student['payment_mode']."</td>";
							echo "<td style='text-align:center;'>".$student['cheque_number']."</td>";
							echo "</tr>";
							$i++;
						}
					} 
					 ?>
				</tbody>
				
			</table>
		</div>

<?php 
}
?>

<!-- js for export excel file.. -->
<script type="text/javascript" src="<?php echo base_url(); ?>js/excel/jquery.btechco.excelexport.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/excel/jquery.base64.js"></script> 
<!-- // js for export excel file.. -->

<script type="text/javascript">
jQuery(document).ready(function($) {

	//display logo image when select any logo..
	$("#files").change(function() {
		var file = $(this).val();
		//execute if use select any image
		if($(this).val() != "")
		{
			var extension = file.substr( (file.lastIndexOf('.') +1) );
			if(extension == "xls")
			{
				$("#msg").text("1 File Selected !");
				$("#msg").addClass('file-select-success');
				$("#msg").removeClass('file-select-error');
				$(".upload-btn").addClass('submit-form-btn');
				$(".upload-btn").removeClass('disable-btn');
				$(".upload-btn").addClass('save-btn');
			}
			else
			{
				$("#msg").text("Invalid File Selected !");
				$("#msg").removeClass('file-select-success');
				$("#msg").addClass('file-select-error');
				$(".upload-btn").removeClass('submit-form-btn');
				$(".upload-btn").removeClass('save-btn');
				$(".upload-btn").addClass('disable-btn');
			}
		}
		//execute if user has not select any image..
		else
		{
			$("#msg").text("No File Selected !");
			$("#msg").removeClass('file-select-success');
			$("#msg").addClass('file-select-error');
			$(".upload-btn").removeClass('submit-form-btn');
			$(".upload-btn").removeClass('save-btn');
			$(".upload-btn").addClass('disable-btn');
			
		}
	});

	$(".student-excel").on('click', '.upload-btn', function(event) {
		
		var file = $("#files").val();
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		if(extension == "xls")
		{
			$(".la-anim-10").addClass('la-animate');
			$("#upload_excel").submit();
		}
		else
		{
			$("#msg").text("No File Selected !");
			$("#msg").removeClass('file-select-success');
			$("#msg").addClass('file-select-error');
			$(".submit-btn").addClass('submit-form-btn');
		}
	});


	$("#course").change(function() {	
		var course_id = $(this).val();
		// alert(course_id);
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
		$(".la-anim-10").addClass('la-animate');
		$.ajax({
			url: "<?php echo base_url();?>index.php/excel/getstudent",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {course : course_id, batch : ""},
			success: function(result){
				$("#tblExport tbody").html(result);
				// alert(result)
				$(".la-anim-10").removeClass('la-animate');

			}
		});

	});

	$("#batch").change(function() {
		var course = $("#course").val();
		var batch = $(this).val();
		$(".la-anim-10").addClass('la-animate');

		$.ajax({
			url: "<?php echo base_url();?>index.php/excel/getstudent",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {course : course, batch : batch},
			success: function(result){
				$("#tblExport tbody").html(result);
				// alert(result)
				$(".la-anim-10").removeClass('la-animate');

			}
		});
	});

	$(".download-btn").click(function () {
        $("#tblExport").btechco_excelexport({
            containerid: "tblExport"
           , datatype: $datatype.Table
           , filename: 'Sample'
        });
    });

    $(".success-msg").delay(5000).fadeOut();

});
</script>