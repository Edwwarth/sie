<?php
$processed=false;
$respuesta="";
if(isset($_POST['respuesta'])){
	$respuesta=$_POST['respuesta'];
}
$acierto="";
if(isset($_POST['acierto'])){
	$acierto=$_POST['acierto'];
}
$pregunta="";
if(isset($_POST['pregunta'])){
	$pregunta=$_POST['pregunta'];
}
if(isset($_GET['idPregunta'])){
	$pregunta=$_GET['idPregunta'];
}
if(isset($_POST['insert'])){
	$newRespuesta = new Respuesta("", $respuesta, $acierto, $pregunta);
	$newRespuesta -> insert();
	$objPregunta = new Pregunta($pregunta);
	$objPregunta -> select();
	$namePregunta = $objPregunta -> getPregunta() ;
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
		$logAdministrator = new LogAdministrator("","Create Respuesta", "Respuesta: " . $respuesta . ";; Acierto: " . $acierto . ";; Pregunta: " . $namePregunta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Evaluador'){
		$logEvaluador = new LogEvaluador("","Create Respuesta", "Respuesta: " . $respuesta . ";; Acierto: " . $acierto . ";; Pregunta: " . $namePregunta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logEvaluador -> insert();
	}
	else if($_SESSION['entity'] == 'Participante'){
		$logParticipante = new LogParticipante("","Create Respuesta", "Respuesta: " . $respuesta . ";; Acierto: " . $acierto . ";; Pregunta: " . $namePregunta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Create Respuesta</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Data Entered
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/respuesta/insertRespuesta.php") ?>" class="bootstrap-form needs-validation" novalidate  >
						<div class="form-group">
							<label>Respuesta*</label>
							<input type="text" class="form-control" name="respuesta" value="<?php echo $respuesta ?>" required />
						</div>
						<div class="form-group">
							<label>Acierto*</label>
							<input type="text" class="form-control" name="acierto" value="<?php echo $acierto ?>" required />
						</div>
					<div class="form-group">
						<label>Pregunta*</label>
						<select class="form-control" name="pregunta">
							<?php
							$objPregunta = new Pregunta();
							$preguntas = $objPregunta -> selectAll();
							foreach($preguntas as $currentPregunta){
								echo "<option value='" . $currentPregunta -> getIdPregunta() . "'";
								if($currentPregunta -> getIdPregunta() == $pregunta){
									echo " selected";
								}
								echo ">" . $currentPregunta -> getPregunta() . "</option>";
							}
							?>
						</select>
					</div>
						<button type="submit" class="btn" name="insert">Create</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
