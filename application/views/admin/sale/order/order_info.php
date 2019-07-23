<div id="content">

    <div class="page-header">

        <div class="container-fluid">

            <div class="pull-right">

                <a class="btn btn-info" title="" data-toggle="tooltip" target="_blank" href="<?= base_url('admin/sale/order/invoice/'.$order_id) ?>" data-original-title="Print Invoice"><i class="fa fa-print"></i></a>

                <a class="btn btn-primary" title="" data-toggle="tooltip" href="<?= base_url('admin/sale/order/edit/'.$order_id) ?>" data-original-title="Edit"><i class="fa fa-pencil"></i></a>

                <a class="btn btn-default" title="" data-toggle="tooltip" href="<?= base_url('admin/sale/order') ?>" data-original-title="Cancel"><i class="fa fa-reply"></i></a>

            </div>

            <h1>Orders</h1>

            <ul class="breadcrumb">

                <li><a href="<?= base_url('admin/dashboard') ?>">Home</a></li>

                <li><a href="<?= base_url('admin/sale/order') ?>">Orders</a></li>

            </ul>

        </div>

    </div>

    <div class="container-fluid">

        <div class="panel panel-default">

            <div class="panel-heading">

                <h3 class="panel-title"><i class="fa fa-list"></i> Orders</h3>

            </div>

            <div class="panel-body">

                <ul class="nav nav-tabs">

                    <li class="active"><a data-toggle="tab" href="#tab-order" aria-expanded="true">Order Details</a></li>

                    <li class=""><a data-toggle="tab" href="#tab-payment" aria-expanded="false">Customer Details</a></li>

                    <li class=""><a data-toggle="tab" href="#tab-shipping" aria-expanded="false">Payment & Shipping Details</a></li>

                    <li class=""><a data-toggle="tab" href="#tab-product" aria-expanded="false">Products</a></li>

                    <li class=""><a data-toggle="tab" href="#tab-history" aria-expanded="false">History</a></li>

                </ul>

                <div class="tab-content">

                    <div id="tab-order" class="tab-pane active">

                        <table class="table table-bordered">

                            <tbody><tr>

                                    <td>Order ID:</td>

                                    <td>#<?= $order_detail[0]['order_id'] ?></td>

                                </tr>

                                <tr>

                                    <td>Invoice No.:</td>

                                    <td><?= $order_detail[0]['invoice'] ?></td>

                                </tr>

                                <tr>

                                    <td>Customer:</td>

                                    <td><?= $order_detail[0]['firstname']." ".$order_detail[0]['lastname'] ?></td>

                                </tr>

                                <tr>

                                    <td>E-Mail:</td>

                                    <td><a href="mailto:fahmil.arief26@gmail.com"><?= $order_detail[0]['email'] ?></a></td>

                                </tr>

                                <tr>

                                    <td>Telephone:</td>

                                    <td><?= $order_detail[0]['telephone'] ?></td>

                                </tr>

                                <tr>

                                    <td>Total:</td>

                                    <td>$<?= number_format($order_detail[0]['total'], 2, '.', '') ?></td>

                                </tr>

                                <tr>

                                    <td>Order Status:</td>

                                    <td id="order-status"><?= $last_order_history ?></td>

                                </tr>

                                <tr>

                                    <td>IP Address:</td>

                                    <td><?= $order_detail[0]['ip'] ?></td>

                                </tr>

                                <tr>

                                    <td>User Agent:</td>

                                    <td><?= $order_detail[0]['user_agent'] ?></td>

                                </tr>

                                <tr>

                                    <td>Accept Language:</td>

                                    <td><?= $order_detail[0]['accept_language'] ?></td>

                                </tr>

                                <tr>

                                    <td>Date Added:</td>

                                    <td><?= date("d/m/Y", strtotime($order_detail[0]['date_added'])) ?></td>

                                </tr>

                                <tr>

                                    <td>Date Modified:</td>

                                    <td><?= date("d/m/Y", strtotime($order_detail[0]['date_modified'])) ?></td>

                                </tr>

                            </tbody></table>

                    </div>

                    <div id="tab-payment" class="tab-pane">

                        <table class="table table-bordered">

                            <tbody><tr>

                                    <td>First Name:</td>

                                    <td><?= $order_detail[0]['firstname'] ?></td>

                                </tr>

                                <tr>

                                    <td>Last Name:</td>

                                    <td><?= $order_detail[0]['lastname'] ?></td>

                                </tr>

                                <tr>

                                    <td>Address 1:</td>

                                    <td><?= $order_detail[0]['address_1'] ?></td>

                                </tr>

                                <tr>

                                    <td>Address 2:</td>

                                    <td><?= $order_detail[0]['address_2'] ?></td>

                                </tr>

                                <tr>

                                    <td>City:</td>

                                    <td><?= $order_detail[0]['city'] ?></td>

                                </tr>

                                <tr>

                                    <td>Postcode:</td>

                                    <td><?= $order_detail[0]['postcode'] ?></td>

                                </tr>

                                <tr>

                                    <td>Region / State:</td>

                                    <td><?= $zone[0]['name'] ?></td>

                                </tr>

                                <tr>

                                    <td>Country:</td>

                                    <td><?= $country[0]['name'] ?></td>

                                </tr>

                            </tbody></table>

                    </div>

                    <div id="tab-shipping" class="tab-pane">

                        <table class="table table-bordered">

                            <tbody>

                                <tr>

                                    <td>Payment Method:</td>

                                    <td><?= $order_detail[0]['payment_method'] ?></td>

                                </tr>

                                <tr>

                                    <td>Payment Comment:</td>

                                    <td><?= ($order_detail[0]['payment_comment']) ? $order_detail[0]['payment_comment']:''; ?></td>

                                </tr>

                                <tr>

                                    <td>Shipping Method:</td>

                                    <td><?= $order_detail[0]['shipping_method'] ?></td>

                                </tr>

                                <tr>

                                    <td>Shipping Comment:</td>

                                    <td><?= ($order_detail[0]['shipping_comment']) ? $order_detail[0]['shipping_comment']:''; ?></td>

                                </tr>

                                <?php if(!empty($order_shipping_country)){ ?>

                                <tr>

                                    <td>Shipping Country:</td>

                                    <td><?= $order_shipping_country[0]['name'];?></td>

                                </tr>

                                <?php if(!empty($order_shipping_country[0]['shipping_price'])){ ?>

                                <tr>

                                    <td>Shipping Price:</td>

                                    <td><?= '$ '.number_format($order_shipping_country[0]['shipping_price'], 2, '.', '');?></td>

                                </tr>

                                <?php } } ?>

                            </tbody>

                        </table>

                    </div>

                    <div id="tab-product" class="tab-pane">

                        <table class="table table-bordered">

                            <thead>

                                <tr>

                                    <td class="text-left">Product</td>

                                    <td class="text-left">Category</td>
                                    <td class="text-left">Option</td>

                                    <td class="text-right">Unit Price</td>

                                </tr>

                            </thead>

                            <tbody>

                                <?php foreach ($order_products as $key=>$row) { 

                                    $order_option_list   = empty($order_option[$key]->option) ?'':implode('|',$order_option[$key]->option);

                                    $option_cost =  empty($order_option[$key]->option) ?  '':" + $".number_format($order_option[$key]->option_cost, 2, '.', '');

                                    $order_price    = number_format($row['price'], 2, '.', ''). $option_cost;
                                ?>

                                <tr>

                                    <td class="text-left"><?= $row['name'] ?></td>

                                    <td class="text-left"><?= $row['category'] ?></td>
                                    <td class='text-left'><?=  $order_option_list  ?></td>

                                    <td class="text-right">$<?= $order_price  ?></td>

                                </tr>

                                <?php } ?>

                                <tr>

                                    <td class="text-right" colspan="3">Total:</td>

                                    <td class="text-right">$<?= number_format($order_total[0]['value'], 2, '.', '') ?></td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                    <div id="tab-history" class="tab-pane">
                    <div class="alert alert-info " style='display:none' id='history-alert'><i class="fa fa-info-circle"></i> <span></span></div>

                        <div id="history"><table class="table table-bordered">

                                <thead>

                                    <tr>

                                        <td class="text-left">Date Added</td>

                                        <td class="text-left">Comment</td>

                                        <td class="text-left">Status</td>

                                        <td class="text-left">Customer Notified</td>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php foreach ($order_history as $row) { ?>

                                    <tr>

                                        <td class="text-left"><?= date("d/m/Y", strtotime($row['date_added'])) ?></td>

                                        <td class="text-left"><?= ($row['comment']) ? $row['comment'] : ''; ?></td>

                                        <td class="text-left"><?= $row['order_status'] ?></td>

                                        <td class="text-left"><?= ($row['notify'] == 0) ? 'No' : 'Yes'; ?></td>

                                    </tr>

                                    <?php } ?>

                                </tbody>

                            </table>

                        </div>

                        <br>

                        <fieldset>

                            <legend>Add Order History</legend>

                            <form class="form-horizontal">

                                <div class="form-group">

                                    <label for="input-order-status" class="col-sm-2 control-label">Order Status</label>

                                    <div class="col-sm-10">

                                        <select class="form-control" id="input-order-status" name="order_status_id">

                                            <option value="Canceled">Canceled</option>

                                            <option value="Canceled Reversal">Canceled Reversal</option>

                                            <option value="Chargeback">Chargeback</option>

                                            <option value="Complete">Complete</option>

                                            <option value="Denied">Denied</option>

                                            <option value="Expired">Expired</option>

                                            <option value="Failed">Failed</option>

                                            <option selected="selected" value="Pending">Pending</option>

                                            <option value="Processed">Processed</option>

                                            <option value="Processing">Processing</option>

                                            <option value="Refunded">Refunded</option>

                                            <option value="Reversed">Reversed</option>

                                            <option value="Shipped">Shipped</option>

                                            <option value="Voided">Voided</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="input-notify" class="col-sm-2 control-label">Notify Customer</label>

                                    <div class="col-sm-10">

                                        <input type="checkbox" id="input-notify" value="1" name="notify">

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="input-comment" class="col-sm-2 control-label">Comment</label>

                                    <div class="col-sm-10">

                                        <textarea class="form-control" id="input-comment" rows="8" name="comment"></textarea>

                                    </div>

                                </div>

                            </form>

                            <div class="text-right">

                                <button class="btn btn-primary" data-loading-text="Loading..." id="button-history"><i class="fa fa-plus-circle"></i> Add History</button>

                            </div>

                        </fieldset>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<script type="text/javascript"><!--

    $('#button-history').on('click', function() {

        var order_status = $('#input-order-status').val();

        if($('#input-notify').is(':checked')) {

            var notify = 1;

        } else {

            var notify = 0;

        }

        var comment = $('#input-comment').val();

        var order_id = '<?= $order_id ?>';

        

        $.ajax({

            url: '<?= base_url('admin/sale/order/notify') ?>',

            type: 'post',

            data: {order_id:order_id,order_status:order_status,notify:notify,comment:comment},

            dataType: 'json',

            beforeSend: function() {

                    $('#button-product-add').button('loading');

            },

            complete: function() {

                    $('#button-product-add').button('reset');

            },

            success: function(json) {

                html = '<tr>';

                html += '<td class="text-left">' + json['date_added'] + '</td>';

                html += '<td class="text-left">' + json['comment'] + '</td>';

                html += '<td class="text-left">' + json['order_status'] + '</td>';

                html += '<td class="text-left">' + json['notify'] + '</td>';

                html += '</tr>';

                

                $('#history table tbody').append(html);

                var history_alert = $("#history-alert");

                history_alert.fadeIn();
                history_alert.find('span').html("History was successfully added");

            },

            error: function(xhr, ajaxOptions, thrownError) {

                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

            }

	});

    });

    

    //--></script>