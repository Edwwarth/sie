<?php
$processed=false;
$idCuestionario = $_GET['idCuestionario'];
$updateCuestionario = new Cuestionario($idCuestionario);
$updateCuestionario -> select();
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
						    $pregunta = new Pregunta($currentEsquema->getPregunta()->getIdPregunta());
					        $pregunta -> select(); $counterPregunta++;?>
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
            							<?php
            							$respuesta = $currentEsquema -> getRespuesta() -> getIdRespuesta();
    									$uno = "";
    									$dos = "";
    									$tres = "";
    									$cuatro = "";
    									$cinco = "";
    									if($respuesta != ""){
    										switch($respuesta){
    											case 1: $uno = "checked";
    											break;
    											case 2: $dos = "checked";
    											break;
    											case 3: $tres = "checked";
    											break;
    											case 4: $cuatro = "checked";
    											break;
    											case 5: $cinco = "checked";
    											break;
    										}
    									}
    									
        								?>
        								<div class="card">
        									<div class="card-header">
        										<label>Respuesta*</label>
        									</div>
        									<div class="card-body">
        										<fieldset class="form-group">
            										<div class="form-check">
            											<input class="form-check-input" type="radio" name="respuesta[<?php echo $counterPregunta-1;?>]" id="respuesta-<?php echo $counterPregunta-1;?>-1" value="1" required <?php echo $uno != null ? $uno : ""; ?>>
            											<label class="form-check-label" for="respuesta-1-<?php echo $counterPregunta-1;?>">
            												Muy Bajo
            											</label>
            										</div>
            										<div class="form-check">
            											<input class="form-check-input" type="radio" name="respuesta[<?php echo $counterPregunta-1;?>]" id="respuesta-<?php echo $counterPregunta-1;?>-2" value="2" <?php echo $dos != null ? $dos : ""; ?>>
            											<label class="form-check-label" for="respuesta-2-<?php echo $counterPregunta-1;?>">
            												Bajo
            											</label>
            										</div>
            										<div class="form-check">
            											<input class="form-check-input" type="radio" name="respuesta[<?php echo $counterPregunta-1;?>]" id="respuesta-<?php echo $counterPregunta-1;?>-3" value="3" <?php echo $tres != null ? $tres : ""; ?>>
            											<label class="form-check-label" for="respuesta-3-<?php echo $counterPregunta-1;?>">
            												Medio
            											</label>
            										</div>
            										<div class="form-check">
            											<input class="form-check-input" type="radio" name="respuesta[<?php echo $counterPregunta-1;?>]" id="respuesta-<?php echo $counterPregunta-1;?>-4" value="4" <?php echo $cuatro != null ? $cuatro : ""; ?>>
            											<label class="form-check-label" for="respuesta-4-<?php echo $counterPregunta-1;?>">
            												Alto
            											</label>
            										</div>
            										<div class="form-check">
            											<input class="form-check-input" type="radio" name="respuesta[<?php echo $counterPregunta-1;?>]" id="respuesta-<?php echo $counterPregunta-1;?>-5" value="5" <?php echo $cinco != null ? $cinco : ""; ?>>
            											<label class="form-check-label" for="respuesta-5-<?php echo $counterPregunta-1;?>">
            												Muy Alto
            											</label>
            										</div>
        										</fieldset>
        									</div>
        								</div>
        							</div>
        						</div>     
    						</div>
						<?php }
						echo "<input type='hidden' id='NroPreg' name='NroPreg' value=" . $counterPregunta . ">";
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
