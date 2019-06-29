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
$idEvaluador = $_GET ['idEvaluador'];
$evaluador = new Evaluador($idEvaluador);
$evaluador -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Evaluador</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Nombre</th>
			<td><?php echo $evaluador -> getNombre() ?></td>
		</tr>
		<tr>
			<th>Apellido</th>
			<td><?php echo $evaluador -> getApellido() ?></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><?php echo $evaluador -> getEmail() ?></td>
		</tr>
		<tr>
			<th>Imagen</th>
				<td><img class="rounded img-fluid" src="<?php echo $evaluador -> getImagen() ?>" /></td>
		</tr>
	</table>
</div>
