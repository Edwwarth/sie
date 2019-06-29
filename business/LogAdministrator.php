<?php
require_once ("persistence/LogAdministratorDAO.php");
require_once ("persistence/Connection.php");

class LogAdministrator {
	private $idLogAdministrator;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $administrator;
	private $logAdministratorDAO;
	private $connection;

	function getIdLogAdministrator() {
		return $this -> idLogAdministrator;
	}

	function setIdLogAdministrator($pIdLogAdministrator) {
		$this -> idLogAdministrator = $pIdLogAdministrator;
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

	function getAdministrator() {
		return $this -> administrator;
	}

	function setAdministrator($pAdministrator) {
		$this -> administrator = $pAdministrator;
	}

	function LogAdministrator($pIdLogAdministrator = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pAdministrator = ""){
		$this -> idLogAdministrator = $pIdLogAdministrator;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> administrator = $pAdministrator;
		$this -> logAdministratorDAO = new LogAdministratorDAO($this -> idLogAdministrator, $this -> accion, $this -> informacion, $this -> fecha, $this -> hora, $this -> ip, $this -> so, $this -> explorador, $this -> administrator);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idLogAdministrator = $result[0];
		$this -> accion = $result[1];
		$this -> informacion = $result[2];
		$this -> fecha = $result[3];
		$this -> hora = $result[4];
		$this -> ip = $result[5];
		$this -> so = $result[6];
		$this -> explorador = $result[7];
		$administrator = new Administrator($result[8]);
		$administrator -> select();
		$this -> administrator = $administrator;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> selectAll());
		$logAdministrators = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrator = new Administrator($result[8]);
			$administrator -> select();
			array_push($logAdministrators, new LogAdministrator($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrator));
		}
		$this -> connection -> close();
		return $logAdministrators;
	}

	function selectAllByAdministrator(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> selectAllByAdministrator());
		$logAdministrators = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrator = new Administrator($result[8]);
			$administrator -> select();
			array_push($logAdministrators, new LogAdministrator($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrator));
		}
		$this -> connection -> close();
		return $logAdministrators;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> selectAllOrder($order, $dir));
		$logAdministrators = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrator = new Administrator($result[8]);
			$administrator -> select();
			array_push($logAdministrators, new LogAdministrator($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrator));
		}
		$this -> connection -> close();
		return $logAdministrators;
	}

	function selectAllByAdministratorOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> selectAllByAdministratorOrder($order, $dir));
		$logAdministrators = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrator = new Administrator($result[8]);
			$administrator -> select();
			array_push($logAdministrators, new LogAdministrator($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrator));
		}
		$this -> connection -> close();
		return $logAdministrators;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> logAdministratorDAO -> search($search));
		$logAdministrators = array();
		while ($result = $this -> connection -> fetchRow()){
			$administrator = new Administrator($result[8]);
			$administrator -> select();
			array_push($logAdministrators, new LogAdministrator($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $administrator));
		}
		$this -> connection -> close();
		return $logAdministrators;
	}
}
?>
