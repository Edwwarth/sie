<?php
class RespuestaDAO{
	private $idRespuesta;
	private $tipo;
	private $valor;

	function RespuestaDAO($pIdRespuesta = "", $pTipo = "", $pValor = ""){
		$this -> idRespuesta = $pIdRespuesta;
		$this -> tipo = $pTipo;
		$this -> valor = $pValor;
	}

	function insert(){
		return "insert into Respuesta(tipo, valor)
				values('" . $this -> tipo . "', '" . $this -> valor . "')";
	}

	function update(){
		return "update Respuesta set 
				tipo = '" . $this -> tipo . "',
				valor = '" . $this -> valor . "'	
				where idRespuesta = '" . $this -> idRespuesta . "'";
	}

	function select() {
		return "select idRespuesta, tipo, valor
				from Respuesta
				where idRespuesta = '" . $this -> idRespuesta . "'";
	}

	function selectAll() {
		return "select idRespuesta, tipo, valor
				from Respuesta";
	}

	function selectAllOrder($orden, $dir){
		return "select idRespuesta, tipo, valor
				from Respuesta
				order by " . $orden . " " . $dir;
	}

	function delete(){
		return "delete from Respuesta
				where idRespuesta = '" . $this -> idRespuesta . "'";
	}
}
?>
