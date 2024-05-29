// require([
//         'jquery',
//         'mage/translate',
//         'jquery/validate'
//     ],
//     function($) {
//         "use strict";
//         console.log(111)
//
//         $.extend(true, $, {
//             default:{
//               template: 'Legacy_Popup/template/option_responsive'
//             },
//             mage: {
//
//             },
//
//             addOption: function (){
//                 // console.log(op_responsive)
//                 console.log(1)
//             }
//         });
//
//         function addOption(){
//             // console.log(op_responsive)
//             console.log(1)
//         }
//
//     },
//
//     function addOption(){
//         // console.log(op_responsive)
//         console.log(1)
//     }
// );

// require(["jquery"], function ($) {
//     $(document).ready(function () {
//         console.log('Your JavaScript is running.');
//     });
// });


function addOption(){

    let tmp = '<tr class="new-option">\n' +
        '    <td class="col-default">\n' +
        '        <input name="option[value][option_{{idx}}][{{idx}}]" value="" class="input-text admin__control-text" type="text">\n' +
        '    </td>\n' +
        '    <td id="delete_button_container_option_{{idx}}" class="col-delete">\n' +
        '        <input type="hidden" class="delete-flag" name="option[delete][option_{{idx}}]" value="">\n' +
        '        <button id="delete_button_option_{{idx}}" title="Delete" type="button" class="action- scalable delete delete-option">\n' +
        '            <span>Delete</span>\n' +
        '        </button>\n' +
        '    </td>\n' +
        '</tr>'

    document.querySelector(".ignore-validate").insertAdjacentHTML('beforeend', tmp);
}
