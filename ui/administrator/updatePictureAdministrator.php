<?php
$processed = false;
$attribute = $_GET['attribute'];
$idAdministrator= $_GET['idAdministrator'];
$error = 0;
if(isset($_POST['update'])){
	$localPath=$_FILES['image']['tmp_name'];
	$type=$_FILES['image']['type'];
	if($type!="image/png"){
		$error=1;
	} else {
		$serverPath = "image/administrator_picture" . $idAdministrator . ".png";
		copy($localPath,$serverPath);
		$updateAdministrator = new Administrator($idAdministrator);
		$updateAdministrator -> updateImage($attribute, $serverPath);
		$user_ip = getenv('REMOTE_ADDR');
		$agent = $_SERVER["HTTP_USER_AGENT"];
		$browser = "-";
		if( preg_match('/MSIE (\d+\.\d+);/', $agent) ) {
			$browser = "Internet Explorer";
		} else if (preg_match('/Chrome[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Chrome";
		} else if (preg_match('/Edge\/\d+/', $agent) ) {
			$browser = "Edge";
		} else if ( preg_match('/Firefox[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Firefox";
		} else if ( preg_match('/OPR[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Opera";
		} else if (preg_match('/Safari[\/\s](\d+\.\d+)/', $agent) ) {
			$browser = "Safari";
		}
		if($_SESSION['entity'] == 'Administrator'){
			$logAdministrator = new LogAdministrator("","Edit picture in Administrator", "Picture: " . $attribute, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logAdministrator -> insert();
		}
		else if($_SESSION['entity'] == 'Evaluador'){
			$logEvaluador = new LogEvaluador("","Edit picture in Administrator", "Picture: " . $attribute, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logEvaluador -> insert();
		}
		else if($_SESSION['entity'] == 'Participante'){
			$logParticipante = new LogParticipante("","Edit picture in Administrator", "Picture: " . $attribute, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logParticipante -> insert();
		}
		$processed = true;
	}
}
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Administrador</li>
	<li class="breadcrumb-item active">Cambiar Imagen</li>
	<li class="breadcrumb-menu d-md-down-none">
		<div class="btn-group" role="group" aria-label="Button group">
		</div>
	</li>
</ol>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Cambio <?php echo $attribute == "picture" ? "imagen" : $attribute  ?> de Administrador</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Imagen Cambiadas
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } else if($error == 1) { ?>
					<div class="alert alert-danger" >Error. La imagen debe ser png
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/administrator/updatePictureAdministrator.php") ?>&idAdministrator=<?php echo $idAdministrator ?>&attribute=<?php echo $attribute ?>" class="bootstrap-form needs-validation" enctype="multipart/form-data" novalidate  >
						<div class="form-group">
							<label>Imagen*</label>
							<input type="file" class="form-control-file" name="image" required />
						</div>
						<button type="submit" class="btn" name="update">Editar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
