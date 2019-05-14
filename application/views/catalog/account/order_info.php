<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">      
            <h2>Order Information</h2>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td colspan="2" class="text-left">Order Details</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 50%;" class="text-left">              
                            <b>Invoice No.:</b> <?php echo $order_detail[0]['invoice'] ?><br>
                            <b>Order ID:</b> #<?php echo $order_id; ?><br>
                            <b>Date Added:</b> <?php echo date('d/m/Y', strtotime($order_detail[0]['date_added'])) ?></td>
                        <td class="text-left">              
                            <b>Payment Method:</b> <?php echo $order_detail[0]['payment_method'] ?><br>
                            <b>Shipping Method:</b> <?php echo $order_detail[0]['shipping_method'] ?></td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="text-left">Shipping Address</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left">
                            <?php echo $order_detail[0]['company'] ?><br>
                            <?php echo $order_detail[0]['address_1'] ?><br>
                            <?php echo $order_detail[0]['address_2'] ?><br>
                            <?php echo $order_detail[0]['city'] ?> <?php echo $order_detail[0]['postcode'] ?><br>
                            <?php echo $zone[0]['name'] ?><br>
                            <?php echo $country[0]['name'] ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td class="text-left">Product Name</td>
                            <td class="text-left">Category</td>
                            <td class="text-right">Quantity</td>
                            <td class="text-right">Price</td>
                            <td class="text-right">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_products as $order_product) { ?>
                        <tr>
                            <td class="text-left"><?php echo $order_product['name'] ?></td>
                            <td class="text-left"><?php echo $order_product['category'] ?></td>
                            <td class="text-right"><?php echo $order_product['quantity'] ?></td>
                            <td class="text-right">$<?php echo number_format($order_product['price'], 2, '.', '') ?></td>
                            <td class="text-right">$<?php echo number_format($order_product['total'], 2, '.', '') ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Total</b></td>
                            <td class="text-right">$<?php echo number_format($order_total[0]['value'], 2, '.', '') ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <h3>Order History</h3>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td class="text-left">Date Added</td>
                        <td class="text-left">Order Status</td>
                        <td class="text-left">Comment</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_statues as $order_status) { ?>
                    <tr>
                        <td class="text-left"><?php echo date('d/m/Y', strtotime($order_status['date_added'])) ?></td>
                        <td class="text-left"><?php echo $order_status['order_status'] ?></td>
                        <td class="text-left"><?php echo $order_status['comment'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="buttons clearfix">
                <div class="pull-right"><a class="btn btn-primary" href="<?php echo base_url('account/order') ?>">Continue</a></div>
            </div>
        </div>
    </div>
</div>

