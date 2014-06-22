<!-- heading -->
<div class="row heading">
	<div class="col-lg-3">
		Lecture Scheduling
	</div>
	<div class="col-lg-6">
		<div class="success-msg-top">
			<?php
			if(  $this->session->userdata('insert_lecture') != "" )
			{
				echo "Lecture Has Been Successfully Scheduled.";
			}
			elseif(  $this->session->userdata('update_lecture') != "" )
			{
				echo "Lecture Has Been Successfully Updated.";
			}
			?>
		</div>
	</div>
	<div class="col-lg-3">
		<div class="row">
			<div class="col-lg-5">
				<a href="<?php echo base_url();?>study/lecturescheduling"><div class="submit-btn">New</div></a>
			</div>
			<div class="col-lg-5 lecture-s">
					<div class="submit-btn view" style="position:relative;">View</div>
					<div class="list-view">
						<a href="<?php echo base_url(); ?>study/lecturescheduling"><div>Batch</div></a>
						<a href="<?php echo base_url(); ?>study/teacherlecture"><div>Teacher</div></a>
					</div>
			</div>
		</div>
	</div>
</div>
<!-- // end heading -->


<!-- navigation top bar -->
<div class="row nav">
	<a href="<?php echo base_url();?>study/course">
		<div class="col-manual-5">Course</div>
	</a>
	<a href="<?php echo base_url();?>study/subject">
	
		<div class="col-manual-5">Subject</div>
	</a>
	<a href="<?php echo base_url();?>study/batch">
		<div class="col-manual-5">Batch</div>
	</a>
	<a href="<?php echo base_url();?>study/batchscheduling">
		<div class="col-manual-5" >Batch Scheduling</div>
	</a>
	<a href="<?php echo base_url();?>study/lecturescheduling">
		<div class="col-manual-5 active">Lecture Scheduling</div>
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
else{
?>

<div class="select-student-id" style="display:none;"></div>
<div class="row lecture-scheduling">
	<div class="col-lg-12">

	<?php echo form_open('study/lecturescheduling','id="lecture-form"');?>

	<div class="row course-batch">
		<div class="col-lg-5 col-centered">
			<div class="row">
			<?php 
			if($this->session->userdata('insert_lecture') != "")
			{
				$course_id = $this->session->userdata('course');
				$batch_id = $this->session->userdata('batch');
			?>

				<div class="col-lg-6">
					<select class="form-control" name="course"  id="course">
						<option value="">Select Course</option>
						<?php
						foreach ($course_detail as $course) {
							if($course_id == $course['id'])
							{
								echo '<option selected value="'.$course['id'].'">'.$course['name'].'</option>';
							}
							else
							{
								echo '<option value="'.$course['id'].'">'.$course['name'].'</option>';
							}
						}
						?>
					</select>
				</div>
				<div class="col-lg-6">
					<select class="form-control" name="batch"  id="batch">
						<option value="">Select Batch</option>
						<?php
						$batch_detail =	$this->manage_course->fetch_batch_by_courseid($course_id);
						foreach ($batch_detail as $batch) {
							if($batch_id == $batch['id'])
							{
								echo '<option selected value="'.$batch['id'].'">'.$batch['name'].'</option>';
							}
							else
							{
								echo '<option value="'.$batch['id'].'">'.$batch['name'].'</option>';
							}
						}
						?>
					</select>
				</div>

			<?php
			}
			elseif($this->session->userdata('update_lecture') != "")
			{
				$course_id = $this->session->userdata('course');
				$batch_id = $this->session->userdata('batch');
			?>

				<div class="col-lg-6">
					<select class="form-control" name="course"  id="course">
						<option value="">Select Course</option>
						<?php
						foreach ($course_detail as $course) {
							if($course_id == $course['id'])
							{
								echo '<option selected value="'.$course['id'].'">'.$course['name'].'</option>';
							}
							else
							{
								echo '<option value="'.$course['id'].'">'.$course['name'].'</option>';
							}
						}
						?>
					</select>
				</div>
				<div class="col-lg-6">
					<select class="form-control" name="batch"  id="batch">
						<option value="">Select Batch</option>
						<?php
						$batch_detail =	$this->manage_course->fetch_batch_by_courseid($course_id);
						foreach ($batch_detail as $batch) {
							if($batch_id == $batch['id'])
							{
								echo '<option selected value="'.$batch['id'].'">'.$batch['name'].'</option>';
							}
							else
							{
								echo '<option value="'.$batch['id'].'">'.$batch['name'].'</option>';
							}
						}
						?>
					</select>
				</div>

			<?php
			}
			else
			{
			?>
				<div class="col-lg-6">
					<select class="form-control" name="course"  id="course">
						<option value="">Select Course</option>
						<?php
						foreach ($course_detail as $course) {
							echo '<option value="'.$course['id'].'">'.$course['name'].'</option>';
						}
						?>
					</select>
				</div>
				<div class="col-lg-6">
					<select class="form-control" name="batch"  id="batch">
						<option value="">Select Batch</option>
					</select>
				</div>
			
			<?php
			}
			?>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-11 col-centered  insert-display">
		
		<?php 
		//execute when update_lecture sesssion is running..
		if($this->session->userdata('insert_lecture') != "") 
		{
			$batch_id = $this->session->userdata('batch');
			$lecture_detail = $this->user_model->lecture_detail($batch_id);
	        if($lecture_detail)
	        {
	            
	          ?>
	          <div class="update-view-display">
		          <div class="row">
		            <div class="col-lg-11 col-centered">
		              <table class="table table-bordered">
		                <?php
		                for($i = 1; $i <= 7; $i++)
		                {
		                    if($i == 1)
		                    {
		                        echo "<tr>";
		                        echo "<td></td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Monday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>".$lecture['start_time']." - ".$lecture['end_time']."</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                    if($i == 2)
		                    {
		                        echo "<tr>";
		                        echo "<td>Monday</td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Monday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>";
		                                    echo "<div>".$lecture['subject_name']."</div>";
		                                    echo "<div>".$lecture['teacher_name']."</div>";
		                                    echo "</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                    if($i == 3)
		                    {
		                        echo "<tr>";
		                        echo "<td>Tuesday</td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Tuesday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>";
		                                    echo "<div>".$lecture['subject_name']."</div>";
		                                    echo "<div>".$lecture['teacher_name']."</div>";
		                                    echo "</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                    if($i == 4)
		                    {
		                        echo "<tr>";
		                        echo "<td>Wednesday</td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Wednesday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>";
		                                    echo "<div>".$lecture['subject_name']."</div>";
		                                    echo "<div>".$lecture['teacher_name']."</div>";
		                                    echo "</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                    if($i == 5)
		                    {
		                        echo "<tr>";
		                        echo "<td>Thursday</td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Thursday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>";
		                                    echo "<div>".$lecture['subject_name']."</div>";
		                                    echo "<div>".$lecture['teacher_name']."</div>";
		                                    echo "</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                    if($i == 6)
		                    {
		                        echo "<tr>";
		                        echo "<td>Friday</td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Friday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>";
		                                    echo "<div>".$lecture['subject_name']."</div>";
		                                    echo "<div>".$lecture['teacher_name']."</div>";
		                                    echo "</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                    if($i == 7)
		                    {
		                        echo "<tr>";
		                        echo "<td>Saturday</td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Saturday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>";
		                                    echo "<div>".$lecture['subject_name']."</div>";
		                                    echo "<div>".$lecture['teacher_name']."</div>";
		                                    echo "</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                } 
		                ?>
		                
		                
		              </table>
		            </div><!-- // end col-lg-12 -->
		          </div><!-- // end row -->
		          <div class="row">
		            <div class="col-lg-4 col-centered">
		              <div class="row">
		                <div class="col-lg-6">
		                    <a href="<?php echo base_url(); ?>pdf/lecture/<?php echo $batch_id; ?>" target="_blank">
		                    <div class="submit-btn">PDF</div>
		                  </a>
		                </div>
		                <div class="col-lg-6">
		                  <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $batch_id; ?>">
		                    <div class="submit-btn">Edit</div>
		                  </a>
		                </div>
		              </div>
		            </div>
		          </div>
	          </div>

	        <div class="row insert-form">
				<div class="col-lg-12">
					<table class="table table-bordered">
						<tr>
							<td></td>
							<td class="lec_1" id="start-end">
								<select name="start_time_1" class="start-time">
									<option class="0" value="">Start</option>
								 
									<option class="5" value="6:00 AM">6:00 AM</option>
									<option class="6" value="6:15 AM">6:15 AM</option>
									<option class="7" value="6:30 AM">6:30 AM</option>
									<option class="8" value="6:45 AM">6:45 AM</option>
								 
									<option class="9" value="7:00 AM">7:00 AM</option>
									<option class="10" value="7:15 AM">7:15 AM</option>
									<option class="11" value="7:30 AM">7:30 AM</option>
									<option class="12" value="7:45 AM">7:45 AM</option>
								 
									<option class="13" value="8:00 AM">8:00 AM</option>
									<option class="14" value="8:15 AM">8:15 AM</option>
									<option class="15" value="8:30 AM">8:30 AM</option>
									<option class="16" value="8:45 AM">8:45 AM</option>
								 
									<option class="17" value="9:00 AM">9:00 AM</option>
									<option class="18" value="9:15 AM">9:15 AM</option>
									<option class="19" value="9:30 AM">9:30 AM</option>
									<option class="20" value="9:45 AM">9:45 AM</option>
								 
									<option class="21" value="10:00 AM">10:00 AM</option>
									<option class="22" value="10:15 AM">10:15 AM</option>
									<option class="23" value="10:30 AM">10:30 AM</option>
									<option class="24" value="10:45 AM">10:45 AM</option>
								 
									<option class="25" value="11:00 AM">11:00 AM</option>
									<option class="26" value="11:15 AM">11:15 AM</option>
									<option class="27" value="11:30 AM">11:30 AM</option>
									<option class="28" value="11:45 AM">11:45 AM</option>
								 
									<option class="29" value="12:00 PM">12:00 PM</option>
									<option class="30" value="12:15 PM">12:15 PM</option>
									<option class="31" value="12:30 PM">12:30 PM</option>
									<option class="32" value="12:45 PM">12:45 PM</option>
								 
									<option class="33" value="1:00 PM">1:00 PM</option>
									<option class="34" value="1:15 PM">1:15 PM</option>
									<option class="35" value="1:30 PM">1:30 PM</option>
									<option class="36" value="1:45 PM">1:45 PM</option>
								 
									<option class="37" value="2:00 PM">2:00 PM</option>
									<option class="38" value="2:15 PM">2:15 PM</option>
									<option class="39" value="2:30 PM">2:30 PM</option>
									<option class="40" value="2:45 PM">2:45 PM</option>
								 
									<option class="41" value="3:00 PM">3:00 PM</option>
									<option class="42" value="3:15 PM">3:15 PM</option>
									<option class="43" value="3:30 PM">3:30 PM</option>
									<option class="44" value="3:45 PM">3:45 PM</option>
								 
									<option class="45" value="4:00 PM">4:00 PM</option>
									<option class="46" value="4:15 PM">4:15 PM</option>
									<option class="47" value="4:30 PM">4:30 PM</option>
									<option class="48" value="4:45 PM">4:45 PM</option>
								 
									<option class="49" value="5:00 PM">5:00 PM</option>
									<option class="50" value="5:15 PM">5:15 PM</option>
									<option class="50" value="5:30 PM">5:30 PM</option>
									<option class="51" value="5:45 PM">5:45 PM</option>
								 
									<option class="52" value="6:00 PM">6:00 PM</option>
									<option class="53" value="6:15 PM">6:15 PM</option>
									<option class="54" value="6:30 PM">6:30 PM</option>
									<option class="55" value="6:45 PM">6:45 PM</option>
								 
									<option class="56" value="7:00 PM">7:00 PM</option>
									<option class="57" value="7:15 PM">7:15 PM</option>
									<option class="58" value="7:30 PM">7:30 PM</option>
									<option class="59" value="7:45 PM">7:45 PM</option>
								 
									<option class="60" value="8:00 PM">8:00 PM</option>
									<option class="61" value="8:15 PM">8:15 PM</option>
									<option class="62" value="8:30 PM">8:30 PM</option>
									<option class="63" value="8:45 PM">8:45 PM</option>
								 
									<option class="64" value="9:00 PM">9:00 PM</option>
									<option class="65" value="9:15 PM">9:15 PM</option>
									<option class="66" value="9:30 PM">9:30 PM</option>
									<option class="67" value="9:45 PM">9:45 PM</option>
								 
									<option class="68" value="10:00 PM">10:00 PM</option>
									<option class="69" value="10:15 PM">10:15 PM</option>
									<option class="70" value="10:30 PM">10:30 PM</option>
									<option class="71" value="10:45 PM">10:45 PM</option>
								 
									<option class="72" value="11:00 PM">11:00 PM</option>
									<option class="73" value="11:15 PM">11:15 PM</option>
									<option class="74" value="11:30 PM">11:30 PM</option>
									<option class="75" value="11:45 PM">11:45 PM</option>
								</select>
								<select name="end_time_1" class="end-time">
									<option class="0" value="">End</option>
								 
									<option class="5" value="6:00 AM">6:00 AM</option>
									<option class="6" value="6:15 AM">6:15 AM</option>
									<option class="7" value="6:30 AM">6:30 AM</option>
									<option class="8" value="6:45 AM">6:45 AM</option>
								 
									<option class="9" value="7:00 AM">7:00 AM</option>
									<option class="10" value="7:15 AM">7:15 AM</option>
									<option class="11" value="7:30 AM">7:30 AM</option>
									<option class="12" value="7:45 AM">7:45 AM</option>
								 
									<option class="13" value="8:00 AM">8:00 AM</option>
									<option class="14" value="8:15 AM">8:15 AM</option>
									<option class="15" value="8:30 AM">8:30 AM</option>
									<option class="16" value="8:45 AM">8:45 AM</option>
								 
									<option class="17" value="9:00 AM">9:00 AM</option>
									<option class="18" value="9:15 AM">9:15 AM</option>
									<option class="19" value="9:30 AM">9:30 AM</option>
									<option class="20" value="9:45 AM">9:45 AM</option>
								 
									<option class="21" value="10:00 AM">10:00 AM</option>
									<option class="22" value="10:15 AM">10:15 AM</option>
									<option class="23" value="10:30 AM">10:30 AM</option>
									<option class="24" value="10:45 AM">10:45 AM</option>
								 
									<option class="25" value="11:00 AM">11:00 AM</option>
									<option class="26" value="11:15 AM">11:15 AM</option>
									<option class="27" value="11:30 AM">11:30 AM</option>
									<option class="28" value="11:45 AM">11:45 AM</option>
								 
									<option class="29" value="12:00 PM">12:00 PM</option>
									<option class="30" value="12:15 PM">12:15 PM</option>
									<option class="31" value="12:30 PM">12:30 PM</option>
									<option class="32" value="12:45 PM">12:45 PM</option>
								 
									<option class="33" value="1:00 PM">1:00 PM</option>
									<option class="34" value="1:15 PM">1:15 PM</option>
									<option class="35" value="1:30 PM">1:30 PM</option>
									<option class="36" value="1:45 PM">1:45 PM</option>
								 
									<option class="37" value="2:00 PM">2:00 PM</option>
									<option class="38" value="2:15 PM">2:15 PM</option>
									<option class="39" value="2:30 PM">2:30 PM</option>
									<option class="40" value="2:45 PM">2:45 PM</option>
								 
									<option class="41" value="3:00 PM">3:00 PM</option>
									<option class="42" value="3:15 PM">3:15 PM</option>
									<option class="43" value="3:30 PM">3:30 PM</option>
									<option class="44" value="3:45 PM">3:45 PM</option>
								 
									<option class="45" value="4:00 PM">4:00 PM</option>
									<option class="46" value="4:15 PM">4:15 PM</option>
									<option class="47" value="4:30 PM">4:30 PM</option>
									<option class="48" value="4:45 PM">4:45 PM</option>
								 
									<option class="49" value="5:00 PM">5:00 PM</option>
									<option class="50" value="5:15 PM">5:15 PM</option>
									<option class="50" value="5:30 PM">5:30 PM</option>
									<option class="51" value="5:45 PM">5:45 PM</option>
								 
									<option class="52" value="6:00 PM">6:00 PM</option>
									<option class="53" value="6:15 PM">6:15 PM</option>
									<option class="54" value="6:30 PM">6:30 PM</option>
									<option class="55" value="6:45 PM">6:45 PM</option>
								 
									<option class="56" value="7:00 PM">7:00 PM</option>
									<option class="57" value="7:15 PM">7:15 PM</option>
									<option class="58" value="7:30 PM">7:30 PM</option>
									<option class="59" value="7:45 PM">7:45 PM</option>
								 
									<option class="60" value="8:00 PM">8:00 PM</option>
									<option class="61" value="8:15 PM">8:15 PM</option>
									<option class="62" value="8:30 PM">8:30 PM</option>
									<option class="63" value="8:45 PM">8:45 PM</option>
								 
									<option class="64" value="9:00 PM">9:00 PM</option>
									<option class="65" value="9:15 PM">9:15 PM</option>
									<option class="66" value="9:30 PM">9:30 PM</option>
									<option class="67" value="9:45 PM">9:45 PM</option>
								 
									<option class="68" value="10:00 PM">10:00 PM</option>
									<option class="69" value="10:15 PM">10:15 PM</option>
									<option class="70" value="10:30 PM">10:30 PM</option>
									<option class="71" value="10:45 PM">10:45 PM</option>
								 
									<option class="72" value="11:00 PM">11:00 PM</option>
									<option class="73" value="11:15 PM">11:15 PM</option>
									<option class="74" value="11:30 PM">11:30 PM</option>
									<option class="75" value="11:45 PM">11:45 PM</option>
								</select>
							</td>
							<td class="add">
								<select id="add">
									<option value="lecture">Lecture</option>
									<option value="break">Break</option>
								</select>
								<img class="addmore" src="<?php echo base_url(); ?>img/add.png" alt="">
							</td>
							
						</tr>
						<tr>
							<td>Monday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_1_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_1_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
								
							</td>
							<td class="add_1"></td>
						</tr>
						<tr>
							<td>Tuesday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_2_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_2_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
								
							</td>
							<td class="add_2"></td>
						</tr>
						<tr>
							<td>Wednesday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_3_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_3_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
							</td>
							<td class="add_3"></td>
						</tr>
						<tr>
							<td>Thursday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_4_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_4_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
							</td>
							<td class="add_4"></td>
						</tr>
						<tr>
							<td>Friday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_5_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_5_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
							</td>
							<td class="add_5"></td>
						</tr>
						<tr>
							<td>Saturday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_6_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_6_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
							</td>
							<td class="add_6"></td>
						</tr>
						
					</table>

				</div>
			</div>
			<div class="row insert-form">
				<div class="col-lg-12">
					<textarea class="form-control" name="comment" rows="4" placeholder="Type Your Comment Here.."></textarea>
				</div>
			</div>
			
			<div class="row insert-form">
				<div class="col-lg-3 col-centered" style="margin-bottom:30px; margin-top:20px;">
					<input type="hidden" value="" name="lecture_type" id="lecture_type">
					<input type="hidden" name="insert_btn" value="success">
					<div class="submit-btn form-submit-btn">Save</div>	
				</div>
			</div>
	          <?php   
	        }// end if($lecture_detail)
		}//end if condition
		elseif($this->session->userdata('update_lecture') != "") 
		{
			$batch_id = $this->session->userdata('batch');
			$lecture_detail = $this->user_model->lecture_detail($batch_id);
	        if($lecture_detail)
	        {
	            
	          ?>
	          <div class="update-view-display">
		          <div class="row">
		            <div class="col-lg-11 col-centered">
		              <table class="table table-bordered">
		                <?php
		                for($i = 1; $i <= 7; $i++)
		                {
		                    if($i == 1)
		                    {
		                        echo "<tr>";
		                        echo "<td></td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Monday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>".$lecture['start_time']." - ".$lecture['end_time']."</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                    if($i == 2)
		                    {
		                        echo "<tr>";
		                        echo "<td>Monday</td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Monday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>";
		                                    echo "<div>".$lecture['subject_name']."</div>";
		                                    echo "<div>".$lecture['teacher_name']."</div>";
		                                    echo "</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                    if($i == 3)
		                    {
		                        echo "<tr>";
		                        echo "<td>Tuesday</td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Tuesday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>";
		                                    echo "<div>".$lecture['subject_name']."</div>";
		                                    echo "<div>".$lecture['teacher_name']."</div>";
		                                    echo "</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                    if($i == 4)
		                    {
		                        echo "<tr>";
		                        echo "<td>Wednesday</td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Wednesday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>";
		                                    echo "<div>".$lecture['subject_name']."</div>";
		                                    echo "<div>".$lecture['teacher_name']."</div>";
		                                    echo "</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                    if($i == 5)
		                    {
		                        echo "<tr>";
		                        echo "<td>Thursday</td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Thursday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>";
		                                    echo "<div>".$lecture['subject_name']."</div>";
		                                    echo "<div>".$lecture['teacher_name']."</div>";
		                                    echo "</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                    if($i == 6)
		                    {
		                        echo "<tr>";
		                        echo "<td>Friday</td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Friday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>";
		                                    echo "<div>".$lecture['subject_name']."</div>";
		                                    echo "<div>".$lecture['teacher_name']."</div>";
		                                    echo "</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                    if($i == 7)
		                    {
		                        echo "<tr>";
		                        echo "<td>Saturday</td>";
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Saturday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td>Break</td>";
		                                }
		                                else
		                                {
		                                    echo "<td>";
		                                    echo "<div>".$lecture['subject_name']."</div>";
		                                    echo "<div>".$lecture['teacher_name']."</div>";
		                                    echo "</td>";
		                                }
		                            }
		                        }
		                        echo "</tr>";
		                    }
		                } 
		                ?>
		                
		                
		              </table>
		            </div><!-- // end col-lg-12 -->
		          </div><!-- // end row -->
		          <div class="row">
		            <div class="col-lg-4 col-centered">
		              <div class="row">
		                <div class="col-lg-6">
		                    <a href="<?php echo base_url(); ?>pdf/lecture/<?php echo $batch_id; ?>" target="_blank">
		                    <div class="submit-btn">PDF</div>
		                  </a>
		                </div>
		                <div class="col-lg-6">
		                  <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $batch_id; ?>">
		                    <div class="submit-btn">Edit</div>
		                  </a>
		                </div>
		              </div>
		            </div>
		          </div>
	          </div>

	        <div class="row insert-form">
				<div class="col-lg-12">
					<table class="table table-bordered">
						<tr>
							<td></td>
							<td class="lec_1" id="start-end">
								<select name="start_time_1" class="start-time">
									<option class="0" value="">Start</option>
								 
									<option class="5" value="6:00 AM">6:00 AM</option>
									<option class="6" value="6:15 AM">6:15 AM</option>
									<option class="7" value="6:30 AM">6:30 AM</option>
									<option class="8" value="6:45 AM">6:45 AM</option>
								 
									<option class="9" value="7:00 AM">7:00 AM</option>
									<option class="10" value="7:15 AM">7:15 AM</option>
									<option class="11" value="7:30 AM">7:30 AM</option>
									<option class="12" value="7:45 AM">7:45 AM</option>
								 
									<option class="13" value="8:00 AM">8:00 AM</option>
									<option class="14" value="8:15 AM">8:15 AM</option>
									<option class="15" value="8:30 AM">8:30 AM</option>
									<option class="16" value="8:45 AM">8:45 AM</option>
								 
									<option class="17" value="9:00 AM">9:00 AM</option>
									<option class="18" value="9:15 AM">9:15 AM</option>
									<option class="19" value="9:30 AM">9:30 AM</option>
									<option class="20" value="9:45 AM">9:45 AM</option>
								 
									<option class="21" value="10:00 AM">10:00 AM</option>
									<option class="22" value="10:15 AM">10:15 AM</option>
									<option class="23" value="10:30 AM">10:30 AM</option>
									<option class="24" value="10:45 AM">10:45 AM</option>
								 
									<option class="25" value="11:00 AM">11:00 AM</option>
									<option class="26" value="11:15 AM">11:15 AM</option>
									<option class="27" value="11:30 AM">11:30 AM</option>
									<option class="28" value="11:45 AM">11:45 AM</option>
								 
									<option class="29" value="12:00 PM">12:00 PM</option>
									<option class="30" value="12:15 PM">12:15 PM</option>
									<option class="31" value="12:30 PM">12:30 PM</option>
									<option class="32" value="12:45 PM">12:45 PM</option>
								 
									<option class="33" value="1:00 PM">1:00 PM</option>
									<option class="34" value="1:15 PM">1:15 PM</option>
									<option class="35" value="1:30 PM">1:30 PM</option>
									<option class="36" value="1:45 PM">1:45 PM</option>
								 
									<option class="37" value="2:00 PM">2:00 PM</option>
									<option class="38" value="2:15 PM">2:15 PM</option>
									<option class="39" value="2:30 PM">2:30 PM</option>
									<option class="40" value="2:45 PM">2:45 PM</option>
								 
									<option class="41" value="3:00 PM">3:00 PM</option>
									<option class="42" value="3:15 PM">3:15 PM</option>
									<option class="43" value="3:30 PM">3:30 PM</option>
									<option class="44" value="3:45 PM">3:45 PM</option>
								 
									<option class="45" value="4:00 PM">4:00 PM</option>
									<option class="46" value="4:15 PM">4:15 PM</option>
									<option class="47" value="4:30 PM">4:30 PM</option>
									<option class="48" value="4:45 PM">4:45 PM</option>
								 
									<option class="49" value="5:00 PM">5:00 PM</option>
									<option class="50" value="5:15 PM">5:15 PM</option>
									<option class="50" value="5:30 PM">5:30 PM</option>
									<option class="51" value="5:45 PM">5:45 PM</option>
								 
									<option class="52" value="6:00 PM">6:00 PM</option>
									<option class="53" value="6:15 PM">6:15 PM</option>
									<option class="54" value="6:30 PM">6:30 PM</option>
									<option class="55" value="6:45 PM">6:45 PM</option>
								 
									<option class="56" value="7:00 PM">7:00 PM</option>
									<option class="57" value="7:15 PM">7:15 PM</option>
									<option class="58" value="7:30 PM">7:30 PM</option>
									<option class="59" value="7:45 PM">7:45 PM</option>
								 
									<option class="60" value="8:00 PM">8:00 PM</option>
									<option class="61" value="8:15 PM">8:15 PM</option>
									<option class="62" value="8:30 PM">8:30 PM</option>
									<option class="63" value="8:45 PM">8:45 PM</option>
								 
									<option class="64" value="9:00 PM">9:00 PM</option>
									<option class="65" value="9:15 PM">9:15 PM</option>
									<option class="66" value="9:30 PM">9:30 PM</option>
									<option class="67" value="9:45 PM">9:45 PM</option>
								 
									<option class="68" value="10:00 PM">10:00 PM</option>
									<option class="69" value="10:15 PM">10:15 PM</option>
									<option class="70" value="10:30 PM">10:30 PM</option>
									<option class="71" value="10:45 PM">10:45 PM</option>
								 
									<option class="72" value="11:00 PM">11:00 PM</option>
									<option class="73" value="11:15 PM">11:15 PM</option>
									<option class="74" value="11:30 PM">11:30 PM</option>
									<option class="75" value="11:45 PM">11:45 PM</option>
								</select>
								<select name="end_time_1" class="end-time">
									<option class="0" value="">End</option>
								 
									<option class="5" value="6:00 AM">6:00 AM</option>
									<option class="6" value="6:15 AM">6:15 AM</option>
									<option class="7" value="6:30 AM">6:30 AM</option>
									<option class="8" value="6:45 AM">6:45 AM</option>
								 
									<option class="9" value="7:00 AM">7:00 AM</option>
									<option class="10" value="7:15 AM">7:15 AM</option>
									<option class="11" value="7:30 AM">7:30 AM</option>
									<option class="12" value="7:45 AM">7:45 AM</option>
								 
									<option class="13" value="8:00 AM">8:00 AM</option>
									<option class="14" value="8:15 AM">8:15 AM</option>
									<option class="15" value="8:30 AM">8:30 AM</option>
									<option class="16" value="8:45 AM">8:45 AM</option>
								 
									<option class="17" value="9:00 AM">9:00 AM</option>
									<option class="18" value="9:15 AM">9:15 AM</option>
									<option class="19" value="9:30 AM">9:30 AM</option>
									<option class="20" value="9:45 AM">9:45 AM</option>
								 
									<option class="21" value="10:00 AM">10:00 AM</option>
									<option class="22" value="10:15 AM">10:15 AM</option>
									<option class="23" value="10:30 AM">10:30 AM</option>
									<option class="24" value="10:45 AM">10:45 AM</option>
								 
									<option class="25" value="11:00 AM">11:00 AM</option>
									<option class="26" value="11:15 AM">11:15 AM</option>
									<option class="27" value="11:30 AM">11:30 AM</option>
									<option class="28" value="11:45 AM">11:45 AM</option>
								 
									<option class="29" value="12:00 PM">12:00 PM</option>
									<option class="30" value="12:15 PM">12:15 PM</option>
									<option class="31" value="12:30 PM">12:30 PM</option>
									<option class="32" value="12:45 PM">12:45 PM</option>
								 
									<option class="33" value="1:00 PM">1:00 PM</option>
									<option class="34" value="1:15 PM">1:15 PM</option>
									<option class="35" value="1:30 PM">1:30 PM</option>
									<option class="36" value="1:45 PM">1:45 PM</option>
								 
									<option class="37" value="2:00 PM">2:00 PM</option>
									<option class="38" value="2:15 PM">2:15 PM</option>
									<option class="39" value="2:30 PM">2:30 PM</option>
									<option class="40" value="2:45 PM">2:45 PM</option>
								 
									<option class="41" value="3:00 PM">3:00 PM</option>
									<option class="42" value="3:15 PM">3:15 PM</option>
									<option class="43" value="3:30 PM">3:30 PM</option>
									<option class="44" value="3:45 PM">3:45 PM</option>
								 
									<option class="45" value="4:00 PM">4:00 PM</option>
									<option class="46" value="4:15 PM">4:15 PM</option>
									<option class="47" value="4:30 PM">4:30 PM</option>
									<option class="48" value="4:45 PM">4:45 PM</option>
								 
									<option class="49" value="5:00 PM">5:00 PM</option>
									<option class="50" value="5:15 PM">5:15 PM</option>
									<option class="50" value="5:30 PM">5:30 PM</option>
									<option class="51" value="5:45 PM">5:45 PM</option>
								 
									<option class="52" value="6:00 PM">6:00 PM</option>
									<option class="53" value="6:15 PM">6:15 PM</option>
									<option class="54" value="6:30 PM">6:30 PM</option>
									<option class="55" value="6:45 PM">6:45 PM</option>
								 
									<option class="56" value="7:00 PM">7:00 PM</option>
									<option class="57" value="7:15 PM">7:15 PM</option>
									<option class="58" value="7:30 PM">7:30 PM</option>
									<option class="59" value="7:45 PM">7:45 PM</option>
								 
									<option class="60" value="8:00 PM">8:00 PM</option>
									<option class="61" value="8:15 PM">8:15 PM</option>
									<option class="62" value="8:30 PM">8:30 PM</option>
									<option class="63" value="8:45 PM">8:45 PM</option>
								 
									<option class="64" value="9:00 PM">9:00 PM</option>
									<option class="65" value="9:15 PM">9:15 PM</option>
									<option class="66" value="9:30 PM">9:30 PM</option>
									<option class="67" value="9:45 PM">9:45 PM</option>
								 
									<option class="68" value="10:00 PM">10:00 PM</option>
									<option class="69" value="10:15 PM">10:15 PM</option>
									<option class="70" value="10:30 PM">10:30 PM</option>
									<option class="71" value="10:45 PM">10:45 PM</option>
								 
									<option class="72" value="11:00 PM">11:00 PM</option>
									<option class="73" value="11:15 PM">11:15 PM</option>
									<option class="74" value="11:30 PM">11:30 PM</option>
									<option class="75" value="11:45 PM">11:45 PM</option>
								</select>
							</td>
							<td class="add">
								<select id="add">
									<option value="lecture">Lecture</option>
									<option value="break">Break</option>
								</select>
								<img class="addmore" src="<?php echo base_url(); ?>img/add.png" alt="">
							</td>
							
						</tr>
						<tr>
							<td>Monday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_1_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_1_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
								
							</td>
							<td class="add_1"></td>
						</tr>
						<tr>
							<td>Tuesday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_2_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_2_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
								
							</td>
							<td class="add_2"></td>
						</tr>
						<tr>
							<td>Wednesday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_3_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_3_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
							</td>
							<td class="add_3"></td>
						</tr>
						<tr>
							<td>Thursday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_4_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_4_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
							</td>
							<td class="add_4"></td>
						</tr>
						<tr>
							<td>Friday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_5_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_5_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
							</td>
							<td class="add_5"></td>
						</tr>
						<tr>
							<td>Saturday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_6_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_6_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
							</td>
							<td class="add_6"></td>
						</tr>
						
					</table>

				</div>
			</div>
			<div class="row insert-form">
				<div class="col-lg-12">
					<textarea class="form-control" name="comment" rows="4" placeholder="Type Your Comment Here.."></textarea>
				</div>
			</div>
			
			<div class="row insert-form">
				<div class="col-lg-3 col-centered" style="margin-bottom:30px; margin-top:20px;">
					<input type="hidden" value="" name="lecture_type" id="lecture_type">
					<input type="hidden" name="insert_btn" value="success">
					<div class="submit-btn form-submit-btn">Save</div>	
				</div>
			</div>
	          <?php   
	        }// end if($lecture_detail)
		}//end elseif condition
		else
		{
		?>
			<div class="row">
				<div class="col-lg-12">
					<table class="table table-bordered">
						<tr>
							<td></td>
							<td class="lec_1" id="start-end">
								<select name="start_time_1" class="start-time">
									<option class="0" value="">Start</option>
								 
									<option class="5" value="6:00 AM">6:00 AM</option>
									<option class="6" value="6:15 AM">6:15 AM</option>
									<option class="7" value="6:30 AM">6:30 AM</option>
									<option class="8" value="6:45 AM">6:45 AM</option>
								 
									<option class="9" value="7:00 AM">7:00 AM</option>
									<option class="10" value="7:15 AM">7:15 AM</option>
									<option class="11" value="7:30 AM">7:30 AM</option>
									<option class="12" value="7:45 AM">7:45 AM</option>
								 
									<option class="13" value="8:00 AM">8:00 AM</option>
									<option class="14" value="8:15 AM">8:15 AM</option>
									<option class="15" value="8:30 AM">8:30 AM</option>
									<option class="16" value="8:45 AM">8:45 AM</option>
								 
									<option class="17" value="9:00 AM">9:00 AM</option>
									<option class="18" value="9:15 AM">9:15 AM</option>
									<option class="19" value="9:30 AM">9:30 AM</option>
									<option class="20" value="9:45 AM">9:45 AM</option>
								 
									<option class="21" value="10:00 AM">10:00 AM</option>
									<option class="22" value="10:15 AM">10:15 AM</option>
									<option class="23" value="10:30 AM">10:30 AM</option>
									<option class="24" value="10:45 AM">10:45 AM</option>
								 
									<option class="25" value="11:00 AM">11:00 AM</option>
									<option class="26" value="11:15 AM">11:15 AM</option>
									<option class="27" value="11:30 AM">11:30 AM</option>
									<option class="28" value="11:45 AM">11:45 AM</option>
								 
									<option class="29" value="12:00 PM">12:00 PM</option>
									<option class="30" value="12:15 PM">12:15 PM</option>
									<option class="31" value="12:30 PM">12:30 PM</option>
									<option class="32" value="12:45 PM">12:45 PM</option>
								 
									<option class="33" value="1:00 PM">1:00 PM</option>
									<option class="34" value="1:15 PM">1:15 PM</option>
									<option class="35" value="1:30 PM">1:30 PM</option>
									<option class="36" value="1:45 PM">1:45 PM</option>
								 
									<option class="37" value="2:00 PM">2:00 PM</option>
									<option class="38" value="2:15 PM">2:15 PM</option>
									<option class="39" value="2:30 PM">2:30 PM</option>
									<option class="40" value="2:45 PM">2:45 PM</option>
								 
									<option class="41" value="3:00 PM">3:00 PM</option>
									<option class="42" value="3:15 PM">3:15 PM</option>
									<option class="43" value="3:30 PM">3:30 PM</option>
									<option class="44" value="3:45 PM">3:45 PM</option>
								 
									<option class="45" value="4:00 PM">4:00 PM</option>
									<option class="46" value="4:15 PM">4:15 PM</option>
									<option class="47" value="4:30 PM">4:30 PM</option>
									<option class="48" value="4:45 PM">4:45 PM</option>
								 
									<option class="49" value="5:00 PM">5:00 PM</option>
									<option class="50" value="5:15 PM">5:15 PM</option>
									<option class="50" value="5:30 PM">5:30 PM</option>
									<option class="51" value="5:45 PM">5:45 PM</option>
								 
									<option class="52" value="6:00 PM">6:00 PM</option>
									<option class="53" value="6:15 PM">6:15 PM</option>
									<option class="54" value="6:30 PM">6:30 PM</option>
									<option class="55" value="6:45 PM">6:45 PM</option>
								 
									<option class="56" value="7:00 PM">7:00 PM</option>
									<option class="57" value="7:15 PM">7:15 PM</option>
									<option class="58" value="7:30 PM">7:30 PM</option>
									<option class="59" value="7:45 PM">7:45 PM</option>
								 
									<option class="60" value="8:00 PM">8:00 PM</option>
									<option class="61" value="8:15 PM">8:15 PM</option>
									<option class="62" value="8:30 PM">8:30 PM</option>
									<option class="63" value="8:45 PM">8:45 PM</option>
								 
									<option class="64" value="9:00 PM">9:00 PM</option>
									<option class="65" value="9:15 PM">9:15 PM</option>
									<option class="66" value="9:30 PM">9:30 PM</option>
									<option class="67" value="9:45 PM">9:45 PM</option>
								 
									<option class="68" value="10:00 PM">10:00 PM</option>
									<option class="69" value="10:15 PM">10:15 PM</option>
									<option class="70" value="10:30 PM">10:30 PM</option>
									<option class="71" value="10:45 PM">10:45 PM</option>
								 
									<option class="72" value="11:00 PM">11:00 PM</option>
									<option class="73" value="11:15 PM">11:15 PM</option>
									<option class="74" value="11:30 PM">11:30 PM</option>
									<option class="75" value="11:45 PM">11:45 PM</option>
								</select>
								<select name="end_time_1" class="end-time">
									<option class="0" value="">End</option>
								 
									<option class="5" value="6:00 AM">6:00 AM</option>
									<option class="6" value="6:15 AM">6:15 AM</option>
									<option class="7" value="6:30 AM">6:30 AM</option>
									<option class="8" value="6:45 AM">6:45 AM</option>
								 
									<option class="9" value="7:00 AM">7:00 AM</option>
									<option class="10" value="7:15 AM">7:15 AM</option>
									<option class="11" value="7:30 AM">7:30 AM</option>
									<option class="12" value="7:45 AM">7:45 AM</option>
								 
									<option class="13" value="8:00 AM">8:00 AM</option>
									<option class="14" value="8:15 AM">8:15 AM</option>
									<option class="15" value="8:30 AM">8:30 AM</option>
									<option class="16" value="8:45 AM">8:45 AM</option>
								 
									<option class="17" value="9:00 AM">9:00 AM</option>
									<option class="18" value="9:15 AM">9:15 AM</option>
									<option class="19" value="9:30 AM">9:30 AM</option>
									<option class="20" value="9:45 AM">9:45 AM</option>
								 
									<option class="21" value="10:00 AM">10:00 AM</option>
									<option class="22" value="10:15 AM">10:15 AM</option>
									<option class="23" value="10:30 AM">10:30 AM</option>
									<option class="24" value="10:45 AM">10:45 AM</option>
								 
									<option class="25" value="11:00 AM">11:00 AM</option>
									<option class="26" value="11:15 AM">11:15 AM</option>
									<option class="27" value="11:30 AM">11:30 AM</option>
									<option class="28" value="11:45 AM">11:45 AM</option>
								 
									<option class="29" value="12:00 PM">12:00 PM</option>
									<option class="30" value="12:15 PM">12:15 PM</option>
									<option class="31" value="12:30 PM">12:30 PM</option>
									<option class="32" value="12:45 PM">12:45 PM</option>
								 
									<option class="33" value="1:00 PM">1:00 PM</option>
									<option class="34" value="1:15 PM">1:15 PM</option>
									<option class="35" value="1:30 PM">1:30 PM</option>
									<option class="36" value="1:45 PM">1:45 PM</option>
								 
									<option class="37" value="2:00 PM">2:00 PM</option>
									<option class="38" value="2:15 PM">2:15 PM</option>
									<option class="39" value="2:30 PM">2:30 PM</option>
									<option class="40" value="2:45 PM">2:45 PM</option>
								 
									<option class="41" value="3:00 PM">3:00 PM</option>
									<option class="42" value="3:15 PM">3:15 PM</option>
									<option class="43" value="3:30 PM">3:30 PM</option>
									<option class="44" value="3:45 PM">3:45 PM</option>
								 
									<option class="45" value="4:00 PM">4:00 PM</option>
									<option class="46" value="4:15 PM">4:15 PM</option>
									<option class="47" value="4:30 PM">4:30 PM</option>
									<option class="48" value="4:45 PM">4:45 PM</option>
								 
									<option class="49" value="5:00 PM">5:00 PM</option>
									<option class="50" value="5:15 PM">5:15 PM</option>
									<option class="50" value="5:30 PM">5:30 PM</option>
									<option class="51" value="5:45 PM">5:45 PM</option>
								 
									<option class="52" value="6:00 PM">6:00 PM</option>
									<option class="53" value="6:15 PM">6:15 PM</option>
									<option class="54" value="6:30 PM">6:30 PM</option>
									<option class="55" value="6:45 PM">6:45 PM</option>
								 
									<option class="56" value="7:00 PM">7:00 PM</option>
									<option class="57" value="7:15 PM">7:15 PM</option>
									<option class="58" value="7:30 PM">7:30 PM</option>
									<option class="59" value="7:45 PM">7:45 PM</option>
								 
									<option class="60" value="8:00 PM">8:00 PM</option>
									<option class="61" value="8:15 PM">8:15 PM</option>
									<option class="62" value="8:30 PM">8:30 PM</option>
									<option class="63" value="8:45 PM">8:45 PM</option>
								 
									<option class="64" value="9:00 PM">9:00 PM</option>
									<option class="65" value="9:15 PM">9:15 PM</option>
									<option class="66" value="9:30 PM">9:30 PM</option>
									<option class="67" value="9:45 PM">9:45 PM</option>
								 
									<option class="68" value="10:00 PM">10:00 PM</option>
									<option class="69" value="10:15 PM">10:15 PM</option>
									<option class="70" value="10:30 PM">10:30 PM</option>
									<option class="71" value="10:45 PM">10:45 PM</option>
								 
									<option class="72" value="11:00 PM">11:00 PM</option>
									<option class="73" value="11:15 PM">11:15 PM</option>
									<option class="74" value="11:30 PM">11:30 PM</option>
									<option class="75" value="11:45 PM">11:45 PM</option>
								</select>
							</td>
							<td class="add">
								<select id="add">
									<option value="lecture">Lecture</option>
									<option value="break">Break</option>
								</select>
								<img class="addmore" src="<?php echo base_url(); ?>img/add.png" alt="">
							</td>
							
						</tr>
						<tr>
							<td>Monday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_1_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_1_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
								
							</td>
							<td class="add_1"></td>
						</tr>
						<tr>
							<td>Tuesday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_2_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_2_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
								
							</td>
							<td class="add_2"></td>
						</tr>
						<tr>
							<td>Wednesday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_3_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_3_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
							</td>
							<td class="add_3"></td>
						</tr>
						<tr>
							<td>Thursday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_4_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_4_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
							</td>
							<td class="add_4"></td>
						</tr>
						<tr>
							<td>Friday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_5_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_5_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
							</td>
							<td class="add_5"></td>
						</tr>
						<tr>
							<td>Saturday</td>
							<td>
								<div>
									<select class="form-control subject" name="sub_6_1" id="">
										<option value="">Subject</option>
									</select>
								</div>
								<div>
									<select class="form-control teacher" name="teach_6_1" id="">
										<option value="">Teacher</option>
										<?php
										foreach($teacher_detail as $teacher)
										{
											echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
										}
										 ?>
									</select>
								</div>
							</td>
							<td class="add_6"></td>
						</tr>
						
					</table>

				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<textarea class="form-control" name="comment" rows="4" placeholder="Type Your Comment Here.."></textarea>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-3 col-centered" style="margin-bottom:30px; margin-top:20px;">
					<input type="hidden" value="" name="lecture_type" id="lecture_type">
					<input type="hidden" name="insert_btn" value="success">
					<div class="submit-btn form-submit-btn">Save</div>	
				</div>
			</div>
		<?php
		}
		?>

		</div>
		<div class="row">
			<div class="col-lg-12 view-display">
				
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
	</div>
</div>

</div>
<?php 
}
?>


<script type="text/javascript">

jQuery(document).ready(function($) {
	<?php
	if($this->session->userdata('update_lecture') != "") 
	{
		?>
		$(".update-view-display").show();
		$(".insert-form").hide();
		<?php
	}
	elseif($this->session->userdata('insert_lecture') != "") 
	{
		?>
		$(".update-view-display").show();
		$(".insert-form").hide();
		<?php
	}
	?>

		$(".view-display").hide();

	var lecture_break = ['lecture_1'];
	count_td = 1;

	$(".lecture-scheduling").on('change', '.start-time', function(event) {
		$(this).removeClass('test');
		var start_time = $(this).val();
		var start_time_class = $(this).find('option:selected').attr("class");
		$(this).next().find('option').remove();
		$(this).next().html('<option class="0" value="">End</option> <option class="5" value="6:00 AM">6:00 AM</option> <option class="6" value="6:15 AM">6:15 AM</option> <option class="7" value="6:30 AM">6:30 AM</option> <option class="8" value="6:45 AM">6:45 AM</option> <option class="9" value="7:00 AM">7:00 AM</option> <option class="10" value="7:15 AM">7:15 AM</option> <option class="11" value="7:30 AM">7:30 AM</option> <option class="12" value="7:45 AM">7:45 AM</option> <option class="13" value="8:00 AM">8:00 AM</option> <option class="14" value="8:15 AM">8:15 AM</option> <option class="15" value="8:30 AM">8:30 AM</option> <option class="16" value="8:45 AM">8:45 AM</option> <option class="17" value="9:00 AM">9:00 AM</option> <option class="18" value="9:15 AM">9:15 AM</option> <option class="19" value="9:30 AM">9:30 AM</option> <option class="20" value="9:45 AM">9:45 AM</option> <option class="21" value="10:00 AM">10:00 AM</option> <option class="22" value="10:15 AM">10:15 AM</option> <option class="23" value="10:30 AM">10:30 AM</option> <option class="24" value="10:45 AM">10:45 AM</option> <option class="25" value="11:00 AM">11:00 AM</option> <option class="26" value="11:15 AM">11:15 AM</option> <option class="27" value="11:30 AM">11:30 AM</option> <option class="28" value="11:45 AM">11:45 AM</option> <option class="29" value="12:00 PM">12:00 PM</option> <option class="30" value="12:15 PM">12:15 PM</option> <option class="31" value="12:30 PM">12:30 PM</option> <option class="32" value="12:45 PM">12:45 PM</option> <option class="33" value="1:00 PM">1:00 PM</option> <option class="34" value="1:15 PM">1:15 PM</option> <option class="35" value="1:30 PM">1:30 PM</option> <option class="36" value="1:45 PM">1:45 PM</option> <option class="37" value="2:00 PM">2:00 PM</option> <option class="38" value="2:15 PM">2:15 PM</option> <option class="39" value="2:30 PM">2:30 PM</option> <option class="40" value="2:45 PM">2:45 PM</option> <option class="41" value="3:00 PM">3:00 PM</option> <option class="42" value="3:15 PM">3:15 PM</option> <option class="43" value="3:30 PM">3:30 PM</option> <option class="44" value="3:45 PM">3:45 PM</option> <option class="45" value="4:00 PM">4:00 PM</option> <option class="46" value="4:15 PM">4:15 PM</option> <option class="47" value="4:30 PM">4:30 PM</option> <option class="48" value="4:45 PM">4:45 PM</option> <option class="49" value="5:00 PM">5:00 PM</option> <option class="50" value="5:15 PM">5:15 PM</option> <option class="50" value="5:30 PM">5:30 PM</option> <option class="51" value="5:45 PM">5:45 PM</option> <option class="52" value="6:00 PM">6:00 PM</option> <option class="53" value="6:15 PM">6:15 PM</option> <option class="54" value="6:30 PM">6:30 PM</option> <option class="55" value="6:45 PM">6:45 PM</option> <option class="56" value="7:00 PM">7:00 PM</option> <option class="57" value="7:15 PM">7:15 PM</option> <option class="58" value="7:30 PM">7:30 PM</option> <option class="59" value="7:45 PM">7:45 PM</option> <option class="60" value="8:00 PM">8:00 PM</option> <option class="61" value="8:15 PM">8:15 PM</option> <option class="62" value="8:30 PM">8:30 PM</option> <option class="63" value="8:45 PM">8:45 PM</option> <option class="64" value="9:00 PM">9:00 PM</option> <option class="65" value="9:15 PM">9:15 PM</option> <option class="66" value="9:30 PM">9:30 PM</option> <option class="67" value="9:45 PM">9:45 PM</option> <option class="68" value="10:00 PM">10:00 PM</option> <option class="69" value="10:15 PM">10:15 PM</option> <option class="70" value="10:30 PM">10:30 PM</option> <option class="71" value="10:45 PM">10:45 PM</option> <option class="72" value="11:00 PM">11:00 PM</option> <option class="73" value="11:15 PM">11:15 PM</option> <option class="74" value="11:30 PM">11:30 PM</option> <option class="75" value="11:45 PM">11:45 PM</option>');
		for(var i = 1; i <= start_time_class; i++)
		{
			$(this).next().find('option.'+i).remove();
		}
		$(this).next().find('option.0').attr('selected','selected');
	});

	

	$(".lecture-scheduling").on('click', '.addmore', function(event) {

		if(count_td <= 8)
		{
			var add = $("#add").val();
			var previous_end_time = $(".add").prev().children('.end-time').attr('class');

			count_td = parseInt(count_td) + 1; 

			//fetch preview td class like (lec_1 or lec_2....)
			var previous_class = $(".add").prev().attr('class');
			var class_val = previous_class.split("_");
			var row_num = parseInt(class_val[1]) + 1 ;
			var td_new_class = "lec_"+row_num;

			if(add == "lecture")
			{
				lecture_break.push('lecture_'+row_num);

				$('.add').before('<td class="'+td_new_class+'" id="start-end" style="position:relative;"><img src="<?php echo base_url(); ?>img/close.png" class="close-td"><select name="start_time_'+row_num+'" class="start-time"> <option class="0" value="">Start</option> <option class="5" value="6:00 AM">6:00 AM</option> <option class="6" value="6:15 AM">6:15 AM</option> <option class="7" value="6:30 AM">6:30 AM</option> <option class="8" value="6:45 AM">6:45 AM</option> <option class="9" value="7:00 AM">7:00 AM</option> <option class="10" value="7:15 AM">7:15 AM</option> <option class="11" value="7:30 AM">7:30 AM</option> <option class="12" value="7:45 AM">7:45 AM</option> <option class="13" value="8:00 AM">8:00 AM</option> <option class="14" value="8:15 AM">8:15 AM</option> <option class="15" value="8:30 AM">8:30 AM</option> <option class="16" value="8:45 AM">8:45 AM</option> <option class="17" value="9:00 AM">9:00 AM</option> <option class="18" value="9:15 AM">9:15 AM</option> <option class="19" value="9:30 AM">9:30 AM</option> <option class="20" value="9:45 AM">9:45 AM</option> <option class="21" value="10:00 AM">10:00 AM</option> <option class="22" value="10:15 AM">10:15 AM</option> <option class="23" value="10:30 AM">10:30 AM</option> <option class="24" value="10:45 AM">10:45 AM</option> <option class="25" value="11:00 AM">11:00 AM</option> <option class="26" value="11:15 AM">11:15 AM</option> <option class="27" value="11:30 AM">11:30 AM</option> <option class="28" value="11:45 AM">11:45 AM</option> <option class="29" value="12:00 PM">12:00 PM</option> <option class="30" value="12:15 PM">12:15 PM</option> <option class="31" value="12:30 PM">12:30 PM</option> <option class="32" value="12:45 PM">12:45 PM</option> <option class="33" value="1:00 PM">1:00 PM</option> <option class="34" value="1:15 PM">1:15 PM</option> <option class="35" value="1:30 PM">1:30 PM</option> <option class="36" value="1:45 PM">1:45 PM</option> <option class="37" value="2:00 PM">2:00 PM</option> <option class="38" value="2:15 PM">2:15 PM</option> <option class="39" value="2:30 PM">2:30 PM</option> <option class="40" value="2:45 PM">2:45 PM</option> <option class="41" value="3:00 PM">3:00 PM</option> <option class="42" value="3:15 PM">3:15 PM</option> <option class="43" value="3:30 PM">3:30 PM</option> <option class="44" value="3:45 PM">3:45 PM</option> <option class="45" value="4:00 PM">4:00 PM</option> <option class="46" value="4:15 PM">4:15 PM</option> <option class="47" value="4:30 PM">4:30 PM</option> <option class="48" value="4:45 PM">4:45 PM</option> <option class="49" value="5:00 PM">5:00 PM</option> <option class="50" value="5:15 PM">5:15 PM</option> <option class="50" value="5:30 PM">5:30 PM</option> <option class="51" value="5:45 PM">5:45 PM</option> <option class="52" value="6:00 PM">6:00 PM</option> <option class="53" value="6:15 PM">6:15 PM</option> <option class="54" value="6:30 PM">6:30 PM</option> <option class="55" value="6:45 PM">6:45 PM</option> <option class="56" value="7:00 PM">7:00 PM</option> <option class="57" value="7:15 PM">7:15 PM</option> <option class="58" value="7:30 PM">7:30 PM</option> <option class="59" value="7:45 PM">7:45 PM</option> <option class="60" value="8:00 PM">8:00 PM</option> <option class="61" value="8:15 PM">8:15 PM</option> <option class="62" value="8:30 PM">8:30 PM</option> <option class="63" value="8:45 PM">8:45 PM</option> <option class="64" value="9:00 PM">9:00 PM</option> <option class="65" value="9:15 PM">9:15 PM</option> <option class="66" value="9:30 PM">9:30 PM</option> <option class="67" value="9:45 PM">9:45 PM</option> <option class="68" value="10:00 PM">10:00 PM</option> <option class="69" value="10:15 PM">10:15 PM</option> <option class="70" value="10:30 PM">10:30 PM</option> <option class="71" value="10:45 PM">10:45 PM</option> <option class="72" value="11:00 PM">11:00 PM</option> <option class="73" value="11:15 PM">11:15 PM</option> <option class="74" value="11:30 PM">11:30 PM</option> <option class="75" value="11:45 PM">11:45 PM</option> </select> <select name="end_time_'+row_num+'" class="end-time"> <option class="0" value="">End</option> <option class="5" value="6:00 AM">6:00 AM</option> <option class="6" value="6:15 AM">6:15 AM</option> <option class="7" value="6:30 AM">6:30 AM</option> <option class="8" value="6:45 AM">6:45 AM</option> <option class="9" value="7:00 AM">7:00 AM</option> <option class="10" value="7:15 AM">7:15 AM</option> <option class="11" value="7:30 AM">7:30 AM</option> <option class="12" value="7:45 AM">7:45 AM</option> <option class="13" value="8:00 AM">8:00 AM</option> <option class="14" value="8:15 AM">8:15 AM</option> <option class="15" value="8:30 AM">8:30 AM</option> <option class="16" value="8:45 AM">8:45 AM</option> <option class="17" value="9:00 AM">9:00 AM</option> <option class="18" value="9:15 AM">9:15 AM</option> <option class="19" value="9:30 AM">9:30 AM</option> <option class="20" value="9:45 AM">9:45 AM</option> <option class="21" value="10:00 AM">10:00 AM</option> <option class="22" value="10:15 AM">10:15 AM</option> <option class="23" value="10:30 AM">10:30 AM</option> <option class="24" value="10:45 AM">10:45 AM</option> <option class="25" value="11:00 AM">11:00 AM</option> <option class="26" value="11:15 AM">11:15 AM</option> <option class="27" value="11:30 AM">11:30 AM</option> <option class="28" value="11:45 AM">11:45 AM</option> <option class="29" value="12:00 PM">12:00 PM</option> <option class="30" value="12:15 PM">12:15 PM</option> <option class="31" value="12:30 PM">12:30 PM</option> <option class="32" value="12:45 PM">12:45 PM</option> <option class="33" value="1:00 PM">1:00 PM</option> <option class="34" value="1:15 PM">1:15 PM</option> <option class="35" value="1:30 PM">1:30 PM</option> <option class="36" value="1:45 PM">1:45 PM</option> <option class="37" value="2:00 PM">2:00 PM</option> <option class="38" value="2:15 PM">2:15 PM</option> <option class="39" value="2:30 PM">2:30 PM</option> <option class="40" value="2:45 PM">2:45 PM</option> <option class="41" value="3:00 PM">3:00 PM</option> <option class="42" value="3:15 PM">3:15 PM</option> <option class="43" value="3:30 PM">3:30 PM</option> <option class="44" value="3:45 PM">3:45 PM</option> <option class="45" value="4:00 PM">4:00 PM</option> <option class="46" value="4:15 PM">4:15 PM</option> <option class="47" value="4:30 PM">4:30 PM</option> <option class="48" value="4:45 PM">4:45 PM</option> <option class="49" value="5:00 PM">5:00 PM</option> <option class="50" value="5:15 PM">5:15 PM</option> <option class="50" value="5:30 PM">5:30 PM</option> <option class="51" value="5:45 PM">5:45 PM</option> <option class="52" value="6:00 PM">6:00 PM</option> <option class="53" value="6:15 PM">6:15 PM</option> <option class="54" value="6:30 PM">6:30 PM</option> <option class="55" value="6:45 PM">6:45 PM</option> <option class="56" value="7:00 PM">7:00 PM</option> <option class="57" value="7:15 PM">7:15 PM</option> <option class="58" value="7:30 PM">7:30 PM</option> <option class="59" value="7:45 PM">7:45 PM</option> <option class="60" value="8:00 PM">8:00 PM</option> <option class="61" value="8:15 PM">8:15 PM</option> <option class="62" value="8:30 PM">8:30 PM</option> <option class="63" value="8:45 PM">8:45 PM</option> <option class="64" value="9:00 PM">9:00 PM</option> <option class="65" value="9:15 PM">9:15 PM</option> <option class="66" value="9:30 PM">9:30 PM</option> <option class="67" value="9:45 PM">9:45 PM</option> <option class="68" value="10:00 PM">10:00 PM</option> <option class="69" value="10:15 PM">10:15 PM</option> <option class="70" value="10:30 PM">10:30 PM</option> <option class="71" value="10:45 PM">10:45 PM</option> <option class="72" value="11:00 PM">11:00 PM</option> <option class="73" value="11:15 PM">11:15 PM</option> <option class="74" value="11:30 PM">11:30 PM</option> <option class="75" value="11:45 PM">11:45 PM</option> </select></td>')
				$(".add_1").before('<td> <div><select class="form-control subject sub_1_'+row_num+'" name="sub_1_'+row_num+'" id=""> <option value="">Subject</option></select> </div> <div> <select class="form-control teacher teach_1_'+row_num+'" name="teach_1_'+row_num+'" id="">'
				 +'<option value="">Teacher</option>'
				 +'<?php
				 	if($teacher_detail)
				 	{
						foreach($teacher_detail as $teacher)
						{
							$id = $teacher["id"];
							$name = $teacher["name"];
							$username = $teacher["username"];
							$name_username = "$name ( $username )";
						?>'
						+'<option value="<?php echo $id ?>"><?php echo $name_username; ?></option>'
							
						+'<?php
						}
				 	}
					 ?>'
				 +' </select> </div> </td>');
				$(".add_2").before('<td> <div><select class="form-control subject sub_2_'+row_num+'" name="sub_2_'+row_num+'" id=""> <option value="">Subject</option></select> </div> <div> <select class="form-control teacher teach_2_'+row_num+'" name="teach_2_'+row_num+'" id="">'
				 +'<option value="">Teacher</option>'
				 +'<?php
				 	if($teacher_detail)
				 	{
						foreach($teacher_detail as $teacher)
						{
							$id = $teacher["id"];
							$name = $teacher["name"];
							$username = $teacher["username"];
							$name_username = "$name ( $username )";
						?>'
						+'<option value="<?php echo $id ?>"><?php echo $name_username; ?></option>'
							
						+'<?php
						}
				 	}
					 ?>'
				 +' </select> </div> </td>');
				$(".add_3").before('<td> <div><select class="form-control subject sub_3_'+row_num+'" name="sub_3_'+row_num+'" id=""> <option value="">Subject</option></select> </div> <div> <select class="form-control teacher teach_3_'+row_num+'" name="teach_3_'+row_num+'" id="">'
				 +'<option value="">Teacher</option>'
				 +'<?php
					if($teacher_detail)
				 	{
						foreach($teacher_detail as $teacher)
						{
							$id = $teacher["id"];
							$name = $teacher["name"];
							$username = $teacher["username"];
							$name_username = "$name ( $username )";
						?>'
						+'<option value="<?php echo $id ?>"><?php echo $name_username; ?></option>'
							
						+'<?php
						}
				 	}
					 ?>'
				 +' </select> </div> </td>');
				$(".add_4").before('<td> <div><select class="form-control subject sub_4_'+row_num+'" name="sub_4_'+row_num+'" id=""> <option value="">Subject</option></select> </div> <div> <select class="form-control teacher teach_4_'+row_num+'" name="teach_4_'+row_num+'" id="">'
				 +'<option value="">Teacher</option>'
				 +'<?php
					if($teacher_detail)
				 	{
						foreach($teacher_detail as $teacher)
						{
							$id = $teacher["id"];
							$name = $teacher["name"];
							$username = $teacher["username"];
							$name_username = "$name ( $username )";
						?>'
						+'<option value="<?php echo $id ?>"><?php echo $name_username; ?></option>'
							
						+'<?php
						}
				 	}
					 ?>'
				 +' </select> </div> </td>');
				$(".add_5").before('<td> <div><select class="form-control subject sub_5_'+row_num+'" name="sub_5_'+row_num+'" id=""> <option value="">Subject</option></select> </div> <div> <select class="form-control teacher teach_5_'+row_num+'" name="teach_5_'+row_num+'" id="">'
				 +'<option value="">Teacher</option>'
				 +'<?php
					if($teacher_detail)
				 	{
						foreach($teacher_detail as $teacher)
						{
							$id = $teacher["id"];
							$name = $teacher["name"];
							$username = $teacher["username"];
							$name_username = "$name ( $username )";
						?>'
						+'<option value="<?php echo $id ?>"><?php echo $name_username; ?></option>'
							
						+'<?php
						}
				 	}
					 ?>'
				 +' </select> </div> </td>');
				$(".add_6").before('<td> <div><select class="form-control subject sub_6_'+row_num+'" name="sub_6_'+row_num+'" id=""> <option value="">Subject</option></select> </div> <div> <select class="form-control teacher teach_6_'+row_num+'" name="teach_6_'+row_num+'" id="">'
				 +'<option value="">Teacher</option>'
				 +'<?php
					if($teacher_detail)
				 	{
						foreach($teacher_detail as $teacher)
						{
							$id = $teacher["id"];
							$name = $teacher["name"];
							$username = $teacher["username"];
							$name_username = "$name ( $username )";
						?>'
						+'<option value="<?php echo $id ?>"><?php echo $name_username; ?></option>'
							
						+'<?php
						}
				 	}
					 ?>'
				 +' </select> </div> </td>');
				

				if($("#batch").val() != "")
				{
					var batch_id = $("#batch").val();
					$.ajax({
						url: "<?php echo base_url();?>index.php/study/batch_subject",
						type: 'POST',
						// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
						data: {batch_id : batch_id},
						success: function(result){
							$(".sub_1_"+row_num).html(result);
							$(".sub_2_"+row_num).html(result);
							$(".sub_3_"+row_num).html(result);
							$(".sub_4_"+row_num).html(result);
							$(".sub_5_"+row_num).html(result);
							$(".sub_6_"+row_num).html(result);
						}
					});
				}


				var end_time_class = $("."+td_new_class).prevAll('#start-end').first().children('.end-time').find('option:selected').attr("class");
				
				//show all option
				$("."+td_new_class).children('.start-time').find('option').remove();
				$("."+td_new_class).children('.start-time').html('<option class="0" value="">Start</option> <option class="5" value="6:00 AM">6:00 AM</option> <option class="6" value="6:15 AM">6:15 AM</option> <option class="7" value="6:30 AM">6:30 AM</option> <option class="8" value="6:45 AM">6:45 AM</option> <option class="9" value="7:00 AM">7:00 AM</option> <option class="10" value="7:15 AM">7:15 AM</option> <option class="11" value="7:30 AM">7:30 AM</option> <option class="12" value="7:45 AM">7:45 AM</option> <option class="13" value="8:00 AM">8:00 AM</option> <option class="14" value="8:15 AM">8:15 AM</option> <option class="15" value="8:30 AM">8:30 AM</option> <option class="16" value="8:45 AM">8:45 AM</option> <option class="17" value="9:00 AM">9:00 AM</option> <option class="18" value="9:15 AM">9:15 AM</option> <option class="19" value="9:30 AM">9:30 AM</option> <option class="20" value="9:45 AM">9:45 AM</option> <option class="21" value="10:00 AM">10:00 AM</option> <option class="22" value="10:15 AM">10:15 AM</option> <option class="23" value="10:30 AM">10:30 AM</option> <option class="24" value="10:45 AM">10:45 AM</option> <option class="25" value="11:00 AM">11:00 AM</option> <option class="26" value="11:15 AM">11:15 AM</option> <option class="27" value="11:30 AM">11:30 AM</option> <option class="28" value="11:45 AM">11:45 AM</option> <option class="29" value="12:00 PM">12:00 PM</option> <option class="30" value="12:15 PM">12:15 PM</option> <option class="31" value="12:30 PM">12:30 PM</option> <option class="32" value="12:45 PM">12:45 PM</option> <option class="33" value="1:00 PM">1:00 PM</option> <option class="34" value="1:15 PM">1:15 PM</option> <option class="35" value="1:30 PM">1:30 PM</option> <option class="36" value="1:45 PM">1:45 PM</option> <option class="37" value="2:00 PM">2:00 PM</option> <option class="38" value="2:15 PM">2:15 PM</option> <option class="39" value="2:30 PM">2:30 PM</option> <option class="40" value="2:45 PM">2:45 PM</option> <option class="41" value="3:00 PM">3:00 PM</option> <option class="42" value="3:15 PM">3:15 PM</option> <option class="43" value="3:30 PM">3:30 PM</option> <option class="44" value="3:45 PM">3:45 PM</option> <option class="45" value="4:00 PM">4:00 PM</option> <option class="46" value="4:15 PM">4:15 PM</option> <option class="47" value="4:30 PM">4:30 PM</option> <option class="48" value="4:45 PM">4:45 PM</option> <option class="49" value="5:00 PM">5:00 PM</option> <option class="50" value="5:15 PM">5:15 PM</option> <option class="50" value="5:30 PM">5:30 PM</option> <option class="51" value="5:45 PM">5:45 PM</option> <option class="52" value="6:00 PM">6:00 PM</option> <option class="53" value="6:15 PM">6:15 PM</option> <option class="54" value="6:30 PM">6:30 PM</option> <option class="55" value="6:45 PM">6:45 PM</option> <option class="56" value="7:00 PM">7:00 PM</option> <option class="57" value="7:15 PM">7:15 PM</option> <option class="58" value="7:30 PM">7:30 PM</option> <option class="59" value="7:45 PM">7:45 PM</option> <option class="60" value="8:00 PM">8:00 PM</option> <option class="61" value="8:15 PM">8:15 PM</option> <option class="62" value="8:30 PM">8:30 PM</option> <option class="63" value="8:45 PM">8:45 PM</option> <option class="64" value="9:00 PM">9:00 PM</option> <option class="65" value="9:15 PM">9:15 PM</option> <option class="66" value="9:30 PM">9:30 PM</option> <option class="67" value="9:45 PM">9:45 PM</option> <option class="68" value="10:00 PM">10:00 PM</option> <option class="69" value="10:15 PM">10:15 PM</option> <option class="70" value="10:30 PM">10:30 PM</option> <option class="71" value="10:45 PM">10:45 PM</option> <option class="72" value="11:00 PM">11:00 PM</option> <option class="73" value="11:15 PM">11:15 PM</option> <option class="74" value="11:30 PM">11:30 PM</option> <option class="75" value="11:45 PM">11:45 PM</option>');


				for(var i = 1; i < end_time_class; i++)
				{
					$("."+td_new_class).children('.start-time').find('option.'+i).remove();
				}
			
			}

			if(add == "break")
			{
				lecture_break.push('break_'+row_num);
				$('.add').before('<td class="'+td_new_class+'" id="break" style="position:relative;display: table-cell;vertical-align: middle;"><img src="<?php echo base_url(); ?>img/close.png" class="close-td"> Break </td>');
				$(".add_1").before('<td class="'+td_new_class+'" style="display:table-cell; vertical-align:middle;"> Break </td>');
				$(".add_2").before('<td class="'+td_new_class+'" style="display:table-cell; vertical-align:middle;"> Break </td>');
				$(".add_3").before('<td class="'+td_new_class+'" style="display:table-cell; vertical-align:middle;"> Break </td>');
				$(".add_4").before('<td class="'+td_new_class+'" style="display:table-cell; vertical-align:middle;"> Break </td>');
				$(".add_5").before('<td class="'+td_new_class+'" style="display:table-cell; vertical-align:middle;"> Break </td>');
				$(".add_6").before('<td class="'+td_new_class+'" style="display:table-cell; vertical-align:middle;"> Break </td>');
			}

		}//end if(count_td <= 8)
		else
		{
			alert("You Can Not Add More Column !");
		}

	});


	//display batch when choose course in filter field..
	$("#course").change(function() {
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
		$(this).parent().removeClass('has-error');
		$(".view-display").hide();
		$(".insert-display").show();
		$(".insert-form").show();
		$(".update-view-display").hide();
	});

	$("#batch").change(function(){
		var batch_id = $(this).val();

		$.ajax({
			url: "<?php echo base_url();?>index.php/study/lecture_check",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {batch_id : batch_id},
			success: function(result){
				if(result)
				{
					$(".view-display").html(result);
					$(".view-display").show();
					$(".insert-display").hide();
				}
				else
				{
					$(".view-display").hide();
					$(".insert-display").show();
				}
			}
		});

		$.ajax({
			url: "<?php echo base_url();?>index.php/study/batch_subject",
			type: 'POST',
			// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
			data: {batch_id : batch_id},
			success: function(result){
				$(".subject").html(result);
			}
		});

		$(this).parent().removeClass('has-error');
		$(".insert-form").show();
		$(".update-view-display").hide();
	});

	$(".lecture-scheduling").on('click', '.close-td', function() {
		var parent_class = $(this).parent().attr('class');

		count_td = parseInt(count_td) - 1; 

		var class_val = parent_class.split("_");

		if( $(this).parent().attr('id') == "break" )
		{
			var hello = "break_"+class_val[1];
			lecture_break.splice($.inArray(hello, lecture_break),1);
		}
		else{
			var hello = "lecture_"+class_val[1];
			lecture_break.splice($.inArray(hello, lecture_break),1);
		}

		$(".lec_"+class_val[1]).fadeOut();
		$(".sub_1_"+class_val[1]).parent().parent().fadeOut();
		$(".sub_2_"+class_val[1]).parent().parent().fadeOut();
		$(".sub_3_"+class_val[1]).parent().parent().fadeOut();
		$(".sub_4_"+class_val[1]).parent().parent().fadeOut();
		$(".sub_5_"+class_val[1]).parent().parent().fadeOut();
		$(".sub_6_"+class_val[1]).parent().parent().fadeOut();

		setTimeout(function () {
		    $(".lec_"+class_val[1]).remove();
			$(".sub_1_"+class_val[1]).parent().parent().remove();
			$(".sub_2_"+class_val[1]).parent().parent().remove();
			$(".sub_3_"+class_val[1]).parent().parent().remove();
			$(".sub_4_"+class_val[1]).parent().parent().remove();
			$(".sub_5_"+class_val[1]).parent().parent().remove();
			$(".sub_6_"+class_val[1]).parent().parent().remove();
		}, 2000);

	});

	$(".lecture-scheduling").on('change', '.end-time', function(event) {
		$(this).removeClass('test');
		var end_time_class = $(this).find('option:selected').attr("class");
		var next_start_time_class = $(this).parent().nextAll('#start-end').children('.start-time').find('option:selected').attr("class");

		if( parseInt(end_time_class) > parseInt(next_start_time_class) )
		{

			$(this).parent().nextAll('#start-end').children('.start-time').find('option.0').attr("selected",'selected');
		}

		//show all option
		$(this).parent().nextAll('#start-end').children('.start-time').find('option').remove();
		$(this).parent().nextAll('#start-end').children('.start-time').html('<option class="0" value="">Start</option> <option class="5" value="6:00 AM">6:00 AM</option> <option class="6" value="6:15 AM">6:15 AM</option> <option class="7" value="6:30 AM">6:30 AM</option> <option class="8" value="6:45 AM">6:45 AM</option> <option class="9" value="7:00 AM">7:00 AM</option> <option class="10" value="7:15 AM">7:15 AM</option> <option class="11" value="7:30 AM">7:30 AM</option> <option class="12" value="7:45 AM">7:45 AM</option> <option class="13" value="8:00 AM">8:00 AM</option> <option class="14" value="8:15 AM">8:15 AM</option> <option class="15" value="8:30 AM">8:30 AM</option> <option class="16" value="8:45 AM">8:45 AM</option> <option class="17" value="9:00 AM">9:00 AM</option> <option class="18" value="9:15 AM">9:15 AM</option> <option class="19" value="9:30 AM">9:30 AM</option> <option class="20" value="9:45 AM">9:45 AM</option> <option class="21" value="10:00 AM">10:00 AM</option> <option class="22" value="10:15 AM">10:15 AM</option> <option class="23" value="10:30 AM">10:30 AM</option> <option class="24" value="10:45 AM">10:45 AM</option> <option class="25" value="11:00 AM">11:00 AM</option> <option class="26" value="11:15 AM">11:15 AM</option> <option class="27" value="11:30 AM">11:30 AM</option> <option class="28" value="11:45 AM">11:45 AM</option> <option class="29" value="12:00 PM">12:00 PM</option> <option class="30" value="12:15 PM">12:15 PM</option> <option class="31" value="12:30 PM">12:30 PM</option> <option class="32" value="12:45 PM">12:45 PM</option> <option class="33" value="1:00 PM">1:00 PM</option> <option class="34" value="1:15 PM">1:15 PM</option> <option class="35" value="1:30 PM">1:30 PM</option> <option class="36" value="1:45 PM">1:45 PM</option> <option class="37" value="2:00 PM">2:00 PM</option> <option class="38" value="2:15 PM">2:15 PM</option> <option class="39" value="2:30 PM">2:30 PM</option> <option class="40" value="2:45 PM">2:45 PM</option> <option class="41" value="3:00 PM">3:00 PM</option> <option class="42" value="3:15 PM">3:15 PM</option> <option class="43" value="3:30 PM">3:30 PM</option> <option class="44" value="3:45 PM">3:45 PM</option> <option class="45" value="4:00 PM">4:00 PM</option> <option class="46" value="4:15 PM">4:15 PM</option> <option class="47" value="4:30 PM">4:30 PM</option> <option class="48" value="4:45 PM">4:45 PM</option> <option class="49" value="5:00 PM">5:00 PM</option> <option class="50" value="5:15 PM">5:15 PM</option> <option class="50" value="5:30 PM">5:30 PM</option> <option class="51" value="5:45 PM">5:45 PM</option> <option class="52" value="6:00 PM">6:00 PM</option> <option class="53" value="6:15 PM">6:15 PM</option> <option class="54" value="6:30 PM">6:30 PM</option> <option class="55" value="6:45 PM">6:45 PM</option> <option class="56" value="7:00 PM">7:00 PM</option> <option class="57" value="7:15 PM">7:15 PM</option> <option class="58" value="7:30 PM">7:30 PM</option> <option class="59" value="7:45 PM">7:45 PM</option> <option class="60" value="8:00 PM">8:00 PM</option> <option class="61" value="8:15 PM">8:15 PM</option> <option class="62" value="8:30 PM">8:30 PM</option> <option class="63" value="8:45 PM">8:45 PM</option> <option class="64" value="9:00 PM">9:00 PM</option> <option class="65" value="9:15 PM">9:15 PM</option> <option class="66" value="9:30 PM">9:30 PM</option> <option class="67" value="9:45 PM">9:45 PM</option> <option class="68" value="10:00 PM">10:00 PM</option> <option class="69" value="10:15 PM">10:15 PM</option> <option class="70" value="10:30 PM">10:30 PM</option> <option class="71" value="10:45 PM">10:45 PM</option> <option class="72" value="11:00 PM">11:00 PM</option> <option class="73" value="11:15 PM">11:15 PM</option> <option class="74" value="11:30 PM">11:30 PM</option> <option class="75" value="11:45 PM">11:45 PM</option>');

		for(var i = 1; i < end_time_class; i++)
		{
			$(this).parent().nextAll('#start-end').children('.start-time').find('option.'+i).remove();
		}
		// $(this).parent().nextAll('#start-end').hide();

	});


	$(".lecture-scheduling").on('change', '.subject', function(event) {
		$(this).parent().removeClass('has-error');
	});


	$(".lecture-scheduling").on('change', '.teacher', function(event) {
		$(this).parent().removeClass('has-error');
	});


	$(".form-submit-btn").click(function(event) {
		flag_start_time = 1;
		flag_end_time = 1;
		flag_teacher = 1;
		flag_subject = 1;
		if( $("#course").val() != "" )
		{
			flag_course = 1;
		}
		else
		{
			flag_course = 0;
			$('#course').parent().addClass('has-error');
			$('.lecture-scheduling').animate({scrollTop:0}, 1000);
		}

		if( $("#batch").val() != "" )
		{
			flag_batch = 1;
		}
		else
		{
			flag_batch = 0;
			$('#batch').parent().addClass('has-error');
			$('.lecture-scheduling').animate({scrollTop:0}, 1000);
		}

		$(".start-time").each(function() {
			if( $(this).val() == "")
			{
				$(this).addClass('test');
				flag_start_time = 0;
			}
			else{
				if(flag_start_time == 1)
				{
					flag_start_time = 1;
				}
			}
		});
		if(flag_start_time == 0)
		{
			$('.lecture-scheduling').animate({scrollTop:0}, 1000);
		}

		$(".end-time").each(function() {
			if( $(this).val() == "")
			{
				$(this).addClass('test');
				flag_end_time = 0;
			}
			else{
				if(flag_end_time == 1)
				{
					flag_end_time = 1;
				}
			}
		});
		if(flag_end_time == 0)
		{
			$('.lecture-scheduling').animate({scrollTop:0}, 1000);
		}
		$(".subject").each(function() {
			if( $(this).val() != "" )
			{
				if($(this).parent().next().children('.teacher').val() == "")
				{
					$(this).parent().next().addClass('has-error');
					flag_teacher = 0;
				}
				else
				{
					if(flag_teacher == 1)
					{
						flag_teacher = 1;
					}
				}
			}
		});

		$(".teacher").each(function() {
			if( $(this).val() != "" )
			{
				if($(this).parent().prev().children('.subject').val() == "")
				{
					$(this).parent().prev().addClass('has-error');
					flag_subject = 0;
				}
				else
				{
					if(flag_subject == 1)
					{
						flag_subject = 1;
					}
				}
			}
		});

		if(flag_teacher == 0)
		{
			alert("Please Select Teacher !");
		}
		if(flag_subject == 0)
		{
			alert("Please Select Subject !");
		}

		$("#lecture_type").val(lecture_break);

		if(flag_course == 1 && flag_batch == 1 && flag_start_time == 1 && flag_end_time == 1 && flag_teacher == 1 && flag_subject == 1)
		{
			$("#lecture-form").submit();
		}

	});

	$(".success-msg-top").delay(2000).slideUp(1300);

	$(".view").click(function(event) {
		/* Act on the event */
		$(".list-view").slideToggle();
	});
	
	$(document).click( function (event) {
	    var className = event.target.className;
	    if(className == "list-view" || className == "submit-btn view"){
	        return false;
	    }
	    else
	    {
	    	$(".list-view").slideUp();
	    }

	});

});


</script>

<?php
$this->session->unset_userdata('update_lecture');
$this->session->unset_userdata('insert_lecture');
$this->session->unset_userdata('course');
$this->session->unset_userdata('batch');
?>