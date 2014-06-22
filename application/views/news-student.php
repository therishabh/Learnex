<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
	News
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
									View News
								</div>
								<!-- // end subject form heading -->
								<div class="col-lg-8">
									
								</div><!-- end success msg -->
								<div class="col-lg-1 edit">

									<div class="current-news-id" style="display:none;"></div>
								</div>

							</div><!-- // end row -->
						</div><!-- // end col-lg-12 -->
					</div><!-- // end row -->

					<div class="staff-right-div news-right-div">
						
					</div><!-- end staff-right-div -->
					
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
	


		$(".title-search").keyup(function() {
			var title = $('.title-search').val();
			var type = $(".type-search").val();
			var status = $(".status-search").val();
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
			var status = $(".status-search").val();
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
					url: '<?php echo base_url();?>index.php/news/update_student_news',
					type: 'POST',
					data: {news_id: news_id},
					success: function(result){
						
					}
				});
			}

		});

	});
</script>