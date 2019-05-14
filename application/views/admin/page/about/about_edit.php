<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-about" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
            </div>
            <h1>About</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/page/about') ?>">About</a></li>
            </ul>
        </div>
    </div>
    
    <div class="container-fluid">
        
        <?php
        if ($this->session->userdata('about_success')) {
            echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->session->userdata('about_success').'<button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('about_success');
        }
        if ($this->session->userdata('about_error')) {
            echo '<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '.$this->session->userdata('about_error').'<button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('about_error');
        }
        ?>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit About</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/page/about/update') ?>" method="post" enctype="multipart/form-data" id="form-about" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="tab-data">
                            <!-- Row 1 -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-title">Title 1</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title1" value="<?php echo $about[0]['title'] ?>" placeholder="Title" id="input-title1" class="form-control" />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-description">Description 1</label>
                                <div class="col-sm-10">
                                    <textarea name="description1" placeholder="Description" id="input-description1"><?php echo $about[0]['description'] ?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-image">Image 1</label>
                                <div class="col-sm-10 parent-image">
                                    <a href="" id="thumb-image1" data-toggle="image" class="img-thumbnail"><img src="<?php echo base_url('thumb/'.$about[0]['image']) ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" /></a>
                                    <input type="hidden" name="image1" value="<?php echo $about[0]['image'] ?>" id="input-image1" />
                                </div>
                            </div> 
                            
                            <!-- Row 2 -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-title">Title 2</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title2" value="<?php echo $about[1]['title'] ?>" placeholder="Title" id="input-title2" class="form-control" />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-description">Description 2</label>
                                <div class="col-sm-10">
                                    <textarea name="description2" placeholder="Description" id="input-description2"><?php echo $about[1]['description'] ?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-image">Image 2</label>
                                <div class="col-sm-10 parent-image">
                                    <a href="" id="thumb-image2" data-toggle="image" class="img-thumbnail"><img src="<?php echo base_url('thumb/'.$about[1]['image']) ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" /></a>
                                    <input type="hidden" name="image2" value="<?php echo $about[1]['image'] ?>" id="input-image2" />
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
            selector: "#input-description1", theme: "modern", height: 300,
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
        
        tinymce.init({
            selector: "#input-description2", theme: "modern", height: 300,
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