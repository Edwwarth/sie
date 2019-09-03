<?php
class ParticipanteDAO{
	private $idParticipante;
	private $nombre;
	private $apellido;
	private $email;
	private $password;
	private $imagen;
	private $identification;

	function ParticipanteDAO($pIdParticipante = "", $pNombre = "", $pApellido = "", $pEmail = "", $pPassword = "", $pIdentification = "", $pImagen = ""){
		$this -> idParticipante = $pIdParticipante;
		$this -> nombre = $pNombre;
		$this -> apellido = $pApellido;
		$this -> email = $pEmail;
		$this -> password = $pPassword;
		$this -> imagen = $pImagen;
		$this -> identification = $pIdentification;
	}

	function logIn($email, $password){
		return "select idParticipante, nombre, apellido, email, password, identification, imagen
				from Participante
				where email = '" . $email . "' and password = '" . md5($password) . "'";
	}

	function insert(){
		return "insert into Participante(nombre, apellido, email, password, identification, imagen)
				values('" . $this -> nombre . "', '" . $this -> apellido . "', '" . $this -> email . "', md5('" . $this -> password . "'), '" . $this -> identification . "', " . $this -> imagen . "')";
	}

	function update(){
		return "update Participante set 
				nombre = '" . $this -> nombre . "',
				apellido = '" . $this -> apellido . "',
				email = '" . $this -> email . "',
				imagen = '" . $this -> imagen . "',
				identification = '" . $this -> identification . "'	
				where idParticipante = '" . $this -> idParticipante . "'";
	}

	function updatePassword($password){
		return "update Participante set 
				password = '" . md5($password) . "'
				where idParticipante = '" . $this -> idParticipante . "'";
	}

	function existEmail($email){
		return "select idParticipante, nombre, apellido, email, password, identification, imagen
				from Participante
				where email = '" . $email . "'";
	}

	function recoverPassword($email, $password){
		return "update Participante set 
				password = '" . md5($password) . "'
				where email = '" . $email . "'";
	}

	function updateImage($attribute, $value){
		return "update Participante set "
				. $attribute . " = '" . $value . "'
				where idParticipante = '" . $this -> idParticipante . "'";
	}

	function select() {
		return "select idParticipante, nombre, apellido, email, password, identification, imagen
				from Participante
				where idParticipante = '" . $this -> idParticipante . "'";
	}

	function selectAll() {
		return "select idParticipante, nombre, apellido, email, password, identification, imagen
				from Participante";
	}

	function selectAllOrder($orden, $dir){
		return "select idParticipante, nombre, apellido, email, password, identification, imagen
				from Participante
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idParticipante, nombre, apellido, email, password, identification, imagen
				from Participante
				where nombre like '%" . $search . "%' or apellido like '%" . $search . "%' or email like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Participante
				where idParticipante = '" . $this -> idParticipante . "'";
	}
}
?>
