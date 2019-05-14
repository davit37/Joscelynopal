<div id="content">

    <div class="page-header">

        <div class="container-fluid">

            <div class="pull-right"><a href="<?php echo base_url('admin/catalog/review/add') ?>" data-toggle="tooltip" title="Add New" class="btn btn-primary"><i class="fa fa-plus"></i></a>

                <button type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-review').submit() : false;"><i class="fa fa-trash-o"></i></button>

            </div>

            <h1>Reviews</h1>

            <ul class="breadcrumb">

                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>

                <li><a href="<?php echo base_url('admin/catalog/review') ?>">Reviews</a></li>

            </ul>

        </div>

    </div>

    <div class="container-fluid">

        <?php

        if ($this->session->userdata('review_success')) {

            echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> Success: You have modified review!      <button data-dismiss="alert" class="close" type="button">×</button></div>';

            $this->session->unset_userdata('review_success');

        }

        if ($this->session->userdata('review_error')) {

            echo '<div class="alert alert-danger"><i class="fa fa-check-circle"></i> Error: Please try again!      <button data-dismiss="alert" class="close" type="button">×</button></div>';

            $this->session->unset_userdata('review_error');

        }

        ?>



        <div class="panel panel-default">

            <div class="panel-heading">

                <h3 class="panel-title"><i class="fa fa-list"></i> Review List</h3>

            </div>

            <div class="panel-body">

                <div class="well">

                    <div class="row">

                        <form action="<?php echo base_url('admin/catalog/review/filter') ?>" method="post" enctype="multipart/form-data" id="form-filter">

                            <div class="col-sm-6">

                                <div class="form-group">

                                    <label class="control-label" for="input-name">Product</label>

                                    <input type="text" name="filter_product" value="" placeholder="Product" id="input-product" class="form-control" />

                                </div>

                                <!-- <div class="form-group">

                                    <label class="control-label" for="input-author">Author</label>

                                    <input type="text" name="filter_author" value="" placeholder="Author" id="input-author" class="form-control" />

                                </div> -->

                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">

                                    <label class="control-label" for="input-status">Status</label>

                                    <select name="filter_status" id="input-status" class="form-control">

                                        <option value=""></option>

                                        <option value="1">Published</option>

                                        <option value="0">Unpublished</option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-sm-12">

                                <div class="form-group">

                                    <label for="input-date-added" class="control-label">Date Added</label>

                                    <div class="input-group date">

                                        <input type="text" class="form-control" id="input-date-added" data-date-format="YYYY-MM-DD" placeholder="Date Added" value="" name="filter_date_added">

                                        <span class="input-group-btn">

                                            <button class="btn btn-default" type="button"><i class="fa fa-calendar"></i></button>

                                        </span></div>

                                    </div>

                                    <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>
                                    
                                </div>

                                

                            </form>

                        </div>

                    </div>

                    <form action="<?php echo base_url('admin/catalog/review/delete') ?>" method="post" enctype="multipart/form-data" id="form-review">

                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">

                                <thead>

                                    <tr>

                                        <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>

                                        <td class="text-center">Image</td>

                                        <td class="text-left"><a href="<?php echo $url_product ?>" class="<?php echo $class_product ?>">Product</a>

                                        </td>

                                   <!--  <td class="text-left"><a href="<?php echo $url_author ?>" class="<?php echo $class_author ?>">Author</a>

                               </td> -->

                               <td class="text-right"><a href="<?php echo $url_rating ?>" class="<?php echo $class_rating ?>">Rating</a>

                               </td>

                               <td class="text-right"><a href="<?php echo $url_status ?>" class="<?php echo $class_status ?>">Status</a>

                               </td>

                               <td class="text-left"><a href="<?php echo $url_date ?>" class="<?php echo $class_date ?>">Date Added</a>

                               </td>

                               <td class="text-right">Action</td>

                           </tr>

                       </thead>

                       <tbody>

                        <?php

                        if ($results) {

                            foreach ($results as $row) {

                                ?>

                                <tr>

                                    <td class="text-center"><input type="checkbox" name="selected[]" value="<?php echo $row['review_id'] ?>" /></td>

                                    <td class="text-center"><img src="<?php echo base_url('thumb/' . $row['image']) ?>" alt="<?php echo $row['product_name'] ?>" class="img-thumbnail" width="40" height="40" /></td>

                                    <td class="text-left"><?php echo $row['product_name'] ?></td>

                                    <!-- <td class="text-left"><?php echo $row['author'] ?></td> -->

                                    <td class="text-right"><?php echo $row['rating'] ?></td>

                                    <td class="text-right"><?php echo ($row['status'] == 1) ? 'Published' : 'Unpublished'; ?></td>

                                    <td class="text-left"><?php echo date("d/m/Y", strtotime($row['date_added'])) ?></td>

                                    <td class="text-right"><a class="btn btn-primary" title="" data-toggle="tooltip" href="<?php echo base_url('admin/catalog/review/edit/' . $row['review_id']) ?>" data-original-title="Edit"><i class="fa fa-pencil"></i></a></td>

                                </tr>

                                <?php

                            }

                        } else {

                            echo '<td class="text-center" colspan="8">No results!</td>';

                        }

                        ?>

                    </tbody>

                </table>

            </div>

        </form>

        <div class="row">

            <div class="col-sm-6 text-left"><?php echo $links ?></div>

            <div class="col-sm-6 text-right">Showing <?php echo $first_result ?> to <?php echo $last_result ?> of <?php echo $total_result ?> (<?php echo $total_page ?> Pages)</div>

            <?php //echo $last_query; ?>

        </div>

    </div>

</div>

</div>

</div>



<script type="text/javascript"><!--

    $('#button-filter').on('click', function() {

        $('#form-filter').submit();

    });

    //--></script>



    <script type="text/javascript"><!--

        $('input[name=\'filter_category\']').autocomplete({

            'source': function(request, response) {

                var like_by = $('input[name=\'filter_category\']').val();



                $.ajax({

                    url: "<?php echo base_url('admin/catalog/product/autocomplete/category') ?>/" + like_by,

                    dataType: 'json',

                    success: function(json) {

                        response($.map(json, function(item) {

                            return {

                                label: item['name'],

                                value: item['category_id']

                            }

                        }));

                    }

                });

            },

            'select': function(item) {

                $('input[name=\'filter_category\']').val(item['label']);

            }

        });



        $('input[name=\'filter_product\']').autocomplete({

            'source': function(request, response) {

                var like_by = $('input[name=\'filter_product\']').val();



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

                $('input[name=\'filter_product\']').val(item['label']);

            }

        });

        //--></script>



        <script type="text/javascript" src="<?php echo base_url('assets/admin/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js') ?>"></script>

        <link media="screen" rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css') ?>">

        <script type="text/javascript"><!--

            $('.date').datetimepicker({

                pickTime: false

            });

            //--></script>