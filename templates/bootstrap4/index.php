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
    <?php require_once ("includes/headerLogin.php");?>
</head>
<body>
<?php require_once("includes/modalResposta.php");?>
    <div id="wrap">
		<div class="container">
			<form class="form-signin" onsubmit="return false;">
                <?php require_once("includes/titulo.php");?>
                <input type="text" class="form-control" id="login"
					name="login" autofocus="autofocus" placeholder="Login" /> <input
					type="password" class="form-control" id="senha" name="senha"
					placeholder="Senha" />
				<button class="btn btn-success btn-sm"
					data-loading-text="Carregado..." name="btnLogar" id="btnLogar"
					type="submit">
					<i class="glyphicon glyphicon-ok"></i> Entrar
				</button>
			</form>
		</div>
		<div class="push"></div>
	</div>
    <?php require_once("includes/footer.php");?>
</body>
</html>