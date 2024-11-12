<?php
/**
 * Archivo principal de la aplicación.
 * 
 * Se encarga de cargar el controlador y la vista necesarias en función de las acciones y controladores solicitados.
 * 
 * @author Oier Albeniz
 * @author Leire de las Heras
 * @author Joseba Fernández
 * 
 * @copyright (c) 2024, Oier Albeniz, Leire de las Heras, Joseba Fernández
 */

session_start();

require_once "config/config.php";
require_once "model/db.php";

if(!isset($_GET["controller"])) $_GET["controller"] = constant("DEFAULT_CONTROLLER");
if(!isset($_GET["action"])) $_GET["action"] = constant("DEFAULT_ACTION");

$controller_path = "controller/" .$_GET["controller"]."Controller.php";
if(!file_exists($controller_path)) $controller_path =
    "controller/".constant("DEFAULT_CONTROLLER")."Controller.php";

require_once $controller_path;
$controllerName = $_GET["controller"]."Controller";
$controller = new $controllerName();

// Variable para manejar peticiones asincronas
$isAjaxRequest = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';

$dataToView["data"] = array();
if(method_exists($controller, $_GET["action"])) $dataToView["data"] = $controller -> {$_GET["action"]}();

if($isAjaxRequest){
    echo json_encode($dataToView["data"]);
    exit();
}

if ($_GET["action"] != "login" && $_GET["action"] != "register") {
    require_once "view/layout/header.php";
}

require_once "view/".$_GET["controller"]."/".$controller->view.".html.php";


//FOOTER QUITADO POR QUE DA PROBLEMAS CUANDO EL CONTENIDO ES MAYOR QUE LA PANTALLA

if ($_GET["action"] != "login" && $_GET["action"] != "register") {
    require_once "view/layout/footer.php";
}
