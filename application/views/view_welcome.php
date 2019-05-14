<div id="welcome" style="height:150px">
	<a href="<?php echo base_url('home'); ?>">
		<img src="<?php echo base_url('assets/images/general/logo.png'); ?>">
	</a>
</div>
<script type="text/javascript">
function arg(){
	$("#welcome img").each(function(){
		//get height and width (unitless) and divide by 2
		var hWide = (750)/2; //half the image's width
		var hTall = (120)/2; //half the image's height, etc.
                
                var wh = ($(window).height())/2; //half the window height

		// attach negative and pixel for CSS rule
		hWide = '-' + hWide + 'px';
		hTall = '-' + hTall + 'px';

		//Set width
		if($('#welcome').width() <= 767){
			$(this).css({
				'width'		: '90%',
				'margin-top' 	: hTall,
				'margin-left'	: '5%',
				'margin-right'	: '5%',
				'left'		: '0',
                                'top'           : wh
			});
		}else{
			$(this).css({
				'width'		: 'auto',
				'margin-top' 	: hTall,
				'margin-left'	: hWide,
				'margin-right'	: '0',
				'left'          : '50%',
                                'top'           : wh
			});
		}
	});
}

$(window).ready(arg);
$(window).resize(arg);
</script>