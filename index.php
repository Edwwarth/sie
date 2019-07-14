<?php 
session_start();
require("business/Administrator.php");
require("business/LogAdministrator.php");
require("business/LogEvaluador.php");
require("business/Evaluador.php");
require("business/LogParticipante.php");
require("business/Participante.php");
require("business/ProgramaAcademico.php");
require("business/Esquema.php");
require("business/Value.php");
require("business/Valor.php");
require("business/Respuesta.php");
require("business/Pregunta.php");
require("business/Cuestionario.php");
ini_set("display_errors","1");
date_default_timezone_set("America/Bogota");
$webPages = array(
	'ui/recoverPassword.php',
	'ui/sessionAdministrator.php',
	'ui/administrator/insertAdministrator.php',
	'ui/administrator/updateAdministrator.php',
	'ui/administrator/selectAllAdministrator.php',
	'ui/administrator/searchAdministrator.php',
	'ui/administrator/updateProfileAdministrator.php',
	'ui/administrator/updatePasswordAdministrator.php',
	'ui/administrator/updatePictureAdministrator.php',
	'ui/logAdministrator/searchLogAdministrator.php',
	'ui/logEvaluador/searchLogEvaluador.php',
	'ui/sessionEvaluador.php',
	'ui/evaluador/insertEvaluador.php',
	'ui/evaluador/updateEvaluador.php',
	'ui/evaluador/selectAllEvaluador.php',
	'ui/evaluador/searchEvaluador.php',
	'ui/evaluador/updateProfileEvaluador.php',
	'ui/evaluador/updatePasswordEvaluador.php',
	'ui/evaluador/updateImagenEvaluador.php',
	'ui/logParticipante/searchLogParticipante.php',
	'ui/sessionParticipante.php',
	'ui/participante/insertParticipante.php',
	'ui/participante/updateParticipante.php',
	'ui/participante/selectAllParticipante.php',
	'ui/participante/searchParticipante.php',
	'ui/participante/updateProfileParticipante.php',
	'ui/participante/updatePasswordParticipante.php',
	'ui/cuestionario/selectAllCuestionarioByParticipante.php',
	'ui/participante/updateImagenParticipante.php',
	'ui/programaAcademico/insertProgramaAcademico.php',
	'ui/programaAcademico/updateProgramaAcademico.php',
	'ui/programaAcademico/selectAllProgramaAcademico.php',
	'ui/programaAcademico/searchProgramaAcademico.php',
	'ui/value/selectAllValueByProgramaAcademico.php',
	'ui/esquema/insertEsquema.php',
	'ui/esquema/updateEsquema.php',
	'ui/esquema/selectAllEsquema.php',
	'ui/esquema/searchEsquema.php',
	'ui/value/insertValue.php',
	'ui/value/updateValue.php',
	'ui/value/selectAllValue.php',
    'ui/value/searchValue.php',
	'ui/respuesta/insertRespuesta.php',
	'ui/respuesta/updateRespuesta.php',
	'ui/respuesta/selectAllRespuesta.php',
	'ui/respuesta/searchRespuesta.php',
	'ui/esquema/selectAllEsquemaByRespuesta.php',
	'ui/value/selectAllValueByRespuesta.php',
	'ui/pregunta/insertPregunta.php',
	'ui/pregunta/updatePregunta.php',
	'ui/pregunta/selectAllPregunta.php',
	'ui/pregunta/searchPregunta.php',
	'ui/esquema/selectAllEsquemaByPregunta.php',
	'ui/cuestionario/insertCuestionario.php',
	'ui/cuestionario/updateCuestionario.php',
	'ui/cuestionario/selectAllCuestionario.php',
	'ui/cuestionario/searchCuestionario.php',
	'ui/esquema/selectAllEsquemaByCuestionario.php',
    'ui/participante/reporteIndividual.php',
    'ui/cuestionario/reportAllCuestionarios.php',
    'ui/cuestionario/detailCuestionario.php',
);
if(isset($_GET['logOut'])){
	$_SESSION['id']="";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Este sistema de información gestiona la información de encuestas.">
		<meta name="author" content="Sara">
		<meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
		<title>Sistema de información y gestion de encuestas.</title>

		<link href="vendors/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
		<link href="vendors/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.0/css/simple-line-icons.css" rel="stylesheet">

		<link href="css/style.css" rel="stylesheet">
		<link href="vendors/pace-progress/css/pace.min.css" rel="stylesheet">

		<!-- Original content -->
		<link rel="icon" type="image/png" href="img/logo.png" />
		<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" /> -->
		<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
		<link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" />
		<link href="css/open-iconic-bootstrap.css" rel="stylesheet" />
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.js"></script>
		<script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
		<script src="js/validator.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
		<script charset="utf-8">
			$(function () {
				$("[data-toggle='tooltip']").tooltip();
			});
		</script>
	</head>

	<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
	
	<?php
	if (empty($_GET['pid'])) {
		echo "<script>document.getElementsByTagName('body')[0].className='app flex-row align-items-center'</script>";
		include ('ui/home.php');
	}else{
		$pid=base64_decode($_GET['pid']);
		if($webPages[0] == $pid){
			include($pid);
		}else if('ui/participante/insertParticipante.php' == $pid){
		    include($pid);
		}
		else{
			if($_SESSION['id']==""){
				header("Location: index.php");
				die();
			}
			if($_SESSION['entity']=="Administrator"){
				include('ui/menuAdministrator.php');
			}
			if($_SESSION['entity']=="Evaluador"){
				include('ui/menuEvaluador.php');
			}
			if($_SESSION['entity']=="Participante"){
				include('ui/menuParticipante.php');
			}
		}
	?>
	<footer class="app-footer">
		<div>
			<a href="">SIE</a> <span>&copy; 2019 Universidad Distrital.</span>
		</div>
		<div class="ml-auto">
			<span>Powered by</span> <a href="">Universidad Distrital</a>
		</div>
	</footer>
	<?php
	}
	?>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> -->
	<!-- <script src="vendors/popper.js/js/popper.min.js"></script> -->
	<!-- <script src="vendors/bootstrap/js/bootstrap.min.js"></script> -->
	<script src="vendors/pace-progress/js/pace.min.js"></script>
	<script src="vendors/perfect-scrollbar/js/perfect-scrollbar.min.js"></script>
	<script src="vendors/@coreui/coreui-pro/js/coreui.min.js"></script>
	<script>
		$('#ui-view').ajaxLoad();
		$(document).ajaxComplete(function() {
		Pace.restart()
		});
	</script>
	</body>
</html>

