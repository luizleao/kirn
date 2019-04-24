<?php
require_once("classes/autoload.php");
$oController = new ControllerSicasLotacao();

$oSicasLotacao = ($_REQUEST['cd_lotacao'] == "") ? NULL        : $oController->get($_REQUEST['cd_lotacao']);
$label   = (is_null($oSicasLotacao)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($oSicasLotacao)) ? ($oController->alterar()) : ($oController->cadastrar());
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
                <li><a href="admSicasLotacao.php">SicasLotacao</a> <span class="divider">/</span></li>
                <li class="active"><?=$label?></li>
            </ul>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
            <form onsubmit="return false;">
                <fieldset>

                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn" href="admSicasLotacao.php">Voltar</a>
                        <input type="hidden" name="classe" id="classe" value="SicasLotacao" />
                        <input name="cd_lotacao" type="hidden" id="cd_lotacao" value="<?=$_REQUEST['cd_lotacao']?>" />
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