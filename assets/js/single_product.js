'use strict'

var _option_list  = '.option_list';

$(_option_list).change(function(){

   var _this = $(this);
   var name  = _this.data('name');

   $.each($(_option_list), function(i,v){

      if($(_option_list).eq(i).data('parent') == name){
         
         
         var list = json_option[i].option_value[_this.val()].split(',');
         var html = '<option></option>';
        
         list.forEach(function(v,i){

            html += `<option>${v}</option>`;
         });

         $(_option_list).eq(i).html(html)
      }

      
   })
})