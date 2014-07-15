<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Extraclass extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	function index()
	{		
		//load user model..
	    $this->load->model('user_model');

	    //get username from session..
	    $username = $this->session->userdata('username');
        //then execute code.
        if(substr($username,0,5) == "admin")
        {

        }
        if(substr($username,0,5) == "staff")
        {

        }
        if(substr($username,0,5) == "stude")
        {
        	if( $this->input->post("insert_btn") != "" )
        	{
        		$user_detail = $this->user_model->get_user_details($username,'student');

        		$insert_data['subject'] = $this->input->post('subject');
        		$insert_data['topic'] = $this->input->post('topic');
        		$insert_data['teacher']= $this->input->post('teacher');
        		$insert_data['created_comment'] = $this->input->post('comment');
        		$insert_data['created_by'] = $user_detail['id'];
        		$insert_data['course'] = $user_detail['course'];
        		$insert_data['num_of_student'] = 1;
        		date_default_timezone_set('Asia/Calcutta');
				$insert_data['created_date'] = date("y-m-d H:i:s");

        		//fetch staff details from database..
        		$extra_class_code = $this->user_model->lastextraclass();
				if($extra_class_code)
				{
					$insert_data['code'] = increment_string($extra_class_code['code']);
				}
				else
				{
					$insert_data['code'] = "extra_1001";
				}

				$query = $this->user_model->insertdata($insert_data,"extra_class");

				$insert_student['class_code'] = $insert_data['code'];
				$insert_student['student_id'] = $user_detail['id'];
				$insert_student['batch'] = $user_detail['batch'];

				$query = $this->user_model->insertdata($insert_student,"extra_class_student");

				
				//execute if query is successfull executed..
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$data['view_status'] = "1";
					$this->session->set_userdata('insert_class',"success");
					header("Location: " . $_SERVER['REQUEST_URI']);
				}

        	}
        	else
        	{
	        	//fetch userdetails from database of that user..
				$data['organization_detail'] = $this->user_model->get_organization_details();
				$user_detail = $this->user_model->get_user_details($username,'student');
				$data['user_detail'] = $user_detail;

				$staff_detail = $this->user_model->fetch_teacher();
	            $data['all_teachers_detail'] = $staff_detail[0];

				$batch_id =  $user_detail['batch'];
				$batch_detail = $this->user_model->fetchbyid($batch_id,"batch");

				$pending_extra_class = $this->user_model->fetch_pending_extra_class();
				$data['pending_extra_class'] = $pending_extra_class;

				

				$running_extra_class = $this->user_model->fetch_running_extra_class();				
				$data['running_extra_class'] = $running_extra_class;

				

				$own_extra_class = $this->user_model->fetch_own_extra_class($user_detail['id']);
				$data['own_extra_class'] = $own_extra_class;

				

				$enroll_extra_class = $this->user_model->fetch_enroll_extra_class($user_detail['id']);
				$data['enroll_extra_class'] = $enroll_extra_class;


				//pass subject of those batch which is student has..
				$data['subject_string'] = $batch_detail['subject'];
				$data['page'] = "extra-class-student";
				$data['view_status'] = "1";
				$this->load->view('template',$data);
        	}
        }
        else
        {

        }
	}

	function selectsubject()
	{
		$this->load->model('user_model');
		$subject_id = $_POST['subject_id'];
		$topic_detail = $this->user_model->fetchtopic($subject_id);
		echo '<option value="">Select Topic</option>';
		foreach ($topic_detail as $topic){
			echo '<option value="'.$topic['name'].'">'.$topic['name'].'</option>';
		}
	}

	function class_search()
	{
		$this->load->model('user_model');
		//get username from session..
	    $username = $this->session->userdata('username');
		$user_detail = $this->user_model->get_user_details($username,'student');


		$batch_id =  $user_detail['batch'];
		$batch_detail = $this->user_model->fetchbyid($batch_id,"batch");
		$subject_string = $batch_detail['subject'];

		$subject = explode("/", $subject_string);
		foreach ($subject as $subject_id) {
		 	$subject_array[] = $subject_id;
		 } 
		
		$student_id = $user_detail['id'];
		$subject = $_POST['subject_id'];
		$topic = $_POST['topic'];
		$code = $_POST['code'];
		$num_of_enroll = $_POST['num_of_enroll'];

		//execute if extra class is running..
		echo '<div class="view-grid" id="running-classes">';

			$running_extra_class = $this->user_model->running_extra_class_search($subject,$topic,$code);
			//execute if there is any running extra classes..! 
			if (is_array($running_extra_class[0])) 
			{
				$p = 1;
				foreach ($running_extra_class as $extra_class) 
				{	
					//display only those extra classs those subject is matched..
					if(in_array($extra_class['subject'],$subject_array))
					{					
						$subject_detail = $this->user_model->fetchbyid($extra_class['subject'],'subject');
						$teacher_detail = $this->user_model->fetchbyid($extra_class['teacher'],'staff');
						$start_date = date("jS, F Y",strtotime($extra_class['start_date']));
						$end_date = date("jS, F Y",strtotime($extra_class['end_date']));
						$number_of_batchmates = $this->user_model->fetch_batchment($extra_class['code'],$user_detail['batch'],$user_detail['id']);
				?>
				<div class="left-blog">
					<!-- extra class code and total student section -->
					<div class="row">
						<div class="col-lg-12 top-label" style="background:#168039 !important;">
							<div class="row">
								<div class="col-lg-4 class-code" title="Extra Class Code">
									<?php echo $extra_class['code']; ?>			
								</div>

								<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
									Batchmates : <?php echo $number_of_batchmates; ?>							
								</div>
								<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
									Total Student : <?php echo $extra_class['num_of_student']; ?>									
								</div>
							</div>
						</div>
					</div>
					<!-- // end extra class code and total student section -->
					
					<!-- start bottom-label -->
					<div class="bottom-label <?php echo $p; ?>"  id="<?php echo $extra_class['id']; ?>">
						<div class="row">
							<div class="col-lg-4">
								<div class="popover-options">
									<div class="show-tooltip" data-toggle="popover" data-content="Subject Name"><?php echo $subject_detail['name']; ?></div>
								</div>
								<div class="popover-options">
									<div data-toggle="popover" data-content="Start Date" class="show-tooltip"><?php echo $start_date; ?></div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="popover-options">
									<div class="show-tooltip" data-toggle="popover" data-content="<?php echo $extra_class['topic']; ?>" title="Topic Name" style="text-align:center;"><?php echo character_limiter($extra_class['topic'],12); ?></div>
								</div>
								<div class="popover-options">
									<div data-toggle="popover" data-content="End Date" class="show-tooltip" style="text-align:center"><?php echo $end_date; ?></div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="popover-options">
									<div data-toggle="popover" data-content="Teacher Name" class="show-tooltip" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
								</div>
								<div class="popover-options">
									<div data-toggle="popover" data-content="Timing" class="show-tooltip" style="text-align:center"><?php echo $extra_class['timing']; ?></div>
								</div>
							</div>
						</div>
					</div>
					<!-- // end bottom-label -->

				</div>
				<?php			
				$p++;	
					}//end if condition..
				}//end foreach loop
			}//end if condition
			else{

				// error message when there is no any organizaion location
				echo '<div class="row">
					<div class="col-lg-12 alert-msg">
						Search Result Not Found..!
					</div>
				</div>';
				// end error message when there is no any organizaion location
			}
		echo '</div><!-- end view-grid running-classes -->';
		
		//end if extra class is running..

		//execute if extra class is pending...
		echo '<div class="view-grid" id="pending-classes">';

			$pending_extra_class = $this->user_model->pending_extra_class_search($subject,$topic,$code);

			//execute if there is any extra classes created by login user..! 
			if (is_array($pending_extra_class[0])) 
			{
				$q = 1;
				foreach ($pending_extra_class as $pending_class) 
				{	
					//display only those extra classs those subject is matched..
					if(in_array($pending_class['subject'],$subject_array))
					{					
						$subject_detail = $this->user_model->fetchbyid($pending_class['subject'],'subject');
						$teacher_detail = $this->user_model->fetchbyid($pending_class['teacher'],'staff');
						$start_date = date("jS, F Y",strtotime($pending_class['start_date']));
						$end_date = date("jS, F Y",strtotime($pending_class['end_date']));
						$number_of_batchmates = $this->user_model->fetch_batchment($pending_class['code'],$user_detail['batch'],$user_detail['id']);
						?>
						<div class="left-blog">
							<!-- extra class code and total student section -->
							<div class="row">
								<div class="col-lg-12 top-label" style="background:#F04E41 !important;">
									<div class="row">
										<div class="col-lg-4 class-code" title="Extra Class Code">
											<?php echo $pending_class['code']; ?>										
										</div>

										<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
											Batchmates : <?php echo $number_of_batchmates; ?>							
										</div>
										<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
											Total Student : <?php echo $pending_class['num_of_student']; ?>									
										</div>
									</div>
								</div>
							</div>
							<!-- // end extra class code and total student section -->
							
							<!-- start bottom-label -->
							<div class="bottom-label <?php echo $q; ?>" id="<?php echo $pending_class['id']; ?>">
								<div class="row">
									<div class="col-lg-4">
										<div class="popover-options">
											<div class="show-tooltip"  data-container="body" data-toggle="popover" data-content="Subject Name">
										         <?php echo $subject_detail['name']; ?>
										     </div>
									     </div>
									</div>
									<div class="col-lg-4">
										<div class="popover-options">
										<div class="show-tooltip" title="Topic Name" data-toggle="popover" data-content="<?php echo $pending_class['topic']; ?>" style="text-align:center;"><?php echo character_limiter($pending_class['topic'],12); ?></div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="popover-options">
										<div class="show-tooltip" data-toggle="popover" data-content="Teacher Name" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
										</div>
									</div>
								</div>
							</div>
							<!-- // end bottom-label -->

						</div>
					<?php	
					$q++;			 
					}// end if condition 
				}//end foreach loop
			}//end if condition
			else{

				// error message when there is no any organizaion location
				echo '<div class="row">
					<div class="col-lg-12 alert-msg">
						Search Result Not Found..!
					</div>
				</div>';
				// end error message when there is no any organizaion location
			}
		echo '</div>';
		
		// end pending status..

		//execute if extra class is created by own...
		echo '<div class="view-grid" id="own-classes">';

			$own_extra_class = $this->user_model->own_extra_class_search($subject,$topic,$code,$student_id);

			//execute if there is any running extra classes..! 
			if (is_array($own_extra_class[0])) 
			{
				$a = 1;
				foreach ($own_extra_class as $own_class) 
				{	
					//display only those extra classs those subject is matched..
					if(in_array($own_class['subject'],$subject_array))
					{					
						$subject_detail = $this->user_model->fetchbyid($own_class['subject'],'subject');
						$teacher_detail = $this->user_model->fetchbyid($own_class['teacher'],'staff');
						$start_date = date("jS, F Y",strtotime($own_class['start_date']));
						$end_date = date("jS, F Y",strtotime($own_class['end_date']));
						$number_of_batchmates = $this->user_model->fetch_batchment($own_class['code'],$user_detail['batch'],$user_detail['id']);
						//execute if extra class status is running..
						if($own_class['allow'] == "1")
						{
						?>
							<div class="left-blog">
								<!-- extra class code and total student section -->
								<div class="row">
									<div class="col-lg-12 top-label" style="background:#168039 !important;">
										<div class="row">
											<div class="col-lg-4 class-code" title="Extra Class Code">
												<?php echo $own_class['code']; ?>										
											</div>

											<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
												Batchmates : <?php echo $number_of_batchmates; ?>							
											</div>
											<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
												Total Student : <?php echo $own_class['num_of_student']; ?>									
											</div>
										</div>
									</div>
								</div>
								<!-- // end extra class code and total student section -->
								
								<!-- start bottom-label -->
								<div class="bottom-label <?php echo $a; ?>" id="<?php echo $own_class['id']; ?>">
									<div class="row">
										<div class="col-lg-4">
											<div class="popover-options">
												<div class="show-tooltip" data-toggle="popover" data-content="Subject Name"><?php echo $subject_detail['name']; ?></div>
											</div>
											<div class="popover-options">
												<div data-toggle="popover" data-content="Start Date" class="show-tooltip"><?php echo $start_date; ?></div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="popover-options">
												<div class="show-tooltip" data-toggle="popover" data-content="<?php echo $own_class['topic']; ?>" title="Topic Name" style="text-align:center;"><?php echo character_limiter($own_class['topic'],12); ?></div>
											</div>
											<div class="popover-options">
												<div data-toggle="popover" data-content="End Date" class="show-tooltip" style="text-align:center;"><?php echo $end_date; ?></div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="popover-options">
												<div data-toggle="popover" data-content="Teacher Name" class="show-tooltip" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
											</div>
											<div class="popover-options">
												<div data-toggle="popover" data-content="Timing" class="show-tooltip" style="text-align:center"><?php echo $own_class['timing']; ?></div>
											</div>
										</div>
									</div>
								</div>
								<!-- // end bottom-label -->

							</div>
						<?php
						}//end if condition if($own_class['allow'] == "1")
						//execute if extra class status is pending..
						else
						{
						?>
							<div class="left-blog">
								<!-- extra class code and total student section -->
								<div class="row">
									<div class="col-lg-12 top-label" style="background:#F04E41 !important;">
										<div class="row">
											<div class="col-lg-4 class-code" title="Extra Class Code">
												<?php echo $own_class['code']; ?>										
											</div>

											<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
												Batchmates : <?php echo $number_of_batchmates; ?>							
											</div>
											<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
												Total Student : <?php echo $own_class['num_of_student']; ?>									
											</div>
										</div>
									</div>
								</div>
								<!-- // end extra class code and total student section -->
								
								<!-- start bottom-label -->
								<div class="bottom-label <?php echo $a; ?>" id="<?php echo $own_class['id']; ?>">
									<div class="row">
										<div class="col-lg-4">
											<div class="popover-options">
												<div class="show-tooltip"  data-container="body" data-toggle="popover" data-content="Subject Name">
											         <?php echo $subject_detail['name']; ?>
											     </div>
										     </div>
										</div>
										<div class="col-lg-4">
											<div class="popover-options">
											<div class="show-tooltip" title="Topic Name" data-toggle="popover" data-content="<?php echo $own_class['topic']; ?>" style="text-align:center;"><?php echo character_limiter($own_class['topic'],12); ?></div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="popover-options">
											<div class="show-tooltip" data-toggle="popover" data-content="Teacher Name" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
											</div>
										</div>
									</div>
								</div>
								<!-- // end bottom-label -->

							</div>
						<?php
						}//end else condition..	
					$a++;
					}//end if condition..			 
				}//end foreach loop
			}//end if condition
			else{

				// error message when there is no any organizaion location
				echo '<div class="row">
					<div class="col-lg-12 alert-msg">
						Search Result Not Found..!
					</div>
				</div>';
				// end error message when there is no any organizaion location
			}
		echo '</div>';
		
		//end created by own section..

		// enrolled class section..
		echo '<div class="view-grid" id="enroll-classes">';

			$enroll_extra_class = $this->user_model->enroll_extra_class_search($subject,$topic,$code,$student_id);
			// print_r($enroll_extra_class);
			//execute if there is any extra classes enrolled by login user..! 
			if (is_array($enroll_extra_class[0])) 
			{
				$x = 1;
				foreach ($enroll_extra_class as $enroll_class) 
				{
					$enroll_class_code = $enroll_class['class_code'];
					$enroll_class_detail = $this->user_model->fetchbyfield('code',$enroll_class_code,'extra_class');
					
					//display only those extra classs those subject is matched..
					if(in_array($enroll_class_detail['subject'],$subject_array))
					{
					
						$subject_detail = $this->user_model->fetchbyid($enroll_class_detail['subject'],'subject');
						$teacher_detail = $this->user_model->fetchbyid($enroll_class_detail['teacher'],'staff');
						$start_date = date("jS, F Y",strtotime($enroll_class_detail['start_date']));
						$end_date = date("jS, F Y",strtotime($enroll_class_detail['end_date']));
						$number_of_batchmates = $this->user_model->fetch_batchment($enroll_class_detail['code'],$user_detail['batch'],$user_detail['id']);

						//execute if extra class status is running..
						if($enroll_class_detail['allow'] == "1")
						{
						?>
						<div class="left-blog">
							<!-- extra class code and total student section -->
							<div class="row">
								<div class="col-lg-12 top-label" style="background:#168039 !important;">
									<div class="row">
										<div class="col-lg-4 class-code" title="Extra Class Code">
											<?php echo $enroll_class_detail['code']; ?>										
										</div>

										<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
											Batchmates : <?php echo $number_of_batchmates; ?>								
										</div>
										<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
											Total Student : <?php echo $enroll_class_detail['num_of_student']; ?>									
										</div>
									</div>
								</div>
							</div>
							<!-- // end extra class code and total student section -->
							
							<!-- start bottom-label -->
							<div class="bottom-label <?php echo $x; ?>" id="<?php echo $enroll_class_detail['id']; ?>">
								<div class="row">
									<div class="col-lg-4">
										<div class="popover-options">
											<div class="show-tooltip" data-toggle="popover" data-content="Subject Name"><?php echo $subject_detail['name']; ?></div>
										</div>
										<div class="popover-options">
											<div data-toggle="popover" data-content="Start Date" class="show-tooltip"><?php echo $start_date; ?></div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="popover-options">
											<div class="show-tooltip" data-toggle="popover" data-content="<?php echo $enroll_class_detail['topic']; ?>" title="Topic Name" style="text-align:center;"><?php echo character_limiter($enroll_class_detail['topic'],12); ?></div>
										</div>
										<div class="popover-options">
											<div data-toggle="popover" data-content="End Date" class="show-tooltip" style="text-align:center;"><?php echo $end_date; ?></div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="popover-options">
											<div data-toggle="popover" data-content="Teacher Name" class="show-tooltip" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
										</div>
										<div class="popover-options">
											<div data-toggle="popover" data-content="Timing" class="show-tooltip" style="text-align:center"><?php echo $enroll_class_detail['timing']; ?></div>
										</div>
									</div>
								</div>
							</div>
							<!-- // end bottom-label -->

						</div>
						<?php
						}//end if condition if($own_class['allow'] == "1")
						//execute if extra class status is pending..
						else
						{
						?>
						<div class="left-blog">
							<!-- extra class code and total student section -->
							<div class="row">
								<div class="col-lg-12 top-label" style="background:#F04E41 !important;">
									<div class="row">
										<div class="col-lg-4 class-code" title="Extra Class Code">
											<?php echo $enroll_class_detail['code']; ?>										
										</div>

										<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
											Batchmates : <?php echo $number_of_batchmates; ?>								
										</div>
										<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
											Total Student : <?php echo $enroll_class_detail['num_of_student']; ?>									
										</div>
									</div>
								</div>
							</div>
							<!-- // end extra class code and total student section -->
							
							<!-- start bottom-label -->
							<div class="bottom-label <?php echo $x; ?>" id="<?php echo $enroll_class_detail['id']; ?>">
								<div class="row">
									<div class="col-lg-4">
										<div class="popover-options">
											<div class="show-tooltip"  data-container="body" data-toggle="popover" data-content="Subject Name">
										         <?php echo $subject_detail['name']; ?>
										     </div>
									     </div>
									</div>
									<div class="col-lg-4">
										<div class="popover-options">
										<div class="show-tooltip" title="Topic Name" data-toggle="popover" data-content="<?php echo $enroll_class_detail['topic']; ?>" style="text-align:center;"><?php echo character_limiter($enroll_class_detail['topic'],12); ?></div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="popover-options">
										<div class="show-tooltip" data-toggle="popover" data-content="Teacher Name" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
										</div>
									</div>
								</div>
							</div>
							<!-- // end bottom-label -->

						</div>
						<?php
						}//end else condition..
					$x++;
					}//end if condition..
				}//end foreach loop3

			}//end if condition
			else
			{
				// error message when there is no any organizaion location
				echo '<div class="row">
					<div class="col-lg-12 alert-msg">
						Search Result Not Found..!
					</div>
				</div>';
				// end error message when there is no any organizaion location
			}

		echo '</div>';
		echo '<div class="hidden number_of_enroll">'.$num_of_enroll.'</div>';
		//end enrolled class section..	

	?>
	<script type="text/javascript">
	 // $('.popover-options a').popover('show');
	$(".popover-options div").popover({
		html : true,
		trigger : 'hover',
		placement : 'top'
	});
	</script>
	<?php
	}

	function class_view()
	{
		$this->load->model('user_model');
		//get username from session..
	    $username = $this->session->userdata('username');
		$user_detail = $this->user_model->get_user_details($username,'student');

		$id = $_POST['class_id'];
		$class_detail = $this->user_model->fetchbyid($id,"extra_class");
		$subject_detail = $this->user_model->fetchbyid($class_detail['subject'],'subject');
		$teacher_detail = $this->user_model->fetchbyid($class_detail['teacher'],'staff');
		$created_detail = $this->user_model->fetchbyid($class_detail['created_by'],'student');
		$number_of_batchmates = $this->user_model->fetch_batchment($class_detail['code'],$user_detail['batch'],$user_detail['id']);
		$check_enroll = $this->user_model->check_enroll($class_detail['code'],$user_detail['id']);//check_enroll(class_code,$student_id);


	?>
		<div class="row">
			<div class="col-lg-4 label-heading">Extra Class Code :</div>
			<div class="col-lg-8"><?php echo $class_detail['code'] ?></div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Status :</div>
			<div class="col-lg-8">
				<?php
				if($class_detail['allow'] == "1")
				{
					echo "Running";
				}
				else
				{
					echo "Pending";
				}
				?>
			</div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Subject :</div>
			<div class="col-lg-8"><?php echo $subject_detail['name']; ?></div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Topic :</div>
			<div class="col-lg-8"><?php echo $class_detail['topic']; ?></div>
		</div>
		<?php
		//execute if class is running..
		if($class_detail['allow'] == "1")
		{
		?>
		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Assign Teacher :</div>
			<div class="col-lg-8"><?php echo $teacher_detail['name']; ?></div>
		</div>
		<?php 
		}
		else
		{
		?>
		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Prefered Teacher :</div>
			<div class="col-lg-8"><?php echo $teacher_detail['name']; ?></div>
		</div>
		<?php 
		}
		?>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Created By :</div>
			<div class="col-lg-8"><?php echo $created_detail['name']; ?></div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">No of Students :</div>
			<div class="col-lg-8 num_of_stu"><?php echo $class_detail['num_of_student']; ?></div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">No of Batchmates :</div>
			<div class="col-lg-8 num_of_batchmate"><?php echo $number_of_batchmates; ?></div>
		</div>

		<?php
		//execute if class is running..
		if($class_detail['allow'] == "1")
		{
		?>
		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Start Date :</div>
			<div class="col-lg-8"><?php echo date("jS, F Y",strtotime($class_detail['start_date'])); ?></div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">End Date By :</div>
			<div class="col-lg-8"><?php echo date("jS, F Y",strtotime($class_detail['end_date'])); ?></div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Timming :</div>
			<div class="col-lg-8"><?php echo $class_detail['timing'];?></div>
		</div>
		<?php
		}
		?>
		
		<div class="status-hiddden hidden"><?php echo $class_detail['allow']; ?></div>
		<div class="enroll-hiddden hidden"><?php echo $check_enroll; ?></div>
	<?php
	}

	function add_enroll()
	{
		$this->load->model('user_model');
		//get username from session..
	    $username = $this->session->userdata('username');
		$user_detail = $this->user_model->get_user_details($username,'student');

		$batch_id =  $user_detail['batch'];
		$batch_detail = $this->user_model->fetchbyid($batch_id,"batch");
		$subject_string = $batch_detail['subject'];

		$subject = explode("/", $subject_string);
		foreach ($subject as $subject_id) {
		 	$subject_array[] = $subject_id;
		 } 
		
		$student_id = $user_detail['id'];
		$subject = $_POST['subject_id'];
		$topic = $_POST['topic'];
		$code = $_POST['code'];
		$id = $_POST['id'];

		$class_detail = $this->user_model->fetchbyid($id,"extra_class");
		$insert_data['class_code'] = $class_detail['code'];
		$insert_data['student_id'] = $user_detail['id']; 
		$insert_data['batch'] = $user_detail['batch']; 
		$query = $this->user_model->insertdata($insert_data,"extra_class_student");

		$number_of_total_student = $this->user_model->number_of_total_student($class_detail['code']);
		$update_data['num_of_student'] = $number_of_total_student;
		$query = $this->user_model->updatedata($update_data,$id,'extra_class');

		$enroll_extra_class = $this->user_model->enroll_extra_class_search($subject,$topic,$code,$student_id);
		//execute if there is any extra classes enrolled by login user..! 
		if (is_array($enroll_extra_class[0])) 
		{
			$x = 1;
			foreach ($enroll_extra_class as $enroll_class) 
			{
				$enroll_class_code = $enroll_class['class_code'];
				$enroll_class_detail = $this->user_model->fetchbyfield('code',$enroll_class_code,'extra_class');
				
				//display only those extra classs those subject is matched..
				if(in_array($enroll_class_detail['subject'],$subject_array))
				{
				
					$subject_detail = $this->user_model->fetchbyid($enroll_class_detail['subject'],'subject');
					$teacher_detail = $this->user_model->fetchbyid($enroll_class_detail['teacher'],'staff');
					$start_date = date("jS, F Y",strtotime($enroll_class_detail['start_date']));
					$end_date = date("jS, F Y",strtotime($enroll_class_detail['end_date']));
					$number_of_batchmates = $this->user_model->fetch_batchment($enroll_class_detail['code'],$user_detail['batch'],$user_detail['id']);

					//execute if extra class status is running..
					if($enroll_class_detail['allow'] == "1")
					{
					?>
					<div class="left-blog">
						<!-- extra class code and total student section -->
						<div class="row">
							<div class="col-lg-12 top-label" style="background:#168039 !important;">
								<div class="row">
									<div class="col-lg-4 class-code" title="Extra Class Code">
										<?php echo $enroll_class_detail['code']; ?>										
									</div>

									<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
										Batchmates : <?php echo $number_of_batchmates; ?>								
									</div>
									<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
										Total Student : <?php echo $enroll_class_detail['num_of_student']; ?>									
									</div>
								</div>
							</div>
						</div>
						<!-- // end extra class code and total student section -->
						
						<!-- start bottom-label -->
						<div class="bottom-label <?php echo $x; ?>" id="<?php echo $enroll_class_detail['id']; ?>">
							<div class="row">
								<div class="col-lg-4">
									<div class="popover-options">
										<div class="show-tooltip" data-toggle="popover" data-content="Subject Name"><?php echo $subject_detail['name']; ?></div>
									</div>
									<div class="popover-options">
										<div data-toggle="popover" data-content="Start Date" class="show-tooltip"><?php echo $start_date; ?></div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="popover-options">
										<div class="show-tooltip" data-toggle="popover" data-content="<?php echo $enroll_class_detail['topic']; ?>" title="Topic Name" style="text-align:center;"><?php echo character_limiter($enroll_class_detail['topic'],12); ?></div>
									</div>
									<div class="popover-options">
										<div data-toggle="popover" data-content="End Date" class="show-tooltip" style="text-align:center;"><?php echo $end_date; ?></div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="popover-options">
										<div data-toggle="popover" data-content="Teacher Name" class="show-tooltip" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
									</div>
									<div class="popover-options">
										<div data-toggle="popover" data-content="Timing" class="show-tooltip" style="text-align:center"><?php echo $enroll_class_detail['timing']; ?></div>
									</div>
								</div>
							</div>
						</div>
						<!-- // end bottom-label -->

					</div>
					<?php
					}//end if condition if($own_class['allow'] == "1")
					//execute if extra class status is pending..
					else
					{
					?>
					<div class="left-blog">
						<!-- extra class code and total student section -->
						<div class="row">
							<div class="col-lg-12 top-label" style="background:#F04E41 !important;">
								<div class="row">
									<div class="col-lg-4 class-code" title="Extra Class Code">
										<?php echo $enroll_class_detail['code']; ?>										
									</div>

									<div class="col-lg-4" title="Number of Batchmates" style="text-align:center;">
										Batchmates : <?php echo $number_of_batchmates; ?>								
									</div>
									<div class="col-lg-4 no-of-student" title="Number of total Enrolled Student">
										Total Student : <?php echo $enroll_class_detail['num_of_student']; ?>									
									</div>
								</div>
							</div>
						</div>
						<!-- // end extra class code and total student section -->
						
						<!-- start bottom-label -->
						<div class="bottom-label <?php echo $x; ?>" id="<?php echo $enroll_class_detail['id']; ?>">
							<div class="row">
								<div class="col-lg-4">
									<div class="popover-options">
										<div class="show-tooltip"  data-container="body" data-toggle="popover" data-content="Subject Name">
									         <?php echo $subject_detail['name']; ?>
									     </div>
								     </div>
								</div>
								<div class="col-lg-4">
									<div class="popover-options">
									<div class="show-tooltip" title="Topic Name" data-toggle="popover" data-content="<?php echo $enroll_class_detail['topic']; ?>" style="text-align:center;"><?php echo character_limiter($enroll_class_detail['topic'],12); ?></div>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="popover-options">
									<div class="show-tooltip" data-toggle="popover" data-content="Teacher Name" style="text-align:center"><?php echo $teacher_detail['name']; ?></div>
									</div>
								</div>
							</div>
						</div>
						<!-- // end bottom-label -->

					</div>
					<?php
					}//end else condition..
				$x++;
				}//end if condition..
			}//end foreach loop3

		}//end if condition
		else
		{
			// error message when there is no any organizaion location
			echo '<div class="row">
				<div class="col-lg-12 alert-msg">
					Search Result Not Found..!
				</div>
			</div>';
			// end error message when there is no any organizaion location
		}



	}

	function remove_enroll()
	{
		$this->load->model('user_model');
		//get username from session..
	    $username = $this->session->userdata('username');
		$user_detail = $this->user_model->get_user_details($username,'student');

		$id = $_POST['id'];

		$class_detail = $this->user_model->fetchbyid($id,"extra_class");
		$class_code = $class_detail['code'];
		$student_id = $user_detail['id']; 
		$query = $this->user_model->remove_enroll($student_id,$class_code);
		$number_of_total_student = $this->user_model->number_of_total_student($class_code);
		$insert_data['num_of_student'] = $number_of_total_student;
		$query = $this->user_model->updatedata($insert_data,$id,'extra_class');
	}


	//execute function when new class is added and select subject and topic
	//then this function returns exist classes in table form..
	function exist_class()
	{
		$this->load->model('user_model');
		//get username from session..
	    $username = $this->session->userdata('username');
		$user_detail = $this->user_model->get_user_details($username,'student');

		$subject = $_POST['subject'];
		$topic = $_POST['topic'];

		$exist_class = $this->user_model->exist_class_pending_running($subject,$topic);
		//execute if there is any running extra classes..! 
		if (is_array($exist_class[0])) 
		{
			?>
			<div class="row" style="margin-top:15px;">
				<div class="col-lg-6 label-text">Already Existing Class</div>
				<div class="col-lg-6 view-full-detail" data-toggle="modal" data-target=".already-exist-modal">View Full Detail</div>
			</div>
			<div style="margin-top:10px;">
				<table class="exist-class">
					<thead>
						<tr>
							<td>S.No</td>
							<td></td>
							<td>Class</td>
							<td title="Enrolled Student">Student</td>
							<td>Operation</td>
						</tr>
					</thead>
					<tbody>
						<?php
						$a = 1;
						foreach ($exist_class as $e_class) 
						{
							$check_enroll = $this->user_model->check_enroll($e_class['code'],$user_detail['id']);//check_enroll(class_code,$student_id);
						?>
						<tr>
							<td><?php echo $a; ?></td>
							<td><span class="<?php echo ($e_class['allow'] == "1") ? "running" : "pending" ?>"></span></td>
							<td data-toggle="modal" data-target=".view-class-modal" style="cursor:pointer;" class="modal-view-class"><?php echo $e_class['code'] ?></td>
							<td><?php echo $e_class['num_of_student']; ?></td>
							<td><?php echo ($check_enroll) ? '<span class="enrolled en_btn">Enrolled</span>' : '<span class="enroll en_btn">Enroll</span>';  ?></td>
							<td class="hidden"><?php echo $check_enroll; ?></td>
							<td class="hidden"><?php echo $e_class['id']; ?></td>
						</tr>
						<?php 
						$a++;
						}
						?>
						</tbody>
					</table>
				</div>
				<div class="pending-running">
					<span></span> Pending
					<span></span> Running
				</div>
				
		<?php
		}
	}

	function exist_class_modal()
	{
		$this->load->model('user_model');
		//get username from session..
	    $username = $this->session->userdata('username');
		$user_detail = $this->user_model->get_user_details($username,'student');

		$subject = $_POST['subject'];
		$topic = $_POST['topic'];

		$exist_class = $this->user_model->exist_class_pending_running($subject,$topic);
		$subject_detail = $this->user_model->fetchbyid($subject,"subject");
		if (is_array($exist_class[0])) 
		{
			?>

			<div class="row">
				<div class="col-lg-6 subject">
					<span>Subject: </span>
					<span><?php echo $subject_detail['name']; ?></span>
				</div>
				<div class="col-lg-6 topic">
					<span>Topic: </span>
					<span><?php echo $topic; ?></span>
				</div>
			</div>
			<table>
				<thead>
				<tr>
					<td>S.No</td>
					<td></td>
					<td>Class</td>
					<td title="Enrolled Student">Student</td>
					<td>Batchmates</td>
					<td>Teacher</td>
					<td>Start Date</td>
					<td>End Date</td>
					<td>Timming</td>
					<td>Operation</td>
				</tr>
			</thead>
			<tbody>
				<?php
				$a = 1;
				foreach ($exist_class as $e_class) 
				{
					$teacher_detail = $this->user_model->fetchbyid($e_class['teacher'],'staff');
					$check_enroll = $this->user_model->check_enroll($e_class['code'],$user_detail['id']);//check_enroll(class_code,$student_id);
					$start_date = date("jS, F Y",strtotime($e_class['start_date']));
					$end_date = date("jS, F Y",strtotime($e_class['end_date']));
					$timing = $e_class['timing'];

					$number_of_batchmates = $this->user_model->fetch_batchment($e_class['code'],$user_detail['batch'],$user_detail['id']);
				?>
				<tr>
					<td><?php echo $a; ?></td>
					<td><span class="<?php echo ($e_class['allow'] == "1") ? "running" : "pending" ?>"></span></td>
					<td><?php echo $e_class['code']; ?></td>
					<td><?php echo $e_class['num_of_student']; ?></td>
					<td><?php echo $number_of_batchmates; ?></td>
					<?php
					if($e_class['allow'] == "1")
					{
						?>
					<td><?php echo $teacher_detail['name']." (Assign)"; ?></td>
					<td><?php echo $start_date; ?></td>
					<td><?php echo $end_date; ?></td>
					<td><?php echo $timing; ?></td>
						<?php
					}
					else
					{
						?>
						<td><?php echo $teacher_detail['name']." (Prefer)"; ?></td>
						<td>--</td>
						<td>--</td>
						<td>--</td>
						<?php
					}
					?>
					<td><?php echo ($check_enroll) ? '<span class="enrolled e_btn">Enrolled</span>' : '<span class="enroll e_btn">Enroll</span>';  ?></td>
					<td class="hidden"><?php echo $check_enroll; ?></td>
					<td class="hidden"><?php echo $e_class['id']; ?></td>
				</tr>
				<?php 
				$a++;
				}
				?>
			</tbody>
			</table>
			<div class="pending-running">
				<span></span> Pending
				<span></span> Running
			</div>
		<?php
		}
	}

	function class_view_modal()
	{
		$this->load->model('user_model');
		//get username from session..
	    $username = $this->session->userdata('username');
		$user_detail = $this->user_model->get_user_details($username,'student');

		$id = $_POST['class_id'];
		$class_detail = $this->user_model->fetchbyid($id,"extra_class");
		$subject_detail = $this->user_model->fetchbyid($class_detail['subject'],'subject');
		$teacher_detail = $this->user_model->fetchbyid($class_detail['teacher'],'staff');
		$created_detail = $this->user_model->fetchbyid($class_detail['created_by'],'student');
		$number_of_batchmates = $this->user_model->fetch_batchment($class_detail['code'],$user_detail['batch'],$user_detail['id']);
		$check_enroll = $this->user_model->check_enroll($class_detail['code'],$user_detail['id']);//check_enroll(class_code,$student_id);


	?>
		<div class="row">
			<div class="col-lg-4 label-heading">Extra Class Code :</div>
			<div class="col-lg-8"><?php echo $class_detail['code'] ?></div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Status :</div>
			<div class="col-lg-8">
				<?php
				if($class_detail['allow'] == "1")
				{
					echo "Running";
				}
				else
				{
					echo "Pending";
				}
				?>
			</div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Subject :</div>
			<div class="col-lg-8"><?php echo $subject_detail['name']; ?></div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Topic :</div>
			<div class="col-lg-8"><?php echo $class_detail['topic']; ?></div>
		</div>
		<?php
		//execute if class is running..
		if($class_detail['allow'] == "1")
		{
		?>
		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Assign Teacher :</div>
			<div class="col-lg-8"><?php echo $teacher_detail['name']; ?></div>
		</div>
		<?php 
		}
		else
		{
		?>
		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Prefered Teacher :</div>
			<div class="col-lg-8"><?php echo $teacher_detail['name']; ?></div>
		</div>
		<?php 
		}
		?>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Created By :</div>
			<div class="col-lg-8"><?php echo $created_detail['name']; ?></div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">No of Students :</div>
			<div class="col-lg-8 num_of_stu"><?php echo $class_detail['num_of_student']; ?></div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">No of Batchmates :</div>
			<div class="col-lg-8 num_of_batchmate"><?php echo $number_of_batchmates; ?></div>
		</div>

		<?php
		//execute if class is running..
		if($class_detail['allow'] == "1")
		{
		?>
		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Start Date :</div>
			<div class="col-lg-8"><?php echo date("jS, F Y",strtotime($class_detail['start_date'])); ?></div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">End Date By :</div>
			<div class="col-lg-8"><?php echo date("jS, F Y",strtotime($class_detail['end_date'])); ?></div>
		</div>

		<div class="row" style="margin-top:10px;">
			<div class="col-lg-4 label-heading">Timming :</div>
			<div class="col-lg-8"><?php echo $class_detail['timing'];?></div>
		</div>
		<?php
		}
		?>
		
		<div class="status-hiddden hidden"><?php echo $class_detail['allow']; ?></div>
		<div class="enroll-hiddden hidden"><?php echo $check_enroll; ?></div>
	<?php
	}

}
?>