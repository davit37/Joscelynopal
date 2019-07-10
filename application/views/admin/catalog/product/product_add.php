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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Add Product</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/catalog/product/save') ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>
                        <li><a href="#tab-image" data-toggle="tab">Image</a></li>
                        <li><a href="#tab-video" data-toggle="tab">Video</a></li>
                        <li><a href="#tab-option" data-toggle="tab">Option</a></li>
                        <li><a href="#tab-special" data-toggle="tab">Special</a></li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="tab-data">
                            <div class="form-group required <?php if($this->session->userdata('product_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-name">Product Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="product_name" value="" placeholder="Product Name" id="input-name" class="form-control" />
                                    <?php if($this->session->userdata('product_error')) {
                                        echo '<div class="text-danger">Product Name is required!</div>';
                                        $this->session->unset_userdata('product_error');
                                    } ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-description">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="product_description" placeholder="Description" id="input-description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-image">Image</label>
                                <div class="col-sm-10 parent-image">
                                    <a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo base_url('assets/images/icon/no_image.png') ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" /></a>
                                    <input type="hidden" name="image" value="" id="input-image" />
                                </div>
                            </div>            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-type">Type</label>
                                <div class="col-sm-10">
                                    <input type="text" name="type" value="" placeholder="Type" id="input-type" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-item-id">Item ID</label>
                                <div class="col-sm-10">
                                    <input type="text" name="item_id" value="" placeholder="Item ID" id="input-item-id" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-content"><span data-toggle="tooltip" title="in GEM">Content</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="content" value="" placeholder="Content" id="input-content" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-weight"><span data-toggle="tooltip" title="in CT">Weight</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="weight" value="" placeholder="Weight" id="input-weight" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-size"><span data-toggle="tooltip" title="in MM">Size</span></label>
                                <div class="col-sm-10">
                                    <input type="text" name="size" value="" placeholder="Size" id="input-size" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-shape">Shape</label>
                                <div class="col-sm-10">
                                    <input type="text" name="shape" value="" placeholder="Shape" id="input-shape" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-clarity">Clarity</label>
                                <div class="col-sm-10">
                                    <input type="text" name="clarity" value="" placeholder="Clarity" id="input-clarity" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-treatment">Treatment</label>
                                <div class="col-sm-10">
                                    <input type="text" name="treatment" value="" placeholder="Treatment" id="input-treatment" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-origin">Origin</label>
                                <div class="col-sm-10">
                                    <input type="text" name="origin" value="" placeholder="Origin" id="input-origin" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-price">Price</label>
                                <div class="col-sm-10">
                                    <input type="text" name="price" value="" placeholder="Price" id="input-price" class="form-control" />
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-quantity">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="text" name="quantity" value="1" placeholder="Quantity" id="input-quantity" class="form-control" />
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-stock"><span data-toggle="tooltip" title="Status shown when a product is out of stock">Out Of Stock Status</span></label>
                                <div class="col-sm-10">
                                    <select name="stock" id="input-stock" class="form-control">
                                        <option value="In Stock">In Stock</option>
                                        <option value="Out Of Stock">Out Of Stock</option>
                                        <option value="Pre-Order">Pre-Order</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-category">Category Product</label>
                                <div class="col-sm-10">
                                    <select name="category_id" id="input-category" class="form-control">
                                        <?php
                                        foreach ($category as $row) {
                                            echo "<option value='" . $row['category_id'] . "'>" . $row['name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-featured">Featured</label>
                                <div class="col-sm-10">
                                    <select name="featured" id="input-featured" class="form-control">
                                        <option value="1">Yes</option>
                                        <option value="0" selected="selected">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-sort-order">Sort Order</label>
                                <div class="col-sm-10">
                                    <input type="text" name="sort_order" value="0" placeholder="Sort Order" id="input-sort-order" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-status">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" id="input-status" class="form-control">
                                        <option value="1" selected="selected">Enabled</option>
                                        <option value="0">Disabled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group <?php if($this->session->userdata('slug_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-slug">Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" name="slug" value="" placeholder="Slug" id="input-slug" class="form-control" />
                                    <?php if($this->session->userdata('slug_error')) {
                                        echo '<div class="text-danger">Duplicate slug, change other slug</div>';
                                        $this->session->unset_userdata('slug_error');
                                    } ?>
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
                                        <tr id="video-row0">
                                            <td class="text-left parent-image">
                                                <a href="" id="thumb-videomp4" data-toggle="image" class="img-thumbnail">
                                                    <img src="<?php echo base_url('assets/images/icon/no_image.png') ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" />
                                                    <input type="hidden" name="product_video_mp4" value="" id="input-videomp4" />
                                                </a>
                                            </td>
                                            <td class="text-right">
                                                MP4
                                            </td>
                                        </tr>
                                        <tr id="video-row1">
                                            <td class="text-left parent-image">
                                                <a href="" id="thumb-videowebm" data-toggle="image" class="img-thumbnail">
                                                    <img src="<?php echo base_url('assets/images/icon/no_image.png') ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" />
                                                    <input type="hidden" name="product_video_webm" value="" id="input-videowebm" />
                                                </a>
                                            </td>
                                            <td class="text-right">
                                                WEBM
                                            </td>
                                        </tr>
                                        <tr id="video-row2">
                                            <td class="text-left parent-image">
                                                <a href="" id="thumb-videoogv" data-toggle="image" class="img-thumbnail">
                                                    <img src="<?php echo base_url('assets/images/icon/no_image.png') ?>" alt="" title="" data-placeholder="<?php echo base_url('assets/images/icon/no_image.png') ?>" />
                                                    <input type="hidden" name="product_video_ogv" value="" id="input-videoogv" />
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
                                            <td class="text-right"><input type="text" name="product_special_price" value="" placeholder="Price" class="form-control" /></td>
                                            <td class="text-left"><div class="input-group date"><input type="text" name="product_special_date_start" value="" placeholder="Date Start" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>
                                            <td class="text-left"><div class="input-group date"><input type="text" name="product_special_date_end" value="" placeholder="Date End" data-date-format="YYYY-MM-DD" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div></td>
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
            filemanager_access_key:"<?php echo $this->session->userdata('token') ?>" ,
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
        var image_row = 0;

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
        var option_row = 0;

        function addType() {
            html = '<tr id="option-value-row' + option_row + '"><td>';
            
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
            html += '<td class="text-left">';
            html += '<input type="text" class="form-control" value="" name="opt_value['+ i +'][]">';
            html += '</td>';
            html += '<td class="text-left">';
            html += '<input type="text" class="form-control" value="" name="opt_price['+ i +'][]">';
            html += '</td>';
            html += '<td class="text-left">';
            html += '<input type="text" class="form-control" value="" name="opt_weight['+ i +'][]">';
            html += '</td>';
            html += '<td class="text-left">';
            html += '<button type="button" onclick="$(this).closest(\'tr\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>';
            html += '</td>';
            html += '</tr>';
            
            $('#option-value' + i + ' > tbody').append(html);
        }
        
    //--></script>

</div>