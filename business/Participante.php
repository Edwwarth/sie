<?php
require_once ("persistence/ParticipanteDAO.php");
require_once ("persistence/Connection.php");

class Participante {
	private $idParticipante;
	private $nombre;
	private $apellido;
	private $email;
	private $password;
	private $imagen;
	private $participanteDAO;
	private $connection;
	private $identification;

	function getIdParticipante() {
		return $this -> idParticipante;
	}

	function setIdParticipante($pIdParticipante) {
		$this -> idParticipante = $pIdParticipante;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function getApellido() {
		return $this -> apellido;
	}

	function setApellido($pApellido) {
		$this -> apellido = $pApellido;
	}

	function getEmail() {
		return $this -> email;
	}

	function setEmail($pEmail) {
		$this -> email = $pEmail;
	}

	function getPassword() {
		return $this -> password;
	}

	function setPassword($pPassword) {
		$this -> password = $pPassword;
	}

	function getImagen() {
		return $this -> imagen;
	}

	function setImagen($pImagen) {
		$this -> imagen = $pImagen;
	}

	function getIdentification() {
		return $this -> identification;
	}

	function setIdentification($pIdentification) {
		$this -> identification = $pIdentification;
	}

	function Participante($pIdParticipante = "", $pNombre = "", $pApellido = "", $pEmail = "", $pPassword = "", $pIdentification = "", $pImagen = ""){
		$this -> idParticipante = $pIdParticipante;
		$this -> nombre = $pNombre;
		$this -> apellido = $pApellido;
		$this -> email = $pEmail;
		$this -> password = $pPassword;
		$this -> identification = $pIdentification;
		$this -> imagen = $pImagen;
		$this -> participanteDAO = new ParticipanteDAO($this -> idParticipante, $this -> nombre, $this -> apellido, $this -> email, $this -> password, $this -> identification, $this -> imagen);
		$this -> connection = new Connection();
	}

	function logIn($email, $password){
		$this -> connection -> open();
		$this -> connection -> run($this -> participanteDAO -> logIn($email, $password));
		if($this -> connection -> numRows()==1){
			$result = $this -> connection -> fetchRow();
			$this -> idParticipante = $result[0];
			$this -> nombre = $result[1];
			$this -> apellido = $result[2];
			$this -> email = $result[3];
			$this -> password = $result[4];
			$this -> identification = $result[5];
			$this -> imagen = $result[6];
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> participanteDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> participanteDAO -> update());
		$this -> connection -> close();
	}

	function updatePassword($password){
		$this -> connection -> open();
		$this -> connection -> run($this -> participanteDAO -> updatePassword($password));
		$this -> connection -> close();
	}

	function existEmail($email){
		$this -> connection -> open();
		$this -> connection -> run($this -> participanteDAO -> existEmail($email));
		if($this -> connection -> numRows()==1){
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
	}

	function recoverPassword($email, $password){
		$this -> connection -> open();
		$this -> connection -> run($this -> participanteDAO -> recoverPassword($email, $password));
		$this -> connection -> close();
	}

	function updateImage($attribute, $value){
		$this -> connection -> open();
		$this -> connection -> run($this -> participanteDAO -> updateImage($attribute, $value));
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> participanteDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idParticipante = $result[0];
		$this -> nombre = $result[1];
		$this -> apellido = $result[2];
		$this -> email = $result[3];
		$this -> password = $result[4];
		$this -> identification = $result[5];
		$this -> imagen = $result[6];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> participanteDAO -> selectAll());
		$participantes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($participantes, new Participante($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6]));
		}
		$this -> connection -> close();
		return $participantes;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> participanteDAO -> selectAllOrder($order, $dir));
		$participantes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($participantes, new Participante($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6]));
		}
		$this -> connection -> close();
		return $participantes;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> participanteDAO -> search($search));
		$participantes = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($participantes, new Participante($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6]));
		}
		$this -> connection -> close();
		return $participantes;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> participanteDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
