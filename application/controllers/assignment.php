<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Assignment extends CI_Controller
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
        //execute if there is admin login..
        if(substr($username,0,5) == "admin")
        {
			if($this->input->post('insert-btn'))
			{

			}
			else if($this->input->post('update-btn'))
			{

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
		        $data['page'] = "assignment";
		        $this->load->view('template',$data);
			}
        }
	}

}
?>