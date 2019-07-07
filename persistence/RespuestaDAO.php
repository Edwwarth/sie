<?php
class RespuestaDAO{
    private $idRespuesta;
    private $tipo;
    
    function RespuestaDAO($pIdRespuesta = "", $pTipo = ""){
        $this -> idRespuesta = $pIdRespuesta;
        $this -> tipo = $pTipo;
    }
    
    function insert(){
        return "insert into Respuesta(tipo)
				values('" . $this -> tipo . "')";
    }
    
    function update(){
        return "update Respuesta set
				tipo = '" . $this -> tipo . "'
				where idRespuesta = '" . $this -> idRespuesta . "'";
    }
    
    function select() {
        return "select idRespuesta, tipo
				from Respuesta
				where idRespuesta = '" . $this -> idRespuesta . "'";
    }
    
    function selectAll() {
        return "select idRespuesta, tipo
				from Respuesta";
    }
    
    function selectAllOrder($orden, $dir){
        return "select idRespuesta, tipo
				from Respuesta
				order by " . $orden . " " . $dir;
    }
    
    function search($search) {
        return "select idRespuesta, tipo
				from Respuesta
				where tipo like '%" . $search . "%'";
    }
    
    function delete(){
        return "delete from Respuesta
				where idRespuesta = '" . $this -> idRespuesta . "'";
    }
}
?>
