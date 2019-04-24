<?php
require_once("classes/autoload.php");
$oController = new ControllerServico();

$oServico = ($_REQUEST['idServico'] == "") ? NULL        : $oController->get($_REQUEST['idServico']);
$label   = (is_null($oServico)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oServico)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerSla = new ControllerSla();$aSla = $oControllerSla->getAll([], []);
$oControllerTipoServico = new ControllerTipoServico();$aTipoServico = $oControllerTipoServico->getAll([], []);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
    <div id="wrap">
        <?php require_once("includes/menu.php");?>
        <div class="container">
            <?php require_once("includes/titulo.php"); ?>
            <ul class="breadcrumb">
                <li><a href="home.php">Home</a> <span class="divider">/</span></li>
                <li><a href="admServico.php">Servico</a> <span class="divider">/</span></li>
                <li class="active"><?=$label?></li>
            </ul>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
            <form onsubmit="return false;">
                <fieldset>

<label for="idSla">Sla</label>
<select name="idSla" id="idSla" class="input-xlarge">
    <option value="">Selecione</option>
<?php
foreach($aSla as $oSla){
?>
    <option value="<?=$oSla->idSla?>"<?=($oSla->idSla == $oServico->oSla->idSla) ? " selected" : ""?>><?=$oSla->descricao?></option>
<?php
}
?>
</select>
<label for="idTipoServico">TipoServico</label>
<select name="idTipoServico" id="idTipoServico" class="input-xlarge">
    <option value="">Selecione</option>
<?php
foreach($aTipoServico as $oTipoServico){
?>
    <option value="<?=$oTipoServico->idTipoServico?>"<?=($oTipoServico->idTipoServico == $oServico->oTipoServico->idTipoServico) ? " selected" : ""?>><?=$oTipoServico->descricao?></option>
<?php
}
?>
</select>
<label for="descricao">Descricao</label>
<input type="text" class="input-xlarge" id="descricao" name="descricao" value="<?=$oServico->descricao?>" />
<label class="control-label" for="valor">valor</label>
<div class="controls">
    <div class="input-prepend">
        <span class="add-on">R$</span>
        <input type="text" class="input-xlarge money" name="valor" id="valor" value="<?=$oServico->valor?>" />
    </div>
</div>
<label for="status">Status</label>
<input type="text" class="input-xlarge" id="status" name="status" value="<?=$oServico->status?>" />
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn" href="admServico.php">Voltar</a>
                        <input type="hidden" name="classe" id="classe" value="Servico" />
                        <input name="idServico" type="hidden" id="idServico" value="<?=$_REQUEST['idServico']?>" />
                    </div>
                </fieldset>
            </form>
        </div>
        <div id="push"></div>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php")?>
</body>
</html>