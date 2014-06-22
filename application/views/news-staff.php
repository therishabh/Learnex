<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		News
	</div>
	<div class="col-lg-6">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-6">
				<a href="<?php echo base_url();?>news"><div class="submit-btn">Add News</div></a>
			</div>
		</div>
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
			There is no any organization so first set organization details
			<?php echo anchor('setting/organization','click here'); ?>
		</div>
	</div>
	
<?php
}
//if organization is exist in database..
else{
?>


<div class="row location news">
	<div class="col-lg-12">
		<div class="row">


			<!-- left hand site division -->
			<div class="col-lg-6 left-side">
				<!-- search bar -->
				<div class="row">
					<div class="col-lg-8 search-bar staff-search">
						<input type="text" class="search-staff title-search"  placeholder="Title..">
					</div>
					<div class="col-lg-4 search-bar" style="padding-left:0px;">
						<select name="" id="batch" class="type-search">
							<option value=""> News Type</option>
							<?php
							foreach($news_type_list as $news)
							{
								echo '<option value="'.$news['id'].'">'.$news['name'].'</option>';
							}
							?>
						</select>
						
					</div>
					
				</div>
				<!-- // end search bar -->

				<div class="row section">
					<div class="col-lg-12" style="padding-right:0px;">		
						<div class="view-grid staff-grid news-grid">
						
						<?php

						if($no_of_news > 0)
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
						?>

							
						</div><!-- end view-grid -->
					</div><!-- end  class="col-lg-12" -->
				</div><!-- end row section -->

			</div><!-- // end<div class="col-lg-6 left-side"> -->
			<!-- // end left hand site division -->



			<div class="col-lg-6 right-side">

				<div class="display-div staff">
						
					<div class="row" style="padding:6px 15px;">
						<div class="col-lg-12 location-heading">
							<div class="row">
								<!-- course form heading -->
								<div class="col-lg-3 right-heading">
									Add News
								</div>
								<!-- // end subject form heading -->
								<div class="col-lg-8">
									<div class="msg success-msg">
										<?php
										if( $this->session->userdata('insert_news') != "" )
										{
											echo "News Has Been Successfully Added.";
										}
										else if( $this->session->userdata('update_news') != "" )
										{
											echo "News Has Been Successfully Updated.";
										}
										?>
									</div>
									
								</div><!-- end success msg -->
								<div class="col-lg-1 edit">

									<div class="current-news-id" style="display:none;"></div>
									<img src="<?php echo base_url()?>/img/edit-icon.png" alt="" class="edit-btn" title="Edit User">
								</div>

							</div><!-- // end row -->
						</div><!-- // end col-lg-12 -->
					</div><!-- // end row -->

					<?php echo form_open_multipart('news','id="news-form"');?>
					<div class="staff-right-div news-right-div">
						<div class="row">
							<div class="col-lg-10 col-centered">
								<div class="row">
									<div class="col-lg-4">
										<div class="label-text">News Title</div>
									</div>
									<div class="col-lg-8">
										<div><input type="text" class="form-control" id="news_title" name="news_title"></div>
									</div>
								</div>
								<div class="row" style="margin-top:10px;">
									<div class="col-lg-4">
										<div class="label-text">News Desc.</div>
									</div>
									<div class="col-lg-8">
										<div><textarea name="news_desc" id="news_desc" rows="5" class="form-control"></textarea></div>
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
												foreach($news_type_list as $news)
												{
													echo '<option value="'.$news['id'].'">'.$news['name'].'</option>';
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
					                                <input type='text' class="form-control" name="publish_date" id="publish_date" value="<?php echo $today_date; ?>" />
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
													<input type="radio" checked name="share_with"  value="all" id="share-all" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
									<div class="col-lg-4">
										<div class="row">
											<div class="col-lg-5">Custome</div>
											<div class="col-lg-4">
												<label>
													<input type="radio" name="share_with"  value="custome" id="share-custome" class="radio">
													<div class="radio-img"></div>
												</label>
											</div>
										</div>
									</div>
								</div>

								<div class="row share-person">
									<div class="col-lg-8 col-lg-offset-4">
										<div class="row">
											
											<div class="col-lg-6">
												<div style="text-align:center;">Teacher</div>
												<div style="text-align:center;margin-top:2px;">
													<label>
														<input type="checkbox" class="checkbox share-checkbox" value="teacher" name="share_custome[]">
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

								<div class="row" style="margin-top:10px;">
									<div class="col-lg-4">
										<div class="label-text">Attachment</div>
									</div>
									<div class="col-lg-6 col-lg-offset-1">
										<label style="width:100%;">
											<input type="file" style="display:none;" name="image" id="file">
											<div class="upload-file">Upload File</div>
										</label>
									</div>
								</div>

								<!-- save and cancle button -->
								<div class="row" style="margin-top:15px;">
									<div class="col-lg-3 col-lg-offset-3">
										<input type="hidden" name="insert_btn" value="success">
										<div class="submit-btn form-submit-btn save-btn">Save</div>
									</div>
									<div class="col-lg-3">
										<div class="cancel-btn" id="reset">Cancle</div>
									</div>
								</div>
								<!-- //end save and cancle button -->

							</div>
						</div>
					</div><!-- end staff-right-div -->
					<?php echo form_close(); ?>
				</div>
			</div>


		</div><!-- end <div class="row"> -->
	</div>
</div>
<?php 
}
?>

<script type="text/javascript">
	jQuery(document).ready(function($) {
	
		$('#datetimepicker1').datetimepicker({
	        pickTime: false
	    });
	    $('#datetimepicker2').datetimepicker({
	        pickTime: false
	    });


		$(".share-person").hide();

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

		$(".title-search").keyup(function() {
			var title = $('.title-search').val();
			var type = $(".type-search").val();
			$.ajax({
				url: '<?php echo base_url();?>index.php/news/search_news',
				type: 'POST',
				data: {title:title, type:type, status:status},
				success: function(result){
					$(".news-grid").html(result);
				}
			});

		});

		$(".type-search").change(function() {

			var title = $('.title-search').val();
			var type = $(".type-search").val();
			$.ajax({
				url: '<?php echo base_url();?>index.php/news/search_news',
				type: 'POST',
				data: {title:title, type:type, status:status},
				success: function(result){
					$(".news-grid").html(result);
				}
			});

		});



		//execute when click on any student on left panel for view News full details..
		$(".news").on('click', '.bottom-label', function() {
			var news_id = $(this).attr('id');
			$(".bottom-label").removeClass('selected');
			
			$(this).addClass('selected');

			$(".right-heading").text('View News');
			$(".edit .current-news-id").text(news_id);
			$(".edit").hide();
			$(".edit-btn").hide();
			$.ajax({
				url: '<?php echo base_url();?>index.php/news/view_news',
				type: 'POST',
				data: {news_id: news_id},
				success: function(result){
					$(".news-right-div").html(result);
					$('.news-right-div').animate({scrollTop:0}, 'slow');
					var active_status = $(".active_status").text();				
					var news_create_user = $(".news_create_user").text();
					var login_username = $(".login_username").text();
					//if login staff username is same as created_news_username then execute this code..
					if(login_username == news_create_user)
					{
						//if active status is false (0) then execute this code. 
						//display edit button..
						if(active_status == '0')
						{
							$(".edit").show();
							$(".edit-btn").show();
						}
					}
				}
			});

			var classes = $(this).attr('class');
			var unread_class = classes.split(' ');
			if(unread_class[1] == "unread")
			{
				var news_noti = $(".news-noti").text();
				var new_news_noti = parseInt(news_noti) - 1;
				$(".news-noti").text(new_news_noti);
				
				$(this).removeClass('unread');
				$.ajax({
					url: '<?php echo base_url();?>index.php/news/update_staff_news',
					type: 'POST',
					data: {news_id: news_id},
					success: function(result){
						
					}
				});
			}

		});

		

		//execute when click on submit button for save or update news into database..
		$(".news").on('click', '.form-submit-btn', function() {
			
			var flag_share = 1;
			
			if($("#news_title").val() == "")
			{
				$("#news_title").parent().addClass('has-error');
				var flag_title = 0;
			}
			else
			{
				var flag_title = 1;
			}

			if($("#news_desc").val() == "")
			{
				$("#news_desc").parent().addClass('has-error');
				var flag_desc = 0;
			}
			else
			{
				var flag_desc = 1;
			}

			if($("#news-type").val() == "")
			{
				$("#news-type").parent().addClass('has-error');
				var flag_type = 0;
			}
			else
			{
				var flag_type = 1;
			}

			if($("#publish_date").val() == "")
			{
				$("#publish_date").parent().addClass('has-error');
				var flag_date = 0;
			}
			else
			{
				var flag_date = 1;
			}

			if( $(".radio").val() == "custome" )
			{
				if($(".share-checkbox").length == "0")
				{
					alert("Please Select Any Share Option !");
					flag_share = 0;
				}
				else
				{
					flag_share = 1;
				}
			}

			if(flag_title == 1 && flag_desc == 1 && flag_type == 1 && flag_date == 1 && flag_share == 1)
			{
				$(".form-submit-btn").removeClass('form-submit-btn');
				$("#news-form").submit();
			}
		});

		//execute when click on edit button for edit any news..
		$(".edit-btn").click(function() {
			var news_id = $(".current-news-id").text();

			$(".news-right-div").html("");
			
			$.ajax({
				url: "<?php echo base_url();?>index.php/news/edit_news",
				type: 'POST',
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				data: {news_id:news_id},
				success: function(result){
					$(".news-right-div").html(result);
					$(".right-heading").text('Update News');
					$(".edit-btn").hide();
					// alert(result);
				}
			});
			
		});


		<?php
		//execute after Course is successfully Added and show success msg.
	  	// 
		if( $this->session->userdata('insert_news') )
		{
		?>
			
			$(".1").css({
				backgroundColor: 'rgb(142, 213, 114)'
			});

			$(".1").animate({
		    	backgroundColor:"#fff"
		  	},9000);
			
			$(".success-msg").delay(5000).fadeOut(1000);
	  	
	  	<?php
	  	}
	  	if( $this->session->userdata('update_news') )
		{
		?>
			var id = "<?php echo $this->session->userdata('update_news') ?>";
			$("#"+id).css({
				backgroundColor: 'rgb(142, 213, 114)'
			});

			$("#"+id).animate({
		    	backgroundColor:"#fff"
		  	},9000);
			
			$(".success-msg").delay(5000).fadeOut(1000);

			var p = $( "#"+id );

			var offset = p.offset();
			var top_value = parseFloat(offset.top) - 200;
			$('.staff-grid').animate({scrollTop:top_value}, 'slow');
	  	
	  	<?php
	  	}
	  	?>

	
	});
</script>


<?php
$this->session->unset_userdata('update_news');
$this->session->unset_userdata('insert_news');
?>