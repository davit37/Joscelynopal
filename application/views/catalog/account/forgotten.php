<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 no-padding-xs">

    <?php if($this->session->userdata('error_login')) { ?>

    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $this->session->userdata('error_login') ?></div>

    <?php $this->session->unset_userdata('error_login') ?>

    <?php } ?>

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <h1>Forgot Your Password?</h1>

            <p>Enter the e-mail address associated with your account. Click submit to have your password e-mailed to you.</p>

            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url('account/forgotten/reset') ?>">

                <fieldset>

                    <legend>Your E-Mail Address</legend>

                    <div class="form-group">

                        <label for="input-email" class="col-sm-2 control-label"><span class="required">*</span> E-Mail Address</label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="input-email" placeholder="E-Mail Address" value="" name="email">

                        </div>

                    </div>

                </fieldset>

                <div class="buttons clearfix">

                    <div class="pull-left"><a class="btn btn-default" href="<?php echo base_url('account/login') ?>">Back</a></div>

                    <div class="pull-right">

                        <input type="submit" class="btn btn-primary" value="Continue">

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>