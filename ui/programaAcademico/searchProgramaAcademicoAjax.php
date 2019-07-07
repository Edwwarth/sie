<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Nombre</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$programaAcademico = new ProgramaAcademico();
		$programaAcademicos = $programaAcademico -> search($_GET['search']);
		$counterPregunta = 1;
		foreach ($programaAcademicos as $currentProgramaAcademico) {
			echo "<tr><td>" . $counterPregunta . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentProgramaAcademico -> getNombre()) . "</td>";
						echo "<td class='text-right' nowrap>";
						if($_GET['entity'] == 'Administrator' || $_GET['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/programaAcademico/updateProgramaAcademico.php") . "&idProgramaAcademico=" . $currentProgramaAcademico -> getIdProgramaAcademico() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Programa Academico' ></span></a> ";
						}
						if($_GET['entity'] == 'Administrator' || $_GET['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/programaAcademico/selectAllProgramaAcademico.php") . "&idProgramaAcademico=" . $currentProgramaAcademico -> getIdProgramaAcademico() . "&action=delete' onclick='return confirm(\"Confirm to delete Programa Academico: " . $currentProgramaAcademico -> getNombre() . "\")'><span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Eliminar Programa Academico' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/pregunta/selectAllPreguntaByProgramaAcademico.php") . "&idProgramaAcademico=" . $currentProgramaAcademico -> getIdProgramaAcademico() . "'><span class='oi oi-magnifying-glass' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Obtener Las Preguntas' ></span></a> ";
						if($_GET['entity'] == 'Administrator' || $_GET['entity'] == 'Evaluador') {
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
