

<?php
//errores solucionados
require_once "config/config.php";
require_once "model/db.php";

session_start();

$url = $_GET["url"];
// echo $url;
$url = rtrim($url, "/");
$url = explode('/',$url);

// print_r($url);

$controller = (isset($url[0]) && $url[0] != '') ? $url[0] : constant("DEFAULT_CONTROLLER");
$action = (isset($url[1])) ? $url[1] : constant("DEFAULT_ACTION");

$controller_path = 'controller/'.$controller.'.php';
// echo $controller_path;

if(!file_exists($controller_path)) $controller_path = 'controller/'.constant("DEFAULT_CONTROLLER").'.php';

require_once $controller_path;


$controllerName = $controller.'Controller'; //notesController, userController, etc
$controller = new $controllerName();

$dataView["data"] = array();

if(method_exists($controller, $action))  $dataView["data"] = $controller->{$action}(); // index(), edit(), delete()

// echo '<pre>';
// print_r($dataView["data"]);
// echo '</pre>';


require_once "views/template/header.php";
require_once "views/".$controller->view.".php";
require_once "views/template/footer.php";


?>