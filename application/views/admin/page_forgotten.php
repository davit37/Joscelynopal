<div id="content">
    <div class="container-fluid"><br />
        <br />
        <div class="row">
            <div class="col-sm-offset-4 col-sm-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title"><i class="fa fa-repeat"></i> Forgot Your Password?</h1>
                    </div>
                    <div class="panel-body">
                        <?php if ($this->session->userdata('error_warning')) { ?>
                            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $this->session->userdata('error_warning'); ?>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                            <?php $this->session->unset_userdata('error_warning'); ?>
                        <?php } ?>

                        <?php echo form_open('admin/forgotten/reset'); ?>
                        <div class="form-group">
                            <label for="input-email">E-Mail Address</label>
                            <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control" id="input-email" placeholder="E-Mail Address" value="" name="email">
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Reset</button>
                            <a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url('admin/login') ?>" data-original-title="Cancel"><i class="fa fa-reply"></i></a>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>