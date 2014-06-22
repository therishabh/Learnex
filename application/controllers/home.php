<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Home extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent :: __construct();
	}

	function index()
	{
		// check login if session is isset or not
		//execute if session is set that means user is already login.
		if( $this->session->userdata('username') )
		{
			$this->load->model('user_model');
			//get username from session..
			$username = $this->session->userdata('username');

			//execute when login user is admin...
			if(substr($username,0,5) == "admin")
			{
				//fetch userdetails form database of that user..
				$data['user_detail'] = $this->user_model->get_user_details($username,'admin');
			}
			//execute when login user is admin...
			elseif(substr($username,0,5) == "staff")
			{
				//fetch userdetails form database of that user..
				$data['user_detail'] = $this->user_model->get_user_details($username,'staff');
			}
			//execute when login user is admin...
			elseif(substr($username,0,5) == "stude")
			{
				//fetch userdetails form database of that user..
				$data['user_detail'] = $this->user_model->get_user_details($username,'student');
			}

			$data['organization_detail'] = $this->user_model->get_organization_details();
			$data['title'] = "Hello ";
			
			
			//view dashboard and pass $data array..
			$data['page'] = "dashboard";
			$this->load->view('template',$data);
			
		}
		//execute when session is not set and click on login button
		else if( $this->input->post('submit_btn') )
		{
			$this->load->library('form_validation');
			$this->load->model('user_model');

			$this->form_validation->set_rules('username',"Username",'required|trim');
			$this->form_validation->set_rules('password','Password','required');
			if( $this->form_validation->run() == FALSE )
			{
				$data['error'] = "Please Enter Username and Password !";
				$this->load->view('login',$data);
			}
			else
			{
				//get username and paassword from form..
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				//execute when login user is admin...
				if(substr($username,0,5) == "admin")
				{
					//check login authontication..
					$check_login = $this->user_model->check_login($username,$password,'admin');

					//check if check_login is true..
					if($check_login)
					{
						
						//fetch $username details from database..
						$data['user_detail'] = $this->user_model->get_user_details($username,'admin');
						
						//execute if user is exist into database..
						if($data['user_detail'])
						{
							$this->session->set_userdata('username',$username);
							//display dashboard and pass user details..
							//
							//view dashboard and pass $data array..
							$data['page'] = "dashboard";
							$this->load->view('template',$data);
							
						}
					}
					else
					{
						$data['error'] = "Enter Correct Username and Password !";
						$this->load->view('login',$data);
					}
				}
				//execute when login user is staff...
				else if(substr($username,0,5) == "staff")
				{
					//check login authontication..
					$check_login = $this->user_model->check_login($username,$password,'staff');

					//check if check_login is true..
					if($check_login)
					{
						//fetch $username details from database..
						$data['user_detail'] = $this->user_model->get_user_details($username,'staff');
						
						//execute if user is exist into database..
						if($data['user_detail'])
						{
							$this->session->set_userdata('username',$username);
							
							//view dashboard and pass $data array..
							$data['page'] = "dashboard";
							$this->load->view('template',$data);
							
						}
					}
					else
					{
						$data['error'] = "Enter Correct Username and Password !";
						$this->load->view('login',$data);
					}
				}
				//execute when login user is student...
				else if(substr($username,0,5) == "stude")
				{
					//check login authontication..
					$check_login = $this->user_model->check_login($username,$password,'student');

					//check if check_login is true..
					if($check_login)
					{
						
						//fetch $username details from database..
						$data['user_detail'] = $this->user_model->get_user_details($username,'student');
						$data['organization_detail'] = $this->user_model->get_organization_details();
						
						//execute if user is exist into database..
						if($data['user_detail'])
						{
							$this->session->set_userdata('username',$username);
							//view dashboard and pass $data array..
							$data['page'] = "dashboard";
							$this->load->view('template',$data);
							
						}
					}
					else
					{
						$data['error'] = "Enter Correct Username and Password !";
						$this->load->view('login',$data);
					}
				}
				//execute if login user is fake..
				else
				{
					$data['title'] = "LearnEx Login";
					$this->load->view('login',$data);
				}

			}
		}
		else
		{
			$data['title'] = "LearnEx Login";
			$this->load->view('login',$data);
		}
			
	}//end index function.
	
}

?>