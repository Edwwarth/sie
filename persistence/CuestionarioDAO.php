<?php
class CuestionarioDAO{
	private $idCuestionario;
	private $participante;

	function CuestionarioDAO($pIdCuestionario = "", $pParticipante = ""){
		$this -> idCuestionario = $pIdCuestionario;
		$this -> participante = $pParticipante;
	}

	function insert(){
		return "insert into Cuestionario(participante_idParticipante)
				values('" . $this -> participante . "')";
	}

	function update(){
		return "update Cuestionario set 
				participante_idParticipante = '" . $this -> participante . "'	
				where idCuestionario = '" . $this -> idCuestionario . "'";
	}

	function select() {
		return "select idCuestionario, participante_idParticipante
				from Cuestionario
				where idCuestionario = '" . $this -> idCuestionario . "'";
	}

	function selectAll() {
		return "select idCuestionario, participante_idParticipante
				from Cuestionario";
	}

	function selectAllByParticipante() {
		return "select idCuestionario, participante_idParticipante
				from Cuestionario
				where participante_idParticipante = '" . $this -> participante . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idCuestionario, participante_idParticipante
				from Cuestionario
				order by " . $orden . " " . $dir;
	}

	function selectAllByParticipanteOrder($orden, $dir) {
		return "select idCuestionario, participante_idParticipante
				from Cuestionario
				where participante_idParticipante = '" . $this -> participante . "'
				order by " . $orden . " " . $dir;
	}
	function search($search) {
	    return "select idCuestionario, participante_idParticipante
				from Cuestionario
				where idCuestionario like '%" . $search . "%'";
	}

	function delete(){
		return "delete from Cuestionario
				where idCuestionario = '" . $this -> idCuestionario . "'";
	}
	
	function getNextAuto(){
	    return "select AUTO_INCREMENT from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA = 'sie26' and TABLE_NAME = 'Cuestionario'";
	}
}
?>
