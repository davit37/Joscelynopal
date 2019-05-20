<script src="<?php echo base_url("assets/js/jquery.cycle2.min.js") ?>"></script>
<script src="<?php echo base_url("assets/js/jquery.cycle2.carousel.js") ?>"></script>

<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 no-padding-xs">
    <div class="product-detail-wrap">
        <div class="row">
            <?php if(!empty($product)){ ?>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 product-detail-column">
                <!-- <div class="scroll"> -->
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-7 col-img-wrap">
                        <div id="slideshow-1">
                            <div id="cycle-1" class="cycle-slideshow"
                            data-cycle-slides="> div"
                            data-cycle-timeout="0"
                            data-cycle-prev="#slideshow-1 .cycle-prev"
                            data-cycle-next="#slideshow-1 .cycle-next"
                            data-cycle-fx="fade"
                            >
                            <?php
                            if ($product[0]['image']) {
                               $first_image = 'upload/' . $product[0]['image'];
                           } else {
                               $first_image = 'assets/images/icon/no_image.png';
                           }
                           ?>

                           <div><img src="<?php echo base_url($first_image) ?>" width="500" height="500"></div>
                           <?php
                           if ($product_image) {
                            foreach ($product_image as $row_image) {
                                ?>
                                <div><img src="<?php echo base_url("upload/" . $row_image['image']) ?>" width="500" height="500"></div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <?php if (count($product_image) > 1) { ?>
                <div id="slideshow-2">
                    <div id="cycle-2" class="cycle-slideshow"
                    data-cycle-slides="> div"
                    data-cycle-timeout="0"
                    data-cycle-prev="#slideshow-2 .cycle-prev"
                    data-cycle-next="#slideshow-2 .cycle-next"
                    data-cycle-fx="carousel"
                    data-cycle-carousel-visible="3"
                    data-cycle-carousel-fluid=true
                    data-allow-wrap="false"
                    >
                    <div><img src="<?php echo base_url("thumb/" . $product[0]['image']) ?>" width="100" height="100"></div>
                    <?php foreach ($product_image as $row_image) { ?>
                    <div><img src="<?php echo base_url("thumb/" . $row_image['image']) ?>" width="100" height="100"></div>
                    <?php } ?>
                </div>

                <div class="cycle-prev"></div>
                <div class="cycle-next"></div>
            </div>
            <?php } ?>

            <script>
                jQuery(document).ready(function($) {

                    var slideshows = $('.cycle-slideshow').on('cycle-next cycle-prev', function(e, opts) {
                                // advance the other slideshow
                                slideshows.not(this).cycle('goto', opts.currSlide);
                            });

                    $('#cycle-2 .cycle-slide').click(function() {
                        var index = $('#cycle-2').data('cycle.API').getSlideIndex(this);
                        slideshows.cycle('goto', index);
                    });

                });
            </script>

            <?php if ($product_video) { ?>
            <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="100%" height="259px" data-setup="{}">
                <?php foreach ($product_video as $row_video) { ?>
                <source src="<?php echo base_url("upload/" . $row_video['video']) ?>" type='video/<?php echo ($row_video['type'] == 'ogv') ? 'ogg' : $row_video['type']; ?>' />
                    <?php } ?>
                    <p class="vjs-no-js">To view this video please enable JavaScript</p>
                </video>
                <?php } ?>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5 col-detail-wrap">
                <div class="text-group">
                    <div class="text1 text-group-desc-product">Type</div>
                    <div class="text2 text-group-desc-product text-group-desc-product">: <?php echo $product[0]['type'] ?></div>
                </div>
                <div class="text-group">
                    <div class="text1 text-group-desc-product">Item ID</div>
                    <div class="text2 text-group-desc-product text-group-desc-product">: <?php echo $product[0]['item_id'] ?></div>
                </div>
                <div class="text-group">
                    <div class="text1 text-group-desc-product">Content</div>
                    <div class="text2 text-group-desc-product text-group-desc-product">: <?php echo $product[0]['content'] ?> GEM</div>
                </div>
                <div class="text-group">
                    <div class="text1 text-group-desc-product">Weight</div>
                    <div class="text2 text-group-desc-product text-group-desc-product">: <?php echo number_format($product[0]['weight'], 2, '.', '') ?> ct</div>
                </div>
                <div class="text-group">
                    <div class="text1 text-group-desc-product">Size</div>
                    <div class="text2 text-group-desc-product text-group-desc-product">: <?php echo $product[0]['size'] ?></div>
                </div>
                <div class="text-group">
                    <div class="text1 text-group-desc-product">Shape</div>
                    <div class="text2 text-group-desc-product text-group-desc-product">: <?php echo $product[0]['shape'] ?></div>
                </div>
                <div class="text-group">
                    <div class="text1 text-group-desc-product">Clarity</div>
                    <div class="text2 text-group-desc-product text-group-desc-product">: <?php echo $product[0]['clarity'] ?></div>
                </div>
                <div class="text-group">
                    <div class="text1 text-group-desc-product">Treatment</div>
                    <div class="text2 text-group-desc-product text-group-desc-product">: <?php echo $product[0]['treatment'] ?></div>
                </div>
                <div class="text-group">
                    <div class="text1 text-group-desc-product">Origin</div>
                    <div class="text2 text-group-desc-product text-group-desc-product">: <?php echo $product[0]['origin'] ?></div>
                </div>
                <div class="text-group">
                    <div class="text1 text-group-desc-product">Price</div>
                    <div class="text2 text-group-desc-product text-group-desc-product">: <span class="<?php echo ($product_special) ? 'has-special font-black' : ''; ?>">$</span><span id="prices" data-price="<?php echo number_format($product[0]['price'], 2, '.', '') ?>" class="<?php echo ($product_special) ? 'has-special font-black' : ''; ?>" value="<?php echo number_format($product[0]['price'], 2, '.', '') ?>"><?php echo number_format($product[0]['price'], 2, '.', '') ?></span></div>
                </div>
       
            
              
                

                   <?php if($product_option != null){ foreach(json_decode($product_option[0]['json_child'],true) as $child_list){?>
                    <div class="text-group product-option">

                        <div class="text1 text-group-desc-product" style="height: 44px;">
                            <?php echo $child_list['child_name']?> <span class="required">*</span>
                        </div>

                            <div class="text2 text-group-desc-product" style="height: 44px;">

                                <select class="select_option option-available form-control option_list "

                                data-name='<?php echo str_replace(' ','_',strtolower($child_list['child_name'] ))  ?>'
                                
                                data-parent="<?php echo !empty($child_list['option_child_of']) ? str_replace(' ','_',strtolower($child_list['option_child_of'] )) : '' ?>" >

                                    <option data-price="0" value="">- Select -</option>
                            
                                    <?php foreach($child_list['option_value'] as $index => $value){?>
                                    
                                        <option  value="<?php echo $index ?>"> <?php echo $value ?></option>

                                    <?php }?>

                                </select>      
                            </div>
                         
                        </div>

                  <?php }}?>

               
          

                <?php if ($product_special) { ?>
                <div class="text-group">
                    <div class="text1 text-group-desc-product"></div>
                    <div class="text2 text-group-desc-product special-price-wrapper">&nbsp;&nbsp;<span>$</span><span id="special_price" data-price="<?php echo number_format($product_special[0]['price'], 2, '.', '') ?>" value="<?php echo number_format($product_special[0]['price'], 2, '.', '') ?>"><?php echo number_format($product_special[0]['price'], 2, '.', '') ?></span></div>
                </div>
                <?php } ?>
                    <!-- <div class="text-group" style="margin-top: 36px;">
                        <div class="text1">Quantity</div>
                        <div class="text2 text-group-desc-product">: <input type="text" id="qty" name="qty" value="1" maxlength="2"></div>
                    </div> -->

                    <div class="cart-button cart-button-product-single">
                        <a id="button-cart">Add to cart</a>
                    </div>
                </div>
            <!-- </div> -->

            <div class="product-detail-desc-wrap">
                    <div class="title">Product Description</div>
                    <div class="desc">
                        <?php echo $product[0]['description'] ?>
                    </div>
            </div>

        </div>
        <?php } else { ?>

            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 product-detail-column">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-img-wrap text-center">
                        <p class="text-center">The page you're looking for is not found.</p>
                    </div>

            </div>
        <?php } ?>

        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 product-detail-column col-recommended text-center">
            <div class="recommended-container">
                <div class="title">May We Recommend</div>

                <?php foreach ($random_product as $row) { ?>
                <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12 list-recommended-product">
                    <div class="list-recommended-image-product"><img class="img-responsive" src="<?php echo base_url("upload/" . $row['image']) ?>" alt="" width="150"></div>
                    <div class="desc-wrap">
                        <div class="name"><a href="<?php echo base_url('product/' . $row['slug']) ?>"><?php echo $row['name'] ?></a></div>
                        <div class="desc"><?php echo word_limiter($row['description'], 4); ?></div>
                        <?php if ($row['special']) { ?>
                        <?php
                        $now = strtotime(date('Y-m-d'));
                        $date_end = strtotime($row['special'][0]['date_end']);
                        if ($date_end >= $now) {
                            ?>
                            <div class="price"><span class="has-special">$<?php echo number_format($row['price'], 2, ',', '') ?></span> $<?php echo number_format($row['special'][0]['price'], 2, ',', '') ?></div>
                            <?php } else { ?>
                            <div class="price">$<?php echo number_format($row['price'], 2, ',', '') ?></div>
                            <?php } ?>
                            <?php } else { ?>
                            <div class="price">$<?php echo number_format($row['price'], 2, ',', '') ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>


                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="rule" style="margin-top: 20px"></div>
            </div>
        </div> -->

        <!-- <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <div class="product-detail-desc-wrap">
                    <div class="title">Product Description</div>
                    <div class="desc">
                        <?php echo $product[0]['description'] ?>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="rule"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="review-wrap">
                    <!-- <div class="title" data-toggle="modal" data-target="#modalReview">Review This Product</div> -->
                    <div class="title2">Customer Reviews</div>


                    <?php
                    /*if ($product_review) {
                        foreach ($product_review as $review) {
                            ?>
                            <div class="review-content-wrap">
                                <div>
                                    <?php
                                    for ($i = 0; $i < $review['rating']; $i++) {
                                        echo '<img src="' . base_url("assets/images/icon/rating-active.png") . '">';
                                    }
                                    for ($i = 0; $i < 5 - $review['rating']; $i++) {
                                        echo '<img src="' . base_url("assets/images/icon/rating.png") . '">';
                                    }
                                    ?>
                                </div>
                                <div class="review-title"><?php echo $review['title'] ?></div>
                                <div class="review-body"><?php echo $review['text'] ?></div>
                                <div class="review-date"><?php echo date("F d, Y", strtotime($review['date_added'])) ?></div>
                            </div>
                        <?php
                        }
                    } else {
                        echo '<div class="review-content-wrap"><div class="review-title">No Review</div></div>';
                    }*/

                    if ($review) {
                        foreach ($review as $reviews) {
                            ?>
                            <div class="review-content-wrap">
                                <div class="review-title"><?php echo $reviews['firstname'].' '.$reviews['lastname'];?></div>
                                <div>
                                    <?php
                                    for ($i = 0; $i < $reviews['rating']; $i++) {
                                        echo '<img src="' . base_url("assets/images/icon/rating-active.png") . '">';
                                    }
                                    for ($i = 0; $i < 5 - $reviews['rating']; $i++) {
                                        echo '<img src="' . base_url("assets/images/icon/rating.png") . '">';
                                    }
                                    ?>
                                </div>
                                <div class="review-body"><?php echo $reviews['text'] ?></div>
                                <div class="review-date"><?php echo date("F d, Y", strtotime($reviews['date_added'])) ?></div>
                            </div>
                        <?php
                        }
                    } else {
                        echo '<div class="review-content-wrap"><div class="review-title">No Review</div></div>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="socmed-wrap text-center">
                    <div class="icon-wrap">
                        <a href="<?php echo $fb[0]['value'] ?>"><img src="<?php echo base_url("assets/images/icon/fb.png") ?>"></a>
                        <a href="<?php echo $tw[0]['value'] ?>"><img src="<?php echo base_url("assets/images/icon/tw.png") ?>"></a>
                        <a href="<?php echo $ig[0]['value'] ?>"><img src="<?php echo base_url("assets/images/icon/ig.png") ?>"></a>
                    </div>
                    <div class="subscribe-wrap">
                        <form class="form-inline">
                            <div class="form-group">
                                <label>Sign up for special offers</label>
                                <input id="subscriber" name="subscriber" class="form-control text-center" placeholder="ENTER EMAIL">
                            </div>
                            <button type="button" class="btn btn-default" id="btn-subscribe">Subscribe!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- <div class="modal fade" id="modalReview">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Write Review</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="email" class="control-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Rating:</label>
                        <select class="form-control" id="rating" name="rating">
                            <option value="1">Very Bad</option>
                            <option value="2">Bad</option>
                            <option value="3">Neural</option>
                            <option value="4">Good</option>
                            <option value="5">Very Good</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title" class="control-label">Title:</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Message:</label>
                        <textarea class="form-control" id="message" name="message"></textarea>
                    </div>
                    <input type="hidden" id="product_id" name="product_id" value="<?php echo $product[0]['product_id'] ?>">
                    <input type="hidden" id="customer_id" name="customer_id" value="<?php echo ($this->session->userdata('uid')) ? $this->session->userdata('uid') : 0; ?>">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="send">Send</button>
            </div>
        </div>
    </div>
</div> -->

<script type="text/javascript">

    var element_price;
    var sum;
    var element_option              = $('.option-available');
    var special_price               = $('#special_price');
    var price                       = $('#prices');

    if($(special_price).length == 0){
        sum             = parseFloat($(price).data('price'));
        element_price   = price;
    } else {
        sum             = parseFloat($(special_price).data('price'));
        element_price   = special_price;
    }

    if($(element_option).length > 0){

        var selectO = $('.select_option');
        var radioO  = $('.radio_option');
        var checkO  = $('.checkbox_option');
        var tempVal = 0;
        var tempSelect;
        var tempRadio;
        var tempChecked;

        $(element_option).on('change',function(){

            tempSelect  = 0;
            tempRadio   = 0;
            tempChecked = 0;

            $(selectO).each(function(){
                $(this).each(function(){
                    var value = $(this).find('option:selected').data('price');
                    if (!isNaN(value)){ tempSelect+=parseFloat(value) };
                });
            });

            $(radioO).each(function(){
                $(this).each(function(){
                    if($(this).is(':checked')){
                        var value = $(this).data('price');
                        if (!isNaN(value)){ tempRadio+=parseFloat(value) };
                    }
                });
            });

            $(checkO).each(function(){
                if($(this).is(':checked')){
                    value = $(this).data('price');
                    if (!isNaN(value)){ tempChecked+=parseFloat(value) };
                }
            });

            var tempSum = parseFloat(sum) + parseFloat(tempSelect) + parseFloat(tempRadio) + parseFloat(tempChecked);
            $(element_price).html(tempSum.toFixed(2));

        });
    }

</script>

<script type="text/javascript"><!--
    $(function(){

        //$('#modalReview').modal('show');
        
        /*$('#modalReview').on('show.bs.modal', function(event) {

            var modal = $(this)
            modal.find('.modal-footer #send').on('click', function() {

                var email = modal.find('.modal-body #email').val();
                var rating = modal.find('.modal-body #rating').val();
                var title = modal.find('.modal-body #title').val();
                var message = modal.find('.modal-body #message').val();
                var product_id = modal.find('.modal-body #product_id').val();
                var customer_id = modal.find('.modal-body #customer_id').val();
                $.ajax({
                    url: '<?php echo base_url('review') ?>',
                    method: 'POST',
                    data: {email: email, rating: rating, title: title, message: message, product_id: product_id, customer_id: customer_id},
                    dataType: 'json',
                    success: function(json) {
                        $('#modalReview').modal('hide');
                        alert('Review Send');
                    }
                });
            });
        });*/

        $('#btn-subscribe').on('click', function() {
            var email = $('#subscriber').val();
            $.ajax({
                url: '<?php echo base_url('review/subscribe') ?>',
                method: 'POST',
                data: {email: email},
                dataType: 'json',
                success: function(json) {
                    alert('Subscribed, Thank You');
                }
            });

        });

        $('#button-cart').on('click', function() {
            var product_id = <?php echo $product[0]['product_id'] ?>;
            var quantity = $('#qty').val();

            var option = [];
            $('[name^="option"]').each(function() {
                if($(this).find('option').is(':selected') || $(this).is(':checked')) {
                    if($(this).val() !== '') {
                        option.push($(this).val());
                    }
                }
            });

            $.ajax({
                url: '<?php echo base_url('checkout/cart/add') ?>/' + product_id + '/' + (typeof (quantity) != undefined ? quantity : 1),
                method: 'POST',
                data: {option},
                dataType: 'json',
                success: function(json) {

                    if(json[0]) {
                        $('#message-cart').empty();
                        $('#menu-cart').empty();
                        $(".overlay").css("visibility", "hidden");
                        $('#message-cart').append('<div class="alert alert-success"><i class="fa fa-check-circle"></i> Your selected product added to cart<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                        $('#menu-cart').append('<i class="fa fa-shopping-cart"></i> Cart (' + json.length + ')</a>');
                        $('html, body').animate({scrollTop: 0}, 'slow');
                    } else {
                        $('#message-cart').empty();
                        $(".overlay").css("visibility", "hidden");
                        $('#message-cart').append('<div class="alert alert-warning"><i class="fa fa-check-circle"></i> This product have required option<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                        $('html, body').animate({scrollTop: 0}, 'slow');
                    }
                }
            });
        });

        $("#qty").keydown(function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                        // Allow: home, end, left, right, down, up
                        (e.keyCode >= 35 && e.keyCode <= 40)) {
                    // let it happen, don't do anything
                return;
            }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
    });
    //--></script>

    <script>
        var json_option =<?php echo  $product_option[0]['json_child'] ?>
    
    </script>
    <script src="<?php echo base_url('assets/js/single_product.js'); ?>"></script>
