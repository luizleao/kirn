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
    <main>
    	<?php require_once("includes/titulo.php");?>
		<form onsubmit="return false;">
			<fieldset>
				<div>
                    <input type="text" id="login" name="login" autofocus="autofocus" placeholder="Login" /> 
                    <input type="password" id="senha" name="senha" placeholder="Senha" />
            		<button class="button" data-loading-text="Carregado..." name="btnLogar" id="btnLogar" type="submit">
            			Entrar
            		</button>
        		</div>
			</fieldset>
		</form>
	</main>
    <?php require_once("includes/footer.php");?>
    <?php require_once("includes/js.php");?>
</body>
</html>