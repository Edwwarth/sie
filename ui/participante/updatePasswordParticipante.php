<?php
$processed = false;
$error = 0;
if(isset($_POST['update'])){
	if($_POST['newPassword'] == $_POST['newPasswordConfirm']){
		$updateParticipante = new Participante($_SESSION['id']);
		$updateParticipante -> select();
		if($updateParticipante -> getPassword() == md5($_POST['currentPassword'])){
			$updateParticipante -> updatePassword($_POST['newPassword']);
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
			$logParticipante = new LogParticipante("","Change Password Participante", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
			$logParticipante -> insert();
			$processed = true;
		} else {
			$error = 2;
		}
	} else {
		$error = 1;
	}
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Cambiar Contraseña Participante</h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Contraseña Cambiada
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } else if($error == 1) { ?>
					<div class="alert alert-danger" >Error. <em>New</em> field and <em>Confirm New</em> field must be equal
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } else if($error == 2) { ?>
					<div class="alert alert-danger" >Error. <em>Current</em> field is not the current password
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/participante/updatePasswordParticipante.php") ?>" class="bootstrap-form needs-validation" novalidate  >
						<div class="form-group">
							<label>Actual*</label>
							<input type="password" class="form-control" name="currentPassword" required />
						</div>
						<div class="form-group">
							<label>Nueva*</label>
							<input type="password" class="form-control" name="newPassword" required />
						</div>
						<div class="form-group">
							<label>Confirmar Nueva*</label>
							<input type="password" class="form-control" name="newPasswordConfirm" required />
						</div>
						<button type="submit" class="btn" name="update">Edit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
