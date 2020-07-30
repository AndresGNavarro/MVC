<?php  

class Usuario {
	private $id;
	private $nombre;
	private $apellidos;
	private $email;
	private $password;
	private $rol;
	private $imagen;
	private $db;

	public function __construct() {
		$this->db = Database::connect();
	}

	function getId(){
		return $this->id;
	}

	function getNombre(){
		return $this->nombre;
	}

	function getApellidos(){
		return $this->apellidos;
	}

	function getEmail(){
		return $this->email;
	}

	function getPassword(){
		return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
	}

	function getRol(){
		return $this->rol;
	}

	function getImagen(){
		return $this->imagen;
	}

	function setId($id){
		$this->id = $this->db->real_escape_string($id);
	}

	function setNombre($nombre){
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setApellidos($apellidos){
		$this->apellidos = $this->db->real_escape_string($apellidos);
	}

	function setEmail($email){
		$this->email = $this->db->real_escape_string($email);
	}

	function setPassword($password){
		$this->password = $password;
	}

	function setRol($rol){
		$this->rol = $rol;
	}

	function setImagen($imagen){
		$this->imagen = $imagen;
	}

	public function save(){
		$sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', 'NULL')";
		$save = $this->db->query($sql);

		$result = false;
		if ($save) {
			$result = true;
		}
		return $result;

	}

	public function login(){
		$result = false;
		$email = $this->email;
		$password = $this->password;
		//Comprobar existe usuario contando los rows que devuelve la consulta
		$sql = "SELECT * FROM usuarios WHERE email = '$email'";
		$login = $this->db->query($sql);

		if ($login && $login->num_rows == 1) {
			//Fetch_object crea un objeto a partir de la fila actual
			$usuario = $login->fetch_object();

			//Verificar la contraseña; Passwordverify compara la contraseña con un hash
			$verify = password_verify($password, $usuario->password);
			if ($verify) {
				$result = $usuario;
			}
		}

		//En caso de ser confirmado devolvemos el objeto
		return $result;
	}

}