<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo base_url('admin/setting/shipping/add') ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-shipping').submit() : false;"><i class="fa fa-trash-o"></i></button>
            </div>
            <h1>Categories</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/setting/shipping') ?>">Shipping</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php
        if ($this->session->userdata('success')) {
            echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->session->userdata('success').'<button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('success');
        }
        if ($this->session->userdata('error')) {
            echo '<div class="alert alert-danger"><i class="fa fa-check-circle"></i> '.$this->session->userdata('error').'<button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('error');
        }
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> Shipping List</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/setting/shipping/delete') ?>" method="post" enctype="multipart/form-data" id="form-shipping">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                    <td class="text-left">Shipping Name</td>
                                    <td class="text-right">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($results) {
                                foreach ($results as $row) {
                                    ?>

                                    <tr>
                                        <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $row['setting_id'] ?>" /></td>
                                        <td class="text-left"><?php echo $row['title'] ?></td>
                                        <td class="text-right"><a href="<?php echo base_url('admin/setting/shipping/edit/' . $row['setting_id']) ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                                    </tr>

                                    <?php
                                }
                                } else {
                                    echo '<tr>';
                                    echo '<td colspan="3" class="text-center">No Result!</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>