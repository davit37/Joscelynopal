<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">

<html>

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <title><?php echo $title; ?></title>
  <style type="text/css">
    .button-red{
      border: 2px solid #c9c9c9;
      padding: 8px 30px;
      font-size: 15px;
      color: #fff;
      border-radius: 5px;
      background: #ff3019;
      background: -moz-linear-gradient(top, #ff3019 0%, #cf0404 100%);
      background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ff3019), color-stop(100%,#cf0404));
      background: -webkit-linear-gradient(top, #ff3019 0%,#cf0404 100%);
      background: -o-linear-gradient(top, #ff3019 0%,#cf0404 100%);
      background: -ms-linear-gradient(top, #ff3019 0%,#cf0404 100%);
      background: linear-gradient(to bottom, #ff3019 0%,#cf0404 100%);
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ff3019', endColorstr='#cf0404',GradientType=0 );
      transition: 0.5s ease-in-out;
      display: inline-block;
    margin-top: 5px;
    margin-bottom: 5px;
    text-align: center;
    text-decoration: none;

    }

    @media only screen and (max-width: 480px){
      .list-product{
        width: 180px;
      }

      .list-category{
        width: 100px;
      }

    }

  </style>
</head>

<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">

  <div style="width: 680px;"><a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $store_name; ?>" style="margin-bottom: 20px; border: none;" /></a>

    <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_greeting; ?></p>



    <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">

      <thead>

        <tr>

          <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;" colspan="2">Order Detail</td>

        </tr>

      </thead>

      <tbody>

        <tr>

          <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><b>Order ID:</b> <?php echo $order_id; ?><br />

            <b>Date Added:</b> <?php echo $date_added; ?><br />

            <b>Payment Method:</b> <?php echo $payment_method; ?><br />

            <b>Shipping Method:</b> <?php echo $shipping_method; ?>

          </td>

          <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><b>Email</b> <?php echo $email; ?><br />

            <b>Telephone:</b> <?php echo $telephone; ?><br />

            <b>IP Address:</b> <?php echo $ip; ?><br />

            <b>Order Status:</b> <?php echo $order_status; ?>

          </td>

        </tr>

      </tbody>

    </table>


    <?php if(!empty($payment_comment) || !empty($shipping_comment)){ ?>
    <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">

      <thead>

        <tr>
          <?php if(!empty($payment_comment)){ ?>
          <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Payment Comment</td>
          <?php } ?>

          <?php if(!empty($shipping_comment)){ ?>
          <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Shipping Comment</td>
          <<?php } ?>
        </tr>

      </thead>

      <tbody>

        <tr>

          <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $payment_comment ?></td>

          <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $shipping_comment ?></td>

        </tr>

      </tbody>

    </table>
    <?php } ?>


    <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">

      <thead>

        <tr>

          <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Shipping Address</td>

        </tr>

      </thead>

      <tbody>

        <tr>

          <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $shipping_address; ?></td>

        </tr>

      </tbody>

    </table>

    <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">

      <thead>

        <tr>

          <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Product</td>

          <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Category</td>

          <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: right; padding: 7px; color: #222222;">Price</td>

        </tr>

      </thead>

      <tbody>

        <?php foreach ($products as $key => $row) { ?>

        <tr>

          <td class="list-product" style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;">
            <?php echo $row['name'];
            if(!empty($option)){
              foreach($option as $index => $value){
                if($row['product_id'] == $value['order_product_id']){
                  echo '<br>'.$value['name'].' : '.$value['value'];
                }
              }
            }
            ?>
          </td>

          <td class="list-category" style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px; vertical-align:top;"><?php echo $row['category']; ?></td>

          <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;">$ 
            <?php echo number_format($row['price'], 2, '.', ''); 
            if(!empty($option)){
              foreach($option as $index => $value){
                if($row['product_id'] == $value['order_product_id']){
                  echo '<br>$'.number_format($value['price'], 2, '.', '');
                }
              }
            }
            ?>  
          </td>

        </tr>

        <?php } ?>

      </tbody>

      <?php if(!empty($shipping_country_name) && !empty($shipping_price)){ ?>
      <thead>

        <tr>

          <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: right; padding: 7px; color: #222222;" colspan="2">Shipping to</td>

          <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: right; padding: 7px; color: #222222;">Price</td>

        </tr>

      </thead>

      <tbody>

        <tr>

          <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;" colspan="2"><?php echo $shipping_country_name; ?></td>

          <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;">$<?php echo number_format($shipping_price, 2, '.', ''); ?></td>

        </tr>

      </tbody>
      <?php } ?>
      <tfoot>

        <tr>

          <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;" colspan="2"><b>Total</b></td>

          <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;"><strong>$<?php echo $total_amount; ?></strong></td>

        </tr>

        <?php if(isset($review_slug) && !empty($review_slug)) { ?>
        <tr>
          <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: center; padding: 7px;" colspan="4">Help us to review our product,</td>
        </tr>
        <tr>
          <td style="text-align:center; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD;" colspan="4">
        <a class="button-red" style="text-decoration:none;" href="<?php echo $review_slug;?>">Click here</a>
          </td>
        </tr>
        <?php } ?>

      </tfoot>

    </table>

    <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $store_name; ?> &copy; <?php echo date("Y"); ?> All Rights Reserved</p>

  </div>

</body>

</html>

