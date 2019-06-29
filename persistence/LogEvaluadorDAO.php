<?php
class LogEvaluadorDAO{
	private $idLogEvaluador;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $evaluador;

	function LogEvaluadorDAO($pIdLogEvaluador = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pEvaluador = ""){
		$this -> idLogEvaluador = $pIdLogEvaluador;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> evaluador = $pEvaluador;
	}

	function insert(){
		return "insert into LogEvaluador(accion, informacion, fecha, hora, ip, so, explorador, evaluador_idEvaluador)
				values('" . $this -> accion . "', '" . $this -> informacion . "', '" . $this -> fecha . "', '" . $this -> hora . "', '" . $this -> ip . "', '" . $this -> so . "', '" . $this -> explorador . "', '" . $this -> evaluador . "')";
	}

	function update(){
		return "update LogEvaluador set 
				accion = '" . $this -> accion . "',
				informacion = '" . $this -> informacion . "',
				fecha = '" . $this -> fecha . "',
				hora = '" . $this -> hora . "',
				ip = '" . $this -> ip . "',
				so = '" . $this -> so . "',
				explorador = '" . $this -> explorador . "',
				evaluador_idEvaluador = '" . $this -> evaluador . "'	
				where idLogEvaluador = '" . $this -> idLogEvaluador . "'";
	}

	function select() {
		return "select idLogEvaluador, accion, informacion, fecha, hora, ip, so, explorador, evaluador_idEvaluador
				from LogEvaluador
				where idLogEvaluador = '" . $this -> idLogEvaluador . "'";
	}

	function selectAll() {
		return "select idLogEvaluador, accion, informacion, fecha, hora, ip, so, explorador, evaluador_idEvaluador
				from LogEvaluador";
	}

	function selectAllByEvaluador() {
		return "select idLogEvaluador, accion, informacion, fecha, hora, ip, so, explorador, evaluador_idEvaluador
				from LogEvaluador
				where evaluador_idEvaluador = '" . $this -> evaluador . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idLogEvaluador, accion, informacion, fecha, hora, ip, so, explorador, evaluador_idEvaluador
				from LogEvaluador
				order by " . $orden . " " . $dir;
	}

	function selectAllByEvaluadorOrder($orden, $dir) {
		return "select idLogEvaluador, accion, informacion, fecha, hora, ip, so, explorador, evaluador_idEvaluador
				from LogEvaluador
				where evaluador_idEvaluador = '" . $this -> evaluador . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idLogEvaluador, accion, informacion, fecha, hora, ip, so, explorador, evaluador_idEvaluador
				from LogEvaluador
				where accion like '%" . $search . "%' or fecha like '%" . $search . "%' or hora like '%" . $search . "%' or ip like '%" . $search . "%' or so like '%" . $search . "%' or explorador like '%" . $search . "%'
				order by date desc, time desc";
	}
}
?>
