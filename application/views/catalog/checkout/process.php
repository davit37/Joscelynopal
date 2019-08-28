


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/table-cart.css').'?'.md5(date('c'));?>">
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php if ($this->session->userdata('error_agree')) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $this->session->userdata('error_agree') ?></div>
            <?php $this->session->unset_userdata('error_agree') ?>
            <?php } ?>
            <h1>Checkout</h1>
            <div id="accordion" class="panel-group">
                <form enctype="multipart/form-data" method="post" action="<?php echo base_url('checkout/process/save') ?>">
                    <!-- Customer Detail Start -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapse-payment-address" aria-expanded="true">Customer Details <i class="fa fa-caret-down"></i></a></h4>
                        </div>
                        <div id="collapse-payment-address" class="panel-collapse collapse in" aria-expanded="true" style="">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <fieldset id="address" class="">
                                            <legend>Shipping Payment</legend>
                                            <div class="form-group">
                                                <label for="input-payment-shipping" class="control-label">Country</label>
                                                <select class="form-control" id="input-payment-shipping" name="shipping_country_id">
                                                    <option value=""> --- Select Country --- </option>
                                                    <?php
                                                    $country_id = ($user) ? $user[0]['country_id'] : 100;
                                                    foreach ($countries as $country) {

                                                        $selected = '';

                                                        ($this->session->userdata('value_shipping_country_id') == $country['country_id']) ? $selected = 'selected': $selected = '';

                                                        if ($country['shipping_price'] != NULL) {
                                                            echo "<option ".$selected." data-name=".$country['name']." data-price=".number_format($country['shipping_price'], 2, '.', '')." value='" . $country['country_id'] . "'>" . $country['name'] . " - $". number_format($country['shipping_price'], 2, '.', '') ."</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <?php if ($this->session->userdata('error_country_id')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_country_id') ?></div>
                                                <?php $this->session->unset_userdata('error_country_id') ?>
                                                <?php } ?>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-sm-12">
                                        <fieldset id="account">
                                            <legend>Your Personal Details</legend>

                                            <div class="form-group <?php echo ($this->session->userdata('error_firstname')) ? 'has-error' : ''; ?>">
                                                <label for="input-payment-firstname" class="control-label"><span class="required">*</span> First Name</label>
                                                <input type="text" class="form-control" id="input-payment-firstname" placeholder="First Name" value="<?php echo ($user) ? $user[0]['firstname'] : $this->session->userdata('value_firstname'); ?>" name="firstname">
                                                <?php if ($this->session->userdata('error_firstname')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_firstname') ?></div>
                                                <?php $this->session->unset_userdata('error_firstname') ?>
                                                <?php } ?>
                                                <?php $this->session->unset_userdata('value_firstname') ?>
                                            </div>
                                            <div class="form-group <?php echo ($this->session->userdata('error_lastname')) ? 'has-error' : ''; ?>">
                                                <label for="input-payment-lastname" class="control-label"><span class="required">*</span> Last Name</label>
                                                <input type="text" class="form-control" id= "input-payment-lastname" placeholder="Last Name" value="<?php echo ($user) ? $user[0]['lastname'] : $this->session->userdata('value_lastname'); ?>" name="lastname">
                                                <?php if ($this->session->userdata('error_lastname')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_lastname') ?></div>
                                                <?php $this->session->unset_userdata('error_lastname') ?>
                                                <?php } ?>
                                                <?php $this->session->unset_userdata('value_lastname') ?>
                                            </div>
                                            <div class="form-group <?php echo ($this->session->userdata('error_email')) ? 'has-error' : ''; ?>">
                                                <label for="input-payment-email" class="control-label"><span class="required">*</span> E-Mail</label>
                                                <input type="text" class="form-control" id="input-payment-email" placeholder="E-Mail" value="<?php echo ($user) ? $user[0]['email'] : $this->session->userdata('value_email'); ?>" name="email">
                                                <?php if ($this->session->userdata('error_email')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_email') ?></div>
                                                <?php $this->session->unset_userdata('error_email') ?>
                                                <?php } ?>
                                                <?php $this->session->unset_userdata('value_email') ?>
                                            </div>
                                            <div class="form-group <?php echo ($this->session->userdata('error_telephone')) ? 'has-error' : ''; ?>">
                                                <label for="input-payment-telephone" class="control-label"><span class="required">*</span> Telephone</label>
                                                <input type="text" class="form-control" id="input-payment-telephone" placeholder="Telephone" value="<?php echo ($user) ? $user[0]['telephone'] : $this->session->userdata('value_telephone'); ?>" name="telephone">
                                                <?php if ($this->session->userdata('error_telephone')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_telephone') ?></div>
                                                <?php $this->session->unset_userdata('error_telephone') ?>
                                                <?php } ?>
                                                <?php $this->session->unset_userdata('value_telephone') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="input-payment-fax" class="control-label">Fax</label>
                                                <input type="text" class="form-control" id="input-payment-fax" placeholder="Fax" value="<?php echo ($user) ? $user[0]['fax'] : $this->session->userdata('value_fax'); ?>" name="fax">
                                                <?php $this->session->unset_userdata('value_fax') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="input-payment-company" class="control-label">Company</label>
                                                <input type="text" class="form-control" id="input-payment-company" placeholder="Company" value="<?php echo ($user) ? $user[0]['company'] : $this->session->userdata('value_company'); ?>" name="company">
                                                <?php $this->session->unset_userdata('value_company') ?>
                                            </div>
                                            <div class="form-group <?php echo ($this->session->userdata('error_address_1')) ? 'has-error' : ''; ?>">
                                                <label for="input-payment-address-1" class="control-label"><span class="required">*</span> Address 1</label>
                                                <input type="text" class="form-control" id="input-payment-address-1" placeholder="Address 1" value="<?php echo ($user) ? $user[0]['address_1'] : $this->session->userdata('value_address_1'); ?>" name="address_1">
                                                <?php if ($this->session->userdata('error_address_1')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_address_1') ?></div>
                                                <?php $this->session->unset_userdata('error_address_1') ?>
                                                <?php } ?>
                                                <?php $this->session->unset_userdata('value_address_1') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="input-payment-address-2" class="control-label">Address 2</label>
                                                <input type="text" class="form-control" id="input-payment-address-2" placeholder="Address 2" value="<?php echo ($user) ? $user[0]['address_2'] : $this->session->userdata('value_address_2'); ?>" name="address_2">
                                                <?php $this->session->unset_userdata('value_address_2') ?>
                                            </div>
                                            <div class="form-group <?php echo ($this->session->userdata('error_city')) ? 'has-error' : ''; ?>">
                                                <label for="input-payment-city" class="control-label"><span class="required">*</span> City</label>
                                                <input type="text" class="form-control" id="input-payment-city" placeholder="City" value="<?php echo ($user) ? $user[0]['city'] : $this->session->userdata('value_city'); ?>" name="city">
                                                <?php if ($this->session->userdata('error_city')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_city') ?></div>
                                                <?php $this->session->unset_userdata('error_city') ?>
                                                <?php } ?>
                                                <?php $this->session->unset_userdata('value_city') ?>
                                            </div>
                                            <div class="form-group <?php echo ($this->session->userdata('error_postcode')) ? 'has-error' : ''; ?>">
                                                <label for="input-payment-postcode" class="control-label"><span class="required">*</span> Post Code</label>
                                                <input type="text" class="form-control" id="input-payment-postcode" placeholder="Post Code" value="<?php echo ($user) ? $user[0]['postcode'] : $this->session->userdata('value_postcode'); ?>" name="postcode">
                                                <?php if ($this->session->userdata('error_postcode')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_postcode') ?></div>
                                                <?php $this->session->unset_userdata('error_postcode') ?>
                                                <?php } ?>
                                                <?php $this->session->unset_userdata('value_postcode') ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="input-payment-country" class="control-label"><span class="required">*</span> Country</label>
                                                <select class="form-control" id="input-payment-country" name="country_id">
                                                    <option value=""> --- Please Select --- </option>
                                                    <?php
                                                    $country_id = ($user) ? $user[0]['country_id'] : 100;
                                                    foreach ($countries as $country) {
                                                        if ($country['country_id'] == $country_id) {
                                                            echo "<option value='" . $country['country_id'] . "' selected='selected'>" . $country['name'] . "</option>";
                                                        } else {
                                                            echo "<option value='" . $country['country_id'] . "'>" . $country['name'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <?php if ($this->session->userdata('error_country_id')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_country_id') ?></div>
                                                <?php $this->session->unset_userdata('error_country_id') ?>
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="input-payment-zone" class="control-label"><span class="required">*</span> Region / State</label>
                                                <select class="form-control" id="input-payment-zone" name="zone_id">
                                                    <option value=""> --- Please Select --- </option>
                                                    <?php
                                                    $zone_id = ($user) ? $user[0]['zone_id'] : '';
                                                    foreach ($zones as $zone) {
                                                        if ($zone['zone_id'] == $zone_id) {
                                                            echo "<option value='" . $zone['zone_id'] . "' selected='selected'>" . $zone['name'] . "</option>";
                                                        } else {
                                                            echo "<option value='" . $zone['country_id'] . "'>" . $zone['name'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <?php if ($this->session->userdata('error_zone_id')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_zone_id') ?></div>
                                                <?php $this->session->unset_userdata('error_zone_id') ?>
                                                <?php } ?>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Customer Detail End -->

                    <!-- Delivery Method Start -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapse-shipping-method" aria-expanded="true">Delivery Method <i class="fa fa-caret-down"></i></a></h4>
                        </div>
                        <div id="collapse-shipping-method" class="panel-collapse collapse in" aria-expanded="true" style="">
                            <div class="panel-body"><p>Please select the preferred shipping method to use on this order.</p>

                                <?php 
                                if($shipping) {
                                    $j = 0;
                                    foreach ($shipping as $ship) {   
                                        ?>
                                        <?php if($j == 0) { ?>
                                        <div class="radio">
                                            <label><input type="radio" checked="checked" value="<?php echo $ship['title'] ?>" name="shipping_method"><?php echo $ship['title'] ?></label>
                                        </div>
                                        <?php } else { ?>
                                        <div class="radio">
                                            <label><input type="radio" <?php echo ($this->session->userdata('value_shipping_method') == $ship['title']) ? 'checked="checked"':''; ?> value="<?php echo $ship['title'] ?>" name="shipping_method"><?php echo $ship['title'] ?></label>
                                        </div>
                                        <?php } ?>
                                        <?php     
                                        $j++;
                                    }    
                                } 
                                ?>
                                <p><strong>Add Comments About Your Order</strong></p>
                                <p>
                                    <textarea class="form-control" rows="8" name="shipping_comment"><?php echo ($this->session->userdata('value_shipping_comment')) ? $this->session->userdata('value_shipping_comment'):'';  ?></textarea>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Delivery Method End -->

                    <!-- Payment Method Start -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapse-payment-method" aria-expanded="true">Payment Method <i class="fa fa-caret-down"></i></a></h4>
                        </div>
                        <div id="collapse-payment-method" class="panel-collapse collapse in" aria-expanded="true" style="">
                            <div class="panel-body"><p>Please select the preferred payment method to use on this order.</p>

                                <?php if($bank[0]['status'] == 1) { ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" checked="checked" value="Bank Transfer" name="payment_method">
                                        Bank Transfer</label>
                                    </div>
                                    <div id="bank-textarea">
                                        <blockquote>
                                            <?php echo $bank[0]['value'] ?>
                                        </blockquote>
                                    </div>
                                    <?php } ?>

                                    <?php if($paypal[0]['status'] == 1) { ?>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" <?php echo ($this->session->userdata('value_payment_method') == 'Paypal') ? 'checked="checked"':''; ?> value="Paypal" name="payment_method">
                                            Paypal</label>
                                        </div>
                                        <?php } ?>
                                        <p><strong>Add Comments About Your Order</strong></p>
                                        <p>
                                            <textarea class="form-control" rows="8" name="payment_comment"><?php echo ($this->session->userdata('value_payment_comment')) ? $this->session->userdata('value_payment_comment'):''; ?></textarea>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Payment Method End -->
                            <?php if( asso_count($products['data_single'], 'sales_status', 'sold_out') > 0){?>

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapse-checkout-confirm" aria-expanded="true">Item Sold Out <i class="fa fa-caret-down"></i></a></h4>
                                </div>
                              
                                <div id="collapse-checkout-confirm" class="panel-collapse collapse in" aria-expanded="true" style="">
                                        <div  class="items-message col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            
                                            <div class="alert alert-warning">This Items have been bougth by another user
                                            <button type="button" class="close" data-dismiss="alert">×</button></div>
                                        
                                        </div>
                                        <div class="panel-body">

                                           

                                             <div class="wrap cf">
                                                <div class="cart">
                                                    <ul class="cartWrap">
                                                        <?php foreach ($products['data_single'] as $key => $value) { 

                                                            if($value['sales_status']=="sold_out"){?>

                                                                <li class="items">

                                                                    <div class="infoWrap"> 
                                                                        <div class="cartSection">
                                                                            <div class="cartDesc">
                                                                                <img src="<?= base_url('upload').'/'.$value['image'];?>" alt="<?= $value['name'];?>" class="itemImg" />
                                                                            </div>  
                                                                            
                                                                            <div class="cartDesc mainCartDesc">
                                                                                 <h3><?= $value['name'];?></h3>
                                                                            </div>
                                                                        </div>
                                                                    </div> 

                                                                </li>                                                 
                                                        
                                                        
                                                        <?php } }?>
                                                    </ul>
                                                </div>
                                            </div>
                                        
                                        </div>
                                
                                </div>
                            </div>
                            
                            <?php } ?>

                            <!-- Confirm Order Start -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle" data-parent="#accordion" data-toggle="collapse" href="#collapse-checkout-confirm" aria-expanded="true">Confirm Order <i class="fa fa-caret-down"></i></a></h4>
                                </div>
                                <div id="collapse-checkout-confirm" class="panel-collapse collapse in" aria-expanded="true" style="">
                                    <div class="panel-body">

                                        <div class="wrap cf">
                                          <div class="cart">

                                           <?php if(!empty($products['data_single'])){

                                            $total_single   = 0;

                                            $total_opton    = 0;

                                            $total          = 0;

                                            $count_subtotal = 0;

                                            $subtotal       = 0;

                                            $subtotal_option = 0;
                                        } ?>

                                        <ul class="cartWrap">

                                           <?php 

                                           foreach($products['data_single'] as $index => $value){

                                             if($value['sales_status'] ==='available') {

                                                if (!empty($value['special'])) {

                                                    $now = strtotime(date('Y-m-d'));

                                                    $date_end = strtotime($value['date_end']);

                                                    if ($date_end >= $now) {

                                                        $price = $value['special'];

                                                    } else {

                                                        $price = $value['price'];

                                                    }
                                                } else {
                                                        $price = $value['price'];
                                                }

                                         ?>

                                         
                                         <li class="items">

                                            <div class="infoWrap"> 
                                                <div class="cartSection">
                                                    <div class="cartDesc">
                                                        <img src="<?php echo base_url('upload').'/'.$value['image'];?>" alt="<?php echo $value['name'];?>" class="itemImg" />
                                                    </div>
                                                    <div class="cartDesc mainCartDesc">
                                                        <h3><?php echo $value['name'];?></h3>
                                                        <p>Category : </p>
                                                        <p><?php echo $value['category_name'];?></p>
                                                        <div class="cartOpt">
                                                            <?php

                                                            echo '<div class="optItems">';
                                                            echo '<p>Price : <strong>$'.number_format($price, 2, '.', '').'</strong></p>';
                                                            echo '</div>';

                                                            if(!empty($cart[$index]['option'])){?>

                                                                <div class="optItems">
                                        
                                                                    <p>Option : <?php echo implode('|',$cart[$index]['option'])?> = <strong>$<?php echo number_format($cart[$index]['option_cost'],2, '.','')?></strong></p>
                                                                </div>
                                        
                                        
                                                            <?php }
                                                
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <?php 
                                                $subtotal = 0;

                                                if(!empty($cart[$index]['option_cost'])){
            
                                                    $subtotal = $price + (float)$cart[$index]['option_cost'];
                                        
                                                } else {

                                                    $subtotal = $price;

                                                }

                                                echo '<div class="wrapper-cart-price">';
                                                echo '<div class="prodTotal cartSection process subtotalpriceitems">';
                                                echo '<p>$'.number_format($subtotal, 2, '.', '').'</p>';
                                                echo '</div>';
                                                echo '</div>';
                                                $total+=$subtotal;

                                                ?> 
                                            </div>
                                        </li>
                                        <?php } ?>
                                        <?php } 
                                        //STOP LOOP
                                        echo '<li class="items shipping-items">';
                                        if(!empty($shipping_sess)){
                                            $total = $total + $shipping_sess[0]['shipping_price'];

                                            echo '<div class="infoWrap">'; 
                                            echo '<div class="cartSection">';
                                            echo '<div class="cartDesc shipDesc">';
                                            echo '<p><strong>Shipping payment to : '.$shipping_sess[0]['name'].'</strong></p>';
                                            echo '</div>';

                                            echo '<div class="wrapper-cart-price process">';
                                            echo '<div class="prodTotal cartSection process">';
                                            echo '<p>$'.number_format($shipping_sess[0]['shipping_price'], 2, '.', '').'</p>';
                                            echo '</div>';
                                            echo '</div>';

                                            echo '</div>';

                                            echo '</div>';

                                        }
                                        echo '</li>';

                                        ?>

                                </ul>
                            </div>

                            <div class="subtotal cf">
                                <ul>
                                  <li class="totalRow final amounttotal"><span class="label">Total</span><span class="value">$<?php echo number_format($total, 2, '.', '');?></span></li>
                              </ul>
                          </div>

                          <div class="buttons process-privacy">
                            <div class="pull-right">
                                <p>I have read and agree to the</p><p><a class="agree" data-toggle="modal" data-target="#myModal"><b>Privacy Policy</b></a><input type="checkbox" value="1" name="agree"></p>
                                <input type="submit" name="submit" class="btn btn-primary" id="button-confirm" value="Confirm Order">
                            </div>
                        </div>

                    </div>

                    <!-- <?php if(!empty($products['data_single'])){

                        $total_single   = 0;
                        $total_opton    = 0;
                        $total          = 0;
                        $count_subtotal = 0;
                        $subtotal       = 0;
                        $subtotal_option = 0;

                        echo '<div class="table-responsive">';
                        echo '<table class="table table-bordered table-shopping-cart">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<td>Item Description</td>';
                        echo '<td>Payment</td>';
                        echo '<td>Subtotal</td>';
                        echo '</tr>';
                        echo '</thead>';

                        echo '<tbody>';

                        foreach($products['data_single'] as $index => $value){

                            if (!empty($value['special'])) {
                                $now = strtotime(date('Y-m-d'));
                                $date_end = strtotime($value['date_end']);
                                if ($date_end >= $now) {
                                    $price = $value['special'];
                                } else {
                                    $price = $value['price'];
                                }
                            } else {

                               $price = $value['price'];

                           }

                           echo '<tr>';

                           echo '<td class="item description">';

                           echo '<div class="itemlist image">';
                           echo '<a href="'.base_url('product/'.$value['slug']).'" target="_blank" class="shopimage" href="#" title="'.$value['name'].'">';
                           echo '<img src="'.base_url('upload').'/'.$value['image'].'" alt="'.$value['name'].'">';
                           echo '</a>';
                           echo '</div>';

                           echo '<div class="itemlist info">';
                           echo '<a href="'.base_url('product/'.$value['slug']).'" target="_blank"><h4 class="textshoppingcart"><strong>'.$value['name'].'</strong></h4></a>';
                           echo '<p class="textshoppingcart" style="margin-top: 15px;"><strong>CATEGORY</strong></p>';
                           echo '<p class="textshoppingcart">'.$value['category_name'].'</p>';

                           echo '</div>';

                           echo '</td>';

                           echo '<td class="item price">';

                           echo '<table class="listprice">';
                           echo '<tr>';
                           echo '<td class="left">';
                           echo '<p class="textshoppingcart">Unit Price</p>';
                           echo '</td>';

                           echo '<td class="right">';
                           echo '<p class="textshoppingcart"><strong>$'.number_format($price, 2, '.', '').'</strong></p>';
                           echo '</td>';
                           echo '</tr>';

                           if(!empty($products['data_option'])){
                            foreach($products['data_option'] as $key => $row){
                                echo '<tr>';
                                echo '<td class="left">';
                                if($value['product_id'] == $row['product_id']){
                                    echo '<p class="textshoppingcart">'.ucfirst($row['option_name']).' : '.$row['option_detil_name'].'</p>';
                                }
                                echo '</td>';

                                echo '<td class="right">';
                                if($value['product_id'] == $row['product_id']){
                                    echo '<p class="textshoppingcart"><strong>$'.number_format($row['price_option_value'], 2, '.', '').'</strong></p>';
                                }
                                echo '</td>';
                                echo '</tr>';
                            }
                        }

                        echo '</table>'; 

                        echo '</td>';

                        echo '<td class="item subtotal">';

                        if(!empty($products['data_option'])){
                            foreach($products['data_option'] as $key => $row){
                                if($value['product_id'] == $row['product_id']){
                                    $total_option+=$row['price_option_value'];    
                                } else {
                                    $total_option = 0;
                                }
                            }

                            $subtotal = $price + $total_option;

                        } else {

                            $subtotal = $price;

                        }

                        echo '<p class="textshoppingcart"><strong>$'.number_format($subtotal, 2, '.', '').'</strong></p>';

                        echo '</td>';

                        echo '</tr>';

                        $total+=$subtotal;

                    }

                    if(!empty($shipping_sess)){

                        $total = $total + $shipping_sess[0]['shipping_price'];

                        echo '<tr class="total shippingtotal">';
                        echo '<td colspan="2" class="item totalprice"><strong>Shipping payment to : '.$shipping_sess[0]['name'].'</strong></td>';
                        echo '<td class="item totalprice shippingamount"><strong>$'.number_format($shipping_sess[0]['shipping_price'], 2, '.', '').'</strong></td>';
                        echo '</tr>';
                    }

                    echo '<tr class="total">';
                    echo '<td colspan="2" class="item totalprice"><strong>Total:</strong></td>';
                    echo '<td class="item totalprice amounttotal"><strong>$'.number_format($total, 2, '.', '').'</strong></td>';
                    echo '</tr>';

                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>'; ?>

                    <div class="buttons">
                        <div class="pull-right">
                            I have read and agree to the <a class="agree" data-toggle="modal" data-target="#myModal"><b>Privacy Policy</b></a>                       
                            <input type="checkbox" value="1" name="agree">
                            &nbsp;
                            <input type="submit" name="submit" class="btn btn-primary" id="button-confirm" value="Confirm Order">
                        </div>
                    </div>
                    <?php } ?> -->
                </div>
            </div>
        </div>
        <!-- Confirm Order End -->
    </form>
</div>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Term & Conditions</h4>
            </div>
            <div class="modal-body">
                <?php echo $term_condition[0]['description'] ?>

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(function(){

        var totalprice                  = $('.amounttotal');
        var subtotalpriceitems          = $('.subtotalpriceitems');
        var storetotalprice             = $(totalprice).find('strong').text().toString();
        var amountprice                 = $(totalprice).find('.value').text().toString();
        amountprice                     = amountprice.replace('$','');

        $('#input-payment-shipping').on('change',function(){

            /* TAKE VALUE */
            var sum_price           = 0; //without shipping
            var sum                 = 0;
            var name                = $(this).find('option:selected').data('name');
            var price               = $(this).find('option:selected').data('price');

            $(subtotalpriceitems).each(function(){
                var to_string = $(this).text().toString();
                var value_subtotal = to_string.replace('$','');
                sum_price+=parseFloat(value_subtotal);
            });

            if(price === undefined){
                sum                 = parseFloat(sum_price);  
            } else {
                price               = price.toString();
                if(!isNaN(sum_price)){
                    sum                 = parseFloat(sum_price) + parseFloat(price);
                }
            }
            /* ELEMENT */
            var elementappend = '<div class="infoWrap">' 
            + '<div class="cartSection">'
            + '<div class="cartDesc">'
            + '<p><strong>Shipping payment to : ' + name + '</strong></p>'
            + '</div>'
            + '</div>'

            + '<div class="prodTotal cartSection process">'
            + '<p>$' + parseFloat(price).toFixed(2) + '</p>'
            + '</div>'
            + '</div>';

            var shipelement         = $(document).find('.shipping-items');

            if( $(shipelement).is(':empty') ) {

                if(price === undefined){

                } else {

                    $(shipelement).prepend(elementappend);
                    setTimeout(function(){
                        $(document).find(totalprice).slideDown();
                    },10);

                }

            } else {

                $(shipelement).empty();

                if(price === undefined){

                } else {

                    $(shipelement).prepend(elementappend);
                    setTimeout(function(){
                        $(document).find(totalprice).slideDown();
                    },10);

                }

            }

            $(totalprice).find('.value').text('$'+sum.toFixed(2));

        });

        $('select[name=\'country_id\']').on('change', function() {
            $.ajax({
                url: '<?php echo base_url('account/register/country') . '/'; ?>' + this.value,
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

                        if (json[i]['zone_id'] == '<?php echo $zone_id; ?>') {
                            html += ' selected="selected"';
                        }

                        html += '>' + json[i]['name'] + '</option>';
                    }

                    $('select[name=\'zone_id\']').html(html);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });

        $('select[name=\'country_id\']').trigger('change');

        $('#bank-textarea').slideDown();
        $('input[name=\'payment_method\']').on('change', function() {
            if($(this).val() == 'Bank Transfer') {
                $('#bank-textarea').slideDown();
            } else {
                $('#bank-textarea').slideUp();
            }
        });

        $('select[name=\'payment_method\']').trigger('change');

    });
</script>
