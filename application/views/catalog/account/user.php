<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <?php if($this->session->userdata('success')) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $this->session->userdata('success'); ?></div>
    <?php $this->session->unset_userdata('success'); ?>
    <?php } ?>
    <?php if($this->session->userdata('error')) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $this->session->userdata('error'); ?></div>
    <?php $this->session->unset_userdata('error'); ?>
    <?php } ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h2>My Account</h2>
            <ul class="list-unstyled">
                <li><a href="<?php echo base_url('account/user/edit') ?>">Edit your account information</a></li>
                <li><a href="<?php echo base_url('account/user/password') ?>">Change your password</a></li>
            </ul>
            <h2>My Orders</h2>
            <ul class="list-unstyled">
                <li><a href="<?php echo base_url('account/order') ?>">View your order history</a></li>
            </ul>
            <h2>Log Out</h2>
            <ul class="list-unstyled">
                <li><a href="<?php echo base_url('account/logout') ?>">Log Out</a></li>
            </ul>
        </div>
    </div>
</div>