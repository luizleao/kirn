<?php
require_once ("classes/Autoload.php");
$oController = new Controller();
$config = $oController->config;

if ($_POST) {
    print ($oController->autenticaUsuario()) ? "" : $oController->msg;
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
<?php require_once("includes/loading.php");?>
	<main class="container">
		<div class="card">
			<div class="card-content">
				<form class="form-signin" onsubmit="return false;">
					<img src="img/logo.png" />
					<h5 class="form-signin-heading">Sistema <?=$config['producao']['sistema']?></h5>
					<div class="row">
						<div class="input-field col s12">
							<input type="text" class="input-block-level" id="login"
								name="login" autofocus="autofocus" /> <label for="login">Login</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input type="password" class="input-block-level" id="senha"
								name="senha" /> <label for="senha">Senha</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<button class="btn waves-effect waves-light" name="btnLogar"
								id="btnLogar" type="submit">Entrar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</main>
    <?php require_once("includes/footer.php");?>
    <?php require_once("includes/modals.php");?>
    <?php require_once("includes/js.php");?>
</body>
</html>