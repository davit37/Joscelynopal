/**
 * ?Variable Dom 
 * 
 * */

var btn_add_opt           = '#btn-add-opt';
var tbl_opt               = '#tbl-opt ';
var btn_add_value         = '.btn-add-value';
var tbl_value             = '#tbl-value-';
var option_name           = '.option-name';
var child_list            = '.child-list';
var option_value          = '.option_value';
var btn_save              = '#btn-save';
var btn_del_val           = '.btn-del-val';
var btn_del_option        = '.btn-del-option';

/**
 * !END
 */

//------------------------------------------------------------------------//

var option_index          = Object.keys(json_child).length;
var json_temp             = {};

//------------------------------------------------------------------------//

/**
 * 
 * ? Group Of Function
 */

//add html to select option
var _set_value_list= ()=>{

   var html = '';
   var input_list = $(option_name);

   $.each(input_list, function (i,v){

      var get_value   = input_list.eq(i).val();
      var get_index   = input_list.eq(i).data('option-index');
      var get_parent  = input_list.eq(i).data('parent-id');
      
      if(get_value != ''){

         if(typeof get_parent == 'undefined'){

            html+= `<option option-index=${get_index} >${get_value}</option>` 
         }else{

            html+= `<option option-index=${get_index} style='display:none'>${get_value}</option>` 
         }

      }
     
   })

   return html;   
}


/**
 * !END
 */


 //------------------------------------------------------------------------//


/**
 * 
 * ?Group function Of Event DOM
 */

//Add new html to form option 
$(btn_add_opt).click(function(){

   $(tbl_opt).append(
      `
        <tr class="option_parent_rm">
            <td><input type="hidden" name="product_option_id[]" value="">
               <div class="row">
                  <div class="col-sm-7">

                     <div class="form-group"><label class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10"><input type="text" name="child_name[]" value="" class="form-control option-name"   data-option-index="${option_index}"></div>

                     </div>
                  </div>

                  <div class="col-sm-5">
                     <div class="form-group"><label class="col-sm-4 control-label">Child
                           Of</label>

                        <div class="col-sm-7"><select name="option_child_of[]" data-option-index="${option_index}" class="form-control child-list">

                              <option value="none">- none -</option>
                              
                              ${_set_value_list()}
                              

                           </select></div>
                     </div>
                  </div>
               </div>

               <hr>
               <div class="row">
                  <div class="col-sm-10 col-sm-offset-1">
                     <table class="table table-striped table-bordered table-hover">

                        <tbody id='tbl-value-${option_index}'>

                        </tbody>

                        <tfoot>
                           <tr>
                              <td colspan="1"></td>
                              <td class="text-left" width='2%'><button type="button" data-toggle="tooltip" title="Add Value"
                                    class="btn btn-primary btn-add-value" data-option-index="${option_index}"><i class="fa fa-plus-circle"></i></button></td>
                           </tr>
                        </tfoot>

                     </table>
                  </div>
               </div>
            </td>
            <td class="text-left"><button type="button"  data-toggle="tooltip"
                  title="Remove" class="btn btn-danger btn-del-option" data-option-index="${option_index}"><i class="fa fa-minus-circle"></i></button>
            </td>
         </tr>
      `
   )

   //Make New Json
   json_child[option_index] = {
      child_name      :'',
      option_child_of :'',
      option_value       :[],

  }

   option_index++;
})


//add new html form value
$(document).on('click',btn_add_value, function(){

   var _this            = $(this)   
   var index            = _this.data('option-index');
   var _option_value_l  = $('#tbl-value-'+index).find(option_value).length;

   
   //add form input value to table
   $(tbl_value+`${index}`).append(`

      <tr  class='parent_rm'>
         <td>
            <input type="text" class="form-control option_value" value="" data-option-index="${index}" data-value-index='${_option_value_l}'>
         </td>
         <td><button type="button" data-toggle="tooltip" title="Devare" class="btn btn-danger btn-del-val" id='btn-del-val' data-option-index="${index}" data-value-index='${_option_value_l}'><i class="fa fa-trash"></i></button></td>
      </tr>
   
   `)

   //add new array value
   json_child[index].option_value.push('');
})


//trigger change input text option name
$(document).on('change', option_name, function(){
   
   var _this         = $(this);
   var _this_index   = _this.data('option-index');

   //add option name to all list child of
   $.each($(child_list), function(i, value){

      if($(child_list).eq(i).data('option-index') != _this_index ){

         var get_option = $(child_list).eq(i).find(`[option-index='${_this_index}']`)

         if(get_option.length > 0){
            
            //change inner-html option list
            get_option.html(_this.val())
         }else{

            //add new option in list
            $(child_list).eq(i).append(`<option option-index="${_this_index}">${_this.val()}</option>`)
         }

      }
      
   })

   //store data to json
   json_child[_this_index].child_name=_this.val();
   
})


//hidden option in list when option select was change to !none
$(document).on('change', child_list, function(){

   var _this         = $(this);
   var _this_index   = _this.data('option-index');
   var get_input     = _this.parents().find(`.option-name[data-option-index='${_this_index}']`); //get DOM option name 

   if(_this.val() != 'none'){
      
      get_input.attr('data-parent-id', _this.val())

      //hide option in list
      $.each($(child_list), function(i,v){
         $(child_list).eq(i).find(`[data-option-index='${_this_index}']`).css('display','none')
      })

   }else{

      get_input.removeAttr('data-parent-id', _this.val())

      //show option in list
      $.each($(child_list), function(i,v){
         $(child_list).eq(i).find(`[option-index='${_this_index}']`).css('display','block')
      })
   }

   //store to json 
   json_child[_this_index].option_child_of = _this.val();

})


//trigger change option value
$(document).on('change',option_value,function(){

   var _this            = $(this);
   var _this_index      = _this.data('option-index');
   var _this_val_index  =  _this.data('value-index');
   var json_val         =  json_child[_this_index]

   //store data to json
   json_val.option_value[_this_val_index] = _this.val();
})


//del value
$(document).on('click',btn_del_val,function(){

   var _this             = $(this);
   var _this_index       = _this.data('option-index');
   var _this_val_index   = _this.data('value-index');
   var json_val          = json_child[_this_index];
   var _c                = confirm('are you sure, this value will be delete');


   if(_c === true){

      //remove element in array
      json_val.option_value.splice(_this_val_index,1);
      _this.parents('.parent_rm').remove();
   }

})


//del option
$(document).on('click',btn_del_option,function(){

   var _this         = $(this);
   var _this_index   = _this.data('option-index');
   var _c            = confirm('are you sure, this option will be delete');

   if(_c === true){

      //remove element in json
      delete json_child[_this_index];
      _this.parents('.option_parent_rm').remove();
   }

})


//save to DB
$(btn_save).click(function(){

   var form_data = new FormData();

   form_data.append('option_name',$('#option_name').val());
   form_data.append('json_child',JSON.stringify(json_child));
   form_data.append('id',$('#id_option').val())

   $.ajax({

      method: 'POST',
      contentType: "application/json",
      dataType: 'JSON',
      url: url,
      data: form_data,
      async: true,
      processData: false,
      contentType: false,
      cache: false,
   }).done(function(){

      location.reload()
   })
})

/**
 * !END
 */

