<?php
$programaAcademico = new ProgramaAcademico($_GET['idProgramaAcademico']); 
$programaAcademico -> select();
$error = 0;
if(!empty($_GET['action']) && $_GET['action']=="delete"){
	$deleteValue = new Value($_GET['idValue']);
	$deleteValue -> select();
	if($deleteValue -> delete()){
		$nameProgramaAcademico = $deleteValue -> getProgramaAcademico() -> getNombre();
		$nameRespuesta = $deleteValue -> getRespuesta() -> getTipo() . " " . $deleteValue -> getRespuesta() -> getValor();
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
			$logAdministrator = new LogAdministrator("","Delete Value", "Programa Academico: " . $nameProgramaAcademico . ";; Respuesta: " . $nameRespuesta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Evaluador'){
			$logEvaluador = new LogEvaluador("","Delete Value", "Programa Academico: " . $nameProgramaAcademico . ";; Respuesta: " . $nameRespuesta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logEvaluador -> insert();
		}
		else if($_SESSION['entity'] == 'Participante'){
			$logParticipante = new LogParticipante("","Delete Value", "Programa Academico: " . $nameProgramaAcademico . ";; Respuesta: " . $nameRespuesta, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
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
			<h4 class="card-title">Get All Value of Programa Academico: <em><?php echo $programaAcademico -> getNombre() ?></em></h4>
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
						<th>Programa Academico</th>
						<th>Respuesta</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$value = new Value("", $_GET['idProgramaAcademico'], "");
					if(isset($_GET['order']) && isset($_GET['dir'])) {
						$values = $value -> selectAllByProgramaAcademicoOrder($_GET['order'], $_GET['dir']);
					} else {
						$values = $value -> selectAllByProgramaAcademico();
					}
					$counter = 1;
					foreach ($values as $currentValue) {
						echo "<tr><td>" . $counter . "</td>";
						echo "<td>" . $currentValue -> getProgramaAcademico() -> getNombre() . "</td>";
						echo "<td>" . $currentValue -> getRespuesta() -> getTipo() . " " . $currentValue -> getRespuesta() -> getValor() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/value/updateValue.php") . "&idValue=" . $currentValue -> getIdValue() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Value' ></span></a> ";
						}
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/value/selectAllValueByProgramaAcademico.php") . "&idProgramaAcademico=" . $_GET['idProgramaAcademico'] . "&idValue=" . $currentValue -> getIdValue() . "&action=delete' onclick='return confirm(\"Confirm to delete Value\")'> <span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Value' ></span></a> ";
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
