<?php
require_once ("persistence/LogParticipanteDAO.php");
require_once ("persistence/Connection.php");

class LogParticipante {
	private $idLogParticipante;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $participante;
	private $logParticipanteDAO;
	private $connection;

	function getIdLogParticipante() {
		return $this -> idLogParticipante;
	}

	function setIdLogParticipante($pIdLogParticipante) {
		$this -> idLogParticipante = $pIdLogParticipante;
	}

	function getAccion() {
		return $this -> accion;
	}

	function setAccion($pAccion) {
		$this -> accion = $pAccion;
	}

	function getInformacion() {
		return $this -> informacion;
	}

	function setInformacion($pInformacion) {
		$this -> informacion = $pInformacion;
	}

	function getFecha() {
		return $this -> fecha;
	}

	function setFecha($pFecha) {
		$this -> fecha = $pFecha;
	}

	function getHora() {
		return $this -> hora;
	}

	function setHora($pHora) {
		$this -> hora = $pHora;
	}

	function getIp() {
		return $this -> ip;
	}

	function setIp($pIp) {
		$this -> ip = $pIp;
	}

	function getSo() {
		return $this -> so;
	}

	function setSo($pSo) {
		$this -> so = $pSo;
	}

	function getExplorador() {
		return $this -> explorador;
	}

	function setExplorador($pExplorador) {
		$this -> explorador = $pExplorador;
	}

	function getParticipante() {
		return $this -> participante;
	}

	function setParticipante($pParticipante) {
		$this -> participante = $pParticipante;
	}

	function LogParticipante($pIdLogParticipante = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pParticipante = ""){
		$this -> idLogParticipante = $pIdLogParticipante;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> participante = $pParticipante;
		$this -> logParticipanteDAO = new LogParticipanteDAO($this -> idLogParticipante, $this -> accion, $this -> informacion, $this -> fecha, $this -> hora, $this -> ip, $this -> so, $this -> explorador, $this -> participante);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logParticipanteDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logParticipanteDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logParticipanteDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idLogParticipante = $result[0];
		$this -> accion = $result[1];
		$this -> informacion = $result[2];
		$this -> fecha = $result[3];
		$this -> hora = $result[4];
		$this -> ip = $result[5];
		$this -> so = $result[6];
		$this -> explorador = $result[7];
		$participante = new Participante($result[8]);
		$participante -> select();
		$this -> participante = $participante;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logParticipanteDAO -> selectAll());
		$logParticipantes = array();
		while ($result = $this -> connection -> fetchRow()){
			$participante = new Participante($result[8]);
			$participante -> select();
			array_push($logParticipantes, new LogParticipante($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $participante));
		}
		$this -> connection -> close();
		return $logParticipantes;
	}

	function selectAllByParticipante(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logParticipanteDAO -> selectAllByParticipante());
		$logParticipantes = array();
		while ($result = $this -> connection -> fetchRow()){
			$participante = new Participante($result[8]);
			$participante -> select();
			array_push($logParticipantes, new LogParticipante($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $participante));
		}
		$this -> connection -> close();
		return $logParticipantes;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logParticipanteDAO -> selectAllOrder($order, $dir));
		$logParticipantes = array();
		while ($result = $this -> connection -> fetchRow()){
			$participante = new Participante($result[8]);
			$participante -> select();
			array_push($logParticipantes, new LogParticipante($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $participante));
		}
		$this -> connection -> close();
		return $logParticipantes;
	}

	function selectAllByParticipanteOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logParticipanteDAO -> selectAllByParticipanteOrder($order, $dir));
		$logParticipantes = array();
		while ($result = $this -> connection -> fetchRow()){
			$participante = new Participante($result[8]);
			$participante -> select();
			array_push($logParticipantes, new LogParticipante($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $participante));
		}
		$this -> connection -> close();
		return $logParticipantes;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> logParticipanteDAO -> search($search));
		$logParticipantes = array();
		while ($result = $this -> connection -> fetchRow()){
			$participante = new Participante($result[8]);
			$participante -> select();
			array_push($logParticipantes, new LogParticipante($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $participante));
		}
		$this -> connection -> close();
		return $logParticipantes;
	}
}
?>
