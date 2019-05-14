<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 menu-shop-wrap">
    <div id="menu-shop">
        <div class="title">Shop</div>
        <div class="desktop-menu-shop">
            <ul>
                <?php
                foreach ($category as $row) {
                    ?>
                    <li><a href="<?php echo base_url('shop/' . $row['slug']) ?>"><?php echo $row['name'] ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>

        <div class="mobile-menu-shop">
            <nav class="nav-collapse">
            <ul>
              <?php
                foreach ($category as $row) {
                    ?>
                    <li><a href="<?php echo base_url('shop/' . $row['slug']) ?>"><?php echo $row['name'] ?></a></li>
                    <?php
                }
                ?>
            </ul>
          </nav>

          <script>
            var nav = responsiveNav(".nav-collapse");
          </script>
        </div>
    </div>
</div>