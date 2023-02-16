










// // alert('holoo');
// var bs_modal = $('#modal_cropper');
// var imgCropper = document.getElementById('imgCropper');
// var cropper,reader,file;

// $("body").on("change", ".input-file-cropper", function(e) {
// // $(".input-file-cropper").on("change",function(e){
//     abriVentanaSmall();
//     var files = e.target.files; //nombre array detallis imagen
//     // imgCropper.src = url;
//     var done = function(url) {
//         imgCropper.src = url;
//         bs_modal.modal({backdrop: 'static', keyboard: false});
//     };

//     if (files && files.length > 0) {
//         file = files[0];
//         if (URL) {
//             done(URL.createObjectURL(file));
//         } else if (FileReader){
//             reader = new FileReader();
//             reader.onload = function(e) {
//                 done(reader.result);
//             };
//             reader.readAsDataURL(file);
//         }
//     }
// });




// bs_modal.on('shown.bs.modal', function() {

//     cropper = new Cropper(imgCropper, {
//         aspectRatio:1,
//         viewMode: 2,
//         preview: '.preview',
//     });

// }).on('hidden.bs.modal', function() {
//     // eliminando canvas (eliminando imagen de coopper)
//     cropper.destroy();
//     cropper = null;
// });




// $("#mandarImagenCropper").click(function() {
//     canvas = cropper.getCroppedCanvas({
//         // calidad imagen (tamaño)
//         width: 500,
//         height: 500,
//     });
//     canvas.toBlob(function(blob){
//         url = URL.createObjectURL(blob);

//         $("#imgPreview").attr("src",url);

//         var reader = new FileReader();
//         muc =  reader.readAsDataURL(blob);

//         reader.onloadend = function() {
//         var base64data = reader.result;
                       
//             $.ajax({
//                 type:"POST",
//                 // dataType: "json",
//                 data: {imgCropper: base64data},
//                 url:"./views/requestController/productos/img.php",
//                 success:function(r){
//                 datos=jQuery.parseJSON(r);
//                 //   console.log(datos);
//                   bs_modal.modal('hide');
//                   cerrarVentanaSmall();
//                 }
//             });
//         };
//     });
// });

// $("#cancelarImagenCropper").click(function() {
//     cerrarVentanaSmall();
//     document.querySelector(".input-file-cropper").value ="";
// });
