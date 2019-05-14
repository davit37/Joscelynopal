<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1>Change Password</h1>
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url('account/user/password_update') ?>">
                <fieldset>
                    <legend>Your Password</legend>
                    <div class="form-group <?php echo ($this->session->userdata('error_password')) ? 'has-error' : ''; ?>"">
                        <label for="input-password" class="col-sm-2 control-label"><span class="required">*</span> Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="input-password" placeholder="Password" value="" name="password">
                            <?php if ($this->session->userdata('error_password')) { ?>
                                <div class="text-danger"><?php echo $this->session->userdata('error_password') ?></div>
                                <?php $this->session->unset_userdata('error_password') ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo ($this->session->userdata('error_confirm')) ? 'has-error' : ''; ?>">
                        <label for="input-confirm" class="col-sm-2 control-label"><span class="required">*</span> Password Confirm</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="input-confirm" placeholder="Password Confirm" value="" name="confirm">
                            <?php if ($this->session->userdata('error_confirm')) { ?>
                                <div class="text-danger"><?php echo $this->session->userdata('error_confirm') ?></div>
                                <?php $this->session->unset_userdata('error_confirm') ?>
                            <?php } ?>
                        </div>
                    </div>
                </fieldset>
                <div class="buttons clearfix">
                    <div class="pull-left"><a class="btn btn-default" href="<?php echo base_url('account/user') ?>">Back</a></div>
                    <div class="pull-right">
                        <input type="submit" class="btn btn-primary" value="Continue">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>