<!-- <style type="text/css">
    .product-option-value{
        display:inline-block;
        min-width: 150px;
    }
</style> -->
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right"><a class="btn btn-default" href="<?php echo base_url('admin/sale/order') ?>"><i class="fa fa-reply"></i> Cancel</a></div>
            <h1>Orders</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/sale/order') ?>">Orders</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Order</h3>
            </div>
            <div class="panel-body">
                <form id="checkout" class="form-horizontal" method="post" action="<?php echo base_url('admin/sale/order/update') ?>">
                    <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
                    <ul class="nav nav-tabs nav-justified" id="order">
                        <li class="active"><a data-toggle="tab" href="#tab-customer">1. Customer Details</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-cart">2. Products</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-payment">3. Payment Details</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-shipping">4. Shipping Details</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-total">5. Totals</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-customer" class="tab-pane active">

                            <div class="form-group">
                                <label for="input-customer" class="col-sm-2 control-label">Customer</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-customer" placeholder="Customer" value="<?php echo ($order_detail[0]['customer_id'] == 0) ? 'As Guest' : 'As Account - '.$customer[0]['firstname'].' '.$customer[0]['lastname']; ?>" name="customer" readonly>
                                    <input type="hidden" value="<?php echo $order_detail[0]['customer_id'] ?>" name="customer_id">
                                </div>
                            </div>

                            <div class="form-group required <?php echo ($this->session->userdata('error_firstname')) ? 'has-error' : ''; ?>">
                                <label for="input-firstname" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-firstname" value="<?php echo $order_detail[0]['firstname'] ?>" name="firstname">
                                    <?php if ($this->session->userdata('error_firstname')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_firstname') ?></div>
                                    <?php $this->session->unset_userdata('error_firstname') ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_lastname')) ? 'has-error' : ''; ?>">
                                <label for="input-lastname" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-lastname" value="<?php echo $order_detail[0]['lastname'] ?>" name="lastname">
                                    <?php if ($this->session->userdata('error_lastname')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_lastname') ?></div>
                                    <?php $this->session->unset_userdata('error_lastname') ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_email')) ? 'has-error' : ''; ?>">
                                <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-email" value="<?php echo $order_detail[0]['email'] ?>" name="email">
                                    <?php if ($this->session->userdata('error_email')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_email') ?></div>
                                    <?php $this->session->unset_userdata('error_email') ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_telephone')) ? 'has-error' : ''; ?>">
                                <label for="input-telephone" class="col-sm-2 control-label">Telephone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-telephone" value="<?php echo $order_detail[0]['telephone'] ?>" name="telephone">
                                    <?php if ($this->session->userdata('error_telephone')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_telephone') ?></div>
                                    <?php $this->session->unset_userdata('error_telephone') ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-fax" class="col-sm-2 control-label">Fax</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-fax" value="<?php echo $order_detail[0]['fax'] ?>" name="fax">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="input-payment-company">Company</label>
                                <div class="col-sm-10">
                                    <input type="text" name="company" value="<?php echo $order_detail[0]['company'] ?>" id="input-payment-company" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_address_1')) ? 'has-error' : ''; ?>">
                                <label class="control-label col-sm-2" for="input-payment-address-1">Address 1</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address_1" value="<?php echo $order_detail[0]['address_1'] ?>" id="input-payment-address-1" class="form-control">
                                    <?php if ($this->session->userdata('error_address_1')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_address_1') ?></div>
                                    <?php $this->session->unset_userdata('error_address_1') ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="input-payment-address-2">Address 2</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address_2" value="<?php echo $order_detail[0]['address_2'] ?>" id="input-payment-address-2" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_city')) ? 'has-error' : ''; ?>">
                                <label class="control-label col-sm-2" for="input-payment-city">City</label>
                                <div class="col-sm-10">
                                    <input type="text" name="city" value="<?php echo $order_detail[0]['city'] ?>" id="input-payment-city" class="form-control">
                                    <?php if ($this->session->userdata('error_city')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_city') ?></div>
                                    <?php $this->session->unset_userdata('error_city') ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_postcode')) ? 'has-error' : ''; ?>">
                                <label class="control-label col-sm-2" for="input-payment-postcode">Post Code</label>
                                <div class="col-sm-10">
                                    <input type="text" name="postcode" value="<?php echo $order_detail[0]['postcode'] ?>" id="input-payment-postcode" class="form-control">
                                    <?php if ($this->session->userdata('error_postcode')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_postcode') ?></div>
                                    <?php $this->session->unset_userdata('error_postcode') ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_country_id')) ? 'has-error' : ''; ?>">
                                <label class="control-label col-sm-2" for="input-payment-country">Country</label>
                                <div class="col-sm-10">
                                    <select name="country_id" id="input-payment-country" class="form-control">
                                        <option value=""> --- Please Select --- </option>
                                        <?php foreach ($countries as $country) { ?>
                                        <option value="<?php echo $country['country_id'] ?>" <?php echo ($country['country_id'] == $order_detail[0]['country_id']) ? 'selected="selected"':''; ?>><?php echo $country['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="value_country_id" value="<?php echo $order_detail[0]['country_id'] ?>" />
                                    <?php if ($this->session->userdata('error_country_id')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_country_id') ?></div>
                                    <?php $this->session->unset_userdata('error_country_id') ?>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_zone_id')) ? 'has-error' : ''; ?>">
                                <label class="control-label col-sm-2" for="input-payment-zone">Region / State</label>
                                <div class="col-sm-10">
                                    <select name="zone_id" id="input-payment-zone" class="form-control">
                                        <option value=""> --- Please Select --- </option>
                                    </select>
                                    <input type="hidden" name="value_zone_id" value="<?php echo $order_detail[0]['zone_id'] ?>" />
                                    <?php if ($this->session->userdata('error_zone_id')) { ?>
                                    <div class="text-danger"><?php echo $this->session->userdata('error_zone_id') ?></div>
                                    <?php $this->session->unset_userdata('error_zone_id') ?>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="form-group required <?php echo ($this->session->userdata('error_order_status')) ? 'has-error' : ''; ?>">
                                <label class="control-label col-sm-2" for="input-payment-zone">Order Status</label>
                                <div class="col-sm-10">
                                    <?php $name = 'name="order_status'; if($order_detail[0]['order_status'] == 'Completed'){ 
                                      $name = 'disabled';    
                                  }?>
                                  <select <?php echo $name;?> class="form-control">
                                    <?php
                                    $status = array('Pending','Processing','Completed');
                                    $selected = '';
                                    foreach($status as $index => $value){
                                        if($order_detail[0]['order_status'] == $value){
                                            $selected = 'selected';
                                        }

                                        echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                                    }
                                    ?>
                                </select>
                                <?php if ($this->session->userdata('error_order_status')) { ?>
                                <div class="text-danger"><?php echo $this->session->userdata('error_order_status') ?></div>
                                <?php $this->session->unset_userdata('error_order_status') ?>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                    <div id="tab-cart" class="tab-pane">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td class="text-left">Product</td>
                                        <td class="text-left">Category</td>
                                        <td class="text-right">Unit Price</td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody id="cart">
                                    <?php foreach ($order_products as $order_product) { ?>
                                    <tr value="<?php echo $order_product['product_id'];?>">
                                        <td class="text-left">
                                            <?php 
                                            echo '<p style="margin-bottom: 5px;">'.$order_product['name'].'</p>';?>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <?php if(isset($order_product['order_option']) && !empty($order_product['order_option'])){ ?>
                                                    <tr>
                                                        <td class="text-left">Option Name</td>
                                                        <td class="text-left">Value</td>
                                                        <td class="text-right"></td>
                                                    </tr>
                                                    <?php } ?>
                                                </thead>

                                                <?php if(isset($order_product['order_option']) && !empty($order_product['order_option'])){ ?>
                                                <tbody>
                                                    <?php foreach($order_product['order_option'] as $index => $value){ ?>
                                                    <tr>
                                                        <td class="text-left"><p style="margin-bottom: 5px;"><?php echo ucfirst($value['name']);?></p></td>
                                                        <td class="text-right"><?php if(!empty($product_option_value)){ 
                                                            echo '<pre>';
                                                            print_r($product_option_value);
                                                            echo '</pre>';

                                                            echo '<pre>';
                                                            print_r($value);
                                                            echo '</pre>';
                                                            ?>
                                                            <select class="product-option-value form-control" name="product_option_value">
                                                                <?php 
                                                                foreach($product_option_value as $key => $row){
                                                                    $selected = '';
                                                                    if($value['product_option_id'] == $row['product_option_id']){
                                                                        $selected = 'selected';
                                                                        echo '<option '.$selected.' value="'.$row['product_option_value_id'].'" data-product="'.$order_product['product_id'].'" data-product-option="'.$row['product_option_id'].'">'.ucfirst($row['value']).' - $'.number_format($value['price'], 2, '.', '').'</option>';
                                                                    }
                                                                } ?>
                                                            </select>
                                                            <?php } ?></td>
                                                            <td class="text-center" style="width: 3px;">
                                                                <button data-original-title="Remove" type="button" value="<?php echo $value['order_option_id'] ?>" data-toggle="tooltip" title="" data-loading-text="Loading..." class="btn btn-danger btn-remove-option"><i class="fa fa-minus-circle"></i></button>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                    <?php }?>
                                                    <?php if(isset($order_product['order_option']) && !empty($order_product['order_option'])){ ?>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="4">
                                                                <form></form>
                                                                <form class="choose-option form-horizontal">
                                                                    <label>Choose Option</label>
                                                                    <select name="product_option" class="input-option form-control select-option">
                                                                        <?php
                                                                        $temp_product_option_id = array(); 
                                                                        if(!empty($product_option)){
                                                                            foreach($product_option as $i => $v){
                                                                                if($i == 0){
                                                                                    $temp_product_option_id[] = $v['product_option_id'];
                                                                                }
                                                                                echo '<option value="'.$v['product_option_id'].'" data-product="'.$order_product['product_id'].'">'.ucfirst($v['value']).'</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <label style="margin-top: 5px;">Choose Option Value (Select option first)</label>
                                                                    <select name="product_option_value" class="input-option form-control select-option-value">
                                                                        <?php
                                                                        if(!empty($product_option_value)){
                                                                            foreach($product_option_value as $k => $r){
                                                                                $selected = '';

                                                                                if(in_array($r['product_option_id'],$temp_product_option_id)){

                                                                                    echo '<option selected value="'.$r['product_option_value_id'].'">'.ucfirst($r['value']).'</option>';

                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <input type="hidden" name="product_id" value="<?php echo $order_product['product_id'];?>">
                                                                    <div class="text-right" style="margin-top: 5px;">
                                                                        <button class="btn btn-primary button-option-add" data-loading-text="Loading..." type="submit"><i class="fa fa-plus-circle"></i> Add Option</button>
                                                                    </div>

                                                                </form>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                    <?php }?>
                                                </table>
                                            </td>
                                            <td class="text-left"><?php echo $order_product['category'] ?></td>
                                            <td class="text-right">$<?php echo number_format($order_product['price'], 2, '.', '') ?></td>
                                            <td class="text-center" style="width: 3px;"><button data-original-title="Remove" type="button" value="<?php echo $order_product['product_id'] ?>" data-toggle="tooltip" title="" data-loading-text="Loading..." class="btn btn-danger btn-remove-product"><i class="fa fa-minus-circle"></i></button></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active"><a data-toggle="tab" href="#tab-product" aria-expanded="false">Products</a></li>
                                <li><a data-toggle="tab" href="#tab-shipping-country" aria-expanded="false">Shipping Country</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-product" class="tab-pane active">
                                <!-- <fieldset>
                                    <legend>Add Product(s)</legend>
                                    <div class="form-group">
                                        <label for="input-product" class="col-sm-2 control-label">Choose Product</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="input-product" value="" name="product">
                                            <input type="hidden" value="" name="product_id">
                                        </div>
                                    </div>
                                </fieldset> -->
                                <fieldset>
                                    <div class="form-group">
                                        <label for="input-product" class="col-sm-2 control-label">Choose Product</label>
                                        <div class="col-sm-10">
                                            <select id="input-product" name="product" class="input-select2">
                                              <?php 
                                              if(!empty($product)){
                                                foreach($product as $index => $value){
                                                    echo '<option value="'.$value['product_id'].'">'.$value['name'].'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="text-right">
                                <button class="btn btn-primary" data-loading-text="Loading..." id="button-product-add" type="button"><i class="fa fa-plus-circle"></i> Add Product</button>
                            </div>
                        </div>

                        <div id="tab-shipping-country" class="tab-pane fade">
                            <fieldset>
                                <div class="form-group">
                                    <label for="input-shipping-country" class="col-sm-2 control-label">Choose Country</label>
                                    <div class="col-sm-10">
                                        <select id="input-shipping-country" name="shipping-country" class="form-control">
                                          <?php 
                                          if(!empty($countries)){
                                            foreach($countries as $index => $value){
                                                $selected = '';

                                                if(!empty($shipping_country) && $shipping_country[0]['country_id'] == $value['country_id']){
                                                    $selected = 'selected';
                                                }
                                                if(!empty($value['shipping_price'])){
                                                    echo '<option '.$selected.' value="'.$value['country_id'].'">'.$value['name'].' - $'.number_format($value['shipping_price'], 2, '.', '').'</option>';
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <label for="input-shipping-country" class="col-sm-12 control-label">Only display country with shipping price</label>
                            </div>
                        </fieldset>
                    </div>

                </div>

            </div>
            <div id="tab-payment" class="tab-pane">
                <p>Please select the preferred payment method to use on this order.</p>
                <?php if($bank[0]['status'] == 1) { ?>
                <div class="radio">
                    <label>
                        <input type="radio" name="payment_method" value="Bank Transfer" <?php echo ($order_detail[0]['payment_method'] == 'Bank Transfer') ? 'checked="checked"':''; ?>>
                        Bank Transfer</label>
                    </div>
                    <?php } ?>

                    <?php if($paypal[0]['status'] == 1) { ?>
                    <div class="radio">
                        <label>
                            <input type="radio" name="payment_method" value="Paypal" <?php echo ($order_detail[0]['payment_method'] == 'Paypal') ? 'checked="checked"':''; ?>>
                            Paypal</label>
                        </div>
                        <?php } ?>
                        <br/>
                        <p><strong>Add Comments About Your Order</strong></p>
                        <p>
                            <textarea name="payment_comment" rows="8" class="form-control"><?php echo $order_detail[0]['payment_comment'] ?></textarea>
                        </p>

                    </div>
                    <div id="tab-shipping" class="tab-pane">
                        <p>Please select the preferred shipping method to use on this order.</p>
                        <?php if($shipping) {
                            foreach ($shipping as $ship) {
                                ?>

                                <div class="radio">
                                    <label><input type="radio" <?php echo ($order_detail[0]['shipping_method'] == $ship['title']) ? 'checked="checked"':''; ?> value="<?php echo $ship['title'] ?>" name="shipping_method"> <?php echo $ship['title'] ?></label>
                                </div>

                                <?php }} ?>
                                <br/>
                                <p><strong>Add Comments About Your Order</strong></p>
                                <p>
                                    <textarea name="shipping_comment" rows="8" class="form-control"><?php echo $order_detail[0]['shipping_comment'] ?></textarea>
                                </p>

                            </div>
                            <div id="tab-total" class="tab-pane">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <td class="text-left">Product</td>
                                                <td class="text-left">Model</td>
                                                <td class="text-right">Unit Price</td>
                                            </tr>
                                        </thead>
                                        <tbody id="total">
                                            <?php foreach ($order_products as $order_product) { ?>
                                            <tr>
                                                <td class="text-left"><?php echo $order_product['name'] ?></td>
                                                <td class="text-left"><?php echo $order_product['category'] ?></td>
                                                <td class="text-right">$<?php echo number_format($order_product['price'], 2, '.', '') ?></td>
                                            </tr>
                                            <?php } ?>
                                            <?php if(!empty($shipping_country)){ ?>
                                            <tr>
                                                <td class="text-right" colspan="2">Shipping to: <?php echo $shipping_country[0]['name'];?></td>
                                                <td class="text-right">$<?php echo number_format($shipping_country[0]['shipping_price'], 2, '.', '') ?></td>
                                            </tr>
                                            <?php } ?>
                                            <tr><td class="text-right" colspan="2">Total:</td>
                                                <td class="text-right">$<?php echo number_format($order_total[0]['value'], 2, '.', '') ?></td>
                                            </tr>
                                            <input type="hidden" name="total" value="<?php echo number_format($order_total[0]['value'], 2, '.', '') ?>">
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 text-left">

                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <button class="btn btn-primary" id="button-save" type="button"><i class="fa fa-check-circle"></i> Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript"><!--

            function capitalize(str) {
                strVal = '';
                str = str.split(' ');
                for (var chr = 0; chr < str.length; chr++) {
                    strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' '
                }
                return strVal
            }

        // Customer
/*        $('input[name=\'customer\']').autocomplete({
            'source': function(request, response) {
                var like_by = $('input[name=\'customer\']').val();

                $.ajax({
                    url: "<?php echo base_url('admin/sale/order/customer_autocomplete/customer') ?>/" + like_by,
                    dataType: 'json',
                    success: function(json) {
                        json.unshift({
                            customer_id: '0',
                            name: 'Guest',
                            firstname: '',
                            lastname: '',
                            email: '',
                            telephone: '',
                            fax: '',
                            company: '',
                            address_1: '',
                            address_2: '',
                            city: '',
                            postcode: '',
                            country_id: '',
                            zone_id: '',
                            zones: ''
                        });

                        response($.map(json, function(item) {
                            return {
                                customer_id: item['customer_group'],
                                label: item['name'],
                                value: item['customer_id'],
                                firstname: item['firstname'],
                                lastname: item['lastname'],
                                email: item['email'],
                                telephone: item['telephone'],
                                fax: item['fax'],
                                company: item['company'],
                                address_1: item['address_1'],
                                address_2: item['address_2'],
                                city: item['city'],
                                postcode: item['postcode'],
                                country_id: item['country_id'],
                                zone_id: item['zone_id'],
                                zones: item['zones']
                            }
                        }));
                    }
                });
            },
            'select': function(item) {
                $('#tab-customer input[name=\'customer\']').val(item['label']);
                $('#tab-customer input[name=\'customer_id\']').val(item['value']);
                $('#tab-customer input[name=\'firstname\']').val(item['firstname']);
                $('#tab-customer input[name=\'lastname\']').val(item['lastname']);
                $('#tab-customer input[name=\'email\']').val(item['email']);
                $('#tab-customer input[name=\'telephone\']').val(item['telephone']);
                $('#tab-customer input[name=\'fax\']').val(item['fax']);
                $('#tab-customer input[name=\'company\']').val(item['company']);
                $('#tab-customer input[name=\'address_1\']').val(item['address_1']);
                $('#tab-customer input[name=\'address_2\']').val(item['address_2']);
                $('#tab-customer input[name=\'city\']').val(item['city']);
                $('#tab-customer input[name=\'postcode\']').val(item['postcode']);
                $('#tab-customer input[name=\'value_country_id\']').val(item['country_id']);
                $('#tab-customer input[name=\'value_country_id\']').val(item['zone_id']);

                $('#tab-customer #input-payment-country option[value=\'' + item['country_id'] + '\']').attr("selected", "selected");

                html = '<option value=""> --- Please Select --- </option>';
                for (i = 0; i < item['zones'].length; i++) {
                    if (item['zones'][i]['zone_id'] == item['zone_id']) {
                        html += '<option selected="selected" value="' + item['zones'][i]['zone_id'] + '">' + item['zones'][i]['name'] + '</option>';
                    } else {
                        html += '<option value="' + item['zones'][i]['zone_id'] + '">' + item['zones'][i]['name'] + '</option>';
                    }
                }
                $('#tab-customer #input-payment-zone').html(html);
            }
        });

$('select[name=\'country_id\']').on('change', function() {
    $.ajax({
        url: '<?php echo base_url('admin/sale/order/country') . '/'; ?>' + this.value,
        dataType: 'json',
        beforeSend: function() {
            $('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        complete: function() {
            $('.fa-spin').remove();
        },
        success: function(json) {
            html = '<option value=""> --- Please Select --- </option>';

            for (i = 0; i < json.length; i++) {
                html += '<option value="' + json[i]['zone_id'] + '"';
                html += '>' + json[i]['name'] + '</option>';

                if (json[i]['zone_id']  == <?php echo $order_detail[0]['zone_id'] ?>) {
                    html += '<option selected="selected" value="' + json[i]['zone_id'] + '">' + json[i]['name'] + '</option>';
                } else {
                    html += '<option value="' + json[i]['zone_id'] + '">' + json[i]['name'] + '</option>';
                }
            }

            $('select[name=\'zone_id\']').html(html);
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});*/

$('select[name=\'country_id\']').trigger('change');

var input_product               = $('#input-product');
var input_select2               = $('.input-select2');
var input_product_option        = $('.product-option-value');
var input_select_option         = $('.select-option');
var input_select_option_value   = $('.select-option-value');
var input_option                = $('.input-option');

$(input_select2).select2();
$(input_option).select2();

$(input_option).each(function(i,v){

    $input_select_option = $(this);
    var input_select_option = i;
    var input_select_option_value = input_select_option + 1;

    $(this).on('select2:select', function (e) {

        var selected = $(this).hasClass('select-option');

        var data                = $(this).val();
        var table               = $(this).closest('table');
        var row_option          = $(table).find('tbody').find('tr');
        var select_option_value = $(input_option)[input_select_option_value];

        // save current config. options
        var options = $(select_option_value).data('select2').options.options;

        // delete all items of the native select element
        if(selected == true){
            $.ajax({
              url: '<?php echo base_url('admin/sale/order/option_value_change').'/' ?>' + data,
              dataType: 'json',
              beforeSend: function() {
              },
              complete: function() {
              },
              success: function(json) {

                $(select_option_value).html('');

                var items = [];
                for (var i = 0; i < json.length; i++) {

                    items.push({
                        "id": json[i]['product_option_value_id'],
                        "text": capitalize(json[i]['value']) 
                    });

                    $(select_option_value).append("<option value=\"" + json[i]['product_option_value_id'] + "\">" + capitalize(json[i]['value']) + "</option>");
                }

                options.data = items;
                $(select_option_value).select2(options);

            },
            error: function(xhr, ajaxOptions, thrownError) {
               alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
           }
       });
        }
    });

});

        /*$('#tab-product input[name=\'product\']').autocomplete({
            'source': function(request, response) {
                var like_by = $('input[name=\'product\']').val();
                $.ajax({
                    url: "<?php echo base_url('admin/sale/order/autocomplete/product') ?>/" + like_by,
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
                $('#tab-product input[name=\'product\']').val(item['label']);
                $('#tab-product input[name=\'product_id\']').val(item['value']);
            }
        });*/ 

        /*$(document).find('#tab-cart').on('change','.product-option-value', function() {
            alert('a');
        }*/

        $("#tab-cart").on("change", ".product-option-value", function() {
            var product_option_value = $(this).val();
            var product              = $(this).find(':selected').data('product');
            var element = $(this);

            $.ajax({
              url: '<?php echo base_url('admin/sale/order/option_change').'/' ?>' + product_option_value + '/' + product,
              dataType: 'json',
              beforeSend: function() {
                $(element).attr('disabled',true);
            },
            complete: function() {
                $(element).attr('disabled',false);
            },
            success: function(json) {

                //console.log(json);
                /*$(select_option_value).html('');

                var items = [];
                for (var i = 0; i < json.length; i++) {

                    items.push({
                        "id": json[i]['product_option_value_id'],
                        "text": capitalize(json[i]['value']) 
                    });

                    $(select_option_value).append("<option value=\"" + json[i]['product_option_value_id'] + "\">" + capitalize(json[i]['value']) + "</option>");
                }

                options.data = items;
                $(select_option_value).select2(options);*/

            },
            error: function(xhr, ajaxOptions, thrownError) {
               alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
           }
       });
        });

        $('#tab-cart').delegate('.btn-remove-option', 'click', function() {
            var table               = $(this).closest('table');
            var row_option          = $(table).find('tbody').find('tr');
            var this_row_option     = $(this).closest('tr');
            var select_option_value = $(this_row_option).find('.product-option-value');
            var option_value        = $(select_option_value).val();
            var product_value       = $(this_row_option).find('.product-option-value option:selected').data('product');
            var product_option      = $(this_row_option).find('.product-option-value option:selected').data('product-option');

            console.log(product_value);
            console.log(option_value);
            console.log(product_option);
            $.ajax({
              url: '<?php echo base_url('admin/sale/order/option_remove').'/' ?>' + product_value + '/' + option_value + '/' + product_option,
              dataType: 'json',
              beforeSend: function() {
                $('.btn-remove-option').button('loading');
                $('.btn-remove-option').attr('disabled',true);
            },
            complete: function() {
                $('.btn-remove-option').button('reset');
                $('.btn-remove-option').attr('disabled',false);
            },
            success: function(json) {

                console.log(json);
                $(this_row_option).remove();
                if(row_option.length <= 1){
                    $(table).find('thead').empty();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
               $('.btn-remove-option').attr('disabled',false);
               $('.btn-remove-option').button('reset');
               alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
           }
       });

        });

        var form_option = $('.choose-option');


        $(form_option).each(function(){

            var table           = $(this).closest('table');
            var thead           = $(table).find('thead');
            var tbody           = $(table).find('tbody');
            var button_submit   = $(this).find('button[type="submit"]'); 

            $(this).validate({
                rules:{
                    product_option: "required",
                    product_option_value: "required"
                },
                submitHandler: function(form) {

                    var data_form = $(form).serializeArray();
                    //console.log(data_form);
                    $.ajax({
                      url: '<?php echo base_url('admin/sale/order/option_add').'/'.$order_id ?>',
                      type: 'POST',
                      data: data_form,
                      dataType: 'json',
                      beforeSend: function() {
                        $(button_submit).button('loading');
                        $(button_submit).attr('disabled',true);
                    },
                    complete: function() {
                        $(button_submit).button('reset');
                        $(button_submit).attr('disabled',false);
                    },
                    success: function(json) {

                        console.log(json);

                        if(json.flag == true){
                            if(thead.length > 0){
                                if( !$.trim( $(thead).html() ).length ) {

                                    var thead_template = '<tr>' 
                                    + '<td class="text-left">Product</td>'
                                    + '<td class="text-left">Category</td>'
                                    + '<td class="text-right">Unit Price</td>'
                                    + '<td></td>'
                                    + '</tr>';
                                    $(thead).append(thead_template);

                                }
                            }

                            $(json.template).appendTo(tbody);
                        }

                        if(json.flag == false){
                            alert(json.message);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                       $(button_submit).attr('disabled',false);
                       $(button_submit).button('reset');
                       alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   }
               });

                }
            });

        });

        /*$('#tab-cart').delegate('.button-option-add', 'click', function() {
            var table               = $(this).closest('table');
            var row_option          = $(table).find('tbody').find('tr');
            var this_row_option     = $(this).closest('tr');
            var select_option_value = $(this_row_option).find('.input-option');
            var option_value        = $(select_option_value).val();
            var product_value       = $(this_row_option).find('.input-option option:selected').data('product');

            $.ajax({
              url: '<?php echo base_url('admin/sale/order/option_add').'/' ?>' + product_value + '/' + option_value,
              dataType: 'json',
              beforeSend: function() {
                $('.button-option-add').button('loading');
                $('.button-option-add').attr('disabled',true);
            },
            complete: function() {
                $('.button-option-add').button('reset');
                $('.button-option-add').attr('disabled',false);
            },
            success: function(json) {

                $(this_row_option).remove();
                if(row_option.length <= 1){
                    $(table).find('thead').empty();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
               $('.button-option-add').attr('disabled',false);
               $('.button-option-add').button('reset');
               alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
           }
       });

   }); */

   $('#button-product-add').on('click', function() {

    var product_id           = $(input_product).val();
    var tbody_cart           = $(document).find('#cart');

    $.ajax({
      url: '<?php echo base_url('admin/sale/order/product_add').'/' ?>' + product_id,
      dataType: 'json',
      beforeSend: function() {
       $('#button-product-add').button('loading');
       $('#button-product-add').attr('disabled',true);
   },
   complete: function() {
       $('#button-product-add').button('reset');
       $('#button-product-add').attr('disabled',false);
   },
   success: function(json) {
    $('#button-product-add').attr('disabled',false);
    console.log(json);
    html = '';
    html2 = '';
    total = 0;

    if(json.flag == true){
        $(json.template).appendTo(tbody_cart);
    }

    if(json.flag == false){
        alert(json.message);
    }

        /*for(i=0;i<json.length;i++) {
            if(json[i]['special_price']) {
                price = json[i]['special_price'];
            } else {
                price = json[i]['price'];
            }

            html += "<tr>";
            html += '<td class="text-left">' + json[i]['product_name'] + '</td>';
            html += '<td class="text-left">' + json[i]['category_name'] + '</td>';
                            //html += '<td class="text-right">' + json[i]['quantity'] + '</td>';
                            if(json[i]['special_price']) {
                                html += '<td class="text-right"><span class="has-special">$' + (json[i]['price'] * 1).toFixed(2) + '</span> $' + (price * 1).toFixed(2) + '</td>';
                            } else {
                                html += '<td class="text-right">$' + (price * 1).toFixed(2) + '</td>';
                            }
                            //html += '<td class="text-right">$' + (json[i]['quantity'] * price).toFixed(2) + '</td>';
                            html += '<td class="text-center" style="width: 3px;"><button data-original-title="Remove" type="button" value="'+ json[i]['product_id'] +'" data-toggle="tooltip" title="" data-loading-text="Loading..." class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
                            html += '</tr>';
                            
                            //total = total + (json[i]['quantity'] * price);
                            total = total + price;
                            html2 += "<tr>";
                            html2 += '<td class="text-left">' + json[i]['product_name'] + '</td>';
                            html2 += '<td class="text-left">' + json[i]['category_name'] + '</td>';
                            //html2 += '<td class="text-right">' + json[i]['quantity'] + '</td>';
                            if(json[i]['special_price']) {
                                html2 += '<td class="text-right"><span class="has-special">$' + (json[i]['price'] * 1).toFixed(2) + '</span> $' + (price * 1).toFixed(2) + '</td>';
                            } else {
                                html2 += '<td class="text-right">$' + (price * 1).toFixed(2) + '</td>';
                            }
                            //html2 += '<td class="text-right">$' + (json[i]['quantity'] * price).toFixed(2) + '</td>';
                            html2 += '</tr>';
                        }
                        
                        //html2 += '<tr><td class="text-right" colspan="4">Total:</td>  <td class="text-right">$'+ (total * 1).toFixed(2) +'</td></tr>';
                        html2 += '<tr><td class="text-right" colspan="3">Total:</td>  <td class="text-right">$'+ (total * 1).toFixed(2) +'</td></tr>';
                        html2 += '<input type="hidden" name="total" value="'+ (total * 1).toFixed(2) +'">';
                        
                        $('#cart').html(html);
                        $('#total').html(html2);
                        */
                        
                        
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                       $('#button-product-add').attr('disabled',false);
                       alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                   }
               });				
});

$('#tab-cart').delegate('.btn-remove-product', 'click', function() {
    var node = this;
    var product_id = $(this).val();
    var product_row = $(this).closest('tr');
    $.ajax({
      url: '<?php echo base_url('admin/sale/order/product_remove').'/' ?>' + product_id,
      dataType: 'json',
      beforeSend: function() {
       $(node).button('loading');
   },
   complete: function() {
       $(node).button('reset');
         //$('.tooltip').remove();
     },
     success: function(json) {
        console.log(json);
        $(product_row).remove();
        /*console.log('a');
        console.log(json);*/
         /*html = '';
         html2 = '';
         total = 0;

         for(i=0;i<json.length;i++) {
            if(json[i]['special_price']) {
                price = json[i]['special_price'];
            } else {
                price = json[i]['price'];
            }

            html += "<tr>";
            html += '<td class="text-left">' + json[i]['product_name'] + '</td>';
            html += '<td class="text-left">' + json[i]['category_name'] + '</td>';
            html += '<td class="text-right">' + json[i]['quantity'] + '</td>';
            if(json[i]['special_price']) {
                html += '<td class="text-right"><span class="has-special">$' + (json[i]['price'] * 1).toFixed(2) + '</span> $' + (price * 1).toFixed(2) + '</td>';
            } else {
                html += '<td class="text-right">$' + (price * 1).toFixed(2) + '</td>';
            }
            html += '<td class="text-right">$' + (json[i]['quantity'] * price).toFixed(2) + '</td>';
            html += '<td class="text-center" style="width: 3px;"><button data-original-title="Remove" type="button" value="'+ json[i]['product_id'] +'" data-toggle="tooltip" title="" data-loading-text="Loading..." class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
            html += '</tr>';

            total = total + (json[i]['quantity'] * price);

            html2 += "<tr>";
            html2 += '<td class="text-left">' + json[i]['product_name'] + '</td>';
            html2 += '<td class="text-left">' + json[i]['category_name'] + '</td>';
            html2 += '<td class="text-right">' + json[i]['quantity'] + '</td>';
            if(json[i]['special_price']) {
                html2 += '<td class="text-right"><span class="has-special">$' + (json[i]['price'] * 1).toFixed(2) + '</span> $' + (price * 1).toFixed(2) + '</td>';
            } else {
                html2 += '<td class="text-right">$' + (price * 1).toFixed(2) + '</td>';
            }
            html2 += '<td class="text-right">$' + (json[i]['quantity'] * price).toFixed(2) + '</td>';
            html2 += '</tr>';
        }

        html2 += '<tr><td class="text-right" colspan="4">Total:</td>  <td class="text-right">$'+ (total * 1).toFixed(2) +'</td></tr>';
        html2 += '<input type="hidden" name="total" value="'+ (total * 1).toFixed(2) +'">';*/

        /*$('#cart').html(html);
        $('#total').html(html2);*/



    },
    error: function(xhr, ajaxOptions, thrownError) {
       alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
   }
});				
});

$('#button-save').on('click', function() {
    $('#checkout').submit();
});

//--></script> 
</div>