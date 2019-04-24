<?php
require_once("classes/autoload.php");
$oController = new ControllerAcessoSession();

$oAcessoSession = ($_REQUEST['sessions_id'] == "") ? NULL        : $oController->get($_REQUEST['sessions_id']);
$label   = (is_null($oAcessoSession)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oAcessoSession)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerAcesso = new ControllerAcesso();$aAcesso = $oControllerAcesso->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="AcessoSessionController">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="home.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="admAcessoSession.php">AcessoSession</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?=$label?></li>
			</ol>
		</nav>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
	<div class="form-group">
		<label for="acesso_id">Acesso</label>
		<select name="acesso_id" id="acesso_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aAcesso as $oAcesso){
		?>
			<option value="<?=$oAcesso->acesso_id?>"<?=($oAcesso->acesso_id == $oAcessoSession->oAcesso->id) ? " selected" : ""?>><?=$oAcesso->id?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="acesso_id">Acesso</label>
		<select name="acesso_id" id="acesso_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aAcesso as $oAcesso){
		?>
			<option value="<?=$oAcesso->acesso_id?>"<?=($oAcesso->acesso_id == $oAcessoSession->oAcesso->id) ? " selected" : ""?>><?=$oAcesso->id?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admAcessoSession.php">Voltar</a>
                        <input name="sessions_id" type="hidden" id="sessions_id" value="<?=$_REQUEST['sessions_id']?>" />
                        <input type="hidden" name="classe" id="classe" value="AcessoSession" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>