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
    foreach ($cuestionarios as $cuestionario) {
        $list .= getListCuestionario($cuestionario -> getIdCuestionario()) . ";";
    }
    $list = substr_replace($list, "", -1);
    print($list);
}

function getListCuestionario($idCuestionario) {
    $esquema = new Esquema("", "", "", $idCuestionario);
    $esquemas = $esquema -> selectAllByCuestionario();
    
    $objProgramaAcademico = new ProgramaAcademico();
    $objProgramaAcademico -> getIdProgramaAcademico();
    $programasAcademicos = $objProgramaAcademico -> selectAll();
    $programasAcademicosIds = array();
    foreach ($programasAcademicos as $programaAcademico){
        $programasAcademicosIds[$programaAcademico -> getIdProgramaAcademico()] = 0;
    }
    foreach ($esquemas as $currentEsquema){
        $objRespuesta = new Respuesta($currentEsquema->getRespuesta()->getIdRespuesta(), "", "");
        $objRespuesta -> select();
        $respuestaValor = $objRespuesta -> getValor();
        $objValue = new Value("","",$currentEsquema->getRespuesta()->getIdRespuesta());
        $values = $objValue -> selectAllByRespuesta();
        foreach ($values as $value){
            $programasAcademicosIds[$value->getProgramaAcademico()->getIdProgramaAcademico()] += $respuestaValor;
        }
    }
    
    $list = "";
    foreach ($programasAcademicosIds as $po){
        $list .= $po . ",";
    }
    $list = substr_replace($list, "", -3);
    return $list;
}
