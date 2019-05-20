'use strict'

var _option_list = '.option_list';
var _obj_selected = {};

child_settings = child_settings.split('\n');


$(_option_list).change(function () {

   var _this = $(this);
   var _arr_selected = [];
   var name = _this.data('name');


   $.each($(_option_list), function (i, v) {

      if ($(_option_list).eq(i).data('parent') == name) {


         var list = json_option[i].option_value[_this.val()].split(',');
         var html = '<option value="" >-Select-</option>';

         list.forEach(function (v, i) {

            html += `<option>${v}</option>`;
         });

         $(_option_list).eq(i).html(html)
      }

   })

   _obj_selected[name] = _this.find('option:selected').text();

   //conver obj selected to array
   Object.values(_obj_selected).forEach((value) => {

      _arr_selected.push(value.trim().toLowerCase());
   })

   var cost = parseInt(get_cost(child_settings,_arr_selected));
   var get_price = parseInt($('#prices').data('original-price'));
   var tot = cost+get_price


   $('#prices').html(tot.toFixed(2));
   $('#prices').val(tot);
   $('#prices').attr('data-price',tot);


})


function get_cost(arr1, arr2) {

   for (var arr of arr1) {

      var _temp = arr.split('=');
      var arr_to_c = _temp[0].split('|').map((val) => {
         return val.trim().toLowerCase();
      });

      if (JSON.stringify(arr_to_c) == JSON.stringify(arr2)) {
         return _temp[1]
      }
   }
   return 0 ;
   
}