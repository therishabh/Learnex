<!-- heading -->
<div class="row heading">
	<div class="col-lg-3">
		Teacher Timetable
	</div>
	<div class="col-lg-6">

	</div>
	<div class="col-lg-3">
		
	</div>
</div>
<!-- // end heading -->


<?php
//check if there is any organization set or not
//execute if there is no any organization in database
//then firstly set organization..
if($organization_detail['name'] == "")
{
?>
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1 alert-msg">
			There is no any organization set so you can not view Timetable. !
		</div>
	</div>
	
<?php
}
else{
?>

<div class="select-student-id" style="display:none;"></div>
<div class="row lecture-scheduling">
	<div class="col-lg-12">


	<div class="row" style="margin-top:10px; margin-bottom:10px;">
		<div class="col-lg-10 col-centered">
			<div class="row view-course-batch">
				<div class="col-lg-8 col-centered">
					<span>Teacher Name : </span>
					<?php echo $user_detail['name']; ?> 
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-11 col-centered dispaly-teacher-timetable">
			<div class="select-teacher">
				
			<?php
			$end_time_1 = 0;
            $end_time_2 = 0;
            $end_time_3 = 0;
            $end_time_4 = 0;
            $end_time_5 = 0;
            $end_time_6 = 0;
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
                			<?php echo $lecture['batch_name']; ?>
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
                          <?php echo $lecture['batch_name']; ?>
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
                			<?php echo $lecture['batch_name']; ?>
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
                          <?php echo $lecture['batch_name']; ?>
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
                			<?php echo $lecture['batch_name']; ?>
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
                          <?php echo $lecture['batch_name']; ?>
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
                			<?php echo $lecture['batch_name']; ?>
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
                          <?php echo $lecture['batch_name']; ?>
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
                			<?php echo $lecture['batch_name']; ?>
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
                          <?php echo $lecture['batch_name']; ?>
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
                			<?php echo $lecture['batch_name']; ?>
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
                          <?php echo $lecture['batch_name']; ?>
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
                    <a href="<?php echo base_url(); ?>pdf/teachertimetable/<?php echo $user_detail['id']; ?>" target="_blank">
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
			?>

			</div>
		</div>
	</div>

	</div>
</div>
</div>


<?php 
}
?>