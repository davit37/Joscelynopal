<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-shipping" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
            </div>
            <h1>Shipping Info</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/page/shipping-info') ?>">Shipping Info</a></li>
            </ul>
        </div>
    </div>
    
    <div class="container-fluid">
        
        <?php
        if ($this->session->userdata('shipping_success')) {
            echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->session->userdata('shipping_success').'<button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('shipping_success');
        }
        if ($this->session->userdata('shipping_error')) {
            echo '<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '.$this->session->userdata('shipping_error').'<button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('shipping_error');
        }
        ?>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Shipping Info</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/page/shipping-info/update') ?>" method="post" enctype="multipart/form-data" id="form-shipping" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="tab-data">
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-title">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" value="<?php echo $shipping[0]['title'] ?>" placeholder="Title" id="input-title" class="form-control" />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-description">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" placeholder="Description" id="input-description"><?php echo $shipping[0]['description'] ?></textarea>
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