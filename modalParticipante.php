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
$idParticipante = $_GET ['idParticipante'];
$participante = new Participante($idParticipante);
$participante -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Participante</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Nombre</th>
			<td><?php echo $participante -> getNombre() ?></td>
		</tr>
		<tr>
			<th>Apellido</th>
			<td><?php echo $participante -> getApellido() ?></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><?php echo $participante -> getEmail() ?></td>
		</tr>
		<tr>
			<th>Imagen</th>
				<td><img class="rounded img-fluid" src="<?php echo $participante -> getImagen() ?>" /></td>
		</tr>
	</table>
</div>
