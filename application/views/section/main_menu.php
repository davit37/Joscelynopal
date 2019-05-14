<?php

$active = $this->uri->segment(1);

?>





<div id="menu" class="col-xs-12 col-sm-12 col-md-10 col-lg-10 no-padding-xs">

    <ul>

        <li <?php if($active == 'home'){echo "class='active'";} ?>><a href="<?php echo base_url('home'); ?>">Home</a></li>

        <?php if(isset($header) && !empty($header)){

            foreach($header as $index => $value){

                $active_class = '';

                if($active == $value['slug']){

                    $active_class = 'class="active"';

                }

                echo '<li '.$active_class.'><a href="'.base_url($value['slug']).'">'.$value['label_menu'].'</a></li>';

            }

        } ?>

    </ul>  

</div>



<div id="message" class="col-xs-12 col-sm-12 col-md-10 col-lg-10"></div>

