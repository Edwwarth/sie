<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Cuestionario</li>
	<li class="breadcrumb-item active">Buscar Cuestionario</li>
	<li class="breadcrumb-menu d-md-down-none">
		<div class="btn-group" role="group" aria-label="Button group">
		</div>
	</li>
</ol>
<div class="container-fluid">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Buscar Cuestionario</h4>
		</div>
		<div class="card-body">
			<div class="container">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<input type="text" class="form-control" id="search" placeholder="Search Cuestionario" autocomplete="off" />
					</div>
				</div>
			</div>
			<div id="searchResult"></div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$("#search").keyup(function(){
		if($("#search").val().length > 0){
			var search = $("#search").val().replace(" ", "%20");
			var path = "indexAjax.php?pid=<?php echo base64_encode("ui/cuestionario/searchCuestionarioAjax.php"); ?>&search="+search+"&entity=<?php echo $_SESSION['entity'] ?>";
			$("#searchResult").load(path);
		}
	});
});
</script>
