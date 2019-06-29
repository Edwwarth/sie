<?php
class LogAdministratorDAO{
	private $idLogAdministrator;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $administrator;

	function LogAdministratorDAO($pIdLogAdministrator = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pAdministrator = ""){
		$this -> idLogAdministrator = $pIdLogAdministrator;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> administrator = $pAdministrator;
	}

	function insert(){
		return "insert into LogAdministrator(accion, informacion, fecha, hora, ip, so, explorador, administrator_idAdministrator)
				values('" . $this -> accion . "', '" . $this -> informacion . "', '" . $this -> fecha . "', '" . $this -> hora . "', '" . $this -> ip . "', '" . $this -> so . "', '" . $this -> explorador . "', '" . $this -> administrator . "')";
	}

	function update(){
		return "update LogAdministrator set 
				accion = '" . $this -> accion . "',
				informacion = '" . $this -> informacion . "',
				fecha = '" . $this -> fecha . "',
				hora = '" . $this -> hora . "',
				ip = '" . $this -> ip . "',
				so = '" . $this -> so . "',
				explorador = '" . $this -> explorador . "',
				administrator_idAdministrator = '" . $this -> administrator . "'	
				where idLogAdministrator = '" . $this -> idLogAdministrator . "'";
	}

	function select() {
		return "select idLogAdministrator, accion, informacion, fecha, hora, ip, so, explorador, administrator_idAdministrator
				from LogAdministrator
				where idLogAdministrator = '" . $this -> idLogAdministrator . "'";
	}

	function selectAll() {
		return "select idLogAdministrator, accion, informacion, fecha, hora, ip, so, explorador, administrator_idAdministrator
				from LogAdministrator";
	}

	function selectAllByAdministrator() {
		return "select idLogAdministrator, accion, informacion, fecha, hora, ip, so, explorador, administrator_idAdministrator
				from LogAdministrator
				where administrator_idAdministrator = '" . $this -> administrator . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idLogAdministrator, accion, informacion, fecha, hora, ip, so, explorador, administrator_idAdministrator
				from LogAdministrator
				order by " . $orden . " " . $dir;
	}

	function selectAllByAdministratorOrder($orden, $dir) {
		return "select idLogAdministrator, accion, informacion, fecha, hora, ip, so, explorador, administrator_idAdministrator
				from LogAdministrator
				where administrator_idAdministrator = '" . $this -> administrator . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idLogAdministrator, accion, informacion, fecha, hora, ip, so, explorador, administrator_idAdministrator
				from LogAdministrator
				where accion like '%" . $search . "%' or fecha like '%" . $search . "%' or hora like '%" . $search . "%' or ip like '%" . $search . "%' or so like '%" . $search . "%' or explorador like '%" . $search . "%'
				order by date desc, time desc";
	}
}
?>
