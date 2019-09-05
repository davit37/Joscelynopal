<div class="container">
    <div id="footer">
        <?php if(isset($bottom) && !empty($bottom)){
        foreach($bottom as $index => $value){

        echo '<a href="'.base_url($value['slug']).'">'.$value['label_menu'].'</a>';

        } }?>
        <a href="https://www.paypal.com"><img src="<?php echo base_url('assets/images/icon/PP_Acceptance_Marks_for_LogoCenter_76x48.png'); ?>"/></a>
    </div>
    <div id="mobile-footer">
        <?php if(isset($bottom) && !empty($bottom)){
        foreach($bottom as $index => $value){

        echo '<a href="'.base_url($value['slug']).'">'.$value['label_menu'].'</a>';

        } }?>
        <a href="https://www.paypal.com"><img src="<?php echo base_url('assets/images/icon/PP_Acceptance_Marks_for_LogoCenter_76x48.png'); ?>"/></a>
    </div>
</div>

<script type="text/javascript">
    $('.product-detail-column').matchHeight();
    $('.list-recommended-product').matchHeight();
    $('.product-item-wrap').matchHeight();
    $('.text-group-desc-product').matchHeight();
    $('.cartDesc').matchHeight();
    $('.cartWrap').find('.items').matchHeight({
        'byRow' : false
    });
    // Cart add remove functions
    var cart = {
        'add': function(product_id, quantity) {
            $.ajax({
                url: '<?php echo base_url('checkout/cart/add') ?>/' + product_id + '/' + (typeof (quantity) != 'undefined' ? quantity : 1),
                dataType: 'json',
                success: function(json) {
                    $('#message').empty();
                    $('#menu-cart').empty();
                    $(".overlay").css("visibility", "hidden");
                    $('#message').append('<div class="alert alert-success"><i class="fa fa-check-circle"></i> Your selected product added to cart<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    $('#menu-cart').append('<i class="fa fa-shopping-cart"></i> Cart (' + json.length + ')</a>');
                    $('html, body').animate({scrollTop: 0}, 'slow');
                }
            }).fail(function(res){

                    $('#message').empty();
                    $(".overlay").css("visibility", "hidden");
                    $('#message').append('<div class="alert alert-warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> You have already added this product to your cart<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    $('html, body').animate({scrollTop: 0}, 'slow');

                });
        },
        'remove': function(key) {
            $.ajax({
                url: '<?php echo base_url('checkout/cart/remove') ?>/' + key,
                dataType: 'json',
                success: function(json) {
                    window.location.replace(json['redirect']);
                }
            });
        },
        'quick': function(product_id, quantity) {
            $.ajax({
                url: '<?php echo base_url('checkout/cart/add') ?>/' + product_id + '/' + (typeof (quantity) != 'undefined' ? quantity : 1),
                dataType: 'json',
                success: function(json) {
                    window.location.replace("<?php echo base_url('checkout/process') ?>");
                }
            });
        }
    }
</script>