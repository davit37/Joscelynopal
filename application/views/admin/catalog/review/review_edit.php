<div id="content">

    <div class="page-header">

        <div class="container-fluid">

            <div class="pull-right">

                <button class="btn btn-primary" title="" data-toggle="tooltip" form="form-review" type="submit" data-original-title="Save"><i class="fa fa-save"></i></button>

                <a class="btn btn-default" title="" data-toggle="tooltip" href="<?php echo base_url('admin/catalog/review') ?>" data-original-title="Cancel"><i class="fa fa-reply"></i></a></div>

            <h1>Reviews</h1>

            <ul class="breadcrumb">

                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>

                <li><a href="<?php echo base_url('admin/catalog/review') ?>">Reviews</a></li>

            </ul>

        </div>

    </div>

    <div class="container-fluid">

        <div class="panel panel-default">

            <div class="panel-heading">

                <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Review</h3>

            </div>

            <div class="panel-body">

                <form class="form-horizontal" id="form-review" enctype="multipart/form-data" method="post" action="<?php echo base_url('admin/catalog/review/update') ?>">

                    <input type="hidden" name="review_id" value="<?php echo $result[0]['review_id'] ?>">

                    <!-- <div class="form-group required <?php if($this->session->userdata('author_error')) echo 'has_error'; ?>">

                        <label for="input-author" class="col-sm-2 control-label">Author</label>

                        <div class="col-sm-10">

                            <input type="email" class="form-control" id="input-author" placeholder="Email" value="<?php echo $result[0]['author'] ?>" name="author">

                            <?php if($this->session->userdata('author_error')) {

                                        echo '<div class="text-danger">Author is required!</div>';

                                        $this->session->unset_userdata('author_error');

                                    } ?>

                        </div>

                    </div>

                    <div class="form-group required <?php if($this->session->userdata('title_error')) echo 'has_error'; ?>">

                        <label for="input-title" class="col-sm-2 control-label">Title</label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="input-title" placeholder="Title" value="<?php echo $result[0]['title'] ?>" name="title">

                            <?php if($this->session->userdata('title_error')) {

                                        echo '<div class="text-danger">Title is required!</div>';

                                        $this->session->unset_userdata('title_error');

                                    } ?>

                        </div>

                    </div> -->

                    <div class="form-group required <?php if($this->session->userdata('product_error')) echo 'has_error'; ?>">

                        <label for="input-product" class="col-sm-2 control-label"><span title="" data-toggle="tooltip" data-original-title="(Autocomplete)">Product</span></label>

                        <div class="col-sm-10">

                            <input type="text" class="form-control" id="input-product" placeholder="Product" value="<?php echo $product[0]['name'] ?>" name="product"><ul class="dropdown-menu"></ul>

                            <input type="hidden" value="<?php echo $result[0]['product_id'] ?>" name="product_id">

                            <?php if($this->session->userdata('product_error')) {

                                        echo '<div class="text-danger">Product is required!</div>';

                                        $this->session->unset_userdata('product_error');

                                    } ?>

                        </div>

                    </div>

                    <div class="form-group required <?php if($this->session->userdata('text_error')) echo 'has_error'; ?>">

                        <label for="input-text" class="col-sm-2 control-label">Text</label>

                        <div class="col-sm-10">

                            <textarea class="form-control" id="input-text" placeholder="Text" rows="8" cols="60" name="text"><?php echo $result[0]['text'] ?></textarea>

                            <?php if($this->session->userdata('text_error')) {

                                        echo '<div class="text-danger">Text is required!</div>';

                                        $this->session->unset_userdata('text_error');

                                    } ?>

                        </div>

                    </div>

                    <div class="form-group required <?php if($this->session->userdata('rating_error')) echo 'has_error'; ?>">

                        <label for="input-name" class="col-sm-2 control-label">Rating</label>

                        <div class="col-sm-10">

                            <label class="radio-inline">

                                <input type="radio" value="1" name="rating" <?php echo ($result[0]['rating'] == 1) ? 'checked="checked"' : ''; ?>>

                                1

                            </label>

                            <label class="radio-inline">

                                <input type="radio" value="2" name="rating" <?php echo ($result[0]['rating'] == 2) ? 'checked="checked"' : ''; ?>>

                                2

                            </label>

                            <label class="radio-inline">

                                <input type="radio" value="3" name="rating" <?php echo ($result[0]['rating'] == 3) ? 'checked="checked"' : ''; ?>>

                                3

                            </label>

                            <label class="radio-inline">

                                <input type="radio" value="4" name="rating" <?php echo ($result[0]['rating'] == 4) ? 'checked="checked"' : ''; ?>>

                                4

                            </label>

                            <label class="radio-inline">

                                <input type="radio" value="5" name="rating" <?php echo ($result[0]['rating'] == 5) ? 'checked="checked"' : ''; ?>>

                                5

                            </label>

                            <?php if($this->session->userdata('rating_error')) {

                                        echo '<div class="text-danger">Rating is required!</div>';

                                        $this->session->unset_userdata('rating_error');

                                    } ?>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="input-status" class="col-sm-2 control-label">Status</label>

                        <div class="col-sm-10">

                            <select class="form-control" id="input-status" name="status">

                                <option <?php echo ($result[0]['status'] == 1) ? 'selected="selected"' : ''; ?> value="1">Publish</option>

                                <option <?php echo ($result[0]['status'] == 0) ? 'selected="selected"' : ''; ?> value="0">Unpublish</option>

                            </select>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script type="text/javascript"><!--

        

        $('input[name=\'product\']').autocomplete({

        'source': function(request, response) {

            var like_by = $('input[name=\'product\']').val();



            $.ajax({

                url: "<?php echo base_url('admin/catalog/product/autocomplete/name') ?>/" + like_by,

                dataType: 'json',

                success: function(json) {

                    response($.map(json, function(item) {

                        return {

                            label: item['name'],

                            value: item['product_id']

                        }

                    }));

                }

            });

        },

        'select': function(item) {

            $('input[name=\'product\']').val(item['label']);

            $('input[name=\'product_id\']').val(item['value']);

        }

    });

    

  //--></script></div>