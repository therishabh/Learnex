<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Notification extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent :: __construct();
	}

	function admin_news_notification()
	{
		$username = $this->session->userdata('username');
		$this->load->model('user_model');
		$news_details = $this->user_model->admin_news_notification($username);
		if($news_details)
		{
			$user_detail = $this->user_model->get_user_details($username,'admin');
			$i = 0;
			$a = 0;
			foreach ($news_details as $news) {
				//check if staff already read news..
				if($user_detail['news'] != "")
				{
					$check_news_id = "*".$news['id']."*";
					//check if staff already read news..
					if (strpos($user_detail['news'],$check_news_id) !== false) {
						
					}
					//check if staff not read news.
					else
					{
						$i++;
					}	
				}
				else
				{
					$a++;
				 	$i++;
				}
			// $a++;		
			}//end foreach.
			echo $i;
		}
		else
		{
			echo "0";
		}
	}
	
	function staff_news_notification()
	{
		$username = $this->session->userdata('username');
		$this->load->model('user_model');
		$news_details = $this->user_model->staff_news_notification($username);
		if($news_details)
		{
			$user_detail = $this->user_model->get_user_details($username,'staff');
			$i = 0;
			foreach ($news_details as $news) {
				$check_news_id = "*".$news['id']."*";
				if($user_detail['news'] != "")
				{
					//check if staff already read news..
					if (strpos($user_detail['news'],$check_news_id) !== false) {
						
					}
					//check if staff not read news.
					else
					{
						$i++;
					}		
				}
				//if there is no news read by staff then execute code.
				else
				{
					$i++;
				}
			}//end foreach.
			echo $i;
		}
		else
		{
			echo "0";
		}
	}

	function student_news_notification()
	{
		$username = $this->session->userdata('username');
		$this->load->model('user_model');
		$news_details = $this->user_model->student_news_notification($username);
		if($news_details)
		{
			$user_detail = $this->user_model->get_user_details($username,'student');
			$i = 0;
			foreach ($news_details as $news) {
				$check_news_id = "*".$news['id']."*";
				if($user_detail['news'] != "")
				{
					//check if staff already read news..
					if (strpos($user_detail['news'],$check_news_id) !== false) {
						
					}
					//check if staff not read news.
					else
					{
						$i++;
					}		
				}
				//if there is no news read by staff then execute code.
				else
				{
					$i++;
				}
			}//end foreach.
			echo $i;
		}
		else
		{
			echo "0";
		}
	}
}

?>