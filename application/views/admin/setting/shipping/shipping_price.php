<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <h1>Shipping Price</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/setting/shipping') ?>">Shipping</a></li>
                <li><a href="<?php echo base_url('admin/setting/shipping/price') ?>">Shipping Price</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php
        if ($this->session->flashdata('success')) {
            echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> '.$this->session->flashdata('success').'<button data-dismiss="alert" class="close" type="button">×</button></div>';
        }
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> Country & Price (in $ USD)</h3>
            </div>
            <div class="panel-body">
                <!-- <div class="form-group">
                    <a target="_blank" href="<?php echo base_url('admin/setting/shipping/download_shipping_prices') ?>" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download Current Shipping Price</a>
                </div> -->
                <!-- <form id="form-shipping" action="<?php echo base_url('admin/setting/shipping/shipping_price') ?>" method="post" enctype="multipart/form-data" id="form-shipping"> -->
                <form id="form-shipping" action="<?php echo base_url('admin/setting/shipping/update_single_shipping_price') ?>" method="post">
                    <div class="table-responsive" style="max-height: 400px;">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td class="text-left">Country</td>
                                    <?php
                                    $tmp_count_column = 1;
                                    if(!empty($shipping_types) && is_array($shipping_types)){
                                        foreach($shipping_types as $i => $v){
                                            echo '<td class="text-left">'.$v['title'].'</td>';
                                            $tmp_count_column++;
                                        }
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Display all country
                                if(!empty($countries) && is_array($countries)){
                                    foreach($countries as $country_id => $row){

                                        //Set prices
                                        $this_shipping_row = '';
                                        if(!empty($shipping_types) && is_array($shipping_types)){
                                            foreach($shipping_types as $shipping_id => $v){
                                                $tmp_price = 0;

                                                //Search & override with current price
                                                if(isset($shipping_prices[$shipping_id][$country_id])){
                                                    $tmp_price = $shipping_prices[$shipping_id][$country_id];
                                                }

                                                $this_shipping_row .= '
                                                    <td class="text-left">
                                                        <input type="text" class="form-control update_single_shipping_price" name="price['.$shipping_id.']['.$country_id.']" value="'.$tmp_price.'" data-shipping_id="'.$shipping_id.'" data-country_id="'.$country_id.'">
                                                    </td>
                                                ';
                                            }
                                        }


                                        echo '
                                        <tr>   
                                            <td class="text-left">
                                                <input type="hidden" class="form-control" name="id[]" value="'.$row['country_id'].'">'.$row['name'].'
                                            </td>
                                            '.$this_shipping_row.'
                                        </tr>
                                        ';
                                    }
                                }else{
                                    echo '
                                        <tr>
                                            <td colspan="'.$tmp_count_column.'" class="text-center">No data country was found.</td>
                                        </tr>
                                    ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- <div class="form-group" style="margin-top: 10px;">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div> -->
                </form>
            </div>
        </div>
    </div>
</div>