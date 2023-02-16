<?php


require_once "../../../controllers/subcategoria_producto_controller.php";
require_once "../../../models/subcategoria_producto_model.php";

require_once "../../../controllers/empleado_controller.php";
require_once "../../../models/empleado_model.php";

require_once "../../../controllers/categoria_producto_controller.php";
require_once "../../../models/categoria_producto_model.php";

$obj = new SubCategoriaProductoController();
$resultado = $obj->listarSubCategoriaProductoController();


    











