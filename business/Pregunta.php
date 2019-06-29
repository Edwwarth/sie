<?php
require_once ("persistence/PreguntaDAO.php");
require_once ("persistence/Connection.php");

class Pregunta {
	private $idPregunta;
	private $pregunta;
	private $preguntaDAO;
	private $connection;

	function getIdPregunta() {
		return $this -> idPregunta;
	}

	function setIdPregunta($pIdPregunta) {
		$this -> idPregunta = $pIdPregunta;
	}

	function getPregunta() {
		return $this -> pregunta;
	}

	function setPregunta($pPregunta) {
		$this -> pregunta = $pPregunta;
	}

	function Pregunta($pIdPregunta = "", $pPregunta = ""){
		$this -> idPregunta = $pIdPregunta;
		$this -> pregunta = $pPregunta;
		$this -> preguntaDAO = new PreguntaDAO($this -> idPregunta, $this -> pregunta);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> preguntaDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> preguntaDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> preguntaDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idPregunta = $result[0];
		$this -> pregunta = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> preguntaDAO -> selectAll());
		$preguntas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($preguntas, new Pregunta($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $preguntas;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> preguntaDAO -> selectAllOrder($order, $dir));
		$preguntas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($preguntas, new Pregunta($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $preguntas;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> preguntaDAO -> search($search));
		$preguntas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($preguntas, new Pregunta($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $preguntas;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> preguntaDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
	function getRandomQuestions(){
	    $this -> connection -> open();
	    $this -> connection -> run($this -> preguntaDAO -> getRandomQuestions());
	    $preguntas = array();
	    while ($result = $this -> connection -> fetchRow()){
	        array_push($preguntas, new Pregunta($result[0], $result[1]));
	    }
	    $this -> connection -> close();
	    return $preguntas;
	}
}
?>
