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
$idLogAdministrator = $_GET ['idLogAdministrator'];
$logAdministrator = new LogAdministrator($idLogAdministrator);
$logAdministrator -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Log Administrator</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Accion</th>
			<td><?php echo str_replace(";; ", "<br>", $logAdministrator -> getAccion()) ?></td>
		</tr>
		<tr>
			<th>Informacion</th>
			<td><?php echo str_replace(";; ", "<br>", $logAdministrator -> getInformacion()) ?></td>
		</tr>
		<tr>
			<th>Fecha</th>
			<td><?php echo str_replace(";; ", "<br>", $logAdministrator -> getFecha()) ?></td>
		</tr>
		<tr>
			<th>Hora</th>
			<td><?php echo str_replace(";; ", "<br>", $logAdministrator -> getHora()) ?></td>
		</tr>
		<tr>
			<th>Ip</th>
			<td><?php echo str_replace(";; ", "<br>", $logAdministrator -> getIp()) ?></td>
		</tr>
		<tr>
			<th>So</th>
			<td><?php echo str_replace(";; ", "<br>", $logAdministrator -> getSo()) ?></td>
		</tr>
		<tr>
			<th>Explorador</th>
			<td><?php echo str_replace(";; ", "<br>", $logAdministrator -> getExplorador()) ?></td>
		</tr>
	</table>
</div>
