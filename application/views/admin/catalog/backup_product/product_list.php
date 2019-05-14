<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right"><a href="<?php echo base_url('admin/catalog/product/add') ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-product').submit() : false;"><i class="fa fa-trash-o"></i></button>
            </div>
            <h1>Products</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/catalog/product') ?>">Products</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php
        if ($this->session->userdata('product_success')) {
            echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> Success: You have modified product!      <button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('product_success');
        }
        if ($this->session->userdata('product_error')) {
            echo '<div class="alert alert-danger"><i class="fa fa-check-circle"></i> Error: Please try again!      <button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('product_error');
        }
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> Product List</h3>
            </div>
            <div class="panel-body">
                <div class="well">
                    <div class="row">
                        <form action="<?php echo base_url('admin/catalog/product/filter') ?>" method="post" enctype="multipart/form-data" id="form-filter">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-name">Product Name</label>
                                    <input type="text" name="filter_name" value="" placeholder="Product Name" id="input-name" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-category">Category</label>
                                    <input type="text" name="filter_category" value="" placeholder="Category" id="input-category" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-price">Price</label>
                                    <input type="text" name="filter_price" value="" placeholder="Price" id="input-price" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-quantity">Quantity</label>
                                    <input type="text" name="filter_quantity" value="" placeholder="Quantity" id="input-quantity" class="form-control" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="control-label" for="input-status">Status</label>
                                    <select name="filter_status" id="input-status" class="form-control">
                                        <option value=""></option>
                                        <option value="1">Enabled</option>
                                        <option value="0">Disabled</option>
                                    </select>
                                </div>
                                <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
                <form action="<?php echo base_url('admin/catalog/product/delete') ?>" method="post" enctype="multipart/form-data" id="form-product">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                    <td class="text-center">Image</td>
                                    <td class="text-left"><a href="<?php echo $url_name ?>" class="<?php echo $class_name ?>">Product Name</a>
                                    </td>
                                    <td class="text-left"><a href="<?php echo $url_category ?>" class="<?php echo $class_category ?>">Category</a>
                                    </td>
                                    <td class="text-right"><a href="<?php echo $url_price ?>" class="<?php echo $class_price ?>">Price</a>
                                    </td>
                                    <td class="text-right"><a href="<?php echo $url_quantity ?>" class="<?php echo $class_quantity ?>">Quantity</a>
                                    </td>
                                    <td class="text-left"><a href="<?php echo $url_status ?>" class="<?php echo $class_status ?>">Status</a>
                                    </td>
                                    <td class="text-right">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($results) {
                                    foreach ($results as $row) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $row['product_id'] ?>" /></td>
                                            <td class="text-center"><img src="<?php echo base_url('thumb/' . $row['image']) ?>" alt="<?php echo $row['product_name'] ?>" class="img-thumbnail" width="40" height="40" /></td>
                                            <td class="text-left"><?php echo $row['product_name'] ?></td>
                                            <td class="text-left"><?php echo $row['category_name'] ?></td>
                                            <td class="text-right">
                                                <?php
                                                if (isset($row['special'])) {
                                                    echo '<span style="text-decoration: line-through;">' . number_format($row['price'], 2, '.', '') . '</span><br/>';
                                                    echo '<div class="text-danger">' . number_format($row['special'], 2, '.', '') . '</div>';
                                                } else {
                                                    echo number_format($row['price'], 2, '.', '');
                                                }
                                                ?>
                                            </td>
                                            <td class="text-right"><span class="label <?php echo ($row['quantity'] < 1) ? 'label-danger' : 'label-success'; ?>"><?php echo $row['quantity'] ?></span></td>
                                            <td class="text-left"><?php echo ($row['status'] == 1) ? 'Enabled' : 'Disabled'; ?></td>
                                            <td class="text-right"><a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo base_url('admin/catalog/product/edit/' . $row['product_id']) ?>" data-original-title="Edit"><i class="fa fa-pencil"></i></a></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo '<td class="text-center" colspan="8">No results!</td>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $links ?></div>
                    <div class="col-sm-6 text-right">Showing <?php echo $first_result ?> to <?php echo $last_result ?> of <?php echo $total_result ?> (<?php echo $total_page ?> Pages)</div>
                    <?php //echo $last_query; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"><!--
$('#button-filter').on('click', function() {
        $('#form-filter').submit();
    });
//--></script>

<script type="text/javascript"><!--
    $('input[name=\'filter_category\']').autocomplete({
        'source': function(request, response) {
            var like_by = $('input[name=\'filter_category\']').val();

            $.ajax({
                url: "<?php echo base_url('admin/catalog/product/autocomplete/category') ?>/" + like_by,
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['category_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'filter_category\']').val(item['label']);
        }
    });

    $('input[name=\'filter_name\']').autocomplete({
        'source': function(request, response) {
            var like_by = $('input[name=\'filter_name\']').val();

            $.ajax({
                url: "<?php echo base_url('admin/catalog/product/autocomplete/name') ?>/" + like_by,
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['product_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'filter_name\']').val(item['label']);
        }
    });
//--></script>