<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class News extends CI_Controller
{

	function __construct()
	{
	parent::__construct();
	}

	function index()
	{
		//load user model..
	    $this->load->model('user_model');
	    $this->load->model('manage_course');
	    //get username from session..
    	$username = $this->session->userdata('username');
    	// if login user is admin..
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
	    	if( $this->input->post('insert_btn') )
			{
				$insert_data['code'] = $this->user_model->generateRandomString(5);
				$insert_data['create_user'] = $username;
				if( !empty($_FILES['image']['name']) )
				{
					//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
					$config['upload_path'] = './uploads/news/';
					//set logo default name..
					$config['file_name'] = $insert_data['code'];
					
					//load the upload library
					$this->load->library('upload', $config);

					$config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|doc|docx';

			   		$this->upload->set_allowed_types('*');
			    
					$this->upload->initialize($config);

					//if not successful, set the error message
					if ($this->upload->do_upload('image')) 
					{
						$logo_data = $this->upload->data();
					}
					print_r($this->upload->data());
					print_r($this->upload->display_errors());

					$insert_data['attachment'] = $logo_data['file_name'];
				}
				//if there is no any file selected..
				else
				{
					$insert_data['attachment'] = "";
				}

				$insert_data['news_title'] = $this->input->post('news_title'); 
				$insert_data['description'] = $this->input->post('news_desc');
				$insert_data['news_type'] = $this->input->post('news_type');
				$publish_date = str_replace('/', "-", $this->input->post('publish_date'));
				$insert_data['publish_time'] = date('Y-m-d',strtotime($publish_date))." 00:00:01";
				date_default_timezone_set('Asia/Calcutta');
				$insert_data['create_date'] = date("y-m-d H:i:s");

				if($this->input->post('share_with') == "all")
				{
					$insert_data['share_with'] = "all";
					$insert_data['custome_share'] = "";
				}
				elseif($this->input->post('share_with') == "custome")
				{
					$insert_data['share_with'] = "custome";
					$insert_data['custome_share'] = implode(',',$this->input->post('share_custome'));
				}

				$query = $this->user_model->insertdata($insert_data,'news');
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('insert_news',"success");
					header("Location: " . $_SERVER['REQUEST_URI']);
				}

			}
			else if( $this->input->post('update_btn') )
			{
				$insert_data['code'] = $this->user_model->generateRandomString(5);
				//if image is not empty
				if($this->input->post('default_image') != "")
				{
					//if image does not changed..
					if( $this->input->post('default_image') == "default")
					{
						$insert_data['attachment'] = $this->input->post('old_image');
					}
					//if image changed..
					else
					{
						//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
						$config['upload_path'] = './uploads/news/';

						//set logo default name..
						$config['file_name'] = $insert_data['code'];

						// set the filter image types
						$config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|doc|docx';
						
						//load the upload library
						$this->load->library('upload', $config);

				   		$this->upload->set_allowed_types('*');
				    
						$this->upload->initialize($config);

						//if not successful, set the error message
						if ($this->upload->do_upload('image')) 
						{
							$logo_data = $this->upload->data();
						}

						$insert_data['attachment'] = $logo_data['file_name'];
						
					}
				}
				else
				{
					$insert_data['attachment'] = ""; 
				}

				$news_id = $this->input->post('news_id');
				$insert_data['news_title'] = $this->input->post('news_title'); 
				$insert_data['description'] = $this->input->post('news_desc');
				$insert_data['news_type'] = $this->input->post('news_type');
				$publish_date = str_replace('/', "-", $this->input->post('publish_date'));
				$insert_data['publish_time'] = date('Y-m-d',strtotime($publish_date))." 00:00:01";
				date_default_timezone_set('Asia/Calcutta');
				$insert_data['modify_date'] = date("y-m-d H:i:s");

				if($this->input->post('share_with') == "all")
				{
					$insert_data['share_with'] = "all";
					$insert_data['custome_share'] = "";
				}
				elseif($this->input->post('share_with') == "custome")
				{
					$insert_data['share_with'] = "custome";
					$insert_data['custome_share'] = implode(',',$this->input->post('share_custome'));
				}

				$query = $this->user_model->updatedata($insert_data,$news_id,'news');
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('update_news',$news_id);
					header("Location: " . $_SERVER['REQUEST_URI']);
				}

			}
			else
			{
		    	//fetch userdetails from database of that user..
				$data['organization_detail'] = $this->user_model->get_organization_details();
				$data['user_detail'] = $this->user_model->get_user_details($username,'admin');
				
				//fetch staff details from database..
				$news_detail = $this->user_model->fetchalldatadesc('news');
				$data['news_detail'] = $news_detail[0];
				$data['no_of_news'] = $news_detail[1];

				$news_unread = $this->user_model->admin_unread_news($username);
				$data['news_unread'] = array();
				if($news_unread)
				{
					foreach ($news_unread as $key) {
						array_push($data['news_unread'], $key['id']);
					}
				}

				$data['news_type_list'] = $this->user_model->fetch_news_type();

				$data['page'] = "news";
				$this->load->view('template',$data);
			}
		}
        //if login user is a Staff..
        elseif(substr($username,0,5) == "staff")
        {
        	if( $this->input->post('insert_btn') )
			{
				$insert_data['code'] = $this->user_model->generateRandomString(5);
				$insert_data['create_user'] = $username;
				if( !empty($_FILES['image']['name']) )
				{
					//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
					$config['upload_path'] = './uploads/news/';
					//set logo default name..
					$config['file_name'] = $insert_data['code'];
					
					//load the upload library
					$this->load->library('upload', $config);

					$config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|doc|docx';

			   		$this->upload->set_allowed_types('*');
			    
					$this->upload->initialize($config);

					//if not successful, set the error message
					if ($this->upload->do_upload('image')) 
					{
						$logo_data = $this->upload->data();
					}
					print_r($this->upload->data());
					print_r($this->upload->display_errors());

					$insert_data['attachment'] = $logo_data['file_name'];
				}
				//if there is no any file selected..
				else
				{
					$insert_data['attachment'] = "";
				}
				date_default_timezone_set('Asia/Calcutta');
				$insert_data['news_title'] = $this->input->post('news_title'); 
				$insert_data['description'] = $this->input->post('news_desc');
				$insert_data['news_type'] = $this->input->post('news_type');
				$publish_date = str_replace('/', "-", $this->input->post('publish_date'));
				$insert_data['publish_time'] = date('Y-m-d',strtotime($publish_date))." 00:00:01";
				$insert_data['active'] = '0';
				$insert_data['create_date'] = date("y-m-d H:i:s");

				if($this->input->post('share_with') == "all")
				{
					$insert_data['share_with'] = "all";
					$insert_data['custome_share'] = "";
				}
				elseif($this->input->post('share_with') == "custome")
				{
					$insert_data['share_with'] = "custome";
					$insert_data['custome_share'] = implode(',',$this->input->post('share_custome'));
				}

				$query = $this->user_model->insertdata($insert_data,'news');
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('insert_news',"success");
					header("Location: " . $_SERVER['REQUEST_URI']);
				}

			}
			else if( $this->input->post('update_btn') )
			{
				$insert_data['code'] = $this->user_model->generateRandomString(5);
				//if image is not empty
				if($this->input->post('default_image') != "")
				{
					//if image does not changed..
					if( $this->input->post('default_image') == "default")
					{
						$insert_data['attachment'] = $this->input->post('old_image');
					}
					//if image changed..
					else
					{
						//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
						$config['upload_path'] = './uploads/news/';

						//set logo default name..
						$config['file_name'] = $insert_data['code'];

						// set the filter image types
						$config['allowed_types'] = 'gif|jpg|png|pdf|jpeg|doc|docx';
						
						//load the upload library
						$this->load->library('upload', $config);

				   		$this->upload->set_allowed_types('*');
				    
						$this->upload->initialize($config);

						//if not successful, set the error message
						if ($this->upload->do_upload('image')) 
						{
							$logo_data = $this->upload->data();
						}

						$insert_data['attachment'] = $logo_data['file_name'];
						
					}
				}
				else
				{
					$insert_data['attachment'] = ""; 
				}

				$news_id = $this->input->post('news_id');
				$insert_data['news_title'] = $this->input->post('news_title'); 
				$insert_data['description'] = $this->input->post('news_desc');
				$insert_data['news_type'] = $this->input->post('news_type');
				$publish_date = str_replace('/', "-", $this->input->post('publish_date'));
				$insert_data['publish_time'] = date('Y-m-d',strtotime($publish_date))." 00:00:01";
				date_default_timezone_set('Asia/Calcutta');
				$insert_data['modify_date'] = date("y-m-d H:i:s");
				$insert_data['active'] = '0';

				if($this->input->post('share_with') == "all")
				{
					$insert_data['share_with'] = "all";
					$insert_data['custome_share'] = "";
				}
				elseif($this->input->post('share_with') == "custome")
				{
					$insert_data['share_with'] = "custome";
					$insert_data['custome_share'] = implode(',',$this->input->post('share_custome'));
				}

				$query = $this->user_model->updatedata($insert_data,$news_id,'news');
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('update_news',$news_id);
					header("Location: " . $_SERVER['REQUEST_URI']);
				}
			}
			else
			{
        		//fetch userdetails from database of that user..
				$data['organization_detail'] = $this->user_model->get_organization_details();
				$data['user_detail'] = $this->user_model->get_user_details($username,'staff');
				
				//fetch staff details from database..
				$news_detail = $this->user_model->fetch_staff_news($username);
				$data['news_detail'] = $news_detail[0];
				$data['no_of_news'] = $news_detail[1];

				$news_unread = $this->user_model->staff_unread_news($username);
				$data['news_unread'] = array();
				foreach ($news_unread as $key) {
					array_push($data['news_unread'], $key['id']);
				}

				$data['news_type_list'] = $this->user_model->fetch_news_type();

				$data['page'] = "news-staff";
				$this->load->view('template',$data);
			}

        }
        //if login user is a Staff..
        elseif(substr($username,0,5) == "stude")
        {
        	//fetch userdetails from database of that user..
			$data['organization_detail'] = $this->user_model->get_organization_details();
			$data['user_detail'] = $this->user_model->get_user_details($username,'student');
			
			//fetch staff details from database..
			$news_detail = $this->user_model->fetch_student_news();
			$data['news_detail'] = $news_detail[0];
			$data['no_of_news'] = $news_detail[1];

			$news_unread = $this->user_model->student_unread_news($username);
			$data['news_unread'] = array();
			foreach ($news_unread as $key) {
				array_push($data['news_unread'], $key['id']);
			}

			$data['news_type_list'] = $this->user_model->fetch_news_type();

			$data['page'] = "news-student";
			$this->load->view('template',$data);
        }
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }

	}

	function view_news(){
		$username = $this->session->userdata('username');
        // if login user is not admin..
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
			$news_id = $_POST['news_id'];
			$this->load->model('user_model');
			$news_detail = $this->user_model->fetchbyid($news_id,'news');
			$news_type_id = $news_detail['news_type'];
			$news_type_detail = $this->user_model->fetchbyid($news_type_id,'news_type');
			$news_type = $news_type_detail['name'];
			?>
			<div class="row display-full-news">
				<div class="col-lg-12">
					
					<div class="row">
						<div class="col-lg-3 label-heading">
							News Title :
						</div>
						<div class="col-lg-8">
							<?php echo $news_detail['news_title'] ?>
						</div>
					</div>

					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							News Type :
						</div>
						<div class="col-lg-8">
							<?php echo $news_type; ?>
						</div>
					</div>

					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							Description :
						</div>
						<div class="col-lg-8">
							<?php echo $news_detail['description'] ?>
						</div>
					</div>
					
					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							Create Date :
						</div>
						<div class="col-lg-8">
							<?php echo date('M j, Y',strtotime($news_detail['create_date'])); ?>
						</div>
					</div>

					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							Publish Date :
						</div>
						<div class="col-lg-8">
							<?php echo date('M j, Y',strtotime($news_detail['publish_time'])); ?>
						</div>
					</div>

					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							Share With :
						</div>
						<div class="col-lg-8">
							<?php 
							if($news_detail['share_with'] == "all")
							{
								echo "All";
							}
							elseif($news_detail['share_with'] == "custome")
							{
								echo ucwords(str_replace(",",", ",$news_detail['custome_share']));
							}
							 ?>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							Publish By :
						</div>
						<div class="col-lg-8">
							<?php 
							if(substr($news_detail['create_user'],0,5) == "admin")
							{
								$publish_user_username = $news_detail['create_user'];
								$user_detail =  $this->user_model->get_user_details($publish_user_username,'admin');
								echo $user_detail['name']." (".$user_detail['username'].")";
							}
							elseif(substr($news_detail['create_user'],0,5) == "staff")
							{
								$publish_user_username = $news_detail['create_user'];
								$user_detail =  $this->user_model->get_user_details($publish_user_username,'staff');
								echo $user_detail['name']." (".$user_detail['username'].")";
							}
							 ?>
						</div>
					</div>
					
					<?php
					if($news_detail['attachment'] != "")
					{
						?>
							<div class="row" style="margin-top:10px;">
								<div class="col-lg-3 label-heading">
									Attachment :
								</div>
								<div class="col-lg-8 attachment">
									<?php
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "jpg")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/image.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "jepg")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/image.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "png")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/image.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "gif")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/image.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "pdf")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/pdf.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "doc")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/word.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "docx")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/word.png" alt="">
									</a>
									<?php
									}
									 ?>
									
								</div>
							</div>					
						<?php
					} 
					?>

					<div class="active-status" style="display:none;"><?php echo $news_detail['active']; ?></div>

				</div>
			</div>
			<?php
		}
        //execute if login user is staff..
		else if( substr($username,0,5) == "staff" )
		{
			$news_id = $_POST['news_id'];
			$this->load->model('user_model');
			$news_detail = $this->user_model->fetchbyid($news_id,'news');
			$news_type_id = $news_detail['news_type'];
			$news_type_detail = $this->user_model->fetchbyid($news_type_id,'news_type');
			$news_type = $news_type_detail['name'];
			?>
			<div class="row display-full-news">
				<div class="col-lg-12">
					
					<div class="row">
						<div class="col-lg-3 label-heading">
							News Title :
						</div>
						<div class="col-lg-8">
							<?php echo $news_detail['news_title'] ?>
						</div>
					</div>

					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							News Type :
						</div>
						<div class="col-lg-8">
							<?php echo $news_type; ?>
						</div>
					</div>

					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							Description :
						</div>
						<div class="col-lg-8">
							<?php echo $news_detail['description'] ?>
						</div>
					</div>
					<?php
					//execute if created user is equal to login user..
					if($news_detail['create_user'] == $this->session->userdata('username'))
					{
					?>
					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							Create Date :
						</div>
						<div class="col-lg-8">
							<?php echo date('M j, Y',strtotime($news_detail['create_date'])); ?>
						</div>
					</div>
					
					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							Publish Date :
						</div>
						<div class="col-lg-8">
							<?php echo date('M j, Y',strtotime($news_detail['publish_time'])); ?>
						</div>
					</div>

					<?php
					}
					?>
					
					<?php
					//execute if created user is equal to login user..
					if($news_detail['create_user'] == $this->session->userdata('username'))
					{
					?>
					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							Share With :
						</div>
						<div class="col-lg-8">
							<?php 
							if($news_detail['share_with'] == "all")
							{
								echo "All";
							}
							elseif($news_detail['share_with'] == "custome")
							{
								echo ucwords(str_replace(",",", ",$news_detail['custome_share']));
							}
							 ?>
						</div>
					</div>
					<?php
					}
					?>


					
					<?php
					if($news_detail['attachment'] != "")
					{
						?>
							<div class="row" style="margin-top:10px;">
								<div class="col-lg-3 label-heading">
									Attachment :
								</div>
								<div class="col-lg-8 attachment">
									<?php
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "jpg")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/image.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "jepg")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/image.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "png")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/image.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "gif")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/image.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "pdf")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/pdf.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "doc")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/word.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "docx")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/word.png" alt="">
									</a>
									<?php
									}
									 ?>
									
								</div>
							</div>					
						<?php
					} 
					?>

					<div class="active_status" style="display:none;"><?php echo $news_detail['active']; ?></div>
					<div class="news_create_user" style="display:none;"><?php echo $news_detail['create_user']; ?></div>
					<div class="login_username" style="display:none;"><?php echo $this->session->userdata('username'); ?></div>
					
				</div>
			</div>
			<?php
		}
		 //execute if login user is student..
		else if( substr($username,0,5) == "stude" )
		{
			$news_id = $_POST['news_id'];
			$this->load->model('user_model');
			$news_detail = $this->user_model->fetchbyid($news_id,'news');
			$news_type_id = $news_detail['news_type'];
			$news_type_detail = $this->user_model->fetchbyid($news_type_id,'news_type');
			$news_type = $news_type_detail['name'];
			?>
			<div class="row display-full-news">
				<div class="col-lg-12">
					
					<div class="row">
						<div class="col-lg-3 label-heading">
							News Title :
						</div>
						<div class="col-lg-8">
							<?php echo $news_detail['news_title'] ?>
						</div>
					</div>

					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							News Type :
						</div>
						<div class="col-lg-8">
							<?php echo $news_type; ?>
						</div>
					</div>

					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							Description :
						</div>
						<div class="col-lg-8">
							<?php echo $news_detail['description'] ?>
						</div>
					</div>
					
					
					<div class="row" style="margin-top:10px;">
						<div class="col-lg-3 label-heading">
							Publish Date :
						</div>
						<div class="col-lg-8">
							<?php echo date('M j, Y',strtotime($news_detail['publish_time'])); ?>
						</div>
					</div>
					
					<?php
					if($news_detail['attachment'] != "")
					{
						?>
							<div class="row" style="margin-top:10px;">
								<div class="col-lg-3 label-heading">
									Attachment :
								</div>
								<div class="col-lg-8 attachment">
									<?php
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "jpg")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/image.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "jepg")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/image.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "png")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/image.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "gif")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/image.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "pdf")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/pdf.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "doc")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/word.png" alt="">
									</a>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "docx")
									{
									?>
									<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
										<img src="<?php echo base_url(); ?>img/word.png" alt="">
									</a>
									<?php
									}
									 ?>
									
								</div>
							</div>					
						<?php
					} 
					?>
				</div>
			</div>
			<?php
		}
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }
        

	}

	function inactive_news()
	{
		$username = $this->session->userdata('username');
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
			$news_id = $_POST['news_id'];
			$this->load->model('user_model');
			$data['active'] = "0";
			$this->user_model->updatedata($data,$news_id,'news');
		}
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }
	}
	
	function active_news()
	{
		$username = $this->session->userdata('username');
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
			$this->load->model('user_model');
			$news_id = $_POST['news_id'];
			$data['active'] = "1";
			$this->user_model->updatedata($data,$news_id,'news');
		}
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }
	}

	function edit_news()
	{
		$username = $this->session->userdata('username');
		$this->load->model('user_model');
        //if login user is not admin..
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
			$this->load->model('user_model');
			$news_id = $_POST['news_id'];
			$news_detail = $this->user_model->fetchbyid($news_id,'news');
		?>
			<div class="row">
				<div class="col-lg-10 col-centered">
					<div class="row">
						<div class="col-lg-4">
							<div class="label-text">News Title</div>
						</div>
						<div class="col-lg-8">
							<div><input type="text" value="<?php echo $news_detail['news_title']; ?>" class="form-control" id="news_title" name="news_title"></div>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-lg-4">
							<div class="label-text">News Desc.</div>
						</div>
						<div class="col-lg-8">
							<div><textarea name="news_desc" id="news_desc" rows="5" class="form-control"><?php echo $news_detail['description']; ?></textarea></div>
						</div>
					</div>
					<div class="row news-type-div" style="margin-top:10px;" style="position:relative;">
						<div class="col-lg-4">
							<div class="label-text">News Type</div>
						</div>
						<div class="col-lg-8">
							<div>
								<select name="news_type" id="news-type" class="form-control">
									<option value="">Select News Type</option>
									<?php
									$news_type_list = $this->user_model->fetch_news_type();
									foreach($news_type_list as $news)
									{
										if($news_detail['news_type'] == $news['id'])
										{
											echo '<option selected value="'.$news['id'].'">'.$news['name'].'</option>';
										}
										else
										{
											echo '<option value="'.$news['id'].'">'.$news['name'].'</option>';
										}

									}
									?>
								</select>
							</div>
						</div>
						<div class="news-type-edit">
							<img src="<?php echo base_url()?>/img/edit-icon.png" alt="Edit News Type" data-toggle="modal" data-target="#myModal">
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-lg-4">
							<div class="label-text">Publish Date</div>
						</div>
						<div class="col-lg-8">
							<div>
								<?php
								date_default_timezone_set('Asia/Calcutta');
								$today_date = date("d/m/Y"); 
								 ?>
								<div class="form-group">
		                            <div class='input-group date' id='datetimepicker2' data-date-format="DD/MM/YYYY">
		                                <input type='text' class="form-control" name="publish_date" id="publish_date" value="<?php echo str_replace('-','/',$news_detail['publish_time']); ?>" />
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-calendar"></span>
		                                </span>
		                            </div>
		                        </div>
							</div>
						</div>
					</div>

					<div class="row" style="margin-top:10px;">
						<div class="col-lg-4">
							<div class="label-text">Share With</div>
						</div>
						<div class="col-lg-4">
							<div class="row">
								<div class="col-lg-3">All</div>
								<div class="col-lg-4">
									<label>
										<?php
										if($news_detail['share_with'] == "all")
										{
											?>
											<input type="radio" checked name="share_with"  value="all" id="share-all" class="radio">
											<div class="radio-img"></div>
											<?php
										}
										else
										{
											?>
											<input type="radio" name="share_with"  value="all" id="share-all" class="radio">
											<div class="radio-img"></div>
											<?php
										}
										 ?>
									</label>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="row">
								<div class="col-lg-5">Custome</div>
								<div class="col-lg-4">
									<label>
										<?php
										if($news_detail['share_with'] == "custome")
										{
											?>
											<input type="radio" checked name="share_with"  value="custome" id="share-custome" class="radio">
											<div class="radio-img"></div>
											<?php
										}
										else
										{
											?>
											<input type="radio" name="share_with"  value="custome" id="share-custome" class="radio">
											<div class="radio-img"></div>
											<?php
										}
										 ?>
									</label>
								</div>
							</div>
						</div>
					</div>
					
					<?php
					if($news_detail['share_with'] == "custome")
					{
					?>
						<div class="row share-person">
							<div class="col-lg-8 col-lg-offset-4">
								<div class="row">
									<div class="col-lg-6">
										<div style="text-align:center;">Staff</div>
										<div style="text-align:center;margin-top:2px;">
											<label>
												<?php
												//execute if admin is exist into custome_share string..
												if (strpos($news_detail['custome_share'],'staff') !== false) 
												{
												?>
													<input type="checkbox" checked class="checkbox share-checkbox" value="staff" name="share_custome[]">
													<div class="checkbox-img"></div>
												<?php
												}
												else
												{
												?>
													<input type="checkbox" class="checkbox share-checkbox" value="staff" name="share_custome[]">
													<div class="checkbox-img"></div>
												<?php
												}
												?>
												
											</label>
										</div>
									</div>
									<div class="col-lg-6">
										<div style="text-align:center;">Student</div>
										<div style="text-align:center;margin-top:2px;">
											<label>
												<?php
												//execute if admin is exist into custome_share string..
												if (strpos($news_detail['custome_share'],'student') !== false) 
												{
												?>
													<input type="checkbox" checked class="checkbox share-checkbox" value="student" name="share_custome[]">
													<div class="checkbox-img"></div>
												<?php
												}
												else
												{
												?>
													<input type="checkbox"  class="checkbox share-checkbox" value="student" name="share_custome[]">
													<div class="checkbox-img"></div>
												<?php
												}
												?>
												
											</label>
										</div>
									</div>
								</div>
							</div>	
						</div>
					<?php					
					}
					else
					{
					?>
						<div class="row share-person">
							<div class="col-lg-8 col-lg-offset-4">
								<div class="row">
									<div class="col-lg-6">
										<div style="text-align:center;">Staff</div>
										<div style="text-align:center;margin-top:2px;">
											<label>
												<input type="checkbox" class="checkbox share-checkbox" value="staff" name="share_custome[]">
												<div class="checkbox-img"></div>
											</label>
										</div>
									</div>
									<div class="col-lg-6">
										<div style="text-align:center;">Student</div>
										<div style="text-align:center;margin-top:2px;">
											<label>
												<input type="checkbox"  class="checkbox share-checkbox" value="student" name="share_custome[]">
												<div class="checkbox-img"></div>
											</label>
										</div>
									</div>
								</div>
							</div>	
						</div>
					<?php
					}
					?>


					<div class="row" style="margin-top:10px;">
						<div class="col-lg-4">
							<div class="label-text">Attachment</div>
						</div>
						<div class="col-lg-6 col-lg-offset-1 attachment-update">
							<?php
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "jpg")
									{
									?>
									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/image.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "jepg")
									{
									?>
									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/image.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "png")
									{
									?>

									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/image.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "gif")
									{
									?>
									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/image.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>

									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "pdf")
									{
									?>
									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/pdf.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "doc")
									{
									?>
									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/word.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "docx")
									{
									?>
									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/word.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>
									<?php
									}
									 ?>
							<label style="width:100%;" class="upload-attachment">
								<input type="file" style="display:none;" name="image" id="file">
								<div class="upload-file">Upload File</div>
							</label>
						</div>
					</div>

					<!-- save and cancle button -->
					<div class="row" style="margin-top:15px;">
						<div class="col-lg-3 col-lg-offset-3">
							<input type="hidden" name="update_btn" value="success">
							<input type="hidden" name="default_image" id="default_image" value="default">
							<input type="hidden" name="old_image" value="<?php echo $news_detail['attachment']; ?>">
							<input type="hidden" name="news_id" value="<?php echo $news_detail['id']; ?>">
							<div class="submit-btn form-submit-btn save-btn">Update</div>
						</div>
						<div class="col-lg-3">
							<div class="cancel-btn" id="reset">Cancle</div>
						</div>
					</div>
					<!-- //end save and cancle button -->

				</div>
			</div>
			<script type="text/javascript">
				$('#datetimepicker2').datetimepicker({
			        pickTime: false
			    });
				if( $('.radio').is(":checked") )
				{
					$(".radio:checked").next('.radio-img').css({
						background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -167px 0px'
					});
				}

				if( $('.checkbox').is(":checked") )
				{
					$(".checkbox:checked").next('.checkbox-img').css({
						background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 0px'
					});
				}

				//display logo image when select any logo..
				$(".news").on('change', '#file', function(event) {
					//execute if use select any image
					if($(this).val() != "")
					{
						$("#default_image").val("hello");
					}
					//execute if user has not select any image..
					else
					{
						$("#default_image").val("");
					}

				});

				//execute when click on cross button for remove attachment..
				$(".news").on('click', '.cross', function() {
					$("#file").val("");
					$(".cross").hide();
					$(".attachment-file").slideUp();
					$(".upload-attachment").slideDown();
					//this is for remove default logo image into update section..
					$("#default_image").val("");
				});



				$(".news").on('click', '.radio', function(event) {
					if( $(this).val() == "all" )
					{
						$(".share-person").slideUp();
					}
					else if( $(this).val() == "custome" )
					{
						$(".share-person").slideDown();
					}	
				});

				<?php


				if($news_detail['attachment'] != "")
				{
				?>
				$(".upload-attachment").hide();
				<?php
				}
				if($news_detail['share_with'] == "custome")
				{
					?>
					$(".share-person").show();
					<?php
				}
				else
				{
					?>
					$(".share-person").hide();
					<?php
				}
				?>
			</script>
			
		<?php
		}
        else if(substr($username,0,5) == "staff")
        {
			$this->load->model('user_model');
			$news_id = $_POST['news_id'];
			$news_detail = $this->user_model->fetchbyid($news_id,'news');
			?>
			<div class="row">
				<div class="col-lg-10 col-centered">
					<div class="row">
						<div class="col-lg-4">
							<div class="label-text">News Title</div>
						</div>
						<div class="col-lg-8">
							<div><input type="text" value="<?php echo $news_detail['news_title']; ?>" class="form-control" id="news_title" name="news_title"></div>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-lg-4">
							<div class="label-text">News Desc.</div>
						</div>
						<div class="col-lg-8">
							<div><textarea name="news_desc" id="news_desc" rows="5" class="form-control"><?php echo $news_detail['description']; ?></textarea></div>
						</div>
					</div>
					<div class="row news-type-div" style="margin-top:10px;" style="position:relative;">
						<div class="col-lg-4">
							<div class="label-text">News Type</div>
						</div>
						<div class="col-lg-8">
							<div>
								<select name="news_type" id="news-type" class="form-control">
									<option value="">Select News Type</option>
									<?php
									$news_type_list = $this->user_model->fetch_news_type();
									foreach($news_type_list as $news)
									{
										if($news_detail['news_type'] == $news['id'])
										{
											echo '<option selected value="'.$news['id'].'">'.$news['name'].'</option>';
										}
										else
										{
											echo '<option value="'.$news['id'].'">'.$news['name'].'</option>';
										}

									}
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-lg-4">
							<div class="label-text">Publish Date</div>
						</div>
						<div class="col-lg-8">
							<div>
								<?php
								date_default_timezone_set('Asia/Calcutta');
								$today_date = date("d/m/Y"); 
								 ?>
								<div class="form-group">
		                            <div class='input-group date' id='datetimepicker2' data-date-format="DD/MM/YYYY">
		                                <input type='text' class="form-control" name="publish_date" id="publish_date" value="<?php echo str_replace('-','/',$news_detail['publish_time']); ?>" />
		                                <span class="input-group-addon">
		                                    <span class="glyphicon glyphicon-calendar"></span>
		                                </span>
		                            </div>
		                        </div>
							</div>
						</div>
					</div>

					<div class="row" style="margin-top:10px;">
						<div class="col-lg-4">
							<div class="label-text">Share With</div>
						</div>
						<div class="col-lg-4">
							<div class="row">
								<div class="col-lg-3">All</div>
								<div class="col-lg-4">
									<label>
										<?php
										if($news_detail['share_with'] == "all")
										{
											?>
											<input type="radio" checked name="share_with"  value="all" id="share-all" class="radio">
											<div class="radio-img"></div>
											<?php
										}
										else
										{
											?>
											<input type="radio" name="share_with"  value="all" id="share-all" class="radio">
											<div class="radio-img"></div>
											<?php
										}
										 ?>
									</label>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="row">
								<div class="col-lg-5">Custome</div>
								<div class="col-lg-4">
									<label>
										<?php
										if($news_detail['share_with'] == "custome")
										{
											?>
											<input type="radio" checked name="share_with"  value="custome" id="share-custome" class="radio">
											<div class="radio-img"></div>
											<?php
										}
										else
										{
											?>
											<input type="radio" name="share_with"  value="custome" id="share-custome" class="radio">
											<div class="radio-img"></div>
											<?php
										}
										 ?>
									</label>
								</div>
							</div>
						</div>
					</div>
					
					<?php
					if($news_detail['share_with'] == "custome")
					{
					?>
						<div class="row share-person">
							<div class="col-lg-8 col-lg-offset-4">
								<div class="row">
									<div class="col-lg-6">
										<div style="text-align:center;">Staff</div>
										<div style="text-align:center;margin-top:2px;">
											<label>
												<?php
												//execute if admin is exist into custome_share string..
												if (strpos($news_detail['custome_share'],'staff') !== false) 
												{
												?>
													<input type="checkbox" checked class="checkbox share-checkbox" value="staff" name="share_custome[]">
													<div class="checkbox-img"></div>
												<?php
												}
												else
												{
												?>
													<input type="checkbox" class="checkbox share-checkbox" value="staff" name="share_custome[]">
													<div class="checkbox-img"></div>
												<?php
												}
												?>
												
											</label>
										</div>
									</div>
									<div class="col-lg-6">
										<div style="text-align:center;">Student</div>
										<div style="text-align:center;margin-top:2px;">
											<label>
												<?php
												//execute if admin is exist into custome_share string..
												if (strpos($news_detail['custome_share'],'student') !== false) 
												{
												?>
													<input type="checkbox" checked class="checkbox share-checkbox" value="student" name="share_custome[]">
													<div class="checkbox-img"></div>
												<?php
												}
												else
												{
												?>
													<input type="checkbox"  class="checkbox share-checkbox" value="student" name="share_custome[]">
													<div class="checkbox-img"></div>
												<?php
												}
												?>
												
											</label>
										</div>
									</div>
								</div>
							</div>	
						</div>
					<?php					
					}
					else
					{
					?>
						<div class="row share-person">
							<div class="col-lg-8 col-lg-offset-4">
								<div class="row">
									<div class="col-lg-6">
										<div style="text-align:center;">Staff</div>
										<div style="text-align:center;margin-top:2px;">
											<label>
												<input type="checkbox" class="checkbox share-checkbox" value="staff" name="share_custome[]">
												<div class="checkbox-img"></div>
											</label>
										</div>
									</div>
									<div class="col-lg-6">
										<div style="text-align:center;">Student</div>
										<div style="text-align:center;margin-top:2px;">
											<label>
												<input type="checkbox"  class="checkbox share-checkbox" value="student" name="share_custome[]">
												<div class="checkbox-img"></div>
											</label>
										</div>
									</div>
								</div>
							</div>	
						</div>
					<?php
					}
					?>


					<div class="row" style="margin-top:10px;">
						<div class="col-lg-4">
							<div class="label-text">Attachment</div>
						</div>
						<div class="col-lg-6 col-lg-offset-1 attachment-update">
							<?php
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "jpg")
									{
									?>
									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/image.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "jepg")
									{
									?>
									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/image.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "png")
									{
									?>

									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/image.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "gif")
									{
									?>
									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/image.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>

									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "pdf")
									{
									?>
									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/pdf.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "doc")
									{
									?>
									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/word.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>
									<?php
									}
									if(pathinfo($news_detail['attachment'], PATHINFO_EXTENSION) == "docx")
									{
									?>
									<div class="attachment-file">
										<a href="<?php echo base_url(); ?>uploads/news/<?php echo $news_detail['attachment']; ?>" target="_black">
											<img src="<?php echo base_url(); ?>img/word.png" alt="">
										</a>
										<div class="cross">
											<img src="<?php echo base_url();?>img/close.png" alt="">
										</div>
									</div>
									<?php
									}
									 ?>
							<label style="width:100%;" class="upload-attachment">
								<input type="file" style="display:none;" name="image" id="file">
								<div class="upload-file">Upload File</div>
							</label>
						</div>
					</div>

					<!-- save and cancle button -->
					<div class="row" style="margin-top:15px;">
						<div class="col-lg-3 col-lg-offset-3">
							<input type="hidden" name="update_btn" value="success">
							<input type="hidden" name="default_image" id="default_image" value="default">
							<input type="hidden" name="old_image" value="<?php echo $news_detail['attachment']; ?>">
							<input type="hidden" name="news_id" value="<?php echo $news_detail['id']; ?>">
							<div class="submit-btn form-submit-btn save-btn">Update</div>
						</div>
						<div class="col-lg-3">
							<div class="cancel-btn" id="reset">Cancle</div>
						</div>
					</div>
					<!-- //end save and cancle button -->

				</div>
			</div>
			<script type="text/javascript">
				$('#datetimepicker2').datetimepicker({
			        pickTime: false
			    });
				if( $('.radio').is(":checked") )
				{
					$(".radio:checked").next('.radio-img').css({
						background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -167px 0px'
					});
				}

				if( $('.checkbox').is(":checked") )
				{
					$(".checkbox:checked").next('.checkbox-img').css({
						background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 0px'
					});
				}

				//display logo image when select any logo..
				$(".news").on('change', '#file', function(event) {
					//execute if use select any image
					if($(this).val() != "")
					{
						$("#default_image").val("hello");
					}
					//execute if user has not select any image..
					else
					{
						$("#default_image").val("");
					}

				});

				//execute when click on cross button for remove attachment..
				$(".news").on('click', '.cross', function() {
					$("#file").val("");
					$(".cross").hide();
					$(".attachment-file").slideUp();
					$(".upload-attachment").slideDown();
					//this is for remove default logo image into update section..
					$("#default_image").val("");
				});



				$(".news").on('click', '.radio', function(event) {
					if( $(this).val() == "all" )
					{
						$(".share-person").slideUp();
					}
					else if( $(this).val() == "custome" )
					{
						$(".share-person").slideDown();
					}	
				});

				<?php


				if($news_detail['attachment'] != "")
				{
				?>
				$(".upload-attachment").hide();
				<?php
				}
				if($news_detail['share_with'] == "custome")
				{
					?>
					$(".share-person").show();
					<?php
				}
				else
				{
					?>
					$(".share-person").hide();
					<?php
				}
				?>
			</script>
			<?php
		}
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }
	}

	function search_news()
	{
		$username = $this->session->userdata('username');
		//if login user is admin..
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
			$title = $_POST['title'];
			$type = $_POST['type'];
			$status = $_POST['status'];
			$this->load->model('user_model');
			$news_detail = $this->user_model->search_news($title,$type,$status);
			$user_detail = $this->user_model->get_user_details($username,'admin');
			$news_unread_array = $this->user_model->admin_unread_news($username);

			$news_unread = array();
			foreach ($news_unread_array as $key) {
				array_push($news_unread, $key['id']);
			}
			if($news_detail)
			{
				$i=1;
				//execute when first time page load..
				foreach($news_detail as $news)
				{
					$news_type_id = $news['news_type'];
					$news_type_detail = $this->user_model->fetchbyid($news_type_id,'news_type');
					$news_type = $news_type_detail['name'];
					$description = character_limiter($news['description'],125);
					$news_title = character_limiter($news['news_title'],27);
				?>
				<div class="row">
					<div class="col-lg-12 top-label">
						<div class="row">
							<div class="col-lg-6 location-name" title="<?php echo $news['news_title']; ?>">
							<?php echo $news_title ?>
							</div>
							<div class="col-lg-6 topic_number">
							<?php echo $news_type; ?>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
							<?php
							if(in_array($news['id'], $news_unread))
							{
								$check_news_id = "*".$news['id']."*";
								//execute if news id exist into admin news read columns..
								/// that means admin already read this news
								if(strpos($user_detail['news'],$check_news_id) !== false)
								{
									?>
									<div class="bottom-label <?php echo $i;?>" id="<?php echo $news['id']; ?>">
									<?php
								}
								else
								{
									?>
									<div class="bottom-label unread <?php echo $i;?>" id="<?php echo $news['id']; ?>">
									<?php
								}
							}
							else
							{
								?>
								<div class="bottom-label <?php echo $i;?>" id="<?php echo $news['id']; ?>">
								<?php
							}
							?>
							<div class="row staff-detail">
								<div class="col-lg-8">
									<div><?php echo $description; ?></div>
								</div>
								<div class="col-lg-4">
									<div><?php echo date('M j, Y',strtotime($news['publish_time'])); ?></div>
									<div><?php echo ucfirst($news['share_with'])?></div>
									<?php
									if($news['active'] == "1")
									{
										echo '<div class="status" style="color:rgb(2, 131, 2); font-weight:bold;">Active</div>';
									}
									if($news['active'] == "0")
									{
										echo '<div class="status" style="color:rgb(172, 3, 3); font-weight:bold;">Inactive</div>';
									}
									?>
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
		}
        //if login user is staff...
        else if(substr($username,0,5) == "staff")
        {
        	$title = $_POST['title'];
			$type = $_POST['type'];
			$this->load->model('user_model');
			$news_detail = $this->user_model->search_staff_news($title,$type,$username);
			$user_detail = $this->user_model->get_user_details($username,'staff');
			$news_unread_array = $this->user_model->staff_unread_news($username);
			$news_unread = array();
			foreach ($news_unread_array as $key) {
				array_push($news_unread, $key['id']);
			}


			if($news_detail)
			{
				$i=1;
				//execute when first time page load..
				foreach($news_detail as $news)
				{
					$news_type_id = $news['news_type'];
					$news_type_detail = $this->user_model->fetchbyid($news_type_id,'news_type');
					$news_type = $news_type_detail['name'];
					$description = character_limiter($news['description'],125);
					$news_title = character_limiter($news['news_title'],27);
				?>
				<div class="row">
					<div class="col-lg-12 top-label">
						<div class="row">
							<div class="col-lg-6 location-name" title="<?php echo $news['news_title']; ?>">
							<?php echo $news_title; ?>
							</div>
							<div class="col-lg-6 topic_number">
							<?php echo $news_type; ?>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<?php
						if(in_array($news['id'], $news_unread))
						{
							$check_news_id = "*".$news['id']."*";
							//execute if news id exist into admin news read columns..
							/// that means admin already read this news
							if(strpos($user_detail['news'],$check_news_id) !== false)
							{
								?>
								<div class="bottom-label <?php echo $i;?>" id="<?php echo $news['id']; ?>">
								<?php
							}
							else
							{
								?>
								<div class="bottom-label unread <?php echo $i;?>" id="<?php echo $news['id']; ?>">
								<?php
							}
						}
						else
						{
							?>
							<div class="bottom-label <?php echo $i;?>" id="<?php echo $news['id']; ?>">
							<?php
						}
						?>
							<div class="row staff-detail">
								<div class="col-lg-8">
									<div><?php echo $description; ?></div>
								</div>
								<div class="col-lg-4">
									<div><?php echo date('M j, Y',strtotime($news['publish_time'])); ?></div>
									<div><?php echo ucfirst($news['share_with'])?></div>
									<?php
									if($news['active'] == "1")
									{
										echo '<div class="status" style="color:rgb(2, 131, 2); font-weight:bold;">Active</div>';
									}
									if($news['active'] == "0")
									{
										echo '<div class="status" style="color:rgb(172, 3, 3); font-weight:bold;">Inactive</div>';
									}
									?>
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
							No News Found In Database..!
						</div>
					</div>';
				// end error message when there is no any organizaion location
			}


        }
        //if login user is staff...
        else if(substr($username,0,5) == "stude")
        {
        	$title = $_POST['title'];
			$type = $_POST['type'];
			$this->load->model('user_model');
			$news_detail = $this->user_model->search_student_news($title,$type);
			$user_detail = $this->user_model->get_user_details($username,'student');
			$news_unread_array = $this->user_model->student_unread_news($username);
			$news_unread = array();
			foreach ($news_unread_array as $key) {
				array_push($news_unread, $key['id']);
			}

			if($news_detail)
			{
				$i=1;
				//execute when first time page load..
				foreach($news_detail as $news)
				{
					$news_type_id = $news['news_type'];
					$news_type_detail = $this->user_model->fetchbyid($news_type_id,'news_type');
					$news_type = $news_type_detail['name'];
					$description = character_limiter($news['description'],125);
					$news_title = character_limiter($news['news_title'],27);
				?>
				<div class="row">
					<div class="col-lg-12 top-label">
						<div class="row">
							<div class="col-lg-6 location-name" title="<?php echo $news['news_title']; ?>">
							<?php echo $news_title; ?>
							</div>
							<div class="col-lg-6 topic_number">
							<?php echo $news_type; ?>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12">
						<?php
						if(in_array($news['id'], $news_unread))
						{
							$check_news_id = "*".$news['id']."*";
							//execute if news id exist into admin news read columns..
							/// that means admin already read this news
							if(strpos($user_detail['news'],$check_news_id) !== false)
							{
								?>
								<div class="bottom-label <?php echo $i;?>" id="<?php echo $news['id']; ?>">
								<?php
							}
							else
							{
								?>
								<div class="bottom-label unread <?php echo $i;?>" id="<?php echo $news['id']; ?>">
								<?php
							}
						}
						else
						{
							?>
							<div class="bottom-label <?php echo $i;?>" id="<?php echo $news['id']; ?>">
							<?php
						}
						?>
							<div class="row staff-detail">
								<div class="col-lg-8">
									<div><?php echo $description; ?></div>
								</div>
								<div class="col-lg-4">
									<div><?php echo date('M j, Y',strtotime($news['publish_time'])); ?></div>
									<div><?php echo ucfirst($news['share_with'])?></div>
									<?php
									if($news['active'] == "1")
									{
										echo '<div class="status" style="color:rgb(2, 131, 2); font-weight:bold;">Active</div>';
									}
									if($news['active'] == "0")
									{
										echo '<div class="status" style="color:rgb(172, 3, 3); font-weight:bold;">Inactive</div>';
									}
									?>
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
							No News Found In Database..!
						</div>
					</div>';
				// end error message when there is no any organizaion location
			}


        }
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }
        
	}

	function update_admin_news()
	{
		$this->load->model('user_model');
		$news_id = $_POST['news_id'];
		$username = $this->session->userdata('username');
		$user_detail = $this->user_model->fetchbyfield('username',$username,'admin');
		$user_id = $user_detail['id'];
		$update_data['news'] = $user_detail['news']."*".$news_id."*";
		$query = $this->user_model->updatedata($update_data,$user_id,'admin');
	}

	function update_staff_news()
	{
		$this->load->model('user_model');
		$news_id = $_POST['news_id'];
		$username = $this->session->userdata('username');
		$user_detail = $this->user_model->fetchbyfield('username',$username,'staff');
		$user_id = $user_detail['id'];
		$update_data['news'] = $user_detail['news']."*".$news_id."*";
		$query = $this->user_model->updatedata($update_data,$user_id,'staff');
	}

	function update_student_news()
	{
		$this->load->model('user_model');
		$news_id = $_POST['news_id'];
		$username = $this->session->userdata('username');
		$user_detail = $this->user_model->fetchbyfield('username',$username,'student');
		$user_id = $user_detail['id'];
		$update_data['news'] = $user_detail['news']."*".$news_id."*";
		$query = $this->user_model->updatedata($update_data,$user_id,'student');
	}

	function news_type_search()
	{
		$this->load->model('user_model');
		$name = $_POST['news_type'];
		$news_type_list = $this->user_model->fetch_news_type_by_name($name);
		if($news_type_list)
		{
			$i = 1;
    		foreach($news_type_list as $news)
			{
				if($news['id'] == 1)
				{
					echo "<tr>";
					echo "<td>".$i."</td>";
					echo "<td class='news_type_edit' id='".$news['id']."'>".$news['name']."</td>";
					echo "<td></td>";
					echo "</tr>";

				}
				else
				{
					echo "<tr>";
					echo "<td>".$i."</td>";
					echo "<td class='news_type_edit' id='".$news['id']."'>".$news['name']."</td>";
					echo "<td><img src='".base_url()."img/crose-icon.png' alt='' class='delete_news_type'></td>";
					echo "</tr>";
				}
				$i++;
			}
		}
		else
		{
		?>		
				<tr>
					<td></td>
					<td style="text-align:center; color:#960101; font-weight:bold">
						Search Result Not Found !
					</td>
					<td></td>
					
				</tr>
		<?php
		}
	}
	function news_type_update()
	{
		$this->load->model('user_model');
		$id = $_POST['id'];
		$name = $_POST['name'];
		$data['name'] = $name;
		$query = $this->user_model->updatedata($data,$id,'news_type');
		if($query)
		{
			echo "success";
		}
		else
		{
			echo "fail";
		}
	}

	function news_type_delete()
	{
		$this->load->model('user_model');
		$id = $_POST['id'];
		$data['status'] = "0";
		$query = $this->user_model->updatedata($data,$id,'news_type');
		$query = $this->user_model->update_news_type($id);
		if($query)
		{
			echo "success";
		}
		else
		{
			echo "fail";
		}
	}

	function news_type_insert()
	{
		$this->load->model('user_model');
		$name = $_POST['name'];
		$data['name'] = $name;
		$query = $this->user_model->insertdata($data,'news_type');
		$query = $this->user_model->fetchlastdata('news_type');
		echo $query['id'];
	}
	function news_type_list_update()
	{
		$this->load->model('user_model');
		$news_type_list = $this->user_model->fetch_news_type();
		echo '<option value="">Select News Type</option>';
		foreach($news_type_list as $news)
		{
			echo '<option value="'.$news['id'].'">'.$news['name'].'</option>';
		}

	} 
}	

?>
