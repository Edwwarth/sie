<?php
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteEvaluador = new Evaluador($_GET['idEvaluador']);
	$deleteEvaluador -> select();
	if($deleteEvaluador -> delete()){
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
			$logAdministrator = new LogAdministrator("","Delete Evaluador", "Nombre: " . $deleteEvaluador -> getNombre() . ";; Apellido: " . $deleteEvaluador -> getApellido() . ";; Email: " . $deleteEvaluador -> getEmail() . ";; Password: " . $deleteEvaluador -> getPassword(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Evaluador'){
			$logEvaluador = new LogEvaluador("","Delete Evaluador", "Nombre: " . $deleteEvaluador -> getNombre() . ";; Apellido: " . $deleteEvaluador -> getApellido() . ";; Email: " . $deleteEvaluador -> getEmail() . ";; Password: " . $deleteEvaluador -> getPassword(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logEvaluador -> insert();
		}
		else if($_SESSION['entity'] == 'Participante'){
			$logParticipante = new LogParticipante("","Delete Evaluador", "Nombre: " . $deleteEvaluador -> getNombre() . ";; Apellido: " . $deleteEvaluador -> getApellido() . ";; Email: " . $deleteEvaluador -> getEmail() . ";; Password: " . $deleteEvaluador -> getPassword(), date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logParticipante -> insert();
		}
	}else{
		$error = 1;
	}
}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Evaluador</li>
	<li class="breadcrumb-item active">Consultar Evaluadores</li>
	<li class="breadcrumb-menu d-md-down-none">
		<div class="btn-group" role="group" aria-label="Button group">
		</div>
	</li>
</ol>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Buscar Evaluadores</h4>
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
							<a href='index.php?pid=<?php echo base64_encode("ui/evaluador/selectAllEvaluador.php") ?>&order=nombre&dir=asc'>
							<span class='oi oi-sort-ascending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="nombre" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/evaluador/selectAllEvaluador.php") ?>&order=nombre&dir=desc'>
							<span class='oi oi-sort-descending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Apellido 
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="apellido" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/evaluador/selectAllEvaluador.php") ?>&order=apellido&dir=asc'>
							<span class='oi oi-sort-ascending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="apellido" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/evaluador/selectAllEvaluador.php") ?>&order=apellido&dir=desc'>
							<span class='oi oi-sort-descending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Correo 
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="email" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/evaluador/selectAllEvaluador.php") ?>&order=email&dir=asc'>
							<span class='oi oi-sort-ascending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="email" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/evaluador/selectAllEvaluador.php") ?>&order=email&dir=desc'>
							<span class='oi oi-sort-descending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$evaluador = new Evaluador();
					if(isset($_GET['order']) && isset($_GET['dir'])) {
						$evaluadors = $evaluador -> selectAllOrder($_GET['order'], $_GET['dir']);
					} else {
						$evaluadors = $evaluador -> selectAll();
					}
					$counterPregunta = 1;
					foreach ($evaluadors as $currentEvaluador) {
						echo "<tr><td>" . $counterPregunta . "</td>";
						echo "<td>" . $currentEvaluador -> getNombre() . "</td>";
						echo "<td>" . $currentEvaluador -> getApellido() . "</td>";
						echo "<td>" . $currentEvaluador -> getEmail() . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalEvaluador.php?idEvaluador=" . $currentEvaluador -> getIdEvaluador() . "'  data-toggle='modal' data-target='#modalEvaluador' ><span class='oi oi-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver Mas Información' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/evaluador/updateEvaluador.php") . "&idEvaluador=" . $currentEvaluador -> getIdEvaluador() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Evaluador' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/evaluador/updateImagenEvaluador.php") . "&idEvaluador=" . $currentEvaluador -> getIdEvaluador() . "&attribute=imagen'><span class='oi oi-image' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar imagen'></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/evaluador/selectAllEvaluador.php") . "&idEvaluador=" . $currentEvaluador -> getIdEvaluador() . "&action=delete' onclick='return confirm(\"Confirma eliminar el Evaluador: " . $currentEvaluador -> getNombre() . " " . $currentEvaluador -> getApellido() . "\")'><span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Eliminar Evaluador' ></span></a> ";
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
<div class="modal fade" id="modalEvaluador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
