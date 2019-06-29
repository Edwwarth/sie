<?php
class EsquemaDAO{
	private $idEsquema;
	private $pregunta;
	private $respuesta;
	private $cuestionario;

	function EsquemaDAO($pIdEsquema = "", $pPregunta = "", $pRespuesta = "", $pCuestionario = ""){
		$this -> idEsquema = $pIdEsquema;
		$this -> pregunta = $pPregunta;
		$this -> respuesta = $pRespuesta;
		$this -> cuestionario = $pCuestionario;
	}

	function insert(){
		return "insert into Esquema(pregunta_idPregunta, respuesta_idRespuesta, cuestionario_idCuestionario)
				values('" . $this -> pregunta . "', '" . $this -> respuesta . "', '" . $this -> cuestionario . "')";
	}

	function update(){
		return "update Esquema set 
				pregunta_idPregunta = '" . $this -> pregunta . "',
				respuesta_idRespuesta = '" . $this -> respuesta . "',
				cuestionario_idCuestionario = '" . $this -> cuestionario . "'	
				where idEsquema = '" . $this -> idEsquema . "'";
	}

	function select() {
		return "select idEsquema, pregunta_idPregunta, respuesta_idRespuesta, cuestionario_idCuestionario
				from Esquema
				where idEsquema = '" . $this -> idEsquema . "'";
	}

	function selectAll() {
		return "select idEsquema, pregunta_idPregunta, respuesta_idRespuesta, cuestionario_idCuestionario
				from Esquema";
	}

	function selectAllByPregunta() {
		return "select idEsquema, pregunta_idPregunta, respuesta_idRespuesta, cuestionario_idCuestionario
				from Esquema
				where pregunta_idPregunta = '" . $this -> pregunta . "'";
	}

	function selectAllByRespuesta() {
		return "select idEsquema, pregunta_idPregunta, respuesta_idRespuesta, cuestionario_idCuestionario
				from Esquema
				where respuesta_idRespuesta = '" . $this -> respuesta . "'";
	}

	function selectAllByCuestionario() {
		return "select idEsquema, pregunta_idPregunta, respuesta_idRespuesta, cuestionario_idCuestionario
				from Esquema
				where cuestionario_idCuestionario = '" . $this -> cuestionario . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idEsquema, pregunta_idPregunta, respuesta_idRespuesta, cuestionario_idCuestionario
				from Esquema
				order by " . $orden . " " . $dir;
	}

	function selectAllByPreguntaOrder($orden, $dir) {
		return "select idEsquema, pregunta_idPregunta, respuesta_idRespuesta, cuestionario_idCuestionario
				from Esquema
				where pregunta_idPregunta = '" . $this -> pregunta . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByRespuestaOrder($orden, $dir) {
		return "select idEsquema, pregunta_idPregunta, respuesta_idRespuesta, cuestionario_idCuestionario
				from Esquema
				where respuesta_idRespuesta = '" . $this -> respuesta . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByCuestionarioOrder($orden, $dir) {
		return "select idEsquema, pregunta_idPregunta, respuesta_idRespuesta, cuestionario_idCuestionario
				from Esquema
				where cuestionario_idCuestionario = '" . $this -> cuestionario . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from Esquema
				where idEsquema = '" . $this -> idEsquema . "'";
	}
}
?>
