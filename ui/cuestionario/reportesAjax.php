<?php
$idCuestionario = "";
if (!empty($_GET['idCuestionario'])){
    $idCuestionario = $_GET['idCuestionario'];
}

if($idCuestionario != ""){
    $list = getListCuestionario($idCuestionario);
    print($list);
}else{
    $objCuestionario = new Cuestionario();
    $cuestionarios = $objCuestionario -> selectAll();
    $list = "";
    //foreach ($cuestionarios as $cuestionario) {
    for ($i = 0; $i < count($cuestionarios); $i++){
        
        $objCuestionario = new Cuestionario($cuestionarios[$i] -> getIdCuestionario());
        $objCuestionario -> select();
        $idParticipante = $objCuestionario -> getParticipante() -> getIdParticipante();
        
        $objCuestionario = new Cuestionario("", $idParticipante);
        $cuestionarios2Delete = $objCuestionario -> selectAllByParticipanteOrder("created_time", "desc");
        $ultimoCuestionario = $cuestionarios2Delete[0] -> getIdCuestionario();
        //unset($cuestionarios2Delete[0]);
        foreach ($cuestionarios2Delete as $cuestionario2Delete){
            $key = array_search($cuestionario2Delete, $cuestionarios);
            unset($cuestionarios[$key]);
        }
        //$list .= (getListCuestionario($ultimoCuestionario)) . ";";
        
        $list .= (getListCuestionario($ultimoCuestionario)) . ";";
    }
    $list = substr_replace($list, "", -1);
    /*
    $list = "";
    foreach ($cuestionarios as $cuestionario) {
        $list .= getListCuestionario($cuestionario -> getIdCuestionario()) . ";";
    }
    $list = substr_replace($list, "", -1);
    */
    print( $list);
}

function getListCuestionario($idCuestionario) {
    $objProgramaAcademico = new ProgramaAcademico();
    $programasAcademicos = $objProgramaAcademico -> selectAll();
    $programasAcademicosIds = array();
    // $programasAcademicosIds = [0 0 0 0 0 0]
    foreach ($programasAcademicos as $programaAcademico){
        $programasAcademicosIds[$programaAcademico -> getIdProgramaAcademico()] = 0;
    }
    
    $esquema = new Esquema("", "", "", $idCuestionario);
    $esquemas = $esquema -> selectAllByCuestionario();
    
    foreach ($esquemas as $currentEsquema){
        $objValor = new Valor("", "", $currentEsquema -> getPregunta() -> getIdPregunta(), "", "");
        $valores = $objValor -> selectAllByPregunta();
        foreach ($valores as $valor){
            if($valor -> getRespuesta() -> getIdRespuesta() == $currentEsquema -> getRespuesta() -> getIdRespuesta()){
                $programasAcademicosIds[$valor->getProgramaAcademico()->getIdProgramaAcademico()] += $valor -> getValor();
            }
        }
    }
    $list = "";
    foreach ($programasAcademicosIds as $po){
        $list .= $po . ",";
    }
    $list = substr_replace($list, "", -1);
    return $list;
}








