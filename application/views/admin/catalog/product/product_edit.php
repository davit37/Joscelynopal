<div id="content">

    <div class="page-header">

        <div class="container-fluid">

            <div class="pull-right">

                <button type="submit" form="form-product" data-toggle="tooltip" title="Save" class="btn btn-primary"><i class="fa fa-save"></i></button>

                <a href="<?php echo base_url('admin/catalog/product') ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a></div>

                <h1>Products</h1>

                <ul class="breadcrumb">

                    <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>

                    <li><a href="<?php echo base_url('admin/catalog/product') ?>">Products</a></li>

                </ul>

            </div>

        </div>

        <div class="container-fluid">

            <div class="panel panel-default">

                <div class="panel-heading">

                    <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit Product</h3>

                </div>

                <div class="panel-body">

                    <form action="<?php echo base_url('admin/catalog/product/update') ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">

                        <?php

                        if ($this->session->flashdata('option_value_error')) {

                            echo '<div class="alert alert-danger">'.$this->session->flashdata('option_value_error').'<button data-dismiss="alert" class="close" type="button">×</button></div>';

                        }

                        ?>

                        <input type="hidden" name="product_id" value="<?php echo $result[0]['product_id'] ?>" />

                        <input type="hidden" name="prev_slug" value="<?php echo $result[0]['slug'] ?>" />

                        <ul class="nav nav-tabs">

                            <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>

                            <li><a href="#tab-image" data-toggle="tab">Image</a></li>

                            <li><a href="#tab-video" data-toggle="tab">Video</a></li>

                            <li><a href="#tab-option" data-toggle="tab">Option</a></li>

                            <li><a href="#tab-special" data-toggle="tab">Special</a></li>

                        </ul>

                        <div class="tab-content">



                            <div class="tab-pane active" id="tab-data">

                                <div class="form-group required <?php if ($this->session->userdata('product_error')) echo 'has_error'; ?>">

                                    <label class="col-sm-2 control-label" for="input-name">Product Name</label>

                                    <div class="col-sm-10">

                                        <input type="text" name="product_name" value="<?php echo $result[0]['name'] ?>" placeholder="Product Name" id="input-name" class="form-control" />

                                        <?php

                                        if ($this->session->userdata('product_error')) {

                                            echo '<div class="text-danger">Product Name is required!</div>';

                                            $this->session->unset_userdata('product_error');

                                        }

                                        ?>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-description">Description</label>

                                    <div class="col-sm-10">

                                        <textarea name="product_description" placeholder="Description" id="input-description"><?php echo $result[0]['description'] ?></textarea>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-image">Image</label>

                                    <div class="col-sm-10 parent-image">

                                        <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo base_url('thumb/' . $result[0]['image']) ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" /></a>

                                        <input type="hidden" name="image" value="<?php echo $result[0]['image'] ?>" id="input-image" />

                                    </div>

                                </div>            

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-type">Type</label>

                                    <div class="col-sm-10">

                                        <input type="text" name="type" value="<?php echo $result[0]['type'] ?>" placeholder="Type" id="input-type" class="form-control" />

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-item-id">Item ID</label>

                                    <div class="col-sm-10">

                                        <input type="text" name="item_id" value="<?php echo $result[0]['item_id'] ?>" placeholder="Item ID" id="input-item-id" class="form-control" />

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-content"><span data-toggle="tooltip" title="in GEM">Content</span></label>

                                    <div class="col-sm-10">

                                        <input type="text" name="content" value="<?php echo $result[0]['content'] ?>" placeholder="Content" id="input-content" class="form-control" />

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-weight"><span data-toggle="tooltip" title="in CT">Weight</span></label>

                                    <div class="col-sm-10">

                                        <input type="text" name="weight" value="<?php echo $result[0]['weight'] ?>" placeholder="Weight" id="input-weight" class="form-control" />

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-size"><span data-toggle="tooltip" title="in MM">Size</span></label>

                                    <div class="col-sm-10">

                                        <input type="text" name="size" value="<?php echo $result[0]['size'] ?>" placeholder="Size" id="input-size" class="form-control" />

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-shape">Shape</label>

                                    <div class="col-sm-10">

                                        <input type="text" name="shape" value="<?php echo $result[0]['shape'] ?>" placeholder="Shape" id="input-shape" class="form-control" />

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-clarity">Clarity</label>

                                    <div class="col-sm-10">

                                        <input type="text" name="clarity" value="<?php echo $result[0]['clarity'] ?>" placeholder="Clarity" id="input-clarity" class="form-control" />

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-treatment">Treatment</label>

                                    <div class="col-sm-10">

                                        <input type="text" name="treatment" value="<?php echo $result[0]['treatment'] ?>" placeholder="Treatment" id="input-treatment" class="form-control" />

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-origin">Origin</label>

                                    <div class="col-sm-10">

                                        <input type="text" name="origin" value="<?php echo $result[0]['origin'] ?>" placeholder="Origin" id="input-origin" class="form-control" />

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-price">Price</label>

                                    <div class="col-sm-10">

                                        <input type="text" name="price" value="<?php echo number_format($result[0]['price'], 2, '.', '') ?>" placeholder="Price" id="input-price" class="form-control" />

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-quantity">Quantity</label>

                                    <div class="col-sm-10">

                                        <input type="text" name="quantity" value="<?php echo $result[0]['quantity'] ?>" placeholder="Quantity" id="input-quantity" class="form-control" />

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-stock"><span data-toggle="tooltip" title="Status shown when a product is out of stock">Out Of Stock Status</span></label>

                                    <div class="col-sm-10">

                                        <select name="stock" id="input-stock" class="form-control">

                                            <option value="In Stock" <?php echo ($result[0]['stock'] == 'In Stock') ? 'selected="selected"' : ''; ?>>In Stock</option>

                                            <option value="Out Of Stock" <?php echo ($result[0]['stock'] == 'Out Of Stock') ? 'selected="selected"' : ''; ?>>Out Of Stock</option>

                                            <option value="Pre-Order" <?php echo ($result[0]['stock'] == 'Pre-Order') ? 'selected="selected"' : ''; ?>>Pre-Order</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-category">Category Product</label>

                                    <div class="col-sm-10">

                                        <select name="category_id" id="input-category" class="form-control">

                                            <?php

                                            foreach ($category as $row) {

                                                $selected = ($result[0]['category_id'] == $row['category_id']) ? 'selected="selected"' : '';

                                                echo "<option value='" . $row['category_id'] . "' " . $selected . ">" . $row['name'] . "</option>";

                                            }

                                            ?>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-featured">Featured</label>

                                    <div class="col-sm-10">

                                        <select name="featured" id="input-featured" class="form-control">

                                            <option value="1" <?php echo ($result[0]['featured'] == 1) ? 'selected="selected"' : ''; ?>>Yes</option>

                                            <option value="0" <?php echo ($result[0]['featured'] == 0) ? 'selected="selected"' : ''; ?>>No</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-sort-order">Sort Order</label>

                                    <div class="col-sm-10">

                                        <input type="text" name="sort_order" value="<?php echo $result[0]['sort_order'] ?>" placeholder="Sort Order" id="input-sort-order" class="form-control" />

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label class="col-sm-2 control-label" for="input-status">Status</label>

                                    <div class="col-sm-10">

                                        <select name="status" id="input-status" class="form-control">

                                            <option value="1" <?php echo ($result[0]['status'] == 1) ? 'selected="selected"' : ''; ?>>Enabled</option>

                                            <option value="0" <?php echo ($result[0]['status'] == 0) ? 'selected="selected"' : ''; ?>>Disabled</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group <?php if ($this->session->userdata('slug_error')) echo 'has_error'; ?>">

                                    <label class="col-sm-2 control-label" for="input-slug">Slug</label>

                                    <div class="col-sm-10">

                                        <input type="text" name="slug" value="<?php echo $result[0]['slug'] ?>" placeholder="Slug" id="input-slug" class="form-control" />

                                        <?php

                                        if ($this->session->userdata('slug_error')) {

                                            echo '<div class="text-danger">Duplicate slug, change other slug</div>';

                                            $this->session->unset_userdata('slug_error');

                                        }

                                        ?>

                                    </div>

                                </div>

                            </div>



                            <div class="tab-pane" id="tab-image">

                                <div class="table-responsive">

                                    <table id="images" class="table table-striped table-bordered table-hover">

                                        <thead>

                                            <tr>

                                                <td class="text-left">Image</td>

                                                <td class="text-right">Sort Order</td>

                                                <td></td>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                            if ($product_images) {

                                                $i = 0;

                                                foreach ($product_images as $product_image) {

                                                    ?>

                                                    <tr id="image-row<?php echo $i ?>">

                                                        <td class="text-left parent-image">

                                                            <a class="img-thumbnail" data-toggle="image" id="thumb-image<?php echo $i ?>" href="">

                                                                <img data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" title="" alt="" src="<?php echo base_url('thumb/' . $product_image['image']) ?>">

                                                            </a><input type="hidden" id="input-image0" value="<?php echo $product_image['image'] ?>" name="product_image[]">

                                                        </td>

                                                        <td class="text-right">

                                                            <input type="text" class="form-control" placeholder="Sort Order" value="<?php echo $product_image['sort_order'] ?>" name="product_image_sort_order[]">

                                                        </td>

                                                        <td class="text-left">

                                                            <button class="btn btn-danger" title="Remove" data-toggle="tooltip" onclick="$('#image-row<?php echo $i ?>').remove();" type="button"><i class="fa fa-minus-circle"></i></button>

                                                        </td>

                                                    </tr>

                                                    <?php

                                                    $i++;

                                                }

                                            }

                                            ?>

                                        </tbody>

                                        <tfoot>

                                            <tr>

                                                <td colspan="2"></td>

                                                <td class="text-left"><button type="button" onclick="addImage();" data-toggle="tooltip" title="Add Image" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>

                                            </tr>

                                        </tfoot>

                                    </table>

                                </div>

                            </div>



                            <div class="tab-pane" id="tab-video">

                                <div class="table-responsive">

                                    <table id="videos" class="table table-striped table-bordered table-hover">

                                        <thead>

                                            <tr>

                                                <td class="text-left">Video</td>

                                                <td class="text-right">Format</td>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                            $img_mp4 = 'no_image.png';

                                            $link_mp4 = '';

                                            $img_webm = 'no_image.png';

                                            $link_webm = '';

                                            $img_ogv = 'no_image.png';

                                            $link_ogv = '';



                                            foreach ($product_videos as $product_video) {

                                                if ($product_video['type'] == 'mp4') {

                                                    $img_mp4 = 'video.png';

                                                    $link_mp4 = $product_video['video'];

                                                }

                                                if ($product_video['type'] == 'webm') {

                                                    $img_webm = 'video.png';

                                                    $link_webm = $product_video['video'];

                                                }

                                                if ($product_video['type'] == 'ogv') {

                                                    $img_ogv = 'video.png';

                                                    $link_ogv = $product_video['video'];

                                                }

                                            }

                                            ?>



                                            <tr id="video-row0">

                                                <td class="text-left parent-image">

                                                    <a href="" id="thumb-videomp4" data-toggle="image" class="img-thumbnail">

                                                        <img src="<?php echo base_url('assets/images/icon/' . $img_mp4) ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" />

                                                        <input type="hidden" name="product_video_mp4" value="<?php echo $link_mp4 ?>" id="input-videomp4" />

                                                    </a>

                                                </td>

                                                <td class="text-right">

                                                    MP4

                                                </td>

                                            </tr>

                                            <tr id="video-row1">

                                                <td class="text-left parent-image">

                                                    <a href="" id="thumb-videowebm" data-toggle="image" class="img-thumbnail">

                                                        <img src="<?php echo base_url('assets/images/icon/' . $img_webm) ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" />

                                                        <input type="hidden" name="product_video_webm" value="<?php echo $link_webm ?>" id="input-videowebm" />

                                                    </a>

                                                </td>

                                                <td class="text-right">

                                                    WEBM

                                                </td>

                                            </tr>

                                            <tr id="video-row2">

                                                <td class="text-left parent-image">

                                                    <a href="" id="thumb-videoogv" data-toggle="image" class="img-thumbnail">

                                                        <img src="<?php echo base_url('assets/images/icon/' . $img_ogv) ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" />

                                                        <input type="hidden" name="product_video_ogv" value="<?php echo $link_ogv ?>" id="input-videoogv" />

                                                    </a>

                                                </td>

                                                <td class="text-right">

                                                    OGV

                                                </td>

                                            </tr>

                                        </tbody>

                                        <tfoot></tfoot>

                                    </table>

                                </div>

                            </div>



                            <div class="tab-pane" id="tab-option">

                                <div class="table-responsive">

                                    <table id="options" class="table table-striped table-bordered table-hover">

                                        <thead>

                                            <tr>

                                                <td class="text-left">Option</td>

                                                <td></td>

                                            </tr>

                                        </thead>

                                        <tbody>



                                            <?php

                                            if ($product_options) {



                                                $i = 0;

                                                foreach ($product_options as $product_option) {

                                                    ?>



                                                    <tr id="option-value-row<?php echo $i ?>">

                                                        <input type="hidden" name="product_option_id[]" value="<?php echo $product_option['product_option_id'];?>">

                                                        <td>

                                                            <div class="form-group">

                                                                <label class="col-sm-2 control-label">Type</label>

                                                                <div class="col-sm-10">

                                                                    <select class="form-control" name="option_type[]">

                                                                        <option value="">- Select -</option>

                                                                        <?php

                                                                        foreach ($option as $opt) {

                                                                            ?>

                                                                            <option value="<?php echo $opt['option_id'] ?>" <?php echo ($opt['option_id'] == $product_option['option_id']) ? 'selected="selected"' : ''; ?>><?php echo $opt['type'] ?></option>

                                                                            <?php

                                                                        }

                                                                        ?>

                                                                    </select>

                                                                </div>

                                                            </div>

                                                            <div class="form-group">

                                                                <label class="col-sm-2 control-label">Name</label>

                                                                <div class="col-sm-10">

                                                                    <input type="text" class="form-control" value="<?php echo $product_option['value'] ?>" name="option_name[]">

                                                                </div>

                                                            </div>

                                                            <div class="form-group">

                                                                <label class="col-sm-2 control-label">Required</label>

                                                                <div class="col-sm-10">

                                                                    <select class="form-control" name="option_required[]">

                                                                        <option value="">- Select -</option>

                                                                        <option value="1" <?php echo ($product_option['required'] == 1) ? 'selected="selected"' : ''; ?>>Yes</option>

                                                                        <option value="0" <?php echo ($product_option['required'] == 0) ? 'selected="selected"' : ''; ?>>No</option>

                                                                    </select>

                                                                </div>

                                                            </div>

                                                            <table class="table table-striped table-bordered table-hover" id="option-value<?php echo $i ?>">

                                                                <thead>

                                                                    <tr>

                                                                        <td class="text-left">Value</td>

                                                                        <td class="text-left">Price</td>

                                                                        <td class="text-left">Weight</td>

                                                                        <td></td>

                                                                    </tr>

                                                                </thead>

                                                                <tbody>

                                                                    <?php

                                                                //$i = 0;
                                                                    foreach ($product_option_values as $product_option_value) {

                                                                        if ($product_option_value['product_option_id'] == $product_option['product_option_id']) {

                                                                            ?>

                                                                            <tr>
                                                                                <input type="hidden" name="opt_value_id[<?php echo $i?>][]" value="<?php echo $product_option_value['product_option_id'];?>">
                                                                                <td class="text-left">

                                                                                    <input type="text" name="opt_value[<?php echo $i ?>][]" value="<?php echo $product_option_value['value'] ?>" class="form-control">

                                                                                </td>

                                                                                <td class="text-left">

                                                                                    <input type="text" name="opt_price[<?php echo $i ?>][]" value="<?php echo number_format($product_option_value['price'], 2, '.', '') ?>" class="form-control">

                                                                                </td>

                                                                                <td class="text-left">

                                                                                    <input type="text" name="opt_weight[<?php echo $i ?>][]" value="<?php echo number_format($product_option_value['weight'], 2, '.', '') ?>" class="form-control">

                                                                                </td>

                                                                                <td class="text-left">

                                                                                    <button class="btn btn-danger" title="Remove" data-toggle="tooltip" onclick="$(this).closest('tr').remove();" type="button">

                                                                                        <i class="fa fa-minus-circle"></i>

                                                                                    </button>

                                                                                </td>

                                                                            </tr>

                                                                            <?php

                                                                        }
                                                                    //$i++;
                                                                    }

                                                                    ?>

                                                                </tbody>

                                                                <tfoot>

                                                                    <tr>

                                                                        <td colspan="3"></td>

                                                                        <td class="text-left">

                                                                            <button class="btn btn-primary" title="Add Value" data-toggle="tooltip" onclick="addOptionVal(<?php echo $i ?>);" type="button">

                                                                                <i class="fa fa-plus-circle"></i>

                                                                            </button>

                                                                        </td>

                                                                    </tr>

                                                                </tfoot>

                                                            </table>

                                                        </td>

                                                        <td class="text-left">

                                                            <button class="btn btn-danger" title="Remove" data-toggle="tooltip" onclick="$('#option-value-row<?php echo $i ?>').remove();" type="button">

                                                                <i class="fa fa-minus-circle"></i>

                                                            </button>

                                                        </td>

                                                    </tr>



                                                    <?php

                                                    $i++;

                                                }

                                            }

                                            ?>



                                        </tbody>

                                        <tfoot>

                                            <tr>

                                                <td></td>

                                                <td class="text-left"><button type="button" onclick="addType();" data-toggle="tooltip" title="Add Option" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>

                                            </tr>

                                        </tfoot>

                                    </table>

                                </div>

                            </div>



                            <div class="tab-pane" id="tab-special">

                                <div class="table-responsive">

                                    <table id="special" class="table table-striped table-bordered table-hover">

                                        <thead>

                                            <tr>

                                                <td class="text-right">Price</td>

                                                <td class="text-left">Date Start</td>

                                                <td class="text-left">Date End</td>



                                            </tr>

                                        </thead>

                                        <tbody>

                                            <tr id="special-row0">

                                                <?php

                                                if ($product_special) {

                                                    $product_special_id = $product_special[0]['product_special_id'];

                                                    $price = number_format($product_special[0]['price'], 2, '.', '');

                                                    $date_start = $product_special[0]['date_start'];

                                                    $date_end = $product_special[0]['date_end'];

                                                } else {

                                                    $product_special_id = '';

                                                    $price = '';

                                                    $date_start = '';

                                                    $date_end = '';

                                                }

                                                ?>

                                                <input type="hidden" name="product_special_id" value="<?php echo $product_special_id;?>">
                                                <td class="text-right"><input type="text" name="product_special_price" value="<?php echo $price; ?>" placeholder="Price" class="form-control" /></td>

                                                <td class="text-left"><div class="input-group date"><input type="text" name="product_special_date_start" value="<?php echo $date_start; ?>" placeholder="Date Start" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>

                                                <td class="text-left"><div class="input-group date"><input type="text" name="product_special_date_end" value="<?php echo $date_end; ?>" placeholder="Date End" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>

                                            </tr>

                                        </tbody>

                                        <tfoot></tfoot>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>



        <script type="text/javascript"><!--



            tinymce.init({

                selector: "#input-description", theme: "modern", height: 300,

                plugins: [

                "advlist autolink lists link image charmap print preview anchor",

                "searchreplace visualblocks code",

                "insertdatetime media table contextmenu paste"

                ],

                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",

                relative_urls: false,

                remove_script_host: false,

                external_filemanager_path: "<?php echo base_url('assets/admin') . '/filemanager/' ?>",

                filemanager_title: "Filemanager",

                filemanager_access_key: "<?php echo $this->session->userdata('token') ?>",

                external_plugins: {"filemanager": "<?php echo base_url('assets/admin/filemanager/plugin.min.js') ?>"}

            });



            //--></script>





            <script type="text/javascript"><!--

                $('.date').datetimepicker({

                    pickTime: false

                });



                $('.time').datetimepicker({

                    pickDate: false

                });



                $('.datetime').datetimepicker({

                    pickDate: true,

                    pickTime: true

                });

                //--></script>



                <script type="text/javascript"><!--

                    function responsive_filemanager_callback(field_id) {

                        console.log(field_id);



                        var baseURL = "<?php echo base_url('thumb') . "/" ?>";

                        var url = jQuery('#' + field_id).val();

                        var lastword = field_id.split("-").pop();

            //alert('update ' + field_id + " with " + url);



            if (field_id.indexOf("video") >= 0) {

                jQuery("#thumb-" + lastword + " img").attr("src", "<?php echo base_url('assets/images/icon/video.png') ?>");

            } else {

                jQuery("#thumb-" + lastword + " img").attr("src", baseURL + url);

            }

        }

        //--></script>



        <script type="text/javascript"><!--

            var image_row = <?php echo $total_row_images ?>;



            function addImage() {

                html = '<tr id="image-row' + image_row + '">';

                html += '  <td class="text-left parent-image"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo base_url('assets/images/icon/no_image.png') ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" /></a><input type="hidden" name="product_image[]" value="" id="input-image' + image_row + '" /></td>';

                html += '  <td class="text-right"><input type="text" name="product_image_sort_order[]" value="" placeholder="Sort Order" class="form-control" /></td>';

                html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

                html += '</tr>';



                $('#images tbody').append(html);



                image_row++;

            }

            //--></script>



            <script type="text/javascript"><!--



                var option_row = <?php echo count($product_options); ?>;



                function addType() {

                    html = '<tr id="option-value-row' + option_row + '"><td>';

                    html += '<input type="hidden" name="product_option_id[]" value="">';

                    html += '<div class="form-group">';

                    html += '<label class="col-sm-2 control-label">Type</label>';

                    html += '<div class="col-sm-10">';

                    html += '<select name="option_type[]" class="form-control">';

                    html += '<option value="">- Select -</option>';

                    <?php foreach ($option as $opt) { ?>

                        html += '<option value="<?php echo $opt['option_id'] ?>"><?php echo $opt['type'] ?></option>';

                        <?php } ?>

                        html += '</select>';

                        html += '</div>';

                        html += '</div>';



                        html += '<div class="form-group">';

                        html += '<label class="col-sm-2 control-label">Name</label>';

                        html += '<div class="col-sm-10">';

                        html += '<input type="text" name="option_name[]" value="" class="form-control" />';

                        html += '</div>';

                        html += '</div>';



                        html += '<div class="form-group">';

                        html += '<label class="col-sm-2 control-label">Required</label>';

                        html += '<div class="col-sm-10">';

                        html += '<select name="option_required[]" class="form-control">';

                        html += '<option value="">- Select -</option>';

                        html += '<option value="1">Yes</option>';

                        html += '<option value="0">No</option>';

                        html += '</select>';

                        html += '</div>';

                        html += '</div>';



                        html += '<table id="option-value' + option_row + '" class="table table-striped table-bordered table-hover">';

                        html += '<thead>';

                        html += '<tr>';

                        html += '<td class="text-left">Value</td>';

                        html += '<td class="text-left">Price</td>';

                        html += '<td class="text-left">Weight</td>';

                        html += '<td></td>';

                        html += '</tr>';

                        html += '</thead>';



                        html += '<tbody></tbody>';

                        html += '<tfoot>';

                        html += '<tr>';

                        html += '<td colspan="3"></td>';

                        html += '<td class="text-left"><button type="button" onclick="addOptionVal(' + option_row + ');" data-toggle="tooltip" title="Add Value" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>';

                        html += '</tr>';

                        html += '</tfoot>';

                        html += '</table>';



                        html += '</td>';

                        html += '<td class="text-left"><button type="button" onclick="$(\'#option-value-row' + option_row + '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';

                        html += '</tr>';



                        $('#options > tbody').append(html);



                        option_row++;

                    }

                    //--></script>



                    <script type="text/javascript"><!--



                        function addOptionVal(i) {



                            html = '<tr>';

                            html += '<input type="hidden" name="opt_value_id[' + i + '][]" value="">';

                            html += '<td class="text-left">';

                            html += '<input type="text" class="form-control" value="" name="opt_value[' + i + '][]">';

                            html += '</td>';

                            html += '<td class="text-left">';

                            html += '<input type="text" class="form-control" value="" name="opt_price[' + i + '][]">';

                            html += '</td>';

                            html += '<td class="text-left">';

                            html += '<input type="text" class="form-control" value="" name="opt_weight[' + i + '][]">';

                            html += '</td>';

                            html += '<td class="text-left">';

                            html += '<button type="button" onclick="$(this).closest(\'tr\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>';

                            html += '</td>';

                            html += '</tr>';



                            $('#option-value' + i + ' > tbody').append(html);

                        }



                        //--></script>



                    </div>