<?php
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteProgramaAcademico = new ProgramaAcademico($_GET['idProgramaAcademico']);
	$deleteProgramaAcademico -> select();
	if($deleteProgramaAcademico -> delete()){
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
			$logAdministrator = new LogAdministrator("","Delete Programa Academico", "Nombre: " . $deleteProgramaAcademico -> getNombre(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Evaluador'){
			$logEvaluador = new LogEvaluador("","Delete Programa Academico", "Nombre: " . $deleteProgramaAcademico -> getNombre(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logEvaluador -> insert();
		}
		else if($_SESSION['entity'] == 'Participante'){
			$logParticipante = new LogParticipante("","Delete Programa Academico", "Nombre: " . $deleteProgramaAcademico -> getNombre(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logParticipante -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Programa Academico</li>
	<li class="breadcrumb-item active">Consultar Programas Academicos</li>
	<li class="breadcrumb-menu d-md-down-none">
		<div class="btn-group" role="group" aria-label="Button group">
		</div>
	</li>
</ol>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Obtener Todos los Programas Academicos</h4>
		</div>
		<div class="card-body">
		<?php if(isset($_GET['action']) && $_GET['action']=="delete"){ ?>
			<?php if($error == 0){ ?>
				<div class="alert alert-success" >El registro fue correctamente eliminado.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php } else { ?>
				<div class="alert alert-danger" >El registro no fue eliminado. Verifique la información cruzada					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php }
			} ?>
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Nombre 
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="nombre" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/programaAcademico/selectAllProgramaAcademico.php") ?>&order=nombre&dir=asc'>
							<span class='oi oi-sort-ascending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="nombre" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/programaAcademico/selectAllProgramaAcademico.php") ?>&order=nombre&dir=desc'>
							<span class='oi oi-sort-descending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$programaAcademico = new ProgramaAcademico();
					if(isset($_GET['order']) && isset($_GET['dir'])) {
						$programaAcademicos = $programaAcademico -> selectAllOrder($_GET['order'], $_GET['dir']);
					} else {
						$programaAcademicos = $programaAcademico -> selectAll();
					}
					$counterPregunta = 1;
					foreach ($programaAcademicos as $currentProgramaAcademico) {
						echo "<tr><td>" . $counterPregunta . "</td>";
						echo "<td>" . $currentProgramaAcademico -> getNombre() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/programaAcademico/updateProgramaAcademico.php") . "&idProgramaAcademico=" . $currentProgramaAcademico -> getIdProgramaAcademico() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Programa Academico' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/programaAcademico/selectAllProgramaAcademico.php") . "&idProgramaAcademico=" . $currentProgramaAcademico -> getIdProgramaAcademico() . "&action=delete' onclick='return confirm(\"Desea Eliminar el Programa Academico: " . $currentProgramaAcademico -> getNombre() . "\")'><span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Eliminar Programa Academico' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/pregunta/selectAllPreguntaByProgramaAcademico.php") . "&idProgramaAcademico=" . $currentProgramaAcademico -> getIdProgramaAcademico() . "'><span class='oi oi-magnifying-glass' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Obtener Las Preguntas' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/pregunta/insertPregunta.php") . "&idProgramaAcademico=" . $currentProgramaAcademico -> getIdProgramaAcademico() . "'><span class='oi oi-file' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Pregunta' ></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counterPregunta++;
					}
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
