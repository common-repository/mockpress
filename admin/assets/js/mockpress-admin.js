// (function ($) {
//   'use strict';

//   /*******************************************/
//   /* General Handler 
//   /*******************************************/
//   $(document).ready(function () {

//   });

//   // Show Side Panel
//   $(document).on("click", ".mp-register-license", function (e) {
//     e.preventDefault();
//     var license_donation = $('#license-donation').val();
//     var register_type = $(this).attr('data-action');
//     var that = this;

//     if (license_donation) {
//       $(this).text("...");

//       $.ajax({
//         url: mp_admin.ajax_url,
//         type: 'POST',
//         data: {
//           action: 'mockpress_register_template',
//           license: license_donation,
//           type: register_type,
//           security: mp_admin.ajax_nonce
//         },
//         success: function (response) {
//           console.log(response)
//           if (response.success == false) {
//             $("#license-donation").css("border", "1px solid red");
//             $("#license-donation").val("");
//             $(that).text("Register");
//           } else {
//             window.location.href += "#license";
//             location.reload();
//           }

//         }
//       });
//     } else {
//       alert("Server or Network Error");
//       location.reload();
//     }

//   });

//   // Show Side Panel
//   $(document).on("click", ".mp-remove-license", function (e) {
//     e.preventDefault();

//     var license = $(this).attr('data-license');

//     if (license) {
//       $(this).text("...");

//       $.ajax({
//         url: mp_admin.ajax_url,
//         type: 'POST',
//         data: {
//           action: 'mockpress_remove_license',
//           license: license,
//           security: mp_admin.ajax_nonce
//         },
//         success: function (response) {
//           // console.log(response);
//           location.reload();
//         }
//       });

//     } else {
//       location.reload();
//       // alert("Tolong Masukan Lisensi Template");
//     }

//   });


// })(jQuery);