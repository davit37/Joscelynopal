<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-maintenance" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>
            </div>
            <h1>Maintenance</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/setting/maintenance') ?>">Store</a></li>
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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Maintenance Status</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/setting/maintenance/update') ?>" method="post" id="form-maintenance" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active in" id="tab-data">
                            
                            <div class="form-group required <?php if($this->session->userdata('error_maintenance')) echo 'error_maintenance'; ?>">
                                <label class="col-sm-2 control-label" for="input-name">Maintenance Toggler</label>
                                <div class="col-sm-10">
                                    <label class="checkbox">
                                        <input name="maintenance" type="checkbox" data-toggle="toggle" <?php echo $check_maintenance ?> data-on="Site on, Live" data-off="Site off, Maintenance" data-width="170">
                                    </label>
                                    <div style="margin-top:5px;">
                                    Blue: Site On (Live)<br>
                                    Grey: Site Off (Maintenance)<br>
                                    * Do not forget to click save button on the top right
                                    </div>

                                    <?php if($this->session->userdata('error_maintenance')) {
                                        echo '<div class="text-danger">'.$this->session->userdata('error_maintenance').'</div>';
                                        $this->session->unset_userdata('error_maintenance');
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