<?php
class ProgramaAcademicoDAO{
	private $idProgramaAcademico;
	private $nombre;

	function ProgramaAcademicoDAO($pIdProgramaAcademico = "", $pNombre = ""){
		$this -> idProgramaAcademico = $pIdProgramaAcademico;
		$this -> nombre = $pNombre;
	}

	function insert(){
		return "insert into ProgramaAcademico(nombre)
				values('" . $this -> nombre . "')";
	}

	function update(){
		return "update ProgramaAcademico set 
				nombre = '" . $this -> nombre . "'	
				where idProgramaAcademico = '" . $this -> idProgramaAcademico . "'";
	}

	function select() {
		return "select idProgramaAcademico, nombre
				from ProgramaAcademico
				where idProgramaAcademico = '" . $this -> idProgramaAcademico . "'";
	}

	function selectAll() {
		return "select idProgramaAcademico, nombre
				from ProgramaAcademico";
	}

	function selectAllOrder($orden, $dir){
		return "select idProgramaAcademico, nombre
				from ProgramaAcademico
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idProgramaAcademico, nombre
				from ProgramaAcademico
				where nombre like '%" . $search . "%'";
	}

	function delete(){
		return "delete from ProgramaAcademico
				where idProgramaAcademico = '" . $this -> idProgramaAcademico . "'";
	}

	function existProgramaAcademico($nombre){
		return "select idProgramaAcademico, nombre
				from ProgramaAcademico
				where nombre = '" . $nombre . "'";
	}
}
?>
