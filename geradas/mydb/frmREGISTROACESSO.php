<?php
require_once("classes/autoload.php");
$oController = new ControllerREGISTROACESSO();

$oREGISTROACESSO = ($_REQUEST['id'] == "") ? NULL        : $oController->get($_REQUEST['id']);
$label   = (is_null($oREGISTROACESSO)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oREGISTROACESSO)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerPESSOA = new ControllerPESSOA();$aPESSOA = $oControllerPESSOA->getAll([], []);
$oControllerPERFILACESSO = new ControllerPERFILACESSO();$aPERFILACESSO = $oControllerPERFILACESSO->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <div class="container">
        <?php 
        require_once("includes/titulo.php"); 
        require_once("includes/menu.php"); 
        ?>
        <ol class="breadcrumb">
            <li><a href="home.php">Home</a></li>
            <li><a href="admREGISTROACESSO.php">REGISTROACESSO</a></li>
            <li class="active"><?=$label?></li>
        </ol>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
            <div class="row">
            	
<div class="col-md-4">
	<div class="form-group">
	    <label for="data">Data</label>
	    <?php $oController->componenteCalendario('data', Util::formataDataBancoForm($oREGISTROACESSO->data), NULL, false)?>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="hora">Hora</label>
		<input type="text" class="form-control" id="hora" name="hora" value="<?=$oREGISTROACESSO->hora?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="sentido">Sentido</label>
		<input type="text" class="form-control" id="sentido" name="sentido" value="<?=$oREGISTROACESSO->sentido?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="permissao">Permissao</label>
		<input type="text" class="form-control" id="permissao" name="permissao" value="<?=$oREGISTROACESSO->permissao?>" />
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="PESSOA_id">PESSOA</label>
		<select name="PESSOA_id" id="PESSOA_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aPESSOA as $oPESSOA){
		?>
			<option value="<?=$oPESSOA->PESSOA_id?>"<?=($oPESSOA->PESSOA_id == $oREGISTROACESSO->oPESSOA->id) ? " selected" : ""?>><?=$oPESSOA->nome?></option>
		<?php
		}
		?>
		</select>
	</div>
</div>
<div class="col-md-4">
	<div class="form-group">
		<label for="PERFIL_ACESSO_id">PERFILACESSO</label>
		<select name="PERFIL_ACESSO_id" id="PERFIL_ACESSO_id" class="form-control">
			<option value="">Selecione</option>
		<?php
		foreach($aPERFILACESSO as $oPERFILACESSO){
		?>
			<option value="<?=$oPERFILACESSO->PERFIL_ACESSO_id?>"<?=($oPERFILACESSO->PERFIL_ACESSO_id == $oREGISTROACESSO->oPERFILACESSO->id) ? " selected" : ""?>><?=$oPERFILACESSO->nome?></option>
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
                        <a class="btn btn-default" href="admREGISTROACESSO.php">Voltar</a>
                        <input name="id" type="hidden" id="id" value="<?=$_REQUEST['id']?>" />
                        <input type="hidden" name="classe" id="classe" value="REGISTROACESSO" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
</body>
</html>