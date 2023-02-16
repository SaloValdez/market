// Swal.fire({
//     title: "HOLA HOLITAS",
//     Text: 'Esto e sun mensaje',
//     icon: 'question',
//     confirmButtonText:'seleccionar',
//     footer:'Esto es info important',

//     // grow: 'row',
//     // grow: 'column',
//     // grow: 'fullscreen',

// timer: 5000,  //segunso que se demorea en cerrar
// timeProgressBr: true,  //se ve el bar de tiempo
// TODO: 
// toast: 'true',
// position: 'center',


// TODO: comocerrar modal con teclado
// allowOutsideClick:
// allowOutsideClick:
// allowEscapeKey: 
// allowEnterKey:
// stopKeydownPropagation:false,




// });







// Swal.fire({
//   position: 'bottom-end',
//   icon: 'success',
//   title: 'Your work has been saved',
//   showConfirmButton: false,
//   timer: 1500,
//   toast: 'true',
// })





// EXITO
// Swal.fire(
//     'Good job!',
//     'You clicked the button!',
//     'success'
//   )

  // Swal.fire(
  //   'Good job!',
  //   'You clicked the button!',
  //   'error'
  // )

                  // TODO: ESTO ES EL EJEMPOLO..........................................................................

                  // Swal.fire({
                  //   icon: 'question',
                  //   title: 'Sweet!',
                  //   text: 'Modal with a custom image.',
                
                  //   showDenyButton: true,
                  //   footer:'Esto es info important',
                  //   showCancelButton: true,
                  //   confirmButtonText: 'Save',
                  //   denyButtonText: `Don't save`,
                  // }).then((result) => {
                  //   /* Read more about isConfirmed, isDenied below */
                  //   if (result.isConfirmed) {
                  //     Swal.fire('Saved!', '', 'success')
                  //   } else if (result.isDenied) {
                  //     Swal.fire('Changes are not saved', '', 'info')
                  //   }
                  // })






// // FOOTER CON EROR
//   Swal.fire({
//     icon: 'error',
//     title: 'Oops...',
//     text: 'Something went wrong!',
//     footer: '<a href="">Why do I have this issue?</a>'
//   })

// //   CON CONDICION y confoirmacion
// Swal.fire({
//     title: 'Do you want to save the changes?',
//     showDenyButton: true,
//     showCancelButton: true,
//     confirmButtonText: 'Save',
//     denyButtonText: `Don't save`,
//   }).then((result) => {
//     /* Read more about isConfirmed, isDenied below */
//     if (result.isConfirmed) {
//       Swal.fire('Saved!', '', 'success')
//     } else if (result.isDenied) {
//       Swal.fire('Changes are not saved', '', 'info')
//     }
//   })


// // con confuirmacion 
// Swal.fire({
//     title: 'Are you sure?',
//     text: "You won't be able to revert this!",
//     icon: 'warning',
//     showCancelButton: true,
//     confirmButtonColor: '#3085d6',
//     cancelButtonColor: '#d33',
//     confirmButtonText: 'Yes, delete it!'
//   }).then((result) => {
//     if (result.isConfirmed) {
//       Swal.fire(
//         'Deleted!',
//         'Your file has been deleted.',
//         'success'
//       )
//     }
//   })

// // pasar parametro y confirmacion
// const swalWithBootstrapButtons = Swal.mixin({
//     customClass: {
//       confirmButton: 'btn btn-success',
//       cancelButton: 'btn btn-danger'
//     },
//     buttonsStyling: false
//   })
  
//   swalWithBootstrapButtons.fire({
//     title: 'Are you sure?',
//     text: "You won't be able to revert this!",
//     icon: 'warning',
//     showCancelButton: true,
//     confirmButtonText: 'Yes, delete it!',
//     cancelButtonText: 'No, cancel!',
//     reverseButtons: true
//   }).then((result) => {
//     if (result.isConfirmed) {
//       swalWithBootstrapButtons.fire(
//         'Deleted!',
//         'Your file has been deleted.',
//         'success'
//       )
//     } else if (
//       /* Read more about handling dismissals below */
//       result.dismiss === Swal.DismissReason.cancel
//     ) {
//       swalWithBootstrapButtons.fire(
//         'Cancelled',
//         'Your imaginary file is safe :)',
//         'error'
//       )
//     }
//   })

// // conimagen
// Swal.fire({
//     title: 'Sweet!',
//     text: 'Modal with a custom image.',
//     imageUrl: 'https://unsplash.it/400/200',
//     imageWidth: 400,
//     imageHeight: 200,
//     imageAlt: 'Custom image',
//   })


// //   en otra posicion
// Swal.fire({
//     position: 'center',
//     icon: 'success',
//     title: 'Your work has been saved',
//     showConfirmButton: false,
//     timer: none
//   })


// //TODO: promesas
// (async()=>{
//     const {value:pais}=await Swal.fire(
//         'Good job!',
//         'You clicked the button!',
//         'success'
//       );
//       if(pais){
//         swal.fire({
//             title: `seleccionaste ${pais}`
//         });
//       }
    
// })()

// // TODO: PERSONALIOZAR COLOR 

// customClass:{

// }

