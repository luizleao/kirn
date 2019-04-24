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
	<?php include_once("includes/menu.php");?>
	<?php include_once("includes/loading.php");?>
    <main class="container light">
    	<blockquote class="border">
    		<a href="home.php">Home</a> <i class="material-icons">chevron_right</i>
    	 	<a href="adm%%NOME_CLASSE%%.php">%%NOME_CLASSE%%</a> <i class="material-icons">chevron_right</i> <?=$label?>
    	</blockquote>
<?php 
if($oController->msg != "")
    $oController->componenteMsg($oController->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col s6">
                    %%ATRIBUICAO%%
                </div>
            </div>
            <div class="row">
                <div class="form-actions">
                    <button id="btn<?=$label?>" type="submit" class="btn btn-small tooltipped" data-position="top" data-tooltip="Salvar"><i class="material-icons">save</i> </button>
					<a class="btn btn-small tooltipped" href="adm%%NOME_CLASSE%%.php" data-position="top" data-tooltip="Voltar"><i class="material-icons">arrow_back</i> </a>
                    %%CHAVE_PRIMARIA%%
                    <input type="hidden" name="classe" id="classe" value="%%NOME_CLASSE%%" />
                </div>
            </div>
        </form>
    </main>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/modals.php");?>
	<?php require_once("includes/js.php");?>
</body>
</html>