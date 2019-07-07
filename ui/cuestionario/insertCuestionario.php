<?php
$processed=false;
$participante="";
if(isset($_POST['participante'])){
    $participante=$_POST['participante'];
}
if(isset($_GET['idParticipante'])){
    $participante=$_GET['idParticipante'];
}
$tipos = array();
if(isset($_POST['pregunta'])){
    $tipos = $_POST['pregunta'];
}
$respuestaValores = array();
if(isset($_POST['respuesta'])){
    $respuestaValores = $_POST['respuesta'];
}
if(isset($_POST['insert'])){
    $nextCuestionario = new Cuestionario();
    $nextId = $nextCuestionario -> getNextAutoI()[0];
    $newCuestionario = new Cuestionario($nextId, $participante);
    $newCuestionario -> insert();
    if($tipos != null && count($tipos)>0 && $respuestaValores != null && count($respuestaValores)>0){
        if(count($tipos) == count($respuestaValores)){
            for($i = 0; $i < count($respuestaValores); $i++){
                $esquema = new Esquema("", $tipos[$i], $respuestaValores[$i], $nextId);
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
    if($_SESSION['entity'] != null && $_SESSION['entity'] == 'Participante'){
        echo "<script>location.href = 'index.php?pid=" . base64_encode("ui/participante/reporteIndividual.php") . "&idCuestionario=" . $nextId . "'</script>";
    }
}
?>
<?php 
if($_SESSION['entity'] != null && $_SESSION['entity'] != 'Participante'){
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
    <?php
}else{
    echo "<script>document.getElementsByTagName('body')[0].className='app header-fixed sidebar-fixed aside-menu-fixed pace-done'</script>";
}
?>
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
								<?php
								if($_SESSION['entity'] != null && $_SESSION['entity'] == "Participante"){
									$participante = new Participante($_SESSION['id']);
									$participante -> select();
									echo "<select class='form-control' name='participante'>";
									echo "<option value='" . $participante -> getIdParticipante() . "'";
									echo " selected";
									echo ">" . $participante -> getNombre() . " " . $participante -> getApellido() . "</option>";
									echo "</select>";
								}else{
								    echo "<select class='form-control' name='participante'>";
									$objParticipante = new Participante();
									$participantes = $objParticipante -> selectAll();
									foreach($participantes as $currentParticipante){
										echo "<option value='" . $currentParticipante -> getIdParticipante() . "'";
										if($currentParticipante -> getIdParticipante() == $participante){
											echo " selected";
										}
										echo ">" . $currentParticipante -> getNombre() . " " . $currentParticipante -> getApellido() . "</option>";
									}
									echo "</select>";
								}
								?>
						</div>
						<label>Preguntas</label>
						<?php 
						  $objPregunta = new Pregunta();
						  $randomPreguntas = $objPregunta -> getRandomQuestions();
						  $counterPregunta = 0;
						  foreach ($randomPreguntas as $pregunta){
						      $counterPregunta++;
						  ?>
						      <!-- Here goes the questions-->
				            <div class="form-group form-check">
								<div class="card">
        							<div class="card-header">
        								Pregunta Numero <?php echo $counterPregunta . ": " . $pregunta -> getPregunta(); ?>
        								  <input type="hidden" id="pregunta-<?php echo $counterPregunta-1;?>" name="pregunta[<?php echo $counterPregunta-1;?>]" value="<?php echo $pregunta -> getIdPregunta();?>"> 
        							</div>
        							<div class="card-body">
        								<div class="card">
        									<div class="card-header">
        										<label>Respuesta*</label>
        									</div>
        									<div class="card-body">
        										<fieldset class="form-group">
        											<?php 
        											$objValor = new Valor("", "", $pregunta->getIdPregunta(), "", "");
        											$valoresByPreg = $objValor -> selectAllByPregunta();
        											$counterRespuesta = 0;
        											foreach ($valoresByPreg as $valor){
        											    $counterRespuesta ++;
        											    ?>
        											    <div class="form-check">
                											<input class="form-check-input" type="radio" name="respuesta[<?php echo $counterPregunta-1;?>]" id="respuesta-<?php echo $counterPregunta-1 . "-" . $counterRespuesta;?>" value="<?php echo $counterRespuesta?>" required>
                											<label class="form-check-label" for="respuesta-1-<?php echo $counterPregunta-1;?>">
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
						  <?php 
						  }
						  echo "<input type='hidden' id='NroPreg' name='NroPreg' value=" . $counterPregunta . ">";
						  ?>
						<button type="submit" class="btn" name="insert" >Ingresar</button>
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

							
