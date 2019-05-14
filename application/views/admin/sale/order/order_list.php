<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo base_url('admin/sale/order/add') ?>" data-original-title="Add New"><i class="fa fa-plus"></i></a></div>
            <h1>Orders</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/sale/order') ?>">Orders</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php
        if ($this->session->userdata('order_success')) {
            echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> Success: You have modified order!      <button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('order_success');
        }
        if ($this->session->userdata('order_error')) {
            echo '<div class="alert alert-danger"><i class="fa fa-check-circle"></i> Error: Please try again!      <button data-dismiss="alert" class="close" type="button">×</button></div>';
            $this->session->unset_userdata('order_error');
        }
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> Order List</h3>
            </div>
            <div class="panel-body">
                <div class="well">
                    <div class="row">
                        <form action="<?php echo base_url('admin/sale/order/filter') ?>" method="post" enctype="multipart/form-data" id="form-filter">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="input-order-id" class="control-label">Order ID</label>
                                <input type="text" class="form-control" id="input-order-id" placeholder="Order ID" value="" name="filter_order_id">
                            </div>
                            <div class="form-group">
                                <label for="input-customer" class="control-label">Customer</label>
                                <input type="text" class="form-control" id="input-customer" placeholder="Customer" value="" name="filter_customer">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="input-order-status" class="control-label">Order Status</label>
                                <select class="form-control" id="input-order-status" name="filter_order_status">
                                    <option value=""></option>
                                    <option value="Missing Orders">Missing Orders</option>
                                    <option value="Canceled">Canceled</option>
                                    <option value="Canceled Reversal">Canceled Reversal</option>
                                    <option value="Chargeback">Chargeback</option>
                                    <option value="Complete">Complete</option>
                                    <option value="Denied">Denied</option>
                                    <option value="Expired">Expired</option>
                                    <option value="Failed">Failed</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Processed">Processed</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Refunded">Refunded</option>
                                    <option value="Reversed">Reversed</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Voided">Voided</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="input-total" class="control-label">Total</label>
                                <input type="text" class="form-control" id="input-total" placeholder="Total" value="" name="filter_total">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="input-date-added" class="control-label">Date Added</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="input-date-added" data-date-format="YYYY-MM-DD" placeholder="Date Added" value="" name="filter_date_added">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span></div>
                            </div>
                            <div class="form-group">
                                <label for="input-date-modified" class="control-label">Date Modified</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="input-date-modified" data-date-format="YYYY-MM-DD" placeholder="Date Modified" value="" name="filter_date_modified">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span></div>
                            </div>
                            <button class="btn btn-primary pull-right" id="button-filter" type="button"><i class="fa fa-search"></i> Filter</button>
                        </div>
                        </form>
                    </div>
                </div>
                <form id="form-order" target="_blank" enctype="multipart/form-data" method="post">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="text-center" style="width: 1px;"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);"></td>
                                    <td class="text-right">
                                        <a href="<?php echo $url_order_id ?>" class="<?php echo $class_order_id ?>">Order ID</a>
                                    </td>
                                    <td class="text-left">
                                        <a href="<?php echo $url_customer ?>" class="<?php echo $class_customer ?>">Customer</a>
                                    </td>
                                    <td class="text-left">
                                        <a href="<?php echo $url_order_status ?>" class="<?php echo $class_order_status ?>">Status</a>
                                    </td>
                                    <td class="text-right">
                                        <a href="<?php echo $url_total ?>" class="<?php echo $class_total ?>">Total</a>
                                    </td>
                                    <td class="text-left">
                                        <a href="<?php echo $url_date_added ?>" class="<?php echo $class_date_added ?>">Date Added</a>
                                    </td>
                                    <td class="text-left">
                                        <a href="<?php echo $url_date_modified ?>" class="<?php echo $class_date_modified ?>">Date Modified</a>
                                    </td>
                                    <td class="text-right">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($results) {
                                    foreach ($results as $row) {

                                        $total = $row['total'];

                                        if(!empty($results_total)){

                                            foreach($results_total as $index => $value){
                                                if($row['order_id'] == $value['order_id']){
                                                    $total = $row['total'] + $value['shipping_price'];
                                                }
                                            }

                                        }
                                        ?>
                                        <tr>
                                            <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $row['order_id'] ?>" /></td>
                                            <td class="text-right"><?php echo $row['order_id'] ?></td>
                                            <td class="text-left"><?php echo $row['firstname'] . " " . $row['lastname'] ?></td>
                                            <td class="text-left"><?php echo $row['order_status'] ?></td>
                                            <td class="text-right">$<?php echo number_format($total, 2, '.', '') ?></td>
                                            <td class="text-left"><?php echo date("d/m/Y", strtotime($row['date_added'])) ?></td>
                                            <td class="text-left"><?php echo date("d/m/Y", strtotime($row['date_modified'])) ?></td>
                                            <td class="text-right">
                                                <a class="btn btn-info" title="" data-toggle="tooltip" href="<?php echo base_url('admin/sale/order/info/'.$row['order_id']) ?>" data-original-title="View"><i class="fa fa-eye"></i></a>
                                                <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo base_url('admin/sale/order/edit/'.$row['order_id']) ?>" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-danger" title="" data-toggle="tooltip" id="button-delete5" href="<?php echo base_url('admin/sale/order/delete/'.$row['order_id']) ?>" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
    <script type="text/javascript"><!--
        $('#button-filter').on('click', function() {
            $('#form-filter').submit();
        });
        //--></script> 
    <script type="text/javascript"><!--
        $('input[name=\'filter_customer\']').autocomplete({
            'source': function(request, response) {
                var like_by = $('input[name=\'filter_customer\']').val();

                $.ajax({
                    url: "<?php echo base_url('admin/sale/order/autocomplete/customer') ?>/" + like_by,
                    dataType: 'json',
                    success: function(json) {
                        response($.map(json, function(item) {
                            return {
                                label: item['name'],
                                value: item['order_id']
                            }
                        }));
                    }
                });
            },
            'select': function(item) {
                $('input[name=\'filter_customer\']').val(item['label']);
            }
        });
        //--></script> 
    <script type="text/javascript"><!--
        $('a[id^=\'button-delete\']').on('click', function(e) {
            e.preventDefault();

            if (confirm('Are you sure?')) {
                location = $(this).attr('href');
            }
        });
        //--></script> 
    <script type="text/javascript" src="<?php echo base_url('assets/admin/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js') ?>"></script>
    <link media="screen" rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css') ?>">
    <script type="text/javascript"><!--
                $('.date').datetimepicker({
            pickTime: false
        });
        //--></script></div>