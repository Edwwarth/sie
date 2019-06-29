<?php
require_once ("persistence/CuestionarioDAO.php");
require_once ("persistence/Connection.php");

class Cuestionario {
	private $idCuestionario;
	private $respuesta;
	private $participante;
	private $cuestionarioDAO;
	private $connection;

	function getIdCuestionario() {
		return $this -> idCuestionario;
	}

	function setIdCuestionario($pIdCuestionario) {
		$this -> idCuestionario = $pIdCuestionario;
	}

	function getRespuesta() {
		return $this -> respuesta;
	}

	function setRespuesta($pRespuesta) {
		$this -> respuesta = $pRespuesta;
	}

	function getParticipante() {
		return $this -> participante;
	}

	function setParticipante($pParticipante) {
		$this -> participante = $pParticipante;
	}

	function Cuestionario($pIdCuestionario = "", $pRespuesta = "", $pParticipante = ""){
		$this -> idCuestionario = $pIdCuestionario;
		$this -> respuesta = $pRespuesta;
		$this -> participante = $pParticipante;
		$this -> cuestionarioDAO = new CuestionarioDAO($this -> idCuestionario, $this -> respuesta, $this -> participante);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cuestionarioDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cuestionarioDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cuestionarioDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idCuestionario = $result[0];
		$this -> respuesta = $result[1];
		$participante = new Participante($result[2]);
		$participante -> select();
		$this -> participante = $participante;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cuestionarioDAO -> selectAll());
		$cuestionarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$participante = new Participante($result[2]);
			$participante -> select();
			array_push($cuestionarios, new Cuestionario($result[0], $result[1], $participante));
		}
		$this -> connection -> close();
		return $cuestionarios;
	}

	function selectAllByParticipante(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cuestionarioDAO -> selectAllByParticipante());
		$cuestionarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$participante = new Participante($result[2]);
			$participante -> select();
			array_push($cuestionarios, new Cuestionario($result[0], $result[1], $participante));
		}
		$this -> connection -> close();
		return $cuestionarios;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> cuestionarioDAO -> selectAllOrder($order, $dir));
		$cuestionarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$participante = new Participante($result[2]);
			$participante -> select();
			array_push($cuestionarios, new Cuestionario($result[0], $result[1], $participante));
		}
		$this -> connection -> close();
		return $cuestionarios;
	}

	function selectAllByParticipanteOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> cuestionarioDAO -> selectAllByParticipanteOrder($order, $dir));
		$cuestionarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$participante = new Participante($result[2]);
			$participante -> select();
			array_push($cuestionarios, new Cuestionario($result[0], $result[1], $participante));
		}
		$this -> connection -> close();
		return $cuestionarios;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> cuestionarioDAO -> search($search));
		$cuestionarios = array();
		while ($result = $this -> connection -> fetchRow()){
			$participante = new Participante($result[2]);
			$participante -> select();
			array_push($cuestionarios, new Cuestionario($result[0], $result[1], $participante));
		}
		$this -> connection -> close();
		return $cuestionarios;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> cuestionarioDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
	function getNextAutoI(){
	    $this -> connection -> open();
	    $this -> connection ->run($this -> cuestionarioDAO -> getNextAuto());
	    $result = $this -> connection -> fetchRow();
	    $this -> connection -> close();
	    return $result;
	}
}
?>
