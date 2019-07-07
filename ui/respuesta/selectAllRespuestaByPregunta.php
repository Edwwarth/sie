<?php
$pregunta = new Pregunta($_GET['idPregunta']); 
$pregunta -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteRespuesta = new Respuesta($_GET['idRespuesta']);
	$deleteRespuesta -> select();
	if($deleteRespuesta -> delete()){
		$namePregunta = $deleteRespuesta -> getPregunta() -> getPregunta();
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
			$logAdministrator = new LogAdministrator("","Delete Respuesta", "Respuesta: " . $deleteRespuesta -> getRespuesta() . ";; Acierto: " . $deleteRespuesta -> getAcierto() . ";; Pregunta: " . $namePregunta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Evaluador'){
			$logEvaluador = new LogEvaluador("","Delete Respuesta", "Respuesta: " . $deleteRespuesta -> getRespuesta() . ";; Acierto: " . $deleteRespuesta -> getAcierto() . ";; Pregunta: " . $namePregunta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logEvaluador -> insert();
		}
		else if($_SESSION['entity'] == 'Participante'){
			$logParticipante = new LogParticipante("","Delete Respuesta", "Respuesta: " . $deleteRespuesta -> getRespuesta() . ";; Acierto: " . $deleteRespuesta -> getAcierto() . ";; Pregunta: " . $namePregunta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Get All Respuesta of Pregunta: <em><?php echo $pregunta -> getPregunta() ?></em></h4>
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
						<th nowrap>Respuesta 
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="respuesta" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/respuesta/selectAllRespuestaByPregunta.php") ?>&idPregunta=<?php echo $_GET['idPregunta'] ?>&order=respuesta&dir=asc'>
							<span class='oi oi-sort-ascending'></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="respuesta" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/respuesta/selectAllRespuestaByPregunta.php") ?>&idPregunta=<?php echo $_GET['idPregunta'] ?>&order=respuesta&dir=desc'>
							<span class='oi oi-sort-descending'></span></a>
						<?php } ?>
						</th>
						<th nowrap>Acierto 
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="acierto" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/respuesta/selectAllRespuestaByPregunta.php") ?>&idPregunta=<?php echo $_GET['idPregunta'] ?>&order=acierto&dir=asc'>
							<span class='oi oi-sort-ascending'></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="acierto" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/respuesta/selectAllRespuestaByPregunta.php") ?>&idPregunta=<?php echo $_GET['idPregunta'] ?>&order=acierto&dir=desc'>
							<span class='oi oi-sort-descending'></span></a>
						<?php } ?>
						</th>
						<th>Pregunta</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$respuesta = new Respuesta("", "", "", $_GET['idPregunta']);
					if(isset($_GET['order']) && isset($_GET['dir'])) {
						$respuestas = $respuesta -> selectAllByPreguntaOrder($_GET['order'], $_GET['dir']);
					} else {
						$respuestas = $respuesta -> selectAllByPregunta();
					}
					$counterPregunta = 1;
					foreach ($respuestas as $currentRespuesta) {
						echo "<tr><td>" . $counterPregunta . "</td>";
						echo "<td>" . $currentRespuesta -> getRespuesta() . "</td>";
						echo "<td>" . $currentRespuesta -> getAcierto() . "</td>";
						echo "<td>" . $currentRespuesta -> getPregunta() -> getPregunta() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/respuesta/updateRespuesta.php") . "&idRespuesta=" . $currentRespuesta -> getIdRespuesta() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Respuesta' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/respuesta/selectAllRespuestaByPregunta.php") . "&idPregunta=" . $_GET['idPregunta'] . "&idRespuesta=" . $currentRespuesta -> getIdRespuesta() . "&action=delete' onclick='return confirm(\"Confirm to delete Respuesta: " . $currentRespuesta -> getRespuesta() . " " . $currentRespuesta -> getAcierto() . "\")'> <span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Respuesta' ></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counterPregunta++;
					};
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
