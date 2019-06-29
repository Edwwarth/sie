<?php
$programaAcademico = new ProgramaAcademico($_GET['idProgramaAcademico']); 
$programaAcademico -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deletePregunta = new Pregunta($_GET['idPregunta']);
	$deletePregunta -> select();
	if($deletePregunta -> delete()){
		$nameProgramaAcademico = $deletePregunta -> getProgramaAcademico() -> getNombre();
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
			$logAdministrator = new LogAdministrator("","Delete Pregunta", "Pregunta: " . $deletePregunta -> getPregunta() . ";; Programa Academico: " . $nameProgramaAcademico, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Evaluador'){
			$logEvaluador = new LogEvaluador("","Delete Pregunta", "Pregunta: " . $deletePregunta -> getPregunta() . ";; Programa Academico: " . $nameProgramaAcademico, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logEvaluador -> insert();
		}
		else if($_SESSION['entity'] == 'Participante'){
			$logParticipante = new LogParticipante("","Delete Pregunta", "Pregunta: " . $deletePregunta -> getPregunta() . ";; Programa Academico: " . $nameProgramaAcademico, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logParticipante -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Pregunta</li>
	<li class="breadcrumb-item active">Consultar Preguntas</li>
	<li class="breadcrumb-menu d-md-down-none">
		<div class="btn-group" role="group" aria-label="Button group">
		</div>
	</li>
</ol>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar Preguntas del Programa Academico: <em><?php echo $programaAcademico -> getNombre() ?></em></h4>
		</div>
		<div class="card-body">
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >El registro fue eliminado correctamente.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } else { ?>
				<div class="alert alert-danger" >El registro no fue eliminado. Verifique si existe información cruzada
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
						<th nowrap>Pregunta 
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="pregunta" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' href='index.php?pid=<?php echo base64_encode("ui/pregunta/selectAllPreguntaByProgramaAcademico.php") ?>&idProgramaAcademico=<?php echo $_GET['idProgramaAcademico'] ?>&order=pregunta&dir=asc'>
							<span class='oi oi-sort-ascending'></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="pregunta" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' href='index.php?pid=<?php echo base64_encode("ui/pregunta/selectAllPreguntaByProgramaAcademico.php") ?>&idProgramaAcademico=<?php echo $_GET['idProgramaAcademico'] ?>&order=pregunta&dir=desc'>
							<span class='oi oi-sort-descending'></span></a>
						<?php } ?>
						</th>
						<th>Programa Academico</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
				<?php
					$pregunta = new Pregunta("", "", "", $_GET['idProgramaAcademico']);
					if(isset($_GET['order']) && isset($_GET['dir'])) {
						$preguntas = $pregunta -> selectAllByProgramaAcademicoOrder($_GET['order'], $_GET['dir']);
					} else {
						$preguntas = $pregunta -> selectAllByProgramaAcademico();
					}
					$counter = 1;
					foreach ($preguntas as $currentPregunta) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentPregunta -> getPregunta() . "</td>";
						echo "<td>" . $currentPregunta -> getRCorrecta() . "</td>";
						echo "<td>" . $currentPregunta -> getProgramaAcademico() -> getNombre() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/pregunta/updatePregunta.php") . "&idPregunta=" . $currentPregunta -> getIdPregunta() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Pregunta' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/pregunta/selectAllPreguntaByProgramaAcademico.php") . "&idProgramaAcademico=" . $_GET['idProgramaAcademico'] . "&idPregunta=" . $currentPregunta -> getIdPregunta() . "&action=delete' onclick='return confirm(\"Confirm to delete Pregunta: " . $currentPregunta -> getPregunta() . " " . $currentPregunta -> getRCorrecta() . "\")'> <span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Pregunta' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/cuestionarioPregunta/selectAllCuestionarioPreguntaByPregunta.php") . "&idPregunta=" . $currentPregunta -> getIdPregunta() . "'><span class='oi oi-magnifying-glass' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Get All Cuestionario Pregunta' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/cuestionarioPregunta/insertCuestionarioPregunta.php") . "&idPregunta=" . $currentPregunta -> getIdPregunta() . "'><span class='oi oi-file' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Create Cuestionario Pregunta' ></span></a> ";
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
