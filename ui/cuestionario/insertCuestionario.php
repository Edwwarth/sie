<?php
$processed=false;
$participante="";
if(isset($_POST['participante'])){
    $participante=$_POST['participante'];
}
if(isset($_GET['idParticipante'])){
    $participante=$_GET['idParticipante'];
}
$preguntasPost = array();
if(isset($_POST['pregunta'])){
    $preguntasPost = $_POST['pregunta'];
}
$respuestasPost = array();
if(isset($_POST['respuesta'])){
    $respuestasPost = $_POST['respuesta'];
}
if(isset($_POST['insert'])){
    $nextCuestionario = new Cuestionario();
    $nextId = $nextCuestionario -> getNextAutoI()[0];
    $newCuestionario = new Cuestionario($nextId, "", $participante);
    $newCuestionario -> insert();
    if($preguntasPost != null && count($preguntasPost)>0 && $respuestasPost != null && count($respuestasPost)>0){
        if(count($preguntasPost) == count($respuestasPost)){
            for($i = 0; $i < count($respuestasPost); $i++){
                $esquema = new Esquema("", $preguntasPost[$i], $respuestasPost[$i], $nextId);
                $esquema -> insert();
            }
        }
    }
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
        $logAdministrator = new LogAdministrator("","Create Cuestionario", "Respuesta: " . "" . ";; Participante: " . $nameParticipante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
        $logAdministrator -> insert();
    }
    else if($_SESSION['entity'] == 'Evaluador'){
        $logEvaluador = new LogEvaluador("","Create Cuestionario", "Respuesta: " . "" . ";; Participante: " . $nameParticipante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
        $logEvaluador -> insert();
    }
    else if($_SESSION['entity'] == 'Participante'){
        $logParticipante = new LogParticipante("","Create Cuestionario", "Respuesta: " . "" . ";; Participante: " . $nameParticipante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
        $logParticipante -> insert();
    }
    $processed=true;
}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Cuestionario</li>
	<li class="breadcrumb-item active">Ingresar Cuestionario</li>
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
					<h4 class="card-title">Nuevo Cuestionario</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Ingresados 
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/cuestionario/insertCuestionario.php") ?>" class="bootstrap-form needs-validation" novalidate  >
						<div class="form-group">
							<label>Participante*</label>
							<select class="form-control" name="participante">
								<?php
								if($_SESSION['entity'] != null && $_SESSION['entity'] == "Participante"){
									$participante = new Participante($_SESSION['id']);
									$participante -> select();
									echo "<input type=\"text\" class=\"form-control\" name=\"participante\" value=" . $participante->getNombre() . " " . $participante->getApellido() . " required readonly />";
								}else{
									$objParticipante = new Participante();
									$participantes = $objParticipante -> selectAll();
									foreach($participantes as $currentParticipante){
										echo "<option value='" . $currentParticipante -> getIdParticipante() . "'";
										if($currentParticipante -> getIdParticipante() == $participante){
											echo " selected";
										}
										echo ">" . $currentParticipante -> getNombre() . " " . $currentParticipante -> getApellido() . "</option>";
									}
								}
								?>
							</select>
						</div>
						<label>Preguntas</label>
						<?php 
						  $objPregunta = new Pregunta();
						  $randomPreguntas = $objPregunta -> getRandomQuestions();
						  $counter = 0;
						  foreach ($randomPreguntas as $pregunta){
						      $counter++;
						  ?>
						      <!-- Here goes the questions-->
				            <div class="form-group form-check">
								<div class="card">
        							<div class="card-header">
        								Pregunta Numero <?php echo $counter . ": " . $pregunta -> getPregunta(); ?>
        								<!-- Hidden question id[] -->
        								  <input type="hidden" id="pregunta-<?php echo $counter-1;?>" name="pregunta[<?php echo $counter-1;?>]" value="<?php echo $pregunta -> getIdPregunta();?>"> 
        							</div>
        							<div class="card-body">
        								<div class="card">
        									<div class="card-header">
        										<label>Respuesta*</label>
        									</div>
        									<div class="card-body">
        										<fieldset class="form-group">
            										<div class="form-check">
            											<input class="form-check-input" type="radio" name="respuesta[<?php echo $counter-1;?>]" id="respuesta-<?php echo $counter-1;?>-1" value="1" required>
            											<label class="form-check-label" for="respuesta-1-<?php echo $counter-1;?>">
            												Muy Bajo
            											</label>
            										</div>
            										<div class="form-check">
            											<input class="form-check-input" type="radio" name="respuesta[<?php echo $counter-1;?>]" id="respuesta-<?php echo $counter-1;?>-2" value="2">
            											<label class="form-check-label" for="respuesta-2-<?php echo $counter-1;?>">
            												Bajo
            											</label>
            										</div>
            										<div class="form-check">
            											<input class="form-check-input" type="radio" name="respuesta[<?php echo $counter-1;?>]" id="respuesta-<?php echo $counter-1;?>-3" value="3">
            											<label class="form-check-label" for="respuesta-3-<?php echo $counter-1;?>">
            												Medio
            											</label>
            										</div>
            										<div class="form-check">
            											<input class="form-check-input" type="radio" name="respuesta[<?php echo $counter-1;?>]" id="respuesta-<?php echo $counter-1;?>-4" value="4">
            											<label class="form-check-label" for="respuesta-4-<?php echo $counter-1;?>">
            												Alto
            											</label>
            										</div>
            										<div class="form-check">
            											<input class="form-check-input" type="radio" name="respuesta[<?php echo $counter-1;?>]" id="respuesta-<?php echo $counter-1;?>-5" value="5">
            											<label class="form-check-label" for="respuesta-5-<?php echo $counter-1;?>">
            												Muy Alto
            											</label>
            										</div>
        										</fieldset>
        									</div>
        								</div>
        							</div>
        						</div>     
    						</div>       
						  <?php 
						  }
						  echo "<input type='hidden' id='NroPreg' name='NroPreg' value=" . $counter . ">";
						  ?>
						<!-- onclick="return validateSubmit()" -->
						<button type="submit" class="btn" name="insert" >Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function validateSubmit(){
	var NumPreg = $("#NroPreg").val();
	var valid = true;
    for(i=0; i<NumPreg; i++){
    	var pregVal = false;
		console.log("input[id^='respuesta-"+i+"']");
        $( "input[id^='respuesta-"+i+"']" ).each(function(index) {
    		console.log($(this));
            if($(this).prop("checked")){
            	pregVal = true;
			}  
        }); 
        if(!pregVal){
			valid = false;
			break;
		}    
    }
	if(valid){
		return true;
	}else{
		alert("Contesta todas las preguntas, por favor.");
		return false;
	}
}
</script>

							
