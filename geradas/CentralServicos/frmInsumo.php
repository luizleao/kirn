<?php
require_once("classes/autoload.php");
$oController = new ControllerInsumo();

$oInsumo = ($_REQUEST['idInsumo'] == "") ? NULL        : $oController->get($_REQUEST['idInsumo']);
$label   = (is_null($oInsumo)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oInsumo)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

$oControllerNaturezaContratual = new ControllerNaturezaContratual();$aNaturezaContratual = $oControllerNaturezaContratual->getAll([], []);
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
                <li><a href="admInsumo.php">Insumo</a> <span class="divider">/</span></li>
                <li class="active"><?=$label?></li>
            </ul>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
            <form onsubmit="return false;">
                <fieldset>

<label for="idNaturezaContratual">NaturezaContratual</label>
<select name="idNaturezaContratual" id="idNaturezaContratual" class="input-xlarge">
    <option value="">Selecione</option>
<?php
foreach($aNaturezaContratual as $oNaturezaContratual){
?>
    <option value="<?=$oNaturezaContratual->idNaturezaContratual?>"<?=($oNaturezaContratual->idNaturezaContratual == $oInsumo->oNaturezaContratual->idNaturezaContratual) ? " selected" : ""?>><?=$oNaturezaContratual->descricao?></option>
<?php
}
?>
</select>
<label for="descricao">Descricao</label>
<input type="text" class="input-xlarge" id="descricao" name="descricao" value="<?=$oInsumo->descricao?>" />
<label for="estoque">Estoque</label>
<input type="text" class="input-xlarge" id="estoque" name="estoque" value="<?=$oInsumo->estoque?>" />
<label class="control-label" for="valor">valor</label>
<div class="controls">
    <div class="input-prepend">
        <span class="add-on">R$</span>
        <input type="text" class="input-xlarge money" name="valor" id="valor" value="<?=$oInsumo->valor?>" />
    </div>
</div>
<label for="status">Status</label>
<input type="text" class="input-xlarge" id="status" name="status" value="<?=$oInsumo->status?>" />
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn" href="admInsumo.php">Voltar</a>
                        <input type="hidden" name="classe" id="classe" value="Insumo" />
                        <input name="idInsumo" type="hidden" id="idInsumo" value="<?=$_REQUEST['idInsumo']?>" />
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