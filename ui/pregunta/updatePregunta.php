<?php
$processed=false;
$idPregunta = $_GET['idPregunta'];
$updatePregunta = new Pregunta($idPregunta);
$updatePregunta -> select();

$objValor = new Valor("", "", $idPregunta, "", "");
$objValor -> select();
$valores = $objValor -> selectAllByPreguntaOrder("pregunta_idPregunta", "asc");
$listIdValores = array();
foreach ($valores as $valor){
    array_push($listIdValores, $valor -> getIdValor());
}
$pregunta="";
if(isset($_POST['pregunta'])){
    $pregunta=$_POST['pregunta'];
}
$tipos = array();
if(isset($_POST['Tipo'])){
    $tipos = $_POST['Tipo'];
}
$valores = [0,0,0,0,0,0];
if(isset($_POST['Value'])){
    $valores = $_POST['Value'];
}
$programasAcademicos = [5,5,5,5,5,5];
if(isset($_POST['programaAcademico'])){
    $programasAcademicos = $_POST['programaAcademico'];
}
if(isset($_POST['update'])){
    $updatePregunta = new Pregunta($idPregunta, $pregunta);
    $updatePregunta -> update();
    $updatePregunta -> select();
    if (count($tipos) == count($valores) && count($valores) == count($valores)){
        for($i = 1; $i <= count($tipos); $i++){
            $objValor = new Valor($listIdValores[($i-1)], $valores[$i], $idPregunta, $programasAcademicos[$i], $tipos[$i]);
            $objValor -> update();
        }
    }   
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
        $logAdministrator = new LogAdministrator("","Edit Pregunta", "Pregunta: " . $pregunta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
        $logAdministrator -> insert();
    }
    else if($_SESSION['entity'] == 'Evaluador'){
        $logEvaluador = new LogEvaluador("","Edit Pregunta", "Pregunta: " . $pregunta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
        $logEvaluador -> insert();
    }
    else if($_SESSION['entity'] == 'Participante'){
        $logParticipante = new LogParticipante("","Edit Pregunta", "Pregunta: " . $pregunta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
        $logParticipante -> insert();
    }
    $processed=true;
}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Pregunta</li>
	<li class="breadcrumb-item active">Editar Pregunta</li>
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
					<h4 class="card-title">Editar Pregunta</h4>
				</div>
				<div class="card-body">
					<?php if($processed){?>
					<div class="alert alert-success" >Datos Ingresados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/pregunta/updatePregunta.php") . "&idPregunta=" . $idPregunta ?>" class="bootstrap-form needs-validation" novalidate  >
						<div class="form-group">
							<label>Pregunta*</label>
							<input type="text" class="form-control" name="pregunta" value="<?php echo $updatePregunta -> getPregunta() ?>" required />
						</div>
						<?php
						$objValor = new Valor("", "", $idPregunta, "", "");
						$objValor -> select();
						$valores = $objValor -> selectAllByPreguntaOrder("pregunta_idPregunta", "asc");
						$counter = 0;
						foreach ($valores as $valor){
						    $counter ++;
						    $respuesta = new Respuesta($valor -> getRespuesta() -> getIdRespuesta(), "");
						    $respuesta -> select();
						    ?>
						    <div class="form-row">
                                <div class="col">
                                  <input type="text" class="form-control" value="<?php echo $respuesta->getTipo()?>" readonly>
                                  <input type="hidden" class="form-control" name="Tipo[<?php echo $respuesta -> getIdRespuesta()?>]" value="<?php echo $respuesta->getIdRespuesta()?>" readonly>
                                </div>
                                <div class="col">
            						<select class="form-control" name="programaAcademico[<?php echo $counter?>]">
            							<?php
            							$objProgramaAcademico = new ProgramaAcademico();
            							$programaAcademicos = $objProgramaAcademico -> selectAll();            							
            							foreach($programaAcademicos as $currentProgramaAcademico){
            							    echo "<option value='" . $currentProgramaAcademico -> getIdProgramaAcademico() . "'";
            							    if($currentProgramaAcademico -> getIdProgramaAcademico() == $valor -> getProgramaAcademico() -> getIdProgramaAcademico()){
            							        echo " selected";
            							    }
            								echo ">" . $currentProgramaAcademico -> getNombre() . "</option>";
            							}
            							?>
            						</select>
            					</div>
            					<div class="col">
                                  <input type="number" class="form-control" name="Value[<?php echo $counter?>]" placeholder="Valor" value=<?php echo $valor -> getValor()?>>
                                </div>
                             </div> 
                             <br> 
						    <?php 
						}
						?>
						<button type="submit" class="btn" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>