<?php
require_once("classes/autoload.php");
$oController = new ControllerSla();

$oSla = ($_REQUEST['idSla'] == "") ? NULL        : $oController->get($_REQUEST['idSla']);
$label   = (is_null($oSla)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oSla)) ? ($oController->alterar()) : ($oController->cadastrar());
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
                <li><a href="admSla.php">Sla</a> <span class="divider">/</span></li>
                <li class="active"><?=$label?></li>
            </ul>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
            <form onsubmit="return false;">
                <fieldset>

<label for="descricao">Descricao</label>
<input type="text" class="input-xlarge" id="descricao" name="descricao" value="<?=$oSla->descricao?>" />
<label for="status">Status</label>
<input type="text" class="input-xlarge" id="status" name="status" value="<?=$oSla->status?>" />
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn" href="admSla.php">Voltar</a>
                        <input type="hidden" name="classe" id="classe" value="Sla" />
                        <input name="idSla" type="hidden" id="idSla" value="<?=$_REQUEST['idSla']?>" />
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