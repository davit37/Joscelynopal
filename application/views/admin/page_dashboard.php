<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>Dashboard</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Dashboard</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6"><div class="tile">
                    <div class="tile-heading">Total Orders</div>
                    <div class="tile-body"><i class="fa fa-shopping-cart"></i>
                        <h2 class="pull-right"><?php echo $total_order; ?></h2>
                    </div>
                    <div class="tile-footer"><a href="<?php echo base_url('admin/sale/order') ?>">View more...</a></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6"><div class="tile">
                    <div class="tile-heading">Total Sales</div>
                    <div class="tile-body"><i class="fa fa-credit-card"></i>
                        <h2 class="pull-right"><?php echo $total ?></h2>
                    </div>
                    <div class="tile-footer"><a href="<?php echo base_url('admin/sale/order') ?>">View more...</a></div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6"><div class="tile">
                    <div class="tile-heading">Total Customers</div>
                    <div class="tile-body"><i class="fa fa-user"></i>
                        <h2 class="pull-right"><?php echo $total_customer ?></h2>
                    </div>
                    <div class="tile-footer"><a href="<?php echo base_url('admin/sale/customer') ?>">View more...</a></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sx-12 col-sm-12"><div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar"></i> <i class="caret"></i></a>
                            <ul id="range" class="dropdown-menu dropdown-menu-right">
                                <li><a href="day">Today</a></li>
                                <li><a href="week">Week</a></li>
                                <li class="active"><a href="month">Month</a></li>
                                <li><a href="year">Year</a></li>
                            </ul>
                        </div>
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Sales Analytics</h3>
                    </div>
                    <div class="panel-body">
                        <div id="chart-sale" style="width: 100%; height: 260px;"></div>
                    </div>
                </div>
                <script src="<?php echo base_url('assets/admin/javascript/jquery/flot/jquery.flot.js') ?>" type="text/javascript"></script>
                <script src="<?php echo base_url('assets/admin/javascript/jquery/flot/jquery.flot.resize.min.js') ?>" type="text/javascript"></script>
                <script type="text/javascript"><!--
                    $('#range a').on('click', function(e) {
                        e.preventDefault();

                        $(this).parent().parent().find('li').removeClass('active');

                        $(this).parent().addClass('active');

                        var range = $(this).attr('href');

                        $.ajax({
                            url: '<?php echo base_url('admin/dashboard/chart') . '/' ?>' + range,
                            dataType: 'json',
                            success: function(json) {
                                if (typeof json['order'] == 'undefined') {
                                    return false;
                                }
                                var option = {
                                    shadowSize: 0,
                                    colors: ['#9FD5F1', '#1065D2'],
                                    bars: {
                                        show: true,
                                        fill: true,
                                        lineWidth: 1
                                    },
                                    grid: {
                                        backgroundColor: '#FFFFFF',
                                        hoverable: true
                                    },
                                    points: {
                                        show: false
                                    },
                                    xaxis: {
                                        show: true,
                                        ticks: json['xaxis']
                                    }
                                }

                                $.plot('#chart-sale', [json['order'], json['customer']], option);

                                $('#chart-sale').bind('plothover', function(event, pos, item) {
                                    $('.tooltip').remove();

                                    if (item) {
                                        $('<div id="tooltip" class="tooltip top in"><div class="tooltip-arrow"></div><div class="tooltip-inner">' + item.datapoint[1].toFixed(2) + '</div></div>').prependTo('body');

                                        $('#tooltip').css({
                                            position: 'absolute',
                                            left: item.pageX - ($('#tooltip').outerWidth() / 2),
                                            top: item.pageY - $('#tooltip').outerHeight(),
                                            pointer: 'cusror'
                                        }).fadeIn('slow');

                                        $('#chart-sale').css('cursor', 'pointer');
                                    } else {
                                        $('#chart-sale').css('cursor', 'auto');
                                    }
                                });
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                        });
                    });

                    $('#range .active a').trigger('click');
                    //--></script>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-sx-12"> <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Latest Orders</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td class="text-right">Order ID</td>
                                    <td>Customer</td>
                                    <td>Status</td>
                                    <td>Date Added</td>
                                    <td class="text-right">Total</td>
                                    <td class="text-right">Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($recent_orders) {
                                    foreach ($recent_orders as $recent_order) {
                                        ?>
                                        <tr>
                                            <td class="text-right"><?php echo $recent_order['order_id'] ?></td>
                                            <td><?php echo $recent_order['firstname'] . ' ' . $recent_order['lastname'] ?></td>
                                            <td><?php echo $recent_order['order_status'] ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($recent_order['date_added'])) ?></td>
                                            <td class="text-right"><?php echo number_format($recent_order['total'], 2, '.', '') ?></td>
                                            <td class="text-right"><a class="btn btn-info" title="" data-toggle="tooltip" href="<?php echo base_url('admin/sale/order/info/' . $recent_order['order_id']) ?>" data-original-title="View"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td class="text-center" colspan="6">No results!</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>