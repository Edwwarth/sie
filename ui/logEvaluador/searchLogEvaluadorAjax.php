<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	});
</script>
<div class="table-responsive">
<table class="table table-striped table-hover">
	<thead>
		<tr><th></th>
			<th nowrap>Accion</th>
			<th nowrap>Fecha</th>
			<th nowrap>Hora</th>
			<th nowrap>Ip</th>
			<th nowrap>So</th>
			<th nowrap>Explorador</th>
			<th>Evaluador</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$logEvaluador = new LogEvaluador();
		$logEvaluadors = $logEvaluador -> search($_GET['search']);
		$counterPregunta = 1;
		foreach ($logEvaluadors as $currentLogEvaluador) {
			echo "<tr><td>" . $counterPregunta . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogEvaluador -> getAccion()) . "</td>";
			echo "<td nowrap>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogEvaluador -> getFecha()) . "</td>";
			echo "<td nowrap>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogEvaluador -> getHora()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogEvaluador -> getIp()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogEvaluador -> getSo()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogEvaluador -> getExplorador()) . "</td>";
			echo "<td>" . $currentLogEvaluador -> getEvaluador() -> getNombre() . " " . $currentLogEvaluador -> getEvaluador() -> getApellido() . "</td>";
			echo "<td class='text-right' nowrap>
				<a href='modalLogEvaluador.php?idLogEvaluador=" . $currentLogEvaluador -> getIdLogEvaluador() . "'  data-toggle='modal' data-target='#modalLogEvaluador' >
					<span class='oi oi-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver Mas Información' ></span>
				</a>
				</td>";
			echo "</tr>";
			$counterPregunta++;
		}
		?>
	</tbody>
</table>
</div>
<div class="modal fade" id="modalLogEvaluador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
