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
$idAdministrator = $_GET ['idAdministrator'];
$administrator = new Administrator($idAdministrator);
$administrator -> select();
?>
<script charset="utf-8">
	$(function () { 
		$("[data-toggle='tooltip']").tooltip(); 
	}); 
</script>
<div class="modal-header">
	<h4 class="modal-title">Administrator</h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body">
	<table class="table table-striped table-hover">
		<tr>
			<th>Name</th>
			<td><?php echo $administrator -> getName() ?></td>
		</tr>
		<tr>
			<th>Last Name</th>
			<td><?php echo $administrator -> getLastName() ?></td>
		</tr>
		<tr>
			<th>Email</th>
			<td><?php echo $administrator -> getEmail() ?></td>
		</tr>
		<tr>
			<th>Picture</th>
				<td><img class="rounded img-fluid" src="<?php echo $administrator -> getPicture() ?>" /></td>
		</tr>
		<tr>
			<th>Phone</th>
			<td><?php echo $administrator -> getPhone() ?></td>
		</tr>
		<tr>
			<th>Mobile</th>
			<td><?php echo $administrator -> getMobile() ?></td>
		</tr>
	</table>
</div>
