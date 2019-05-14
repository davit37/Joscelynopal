<!DOCTYPE html>
<html dir="ltr" lang="en">
    <head>
        <meta charset="UTF-8" />
        <?php
        $web_title = 'Joscelyn Opal';
        if (isset($title) ) {
            $web_title = $title . ' - ' . $web_title;
        }
        ?>
        <title><?php echo $web_title ?></title>

        <!-- FAVICON -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url("assets/favicon/apple-icon-57x57.png") ?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url("assets/favicon/apple-icon-60x60.png") ?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url("assets/favicon/apple-icon-72x72.png") ?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url("assets/favicon/apple-icon-76x76.png") ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url("assets/favicon/apple-icon-114x114.png") ?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url("assets/favicon/apple-icon-120x120.png") ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url("assets/favicon/apple-icon-144x144.png") ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url("assets/favicon/apple-icon-152x152.png") ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url("assets/favicon/apple-icon-180x180.png") ?>">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url("assets/favicon/android-icon-192x192.png") ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url("assets/favicon/favicon-32x32.png") ?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url("assets/favicon/favicon-96x96.png") ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url("assets/favicon/favicon-16x16.png") ?>">
        <link rel="manifest" href="<?php echo base_url("assets/favicon/manifest.json") ?>">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo base_url("assets/favicon/ms-icon-144x144.png") ?>">
        <meta name="theme-color" content="#ffffff">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <script type="text/javascript" src="<?php echo base_url('assets/admin/javascript/jquery/jquery-2.1.1.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/javascript/bootstrap/js/bootstrap.min.js') ?>"></script>
        <link href="<?php echo base_url('assets/admin/javascript/bootstrap/opencart/opencart.css') ?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url('assets/admin/javascript/font-awesome/css/font-awesome.min.css') ?>" type="text/css" rel="stylesheet" />
        <script src="<?php echo base_url('assets/admin/javascript/jquery/datetimepicker/moment.js') ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('assets/admin/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js') ?>" type="text/javascript"></script>
        <link href="<?php echo base_url('assets/admin/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css') ?>" type="text/css" rel="stylesheet" media="screen" />
        <script type="text/javascript" src="<?php echo base_url('assets/admin/javascript/tinymce/tinymce.min.js'); ?>"></script>
        <link href="<?php echo base_url('assets/admin/javascript/select2/dist/css/select2.min.css') ?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url('assets/admin/javascript/bootstrap-toggle/css/bootstrap-toggle.min.css') ?>" type="text/css" rel="stylesheet" />
        <link href="<?php echo base_url('assets/css/custom.css') ?>" type="text/css" rel="stylesheet" />
        <style type="text/css">
            .select2{
                width: 100% !important;
            }
        </style>

        <!-- <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-49774903-7', 'auto');
	  ga('send', 'pageview');
	
	</script> -->
    </head>
    <body>
        <div id="container">
            <?php
            //header
            if ($this->uri->segment(2) == 'login' || $this->uri->segment(2) == 'forgotten') {
                $this->load->view('admin/section/login_header');
            } else {
                $this->load->view('admin/section/header');
                $this->load->view('admin/section/navigation');
            }

            //content
            
            $this->load->view($load_view);

            //footer
            $this->load->view('admin/section/footer');
            ?>
        </div>
        
        
        <script type="text/javascript" src="<?php echo base_url('assets/admin/javascript/select2/dist/js/select2.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/javascript/validate/jquery.validate.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/javascript/validate/additional-methods.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/javascript/bootstrap-toggle/js/bootstrap2-toggle.min.js'); ?>"></script>

        <link type="text/css" href="<?php echo base_url('assets/admin/stylesheet/stylesheet.css') ?>" rel="stylesheet" media="screen" />
        <script src="<?php echo base_url('assets/admin/javascript/common.js') ?>" type="text/javascript"></script>

        <script type="text/javascript">
        
        $(document).ready(function() {
        
        // Image Manager
	$(document).delegate('a[data-toggle=\'image\']', 'click', function(e) {
		e.preventDefault();
		
		$('.popover').popover('hide', function() {
			$('.popover').remove();
		});
					
		var element = this;
		
		$(element).popover({
			html: true,
			placement: 'right',
			trigger: 'manual',
			content: function() {
				return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
			}
		});
		
		$(element).popover('show');
                
                $('#button-image').on('click', function() {
                    $('#modal-image').remove();
                    
                    var field_id = $(this).closest('.parent-image').find('input').attr('id');

                    var baseURL = '<?php echo base_url();?>';
                    var fm = baseURL + 'assets/admin/filemanager/dialog.php?type=2&field_id='+ field_id +'&relative_url=1&akey=<?php echo ($this->session->userdata('token')) ? $this->session->userdata('token') : ''; ?>';

                    $('body').append('<div id="modal-image" class="modal"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h4 class="modal-title">File Manager</h4> </div>  <div class="modal-body"><iframe width="100%" height="400" src="' + fm + '" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe></div><div class="modal-footer"></div></div></div></div>');
                    $('#modal-image').modal('show');

                    $(element).popover('hide', function() {
                        $('.popover').remove();
                    });
                });
		
		$('#button-clear').on('click', function() {
			$(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));
			
			$(element).parent().find('input').attr('value', '');
			
			$(element).popover('hide', function() {
				$('.popover').remove();
			});
		});
	});
	
	});
        
        //--></script>
    </body>
</html>