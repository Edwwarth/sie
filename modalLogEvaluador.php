<?php
require("business/Administrator.php");
require("business/LogAdministrator.php");
require("business/LogEvaluador.php");
require("business/Evaluador.php");
require("business/LogParticipante.php");
require("business/Participante.php");
require("business/ProgramaAcademico.php");
require("business/Esquema.php");
require("business/Value.php");
require("business/Respuesta.php");
require("business/Pregunta.php");
require("business/Cuestionario.php");
require_once("persistence/Connection.php");
$idLogEvaluador = $_GET ['idLogEvaluador'];
$logEvaluador = new LogEvaluador($idLogEvaluador);
$logEvaluador -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Log Evaluador</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Accion</th>
			<td><?php echo str_replace(";; ", "<br>", $logEvaluador -> getAccion()) ?></td>
		</tr>
		<tr>
			<th>Informacion</th>
			<td><?php echo str_replace(";; ", "<br>", $logEvaluador -> getInformacion()) ?></td>
		</tr>
		<tr>
			<th>Fecha</th>
			<td><?php echo str_replace(";; ", "<br>", $logEvaluador -> getFecha()) ?></td>
		</tr>
		<tr>
			<th>Hora</th>
			<td><?php echo str_replace(";; ", "<br>", $logEvaluador -> getHora()) ?></td>
		</tr>
		<tr>
			<th>Ip</th>
			<td><?php echo str_replace(";; ", "<br>", $logEvaluador -> getIp()) ?></td>
		</tr>
		<tr>
			<th>So</th>
			<td><?php echo str_replace(";; ", "<br>", $logEvaluador -> getSo()) ?></td>
		</tr>
		<tr>
			<th>Explorador</th>
			<td><?php echo str_replace(";; ", "<br>", $logEvaluador -> getExplorador()) ?></td>
		</tr>
	</table>
</div>
