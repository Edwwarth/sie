<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Administrador</li>
	<li class="breadcrumb-item active">Consultar Administradores</li>
	<li class="breadcrumb-menu d-md-down-none">
		<div class="btn-group" role="group" aria-label="Button group">
		</div>
	</li>
</ol>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Consultar Administradores</h4>
		</div>
		<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<tr><th></th>
						<th nowrap>Nombre 
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="name" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=name&dir=asc'>
							<span class='oi oi-sort-ascending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="name" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=name&dir=desc'>
							<span class='oi oi-sort-descending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Apellido
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="lastName" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=lastName&dir=asc'>
							<span class='oi oi-sort-ascending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="lastName" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=lastName&dir=desc'>
							<span class='oi oi-sort-descending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Correo 
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="email" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=email&dir=asc'>
							<span class='oi oi-sort-ascending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="email" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=email&dir=desc'>
							<span class='oi oi-sort-descending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Teléfono 
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="phone" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=phone&dir=asc'>
							<span class='oi oi-sort-ascending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="phone" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=phone&dir=desc'>
							<span class='oi oi-sort-descending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap>Celular 
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="mobile" && $_GET['dir']=="asc") { ?>
							<span class='oi oi-caret-top'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=mobile&dir=asc'>
							<span class='oi oi-sort-ascending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Ascendente' ></span></a>
						<?php } ?>
						<?php if(isset($_GET['order']) && isset($_GET['dir']) && $_GET['order']=="mobile" && $_GET['dir']=="desc") { ?>
							<span class='oi oi-caret-bottom'></span>
						<?php } else { ?>
							<a href='index.php?pid=<?php echo base64_encode("ui/administrator/selectAllAdministrator.php") ?>&order=mobile&dir=desc'>
							<span class='oi oi-sort-descending' data-toggle='tooltip' class='tooltipLink' data-original-title='Ordenar Descendente' ></span></a>
						<?php } ?>
						</th>
						<th nowrap></th>
					</tr>
				</thead>
				</tbody>
					<?php
					$administrator = new Administrator();
					if(isset($_GET['order']) && isset($_GET['dir'])) {
						$administrators = $administrator -> selectAllOrder($_GET['order'], $_GET['dir']);
					} else {
						$administrators = $administrator -> selectAll();
					}
					$counterPregunta = 1;
					foreach ($administrators as $currentAdministrator) {
						echo "<tr><td>" . $counterPregunta . "</td>";
						echo "<td>" . $currentAdministrator -> getName() . "</td>";
						echo "<td>" . $currentAdministrator -> getLastName() . "</td>";
						echo "<td>" . $currentAdministrator -> getEmail() . "</td>";
						echo "<td>" . $currentAdministrator -> getPhone() . "</td>";
						echo "<td>" . $currentAdministrator -> getMobile() . "</td>";
						echo "<td class='text-right' nowrap>";
						echo "<a href='modalAdministrator.php?idAdministrator=" . $currentAdministrator -> getIdAdministrator() . "'  data-toggle='modal' data-target='#modalAdministrator' ><span class='oi oi-eye' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Ver más información' ></span></a> ";
						if($_SESSION['entity'] == 'Administrator') {
							echo "<a href='index.php?pid=" . base64_encode("ui/administrator/updateAdministrator.php") . "&idAdministrator=" . $currentAdministrator -> getIdAdministrator() . "'><span class='oi oi-pencil' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar Administrador' ></span></a> ";
							echo "<a href='index.php?pid=" . base64_encode("ui/administrator/updatePictureAdministrator.php") . "&idAdministrator=" . $currentAdministrator -> getIdAdministrator() . "&attribute=picture'><span class='oi oi-image' data-toggle='tooltip' data-placement='left' class='tooltipLink' data-original-title='Editar imagen perfil'></span></a> ";
						}
						echo "</td>";
						echo "</tr>";
						$counterPregunta++;
					}
					?>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalAdministrator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
