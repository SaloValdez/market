<?php

require_once "./models/rutasModel.php";

class RutasController extends RutasModel{
    public function mostrarPlantillaController(){
        include "./views/template.php";
    }

 

    public function enlacesController(){
       

        if(isset($_GET['variableWeb'])){
            $variableGET = $_GET['variableWeb'];
          
        }else{
            $variableGET = "inicio";
        }

        $respuesta = RutasModel::enlacesModel($variableGET);
        include $respuesta;


    }

}

// $obj = new RutasController();
// $obj->enlacesController();