<?php
$logInError=false;
if(isset($_POST['logIn'])){
	if(isset($_POST['email']) && isset($_POST['password'])){
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
		$email=$_POST['email'];
		$password=$_POST['password'];
		$administrator = new Administrator();
		if($administrator -> logIn($email, $password)){
			$_SESSION['id']=$administrator -> getIdAdministrator();
			$_SESSION['entity']="Administrator";
			$logAdministrator = new LogAdministrator("", "Log In", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $administrator -> getIdAdministrator());
			$logAdministrator -> insert();
			//Redirect to reports ?
			echo "<script>location.href = 'index.php?pid=" . base64_encode("ui/cuestionario/reportAllCuestionarios.php") . "'</script>"; 
		}
		$evaluador = new Evaluador();
		if($evaluador -> logIn($email, $password)){
			$_SESSION['id']=$evaluador -> getIdEvaluador();
			$_SESSION['entity']="Evaluador";
			$logEvaluador = new LogEvaluador("", "Log In", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $evaluador -> getIdEvaluador());
			$logEvaluador -> insert();
			//Redirect to reports ?
			echo "<script>location.href = 'index.php?pid=" . base64_encode("ui/cuestionario/reportAllCuestionarios.php") . "'</script>"; 
		}
		$participante = new Participante();
		if($participante -> logIn($email, $password)){
			$_SESSION['id']=$participante -> getIdParticipante();
			$_SESSION['entity']="Participante";
			$logParticipante = new LogParticipante("", "Log In", "", date("Y-m-d"), date("H:i:s"), $user_ip, PHP_OS, $browser, $participante -> getIdParticipante());
			$logParticipante -> insert();
			//Redirect to reports ?
			echo "<script>location.href = 'index.php?pid=" . base64_encode('ui/cuestionario/insertCuestionario.php') . "'</script>"; 
		}
		$logInError=true;
	}
}
?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card-group">
        <div class="card p-4">
          <div class="card-body">
          	<form id="form" method="post" action="index.php" class="bootstrap-form needs-validation" novalidate >
                <h1>Login</h1>
                <p class="text-muted"></p>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-user"></i>
                    </span>
                  </div>
                  <input type="email" class="form-control" name="email" placeholder="Correo" autocomplete="off" required />
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-lock"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control" name="password" placeholder="Clave" required />
                </div>
              	<?php if($logInError){ echo "<div class='alert alert-danger' >Correo o clave no valida.</div>";}?>
                <div class="row">
                  <div class="col-6">
                    <button class="btn btn-primary px-4" type="submit" class="btn btn-primary" name="logIn">Ingresar</button>
                  </div>
                  <div class="col-6 text-right">
                    <button class="btn btn-link px-0" type="button" onclick="location.href='index.php?pid=<?php echo base64_encode("ui/recoverPassword.php")?>'">¿Olvidaste tu clave?</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
        <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
          <div class="card-body text-center">
            <div>
              <h2>Registrate</h2>
              <p></p>
              <button class="btn btn-primary active mt-3" type="button">Registrate ahora</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
