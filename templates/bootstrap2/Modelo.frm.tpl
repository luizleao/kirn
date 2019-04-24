<?php
require_once("classes/autoload.php");
$oController = new Controller%%NOME_CLASSE%%();

$o%%NOME_CLASSE%% = ($_REQUEST['%%ID_PK%%'] == "") ? NULL        : $oController->get($_REQUEST['%%ID_PK%%']);
$label   = (is_null($o%%NOME_CLASSE%%)) ? "Cadastrar" : "Editar";

if($_POST){
    $operacao = (is_object($o%%NOME_CLASSE%%)) ? ($oController->alterar()) : ($oController->cadastrar());
    print ($operacao) ? "" : $oController->msg; exit;
}

%%CARREGA_COLECAO%%
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
                <li><a href="adm%%NOME_CLASSE%%.php">%%NOME_CLASSE%%</a> <span class="divider">/</span></li>
                <li class="active"><?=$label?></li>
            </ul>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
            <form onsubmit="return false;">
                <fieldset>
%%ATRIBUICAO%%
                    <div class="form-actions">
                        <button id="btn<?=$label?>" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn" href="adm%%NOME_CLASSE%%.php">Voltar</a>
                        <input type="hidden" name="classe" id="classe" value="%%NOME_CLASSE%%" />
                        %%CHAVE_PRIMARIA%%
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