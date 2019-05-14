<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>JoscelynOpal - Under Maintenance</title>
	<style type="text/css">
		* {
			padding:0;
			margin:0;
		}
		
		body {
			overflow:hidden;
		}
		
		.main_image_v2 {
			position: absolute;
			top: 50%;
			left: 50%;
			width: 640px;
			height: 228px;
			margin-left: -320px; /* Half the width */
			margin-top: -114px; /* Half the height */
		}

		@media only screen and (max-width: 768px){
			.main_image_v2 {
				width:400px;
				height:143px;
				margin-left: -200px; /* Half the width */
				margin-top: -71.5px; /* Half the height */
			}
		}

		@media only screen and (max-width: 500px){
			.main_image_v2 {
				width:350px;
				height:125px;
				margin-left: -175px; /* Half the width */
				margin-top: -62.5px; /* Half the height */
			}
		}
	</style>
</head>
<body>
	<img src="<?php echo base_url('assets/images/general/maintenance.png'); ?>" class="main_image_v2"/>
</body>
</html>