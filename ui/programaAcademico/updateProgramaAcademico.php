<?php
$processed=false;
$idProgramaAcademico = $_GET['idProgramaAcademico'];
$updateProgramaAcademico = new ProgramaAcademico($idProgramaAcademico);
$updateProgramaAcademico -> select();
$nombre="";
if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
}
if(isset($_POST['update'])){
	$updateProgramaAcademico = new ProgramaAcademico($idProgramaAcademico, $nombre);
	$updateProgramaAcademico -> update();
	$updateProgramaAcademico -> select();
	$user_ip = getenv('REMOTE_ADDR');
	$agent = $_SERVER["HTTP_USER_AGENT"];
	$browser = "-";
	if( preg_match('/MSIE (\d+\.\d+);/', $agent) ) {
		$browser = "Internet Explorer";
	} else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Chrome";
	} else if (preg_match('/Edge\/\d+/', $agent) ) {
		$browser = "Edge";
	} else if ( preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Firefox";
	} else if ( preg_match('/OPR[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Opera";
	} else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent) ) {
		$browser = "Safari";
	}
	if($_SESSION['entity'] == 'Administrator'){
		$logAdministrator = new LogAdministrator("","Edit Programa Academico", "Nombre: " . $nombre, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Evaluador'){
		$logEvaluador = new LogEvaluador("","Edit Programa Academico", "Nombre: " . $nombre, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logEvaluador -> insert();
	}
	else if($_SESSION['entity'] == 'Participante'){
		$logParticipante = new LogParticipante("","Edit Programa Academico", "Nombre: " . $nombre, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logParticipante -> insert();
	}
	$processed=true;
}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Programa Academico</li>
	<li class="breadcrumb-item active">Editar Programa Academico</li>
	<li class="breadcrumb-menu d-md-down-none">
		<div class="btn-group" role="group" aria-label="Button group">
		</div>
	</li>
</ol>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Editar Programa Academico</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Editados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/programaAcademico/updateProgramaAcademico.php") . "&idProgramaAcademico=" . $idProgramaAcademico ?>" class="bootstrap-form needs-validation" novalidate  >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $updateProgramaAcademico -> getNombre() ?>" required />
						</div>
						<button type="submit" class="btn" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
