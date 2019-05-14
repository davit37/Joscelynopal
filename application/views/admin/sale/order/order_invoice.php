<!DOCTYPE html>
<html lang="en" dir="ltr"><head>
        <meta charset="UTF-8">
        <title>Invoice</title>
        <link media="all" rel="stylesheet" href="<?php echo base_url('assets/admin/javascript/bootstrap/css/bootstrap.css') ?>">
        <script type="text/javascript" src="<?php echo base_url('assets/admin/javascript/jquery/jquery-2.1.1.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/admin/javascript/bootstrap/js/bootstrap.min.js') ?>"></script>
        <link href="<?php echo base_url('assets/admin/javascript/font-awesome/css/font-awesome.min.css') ?>" type="text/css" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url('assets/admin/stylesheet/stylesheet.css') ?>" rel="stylesheet" media="screen" />
    </head>
    <body>
        <div class="container">
            <div style="page-break-after: always;">
                <h1>Invoice #<?php echo $order_id ?></h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td colspan="2">Order Details</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 50%;">
                                <address>
                                    <strong><?php echo $config_store_name[0]['value'] ?></strong><br>
                                    <?php echo $config_store_address[0]['value'] ?>           
                                </address>
                                <b>Telephone:</b> <?php echo $config_store_telephone[0]['value'] ?><br>
                                <b>E-Mail:</b> <?php echo $config_store_email[0]['value'] ?><br>
                                <b>Web Site:</b> <a href="<?php echo base_url() ?>"><?php echo base_url() ?></a>
                            </td>
                            <td style="width: 50%;">
                                <b>Date Added:</b> <?php echo date("d/m/Y", strtotime($order_detail[0]['date_added'])) ?><br>
                                <b>Invoice No.:</b> <?php echo $order_detail[0]['invoice'] ?><br>
                                <b>Order ID:</b> <?php echo $order_id ?><br>
                                <b>Payment Method:</b> <?php echo $order_detail[0]['payment_method'] ?><br>
                                <b>Shipping Method:</b> <?php echo $order_detail[0]['shipping_method'] ?><br>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td style="width: 50%;"><b>Customer</b></td>
                            <td style="width: 50%;"><b>Ship To</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <address>
                                    Name: <?php echo $order_detail[0]['firstname'].' '.$order_detail[0]['lastname'] ?><br>
                                    Email: <?php echo $order_detail[0]['email'] ?><br>
                                    Telephone: <?php echo $order_detail[0]['telephone'] ?><br>
                                    Fax: <?php echo $order_detail[0]['fax'] ?>            
                                </address>
                            </td>
                            <td>
                                <address>
                                    <?php echo $order_detail[0]['company'] ?><br>
                                    <?php echo $order_detail[0]['address_1'] ?><br>
                                    <?php echo $order_detail[0]['address_2'] ?><br>
                                    <?php echo $order_detail[0]['city'] ?> <?php echo $order_detail[0]['postcode'] ?><br>
                                    <?php echo $zone[0]['name'] ?><br>
                                    <?php echo $country[0]['name'] ?>            
                                </address>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td><b>Product</b></td>
                            <td><b>Category</b></td>
                            <td class="text-right"><b>Quantity</b></td>
                            <td class="text-right"><b>Unit Price</b></td>
                            <td class="text-right"><b>Total</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_products as $order_product) { ?>
                        <tr>
                            <td><?php echo $order_product['name'] ?></td>
                            <td><?php echo $order_product['category'] ?></td>
                            <td class="text-right"><?php echo $order_product['quantity'] ?></td>
                            <td class="text-right">$<?php echo number_format($order_product['price'], 2, '.', '') ?></td>
                            <td class="text-right">$<?php echo number_format($order_product['total'], 2, '.', '') ?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="4" class="text-right"><b>Total</b></td>
                            <td class="text-right">$<?php echo number_format($order_total[0]['value'], 2, '.', '') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </body></html>