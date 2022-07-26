<?php
require_once 'controller/plantilla.controller.php';
require_once 'controller/usuarios.controller.php';
require_once 'controller/ventas.controller.php';

require_once 'model/usuarios.model.php';
require_once 'model/ventas.model.php';

$plantilla = new ControllerPlantilla();
$plantilla->ctrPlantilla();
