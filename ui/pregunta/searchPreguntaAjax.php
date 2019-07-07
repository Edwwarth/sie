<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Pregunta</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$pregunta = new Pregunta();
		$preguntas = $pregunta -> search($_GET['search']);
		$counter = 1;
		foreach ($preguntas as $currentPregunta) {
			echo "<tr><td>" . $counter . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentPregunta -> getPregunta()) . "</td>";
    		echo "<td class='text-right' nowrap>";
    		if($_GET['entity'] == 'Administrator' ) {
    		    echo "<a href='index.php?pid=" . base64_encode("ui/pregunta/updatePregunta.php") . "&idPregunta=" . $currentPregunta -> getIdPregunta() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Pregunta' ></span></a> ";
    		}
    		if($_GET['entity'] == 'Administrator') {
    		    echo "<a href='index.php?pid=" . base64_encode("ui/pregunta/selectAllPregunta.php") . "&idPregunta=" . $currentPregunta -> getIdPregunta() . "&action=delete' onclick='return confirm(\"Confirma eliminar la Pregunta: " . $currentPregunta -> getPregunta() . "\")'><span class='oi oi-delete' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Eliminar Pregunta' ></span></a> ";
    		}
			echo "</td>";
			echo "</tr>";
			$counter++;
		}
		?>
	</tbody>
</table>
</div>
