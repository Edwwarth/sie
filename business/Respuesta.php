<?php
require_once ("persistence/RespuestaDAO.php");
require_once ("persistence/Connection.php");

class Respuesta {
	private $idRespuesta;
	private $tipo;
	private $valor;
	private $respuestaDAO;
	private $connection;

	function getIdRespuesta() {
		return $this -> idRespuesta;
	}

	function setIdRespuesta($pIdRespuesta) {
		$this -> idRespuesta = $pIdRespuesta;
	}

	function getTipo() {
		return $this -> tipo;
	}

	function setTipo($pTipo) {
		$this -> tipo = $pTipo;
	}

	function getValor() {
		return $this -> valor;
	}

	function setValor($pValor) {
		$this -> valor = $pValor;
	}

	function Respuesta($pIdRespuesta = "", $pTipo = "", $pValor = ""){
		$this -> idRespuesta = $pIdRespuesta;
		$this -> tipo = $pTipo;
		$this -> valor = $pValor;
		$this -> respuestaDAO = new RespuestaDAO($this -> idRespuesta, $this -> tipo, $this -> valor);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> respuestaDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> respuestaDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> respuestaDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idRespuesta = $result[0];
		$this -> tipo = $result[1];
		$this -> valor = $result[2];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> respuestaDAO -> selectAll());
		$respuestas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($respuestas, new Respuesta($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $respuestas;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> respuestaDAO -> selectAllOrder($order, $dir));
		$respuestas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($respuestas, new Respuesta($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $respuestas;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> respuestaDAO -> search($search));
		$respuestas = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($respuestas, new Respuesta($result[0], $result[1], $result[2]));
		}
		$this -> connection -> close();
		return $respuestas;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> respuestaDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
