
<div id="navigation">
    <nav class="navbar">
        <div class="container">

            <!-- Header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Menu</a>
            </div>

            <!-- Collapse -->
            <div id="navbar" class="navbar-collapse collapse">

                <!-- Left -->
                <ul class="nav navbar-nav">
                    <?php if ($this->session->userdata('uid')) { ?>
                    <li><a href="<?php echo base_url('account/logout') ?>">Logout</a></li>
                    <?php } else { ?>
                    <li class="<?php echo ($this->uri->segment(2) == 'login') ? 'active':''; ?>"><a href="<?php echo base_url('account/login') ?>">Login</a></li>
                    <li class="<?php echo ($this->uri->segment(2) == 'forgotten') ? 'active':''; ?>"><a href="<?php echo base_url('account/forgotten') ?>">Password</a></li>
                    <li class="<?php echo ($this->uri->segment(2) == 'register') ? 'active':''; ?>"><a href="<?php echo base_url('account/register') ?>">Register</a></li>
  
                    <?php } ?>
                 </ul>

                <!-- Right -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url('account/user') ?>"><i class="fa fa-user"></i> My Account</a></li>
                    
                    <?php 
                    if($this->session->userdata('uid')) {
                        $value_cart = count($cart);
                    } elseif ($this->session->userdata('guest_cart')) {
                        $value_cart = count(json_decode($this->session->userdata('guest_cart'), true));
                    } else {
                        $value_cart = 0;
                    }
                    
                    if($value_cart > 0) {
                        $value_cart = 'Cart ('.$value_cart.')';
                    } else {
                        $value_cart = 'Cart';
                    }
                    ?>
                    <li><a id="menu-cart" href="<?php echo base_url('checkout/cart') ?>"><i class="fa fa-shopping-cart"></i> <?php echo $value_cart ?></a></li>
                </ul>
            </div>

        </div>
    </nav>
</div>