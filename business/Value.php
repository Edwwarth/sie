<?php
require_once ("persistence/ValueDAO.php");
require_once ("persistence/Connection.php");

class Value {
	private $idValue;
	private $programaAcademico;
	private $respuesta;
	private $valueDAO;
	private $connection;

	function getIdValue() {
		return $this -> idValue;
	}

	function setIdValue($pIdValue) {
		$this -> idValue = $pIdValue;
	}

	function getProgramaAcademico() {
		return $this -> programaAcademico;
	}

	function setProgramaAcademico($pProgramaAcademico) {
		$this -> programaAcademico = $pProgramaAcademico;
	}

	function getRespuesta() {
		return $this -> respuesta;
	}

	function setRespuesta($pRespuesta) {
		$this -> respuesta = $pRespuesta;
	}

	function Value($pIdValue = "", $pProgramaAcademico = "", $pRespuesta = ""){
		$this -> idValue = $pIdValue;
		$this -> programaAcademico = $pProgramaAcademico;
		$this -> respuesta = $pRespuesta;
		$this -> valueDAO = new ValueDAO($this -> idValue, $this -> programaAcademico, $this -> respuesta);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valueDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valueDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valueDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idValue = $result[0];
		$programaAcademico = new ProgramaAcademico($result[1]);
		$programaAcademico -> select();
		$this -> programaAcademico = $programaAcademico;
		$respuesta = new Respuesta($result[2]);
		$respuesta -> select();
		$this -> respuesta = $respuesta;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valueDAO -> selectAll());
		$values = array();
		while ($result = $this -> connection -> fetchRow()){
			$programaAcademico = new ProgramaAcademico($result[1]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[2]);
			$respuesta -> select();
			array_push($values, new Value($result[0], $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $values;
	}

	function selectAllByProgramaAcademico(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valueDAO -> selectAllByProgramaAcademico());
		$values = array();
		while ($result = $this -> connection -> fetchRow()){
			$programaAcademico = new ProgramaAcademico($result[1]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[2]);
			$respuesta -> select();
			array_push($values, new Value($result[0], $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $values;
	}

	function selectAllByRespuesta(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valueDAO -> selectAllByRespuesta());
		$values = array();
		while ($result = $this -> connection -> fetchRow()){
			$programaAcademico = new ProgramaAcademico($result[1]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[2]);
			$respuesta -> select();
			array_push($values, new Value($result[0], $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $values;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> valueDAO -> selectAllOrder($order, $dir));
		$values = array();
		while ($result = $this -> connection -> fetchRow()){
			$programaAcademico = new ProgramaAcademico($result[1]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[2]);
			$respuesta -> select();
			array_push($values, new Value($result[0], $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $values;
	}

	function selectAllByProgramaAcademicoOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> valueDAO -> selectAllByProgramaAcademicoOrder($order, $dir));
		$values = array();
		while ($result = $this -> connection -> fetchRow()){
			$programaAcademico = new ProgramaAcademico($result[1]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[2]);
			$respuesta -> select();
			array_push($values, new Value($result[0], $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $values;
	}

	function selectAllByRespuestaOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> valueDAO -> selectAllByRespuestaOrder($order, $dir));
		$values = array();
		while ($result = $this -> connection -> fetchRow()){
			$programaAcademico = new ProgramaAcademico($result[1]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[2]);
			$respuesta -> select();
			array_push($values, new Value($result[0], $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $values;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> valueDAO -> search($search));
		$values = array();
		while ($result = $this -> connection -> fetchRow()){
			$programaAcademico = new ProgramaAcademico($result[1]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[2]);
			$respuesta -> select();
			array_push($values, new Value($result[0], $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $values;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valueDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
