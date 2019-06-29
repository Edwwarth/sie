<?php
require_once ("persistence/ProgramaAcademicoDAO.php");
require_once ("persistence/Connection.php");

class ProgramaAcademico {
	private $idProgramaAcademico;
	private $nombre;
	private $programaAcademicoDAO;
	private $connection;

	function getIdProgramaAcademico() {
		return $this -> idProgramaAcademico;
	}

	function setIdProgramaAcademico($pIdProgramaAcademico) {
		$this -> idProgramaAcademico = $pIdProgramaAcademico;
	}

	function getNombre() {
		return $this -> nombre;
	}

	function setNombre($pNombre) {
		$this -> nombre = $pNombre;
	}

	function ProgramaAcademico($pIdProgramaAcademico = "", $pNombre = ""){
		$this -> idProgramaAcademico = $pIdProgramaAcademico;
		$this -> nombre = $pNombre;
		$this -> programaAcademicoDAO = new ProgramaAcademicoDAO($this -> idProgramaAcademico, $this -> nombre);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> programaAcademicoDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> programaAcademicoDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> programaAcademicoDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idProgramaAcademico = $result[0];
		$this -> nombre = $result[1];
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> programaAcademicoDAO -> selectAll());
		$programaAcademicos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($programaAcademicos, new ProgramaAcademico($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $programaAcademicos;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> programaAcademicoDAO -> selectAllOrder($order, $dir));
		$programaAcademicos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($programaAcademicos, new ProgramaAcademico($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $programaAcademicos;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> programaAcademicoDAO -> search($search));
		$programaAcademicos = array();
		while ($result = $this -> connection -> fetchRow()){
			array_push($programaAcademicos, new ProgramaAcademico($result[0], $result[1]));
		}
		$this -> connection -> close();
		return $programaAcademicos;
	}

	function delete(){
		$this -> connection -> open();
		$this -> connection -> run($this -> programaAcademicoDAO -> delete());
		$success = $this -> connection -> querySuccess();
		$this -> connection -> close();
		return $success;
	}
}
?>
