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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Add Order</h3>
            </div>
            <div class="panel-body">
                <form id="checkout" class="form-horizontal" method="post" action="<?php echo base_url('admin/sale/order/save') ?>">
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
                                    <input type="text" class="form-control" id="input-customer" placeholder="Customer" value="" name="customer">
                                    <input type="hidden" value="0" name="customer_id">
                                </div>
                            </div>

                            <div class="form-group required <?php echo ($this->session->userdata('error_firstname')) ? 'has-error' : ''; ?>">
                                <label for="input-firstname" class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-firstname" value="" name="firstname">
                                    <?php if ($this->session->userdata('error_firstname')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_firstname') ?></div>
                                                <?php $this->session->unset_userdata('error_firstname') ?>
                                            <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_lastname')) ? 'has-error' : ''; ?>">
                                <label for="input-lastname" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-lastname" value="" name="lastname">
                                    <?php if ($this->session->userdata('error_lastname')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_lastname') ?></div>
                                                <?php $this->session->unset_userdata('error_lastname') ?>
                                            <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_email')) ? 'has-error' : ''; ?>">
                                <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-email" value="" name="email">
                                    <?php if ($this->session->userdata('error_email')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_email') ?></div>
                                                <?php $this->session->unset_userdata('error_email') ?>
                                            <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_telephone')) ? 'has-error' : ''; ?>">
                                <label for="input-telephone" class="col-sm-2 control-label">Telephone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-telephone" value="" name="telephone">
                                    <?php if ($this->session->userdata('error_telephone')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_telephone') ?></div>
                                                <?php $this->session->unset_userdata('error_telephone') ?>
                                            <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-fax" class="col-sm-2 control-label">Fax</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-fax" value="" name="fax">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="input-payment-company">Company</label>
                                <div class="col-sm-10">
                                    <input type="text" name="company" value="" id="input-payment-company" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_address_1')) ? 'has-error' : ''; ?>">
                                <label class="control-label col-sm-2" for="input-payment-address-1">Address 1</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address_1" value="" id="input-payment-address-1" class="form-control">
                                    <?php if ($this->session->userdata('error_address_1')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_address_1') ?></div>
                                                <?php $this->session->unset_userdata('error_address_1') ?>
                                            <?php } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="input-payment-address-2">Address 2</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address_2" value="" id="input-payment-address-2" class="form-control">
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_city')) ? 'has-error' : ''; ?>">
                                <label class="control-label col-sm-2" for="input-payment-city">City</label>
                                <div class="col-sm-10">
                                    <input type="text" name="city" value="" id="input-payment-city" class="form-control">
                                    <?php if ($this->session->userdata('error_city')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_city') ?></div>
                                                <?php $this->session->unset_userdata('error_city') ?>
                                            <?php } ?>
                                </div>
                            </div>
                            <div class="form-group required <?php echo ($this->session->userdata('error_postcode')) ? 'has-error' : ''; ?>">
                                <label class="control-label col-sm-2" for="input-payment-postcode">Post Code</label>
                                <div class="col-sm-10">
                                    <input type="text" name="postcode" value="" id="input-payment-postcode" class="form-control">
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
                                            <option value="<?php echo $country['country_id'] ?>"><?php echo $country['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="value_country_id" value="" />
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
                                    <input type="hidden" name="value_zone_id" value="" />
                                    <?php if ($this->session->userdata('error_zone_id')) { ?>
                                                <div class="text-danger"><?php echo $this->session->userdata('error_zone_id') ?></div>
                                                <?php $this->session->unset_userdata('error_zone_id') ?>
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
                                            <td class="text-right">Quantity</td>
                                            <td class="text-right">Unit Price</td>
                                            <td class="text-right">Total</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody id="cart"></tbody>
                                </table>
                            </div>
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active"><a data-toggle="tab" href="#tab-product" aria-expanded="false">Products</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-product" class="tab-pane active">
                                    <fieldset>
                                        <legend>Add Product(s)</legend>
                                        <div class="form-group">
                                            <label for="input-product" class="col-sm-2 control-label">Choose Product</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-product" value="" name="product">
                                                <input type="hidden" value="" name="product_id">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="input-quantity" class="col-sm-2 control-label">Quantity</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="input-quantity" value="1" name="quantity">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="text-right">
                                        <button class="btn btn-primary" data-loading-text="Loading..." id="button-product-add" type="button"><i class="fa fa-plus-circle"></i> Add Product</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="tab-payment" class="tab-pane">
                            <p>Please select the preferred payment method to use on this order.</p>
                            <?php if($bank[0]['status'] == 1) { ?>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="payment_method" value="Bank Transfer" checked="checked">
                                    Bank Transfer</label>
                            </div>
                            <?php } ?>
                            
                            <?php if($paypal[0]['status'] == 1) { ?>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="payment_method" value="Paypal">
                                    Paypal</label>
                            </div>
                            <?php } ?>
                            <br/>
                            <p><strong>Add Comments About Your Order</strong></p>
                            <p>
                                <textarea name="payment_comment" rows="8" class="form-control"></textarea>
                            </p>
                        
                        </div>
                        <div id="tab-shipping" class="tab-pane">
                            <p>Please select the preferred shipping method to use on this order.</p>
                            <?php 
                            if($shipping) {
                                $j = 0;
                                foreach ($shipping as $ship) {   
                            ?>
                            <?php if($j == 0) { ?>
                            <div class="radio">
                                <label><input type="radio" checked="checked" value="<?php echo $ship['title'] ?>" name="shipping_method"> <?php echo $ship['title'] ?></label>
                            </div>
                            <?php } else { ?>
                            <div class="radio">
                                <label><input type="radio" <?php echo ($this->session->userdata('value_shipping_method') == $ship['title']) ? 'checked="checked"':''; ?> value="<?php echo $ship['title'] ?>" name="shipping_method"> <?php echo $ship['title'] ?></label>
                            </div>
                            <?php } ?>
                            <?php     
                                $j++;
                                }    
                            } 
                            ?>
                            <br/>
                            <p><strong>Add Comments About Your Order</strong></p>
                            <p>
                                <textarea name="shipping_comment" rows="8" class="form-control"></textarea>
                            </p>
                        
                        </div>
                        <div id="tab-total" class="tab-pane">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <td class="text-left">Product</td>
                                            <td class="text-left">Model</td>
                                            <td class="text-right">Quantity</td>
                                            <td class="text-right">Unit Price</td>
                                            <td class="text-right">Total</td>
                                        </tr>
                                    </thead>
                                    <tbody id="total"></tbody>
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

        // Customer
        $('input[name=\'customer\']').autocomplete({
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
                    }

                    $('select[name=\'zone_id\']').html(html);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });

        $('select[name=\'country_id\']').trigger('change');

        $('#tab-product input[name=\'product\']').autocomplete({
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
        });

$('#button-product-add').on('click', function() {
        var product_id = $('#tab-product input[name=\'product_id\']').val();
        var quantity = $('#tab-product input[name=\'quantity\']').val();
	$.ajax({
		url: '<?php echo base_url('admin/sale/order/product_add').'/' ?>' + product_id + '/' + quantity,
		dataType: 'json',
		beforeSend: function() {
			$('#button-product-add').button('loading');
		},
		complete: function() {
			$('#button-product-add').button('reset');
		},
		success: function(json) {
			html = '';
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
                        html2 += '<input type="hidden" name="total" value="'+ (total * 1).toFixed(2) +'">';
                        
                        $('#cart').html(html);
                        $('#total').html(html2);
                        
                        
                        
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});				
});

$('#tab-cart').delegate('.btn-danger', 'click', function() {
        var node = this;
	var product_id = $(this).val();
	$.ajax({
		url: '<?php echo base_url('admin/sale/order/product_remove').'/' ?>' + product_id,
		dataType: 'json',
		beforeSend: function() {
			$(node).button('loading');
		},
		complete: function() {
			$(node).button('reset');
                        $('.tooltip').remove();
		},
		success: function(json) {
			html = '';
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
                        html2 += '<input type="hidden" name="total" value="'+ (total * 1).toFixed(2) +'">';
                        
                        $('#cart').html(html);
                        $('#total').html(html2);
                        
                        
                        
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