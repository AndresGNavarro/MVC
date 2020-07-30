<?php
//Se encarga de recoger parametros GET a través de la URL, ver a que CONTROLADOR pertenecen, cargar ese archivo/Objeto y llamar al MÉTODO correspondiente 
session_start();
//Cargamos el AUTOLOAD para tener acceso a todos los objetos, clases 
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

function showError(){
	$error = new errorController();
	$error->index();
}

//Comprobamos que llega el controlador en la URL y lo pasamos a una VARIABLE
if(isset($_GET['controller'])){
	$nombre_controlador = $_GET['controller'].'Controller';
}elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
	$nombre_controlador = controller_default;
}else{
	showError();
	exit();
}

//Comprobamos si existe la clase en el controlador  para crear el objeto
if(class_exists($nombre_controlador)){	
	$controlador = new $nombre_controlador();
	//Comprobamos si llega la ACCION y que también exista el nombre del MÉTODO para poder invoca el MÉTODO
	if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
		$action = $_GET['action'];
		$controlador->$action();
	}elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
		$action_default = action_default;
		$controlador->$action_default();
	}else{
		showError();
	}
}else{
	
	showError();
}


require_once 'views/layout/footer.php';