<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class PDF extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
	}
	

	function lecture($id = "")
	{
		if($id != "")
		{

			$this->load->model('user_model');
	        // $batch_id = $_POST['batch_id'];
	        $batch_id = $id;
	        $batch_comment = $this->user_model->batch_comment($batch_id);
	        $batch_detail = $this->user_model->fetchbyid($batch_id,'batch');
	        if($batch_detail)
	        {

		        $course_id = $batch_detail['course'];
		        $course_detail = $this->user_model->fetchbyid($course_id,'course');
		        $lecture_detail = $this->user_model->lecture_detail($batch_id);
		        $pdf_name = $course_detail['name']." ".$batch_detail['name'];
		        $organization_details = $this->user_model->get_organization_details();
		    	ob_start();
		?>
		<style>
			table tr td{
				padding: 10px;
				text-align: center;
			}
		</style>

		<!-- write your code here -->
		<page orientation="paysage" >
			
			<div style="margin-top:20px; font-color:#000; font-size:32px; text-align:center; margin-bottom:20px; padding-bottom :4px; border-bottom:5px solid double;">
				<?php echo $organization_details['name']; ?>
			</div>

			<table style="padding-bottom:20px;" align="center">
				<tr >
					<td style="font-color:#000;font-size:22px;width:500px; text-align:center;"><span style="font-weight:bold;">Course : </span> <?php echo $course_detail['name']; ?></td>
					<td style="font-color:#000;font-size:22px;width:500px; text-align:center;"><span style="font-weight:bold;">Batch : </span> <?php echo $batch_detail['name']; ?></td>
				</tr>
			</table>
			

			<table style="width:100%" align="center" border="1" >
		    <?php
		    for($i = 1; $i <= 7; $i++)
		    {
		        if($i == 1)
		        {
		            echo "<tr style='background-color:#D0D0D0;'>";
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
		                        echo $lecture['subject_name'];
		                        echo "<br>";
		                        echo $lecture['teacher_name'];
		                        echo "</td>";
		                    }
		                }
		            }
		            echo "</tr>";
		        }
		        if($i == 3)
		        {
		            echo "<tr style='background-color:#EEEEEE'>";
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
		                        echo $lecture['subject_name'];
		                        echo "<br>";
		                        echo $lecture['teacher_name'];
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
		                        echo $lecture['subject_name'];
		                        echo "<br>";
		                        echo $lecture['teacher_name'];
		                        echo "</td>";
		                    }
		                }
		            }
		            echo "</tr>";
		        }
		        if($i == 5)
		        {
		            echo "<tr style='background-color:#EEEEEE'>";
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
		                        echo $lecture['subject_name'];
		                        echo "<br>";
		                        echo $lecture['teacher_name'];
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
		                        echo $lecture['subject_name'];
		                        echo "<br>";
		                        echo $lecture['teacher_name'];
		                        echo "</td>";
		                    }
		                }
		            }
		            echo "</tr>";
		        }
		        if($i == 7)
		        {
		            echo "<tr style='background-color:#EEEEEE'>";
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
		                        echo $lecture['subject_name'];
		                        echo "<br>";
		                        echo $lecture['teacher_name'];
		                        echo "</td>";
		                    }
		                }
		            }
		            echo "</tr>";
		        }
		    } 
		    ?>
		    
		  	</table>

		  	<div style="font-size:18px; margin-top:30px; margin-right:30px; margin-left:30px; text-align:justify;">	
		  	<?php
              if($batch_comment['comment'] != "")
              {
                ?>
                  <div style="font-weight:bold;font-size:22px;">Note:</div>
                  <div style="margin-top:10px;">
                    <?php echo $batch_comment['comment']; ?>
                  </div>
                <?php
              } 
               ?>
            </div>
		   
		</page>


		<!-- // write your code here -->

		<?php
		        $content = ob_get_clean();
		        require_once('/pdf123/html2pdf.class.php');
		        try
		        {
		            $html2pdf = new HTML2PDF('P', 'A4', 'fr');
		            $html2pdf->writeHTML($content);
		            $html2pdf->Output("$pdf_name.pdf");
		            exit;
		        }
		        catch(HTML2PDF_exception $e) {
		            echo $e;
		            exit;
		        }
	        }//end if condition ($batch_detail)

		}//end if condition($id != "")


	}//end function ()

	function teachertimetable($id = "")
	{
		ob_start();

		//check if there is teacher id exist or not..
		if($id != "")
		{
			$end_time_1 = 0;
	        $end_time_2 = 0;
	        $end_time_3 = 0;
	        $end_time_4 = 0;
	        $end_time_5 = 0;
	        $end_time_6 = 0;

			$teacher_id = $id;
			$this->load->model('user_model');
			$lecture_detail = $this->user_model->fetch_teacher_lecture($teacher_id);
			$organization_details = $this->user_model->get_organization_details();
			$pdf_name = $lecture_detail[0]['teacher_name']."_".$lecture_detail[0]['teacher_username']."_timetable";

			if($lecture_detail)
		    {
			?>
			<style>
			table tr td{
				padding: 10px;
				text-align: center;
			}
			</style>
			<!-- write your code here -->
			<page orientation="paysage" >
			
				<div style="margin-top:20px; font-color:#000; font-size:32px; text-align:center; margin-bottom:20px; padding-bottom :4px; border-bottom:5px solid double;">
					<?php echo $organization_details['name']; ?>
				</div>

				<table style="padding-bottom:20px;" align="center">
					<tr >
						<td style="font-color:#000;font-size:22px;width:500px; text-align:center;"><span style="font-weight:bold;">Staff Name : </span> <?php echo $lecture_detail[0]['teacher_name']; ?></td>
						<td style="font-color:#000;font-size:22px;width:500px; text-align:center;"><span style="font-weight:bold;">Username : </span> <?php echo $lecture_detail[0]['teacher_username']; ?></td>
					</tr>
				</table>
				
			     	<table style="width:100%" align="center" border="1">
			        <?php 
			        for($i = 1; $i < 7; $i++)
			        {
						if($i == 1)
						{
							echo "<tr>";
							echo "<td style='font-size:18px;font-weight:bold;'>Monday</td>";
							foreach($lecture_detail as $lecture)
							{
								if($lecture['day'] == "Monday")
								{
									if( strtotime($lecture['start_time']) < $end_time_1 )
									{
									?>
										<td style="background:rgb(180, 2, 2);color:#FFF; font-size:16px;">
											<?php
												echo $lecture['start_time'] ." - ". $lecture['end_time']; 
												echo "<br>";
												echo $lecture['subject_name'];
												echo "<br>";
												echo $lecture['batch_name'];
											?>
										</td>
									<?php
									}
									else
									{
									?>
										<td style="color:#000; font-size:16px;">
											<?php
												echo $lecture['start_time'] ." - ". $lecture['end_time']; 
												echo "<br>";
												echo $lecture['subject_name'];
												echo "<br>";
												echo $lecture['batch_name'];
											?>
										</td>
									<?php
									}//end else
									if(strtotime($lecture['end_time']) > $end_time_1)
				                    {
				                      $end_time_1 = strtotime($lecture['end_time']);
				                    }
								}//end if condition Monday..
							} //end foreach($lecture_detail as $lecture)
							echo "</tr>";
			        	}//end if if($i == 1)

			        	if($i == 2)
						{
							echo "<tr style='background-color:#EEEEEE'>";
							echo "<td style='font-size:18px;font-weight:bold;'>Tuesday</td>";
							foreach($lecture_detail as $lecture)
							{
								if($lecture['day'] == "Tuesday")
								{
									if( strtotime($lecture['start_time']) < $end_time_2 )
									{
									?>
										<td style="background:rgb(180, 2, 2);color:#FFF; font-size:16px;">
											<?php
												echo $lecture['start_time'] ." - ". $lecture['end_time']; 
												echo "<br>";
												echo $lecture['subject_name'];
												echo "<br>";
												echo $lecture['batch_name'];
											?>
										</td>
									<?php
									}
									else
									{
									?>
										<td style="color:#000; font-size:16px;">
											<?php
												echo $lecture['start_time'] ." - ". $lecture['end_time']; 
												echo "<br>";
												echo $lecture['subject_name'];
												echo "<br>";
												echo $lecture['batch_name'];
											?>
										</td>
									<?php
									}//end else
									if(strtotime($lecture['end_time']) > $end_time_2)
				                    {
				                      $end_time_2 = strtotime($lecture['end_time']);
				                    }
								}//end if condition Monday..
							} //end foreach($lecture_detail as $lecture)
							echo "</tr>";
			        	}//end if if($i == 2)

			        	if($i == 3)
						{
							echo "<tr>";
							echo "<td style='font-size:18px;font-weight:bold;'>Wednesday</td>";
							foreach($lecture_detail as $lecture)
							{
								if($lecture['day'] == "Wednesday")
								{
									if( strtotime($lecture['start_time']) < $end_time_3 )
									{
									?>
										<td style="background:rgb(180, 2, 2);color:#FFF; font-size:16px;">
											<?php
												echo $lecture['start_time'] ." - ". $lecture['end_time']; 
												echo "<br>";
												echo $lecture['subject_name'];
												echo "<br>";
												echo $lecture['batch_name'];
											?>
										</td>
									<?php
									}
									else
									{
									?>
										<td style="color:#000; font-size:16px;">
											<?php
												echo $lecture['start_time'] ." - ". $lecture['end_time']; 
												echo "<br>";
												echo $lecture['subject_name'];
												echo "<br>";
												echo $lecture['batch_name'];
											?>
										</td>
									<?php
									}//end else
									if(strtotime($lecture['end_time']) > $end_time_3)
				                    {
				                      $end_time_3 = strtotime($lecture['end_time']);
				                    }
								}//end if condition Monday..
							} //end foreach($lecture_detail as $lecture)
							echo "</tr>";
			        	}//end if if($i == 3)

			        	if($i == 4)
						{
							echo "<tr style='background-color:#EEEEEE'>";
							echo "<td style='font-size:18px;font-weight:bold;'>Thursday</td>";
							foreach($lecture_detail as $lecture)
							{
								if($lecture['day'] == "Thursday")
								{
									if( strtotime($lecture['start_time']) < $end_time_4 )
									{
									?>
										<td style="background:rgb(180, 2, 2);color:#FFF; font-size:16px;">
											<?php
												echo $lecture['start_time'] ." - ". $lecture['end_time']; 
												echo "<br>";
												echo $lecture['subject_name'];
												echo "<br>";
												echo $lecture['batch_name'];
											?>
										</td>
									<?php
									}
									else
									{
									?>
										<td style="color:#000; font-size:16px;">
											<?php
												echo $lecture['start_time'] ." - ". $lecture['end_time']; 
												echo "<br>";
												echo $lecture['subject_name'];
												echo "<br>";
												echo $lecture['batch_name'];
											?>
										</td>
									<?php
									}//end else
									if(strtotime($lecture['end_time']) > $end_time_4)
				                    {
				                      $end_time_4 = strtotime($lecture['end_time']);
				                    }
								}//end if condition Monday..
							} //end foreach($lecture_detail as $lecture)
							echo "</tr>";
			        	}//end if if($i == 4)

			        	if($i == 5)
						{
							echo "<tr>";
							echo "<td style='font-size:18px;font-weight:bold;'>Friday</td>";
							foreach($lecture_detail as $lecture)
							{
								if($lecture['day'] == "Friday")
								{
									if( strtotime($lecture['start_time']) < $end_time_5 )
									{
									?>
										<td style="background:rgb(180, 2, 2);color:#FFF; font-size:16px;">
											<?php
												echo $lecture['start_time'] ." - ". $lecture['end_time']; 
												echo "<br>";
												echo $lecture['subject_name'];
												echo "<br>";
												echo $lecture['batch_name'];
											?>
										</td>
									<?php
									}
									else
									{
									?>
										<td style="color:#000; font-size:16px;">
											<?php
												echo $lecture['start_time'] ." - ". $lecture['end_time']; 
												echo "<br>";
												echo $lecture['subject_name'];
												echo "<br>";
												echo $lecture['batch_name'];
											?>
										</td>
									<?php
									}//end else
									if(strtotime($lecture['end_time']) > $end_time_5)
				                    {
				                      $end_time_5 = strtotime($lecture['end_time']);
				                    }
								}//end if condition Monday..
							} //end foreach($lecture_detail as $lecture)
							echo "</tr>";
			        	}//end if if($i == 5)

			        	if($i == 6)
						{
							echo "<tr style='background-color:#EEEEEE'>";
							echo "<td style='font-size:18px;font-weight:bold;'>Saturday</td>";
							foreach($lecture_detail as $lecture)
							{
								if($lecture['day'] == "Saturday")
								{
									if( strtotime($lecture['start_time']) < $end_time_6 )
									{
									?>
										<td style="background:rgb(180, 2, 2);color:#FFF; font-size:16px;">
											<?php
												echo $lecture['start_time'] ." - ". $lecture['end_time']; 
												echo "<br>";
												echo $lecture['subject_name'];
												echo "<br>";
												echo $lecture['batch_name'];
											?>
										</td>
									<?php
									}
									else
									{
									?>
										<td style="color:#000; font-size:16px;">
											<?php
												echo $lecture['start_time'] ." - ". $lecture['end_time']; 
												echo "<br>";
												echo $lecture['subject_name'];
												echo "<br>";
												echo $lecture['batch_name'];
											?>
										</td>
									<?php
									}//end else
									if(strtotime($lecture['end_time']) > $end_time_6)
				                    {
				                      $end_time_6 = strtotime($lecture['end_time']);
				                    }
								}//end if condition Monday..
							} //end foreach($lecture_detail as $lecture)
							echo "</tr>";
			        	}//end if if($i == 6)

			        }//end for loop condition  for($i = 1; $i < 7; $i++)
			        echo "</table>";
			        echo "</page>";
			    }//end // if($lecture_detail)
			    else
			    {
			    	//redirect teacher timetable page..
            		redirect('study/teacherlecture','refresh');
			    }
			    ?>
			<!-- // end write your code here -->

			<?php
			$this->session->unset_userdata('end_time_1');
        	$this->session->unset_userdata('end_time_2');
	        $this->session->unset_userdata('end_time_3');
	        $this->session->unset_userdata('end_time_4');
	        $this->session->unset_userdata('end_time_5');
	        $this->session->unset_userdata('end_time_6');

        	$content = ob_get_clean();
			require_once('/pdf123/html2pdf.class.php');
			try
			{
			    $html2pdf = new HTML2PDF('P', 'A4', 'fr');
			    $html2pdf->writeHTML($content);
			    $html2pdf->Output("$pdf_name.pdf");
			    exit;
			}
			catch(HTML2PDF_exception $e) 
			{
			    echo $e;
			    exit;
			}

		}
	}//end function teachertimetable();
	    
	function studentprofile($code = "")
	{
		ob_start();

		//check if there is teacher id exist or not..
		if($code != "")
		{
			$this->load->model('user_model');
			$organization_details = $this->user_model->get_organization_details();
			$student_detail = $this->user_model->fetchbyfield('code',$code,'student');

			if($student_detail)
			{
				$course_detail = $this->user_model->fetchbyid($student_detail['course'],'course');
				$batch_detail = $this->user_model->fetchbyid($student_detail['batch'],'batch');
				?>
								
					<style type="text/css">
						table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
						    table.page_footer {width: 100%; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}

						    div.niveau
						    {
						        padding-left: 5mm;
						    }

						.odd{
						    height:auto;
						    background: #eff3fe;
						    
						    margin-right:5px;
						}
						.odd td{
						    font-weight:bold;
						       padding:10px 10px 10px 10px;
						   border-top:1px solid #bdcfff;
						    border-bottom:1px solid #bdcfff;
						}
						.right{
						  font-size:16px;
						    width: 450px;
						    color:#000000;
						    text-align: left;
						    font-weight: normal;
						}
						.left{
						  font-size:16px;
						    width:350px;
						    color:#0A4961;
						    text-align: right;
						}
						.even{
						    
						    height:auto;
						    background: #dae6ff;
						    margin-right:5px;
						}
						.even td{
						    
						    font-weight:bold;
						    border-top:1px solid #bdcfff;
						    border-bottom:1px solid #bdcfff;
						    padding:10px 10px 10px 10px;
						}
						.even .right{
						    font-weight: normal;
						}
						.profile-topbanner{
						    width: 185px;
						    height: 135px;
						    background: url(images/topbanner.png);
						}

						#new_profile_info_top {
						    margin:30px auto;
						    width:697px;
						}
						.profile_top_banner{
						    position:absolute;
						    float:right;
						    padding-left:528px;
						    margin-top:-10px;
						    
						}

						#student_main_info h3 {
						    margin:10;
						    padding-left:480px;
						    margin-top:25px;
						  font-size:30px;
						}
						h4 {
						    margin:0;
						  border:2px solid #ff0;
						    color:#000;
						    margin-top:10px;
						    font-size: 20px;
						}
						h3 {
						    font-size: 30px;
						    margin:0;
						     margin-top:10px;
						    color: #0A4961;
						}
						.left_col{
						  width:200px;
						}

						.name_clg{
						  margin-bottom:40px;
						  text-align:center;
						}

						#profile_picture_display{
						  margin-left:100px;
						  border:2px solid #0A4961;
						  width:123px;
						}

					</style>

					<page_footer>
					    <table class="page_footer">
					        <tr>
					            <td style="width:50%; text-align:left">
					                <?php 
					                date_default_timezone_set('Asia/Calcutta');
					                echo date("d M, Y");
					                ?>
					            </td>
					            <td style="width: 50%; text-align: right">
					                page [[page_cu]]/[[page_nb]]
					            </td>
					        </tr>
					    </table>
					</page_footer>

					<div style="margin-top:20px; font-color:#000; font-size:32px; text-align:center; margin-bottom:20px; padding-bottom :4px; border-bottom:5px solid double;">
					  <?php echo $organization_details['name']; ?>
					</div>

					<div style="width:740px; padding-top:14px;">                       
					    <div id="profile_picture_display">
					        <img src="<?php echo base_url() ?>uploads/student/<?php echo $student_detail['image'] ?>" alt="Default_Student" height="135" width="122" />
					    </div>

					    <div class ="student_main_info" style="margin-left:300px;margin-top:-150px;">
					      <h3><?php echo $student_detail['name']; ?></h3>
					      <h4><?php echo $student_detail['username']; ?></h4>
					      <h4><?php echo $course_detail['name']?></h4>
					      <h4>
					      	<?php
					      	if($batch_detail)
					      	echo $batch_detail['name']; 
					      	 ?>
					      </h4>
					      <br><br>
					    </div>
					</div> 

					 <table width="700"  align="center">
					    
					    <tr class="odd left">
					        <td class="left_col">User ID</td>
					        <td class="right"><?php echo $student_detail['username']; ?></td>
					    </tr>
					    
					    <tr class="even left">
					        <td class="left_col">Date of Birth</td>
					        <td class="right"><?php echo date('j, M Y',strtotime($student_detail['dob'])); ?></td>
					    </tr>
					    
					    <tr class="odd left">
					        <td class="left_col">Category</td>
					        <td class="right"><?php echo ucfirst($student_detail['username']); ?></td>
					    </tr>

					    <tr class="even left">
					        <td class="left_col">Gender</td>
					        <td class="right"><?php echo ucfirst($student_detail['gender']); ?></td>
					    </tr>


					    <tr class="odd left">
					        <td class="left_col">Blood Group</td>
					        <td class="right"><?php echo $student_detail['blood_group']; ?></td>
					    </tr>

					    <tr class="even left">
					        <td class="left_col">Date of Joining</td>
					        <td class="right"><?php echo date('j, M Y',strtotime($student_detail['doj'])); ?></td>
					    </tr>

					    <tr class="odd left">
					        <td class="left_col">Class</td>
					        <td class="right"><?php echo $student_detail['class']; ?></td>
					    </tr>

					    <tr class="even left">
					        <td class="left_col">Parent Relation</td>
					        <td class="right"><?php echo $student_detail['parent_relation']; ?></td>
					    </tr>

					    <tr class="odd left">
					        <td class="left_col">Parent Name</td>
					        <td class="right"><?php echo $student_detail['parent_name']; ?></td>
					    </tr>

					    <tr class="even left">
					        <td class="left_col">Parent Occupation</td>
					        <td class="right"><?php echo $student_detail['parent_occupation']; ?></td>
					    </tr>

					    <tr class="odd left">
					        <td class="left_col">Parent Phone No</td>
					        <td class="right"><?php echo $student_detail['parent_phone']; ?></td>
					    </tr>
						
						 <tr class="even left">
					        <td class="left_col">Parent Email Id.</td>
					        <td class="right"><?php echo $student_detail['parent_email']; ?></td>
					    </tr>

					    <tr class="odd left">
					        <td class="left_col">Student Phone</td>
					        <td class="right"><?php echo $student_detail['phone']; ?></td>
					    </tr>

					    <tr class="even left">
					        <td class="left_col">Student Email Id.</td>
					        <td class="right"><?php echo $student_detail['email']; ?></td>
					    </tr>

					    <tr class="odd left">
					        <td class="left_col">City</td>
					        <td class="right"><?php echo ucfirst($student_detail['city']); ?></td>
					    </tr>

					    <tr class="even left">
					        <td class="left_col">State</td>
					        <td class="right"><?php echo ucfirst($student_detail['state']); ?></td>
					    </tr>

					    <tr class="odd left">
					        <td class="left_col">Country</td>
					        <td class="right"><?php echo ucfirst($student_detail['country']); ?></td>
					    </tr>

					    <tr class="even left">
					        <td class="left_col">Current Address</td>
					        <td class="right"><?php echo ucfirst($student_detail['current_address']); ?></td>
					    </tr>

					    <tr class="odd left">
					        <td class="left_col">Permanent Address</td>
					        <td class="right"><?php echo ucfirst($student_detail['permanent_address']); ?></td>
					    </tr>

					</table>
					<!-- write your code here -->
				<?php
				
			}
			$content = ob_get_clean();
	        require_once('/pdf123/html2pdf.class.php');
	        try
	        {
	            $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
	            $html2pdf->writeHTML($content);
	            $html2pdf->Output($student_detail['name']."_".$student_detail['username'].".pdf");
	            exit;
	        }
	        catch(HTML2PDF_exception $e) {
	            echo $e;
	            exit;
	        }
		}
	}

	function studentlist($course = "",$batch = "")
	{
	 //get username from session..
    $username = $this->session->userdata('username');
    //then execute code.
    if(substr($username,0,5) == "admin")
    {
		if($course != "")
		{
			ob_start();
			$this->load->model('user_model');
			$organization_details = $this->user_model->get_organization_details();
			$student_detail = $this->user_model->getstudentlist($course,$batch);
			$course_detail = $this->user_model->fetchbyid($course,'course');
			$batch_detail = $this->user_model->fetchbyid($batch,'batch');
			?>
			<style type="text/css">
			table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
			table.page_footer {width: 100%; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
			h1 {color: #000033}
			h2 {color: #000055}
			h3 {color: #000077}

			div.niveau
			{
			padding-left: 5mm;
			}
			.main-table .even
			{
			background-color: #EDEDED;
			}
			.main-table .odd
			{
			background-color: #fff;
			}
			</style>
			<page_footer>
			    <table class="page_footer">
			        <tr>
			            <td style="width:50%; text-align:left">
			                <?php 
			                date_default_timezone_set('Asia/Calcutta');
			                echo date("d M, Y");
			                ?>
			            </td>
			            <td style="width: 50%; text-align: right">
			                page [[page_cu]]/[[page_nb]]
			            </td>
			        </tr>
			    </table>
			</page_footer>
			<div style="margin-top:20px; font-color:#000; font-size:32px; text-align:center; margin-bottom:20px; padding-bottom :4px; border-bottom:5px solid double;">
			    <?php echo $organization_details['name']; ?>
			</div>
			<table style="padding-bottom:20px;" align="center">
			    <tr >
			        <td style="font-color:#000;font-size:22px;width:350px; text-align:center;">
			            <span style="font-weight:bold;">Course : </span> 
			            <?php echo $course_detail['name']; ?>
			        </td>
			        <?php 
			        if($batch != "")
			        {
			        ?>
			        <td style="font-color:#000;font-size:22px;width:350px; text-align:center;">
			            <span style="font-weight:bold;">Batch : </span> 
			            <?php echo $batch_detail['name']; ?>
			        </td>
			        <?php
			        }
			        ?>
			    </tr>
			</table>
			<?php
			
			if($student_detail)
			{
				$i = 1;
				foreach($student_detail as $student)
				{
					$email = explode(',',$student['email']);
					$phone = explode(',',$student['phone']);
					$batch_detail = $this->user_model->fetchbyid($student['batch'],'batch');
				?>
				<table style="padding-bottom:0px;" align="center" >
				    <tr>
				        <td style="display:table-cell; vertical-align: middle; font-size:25px; font-weight:bold; padding:5px;">
				           <?php echo $i; ?>
				        </td>
				        <td>
				        	<table >
				                <tr style="width:100%; background-color:#0A4961; color:#fff;">
				                   <td style="width:378px; padding:5px; font-size:16px;"><?php echo ucfirst($student['name']); ?></td>
				                   <td style="width:293px;text-align:right; padding:5px; font-size:16px;"><?php echo $student['username']; ?></td>
				               </tr>
				            </table>
				            <table class="main-table">
				            	<?php
				            	if($i%2 == "0")
				            	{
				            		echo '<tr class="odd">';
				            	} 
				            	else
				            	{
				            		echo '<tr class="even">';
				            	}
				            	?>
				               
				                   <td style="padding:5px;">
				                        <img src="<?php echo base_url(); ?>uploads/student/<?php echo $student['image'] ?>" style="height:80px; width:70px;" alt="">
				                   </td>
				                   <td style="width:310px">
				                       <div style="padding-top:-7px; font-size:16px; padding-left:10px;"><?php echo date('j, M Y',strtotime($student['dob'])); ?></div>
				                       <div style="padding-top:2px; font-size:16px; padding-left:10px;"><?php echo ucfirst($student['gender']) ?></div>
				                       <div style="padding-top:10px; font-size:16px; padding-left:10px;"><?php echo $email[0]; ?></div>
				                   </td>
				                   <td style="width:310px;">
				                        <div style="padding-top:-7px; font-size:16px; text-align:right; padding-right:10px;"><?php echo $course_detail['name'] ?></div>
				                        <div style="padding-top:2px; font-size:16px; text-align:right; padding-right:10px;"><?php echo $batch_detail['name']; ?></div>
				                        <div style="padding-top:10px; font-size:16px; text-align:right; padding-right:10px;"><?php echo $phone[0]; ?></div>
				                   </td>
				               </tr>
				           </table>
				        </td>
    				</tr>
				</table>
				<?php
				$i++;
				}
			}
			$content = ob_get_clean();
	        require_once('/pdf123/html2pdf.class.php');
	        try
	        {
	            $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
	            $html2pdf->writeHTML($content);
	            $html2pdf->Output("studentlist_".$course_detail['name']."_".$batch_detail['name'].".pdf");
	            exit;
	        }
	        catch(HTML2PDF_exception $e) {
	            echo $e;
	            exit;
	        }
		}//end if condition..
		else
		{
			// //redirect to home page...
	        redirect('/home/', 'refresh');	
		}
    }
    else
    {
    	// //redirect to home page...
        redirect('/home/', 'refresh');	
    }
	}

}//end class
?>