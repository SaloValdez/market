
<nav>
      <div class="contenedor-boton-menu" id="btn-contenedor-boton-menu">
        <button class="miboton"><i class="fas fa-bars"></i></button>
      </div>

      <ul  id="mostrar-menu">
        <li class="index"><a href="index.php">Inicio</a></li>
        <!-- <li>
          <a href="#"   class="btn-submenu">Item-2</a>
          <ul class="sub-menu">
            <li><a href="#">Sub-1</a></li>
            <li><a href="#">Sussxxxxu-2</a></li>
          </ul>
        </li> -->
        
        <li class="productos"><a href="productos">Productos</a></li>
        <li class="realizarVenta"><a href="realizarVenta">Realizar Venta</a></li>
        <li class="subCategoriasProductos"><a href="subCategoriasProductos">Sub Categorias</a></li>
        <li class="categoriasProductos"><a href="categoriasProductos">Categorias</a></li>
        <li class="empleados"><a href="empleados">Empleados</a></li>
        <li class="contactos"><a href="contactos">Contactenos</a></li>
        <li class="clientes"><a href="clientes">Clientes</a></li>

        <li class="lista-user">
          <a href="#" class="btn-submenu">Usuarios</a>
          <ul class="sub-menu sub-user">
          <li><a class="contenedor_imagen_user"href="#"><img src="views/src/img/perfil.png" alt="" srcset=""></a></li>
           
            <li><a href="#" class="contenedor_imagen_user nombre_user nombresPersonalSession"id="nombresPersonalSession1">Salomon Valdez Pacohuanaco</a></li>
            <li><a href="#">Configuracio Usuario</a></li>
            <li><a href="#">Mis Ventas</a></li>
            <li> <i class="fa-solid fa-power-off"></i> <a href="./views/modules/closeSession.php">Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
   


<!--TODO: PANEL USUARIO DESKTOP -->

      <div class="usuario">
        <div class="usuario-activo">
          
          <a href="#"> <img src="views/src/img/perfil.png" alt=""><span class="nombresPersonalSession"id="nombresPersonalSession2">Salomon Valdez Pacohuanaco</span></a>
         
        </div>
        <ul>
          <li><a href="#">Configuracio Usuario</a></li>
          <li><a href="#">Mis Ventas</a></li>
          <li><i class="fa-solid fa-power-off"></i> <a href="./views/modules/closeSession.php">Cerrar Sesion</a></li>
        </ul>
      </div>
    </nav>
    <script>

// console.log(location.href);
// console.log(location);
    url = location.href;

// url

let buscarHastaSlashPunto = url.split('.');
// let nombrePaginaPunto     = buscarHastaSlashPunto[buscarHastaSlashPunto.length - 1];
if(buscarHastaSlashPunto.length ==2){
  $('.index').css('background', 'var(--colorQuarter)');
}

  // console.log(buscarHastaSlashPunto);

 

   let buscarHastaSlash = url.split('/');
   let nombrePagina     = buscarHastaSlash[buscarHastaSlash.length - 1];
 
// console.log(nombrePagina);

  switch (nombrePagina) {
  case 'contactos':
    $('.contactos').css('background', 'var(--colorQuarter)');
    break;
  case 'productos':
    $('.productos').css('background', 'var(--colorQuarter)');
    break;
  case 'empleados':
    $('.empleados').css('background', 'var(--colorQuarter)');
    break;
  case 'categoriasProductos':
    $('.categoriasProductos').css('background', 'var(--colorQuarter)');
    break;
    case 'clientes':
    $('.clientes').css('background', 'var(--colorQuarter)');
    break;
    case 'subCategoriasProductos':
    $('.subCategoriasProductos').css('background', 'var(--colorQuarter)');
    break;
    case 'realizarVenta':
    $('.realizarVenta').css('background', 'var(--colorQuarter)');
    break;

  break;
  default:
    console.log(`Sorry, we are out of ${nombrePagina}.`);
}
    
</script>
