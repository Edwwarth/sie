<?php 
if($_SESSION['entity'] != null && $_SESSION['entity'] == 'Participante'){
    echo "<script>document.getElementsByTagName('body')[0].className='app header-fixed sidebar-fixed aside-menu-fixed pace-done'</script>";
}
?>
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
var idCuestionario = url.searchParams.get("idCuestionario");

var path = "indexAjax.php?pid=<?php echo base64_encode("ui/cuestionario/reportesAjax.php"); ?>&idCuestionario="+idCuestionario;
$("#list").load(path);

var numberList = [];
$( document ).ajaxSuccess(function( event, request, settings ) {
	console.log(request.responseText)
	$.each(request.responseText.split(","), function(value, key){
	    numberList.push(parseInt(key));
	});
	var ctx = document.getElementById('myChart').getContext('2d');
	var chart = new Chart(ctx, {
	    type: 'horizontalBar',
	    data: {
	        labels: ['Tecnología en gestión de la producción industrial', 
	        	'Tecnología en electrónica', 
	        	'Tecnología en construcciones civiles', 
	        	'Tecnología en sistemas eléctricos de media y baja tensión',
	        	'Tecnología en gestión de la producción industrial',  
	        	'Tecnología en sistematización de datos',
	        	],
	        datasets: [{
	            label: 'Resultados Individuales',
	            backgroundColor: 'rgba(0,0,255,0.5)',
	            borderColor: 'rgb(255, 99, 132)',
	            data: numberList
	        }]
	    },
	    options: {}
	});
});



</script>