<?php
class CuestionarioDAO{
	private $idCuestionario;
	private $respuesta;
	private $participante;

	function CuestionarioDAO($pIdCuestionario = "", $pRespuesta = "", $pParticipante = ""){
		$this -> idCuestionario = $pIdCuestionario;
		$this -> respuesta = $pRespuesta;
		$this -> participante = $pParticipante;
	}

	function insert(){
		return "insert into Cuestionario(respuesta, participante_idParticipante)
				values('" . $this -> respuesta . "', '" . $this -> participante . "')";
	}

	function update(){
		return "update Cuestionario set 
				respuesta = '" . $this -> respuesta . "',
				participante_idParticipante = '" . $this -> participante . "'	
				where idCuestionario = '" . $this -> idCuestionario . "'";
	}

	function select() {
		return "select idCuestionario, respuesta, participante_idParticipante
				from Cuestionario
				where idCuestionario = '" . $this -> idCuestionario . "'";
	}

	function selectAll() {
		return "select idCuestionario, respuesta, participante_idParticipante
				from Cuestionario";
	}

	function selectAllByParticipante() {
		return "select idCuestionario, respuesta, participante_idParticipante
				from Cuestionario
				where participante_idParticipante = '" . $this -> participante . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idCuestionario, respuesta, participante_idParticipante
				from Cuestionario
				order by " . $orden . " " . $dir;
	}

	function selectAllByParticipanteOrder($orden, $dir) {
		return "select idCuestionario, respuesta, participante_idParticipante
				from Cuestionario
				where participante_idParticipante = '" . $this -> participante . "'
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from Cuestionario
				where idCuestionario = '" . $this -> idCuestionario . "'";
	}
	function getNextAuto(){
	    return "select AUTO_INCREMENT from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA = 'sie23' and TABLE_NAME = 'Cuestionario'";
	}
}
?>
