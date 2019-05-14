<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 no-padding-xs">
    <div class="product-desc-wrap">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 article-title"><?php echo $content[0]['name'] ?></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-text">
                <?php echo $content[0]['description'] ?>
            </div>
        </div>
    </div>
    
    <?php if($products) { ?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <ul id="menu-sort">
                <li class="<?php echo ($active == 'featured') ? 'active' : ''; ?>"><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/featured') ?>">FEATURED</a></li>
                <li class="<?php echo ($active == 'newest') ? 'active' : ''; ?>"><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/newest') ?>">NEWEST</a></li>
                <li class="<?php echo ($active == 'top-rated') ? 'active' : ''; ?>"><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/top-rated') ?>">TOP RATED</a></li>
                <li class="<?php echo ($active == 'price-high-to-low') ? 'active' : ''; ?>"><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/price-high-to-low') ?>">PRICE: HIGH TO LOW</a></li>
                <li class="<?php echo ($active == 'price-low-to-high') ? 'active' : ''; ?>"><a href="<?php echo base_url($this->uri->segment(1).'/'.$this->uri->segment(2).'/price-low-to-high') ?>">PRICE: LOW TO HIGH</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="showing">
                Showing <?php echo $first_result ?>-<?php echo $last_result ?> of <?php echo $total_result ?>
            </div>
            <div class="showing">
                Page <?php echo $current_page ?> of <?php echo $total_page ?> <a href="<?php echo $next_page ?>">Next Page »</a>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="product-wrap">
        <div class="row">
            <?php if($products) { ?>
            
            <?php $i = 0;
            foreach ($products as $product) {
                if ($product['special']) {
                    $now = strtotime(date('Y-m-d'));
                    $date_end = strtotime($product['date_end']);
                    if($date_end >= $now ) {
                        $flag_special = $product['special'];
                    } else {
                        $flag_special = FALSE;
                    } 
                } else {
                    $flag_special = FALSE;
                }
                ?>
                <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 list-product-wrap">
                    <div class="product-item-wrap">
                        <div class="product-image" style="background-image: url(<?php echo base_url('upload/' . $product['image']); ?>);"></div>
                        <div class="product-title text-center"><a href="<?php echo base_url('shop/'.$this->uri->segment(2).'/'.$product['slug']); ?>"><?php echo word_limiter(strip_tags($product['name']), 3) ?></a></div>
                        <div class="item-desc text-center"><?php echo word_limiter(strip_tags($product['description']), 8); ?></div>
                        <div class="item-price text-center"><?php echo ($flag_special) ? 'has-special' : ''; ?> $<?php echo number_format($product['price'], 2, '.', '') ?></div>
                        <?php if ($flag_special) { ?>
                        <div class="item-disc text-center">
                                <span>$<?php echo number_format($product['special'], 2, '.', '') ?></span> save <?php
                                $save = ($product['price'] - $product['special']) / $product['price'] * 100;
                                echo number_format($save, 0, '.', '');
                                ?>%
                        </div>
                        <div id="popup-product-<?php echo $i ?>" class="offer text-center"><a href="#popup<?php echo $i ?>">Special Offer!</a></div>
                        <?php } ?>
                    </div>
                </div>
                <?php $i++;
            }
            ?>
            
            <?php } else { ?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <h2>There is no product in here!</h2>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php $i = 0;
if($products) {
foreach ($products as $product) {
    if ($product['special']) {
        $now = strtotime(date('Y-m-d'));
        $date_end = strtotime($product['date_end']);
        if($date_end >= $now ) {
            $flag_special = $product['special'];
        } else {
            $flag_special = FALSE;
        } 
    } else {
        $flag_special = FALSE;
    }
    ?>
<div id="popop-overlay-<?php echo $i ?>" class="overlay">
                        <div id="popup<?php echo $i ?>" class="popup-wrap">
                            <div class="pull-right"><div class="close-popup">Close</div></div>
                            <div class="clearfix"></div>
                            <div class="popup-inner-wrap">
                                <div class="popup-stock">Item: <?php echo $product['item_id'] ?> - <?php echo ($product['quantity'] <= 0) ? $product['stock'] : 'In Stock'; ?></div>
                                <div class="popup-title"><?php echo word_limiter(strip_tags($product['name']), 4); ?></div>
                                <div class="popup-desc"><?php echo character_limiter(strip_tags($product['description']), 35); ?></div>
                                <div class="popup-price"><span class="<?php echo ($flag_special) ? 'has-special' : ''; ?>">$<?php echo number_format($product['price'], 2, '.', '') ?></span>
                                    <?php if ($flag_special) { ?>
                                        <span>$<?php echo number_format($product['special'], 2, '.', '') ?></span> save <?php
                                        $save = ($product['price'] - $product['special']) / $product['price'] * 100;
                                        echo number_format($save, 0, '.', '');
                                        ?>%
                                <?php } ?>
                                </div>
                                <div class="popup-img-wrap">
                                    <div class="popup-img" style="background-image: url(<?php echo base_url('upload/' . $product['image']) ?>);"></div>
                                </div>
                                <div class="popup-button text-center">
                                    <div class="popup-cart"><a onclick="cart.add('<?php echo $product['product_id'] ?>');">Add to cart</a></div>
                                    <div class="popup-quick"><a onclick="cart.quick('<?php echo $product['product_id'] ?>');">Quick Buy</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $("#popup-product-<?php echo $i ?> a").click(function() {
                            $("#popop-overlay-<?php echo $i ?>").css("visibility", "visible");
                        });

                        $(".close-popup").click(function() {
                            $(".overlay").css("visibility", "hidden");
                        });
                    </script>
    <?php $i++;
}
}
?>