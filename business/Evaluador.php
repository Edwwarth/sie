<?php
require_once ("persistence/EvaluadorDAO.php");
require_once ("persistence/Connection.php");

class Evaluador {
	private $idEvaluador;
	private $nombre;
	private $apellido;
	private $email;
	private $password;
	private $imagen;
	private $evaluadorDAO;
	private $connection;

	function getIdEvaluador() {
		return $this -> idEvaluador;
	}

	function setIdEvaluador($pIdEvaluador) {
		$this -> idEvaluador = $pIdEvaluador;
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

	function Evaluador($pIdEvaluador = "", $pNombre = "", $pApellido = "", $pEmail = "", $pPassword = "", $pImagen = ""){
		$this -> idEvaluador = $pIdEvaluador;
		$this -> nombre = $pNombre;
		$this -> apellido = $pApellido;
		$this -> email = $pEmail;
		$this -> password = $pPassword;
		$this -> imagen = $pImagen;
		$this -> evaluadorDAO = new EvaluadorDAO($this -> idEvaluador, $this -> nombre, $this -> apellido, $this -> email, $this -> password, $this -> imagen);
		$this -> connection = new Connection();
	}

	function logIn($email, $password){
		$this -> connection -> open();
		$this -> connection -> run($this -> evaluadorDAO -> logIn($email, $password));
		if($this -> connection -> numRows()==1){
			$result = $this -> connection -> fetchRow();
			$this -> idEvaluador = $result[0];
			$this -> nombre = $result[1];
			$this -> apellido = $result[2];
			$this -> email = $result[3];
			$this -> password = $result[4];
			$this -> imagen = $result[5];
			$this -> connection -> close();
			return true;
		}else{
			$this -> connection -> close();
			return false;
		}
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> evaluadorDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> evaluadorDAO -> update());
		$this -> connection -> close();
	}

	function updatePassword($password){
		$this -> connection -> open();
		$this -> connection -> run($this -> evaluadorDAO -> updatePassword($password));
		$this -> connection -> close();
	}

	function existEmail($email){
		$this -> connection -> open();
		$this -> connection -> run($this -> evaluadorDAO -> existEmail($email));
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
		$this -> connection -> run($this -> evaluadorDAO -> recoverPassword($email, $password));
		$this -> connection -> close();
	}

	function updateImage($attribute, $value){
		$this -> connection -> open();
		$this -> connection -> run($this -> evaluadorDAO -> updateImage($attribute, $value));
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> evaluadorDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idEvaluador = $result[0];
		$this -> nombre = $result[1];
		$this -> apellido = $result[2];
		$this -> email = $result[3];
		$this -> password = $result[4];
		$this -> imagen = $result[5];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> evaluadorDAO -> selectAll());
		$evaluadors = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($evaluadors, new Evaluador($result[0], $result[1], $result[2], $result[3], $result[4], $result[5]));
		}
		$this -> connection -> close();
		return $evaluadors;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> evaluadorDAO -> selectAllOrder($order, $dir));
		$evaluadors = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($evaluadors, new Evaluador($result[0], $result[1], $result[2], $result[3], $result[4], $result[5]));
		}
		$this -> connection -> close();
		return $evaluadors;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> evaluadorDAO -> search($search));
		$evaluadors = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($evaluadors, new Evaluador($result[0], $result[1], $result[2], $result[3], $result[4], $result[5]));
		}
		$this -> connection -> close();
		return $evaluadors;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> evaluadorDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
