<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-page" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo base_url('admin/page') ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1>Page</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/page') ?>">Page</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Page</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/page/update') ?>" method="post" enctype="multipart/form-data" id="form-page" class="form-horizontal">
                    <input type="hidden" name="page_id" value="<?php echo $result[0]['page_id'] ?>" />
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="tab-data">
                            <div class="form-group required <?php if($this->session->userdata('title_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-title">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" value="<?php echo $result[0]['title'] ?>" placeholder="Title" id="input-title" class="form-control" />
                                    <?php if($this->session->userdata('title_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('title_error').'</div>';
                                        $this->session->unset_userdata('title_error');
                                    } ?>
                                </div>
                            </div>
                            
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-label">Label Menu</label>
                                <div class="col-sm-10">
                                    <input type="text" name="label_menu" value="<?php echo $result[0]['label_menu'];?>" placeholder="Label Menu" id="input-label" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-slug">Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" name="slug" value="<?php echo $result[0]['slug'];?>" placeholder="Slug" id="input-slug" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-image">Image</label>
                                <div class="col-sm-10 parent-image">
                                    <?php if(!empty($result[0]['image'])){ ?>
                                    <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo base_url('thumb/' . $result[0]['image']) ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" /></a>
                                    <input type="hidden" name="image" value="<?php echo $result[0]['image'] ?>" id="input-image" />
                                    <?php } else { ?>
                                    <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo base_url('assets/images/icon/no_image.png') ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" /></a>
                                    <input type="hidden" name="image" value="" id="input-image" />
                                    <?php } ?>
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-description">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" placeholder="Description" id="input-description1"><?php echo $result[0]['description'];?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="position-menu">
                                <h5><strong>Position Menu</strong></h5></label>
                                <div class="col-sm-10">
                                    <select name="position_menu" id="position-menu" class="form-control">
                                        <option <?php ($result[0]['position_menu'] == 'header') ? 'selected' : '';?> value="header">Header</option>
                                        <option <?php ($result[0]['position_menu'] == 'bottom') ? 'selected' : '';?> value="bottom">Bottom</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-sort-order">
                                <h5><i>Home is default on first header menu</i></h5>
                                <h5><strong>Sort Order</strong></h5></label>
                                <div class="col-sm-10">
                                    <input type="text" name="sort_order" value="<?php echo (!empty($result[0]['sort_order'])) ? $result[0]['sort_order'] : 1; ?>" placeholder="Sort Order" id="input-sort-order" class="form-control" />
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