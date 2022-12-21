// jQuery(document).ready(function($){
//     $('#button').on('click', function(e){
//         e.preventDefault();

//         $.ajax({
//             url:genius_ajax_script.ajaxurl,
//             data: {
//                 'action' : 'genius_ajax_example',
//                 'nonce'  : genius_ajax_script.nonce,
//                 'string' : genius_ajax_script.string
//             },

//             success: function(data){
//                 $('#car_content').append(data);
//             },
//             error: function(file){
//                 console.log('file');
//             }

//         })
//     })
// });