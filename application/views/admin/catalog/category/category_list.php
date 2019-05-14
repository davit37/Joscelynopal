<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo base_url('admin/catalog/category/add') ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-category').submit() : false;"><i class="fa fa-trash-o"></i></button>
            </div>
            <h1>Categories</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/catalog/category') ?>">Categories</a></li>
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
                <h3 class="panel-title"><i class="fa fa-list"></i> Category List</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/catalog/category/delete') ?>" method="post" enctype="multipart/form-data" id="form-category">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                    <td class="text-left">
                                        <a href="<?php echo $url_name ?>" class="<?php echo $class_name ?>">Category Name</a>
                                    </td>
                                    <td class="text-right">                    
                                        <a href="<?php echo $url_order ?>" class="<?php echo $class_order ?>">Sort Order</a>
                                    </td>
                                    <td class="text-right">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($results as $row) {
                                    ?>

                                    <tr>
                                        <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $row['category_id'] ?>" /></td>
                                        <td class="text-left"><?php echo $row['name'] ?></td>
                                        <td class="text-right"><?php echo $row['sort_order'] ?></td>
                                        <td class="text-right"><a href="<?php echo base_url('admin/catalog/category/edit/' . $row['category_id']) ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                                    </tr>

                                    <?php
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