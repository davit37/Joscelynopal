<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-contact" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
            </div>
            <h1>Contact</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/page/contact') ?>">Contact</a></li>
            </ul>
        </div>
    </div>
    
    <div class="container-fluid">
        
        <?php
        if ($this->session->userdata('contact_success')) {
            echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->session->userdata('contact_success').'<button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('contact_success');
        }
        if ($this->session->userdata('contact_error')) {
            echo '<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '.$this->session->userdata('contact_error').'<button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('contact_error');
        }
        ?>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Contact</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/page/contact/update') ?>" method="post" enctype="multipart/form-data" id="form-contact" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="tab-data">
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-title">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" value="<?php echo $contact[0]['title'] ?>" placeholder="Title" id="input-title" class="form-control" />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-description">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" placeholder="Description" id="input-description"><?php echo $contact[0]['description'] ?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-image">Image</label>
                                <div class="col-sm-10 parent-image">
                                    <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo base_url('thumb/'.$contact[0]['image']) ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" /></a>
                                    <input type="hidden" name="image" value="<?php echo $contact[0]['image'] ?>" id="input-image1" />
                                </div>
                            </div> 
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"><!--

        tinymce.init({
            selector: "#input-description", theme: "modern", height: 300,
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            relative_urls: false,
            remove_script_host: false,
            external_filemanager_path: "<?php echo base_url('assets/admin') . '/filemanager/' ?>",
            filemanager_title: "Filemanager",
            filemanager_access_key:"<?php echo $this->session->userdata('token') ?>" ,
            external_plugins: {"filemanager": "<?php echo base_url('assets/admin/filemanager/plugin.min.js') ?>"}
        });

        //--></script>

<script type="text/javascript"><!--
        function responsive_filemanager_callback(field_id) {
            console.log(field_id);

            var baseURL = "<?php echo base_url('thumb') . "/" ?>";
            var url = jQuery('#' + field_id).val();
            var lastword = field_id.split("-").pop();
            //alert('update ' + field_id + " with " + url);

            if (field_id.indexOf("video") >= 0) {
                jQuery("#thumb-" + lastword + " img").attr("src", "<?php echo base_url('assets/images/icon/video.png') ?>");
            } else {
                jQuery("#thumb-" + lastword + " img").attr("src", baseURL + url);
            }
        }
        //--></script>