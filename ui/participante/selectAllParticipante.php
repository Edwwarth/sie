<?php
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteParticipante = new Participante($_GET['idParticipante']);
	$deleteParticipante -> select();
	if($deleteParticipante -> delete()){
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
			$logAdministrator = new LogAdministrator("","Delete Participante", "Nombre: " . $deleteParticipante -> getNombre() . ";; Apellido: " . $deleteParticipante -> getApellido() . ";; Email: " . $deleteParticipante -> getEmail() . ";; Password: " . $deleteParticipante -> getPassword(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Evaluador'){
			$logEvaluador = new LogEvaluador("","Delete Participante", "Nombre: " . $deleteParticipante -> getNombre() . ";; Apellido: " . $deleteParticipante -> getApellido() . ";; Email: " . $deleteParticipante -> getEmail() . ";; Password: " . $deleteParticipante -> getPassword(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logEvaluador -> insert();
		}
		else if($_SESSION['entity'] == 'Participante'){
			$logParticipante = new LogParticipante("","Delete Participante", "Nombre: " . $deleteParticipante -> getNombre() . ";; Apellido: " . $deleteParticipante -> getApellido() . ";; Email: " . $deleteParticipante -> getEmail() . ";; Password: " . $deleteParticipante -> getPassword(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logParticipante -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Participante</li>
	<li class="breadcrumb-item active">Consultar Participantes</li>
	<li class="breadcrumb-menu d-md-down-none">
		<div class="btn-group" role="group" aria-label="Button group">
		</div>
	</li>
</ol>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Buscar Participantes</h4>
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
				<div class="alert alert-danger" >El registro no fue eliminado. Verifique la información crruzada
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
						<th nowrap>Nombre 
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="nombre" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/participante/selectAllParticipante.php") ?>&order=nombre&dir=asc'>
							<span class='oi oi-sort-ascending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="nombre" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/participante/selectAllParticipante.php") ?>&order=nombre&dir=desc'>
							<span class='oi oi-sort-descending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Apellido 
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="apellido" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/participante/selectAllParticipante.php") ?>&order=apellido&dir=asc'>
							<span class='oi oi-sort-ascending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="apellido" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/participante/selectAllParticipante.php") ?>&order=apellido&dir=desc'>
							<span class='oi oi-sort-descending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Email 
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="email" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/participante/selectAllParticipante.php") ?>&order=email&dir=asc'>
							<span class='oi oi-sort-ascending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="email" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/participante/selectAllParticipante.php") ?>&order=email&dir=desc'>
							<span class='oi oi-sort-descending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Identificación </th>
						<th nowrap></th>
						
					</tr>
				</thead>
				</tbody>
					<?php
					$participante = new Participante();
					if(isset($_GET['order']) && isset($_GET['dir'])) {
						$participantes = $participante -> selectAllOrder($_GET['order'], $_GET['dir']);
					} else {
						$participantes = $participante -> selectAll();
					}
					$counterPregunta = 1;
					foreach ($participantes as $currentParticipante) {
						echo "<tr><td>" . $counterPregunta . "</td>";
						echo "<td>" . $currentParticipante -> getNombre() . "</td>";
						echo "<td>" . $currentParticipante -> getApellido() . "</td>";
						echo "<td>" . $currentParticipante -> getEmail() . "</td>";
						echo "<td>" . $currentParticipante -> getIdentification() . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalParticipante.php?idParticipante=" . $currentParticipante -> getIdParticipante() . "'  data-toggle='modal' data-target='#modalParticipante' ><span class='oi oi-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver Mas Información' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/participante/updateParticipante.php") . "&idParticipante=" . $currentParticipante -> getIdParticipante() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Participante' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/participante/updateImagenParticipante.php") . "&idParticipante=" . $currentParticipante -> getIdParticipante() . "&attribute=imagen'><span class='oi oi-image' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar imagen'></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/participante/selectAllParticipante.php") . "&idParticipante=" . $currentParticipante -> getIdParticipante() . "&action=delete' onclick='return confirm(\"Confirma eliminar el Participante: " . $currentParticipante -> getNombre() . " " . $currentParticipante -> getApellido() . "\")'><span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Eliminar Participante' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/cuestionario/selectAllCuestionarioByParticipante.php") . "&idParticipante=" . $currentParticipante -> getIdParticipante() . "'><span class='oi oi-magnifying-glass' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Obtener los Cuestionarios' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/cuestionario/insertCuestionario.php") . "&idParticipante=" . $currentParticipante -> getIdParticipante() . "'><span class='oi oi-file' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Crear Cuestionario' ></span></a> ";
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
<div class="modal fade" id="modalParticipante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" >
		<div class="modal-content" id="modalContent">
		</div>
	</div>
</div>
<script>
	$('body').on('show.bs.modal', '.modal', function (e) {
		var link = $(e.relatedTarget);
		$(this).find(".modal-content").load(link.attr("href"));
	});
</script>
