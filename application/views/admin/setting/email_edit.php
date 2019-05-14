<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-email" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
            </div>
            <h1>Email</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/setting/email') ?>">Email</a></li>
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Email</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/setting/email/update') ?>" method="post" enctype="multipart/form-data" id="form-email" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="tab-data">
                            <div class="form-group required <?php if($this->session->userdata('contact_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-contact">Contact Email</label>
                                <div class="col-sm-10">
                                    <input type="text" name="contact_email" value="<?php echo $contact_email[0]['value'] ?>" placeholder="Contact Email" id="input-contact" class="form-control" />
                                    <?php if($this->session->userdata('contact_error')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('contact_error').'</div>';
                                        $this->session->unset_userdata('contact_error');
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