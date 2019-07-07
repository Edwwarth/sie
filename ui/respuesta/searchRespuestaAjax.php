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
			<th nowrap>Acierto</th>
			<th>Pregunta</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$respuesta = new Respuesta();
		$respuestas = $respuesta -> search($_GET['search']);
		$counterPregunta = 1;
		foreach ($respuestas as $currentRespuesta) {
			echo "<tr><td>" . $counterPregunta . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentRespuesta -> getRespuesta()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentRespuesta -> getAcierto()) . "</td>";
			echo "<td>" . $currentRespuesta -> getPregunta() -> getPregunta() . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator' || $_GET['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/respuesta/updateRespuesta.php") . "&idRespuesta=" . $currentRespuesta -> getIdRespuesta() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Edit Respuesta' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator' || $_GET['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/respuesta/selectAllRespuesta.php") . "&idRespuesta=" . $currentRespuesta -> getIdRespuesta() . "&action=delete' onclick='return confirm(\"Confirm to delete Respuesta: " . $currentRespuesta -> getRespuesta() . " " . $currentRespuesta -> getAcierto() . "\")'><span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Delete Respuesta' ></span></a> ";
						}
						echo "</td>";
			echo "</tr>";
			$counterPregunta++;
		}
		?>
	</tbody>
</table>
</div>
