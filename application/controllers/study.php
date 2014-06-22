<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Study extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    
    $username = $this->session->userdata('username');
    
    //if login user is admin...
    //then execute code.
    if(substr($username,0,5) == "admin")
    {
        //redirect organization setting...
        redirect('study/course','refresh');
    }
    else if(substr($username,0,5) == "staff")
    {
        //load user model..
        $this->load->model('user_model');
        $this->load->model('manage_course');
        //get username from session..
        $username = $this->session->userdata('username');
      
        //fetch userdetails from database of that user..
        $data['organization_detail'] = $this->user_model->get_organization_details();
        $data['user_detail'] = $this->user_model->get_user_details($username,'staff');

        $staff_detail = $this->user_model->fetch_teacher();
        $data['teacher_detail'] = $staff_detail[0];

        //fetch teacher timetable
        $teacher_id = $data['user_detail']['id'];
        $data['lecture_detail'] = $this->user_model->fetch_teacher_lecture($teacher_id);

        $data['title'] = "Hello ";
        $data['page'] = "teacherlecture_teacher";
        $this->load->view('template',$data);
        
    }
    //if login user is not admin..
    else
    {
        // //redirect to home page...
        redirect('/home/', 'refresh');
    } 
  }


  // *************************************
  // Start Course
  // *************************************

  function course($course_id = "")
  {
    //load user model..
    $this->load->model('user_model');
    $this->load->model('manage_course');

    //get username from session..
    $username = $this->session->userdata('username');
    //if login user is admin...
    //then execute code.
    if(substr($username,0,5) == "admin")
    {
        //execute if course id is not empty..
        if( $course_id != "" )
        {
          $data['selected_course'] = $this->manage_course->get_detail_by_id($course_id,'course');
          //execute if course_id exist into database..
          if( count($data['selected_course']) > 0 )
          {
            //fetch userdetails from database of that user..
            $data['organization_detail'] = $this->user_model->get_organization_details();
            $data['user_detail'] = $this->user_model->get_user_details($username,'admin');
            $detail_course = $this->manage_course->course_details();
            $data['course_details'] = $detail_course[0];
            $data['no_of_course'] = $detail_course[1];
            $data['title'] = "Hello ";
            $data['page'] = "course";
            $this->load->view('template',$data);
          }
          //execute if course id not exists into database..
          //then display normal course page..
          else
          {
            //if there is selected id is not corrent then selected course array is blank..
            $data['selected_course'] = "";

            //fetch userdetails from database of that user..
            $data['organization_detail'] = $this->user_model->get_organization_details();
            $data['user_detail'] = $this->user_model->get_user_details($username,'admin');
            $detail_course = $this->manage_course->course_details();
            $data['course_details'] = $detail_course[0];
            $data['no_of_course'] = $detail_course[1];
            $data['title'] = "Hello ";
            $data['page'] = "course";
            $this->load->view('template',$data);
          }
        }
        //execute if click on save button..
        else if($this->input->post("insert_btn") != "")
        {
            $insert_data['name'] = $this->input->post("course_name");
            $insert_data['academic_year'] = $this->input->post("academic_year");
            $insert_data['fee'] = $this->input->post("course_fee");


            //execute if discount is applicable..
            if( $this->input->post('discount_checkbox') == "yes" )
            {
              $insert_data['discount'] = "yes";
              $insert_data['discount_mode'] = $this->input->post("discount_mode");
              //if discount value is percentage mode..
              if($this->input->post('discount_mode') == "percent")
              {
                $insert_data['discount_amount'] = $this->input->post("discount_value_percent");
              }
              //if discount value is fix mode
              elseif($this->input->post('discount_mode') == "fix")
              {
                $insert_data['discount_amount'] = $this->input->post("discount_value_fix");
              }
            }
            //execute if discount is not applicable..
            else
            {
              $insert_data['discount'] = "no";
              $insert_data['discount_mode'] = "";
              $insert_data['discount_amount'] = "";
            }

            $insert_data['net_fee_amount'] = $this->input->post('net_fee_amount');

            //execute if instalment is applicable..
            if( $this->input->post('instalment_applicable') == "yes" )
            {
              $insert_data['instalment_applicable'] = "yes";
              $insert_data['no_of_instalment'] = $this->input->post('num_of_instalment');
              $insert_data['instalment_mode'] = $this->input->post('instalment_mode');

              if($this->input->post('instalment_mode') == "percent")
              $insert_data['instalment_amount'] = implode("/",$this->input->post('instalment_percent_value'));
              else if ($this->input->post('instalment_mode') == "fix")
              $insert_data['instalment_amount'] = implode("/",$this->input->post('instalment_fix_value'));
                
            }
            //execute if instalment is not applicable..
            else
            {
              $insert_data['instalment_applicable'] = "no";
              $insert_data['no_of_instalment'] = "";
              $insert_data['instalment_mode'] = "";
              $insert_data['instalment_amount'] = "";
            }

            //insert data into course table in database.. 
            $query = $this->manage_course->course_insert($insert_data);
            

            //if data is successfully submited into course table into database..
            if($query)
            {
              //redirect to same page 
              //because of post-request-get rule..
              //there is for Duplicate form submissions avoid..
              //start session for display message..
              $this->session->set_userdata('insert_course',"success");
              header("Location: " . $_SERVER['REQUEST_URI']);
            }
        }
        //execute if click on update button..
        //when user want to update course information...
        else if($this->input->post("update_btn") != "")
        {
            $insert_data['name'] = $this->input->post("course_name");
            $insert_data['academic_year'] = $this->input->post("academic_year");
            $insert_data['fee'] = $this->input->post("course_fee");
            $course_id = $this->input->post('course_id');
            
            //execute if discount is applicable..
            if( $this->input->post('discount_checkbox') == "yes" )
            {
              $insert_data['discount'] = "yes";
              $insert_data['discount_mode'] = $this->input->post("discount_mode");
              //if discount value is percentage mode..
              if($this->input->post('discount_mode') == "percent")
              {
                $insert_data['discount_amount'] = $this->input->post("discount_value_percent");
              }
              //if discount value is fix mode
              elseif($this->input->post('discount_mode') == "fix")
              {
                $insert_data['discount_amount'] = $this->input->post("discount_value_fix");
              }
            }
            //execute if discount is not applicable..
            else
            {
              $insert_data['discount'] = "no";
              $insert_data['discount_mode'] = "";
              $insert_data['discount_amount'] = "";
            }

            $insert_data['net_fee_amount'] = $this->input->post('net_fee_amount');

            //execute if instalment application is selected..
            if( $this->input->post('instalment_applicable') == "yes" )
            {
              $insert_data['instalment_applicable'] = "yes";
              $insert_data['no_of_instalment'] = $this->input->post('num_of_instalment');
              $insert_data['instalment_mode'] = $this->input->post('instalment_mode');

              if($this->input->post('instalment_mode') == "percent")
              $insert_data['instalment_amount'] = implode("/",$this->input->post('instalment_percent_value'));
              else if ($this->input->post('instalment_mode') == "fix")
              $insert_data['instalment_amount'] = implode("/",$this->input->post('instalment_fix_value'));
                
            }
            //execute if instalment application is not selected..
            else
            {
              $insert_data['instalment_applicable'] = "no";
              $insert_data['no_of_instalment'] = "";
              $insert_data['instalment_mode'] = "";
              $insert_data['instalment_amount'] = "";
            }

            //insert data into course table in database.. 
            $query = $this->manage_course->course_update($insert_data,$course_id);
            
            // if data is successfully submited into course table into database..
            if($query)
            {
              //after updating course information..
              //redirect to same page 
              //because of post-request-get rule..
              //there is for Duplicate form submissions avoid...
              //start session for display message..
              $this->session->set_userdata('update_course_id',$course_id);
              $this->session->set_userdata('update_course',"success");
              header("Location: " . $_SERVER['REQUEST_URI']);
            }
        }
        //execute if not click on save or update button..
        else
        {      
          //fetch userdetails from database of that user..
          $data['organization_detail'] = $this->user_model->get_organization_details();
          $data['user_detail'] = $this->user_model->get_user_details($username,'admin');
          $detail_course = $this->manage_course->course_details();
          $data['course_details'] = $detail_course[0];
          $data['no_of_course'] = $detail_course[1];
          $data['page'] = "course";
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

  function course_search()
  {
    //get username from session..
    $username = $this->session->userdata('username');

    //if login user is admin...
    //then execute code.
    if(substr($username,0,5) == "admin")
    {
        $this->load->model('manage_course');
        $search_text = $this->input->post('search_course');
        $detail_course = $this->manage_course->search_course($search_text);
        $course_details = $detail_course[0];
        $no_of_course = $detail_course[1];

        if($course_details)
        {
          ///execute if existed number of course greater than 0
          ///then display course grid
          if($no_of_course > 0)
          {
            $i = 1;
            foreach($course_details as $course)
            {

              $course_id = $course['id'];
              $course_name = $course['name'];
              $course_fee = $course['fee'];
              $course_net_fee = $course['net_fee_amount'];
              $discount_mode = $course['discount_mode'];
              $discount_amount = $course['discount_amount'];
              $num_of_instalment = $course['no_of_instalment'];
              //if select any organization..
              if(isset($selected_course) && $selected_course != "")
              {
                //execute when selected_course id is same as course id.
                if($course_id == $selected_course['id'])
                {

                  echo '<div class="row">
                    <div class="col-lg-12 top-label">
                      <div class="row">
                        <div class="col-lg-6 location-name">'.$course_name.'</div>
                        <div class="col-lg-6 location-city">'.$course_fee.'</div>
                      </div>
                    </div>
                  </div>';

                  echo '<div class="row">
                    <div class="col-lg-12">
                      <div class="bottom-label '.$i.' selected" id="'.$course_id.'">
                        <div class="row">
                          <div class="col-lg-4 location-address">
                            <div>Discount :</div>';
                            if($discount_mode == "percent")
                            {
                              echo "<div style='font-size:17px;'>$discount_amount<span><img src='".base_url()."img/precentage.png' style='height:15px; padding-left:5px;'><span></div>";
                            }
                            elseif($discount_mode == "fix")
                            {
                              echo "<div style='font-size:17px;'>$discount_amount<span><img src='".base_url()."img/rupee.png' style='height:15px;padding-left:5px;'><span></div>";
                            }
                            else
                            {
                              echo "<div style='font-size:17px;'>0<span><img src='".base_url()."img/rupee.png' style='height:15px;padding-left:5px;'><span></div>";
                            }
                        echo '</div>
                          <div class="col-lg-3 location-phone">
                            <div>Net Course Fee :</div>
                            <div>'.$course_net_fee.'</div>
                          </div>
                        <div class="col-lg-5 location-email">
                          <div class="location-phone">
                            <div>Num of Instalment :</div>

                            <div>';
                            if($num_of_instalment != "")
                            {
                              echo $num_of_instalment;
                            }
                            else
                            {
                              echo "0";
                            }
                            echo '</div>
                          </div>
                        </div>
                        </div>

                      </div>
                    </div>
                  </div>';
                }
                else
                {
                  echo '<div class="row">
                    <div class="col-lg-12 top-label">
                      <div class="row">
                        <div class="col-lg-6 location-name">'.$course_name.'</div>
                        <div class="col-lg-6 location-city">'.$course_fee.'</div>
                      </div>
                    </div>
                  </div>';

                  echo '<div class="row">
                    <div class="col-lg-12">
                      <div class="bottom-label '.$i.'" id="'.$course_id.'">
                        <a href="'.base_url().'study/course/'.$course_id.'">
                        <div class="row">
                          <div class="col-lg-4 location-address">
                            <div>Discount :</div>';
                            if($discount_mode == "percent")
                            {
                              echo "<div style='font-size:17px;'>$discount_amount<span><img src='".base_url()."img/precentage.png' style='height:15px; padding-left:5px;'><span></div>";
                            }
                            elseif($discount_mode == "fix")
                            {
                              echo "<div style='font-size:17px;'>$discount_amount<span><img src='".base_url()."img/rupee.png' style='height:15px;padding-left:5px;'><span></div>";
                            }
                            else
                            {
                              echo "<div style='font-size:17px;'>0<span><img src='".base_url()."img/rupee.png' style='height:15px;padding-left:5px;'><span></div>";
                            }
                        echo '</div>
                          <div class="col-lg-3 location-phone">
                            <div>Net Course Fee :</div>
                            <div>'.$course_net_fee.'</div>
                          </div>
                        <div class="col-lg-5 location-email">
                          <div class="location-phone">
                            <div>Num of Instalment :</div>

                            <div>';
                            if($num_of_instalment != "")
                            {
                              echo $num_of_instalment;
                            }
                            else
                            {
                              echo "0";
                            }
                            echo '</div>
                          </div>
                        </div>
                        </div>
                        </a>

                      </div>
                    </div>
                  </div>';
                }//end // else condition.
              }
              //execute if there is no any select organization..
              else
              {
                echo '<div class="row">
                    <div class="col-lg-12 top-label">
                      <div class="row">
                        <div class="col-lg-6 location-name">'.$course_name.'</div>
                        <div class="col-lg-6 location-city">'.$course_fee.'</div>
                      </div>
                    </div>
                  </div>';

                echo '<div class="row">
                  <div class="col-lg-12">
                    <div class="bottom-label '.$i.'" id="'.$course_id.'">
                      <a href="'.base_url().'study/course/'.$course_id.'">
                      <div class="row">
                        <div class="col-lg-4 location-address">
                          <div>Discount :</div>';
                          if($discount_mode == "percent")
                          {
                            echo "<div style='font-size:17px;'>$discount_amount<span><img src='".base_url()."img/precentage.png' style='height:15px; padding-left:5px;'><span></div>";
                          }
                          elseif($discount_mode == "fix")
                          {
                            echo "<div style='font-size:17px;'>$discount_amount<span><img src='".base_url()."img/rupee.png' style='height:15px;padding-left:5px;'><span></div>";
                          }
                          else
                          {
                            echo "<div style='font-size:17px;'>0<span><img src='".base_url()."img/rupee.png' style='height:15px;padding-left:5px;'><span></div>";
                          }
                      echo '</div>
                        <div class="col-lg-3 location-phone">
                          <div>Net Course Fee :</div>
                          <div>'.$course_net_fee.'</div>
                        </div>
                      <div class="col-lg-5 location-email">
                        <div class="location-phone">
                          <div>Num of Instalment :</div>

                          <div>';
                          if($num_of_instalment != "")
                          {
                            echo $num_of_instalment;
                          }
                          else
                          {
                            echo "0";
                          }
                          echo '</div>
                        </div>
                      </div>
                      </div>
                      </a>

                    </div>
                  </div>
                </div>';

                
              }
              
              
              $i++;
            }
                    
          }//end if condition if($no_of_course > 0)
          
        }
        //execute if there is no any organization in database
        else
        {
          // error message when there is no any organizaion location
          echo '<div class="row">
              <div class="col-lg-12 alert-msg">
                No Courses With This Name
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

  // *************************************
  // end Course
  // *************************************



  // *************************************
  // Start Subject
  // *************************************


  function subject($subject_id = "")
  {
    //load user model..
    $this->load->model('user_model');
    $this->load->model('manage_course');

    //get username from session..
    $username = $this->session->userdata('username');
    //if login user is admin...
    //then execute code.
    if(substr($username,0,5) == "admin")
    {
        if( $subject_id  != "" )
        {
          $data['selected_subject'] = $this->manage_course->get_detail_by_id($subject_id,'subject');
          //execute if course_id exist into database..
          if( count($data['selected_subject']) > 0 )
          {
            //fetch userdetails from database of that user..
            $data['organization_detail'] = $this->user_model->get_organization_details();
            $data['user_detail'] = $this->user_model->get_user_details($username,'admin');
            $detail_subject = $this->manage_course->subject_details();
            $data['subject_details'] = $detail_subject[0];
            $data['no_of_subject'] = $detail_subject[1];
            $data['title'] = "Hello ";
            $data['page'] = "subject";
            $this->load->view('template',$data);
          }
          //execute if course id not exists into database..
          //then display normal course page..
          else
          {
            //if there is selected id is not corrent then selected course array is blank..
            $data['selected_subject'] = "";

            //fetch userdetails from database of that user..
            $data['organization_detail'] = $this->user_model->get_organization_details();
            $data['user_detail'] = $this->user_model->get_user_details($username,'admin');
            $detail_subject = $this->manage_course->subject_details();
            $data['subject_details'] = $detail_subject[0];
            $data['no_of_subject'] = $detail_subject[1];
            $data['title'] = "Hello ";
            $data['page'] = "subject";
            $this->load->view('template',$data);
          }
        }
        else if( $this->input->post("insert_btn") )
        {
          $insert_data['name'] = $this->input->post('subject_name');
          $insert_data['topic'] = trim($this->input->post('topic'), ",");

          $query = $this->manage_course->insert_subject($insert_data);
          
          if($query)
          {
            //redirect to subject page.. 
            //because of post-request-get rule..
            //there is for Duplicate form submissions avoid..
            //start session for display message..
            $this->session->set_userdata('insert_subject',"success");
            header("Location: " . $_SERVER['REQUEST_URI']);
          }

        }
        elseif( $this->input->post("update_btn") )
        {
          $selected_id = $this->input->post('subject_id');
          $insert_data['name'] = $this->input->post('subject_name');
          $insert_data['topic'] = trim($this->input->post('topic'), ",");

          $query = $this->manage_course->update_subject($insert_data,$selected_id);
          
          if($query)
          {
            //redirect to subject page.. 
            //because of post-request-get rule..
            //there is for Duplicate form submissions avoid..
            //start session for display message..
            $this->session->set_userdata('update_subject',$selected_id);
            header("Location: " . $_SERVER['REQUEST_URI']);
          }
        }
        else
        {
          //fetch userdetails from database of that user..
          $data['organization_detail'] = $this->user_model->get_organization_details();
          $data['user_detail'] = $this->user_model->get_user_details($username,'admin');
          $detail_subject = $this->manage_course->subject_details();
          $data['subject_details'] = $detail_subject[0];
          $data['no_of_subject'] = $detail_subject[1];
          $data['title'] = "Hello ";
          $data['page'] = "subject";
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

  function subject_search()
  {

    //get username from session..
    $username = $this->session->userdata('username');
    //if login user is admin...
    //then execute code.
    if(substr($username,0,5) == "admin")
    {
        $this->load->model('manage_course');
        $search_text = $this->input->post('search_subject');
        $detail_subject = $this->manage_course->search_subject($search_text);
        $subject_details = $detail_subject[0];
        $no_of_subject = $detail_subject[1];

        if($subject_details)
        {
          ///execute if existed number of subject greater than 0
          ///then display subject grid
          if($no_of_subject > 0)
          {
            $i = 1;
            foreach($subject_details as $subject)
            {

              $subject_id = $subject['id'];
              $subject_name = $subject['name'];
              $subject_topic = explode(',', $subject['topic']);
              sort($subject_topic);
              $number_of_topic = count($subject_topic);
              if($number_of_topic > 1)
              {
                $number_of_topic = $number_of_topic." Topics";
              }
              else
              {
                $number_of_topic = $number_of_topic." Topic";
              }

              //if select any Subject..
              if(isset($selected_subject) && $selected_subject != "")
              {
                //execute when selected_subject id is same as subject id.
                if($subject_id == $selected_subject['id'])
                {

                  echo '<div class="row">
                    <div class="col-lg-12 top-label">
                      <div class="row">
                        <div class="col-lg-6 location-name">'.$subject_name.'</div>
                        <div class="col-lg-6 topic_number">'.$number_of_topic.'</div>
                      </div>
                    </div>
                  </div>';

                  echo '<div class="row">
                      <div class="col-lg-12">
                        <div class="bottom-label '.$i.' selected" id="'.$subject_id.'">
                          <a href="'.base_url().'study/subject/'.$subject_id.'">
                          <div class="row">';
                            echo '<div class="col-lg-4 subject-topic">';
                            for($i = 0; $i < count($subject_topic); $i++)
                            {
                              if($i < 2)
                              {
                              $topic_name = character_limiter($subject_topic[$i],12);
                              echo $topic_name;
                              echo "<br>";
                              }
                            }
                            echo '</div>';

                            echo '<div class="col-lg-4 subject-topic">';
                            for($i = 0; $i < count($subject_topic); $i++)
                            {
                              if($i > 1 && $i < 4)
                              {
                              $topic_name = character_limiter($subject_topic[$i],12);
                              echo $topic_name;
                              echo "<br>";
                              }
                            }
                            echo '</div>';

                            echo '<div class="col-lg-4 subject-topic">';
                            for($i = 0; $i < count($subject_topic); $i++)
                            {
                              if($i > 3 && $i < 6)
                              {
                              $topic_name = character_limiter($subject_topic[$i],12);
                              echo $topic_name;
                              echo "<br>";
                              }
                              
                            }
                            echo '</div>';
                          
                            ?>

                          </div><!-- end row -->
                          </a>
                        </div><!-- end bottom-label -->
                      </div><!-- end col-lg-12 -->
                    </div>
                <?php
                }// end if($subject_id == $selected_subject['id'])
                else
                {
                  echo '<div class="row">
                    <div class="col-lg-12 top-label">
                      <div class="row">
                        <div class="col-lg-6 location-name">'.$subject_name.'</div>
                        <div class="col-lg-6 topic_number">'.$number_of_topic.'</div>
                      </div>
                    </div>
                  </div>';

                  echo '<div class="row">
                      <div class="col-lg-12">
                        <div class="bottom-label '.$i.'" id="'.$subject_id.'">
                          <a href="'.base_url().'study/subject/'.$subject_id.'">
                          <div class="row">';
                            echo '<div class="col-lg-4 subject-topic">';
                            for($i = 0; $i < count($subject_topic); $i++)
                            {
                              if($i < 2)
                              {
                              $topic_name = character_limiter($subject_topic[$i],12);
                              echo $topic_name;
                              echo "<br>";
                              }
                            }
                            echo '</div>';

                            echo '<div class="col-lg-4 subject-topic">';
                            for($i = 0; $i < count($subject_topic); $i++)
                            {
                              if($i > 1 && $i < 4)
                              {
                              $topic_name = character_limiter($subject_topic[$i],12);
                              echo $topic_name;
                              echo "<br>";
                              }
                            }
                            echo '</div>';

                            echo '<div class="col-lg-4 subject-topic">';
                            for($i = 0; $i < count($subject_topic); $i++)
                            {
                              if($i > 3 && $i < 6)
                              {
                              $topic_name = character_limiter($subject_topic[$i],12);
                              echo $topic_name;
                              echo "<br>";
                              }
                              
                            }
                            echo '</div>';
                          
                            ?>

                          </div><!-- end row -->
                          </a>
                        </div><!-- end bottom-label -->
                      </div><!-- end col-lg-12 -->
                    </div>
                <?php
                }//end else condition..
              }//end if(isset($selected_subject) && $selected_subject != "")
              //execute if there is no any subject selected..
              else
              {
                echo '<div class="row">
                    <div class="col-lg-12 top-label">
                      <div class="row">
                        <div class="col-lg-6 location-name">'.$subject_name.'</div>
                        <div class="col-lg-6 topic_number">'.$number_of_topic.'</div>
                      </div>
                    </div>
                  </div>';

                  echo '<div class="row">
                      <div class="col-lg-12">
                        <div class="bottom-label '.$i.'" id="'.$subject_id.'">
                          <a href="'.base_url().'study/subject/'.$subject_id.'">
                          <div class="row">';
                            echo '<div class="col-lg-4 subject-topic">';
                            for($i = 0; $i < count($subject_topic); $i++)
                            {
                              if($i < 2)
                              {
                              $topic_name = character_limiter($subject_topic[$i],12);
                              echo $topic_name;
                              echo "<br>";
                              }
                            }
                            echo '</div>';

                            echo '<div class="col-lg-4 subject-topic">';
                            for($i = 0; $i < count($subject_topic); $i++)
                            {
                              if($i > 1 && $i < 4)
                              {
                              $topic_name = character_limiter($subject_topic[$i],12);
                              echo $topic_name;
                              echo "<br>";
                              }
                            }
                            echo '</div>';

                            echo '<div class="col-lg-4 subject-topic">';
                            for($i = 0; $i < count($subject_topic); $i++)
                            {
                              if($i > 3 && $i < 6)
                              {
                              $topic_name = character_limiter($subject_topic[$i],12);
                              echo $topic_name;
                              echo "<br>";
                              }
                              
                            }
                            echo '</div>';
                          
                            ?>

                          </div><!-- end row -->
                          </a>
                        </div><!-- end bottom-label -->
                      </div><!-- end col-lg-12 -->
                    </div>
              <?php
              }
            } // end foreach loop foreach($subject_details as $subject)
          }//end if condition.. if($no_of_subject > 0)
        }
        //execute if there is no any organization in database
        else
        {
          // error message when there is no any organizaion location
          echo '<div class="row">
              <div class="col-lg-12 alert-msg">
                No Subject With This Name
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


  // *************************************
  // end Subject
  // *************************************


  // *************************************
  // start batch
  // *************************************


  function batch($batch_id = "")
  {
    //load user model..
    $this->load->model('user_model');
    $this->load->model('manage_course');

    //get username from session..
    $username = $this->session->userdata('username');

    //if login user is admin...
    //then execute code.
    if(substr($username,0,5) == "admin")
    {
        if( $batch_id  != "" )
        {
          $data['selected_standard'] = $this->manage_course->get_detail_by_id($batch_id,'batch');
          //execute if course_id exist into database..
          if( count($data['selected_standard']) > 0 )
          {
            //fetch userdetails from database of that user..
            $data['organization_detail'] = $this->user_model->get_organization_details();
            $data['user_detail'] = $this->user_model->get_user_details($username,'admin');
            $detail_standard = $this->user_model->fetchalldatadesc("batch");
            $data['standard_details'] = $detail_standard[0];
            $data['no_of_standard'] = $detail_standard[1];
            $data['course_details'] = $this->manage_course->get_course();
            $data['subject_details'] = $this->manage_course->get_subject();
            $data['title'] = "Hello ";
            $data['page'] = "batch";
            $this->load->view('template',$data);
          }
          //execute if course id not exists into database..
          //then display normal course page..
          else
          {
            //if there is selected id is not corrent then selected course array is blank..
            $data['selected_standard'] = "";

            //fetch userdetails from database of that user..
            $data['organization_detail'] = $this->user_model->get_organization_details();
            $data['user_detail'] = $this->user_model->get_user_details($username,'admin');
            $detail_standard = $this->user_model->fetchalldatadesc("batch");
            $data['standard_details'] = $detail_standard[0];
            $data['no_of_standard'] = $detail_standard[1];
            $data['course_details'] = $this->manage_course->get_course();
            $data['subject_details'] = $this->manage_course->get_subject();
            $data['title'] = "Hello ";
            $data['page'] = "batch";
            $this->load->view('template',$data);
          }
        }
        else if( $this->input->post('insert_btn') )
        {
          $insert_data['name'] = $this->input->post('standard_name');
          $insert_data['course'] = $this->input->post('course');
          $insert_data['subject'] = implode("/",$this->input->post('subject') );

          $query = $this->user_model->insertdata($insert_data,'batch');
          
          if($query)
          {
            //redirect to subject page.. 
            //because of post-request-get rule..
            //there is for Duplicate form submissions avoid..
            //start session for display message..
            $this->session->set_userdata('insert_standard',"success");
            header("Location: " . $_SERVER['REQUEST_URI']);
          }
        }
        else if( $this->input->post('update_btn') )
        {
          $batch_id = $this->input->post('batch_id');
          $insert_data['name'] = $this->input->post('standard_name');
          $insert_data['course'] = $this->input->post('course');
          $insert_data['subject'] = implode("/",$this->input->post('subject') );

          $query = $this->user_model->updatedata($insert_data,$batch_id,'batch');
          
          if($query)
          {
            //redirect to subject page.. 
            //because of post-request-get rule..
            //there is for Duplicate form submissions avoid..
            //start session for display message..
            $this->session->set_userdata('update_standard',$batch_id);
            header("Location: " . $_SERVER['REQUEST_URI']);
          }
        }
        else
        {

          //fetch userdetails from database of that user..
          $data['organization_detail'] = $this->user_model->get_organization_details();
          $data['user_detail'] = $this->user_model->get_user_details($username,'admin');
          $detail_standard = $this->manage_course->batch_details();
          $data['standard_details'] = $detail_standard[0];
          $data['no_of_standard'] = $detail_standard[1];
          $data['course_details'] = $this->manage_course->get_course();
          $data['subject_details'] = $this->manage_course->get_subject();
          $data['title'] = "Hello ";
          $data['page'] = "batch";
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

    function batch_search()
    {
    
        //get username from session..
        $username = $this->session->userdata('username');
        //if login user is admin...
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
            $this->load->model('manage_course');
            $search_text = $this->input->post('search_standard');
            $detail_standard = $this->manage_course->search_batch($search_text);
            $standard_details = $detail_standard[0];
            $no_of_standard = $detail_standard[1];

            if($standard_details)
            {
              ///execute if existed number of standard greater than 0
              ///then display standard grid
              if($no_of_standard > 0)
              {
                $i = 1;
                foreach($standard_details as $standard)
                {
                  $batch_id = $standard['id'];
                  $standard_name = $standard['name'];
                  $course_id = $standard['course'];
                  $standard_subject = explode('/',$standard['subject']);
                  //get course name from database by course id..
                  $course = $this->manage_course->get_detail_by_id($course_id,'course');
                  $course_name = $course['name'];

                  //if select any organization..
                  if(isset($selected_standard) && $selected_standard != "")
                  {
                    //execute when selected_standard id is same as standard id.
                    if($batch_id == $selected_standard['id'])
                    {
                      echo '<div class="row">
                        <div class="col-lg-12 top-label">
                          <div class="row">
                            <div class="col-lg-6 location-name">'.$standard_name.'</div>
                            <div class="col-lg-6 topic_number">'.$course_name.'</div>
                          </div>
                        </div>
                      </div>';
                      echo '<div class="row">
                        <div class="col-lg-12">
                          <div class="bottom-label '.$i.' selected" id="'.$batch_id.'">
                            <a href="#">
                            <div class="row">';
                            $x = 1;
                            foreach($standard_subject as $subject)
                            {
                              if($x < 10)
                              {
                                $subject_n = $this->manage_course->get_detail_by_id($subject,'subject');
                                $subject_name = $subject_n['name'];

                                echo '<div class="col-lg-4">';
                                echo $subject_name;
                                echo '</div>';                                
                              }
                              $x++;
                            }
                            
                              ?>

                            </div><!-- end row -->
                            </a>
                          </div><!-- end bottom-label -->
                        </div><!-- end col-lg-12 -->
                      </div>
                      <?php
                    
                    }
                    else
                    {
                      echo '<div class="row">
                          <div class="col-lg-12 top-label">
                            <div class="row">
                              <div class="col-lg-6 location-name">'.$standard_name.'</div>
                              <div class="col-lg-6 topic_number">'.$course_name.'</div>
                            </div>
                          </div>
                        </div>';
                      echo '<div class="row">
                        <div class="col-lg-12">
                          <div class="bottom-label '.$i.'" id="'.$batch_id.'">
                            <a href="'.base_url().'study/standard/'.$batch_id.'">
                            <div class="row">';
                            $x = 1;
                            foreach($standard_subject as $subject)
                            {
                              if($x < 10)
                              {
                                $subject_n = $this->manage_course->get_detail_by_id($subject,'subject');
                                $subject_name = $subject_n['name'];

                                echo '<div class="col-lg-4">';
                                echo $subject_name;
                                echo '</div>';                                
                              }
                              $x++;
                            }
                            
                              ?>

                            </div><!-- end row -->
                            </a>
                          </div><!-- end bottom-label -->
                        </div><!-- end col-lg-12 -->
                      </div>
                      <?php
                    }
                  }//end if condition..
                  //execute if there is no any select organization..
                  else
                  {
                    echo '<div class="row">
                      <div class="col-lg-12 top-label">
                        <div class="row">
                          <div class="col-lg-6 location-name">'.$standard_name.'</div>
                          <div class="col-lg-6 topic_number">'.$course_name.'</div>
                        </div>
                      </div>
                    </div>';
                    echo '<div class="row">
                        <div class="col-lg-12">
                          <div class="bottom-label '.$i.'" id="'.$batch_id.'">
                            <a href="'.base_url().'study/standard/'.$batch_id.'">
                            <div class="row">';

                            $x = 1;
                            foreach($standard_subject as $subject)
                            {
                              if($x < 10)
                              {
                                $subject_n = $this->manage_course->get_detail_by_id($subject,'subject');
                                $subject_name = $subject_n['name'];

                                echo '<div class="col-lg-4">';
                                echo $subject_name;
                                echo '</div>';                                
                              }
                              $x++;
                            }
                            
                              ?>

                            </div><!-- end row -->
                            </a>
                          </div><!-- end bottom-label -->
                        </div><!-- end col-lg-12 -->
                      </div>
                  <?php
                  }//end else condition..
                  $i++;
                }//end foreach loop foreach($standard_details as $standard)
              }// end if condition.. if($no_of_standard > 0)
            }
            //execute if there is no any organization in database
            else
            {
              // error message when there is no any organizaion location
              echo '<div class="row">
                  <div class="col-lg-12 alert-msg">
                    No Batch With This Name.. !
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

  // *************************************
  // end batch
  // *************************************
  // 
  // *************************************
  // Start batch Scheduling
  // *************************************
  
    function batchscheduling()
    {
        //get username from session..
        $username = $this->session->userdata('username');
        //if login user is admin...
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
            //load user model..
            $this->load->model('user_model');
            $this->load->model('manage_course');


            //fetch userdetails from database of that user..
            $data['organization_detail'] = $this->user_model->get_organization_details();
            $data['user_detail'] = $this->user_model->get_user_details($username,'admin');

            //fetch all course for display into filter section
            $course_detail = $this->user_model->fetchalldatadesc('course');
            $data['course_detail'] = $course_detail[0];

            //fetch first inserted course..
            $course_id = $this->manage_course->first_course_id();

            //fetch student details from database..
            $student_detail = $this->user_model->get_student_by_course($course_id['id']);
            $data['student_detail'] = $student_detail[0];
            $data['no_of_student'] = $student_detail[1];


            $data['title'] = "Hello ";
            $data['page'] = "batchscheduling";
            $this->load->view('template',$data);
        }
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }

    }

    function batchscheduling_search()
    {
        //get username from session..
        $username = $this->session->userdata('username');
        //if login user is admin...
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
            if(isset($_POST['name']))
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
                    <div class="student">
                        <div class="student-checkbox">
                            <label style="float:left;">
                                <input type="checkbox" name="student-check[]" class="checkbox student-check" value="<?php echo $student['id']; ?>">
                                <div class="checkbox-img"></div>
                            </label>
                        </div>

                        
                        <div class="row student-list">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-1 student-img">
                                        <img src="<?php echo base_url(); ?>uploads/student/<?php echo $student['image']; ?>" alt="">
                                    </div>
                                    <div class="col-lg-4 student-name-username">
                                        <div><?php echo $student['name']; ?></div>
                                        <div><?php echo $student['username']; ?></div>
                                        <div><?php echo date('j, M Y',strtotime($student['dob'])) ?></div>
                                    </div>

                                    <div class="col-lg-3 student-email-phone">
                                        <div><?php echo $student['gender']; ?></div>
                                        <div><?php echo $email[0]; ?></div>
                                        <div><?php echo $phone[0]; ?></div>
                                    </div>
                                    <div class="col-lg-2 student-email-phone">
                                        <div><?php echo $student['city']; ?></div>
                                        <div><?php echo $course['name']; ?></div>
                                        <div>
                                            <?php 
                                            if($batch['name'] != "")
                                                echo $batch['name'];
                                            else
                                                echo "<span style='color:red'>--</span>"
                                             ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 student-view" style="position:relative">
                                        <div data-toggle="modal" data-target=".bs-example-modal-lg" style="position:absolute;" >
                                        <img src="<?php echo base_url() ?>/img/view.png" alt="" class="view-student" id="stu_<?php echo $student['id']; ?>">
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
            }   
        }
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }

    }


    function batchscheduling_move()
    {
        //get username from session..
        $username = $this->session->userdata('username');
        //if login user is admin...
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
            $this->load->model('user_model');
            $student_ids = $_POST['select_id'];
            $batch = $_POST['batch'];
            $course = $_POST['course'];
            $student_id = explode(',',$student_ids);
            $a = 0;
            for($i = 0; $i < count($student_id); $i++)
            {
              if($student_id[$i] != "")
              {
                  $update_data['batch'] = $batch;
                  $id = $student_id[$i];
                  $this->user_model->updatedata($update_data,$id,"student");
                  $a++;
              }
            }

            $batch = $this->user_model->fetchbyfield('id',$batch,'batch');
            if($a > 0)
            {
              if($a == 1)
              {
                  echo "Student Has Been Successfully Moved in <span>".$batch['name']."</span>.";
              }
              else{
                  echo "Students Have Been Successfully Moved in <span>".$batch['name']."</span>.";
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

    function move_list()
    {
        //get username from session..
        $username = $this->session->userdata('username');
        //if login user is admin...
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
            $course_id = $_POST['course_id'];
            $this->load->model('user_model');
            $this->load->model('manage_course');
            $batch_detail = $this->manage_course->fetch_batch_by_courseid($course_id);
           
            foreach ($batch_detail as $batch) {
                $batch_id = $batch['id'];
                $num_of_student = $this->user_model->count_student_by_batch($batch_id);
                echo '<div class="move-batch" id="'.$batch['id'].'">'.$batch['name'].' ('.$num_of_student.')'.'</div>';
            }
            
        }
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }

    }


    function batchscheduling_view_student()
    {
        //get username from session..
        $username = $this->session->userdata('username');
        //if login user is admin...
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
            $data = explode("_",$_POST['student_id']);
            $student_id = $data[1];
            $this->load->model('user_model');
            $student_detail = $this->user_model->fetchbyid($student_id,'student');
            $email = explode(',',$student_detail['email']);
            $phone = explode(',',$student_detail['phone']);
            $course = $this->user_model->fetchbyfield('id',$student_detail['course'],'course');
            $batch = $this->user_model->fetchbyfield('id',$student_detail['batch'],'batch');
            ?>
            <div class="row">
                <div class="col-lg-12">
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Student Profile</h4>
                    </div>
                    <div class="modal-body">

                        <!-- start personal info -->
                        <div class="title" style="padding-top:0px;">Personal Info </div>
                        <div class="row info" style="margin-top:0px;">
                            <!-- display Left side -->
                            <div class="col-lg-6">
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-5 lable-text">
                                        Name :
                                    </div>
                                    <div class="col-lg-7 lable-value">
                                       <?php echo $student_detail['name'] ?>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-5 lable-text">
                                        Username :
                                    </div>
                                    <div class="col-lg-7 lable-value">
                                        <?php echo $student_detail['username'] ?>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-5 lable-text">
                                        Date of Birth :
                                    </div>
                                    <div class="col-lg-7 lable-value">
                                        <?php echo date('j, M Y',strtotime($student_detail['dob'])) ?>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-5 lable-text">
                                        Gender :
                                    </div>
                                    <div class="col-lg-7 lable-value">
                                        <?php echo $student_detail['gender'];?>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-5 lable-text">
                                        Blood Group :
                                    </div>
                                    <div class="col-lg-7 lable-value">
                                        <?php echo $student_detail['blood_group'];?>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-5 lable-text">
                                        Category :
                                    </div>
                                    <div class="col-lg-7 lable-value">
                                        <?php echo $student_detail['category'];?>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-5 lable-text">
                                        Course :
                                    </div>
                                    <div class="col-lg-7 lable-value">
                                        <?php echo $course['name'];?>
                                    </div>
                                </div>

                            </div>
                            <!-- // end display Left side -->


                            <!-- display right side -->
                            <div class="col-lg-6">
                                <div class="row" style="margin-top:10px;">

                                    <div class="col-lg-6 col-centered student-img">
                                        <img src="<?php echo base_url(); ?>uploads/student/<?php echo $student_detail['image']?>" alt="">
                                    </div>
                                    
                                </div>

                                <div class="row" style="margin-top:20px;">
                                    <div class="col-lg-5 lable-text">
                                        Date of Joining :
                                    </div>
                                    <div class="col-lg-7 lable-value">
                                        <?php echo date('j, M Y',strtotime($student_detail['doj'])) ?>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:10px;">
                                    <div class="col-lg-5 lable-text">
                                        Batch :
                                    </div>
                                    <div class="col-lg-7 lable-value">
                                       <?php echo $batch['name'];?>
                                    </div>
                                </div>


                            </div>
                            <!-- // end display right side -->
                        </div>
                        <!-- // end personal info -->
                        


                        <!-- start Parent info -->
                        <div class="title">Parent Info</div>
                        <div class="info">
                            
                            <div class="row">
                                <!-- display Left side -->
                                <div class="col-lg-6">
                                    <div class="row" style="margin-top:10px;">
                                        <div class="col-lg-5 lable-text">
                                            <?php echo $student_detail['parent_relation'] ?> Name :
                                        </div>
                                        <div class="col-lg-7 lable-value">
                                            <?php echo $student_detail['parent_name'] ?>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:10px;">
                                        <div class="col-lg-5 lable-text">
                                            <?php echo $student_detail['parent_relation'] ?> Mobile :
                                        </div>
                                        <div class="col-lg-7 lable-value">
                                            <?php echo $student_detail['parent_phone'] ?>
                                        </div>
                                    </div>
                                    

                                </div>
                                <!-- // end display Left side -->


                                <!-- display right side -->
                                <div class="col-lg-6">

                                    <div class="row" style="margin-top:10px;">
                                        <div class="col-lg-5 lable-text">
                                            <?php echo $student_detail['parent_relation'] ?> Email :
                                        </div>
                                        <div class="col-lg-7 lable-value">
                                            <?php echo $student_detail['parent_email'] ?>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top:10px;">
                                        <div class="col-lg-5 lable-text">
                                            <?php echo $student_detail['parent_relation'] ?> Occ :
                                        </div>
                                        <div class="col-lg-7 lable-value">
                                            <?php echo $student_detail['parent_occupation'] ?>
                                        </div>
                                    </div>

                                </div>
                                <!-- // end display right side -->
                            </div>




                        </div>
                        <!-- // end Parent info -->



                        <!-- start Contact info -->
                        <div class="title">Contact Info</div>
                        <div class="info">
                            
                            <div class="row">
                                <!-- display Left side -->
                                <div class="col-lg-6">
                                    <div class="row" style="margin-top:10px;">
                                        <div class="col-lg-5 lable-text">
                                            Phone No :
                                        </div>
                                        <div class="col-lg-7 lable-value phone-no">
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

                                    <div class="row" style="margin-top:10px;">
                                        <div class="col-lg-5 lable-text">
                                            Country :
                                        </div>
                                        <div class="col-lg-7 lable-value">
                                           <?php echo $student_detail['country'];?>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top:10px;">
                                        <div class="col-lg-5 lable-text">
                                            City :
                                        </div>
                                        <div class="col-lg-7 lable-value">
                                           <?php echo $student_detail['city'];?>
                                        </div>
                                    </div>


                                    <div class="row" style="margin-top:10px;">
                                        <div class="col-lg-5 lable-text">
                                            Current Add :
                                        </div>
                                        <div class="col-lg-7 lable-value">
                                            <?php echo $student_detail['current_address'];?>
                                        </div>
                                    </div>                                      

                                    

                                </div>
                                <!-- // end display Left side -->


                                <!-- display right side -->
                                <div class="col-lg-6">

                                    <div class="row" style="margin-top:10px;">
                                        <div class="col-lg-5 lable-text">
                                            Email Id :
                                        </div>
                                        <div class="col-lg-7 lable-value">
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

                                    <div class="row" style="margin-top:10px;">
                                        <div class="col-lg-5 lable-text">
                                            State:
                                        </div>
                                        <div class="col-lg-7 lable-value">
                                            <?php echo $student_detail['state'];?>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top:10px;">
                                        <div class="col-lg-5 lable-text">
                                            Permanent Add :
                                        </div>
                                        <div class="col-lg-7 lable-value">
                                            <?php echo $student_detail['permanent_address'];?>
                                        </div>
                                    </div>  

                                </div>
                                <!-- // end display right side -->
                            </div>

                        </div>
                        <!-- // end Contact info -->

                    </div>

                </div>
            </div>
        <?php
        }
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }
    }

  // *************************************
  // End batch Scheduling
  // *************************************
 


  // **************************************
  // Start Lectuer Scheduling..
  // **************************************

    function lecturescheduling(){
        //load user model..
        $this->load->model('user_model');
        $this->load->model('manage_course');
        //get username from session..
        $username = $this->session->userdata('username');
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
            //execute when click on save button for insert data into database. 
            if( $this->input->post("insert_btn") != "" )
            {
                $lecture_type = $this->input->post('lecture_type');
                $course = $this->input->post('course');
                $batch = $this->input->post('batch');
                $this->session->set_userdata('course',$course);
                $this->session->set_userdata('batch',$batch);
                
                //break lecture type into array..
                $lecture_type = explode(',', $lecture_type);  // (lecture_1,break_2,lecture_3)

                //execute loop 7 times because insert data into 7 rows..(mon, tue, wed,....)
                for($i = 1; $i <= 6; $i++)
                {
                    //execute if there is n lecture or break then execute n times..
                    $x = 1;
                    for($a = 0; $a < count($lecture_type); $a++)
                    {
                        $lecture_break = $lecture_type[$a]; //lecture_1, Break_2, lecture_3.....
                        $abc = explode("_", $lecture_break);
                        //if there is a lectue then execute..
                        if($abc[0] == "lecture")
                        {
                            $lecture_number = $abc[1];
                            $start_time = $this->input->post("start_time_$lecture_number");
                            $end_time = $this->input->post("end_time_$lecture_number");
                            $sub = "sub_".$i."_".$lecture_number;
                            $teach = "teach_".$i."_".$lecture_number;
                            $subject = $this->input->post($sub);
                            $teacher = $this->input->post($teach);
                            
                            $insert_data['batch'] = $batch;
                            if($i == 1)
                            $insert_data['day'] = "Monday";
                            if($i == 2)
                            $insert_data['day'] = "Tuesday";
                            if($i == 3)
                            $insert_data['day'] = "Wednesday";
                            if($i == 4)
                            $insert_data['day'] = "Thursday";
                            if($i == 5)
                            $insert_data['day'] = "Friday";
                            if($i == 6)
                            $insert_data['day'] = "Saturday";

                            $insert_data['start_time'] = str_replace(":", ".", $start_time);
                            $insert_data['end_time'] = str_replace(":", ".", $end_time);
                            $insert_data['teacher'] = $teacher;
                            $insert_data['subject'] = $subject;
                            $insert_data['code'] = $this->user_model->generateRandomString('5');
                            $this->user_model->insertdata($insert_data,'timetable');
                          }
                        //if there is a break then execute..
                        if($abc[0] == "break")
                        {
                            $insert_data['batch'] = $batch;
                            if($i == 1)
                            $insert_data['day'] = "Monday";
                            if($i == 2)
                            $insert_data['day'] = "Tuesday";
                            if($i == 3)
                            $insert_data['day'] = "Wednesday";
                            if($i == 4)
                            $insert_data['day'] = "Thursday";
                            if($i == 5)
                            $insert_data['day'] = "Friday";
                            if($i == 6)
                            $insert_data['day'] = "Saturday";

                            $insert_data['start_time'] = "Break";
                            $insert_data['end_time'] = "Break";
                            $insert_data['teacher'] = "Break";
                            $insert_data['subject'] = "Break";
                            $this->user_model->insertdata($insert_data,'timetable');
                        }
                    $x++;
                    }       
                }

                $insert_lecture_detail['batch'] = $batch;
                $insert_lecture_detail['comment'] = $this->input->post('comment');
                $query = $this->user_model->insertdata($insert_lecture_detail,'lecture_schedule');
                // 
                //if data is successfully submited into course table into database..
                if($query)
                {
                  //redirect to same page 
                  //because of post-request-get rule..
                  //there is for Duplicate form submissions avoid..
                  //start session for display message..
                  $this->session->set_userdata('insert_lecture',"success");
                  
                  
                    redirect('study/lecturescheduling','refresh');
                }
            }
            //execute when click on save button for insert data into database. 
            if( $this->input->post("update_btn") != "" )
            {
                $lecture_type = $this->input->post('lecture_type');
                $batch = $this->input->post('batch');
                $course = $this->input->post('course');
                $update_data['status'] = "0";
                $this->user_model->update_timetable($update_data,$batch,'timetable');
                $this->user_model->delete_timetable($batch,'lecture_schedule');
                
                //break lecture type into array..
                $lecture_type = explode(',', $lecture_type);  // (lecture_1,break_2,lecture_3)

                //execute loop 7 times because insert data into 7 rows..(mon, tue, wed,....)
                for($i = 1; $i <= 6; $i++)
                {
                    //execute if there is n lecture or break then execute n times..
                    $x = 1;
                    for($a = 0; $a < count($lecture_type); $a++)
                    {
                        $lecture_break = $lecture_type[$a]; //lecture_1, Break_2, lecture_3.....
                        $abc = explode("_", $lecture_break);
                        //if there is a lectue then execute..
                        if($abc[0] == "lecture")
                        {
                            $lecture_number = $abc[1];
                            $start_time = $this->input->post("start_time_$lecture_number");
                            $end_time = $this->input->post("end_time_$lecture_number");
                            $sub = "sub_".$i."_".$lecture_number;
                            $teach = "teach_".$i."_".$lecture_number;
                            $subject = $this->input->post($sub);
                            $teacher = $this->input->post($teach);
                            
                                $insert_data['batch'] = $batch;
                                if($i == 1)
                                $insert_data['day'] = "Monday";
                                if($i == 2)
                                $insert_data['day'] = "Tuesday";
                                if($i == 3)
                                $insert_data['day'] = "Wednesday";
                                if($i == 4)
                                $insert_data['day'] = "Thursday";
                                if($i == 5)
                                $insert_data['day'] = "Friday";
                                if($i == 6)
                                $insert_data['day'] = "Saturday";

                                $insert_data['start_time'] = str_replace(":", ".", $start_time);
                                $insert_data['end_time'] = str_replace(":", ".", $end_time);
                                $insert_data['teacher'] = $teacher;
                                $insert_data['subject'] = $subject;
                                $insert_data['code'] = $this->user_model->generateRandomString('5');
                                $this->user_model->insertdata($insert_data,'timetable');
                           

                        }
                        //if there is a break then execute..
                        if($abc[0] == "break")
                        {
                            $insert_data['batch'] = $batch;
                            if($i == 1)
                            $insert_data['day'] = "Monday";
                            if($i == 2)
                            $insert_data['day'] = "Tuesday";
                            if($i == 3)
                            $insert_data['day'] = "Wednesday";
                            if($i == 4)
                            $insert_data['day'] = "Thursday";
                            if($i == 5)
                            $insert_data['day'] = "Friday";
                            if($i == 6)
                            $insert_data['day'] = "Saturday";

                            $insert_data['start_time'] = "Break";
                            $insert_data['end_time'] = "Break";
                            $insert_data['teacher'] = "Break";
                            $insert_data['subject'] = "Break";
                            $query = $this->user_model->insertdata($insert_data,'timetable');
                        }
                    $x++;
                    }       
                }

                $insert_lecture_detail['batch'] = $batch;
                $insert_lecture_detail['comment'] = $this->input->post('comment');
                $query = $this->user_model->insertdata($insert_lecture_detail,'lecture_schedule');
                //if data is successfully submited into course table into database..
                if($query)
                {
                  //redirect to same page 
                  //because of post-request-get rule..
                  //there is for Duplicate form submissions avoid..
                  //start session for display message..
                  $this->session->set_userdata('update_lecture',"success");
                  $this->session->set_userdata('course',$course);
                  $this->session->set_userdata('batch',$batch);
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

                $staff_detail = $this->user_model->fetch_teacher();
                $data['teacher_detail'] = $staff_detail[0];

                $data['title'] = "Hello ";
                $data['page'] = "lecturescheduling";
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

    function batch_subject()
    {
        $username = $this->session->userdata('username');
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
            $this->load->model('user_model');

            $batch_id = $_POST['batch_id'];
            $batch_detail = $this->user_model->fetchbyid($batch_id,'batch');
            $batch_subject_string = $batch_detail['subject'];
            $batch_subject = explode('/',$batch_subject_string);
            echo '<option value="">Subject</option>';
            foreach ($batch_subject as $subject_id) {
              $subject_detail = $this->user_model->fetchbyid($subject_id,'subject');
              echo '<option value="'.$subject_detail['id'].'">'.$subject_detail['name'].'</option>';
            }
        }
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }       
    }


    function lecture_check()
    {
         $username = $this->session->userdata('username');
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
            $this->load->model('user_model');
            $batch_id = $_POST['batch_id'];
            $batch_comment = $this->user_model->batch_comment($batch_id);
            $lecture_detail = $this->user_model->lecture_detail($batch_id);
            if($lecture_detail)
            {
                
              ?>
              <div class="row">
                <div class="col-lg-11 col-centered">
                  <table class="table table-bordered">
                    <?php
                    for($i = 1; $i <= 7; $i++)
                    {
                        if($i == 1)
                        {
                            echo "<tr>";
                            echo "<td></td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Monday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td>".$lecture['start_time']." - ".$lecture['end_time']."</td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                        if($i == 2)
                        {
                            echo "<tr>";
                            echo "<td>Monday</td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Monday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td>";
                                        echo "<div>".$lecture['subject_name']."</div>";
                                        echo "<div>".$lecture['teacher_name']."</div>";
                                        echo "</td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                        if($i == 3)
                        {
                            echo "<tr>";
                            echo "<td>Tuesday</td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Tuesday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td>";
                                        echo "<div>".$lecture['subject_name']."</div>";
                                        echo "<div>".$lecture['teacher_name']."</div>";
                                        echo "</td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                        if($i == 4)
                        {
                            echo "<tr>";
                            echo "<td>Wednesday</td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Wednesday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td>";
                                        echo "<div>".$lecture['subject_name']."</div>";
                                        echo "<div>".$lecture['teacher_name']."</div>";
                                        echo "</td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                        if($i == 5)
                        {
                            echo "<tr>";
                            echo "<td>Thursday</td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Thursday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td>";
                                        echo "<div>".$lecture['subject_name']."</div>";
                                        echo "<div>".$lecture['teacher_name']."</div>";
                                        echo "</td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                        if($i == 6)
                        {
                            echo "<tr>";
                            echo "<td>Friday</td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Friday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td>";
                                        echo "<div>".$lecture['subject_name']."</div>";
                                        echo "<div>".$lecture['teacher_name']."</div>";
                                        echo "</td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                        if($i == 7)
                        {
                            echo "<tr>";
                            echo "<td>Saturday</td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Saturday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td>";
                                        echo "<div>".$lecture['subject_name']."</div>";
                                        echo "<div>".$lecture['teacher_name']."</div>";
                                        echo "</td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                    } 
                    ?>
                    
                    
                  </table>
                </div><!-- // end col-lg-12 -->
              </div><!-- // end row -->
              <div class="row">
                <div class="col-lg-11 col-centered">
                  <?php
                  if($batch_comment['comment'] != "")
                  {
                    ?>
                      <div class="note">Note:</div>
                      <div class="comment">
                        <?php echo $batch_comment['comment']; ?>
                      </div>
                    <?php
                  } 
                   ?>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-centered">
                  <div class="row">
                    <div class="col-lg-6">
                        <a href="<?php echo base_url(); ?>pdf/lecture/<?php echo $batch_id; ?>" target="_blank">
                        <div class="submit-btn">PDF</div>
                      </a>
                    </div>
                    <div class="col-lg-6">
                      <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $batch_id; ?>">
                        <div class="submit-btn">Edit</div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <?php   
            }
        }
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }
            
    }

    function editlecture($id = "")
    {
        //load user model..
        $this->load->model('user_model');
        $this->load->model('manage_course');

        //get username from session..
        $username = $this->session->userdata('username');
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
            $batch_id = $id;

            if($batch_id != "")
            {
                $this->load->model('user_model');
                $lecture_detail = $this->user_model->lecture_detail($batch_id);
                if($lecture_detail)
                {
                    $data['lecture_detail'] = $lecture_detail;

                    $batch_status = $this->user_model->batch_comment($batch_id);
                    $data['comment'] = $batch_status['comment'];
                    //fetch userdetails from database of that user..
                    $data['organization_detail'] = $this->user_model->get_organization_details();
                    $data['user_detail'] = $this->user_model->get_user_details($username,'admin');

                    $staff_detail = $this->user_model->fetch_teacher();
                    $data['teacher_detail'] = $staff_detail[0];

                    $batch_detail = $this->user_model->fetchbyid($batch_id,'batch');
                    $data['batch_detail'] = $batch_detail;
                    $course_id = $batch_detail['course'];
                    $data['course_detail'] = $this->user_model->fetchbyid($course_id,'course');


                    $data['title'] = "Hello ";
                    $data['page'] = "editlecture";
                    $this->load->view('template',$data);
                }
                else
                {
                    //redirect organization setting...
                    redirect('study/lecturescheduling','refresh');
                }
            }
            else
            {
                //redirect organization setting...
                redirect('study/lecturescheduling','refresh');
            }
        }
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }

    }

    function teacherlecture($id = "")
    {

        //load user model..
        $this->load->model('user_model');
        $this->load->model('manage_course');
        //get username from session..
        $username = $this->session->userdata('username');
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
            //fetch userdetails from database of that user..
            $data['organization_detail'] = $this->user_model->get_organization_details();
            $data['user_detail'] = $this->user_model->get_user_details($username,'admin');

            $staff_detail = $this->user_model->fetch_teacher();
            $data['teacher_detail'] = $staff_detail[0];

            $data['title'] = "Hello ";
            $data['page'] = "teacherlecture";
            $this->load->view('template',$data);
        }
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }
           
       
    }

    function view_teacher_timetable()
    {
         //get username from session..
        $username = $this->session->userdata('username');
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
            //load user model..
            $teacher_id = $_POST['teacher_id'];
            $this->load->model('user_model');


            $end_time_1 = 0;
            $end_time_2 = 0;
            $end_time_3 = 0;
            $end_time_4 = 0;
            $end_time_5 = 0;
            $end_time_6 = 0;
            $lecture_detail = $this->user_model->fetch_teacher_lecture($teacher_id);
            if($lecture_detail)
            {
              ?>
              <table class="table table-bordered">
                <?php 
                for($i = 1; $i < 7; $i++)
                {
                  if($i == 1)
                  {
                    echo "<tr>";
                    echo "<td>Monday</td>";
                    foreach($lecture_detail as $lecture)
                    {
                      if($lecture['day'] == "Monday")
                      {
                        if( strtotime($lecture['start_time']) < $end_time_1 )
                        {
                          ?>
                        <td style="background:rgb(180, 2, 2);color:#FFF;">
                          <div>
                          <?php
                          echo $lecture['start_time'] ." - ". $lecture['end_time']; 
                          ?>
                          </div>
                          <div>
                          <?php
                          echo $lecture['subject_name'];
                          echo "<br>";
                          ?>
                          <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $lecture['batch_id']; ?>" target="_blank" style="color:#fff;"><?php echo $lecture['batch_name']; ?></a>
                          </div>
                        </td>
                        <?php
                        }
                        else
                        {
                        ?>
                        <td>
                          <div>
                          <?php
                          echo $lecture['start_time'] ." - ". $lecture['end_time']; 
                          ?>
                          </div>
                          <div>
                          <?php
                          echo $lecture['subject_name'];
                          echo "<br>";
                          ?>
                          <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $lecture['batch_id']; ?>" target="_blank"><?php echo $lecture['batch_name']; ?></a>
                          </div>
                        </td>
                        <?php
                        }
                        ?>

                      <?php
                        if(strtotime($lecture['end_time']) > $end_time_1)
                        {
                          $end_time_1 = strtotime($lecture['end_time']);
                        }
                      }//end if condition Monday..
                    }
                    echo "</tr>";     
                  }
                  if($i == 2)
                  {
                    echo "<tr>";
                    echo "<td>Tuesday</td>";
                    foreach($lecture_detail as $lecture)
                    {
                      if($lecture['day'] == "Tuesday")
                      {
                        if( strtotime($lecture['start_time']) < $end_time_2 )
                        {
                          ?>
                        <td style="background:rgb(180, 2, 2);color:#FFF;">
                          <div>
                          <?php
                          echo $lecture['start_time'] ." - ". $lecture['end_time']; 
                          ?>
                          </div>
                          <div>
                          <?php
                          echo $lecture['subject_name'];
                          echo "<br>";
                          ?>
                          <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $lecture['batch_id']; ?>" target="_blank" style="color:#fff;"><?php echo $lecture['batch_name']; ?></a>
                          </div>
                        </td>
                        <?php
                        }
                        else
                        {
                        ?>
                        <td>
                          <div>
                          <?php
                          echo $lecture['start_time'] ." - ". $lecture['end_time']; 
                          ?>
                          </div>
                          <div>
                          <?php
                          echo $lecture['subject_name'];
                          echo "<br>";
                          ?>
                          <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $lecture['batch_id']; ?>" target="_blank"><?php echo $lecture['batch_name']; ?></a>
                          </div>
                        </td>
                        <?php
                        }
                        ?>

                      <?php
                        if(strtotime($lecture['end_time']) > $end_time_2)
                        {
                          $end_time_2 = strtotime($lecture['end_time']);
                        }
                      }
                    }
                    echo "</tr>";     
                  }
                  if($i == 3)
                  {
                    echo "<tr>";
                    echo "<td>Wednesday</td>";
                    foreach($lecture_detail as $lecture)
                    {
                      if($lecture['day'] == "Wednesday")
                      {
                        if( strtotime($lecture['start_time']) < $end_time_3 )
                        {
                          ?>
                        <td style="background:rgb(180, 2, 2);color:#FFF;">
                          <div>
                          <?php
                          echo $lecture['start_time'] ." - ". $lecture['end_time']; 
                          ?>
                          </div>
                          <div>
                          <?php
                          echo $lecture['subject_name'];
                          echo "<br>";
                          ?>
                          <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $lecture['batch_id']; ?>" target="_blank" style="color:#fff;"><?php echo $lecture['batch_name']; ?></a>
                          </div>
                        </td>
                        <?php
                        }
                        else
                        {
                        ?>
                        <td>
                          <div>
                          <?php
                          echo $lecture['start_time'] ." - ". $lecture['end_time']; 
                          ?>
                          </div>
                          <div>
                          <?php
                          echo $lecture['subject_name'];
                          echo "<br>";
                          ?>
                          <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $lecture['batch_id']; ?>" target="_blank" ><?php echo $lecture['batch_name']; ?></a>
                          </div>
                        </td>
                        <?php
                        }
                        ?>

                      <?php
                        if(strtotime($lecture['end_time']) > $end_time_3)
                        {
                          $end_time_3 = strtotime($lecture['end_time']);
                        }
                      }
                    }
                    echo "</tr>";     
                  }
                  if($i == 4)
                  {
                    echo "<tr>";
                    echo "<td>Thursday</td>";
                    foreach($lecture_detail as $lecture)
                    {
                      if($lecture['day'] == "Thursday")
                      {
                        if( strtotime($lecture['start_time']) < $end_time_4 )
                        {
                          ?>
                        <td style="background:rgb(180, 2, 2);color:#FFF;">
                          <div>
                          <?php
                          echo $lecture['start_time'] ." - ". $lecture['end_time']; 
                          ?>
                          </div>
                          <div>
                          <?php
                          echo $lecture['subject_name'];
                          echo "<br>";
                          ?>
                          <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $lecture['batch_id']; ?>" target="_blank" style="color:#fff;"><?php echo $lecture['batch_name']; ?></a>
                          </div>
                        </td>
                        <?php
                        }
                        else
                        {
                        ?>
                        <td>
                          <div>
                          <?php
                          echo $lecture['start_time'] ." - ". $lecture['end_time']; 
                          ?>
                          </div>
                          <div>
                          <?php
                          echo $lecture['subject_name'];
                          echo "<br>";
                          ?>
                          <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $lecture['batch_id']; ?>" target="_blank" ><?php echo $lecture['batch_name']; ?></a>
                          </div>
                        </td>
                        <?php
                        }
                        if(strtotime($lecture['end_time']) > $end_time_4)
                        {
                          $end_time_4 = strtotime($lecture['end_time']);
                        }
                      }
                    }
                    echo "</tr>";     
                  }
                  if($i == 5)
                  {
                    echo "<tr>";
                    echo "<td>Friday</td>";
                    foreach($lecture_detail as $lecture)
                    {
                      if($lecture['day'] == "Friday")
                      {
                        if( strtotime($lecture['start_time']) < $end_time_5 )
                        {
                          ?>
                        <td style="background:rgb(180, 2, 2);color:#FFF;">
                          <div>
                          <?php
                          echo $lecture['start_time'] ." - ". $lecture['end_time']; 
                          ?>
                          </div>
                          <div>
                          <?php
                          echo $lecture['subject_name'];
                          echo "<br>";
                          ?>
                          <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $lecture['batch_id']; ?>" target="_blank" style="color:#fff;"><?php echo $lecture['batch_name']; ?></a>
                          </div>
                        </td>
                        <?php
                        }
                        else
                        {
                        ?>
                        <td>
                          <div>
                          <?php
                          echo $lecture['start_time'] ." - ". $lecture['end_time']; 
                          ?>
                          </div>
                          <div>
                          <?php
                          echo $lecture['subject_name'];
                          echo "<br>";                     
                          ?>
                          </div>
                          <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $lecture['batch_id']; ?>" target="_blank"><?php echo $lecture['batch_name']; ?></a>
                        </td>
                        <?php
                        }
                        if(strtotime($lecture['end_time']) > $end_time_5)
                        {
                          $end_time_5 = strtotime($lecture['end_time']);
                        }
                      }
                    }
                    echo "</tr>";     
                  }
                  if($i == 6)
                  {
                    echo "<tr>";
                    echo "<td>Saturday</td>";
                    foreach($lecture_detail as $lecture)
                    {
                      if($lecture['day'] == "Saturday")
                      {
                        if( strtotime($lecture['start_time']) < $end_time_6 )
                        {
                          ?>
                        <td style="background:rgb(180, 2, 2);color:#FFF;">
                          <div>
                          <?php
                          echo $lecture['start_time'] ." - ". $lecture['end_time']; 
                          ?>
                          </div>
                          <div>
                          <?php
                          echo $lecture['subject_name'];
                          echo "<br>";
                          ?>
                          <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $lecture['batch_id']; ?>" target="_blank" style="color:#fff;"><?php echo $lecture['batch_name']; ?></a>
                          </div>
                        </td>
                        <?php
                        }
                        else
                        {
                        ?>
                        <td>
                          <div>
                          <?php
                          echo $lecture['start_time'] ." - ". $lecture['end_time']; 
                          ?>
                          </div>
                          <div>
                          <?php
                          echo $lecture['subject_name'];
                          echo "<br>";
                          ?>
                          <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $lecture['batch_id']; ?>" target="_blank" ><?php echo $lecture['batch_name']; ?></a>
                          </div>
                        </td>
                        <?php
                        }
                        ?>

                      <?php
                        if(strtotime($lecture['end_time']) > $end_time_6)
                        {
                          $end_time_6 = strtotime($lecture['end_time']);
                        }
                      }
                    }
                    echo "</tr>";     
                  }
                  
                }
                ?>
              </table>
              <div class="row" style="margin-bottom:30px;">
                  <div class="col-lg-3 col-centered">
                    <a href="<?php echo base_url(); ?>pdf/teachertimetable/<?php echo $teacher_id; ?>" target="_blank">
                        <div class="submit-btn save-btn">PDF</div>
                    </a>
                  </div>
              </div>
              <?php
            }//end if condition
            else
            {
                ?>
                <div class="error-teacher-select">
                    Still to be scheduled.. !
                </div>
                <?php
            }
        }
        //if login user is not admin..
        else
        {
            // //redirect to home page...
            redirect('/home/', 'refresh');
        }



    }//end function view_teacher_timetable




    function lecture_attendance_check()
    {
         //get username from session..
        $username = $this->session->userdata('username');
        //then execute code.
        if(substr($username,0,5) == "admin")
        {
            $this->load->model('user_model');
            $batch_id = $_POST['batch_id'];
            $batch_comment = $this->user_model->batch_comment($batch_id);
            $lecture_detail = $this->user_model->lecture_detail($batch_id);
            if($lecture_detail)
            {
                
              ?>
              <div class="row">
                <div class="col-lg-11 col-centered">
                  <table class="table table-bordered">
                    <?php
                    for($i = 1; $i <= 7; $i++)
                    {
                        if($i == 1)
                        {
                            echo "<tr>";
                            echo "<td></td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Monday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td>".$lecture['start_time']." - ".$lecture['end_time']."</td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                        if($i == 2)
                        {
                            echo "<tr>";
                            echo "<td>Monday</td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Monday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td><a href='".base_url()."attendance/insert/".$lecture['code']."'>";
                                        echo "<div>".$lecture['subject_name']."</div>";
                                        echo "<div>".$lecture['teacher_name']."</div>";
                                        echo "</a></td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                        if($i == 3)
                        {
                            echo "<tr>";
                            echo "<td>Tuesday</td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Tuesday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td><a href='".base_url()."attendance/insert/".$lecture['code']."'>";
                                        echo "<div>".$lecture['subject_name']."</div>";
                                        echo "<div>".$lecture['teacher_name']."</div>";
                                        echo "</a></td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                        if($i == 4)
                        {
                            echo "<tr>";
                            echo "<td>Wednesday</td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Wednesday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td><a href='".base_url()."attendance/insert/".$lecture['code']."'>";
                                        echo "<div>".$lecture['subject_name']."</div>";
                                        echo "<div>".$lecture['teacher_name']."</div>";
                                        echo "</a></td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                        if($i == 5)
                        {
                            echo "<tr>";
                            echo "<td>Thursday</td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Thursday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td><a href='".base_url()."attendance/insert/".$lecture['code']."'>";
                                        echo "<div>".$lecture['subject_name']."</div>";
                                        echo "<div>".$lecture['teacher_name']."</div>";
                                        echo "</a></td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                        if($i == 6)
                        {
                            echo "<tr>";
                            echo "<td>Friday</td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Friday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td><a href='".base_url()."attendance/insert/".$lecture['code']."'>";
                                        echo "<div>".$lecture['subject_name']."</div>";
                                        echo "<div>".$lecture['teacher_name']."</div>";
                                        echo "</a></td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                        if($i == 7)
                        {
                            echo "<tr>";
                            echo "<td>Saturday</td>";
                            foreach ($lecture_detail as $lecture) {
                                if($lecture['day'] == "Saturday")
                                {
                                    if($lecture['start_time'] == "Break")
                                    {
                                        echo "<td>Break</td>";
                                    }
                                    else
                                    {
                                        echo "<td><a href='".base_url()."attendance/insert/".$lecture['code']."'>";
                                        echo "<div>".$lecture['subject_name']."</div>";
                                        echo "<div>".$lecture['teacher_name']."</div>";
                                        echo "</a></td>";
                                    }
                                }
                            }
                            echo "</tr>";
                        }
                    } 
                    ?>
                    
                    
                  </table>
                </div><!-- // end col-lg-12 -->
              </div><!-- // end row -->
              <div class="row">
                <div class="col-lg-11 col-centered">
                  <?php
                  if($batch_comment['comment'] != "")
                  {
                    ?>
                      <div class="note">Note:</div>
                      <div class="comment">
                        <?php echo $batch_comment['comment']; ?>
                      </div>
                    <?php
                  } 
                   ?>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-centered">
                  <div class="row">
                    <div class="col-lg-6">
                        <a href="<?php echo base_url(); ?>pdf/lecture/<?php echo $batch_id; ?>" target="_blank">
                        <div class="submit-btn">PDF</div>
                      </a>
                    </div>
                    <div class="col-lg-6">
                      <a href="<?php echo base_url(); ?>study/editlecture/<?php echo $batch_id; ?>">
                        <div class="submit-btn">Edit</div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <?php   
            }
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
