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
			<th>Administrator</th>
			<th nowrap></th>
		</tr>
	</thead>
	</tbody>
		<?php
		$logAdministrator = new LogAdministrator();
		$logAdministrators = $logAdministrator -> search($_GET['search']);
		$counterPregunta = 1;
		foreach ($logAdministrators as $currentLogAdministrator) {
			echo "<tr><td>" . $counterPregunta . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogAdministrator -> getAccion()) . "</td>";
			echo "<td nowrap>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogAdministrator -> getFecha()) . "</td>";
			echo "<td nowrap>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogAdministrator -> getHora()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogAdministrator -> getIp()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogAdministrator -> getSo()) . "</td>";
			echo "<td>" . str_ireplace($_GET['search'], "<mark>" . $_GET['search'] . "</mark>", $currentLogAdministrator -> getExplorador()) . "</td>";
			echo "<td>" . $currentLogAdministrator -> getAdministrator() -> getName() . " " . $currentLogAdministrator -> getAdministrator() -> getLastName() . "</td>";
			echo "<td class='text-right' nowrap>
				<a href='modalLogAdministrator.php?idLogAdministrator=" . $currentLogAdministrator -> getIdLogAdministrator() . "'  data-toggle='modal' data-target='#modalLogAdministrator' >
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
<div class="modal fade" id="modalLogAdministrator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
