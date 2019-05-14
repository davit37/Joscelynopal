<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-category" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo base_url('admin/catalog/category') ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1>Categories</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/catalog/category') ?>">Categories</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Add Category</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/catalog/category/save') ?>" method="post" enctype="multipart/form-data" id="form-category" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="tab-data">
                            <div class="form-group required <?php if($this->session->userdata('category_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-name">Category Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="category_name" value="" placeholder="Category Name" id="input-name" class="form-control" />
                                    <?php if($this->session->userdata('category_error')) {
                                        echo '<div class="text-danger">Category Name is required!</div>';
                                        $this->session->unset_userdata('category_error');
                                    } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-description">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="category_description" placeholder="Description" id="input-description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-sort-order">Sort Order</label>
                                <div class="col-sm-10">
                                    <input type="text" name="sort_order" value="0" placeholder="Sort Order" id="input-sort-order" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-status">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" id="input-status" class="form-control">
                                        <option value="1" selected="selected">Enabled</option>
                                        <option value="0">Disabled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group <?php if($this->session->userdata('slug_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-slug">Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" name="slug" value="" placeholder="Slug" id="input-slug" class="form-control" />
                                    <?php if($this->session->userdata('slug_error')) {
                                        echo '<div class="text-danger">Duplicate slug, change other slug</div>';
                                        $this->session->unset_userdata('slug_error');
                                    } ?>
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