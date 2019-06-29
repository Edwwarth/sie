<?php
$pregunta = new Pregunta($_GET['idPregunta']); 
$pregunta -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteEsquema = new Esquema($_GET['idEsquema']);
	$deleteEsquema -> select();
	if($deleteEsquema -> delete()){
		$namePregunta = $deleteEsquema -> getPregunta() -> getPregunta();
		$nameRespuesta = $deleteEsquema -> getRespuesta() -> getTipo() . " " . $deleteEsquema -> getRespuesta() -> getValor();
		$nameCuestionario = $deleteEsquema -> getCuestionario() -> getRespuesta();
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
			$logAdministrator = new LogAdministrator("","Delete Esquema", "Pregunta: " . $namePregunta . ";; Respuesta: " . $nameRespuesta . ";; Cuestionario: " . $nameCuestionario, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Evaluador'){
			$logEvaluador = new LogEvaluador("","Delete Esquema", "Pregunta: " . $namePregunta . ";; Respuesta: " . $nameRespuesta . ";; Cuestionario: " . $nameCuestionario, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logEvaluador -> insert();
		}
		else if($_SESSION['entity'] == 'Participante'){
			$logParticipante = new LogParticipante("","Delete Esquema", "Pregunta: " . $namePregunta . ";; Respuesta: " . $nameRespuesta . ";; Cuestionario: " . $nameCuestionario, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logParticipante -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Get All Esquema of Pregunta: <em><?php echo $pregunta -> getPregunta() ?></em></h4>
		</div>
		<div class="card-body">
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >The registry was succesfully deleted.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } else { ?>
				<div class="alert alert-danger" >The registry was not deleted. Check it does not have related information
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php }
			} ?>
			<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th>Pregunta</th>
						<th>Respuesta</th>
						<th>Cuestionario</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$esquema = new Esquema("", $_GET['idPregunta'], "", "");
					if(isset($_GET['order']) && isset($_GET['dir'])) {
						$esquemas = $esquema -> selectAllByPreguntaOrder($_GET['order'], $_GET['dir']);
					} else {
						$esquemas = $esquema -> selectAllByPregunta();
					}
					$counter = 1;
					foreach ($esquemas as $currentEsquema) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentEsquema -> getPregunta() -> getPregunta() . "</td>";
						echo "<td>" . $currentEsquema -> getRespuesta() -> getTipo() . " " . $currentEsquema -> getRespuesta() -> getValor() . "</td>";
						echo "<td>" . $currentEsquema -> getCuestionario() -> getRespuesta() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/esquema/updateEsquema.php") . "&idEsquema=" . $currentEsquema -> getIdEsquema() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Esquema' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/esquema/selectAllEsquemaByPregunta.php") . "&idPregunta=" . $_GET['idPregunta'] . "&idEsquema=" . $currentEsquema -> getIdEsquema() . "&action=delete' onclick='return confirm(\"Confirm to delete Esquema\")'> <span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Esquema' ></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counter++;
					};
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
