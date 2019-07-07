<?php
require_once ("persistence/RespuestaDAO.php");
require_once ("persistence/Connection.php");

class Respuesta {
    private $idRespuesta;
    private $tipo;
    private $respuestaDAO;
    private $connection;
    
    function getIdRespuesta() {
        return $this -> idRespuesta;
    }
    
    function setIdRespuesta($pIdRespuesta) {
        $this -> idRespuesta = $pIdRespuesta;
    }
    
    function getTipo() {
        return $this -> tipo;
    }
    
    function setTipo($pTipo) {
        $this -> tipo = $pTipo;
    }
    
    function Respuesta($pIdRespuesta = "", $pTipo = ""){
        $this -> idRespuesta = $pIdRespuesta;
        $this -> tipo = $pTipo;
        $this -> respuestaDAO = new RespuestaDAO($this -> idRespuesta, $this -> tipo);
        $this -> connection = new Connection();
    }
    
    function insert(){
        $this -> connection -> open();
        $this -> connection -> run($this -> respuestaDAO -> insert());
        $this -> connection -> close();
    }
    
    function update(){
        $this -> connection -> open();
        $this -> connection -> run($this -> respuestaDAO -> update());
        $this -> connection -> close();
    }
    
    function select(){
        $this -> connection -> open();
        $this -> connection -> run($this -> respuestaDAO -> select());
        $result = $this -> connection -> fetchRow();
        $this -> connection -> close();
        $this -> idRespuesta = $result[0];
        $this -> tipo = $result[1];
    }
    
    function selectAll(){
        $this -> connection -> open();
        $this -> connection -> run($this -> respuestaDAO -> selectAll());
        $respuestas = array();
        while ($result = $this -> connection -> fetchRow()){
            array_push($respuestas, new Respuesta($result[0], $result[1]));
        }
        $this -> connection -> close();
        return $respuestas;
    }
    
    function selectAllOrder($order, $dir){
        $this -> connection -> open();
        $this -> connection -> run($this -> respuestaDAO -> selectAllOrder($order, $dir));
        $respuestas = array();
        while ($result = $this -> connection -> fetchRow()){
            array_push($respuestas, new Respuesta($result[0], $result[1]));
        }
        $this -> connection -> close();
        return $respuestas;
    }
    
    function search($search){
        $this -> connection -> open();
        $this -> connection -> run($this -> respuestaDAO -> search($search));
        $respuestas = array();
        while ($result = $this -> connection -> fetchRow()){
            array_push($respuestas, new Respuesta($result[0], $result[1]));
        }
        $this -> connection -> close();
        return $respuestas;
    }
    
    function delete(){
        $this -> connection -> open();
        $this -> connection -> run($this -> respuestaDAO -> delete());
        $success = $this -> connection -> querySuccess();
        $this -> connection -> close();
        return $success;
    }
}
?>
