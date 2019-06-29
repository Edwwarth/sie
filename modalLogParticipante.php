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
$idLogParticipante = $_GET ['idLogParticipante'];
$logParticipante = new LogParticipante($idLogParticipante);
$logParticipante -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Log Participante</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Accion</th>
			<td><?php echo str_replace(";; ", "<br>", $logParticipante -> getAccion()) ?></td>
		</tr>
		<tr>
			<th>Informacion</th>
			<td><?php echo str_replace(";; ", "<br>", $logParticipante -> getInformacion()) ?></td>
		</tr>
		<tr>
			<th>Fecha</th>
			<td><?php echo str_replace(";; ", "<br>", $logParticipante -> getFecha()) ?></td>
		</tr>
		<tr>
			<th>Hora</th>
			<td><?php echo str_replace(";; ", "<br>", $logParticipante -> getHora()) ?></td>
		</tr>
		<tr>
			<th>Ip</th>
			<td><?php echo str_replace(";; ", "<br>", $logParticipante -> getIp()) ?></td>
		</tr>
		<tr>
			<th>So</th>
			<td><?php echo str_replace(";; ", "<br>", $logParticipante -> getSo()) ?></td>
		</tr>
		<tr>
			<th>Explorador</th>
			<td><?php echo str_replace(";; ", "<br>", $logParticipante -> getExplorador()) ?></td>
		</tr>
	</table>
</div>
