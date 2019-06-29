<?php
class ValueDAO{
	private $idValue;
	private $programaAcademico;
	private $respuesta;

	function ValueDAO($pIdValue = "", $pProgramaAcademico = "", $pRespuesta = ""){
		$this -> idValue = $pIdValue;
		$this -> programaAcademico = $pProgramaAcademico;
		$this -> respuesta = $pRespuesta;
	}

	function insert(){
		return "insert into Value(programaAcademico_idProgramaAcademico, respuesta_idRespuesta)
				values('" . $this -> programaAcademico . "', '" . $this -> respuesta . "')";
	}

	function update(){
		return "update Value set 
				programaAcademico_idProgramaAcademico = '" . $this -> programaAcademico . "',
				respuesta_idRespuesta = '" . $this -> respuesta . "'	
				where idValue = '" . $this -> idValue . "'";
	}

	function select() {
		return "select idValue, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Value
				where idValue = '" . $this -> idValue . "'";
	}

	function selectAll() {
		return "select idValue, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Value";
	}

	function selectAllByProgramaAcademico() {
		return "select idValue, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Value
				where programaAcademico_idProgramaAcademico = '" . $this -> programaAcademico . "'";
	}

	function selectAllByRespuesta() {
		return "select idValue, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Value
				where respuesta_idRespuesta = '" . $this -> respuesta . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idValue, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Value
				order by " . $orden . " " . $dir;
	}

	function selectAllByProgramaAcademicoOrder($orden, $dir) {
		return "select idValue, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Value
				where programaAcademico_idProgramaAcademico = '" . $this -> programaAcademico . "'
				order by " . $orden . " " . $dir;
	}

	function selectAllByRespuestaOrder($orden, $dir) {
		return "select idValue, programaAcademico_idProgramaAcademico, respuesta_idRespuesta
				from Value
				where respuesta_idRespuesta = '" . $this -> respuesta . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from Value
				where idValue = '" . $this -> idValue . "'";
	}
}
?>
