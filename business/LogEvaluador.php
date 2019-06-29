<?php
require_once ("persistence/LogEvaluadorDAO.php");
require_once ("persistence/Connection.php");

class LogEvaluador {
	private $idLogEvaluador;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $evaluador;
	private $logEvaluadorDAO;
	private $connection;

	function getIdLogEvaluador() {
		return $this -> idLogEvaluador;
	}

	function setIdLogEvaluador($pIdLogEvaluador) {
		$this -> idLogEvaluador = $pIdLogEvaluador;
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

	function getEvaluador() {
		return $this -> evaluador;
	}

	function setEvaluador($pEvaluador) {
		$this -> evaluador = $pEvaluador;
	}

	function LogEvaluador($pIdLogEvaluador = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pEvaluador = ""){
		$this -> idLogEvaluador = $pIdLogEvaluador;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> evaluador = $pEvaluador;
		$this -> logEvaluadorDAO = new LogEvaluadorDAO($this -> idLogEvaluador, $this -> accion, $this -> informacion, $this -> fecha, $this -> hora, $this -> ip, $this -> so, $this -> explorador, $this -> evaluador);
		$this -> connection = new Connection();
	}

	function insert(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEvaluadorDAO -> insert());
		$this -> connection -> close();
	}

	function update(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEvaluadorDAO -> update());
		$this -> connection -> close();
	}

	function select(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEvaluadorDAO -> select());
		$result = $this -> connection -> fetchRow();
		$this -> connection -> close();
		$this -> idLogEvaluador = $result[0];
		$this -> accion = $result[1];
		$this -> informacion = $result[2];
		$this -> fecha = $result[3];
		$this -> hora = $result[4];
		$this -> ip = $result[5];
		$this -> so = $result[6];
		$this -> explorador = $result[7];
		$evaluador = new Evaluador($result[8]);
		$evaluador -> select();
		$this -> evaluador = $evaluador;
	}

	function selectAll(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEvaluadorDAO -> selectAll());
		$logEvaluadors = array();
		while ($result = $this -> connection -> fetchRow()){
			$evaluador = new Evaluador($result[8]);
			$evaluador -> select();
			array_push($logEvaluadors, new LogEvaluador($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $evaluador));
		}
		$this -> connection -> close();
		return $logEvaluadors;
	}

	function selectAllByEvaluador(){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEvaluadorDAO -> selectAllByEvaluador());
		$logEvaluadors = array();
		while ($result = $this -> connection -> fetchRow()){
			$evaluador = new Evaluador($result[8]);
			$evaluador -> select();
			array_push($logEvaluadors, new LogEvaluador($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $evaluador));
		}
		$this -> connection -> close();
		return $logEvaluadors;
	}

	function selectAllOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEvaluadorDAO -> selectAllOrder($order, $dir));
		$logEvaluadors = array();
		while ($result = $this -> connection -> fetchRow()){
			$evaluador = new Evaluador($result[8]);
			$evaluador -> select();
			array_push($logEvaluadors, new LogEvaluador($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $evaluador));
		}
		$this -> connection -> close();
		return $logEvaluadors;
	}

	function selectAllByEvaluadorOrder($order, $dir){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEvaluadorDAO -> selectAllByEvaluadorOrder($order, $dir));
		$logEvaluadors = array();
		while ($result = $this -> connection -> fetchRow()){
			$evaluador = new Evaluador($result[8]);
			$evaluador -> select();
			array_push($logEvaluadors, new LogEvaluador($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $evaluador));
		}
		$this -> connection -> close();
		return $logEvaluadors;
	}

	function search($search){
		$this -> connection -> open();
		$this -> connection -> run($this -> logEvaluadorDAO -> search($search));
		$logEvaluadors = array();
		while ($result = $this -> connection -> fetchRow()){
			$evaluador = new Evaluador($result[8]);
			$evaluador -> select();
			array_push($logEvaluadors, new LogEvaluador($result[0], $result[1], $result[2], $result[3], $result[4], $result[5], $result[6], $result[7], $evaluador));
		}
		$this -> connection -> close();
		return $logEvaluadors;
	}
}
?>
