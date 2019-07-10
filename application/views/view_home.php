
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 no-padding-xs">
    <div class="row">
        <div id="home-slider" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tp-banner-container">
                <div class="tp-banner" >
                    <ul>
                        <?php foreach ($slideshow as $row) { ?>
                        <li data-transition="random" data-slotamount="7" data-masterspeed="1500" data-link="<?php echo $row['link'] ?>" >
                            <!-- MAIN IMAGE -->
                            <img src="<?php echo base_url('upload/'.$row['image']); ?>"  alt="<?php echo $row['title'] ?>"  data-bgfit="contain" data-bgposition="center center" data-bgrepeat="no-repeat">
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="rule" style="margin-top: 40px"></div>
        </div>
    </div>

    <div class="row">
        <div class="featured-wrap">
            <div class="featured-title">FEATURED ITEMS</div>
            <div class="row">
                <?php
                if ($products) {
                    foreach ($products as $product) {
                        ?>
                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3 list-product-home">
                            <div class="item-img-wrap">
                                <div class="item-img" style="background-image: url(<?php echo base_url('upload/' . $product['image']); ?>);"></div>
                               

                                <div class="item-cart"><a onclick="cart.add('<?php echo $product['product_id'] ?>');">Add to cart</a></div>
                    
                                
                                <div class="item-title text-center"><a href="<?php echo base_url('product/'.$product['slug']) ?>"><?php echo character_limiter($product['name'], 22) ?></a></div>
                        </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('.tp-banner').revolution(
                {
                    delay: 9000,
                    startwidth: 1188,
                    startheight: 460,
                    hideThumbs: 10
                });
    });
</script>