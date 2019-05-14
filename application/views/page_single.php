<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <?php
    if ($this->uri->segment(1) == 'about') {
        ?>

        <?php foreach ($page as $row) { ?>
        <div class="row">
            <div class="content-wrap">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 article-title"><?php echo $row['title'] ?></div>
                <div class="clearfix"></div>
                <div class="content-inner-wrap">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 content-text">
                        <?php echo $row['description'] ?>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="img-right"><img src="<?php echo base_url('upload/'.$row['image']); ?>" width="100%" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <script type="text/javascript">
            var content_height = $(".content-text").height();
            $(".img-right").css("height", content_height);
        </script>

        <?php
    } elseif ($this->uri->segment(1) == 'term-conditions' || $this->uri->segment(1) == 'shipping-info' || $this->uri->segment(1) == 'payment-info' || $this->uri->segment(1) == 'payment-method') {
        ?>
        <div class="row">
            <div class="content-wrap">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 article-title"><?php echo $page[0]['title'] ?></div>
                <div class="clearfix"></div>
                <div class="content-inner-wrap">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content-text">
                        <?php echo $page[0]['description'] ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>

