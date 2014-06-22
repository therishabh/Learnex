<!-- heading -->
<div class="row heading">
	<div class="col-lg-6">
		Manage News
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
					<div class="col-lg-4 search-bar staff-search">
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
					<div class="col-lg-4 search-bar staff-search" style="padding-left:0px;">
						<select name="" id="batch" class="status-search">
							<option value="">Status</option>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
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
									<div class="status-btn"></div>
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
											<div class="col-lg-4">
												<div style="text-align:center;">Admin</div>
												<div style="text-align:center;margin-top:2px;">
													<label>
														<input type="checkbox"  class="checkbox share-checkbox" value="admin" name="share_custome[]">
														<div class="checkbox-img"></div>
													</label>
												</div>
											</div>
											<div class="col-lg-4">
												<div style="text-align:center;">Staff</div>
												<div style="text-align:center;margin-top:2px;">
													<label>
														<input type="checkbox" class="checkbox share-checkbox" value="staff" name="share_custome[]">
														<div class="checkbox-img"></div>
													</label>
												</div>
											</div>
											<div class="col-lg-4">
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

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
				<div class="modal-close-btn">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

				</div>
		    	<div class="modal-border">
				     <div class="modal-heading">Edit News Type</div>
			    	<div class="row">
			    		<div class="col-lg-9 col-centered">
			    			<input type="text" class="form-control modal-search" placeholder="Type News Type.." >
			    		</div>
			    	</div>
			    	<table class="table">
			    		<thead>
				    		<tr>
				    			<th>S No.</th>
				    			<th>News Type</th>
				    			<th></th>
				    		</tr>
			    		</thead>
			    		<tbody id="news_type_tbody">
			    		<?php
			    		$i = 1;
			    		foreach($news_type_list as $news)
						{
							if($news['id'] == 1)
							{
								echo "<tr>";
								echo "<td class='sno'>".$i."</td>";
								echo "<td class='news_type_edit' id='".$news['id']."'>".$news['name']."</td>";
								echo "<td></td>";
								echo "</tr>";

							}
							else
							{
								echo "<tr>";
								echo "<td class='sno'>".$i."</td>";
								echo "<td class='news_type_edit' id='".$news['id']."'>".$news['name']."</td>";
								echo "<td><img src='".base_url()."img/crose-icon.png' alt='' class='delete_news_type'></td>";
								echo "</tr>";
							}
							$i++;
						}
			    		?>

			    		</tbody>
			    	</table>
			    	<div class="row">
				    	<div class="col-lg-offset-8 col-lg-4 news-type-add-row text-right">
							<div>
								<img src="img/iconmonstr-plus-icon.png" alt=""> <span>Add New</span>
							</div>
						</div>
			    	</div>
		    	</div>
		  </div>
		</div>
		<!-- end modal -->

	</div>
</div>
<div class="hidden_news_type" style="display:none;"></div>
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


		$(".status-search").change(function() {

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
			$(".edit").show();
			$(".edit-btn").show();
			$.ajax({
				url: '<?php echo base_url();?>index.php/news/view_news',
				type: 'POST',
				data: {news_id: news_id},
				success: function(result){
					$(".news-right-div").html(result);
					$('.news-right-div').animate({scrollTop:0}, 'slow');
					var active_status = $(".active-status").text();
					if(active_status == "1")
					{
						$(".success-msg").text("");
						$(".status-btn").text("Active");
						$(".status-btn").removeClass('inactive-btn');
						$(".status-btn").addClass('active-btn');
					}
					else
					{
						$(".success-msg").text("");
						$(".status-btn").text("Inactive");
						$(".status-btn").removeClass('active-btn');
						$(".status-btn").addClass('inactive-btn');
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
					url: '<?php echo base_url();?>index.php/news/update_admin_news',
					type: 'POST',
					data: {news_id: news_id},
					success: function(result){
						
					}
				});

			}
		});

		//execute when click on inactive button for activate any news..
		$(".news").on('click', '.inactive-btn', function(event) {
			var news_id = $(".current-news-id").text();
			if(confirm("Do you want to Active this News ?"))
			{
				$.ajax({
					url: "<?php echo base_url();?>index.php/news/active_news",
					type: 'POST',
					// dataType: 'default: Intelligent Guess (<O></O>ther values: xml, json, script, or html)',
					data: {news_id : news_id},
					success: function(result){
						$(".success-msg").text("");
						$(".status-btn").text('Active');
						$(".status-btn").removeClass('inactive-btn')
						$(".status-btn").addClass('active-btn');
						$(".selected .status").text('Active');
						$(".selected .status").css({
							color: 'rgb(2, 131, 2)'
						});
					}
				});
			}
		});
		
		//execute when click on active button for deactivate any news..
		$(".news").on('click', '.active-btn', function(event) {
			var news_id = $(".current-news-id").text();
			if(confirm("Do you want to Inactive this News ?"))
			{
				$.ajax({
					url: "<?php echo base_url();?>index.php/news/inactive_news",
					type: 'POST',
					// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
					data: {news_id : news_id},
					success: function(result){
						$(".success-msg").text("");
						$(".status-btn").text('Inactive');
						$(".status-btn").removeClass('active-btn')
						$(".status-btn").addClass('inactive-btn');
						$(".selected .status").text('Inactive');
						$(".selected .status").css({
							color: 'rgb(172, 3, 3)'
						});
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

	  	// modal script
	  	$(".modal-search").keyup(function() {
	  		var news_type = $(this).val();
	  		$.ajax({
				url: "<?php echo base_url();?>index.php/news/news_type_search",
				type: 'POST',
				// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
				data: {news_type:news_type},
				success: function(result){
					$("#news_type_tbody").html(result);
				}
			});
	  	});

	  	//make td editable when click on it..
		$("#news_type_tbody").on('click','.news_type_edit',function(){
			//Category Content Update
			$(".news_type_edit").attr('contentEditable',false);
			var news_type_id = $(this).attr("id");
			if(news_type_id != 1)
			{
				$(this).attr("contentEditable",'true');
			}
			else
			{
				alert('You can not edit Misc category !');
			}

			$(this).focus();
		});	
		//end make td editable when click on it..


		//update News Type when focusout category div
		$("#news_type_tbody").on('focusout','.news_type_edit',function(){
			var name = $(this).text();
			var news_type_id = $(this).attr("id");
			//check if category is empty
			if(name == "")
			{
				alert("Please do not leave blank !");
				$(this).text($(".hidden_news_type").text());
				$(this).focus();
			}
			//if catgory is not empty
			else
			{
				$.ajax({
					url: "<?php echo base_url();?>index.php/news/news_type_update",
					type: 'POST',
					// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
					data: {id:news_type_id , name : name},
					success: function(result){
						$.ajax({
							type:"POST",
							url:"<?php echo base_url();?>index.php/news/news_type_list_update",
							data: {hello : "success"},
							success : function(result){
								$('#news-type').html(result)
							}
						});
					}
				});
			}
		});//end focusout

		//store category value into hidden_category division on focus in..
		$("#news_type_tbody").on('focusin','.news_type_edit',function(){
			$(".hidden_news_type").text($(this).text());
		});
		
		//return false when click enter button in category div
		$("#news_type_tbody").on('keypress','.news_type_edit , .new_news_type',function(e){
			if(e.which == 13)
			{
				$(this).blur();
				return false;
			}
		});

		//delete category when click on delete button in category modal
		$("#news_type_tbody").on('click','.delete_news_type',function(){
			var news_type_id = $(this).parent().prev().attr("id");
			var name = $(this).parent().prev().text();
			var this_tr = $(this).parent().parent();
			// alert("su");
			if(name != "")
			{
				//show confirmation message..
				var confirm_msg = confirm("Do you want to delete '"+ name +"' ?");
				//if confirmation message is true
				if(confirm_msg == true)
				{

					$(this).parent().parent().fadeOut('700', function() {
						
						this_tr.remove();
						$("#news_type_tbody tr").each(function(id){
							var num = parseInt(id) + 1;
							$(this).children('.sno').html(num);
						});

					});
					
					//delete category into database..
					$.ajax({
						url: "<?php echo base_url();?>index.php/news/news_type_delete",
						type: 'POST',
						// dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
						data: {id:news_type_id},
						success: function(result){
							// alert(result);
							$.ajax({
								type:"POST",
								url:"<?php echo base_url();?>index.php/news/news_type_list_update",
								data: {hello : "success"},
								success : function(result){
									$('#news-type').html(result)
								}
							});
						}
					});
					
				}
			}
			else{
				$(this).parent().parent().fadeOut(700);
				$(this).parent().parent().remove();
			}			
		});


		//append new category row...
		$(".news-type-add-row").click(function()
		{
			var last_row_number = $('#news_type_tbody').children().last().children().first().text();
			var new_row_number = parseInt(last_row_number) + 1;
			var last_row_news_type= $('#news_type_tbody').children().last().children('.news_type_edit').text();
			var new_row = "<tr><td>"+new_row_number+"</td><td contenteditable='true' class='new_news_type'></td><td class='del'><img src='<?php echo base_url(); ?>img/crose-icon.png' alt='' class='delete_news_type'></td></tr>";
			
			if(last_row_news_type != "")
			{
				$("#news_type_tbody").append(new_row);
				$('#news_type_tbody').children().last().children('.new_news_type').focus();
			}
			else
			{
				$('#news_type_tbody').children().last().children('.new_news_type').focus();
			}
		});


		//insert new category..
		$("#news_type_tbody").on("focusout",'.new_news_type',function(){
			var name = $(this).text();
			if(name != "")
			{
				$(this).addClass('news_type_edit');
				$(this).removeClass('new_news_type');

				
				$.ajax({
					type:"POST",
					url:"<?php echo base_url();?>index.php/news/news_type_insert",
					data: {name : name},
					success : function(result){
						$('#news_type_tbody').children().last().children('.news_type_edit').attr('id', result);

						$.ajax({
							type:"POST",
							url:"<?php echo base_url();?>index.php/news/news_type_list_update",
							data: {hello : "success"},
							success : function(result){
								$('#news-type').html(result)
							}
						});
					}
				});

				
			}
		});

	});
</script>


<?php
$this->session->unset_userdata('update_news');
$this->session->unset_userdata('insert_news');
?>