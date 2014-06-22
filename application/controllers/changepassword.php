<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Changepassword extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent :: __construct();
	}

	function index()
	{
		$this->load->model('user_model');

		//get username from session..
		$username = $this->session->userdata('username');

		if($this->session->userdata('username'))
		{
			if($this->input->post('submit-btn'))
			{
				$old_password = $this->input->post('oldpassword');	
				$new_password = $this->input->post('newpassword');	
				$con_password = $this->input->post('conpassword');
				$username = $this->session->userdata('username');
				if(substr($username,0,5) == "admin")
				{
					$data['user_detail'] = $this->user_model->get_user_details($username,'admin');

					if(md5($old_password) == $data['user_detail']['password'])
					{

						$id = $data['user_detail']['id'];
						$update_data['change_pass_status'] = 0;
						date_default_timezone_set('Asia/Calcutta');
						$update_data['change_pass_time'] = date("y-m-d H:i:s");
						$update_data['password'] = md5($new_password);
						$query = $this->user_model->updatedata($update_data,$id,'admin');
						if($query)
						{
							//view dashboard and pass $data array..
							$data['page'] = "dashboard";
							$this->load->view('template',$data);
						}
					}
					else
					{
						$data['error'] = "Success";
						$this->load->view("changepassword",$data);
					}
				}
				else if(substr($username,0,5) == "staff")
				{
					$data['user_detail'] = $this->user_model->get_user_details($username,'staff');

					if(md5($old_password) == $data['user_detail']['password'])
					{

						$id = $data['user_detail']['id'];
						$update_data['change_pass_status'] = 0;
						date_default_timezone_set('Asia/Calcutta');
						$update_data['change_pass_time'] = date("y-m-d H:i:s");
						$update_data['password'] = md5($new_password);
						$query = $this->user_model->updatedata($update_data,$id,'staff');
						if($query)
						{
							//view dashboard and pass $data array..
							$data['page'] = "dashboard";
							$this->load->view('template',$data);
						}
					}
					else
					{
						$data['error'] = "Success";
						$this->load->view("changepassword",$data);
					}
				}
				else if(substr($username,0,5) == "stude")
				{
					$data['user_detail'] = $this->user_model->get_user_details($username,'student');

					if(md5($old_password) == $data['user_detail']['password'])
					{

						$id = $data['user_detail']['id'];
						$update_data['change_pass_status'] = 0;
						date_default_timezone_set('Asia/Calcutta');
						$update_data['change_pass_time'] = date("y-m-d H:i:s");
						$update_data['password'] = md5($new_password);
						$query = $this->user_model->updatedata($update_data,$id,'student');
						if($query)
						{
							//view dashboard and pass $data array..
							$data['page'] = "dashboard";
							$this->load->view('template',$data);
						}
					}
					else
					{
						$data['error'] = "Success";
						$this->load->view("changepassword",$data);
					}
				}
			}
			else
			{
				$username = $this->session->userdata('username');
				if(substr($username,0,5) == "admin")
				{
					$user_detail = $this->user_model->get_user_details($username,'admin');
				}
				elseif(substr($username,0,5) == "staff")
				{
					$user_detail = $this->user_model->get_user_details($username,'staff');
				}
				elseif(substr($username,0,5) == "stude")
				{
					$user_detail = $this->user_model->get_user_details($username,'student');
				}

				//execute if login user status is true..
				if($user_detail['status'] == 1)
				{
					if($user_detail['change_pass_status'] == 1)
					{
						$this->load->view("changepassword");
					}
					else
					{
						 redirect('/home/', 'refresh');
					}
				}
				//execute if login user status is false...
				else
				{
					$this->session->sess_destroy('username');
					redirect('home', 'refresh');
				}
				
			}
		}
		else
		{
			redirect('/home/', 'refresh');
		}
		
	}
}
?>