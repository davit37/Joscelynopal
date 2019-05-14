<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1>Order History</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td class="text-right">Order ID</td>
                            <td class="text-left">Order Status</td>
                            <td class="text-left">Date Added</td>
                            <td class="text-right">No. of Products</td>
                            <td class="text-left">Customer</td>
                            <td class="text-right">Total</td>
                            <td class="text-right">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($orders) {
                        $i = 0;
                        foreach ($orders as $order) {
                        ?>
                        <tr>
                            <td class="text-right">#<?php echo $order['order_id'] ?></td>
                            <td class="text-left"><?php echo $order_history[$i] ?></td>
                            <td class="text-left"><?php echo date("d/m/Y", strtotime($order['date_added'])) ?></td>
                            <td class="text-right"><?php echo $total_product[$i] ?></td>
                            <td class="text-left"><?php echo $order['firstname'].' '.$order['lastname'] ?></td>
                            <td class="text-right">$<?php echo number_format($order_total[$i], 2, ',', '') ?></td>
                            <td class="text-right"><a class="btn btn-info" title="" data-toggle="tooltip" href="<?php echo base_url('account/order/info/'.$order['order_id']) ?>" data-original-title="View"><i class="fa fa-eye"></i></a></td>
                        </tr>
                        <?php $i++;}} else { ?>
                        <tr>
                            <td class="text-center" colspan="7">No Result!</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="text-right"></div>
            <div class="buttons clearfix">
                <div class="pull-right"><a class="btn btn-primary" href="<?php echo base_url('account/user') ?>">Continue</a></div>
            </div>

        </div>
    </div>
</div>