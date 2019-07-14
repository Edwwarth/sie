<?php
$processed=false;
$nombre="";
if(isset($_POST['nombre'])){
	$nombre=$_POST['nombre'];
}
$apellido="";
if(isset($_POST['apellido'])){
	$apellido=$_POST['apellido'];
}
$email="";
if(isset($_POST['email'])){
	$email=$_POST['email'];
}
$password="";
if(isset($_POST['password'])){
	$password=$_POST['password'];
}
if(isset($_POST['insert'])){
	$newParticipante = new Participante("", $nombre, $apellido, $email, $password, "");
	$newParticipante -> insert();
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
	$participante = new Participante();
	if($_SESSION['id'] == "" && $participante -> logIn($email, $password)){
	    $_SESSION['id']=$participante -> getIdParticipante();
	    $_SESSION['entity']="Participante";
	    $logParticipante = new LogParticipante("", "Log In", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $participante -> getIdParticipante());
	    $logParticipante -> insert();
	    echo "<script>location.href = 'index.php?pid=" . base64_encode('ui/cuestionario/insertCuestionario.php') . "&par=true" . "'</script>";
	}
	if($_SESSION['entity'] == 'Administrator'){
		$logAdministrator = new LogAdministrator("","Create Participante", "Nombre: " . $nombre . ";; Apellido: " . $apellido . ";; Email: " . $email . ";; Password: " . $password, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logAdministrator -> insert();
	}
	else if($_SESSION['entity'] == 'Evaluador'){
		$logEvaluador = new LogEvaluador("","Create Participante", "Nombre: " . $nombre . ";; Apellido: " . $apellido . ";; Email: " . $email . ";; Password: " . $password, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logEvaluador -> insert();
	}
	else if($_SESSION['entity'] == 'Participante'){
		$logParticipante = new LogParticipante("","Create Participante", "Nombre: " . $nombre . ";; Apellido: " . $apellido . ";; Email: " . $email . ";; Password: " . $password, date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $_SESSION['id']);
		$logParticipante -> insert();
	}
	$processed=true;
}

//registrer the user without entity

if($_SESSION['id'] != ""){
?>
<ol class="breadcrumb">
    <li class="breadcrumb-item">Inicio</li>
    <li class="breadcrumb-item">Participante</li>
	<li class="breadcrumb-item active">Ingresar Participante</li>
	<li class="breadcrumb-menu d-md-down-none">
		<div class="btn-group" role="group" aria-label="Button group">
		</div>
	</li>
</ol>
<?php }
else{
    echo "<script>document.getElementsByTagName('body')[0].className='app header-fixed sidebar-fixed aside-menu-fixed pace-done'</script>";
}
?>
<div class="container" id="principalContainer">
	<?php
	$_SESSION['id'] != "" ? print("") : print("<script>document.getElementById('principalContainer').style.paddingBottom = '90px';</script>");
	?>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><?php $_SESSION['id'] != "" ? print("Crear Participante") : print("Registrar Nuevo Usuario")?></h4>
				</div>
				<div class="card-body">
					<?php if($processed){ ?>
					<div class="alert alert-success" >Datos Ingresados
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<?php } ?>
					<form id="form" method="post" action="index.php?pid=<?php echo base64_encode("ui/participante/insertParticipante.php") ?>" class="bootstrap-form needs-validation" novalidate  >
						<div class="form-group">
							<label>Nombre*</label>
							<input type="text" class="form-control" name="nombre" value="<?php echo $nombre ?>" required />
						</div>
						<div class="form-group">
							<label>Apellido*</label>
							<input type="text" class="form-control" name="apellido" value="<?php echo $apellido ?>" required />
						</div>
						<div class="form-group">
							<label>Correo</label>
							<input type="email" class="form-control" name="email" value="<?php echo $email ?>"  required />
						</div>
						<div class="form-group">
							<label>Contraseña</label>
							<input type="password" class="form-control" name="password" value="<?php echo $password ?>" required />
						</div>
						<button type="submit" class="btn" name="insert">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
