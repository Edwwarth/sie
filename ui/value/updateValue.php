<?php
$processed=false;
$idValue = $_GET['idValue'];
$updateValue = new Value($idValue);
$updateValue -> select();
$programaAcademico="";
if(isset($_POST['programaAcademico'])){
	$programaAcademico=$_POST['programaAcademico'];
}
$respuesta="";
if(isset($_POST['respuesta'])){
	$respuesta=$_POST['respuesta'];
}
if(isset($_POST['update'])){
	$updateValue = new Value($idValue, $programaAcademico, $respuesta);
	$updateValue -> update();
	$updateValue -> select();
	$objProgramaAcademico = new ProgramaAcademico($programaAcademico);
	$objProgramaAcademico -> select();
	$nameProgramaAcademico = $objProgramaAcademico -> getNombre() ;
	$objRespuesta = new Respuesta($respuesta);
	$objRespuesta -> select();
	$nameRespuesta = $objRespuesta -> getTipo() . " " . $objRespuesta -> getValor() ;
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
		$logAdministrator = new LogAdministrator("","Edit Value", "Programa Academico: " . $nameProgramaAcademico . ";; Respuesta: " . $nameRespuesta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Evaluador'){
		$logEvaluador = new LogEvaluador("","Edit Value", "Programa Academico: " . $nameProgramaAcademico . ";; Respuesta: " . $nameRespuesta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logEvaluador -> insert();
	}
	else if($_SESSION['entity'] == 'Participante'){
		$logParticipante = new LogParticipante("","Edit Value", "Programa Academico: " . $nameProgramaAcademico . ";; Respuesta: " . $nameRespuesta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logParticipante -> insert();
	}
	$processed=true;
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Edit Value</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Edited
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/value/updateValue.php") . "&idValue=" . $idValue ?>" class="bootstrap-form needs-validation" novalidate  >
					<div class="form-group">
						<label>Programa Academico*</label>
						<select class="form-control" name="programaAcademico">
							<?php
							$objProgramaAcademico = new ProgramaAcademico();
							$programaAcademicos = $objProgramaAcademico -> selectAll();
							foreach($programaAcademicos as $currentProgramaAcademico){
								echo "<option value='" . $currentProgramaAcademico -> getIdProgramaAcademico() . "'";
								if($currentProgramaAcademico -> getIdProgramaAcademico() == $updateValue -> getProgramaAcademico() -> getIdProgramaAcademico()){
									echo " selected";
								}
								echo ">" . $currentProgramaAcademico -> getNombre() . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Respuesta*</label>
						<select class="form-control" name="respuesta">
							<?php
							$objRespuesta = new Respuesta();
							$respuestas = $objRespuesta -> selectAll();
							foreach($respuestas as $currentRespuesta){
								echo "<option value='" . $currentRespuesta -> getIdRespuesta() . "'";
								if($currentRespuesta -> getIdRespuesta() == $updateValue -> getRespuesta() -> getIdRespuesta()){
									echo " selected";
								}
								echo ">" . $currentRespuesta -> getTipo() . " " . $currentRespuesta -> getValor() . "</option>";
							}
							?>
						</select>
					</div>
						<button type="submit" class="btn" name="update">Edit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
