<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Reportes</li>
	<li class="breadcrumb-item active">Consultar Reportes</li>
	<li class="breadcrumb-menu d-md-down-none">
		<div class="btn-group" role="group" aria-label="Button group">
		</div>
	</li>
</ol>
<div class="container">
	<div class="row">
    	<div class="col-md-2"></div>
    	<div class="col-md-8">
			<canvas id="myChart"></canvas>
		</div>
	</div>
</div>
<input type="hidden" id="list">
<script>
var url = new URL(window.location);

var path = "indexAjax.php?pid=<?php echo base64_encode("ui/cuestionario/reportesAjax.php"); ?>";
$("#list").load(path);

var numberList = [0,0,0,0,0,0];

$( document ).ajaxSuccess(function( event, request, settings ) {
	$.each(request.responseText.split(";"), function(key, value){
	    $.each(value.split(","), function(key, value){
		    value = parseInt(value);
	    	value += numberList[key];
		    numberList[key] = value;
		});
	});
	var ctx = document.getElementById('myChart').getContext('2d');
	var ProgramaAcademico = [];
	<?php 
	$objProgramaAcademico = new ProgramaAcademico();
	$programas = $objProgramaAcademico -> selectAll();
	foreach ($programas as $programa){
	   ?>
	   ProgramaAcademico.push("<?php echo $programa -> getNombre()?>");
	   <?php 
	}
	?>
	var chart = new Chart(ctx, {
	    type: 'horizontalBar',
	    data: {
	        labels: ProgramaAcademico,
	        datasets: [{
	            label: 'Resultados Múltiples',
	            backgroundColor: 'rgba(0,0,255,0.5)',
	            borderColor: 'rgb(255, 99, 132)',
	            data: numberList
	        }]
	    },
	    options: {}
	});
});



</script>