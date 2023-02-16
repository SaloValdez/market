<?php

class RutasModel{

    public function enlacesModel($parametroGet){
        if(
           $parametroGet == 'productos'||
           $parametroGet == 'usuarios'||
           $parametroGet == 'subCategoriasProductos'||
           $parametroGet == 'categoriasProductos'||
           $parametroGet == 'empleados'||
           $parametroGet == 'contactos'||
           $parametroGet == 'realizarVenta'||
           $parametroGet == 'clientes'){

            $url = "./views/modules/".$parametroGet.".php";


        }elseif($parametroGet =="inicio"){
            $url = "./views/modules/inicio.php";
        }else{
            $url = "./views/modules/inicio.php";
        }

        return $url;

    }
}


