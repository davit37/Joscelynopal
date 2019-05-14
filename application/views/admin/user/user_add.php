<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-user" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo base_url('admin/user') ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1>Users</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/user') ?>">Users</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        
        <?php
        if ($this->session->userdata('error')) {
            echo '<div class="alert alert-danger"><i class="fa fa-check-circle"></i> ' . $this->session->userdata('error') . '<button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('error');
        }
        ?>
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Add User</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/user/save') ?>" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="tab-data">
                            <div class="form-group required <?php if($this->session->userdata('username_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-username">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" name="username" value="" placeholder="Username" id="input-username" class="form-control" />
                                    <?php if($this->session->userdata('username_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('username_error').'</div>';
                                        $this->session->unset_userdata('username_error');
                                    } ?>
                                </div>
                            </div>
                            <div class="form-group required <?php if($this->session->userdata('email_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-email">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="email" value="" placeholder="Email" id="input-email" class="form-control" />
                                    <?php if($this->session->userdata('email_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('email_error').'</div>';
                                        $this->session->unset_userdata('email_error');
                                    } ?>
                                </div>
                            </div>
                            <div class="form-group required <?php if($this->session->userdata('password_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-password">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" />
                                    <?php if($this->session->userdata('password_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('password_error').'</div>';
                                        $this->session->unset_userdata('password_error');
                                    } ?>
                                </div>
                            </div>
                            <div class="form-group required <?php if($this->session->userdata('confirm_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-confirm">Confirm</label>
                                <div class="col-sm-10">
                                    <input type="password" name="confirm" value="" placeholder="Confirm" id="input-confirm" class="form-control" />
                                    <?php if($this->session->userdata('confirm_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('confirm_error').'</div>';
                                        $this->session->unset_userdata('confirm_error');
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