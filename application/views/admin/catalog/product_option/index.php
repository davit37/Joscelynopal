<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo base_url('admin/catalog/product_option/form?action=create') ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-p_option').submit() : false;"><i class="fa fa-trash-o"></i></button>
            </div>
            <h1>Product Option</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/catalog/production_option') ?>">Product Option</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php
        if ($this->session->userdata('category_success')) {
            echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> Success: You have modified categories!      <button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('category_success');
        }
        if ($this->session->userdata('category_error')) {
            echo '<div class="alert alert-danger"><i class="fa fa-check-circle"></i> Error: Please try again!      <button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('category_error');
        }
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> Option List</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/catalog/product_option/delete') ?>" method="post" enctype="multipart/form-data" id="form-p_option">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                    <td class="text-left">
                                        Product Name
                                    </td>
                                
                                    <td class="text-right">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if(is_array($results)){
                                                            
                                    foreach ($results as $row) {
                                        ?>

                                        <tr>
                                            <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $row['id'] ?>" /></td>
                                            <td class="text-left"><?php echo $row['option_name'] ?></td>
                                            <td class="text-right"><a href="<?php echo base_url('admin/catalog/product_option/form?action=edit&id=' . $row['id']) ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                                        </tr>

                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $links ?></div>
                    <div class="col-sm-6 text-right">Showing <?php echo $first_result ?> to <?php echo $last_result ?> of <?php echo $total_result ?> (<?php echo $total_page ?> Pages)</div>
                </div>
            </div>
        </div>
    </div>
</div>