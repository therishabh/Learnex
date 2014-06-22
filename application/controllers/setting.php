<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Setting extends CI_Controller
{
	public function __construst()
	{
		parent::__construst();
		
	}

	function index()
	{
		$username = $this->session->userdata('username');
		
		//if login user is admin...
		//then execute code.
		if(substr($username,0,5) == "admin")
		{
			//redirect organization setting...
			redirect('setting/organization','refresh');
		}
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}
	}
	//end index function
	

	//function for display organization page..
	function organization($update = "")
	{
		//load user_model..
		$this->load->model('user_model');
		
		//get username from session..
		$username = $this->session->userdata('username');
		
		//if login user is admin...
		//then execute code.
		if(substr($username,0,5) == "admin")
		{

			//execute if user want to insert organization details into database..
			if( $this->input->post('insert_btn') )
			{
				//check if any logo file is selected..
				if( !empty($_FILES['logo_choose']['name']) )
				{
					//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
					$config['upload_path'] = './uploads/organization_logo/';

					//set logo default name..
					$config['file_name'] = "logo";

					// set the filter image types
					$config['allowed_types'] = 'gif|jpg|png';
					
					//load the upload library
					$this->load->library('upload', $config);

			   		$this->upload->set_allowed_types('*');
			    
					$this->upload->initialize($config);

					//if not successful, set the error message
					if ($this->upload->do_upload('logo_choose')) 
					{
						$logo_data = $this->upload->data();
					}

					$data['logo'] = $logo_data['file_name'];
				}
				//if there is no any file selected..
				else
				{
					$data['logo'] = "";
				}

				$data['name'] = $this->input->post('organization_name');
				$data['address'] = $this->input->post('organization_address');
				$data['country'] = $this->input->post('country'); 
				$data['state'] = $this->input->post('state');
				$data['city'] = $this->input->post('city'); 
				$data['phone'] = implode(',',$this->input->post('phone')); 
				$data['email'] = implode(',',$this->input->post('email'));
				$data['website'] = implode(',',$this->input->post('website'));

				//load setting_model
				$this->load->model('setting_model');
				///insert organization data into database..
				$query = $this->setting_model->insert_organization_detail($data);

				//if organization data successfully inserted into database then
				//display full data of that organization.
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('insert_org',"success");
					header("Location: " . $_SERVER['REQUEST_URI']);
				}//end if condition..
			}
			else if ( $update == "update") 
			{
				//get username from session..
				$username = $this->session->userdata('username');
				
				//fetch userdetails form database of that user..
				$data['user_detail'] = $this->user_model->get_user_details($username,'admin');
				
				//fetch organization details from database..
				$data['organization_detail'] = $this->user_model->get_organization_details();
				$data['update_organization'] = "success";
				$data['page'] = "organization";
				$this->load->view('template',$data);
			}
			//execute if user want to update organization details..
			else if( $this->input->post('update_btn') )
			{
				//if logo does not update or delete..
				if( $this->input->post('default_logo') != "" )
				{
					//logo does not update..
					//set old logo (there is no need to update logo in database.)
				}
				else
				{

					if( empty($_FILES['logo_choose']['name']) )
					{
						$data['logo'] = "";
					}
					else
					{
						//set the path where the files uploaded will be copied. NOTE if using linux, set the folder to permission 777
						$config['upload_path'] = './uploads/organization_logo/';

						$config['file_name'] = "logo";

						// set the filter image types
						$config['allowed_types'] = 'gif|jpg|png';
						
						//load the upload library
						$this->load->library('upload', $config);

				    
				   		$this->upload->set_allowed_types('*');
				    
						$this->upload->initialize($config);

						//if not successful, set the error message
						if ($this->upload->do_upload('logo_choose')) 
						{
							$logo_data = $this->upload->data();
						}//end if..

						$data['logo'] = $logo_data['file_name'];
					}//end else..

				}//end else..

				$data['name'] = $this->input->post('organization_name');
				$data['address'] = $this->input->post('organization_address');
				$data['country'] = $this->input->post('country'); 
				$data['state'] = $this->input->post('state');
				$data['city'] = $this->input->post('city'); 
				$data['phone'] = implode(',',$this->input->post('phone')); 
				$data['email'] = implode(',',$this->input->post('email'));
				$data['website'] = implode(',',$this->input->post('website'));


				//load setting_model
				$this->load->model('setting_model');
				$query = $this->setting_model->update_organization_detail($data);
				
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('update_org',"success");
					header("Location: " . $_SERVER['REQUEST_URI']);
				}
					
			}//end else if( $this->input->post('update_btn') )
			else
			{			
				//fetch userdetails form database of that user..
				$data['user_detail'] = $this->user_model->get_user_details($username,'admin');
				
				//fetch organization details from database..
				$data['organization_detail'] = $this->user_model->get_organization_details();
		
				$data['page'] = "organization";
				$this->load->view('template',$data);
			}
		}
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}

	}//end function
		



	//function for organization Location...
	function location($location_id = "")
	{
		$this->load->model('user_model');
		$this->load->model('setting_model');
		
		//get username from session..
		$username = $this->session->userdata('username');

		//if login user is admin...
		//then execute code.
		if(substr($username,0,5) == "admin")
		{
			//execute if click on any organization location in grid view..
			//if there is location_id exist..
			if($location_id != "")
			{
				$data['selected_organization'] = $this->setting_model->get_organization_location_by_id($location_id);
				
				//check selected organization is exist in database or not..
				if( count($data['selected_organization']) > 0 )
				{
					//get organization details form database..
					$data['organization_detail'] = $this->user_model->get_organization_details();

					//get user details from database..
					$data['user_detail'] = $this->user_model->get_user_details($username,'admin');

					//get organization location details from database.
					$data['organization_location'] = $this->setting_model->get_organization_location();

					$data['page'] = "location";
					$this->load->view('template',$data);
				}
				//if selected organization is not exist into database then return main page
				//and display an error...
				else
				{
					$data['selected_organization'] = "";

					//get organization details form database..
					$data['organization_detail'] = $this->user_model->get_organization_details();

					//get user details from database..
					$data['user_detail'] = $this->user_model->get_user_details($username,'admin');

					//get organization location details from database.
					$data['organization_location'] = $this->setting_model->get_organization_location();

					$data['page'] = "location";
					$this->load->view('template',$data);
				}

			}
			//execute when new locaiton is inserted into database
			else if( $this->input->post('insert_location') )
			{
				echo $insert_data['location_name'] = $this->input->post('location_name');
				$insert_data['location_head'] = $this->input->post('location_head');
				$insert_data['address'] = $this->input->post('address');
				$insert_data['country'] = $this->input->post('country');
				$insert_data['state'] = $this->input->post('state');
				$insert_data['city'] = $this->input->post('city');
				$insert_data['phone'] = implode(',',$this->input->post('phone'));
				$insert_data['email'] = implode(',',$this->input->post('email'));
				$insert_data['website'] = $this->input->post('website');
				$insert_data['created_date'] = date("Y-m-d H:i:s");
				$insert_data['modify_date'] = date("Y-m-d H:i:s");

				$insert_location = $this->setting_model->insert_organization_location($insert_data);

				if($insert_location)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('insert_org_location',"success");
					header("Location: " . $_SERVER['REQUEST_URI']);
				}
			}
			//execute when any locaiton is updated into database
			else if( $this->input->post('update_location') )
			{
				$location_id = $this->input->post('id');
				$update_data['location_name'] = $this->input->post('location_name');
				$update_data['location_head'] = $this->input->post('location_head');
				$update_data['address'] = $this->input->post('address');
				$update_data['country'] = $this->input->post('country');
				$update_data['state'] = $this->input->post('state');
				$update_data['city'] = $this->input->post('city');
				$update_data['phone'] = implode(',',$this->input->post('phone'));
				$update_data['email'] = implode(',',$this->input->post('email'));
				$update_data['website'] = $this->input->post('website');
				$update_data['modify_date'] = date("Y-m-d H:i:s");

				$update_location = $this->setting_model->update_organization_location($update_data,$location_id);
				if($update_location)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('update_org_location',"success");
					$this->session->set_userdata('update_org_id',"$location_id");
					header("Location: " . $_SERVER['REQUEST_URI']);
				}
			}
			//execute if there not click on save or update
			else
			{
				//get organization details form database..
				$data['organization_detail'] = $this->user_model->get_organization_details();

				//get user details from database..
				$data['user_detail'] = $this->user_model->get_user_details($username,'admin');

				//get organization location details from database.
				$data['organization_location'] = $this->setting_model->get_organization_location();

				$data['page'] = "location";
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

	function location_search()
	{
		$this->load->model('setting_model');

		//get username from session..
		$username = $this->session->userdata('username');

		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			$search_text = $this->input->post('search_location');
			$organization_location = $this->setting_model->search_location($search_text);
			if($organization_location)
			{
				//execute if there is any organization location exist in database..
				if( count($organization_location) > 0 )
				{
					$i = 1;
					foreach($organization_location as $a)
					{

						$location_id = $a['id'];
						$location_name = $a['location_name'];
						$location_address = character_limiter($a['address'],50);
						$location_full_address = $a['address'];
						$location_city = $a['city'];
						$location_email = explode(',',$a['email']);
						$location_phone = explode(',',$a['phone']);

						//if select any organization..
						if(isset($selected_organization) && $selected_organization != "")
						{
							//execute when selected organization id is same as location id.
							//then show selected location..
							if($location_id == $selected_organization['id'])
							{
								echo '<div class="row">
									<div class="col-lg-12 top-label">
										<div class="row">
											<div class="col-lg-6 location-name">'.$location_name.'</div>
											<div class="col-lg-6 location-city">'.$location_city.'</div>
										</div>
									</div>
								</div>';
								echo '<div class="row">
									<div class="col-lg-12">
										<div class="bottom-label '.$i.' selected" id="'.$location_id.'">
											<div class="row">
												<div class="col-lg-4 location-address">
													<div>'.$location_address.'</div>
												</div>
												<div class="col-lg-3 location-phone">';
												foreach ($location_phone as $phone) {
													echo '<div>'.$phone.'</div>';
												}
												echo '</div>
											<div class="col-lg-5 location-email">';
											foreach ($location_email as $email) {
													echo '<div>'.$email.'</div>';
												}
												echo '</div>
											</div>
										</div>
									</div>
								</div>';
							}//end if condition.. if($location_id == $selected_organization['id'])
							else
							{
								echo '<div class="row">
									<div class="col-lg-12 top-label">
										<div class="row">
											<div class="col-lg-6 location-name">'.$location_name.'</div>
											<div class="col-lg-6 location-city">'.$location_city.'</div>
										</div>
									</div>
								</div>';
								echo '<div class="row">
									<div class="col-lg-12">
										<div class="bottom-label '.$i.'" id="'.$location_id.'">
										<a href="'.base_url().'setting/location/'.$location_id.'">
											<div class="row">
												<div class="col-lg-4 location-address">
													<div>'.$location_address.'</div>
												</div>
												<div class="col-lg-3 location-phone">';
												foreach ($location_phone as $phone) {
													echo '<div>'.$phone.'</div>';
												}
												echo '</div>
											<div class="col-lg-5 location-email">';
											foreach ($location_email as $email) {
													echo '<div>'.$email.'</div>';
												}
												echo '</div>
											</div>
										</a>
										</div>
									</div>
								</div>';
							}//end else condition..
						}// end if(isset($selected_organization) && $selected_organization != "")
						//execute if there is no any select organization..
						else{
							echo '<div class="row">
									<div class="col-lg-12 top-label">
										<div class="row">
											<div class="col-lg-6 location-name">'.$location_name.'</div>
											<div class="col-lg-6 location-city">'.$location_city.'</div>
										</div>
									</div>
								</div>';
								echo '<div class="row">
									<div class="col-lg-12">
										<div class="bottom-label '.$i.'" id="'.$location_id.'">
										<a href="'.base_url().'setting/location/'.$location_id.'">
											<div class="row">
												<div class="col-lg-4 location-address">
													<div>'.$location_address.'</div>
												</div>
												<div class="col-lg-3 location-phone">';
												foreach ($location_phone as $phone) {
													echo '<div>'.$phone.'</div>';
												}
												echo '</div>
											<div class="col-lg-5 location-email">';
											foreach ($location_email as $email) {
													echo '<div>'.$email.'</div>';
												}
												echo '</div>
											</div>
										</a>
										</div>
									</div>
								</div>';
							}//end else..

						$i++;
						
					}//end foreach loop
				}//close if condition..
			}
			else
			{
				// error message when there is no any organizaion location
				echo '<div class="row">
						<div class="col-lg-12 alert-msg">
							There is no any Organization Location.
						</div>
					</div>';
				// end error message when there is no any organizaion location
			}
		}
		//if login user is not admin..
		else
		{
			// //redirect to home page...
			redirect('/home/', 'refresh');
		}
	}
	
	function tax($update = ""){

		$this->load->model('user_model');
		$this->load->model('setting_model');
		//get username from session..
		$username = $this->session->userdata('username');
		//if login user is admin...then execute code.
		if(substr($username,0,5) == "admin")
		{
			if($this->input->post('insert_btn') != "")
			{
				$insert_data['tax_name'] = $this->input->post('tax_name');
				$insert_data['tax_value'] = $this->input->post('tax_value');
				date_default_timezone_set('Asia/Calcutta');
				$insert_data['created_time'] = date("Y-m-d H:i:s");

				if($this->input->post('tax_applicable') == "yes")
				$insert_data['applicable'] = "1";
				else
				$insert_data['applicable'] = "0";

				$query = $this->setting_model->tax_insert($insert_data);
				//if query is executed..
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('insert_tax',"success");
					header("Location: " . $_SERVER['REQUEST_URI']);			}
			}
			//execute when click on edit button..
			//then display tax details into editable mode..
			else if( $update != "" )
			{
				//get username from session..
				$username = $this->session->userdata('username');
				
				//fetch userdetails form database of that user..
				$data['user_detail'] = $this->user_model->get_user_details($username,'admin');
				
				//fetch organization details from database..
				$data['organization_detail'] = $this->user_model->get_organization_details();

				//fetch tax details from database..
				$data['tax_detail'] = $this->setting_model->get_tax_details();

				$data['update_tax'] = "success";
				$data['page'] = "tax";
				$this->load->view('template',$data);
			}
			//execute when click on update button after edit tax details..
			else if($this->input->post('update_btn') != "")
			{
				$insert_data['tax_name'] = $this->input->post('tax_name');
				$insert_data['tax_value'] = $this->input->post('tax_value');
				date_default_timezone_set('Asia/Calcutta');
				$insert_data['modify_time'] = date("Y-m-d H:i:s");

				if($this->input->post('tax_applicable') == "yes")
				$insert_data['applicable'] = "1";
				else
				$insert_data['applicable'] = "0";

				$query = $this->setting_model->tax_update($insert_data);
				//if query is executed..
				if($query)
				{
					//redirect to same page 
					//because of post-request-get rule..
					//there is for Duplicate form submissions avoid..
					//start session for display message..
					$this->session->set_userdata('update_tax',"success");
					header("Location: " . $_SERVER['REQUEST_URI']);	
				}
				
			}
			else
			{
				//fetch userdetails form database of that user..
				$data['user_detail'] = $this->user_model->get_user_details($username,'admin');
				
				//fetch organization details from database..
				$data['organization_detail'] = $this->user_model->get_organization_details();

				//fetch tax details from database..
				$data['tax_detail'] = $this->setting_model->get_tax_details();
				$data['page'] = "tax";
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

	function academic()
	{
		$this->load->model('user_model');
		$this->load->model('setting_model');
		$this->load->library('form_validation');

		//get username from session..
		$username = $this->session->userdata('username');
		
		//fetch userdetails form database of that user..
		$data['user_detail'] = $this->user_model->get_user_details($username,'admin');
		
		//fetch organization details from database..
		$data['organization_detail'] = $this->user_model->get_organization_details();

		$data['page'] = "academic";
		$this->load->view('template',$data);
	}

	function rightpanel()
	{
		if(isset($_POST['open']) && !empty($_POST['open']))
		{
			$this->session->set_userdata('open-panel','true');
		}
		else if(isset($_POST['close']) && !empty($_POST['close']))
		{
			$this->session->unset_userdata('open-panel');
		}
	}

}

?>