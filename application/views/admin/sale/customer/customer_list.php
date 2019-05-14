<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right"><a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo base_url('admin/sale/customer/add'); ?>" data-original-title="Add New"><i class="fa fa-plus"></i></a>
                <button onclick="confirm('Are you sure?') ? $('#form-customer').submit() : false;" class="btn btn-danger" title="" data-toggle="tooltip" type="button" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
            </div>
            <h1>Customers</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/sale/customer') ?>">Customers</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php
        if ($this->session->userdata('customer_success')) {
            echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> Success: You have modified order!      <button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('order_success');
        }
        if ($this->session->userdata('customer_error')) {
            echo '<div class="alert alert-danger"><i class="fa fa-check-circle"></i> Error: Please try again!      <button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('order_error');
        }
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> Customer List</h3>
            </div>
            <div class="panel-body">
                <div class="well">
                    <div class="row">
                        <form action="<?php echo base_url('admin/sale/customer/filter') ?>" method="post" enctype="multipart/form-data" id="form-filter">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="input-name" class="control-label">Customer Name</label>
                                    <input type="text" class="form-control" id="input-name" placeholder="Customer Name" value="" name="filter_name"><ul class="dropdown-menu"></ul>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="input-email" class="control-label">E-Mail</label>
                                    <input type="text" class="form-control" id="input-email" placeholder="E-Mail" value="" name="filter_email"><ul class="dropdown-menu"></ul>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="input-ip" class="control-label">IP</label>
                                    <input type="text" class="form-control" id="input-ip" placeholder="IP" value="" name="filter_ip" kl_virtual_keyboard_secure_input="on">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="input-date-added" class="control-label">Date Added</label>
                                    <div class="input-group date">
                                        <input type="text" class="form-control" id="input-date-added" data-date-format="YYYY-MM-DD" placeholder="Date Added" value="" name="filter_date_added">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                        </span></div>
                                </div>
                                <button class="btn btn-primary pull-right" id="button-filter" type="button"><i class="fa fa-search"></i> Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
                <form id="form-customer" enctype="multipart/form-data" method="post" action="<?php echo base_url('admin/sale/customer/delete') ?>">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="text-center" style="width: 1px;"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></td>
                                    <td class="text-left">                    
                                        <a href="<?php echo $url_customer ?>" class="<?php echo $class_customer ?>">Customer Name</a>
                                    </td>
                                    <td class="text-left">                    
                                        <a href="<?php echo $url_email ?>" class="<?php echo $class_email ?>">E-Mail</a>
                                    </td>

                                    <td class="text-left">                    
                                        <a href="<?php echo $url_ip ?>" class="<?php echo $class_ip ?>">IP</a>
                                    </td>
                                    <td class="text-left">                    
                                        <a href="<?php echo $url_date_added ?>" class="<?php echo $class_date_added ?>">Date Added</a>
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
                                            <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $row['customer_id'] ?>" /></td>
                                            <td class="text-left"><?php echo $row['firstname'] . ' ' . $row['lastname'] ?></td>
                                            <td class="text-left"><?php echo $row['email'] ?></td>
                                            <td class="text-left"><?php echo $row['ip'] ?></td>
                                            <td class="text-left"><?php echo date("d/m/Y", strtotime($row['date_added'])) ?></td>
                                            <td class="text-right">
                                                <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo base_url('admin/sale/customer/edit/'.$row['customer_id']) ?>" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            </td>
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
        $('input[name=\'filter_name\']').autocomplete({
        'source': function(request, response) {
            var like_by = $('input[name=\'filter_name\']').val();

            $.ajax({
                url: "<?php echo base_url('admin/sale/customer/autocomplete/customer') ?>/" + like_by,
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['name'],
                            value: item['customer_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'filter_name\']').val(item['label']);
        }
    });

    $('input[name=\'filter_email\']').autocomplete({
        'source': function(request, response) {
            var like_by = $('input[name=\'filter_email\']').val();

            $.ajax({
                url: "<?php echo base_url('admin/sale/customer/autocomplete/email') ?>/" + like_by,
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            label: item['email'],
                            value: item['customer_id']
                        }
                    }));
                }
            });
        },
        'select': function(item) {
            $('input[name=\'filter_email\']').val(item['label']);
        }
    });
    //--></script>

<script type="text/javascript" src="<?php echo base_url('assets/admin/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js') ?>"></script>
<link media="screen" rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css') ?>">
<script type="text/javascript"><!--
            $('.date').datetimepicker({
        pickTime: false
    });
    //--></script>