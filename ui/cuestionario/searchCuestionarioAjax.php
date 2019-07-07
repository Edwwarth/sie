<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Respuesta</th>
			<th>Participante</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$cuestionario = new Cuestionario();
		$cuestionarios = $cuestionario -> search($_GET['search']);
		$counterPregunta = 1;
		foreach ($cuestionarios as $currentCuestionario) {
			echo "<tr><td>" . $counterPregunta . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentCuestionario -> getRespuesta()) . "</td>";
			echo "<td>" . $currentCuestionario -> getParticipante() -> getNombre() . " " . $currentCuestionario -> getParticipante() -> getApellido() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator' || $_GET['entity'] == 'Evaluador') {
						    echo "<a href='index.php?pid=" . base64_encode("ui/cuestionario/detailCuestionario.php") . "&idCuestionario=" . $currentCuestionario -> getIdCuestionario() . "'><span class='oi oi-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver Cuestionario' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/cuestionario/updateCuestionario.php") . "&idCuestionario=" . $currentCuestionario -> getIdCuestionario() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Cuestionario' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/cuestionario/selectAllCuestionario.php") . "&idCuestionario=" . $currentCuestionario -> getIdCuestionario() . "&action=delete' onclick='return confirm(\"Confirm to delete Cuestionario: " . $currentCuestionario -> getRespuesta() . "\")'><span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Eliminar Cuestionario' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counterPregunta++;
		}
		?>
	</tbody>
</table>
</div>
