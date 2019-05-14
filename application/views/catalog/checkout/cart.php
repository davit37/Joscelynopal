<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/table-cart.css').'?'.md5(date('c'));?>">
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <h1 class="title-page">Shopping Cart</h1>

            <?php if ($products) { ?>

            <form enctype="multipart/form-data" method="post" action="<?php echo base_url('checkout/cart/edit') ?>">

                <div class="wrap cf">
                  <div class="cart">

   <?php if(!empty($products['data_single'])){



    $total_single   = 0;

    $total_opton    = 0;

    $total          = 0;

    $count_subtotal = 0;

    $subtotal       = 0;

    $subtotal_option = 0;
} ?>

<ul class="cartWrap">

   <?php 

   foreach($products['data_single'] as $index => $value){



    if (!empty($value['special'])) {

        $now = strtotime(date('Y-m-d'));

        $date_end = strtotime($value['date_end']);

        if ($date_end >= $now) {

            $price = $value['special'];

        } else {

            $price = $value['price'];

        }

    } else {



     $price = $value['price'];



 }

 ?>
 <li class="items odd">

    <div class="infoWrap"> 
        <div class="cartSection">
            <div class="cartDesc">
                <img src="<?php echo base_url('upload').'/'.$value['image'];?>" alt="<?php echo $value['name'];?>" class="itemImg" />
            </div>
            <div class="cartDesc mainCartDesc">
                <h3><?php echo $value['name'];?></h3>
                <p>Category : </p>
                <p><?php echo $value['category_name'];?></p>
                <div class="cartOpt">
                    <?php

                    echo '<div class="optItems">';
                    echo '<p>Price : <strong>$'.number_format($price, 2, '.', '').'</strong></p>';
                    echo '</div>';
                    if(!empty($products['data_option'])){

                        foreach($products['data_option'] as $key => $row){

                            echo '<div class="optItems">';
                            if($value['product_id'] == $row['product_id']){

                                echo '<p>'.ucfirst($row['option_name']).' : '.$row['option_detil_name'].'  <strong>$'.number_format($row['price_option_value'], 2, '.', '').'</strong></p>';

                            }

                            echo '</div>';

                        }

                    }
                    ?>
                </div>
            </div>
        </div>  
        <?php 
        $subtotal = 0;

        if(!empty($products['data_option'])){
            $total_option = 0;
            foreach($products['data_option'] as $key => $row){

                if($value['product_id'] == $row['product_id']){

                    $total_option+=$row['price_option_value'];    

                } 

            }

            $subtotal = $price + $total_option;

        } else {

            $subtotal = $price;

        }

        echo '<div class="wrapper-cart-price">';

        echo '<div class="prodTotal cartSection">';
        echo '<p>$'.number_format($subtotal, 2, '.', '').'</p>';
        echo '</div>';

        echo '<div class="cartSection removeWrap">';
        echo '<a onclick="cart.remove('.$value['product_id'].');" class="remove" title="" data-toggle="tooltip" type="button" data-original-title="Remove">x</a>';
        echo '</div>';

        echo '</div>';

        $total+=$subtotal;

        ?>
 </div>
</li>

<?php } ?>
<!--<li class="items even">Item 2</li>-->

</ul>
</div>

<div class="subtotal cf">
    <ul>
      <li class="totalRow final"><span class="label">Total</span><span class="value">$<?php echo number_format($total, 2, '.', '');?></span></li>
  </ul>
</div>

</form>

<div class="buttons">

    <div class="pull-left wrapper-btn-continue"><a class="btn continue" href="<?php echo base_url('home') ?>">Continue Shopping</a></div>

    <div class="pull-right wrapper-btn-continue"><a class="btn continue" href="<?php echo base_url('checkout/process') ?>">Checkout</a></div>

</div>

</div>

<!-- <div class="table-responsive">



    <?php if(!empty($products['data_single'])){



        $total_single   = 0;

        $total_opton    = 0;

        $total          = 0;

        $count_subtotal = 0;

        $subtotal       = 0;

        $subtotal_option = 0;



        echo '<table class="table table-bordered table-shopping-cart">';

        echo '<thead>';

        echo '<tr>';

        echo '<td></td>';

        echo '<td>Item Description</td>';

        echo '<td>Payment</td>';

        echo '<td>Subtotal</td>';

        echo '</tr>';

        echo '</thead>';



        echo '<tbody>';



        foreach($products['data_single'] as $index => $value){



            if (!empty($value['special'])) {

                $now = strtotime(date('Y-m-d'));

                $date_end = strtotime($value['date_end']);

                if ($date_end >= $now) {

                    $price = $value['special'];

                } else {

                    $price = $value['price'];

                }

            } else {



             $price = $value['price'];



         }



         echo '<tr>';



         echo '<td class="item remove-action">';

         echo '<div class="itemlist">';

         echo '<button onclick="cart.remove('.$value['product_id'].');" class="btn btn-danger btn-sm btn-cart" title="" data-toggle="tooltip" type="button" data-original-title="Remove"><i class="fa fa-trash"></i></button>';

         echo '</div>';

         echo '</td>';



         echo '<td class="item description">';



         echo '<div class="itemlist image">';

         echo '<a href="'.base_url('product/'.$value['slug']).'" target="_blank" class="shopimage" href="#" title="'.$value['name'].'">';

         echo '<img src="'.base_url('upload').'/'.$value['image'].'" alt="'.$value['name'].'">';

         echo '</a>';

         echo '</div>';



         echo '<div class="itemlist info">';

         echo '<a href="'.base_url('product/'.$value['slug']).'" target="_blank"><h4 class="textshoppingcart"><strong>'.$value['name'].'</strong></h4></a>';

         echo '<p class="textshoppingcart" style="margin-top: 15px;"><strong>CATEGORY</strong></p>';

         echo '<p class="textshoppingcart">'.$value['category_name'].'</p>';



         echo '</div>';



         echo '</td>';



         echo '<td class="item price">';



         echo '<table class="listprice">';

         echo '<tr>';

         echo '<td class="left">';

         echo '<p class="textshoppingcart">Unit Price</p>';

         echo '</td>';



         echo '<td class="right">';

         echo '<p class="textshoppingcart"><strong>$'.number_format($price, 2, '.', '').'</strong></p>';

         echo '</td>';

         echo '</tr>';



         if(!empty($products['data_option'])){

            foreach($products['data_option'] as $key => $row){

                echo '<tr>';

                echo '<td class="left">';

                if($value['product_id'] == $row['product_id']){

                    echo '<p class="textshoppingcart">'.ucfirst($row['option_name']).' : '.$row['option_detil_name'].'</p>';

                }

                echo '</td>';



                echo '<td class="right">';

                if($value['product_id'] == $row['product_id']){

                    echo '<p class="textshoppingcart"><strong>$'.number_format($row['price_option_value'], 2, '.', '').'</strong></p>';

                }

                echo '</td>';

                echo '</tr>';

            }

        }



        echo '</table>'; 



        echo '</td>';



        echo '<td class="item subtotal">';

        $subtotal = 0;

        if(!empty($products['data_option'])){
            $total_option = 0;
            foreach($products['data_option'] as $key => $row){

                if($value['product_id'] == $row['product_id']){

                    $total_option+=$row['price_option_value'];    

                } 

            }

            $subtotal = $price + $total_option;

        } else {

            $subtotal = $price;

        }

        echo '<p class="textshoppingcart"><strong>$'.number_format($subtotal, 2, '.', '').'</strong></p>';

        echo '</td>';



        echo '</tr>';



        $total+=$subtotal;



    }



    echo '<tr class="total">';

    echo '<td colspan="3" class="item totalprice"><strong>Total:</strong></td>';

    echo '<td class="item totalprice"><strong>$'.number_format($total, 2, '.', '').'</strong></td>';

    echo '</tr>';



    echo '</tbody>';

    echo '</table>';



} ?>



</div> -->

<!-- </form> -->



<!-- <div class="buttons">

    <div class="pull-left"><a class="btn btn-default" href="<?php echo base_url('home') ?>">Continue Shopping</a></div>

    <div class="pull-right"><a class="btn btn-primary" href="<?php echo base_url('checkout/process') ?>">Checkout</a></div>

</div> -->

<?php } else { ?>



<p>Your shopping cart is empty!</p>

<div class="buttons">

    <div class="pull-right"><a class="btn btn-primary" href="<?php echo base_url('home') ?>">Continue</a></div>

</div>

<?php } ?>

</div>

</div>

</div>