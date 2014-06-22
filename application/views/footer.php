

			</div>
		</div>
	</div>


	<!-- // end main body for content -->

	<!-- right panel which is slider -->
	<div id="right-panel" class="ng-scope" >
		
		<!-- start close button -->
		
            <div class="row">
            	<div class="col-lg-2">
            		<div class="close-right-panel">x</div>
            	</div>
            </div>
		<!-- // end close button -->
		
		<!-- open image -->
        <a class="open-tab">Open</a>
		<!-- // end open image -->

	</div>
	<!-- // end right panel which is slider -->

	
<div id="preloader">
	<div id="status">&nbsp;</div>
</div>

<script type="text/javascript">

	$(window).load(function() { // makes sure the whole site is loaded
			$('#status').fadeOut(); // will first fade out the loading animation
			$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
			$('body').delay(350).css({'overflow':'visible'});
		})

</script>
</body>
</html>



<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.js"></script>

<script type="text/javascript">


	$("#right-panel .close-right-panel").click(function() {

		//execute an ajax operation when click on close tab for panel close
		//this ajax execute and close a session open-panel which is help to identify for right panel
		//is close or open..
		$.ajax({
			url: '<?php echo base_url();?>index.php/setting/rightpanel',
			type: 'POST',
			data: {close : "success"}
		});

		$("#right-panel").removeClass('right-panel-webkit');
		$(".main-body").css({
			width: 'calc(100% - 70px)'
		});
		$("#right-panel .open-tab").show();
	});

	$("#right-panel .open-tab").click(function() {

		//execute an ajax operation when click on open tab for panel open
		//this ajax execute and start a session open-panel which is help to identify for right panel
		//is close or open..
		$.ajax({
			url: '<?php echo base_url();?>index.php/setting/rightpanel',
			type: 'POST',
			data: {open : "success"}
		});

		$("#right-panel").addClass('right-panel-webkit');
		$(".main-body").css({
			width: 'calc(100% - 330px)'
		});
		$("#right-panel .open-tab").hide();
	});

	// script for automatic open right side panel
	// when right side panel is one time open then automatic open on all pages..
	// check open-panel session if this session is set this means panel is open 
	// otherwise panel is close..
	<?php
	if( $this->session->userdata('open-panel') )
	{
	?>
		$("#right-panel").addClass('right-panel-webkit');
		$(".main-body").css({
			width: 'calc(100% - 330px)'
		});
		$("#right-panel .open-tab").hide();
	<?php
	}
	else
	{
	?>
		$("#right-panel").removeClass('right-panel-webkit');
		$(".main-body").css({
			width: 'calc(100% - 70px)'
		});
		$("#right-panel .open-tab").show();
	<?php
	}
	?>


	$(".main-body").on('click', '.checkbox', function() {
		
		if( $(this).is(":checked") )
		{
			$(this).next('.checkbox-img').css({
				background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 1px'
			});
		}
		else
		{
			$(this).next('.checkbox-img').css({
				background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -23px 1px'
			});
		}
	});

	$(".main-body").on('click', '.radio', function() {
		
		if( $(this).is(":checked") )
		{
			var name = $(this).attr('name');
			
			$('.radio').each(function(){

				if( $(this).attr('name') == name )
				{
					$(this).next(".radio-img").css({
						background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -143px 0px'
					});
				}

			});

			$(this).next('.radio-img').css({
				background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -167px 0px'
			});
		}
		else
		{
			$(this).next('.radio-img').css({
				background: 'url(../img/blue.png) no-repeat -143px 0px'
			});
		}
	});

	if( $('.checkbox').is(":checked") )
	{
		$(".checkbox:checked").next('.checkbox-img').css({
			background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -47px 1px'
		});
	}

	if( $('.radio').is(":checked") )
	{
		$(".radio:checked").next('.radio-img').css({
			background: 'url(<?php echo base_url();?>img/blue.png) no-repeat -167px 0px'
		});
	}

</script>