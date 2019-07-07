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
			<th nowrap>Apellido</th>
			<th nowrap>Correo</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$participante = new Participante();
		$participantes = $participante -> search($_GET['search']);
		$counterPregunta = 1;
		foreach ($participantes as $currentParticipante) {
			echo "<tr><td>" . $counterPregunta . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentParticipante -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentParticipante -> getApellido()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentParticipante -> getEmail()) . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalParticipante.php?idParticipante=" . $currentParticipante -> getIdParticipante() . "'  data-toggle='modal' data-target='#modalParticipante' ><span class='oi oi-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver Mas Información' ></span></a> ";
						if($_GET['entity'] == 'Administrator' || $_GET['entity'] == 'Evaluador') {
							echo "<a href='index.php?pid=" . base64_encode("ui/participante/updateParticipante.php") . "&idParticipante=" . $currentParticipante -> getIdParticipante() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Participante' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/participante/updateImagenParticipante.php") . "&idParticipante=" . $currentParticipante -> getIdParticipante() . "&attribute=imagen'><span class='oi oi-image' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar imagen'></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/participante/selectAllParticipante.php") . "&idParticipante=" . $currentParticipante -> getIdParticipante() . "&action=delete' onclick='return confirm(\"Confirma eliminar el Participante: " . $currentParticipante -> getNombre() . " " . $currentParticipante -> getApellido() . "\")'><span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Eliminar Participante' ></span></a> ";
						}
						echo "<a href='index.php?pid=" . base64_encode("ui/cuestionario/selectAllCuestionarioByParticipante.php") . "&idParticipante=" . $currentParticipante -> getIdParticipante() . "'><span class='oi oi-magnifying-glass' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Obtener los Cuestionarios' ></span></a> ";
						if($_GET['entity'] == 'Administrator' || $_GET['entity'] == 'Evaluador') {
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
