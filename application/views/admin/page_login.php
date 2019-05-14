<div id="content">
    <div class="container-fluid"><br />
        <br />
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title"><i class="fa fa-lock"></i> Please enter your login details.</h1>
                    </div>
                    <div class="panel-body">
                        <?php if ($this->session->userdata('error_warning')) { ?>
                            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $this->session->userdata('error_warning'); ?>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                            <?php $this->session->unset_userdata('error_warning'); ?>
                        <?php } ?>
                        
                        <?php if ($this->session->userdata('success')) { ?>
                            <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $this->session->userdata('success'); ?>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                            <?php $this->session->unset_userdata('success'); ?>
                        <?php } ?>

                        <?php echo form_open('admin/login/signin'); ?>
                        <div class="form-group">
                            <label for="input-username">Username</label>
                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" name="username" placeholder="Username" id="input-username" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-password">Password</label>
                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" placeholder="Password" id="input-password" class="form-control" />
                            </div>
                            <span class="help-block"><a href="<?php echo base_url('admin/forgotten') ?>">Forgotten Password</a></span>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-key"></i> Login</button>
                        </div>
                        <input type="hidden" name="redirect" value="<?php echo base_url('admin/login') ?>" />
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
