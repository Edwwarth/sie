<?php
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
            $logAdministrator = new LogAdministrator("","Delete Cuestionario", "Descripcion: ;; Participante: " . $nameParticipante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
            $logAdministrator -> insert();
        }
        else if($_SESSION['entity'] == 'Evaluador'){
            $logEvaluador = new LogEvaluador("","Delete Cuestionario", "Descripcion: ;; Participante: " . $nameParticipante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
            $logEvaluador -> insert();
        }
        else if($_SESSION['entity'] == 'Participante'){
            $logParticipante = new LogParticipante("","Delete Cuestionario", "Descripcion: ;; Participante: " . $nameParticipante, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
	<li class="breadcrumb-item active">Consular Cuestionarios</li>
	<li class="breadcrumb-menu d-md-down-none">
		<div class="btn-group" role="group" aria-label="Button group">
		</div>
	</li>
</ol>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Obtener Cuestionarios</h4>
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
				<div class="alert alert-danger" >El registro no fue eliminado. Verifique información cruzada
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
					$cuestionario = new Cuestionario();
					if(isset($_GET['order']) && isset($_GET['dir'])) {
						$cuestionarios = $cuestionario -> selectAllOrder($_GET['order'], $_GET['dir']);
					} else {
						$cuestionarios = $cuestionario -> selectAll();
					}
					$counter = 1;
					foreach ($cuestionarios as $currentCuestionario) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentCuestionario -> getParticipante() -> getNombre() . " " . $currentCuestionario -> getParticipante() -> getApellido() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator' || $_SESSION['entity'] == 'Evaluador') {
						    echo "<a href='index.php?pid=" . base64_encode("ui/cuestionario/detailCuestionario.php") . "&idCuestionario=" . $currentCuestionario -> getIdCuestionario() . "'><span class='oi oi-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver Cuestionario' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/cuestionario/updateCuestionario.php") . "&idCuestionario=" . $currentCuestionario -> getIdCuestionario() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Cuestionario' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/cuestionario/selectAllCuestionario.php") . "&idCuestionario=" . $currentCuestionario -> getIdCuestionario() . "&action=delete' onclick='return confirm(\"Confirma eliminar el Cuestionario?\")'><span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Eliminar Cuestionario' ></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counter++;
					}
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
