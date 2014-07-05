<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->load->model('user_model');
		//get username from session..
		$username = $this->session->userdata('username');
		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			//redirect organization setting...
			redirect('user/staff','refresh');
		}
		elseif(substr($username,0,5) == "staff")
		{

		}
		elseif(substr($username,0,5) == "stude")
		{
			//fetch organization details from database..
			$data['organization_detail'] = $this->user_model->fetchbyid('1','organization');


			//fetch userdetails from database of login user..
			//this is for display which user is logged in..
			$user_detail = $this->user_model->fetchbyfield('username',$username,'student');
			$data['user_detail'] = $user_detail;

			//fetch student course and batch..
			$course_id = $user_detail['course'];
			$batch_id = $user_detail['batch'];
			
			if($course_id != "")
			{
				$course_id = $user_detail['course'];
				$course_detail =  $this->user_model->fetch_course_name($course_id);
				$data['course_name'] = $course_detail['name'];
			}

			if($batch_id != "")
			{
				$batch_id = $user_detail['batch'];
				$batch_detail = $this->user_model->fetch_batch_name($batch_id);
				$data['batch_name'] = $batch_detail['name'];

			}


			//fetch staff details from database..
			$student_detail = $this->user_model->fetch_student_deatil_with_course_batch($course_id,$batch_id);
			$data['student_detail'] = $student_detail[0];
			$data['no_of_student'] = $student_detail[1];

			$data['page'] = "student-stu";
			$this->load->view('template',$data);
		}
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}

	}

	
	//**********************************
	// Start Staff Management
	//**********************************
	//
	//function for add update staff details..
	function staff()
	{
		$this->load->model('user_model');

		//get username from session..
		$username = $this->session->userdata('username');

		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			if( $this->input->post('insert_btn') )
			{
				$code = $this->user_model->generateRandomString(6);
				//check if any file is selected..
				if( !empty($_FILES['image']['name']) )
				{
					//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
					$config['upload_path'] = './uploads/staff/';

					//set logo default name..
					$config['file_name'] = $code;

					// set the filter image types
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					
					//load the upload library
					$this->load->library('upload', $config);

			   		$this->upload->set_allowed_types('*');
			    
					$this->upload->initialize($config);

					//if not successful, set the error message
					if ($this->upload->do_upload('image')) 
					{
						$logo_data = $this->upload->data();
					}

					// *** 1) Initialise / load image
				    $resizeObj = new resize("./uploads/staff/".$logo_data['file_name']);

				    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				    $resizeObj -> resizeImage(115,135, 'exact');

				    // *** 3) Save image
				    $resizeObj -> saveImage("./uploads/staff/".$logo_data['file_name'], 1000);

					$insert_data['image'] = $logo_data['file_name'];
				}
				//if there is no any file selected..
				else
				{
					$insert_data['image'] = "default.png";
				}

				$username = $this->input->post('username');

				$insert_data['name'] = $this->input->post('name');
				$insert_data['username'] = $this->input->post('username');
				$insert_data['password'] = md5('123');
				$insert_data['email'] = implode(',',$this->input->post('email'));
				$insert_data['phone'] = implode(',',$this->input->post('phone'));
				$insert_data['gender'] = $this->input->post('gender');
				$insert_data['dob'] = str_replace("/", "-", $this->input->post('dob')) ;
				$insert_data['country'] = $this->input->post('country');
				$insert_data['state'] = $this->input->post('state');
				$insert_data['city'] = $this->input->post('city');
				$insert_data['c_address'] = $this->input->post('current_address');
				$insert_data['p_address'] = $this->input->post('permanent_address');
				$insert_data['doj'] = str_replace("/", "-", $this->input->post('doj'));
				$insert_data['staff_type'] = $this->input->post('staff_type');
				$insert_data['emp_type'] = $this->input->post('emp_type');
				$insert_data['marital_status'] = $this->input->post('marital_status');
				$insert_data['parent_relation'] = $this->input->post('relationship');
				$insert_data['parent_name'] = $this->input->post('parent_name');
				$insert_data['parent_email'] = $this->input->post('parent_email');
				$insert_data['parent_phone'] = $this->input->post('parent_phone');
				$insert_data['code'] = $this->user_model->generateRandomString(6);

				date_default_timezone_set('Asia/Calcutta');
				$insert_data['create_date'] = date("y-m-d H:i:s");
				
				// script for insert staff data into database..
				$query = $this->user_model->insert_staff_details($insert_data);


		        for($i = 1; $i <= 7; $i++)
		        {
		        	$insert_tt['days'] = $i;
		            $this->user_model->insertdata($insert_tt,$table_name);
		        }

				//execute if query is successfull executed..
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('insert_staff',"success");
					header("Location: " . $_SERVER['REQUEST_URI']);
				}
			}
			else if( $this->input->post('update_btn') )
			{
				$code = $this->user_model->generateRandomString(6);
				//if image is not empty
				if($this->input->post('default_image') != "")
				{
					//if image does not changed..
					if( $this->input->post('default_image') == "default")
					{
						$insert_data['image'] = $this->input->post('old_image');
					}
					//if image changed..
					else
					{
						//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
						$config['upload_path'] = './uploads/staff/';

						//set logo default name..
						$config['file_name'] = $code;

						// set the filter image types
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						
						//load the upload library
						$this->load->library('upload', $config);

				   		$this->upload->set_allowed_types('*');
				    
						$this->upload->initialize($config);

						//if not successful, set the error message
						if ($this->upload->do_upload('image')) 
						{
							$logo_data = $this->upload->data();
						}

						// *** 1) Initialise / load image
					    $resizeObj = new resize("./uploads/staff/".$logo_data['file_name']);

					    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					    $resizeObj -> resizeImage(115,135, 'exact');

					    // *** 3) Save image
					    $resizeObj -> saveImage("./uploads/staff/".$logo_data['file_name'], 1000);

						$insert_data['image'] = $logo_data['file_name'];
						
					}
				}
				else
				{
					$insert_data['image'] = "default.png"; 
				}

				$id = $this->input->post('staff_id');
				$insert_data['name'] = $this->input->post('name');
				$insert_data['username'] = $this->input->post('username');
				$insert_data['email'] = implode(',',$this->input->post('email'));
				$insert_data['phone'] = implode(',',$this->input->post('phone'));
				$insert_data['gender'] = $this->input->post('gender');
				$insert_data['dob'] = str_replace("/", "-", $this->input->post('dob'));
				$insert_data['country'] = $this->input->post('country');
				$insert_data['state'] = $this->input->post('state');
				$insert_data['city'] = $this->input->post('city');
				$insert_data['c_address'] = $this->input->post('current_address');
				$insert_data['p_address'] = $this->input->post('permanent_address');
				$insert_data['doj'] = str_replace("/", "-", $this->input->post('doj'));
				$insert_data['staff_type'] = $this->input->post('staff_type');
				$insert_data['emp_type'] = $this->input->post('emp_type');
				$insert_data['marital_status'] = $this->input->post('marital_status');
				$insert_data['parent_relation'] = $this->input->post('relationship');
				$insert_data['parent_name'] = $this->input->post('parent_name');
				$insert_data['parent_email'] = $this->input->post('parent_email');
				$insert_data['parent_phone'] = $this->input->post('parent_phone');
				date_default_timezone_set('Asia/Calcutta');
				$insert_data['modify_date'] = date("y-m-d H:i:s");

				$query = $this->user_model->update_staff($insert_data,$id);
				//execute if query is successfull executed..
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('update_staff',$id);
					header("Location: " . $_SERVER['REQUEST_URI']);
				}
				
			}
			else
			{
				//fetch organization details from database..
				$data['organization_detail'] = $this->user_model->get_organization_details();
				$data['num_of_org_location'] = $this->user_model->num_of_org_location();
				$data['org_location'] = $this->user_model->get_organization_location();


				//fetch userdetails from database of login user..
				$data['user_detail'] = $this->user_model->get_user_details($username,'admin');

				//fetch staff details from database..
				$staff_detail = $this->user_model->get_staff_details();
				$data['staff'] = $staff_detail[0];
				$data['no_of_staff'] = $staff_detail[1];

				

				//fetch staff details from database..
				if($this->user_model->last_staff_username())
				{
					$data['last_staff_username'] = $this->user_model->last_staff_username();
				}
				else
				{
					$data['last_staff_username']['username'] = "staff_100";
				}
				$data['title'] = "Hello";
				$data['page'] = "staff";
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
	
	//execute functin when user click on any staff on left panel to view staff details..
	function view_staff()
	{
		$staff_id = $this->input->post('staff_id');
		$this->load->model('user_model');

		//get username from session..
		$username = $this->session->userdata('username');

		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			$staff_detail = $this->user_model->fetchbyid($staff_id,'staff');

			$email = explode(',',$staff_detail['email']);
			$phone = explode(',',$staff_detail['phone']);
			?>
			<div class="staff-view">
				<div class="row">
					<!-- end col-lg-8 -->
					<div class="col-lg-8">
						<div class="row">
							<div class="col-lg-12">
								<span class="staff-heading">Name : </span><?php echo $staff_detail['name'];?>
							</div>
						</div>
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-12">
								<span class="staff-heading">Usename : </span><?php echo $staff_detail['username'];?>
							</div>
						</div>
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-12">
								<span class="staff-heading">Gender : </span><?php echo $staff_detail['gender'];?>
							</div>
						</div>
						<div class="row" style="margin-top:15px;">
							<div class="col-lg-12">
								<span class="staff-heading">Date Of Birth : </span><?php echo date('j, M Y',strtotime($staff_detail['dob'])) ?>
							</div>
						</div>
					</div>
					<!-- end col-lg-8 -->
					
					<!-- col-lg-4 -->
					<div class="col-lg-4">
					<img src="<?php echo base_url(); ?>uploads/staff/<?php echo $staff_detail['image'] ?>"  alt="" class="img">
					</div>
					<!-- end col-lg-4 -->

				</div><!-- end row.. -->

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-6">
						<span class="staff-heading">Email Id : </span>
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
					<div class="col-lg-6">
						<span class="staff-heading">Phone No : </span>
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

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-6">
						<div class="staff-heading">Current Address : </div>
						<div><?php echo $staff_detail['c_address']; ?></div>
					</div>
					<div class="col-lg-6">
						<div class="staff-heading">Permanent Address : </div>
						<div><?php echo $staff_detail['p_address']; ?></div>
					</div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-6">
						<span class="staff-heading">Country : </span><?php echo $staff_detail['country']; ?>
					</div>
					<div class="col-lg-6">
						<span class="staff-heading">State : </span><?php echo $staff_detail['state']; ?>
					</div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-6">
						<span class="staff-heading">City : </span><?php echo $staff_detail['city']; ?>
					</div>
					<div class="col-lg-6">
						<span class="staff-heading">Date Of Joining : </span><?php echo date('j, M Y',strtotime($staff_detail['doj'])) ?>
					</div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-6">
						<span class="staff-heading">Parent Name : </span><?php echo $staff_detail['parent_name']; ?>
					</div>
					<div class="col-lg-6">
						<span class="staff-heading">Parent Relation : </span><?php echo $staff_detail['parent_relation']; ?>
					</div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-6">
						<span class="staff-heading">Parent Mobile No : </span><?php echo $staff_detail['parent_phone']; ?>
					</div>
					<div class="col-lg-6">
						<span class="staff-heading">Parent Email : </span><?php echo $staff_detail['parent_email']; ?>
					</div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-6">
						<span class="staff-heading">Staff Type : </span><?php echo $staff_detail['staff_type']; ?>
					</div>
					<div class="col-lg-6">
						<span class="staff-heading">Employee Type : </span><?php echo $staff_detail['emp_type']; ?>
					</div>
				</div>
			</div><!-- end staff-view -->

			<?php
		}
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}

	}

	//execute function when search staff..
	function staff_search()
	{
		//get username from session..
		$username = $this->session->userdata('username');
		
		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			if(isset($_POST['name']))
			{
				$this->load->model('user_model');

				$name = trim($_POST['name']);
				$emp_type = $_POST['emp_type'];
				$staff_type = $_POST['staff_type'];

				// $doj = date("j, M Y", strtotime($_POST['doj']));

				$staff = $this->user_model->get_staff($name,$emp_type,$staff_type);
				//if result returns value..
				//if there is any staff in database..
				if($staff)
				{
					$i=1;
					//execute when first time page load..
					foreach($staff as $staff_detail)
					{

						$email = explode(',',$staff_detail['email']);
						$phone = explode(',',$staff_detail['phone']);
					?>
					<div class="left-blog">
						<div class="row">
							<div class="col-lg-12 top-label">
								<div class="row">
									<div class="col-lg-6 location-name">
									<?php echo $staff_detail['name']; ?>
									</div>
									<div class="col-lg-6 topic_number">
									<?php echo $staff_detail['username']; ?>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="bottom-label <?php echo $i;?>" id="<?php echo $staff_detail['id']; ?>" style="padding-right:0px;">
									<div class="row staff-detail">
										<div class="col-lg-2">
											<img src="<?php echo base_url(); ?>uploads/staff/<?php echo $staff_detail['image'] ?>"  alt="<?php echo $staff_detail['name']; ?>" class="staff-img">
										</div>
										<div class="col-lg-5">
											<div><?php echo date('j, M Y',strtotime($staff_detail['dob'])); ?></div>
											<div><?php echo $email[0]; ?></div>
											<div><?php echo $phone[0]; ?></div>
										</div>
										<div class="col-lg-5">
											<div><?php echo $staff_detail['gender']; ?></div>
											<div><?php echo $staff_detail['staff_type']; ?></div>
											<div><?php echo $staff_detail['emp_type']; ?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					$i++;
					}//end foreach loop..
				}
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
		}
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}
		
	}

	//execute when click on edit button on right hand pannel..
	function edit_staff()
	{
		//get username from session..
		$username = $this->session->userdata('username');
		
		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			$staff_id = $this->input->post('staff_id');
			$this->load->model('user_model');

			$staff_detail = $this->user_model->search_by_id($staff_id,'staff');
			//if user exist into database and information is fetched..
			if($staff_detail)
			{
				$staff_dob = date('d/m/Y',strtotime($staff_detail['dob']) );
				$staff_doj = date('d/m/Y',strtotime($staff_detail['doj']) );
				
				echo form_open_multipart('user/staff','id="staff-form"');
				?>

				<div class="row">
					<div class="col-lg-5">
						<div class="row">
							<div class="col-lg-12">
								<div class="label-text">Name</div>
								<div><input type="text" class="form-control" value="<?php echo $staff_detail['name'];?>" id="staff-name" name="name"></div>
							</div>
						</div>
						<div class="row" style="margin-top:10px;">
							<div class="col-lg-12">
								<div class="label-text">Username</div>
								<div><input type="text" class="form-control" readonly value="<?php echo $staff_detail['username']?>" id="staff-username" name="username"></div>
							</div>
						</div>
						<div class="row" style="margin-top:10px;">
							<div class="col-lg-12">
								<div class="label-text">Date Of Birth</div>
								<div>

									<div class="form-group">
		                                <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
		                                    <input type='text' class="form-control" name="dob" id="staff-dob" />
		                                    <span class="input-group-addon">
		                                        <span class="glyphicon glyphicon-calendar"></span>
		                                    </span>
		                                </div>
		                                <script type="text/javascript">
		                                $('#datetimepicker1').datetimepicker({
									        pickTime: false
									    });
		    							$('#datetimepicker1').data("DateTimePicker").setMaxDate(new Date("january 1, 1994"));
									    $('#datetimepicker1').data("DateTimePicker").setDate("<?php echo  $staff_dob; ?>");
		                                </script>
		                            </div>
			                     
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-lg-offset-3">
						<div class="row">
							<div class="col-lg-12 image">
								<div id="uploaded-image">
									<img src="<?php echo base_url(); ?>uploads/staff/<?php echo $staff_detail['image'];?>"  alt="Staff Image" class="img">
								</div>
								
								<div class="cross">
									<img src="<?php echo base_url();?>img/close.png" alt="">
								</div>
							</div>

						</div>
						<div class="row" style="margin-top:5px;">
							<div class="col-lg-9">
								<label style="width:100%;">
									<input type="file" style="display:none;" name="image" accept="image/*" id="files">
									<div class="upload-file">Upload Image</div>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="">
					<div class="col-lg-5">
						<div class="label-text">Gender </div>
						<div>
							<select class="form-control" name="gender">
								<?php
								if($staff_detail['gender'] == "Male")
								{
									echo '<option value="Male" selected >Male</option>
									<option value="Female">Female</option>';
								}
								else
								{
									echo '<option value="Male">Male</option>
									<option value="Female" selected >Female</option>';
								}
								?>
								
							</select>
						</div>
					</div>
					<div class="col-lg-5 col-lg-offset-2">
						<div class="label-text">Country</div>
						<div>
							<select class="form-control country" onchange="print_state('state' , this.selectedIndex);" id="country" name ="country"></select>
						</div>
					</div>
				</div>

				<div class="row" style="margin-top:10px;">
					<div class="col-lg-5">
						<div class="label-text">State</div>
						<div>
							<select name ="state" id ="state" class="form-control state"></select>
							<script language="javascript">print_country("country");</script>
						</div>
					</div>
					<div class="col-lg-5 col-lg-offset-2">
						<div class="label-text">City</div>
						<div><input type="text" class="form-control" value="<?php echo $staff_detail['city']?>" id="city" name="city"></div>
					</div>
				</div>

				<div class="row" style="margin-top:10px;">
					<div class="col-lg-5">
						<div class="row">
							<div class="col-lg-12">
								<div class="label-text">Email Id.</div>
								<div class="email">
									<?php
									$staff_email = explode(',',$staff_detail['email']);
									for($a = 0; $a< count($staff_email); $a++)
									{
										if($staff_email[$a] != "")
										{
											if($a == 0)
											{
											echo '<input type="text" value="'.$staff_email[$a].'" name="email[]" class="form-control email-text">';
											}
											else
											{
											echo '<input type="text" value="'.$staff_email[$a].'" name="email[]" class="form-control email-text" style="margin-top:10px;">';
											}
										}
									}
									?>
									
								</div>
							</div>
						</div>

						<div class="row add-more">
							<div class="col-lg-6 add-email">
								+ Add More
							</div>
							<div class="col-lg-6 remove-box remove-email" style="text-align:right">
								- Remove
							</div>
						</div>
							
					</div>
					<div class="col-lg-5 col-lg-offset-2">
						<div class="row">
							<div class="col-lg-12">
								<div class="label-text">Phone No.</div>
								<div class="phone">

									<?php
									$staff_phone = explode(',',$staff_detail['phone']);
									for($a = 0; $a< count($staff_phone); $a++)
									{
										if($staff_phone[$a] != "")
										{
											if($a == 0)
											{
											echo '<input type="text" value="'.$staff_phone[$a].'" name="phone[]" class="form-control phone-text">';
											}
											else
											{
											echo '<input type="text" value="'.$staff_phone[$a].'" name="phone[]" class="form-control phone-text" style="margin-top:10px;">';
											}
										}
									}
									?>
								</div>
							</div>
						</div>

						<div class="row add-more">
							<div class="col-lg-6 add-phone">
								+ Add More
							</div>
							<div class="col-lg-6 remove-box remove-phone" style="text-align:right">
								- Remove
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-5">
						<div class="label-text">Date of Joining</div>
						<div>
							<div class='input-group date' id='datetimepicker2' data-date-format="DD/MM/YYYY">
		                        <input type='text' class="form-control" name="doj" id="staff-doj"/>
		                        <span class="input-group-addon">
		                            <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
		                    </div>
		                    <script type="text/javascript">
		                    $('#datetimepicker2').datetimepicker({
						        pickTime: false
						    });
						    $('#datetimepicker2').data("DateTimePicker").setDate("<?php echo  $staff_doj; ?>");
		                    </script>
						</div>
					</div>
					<div class="col-lg-5 col-lg-offset-2">
						<div class="label-text">Marital Status</div>
						<div>
							<select name="marital_status" id="marital_status"  class="form-control">
								<option value="">Single</option>
								<option value="">Married</option>
							</select>
						</div>
					</div>
				</div>

				<div class="row" style="margin-top:10px;">
					<div class="col-lg-5">
						<div class="label-text">Current Address</div>
						<div>
							<textarea name="current_address" class="form-control c_address" rows="3"><?php echo $staff_detail['c_address']?></textarea>
						</div>
					</div>
					<div class="col-lg-2" style="text-align:center; padding-top:36px;">
						<?php
						if($staff_detail['c_address'] == $staff_detail['p_address'])
						{
						?>
						<label>
							<div style="font-family:Gilda Display; font-size:13px; font-weight:normal;">Copy</div>
							<input type="checkbox" checked class="checkbox address-checkbox" >
							<div style="margin-left:2px;" class="checkbox-img"></div>
						</label>
						<?php
						}
						else
						{
						?>
						<label>
							<div style="font-family:Gilda Display; font-size:13px; font-weight:normal;">Copy</div>
							<input type="checkbox" class="checkbox address-checkbox" >
							<div style="margin-left:2px;" class="checkbox-img"></div>
						</label>
						<?php
						}
						?>
						
					</div>
					<div class="col-lg-5">
						<div class="label-text">Permanet Address</div>
						<div>
							<textarea name="permanent_address" class="form-control p_address" rows="3"><?php echo $staff_detail['p_address']?></textarea>
						</div>
					</div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-5">
						<div class="label-text">Relationship</div>
						<div>
							<select name="relationship" id="relationship" class="form-control">
								<?php
								if($staff_detail['parent_relation'] == "Father")
								{
									echo '<option value="Father" selected >Father</option>
									<option value="Mother">Mother</option>
									<option value="Spouse">Spouse</option>
									<option value="Guardian">Guardian</option>';
								}
								else if($staff_detail['parent_relation'] == "Mother")
								{
									echo '<option value="Father">Father</option>
									<option value="Mother" selected >Mother</option>
									<option value="Spouse">Spouse</option>
									<option value="Guardian">Guardian</option>';
								}
								else if($staff_detail['parent_relation'] == "Spouse")
								{
									echo '<option value="Father">Father</option>
									<option value="Mother">Mother</option>
									<option value="Spouse" selected >Spouse</option>
									<option value="Guardian">Guardian</option>';
								} 
								else if($staff_detail['parent_relation'] == "Guardian")
								{
									echo '<option value="Father">Father</option>
									<option value="Mother">Mother</option>
									<option value="Spouse">Spouse</option>
									<option value="Guardian" selected >Guardian</option>';
								} 
								 ?>
								
							</select>
						</div>
					</div>
					<div class="col-lg-5 col-lg-offset-2">
						<div class="label-text parent-name"><?php echo $staff_detail['parent_relation'];?> Name</div>
						<div>
							<input type="text" class="form-control" name="parent_name" id="parent_name" value="<?php echo $staff_detail['parent_name']?>">
						</div>
					</div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-5">
						<div class="label-text parent-phone"><?php echo $staff_detail['parent_relation'];?> Phone</div>
						<div>
							<input type="text" class="form-control" name="parent_phone" id="parent_phone" value="<?php echo $staff_detail['parent_phone']?>">
						</div>
					</div>
					<div class="col-lg-5 col-lg-offset-2">
						<div class="label-text parent-email"><?php echo $staff_detail['parent_relation'];?> Email Id</div>
						<div>
							<input type="text" class="form-control" name="parent_email" id="parent_email" value="<?php echo $staff_detail['parent_email']?>">
						</div>
					</div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-5">
						<div class="label-text">Staff Type</div>
						<div>
							<select name="staff_type" id="" class="form-control">
								<?php
								if($staff_detail['staff_type'] == "Teaching")
								{
									echo '<option value="Teaching" selected>Teaching</option>
									<option value="Non Teaching">Non Teaching</option>';
								}
								else
								{
									echo '<option value="Teaching">Teaching</option>
									<option value="Non Teaching" selected>Non Teaching</option>';
								}
								?>
								
							</select>
						</div>
					</div>
					<div class="col-lg-5 col-lg-offset-2">
						<div class="label-text">Employee Type</div>
						<div>
							<select class="form-control" name="emp_type">
								<?php
								if($staff_detail['emp_type'] == "Permanent")
								{
									echo '<option value="Permanent" selected>Permanent</option>
									<option value="Part Time">Part Time</option>
									<option value="Contract Based">Contract Based</option>';
								}
								else if($staff_detail['emp_type'] == "Part Time")
								{
									echo '<option value="Permanent">Permanent</option>
									<option value="Part Time" selected>Part Time</option>
									<option value="Contract Based">Contract Based</option>';
								}
								else if($staff_detail['emp_type'] == "Contract Based")
								{
									echo '<option value="Permanent">Permanent</option>
									<option value="Part Time">Part Time</option>
									<option value="Contract Based" selected>Contract Based</option>';
								}
								?>
							</select>
						</div>
					</div>
				</div>

				<!-- save and cancle button -->
				<div class="row" style="margin-top:15px;">
					<div class="col-lg-3 col-lg-offset-3">
						<input type="hidden" name="update_btn" value="success">
						<input type="hidden" name="default_image" id="default_image" value="default">
						<input type="hidden" name="old_image" value="<?php echo $staff_detail['image']; ?>">
						<input type="hidden" name="staff_id" value="<?php echo $staff_detail['id']; ?>">
						<div class="submit-btn form-submit-btn save-btn">Update</div>
					</div>
					<div class="col-lg-3">
						<div class="cancel-btn" id="reset">Cancel</div>
					</div>
				</div>
				<div class="username" style="display:none;"><?php echo $staff_detail['username']; ?></div>
				<!-- //end save and cancle button -->

				<?php echo form_close(); ?>


				<script type="text/javascript">

					//select those country which is present in database..
					$("#country").val("<?php echo $staff_detail['country']; ?>").attr('selected','selected');

					//get country_index which is selected..
					var country_index = $('#country :selected').index();

					//display all state of selected Country..
					print_state_country('state',country_index);

					//select those state which is present in database..
					$("#state").val("<?php echo $staff_detail['state']; ?>").attr('selected','selected');


					if( $('.checkbox').is(":checked") )
					{
						$(".checkbox:checked").next('.checkbox-img').css({
							background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 0px'
						});
					}


					<?php
						if($staff_detail['image'] == "default.png")
						{
							?>
							$(".cross").hide();
							<?php
						}
						else
						{
							?>
							$(".cross").show();
							<?php
						}
					?>


					//by default hide remove text box button..
					$(".remove-box").hide();
					

					//display remove email button..
					var email_count = 0
					$(".email-text").each(function(){
						email_count++;
					});

					if(email_count != 1)
					{
						$(".remove-email").show();
					}

					//display remove phone button..
					var phone_count = 0
					$(".phone-text").each(function(){
						phone_count++;
					});

					if(phone_count != 1)
					{
						$(".remove-phone").show();
					}
				</script>
			<?php
			}// end if($staff_detail)
		}
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}
	}

	//**********************************
	// End Staff Management
	//**********************************



	//*******************************
	// Start admin management
	//*******************************
	//function for add insert or update or view admin details..
	function admin()
	{
		$this->load->model('user_model');

		//get username from session..
		$username = $this->session->userdata('username');

		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			if( $this->input->post('insert_btn') )
			{
				$code = $this->user_model->generateRandomString(6);
				//check if any file is selected..
				if( !empty($_FILES['image']['name']) )
				{
					//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
					$config['upload_path'] = './uploads/admin/';

					//set logo default name..
					$config['file_name'] = $code;

					// set the filter image types
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					
					//load the upload library
					$this->load->library('upload', $config);

			   		$this->upload->set_allowed_types('*');
			    
					$this->upload->initialize($config);

					//if not successful, set the error message
					if ($this->upload->do_upload('image')) 
					{
						$logo_data = $this->upload->data();
					}

					// *** 1) Initialise / load image
				    $resizeObj = new resize("./uploads/admin/".$logo_data['file_name']);

				    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				    $resizeObj -> resizeImage(115,135, 'exact');

				    // *** 3) Save image
				    $resizeObj -> saveImage("./uploads/admin/".$logo_data['file_name'], 1000);

					$insert_data['image'] = $logo_data['file_name'];
				}
				//if there is no any file selected..
				else
				{
					$insert_data['image'] = "default.png";
				}

				$insert_data['name'] = $this->input->post('name');
				$insert_data['username'] = $this->input->post('username');
				$insert_data['email'] = implode(',',$this->input->post('email'));
				$insert_data['password'] = md5("123");
				$insert_data['phone'] = implode(',',$this->input->post('phone'));
				$insert_data['gender'] = $this->input->post('gender');
				$insert_data['dob'] = str_replace("/", "-", $this->input->post('dob')) ;
				$insert_data['country'] = $this->input->post('country');
				$insert_data['state'] = $this->input->post('state');
				$insert_data['city'] = $this->input->post('city');
				$insert_data['c_address'] = $this->input->post('current_address');
				$insert_data['p_address'] = $this->input->post('permanent_address');
				$insert_data['doj'] = str_replace("/", "-", $this->input->post('doj'));
				$insert_data['marital_status'] = $this->input->post('marital_status');
				$insert_data['parent_relation'] = $this->input->post('relationship');
				$insert_data['parent_name'] = $this->input->post('parent_name');
				$insert_data['parent_email'] = $this->input->post('parent_email');
				$insert_data['parent_phone'] = $this->input->post('parent_phone');
				$insert_data['code'] = $this->user_model->generateRandomString(6);

				date_default_timezone_set('Asia/Calcutta');
				$insert_data['create_date'] = date("y-m-d H:i:s");
				
				// script for insert staff data into database..
				$query = $this->user_model->insertdata($insert_data,'admin');

				//execute if query is successfull executed..
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('insert_admin',"success");
					header("Location: " . $_SERVER['REQUEST_URI']);
				}
			}
			else if( $this->input->post('update_btn') )
			{
				$code = $this->user_model->generateRandomString(6);

				//if image is not empty
				if($this->input->post('default_image') != "")
				{
					//if image does not changed..
					if( $this->input->post('default_image') == "default")
					{
						$insert_data['image'] = $this->input->post('old_image');
					}
					//if image changed..
					else
					{
						//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
						$config['upload_path'] = './uploads/admin/';

						//set logo default name..
						$config['file_name'] = $code;

						// set the filter image types
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						
						//load the upload library
						$this->load->library('upload', $config);

				   		$this->upload->set_allowed_types('*');
				    
						$this->upload->initialize($config);

						//if not successful, set the error message
						if ($this->upload->do_upload('image')) 
						{
							$logo_data = $this->upload->data();
						}

						// *** 1) Initialise / load image
					    $resizeObj = new resize("./uploads/admin/".$logo_data['file_name']);

					    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					    $resizeObj -> resizeImage(115,135, 'exact');

					    // *** 3) Save image
					    $resizeObj -> saveImage("./uploads/admin/".$logo_data['file_name'], 1000);

						$insert_data['image'] = $logo_data['file_name'];
						
					}
				}
				else
				{
					$insert_data['image'] = "default.png"; 
				}

				$id = $this->input->post('staff_id');
				$insert_data['name'] = $this->input->post('name');
				$insert_data['username'] = $this->input->post('username');
				$insert_data['email'] = implode(',',$this->input->post('email'));
				$insert_data['password'] = md5("123");
				$insert_data['phone'] = implode(',',$this->input->post('phone'));
				$insert_data['gender'] = $this->input->post('gender');
				$insert_data['dob'] = str_replace("/", "-", $this->input->post('dob')) ;
				$insert_data['country'] = $this->input->post('country');
				$insert_data['state'] = $this->input->post('state');
				$insert_data['city'] = $this->input->post('city');
				$insert_data['c_address'] = $this->input->post('current_address');
				$insert_data['p_address'] = $this->input->post('permanent_address');
				$insert_data['doj'] = str_replace("/", "-", $this->input->post('doj'));
				$insert_data['marital_status'] = $this->input->post('marital_status');
				$insert_data['parent_relation'] = $this->input->post('relationship');
				$insert_data['parent_name'] = $this->input->post('parent_name');
				$insert_data['parent_email'] = $this->input->post('parent_email');
				$insert_data['parent_phone'] = $this->input->post('parent_phone');
				date_default_timezone_set('Asia/Calcutta');
				$insert_data['modify_date'] = date("y-m-d H:i:s");




				$query = $this->user_model->updatedata($insert_data,$id,'admin');
				//execute if query is successfull executed..
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('update_admin',$id);
					header("Location: " . $_SERVER['REQUEST_URI']);
				}
				
			}
			else
			{
				//fetch organization details from database..
				$data['organization_detail'] = $this->user_model->get_organization_details();
				$data['num_of_org_location'] = $this->user_model->num_of_org_location();
				$data['org_location'] = $this->user_model->get_organization_location();


				//fetch userdetails from database of login user..
				$data['user_detail'] = $this->user_model->get_user_details($username,'admin');

				//fetch staff details from database..
				$admin_detail = $this->user_model->fetchalldatadesc('admin');
				$data['admin'] = $admin_detail[0];
				$data['no_of_admin'] = $admin_detail[1];

				//fetch staff details from database..
				if($this->user_model->fetchlastdata('admin'))
				{
					$data['last_admin_username'] = $this->user_model->fetchlastdata('admin');
				}
				else
				{
					$data['last_admin_username']['username'] = "staff_100";
				}

				$data['title'] = "Hello";
				$data['page'] = "admin";
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


	//execute function when search admin..
	function admin_search()
	{
		//get username from session..
		$username = $this->session->userdata('username');

		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			$this->load->model('user_model');
			if(isset($_POST['name']))
			{
				$name = trim($_POST['name']);
				$username = $_POST['username'];

				$admin = $this->user_model->get_admin($name,$username);
				//if result returns value..
				//if there is any admin in database..
				if($admin)
				{
					$i=1;
					//execute when first time page load..
					foreach($admin as $admin_detail)
					{

						$email = explode(',',$admin_detail['email']);
						$phone = explode(',',$admin_detail['phone']);
					?>
					<div class="left-blog">

						<div class="row">
							<div class="col-lg-12 top-label">
								<div class="row">
									<div class="col-lg-6 location-name">
									<?php echo $admin_detail['name']; ?>
									</div>
									<div class="col-lg-6 topic_number">
									<?php echo $admin_detail['username']; ?>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="bottom-label <?php echo $i;?>" id="<?php echo $admin_detail['id']; ?>" style="padding-right:0px;">
									<div class="row staff-detail">
										<div class="col-lg-2">
											<img src="<?php echo base_url(); ?>uploads/admin/<?php echo $admin_detail['image'] ?>"  alt="<?php echo $admin_detail['name']; ?>" class="staff-img">
										</div>
										<div class="col-lg-5">
											<div><?php echo date('j, M Y',strtotime($admin_detail['dob'])); ?></div>
											<div><?php echo $email[0]; ?></div>
											<div><?php echo $phone[0]; ?></div>
										</div>
										<div class="col-lg-5">
											<div><?php echo $admin_detail['gender']; ?></div>
											<div><?php echo $admin_detail['city']; ?></div>
											<div><?php echo $admin_detail['country']; ?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<?php
					$i++;
					}//end foreach loop..
				}
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
			}//end if(isset($_POST['name']))
		}// end if(substr($username,0,5) == "admin")
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}
		
	}
	//end execute function when search admin..

	//execute functin when user click on any admin on left panel to view admin details..
	function view_admin()
	{
		//get username from session..
		$username = $this->session->userdata('username');

		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			$admin_id = $this->input->post('admin_id');
			$this->load->model('user_model');

			$admin_detail = $this->user_model->fetchbyid($admin_id,'admin');
			if($admin_detail)
			{
				$email = explode(',',$admin_detail['email']);
				$phone = explode(',',$admin_detail['phone']);
				?>
				<div class="staff-view">
					<div class="row">
						<!-- end col-lg-8 -->
						<div class="col-lg-8">
							<div class="row">
								<div class="col-lg-12">
									<span class="staff-heading">Name : </span><?php echo $admin_detail['name'];?>
								</div>
							</div>
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Usename : </span><?php echo $admin_detail['username'];?>
								</div>
							</div>
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Gender : </span><?php echo $admin_detail['gender'];?>
								</div>
							</div>
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Date Of Birth : </span><?php echo date('j, M Y',strtotime($admin_detail['dob'])) ?>
								</div>
							</div>
						</div>
						<!-- end col-lg-8 -->
						
						<!-- col-lg-4 -->
						<div class="col-lg-4">
						<img src="<?php echo base_url(); ?>uploads/admin/<?php echo $admin_detail['image'] ?>"  alt="" class="img">
						</div>
						<!-- end col-lg-4 -->

					</div><!-- end row.. -->

					<div class="row" style="margin-top:15px;">
						<div class="col-lg-6">
							<span class="staff-heading">Email Id : </span>
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
						<div class="col-lg-6">
							<span class="staff-heading">Phone No : </span>
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

					<div class="row" style="margin-top:15px;">
						<div class="col-lg-6">
							<div class="staff-heading">Current Address : </div>
							<div><?php echo $admin_detail['c_address']; ?></div>
						</div>
						<div class="col-lg-6">
							<div class="staff-heading">Permanent Address : </div>
							<div><?php echo $admin_detail['p_address']; ?></div>
						</div>
					</div>

					<div class="row" style="margin-top:15px;">
						<div class="col-lg-6">
							<span class="staff-heading">Country : </span><?php echo $admin_detail['country']; ?>
						</div>
						<div class="col-lg-6">
							<span class="staff-heading">State : </span><?php echo $admin_detail['state']; ?>
						</div>
					</div>

					<div class="row" style="margin-top:15px;">
						<div class="col-lg-6">
							<span class="staff-heading">City : </span><?php echo $admin_detail['city']; ?>
						</div>
						<div class="col-lg-6">
							<span class="staff-heading">Date Of Joining : </span><?php echo date('j, M Y',strtotime($admin_detail['doj'])) ?>
						</div>
					</div>

					<div class="row" style="margin-top:15px;">
						<div class="col-lg-6">
							<span class="staff-heading">Parent Name : </span><?php echo $admin_detail['parent_name']; ?>
						</div>
						<div class="col-lg-6">
							<span class="staff-heading">Parent Relation : </span><?php echo $admin_detail['parent_relation']; ?>
						</div>
					</div>

					<div class="row" style="margin-top:15px;">
						<div class="col-lg-6">
							<span class="staff-heading">Parent Mobile No : </span><?php echo $admin_detail['parent_phone']; ?>
						</div>
						<div class="col-lg-6">
							<span class="staff-heading">Parent Email : </span><?php echo $admin_detail['parent_email']; ?>
						</div>
					</div>

				</div><!-- end staff-view -->

			<?php
			}//end if($admin_detail)
		}// end if(substr($username,0,5) == "admin")
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}

	}


	//execute when click on edit button on right hand pannel..
	function edit_admin()
	{
		//get username from session..
		$username = $this->session->userdata('username');

		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			$admin_id = $this->input->post('admin_id');
			$this->load->model('user_model');

			$admin_detail = $this->user_model->fetchbyid($admin_id,'admin');
			if($admin_detail)
			{
				$admin_dob = date('d/m/Y',strtotime($admin_detail['dob']) );
				$admin_doj = date('d/m/Y',strtotime($admin_detail['doj']) );

				echo form_open_multipart('user/admin','id="admin-form"');?>

				<div class="row">
					<div class="col-lg-5">
						<div class="row">
							<div class="col-lg-12">
								<div class="label-text">Name</div>
								<div><input type="text" class="form-control" value="<?php echo $admin_detail['name'];?>" id="staff-name" name="name"></div>
							</div>
						</div>
						<div class="row" style="margin-top:10px;">
							<div class="col-lg-12">
								<div class="label-text">Username</div>
								<div><input type="text" class="form-control" readonly value="<?php echo $admin_detail['username']?>" id="staff-username" name="username"></div>
							</div>
						</div>
						<div class="row" style="margin-top:10px;">
							<div class="col-lg-12">
								<div class="label-text">Date Of Birth</div>
								<div>

									<div class="form-group">
		                                <div class='input-group date' id='datetimepicker1' data-date-format="DD/MM/YYYY">
		                                    <input type='text' class="form-control" name="dob" id="staff-dob" />
		                                    <span class="input-group-addon">
		                                        <span class="glyphicon glyphicon-calendar"></span>
		                                    </span>
		                                </div>
		                                <script type="text/javascript">
		                                $('#datetimepicker1').datetimepicker({
									        pickTime: false
									    });
		    							$('#datetimepicker1').data("DateTimePicker").setMaxDate(new Date("january 1, 1994"));
									    $('#datetimepicker1').data("DateTimePicker").setDate("<?php echo  $admin_dob; ?>");
		                                </script>
		                            </div>
			                     
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-lg-offset-3">
						<div class="row">
							<div class="col-lg-12 image">
								<div id="uploaded-image">
									<img src="<?php echo base_url(); ?>uploads/admin/<?php echo $admin_detail['image'];?>"  alt="Staff Image" class="img">
								</div>
								
								<div class="cross">
									<img src="<?php echo base_url();?>img/close.png" alt="">
								</div>
							</div>

						</div>
						<div class="row" style="margin-top:5px;">
							<div class="col-lg-9">
								<label style="width:100%;">
									<input type="file" style="display:none;" name="image" accept="image/*" id="files">
									<div class="upload-file">Upload Image</div>
								</label>
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="">
					<div class="col-lg-5">
						<div class="label-text">Gender </div>
						<div>
							<select class="form-control" name="gender">
								<?php
								if($admin_detail['gender'] == "Male")
								{
									echo '<option value="Male" selected >Male</option>
									<option value="Female">Female</option>';
								}
								else
								{
									echo '<option value="Male">Male</option>
									<option value="Female" selected >Female</option>';
								}
								?>
								
							</select>
						</div>
					</div>
					<div class="col-lg-5 col-lg-offset-2">
						<div class="label-text">Country</div>
						<div>
							<select class="form-control country" onchange="print_state('state' , this.selectedIndex);" id="country" name ="country"></select>
						</div>
					</div>
				</div>

				<div class="row" style="margin-top:10px;">
					<div class="col-lg-5">
						<div class="label-text">State</div>
						<div>
							<select name ="state" id ="state" class="form-control state"></select>
							<script language="javascript">print_country("country");</script>
						</div>
					</div>
					<div class="col-lg-5 col-lg-offset-2">
						<div class="label-text">City</div>
						<div><input type="text" class="form-control" value="<?php echo $admin_detail['city']?>" id="city" name="city"></div>
					</div>
				</div>

				<div class="row" style="margin-top:10px;">
					<div class="col-lg-5">
						<div class="row">
							<div class="col-lg-12">
								<div class="label-text">Email Id.</div>
								<div class="email">
									<?php
									$staff_email = explode(',',$admin_detail['email']);
									for($a = 0; $a< count($staff_email); $a++)
									{
										if($staff_email[$a] != "")
										{
											if($a == 0)
											{
											echo '<input type="text" value="'.$staff_email[$a].'" name="email[]" class="form-control email-text">';
											}
											else
											{
											echo '<input type="text" value="'.$staff_email[$a].'" name="email[]" class="form-control email-text" style="margin-top:10px;">';
											}
										}
									}
									?>
									
								</div>
							</div>
						</div>

						<div class="row add-more">
							<div class="col-lg-6 add-email">
								+ Add More
							</div>
							<div class="col-lg-6 remove-box remove-email" style="text-align:right">
								- Remove
							</div>
						</div>
							
					</div>
					<div class="col-lg-5 col-lg-offset-2">
						<div class="row">
							<div class="col-lg-12">
								<div class="label-text">Phone No.</div>
								<div class="phone">

									<?php
									$staff_phone = explode(',',$admin_detail['phone']);
									for($a = 0; $a< count($staff_phone); $a++)
									{
										if($staff_phone[$a] != "")
										{
											if($a == 0)
											{
											echo '<input type="text" value="'.$staff_phone[$a].'" name="phone[]" class="form-control phone-text">';
											}
											else
											{
											echo '<input type="text" value="'.$staff_phone[$a].'" name="phone[]" class="form-control phone-text" style="margin-top:10px;">';
											}
										}
									}
									?>
								</div>
							</div>
						</div>

						<div class="row add-more">
							<div class="col-lg-6 add-phone">
								+ Add More
							</div>
							<div class="col-lg-6 remove-box remove-phone" style="text-align:right">
								- Remove
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-5">
						<div class="label-text">Date of Joining</div>
						<div>
							<div class='input-group date' id='datetimepicker2' data-date-format="DD/MM/YYYY">
		                        <input type='text' class="form-control" name="doj" id="staff-doj"/>
		                        <span class="input-group-addon">
		                            <span class="glyphicon glyphicon-calendar"></span>
		                        </span>
		                    </div>
		                    <script type="text/javascript">
		                    $('#datetimepicker2').datetimepicker({
						        pickTime: false
						    });
						    $('#datetimepicker2').data("DateTimePicker").setDate("<?php echo  $admin_doj; ?>");
		                    </script>
						</div>
					</div>
					<div class="col-lg-5 col-lg-offset-2">
						<div class="label-text">Marital Status</div>
						<div>
							<select name="marital_status" id="marital_status"  class="form-control">
								<option value="">Single</option>
								<option value="">Married</option>
							</select>
						</div>
					</div>
				</div>

				<div class="row" style="margin-top:10px;">
					<div class="col-lg-5">
						<div class="label-text">Current Address</div>
						<div>
							<textarea name="current_address" class="form-control c_address" rows="3"><?php echo $admin_detail['c_address']?></textarea>
						</div>
					</div>
					<div class="col-lg-2" style="text-align:center; padding-top:36px;">
						<?php
						if($admin_detail['c_address'] == $admin_detail['p_address'])
						{
						?>
						<label>
							<div style="font-family:Gilda Display; font-size:13px; font-weight:normal;">Copy</div>
							<input type="checkbox" checked class="checkbox address-checkbox" >
							<div style="margin-left:2px;" class="checkbox-img"></div>
						</label>
						<?php
						}
						else
						{
						?>
						<label>
							<div style="font-family:Gilda Display; font-size:13px; font-weight:normal;">Copy</div>
							<input type="checkbox" class="checkbox address-checkbox" >
							<div style="margin-left:2px;" class="checkbox-img"></div>
						</label>
						<?php
						}
						?>
						
					</div>
					<div class="col-lg-5">
						<div class="label-text">Permanet Address</div>
						<div>
							<textarea name="permanent_address" class="form-control p_address" rows="3"><?php echo $admin_detail['p_address']?></textarea>
						</div>
					</div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-5">
						<div class="label-text">Relationship</div>
						<div>
							<select name="relationship" id="relationship" class="form-control">
								<?php
								if($admin_detail['parent_relation'] == "Father")
								{
									echo '<option value="Father" selected >Father</option>
									<option value="Mother">Mother</option>
									<option value="Spouse">Spouse</option>
									<option value="Guardian">Guardian</option>';
								}
								else if($admin_detail['parent_relation'] == "Mother")
								{
									echo '<option value="Father">Father</option>
									<option value="Mother" selected >Mother</option>
									<option value="Spouse">Spouse</option>
									<option value="Guardian">Guardian</option>';
								}
								else if($admin_detail['parent_relation'] == "Spouse")
								{
									echo '<option value="Father">Father</option>
									<option value="Mother">Mother</option>
									<option value="Spouse" selected >Spouse</option>
									<option value="Guardian">Guardian</option>';
								} 
								else if($admin_detail['parent_relation'] == "Guardian")
								{
									echo '<option value="Father">Father</option>
									<option value="Mother">Mother</option>
									<option value="Spouse">Spouse</option>
									<option value="Guardian" selected >Guardian</option>';
								} 
								 ?>
								
							</select>
						</div>
					</div>
					<div class="col-lg-5 col-lg-offset-2">
						<div class="label-text parent-name"><?php echo $admin_detail['parent_relation'];?> Name</div>
						<div>
							<input type="text" class="form-control" name="parent_name" id="parent_name" value="<?php echo $admin_detail['parent_name']?>">
						</div>
					</div>
				</div>

				<div class="row" style="margin-top:15px;">
					<div class="col-lg-5">
						<div class="label-text parent-phone"><?php echo $admin_detail['parent_relation'];?> Phone</div>
						<div>
							<input type="text" class="form-control" name="parent_phone" id="parent_phone" value="<?php echo $admin_detail['parent_phone']?>">
						</div>
					</div>
					<div class="col-lg-5 col-lg-offset-2">
						<div class="label-text parent-email"><?php echo $admin_detail['parent_relation'];?> Email Id</div>
						<div>
							<input type="text" class="form-control" name="parent_email" id="parent_email" value="<?php echo $admin_detail['parent_email']?>">
						</div>
					</div>
				</div>

				<!-- save and cancle button -->
				<div class="row" style="margin-top:15px;">
					<div class="col-lg-3 col-lg-offset-3">
						<input type="hidden" name="update_btn" value="success">
						<input type="hidden" name="default_image" id="default_image" value="default">
						<input type="hidden" name="old_image" value="<?php echo $admin_detail['image']; ?>">
						<input type="hidden" name="staff_id" value="<?php echo $admin_detail['id']; ?>">
						<div class="submit-btn form-submit-btn save-btn">Update</div>
					</div>
					<div class="col-lg-3">
						<div class="cancel-btn" id="reset">Cancle</div>
					</div>
				</div>
				<div class="username" style="display:none;"><?php echo $admin_detail['username']; ?></div>
				<!-- //end save and cancle button -->
				<?php echo form_close(); ?>


				<script type="text/javascript">
					//select those country which is present in database..
					$("#country").val("<?php echo $admin_detail['country']; ?>").attr('selected','selected');

					//get country_index which is selected..
					var country_index = $('#country :selected').index();

					//display all state of selected Country..
					print_state_country('state',country_index);

					//select those state which is present in database..
					$("#state").val("<?php echo $admin_detail['state']; ?>").attr('selected','selected');


					if( $('.checkbox').is(":checked") )
					{
						$(".checkbox:checked").next('.checkbox-img').css({
							background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 0px'
						});
					}


					<?php
					if($admin_detail['image'] == "default.png")
					{
						?>
						$(".cross").hide();
						<?php
					}
					else
					{
						?>
						$(".cross").show();
						<?php
					}
					?>


					//by default hide remove text box button..
					$(".remove-box").hide();
					

					//display remove email button..
					var email_count = 0
					$(".email-text").each(function(){
						email_count++;
					});

					if(email_count != 1)
					{
						$(".remove-email").show();
					}

					//display remove phone button..
					var phone_count = 0
					$(".phone-text").each(function(){
						phone_count++;
					});

					if(phone_count != 1)
					{
						$(".remove-phone").show();
					}
				</script>
				
		<?php
			}
		}// end if(substr($username,0,5) == "admin")
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}

	}
	//**********************************
	// End Admin Management
	//**********************************



	//**********************************
	// Start Student Management
	//**********************************

	function student(){

		$this->load->model('user_model');
		//get username from session..
		$username = $this->session->userdata('username');

		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			if( $this->input->post('insert_btn') )
			{
				$code = $this->user_model->generateRandomString(6);
				//check if any file is selected..
				if( !empty($_FILES['image']['name']) )
				{
					//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
					$config['upload_path'] = './uploads/student/';

					//set logo default name..
					$config['file_name'] = $code;

					// set the filter image types
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					
					//load the upload library
					$this->load->library('upload', $config);

			   		$this->upload->set_allowed_types('*');
			    
					$this->upload->initialize($config);

					//if not successful, set the error message
					if ($this->upload->do_upload('image')) 
					{
						$logo_data = $this->upload->data();
					}

					// *** 1) Initialise / load image
				    $resizeObj = new resize("./uploads/student/".$logo_data['file_name']);

				    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
				    $resizeObj -> resizeImage(115,135, 'exact');

				    // *** 3) Save image
				    $resizeObj -> saveImage("./uploads/student/".$logo_data['file_name'], 1000);

					$insert_data['image'] = $logo_data['file_name'];
				}
				//if there is no any file selected..
				else
				{
					$insert_data['image'] = "default.png";
				}

				$insert_data['name'] = $this->input->post('name');
				$insert_data['code'] = $this->user_model->generateRandomString(6);
				$insert_data['username'] = $this->input->post('username');
				$insert_data['password'] = md5('123');
				$insert_data['dob'] = str_replace("/", "-", $this->input->post('dob')) ;
				$insert_data['gender'] = $this->input->post('gender');
				$insert_data['blood_group'] = $this->input->post('blood_group');
				$insert_data['doj'] = str_replace("/", "-", $this->input->post('doj'));
				$insert_data['course'] = $this->input->post('course');
				$insert_data['category'] = $this->input->post('category');
				$insert_data['batch'] = $this->input->post('batch');
				$insert_data['parent_relation'] = $this->input->post('relationship');
				$insert_data['parent_name'] = $this->input->post('parent_name');
				$insert_data['parent_occupation'] = $this->input->post('parent_occupation');
				$insert_data['parent_email'] = $this->input->post('parent_email');
				$insert_data['parent_phone'] = $this->input->post('parent_phone');
				$insert_data['phone'] = implode(',',$this->input->post('phone'));
				$insert_data['email'] = implode(',',$this->input->post('email'));
				$insert_data['country'] = $this->input->post('country');
				$insert_data['state'] = $this->input->post('state');
				$insert_data['city'] = $this->input->post('city');
				$insert_data['current_address'] = $this->input->post('current_address');
				$insert_data['permanent_address'] = $this->input->post('permanent_address');

				date_default_timezone_set('Asia/Calcutta');
				$insert_data['create_date'] = date("y-m-d H:i:s");

				$insert_data['total_amount'] = $this->input->post('total_amount');
				$insert_data['net_amount'] = $this->input->post('net_amount');
				if($this->input->post('discount_checkbox') == "yes")
				{
					$insert_data['discount'] = "Yes";
					$insert_data['discount_amount'] = $this->input->post('discount_value');
				}
				else
				{
					$insert_data['discount'] = "Yes";
					$insert_data['discount_amount'] = "";
				}
				

				if($this->input->post('payment_type') == "Full Amount")
				{
					$insert_data['pay_amount'] =  $this->input->post('net_amount');
				}
				elseif($this->input->post('payment_type') == "Instalment")
				{
					$insert_data['pay_amount'] =  $this->input->post('pay_amount');
				}

				$insert_data['payment_mode'] =  $this->input->post('payment_mode');

				if($this->input->post('payment_mode') == "Cash")
				{
					$insert_data['cheque_number'] =  "";
				}
				elseif($this->input->post('payment_mode') == "Cheque")
				{
					$insert_data['cheque_number'] =  $this->input->post('cheque_number');
				}

				
				// script for insert staff data into database..
				$query = $this->user_model->insertdata($insert_data,'student');

				//execute if query is successfull executed..
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('insert_student',"success");
					header("Location: " . $_SERVER['REQUEST_URI']);
				}
			}
			else if( $this->input->post('update_btn') )
			{
				$code = $this->user_model->generateRandomString(6);
				//if image is not empty
				if($this->input->post('default_image') != "")
				{
					//if image does not changed..
					if( $this->input->post('default_image') == "default")
					{
						$insert_data['image'] = $this->input->post('old_image');
					}
					//if image changed..
					else
					{
						//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
						$config['upload_path'] = './uploads/student/';

						//set logo default name..
						$config['file_name'] = $code;

						// set the filter image types
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						
						//load the upload library
						$this->load->library('upload', $config);

				   		$this->upload->set_allowed_types('*');
				    
						$this->upload->initialize($config);

						//if not successful, set the error message
						if ($this->upload->do_upload('image')) 
						{
							$logo_data = $this->upload->data();
						}

						// *** 1) Initialise / load image
					    $resizeObj = new resize("./uploads/student/".$logo_data['file_name']);

					    // *** 2) Resize image (options: exact, portrait, landscape, auto, crop)
					    $resizeObj -> resizeImage(115,135, 'exact');

					    // *** 3) Save image
					    $resizeObj -> saveImage("./uploads/student/".$logo_data['file_name'], 1000);

						$insert_data['image'] = $logo_data['file_name'];
						
					}
				}
				else
				{
					$insert_data['image'] = "default.png"; 
				}

				$id = $this->input->post('student_id');
				$insert_data['name'] = $this->input->post('name');
				$insert_data['code'] = $this->user_model->generateRandomString(6);
				$insert_data['username'] = $this->input->post('username');
				$insert_data['dob'] = str_replace("/", "-", $this->input->post('dob')) ;
				$insert_data['gender'] = $this->input->post('gender');
				$insert_data['blood_group'] = $this->input->post('blood_group');
				$insert_data['doj'] = str_replace("/", "-", $this->input->post('doj'));
				$insert_data['course'] = $this->input->post('course');
				$insert_data['category'] = $this->input->post('category');
				$insert_data['batch'] = $this->input->post('batch');
				$insert_data['parent_relation'] = $this->input->post('relationship');
				$insert_data['parent_name'] = $this->input->post('parent_name');
				$insert_data['parent_occupation'] = $this->input->post('parent_occupation');
				$insert_data['parent_email'] = $this->input->post('parent_email');
				$insert_data['parent_phone'] = $this->input->post('parent_phone');
				$insert_data['phone'] = implode(',',$this->input->post('phone'));
				$insert_data['email'] = implode(',',$this->input->post('email'));
				$insert_data['country'] = $this->input->post('country');
				$insert_data['state'] = $this->input->post('state');
				$insert_data['city'] = $this->input->post('city');
				$insert_data['current_address'] = $this->input->post('current_address');
				$insert_data['permanent_address'] = $this->input->post('permanent_address');
				
				date_default_timezone_set('Asia/Calcutta');
				$insert_data['modify_date'] = date("y-m-d H:i:s");


				$insert_data['total_amount'] = $this->input->post('total_amount');
				$insert_data['net_amount'] = $this->input->post('net_amount');
				if($this->input->post('discount_checkbox') == "yes")
				{
					$insert_data['discount'] = "Yes";
					$insert_data['discount_amount'] = $this->input->post('discount_value');
				}
				else
				{
					$insert_data['discount'] = "Yes";
					$insert_data['discount_amount'] = "";
				}
				

				if($this->input->post('payment_type') == "Full Amount")
				{
					$insert_data['pay_amount'] =  $this->input->post('net_amount');
				}
				elseif($this->input->post('payment_type') == "Instalment")
				{
					$insert_data['pay_amount'] =  $this->input->post('pay_amount');
				}

				$insert_data['payment_mode'] =  $this->input->post('payment_mode');

				if($this->input->post('payment_mode') == "Cash")
				{
					$insert_data['cheque_number'] =  "";
				}
				elseif($this->input->post('payment_mode') == "Cheque")
				{
					$insert_data['cheque_number'] =  $this->input->post('cheque_number');
				}

				
				$query = $this->user_model-> updatedata($insert_data,$id,'student');
				//execute if query is successfull executed..
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('update_student',$id);
					header("Location: " . $_SERVER['REQUEST_URI']);
				}
				
			}
			else
			{
				//fetch organization details from database..
				$data['organization_detail'] = $this->user_model->fetchbyid('1','organization');


				//fetch userdetails from database of login user..
				//this is for display which user is logged in..
				$data['user_detail'] = $this->user_model->fetchbyfield('username',$username,'admin');

				$course_detail = $this->user_model->fetchalldatadesc('course');
				$data['course_detail'] = $course_detail[0];
				
				//fetch staff details from database..
				$student_detail = $this->user_model->fetchalldatadesc('student');
				$data['student_detail'] = $student_detail[0];
				$data['no_of_student'] = $student_detail[1];

				$data['page'] = "student";
				$this->load->view('template',$data);
			}
			
		}// end if(substr($username,0,5) == "admin")
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}


	}

	//execute functin when user click on any admin on left panel to view admin details..
	function view_student()
	{
		//get username from session..
		$username = $this->session->userdata('username');
		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			$student_id = $this->input->post('student_id');
			$this->load->model('user_model');

			$student_detail = $this->user_model->fetchbyid($student_id,'student');
			if($student_detail)
			{
				$email = explode(',',$student_detail['email']);
				$phone = explode(',',$student_detail['phone']);
				$course = $this->user_model->fetchbyfield('id',$student_detail['course'],'course');
		        $batch = $this->user_model->fetchbyfield('id',$student_detail['batch'],'batch');
		        ?>
				<div class="staff-view student-view">

					<div class="row">
						<!-- end col-lg-8 -->
						<div class="col-lg-7">
							<div class="title" style="padding-top:0px;">Personal Info </div>
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Name : </span><?php echo $student_detail['name'];?>
								</div>
							</div>
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Usename : </span><?php echo $student_detail['username'];?>
								</div>
							</div>
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Date Of Birth : </span><?php echo date('j, M Y',strtotime($student_detail['dob'])) ?>
								</div>
							</div>
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Gender : </span><?php echo $student_detail['gender'];?>
								</div>
							</div>

							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Blood Group : </span><?php echo $student_detail['blood_group'] ?>
								</div>
							</div>

						</div>
						<!-- end col-lg-8 -->
						
						<!-- col-lg-4 -->
						<div class="col-lg-5">
							<div class="row" style="margin-top:40px;">
								<div class="col-lg-12">
									<img src="<?php echo base_url(); ?>uploads/student/<?php echo $student_detail['image'] ?>"  alt="" class="img">
								</div>
							</div>
						</div>
						<!-- end col-lg-4 -->

					</div><!-- end row.. -->

					<div class="row student-info">
						<div class="col-lg-6">
							

							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Category : </span><?php echo $student_detail['category'] ?>
								</div>
							</div>

							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Course : </span><?php echo $course['name']; ?>
								</div>
							</div>

							
						</div>
						<div class="col-lg-6">
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Date of Joining : </span><?php echo date('j, M Y',strtotime($student_detail['doj'])) ?>
								</div>
							</div>

							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Batch : </span><?php echo $batch['name']; ?>
								</div>
							</div>
						</div>
					</div>

					<div class="row student-info">
						<!-- end col-lg-8 -->
						<div class="col-lg-6">
						<div class="title">Parent Info </div>
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading"><?php echo $student_detail['parent_relation']; ?> Name : </span><?php echo $student_detail['parent_name'];?>
								</div>
							</div>
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading"><?php echo $student_detail['parent_relation']; ?> Mobile : </span><?php echo $student_detail['parent_phone'];?>
								</div>
							</div>
							
						</div>
						<!-- end col-lg-6 -->
						
						<div class="col-lg-6">
							<div class="row" style="margin-top:48px;">
								<div class="col-lg-12">
									<span class="staff-heading"><?php echo $student_detail['parent_relation']; ?> Email : </span><?php echo $student_detail['parent_email']; ?>
								</div>
							</div>

							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading"><?php echo $student_detail['parent_relation']; ?> Occ : </span><?php echo $student_detail['parent_occupation']; ?>
								</div>
							</div>
						</div>
						
					</div>
					

					<div class="row student-info">
						<!-- end col-lg-8 -->
						<div class="col-lg-6">
						<div class="title">Contact Info </div>
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Phone No : </span>
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
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Country : </span><?php echo $student_detail['country'];?>
								</div>
							</div>
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">City : </span><?php echo $student_detail['city'];?>
								</div>
							</div>
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Current Add : </span><?php echo $student_detail['current_address'];?>
								</div>
							</div>
							
						</div>
						<!-- end col-lg-6 -->
						
						<div class="col-lg-6">
							<div class="row" style="margin-top:48px;">
								<div class="col-lg-12">
									<span class="staff-heading">Email id : </span>
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

							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">State : </span><?php echo $student_detail['state'];?>
								</div>
							</div>
							<div class="row" style="margin-top:15px;">
								<div class="col-lg-12">
									<span class="staff-heading">Permanent Add : </span><?php echo $student_detail['permanent_address'];?>
								</div>
							</div>
						</div>
						
					</div>

				</div><!-- end staff-view -->
				<div class="student_code" style="display:none;"><?php echo $student_detail['code']; ?></div>
				
			<?php
			}//end if($student_detail)
		}// end if(substr($username,0,5) == "admin")
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}
	}

	function newstudent()
	{
		$this->load->model('user_model');

		//get username from session..
		$username = $this->session->userdata('username');

		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			//fetch organization details from database..
			$data['organization_detail'] = $this->user_model->fetchbyid('1','organization');

			//fetch userdetails from database of login user..
			//this is for display which user is logged in..
			$data['user_detail'] = $this->user_model->fetchbyfield('username',$username,'admin');

			//fetch staff details from database..
			if($this->user_model->last_student_username())
			{
				$data['last_student_username'] = $this->user_model->last_student_username();
			}
			else
			{
				$data['last_student_username']['username'] = "student_1000";
			}

			$data['course_detail'] = $this->user_model->fetchalldata('course');

			$data['page'] = "student-add";
			$data['student_status'] = "Add Student";
			$this->load->view('template',$data);
			
		}// end if(substr($username,0,5) == "admin")
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}

	}

	function batch_search()
	{
		//get username from session..
		$username = $this->session->userdata('username');

		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			$course_id = $_POST['course_id'];
			$this->load->model('user_model');
			$this->load->model('manage_course');
			$batch_detail =	$this->manage_course->fetch_batch_by_courseid($course_id);
			echo "<option value=''>Select Batch</option>";
			foreach ($batch_detail as $batch) {
				$batch_id = $batch['id'];
				$num_of_student = $this->user_model->count_student_by_batch($batch_id);
				echo "<option value='".$batch['id']."'>".$batch['name']." ($num_of_student)</option>";
			}
		}// end if(substr($username,0,5) == "admin")
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}
	}


	//execute function when search admin..
	function student_search()
	{
		//get username from session..
		$username = $this->session->userdata('username');

		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			$this->load->model('user_model');

			$name = trim($_POST['name']);
			$username = trim($_POST['username']);
			$course = $_POST['course'];
			$batch = $_POST['batch'];

			$student_detail = $this->user_model->get_student($name,$username,$course,$batch);

			//if result returns value..
			//if there is any admin in database..
			if($student_detail)
			{
				$i=1;
				//execute when first time page load..
				foreach($student_detail as $student)
				{
					$email = explode(',',$student['email']);
					$phone = explode(',',$student['phone']);
					$course = $this->user_model->fetchbyfield('id',$student['course'],'course');
					$batch = $this->user_model->fetchbyfield('id',$student['batch'],'batch');
				?>
				<div class="left-blog">

					<div class="row">
						<div class="col-lg-12 top-label">
							<div class="row">
								<div class="col-lg-6 location-name">
								<?php echo $student['name']; ?>
								</div>
								<div class="col-lg-6 topic_number">
								<?php echo $student['username']; ?>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-12">
							<div class="bottom-label <?php echo $i;?>" id="<?php echo $student['id']; ?>">
								<div class="row staff-detail">
									<div class="col-lg-2">
										<img src="<?php echo base_url(); ?>uploads/student/<?php echo $student['image'] ?>"  alt="" class="staff-img">
									</div>
									<div class="col-lg-5">
										<div><?php echo date('j, M Y',strtotime($student['dob'])); ?></div>
										<div><?php echo $student['gender']; ?></div>
										<div><?php echo $email[0]; ?></div>
									</div>
									<div class="col-lg-5">
										<div><?php echo $course['name']; ?></div>
										<div><?php echo $batch['name']; ?></div>
										<div><?php echo $phone[0]; ?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
				$i++;
				}
			}
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
		}// end if(substr($username,0,5) == "admin")
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}
		
	}


	//end execute function when search student..
	//
	//
	function editstudent($id)
	{
		//get username from session..
		$username = $this->session->userdata('username');
		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			$this->load->model('user_model');
			$this->load->model('manage_course');

			if($id != "")
			{
				if( $this->user_model->fetchbyid($id,'student') )
				{
					//fetch organization details from database..
					$data['organization_detail'] = $this->user_model->fetchbyid('1','organization');

					//fetch userdetails from database of login user..
					//this is for display which user is logged in..
					$data['user_detail'] = $this->user_model->fetchbyfield('username',$username,'admin');

					$course_detail = $this->user_model->fetchalldatadesc('course');
					$data['course_detail'] = $course_detail[0];
					
					//fetch student details from database..
					$data['student_detail'] = $this->user_model->fetchbyid($id,'student');

					$data['page'] = "student-edit";
					$data['student_status'] = "Edit Student";
					$this->load->view('template',$data);
				}
				else
				{
					//redirect organization setting...
					redirect('user/student','refresh');
				}
			}
			else
			{
				//redirect organization setting...
				redirect('user/student','refresh');
			}
		}// end if(substr($username,0,5) == "admin")
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}

	}

	//**********************************
	// End Student Management
	//**********************************
	//
	function course_fee(){
		$course = $_POST['course_id'];
		$this->load->model("user_model");
		$course_detail = $this->user_model->fetchbyid($course,"course");
		echo '<div class="net-fee-amount-hidden hidden">'.$course_detail['net_fee_amount'].'</div>';
		echo '<div class="instalment-mode-hidden hidden">'.$course_detail['instalment_mode'].'</div>';
		$instalment_amount = explode("/",$course_detail['instalment_amount']);
		//execute if instament mode is not blank..
		// that means instament is applicable..
		if($course_detail['instalment_mode'] != "")
		{
			//execute if instalment mode is fix value..
			if($course_detail['instalment_mode'] == "fix")
			{
				$a = 1;
				for($i = 0; $i < count($instalment_amount); $i++) {
				?>

				<div class="row">
					<div class="col-lg-6 label-text"><?php echo $a; ?> Instalment Amount</div>
					<div class="col-lg-6">
					<input type="text" name="total_amount" value="<?php echo $instalment_amount[$i]; ?>" class="form-control instalment-value" readonly style="margin-top:5px;">
					<div class="hidden instalment-amount-hidden"><?php echo $instalment_amount[$i]; ?></div>
					</div>
				</div>
				<?php
					$a++;
				}
				
			}
			if($course_detail['instalment_mode'] == "percent")
			{
				$a = 1;
				for($i = 0; $i < count($instalment_amount); $i++) {
					$amount = $course_detail['net_fee_amount'] * $instalment_amount[$i] / 100;
				?>

				<div class="row">
					<div class="col-lg-6 label-text"><?php echo $a; ?> Instalment Amount</div>
					<div class="col-lg-6">
					<input type="text" name="total_amount" value="<?php echo round($amount, 2);  ?>" class="form-control instalment-value" readonly style="margin-top:5px;">
					<div class="hidden instalment-amount-hidden"><?php echo round($amount, 2); ?></div>
					</div>
				</div>
				<?php
					$a++;
				}
			}
		}
		else
		{

		}
	}
}


class resize
{
    // *** Class variables
    private $image;
    private $width;
    private $height;
    private $imageResized;

    function __construct($fileName)
    {
        // *** Open up the file
        $this->image = $this->openImage($fileName);

        // *** Get width and height
        $this->width  = imagesx($this->image);
        $this->height = imagesy($this->image);
    }

    ## --------------------------------------------------------

    private function openImage($file)
    {
        // *** Get extension
        $extension = strtolower(strrchr($file, '.'));

        switch($extension)
        {
            case '.jpg':
            case '.jpeg':
                $img = @imagecreatefromjpeg($file);
                break;
            case '.gif':
                $img = @imagecreatefromgif($file);
                break;
            case '.png':
                $img = @imagecreatefrompng($file);
                break;
            default:
                $img = false;
                break;
        }
        return $img;
    }

    ## --------------------------------------------------------

    public function resizeImage($newWidth, $newHeight, $option="auto")
    {
        // *** Get optimal width and height - based on $option
        $optionArray = $this->getDimensions($newWidth, $newHeight, $option);

        $optimalWidth  = $optionArray['optimalWidth'];
        $optimalHeight = $optionArray['optimalHeight'];


        // *** Resample - create image canvas of x, y size
        $this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
        imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);


        // *** if option is 'crop', then crop too
        if ($option == 'crop') {
            $this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
        }
    }

    ## --------------------------------------------------------

    private function getDimensions($newWidth, $newHeight, $option)
    {

       switch ($option)
        {
            case 'exact':
                $optimalWidth = $newWidth;
                $optimalHeight= $newHeight;
                break;
            case 'portrait':
                $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                $optimalHeight= $newHeight;
                break;
            case 'landscape':
                $optimalWidth = $newWidth;
                $optimalHeight= $this->getSizeByFixedWidth($newWidth);
                break;
            case 'auto':
                $optionArray = $this->getSizeByAuto($newWidth, $newHeight);
                $optimalWidth = $optionArray['optimalWidth'];
                $optimalHeight = $optionArray['optimalHeight'];
                break;
            case 'crop':
                $optionArray = $this->getOptimalCrop($newWidth, $newHeight);
                $optimalWidth = $optionArray['optimalWidth'];
                $optimalHeight = $optionArray['optimalHeight'];
                break;
        }
        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    ## --------------------------------------------------------

    private function getSizeByFixedHeight($newHeight)
    {
        $ratio = $this->width / $this->height;
        $newWidth = $newHeight * $ratio;
        return $newWidth;
    }

    private function getSizeByFixedWidth($newWidth)
    {
        $ratio = $this->height / $this->width;
        $newHeight = $newWidth * $ratio;
        return $newHeight;
    }

    private function getSizeByAuto($newWidth, $newHeight)
    {
        if ($this->height < $this->width)
        // *** Image to be resized is wider (landscape)
        {
            $optimalWidth = $newWidth;
            $optimalHeight= $this->getSizeByFixedWidth($newWidth);
        }
        elseif ($this->height > $this->width)
        // *** Image to be resized is taller (portrait)
        {
            $optimalWidth = $this->getSizeByFixedHeight($newHeight);
            $optimalHeight= $newHeight;
        }
        else
        // *** Image to be resizerd is a square
        {
            if ($newHeight < $newWidth) {
                $optimalWidth = $newWidth;
                $optimalHeight= $this->getSizeByFixedWidth($newWidth);
            } else if ($newHeight > $newWidth) {
                $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                $optimalHeight= $newHeight;
            } else {
                // *** Sqaure being resized to a square
                $optimalWidth = $newWidth;
                $optimalHeight= $newHeight;
            }
        }

        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    ## --------------------------------------------------------

    private function getOptimalCrop($newWidth, $newHeight)
    {

        $heightRatio = $this->height / $newHeight;
        $widthRatio  = $this->width /  $newWidth;

        if ($heightRatio < $widthRatio) {
            $optimalRatio = $heightRatio;
        } else {
            $optimalRatio = $widthRatio;
        }

        $optimalHeight = $this->height / $optimalRatio;
        $optimalWidth  = $this->width  / $optimalRatio;

        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    ## --------------------------------------------------------

    private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight)
    {
        // *** Find center - this will be used for the crop
        $cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
        $cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );

        $crop = $this->imageResized;
        //imagedestroy($this->imageResized);

        // *** Now crop from center to exact requested size
        $this->imageResized = imagecreatetruecolor($newWidth , $newHeight);
        imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
    }

    ## --------------------------------------------------------

    public function saveImage($savePath, $imageQuality="100")
    {
        // *** Get extension
        $extension = strrchr($savePath, '.');
           $extension = strtolower($extension);

        switch($extension)
        {
            case '.jpg':
            case '.jpeg':
                if (imagetypes() & IMG_JPG) {
                    imagejpeg($this->imageResized, $savePath, $imageQuality);
                }
                break;

            case '.gif':
                if (imagetypes() & IMG_GIF) {
                    imagegif($this->imageResized, $savePath);
                }
                break;

            case '.png':
                // *** Scale quality from 0-100 to 0-9
                $scaleQuality = round(($imageQuality/100) * 9);

                // *** Invert quality setting as 0 is best, not 9
                $invertScaleQuality = 9 - $scaleQuality;

                if (imagetypes() & IMG_PNG) {
                     imagepng($this->imageResized, $savePath, $invertScaleQuality);
                }
                break;

            // ... etc

            default:
                // *** No extension - No save.
                break;
        }

        imagedestroy($this->imageResized);
    }


    ## --------------------------------------------------------

}


?>