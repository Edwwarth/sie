<?php
require_once ("persistence/EsquemaDAO.php");
require_once ("persistence/Connection.php");

class Esquema {
    private $idEsquema;
    private $pregunta;
    private $respuesta;
    private $cuestionario;
    private $esquemaDAO;
    private $connection;
    
    function getIdEsquema() {
        return $this -> idEsquema;
    }
    
    function setIdEsquema($pIdEsquema) {
        $this -> idEsquema = $pIdEsquema;
    }
    
    function getPregunta() {
        return $this -> pregunta;
    }
    
    function setPregunta($pPregunta) {
        $this -> pregunta = $pPregunta;
    }
    
    function getRespuesta() {
        return $this -> respuesta;
    }
    
    function setRespuesta($pRespuesta) {
        $this -> respuesta = $pRespuesta;
    }
    
    function getCuestionario() {
        return $this -> cuestionario;
    }
    
    function setCuestionario($pCuestionario) {
        $this -> cuestionario = $pCuestionario;
    }
    
    function Esquema($pIdEsquema = "", $pPregunta = "", $pRespuesta = "", $pCuestionario = ""){
        $this -> idEsquema = $pIdEsquema;
        $this -> pregunta = $pPregunta;
        $this -> respuesta = $pRespuesta;
        $this -> cuestionario = $pCuestionario;
        $this -> esquemaDAO = new EsquemaDAO($this -> idEsquema, $this -> pregunta, $this -> respuesta, $this -> cuestionario);
        $this -> connection = new Connection();
    }
    
    function insert(){
        $this -> connection -> open();
        $this -> connection -> run($this -> esquemaDAO -> insert());
        $this -> connection -> close();
    }
    
    function update(){
        $this -> connection -> open();
        $this -> connection -> run($this -> esquemaDAO -> update());
        $this -> connection -> close();
    }
    
    function select(){
        $this -> connection -> open();
        $this -> connection -> run($this -> esquemaDAO -> select());
        $result = $this -> connection -> fetchRow();
        $this -> connection -> close();
        $this -> idEsquema = $result[0];
        $pregunta = new Pregunta($result[1]);
        $pregunta -> select();
        $this -> pregunta = $pregunta;
        $respuesta = new Respuesta($result[2]);
        $respuesta -> select();
        $this -> respuesta = $respuesta;
        $cuestionario = new Cuestionario($result[3]);
        $cuestionario -> select();
        $this -> cuestionario = $cuestionario;
    }
    
    function selectAll(){
        $this -> connection -> open();
        $this -> connection -> run($this -> esquemaDAO -> selectAll());
        $esquemas = array();
        while ($result = $this -> connection -> fetchRow()){
            $pregunta = new Pregunta($result[1]);
            $pregunta -> select();
            $respuesta = new Respuesta($result[2]);
            $respuesta -> select();
            $cuestionario = new Cuestionario($result[3]);
            $cuestionario -> select();
            array_push($esquemas, new Esquema($result[0], $pregunta, $respuesta, $cuestionario));
        }
        $this -> connection -> close();
        return $esquemas;
    }
    
    function selectAllByPregunta(){
        $this -> connection -> open();
        $this -> connection -> run($this -> esquemaDAO -> selectAllByPregunta());
        $esquemas = array();
        while ($result = $this -> connection -> fetchRow()){
            $pregunta = new Pregunta($result[1]);
            $pregunta -> select();
            $respuesta = new Respuesta($result[2]);
            $respuesta -> select();
            $cuestionario = new Cuestionario($result[3]);
            $cuestionario -> select();
            array_push($esquemas, new Esquema($result[0], $pregunta, $respuesta, $cuestionario));
        }
        $this -> connection -> close();
        return $esquemas;
    }
    
    function selectAllByRespuesta(){
        $this -> connection -> open();
        $this -> connection -> run($this -> esquemaDAO -> selectAllByRespuesta());
        $esquemas = array();
        while ($result = $this -> connection -> fetchRow()){
            $pregunta = new Pregunta($result[1]);
            $pregunta -> select();
            $respuesta = new Respuesta($result[2]);
            $respuesta -> select();
            $cuestionario = new Cuestionario($result[3]);
            $cuestionario -> select();
            array_push($esquemas, new Esquema($result[0], $pregunta, $respuesta, $cuestionario));
        }
        $this -> connection -> close();
        return $esquemas;
    }
    
    function selectAllByCuestionario(){
        $this -> connection -> open();
        $this -> connection -> run($this -> esquemaDAO -> selectAllByCuestionario());
        $esquemas = array();
        while ($result = $this -> connection -> fetchRow()){
            $pregunta = new Pregunta($result[1]);
            $pregunta -> select();
            $respuesta = new Respuesta($result[2]);
            $respuesta -> select();
            $cuestionario = new Cuestionario($result[3]);
            $cuestionario -> select();
            array_push($esquemas, new Esquema($result[0], $pregunta, $respuesta, $cuestionario));
        }
        $this -> connection -> close();
        return $esquemas;
    }
    
    function selectAllOrder($order, $dir){
        $this -> connection -> open();
        $this -> connection -> run($this -> esquemaDAO -> selectAllOrder($order, $dir));
        $esquemas = array();
        while ($result = $this -> connection -> fetchRow()){
            $pregunta = new Pregunta($result[1]);
            $pregunta -> select();
            $respuesta = new Respuesta($result[2]);
            $respuesta -> select();
            $cuestionario = new Cuestionario($result[3]);
            $cuestionario -> select();
            array_push($esquemas, new Esquema($result[0], $pregunta, $respuesta, $cuestionario));
        }
        $this -> connection -> close();
        return $esquemas;
    }
    
    function selectAllByPreguntaOrder($order, $dir){
        $this -> connection -> open();
        $this -> connection -> run($this -> esquemaDAO -> selectAllByPreguntaOrder($order, $dir));
        $esquemas = array();
        while ($result = $this -> connection -> fetchRow()){
            $pregunta = new Pregunta($result[1]);
            $pregunta -> select();
            $respuesta = new Respuesta($result[2]);
            $respuesta -> select();
            $cuestionario = new Cuestionario($result[3]);
            $cuestionario -> select();
            array_push($esquemas, new Esquema($result[0], $pregunta, $respuesta, $cuestionario));
        }
        $this -> connection -> close();
        return $esquemas;
    }
    
    function selectAllByRespuestaOrder($order, $dir){
        $this -> connection -> open();
        $this -> connection -> run($this -> esquemaDAO -> selectAllByRespuestaOrder($order, $dir));
        $esquemas = array();
        while ($result = $this -> connection -> fetchRow()){
            $pregunta = new Pregunta($result[1]);
            $pregunta -> select();
            $respuesta = new Respuesta($result[2]);
            $respuesta -> select();
            $cuestionario = new Cuestionario($result[3]);
            $cuestionario -> select();
            array_push($esquemas, new Esquema($result[0], $pregunta, $respuesta, $cuestionario));
        }
        $this -> connection -> close();
        return $esquemas;
    }
    
    function selectAllByCuestionarioOrder($order, $dir){
        $this -> connection -> open();
        $this -> connection -> run($this -> esquemaDAO -> selectAllByCuestionarioOrder($order, $dir));
        $esquemas = array();
        while ($result = $this -> connection -> fetchRow()){
            $pregunta = new Pregunta($result[1]);
            $pregunta -> select();
            $respuesta = new Respuesta($result[2]);
            $respuesta -> select();
            $cuestionario = new Cuestionario($result[3]);
            $cuestionario -> select();
            array_push($esquemas, new Esquema($result[0], $pregunta, $respuesta, $cuestionario));
        }
        $this -> connection -> close();
        return $esquemas;
    }
    
    function search($search){
        $this -> connection -> open();
        $this -> connection -> run($this -> esquemaDAO -> search($search));
        $esquemas = array();
        while ($result = $this -> connection -> fetchRow()){
            $pregunta = new Pregunta($result[1]);
            $pregunta -> select();
            $respuesta = new Respuesta($result[2]);
            $respuesta -> select();
            $cuestionario = new Cuestionario($result[3]);
            $cuestionario -> select();
            array_push($esquemas, new Esquema($result[0], $pregunta, $respuesta, $cuestionario));
        }
        $this -> connection -> close();
        return $esquemas;
    }
    
    function delete(){
        $this -> connection -> open();
        $this -> connection -> run($this -> esquemaDAO -> delete());
        $success = $this -> connection -> querySuccess();
        $this -> connection -> close();
        return $success;
    }
}
?>
