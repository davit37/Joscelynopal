<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div><img src="<?php echo base_url('assets/images/icon/loading.gif') ?>" ></div>
            <div style="padding: 0 65px;">Processing...</div>

            <!-- Paypal Form -->
            <form name="paypalForm" id="paypalForm" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
            <!-- <form> -->
                <input type="hidden" name="cmd" value="_cart" >
                <input type="hidden" name="upload" value="1" >
                <input type="hidden" name="business" value="<?php echo $business_email[0]['value'] ?>" >

                <?php if (!empty($products['data_single'])) { ?>

                    <?php
                    $i = 0;
                    $total = 0;
                    $total_price = 0;
                    $total_option = 0;
                    $product_id_qty = '';
                    $subtotal = 0;

                    echo '<input type="hidden" name="shipping_1" value="'.number_format($shipping, 2, '.', '').'">';

                    foreach ($products['data_single'] as $key => $value) {

                        //foreach ($value as $col) {
                            ?>

                            <input type="hidden" name="item_name_<?php echo $i + 1; ?>" value="<?php echo $value['name'] ?> : $<?php echo number_format($value['special'] ?  $value['special']:$value['price'], 2, '.', '')?> USD" >
                            <input type="hidden" name="quantity_<?php echo $i + 1; ?>" value="<?php echo $quantity[$i] ?>" >
                                
                            
                        <?php
                            
                            // Custom Variable for Paypal
                            if($this->session->userdata('value_order_id')){
                            $product_id_qty .= $value['product_id'].'-'.$value['customer'].'-'.$this->session->userdata('value_order_id').',';
                            } else {
                            $product_id_qty .= $value['product_id'].'-'.$value['customer'].',';
                            }

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

                            $subtotal = 0;
                            $total_option = 0;
                            if(!empty($cart[$key]['option'])){

                                

                        ?>
                            <input type="hidden" name="on0_<?php echo $i + 1; ?>" value="option(<?php echo implode(' | ',$cart[$key]['option'])?>)">
                            <input type="hidden" name="os0_<?php echo $i + 1; ?>" value="$<?php echo number_format($cart[$key]['option_cost'], 2, '.', '') ?> USD">

                        <?php                            
                                $subtotal = $price + (float)$cart[$key]['option_cost'];
                            } else {

                                $subtotal = $price;

                            }
                        ?>

                            <input type="hidden" name="amount_<?php echo $i + 1; ?>" value="<?php echo number_format($subtotal, 2, '.', ''); ?>" >

                            <?php
                        //}
                        echo "</tr>";
                        $i++;
                    }
                    ?>

                <?php /*echo '<input type="image"
src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif"
border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">';*/ } ?>
                            
                <input type="hidden" name="custom" value="<?php echo $product_id_qty ?>" >
                <!-- <input type="hidden" name="notify_url" value="<?php echo $notify_url[0]['value'] ?>" > -->
                <input type="hidden" name="notify_url" value="<?php echo base_url('checkout/paypal/notify');?>" >
                <input type="hidden" name="return" value="<?php echo base_url('checkout/success');?>" >
                <input type="hidden" name="rm" value="2" >
                <input type="hidden" name="cbt" value="Return to The Store" >
                <input type="hidden" name="cancel_return" value="<?php echo base_url('checkout/cart');?>" >
                <input type="hidden" name="lc" value="US" >
                <input type="hidden" name="currency_code" value="<?php echo $currency_code[0]['value'] ?>" >
                <input type="hidden" name="cpp_logo_image" value="<?php echo $checkout_logo[0]['value'] ?>" >
            </form>
        </div>
    </div>
</div>

<script type="text/javascript"><!--

   $("#paypalForm").submit();

    //--></script>