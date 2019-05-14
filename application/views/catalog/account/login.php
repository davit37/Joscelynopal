<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 no-padding-xs">

    <?php if($this->session->userdata('error_login')) { ?>

    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $this->session->userdata('error_login') ?></div>

    <?php $this->session->unset_userdata('error_login') ?>

    <?php } ?>

    

    <?php if($this->session->userdata('success')) { ?>

    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $this->session->userdata('success') ?></div>

    <?php $this->session->unset_userdata('success') ?>

    <?php } ?>

    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <div class="well">

                <h2>New Customer</h2>

                <p><strong>Register Account</strong></p>

                <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>

                <a class="btn btn-primary" href="<?php echo base_url('account/register') ?>">Continue</a></div>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <div class="well">

                <h2>Customer Login</h2>

                <p><strong>Already have account?</strong></p>

                <form enctype="multipart/form-data" method="post" action="<?php echo base_url('account/login/auth') ?>">

                    <div class="form-group">

                        <label for="input-email" class="control-label">E-Mail Address</label>

                        <input type="text" class="form-control" id="input-email" placeholder="E-Mail Address" value="" name="email" kl_virtual_keyboard_secure_input="on">

                    </div>

                    <div class="form-group">

                        <label for="input-password" class="control-label">Password</label>

                        <input type="password" class="form-control" id="input-password" placeholder="Password" value="" name="password" kl_virtual_keyboard_secure_input="on">

                        <a href="<?php echo base_url('account/forgotten') ?>">Forgotten Password</a></div>

                    <input type="submit" class="btn btn-primary" value="Login">

                </form>

            </div>

        </div>

    </div>

</div>