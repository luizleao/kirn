<?php
require_once("classes/autoload.php");
$oController = new ControllerTipoServico();

$oTipoServico = ($_REQUEST['idTipoServico'] == "") ? NULL        : $oController->get($_REQUEST['idTipoServico']);
$label   = (is_null($oTipoServico)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oTipoServico)) ? ($oController->alterar()) : ($oController->cadastrar());
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
                <li><a href="admTipoServico.php">TipoServico</a> <span class="divider">/</span></li>
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
    <option value="<?=$oNaturezaContratual->idNaturezaContratual?>"<?=($oNaturezaContratual->idNaturezaContratual == $oTipoServico->oNaturezaContratual->idNaturezaContratual) ? " selected" : ""?>><?=$oNaturezaContratual->descricao?></option>
<?php
}
?>
</select>
<label for="descricao">Descricao</label>
<input type="text" class="input-xlarge" id="descricao" name="descricao" value="<?=$oTipoServico->descricao?>" />
<label for="status">Status</label>
<input type="text" class="input-xlarge" id="status" name="status" value="<?=$oTipoServico->status?>" />
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn" href="admTipoServico.php">Voltar</a>
                        <input type="hidden" name="classe" id="classe" value="TipoServico" />
                        <input name="idTipoServico" type="hidden" id="idTipoServico" value="<?=$_REQUEST['idTipoServico']?>" />
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