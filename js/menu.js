const btnMenu = document.querySelector("#btn-contenedor-boton-menu");
const menu = document.querySelector("#mostrar-menu");


// TODO: Para mostrar y esconder menu (SMARTPHONE and TABLETS)
		btnMenu.addEventListener("click",function(e) {
			// alert("holoooo");
			menu.classList.toggle("mostrar-menu")
		});


//TODO: Para esconder  y mostrar SUBMENUS (SMARTPHONE and TABLETS)
const submenuBtn = document.querySelectorAll(".btn-submenu");
for(let  i=0; i < submenuBtn.length; i++ ){
	submenuBtn[i].addEventListener("click",function() {
				// alert('holoooddddooo');
				if(window.innerWidth < 1024){
					const subMenu = this.nextElementSibling;  //selecciona al hemano de este btn
					const height = subMenu.scrollHeight;  //obtener la altura del subMenu
				// 	alert('holo');
				
					
					if(subMenu.classList.contains("desplegar")){
						subMenu.classList.remove("desplegar");
						subMenu.removeAttribute("style");
					}else{
						subMenu.classList.add("desplegar");
						subMenu.style.height = height  + "px";
					}

				}
	});
}




// refreshCSS =() => {
// 	let links = document.getElementsByTagName('link');
// 	for (let i = 0; i < links.length; i++) {
// 			if (links[i].getAttribute('rel') == 'stylesheet') {
// 					let href = links[i].getAttribute('href')
// 																	.split('?')[0];
						
// 					let newHref = href + '?version=' 
// 											+ new Date().getMilliseconds();
						
// 					links[i].setAttribute('href', newHref);
// 			}
// 	}
// }

