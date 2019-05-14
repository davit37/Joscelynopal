<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <a href="<?php echo base_url('home') ?>"><img class="logo" src="<?php echo base_url('assets/images/general/logo.png') ?>"></a>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 block-search text-right">
        <?php
        echo form_open('search');
        echo '<div class="form-group">';
        echo form_input(array('name' => 'search', 'class' => 'input-search'));
        echo form_submit(array('name' => 'submit', 'value' => 'SEARCH', 'class' => 'submit-search'));
        echo '</div>';
        echo form_close();
        ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="rule"></div>
    </div>
</div>