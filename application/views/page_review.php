<style type="text/css">

  .panel-title{
    font-size: 14px;
  }

  .panel-body img{
    width: auto;
    max-width: 100%;
    max-height: 100px;
  }

  .panel-body-content{
    margin-bottom: 10px;
  }

  .form-loading{
    margin-left: 5px;
    width: 30px;
    height: 30px;
    display:inline-block;
    opacity: 0;
  }

  .form-loading img{
    width: 100%;
  }
</style>
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 contact">

  <div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

      <div class="title">REVIEW</div>

    </div>

  </div>

  <div class="row">

    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

      <div class="content">

        <?php
        if(!empty($order_product)){

          echo '<div class="panel-group" id="accordion">';
          $no = 1;
          echo '<form id="review-form">';
          echo '<input type="hidden" name="url" value="'.$this->uri->segment(2).'">';
          echo '<input type="hidden" name="order_id" value="'.$order_product[0]['order_id'].'">';
          foreach($order_product as $index => $value){
            echo '<div class="panel panel-default">';
            echo '<div class="panel-heading">';
            echo '<h4 class="panel-title">'.$value['name'].'</h4>';
            echo '</div>';

            echo '<div id="review-product-'.$no.'" class="panel-collapse collapse in">';
            echo '<div class="panel-body">';
            echo '<div class="panel-body-content">';
            echo '<img class="img-responsive" src="'.base_url('upload/'.$value['image']).'">';
            echo '</div>';

            echo '<div class="panel-body-content">';

            echo '<div class="form-group">';
            echo '<label for="recipient-name" class="control-label">Rating:</label>';
            echo '<select class="form-control" name="rating[]" required>';
            echo '<option value="1">Very Bad</option>';
            echo '<option value="2">Bad</option>';
            echo '<option value="3">Neural</option>';
            echo '<option value="4">Good</option>';
            echo '<option value="5">Very Good</option>';
            echo '</select>';
            echo '</div>';

                        echo '<div class="form-group">';
                        echo '<label for="message-text" class="control-label">Message:</label>';
                        echo '<textarea style="height: 150px;" class="form-control" name="message[]" required></textarea>';
                        echo '</div>';
                        echo '<input type="hidden" name="product_id[]" value="'.$value['product_id'].'">';
                        echo '</div>';

                        echo '</div>';
                        echo '</div>';

                        echo '</div>';
                        $no++;
                      }

                      echo '<div class="panel-body-content" style="margin-top: 10px;">';
                      echo '<button type="submit" class="submit-review btn btn-primary">Submit</button>';
                      echo '<span class="form-loading"><img src="'.base_url('assets/images/general/loading.gif').'"></span>';
                      echo '</div>';

                      echo '</form>';
                      echo '</div>';

                    } else {
                      echo '<p>Your link review has been expired.</p>';
                    }
                    ?>

                  </div>

                </div>

              </div>

            </div>

            <script type="text/javascript">
              $(function(){

                $("#review-form").submit(function(e){

                  e.preventDefault();

                  var dataPost = $(this).serialize();

                  $.ajax({
                    url: '<?php echo base_url('review/form');?>',
                    data: dataPost,
                    dataType: 'json',
                    type: 'POST',
                    beforeSend: function(data){

                      $('.form-loading').css('opacity','1');
                      $('.submit-review').attr('disabled',true);
                      $('.form-control').attr('disabled',true);

                    },
                    success: function(result){

                      $('.form-loading').css('opacity','0');
                      $('.submit-review').attr('disabled',false);
                      $('.form-control').attr('disabled',false);

                      alert(result.message);

                      if(result.status == 'success'){
                        window.location.href = "<?php echo base_url('home');?>";
                      }

                    }

                  });

                });

              });
            </script>