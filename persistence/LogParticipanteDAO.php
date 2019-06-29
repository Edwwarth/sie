<?php
class LogParticipanteDAO{
	private $idLogParticipante;
	private $accion;
	private $informacion;
	private $fecha;
	private $hora;
	private $ip;
	private $so;
	private $explorador;
	private $participante;

	function LogParticipanteDAO($pIdLogParticipante = "", $pAccion = "", $pInformacion = "", $pFecha = "", $pHora = "", $pIp = "", $pSo = "", $pExplorador = "", $pParticipante = ""){
		$this -> idLogParticipante = $pIdLogParticipante;
		$this -> accion = $pAccion;
		$this -> informacion = $pInformacion;
		$this -> fecha = $pFecha;
		$this -> hora = $pHora;
		$this -> ip = $pIp;
		$this -> so = $pSo;
		$this -> explorador = $pExplorador;
		$this -> participante = $pParticipante;
	}

	function insert(){
		return "insert into LogParticipante(accion, informacion, fecha, hora, ip, so, explorador, participante_idParticipante)
				values('" . $this -> accion . "', '" . $this -> informacion . "', '" . $this -> fecha . "', '" . $this -> hora . "', '" . $this -> ip . "', '" . $this -> so . "', '" . $this -> explorador . "', '" . $this -> participante . "')";
	}

	function update(){
		return "update LogParticipante set 
				accion = '" . $this -> accion . "',
				informacion = '" . $this -> informacion . "',
				fecha = '" . $this -> fecha . "',
				hora = '" . $this -> hora . "',
				ip = '" . $this -> ip . "',
				so = '" . $this -> so . "',
				explorador = '" . $this -> explorador . "',
				participante_idParticipante = '" . $this -> participante . "'	
				where idLogParticipante = '" . $this -> idLogParticipante . "'";
	}

	function select() {
		return "select idLogParticipante, accion, informacion, fecha, hora, ip, so, explorador, participante_idParticipante
				from LogParticipante
				where idLogParticipante = '" . $this -> idLogParticipante . "'";
	}

	function selectAll() {
		return "select idLogParticipante, accion, informacion, fecha, hora, ip, so, explorador, participante_idParticipante
				from LogParticipante";
	}

	function selectAllByParticipante() {
		return "select idLogParticipante, accion, informacion, fecha, hora, ip, so, explorador, participante_idParticipante
				from LogParticipante
				where participante_idParticipante = '" . $this -> participante . "'";
	}

	function selectAllOrder($orden, $dir){
		return "select idLogParticipante, accion, informacion, fecha, hora, ip, so, explorador, participante_idParticipante
				from LogParticipante
				order by " . $orden . " " . $dir;
	}

	function selectAllByParticipanteOrder($orden, $dir) {
		return "select idLogParticipante, accion, informacion, fecha, hora, ip, so, explorador, participante_idParticipante
				from LogParticipante
				where participante_idParticipante = '" . $this -> participante . "'
				order by " . $orden . " " . $dir;
	}

	function search($search) {
		return "select idLogParticipante, accion, informacion, fecha, hora, ip, so, explorador, participante_idParticipante
				from LogParticipante
				where accion like '%" . $search . "%' or fecha like '%" . $search . "%' or hora like '%" . $search . "%' or ip like '%" . $search . "%' or so like '%" . $search . "%' or explorador like '%" . $search . "%'
				order by date desc, time desc";
	}
}
?>
