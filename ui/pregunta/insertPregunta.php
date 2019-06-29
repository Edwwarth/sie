<?php
$processed=false;
$pregunta="";
if(isset($_POST['pregunta'])){
	$pregunta=$_POST['pregunta'];
}
$rCorrecta="";
if(isset($_POST['rCorrecta'])){
	$rCorrecta=$_POST['rCorrecta'];
}
$programaAcademico="";
if(isset($_POST['programaAcademico'])){
	$programaAcademico=$_POST['programaAcademico'];
}
if(isset($_GET['idProgramaAcademico'])){
	$programaAcademico=$_GET['idProgramaAcademico'];
}
if(isset($_POST['insert'])){
	$newPregunta = new Pregunta("", $pregunta, $rCorrecta, $programaAcademico);
	$newPregunta -> insert();
	$objProgramaAcademico = new ProgramaAcademico($programaAcademico);
	$objProgramaAcademico -> select();
	$nameProgramaAcademico = $objProgramaAcademico -> getNombre() ;
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
		$logAdministrator = new LogAdministrator("","Create Pregunta", "Pregunta: " . $pregunta . ";; R Correcta: " . $rCorrecta . ";; Programa Academico: " . $nameProgramaAcademico, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Evaluador'){
		$logEvaluador = new LogEvaluador("","Create Pregunta", "Pregunta: " . $pregunta . ";; R Correcta: " . $rCorrecta . ";; Programa Academico: " . $nameProgramaAcademico, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logEvaluador -> insert();
	}
	else if($_SESSION['entity'] == 'Participante'){
		$logParticipante = new LogParticipante("","Create Pregunta", "Pregunta: " . $pregunta . ";; R Correcta: " . $rCorrecta . ";; Programa Academico: " . $nameProgramaAcademico, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logParticipante -> insert();
	}
	$processed=true;
}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Pregunta</li>
	<li class="breadcrumb-item active">Ingresar Pregunta</li>
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
					<h4 class="card-title">Crear Pregunta</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Ingresados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/pregunta/insertPregunta.php") ?>" class="bootstrap-form needs-validation" novalidate  >
						<div class="form-group">
							<label>Programa Academico*</label>
							<select class="form-control" name="programaAcademico">
								<?php
								$objProgramaAcademico = new ProgramaAcademico();
								$programaAcademicos = $objProgramaAcademico -> selectAll();
								foreach($programaAcademicos as $currentProgramaAcademico){
									echo "<option value='" . $currentProgramaAcademico -> getIdProgramaAcademico() . "'";
									if($currentProgramaAcademico -> getIdProgramaAcademico() == $programaAcademico){
										echo " selected";
									}
									echo ">" . $currentProgramaAcademico -> getNombre() . "</option>";
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Pregunta*</label>
							<input type="text" class="form-control" name="pregunta" value="<?php echo $pregunta ?>" required />
						</div>
						<div class="card">
							<div class="card-header">
								<label>Respuesta*</label>
							</div>
							<div class="card-body">
								<?php 
									$uno = "";
									$dos = "";
									$tres = "";
									$cuatro = "";
									if($rCorrecta != ""){
										switch($rCorrecta){
											case 1: $uno = "checked";
											break;
											case 2: $dos = "checked";
											break;
											case 3: $tres = "checked";
											break;
											case 4: $cuatro = "checked";
											break;
										}
									}
								?>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="rCorrecta" id="respuesta1" value="1" required <?php echo $uno != null ? $uno : ""; ?>>
									<label class="form-check-label" for="respuesta1">
										Opcion 1
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="rCorrecta" id="respuesta2" value="2" <?php echo $dos != null ? $dos : ""; ?>>
									<label class="form-check-label" for="respuesta2">
										Opcion 2
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="rCorrecta" id="respuesta3" value="3" <?php echo $tres != null ? $tres : ""; ?>>
									<label class="form-check-label" for="respuesta3">
										Opcion 3
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="rCorrecta" id="respuesta4" value="4" <?php echo $cuatro != null ? $cuatro : ""; ?>>
									<label class="form-check-label" for="respuesta4">
										Opcion 4
									</label>
								</div>
							</div>
						</div>
						<button type="submit" class="btn" name="insert" onclick="validateSubmit()">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function validateSubmit(){
	if(){

	}
}
</script>
