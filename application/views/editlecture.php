<!-- heading -->
<div class="row heading">
	<div class="col-lg-3">
		Lecture Scheduling
	</div>
	<div class="col-lg-6">
		<div class="success-msg-top">
			<?php
			if(isset($insert_lecture))
			{
				echo "Lecture Has Been Successfully Scheduled.";
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
		<div class="col-lg-10 col-centered">
			<div class="row view-course-batch">
				<div class="col-lg-6">
					<span>Course : </span>
					<?php echo $course_detail['name'];?> 
				</div>
				<div class="col-lg-6">
					Batch : <?php echo $batch_detail['name']; ?>
				</div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-lg-11 col-centered  insert-display">
			<div class="row">
				<div class="col-lg-12">
					<table class="table table-bordered">
					<?php
		                for($i = 0; $i < 7; $i++)
		                {
		                    if($i == 0)
		                    {
		                    	echo "<tr>";
		                        echo "<td></td>";
		                        $x = 1;
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Monday")
		                            {
		                            	$start_time = str_replace(".", ":", $lecture['start_time']);
		                            	$end_time = str_replace(".", ":", $lecture['end_time']);
		                                if($lecture['start_time'] == "Break")
		                                {
		                                    echo "<td class='lec_$x' id='break' style='position:relative'>
		                                    		<img src='".base_url()."/img/close.png' class='close-td'>
			                                    Break
			                                    </td>";
		                                }
		                                else
		                                {
		                                	if($x == 1)
		                                	{
		                                		?>
		                                		<td class="lec_<?php echo $x; ?>" id="start-end">
		                                    		<select name="start_time_<?php echo $x; ?>" class="start-time">
		                                    		
														<option   class="0" value="">Start</option>
													 
														<option <?php if($start_time == "6:00 AM") echo "selected"; ?> class="5" value="6:00 AM">6:00 AM</option>
														<option <?php if($start_time == "6:15 AM") echo "selected"; ?> class="6" value="6:15 AM">6:15 AM</option>
														<option <?php if($start_time == "6:30 AM") echo "selected"; ?> class="7" value="6:30 AM">6:30 AM</option>
														<option <?php if($start_time == "6:45 AM") echo "selected"; ?> class="8" value="6:45 AM">6:45 AM</option>
													 
														<option <?php if($start_time == "7:00 AM") echo "selected"; ?> class="9" value="7:00 AM">7:00 AM</option>
														<option <?php if($start_time == "7:15 AM") echo "selected"; ?> class="10" value="7:15 AM">7:15 AM</option>
														<option <?php if($start_time == "7:30 AM") echo "selected"; ?> class="11" value="7:30 AM">7:30 AM</option>
														<option <?php if($start_time == "7:45 AM") echo "selected"; ?> class="12" value="7:45 AM">7:45 AM</option>
													 
														<option <?php if($start_time == "8:00 AM") echo "selected"; ?> class="13" value="8:00 AM">8:00 AM</option>
														<option <?php if($start_time == "8:15 AM") echo "selected"; ?> class="14" value="8:15 AM">8:15 AM</option>
														<option <?php if($start_time == "8:30 AM") echo "selected"; ?> class="15" value="8:30 AM">8:30 AM</option>
														<option <?php if($start_time == "8:45 AM") echo "selected"; ?> class="16" value="8:45 AM">8:45 AM</option>
													 
														<option <?php if($start_time == "9:00 AM") echo "selected"; ?> class="17" value="9:00 AM">9:00 AM</option>
														<option <?php if($start_time == "9:15 AM") echo "selected"; ?> class="18" value="9:15 AM">9:15 AM</option>
														<option <?php if($start_time == "9:30 AM") echo "selected"; ?> class="19" value="9:30 AM">9:30 AM</option>
														<option <?php if($start_time == "9:45 AM") echo "selected"; ?> class="20" value="9:45 AM">9:45 AM</option>
													 
														<option <?php if($start_time == "10:00 AM") echo "selected"; ?> class="21" value="10:00 AM">10:00 AM</option>
														<option <?php if($start_time == "10:15 AM") echo "selected"; ?> class="22" value="10:15 AM">10:15 AM</option>
														<option <?php if($start_time == "10:30 AM") echo "selected"; ?> class="23" value="10:30 AM">10:30 AM</option>
														<option <?php if($start_time == "10:45 AM") echo "selected"; ?> class="24" value="10:45 AM">10:45 AM</option>
													 
														<option <?php if($start_time == "11:00 AM") echo "selected"; ?> class="25" value="11:00 AM">11:00 AM</option>
														<option <?php if($start_time == "11:15 AM") echo "selected"; ?> class="26" value="11:15 AM">11:15 AM</option>
														<option <?php if($start_time == "11:30 AM") echo "selected"; ?> class="27" value="11:30 AM">11:30 AM</option>
														<option <?php if($start_time == "11:45 AM") echo "selected"; ?> class="28" value="11:45 AM">11:45 AM</option>
													 
														<option <?php if($start_time == "12:00 PM") echo "selected"; ?> class="29" value="12:00 PM">12:00 PM</option>
														<option <?php if($start_time == "12:15 PM") echo "selected"; ?> class="30" value="12:15 PM">12:15 PM</option>
														<option <?php if($start_time == "12:30 PM") echo "selected"; ?> class="31" value="12:30 PM">12:30 PM</option>
														<option <?php if($start_time == "12:45 PM") echo "selected"; ?> class="32" value="12:45 PM">12:45 PM</option>
													 
														<option <?php if($start_time == "1:00 PM") echo "selected"; ?> class="33" value="1:00 PM">1:00 PM</option>
														<option <?php if($start_time == "1:15 PM") echo "selected"; ?> class="34" value="1:15 PM">1:15 PM</option>
														<option <?php if($start_time == "1:30 PM") echo "selected"; ?> class="35" value="1:30 PM">1:30 PM</option>
														<option <?php if($start_time == "1:45 PM") echo "selected"; ?> class="36" value="1:45 PM">1:45 PM</option>
													 
														<option <?php if($start_time == "2:00 PM") echo "selected"; ?> class="37" value="2:00 PM">2:00 PM</option>
														<option <?php if($start_time == "2:15 PM") echo "selected"; ?> class="38" value="2:15 PM">2:15 PM</option>
														<option <?php if($start_time == "2:30 PM") echo "selected"; ?> class="39" value="2:30 PM">2:30 PM</option>
														<option <?php if($start_time == "2:45 PM") echo "selected"; ?> class="40" value="2:45 PM">2:45 PM</option>
													 
														<option <?php if($start_time == "3:00 PM") echo "selected"; ?> class="41" value="3:00 PM">3:00 PM</option>
														<option <?php if($start_time == "3:15 PM") echo "selected"; ?> class="42" value="3:15 PM">3:15 PM</option>
														<option <?php if($start_time == "3:30 PM") echo "selected"; ?> class="43" value="3:30 PM">3:30 PM</option>
														<option <?php if($start_time == "3:45 PM") echo "selected"; ?> class="44" value="3:45 PM">3:45 PM</option>
													 
														<option <?php if($start_time == "4:00 PM") echo "selected"; ?> class="45" value="4:00 PM">4:00 PM</option>
														<option <?php if($start_time == "4:15 PM") echo "selected"; ?> class="46" value="4:15 PM">4:15 PM</option>
														<option <?php if($start_time == "4:30 PM") echo "selected"; ?> class="47" value="4:30 PM">4:30 PM</option>
														<option <?php if($start_time == "4:45 PM") echo "selected"; ?> class="48" value="4:45 PM">4:45 PM</option>
													 
														<option <?php if($start_time == "5:00 PM") echo "selected"; ?> class="49" value="5:00 PM">5:00 PM</option>
														<option <?php if($start_time == "5:15 PM") echo "selected"; ?> class="50" value="5:15 PM">5:15 PM</option>
														<option <?php if($start_time == "5:30 PM") echo "selected"; ?> class="50" value="5:30 PM">5:30 PM</option>
														<option <?php if($start_time == "5:45 PM") echo "selected"; ?> class="51" value="5:45 PM">5:45 PM</option>
													 
														<option <?php if($start_time == "6:00 PM") echo "selected"; ?> class="52" value="6:00 PM">6:00 PM</option>
														<option <?php if($start_time == "6:15 PM") echo "selected"; ?> class="53" value="6:15 PM">6:15 PM</option>
														<option <?php if($start_time == "6:30 PM") echo "selected"; ?> class="54" value="6:30 PM">6:30 PM</option>
														<option <?php if($start_time == "6:45 PM") echo "selected"; ?> class="55" value="6:45 PM">6:45 PM</option>
													 
														<option <?php if($start_time == "7:00 PM") echo "selected"; ?> class="56" value="7:00 PM">7:00 PM</option>
														<option <?php if($start_time == "7:15 PM") echo "selected"; ?> class="57" value="7:15 PM">7:15 PM</option>
														<option <?php if($start_time == "7:30 PM") echo "selected"; ?> class="58" value="7:30 PM">7:30 PM</option>
														<option <?php if($start_time == "7:45 PM") echo "selected"; ?> class="59" value="7:45 PM">7:45 PM</option>
													 
														<option <?php if($start_time == "8:00 PM") echo "selected"; ?> class="60" value="8:00 PM">8:00 PM</option>
														<option <?php if($start_time == "8:15 PM") echo "selected"; ?> class="61" value="8:15 PM">8:15 PM</option>
														<option <?php if($start_time == "8:30 PM") echo "selected"; ?> class="62" value="8:30 PM">8:30 PM</option>
														<option <?php if($start_time == "8:45 PM") echo "selected"; ?> class="63" value="8:45 PM">8:45 PM</option>
													 
														<option <?php if($start_time == "9:00 PM") echo "selected"; ?> class="64" value="9:00 PM">9:00 PM</option>
														<option <?php if($start_time == "9:15 PM") echo "selected"; ?> class="65" value="9:15 PM">9:15 PM</option>
														<option <?php if($start_time == "9:30 PM") echo "selected"; ?> class="66" value="9:30 PM">9:30 PM</option>
														<option <?php if($start_time == "9:45 PM") echo "selected"; ?> class="67" value="9:45 PM">9:45 PM</option>
													 
														<option <?php if($start_time == "10:00 PM") echo "selected"; ?> class="68" value="10:00 PM">10:00 PM</option>
														<option <?php if($start_time == "10:15 PM") echo "selected"; ?> class="69" value="10:15 PM">10:15 PM</option>
														<option <?php if($start_time == "10:30 PM") echo "selected"; ?> class="70" value="10:30 PM">10:30 PM</option>
														<option <?php if($start_time == "10:45 PM") echo "selected"; ?> class="71" value="10:45 PM">10:45 PM</option>
													 
														<option <?php if($start_time == "11:00 PM") echo "selected"; ?> class="72" value="11:00 PM">11:00 PM</option>
														<option <?php if($start_time == "11:15 PM") echo "selected"; ?> class="73" value="11:15 PM">11:15 PM</option>
														<option <?php if($start_time == "11:30 PM") echo "selected"; ?> class="74" value="11:30 PM">11:30 PM</option>
														<option <?php if($start_time == "11:45 PM") echo "selected"; ?> class="75" value="11:45 PM">11:45 PM</option>
													</select>

													<select name="end_time_<?php echo $x; ?>" class="end-time">

														<option class="0" value="">End</option>
													 
														<option <?php if($end_time == "6:00 AM") echo "selected"; ?> class="5" value="6:00 AM">6:00 AM</option>
														<option <?php if($end_time == "6:15 AM") echo "selected"; ?> class="6" value="6:15 AM">6:15 AM</option>
														<option <?php if($end_time == "6:30 AM") echo "selected"; ?> class="7" value="6:30 AM">6:30 AM</option>
														<option <?php if($end_time == "6:45 AM") echo "selected"; ?> class="8" value="6:45 AM">6:45 AM</option>
													 
														<option <?php if($end_time == "7:00 AM") echo "selected"; ?> class="9" value="7:00 AM">7:00 AM</option>
														<option <?php if($end_time == "7:15 AM") echo "selected"; ?> class="10" value="7:15 AM">7:15 AM</option>
														<option <?php if($end_time == "7:30 AM") echo "selected"; ?> class="11" value="7:30 AM">7:30 AM</option>
														<option <?php if($end_time == "7:45 AM") echo "selected"; ?> class="12" value="7:45 AM">7:45 AM</option>
													 
														<option <?php if($end_time == "8:00 AM") echo "selected"; ?> class="13" value="8:00 AM">8:00 AM</option>
														<option <?php if($end_time == "8:15 AM") echo "selected"; ?> class="14" value="8:15 AM">8:15 AM</option>
														<option <?php if($end_time == "8:30 AM") echo "selected"; ?> class="15" value="8:30 AM">8:30 AM</option>
														<option <?php if($end_time == "8:45 AM") echo "selected"; ?> class="16" value="8:45 AM">8:45 AM</option>
													 
														<option <?php if($end_time == "9:00 AM") echo "selected"; ?> class="17" value="9:00 AM">9:00 AM</option>
														<option <?php if($end_time == "9:15 AM") echo "selected"; ?> class="18" value="9:15 AM">9:15 AM</option>
														<option <?php if($end_time == "9:30 AM") echo "selected"; ?> class="19" value="9:30 AM">9:30 AM</option>
														<option <?php if($end_time == "9:45 AM") echo "selected"; ?> class="20" value="9:45 AM">9:45 AM</option>
													 
														<option <?php if($end_time == "10:00 AM") echo "selected"; ?> class="21" value="10:00 AM">10:00 AM</option>
														<option <?php if($end_time == "10:15 AM") echo "selected"; ?> class="22" value="10:15 AM">10:15 AM</option>
														<option <?php if($end_time == "10:30 AM") echo "selected"; ?> class="23" value="10:30 AM">10:30 AM</option>
														<option <?php if($end_time == "10:45 AM") echo "selected"; ?> class="24" value="10:45 AM">10:45 AM</option>
													 
														<option <?php if($end_time == "11:00 AM") echo "selected"; ?> class="25" value="11:00 AM">11:00 AM</option>
														<option <?php if($end_time == "11:15 AM") echo "selected"; ?> class="26" value="11:15 AM">11:15 AM</option>
														<option <?php if($end_time == "11:30 AM") echo "selected"; ?> class="27" value="11:30 AM">11:30 AM</option>
														<option <?php if($end_time == "11:45 AM") echo "selected"; ?> class="28" value="11:45 AM">11:45 AM</option>
													 
														<option <?php if($end_time == "12:00 PM") echo "selected"; ?> class="29" value="12:00 PM">12:00 PM</option>
														<option <?php if($end_time == "12:15 PM") echo "selected"; ?> class="30" value="12:15 PM">12:15 PM</option>
														<option <?php if($end_time == "12:30 PM") echo "selected"; ?> class="31" value="12:30 PM">12:30 PM</option>
														<option <?php if($end_time == "12:45 PM") echo "selected"; ?> class="32" value="12:45 PM">12:45 PM</option>
													 
														<option <?php if($end_time == "1:00 PM") echo "selected"; ?> class="33" value="1:00 PM">1:00 PM</option>
														<option <?php if($end_time == "1:15 PM") echo "selected"; ?> class="34" value="1:15 PM">1:15 PM</option>
														<option <?php if($end_time == "1:30 PM") echo "selected"; ?> class="35" value="1:30 PM">1:30 PM</option>
														<option <?php if($end_time == "1:45 PM") echo "selected"; ?> class="36" value="1:45 PM">1:45 PM</option>
													 
														<option <?php if($end_time == "2:00 PM") echo "selected"; ?> class="37" value="2:00 PM">2:00 PM</option>
														<option <?php if($end_time == "2:15 PM") echo "selected"; ?> class="38" value="2:15 PM">2:15 PM</option>
														<option <?php if($end_time == "2:30 PM") echo "selected"; ?> class="39" value="2:30 PM">2:30 PM</option>
														<option <?php if($end_time == "2:45 PM") echo "selected"; ?> class="40" value="2:45 PM">2:45 PM</option>
													 
														<option <?php if($end_time == "3:00 PM") echo "selected"; ?> class="41" value="3:00 PM">3:00 PM</option>
														<option <?php if($end_time == "3:15 PM") echo "selected"; ?> class="42" value="3:15 PM">3:15 PM</option>
														<option <?php if($end_time == "3:30 PM") echo "selected"; ?> class="43" value="3:30 PM">3:30 PM</option>
														<option <?php if($end_time == "3:45 PM") echo "selected"; ?> class="44" value="3:45 PM">3:45 PM</option>
													 
														<option <?php if($end_time == "4:00 PM") echo "selected"; ?> class="45" value="4:00 PM">4:00 PM</option>
														<option <?php if($end_time == "4:15 PM") echo "selected"; ?> class="46" value="4:15 PM">4:15 PM</option>
														<option <?php if($end_time == "4:30 PM") echo "selected"; ?> class="47" value="4:30 PM">4:30 PM</option>
														<option <?php if($end_time == "4:45 PM") echo "selected"; ?> class="48" value="4:45 PM">4:45 PM</option>
													 
														<option <?php if($end_time == "5:00 PM") echo "selected"; ?> class="49" value="5:00 PM">5:00 PM</option>
														<option <?php if($end_time == "5:15 PM") echo "selected"; ?> class="50" value="5:15 PM">5:15 PM</option>
														<option <?php if($end_time == "5:30 PM") echo "selected"; ?> class="50" value="5:30 PM">5:30 PM</option>
														<option <?php if($end_time == "5:45 PM") echo "selected"; ?> class="51" value="5:45 PM">5:45 PM</option>
													 
														<option <?php if($end_time == "6:00 PM") echo "selected"; ?> class="52" value="6:00 PM">6:00 PM</option>
														<option <?php if($end_time == "6:15 PM") echo "selected"; ?> class="53" value="6:15 PM">6:15 PM</option>
														<option <?php if($end_time == "6:30 PM") echo "selected"; ?> class="54" value="6:30 PM">6:30 PM</option>
														<option <?php if($end_time == "6:45 PM") echo "selected"; ?> class="55" value="6:45 PM">6:45 PM</option>
													 
														<option <?php if($end_time == "7:00 PM") echo "selected"; ?> class="56" value="7:00 PM">7:00 PM</option>
														<option <?php if($end_time == "7:15 PM") echo "selected"; ?> class="57" value="7:15 PM">7:15 PM</option>
														<option <?php if($end_time == "7:30 PM") echo "selected"; ?> class="58" value="7:30 PM">7:30 PM</option>
														<option <?php if($end_time == "7:45 PM") echo "selected"; ?> class="59" value="7:45 PM">7:45 PM</option>
													 
														<option <?php if($end_time == "8:00 PM") echo "selected"; ?> class="60" value="8:00 PM">8:00 PM</option>
														<option <?php if($end_time == "8:15 PM") echo "selected"; ?> class="61" value="8:15 PM">8:15 PM</option>
														<option <?php if($end_time == "8:30 PM") echo "selected"; ?> class="62" value="8:30 PM">8:30 PM</option>
														<option <?php if($end_time == "8:45 PM") echo "selected"; ?> class="63" value="8:45 PM">8:45 PM</option>
													 
														<option <?php if($end_time == "9:00 PM") echo "selected"; ?> class="64" value="9:00 PM">9:00 PM</option>
														<option <?php if($end_time == "9:15 PM") echo "selected"; ?> class="65" value="9:15 PM">9:15 PM</option>
														<option <?php if($end_time == "9:30 PM") echo "selected"; ?> class="66" value="9:30 PM">9:30 PM</option>
														<option <?php if($end_time == "9:45 PM") echo "selected"; ?> class="67" value="9:45 PM">9:45 PM</option>
													 
														<option <?php if($end_time == "10:00 PM") echo "selected"; ?> class="68" value="10:00 PM">10:00 PM</option>
														<option <?php if($end_time == "10:15 PM") echo "selected"; ?> class="69" value="10:15 PM">10:15 PM</option>
														<option <?php if($end_time == "10:30 PM") echo "selected"; ?> class="70" value="10:30 PM">10:30 PM</option>
														<option <?php if($end_time == "10:45 PM") echo "selected"; ?> class="71" value="10:45 PM">10:45 PM</option>
													 
														<option <?php if($end_time == "11:00 PM") echo "selected"; ?> class="72" value="11:00 PM">11:00 PM</option>
														<option <?php if($end_time == "11:15 PM") echo "selected"; ?> class="73" value="11:15 PM">11:15 PM</option>
														<option <?php if($end_time == "11:30 PM") echo "selected"; ?> class="74" value="11:30 PM">11:30 PM</option>
														<option <?php if($end_time == "11:45 PM") echo "selected"; ?> class="75" value="11:45 PM">11:45 PM</option>
													</select>
			                                    </td>
			                                 <?php
		                                	}
		                                	else
		                                	{
		                                		?>
		                                		<td class="lec_<?php echo $x; ?>" id="start-end" style="position:relative;">
		                                			<img src="<?php echo base_url(); ?>img/close.png" class="close-td">
		                                    		<select name="start_time_<?php echo $x; ?>" class="start-time">
		                                    		
														<option   class="0" value="">Start</option>
													 
														<option <?php if($start_time == "6:00 AM") echo "selected"; ?> class="5" value="6:00 AM">6:00 AM</option>
														<option <?php if($start_time == "6:15 AM") echo "selected"; ?> class="6" value="6:15 AM">6:15 AM</option>
														<option <?php if($start_time == "6:30 AM") echo "selected"; ?> class="7" value="6:30 AM">6:30 AM</option>
														<option <?php if($start_time == "6:45 AM") echo "selected"; ?> class="8" value="6:45 AM">6:45 AM</option>
													 
														<option <?php if($start_time == "7:00 AM") echo "selected"; ?> class="9" value="7:00 AM">7:00 AM</option>
														<option <?php if($start_time == "7:15 AM") echo "selected"; ?> class="10" value="7:15 AM">7:15 AM</option>
														<option <?php if($start_time == "7:30 AM") echo "selected"; ?> class="11" value="7:30 AM">7:30 AM</option>
														<option <?php if($start_time == "7:45 AM") echo "selected"; ?> class="12" value="7:45 AM">7:45 AM</option>
													 
														<option <?php if($start_time == "8:00 AM") echo "selected"; ?> class="13" value="8:00 AM">8:00 AM</option>
														<option <?php if($start_time == "8:15 AM") echo "selected"; ?> class="14" value="8:15 AM">8:15 AM</option>
														<option <?php if($start_time == "8:30 AM") echo "selected"; ?> class="15" value="8:30 AM">8:30 AM</option>
														<option <?php if($start_time == "8:45 AM") echo "selected"; ?> class="16" value="8:45 AM">8:45 AM</option>
													 
														<option <?php if($start_time == "9:00 AM") echo "selected"; ?> class="17" value="9:00 AM">9:00 AM</option>
														<option <?php if($start_time == "9:15 AM") echo "selected"; ?> class="18" value="9:15 AM">9:15 AM</option>
														<option <?php if($start_time == "9:30 AM") echo "selected"; ?> class="19" value="9:30 AM">9:30 AM</option>
														<option <?php if($start_time == "9:45 AM") echo "selected"; ?> class="20" value="9:45 AM">9:45 AM</option>
													 
														<option <?php if($start_time == "10:00 AM") echo "selected"; ?> class="21" value="10:00 AM">10:00 AM</option>
														<option <?php if($start_time == "10:15 AM") echo "selected"; ?> class="22" value="10:15 AM">10:15 AM</option>
														<option <?php if($start_time == "10:30 AM") echo "selected"; ?> class="23" value="10:30 AM">10:30 AM</option>
														<option <?php if($start_time == "10:45 AM") echo "selected"; ?> class="24" value="10:45 AM">10:45 AM</option>
													 
														<option <?php if($start_time == "11:00 AM") echo "selected"; ?> class="25" value="11:00 AM">11:00 AM</option>
														<option <?php if($start_time == "11:15 AM") echo "selected"; ?> class="26" value="11:15 AM">11:15 AM</option>
														<option <?php if($start_time == "11:30 AM") echo "selected"; ?> class="27" value="11:30 AM">11:30 AM</option>
														<option <?php if($start_time == "11:45 AM") echo "selected"; ?> class="28" value="11:45 AM">11:45 AM</option>
													 
														<option <?php if($start_time == "12:00 PM") echo "selected"; ?> class="29" value="12:00 PM">12:00 PM</option>
														<option <?php if($start_time == "12:15 PM") echo "selected"; ?> class="30" value="12:15 PM">12:15 PM</option>
														<option <?php if($start_time == "12:30 PM") echo "selected"; ?> class="31" value="12:30 PM">12:30 PM</option>
														<option <?php if($start_time == "12:45 PM") echo "selected"; ?> class="32" value="12:45 PM">12:45 PM</option>
													 
														<option <?php if($start_time == "1:00 PM") echo "selected"; ?> class="33" value="1:00 PM">1:00 PM</option>
														<option <?php if($start_time == "1:15 PM") echo "selected"; ?> class="34" value="1:15 PM">1:15 PM</option>
														<option <?php if($start_time == "1:30 PM") echo "selected"; ?> class="35" value="1:30 PM">1:30 PM</option>
														<option <?php if($start_time == "1:45 PM") echo "selected"; ?> class="36" value="1:45 PM">1:45 PM</option>
													 
														<option <?php if($start_time == "2:00 PM") echo "selected"; ?> class="37" value="2:00 PM">2:00 PM</option>
														<option <?php if($start_time == "2:15 PM") echo "selected"; ?> class="38" value="2:15 PM">2:15 PM</option>
														<option <?php if($start_time == "2:30 PM") echo "selected"; ?> class="39" value="2:30 PM">2:30 PM</option>
														<option <?php if($start_time == "2:45 PM") echo "selected"; ?> class="40" value="2:45 PM">2:45 PM</option>
													 
														<option <?php if($start_time == "3:00 PM") echo "selected"; ?> class="41" value="3:00 PM">3:00 PM</option>
														<option <?php if($start_time == "3:15 PM") echo "selected"; ?> class="42" value="3:15 PM">3:15 PM</option>
														<option <?php if($start_time == "3:30 PM") echo "selected"; ?> class="43" value="3:30 PM">3:30 PM</option>
														<option <?php if($start_time == "3:45 PM") echo "selected"; ?> class="44" value="3:45 PM">3:45 PM</option>
													 
														<option <?php if($start_time == "4:00 PM") echo "selected"; ?> class="45" value="4:00 PM">4:00 PM</option>
														<option <?php if($start_time == "4:15 PM") echo "selected"; ?> class="46" value="4:15 PM">4:15 PM</option>
														<option <?php if($start_time == "4:30 PM") echo "selected"; ?> class="47" value="4:30 PM">4:30 PM</option>
														<option <?php if($start_time == "4:45 PM") echo "selected"; ?> class="48" value="4:45 PM">4:45 PM</option>
													 
														<option <?php if($start_time == "5:00 PM") echo "selected"; ?> class="49" value="5:00 PM">5:00 PM</option>
														<option <?php if($start_time == "5:15 PM") echo "selected"; ?> class="50" value="5:15 PM">5:15 PM</option>
														<option <?php if($start_time == "5:30 PM") echo "selected"; ?> class="50" value="5:30 PM">5:30 PM</option>
														<option <?php if($start_time == "5:45 PM") echo "selected"; ?> class="51" value="5:45 PM">5:45 PM</option>
													 
														<option <?php if($start_time == "6:00 PM") echo "selected"; ?> class="52" value="6:00 PM">6:00 PM</option>
														<option <?php if($start_time == "6:15 PM") echo "selected"; ?> class="53" value="6:15 PM">6:15 PM</option>
														<option <?php if($start_time == "6:30 PM") echo "selected"; ?> class="54" value="6:30 PM">6:30 PM</option>
														<option <?php if($start_time == "6:45 PM") echo "selected"; ?> class="55" value="6:45 PM">6:45 PM</option>
													 
														<option <?php if($start_time == "7:00 PM") echo "selected"; ?> class="56" value="7:00 PM">7:00 PM</option>
														<option <?php if($start_time == "7:15 PM") echo "selected"; ?> class="57" value="7:15 PM">7:15 PM</option>
														<option <?php if($start_time == "7:30 PM") echo "selected"; ?> class="58" value="7:30 PM">7:30 PM</option>
														<option <?php if($start_time == "7:45 PM") echo "selected"; ?> class="59" value="7:45 PM">7:45 PM</option>
													 
														<option <?php if($start_time == "8:00 PM") echo "selected"; ?> class="60" value="8:00 PM">8:00 PM</option>
														<option <?php if($start_time == "8:15 PM") echo "selected"; ?> class="61" value="8:15 PM">8:15 PM</option>
														<option <?php if($start_time == "8:30 PM") echo "selected"; ?> class="62" value="8:30 PM">8:30 PM</option>
														<option <?php if($start_time == "8:45 PM") echo "selected"; ?> class="63" value="8:45 PM">8:45 PM</option>
													 
														<option <?php if($start_time == "9:00 PM") echo "selected"; ?> class="64" value="9:00 PM">9:00 PM</option>
														<option <?php if($start_time == "9:15 PM") echo "selected"; ?> class="65" value="9:15 PM">9:15 PM</option>
														<option <?php if($start_time == "9:30 PM") echo "selected"; ?> class="66" value="9:30 PM">9:30 PM</option>
														<option <?php if($start_time == "9:45 PM") echo "selected"; ?> class="67" value="9:45 PM">9:45 PM</option>
													 
														<option <?php if($start_time == "10:00 PM") echo "selected"; ?> class="68" value="10:00 PM">10:00 PM</option>
														<option <?php if($start_time == "10:15 PM") echo "selected"; ?> class="69" value="10:15 PM">10:15 PM</option>
														<option <?php if($start_time == "10:30 PM") echo "selected"; ?> class="70" value="10:30 PM">10:30 PM</option>
														<option <?php if($start_time == "10:45 PM") echo "selected"; ?> class="71" value="10:45 PM">10:45 PM</option>
													 
														<option <?php if($start_time == "11:00 PM") echo "selected"; ?> class="72" value="11:00 PM">11:00 PM</option>
														<option <?php if($start_time == "11:15 PM") echo "selected"; ?> class="73" value="11:15 PM">11:15 PM</option>
														<option <?php if($start_time == "11:30 PM") echo "selected"; ?> class="74" value="11:30 PM">11:30 PM</option>
														<option <?php if($start_time == "11:45 PM") echo "selected"; ?> class="75" value="11:45 PM">11:45 PM</option>
													</select>

													<select name="end_time_<?php echo $x; ?>" class="end-time">

														<option class="0" value="">End</option>
													 
														<option <?php if($end_time == "6:00 AM") echo "selected"; ?> class="5" value="6:00 AM">6:00 AM</option>
														<option <?php if($end_time == "6:15 AM") echo "selected"; ?> class="6" value="6:15 AM">6:15 AM</option>
														<option <?php if($end_time == "6:30 AM") echo "selected"; ?> class="7" value="6:30 AM">6:30 AM</option>
														<option <?php if($end_time == "6:45 AM") echo "selected"; ?> class="8" value="6:45 AM">6:45 AM</option>
													 
														<option <?php if($end_time == "7:00 AM") echo "selected"; ?> class="9" value="7:00 AM">7:00 AM</option>
														<option <?php if($end_time == "7:15 AM") echo "selected"; ?> class="10" value="7:15 AM">7:15 AM</option>
														<option <?php if($end_time == "7:30 AM") echo "selected"; ?> class="11" value="7:30 AM">7:30 AM</option>
														<option <?php if($end_time == "7:45 AM") echo "selected"; ?> class="12" value="7:45 AM">7:45 AM</option>
													 
														<option <?php if($end_time == "8:00 AM") echo "selected"; ?> class="13" value="8:00 AM">8:00 AM</option>
														<option <?php if($end_time == "8:15 AM") echo "selected"; ?> class="14" value="8:15 AM">8:15 AM</option>
														<option <?php if($end_time == "8:30 AM") echo "selected"; ?> class="15" value="8:30 AM">8:30 AM</option>
														<option <?php if($end_time == "8:45 AM") echo "selected"; ?> class="16" value="8:45 AM">8:45 AM</option>
													 
														<option <?php if($end_time == "9:00 AM") echo "selected"; ?> class="17" value="9:00 AM">9:00 AM</option>
														<option <?php if($end_time == "9:15 AM") echo "selected"; ?> class="18" value="9:15 AM">9:15 AM</option>
														<option <?php if($end_time == "9:30 AM") echo "selected"; ?> class="19" value="9:30 AM">9:30 AM</option>
														<option <?php if($end_time == "9:45 AM") echo "selected"; ?> class="20" value="9:45 AM">9:45 AM</option>
													 
														<option <?php if($end_time == "10:00 AM") echo "selected"; ?> class="21" value="10:00 AM">10:00 AM</option>
														<option <?php if($end_time == "10:15 AM") echo "selected"; ?> class="22" value="10:15 AM">10:15 AM</option>
														<option <?php if($end_time == "10:30 AM") echo "selected"; ?> class="23" value="10:30 AM">10:30 AM</option>
														<option <?php if($end_time == "10:45 AM") echo "selected"; ?> class="24" value="10:45 AM">10:45 AM</option>
													 
														<option <?php if($end_time == "11:00 AM") echo "selected"; ?> class="25" value="11:00 AM">11:00 AM</option>
														<option <?php if($end_time == "11:15 AM") echo "selected"; ?> class="26" value="11:15 AM">11:15 AM</option>
														<option <?php if($end_time == "11:30 AM") echo "selected"; ?> class="27" value="11:30 AM">11:30 AM</option>
														<option <?php if($end_time == "11:45 AM") echo "selected"; ?> class="28" value="11:45 AM">11:45 AM</option>
													 
														<option <?php if($end_time == "12:00 PM") echo "selected"; ?> class="29" value="12:00 PM">12:00 PM</option>
														<option <?php if($end_time == "12:15 PM") echo "selected"; ?> class="30" value="12:15 PM">12:15 PM</option>
														<option <?php if($end_time == "12:30 PM") echo "selected"; ?> class="31" value="12:30 PM">12:30 PM</option>
														<option <?php if($end_time == "12:45 PM") echo "selected"; ?> class="32" value="12:45 PM">12:45 PM</option>
													 
														<option <?php if($end_time == "1:00 PM") echo "selected"; ?> class="33" value="1:00 PM">1:00 PM</option>
														<option <?php if($end_time == "1:15 PM") echo "selected"; ?> class="34" value="1:15 PM">1:15 PM</option>
														<option <?php if($end_time == "1:30 PM") echo "selected"; ?> class="35" value="1:30 PM">1:30 PM</option>
														<option <?php if($end_time == "1:45 PM") echo "selected"; ?> class="36" value="1:45 PM">1:45 PM</option>
													 
														<option <?php if($end_time == "2:00 PM") echo "selected"; ?> class="37" value="2:00 PM">2:00 PM</option>
														<option <?php if($end_time == "2:15 PM") echo "selected"; ?> class="38" value="2:15 PM">2:15 PM</option>
														<option <?php if($end_time == "2:30 PM") echo "selected"; ?> class="39" value="2:30 PM">2:30 PM</option>
														<option <?php if($end_time == "2:45 PM") echo "selected"; ?> class="40" value="2:45 PM">2:45 PM</option>
													 
														<option <?php if($end_time == "3:00 PM") echo "selected"; ?> class="41" value="3:00 PM">3:00 PM</option>
														<option <?php if($end_time == "3:15 PM") echo "selected"; ?> class="42" value="3:15 PM">3:15 PM</option>
														<option <?php if($end_time == "3:30 PM") echo "selected"; ?> class="43" value="3:30 PM">3:30 PM</option>
														<option <?php if($end_time == "3:45 PM") echo "selected"; ?> class="44" value="3:45 PM">3:45 PM</option>
													 
														<option <?php if($end_time == "4:00 PM") echo "selected"; ?> class="45" value="4:00 PM">4:00 PM</option>
														<option <?php if($end_time == "4:15 PM") echo "selected"; ?> class="46" value="4:15 PM">4:15 PM</option>
														<option <?php if($end_time == "4:30 PM") echo "selected"; ?> class="47" value="4:30 PM">4:30 PM</option>
														<option <?php if($end_time == "4:45 PM") echo "selected"; ?> class="48" value="4:45 PM">4:45 PM</option>
													 
														<option <?php if($end_time == "5:00 PM") echo "selected"; ?> class="49" value="5:00 PM">5:00 PM</option>
														<option <?php if($end_time == "5:15 PM") echo "selected"; ?> class="50" value="5:15 PM">5:15 PM</option>
														<option <?php if($end_time == "5:30 PM") echo "selected"; ?> class="50" value="5:30 PM">5:30 PM</option>
														<option <?php if($end_time == "5:45 PM") echo "selected"; ?> class="51" value="5:45 PM">5:45 PM</option>
													 
														<option <?php if($end_time == "6:00 PM") echo "selected"; ?> class="52" value="6:00 PM">6:00 PM</option>
														<option <?php if($end_time == "6:15 PM") echo "selected"; ?> class="53" value="6:15 PM">6:15 PM</option>
														<option <?php if($end_time == "6:30 PM") echo "selected"; ?> class="54" value="6:30 PM">6:30 PM</option>
														<option <?php if($end_time == "6:45 PM") echo "selected"; ?> class="55" value="6:45 PM">6:45 PM</option>
													 
														<option <?php if($end_time == "7:00 PM") echo "selected"; ?> class="56" value="7:00 PM">7:00 PM</option>
														<option <?php if($end_time == "7:15 PM") echo "selected"; ?> class="57" value="7:15 PM">7:15 PM</option>
														<option <?php if($end_time == "7:30 PM") echo "selected"; ?> class="58" value="7:30 PM">7:30 PM</option>
														<option <?php if($end_time == "7:45 PM") echo "selected"; ?> class="59" value="7:45 PM">7:45 PM</option>
													 
														<option <?php if($end_time == "8:00 PM") echo "selected"; ?> class="60" value="8:00 PM">8:00 PM</option>
														<option <?php if($end_time == "8:15 PM") echo "selected"; ?> class="61" value="8:15 PM">8:15 PM</option>
														<option <?php if($end_time == "8:30 PM") echo "selected"; ?> class="62" value="8:30 PM">8:30 PM</option>
														<option <?php if($end_time == "8:45 PM") echo "selected"; ?> class="63" value="8:45 PM">8:45 PM</option>
													 
														<option <?php if($end_time == "9:00 PM") echo "selected"; ?> class="64" value="9:00 PM">9:00 PM</option>
														<option <?php if($end_time == "9:15 PM") echo "selected"; ?> class="65" value="9:15 PM">9:15 PM</option>
														<option <?php if($end_time == "9:30 PM") echo "selected"; ?> class="66" value="9:30 PM">9:30 PM</option>
														<option <?php if($end_time == "9:45 PM") echo "selected"; ?> class="67" value="9:45 PM">9:45 PM</option>
													 
														<option <?php if($end_time == "10:00 PM") echo "selected"; ?> class="68" value="10:00 PM">10:00 PM</option>
														<option <?php if($end_time == "10:15 PM") echo "selected"; ?> class="69" value="10:15 PM">10:15 PM</option>
														<option <?php if($end_time == "10:30 PM") echo "selected"; ?> class="70" value="10:30 PM">10:30 PM</option>
														<option <?php if($end_time == "10:45 PM") echo "selected"; ?> class="71" value="10:45 PM">10:45 PM</option>
													 
														<option <?php if($end_time == "11:00 PM") echo "selected"; ?> class="72" value="11:00 PM">11:00 PM</option>
														<option <?php if($end_time == "11:15 PM") echo "selected"; ?> class="73" value="11:15 PM">11:15 PM</option>
														<option <?php if($end_time == "11:30 PM") echo "selected"; ?> class="74" value="11:30 PM">11:30 PM</option>
														<option <?php if($end_time == "11:45 PM") echo "selected"; ?> class="75" value="11:45 PM">11:45 PM</option>
													</select>
			                                    </td>
			                                    <?php
		                                	}
		                                }
		                            }
		                        $x++;
		                        }
		                        echo '<td class="add">
								<select id="add">
									<option value="lecture">Lecture</option>
									<option value="break">Break</option>
								</select>
								<img class="addmore" src="'.base_url().'img/add.png" alt="">
							</td>';
		                        echo "</tr>";
		                    }//end if($i == 0)
		                    if($i == 1)
		                    {

		                        echo "<tr>";
		                        echo "<td>Monday</td>";
		                        $x = 1;
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Monday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                   echo "<td class='lec_$x'>Break</td>";
		                                }
		                                else
		                                {
		                                	$subject_name = "sub_".$i."_".$x;
		                                	$teacher_name = "teach_".$i."_".$x;
		                                	?>

		                                    <td>
		                                    <div>
		                                    	<select class='form-control subject <?php echo $subject_name; ?>' name='<?php echo $subject_name; ?>'>
		                                    		<?php 
		                                    		$batch_subject_string = $batch_detail['subject'];
											        $batch_subject = explode('/',$batch_subject_string);

											        echo '<option value="">Subject</option>';
											        foreach ($batch_subject as $subject_id) 
											        {
														$subject_detail = $this->user_model->fetchbyid($subject_id,'subject');
														
														if($lecture['subject_id'] == $subject_detail['id'])
														{
															echo '<option selected value="'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
														}
														else
														{
															echo '<option value="'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
														}
        											}
		                                    		?>
		                                    	</select>
		                                    </div>
		                                   		<select class="form-control teacher <?php echo $teacher_name; ?>" name="<?php echo $teacher_name; ?>">
													<option value="">Teacher</option>
													<?php
													foreach($teacher_detail as $teacher)
													{
														if($lecture['teacher_id'] == $teacher['id'])
														{
															echo "<option selected value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
														}
														else
														{
															echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
														}
													}
													 ?>
												</select>
		                                    <div>
		                                    </div>
		                                    </td>

		                                	<?php
		                                }
		                           	$x++;
		                            }
		                        }
		                        echo '<td class="add_1"></td>';
		                        echo "</tr>";
		                    }//end if($i == 1)

		                    if($i == 2)
		                    {

		                        echo "<tr>";
		                        echo "<td>Tuesday</td>";
		                        $x = 1;
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Tuesday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                   echo "<td class='lec_$x'>Break</td>";
		                                }
		                                else
		                                {
		                                	$subject_name = "sub_".$i."_".$x;
		                                	$teacher_name = "teach_".$i."_".$x;
		                                	?>

		                                    <td>
		                                    <div>
		                                    	<select class='form-control subject <?php echo $subject_name; ?>' name='<?php echo $subject_name; ?>'>
		                                    		<?php 
		                                    		$batch_subject_string = $batch_detail['subject'];
											        $batch_subject = explode('/',$batch_subject_string);

											        echo '<option value="">Subject</option>';
											        foreach ($batch_subject as $subject_id) 
											        {
														$subject_detail = $this->user_model->fetchbyid($subject_id,'subject');
														
														if($lecture['subject_id'] == $subject_detail['id'])
														{
															echo '<option selected value="'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
														}
														else
														{
															echo '<option value="'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
														}
        											}
		                                    		?>
		                                    	</select>
		                                    </div>
		                                   		<select class="form-control teacher <?php echo $teacher_name; ?>" name="<?php echo $teacher_name; ?>">
													<option value="">Teacher</option>
													<?php
													foreach($teacher_detail as $teacher)
													{
														if($lecture['teacher_id'] == $teacher['id'])
														{
															echo "<option selected value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
														}
														else
														{
															echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
														}
													}
													 ?>
												</select>
		                                    <div>
		                                    </div>
		                                    </td>

		                                	<?php
		                                }
		                           	$x++;
		                            }
		                        }
		                        echo '<td class="add_2"></td>';
		                        echo "</tr>";
		                    }//end if($i == 2)

		                    if($i == 3)
		                    {

		                        echo "<tr>";
		                        echo "<td>Wednesday</td>";
		                        $x = 1;
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Wednesday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                   echo "<td class='lec_$x'>Break</td>";
		                                }
		                                else
		                                {
		                                	$subject_name = "sub_".$i."_".$x;
		                                	$teacher_name = "teach_".$i."_".$x;
		                                	?>

		                                    <td>
		                                    <div>
		                                    	<select class='form-control subject <?php echo $subject_name; ?>' name='<?php echo $subject_name; ?>'>
		                                    		<?php 
		                                    		$batch_subject_string = $batch_detail['subject'];
											        $batch_subject = explode('/',$batch_subject_string);

											        echo '<option value="">Subject</option>';
											        foreach ($batch_subject as $subject_id) 
											        {
														$subject_detail = $this->user_model->fetchbyid($subject_id,'subject');
														
														if($lecture['subject_id'] == $subject_detail['id'])
														{
															echo '<option selected value="'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
														}
														else
														{
															echo '<option value="'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
														}
        											}
		                                    		?>
		                                    	</select>
		                                    </div>
		                                   		<select class="form-control teacher <?php echo $teacher_name; ?>" name="<?php echo $teacher_name; ?>">
													<option value="">Teacher</option>
													<?php
													foreach($teacher_detail as $teacher)
													{
														if($lecture['teacher_id'] == $teacher['id'])
														{
															echo "<option selected value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
														}
														else
														{
															echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
														}
													}
													 ?>
												</select>
		                                    <div>
		                                    </div>
		                                    </td>

		                                	<?php
		                                }
		                           	$x++;
		                            }
		                        }
		                        echo '<td class="add_3"></td>';
		                        echo "</tr>";
		                    }//end if($i == 3)

		                    if($i == 4)
		                    {

		                        echo "<tr>";
		                        echo "<td>Thursday</td>";
		                        $x = 1;
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Thursday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                   echo "<td class='lec_$x'>Break</td>";
		                                }
		                                else
		                                {
		                                	$subject_name = "sub_".$i."_".$x;
		                                	$teacher_name = "teach_".$i."_".$x;
		                                	?>

		                                    <td>
		                                    <div>
		                                    	<select class='form-control subject <?php echo $subject_name; ?>' name='<?php echo $subject_name; ?>'>
		                                    		<?php 
		                                    		$batch_subject_string = $batch_detail['subject'];
											        $batch_subject = explode('/',$batch_subject_string);

											        echo '<option value="">Subject</option>';
											        foreach ($batch_subject as $subject_id) 
											        {
														$subject_detail = $this->user_model->fetchbyid($subject_id,'subject');
														
														if($lecture['subject_id'] == $subject_detail['id'])
														{
															echo '<option selected value="'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
														}
														else
														{
															echo '<option value="'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
														}
        											}
		                                    		?>
		                                    	</select>
		                                    </div>
		                                   		<select class="form-control teacher <?php echo $teacher_name; ?>" name="<?php echo $teacher_name; ?>">
													<option value="">Teacher</option>
													<?php
													foreach($teacher_detail as $teacher)
													{
														if($lecture['teacher_id'] == $teacher['id'])
														{
															echo "<option selected value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
														}
														else
														{
															echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
														}
													}
													 ?>
												</select>
		                                    <div>
		                                    </div>
		                                    </td>

		                                	<?php
		                                }
		                           	$x++;
		                            }
		                        }
		                        echo '<td class="add_4"></td>';
		                        echo "</tr>";
		                    }//end if($i == 4)

		                    if($i == 5)
		                    {

		                        echo "<tr>";
		                        echo "<td>Friday</td>";
		                        $x = 1;
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Friday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                   echo "<td class='lec_$x'>Break</td>";
		                                }
		                                else
		                                {
		                                	$subject_name = "sub_".$i."_".$x;
		                                	$teacher_name = "teach_".$i."_".$x;
		                                	?>

		                                    <td>
		                                    <div>
		                                    	<select class='form-control subject <?php echo $subject_name; ?>' name='<?php echo $subject_name; ?>'>
		                                    		<?php 
		                                    		$batch_subject_string = $batch_detail['subject'];
											        $batch_subject = explode('/',$batch_subject_string);

											        echo '<option value="">Subject</option>';
											        foreach ($batch_subject as $subject_id) 
											        {
														$subject_detail = $this->user_model->fetchbyid($subject_id,'subject');
														
														if($lecture['subject_id'] == $subject_detail['id'])
														{
															echo '<option selected value="'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
														}
														else
														{
															echo '<option value="'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
														}
        											}
		                                    		?>
		                                    	</select>
		                                    </div>
		                                   		<select class="form-control teacher <?php echo $teacher_name; ?>" name="<?php echo $teacher_name; ?>">
													<option value="">Teacher</option>
													<?php
													foreach($teacher_detail as $teacher)
													{
														if($lecture['teacher_id'] == $teacher['id'])
														{
															echo "<option selected value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
														}
														else
														{
															echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
														}
													}
													 ?>
												</select>
		                                    <div>
		                                    </div>
		                                    </td>

		                                	<?php
		                                }
		                           	$x++;
		                            }
		                        }
		                        echo '<td class="add_5"></td>';
		                        echo "</tr>";
		                    }//end if($i == 5)

		                    if($i == 6)
		                    {

		                        echo "<tr>";
		                        echo "<td>Saturday</td>";
		                        $x = 1;
		                        foreach ($lecture_detail as $lecture) {
		                            if($lecture['day'] == "Saturday")
		                            {
		                                if($lecture['start_time'] == "Break")
		                                {
		                                   echo "<td class='lec_$x'>Break</td>";
		                                }
		                                else
		                                {
		                                	$subject_name = "sub_".$i."_".$x;
		                                	$teacher_name = "teach_".$i."_".$x;
		                                	?>

		                                    <td>
		                                    <div>
		                                    	<select class='form-control subject <?php echo $subject_name; ?>' name='<?php echo $subject_name; ?>'>
		                                    		<?php 
		                                    		$batch_subject_string = $batch_detail['subject'];
											        $batch_subject = explode('/',$batch_subject_string);

											        echo '<option value="">Subject</option>';
											        foreach ($batch_subject as $subject_id) 
											        {
														$subject_detail = $this->user_model->fetchbyid($subject_id,'subject');
														
														if($lecture['subject_id'] == $subject_detail['id'])
														{
															echo '<option selected value="'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
														}
														else
														{
															echo '<option value="'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
														}
        											}
		                                    		?>
		                                    	</select>
		                                    </div>
		                                   		<select class="form-control teacher <?php echo $teacher_name; ?>" name="<?php echo $teacher_name; ?>">
													<option value="">Teacher</option>
													<?php
													foreach($teacher_detail as $teacher)
													{
														if($lecture['teacher_id'] == $teacher['id'])
														{
															echo "<option selected value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
														}
														else
														{
															echo "<option value='".$teacher['id']."'>".$teacher['name']." (".$teacher['username'].") </option>";
														}
													}
													 ?>
												</select>
		                                    <div>
		                                    </div>
		                                    </td>

		                                	<?php
		                                }
		                           	$x++;
		                            }
		                        }
		                        echo '<td class="add_6"></td>';
		                        echo "</tr>";
		                    }//end if($i == 6)

		                }//end for loop
		                ?>
					</table>

				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<textarea class="form-control" name="comment" rows="4" placeholder="Type Your Comment Here.."><?php echo $comment ?></textarea>
				</div>
			</div>
			
			<div class="row">
				<div class="col-lg-3 col-centered" style="margin-bottom:30px; margin-top:20px;">
					<input type="hidden" value="" name="lecture_type" id="lecture_type">
					<input type="hidden" name="update_btn" value="success">
					<input type="hidden" name="batch" id="batch" value="<?php echo $batch_detail['id']; ?>">
					<input type="hidden" name="course" id="course" value="<?php echo $course_detail['id']; ?>">
					<div class="submit-btn form-submit-btn">Update</div>	
				</div>
			</div>
		</div>
		<div class="col-lg-12 view-display">
			
		</div>
	</div>
	<?php echo form_close(); ?>
	</div>
</div>

</div>

<div class="test"></div>
<?php 
} 
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
	
	var lecture_break = [];
	
	count_td = 0;
	$('tr').each(function(){
		count_td = parseInt(count_td) +1;
		
	})


	z = 1;
	$("tr:nth-child(2) td").each(function(){

		if( $(this).is(":first-child") || $(this).is(':last-child') )
		{

		}
		else
		{
			if( $(this).html() == "Break" )
			{
				lecture_break.push('break_'+z);
			}
			else
			{
				lecture_break.push('lecture_'+z);
			}
			z = parseInt(z) + 1;
		}
	});



	$(".start-time").each(function() {
		var selected_class = $(this).find('option:selected').attr("class");
		for(var i = 1; i < selected_class; i++)
		{
			$(this).find('option.'+i).remove();
		}
	});

	$(".end-time").each(function() {
		var selected_class = $(this).find('option:selected').attr("class");
		for(var i = 1; i < selected_class; i++)
		{
			$(this).find('option.'+i).remove();
		}
	});


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
					 ?>'
				 +' </select> </div> </td>');
				$(".add_2").before('<td> <div><select class="form-control subject sub_2_'+row_num+'" name="sub_2_'+row_num+'" id=""> <option value="">Subject</option></select> </div> <div> <select class="form-control teacher teach_2_'+row_num+'" name="teach_2_'+row_num+'" id="">'
				 +'<option value="">Teacher</option>'
				 +'<?php
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
					 ?>'
				 +' </select> </div> </td>');
				$(".add_3").before('<td> <div><select class="form-control subject sub_3_'+row_num+'" name="sub_3_'+row_num+'" id=""> <option value="">Subject</option></select> </div> <div> <select class="form-control teacher teach_3_'+row_num+'" name="teach_3_'+row_num+'" id="">'
				 +'<option value="">Teacher</option>'
				 +'<?php
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
					 ?>'
				 +' </select> </div> </td>');
				$(".add_4").before('<td> <div><select class="form-control subject sub_4_'+row_num+'" name="sub_4_'+row_num+'" id=""> <option value="">Subject</option></select> </div> <div> <select class="form-control teacher teach_4_'+row_num+'" name="teach_4_'+row_num+'" id="">'
				 +'<option value="">Teacher</option>'
				 +'<?php
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
					 ?>'
				 +' </select> </div> </td>');
				$(".add_5").before('<td> <div><select class="form-control subject sub_5_'+row_num+'" name="sub_5_'+row_num+'" id=""> <option value="">Subject</option></select> </div> <div> <select class="form-control teacher teach_5_'+row_num+'" name="teach_5_'+row_num+'" id="">'
				 +'<option value="">Teacher</option>'
				 +'<?php
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
					 ?>'
				 +' </select> </div> </td>');
				$(".add_6").before('<td> <div><select class="form-control subject sub_6_'+row_num+'" name="sub_6_'+row_num+'" id=""> <option value="">Subject</option></select> </div> <div> <select class="form-control teacher teach_6_'+row_num+'" name="teach_6_'+row_num+'" id="">'
				 +'<option value="">Teacher</option>'
				 +'<?php
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
				$('.add').before('<td class="'+td_new_class+'" id="break" style="position:relative;"><img src="<?php echo base_url(); ?>img/close.png" class="close-td"> Break </td>');
				$(".add_1").before('<td class="'+td_new_class+'"> Break </td>');
				$(".add_2").before('<td class="'+td_new_class+'"> Break </td>');
				$(".add_3").before('<td class="'+td_new_class+'"> Break </td>');
				$(".add_4").before('<td class="'+td_new_class+'"> Break </td>');
				$(".add_5").before('<td class="'+td_new_class+'"> Break </td>');
				$(".add_6").before('<td class="'+td_new_class+'"> Break </td>');
			}

		}//end if(count_td <= 8)
		else
		{
			alert("You Can Not Add More Column !");
		}

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
		if(flag_end_time == 0 || flag_start_time == 0)
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

		if(flag_start_time == 1 && flag_end_time == 1 && flag_teacher == 1 && flag_subject == 1)
		{
			// alert("success");
			$("#lecture-form").submit();
		}
	});

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