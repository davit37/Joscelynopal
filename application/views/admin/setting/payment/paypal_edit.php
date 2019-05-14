<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-paypal" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
            </div>
            <h1>Paypal</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/setting/payment/paypal') ?>">Paypal</a></li>
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Paypal</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/setting/payment/paypal/update') ?>" method="post" enctype="multipart/form-data" id="form-paypal" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-status" data-toggle="tab">Status</a></li>
                        <li><a href="#tab-data" data-toggle="tab">Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="tab-status">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-status">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" id="input-status" class="form-control">
                                        <option value="1" <?php if($module == 1) echo 'selected="selected"' ?>>Enabled</option>
                                        <option value="0" <?php if($module == 0) echo 'selected="selected"' ?>>Disabled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane in" id="tab-data">
                            <div class="form-group required <?php if($this->session->userdata('business_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-business">Business Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="business_email" value="<?php echo $business_email ?>" placeholder="Business Email" id="input-business" class="form-control" />
                                    <?php if($this->session->userdata('business_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('business_error').'</div>';
                                        $this->session->unset_userdata('business_error');
                                    } ?>
                                </div>
                            </div>
                            
                            <div class="form-group required <?php if($this->session->userdata('notify_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-notify">Notify Url</label>
                                <div class="col-sm-10">
                                    <input type="text" name="notify_url" value="<?php echo $notify_url ?>" placeholder="Notify Url" id="input-notify" class="form-control" />
                                    <?php if($this->session->userdata('notify_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('notify_error').'</div>';
                                        $this->session->unset_userdata('notify_error');
                                    } ?>
                                </div>
                            </div>
                            
                            <div class="form-group required <?php if($this->session->userdata('return_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-return">Return Url</label>
                                <div class="col-sm-10">
                                    <input type="text" name="return_url" value="<?php echo $return_url ?>" placeholder="Return Url" id="input-return" class="form-control" />
                                    <?php if($this->session->userdata('return_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('return_error').'</div>';
                                        $this->session->unset_userdata('return_error');
                                    } ?>
                                </div>
                            </div>
                            
                            <div class="form-group required <?php if($this->session->userdata('cancel_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-cancel">Cancel Url</label>
                                <div class="col-sm-10">
                                    <input type="text" name="cancel_url" value="<?php echo $cancel_url ?>" placeholder="Cancel Url" id="input-cancel" class="form-control" />
                                    <?php if($this->session->userdata('cancel_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('cancel_error').'</div>';
                                        $this->session->unset_userdata('cancel_error');
                                    } ?>
                                </div>
                            </div>
                            
                            <div class="form-group required <?php if($this->session->userdata('currency_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-currency">Currency Code</label>
                                <div class="col-sm-10">
                                    <input type="text" name="currency_code" value="<?php echo $currency_code ?>" placeholder="Currency Code" id="input-currency" class="form-control" />
                                    <?php if($this->session->userdata('currency_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('currency_error').'</div>';
                                        $this->session->unset_userdata('currency_error');
                                    } ?>
                                </div>
                            </div>
                            
                            <div class="form-group required <?php if($this->session->userdata('logo_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-logo">Checkout Logo</label>
                                <div class="col-sm-10">
                                    <input type="text" name="checkout_logo" value="<?php echo $checkout_logo ?>" placeholder="Checkout Logo" id="input-logo" class="form-control" />
                                    <?php if($this->session->userdata('logo_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('logo_error').'</div>';
                                        $this->session->unset_userdata('logo_error');
                                    } ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-test">Test Mode</label>
                                <div class="col-sm-10">
                                    <select name="test" id="input-test" class="form-control">
                                        <option value="1" <?php if($test_mode == 1) echo 'selected="selected"' ?>>Enabled</option>
                                        <option value="0" <?php if($test_mode == 0) echo 'selected="selected"' ?>>Disabled</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group required <?php if($this->session->userdata('debug_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-debug">Debug Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="debug_email" value="<?php echo $debug_email ?>" placeholder="Debug Email" id="input-debug" class="form-control" />
                                    <?php if($this->session->userdata('debug_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('debug_error').'</div>';
                                        $this->session->unset_userdata('debug_error');
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