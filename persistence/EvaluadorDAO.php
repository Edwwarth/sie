<?php
class EvaluadorDAO{
	private $idEvaluador;
	private $nombre;
	private $apellido;
	private $email;
	private $password;
	private $imagen;

	function EvaluadorDAO($pIdEvaluador = "", $pNombre = "", $pApellido = "", $pEmail = "", $pPassword = "", $pImagen = ""){
		$this -> idEvaluador = $pIdEvaluador;
		$this -> nombre = $pNombre;
		$this -> apellido = $pApellido;
		$this -> email = $pEmail;
		$this -> password = $pPassword;
		$this -> imagen = $pImagen;
	}

	function logIn($email, $password){
		return "select idEvaluador, nombre, apellido, email, password, imagen
				from Evaluador
				where email = '" . $email . "' and password = '" . md5($password) . "'";
	}

	function insert(){
		return "insert into Evaluador(nombre, apellido, email, password, imagen)
				values('" . $this -> nombre . "', '" . $this -> apellido . "', '" . $this -> email . "', md5('" . $this -> password . "'), '" . $this -> imagen . "')";
	}

	function update(){
		return "update Evaluador set 
				nombre = '" . $this -> nombre . "',
				apellido = '" . $this -> apellido . "',
				email = '" . $this -> email . "',
				imagen = '" . $this -> imagen . "'	
				where idEvaluador = '" . $this -> idEvaluador . "'";
	}

	function updatePassword($password){
		return "update Evaluador set 
				password = '" . md5($password) . "'
				where idEvaluador = '" . $this -> idEvaluador . "'";
	}

	function existEmail($email){
		return "select idEvaluador, nombre, apellido, email, password, imagen
				from Evaluador
				where email = '" . $email . "'";
	}

	function recoverPassword($email, $password){
		return "update Evaluador set 
				password = '" . md5($password) . "'
				where email = '" . $email . "'";
	}

	function updateImage($attribute, $value){
		return "update Evaluador set "
				. $attribute . " = '" . $value . "'
				where idEvaluador = '" . $this -> idEvaluador . "'";
	}

	function select() {
		return "select idEvaluador, nombre, apellido, email, password, imagen
				from Evaluador
				where idEvaluador = '" . $this -> idEvaluador . "'";
	}

	function selectAll() {
		return "select idEvaluador, nombre, apellido, email, password, imagen
				from Evaluador";
	}

	function selectAllOrder($orden, $dir){
		return "select idEvaluador, nombre, apellido, email, password, imagen
				from Evaluador
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idEvaluador, nombre, apellido, email, password, imagen
				from Evaluador
				where nombre like '%" . $search . "%' or apellido like '%" . $search . "%' or email like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Evaluador
				where idEvaluador = '" . $this -> idEvaluador . "'";
	}
}
?>
