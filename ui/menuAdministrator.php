<?php
$administrator = new Administrator($_SESSION['id']);
$administrator -> select();
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
);
if (isset($_GET['logOut'])) {
    $_SESSION['id'] = "";
}
?>
<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.php?pid=<?php echo base64_encode("ui/sessionAdministrator.php") ?>">
        <img class="navbar-brand-full" src="img/logo.png" width="80" height="70" alt="">
        <img class="navbar-brand-minimized" src="putSomeLogoPlox" width="30" height="30" alt="">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item px-3"><a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/sessionAdministrator.php") ?>">Dashboard</a></li>
    </ul>
    <!-- NavBar, the firts column -->
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"> <img class="img-avatar" src="img/avatars/6.jpg" alt="admin@bootstrapmaster.com">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>Configuración</strong>
                </div>
                <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/updateProfileAdministrator.php") ?>"> <i class="fa fa-user"></i> Perfil
                </a>
                <a class="dropdown-item" href="index.php?pid=<?php echo base64_encode("ui/administrator/updatePasswordAdministrator.php") ?>"> <i class="fa fa-user"></i> Cambiar clave
                </a>
                <a class="dropdown-item" href="index.php?logOut=1"> <i class="fa fa-lock"></i> Cerrar sesion
                </a>
            </div>
        </li>
    </ul>
</header>
<div class="app-body">
    <div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <!-- Please put the correct icons -->
                <li class="nav-title">Reportes</li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"> <i class="nav-icon icon-cursor"></i> Reportes
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode('ui/cuestionario/reportAllCuestionarios.php') ?>"> <i class="nav-icon icon-cursor"></i> Mostrar Cuestionarios
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-title">Perfiles</li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"> <i class="nav-icon icon-cursor"></i> Administradores
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/administrator/insertAdministrator.php") ?>"> <i class="nav-icon icon-cursor"></i> Crear administrador
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>"> <i class="nav-icon icon-cursor"></i> Consultar administradores
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/administrator/searchAdministrator.php") ?>"> <i class="nav-icon icon-cursor"></i> Buscar administrador
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"> <i class="nav-icon icon-cursor"></i> Evaluadores
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/evaluador/insertEvaluador.php") ?>"> <i class="nav-icon icon-cursor"></i> Crear Evaluador
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/evaluador/selectAllEvaluador.php") ?>"> <i class="nav-icon icon-cursor"></i> Consultar Evaluadores
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/evaluador/searchEvaluador.php") ?>"> <i class="nav-icon icon-cursor"></i> Buscar Evaluador
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"> <i class="nav-icon icon-cursor"></i> Participantes
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/participante/insertParticipante.php") ?>"> <i class="nav-icon icon-cursor"></i> Crear Participante
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/participante/selectAllParticipante.php") ?>"> <i class="nav-icon icon-cursor"></i> Consultar Participantes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/participante/searchParticipante.php") ?>"> <i class="nav-icon icon-cursor"></i> Buscar Participante
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-title">Informacion de Cuestionario</li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"> <i class="nav-icon icon-cursor"></i> Programa Academico
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/programaAcademico/insertProgramaAcademico.php") ?>"> <i class="nav-icon icon-cursor"></i> Ingresar Programa Academico
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/programaAcademico/selectAllProgramaAcademico.php") ?>"> <i class="nav-icon icon-cursor"></i> Consultar Programas Academicos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/programaAcademico/searchProgramaAcademico.php") ?>"> <i class="nav-icon icon-cursor"></i> Buscar Programa Academico
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"> <i class="nav-icon icon-cursor"></i> Preguntas
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/pregunta/insertPregunta.php") ?>"> <i class="nav-icon icon-cursor"></i> Crear Pregunta
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/pregunta/selectAllPregunta.php") ?>"> <i class="nav-icon icon-cursor"></i> Consultar Preguntas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/pregunta/searchPregunta.php") ?>"> <i class="nav-icon icon-cursor"></i> Buscar Pregunta
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"> <i class="nav-icon icon-cursor"></i> Cuestionario
                    </a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/cuestionario/insertCuestionario.php") ?>"> <i class="nav-icon icon-cursor"></i> Ingresar Cuestionario
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/cuestionario/selectAllCuestionario.php") ?>"> <i class="nav-icon icon-cursor"></i> Consultar Cuestionarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <!-- index.php?pid= echo base64_encode("ui/cuestionario/searchCuestionario.php") ?> -->
                            <a class="nav-link" href=""> <i class="nav-icon icon-cursor"></i> Buscar Cuestionario
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-title">Logs</li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/logAdministrator/searchLogAdministrator.php") ?>"> <i class="nav-icon icon-speedometer"></i> Logs Administradores
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/logEvaluador/searchLogEvaluador.php") ?>"> <i class="nav-icon icon-drop"></i> Logs Evaluador
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?pid=<?php echo base64_encode("ui/logParticipante/searchLogParticipante.php") ?>"> <i class="nav-icon icon-drop"></i> Logs Participante
                    </a>
                </li>
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>
    <div class="main">
        <?php

    	if (!empty($_GET['pid'])) {
            $pid = base64_decode($_GET['pid']);
            //echo $pid;
            //print_r($webPages);
    	    if (in_array($pid, $webPages)) {
    	        include($pid);
    	    } else {
    	        include('ui/error.php');
    	    }
    	}

    	?>
    </div>
</div>
