<?php
class ValorDAO{
	private $idValor;
	private $valor;
	private $pregunta;
	private $programaAcademico;
	private $respuesta;

	function ValorDAO($pIdValor = "", $pValor = "", $pPregunta = "", $pProgramaAcademico = "", $pRespuesta = ""){
		$this -> idValor = $pIdValor;
		$this -> valor = $pValor;
		$this -> pregunta = $pPregunta;
		$this -> programaAcademico = $pProgramaAcademico;
		$this -> respuesta = $pRespuesta;
	}

	function insert(){
		return "insert into Valor(valor, pregunta_idPregunta, programaAcademico_idProgramaAcademico, respuesta_idRespuesta)
				values('" . $this -> valor . "', '" . $this -> pregunta . "', '" . $this -> programaAcademico . "', '" . $this -> respuesta . "')";
	}

	function update(){
		return "update Valor set 
				valor = '" . $this -> valor . "',
				pregunta_idPregunta = '" . $this -> pregunta . "',
				programaAcademico_idProgramaAcademico = '" . $this -> programaAcademico . "',
				respuesta_idRespuesta = '" . $this -> respuesta . "'	
				where idValor = '" . $this -> idValor . "'";
	}

	function select() {
		return "select idValor, valor, pregunta_idPregunta, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Valor
				where idValor = '" . $this -> idValor . "'";
	}

	function selectAll() {
		return "select idValor, valor, pregunta_idPregunta, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Valor";
	}

	function selectAllByPregunta() {
		return "select idValor, valor, pregunta_idPregunta, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Valor
				where pregunta_idPregunta = '" . $this -> pregunta . "'";
	}

	function selectAllByProgramaAcademico() {
		return "select idValor, valor, pregunta_idPregunta, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Valor
				where programaAcademico_idProgramaAcademico = '" . $this -> programaAcademico . "'";
	}

	function selectAllByRespuesta() {
		return "select idValor, valor, pregunta_idPregunta, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Valor
				where respuesta_idRespuesta = '" . $this -> respuesta . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idValor, valor, pregunta_idPregunta, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Valor
				order by " . $orden . " " . $dir;
	}

	function selectAllByPreguntaOrder($orden, $dir) {
		return "select idValor, valor, pregunta_idPregunta, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Valor
				where pregunta_idPregunta = '" . $this -> pregunta . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByProgramaAcademicoOrder($orden, $dir) {
		return "select idValor, valor, pregunta_idPregunta, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Valor
				where programaAcademico_idProgramaAcademico = '" . $this -> programaAcademico . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByRespuestaOrder($orden, $dir) {
		return "select idValor, valor, pregunta_idPregunta, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Valor
				where respuesta_idRespuesta = '" . $this -> respuesta . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idValor, valor, pregunta_idPregunta, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Valor
				where valor like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Valor
				where idValor = '" . $this -> idValor . "'";
	}
}
?>
