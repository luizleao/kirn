<?php
require_once("classes/autoload.php");
$oController = new Controller();
// ================= Edicao do Usuario ========================= 
$oUsuario = $oController->getUsuario($_SESSION['usuarioAtual']->idUsuario);

if($_POST){
    //Util::trace($_REQUEST);exit;
    print ($oController->alterarSenha($oUsuario, $_REQUEST['senhaAtual'], $_REQUEST['novaSenha1'], $_REQUEST['novaSenha2'])) ? "" : $oControle->msg; exit;
}

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/menu.php");?>
	<div class="container">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="principal.php">Início</a></li>
				<li class="breadcrumb-item">Usuário</li>
				<li class="breadcrumb-item active" aria-current="page">Alterar Senha</li>
			</ol>
		</nav>

<?php 
if($oControllerl->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="senhaAtual">Senha Atual</label>
                        <input type="password" class="form-control" id="senhaAtual" name="senhaAtual" value="" />
                    </div>
                    <div class="form-group">
                        <label for="novaSenha1">Nova Senha</label>
                        <input type="password" class="form-control" id="novaSenha1" name="novaSenha1" value="" />
                    </div>
                    <div class="form-group">
                        <label for="novaSenha2">Repetir Nova Senha</label>
                        <input type="password" class="form-control" id="novaSenha2" name="novaSenha2" value="" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnAlterarSenha" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Alterar</button>
                        <a class="btn btn-default" href="admUsuario.php">Voltar</a>
                        <input name="idUsuario" type="hidden" id="idUsuario" value="<?=$oUsuario->idUsuario?>" />
                        <input type="hidden" name="classe" id="classe" value="Usuario" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>