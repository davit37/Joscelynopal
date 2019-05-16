
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="button" form="form-product" data-toggle="tooltip" title="Save" class="btn btn-primary" id='btn-save'><i class="fa fa-save"></i></button>
                <a href="<?php echo base_url('admin/catalog/product') ?>" data-toggle="tooltip" title="Cancel" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1>Product Option</h1>
            <ul class="breadcrumb">
                <li><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                <li><a href="<?php echo base_url('admin/catalog/product_option') ?>">Product Option</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i><?php echo $action ?>  Product Option</h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('admin/catalog/product_option/save?action='.$action ) ?>" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">

                  <input type="hidden" name="id" id='id_option' value="<?php echo isset($result) ?$result[0]['id']:''  ?>">

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-data" data-toggle="tab">Data</a></li>
                        
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active" id="tab-data">
                            <div class="form-group required <?php if($this->session->userdata('product_error')) echo 'has_error'; ?>">
                                <label class="col-sm-2 control-label" for="input-name">Product Name</label>
                                <div class="col-sm-10">

                                    <input type="text" name="option_name" placeholder="Option Name" id="option_name" class="form-control" value="<?php echo isset($result) ?$result[0]['option_name']:''  ?>" />

                                    <?php if($this->session->userdata('product_error')) {
                                        echo '<div class="text-danger">Product Name is required!</div>';
                                        $this->session->unset_userdata('product_error');
                                    } ?>
                                </div>
                            </div>

                           <hr>

                            <div class="table-responsive">

                                <table  class="table table-striped table-bordered table-hover">

                                    <tbody id='tbl-opt'>

                                        <?php if(isset($json_child )){?>

                                        <?php foreach($json_child as $index => $json_child){ ?>
                                        
                                            <tr class="option_parent_rm">        
                                                <td><input type="hidden" name="product_option_id[]" value="">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <div class="form-group"><label
                                                                class="col-sm-2 control-label">Name</label>
                                                            <div class="col-sm-10"> 
                                                                <?php echo $json_child['child_name_html']; ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-5">
                                                        <div class="form-group"><label class="col-sm-4 control-label">Child
                                                                Of</label>
                                                            <div class="col-sm-7"><select name="option_child_of[]"
                                                                    class="form-control child-list" data-option-index="<?php echo $index ?>">
                                                                    <option value="none">- none -</option>

                                                                    <?php echo $json_child['option_list'] ?>
                                                                    
                                                                </select></div>
                                                        </div>
                                                    </div>


                                                    </div>

                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-10 col-sm-offset-1">
                                                            <table  class="table table-striped table-bordered table-hover">
                                                            
                                                                <tbody id='tbl-value-<?php echo  $index ?>'>

                                                                <?php foreach($json_child['option_value'] as $v_index => $option_value){ ?>

                                                                    <tr class='parent_rm'>
                                                                        <td>

                                                                            <input type="text" class="form-control option_value" value="<?php echo $option_value ?> " name="" data-option-index="<?php echo $index ?>" data-value-index="<?php echo $v_index?>">

                                                                        </td>
                                                                        <td>
                                                                              <button type="button" data-toggle="tooltip" title="Devare" class="btn btn-danger btn-del-val" data-option-index="<?php echo $index ?>" data-value-index="<?php echo $v_index?>"><i class="fa fa-trash"></i></button>

                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                                </tbody>

                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="1"></td>
                                                                        <td class="text-left" width='2%'><button type="button" data-toggle="tooltip" title="Add Value" class="btn btn-primary btn-add-value" data-option-index="<?php echo $index ?>"><i class="fa fa-plus-circle"></i></button></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>

                                                
                                                
                                                </td>
                                                <td class="text-left" ><button type="button"
                                                        onclick="$('#option-value-row0').remove();" data-toggle="tooltip"
                                                        title="Remove" class="btn btn-danger btn-del-option" data-option-index="<?php echo $index ?>"><i
                                                            class="fa fa-minus-circle" ></i></button></td>
                                            </tr>

                                        <?php } }?>
                                      
                                        <!-- <tr>
                                            <td><input type="hidden" name="product_option_id[]" value="">
                                             <div class="row">
                                                 <div class="col-sm-7">
                                                     <div class="form-group"><label
                                                             class="col-sm-2 control-label">Name</label>
                                                         <div class="col-sm-10"><input type="text" name="child_name[]"
                                                                 value="" class="form-control option-name" data-option-index='0'></div>
                                                     </div>
                                                 </div>

                                                 <div class="col-sm-5">
                                                     <div class="form-group"><label class="col-sm-4 control-label">Child
                                                             Of</label>
                                                         <div class="col-sm-7"><select name="option_child_of[]"
                                                                 class="form-control child-list" data-option-index='0'>
                                                                 <option value="none">- none -</option>
                                                                 
                                                                 
                                                             </select></div>
                                                     </div>
                                                 </div>


                                                </div>

                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-10 col-sm-offset-1">
                                                        <table  class="table table-striped table-bordered table-hover">
                                                          
                                                            <tbody id='tbl-value-0'>
                                                               
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td colspan="1"></td>
                                                                    <td class="text-left" width='2%'><button type="button" data-toggle="tooltip" title="Add Value" class="btn btn-primary btn-add-value" data-option-index='0'><i class="fa fa-plus-circle"></i></button></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>

                                              
                                               
                                            </td>
                                            <td class="text-left" ><button type="button"
                                                    onclick="$('#option-value-row0').remove();" data-toggle="tooltip"
                                                    title="Remove" class="btn btn-danger"><i
                                                        class="fa fa-minus-circle"></i></button></td>
                                        </tr> -->

                                    </tbody>

                                    <tfoot>

                                        <tr>

                                            <td></td>

                                            <td class="text-left" width='2%'><button type="button" id='btn-add-opt'
                                                    data-toggle="tooltip" title="" class="btn btn-primary"
                                                    data-original-title="Add Option"><i
                                                        class="fa fa-plus-circle"></i></button></td>

                                        </tr>

                                    </tfoot>

                                </table>

                            </div>

                            <hr>

                            <div class="form-group required ">

                                <label for="input-text" class="col-sm-2 control-label">Child Settings</label>

                                <div class="col-sm-10">

                                    <textarea class="form-control" rows="6" cols="60"
                                        id="child_setting" > <?php echo isset($result) ? $result[0]['child_setting']:''  ?></textarea>

                                </div>

                            </div>


                        </div>

                       
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script type="text/javascript">

        var url = "<?php echo base_url('admin/catalog/product_option/save?action='.$action ) ?>";

       
        var json_child = <?php echo isset($result[0]['json_child']) ? $result[0]['json_child']:'{}'?>

        

    </script>



   


    <script src='<?php echo base_url("assets/admin/catalog/f_product_option.js") ?>' ></script>

</div>