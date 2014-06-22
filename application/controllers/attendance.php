<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Attendance extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent :: __construct();
	}

	function index()
	{
		//load user model..
	    $this->load->model('user_model');
	    $this->load->model('manage_course');

	    //get username from session..
	    $username = $this->session->userdata('username');
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
		    if($this->input->post('insert-btn'))
		    {
		    	$data['date'] = $this->input->post("date");
		    	$data['timetable_id'] = $this->input->post("timetable-id");
		    	$data['student'] = $this->input->post("select-student-id");
		    	date_default_timezone_set('Asia/Calcutta');
				$data['create_date'] = date("y-m-d H:i:s");
		    	$query = $this->user_model->insertdata($data,'attendance');
		    	if($query)
		    	{
		    		//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('insert_attendance',"success");
					header("Location: " . $_SERVER['REQUEST_URI']);
		    	}
		    }
		    else if($this->input->post('update-btn'))
		    {
		    	$id = $this->input->post("attendance_id");
		    	$data['date'] = $this->input->post("date");
		    	$data['timetable_id'] = $this->input->post("timetable-id");
		    	$data['student'] = $this->input->post("select-student-id");
		    	date_default_timezone_set('Asia/Calcutta');
				$data['modify_date'] = date("y-m-d H:i:s");
		    	$query = $this->user_model->updatedata($data,$id,'attendance');
		    	if($query)
		    	{
		    		//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('update_attendance',"success");
					header("Location: " . $_SERVER['REQUEST_URI']);
		    	}
		    }
		    else
		    {
			    //fetch userdetails from database of that user..
		        $data['organization_detail'] = $this->user_model->get_organization_details();
		        $data['user_detail'] = $this->user_model->get_user_details($username,'admin');

		        //fetch all course for display into filter section
		        $course_detail = $this->user_model->fetchalldatadesc('course');
		        $data['course_detail'] = $course_detail[0];

		        $data['title'] = "Hello ";
		        $data['page'] = "attendance";
		        $this->load->view('template',$data);
		    }
		}
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }

	}

	function insert($code = "")
	{
		//get username from session..
	    $username = $this->session->userdata('username');
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
			if($code != "")
			{
				//load user model..
			    $this->load->model('user_model');
			    $this->load->model('manage_course');

				$lecture_detail = $this->user_model->fetchlecturedetail($code);
				if($lecture_detail)
				{
					//get username from session..
				    $username = $this->session->userdata('username');

				    //fetch userdetails from database of that user..
			        $data['organization_detail'] = $this->user_model->get_organization_details();
			        $data['user_detail'] = $this->user_model->get_user_details($username,'admin');

					$data['lecture_detail'] = $lecture_detail;
					$batch_id = $lecture_detail['batch_id'];
					$student_detail = $this->user_model->fetch_student_by_batch($batch_id);
					$data['student_detail'] = $student_detail;

			        
			        $data['title'] = "Hello ";
			        $data['page'] = "attendance-insert";
			        $this->load->view('template',$data);

				}
				else
				{
					//redirect organization setting...
	    			redirect('attendance','refresh');
				}
			}
			else
			{
				//redirect organization setting...
	    		redirect('attendance','refresh');
			}
		}
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }
	}

	function check_attendance()
	{
		//get username from session..
	    $username = $this->session->userdata('username');
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
			$this->load->model('user_model');
			$timetable_id = $_POST['timetable_id'];
			$batch_id = $_POST['batch_id'];
			$date = $_POST['selected_date'];
			$query = $this->user_model->fetchattendance($date,$timetable_id);
			if($query)
			{
				$selected_student = explode(',',$query['student']);
				$student_detail = $this->user_model->fetch_student_by_batch($batch_id);
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
										<label>';
								if(in_array($student['id'], $selected_student))
								{
									echo '<input type="checkbox" checked="checked" class="checkbox student-check" value="'.$student['id'].'">
											<div class="checkbox-img"></div>';
								}
								else
								{
									echo '<input type="checkbox" id="discount-checkbox" class="checkbox student-check" value="'.$student['id'].'" >
											<div class="checkbox-img"></div>';
								}
											
								echo '</label>
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
									<label>';
								if(in_array($student['id'], $selected_student))
								{
									echo '<input type="checkbox" checked="checked" class="checkbox student-check" value="'.$student['id'].'">
											<div class="checkbox-img"></div>';
								}
								else
								{
									echo '<input type="checkbox" id="discount-checkbox" class="checkbox student-check" value="'.$student['id'].'" >
											<div class="checkbox-img"></div>';
								}
											
								echo '</label>
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
							<div class="save-btn submit-btn">Update</div>
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
				<input type="hidden" name="timetable-id" class="timetable-id" value="<?php echo $timetable_id; ?>">
				<input type="hidden" name="attendance_id" value="<?php echo $query['id']; ?>">
				<input type="hidden" name="select-student-id" class="select-student-id" value="">
				<input type="hidden" name="update-btn" value="success">
				<?php
			}
			else
			{
				$student_detail = $this->user_model->fetch_student_by_batch($batch_id);
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
					There is No any student in Selected Batch
				</div>

				<?php
				}
				?>
				<input type="hidden" name="timetable-id" class="timetable-id" value="<?php echo $timetable_id; ?>">
				<input type="hidden" name="select-student-id" class="select-student-id" value="">
				<input type="hidden" name="insert-btn" value="success">
				<?php
			}
			?>
			<script type="text/javascript">
				if( $('.checkbox').is(":checked") )
				{
					$(".checkbox:checked").next('.checkbox-img').css({
						background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 1px'
					});
				}
				if($(".student-check").length == $(".student-check:checked").length) {
		            $(".checkall .checkbox").prop('checked',true);
		            $(".checkall .checkbox").next('.checkbox-img').css({
						background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 1px'
					});
		        }
		        else
		        {
		        	$(".checkall .checkbox").prop('checked',false);
		            $(".checkall .checkbox").next('.checkbox-img').css({
						background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 1px'
					});
		        }
		        var total_student = $(".student-check").length;
		        var present_student = $(".student-check:checked").length;
		        var absent_student = parseInt(total_student) - parseInt(present_student);
				$(".p-student").text(present_student);
				$(".a-student").text(absent_student);

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
				
			</script>
        	<?php
		}
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }


		
	}
}
?>
