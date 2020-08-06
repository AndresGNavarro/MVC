<?php
//Entra a la ruta de los controladores a hacer un INCLUDE de cada uno de estos de manera automática
function controllers_autoload($classname){
	include 'controllers/' . $classname . '.php';
}

spl_autoload_register('controllers_autoload');