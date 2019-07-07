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
		$evaluador = new Evaluador();
		$evaluadors = $evaluador -> search($_GET['search']);
		$counterPregunta = 1;
		foreach ($evaluadors as $currentEvaluador) {
			echo "<tr><td>" . $counterPregunta . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentEvaluador -> getNombre()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentEvaluador -> getApellido()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentEvaluador -> getEmail()) . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalEvaluador.php?idEvaluador=" . $currentEvaluador -> getIdEvaluador() . "'  data-toggle='modal' data-target='#modalEvaluador' ><span class='oi oi-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver Mas Información' ></span></a> ";
						if($_GET['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/evaluador/updateEvaluador.php") . "&idEvaluador=" . $currentEvaluador -> getIdEvaluador() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Evaluador' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/evaluador/updateImagenEvaluador.php") . "&idEvaluador=" . $currentEvaluador -> getIdEvaluador() . "&attribute=imagen'><span class='oi oi-image' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar imagen'></span></a> ";
						}
						if($_GET['entity'] == 'Administrator') {
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
