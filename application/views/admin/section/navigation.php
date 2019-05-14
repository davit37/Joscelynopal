<nav id="column-left"><div id="profile">
        <div><a class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url('assets/favicon/android-icon-48x48.png') ?>" alt="<?php echo $this->session->userdata('user') ?>" title="admin" class="img-circle" /></a></div>
        <div>
            <h4><?php echo $this->session->userdata('user') ?></h4>
            <small>Administrator</small></div>
    </div>
    <ul id="menu">
        <li id="dashboard"><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard fa-fw"></i> <span>Dashboard</span></a></li>
        <li id="catalog"><a class="parent"><i class="fa fa-tags fa-fw"></i> <span>Catalog</span></a>
            <ul>
                <li><a href="<?php echo base_url('admin/catalog/category') ?>">Categories</a></li>
                <li><a href="<?php echo base_url('admin/catalog/product') ?>">Products</a></li>
                <li><a href="<?php echo base_url('admin/catalog/product_option') ?>">Products Option</a></li>
                <li><a href="<?php echo base_url('admin/catalog/review') ?>">Review</a></li>
            </ul>
        </li>
        <li id="sale"><a class="parent"><i class="fa fa-shopping-cart fa-fw"></i> <span>Sales</span></a>
            <ul>
                <li><a href="<?php echo base_url('admin/sale/order') ?>">Orders</a></li>
                <li><a href="<?php echo base_url('admin/sale/customer') ?>">Customers</a></li>
            </ul>
        </li>
        <li id="user"><a href="<?php echo base_url('admin/user') ?>"><i class="fa fa-user fa-fw"></i> <span>User</span></a></li>
        <li id="slideshow"><a href="<?php echo base_url('admin/slideshow') ?>"><i class="fa fa-picture-o fa-fw"></i> <span>Slideshow</span></a></li>
        <li id="page"><a href="<?php echo base_url('admin/page') ?>"><i class="fa fa-file-o fa-fw"></i> <span>Page</span></a></li>
        <li id="setting"><a class="parent"><i class="fa fa-cog fa-fw"></i> <span>Setting</span></a>
            <ul>
                <li><a class="parent">Payment</a>
                    <ul class="collapse">
                        <li><a href="<?php echo base_url('admin/setting/payment/bank') ?>">Bank Transfer</a></li>
                        <li><a href="<?php echo base_url('admin/setting/payment/paypal') ?>">Paypal</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo base_url('admin/setting/shipping') ?>">Shipping Method</a></li>
                <li><a href="<?php echo base_url('admin/setting/shipping/shipping_price') ?>">Shipping Price</a></li>
                <li><a href="<?php echo base_url('admin/setting/email') ?>">Email</a></li>
                <li><a href="<?php echo base_url('admin/setting/store') ?>">Store</a></li>
                <li><a href="<?php echo base_url('admin/setting/social') ?>">Social Media</a></li>
                <li><a href="<?php echo base_url('admin/setting/maintenance') ?>">Maintenance</a></li>
            </ul>
        </li>
    </ul>
</nav>