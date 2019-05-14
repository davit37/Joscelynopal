<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-slideshow" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo base_url('admin/slideshow') ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1>Slideshow</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/slideshow') ?>">Slideshow</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Slideshow</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/slideshow/update') ?>" method="post" enctype="multipart/form-data" id="form-slideshow" class="form-horizontal">
                    <input type="hidden" name="slideshow_id" value="<?php echo $result[0]['slideshow_id'] ?>" />
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
                                <label class="col-sm-2 control-label" for="input-image">Image</label>
                                <div class="col-sm-10 parent-image">
                                    <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo base_url('thumb/' . $result[0]['image']) ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" /></a>
                                    <input type="hidden" name="image" value="<?php echo $result[0]['image'] ?>" id="input-image" />
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-link">Link</label>
                                <div class="col-sm-10">
                                    <input type="text" name="link" value="<?php echo $result[0]['link'] ?>" placeholder="Link" id="input-link" class="form-control" />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-sort-order">Sort Order</label>
                                <div class="col-sm-10">
                                    <input type="text" name="sort_order" value="<?php echo $result[0]['sort_order'] ?>" placeholder="Sort Order" id="input-sort-order" class="form-control" />
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