<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-shipping" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo base_url('admin/setting/shipping') ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1>Categories</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/setting/shipping') ?>">Categories</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Add Shipping</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/setting/shipping/update') ?>" method="post" enctype="multipart/form-data" id="form-shipping" class="form-horizontal">
                    <input type="hidden" name="setting_id" value="<?php echo $result[0]['setting_id'] ?>">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="tab-data">
                            <div class="form-group required <?php if($this->session->userdata('name_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-name">Shipping Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="<?php echo $result[0]['title'] ?>" placeholder="Shipping Name" id="input-name" class="form-control" />
                                    <?php if($this->session->userdata('name_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('name_error').'</div>';
                                        $this->session->unset_userdata('name_error');
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

