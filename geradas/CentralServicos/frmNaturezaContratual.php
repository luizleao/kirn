<?php
require_once("classes/autoload.php");
$oController = new ControllerNaturezaContratual();

$oNaturezaContratual = ($_REQUEST['idNaturezaContratual'] == "") ? NULL        : $oController->get($_REQUEST['idNaturezaContratual']);
$label   = (is_null($oNaturezaContratual)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oNaturezaContratual)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}


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
                <li><a href="admNaturezaContratual.php">NaturezaContratual</a> <span class="divider">/</span></li>
                <li class="active"><?=$label?></li>
            </ul>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
            <form onsubmit="return false;">
                <fieldset>

<label for="descricao">Descricao</label>
<input type="text" class="input-xlarge" id="descricao" name="descricao" value="<?=$oNaturezaContratual->descricao?>" />
<label for="status">Status</label>
<input type="text" class="input-xlarge" id="status" name="status" value="<?=$oNaturezaContratual->status?>" />
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn" href="admNaturezaContratual.php">Voltar</a>
                        <input type="hidden" name="classe" id="classe" value="NaturezaContratual" />
                        <input name="idNaturezaContratual" type="hidden" id="idNaturezaContratual" value="<?=$_REQUEST['idNaturezaContratual']?>" />
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