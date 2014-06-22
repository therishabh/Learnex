<!-- heading -->
<div class="row heading">
	<div class="col-lg-4">
		Student Detail
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
			There is no any organization so you can not access this Facility..!
		</div>
	</div>
	
<?php
}
//if organization is exist in database..
else{
	$email = explode(',',$user_detail['email']);
	$phone = explode(',',$user_detail['phone']);
?>


<div class="row student-info-detail">
	<div class="col-lg-9 col-centered">

		<div class="row" style="margin-top:40px;">
			<div class="col-lg-6">
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Name</div>
					<div class="col-lg-6 label-value"><?php echo $user_detail['name']; ?></div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Username</div>
					<div class="col-lg-6 label-value"><?php echo $user_detail['username']; ?></div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Date of Birth</div>
					<div class="col-lg-6 label-value"><?php echo $user_detail['username']; ?></div>
				</div>
				<div class="row" style="margin-top:10px;" >
					<div class="col-lg-6 label-text">Gender</div>
					<div class="col-lg-6 label-value"><?php echo $user_detail['gender']; ?></div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Blood Group</div>
					<div class="col-lg-6 label-value"><?php echo $user_detail['blood_group']; ?></div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-4 col-lg-offset-3 student-image" style="text-align:center;">
						<img src="<?php echo base_url(); ?>uploads/student/<?php echo $user_detail['image'] ?>"  alt="Student Image" class="img">
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-lg-6">
				<div class="row" style="margin-top:10px">
					<div class="col-lg-6 label-text">Date of Joining</div>
					<div class="col-lg-6 label-value"><?php echo $user_detail['doj'] ?></div>
				</div>
				<div class="row" style="margin-top:10px">
					<div class="col-lg-6 label-text">Course</div>
					<div class="col-lg-6 label-value"><?php echo $course_name ?></div>
				</div>

				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Class</div>
					<div class="col-lg-6 label-value"><?php echo $user_detail['class']; ?></div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="row" style="margin-top:10px">
					<div class="col-lg-6 label-text">Category</div>
					<div class="col-lg-6 label-value"><?php echo $user_detail['category'] ?></div>
				</div>
				<div class="row" style="margin-top:10px;">
					<div class="col-lg-6 label-text">Batch</div>
					<div class="col-lg-6 label-value"><?php echo $batch_name; ?></div>
				</div>
			</div>
		</div>

		<fieldset style="margin-top:20px;">
			<legend>Parent Info</legend>

			<div class="row" style="margin-top:10px">
				
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-name"><?php echo $user_detail['parent_relation'] ?> Name</div>
						<div class="col-lg-6 label-value"><?php echo $user_detail['parent_name'] ?></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-name"><?php echo $user_detail['parent_relation'] ?> Occupation</div>
						<div class="col-lg-6 label-value"><?php echo $user_detail['parent_occupation'] ?></div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-occ"><?php echo $user_detail['parent_relation'] ?> Phone</div>
						<div class="col-lg-6 label-value"><?php echo $user_detail['parent_phone'] ?></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text parent-phone"><?php echo $user_detail['parent_relation'] ?> Email id</div>
						<div class="col-lg-6 label-value"><?php echo $user_detail['parent_email'] ?></div>
					</div>
				</div>
			</div>

		</fieldset>

		<fieldset style="margin-top:30px; margin-bottom:40px;">
			<legend>Personal Contacts</legend>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Email Id</div>
						<div class="col-lg-6 label-value">
							<?php
							for($i = 0; $i < count($email); $i++)
							{
								if(count($email) == 1)
								{
									echo $email[$i];
								}
								else
								{
									echo "<div>";
									echo $email[$i];
									echo "</div>";
								}
							} 
							?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Phone</div>
						<div class="col-lg-6 label-value">
							<?php
								for($i = 0; $i < count($phone); $i++)
								{
									if(count($phone) == 1)
									{
										echo $phone[$i];
									}
									else
									{
										echo "<div>";
										echo $phone[$i];
										echo "</div>";
									}
								} 
							?>
						</div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Country</div>
						<div class="col-lg-6 label-value"><?php echo $user_detail['country'] ?></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">State</div>
						<div class="col-lg-6 label-value"><?php echo $user_detail['state']; ?></div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Current Address</div>
						<div class="col-lg-6 label-value"><?php echo $user_detail['current_address']; ?></div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">Permanet Address</div>
						<div class="col-lg-6 label-value"><?php echo $user_detail['permanent_address']; ?></div>
					</div>
				</div>
			</div>

			<div class="row" style="margin-top:10px">
				<div class="col-lg-6">
					<div class="row">
						<div class="col-lg-6 label-text">City</div>
						<div class="col-lg-6 label-value"><?php echo $user_detail['city']; ?></div>
					</div>
				</div>
			</div>


		</fieldset>
		<div class="student_code" style="display:none;"><?php echo $user_detail['code']; ?></div>


	</div>
</div><!-- end view-student-info -->

<?php 
}
?>


<script type="text/javascript">

</script>

