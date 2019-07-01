<?php
$processed=false;
$pregunta="";
if(isset($_POST['pregunta'])){
    $pregunta=$_POST['pregunta'];
}
if(isset($_POST['insert'])){
    $newPregunta = new Pregunta("", $pregunta);
    $newPregunta -> insert();
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
        $logAdministrator = new LogAdministrator("","Create Pregunta", "Pregunta: " . $pregunta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
        $logAdministrator -> insert();
    }
    else if($_SESSION['entity'] == 'Evaluador'){
        $logEvaluador = new LogEvaluador("","Create Pregunta", "Pregunta: " . $pregunta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
        $logEvaluador -> insert();
    }
    else if($_SESSION['entity'] == 'Participante'){
        $logParticipante = new LogParticipante("","Create Pregunta", "Pregunta: " . $pregunta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
					<h4 class="card-title">Ingresar Pregunta</h4>
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
							<label>Pregunta*</label>
							<input type="text" class="form-control" name="pregunta" value="<?php echo $pregunta ?>" required />
						</div>
						<button type="submit" class="btn" name="insert">Ingresar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
