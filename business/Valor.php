<?php
require_once ("persistence/ValorDAO.php");
require_once ("persistence/Connection.php");

class Valor {
	private $idValor;
	private $valor;
	private $pregunta;
	private $programaAcademico;
	private $respuesta;
	private $valorDAO;
	private $connection;

	function getIdValor() {
		return $this -> idValor;
	}

	function setIdValor($pIdValor) {
		$this -> idValor = $pIdValor;
	}

	function getValor() {
		return $this -> valor;
	}

	function setValor($pValor) {
		$this -> valor = $pValor;
	}

	function getPregunta() {
		return $this -> pregunta;
	}

	function setPregunta($pPregunta) {
		$this -> pregunta = $pPregunta;
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

	function Valor($pIdValor = "", $pValor = "", $pPregunta = "", $pProgramaAcademico = "", $pRespuesta = ""){
		$this -> idValor = $pIdValor;
		$this -> valor = $pValor;
		$this -> pregunta = $pPregunta;
		$this -> programaAcademico = $pProgramaAcademico;
		$this -> respuesta = $pRespuesta;
		$this -> valorDAO = new ValorDAO($this -> idValor, $this -> valor, $this -> pregunta, $this -> programaAcademico, $this -> respuesta);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valorDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valorDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valorDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idValor = $result[0];
		$this -> valor = $result[1];
		$pregunta = new Pregunta($result[2]);
		$pregunta -> select();
		$this -> pregunta = $pregunta;
		$programaAcademico = new ProgramaAcademico($result[3]);
		$programaAcademico -> select();
		$this -> programaAcademico = $programaAcademico;
		$respuesta = new Respuesta($result[4]);
		$respuesta -> select();
		$this -> respuesta = $respuesta;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valorDAO -> selectAll());
		$valors = array();
		while ($result = $this -> connection -> fetchRow()){
			$pregunta = new Pregunta($result[2]);
			$pregunta -> select();
			$programaAcademico = new ProgramaAcademico($result[3]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[4]);
			$respuesta -> select();
			array_push($valors, new Valor($result[0], $result[1], $pregunta, $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $valors;
	}

	function selectAllByPregunta(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valorDAO -> selectAllByPregunta());
		$valors = array();
		while ($result = $this -> connection -> fetchRow()){
			$pregunta = new Pregunta($result[2]);
			$pregunta -> select();
			$programaAcademico = new ProgramaAcademico($result[3]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[4]);
			$respuesta -> select();
			array_push($valors, new Valor($result[0], $result[1], $pregunta, $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $valors;
	}

	function selectAllByProgramaAcademico(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valorDAO -> selectAllByProgramaAcademico());
		$valors = array();
		while ($result = $this -> connection -> fetchRow()){
			$pregunta = new Pregunta($result[2]);
			$pregunta -> select();
			$programaAcademico = new ProgramaAcademico($result[3]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[4]);
			$respuesta -> select();
			array_push($valors, new Valor($result[0], $result[1], $pregunta, $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $valors;
	}

	function selectAllByRespuesta(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valorDAO -> selectAllByRespuesta());
		$valors = array();
		while ($result = $this -> connection -> fetchRow()){
			$pregunta = new Pregunta($result[2]);
			$pregunta -> select();
			$programaAcademico = new ProgramaAcademico($result[3]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[4]);
			$respuesta -> select();
			array_push($valors, new Valor($result[0], $result[1], $pregunta, $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $valors;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> valorDAO -> selectAllOrder($order, $dir));
		$valors = array();
		while ($result = $this -> connection -> fetchRow()){
			$pregunta = new Pregunta($result[2]);
			$pregunta -> select();
			$programaAcademico = new ProgramaAcademico($result[3]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[4]);
			$respuesta -> select();
			array_push($valors, new Valor($result[0], $result[1], $pregunta, $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $valors;
	}

	function selectAllByPreguntaOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> valorDAO -> selectAllByPreguntaOrder($order, $dir));
		$valors = array();
		while ($result = $this -> connection -> fetchRow()){
			$pregunta = new Pregunta($result[2]);
			$pregunta -> select();
			$programaAcademico = new ProgramaAcademico($result[3]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[4]);
			$respuesta -> select();
			array_push($valors, new Valor($result[0], $result[1], $pregunta, $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $valors;
	}

	function selectAllByProgramaAcademicoOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> valorDAO -> selectAllByProgramaAcademicoOrder($order, $dir));
		$valors = array();
		while ($result = $this -> connection -> fetchRow()){
			$pregunta = new Pregunta($result[2]);
			$pregunta -> select();
			$programaAcademico = new ProgramaAcademico($result[3]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[4]);
			$respuesta -> select();
			array_push($valors, new Valor($result[0], $result[1], $pregunta, $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $valors;
	}

	function selectAllByRespuestaOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> valorDAO -> selectAllByRespuestaOrder($order, $dir));
		$valors = array();
		while ($result = $this -> connection -> fetchRow()){
			$pregunta = new Pregunta($result[2]);
			$pregunta -> select();
			$programaAcademico = new ProgramaAcademico($result[3]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[4]);
			$respuesta -> select();
			array_push($valors, new Valor($result[0], $result[1], $pregunta, $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $valors;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> valorDAO -> search($search));
		$valors = array();
		while ($result = $this -> connection -> fetchRow()){
			$pregunta = new Pregunta($result[2]);
			$pregunta -> select();
			$programaAcademico = new ProgramaAcademico($result[3]);
			$programaAcademico -> select();
			$respuesta = new Respuesta($result[4]);
			$respuesta -> select();
			array_push($valors, new Valor($result[0], $result[1], $pregunta, $programaAcademico, $respuesta));
		}
		$this -> connection -> close();
		return $valors;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> valorDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
