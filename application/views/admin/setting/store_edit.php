<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-store" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
            </div>
            <h1>Store</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/setting/store') ?>">Store</a></li>
            </ul>
        </div>
    </div>
    
    <div class="container-fluid">
        
        <?php
        if ($this->session->userdata('notif_success')) {
            echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->session->userdata('notif_success').'<button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('notif_success');
        }
        if ($this->session->userdata('notif_error')) {
            echo '<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '.$this->session->userdata('notif_error').'<button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('notif_error');
        }
        ?>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Store</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/setting/store/update') ?>" method="post" enctype="multipart/form-data" id="form-store" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="tab-data">
                            
                            <div class="form-group required <?php if($this->session->userdata('error_name')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-name">Store Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="store_name" value="<?php echo $store_name[0]['value'] ?>" placeholder="Store Name" id="input-name" class="form-control" />
                                    <?php if($this->session->userdata('error_name')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('error_name').'</div>';
                                        $this->session->unset_userdata('error_name');
                                    } ?>
                                </div>
                            </div>
                            
                            <div class="form-group required <?php if($this->session->userdata('error_address')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-address">Store Address</label>
                                <div class="col-sm-10">
                                    <textarea name="store_address" id="input-address" class="form-control"><?php echo $store_address[0]['value'] ?></textarea>
                                    <?php if($this->session->userdata('error_address')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('error_address').'</div>';
                                        $this->session->unset_userdata('error_address');
                                    } ?>
                                </div>
                            </div>
                            
                            <div class="form-group required <?php if($this->session->userdata('error_email')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-email">Store Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="store_email" value="<?php echo $store_email[0]['value'] ?>" placeholder="Store Email" id="input-email" class="form-control" />
                                    <?php if($this->session->userdata('error_email')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('error_email').'</div>';
                                        $this->session->unset_userdata('error_email');
                                    } ?>
                                </div>
                            </div>
                            
                            <div class="form-group required <?php if($this->session->userdata('error_telephone')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-telephone">Store Telephone</label>
                                <div class="col-sm-10">
                                    <input type="text" name="store_telephone" value="<?php echo $store_telephone[0]['value'] ?>" placeholder="Store Telephone" id="input-telephone" class="form-control" />
                                    <?php if($this->session->userdata('error_telephone')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('error_telephone').'</div>';
                                        $this->session->unset_userdata('error_telephone');
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