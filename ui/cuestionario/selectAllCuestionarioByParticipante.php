<?php
$participante = new Participante($_GET['idParticipante']);
$participante -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
    $deleteCuestionario = new Cuestionario($_GET['idCuestionario']);
    $deleteCuestionario -> select();
    if($deleteCuestionario -> delete()){
        $nameParticipante = $deleteCuestionario -> getParticipante() -> getNombre() . " " . $deleteCuestionario -> getParticipante() -> getApellido();
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
            $logAdministrator = new LogAdministrator("","Delete Cuestionario", "Descripcion: " . $deleteCuestionario -> getDescripcion() . ";; Participante: " . $nameParticipante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
            $logAdministrator -> insert();
        }
        else if($_SESSION['entity'] == 'Evaluador'){
            $logEvaluador = new LogEvaluador("","Delete Cuestionario", "Descripcion: " . $deleteCuestionario -> getDescripcion() . ";; Participante: " . $nameParticipante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
            $logEvaluador -> insert();
        }
        else if($_SESSION['entity'] == 'Participante'){
            $logParticipante = new LogParticipante("","Delete Cuestionario", "Descripcion: " . $deleteCuestionario -> getDescripcion() . ";; Participante: " . $nameParticipante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
            $logParticipante -> insert();
        }
    }else{
        $error = 1;
    }
}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Cuestionario</li>
	<li class="breadcrumb-item active">Consultar Cuestionarios</li>
	<li class="breadcrumb-menu d-md-down-none">
		<div class="btn-group" role="group" aria-label="Button group">
		</div>
	</li>
</ol>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Cuestionarios del participante: <em><?php echo $participante -> getNombre() . " " . $participante -> getApellido() ?></em></h4>
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
						<th>Participante</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$cuestionario = new Cuestionario("", $_GET['idParticipante']);
					if(isset($_GET['order']) && isset($_GET['dir'])) {
						$cuestionarios = $cuestionario -> selectAllByParticipanteOrder($_GET['order'], $_GET['dir']);
					} else {
						$cuestionarios = $cuestionario -> selectAllByParticipante();
					}
					$counterPregunta = 1;
					foreach ($cuestionarios as $currentCuestionario) {
						echo "<tr><td>" . $counterPregunta . "</td>";
						echo "<td>" . $currentCuestionario -> getParticipante() -> getNombre() . " " . $currentCuestionario -> getParticipante() -> getApellido() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
						    echo "<a href='index.php?pid=" . base64_encode("ui/cuestionario/detailCuestionario.php") . "&idCuestionario=" . $currentCuestionario -> getIdCuestionario() . "'><span class='oi oi-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver Cuestionario' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/cuestionario/updateCuestionario.php") . "&idCuestionario=" . $currentCuestionario -> getIdCuestionario() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Cuestionario' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/participante/reporteIndividual.php") . "&idCuestionario=" . $currentCuestionario -> getIdCuestionario() . "'><span class='oi oi-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Reporte' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/cuestionario/selectAllCuestionarioByParticipante.php") . "&idParticipante=" . $_GET['idParticipante'] . "&idCuestionario=" . $currentCuestionario -> getIdCuestionario() . "&action=delete' onclick='return confirm(\"Confirma eliminar cuestionario\")'> <span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Eliminar Cuestionario' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/participante/reporteIndividual.php") . "&idCuestionario=" . $currentCuestionario -> getIdCuestionario() . "'><span class='oi oi-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Mostrar Reporte' ></span></a> ";
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
