<?php
$processed=false;
$idCuestionario = $_GET['idCuestionario'];
$updateCuestionario = new Cuestionario($idCuestionario);
$updateCuestionario -> select();
$descripcion="";
if(isset($_POST['descripcion'])){
    $descripcion=$_POST['descripcion'];
}
$participante="";
if(isset($_POST['participante'])){
    $participante=$_POST['participante'];
}

$tipos = array();
if(isset($_POST['pregunta'])){
    $tipos = $_POST['pregunta'];
}

$respuestaValores = array();
if(isset($_POST['respuesta'])){
    $respuestaValores = $_POST['respuesta'];
}

$idCuestionarioPreg = array();
if(isset($_POST['idCuestionarioPreg'])){
    $idCuestionarioPreg = $_POST['idCuestionarioPreg'];
}

if(isset($_POST['update'])){
    if($tipos != null && count($tipos)>0 && $respuestaValores != null && count($respuestaValores)>0){
        /**
         * Must be same length
         * */
        if(count($tipos) == count($respuestaValores)){
            for($i = 0; $i < count($respuestaValores); $i++){
                /**
                 * After seach for the correct answer for each question
                 * Compare correct answer
                 * Can avoided with trigger
                 * */
                $updateCuestionarioPregunta = new Esquema($idCuestionarioPreg[$i], $tipos[$i], $respuestaValores[$i] , $idCuestionario);
                $updateCuestionarioPregunta -> update();
                $updateCuestionarioPregunta -> select();
            }
        }
    }
    $updateCuestionario = new Cuestionario($idCuestionario, $descripcion, $participante);
    $updateCuestionario -> update();
    $updateCuestionario -> select();
    $objParticipante = new Participante($participante);
    $objParticipante -> select();
    $nameParticipante = $objParticipante -> getNombre() . " " . $objParticipante -> getApellido() ;
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
        $logAdministrator = new LogAdministrator("","Edit Cuestionario", "Descripcion: " . $descripcion . ";; Participante: " . $nameParticipante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
        $logAdministrator -> insert();
    }
    else if($_SESSION['entity'] == 'Evaluador'){
        $logEvaluador = new LogEvaluador("","Edit Cuestionario", "Descripcion: " . $descripcion . ";; Participante: " . $nameParticipante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
        $logEvaluador -> insert();
    }
    else if($_SESSION['entity'] == 'Participante'){
        $logParticipante = new LogParticipante("","Edit Cuestionario", "Descripcion: " . $descripcion . ";; Participante: " . $nameParticipante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
        $logParticipante -> insert();
    }
    $processed=true;
}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Cuestionario</li>
	<li class="breadcrumb-item active">Editar Cuestionario</li>
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
					<h4 class="card-title">Ver Cuestionario</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Editados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/cuestionario/updateCuestionario.php") . "&idCuestionario=" . $idCuestionario ?>" class="bootstrap-form needs-validation" novalidate  >
					<div class="form-group">
						<label>Participante*</label>
						<select class="form-control" name="participante">
							<?php
							$objParticipante = new Participante();
							$participantes = $objParticipante -> selectAll();
							foreach($participantes as $currentParticipante){
								echo "<option value='" . $currentParticipante -> getIdParticipante() . "'";
								if($currentParticipante -> getIdParticipante() == $updateCuestionario -> getParticipante() -> getIdParticipante()){
									echo " selected";
								}
								echo ">" . $currentParticipante -> getNombre() . " " . $currentParticipante -> getApellido() . "</option>";
							}
							?>
						</select>
					</div>
					<label>Preguntas</label>
						<?php
						$esquema = new Esquema("", "", "", $_GET['idCuestionario']);
						$esquemas = $esquema -> selectAllByCuestionario();
						$counterPregunta = 0;
						if(count($esquemas) == 0){
						    print("<p>El numero de preguntas es cero</>");
						}
						foreach ($esquemas as $currentEsquema){
						    $counterPregunta++;?>
    						<!-- Here goes the questions-->
    			            <div class="form-group form-check">
    							<div class="card">
        							<div class="card-header">
        								Pregunta Numero <?php echo $counterPregunta . ": " . $currentEsquema-> getPregunta() -> getPregunta(); ?>
        								<!-- Hidden question id[] and Hidden questPreg id[] -->
    								    <input type="hidden" id="pregunta-<?php echo $counterPregunta-1;?>" name="pregunta[<?php echo $counterPregunta-1;?>]" value="<?php echo $currentEsquema-> getPregunta() -> getIdPregunta();?>">
    								    <input type="hidden" id="pregunta-<?php echo $counterPregunta-1;?>" name="idCuestionarioPreg[<?php echo $counterPregunta-1;?>]" value="<?php echo $currentEsquema -> getIdEsquema();?>"> 
        							</div>
        							<div class="card-body">
        							<div class="card">
        									<div class="card-header">
        										<label>Respuesta*</label>
        									</div>
        									<div class="card-body">
        										<fieldset class="form-group">
                        							<?php
                        							$objValor = new Valor("", "", $currentEsquema -> getPregunta() -> getIdPregunta(), "", "");
                        							$valoresPorPregunta = $objValor -> selectAllByPregunta();
                        							$counterRespuesta = 0;
                        							foreach ($valoresPorPregunta as $valor){
                        							    $counterRespuesta ++;
                        							    $checked = "";
                        							    if($valor -> getRespuesta() -> getIdRespuesta() == $currentEsquema -> getRespuesta() -> getIdRespuesta()){
                        							        $checked = "checked";
                        							    }
                        							    ?>
                        							    <div class="form-check">
                											<input class="form-check-input" type="radio" name="respuesta[<?php echo $counterPregunta-1;?>]" id="respuesta-<?php echo $counterPregunta-1 . "-" . $counterRespuesta;?>" value="<?php echo $counterRespuesta ?>" required <?php echo $checked != null ? $checked : ""; ?>>
                											<label class="form-check-label" for="respuesta-<?php echo $counterRespuesta . "-" . $counterPregunta-1;?>">
                												<?php 
                												echo $valor -> getRespuesta() -> getTipo();
                												?>
                											</label>
                										</div>
                        							    <?php 
                        							}
                    								?>        								
        										</fieldset>
        									</div>
        								</div>
        							</div>
        						</div>     
    						</div>
						<?php }
						echo "<input type='hidden' id='NroPreg' name='NroPreg' value=" . $counterPregunta . ">";
						?>
						<button type="submit" class="btn" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
