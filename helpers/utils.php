<?php 


class Utils{
	
	public static function deleteSession($name){

		if (isset($_SESSION[$name])){
			$_SESSION[$name] = null;
			unset($_SESSION[$name]);
		}
		return $name;
	}

	public static function isAdmin(){
//Esta funcion trabaja como un Middleware, se utiliza en las funciones que unicamente queremos que sean ejecutadas con un usuario logeado tipo admin
		if (!isset($_SESSION['admin'])){
			header("Location:".base_url);
		}else{
			return true;
		}
		
	}

	public static  function showCategorias(){
		require_once 'models/categoria.php';
		$categoria = new Categoria();
		$categorias = $categoria->getAll();
		return $categorias;
	}
}