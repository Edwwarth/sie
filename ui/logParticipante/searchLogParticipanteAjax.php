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
			<th>Participante</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$logParticipante = new LogParticipante();
		$logParticipantes = $logParticipante -> search($_GET['search']);
		$counterPregunta = 1;
		foreach ($logParticipantes as $currentLogParticipante) {
			echo "<tr><td>" . $counterPregunta . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogParticipante -> getAccion()) . "</td>";
			echo "<td nowrap>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogParticipante -> getFecha()) . "</td>";
			echo "<td nowrap>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogParticipante -> getHora()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogParticipante -> getIp()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogParticipante -> getSo()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogParticipante -> getExplorador()) . "</td>";
			echo "<td>" . $currentLogParticipante -> getParticipante() -> getNombre() . " " . $currentLogParticipante -> getParticipante() -> getApellido() . "</td>";
			echo "<td class='text-right' nowrap>
				<a href='modalLogParticipante.php?idLogParticipante=" . $currentLogParticipante -> getIdLogParticipante() . "'  data-toggle='modal' data-target='#modalLogParticipante' >
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
<div class="modal fade" id="modalLogParticipante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
