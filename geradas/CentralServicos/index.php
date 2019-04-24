<?php
require_once("classes/autoload.php");
$oController = new Controller();
$config = $oController->config;

if($_POST){
    print ($oController->autenticaUsuario()) ? "" : $oController->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/headerLogin.php");?>
</head>
<body>
    <div id="wrap">
        <div class="container">
            <form class="form-signin" onsubmit="return false;">
                <?php require_once("includes/titulo.php");?>
                <input type="text" class="input-block-level" id="login" name="login" autofocus="autofocus" placeholder="Login" />
                <input type="password" class="input-block-level" id="senha" name="senha" placeholder="Senha" />
                <button class="btn btn-primary" data-loading-text="loading..." name="btnLogar" id="btnLogar" type="submit">Entrar</button>
                <div class="g-signin2" data-onsuccess="onSignIn"></div>
            </form>
        </div>
        <div class="push"></div>
    </div>
    <?php require_once("includes/footer.php");?>
    <?php require_once("includes/modals.php");?>
</body>
</html>